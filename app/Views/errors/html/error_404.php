<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Ups! Pagina no encontrada
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<main style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background-image: radial-gradient(#fff8, #fff);; color: white; padding: 100px 20px 20px 20px; text-align: center;">
  <div>
    <h1 style="font-size: 8rem; font-family: 'League Gothic', sans-serif; margin-bottom: 20px;">404</h1>
    <p style="font-size: 1.5rem; margin-bottom: 30px;">Oops, la página que estás buscando no existe.</p>
    <div class="d-flex justify-content-center">
      <a href="<?= base_url('/') ?>" class="btn btn-light" style="padding: 10px 30px; font-weight: bold;">Volver al inicio</a>
    </div>
  </div>
</main>
<?= $this->endSection() ?>