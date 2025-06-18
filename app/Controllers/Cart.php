<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProductSizeModel;
use App\Models\SizeModel;

class Cart extends BaseController
{
    protected $cartModel;
    protected $sizeModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->sizeModel = new SizeModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        $cartItems = $this->cartModel
            ->select('cart.*, products.name, products.price, products.image_url, sizes.size_label')
            ->join('products', 'products.id = cart.product_id')
            ->join('sizes', 'sizes.id = cart.size_id')
            ->where('cart.user_id', $userId)
            ->where('cart.active', 1)
            ->findAll();

        return view('cart/index', [
            'cartItems' => $cartItems
        ]);
    }

    public function add()
    {
        $userId    = session()->get('user_id');
        $productId = $this->request->getPost('product_id');
        $sizeId    = $this->request->getPost('size_id');
        $quantity  = (int) $this->request->getPost('quantity') ?? 1;

        $existing = $this->cartModel
            ->where([
                'user_id'    => $userId,
                'product_id' => $productId,
                'size_id'    => $sizeId
            ])
            ->first();

        if ($existing) {
            if ($existing['active']) {
                $this->cartModel->update($existing['id'], [
                    'quantity' => $existing['quantity'] + $quantity
                ]);
            } else {
                $this->cartModel->update($existing['id'], [
                    'quantity' => $quantity,
                    'active'   => 1
                ]);
            }
        } else {
            $this->cartModel->insert([
                'user_id'    => $userId,
                'product_id' => $productId,
                'size_id'    => $sizeId,
                'quantity'   => $quantity,
                'active'     => 1
            ]);
        }

        return redirect()->to('/cart')->with('success', 'Producto agregado al carrito.');
    }

    public function update()
    {
        $userId   = session()->get('user_id');
        $cartId   = $this->request->getPost('cart_id');
        $quantity = (int) $this->request->getPost('quantity');

        $item = $this->cartModel->find($cartId);

        if ($item && $item['user_id'] == $userId && $item['active']) {
            $this->cartModel->update($cartId, ['quantity' => $quantity]);
        }

        return redirect()->to('/cart')->with('success', 'Cantidad actualizada.');
    }

    public function remove($id)
    {
        $userId = session()->get('user_id');
        $item = $this->cartModel->find($id);

        if ($item && $item['user_id'] == $userId && $item['active']) {
            $this->cartModel->update($id, ['active' => 0]);
        }

        return redirect()->to('/cart')->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        $userId = session()->get('user_id');

        $this->cartModel
            ->where('user_id', $userId)
            ->where('active', 1)
            ->set(['active' => 0])
            ->update();

        return redirect()->to('/cart')->with('success', 'Carrito vaciado.');
    }

    public function checkout()
    {
        $userId = session()->get('user_id');

        $cartItems = $this->cartModel
            ->select('cart.*, products.price')
            ->join('products', 'products.id = cart.product_id')
            ->where('cart.user_id', $userId)
            ->where('cart.active', 1)
            ->findAll();

        if (empty($cartItems)) {
            return redirect()->to('/cart')->with('error', 'Tu carrito está vacío.');
        }

        $productSizeModel = new ProductSizeModel();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $total = 0;

        foreach ($cartItems as $item) {
            $stockRecord = $productSizeModel
                ->where('product_id', $item['product_id'])
                ->where('size_id', $item['size_id'])
                ->first();

            if (!$stockRecord || $stockRecord->stock < $item['quantity']) {
                return redirect()->to('/cart')->with('error', 'Stock insuficiente para un producto.');
            }

            $total += $item['quantity'] * $item['price'];
        }

        $orderId = $orderModel->insert([
            'user_id'     => $userId,
            'total_price' => $total
        ]);

        foreach ($cartItems as $item) {
            $stockRecord = $productSizeModel
                ->where('product_id', $item['product_id'])
                ->where('size_id', $item['size_id'])
                ->first();

            $productSizeModel->update($stockRecord->id, [
                'stock' => $stockRecord->stock - $item['quantity']
            ]);

            $orderItemModel->insert([
                'order_id'          => $orderId,
                'product_id'        => $item['product_id'],
                'size_id'           => $item['size_id'],
                'quantity'          => $item['quantity'],
                'price_at_purchase' => $item['price'],
            ]);
        }

        $this->cartModel
            ->where('user_id', $userId)
            ->where('active', 1)
            ->set(['active' => 0])
            ->update();

        return redirect()->to('/orders')->with('success', '¡Compra realizada con éxito!');
    }
}
