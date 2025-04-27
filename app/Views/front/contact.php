<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Contacto
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="contacto">
    <div class="contacto-container">
        <div class="contacto-text">
            <h1>Contacto</h1>
            <p>Estamos a tu disposición para responder todas tus consultas. A continuación te compartimos nuestros datos de contacto, y un formulario para que nos envíes tu mensaje directamente.</p>

            <h2>Información de Contacto</h2>
            <ul>
                <li><strong>Nombre del titular:</strong> Benjamin Sanchez Morales</li>
                <li><strong>Razón social:</strong> SneakersHouse</li>
                <li><strong>Domicilio legal:</strong>  Junin 1924, Corrientes, Argentina</li>
                <li><strong>Teléfono:</strong>+54 379 420 1234</li>
                <li><strong>Email:</strong> info@sneakersHouse.com</li>
                <li><strong>Redes sociales:</strong> 
                    <ul>
                        <li>Instagram: @sneakersHouse</li>
                        <li>Facebook: /sneakersHouse</li>
                        <li>LinkedIn: /sneakersHouse</li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="contacto-form">
            <h2>Formulario de Contacto</h2>
            <form action="<?= base_url('contacto/enviar') ?>" method="POST" class="formulario">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono">
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn-enviar">Enviar Mensaje</button>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
