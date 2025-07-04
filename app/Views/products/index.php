<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Productos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="products">
  <div class="search-section">
    <h2>Buscar Zapatillas</h2>
    <div class="search-container">
      <form method="GET" action="" class="search-form">
        <div class="search-input-group">
          <input type="text" name="search" placeholder="Buscar por nombre de zapatilla..." value="<?= esc($search ?? '') ?>" class="search-input">
          <button type="submit" class="search-btn">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="filters">
    <form method="GET" action="">
      <input type="hidden" name="search" value="<?= esc($search ?? '') ?>">
      <select name="brand">
        <option value="">Todas las marcas</option>
        <?php foreach ($brands as $brand): ?>
          <option value="<?= $brand->id ?>" <?= ($selectedBrand == $brand->id) ? 'selected' : '' ?>><?= esc($brand->name) ?></option>
        <?php endforeach; ?>
      </select>
      <select name="size">
        <option value="">Todos los talles</option>
        <?php foreach ($sizes as $size): ?>
          <option value="<?= $size->id ?>" <?= ($selectedSize == $size->id) ? 'selected' : '' ?>><?= esc($size->size_label) ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit">Filtrar</button>
      <?php if (!empty($search) || !empty($selectedBrand) || !empty($selectedSize)): ?>
        <a href="<?= site_url('productos') ?>" class="clear-filters">Limpiar filtros</a>
      <?php endif; ?>
    </form>
  </div>

  <?php if (!empty($search) || !empty($selectedBrand) || !empty($selectedSize)): ?>
    <div class="results-info">
      <p>Se encontraron <strong><?= count($products) ?></strong> producto<?= count($products) != 1 ? 's' : '' ?>
        <?php if (!empty($search)): ?>
          para "<strong><?= esc($search) ?></strong>"
        <?php endif; ?>
      </p>
    </div>
  <?php endif; ?>

  <div class="product-grid">
    <?php if (empty($products)): ?>
      <div class="no-products">
        <i class="fas fa-search" style="font-size: 3em; color: #999; margin-bottom: 20px;"></i>
        <h3>No se encontraron productos</h3>
        <p>Intenta con otros términos de búsqueda o ajusta los filtros.</p>
        <a href="<?= site_url('productos') ?>" class="btn">Ver todos los productos</a>
      </div>
    <?php else: ?>
      <?php foreach ($products as $product): ?>
        <div class="product-card">
        <img src="<?= base_url('public/uploads/' . esc($product['image_url'])) ?>" alt="<?= esc($product['name']) ?>">
          <h3><?= esc($product['name']) ?></h3>
          <p><?= esc($product['brand_name'] ?? 'Sin marca') ?> - Talles: <?= implode(', ', $product['sizes']) ?></p>
          <p>$<?= esc($product['price']) ?></p>
          <a href="<?= base_url('producto/' . $product['id']) ?>" class="btn">Ver más</a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<?= $this->endSection() ?>