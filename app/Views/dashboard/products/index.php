<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="dashboard-container">
  <h1 class="dashboard-title">Panel de Administración</h1>

  <?php if (session()->getFlashdata('success')) : ?>
      <div class="alert success-alert">
          <?= session()->getFlashdata('success') ?>
      </div>
  <?php endif; ?>

  <div class="dashboard-actions">
    <a href="<?= site_url('products/create') ?>" class="btn primary-btn">Crear Producto</a>
    <a href="<?= site_url('productos') ?>" class="btn secondary-btn">Ver Productos</a>
  </div>

  <div class="dashboard-section">
    <h2 class="section-title">Listado de Productos</h2>

    <div class="product-grid">
      <?php foreach ($products as $product) : ?>
        <div class="product-card">
          <img src="<?= base_url('public/uploads/' . esc($product['image_url'])) ?>" alt="<?= esc($product['name']) ?>">
          <h3><?= esc($product['name']) ?></h3>
          <p><?= esc($product['price']) ?></p>
          <a href="<?= site_url('products/edit/' . $product['id']) ?>" class="btn secondary-btn">Editar</a>
          <form action="<?= site_url('products/delete/' . $product['id']) ?>" method="post" style="display:inline;">
            <?= csrf_field() ?>
            <button type="submit" class="btn primary-btn" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
