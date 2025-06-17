<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductSizeModel extends Model
{
    protected $table = 'product_sizes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'size_id', 'stock'];
    protected $returnType = 'object';
}
