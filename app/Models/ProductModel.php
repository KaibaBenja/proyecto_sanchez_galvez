<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'description',
        'brand_id',
        'category_id',
        'price',
        'image_url',
        'created_at',
        'updated_at',
    ];
    protected $returnType = true;
}
