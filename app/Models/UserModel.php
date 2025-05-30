<?php

namespace App\Models;
use CodeIgniter\Model;
class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'role', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $returnType = 'object';
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[6]|max_length[255]',
        'role' => 'in_list[user,admin]'
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already registered.'
        ],
        'role' => [
            'in_list' => 'Role must be either user or admin.'
        ]
    ];
    protected $skipValidation = false;
}