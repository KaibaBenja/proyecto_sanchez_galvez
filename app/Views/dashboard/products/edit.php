<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Editar Producto
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="form-section">
  <div class="form-container">
    <h1>Editar Producto</h1>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('/dashboard/products/update/' . $product['id']) ?>" enctype="multipart/form-data">
      <?= csrf_field() ?>

      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="<?= esc($product['name']) ?>" required>
      </div>

      <div class="form-group">
        <label for="price">Precio</label>
        <input type="number" step="0.01" name="price" id="price" value="<?= esc($product['price']) ?>" required>
      </div>

      <div class="form-group">
        <label for="description">Descripción</label>
        <textarea name="description" id="description"><?= esc($product['description']) ?></textarea>
      </div>

      <div class="form-group">
        <label for="brand_id">Marca</label>
        <select name="brand_id" id="brand_id" required>
          <option value="">Seleccionar Marca</option>
          <?php foreach ($brands as $brand): ?>
            <option value="<?= $brand->id ?>" <?= $brand->id == $product['brand_id'] ? 'selected' : '' ?>>
              <?= esc($brand->name) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="category_id">Categoría</label>
        <select name="category_id" id="category_id" required>
          <option value="">Seleccionar Categoría</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category->id ?>" <?= $category->id == $product['category_id'] ? 'selected' : '' ?>>
              <?= esc($category->name) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="image">Imagen (opcional)</label>
        <?php if (!empty($product->image_url)): ?>
          <img src="<?= base_url('public/uploads/' . $product->image_url) ?>" alt="Imagen actual" width="100"><br>
        <?php endif; ?>
        <input type="file" name="image" id="image">
      </div>

      <div class="form-group">
        <label>Talles y Stock</label>
        <?php foreach ($sizes as $size): ?>
          <?php
            $matched = null;
            foreach ($productSizes as $ps) {
              if ($ps->size_id == $size->id) {
                $matched = $ps;
                break;
              }
            }
          ?>
          <div style="margin-bottom: 10px;">
            <label><?= esc($size->size_label) ?></label>
            <input type="hidden" name="sizes[]" value="<?= $size->id ?>">
            <input type="number" name="stocks[]" min="0" value="<?= $matched ? $matched->stock : 0 ?>" style="width: 80px;">
          </div>
        <?php endforeach; ?>
      </div>

      <button type="submit" class="edit-btn">Actualizar</button>
    </form>
  </div>
</section>
<?= $this->endSection() ?>
