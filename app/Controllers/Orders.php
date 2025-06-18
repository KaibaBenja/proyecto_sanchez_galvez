<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Orders extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $orders = $orderModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        foreach ($orders as &$order) {
            $items = $orderItemModel
                ->select('order_items.*, products.name AS product_name, sizes.size_label')
                ->join('products', 'products.id = order_items.product_id')
                ->join('sizes', 'sizes.id = order_items.size_id')
                ->where('order_id', $order['id'])
                ->findAll();

            $order['items'] = $items;
        }

        return view('orders/index', ['orders' => $orders]);
    }

}
