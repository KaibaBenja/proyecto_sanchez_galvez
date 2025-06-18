<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table            = 'cart';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'product_id', 'size_id', 'quantity', 'active'];
    protected $useTimestamps    = true;

    // Obtener todos los ítems activos del carrito del usuario
    public function getUserCart($userId)
    {
        return $this->select('cart.*, products.name, products.price, products.image_url, sizes.size_label')
                    ->join('products', 'products.id = cart.product_id')
                    ->join('sizes', 'sizes.id = cart.size_id')
                    ->where('cart.user_id', $userId)
                    ->where('cart.active', 1)
                    ->findAll();
    }
}
