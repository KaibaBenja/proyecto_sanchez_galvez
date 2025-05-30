<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Iniciar Sesion
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="contacto">
        <div class="contacto-container">
            <div class="contacto-form">
                <h2>Iniciar Sesión</h2>
                <form action="<?= base_url('/login-action') ?>" method="POST" class="formulario">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn-enviar">Ingresar</button>
                    <a href= "<?= site_url('/register') ?>">Registrarse</a>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>