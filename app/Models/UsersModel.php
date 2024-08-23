<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    //nama table
    protected $table                = 'pengguna';
    protected $primaryKey           = 'id';
    protected $allowedFields        = [
        'firstname', 'lastname', 'role',
        'user_name', 'user_email', 'user_password', 'user_created_at'
    ];

    public function getUsers($id = false)
    {
        $query = $this->table('pengguna');

        [
            'firstname', 'lastname', 'role',
            'user_name', 'user_email', 'user_password', 'user_created_at'
        ];
        if ($id == false)
            return $query->get()->getResultArray();
        return $query->where(['id' => $id])->first();
    }
}
