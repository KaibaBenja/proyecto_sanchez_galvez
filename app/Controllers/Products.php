<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\SizeModel;
use App\Models\ProductSizeModel;

class Products extends BaseController
{
    protected $productModel;
    protected $brandModel;
    protected $categoryModel;
    protected $sizeModel;
    protected $productSizeModel;

    public function __construct()
    {
        helper(['auth']);
        $this->productModel      = new ProductModel();
        $this->brandModel        = new BrandModel();
        $this->categoryModel     = new CategoryModel();
        $this->sizeModel         = new SizeModel();
        $this->productSizeModel  = new ProductSizeModel();
    }

    public function createProducts(){
        return view('products/create');
    }

    private function authorize()
    {
        $role = session()->get('user_role');
        return in_array($role, ['admin', 'vendedor']);
    }

    public function store()
{
    if (! $this->authorize()) {
            return redirect()->to('/login');
        }

    $productModel = new \App\Models\ProductModel();
    $brandModel = new \App\Models\BrandModel();
    $categoryModel = new \App\Models\CategoryModel();
    $sizeModel = new \App\Models\SizeModel();
    $productSizeModel = new \App\Models\ProductSizeModel();

    $brandInput = $this->request->getPost('brand');
    $categoryInput = $this->request->getPost('category');
    $sizesInput = $this->request->getPost('sizes'); 

    if (is_numeric($brandInput)) {
        $brandId = $brandInput;
    } else {
        $brand = $brandModel->where('name', $brandInput)->first();
        if (!$brand) {
            $brandId = $brandModel->insert(['name' => $brandInput], true);
        } else {
            $brandId = $brand['id'];
        }
    }

    if (is_numeric($categoryInput)) {
        $categoryId = $categoryInput;
    } else {
        $category = $categoryModel->where('name', $categoryInput)->first();
        if (!$category) {
            $categoryId = $categoryModel->insert(['name' => $categoryInput], true);
        } else {
            $categoryId = $category['id'];
        }
    }

    $productId = $productModel->insert([
        'name' => $this->request->getPost('name'),
        'brand_id' => $brandId,
        'category_id' => $categoryId,
        'price' => $this->request->getPost('price'),
        'description' => $this->request->getPost('description'),
        'image_url' => $this->request->getPost('image_url')
    ], true);

    foreach ($sizesInput as $sizeEntry) {
        $label = $sizeEntry['label'];
        $stock = $sizeEntry['stock'];

        $size = $sizeModel->where('size_label', $label)->first();
        if (!$size) {
            $sizeId = $sizeModel->insert(['size_label' => $label], true);
        } else {
            $sizeId = $size['id'];
        }

        $productSizeModel->save([
            'product_id' => $productId,
            'size_id' => $sizeId,
            'stock' => $stock
        ]);
    }

    return redirect()->to('/products')->with('success', 'Producto creado correctamente');
}


    
  
}
