<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
About
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="about-us">
    <div class="about-container">
        <div class="about-text">
            <h1>Sobre Nosotros</h1>
            <p><strong>Nuestra misión</strong> es conectar a las personas con el par de sneakers perfecto, combinando estilo, comodidad y exclusividad en cada paso.</p>
            <p><strong>Visión</strong>: Ser referentes en la cultura sneaker a nivel nacional, creando una comunidad que comparta la pasión por la moda urbana y el deporte.</p>
            <p><strong>Desde 2019</strong>, en SneakersHouse hemos trabajado para acercar los modelos más icónicos y exclusivos a nuestros clientes. Lo que comenzó como un pequeño proyecto entre amigos fanáticos de las zapatillas, hoy se ha transformado en una tienda reconocida por su autenticidad, atención personalizada y amor por los sneakers.</p>
        </div>
        <div class="about-image">
            <img src="assets/img/logo.png" alt="Sneakers Story">
        </div>
    </div>
</section>

<section class="staff">
    <div class="staff-container">
        <h2>Nuestro Equipo</h2>
        <div class="staff-grid">
            <div class="staff-member">
                <img src="assets/img/benja.jpg" alt="Fundador">
                <h3>Benjamin Sanchez Morales</h3>
                <p>Fundador & CEO</p>
            </div>
            <div class="staff-member">
                <img src="assets/img/juan.png" alt="Marketing Manager">
                <h3>Juan Pablo Ramirez</h3>
                <p>Marketing</p>
            </div>
            <div class="staff-member">
                <img src="assets/img/mateo.jpg" alt="Ventas">
                <h3>Mateo Galvez</h3>
                <p>Co-Founder & Ventas</p>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
