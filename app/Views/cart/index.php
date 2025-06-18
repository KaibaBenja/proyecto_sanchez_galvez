<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Carrito de Compras
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <h1>Carrito de Compras</h1>

  <?php if (!empty($cartItems)): ?>
    
      <table border="1" cellpadding="10" cellspacing="0">
          <thead>
              <tr>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Total</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($cartItems as $item): ?>
                  <tr>
                      <td><?= esc($item['product_name']) ?> (<?= esc($item['size_label']) ?>)</td>
                      <td>$<?= esc($item['price']) ?></td>
                      <td><?= esc($item['quantity']) ?></td>
                      <td>$<?= esc($item['price'] * $item['quantity']) ?></td>
                      <td>
                          <form method="post" action="<?= base_url('/cart/remove/' . $item['id']) ?>">
                              <button type="submit">Eliminar</button>
                          </form>
                      </td>
                  </tr>
              <?php endforeach; ?>
          </tbody>
      </table>
  <?php else: ?>
      <p>Tu carrito está vacío.</p>
  <?php endif; ?>
<?= $this->endSection() ?>
