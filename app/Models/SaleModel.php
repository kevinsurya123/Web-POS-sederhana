<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    //Nama Tabel
    protected $table                = 'sale';
    protected $useTimestamps = true;
    protected $allowedFields        = ['sale_id', 'user_id', 'customer_id'];


    public function getLaporan($tanggal_awal, $tanggal_akhir)
    {
        return $this->db->table('sale_detail as sd')
            ->select('s.sale_id, s.created_at tanggal_transaksi,  s.user_id, p.firstname, p.lastname, s.customer_id,
         c.name nama_customer, SUM(sd.total_price)total')
            ->join('sale s', 'sd.sale_id = s.sale_id')
            ->join('pengguna p', 'p.id = s.user_id')
            ->join('customer c', 'c.customer_id = s.customer_id', 'left')
            ->where('date(s.created_at) >=', $tanggal_awal)
            ->where('date(s.created_at) <=', $tanggal_akhir)
            ->groupBy('s.sale_id')
            ->get()->getResultArray();
    }
}
