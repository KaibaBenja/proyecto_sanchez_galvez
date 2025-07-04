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
        $db = \Config\Database::connect();

        $search = $this->request->getGet('search');
        $dateFrom = $this->request->getGet('date_from');
        $dateTo = $this->request->getGet('date_to');
        $sortBy = $this->request->getGet('sort_by') ?? 'created_at';
        $sortOrder = $this->request->getGet('sort_order') ?? 'DESC';
        
        $sortOrder = strtoupper($sortOrder) === 'ASC' ? 'ASC' : 'DESC';
        
        $allowedSortFields = ['created_at', 'total_price', 'id'];
        $sortBy = in_array($sortBy, $allowedSortFields) ? $sortBy : 'created_at';

        $builder = $db->table('orders')
            ->where('user_id', $userId);

        if (!empty($dateFrom)) {
            $builder->where('orders.created_at >=', $dateFrom . ' 00:00:00');
        }
        if (!empty($dateTo)) {
            $builder->where('orders.created_at <=', $dateTo . ' 23:59:59');
        }

        if (!empty($search)) {
            $builder->like('orders.id', $search);
        }

        $builder->orderBy($sortBy, $sortOrder);

        $orders = $builder->get()->getResultArray();

        if (!empty($search)) {
            $productSearch = $db->table('order_items')
                ->select('DISTINCT order_id')
                ->join('products', 'products.id = order_items.product_id')
                ->where('order_items.order_id IN (SELECT id FROM orders WHERE user_id = ' . $userId . ')')
                ->like('products.name', $search)
                ->get()
                ->getResultArray();
            
            $productOrderIds = array_column($productSearch, 'order_id');
            
            if (!empty($productOrderIds)) {
                $orders = array_filter($orders, function($order) use ($productOrderIds) {
                    return in_array($order['id'], $productOrderIds);
                });
            }
        }

        foreach ($orders as &$order) {
            $items = $orderItemModel
                ->select('order_items.*, products.name AS product_name, sizes.size_label')
                ->join('products', 'products.id = order_items.product_id')
                ->join('sizes', 'sizes.id = order_items.size_id')
                ->where('order_id', $order['id'])
                ->findAll();

            $order['items'] = $items;
        }

        return view('orders/index', [
            'orders' => $orders,
            'search' => $search,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder
        ]);
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

        $search = $this->request->getGet('search');
        $dateFrom = $this->request->getGet('date_from');
        $dateTo = $this->request->getGet('date_to');
        $sortBy = $this->request->getGet('sort_by') ?? 'created_at';
        $sortOrder = $this->request->getGet('sort_order') ?? 'DESC';
        
        $sortOrder = strtoupper($sortOrder) === 'ASC' ? 'ASC' : 'DESC';
        
        $allowedSortFields = ['created_at', 'total_price', 'id'];
        $sortBy = in_array($sortBy, $allowedSortFields) ? $sortBy : 'created_at';

        $builder = $db->table('orders')
            ->select('orders.*, users.name as user_name, users.email as user_email')
            ->join('users', 'users.id = orders.user_id');

        if (!empty($dateFrom)) {
            $builder->where('orders.created_at >=', $dateFrom . ' 00:00:00');
        }
        if (!empty($dateTo)) {
            $builder->where('orders.created_at <=', $dateTo . ' 23:59:59');
        }

        if (!empty($search)) {
            $builder->groupStart()
                ->like('users.name', $search)
                ->orLike('users.email', $search)
                ->orLike('orders.id', $search)
                ->groupEnd();
        }

        $builder->orderBy($sortBy, $sortOrder);

        $orders = $builder->get()->getResultArray();

        if (!empty($search)) {
            $productSearch = $db->table('order_items')
                ->select('DISTINCT order_id')
                ->join('products', 'products.id = order_items.product_id')
                ->like('products.name', $search)
                ->get()
                ->getResultArray();
            
            $productOrderIds = array_column($productSearch, 'order_id');
            
            if (!empty($productOrderIds)) {
                $orders = array_filter($orders, function($order) use ($productOrderIds) {
                    return in_array($order['id'], $productOrderIds);
                });
            }
        }

        foreach ($orders as &$order) {
            $order['user'] = [
                'name' => $order['user_name'],
                'email' => $order['user_email']
            ];

            $order['items'] = $db->table('order_items')
                ->select('order_items.*, products.name AS product_name, sizes.size_label')
                ->join('products', 'products.id = order_items.product_id')
                ->join('sizes', 'sizes.id = order_items.size_id')
                ->where('order_items.order_id', $order['id'])
                ->get()
                ->getResultArray();
        }

        return view('dashboard/orders/all', [
            'orders' => $orders,
            'search' => $search,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder
        ]);
    }

    public function show($orderId)
    {
        $userId = session()->get('user_id');
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para ver tus compras');
        }

        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $userModel = new \App\Models\UserModel();
        $db = \Config\Database::connect();

        $order = $db->table('orders')
            ->select('orders.*, users.name as user_name, users.email as user_email')
            ->join('users', 'users.id = orders.user_id')
            ->where('orders.id', $orderId)
            ->where('orders.user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$order) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Compra no encontrada o no tienes permisos para verla');
        }

        $order['items'] = $db->table('order_items')
            ->select('order_items.*, products.name AS product_name, products.image_url, sizes.size_label')
            ->join('products', 'products.id = order_items.product_id')
            ->join('sizes', 'sizes.id = order_items.size_id')
            ->where('order_items.order_id', $orderId)
            ->get()
            ->getResultArray();

        $subtotal = 0;
        foreach ($order['items'] as $item) {
            $subtotal += $item['quantity'] * $item['price_at_purchase'];
        }

        return view('orders/show', [
            'order' => $order,
            'subtotal' => $subtotal
        ]);
    }
}
