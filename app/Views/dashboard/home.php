<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Panel de Administración
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="cart-section">
  <div class="cart-container">
    <h1 class="cart-title">Panel de Control</h1>

    <div class="dashboard-links">
      <ul>
        <li><a href="<?= base_url('dashboard/products') ?>">📦 Gestión de Productos</a></li>
        <li><a href="<?= base_url('dashboard/products/create') ?>">➕ Crear Producto</a></li>
        <li><a href="<?= base_url('orders/all') ?>">🧾 Ver Todas las Compras</a></li>
        <li><a href="<?= base_url('consultas') ?>">📩 Ver Consultas</a></li>
        <li><a href="<?= base_url('dashboard/users') ?>">👥 Gestión de Usuarios</a></li>
        <li><a href="<?= base_url('/') ?>">🏠 Ir al Sitio Principal</a></li>
        <li><a href="<?= base_url('logout') ?>">🚪 Cerrar Sesión</a></li>
      </ul>
    </div>
  </div>
</section>

<style>
  .dashboard-links ul {
    list-style: none;
    padding: 0;
    margin-top: 40px;
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  }

  .dashboard-links a {
    display: block;
    background: #f9f9f9;
    border-radius: 12px;
    padding: 18px;
    font-family: Karla, sans-serif;
    font-size: 1.1em;
    text-align: center;
    text-decoration: none;
    color: #232442;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: background 0.3s ease;
  }

  .dashboard-links a:hover {
    background: #e3f2fd;
  }
</style>
<?= $this->endSection() ?>
