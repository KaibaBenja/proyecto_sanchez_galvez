<?php

namespace App\Controllers;

use App\Models\CartModel;
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

    public function index(){
        $userId = session()->get('user_id');
        $cartItems = $this->cartModel->getUserCart($userId);
        return view('cart/index', ['cartItems' => $cartItems]);
    }

    public function add()
    {
        $userId    = session()->get('user_id');
        $productId = $this->request->getPost('product_id');
        $sizeId    = $this->request->getPost('size_id');
        $quantity  = (int) ($this->request->getPost('quantity') ?? 1);

        if (!$sizeId || !$this->sizeModel->find($sizeId)) {
            return redirect()->back()->with('error', 'Debe seleccionar un talle válido.');
        }

        $existing = $this->cartModel
            ->where(['user_id' => $userId, 'product_id' => $productId, 'size_id' => $sizeId, 'active' => 1])
            ->first();

        if ($existing) {
            $this->cartModel->update($existing['id'], [
                'quantity' => $existing['quantity'] + $quantity
            ]);
        } else {
            $this->cartModel->insert([
                'user_id'    => $userId,
                'product_id' => $productId,
                'size_id'    => $sizeId,
                'quantity'   => $quantity,
                'active'     => 1,
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
}
