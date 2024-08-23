<?php

namespace App\Models;

use CodeIgniter\Model;

class BuyDetailModel extends Model
{
    //Nama Tabel
    protected $table                = 'buy_detail';
    protected $allowedFields        = ['buy_id', 'service_id', 'amount', 'price', 'discount', 'total_price'];

    public function getDetail($buy_id)
    {
        $this->select('buy_detail.* b.title, c.name_category')
            ->join('service b', 'service_id')
            ->join('service_category c', 'service_category_id')
            ->where('buy_id', $buy_id)
            ->findAll();
    }
}
