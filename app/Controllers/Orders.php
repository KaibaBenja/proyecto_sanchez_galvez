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

    public function all()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('user_role'), ['admin', 'vendedor'])) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        $orderModel = new \App\Models\OrderModel();
        $orderItemModel = new \App\Models\OrderItemModel();
        $userModel = new \App\Models\UserModel();
        $db = \Config\Database::connect();

        // Obtener todas las órdenes
        $orders = $orderModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        foreach ($orders as &$order) {
            $order['user'] = $userModel->find($order['user_id']);

            $order['items'] = $db->table('order_items')
                ->select('order_items.*, products.name AS product_name, sizes.size_label')
                ->join('products', 'products.id = order_items.product_id')
                ->join('sizes', 'sizes.id = order_items.size_id')
                ->where('order_items.order_id', $order['id'])
                ->get()
                ->getResultArray();
        }

        return view('dashboard/orders/all', ['orders' => $orders]);
    }
}
