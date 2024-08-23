<?php

namespace App\Models;

use CodeIgniter\Model;

class BuyModel extends Model
{
    //Nama Tabel
    protected $table                = 'buy';
    protected $useTimestamps = true;
    protected $allowedFields        = ['buy_id', 'user_id', 'supplier_id'];


    public function getLaporan($tanggal_awal, $tanggal_akhir)
    {
        return $this->db->table('buy_detail as bd')
            ->select('b.buy_id, b.created_at tanggal_transaksi,  b.user_id, p.firstname, p.lastname, b.supplier_id,
            s.name nama_supplier, SUM(bd.total_price)total')
            ->join('buy b', 'bd.buy_id = b.buy_id')
            ->join('pengguna p', 'p.id = b.user_id')
            ->join('supplier s', 's.supplier_id = b.supplier_id', 'left')
            ->where('date(b.created_at) >=', $tanggal_awal)
            ->where('date(b.created_at) <=', $tanggal_akhir)
            ->groupBy('b.buy_id')
            ->get()->getResultArray();
    }
}
