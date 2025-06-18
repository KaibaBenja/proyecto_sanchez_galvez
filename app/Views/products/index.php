<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Productos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="products">
  <div class="filters">
    <form method="GET" action="">
      <select name="brand">
        <option value="">Todas las marcas</option>
        <?php foreach ($brands as $brand): ?>
          <option value="<?= $brand->id ?>"><?= esc($brand->name) ?></option>
        <?php endforeach; ?>
      </select>
      <select name="size">
        <option value="">Todos los talles</option>
        <?php foreach ($sizes as $size): ?>
          <option value="<?= $size->id ?>"><?= esc($size->size_label) ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit">Filtrar</button>
    </form>
  </div>

  <div class="product-grid">
    <?php foreach ($products as $product): ?>
      <div class="product-card">
      <img src="<?= base_url('public/uploads/' . esc($product['image_url'])) ?>" alt="<?= esc($product['name']) ?>">
        <h3><?= esc($product['name']) ?></h3>
        <p><?= esc($product['brand_name'] ?? 'Sin marca') ?> - Talles: <?= implode(', ', $product['sizes']) ?></p>
        <p>$<?= esc($product['price']) ?></p>
        <a href="<?= base_url('producto/' . $product['id']) ?>" class="btn">Ver más</a>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?= $this->endSection() ?>