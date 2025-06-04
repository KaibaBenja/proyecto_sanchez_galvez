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

    private function authorize()
    {
        $role = session()->get('user_role');
        return in_array($role, ['admin', 'vendedor']);
    }

    public function index()
    {
        // Mismo que antes, con filtros por brand/category/size
        $brandId    = $this->request->getGet('brand_id');
        $categoryId = $this->request->getGet('category_id');
        $sizeId     = $this->request->getGet('size_id');

        $query = $this->productModel
            ->select('products.*, brands.name as brand_name, categories.name as category_name')
            ->join('brands', 'brands.id = products.brand_id')
            ->join('categories', 'categories.id = products.category_id');

        if ($brandId)    $query->where('products.brand_id', $brandId);
        if ($categoryId) $query->where('products.category_id', $categoryId);
        if ($sizeId) {
            $query->join('product_sizes', 'product_sizes.product_id = products.id')
                  ->where('product_sizes.size_id', $sizeId);
        }

        $data['products']   = $query->findAll();
        $data['brands']     = $this->brandModel->findAll();
        $data['categories'] = $this->categoryModel->findAll();
        $data['sizes']      = $this->sizeModel->findAll();

        return view('products/index', $data);
    }

    public function create()
    {
        if (! $this->authorize()) {
            return redirect()->to('/login');
        }

        $data['brands']     = $this->brandModel->findAll();
        $data['categories'] = $this->categoryModel->findAll();
        $data['sizes']      = $this->sizeModel->findAll();

        return view('products/create', $data);
    }

    public function store()
    {
        if (! $this->authorize()) {
            return redirect()->to('/login');
        }

        // 1) Procesar subida de imagen:
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && ! $image->hasMoved()) {
            $newName = $image->getRandomName();
            // Mueve la imagen a public/uploads
            $image->move(WRITEPATH . '../public/uploads', $newName);
            $imagePath = '/uploads/' . $newName;
        } else {
            // Si no subió imagen o hubo error, se puede setear valor vacío.
            $imagePath = '';
        }

        // 2) Guardar producto
        $this->productModel->save([
            'name'         => $this->request->getPost('name'),
            'description'  => $this->request->getPost('description'),
            'brand_id'     => $this->request->getPost('brand_id'),
            'category_id'  => $this->request->getPost('category_id'),
            'price'        => $this->request->getPost('price'),
            'image_url'    => $imagePath
        ]);

        // 3) Obtener el ID recién insertado
        $productId = $this->productModel->getInsertID();

        // 4) Guardar tallas y stock en product_sizes
        //    Esperamos que el form envíe, por cada talla, un campo stock[#size_id#]
        $sizesAll = $this->sizeModel->findAll();
        foreach ($sizesAll as $s) {
            $stockInputName = 'stock_' . $s->id;
            $stockValue = (int) $this->request->getPost($stockInputName);

            if ($stockValue > 0) {
                $this->productSizeModel->save([
                    'product_id' => $productId,
                    'size_id'    => $s->id,
                    'stock'      => $stockValue
                ]);
            }
        }

        return redirect()->to('/products');
    }

    public function edit($id)
    {
        if (! $this->authorize()) {
            return redirect()->to('/login');
        }

        $data['product']    = $this->productModel->find($id);
        $data['brands']     = $this->brandModel->findAll();
        $data['categories'] = $this->categoryModel->findAll();
        $data['sizes']      = $this->sizeModel->findAll();

        // Traer los registros de product_sizes actuales para este producto
        $currentSizes = $this->productSizeModel
            ->where('product_id', $id)
            ->findAll();
        // Para facilitar la vista, armamos un array [size_id => stock]
        $data['productSizesStock'] = [];
        foreach ($currentSizes as $ps) {
            $data['productSizesStock'][$ps->size_id] = $ps->stock;
        }

        return view('products/edit', $data);
    }

    public function update($id)
    {
        if (! $this->authorize()) {
            return redirect()->to('/login');
        }

        // 1) Si subió imagen nueva, procesarla; sino, dejar la ruta anterior
        $product = $this->productModel->find($id);
        $image    = $this->request->getFile('image');
        if ($image && $image->isValid() && ! $image->hasMoved()) {
            // Borrar imagen anterior si querés
            if (! empty($product->image_url) && file_exists(WRITEPATH . '../public' . $product->image_url)) {
                @unlink(WRITEPATH . '../public' . $product->image_url);
            }

            $newName = $image->getRandomName();
            $image->move(WRITEPATH . '../public/uploads', $newName);
            $imagePath = '/uploads/' . $newName;
        } else {
            $imagePath = $product->image_url;
        }

        // 2) Actualizar datos del producto
        $this->productModel->update($id, [
            'name'         => $this->request->getPost('name'),
            'description'  => $this->request->getPost('description'),
            'brand_id'     => $this->request->getPost('brand_id'),
            'category_id'  => $this->request->getPost('category_id'),
            'price'        => $this->request->getPost('price'),
            'image_url'    => $imagePath
        ]);

        // 3) Eliminar todos los registros de product_sizes para este producto
        $this->productSizeModel->where('product_id', $id)->delete();

        // 4) Volver a insertar según los valores del formulario
        $sizesAll = $this->sizeModel->findAll();
        foreach ($sizesAll as $s) {
            $stockInputName = 'stock_' . $s->id;
            $stockValue = (int) $this->request->getPost($stockInputName);

            if ($stockValue > 0) {
                $this->productSizeModel->save([
                    'product_id' => $id,
                    'size_id'    => $s->id,
                    'stock'      => $stockValue
                ]);
            }
        }

        return redirect()->to('/products');
    }

    public function delete($id)
    {
        if (! $this->authorize()) {
            return redirect()->to('/login');
        }

        // Eliminar producto (y se borrarán en cascada sus product_sizes)
        $this->productModel->delete($id);
        return redirect()->to('/products');
    }
}
