<?php

namespace App\Models;

use CodeIgniter\Model;

class BerandaModel extends Model
{
    public function getTransaksi($tahun)
    {
        return $this->db->table('sale_detail as sd')
            ->select("MONTH(s.created_at) bulan, SUM(sd.total_price) total")
            ->join('sale s', 'sale_id')
            ->where('YEAR(s.created_at)', $tahun)
            ->groupBy('MONTH(s.created_at)')
            ->orderBy('MONTH(s.created_at)')
            ->get()->getResultArray();
    }

    public function getCustomer($tahun)
    {
        return $this->db->table('customer')
            ->select("MONTH(created_at) bulan, COUNT(*) total")
            ->where('YEAR(created_at)', $tahun)
            ->groupBy('MONTH(created_at)')
            ->orderBy('MONTH(created_at)')
            ->get()->getResultArray();
    }

    public function getTransaksiPembelian($tahun)
    {
        return $this->db->table('buy_detail as bd')
            ->select("MONTH(b.created_at) bulan, SUM(bd.total_price) total")
            ->join('buy b', 'buy_id')
            ->where('YEAR(b.created_at)', $tahun)
            ->groupBy('MONTH(b.created_at)')
            ->orderBy('MONTH(b.created_at)')
            ->get()->getResultArray();
    }

    public function getSupplier($tahun)
    {
        return $this->db->table('supplier')
            ->select("MONTH(created_at) bulan, COUNT(*) total")
            ->where('YEAR(created_at)', $tahun)
            ->groupBy('MONTH(created_at)')
            ->orderBy('MONTH(created_at)')
            ->get()->getResultArray();
    }
}
