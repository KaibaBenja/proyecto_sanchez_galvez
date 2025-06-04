<?php

namespace App\Models;

use CodeIgniter\Model;

class SizeModel extends Model
{
    protected $table      = 'sizes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['size_label'];
    protected $returnType = 'object';
}
