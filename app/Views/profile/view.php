<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>Mi Perfil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="form-section">
  <div class="form-container">
    <h1>Mi Perfil</h1>

    <p><strong>Nombre:</strong> <?= esc($user['name']) ?></p>
    <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
    <a href="<?= base_url('/profile/edit') ?>" class="btn">Editar Perfil</a>
  </div>
</section>

<style>
    .form-container{
        color: #111;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 20px;
        font-size: 1rem;
        gap: 10px;
        text-align: center;
    }

</style>
<?= $this->endSection() ?>
