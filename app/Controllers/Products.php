<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\SizeModel;
use App\Models\ProductSizeModel;

class Products extends BaseController
{
    public function create()
    {
        // Validar acceso solo a admin o vendedor
        if (!session()->get('logged_in') || !in_array(session()->get('user_role'), ['admin', 'vendedor'])) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        $brandModel = new BrandModel();
        $categoryModel = new CategoryModel();
        $sizeModel = new SizeModel();

        $data = [
            'brands'     => $brandModel->findAll(),
            'categories' => $categoryModel->findAll(),
            'sizes'      => $sizeModel->findAll(),
        ];

        return view('dashboard/products/create', $data);
    }

    public function store()
    {
        // Validar acceso solo a admin o vendedor
        if (!session()->get('logged_in') || !in_array(session()->get('user_role'), ['admin', 'vendedor'])) {
            return redirect()->to('/login')->with('error', 'Acceso no autorizado');
        }

        helper(['form', 'url']);

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'        => 'required|min_length[2]',
            'price'       => 'required|numeric',
            'description' => 'permit_empty|string',
            'image'       => 'uploaded[image]|is_image[image]|max_size[image,2048]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $productModel     = new ProductModel();
        $brandModel       = new BrandModel();
        $categoryModel    = new CategoryModel();
        $sizeModel        = new SizeModel();
        $productSizeModel = new ProductSizeModel();

        $request = $this->request->getPost();

        // Crear marca si se ingresó nueva
        if (empty($request['brand_id']) && !empty($request['new_brand'])) {
            $brandModel->insert(['name' => $request['new_brand']]);
            $request['brand_id'] = $brandModel->getInsertID();
        }

        // Crear categoría si se ingresó nueva
        if (empty($request['category_id']) && !empty($request['new_category'])) {
            $categoryModel->insert(['name' => $request['new_category']]);
            $request['category_id'] = $categoryModel->getInsertID();
        }

        // Subida de imagen
        $imageFile = $this->request->getFile('image');
        $imageName = '';

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move(ROOTPATH . 'public/uploads/', $imageName);
        }

        // Insertar producto
        $productId = $productModel->insert([
            'name'        => $request['name'],
            'price'       => $request['price'],
            'description' => $request['description'],
            'brand_id'    => $request['brand_id'],
            'category_id' => $request['category_id'],
            'image_url'   => $imageName,
        ]);

        // Guardar talles y stock
        $sizes      = $this->request->getPost('sizes');
        $newSizes   = $this->request->getPost('new_sizes');
        $stocks     = $this->request->getPost('stocks');

        if ($sizes && $stocks && count($sizes) === count($stocks)) {
            foreach ($sizes as $index => $sizeId) {
                $stock = $stocks[$index];
                $newSizeLabel = trim($newSizes[$index]);

                if ($sizeId === '__new__' && $newSizeLabel !== '') {
                    $sizeModel->insert(['size_label' => $newSizeLabel]);
                    $sizeId = $sizeModel->getInsertID();
                }

                if (!empty($sizeId) && is_numeric($sizeId) && is_numeric($stock)) {
                    $productSizeModel->insert([
                        'product_id' => $productId,
                        'size_id'    => $sizeId,
                        'stock'      => $stock,
                    ]);
                }
            }
        }

        return redirect()->to('/')->with('success', 'Producto creado correctamente');
    }
}
