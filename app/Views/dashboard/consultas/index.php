<?php
  $currentSort = $sort ?? 'created_at';
  $currentDir = $direction ?? 'desc';

  function sortUrl($field, $currentSort, $currentDir, $search) {
    $dir = ($field === $currentSort && $currentDir === 'asc') ? 'desc' : 'asc';
    
    return base_url('/admin/consultas?sort=' . $field . '&direction=' . $dir . '&search=' . urlencode($search));
}

function sortArrow($field, $currentSort, $currentDir) {
    if ($field !== $currentSort) return '⇅';
    return $currentDir === 'asc' ? '↑' : '↓';
}
?>

<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Consultas Recibidas
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="cart-section">
  <div class="cart-container">
    <h1 class="cart-title">Consultas Recibidas</h1>

    <form method="get" class="filter-form" style="margin-bottom: 30px; display: flex; gap: 10px; flex-wrap: wrap;">
      <input type="text" name="search" placeholder="Buscar por nombre, email, teléfono o mensaje" value="<?= esc($search) ?>" style="padding: 10px; flex: 1; min-width: 200px; border-radius: 8px; border: 1px solid #ccc;">
      <button type="submit" style="padding: 10px 20px; border: none; background-color: #232442; color: #fff; border-radius: 8px; cursor: pointer;">Buscar</button>
    </form>

    <?php if (empty($consultas)): ?>
      <p class="cart-empty">No se encontraron consultas.</p>
    <?php else: ?>
      <table class="cart-table">
        <thead>
          <tr>
            <th>
            <a href="<?= sortUrl('nombre', $currentSort, $currentDir, $search) ?>">
                Nombre <?= sortArrow('nombre', $currentSort, $currentDir) ?>
            </a>
            </th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Mensaje</th>
            <th>
            <a href="<?= sortUrl('created_at', $currentSort, $currentDir, $search) ?>">
                Fecha <?= sortArrow('created_at', $currentSort, $currentDir) ?>
            </a>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($consultas as $consulta): ?>
            <tr class="cart-item-desktop">
              <td><?= esc($consulta['nombre']) ?></td>
              <td><?= esc($consulta['email']) ?></td>
              <td><?= esc($consulta['tel']) ?></td>
              <td><?= esc($consulta['mensaje']) ?></td>
              <td><?= date('d/m/Y H:i', strtotime($consulta['created_at'])) ?></td>
            </tr>
            
            <tr class="cart-item-mobile">
              <td data-label="Nombre"><?= esc($consulta['nombre']) ?></td>
              <td data-label="Email"><?= esc($consulta['email']) ?></td>
              <td data-label="Teléfono"><?= esc($consulta['tel']) ?></td>
              <td data-label="Mensaje"><?= esc($consulta['mensaje']) ?></td>
              <td data-label="Fecha"><?= date('d/m/Y H:i', strtotime($consulta['created_at'])) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</section>
<?= $this->endSection() ?>
