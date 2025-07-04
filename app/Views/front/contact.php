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
            <form action="<?= base_url('contact/enviar') ?>" method="POST" class="formulario" onsubmit="return validarFormulario()">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" id="nombre" name="nombre"  pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras y espacios">
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" >
                </div>
                <div class="form-group">
                    <label for="tel">Teléfono</label>
                    <input type="number" id="tel" name="tel" pattern="[0-9+ ()-]*" title="Solo números, espacios, paréntesis, guiones y el signo +">
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="5" ></textarea>
                </div>
                <button type="submit" class="btn-enviar">Enviar Mensaje</button>
                <button type="reset" class="btn-limpiar">Limpiar</button>
            </form>
        </div>
        
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <script>
            alert("<?= esc(session()->getFlashdata('success')) ?>");
            window.location.href = "<?= base_url('/contact') ?>";
        </script>
    <?php endif; ?>

    <script>
        function validarFormulario() {
            const nombre = document.getElementById('nombre').value.trim();
            const email = document.getElementById('email').value.trim();
            const tel = document.getElementById('tel').value.trim();
            const mensaje = document.getElementById('mensaje').value.trim();

            const regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/;
            const regexTelefono = /^[0-9+ ()-]*$/;

            if (!regexNombre.test(nombre)) {
                alert("El nombre solo debe contener letras y espacios.");
                return false;
            }

            if (!email.includes('@') || !email.includes('.')) {
                alert("Por favor ingresa un correo electrónico válido.");
                return false;
            }

            if (tel && !regexTelefono.test(tel)) {
                alert("El teléfono contiene caracteres no válidos.");
                return false;
            }

            if (mensaje.length < 5) {
                alert("El mensaje debe contener al menos 5 caracteres.");
                return false;
            }

            return true;
        }
    </script>
</section>
<?= $this->endSection() ?>
