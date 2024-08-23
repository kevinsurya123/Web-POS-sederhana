<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table      = 'service';
    protected $primaryKey = 'service_id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'service_id', 'title', 'slug', 'price', 'discount', 'stock',  'service_category_id'
    ];
    // protected $useSoftDeletes = true;

    public function getService($slug = false)
    {
        $query = $this->table('service')
            ->join('service_category', 'service_category_id')
            ->where('deleted_at is null');

        if ($slug == false)
            return $query->get()->getResultArray();
        return $query->where(['slug' => $slug])->first();
    }
}
