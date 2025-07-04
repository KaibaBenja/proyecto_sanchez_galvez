<header class="header" role="banner">
    <a href="<?= site_url() ?>" class="logo">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="SneakersHouse Logo" class="logo__image">
    </a>

    <nav class="navMobile" role="navigation" aria-label="Menú principal">
        <ul class="navMobile__menu">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li><a href="<?= site_url('about') ?>">¿Quiénes somos?</a></li>
            <li><a href="<?= site_url('contact') ?>">Contacto</a></li>
            <li><a href="<?= site_url('commercial') ?>">Comercialización</a></li>
            <li><a href="<?= site_url('terms') ?>">Términos y Usos</a></li>
            <li><a href="<?= site_url('productos') ?>">Productos</a></li>
            <?php if (session()->get('user_role') === 'cliente' || session()->get('user_role') === 'vendedor'): ?>
                <li><a href="<?= site_url('orders') ?>">Historial de compras</a></li>
            <?php endif; ?>

            <?php if (session()->get('user_role') === 'cliente' || session()->get('user_role') === 'vendedor'): ?>
                <li><a href="<?= site_url('cart') ?>"><i class="fas fa-shopping-cart"></i></a></li>
            <?php endif; ?>
            <?php if (session()->get('logged_in')): ?>
                <?php if (session()->get('user_role') === 'admin'): ?>
                    <li><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <?php endif; ?>
                <li class="user-info">
                    <i class="fas fa-user"></i> |
                    <a href="<?= site_url('/profile') ?>">Mi perfil</a> |
                    <a href="<?= site_url('/logout') ?>">Cerrar sesión</a>
                </li>
            <?php else: ?>
                <li><a href="<?= site_url('/login') ?>">Iniciar sesión</a></li>
            <?php endif; ?>
        </ul>

        <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <img src="<?= base_url('assets/img/menu.png') ?>" alt="menu">
        </button>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">SneakersHouse</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body h-100">
            <ul class="navMobile__menu">
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><a href="<?= site_url('about') ?>">¿Quiénes somos?</a></li>
                <li><a href="<?= site_url('contact') ?>">Contacto</a></li>
                <li><a href="<?= site_url('commercial') ?>">Comercialización</a></li>
                <li><a href="<?= site_url('terms') ?>">Términos y Usos</a></li>
                <li><a href="<?= site_url('productos') ?>">Productos</a></li>
                <?php if (session()->get('user_role') === 'cliente' || session()->get('user_role') === 'vendedor'): ?>
                    <li><a href="<?= site_url('orders') ?>">Historial de compras</a></li>
                <?php endif; ?>

                <li><a href="<?= site_url('cart') ?>"><i class="fas fa-shopping-cart"></i>| Carrito</a></li>

                <?php if (session()->get('logged_in')): ?>
                    <?php if (session()->get('user_role') === 'admin'): ?>
                        <li><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                    <?php endif; ?>
                    <li class="user-info">
                        <i class="fas fa-user"></i> |
                        <a href="<?= site_url('/profile') ?>">Mi perfil</a> |
                        <a href="<?= site_url('/logout') ?>">Cerrar sesión</a>
                    </li>
                <?php else: ?>
                    <li><a href="<?= site_url('/login') ?>">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>