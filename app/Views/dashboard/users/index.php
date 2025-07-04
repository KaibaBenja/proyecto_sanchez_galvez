<?= $this->extend('layout/layout') ?>
<?= $this->section('title') ?>Usuarios<?= $this->endSection() ?>
<?= $this->section('content') ?>

<section class="cart-section">
  <div class="cart-container">
    <h1 class="cart-title">Gestión de Usuarios</h1>

    <?php if (session()->getFlashdata('success')): ?>
      <p style="color: green"><?= session()->getFlashdata('success') ?></p>
    <?php elseif (session()->getFlashdata('error')): ?>
      <p style="color: red"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <table class="cart-table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= esc($user['name']) ?></td>
            <td><?= esc($user['email']) ?></td>
            <td>
              <form method="post" action="<?= base_url('dashboard/users/update-role/' . $user['id']) ?>">
                <?= csrf_field() ?>
                <select name="role" onchange="this.form.submit()" <?= $currentUserId == $user['id'] ? 'disabled' : '' ?>>
                  <option value="cliente" <?= $user['role'] === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                  <option value="vendedor" <?= $user['role'] === 'vendedor' ? 'selected' : '' ?>>Vendedor</option>
                  <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
              </form>
            </td>
            <td>
              <?php if ($currentUserId != $user['id']): ?>
                <form method="post" action="<?= base_url('dashboard/users/delete/' . $user['id']) ?>" onsubmit="return confirm('¿Eliminar este usuario?');">
                  <?= csrf_field() ?>
                  <button class="remove-btn" type="submit">Eliminar</button>
                </form>
              <?php else: ?>
                <em>No se puede eliminar</em>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<style>
  .remove-btn{
    background-color: #ff0000;
    color: #fff;
    border: none;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
  }
</style>

<?= $this->endSection() ?>
