<?php

namespace App\Controllers;

use \App\Models\ServiceModel;
use \App\Models\SupplierModel;
use \App\Models\BuyModel;
use \App\Models\BuyDetailModel;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;

define('_TITLE', 'Pembelian');

class Pembelian extends BaseController
{

    private $service, $cart, $supplier, $buy, $buyDetail;
    public function __construct()
    {
        $this->service = new ServiceModel();
        $this->supplier = new SupplierModel();
        $this->buy = new BuyModel();
        $this->buyDetail = new BuyDetailModel();
        $this->cart = \Config\Services::cart();
    }
    public function index()
    {
        //dd($this->cart->contents());
        $this->cart->destroy();
        $dataService = $this->service->getService();
        $dataSupplier = $this->supplier->findAll();
        $data = [
            'judul' => _TITLE,
            'dataService' => $dataService,
            'dataSupplier' => $dataSupplier,
        ];
        return view('pembelian/list', $data);
    }
    public function addCart()
    {
        $this->cart->insert(array(
            'id'      => $this->request->getVar('id'),
            'qty'     => $this->request->getVar('qty'),
            'price'   => $this->request->getVar('price'),
            'name'    => $this->request->getVar('name'),
            'options' => array(
                'discount' => $this->request->getVar('discount'),
            )
        ));
        echo $this->showCart();
    }
    public function loadCart()
    {
        //load data cart
        echo $this->showCart();
    }
    public function showCart()
    {
        //tampil Cart
        $output = '';
        $no = 1;
        foreach ($this->cart->contents() as $items) {
            $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
            $output .= '
            <tr>
            <td> ' . $no++ . '</td>
            <td> ' . $items['name'] . '</td>
            <td> ' . $items['qty'] . '</td>
            <td> ' . number_to_currency($items['price'], 'IDR', 'id_ID', 2) . '</td>
            <td> ' . number_to_currency($diskon, 'IDR', 'id_ID', 2) . '</td>
            <td> ' . number_to_currency($items['subtotal'] - $diskon, 'IDR', 'id_ID', 2) . '</td>
            <td><button id="' . $items['rowid'] . '" qty="' . $items['qty'] .
                '"
            class="ubah_cart btn btn-warning btn-xs" title="Ubah Jumlah"><i class="fa
            fa-edit"></i></button>            
            <button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn btn-danger
            btn-xs"><i class="fa fa-trash" title="Hapus"></i></button>
            </td>
            </tr>
            ';
        }
        if (!$this->cart->contents()) {
            $output = '<tr><td colspan="7" align="center">Tidak ada transaksi!</td></tr>';
        }
        return $output;
    }

    public function getTotal()
    {
        $totalBayar = 0;
        foreach ($this->cart->contents() as $items) {
            $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
            $totalBayar += $items['subtotal'] - $diskon;
            //$totalBayar = $totalBayar + $items['subtotal']-$diskon;
        }
        echo number_to_currency($totalBayar, 'IDR', 'id_ID', 2);
        //echo $totalBayar;
    }
    public function updateCart()
    {
        $this->cart->update(array(
            'rowid' => $this->request->getVar('rowid'),
            'qty' => $this->request->getVar('qty')
        ));
        echo $this->showCart();
    }

    public function deleteCart($rowid)
    {
        //fungsi hapus item cart
        $this->cart->remove($rowid);
        echo $this->showCart();
    }

    public function pembayaran()
    {
        //Cek ada transaksi yang dilakukan
        if (!$this->cart->contents()) {
            //Transaksi kosong
            $response = [
                'status' => false,
                'msg' => 'Tidak ada transaksi!'
            ];
            echo json_encode($response);
        } else {
            // Ada Transaksi
            // memperoleh total transaksi
            $totalBayar = 0;
            foreach ($this->cart->contents() as $items) {
                $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
                $totalBayar += $items['subtotal'] - $diskon;
            }

            $nominal = $this->request->getVar('nominal');
            $id = "J" . time();

            //Pengecekan apakah nominal yang dimasukkan cukup atau kurang
            if ($nominal < $totalBayar) {
                $response  = [
                    'status' => false,
                    'msg' => "Nominal Pembayaran Kurang!",
                ];
                echo json_encode($response);
            } else {
                //jika nominal memenuhi maka akan menyimpan data di tabel buy dan buy_detail
                $this->buy->save([
                    'buy_id' => $id,
                    'user_id' => session()->user_id,
                    'supplier_id' => $this->request->getVar('id-supp')
                ]);
                foreach ($this->cart->contents() as $items) {
                    // $diskon = ($items['options']['discount'] / 100) * $items['subtotal'];
                    $this->buyDetail->save([
                        'buy_id' => $id,
                        'service_id' => $items['id'],
                        'amount' => $items['qty'],
                        'price' => $items['price'],
                        'total_price' => $items['subtotal'] - $diskon,
                    ]);
                    //Mengurangi jumlah stock di tabel book
                    // Kita get book berdasar ID Book
                    $service = $this->service->where(['service_id' => $items['id']])->first();
                    $this->service->save([
                        'service_id' => $items['id'],
                        'stock' => $service['stock'] + $items['qty'],
                    ]);
                }
                $this->cart->destroy();
                $kembalian = $nominal - $totalBayar;

                $response = [
                    'status' => true,
                    'msg' => "Pembayaran Berhasil!",
                    'data' => [
                        'kembalian' => number_to_currency(
                            $kembalian,
                            'IDR',
                            'id_ID',
                            2

                        )
                    ]
                ];
                echo json_encode($response);
            }
        }
    }

    public function laporan($tanggal_awal = null, $tanggal_akhir = null)
    {
        //dd("Test Masuk");
        $_SESSION['tanggal_awal']  = $tanggal_awal == null ? date('Y-m-01') : $tanggal_awal;
        $_SESSION['tanggal_akhir'] = $tanggal_akhir == null ? date('Y-m-t') : $tanggal_akhir;

        $tanggal1 = $_SESSION['tanggal_awal'];
        $tanggal2 = $_SESSION['tanggal_akhir'];

        $laporan = $this->buy->getLaporan($tanggal1, $tanggal2);
        //dd($laporan);
        $data = [
            'title' => 'Laporan Pembelian',
            'result' => $laporan,
            'tanggal' => [
                'tanggal_awal' =>  $tanggal1,
                'tanggal_akhir' => $tanggal2,
            ]
        ];
        return view('pembelian/laporan', $data);
    }

    public function exportPDF()
    {
        $tanggal1 = $_SESSION['tanggal_awal'];
        $tanggal2 = $_SESSION['tanggal_akhir'];
        $laporan = $this->buy->getLaporan($tanggal1, $tanggal2);
        $data = [
            'title' => 'Laporan Pembelian',
            'result' => $laporan,
        ];
        $html = view('pembelian/exportPDF', $data);

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan-pembelian.pdf', 'I');
    }

    public function exportExcel()
    {
        $tanggal1 = $_SESSION['tanggal_awal'];
        $tanggal2 = $_SESSION['tanggal_akhir'];
        $laporan = $this->buy->getLaporan($tanggal1, $tanggal2);

        $spreadsheet = new Spreadsheet();
        //tulis header/nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nota')
            ->setCellValue('C1', 'Tanggal Transaksi')
            ->setCellValue('D1', 'User')
            ->setCellValue('E1', 'Supplier')
            ->setCellValue('F1', 'Total');

        //tulis data mobil ke cell
        $rows = 2;
        $no = 1;
        foreach ($laporan as $value) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $rows, $no++)
                ->setCellValue('B' . $rows, $value['buy_id'])
                ->setCellValue('C' . $rows, $value['tanggal_transaksi'])
                ->setCellValue('D' . $rows, $value['firstname'] . ' ' . $value['lastname'])
                ->setCellValue('E' . $rows, $value['nama_supplier'])
                ->setCellValue('F' . $rows, $value['total']);
            $rows++;
        }
        //tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan-Pembelian';

        //redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function filter()
    {
        $tanggal_awal = $this->request->getVar('tanggal_awal');
        $tanggal_akhir = $this->request->getVar('tanggal_akhir');
        return $this->laporan($tanggal_awal, $tanggal_akhir);
    }

    public function detail($buy_id)
    {
        $data = [
            'judul' => 'detail',
            'result' => $this->buyDetail->getDetail($buy_id)
        ];
        //dd($data);
        return view('pembelian/detail', $data);
    }
}
