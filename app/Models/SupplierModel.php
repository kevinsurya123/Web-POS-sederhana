<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table                = 'supplier';
    protected $primaryKey           = 'supplier_id';
    protected $allowedFields        = ['name', 'no_supplier', 'address', 'gender', 'email', 'phone'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}