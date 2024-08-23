<?php

namespace App\Controllers;

use \App\Models\ServiceModel;
use \App\Models\CategoryModel;

class Service extends BaseController
{
    private $serviceModel, $catModel;
    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->catModel = new CategoryModel();
    }
    public function index()
    {
        $dataService = $this->serviceModel->getService();
        $serviceModel = new ServiceModel();
        $dataService = $serviceModel->findAll();
        $data = [
            'title' => 'Data Service',
            'result' => $dataService
        ];
        return view('service/index', $data);
    }
    public function detail($slug)
    {
        $dataService = $this->serviceModel->getService($slug);
        $data = [
            'title' => 'Detail Layanan',
            'result' => $dataService
        ];
        return view('service/detail', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Tambah Layanan',
            'category' => $this->catModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('service/create', $data);
    }
    public function save()
    {
        //validasi cok
        if (!$this->validate([
            'title' =>  [
                'rules' => 'required|is_unique[service.title]',
                'label' => 'Nama',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'price' =>  'required|numeric',
            'discount' =>  'permit_empty|decimal',
        ])) {
            return redirect()->to('/service/create')->withInput();
        }
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->serviceModel->save([
            'title' => $this->request->getVar('title'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount'),
            'stock' => $this->request->getVar('stock'),
            'service_category_id' => $this->request->getVar('service_category_id'),
            'slug' => $slug,
        ]);

        session()->setFlashdata("msg", "Data Berhasil Dimasukan");
        return redirect()->to('/service');
    }

    public function edit($slug)
    {
        $dataService = $this->serviceModel->getService($slug);
        if (empty($dataService)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul Service $slug
            tidak ditemukan");
        }

        $data = [
            'title' => 'Ubah Service',
            'category' => $this->catModel->findAll(),
            'validation' => \Config\Services::validation(),
            'result' => $dataService
        ];
        return view('service/edit', $data);
    }

    public function update($id)
    {
        //Cek Judul
        $dataOld = $this->serviceModel->getService($this->request->getVar('slug'));
        if ($dataOld['title'] == $this->request->getVar('title')) {
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[service.title]';
        }
        //Validasi Data
        if (!$this->validate([
            'title' => [
                'rules' => $rule_title,
                'label' => 'Judul',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'author' => 'required',
            'release_year' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'permit_empty|decimal',
            'stock' => 'required|integer',
        ])) {
            return redirect()->to('/service/edit/' . $this->request->getVar('slug'))->withInput();
        }
        // Membuat string menjadi huruf kecil semua dan spasinya diganti -
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->serviceModel->save([
            'service_id' => $id,
            'title' => $this->request->getVar('title'),
            'author' => $this->request->getVar('author'),
            'release_year' => $this->request->getVar('release_year'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount'),
            'stock' => $this->request->getVar('stock'),
            'service_category_id' => $this->request->getVar('service_category_id'),
            'slug' => $slug,
        ]);

        session()->setFlashdata("msg", "Data berhasil diubah!");

        return redirect()->to('/service');
    }

    public function delete($id)
    {
        $this->serviceModel->delete($id);
        session()->setFlashdata("msg", "Data Berhasil Dihapus!");
        return redirect()->to('/service');
    }
}
