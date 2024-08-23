<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleDetailModel extends Model
{
    //Nama Tabel
    protected $table                = 'sale_detail';
    protected $allowedFields        = ['sale_id', 'service_id', 'amount', 'price', 'discount', 'total_price'];

    public function getDetail($sale_id)
    {
        $this->select('sale_detail.* b.title, c.name_category')
            ->join('service b', 'service_id')
            ->join('service_category c', 'service_category_id')
            ->where('sale_id', $sale_id)
            ->findAll();
    }
}
