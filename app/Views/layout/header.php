<header class="header">
    <a href="<?= site_url() ?>">
        <figure class="logo">
            <img src="assets/img/logo.png" alt="Logo" class="logo__image">
        </figure>
    </a>
    <nav class="navMobile">
        <ul class="navMobile__menu">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li><a href="<?= site_url('about') ?>">¿Quienes somos?</a></li>
            <li><a href="<?= site_url('contact') ?>">Contacto</a></li>
            <li><a href="<?= site_url('commercial') ?>">Comercialización</a></li>
            <li><a href="<?= site_url('terms') ?>">Términos y Usos</a></li>
            <li><a href="<?= site_url('terms') ?>">Iniciar Sesión</a></li>
        </ul>
        <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><img src="assets/img/menu.png" alt="menu"></button>

    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">SneakersHouse</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body h-100">
            <ul class="navMobile__menu">
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><a href="<?= site_url('about') ?>">¿Quienes somos?</a></li>
                <li><a href="<?= site_url('contact') ?>">Contacto</a></li>
                <li><a href="<?= site_url('commercial') ?>">Comercialización</a></li>
                <li><a href="<?= site_url('terms') ?>">Términos y Usos</a></li>
                <li><a href="<?= site_url('terms') ?>">Iniciar Sesión</a></li>
            </ul>
        </div>
    </div>
</header>