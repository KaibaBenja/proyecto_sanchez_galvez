<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>Editar Perfil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="form-section">
  <div class="form-container">
    <h1>Editar Perfil</h1>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('/profile/update') ?>">
      <?= csrf_field() ?>

      <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" value="<?= esc($user['name']) ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" value="<?= esc($user['email']) ?>" required>
      </div>

      <div class="form-group">
        <label for="current_password">Contraseña actual</label>
        <input type="password" name="current_password" id="current_password">
      </div>

      <div class="form-group">
        <label for="new_password">Nueva contraseña</label>
        <input type="password" name="new_password" id="new_password">
      </div>

    <div class="form-group">
    <label for="confirm_password">Confirmar nueva contraseña</label>
    <input type="password" name="confirm_password" id="confirm_password">
    </div>

      <button type="submit" class="btn">Actualizar</button>
    </form>
  </div>
</section>
<?= $this->endSection() ?>
