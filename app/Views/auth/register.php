<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Registrarse
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="contacto">
        <div class="contacto-container">
            <div class="contacto-form">
                <h2>Registro de Usuario</h2>
                <form action="<?= base_url('/register-action') ?>" method="POST" class="formulario">
                    <div class="form-group">
                        <label for="nombre">Nombre y Apellido</label>
                        <input type="text" id="nombre" name="nombre" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras y espacios">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" pattern="[0-9+ ()-]*" title="Solo números, espacios, paréntesis, guiones y el signo +">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmar">Confirmar Contraseña</label>
                        <input type="password" id="confirmar" name="confirmar" required>
                    </div>
                    <button type="submit" class="btn-enviar">Registrarse</button>
                    <a href= "<?= site_url('/login') ?>">Iniciar Sesion</a>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>