<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('components/hero') ?>

<section class="features py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-box p-3">
                    <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                    <h5>Envío Gratis</h5>
                    <p class="mb-0">En pedidos superiores a $150.000</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box p-3">
                    <i class="fas fa-undo fa-3x mb-3 text-primary"></i>
                    <h5>Devolución Gratuita</h5>
                    <p class="mb-0">30 días para devoluciones</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box p-3">
                    <i class="fas fa-lock fa-3x mb-3 text-primary"></i>
                    <h5>Pago Seguro</h5>
                    <p class="mb-0">100% protección de compra</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured-products py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Productos Destacados</h2>
            <p>Descubre nuestras zapatillas más populares</p>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="product-card">
                    <div class="product-badge bg-danger">-20%</div>
                    <div class="product-thumb">
                        <img src="https://nikearprod.vtexassets.com/arquivos/ids/785924-1600-1600?width=1600&height=1600&aspect=true" alt="Sneaker 1" class="img-fluid">
                        <div class="product-action">
                            <a href="#" class="btn-wishlist" data-bs-toggle="tooltip" title="Añadir a favoritos"><i class="far fa-heart"></i></a>
                            <a href="#" class="btn-quickview" data-bs-toggle="tooltip" title="Vista rápida"><i class="fas fa-eye"></i></a>
                        </div>
                    </div>
                    <div class="product-info p-3">
                        <h5 class="product-title">Air Max 90</h5>
                        <div class="product-brand">Nike</div>
                        <div class="product-price">
                            <span class="old-price">$249,999</span>
                            <span class="current-price">$199,999</span>
                        </div>
                        <button class="btn btn-primary btn-sm w-100 mt-2">Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="product-card">
                    <div class="product-badge bg-success">Nuevo</div>
                    <div class="product-thumb">
                        <img src="https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/ff67e3405f7f46eca232d3aa4e0b78e9_9366/Zapatillas_Ultraboost_5_Blanco_ID8810_HM1.jpg" alt="Sneaker 2" class="img-fluid">
                        <div class="product-action">
                            <a href="#" class="btn-wishlist" data-bs-toggle="tooltip" title="Añadir a favoritos"><i class="far fa-heart"></i></a>
                            <a href="#" class="btn-quickview" data-bs-toggle="tooltip" title="Vista rápida"><i class="fas fa-eye"></i></a>
                        </div>
                    </div>
                    <div class="product-info p-3">
                        <h5 class="product-title">Ultraboost 5.0</h5>
                        <div class="product-brand">Adidas</div>
                        <div class="product-price">
                            <span class="current-price">$249,999</span>
                        </div>
                        <button class="btn btn-primary btn-sm w-100 mt-2">Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="product-card">
                    <div class="product-thumb">
                        <img src="https://sporting.vtexassets.com/arquivos/ids/1467346/ID1593H-000-1.jpg?v=638640995383270000" alt="Sneaker 3" class="img-fluid">
                        <div class="product-action">
                            <a href="#" class="btn-wishlist" data-bs-toggle="tooltip" title="Añadir a favoritos"><i class="far fa-heart"></i></a>
                            <a href="#" class="btn-quickview" data-bs-toggle="tooltip" title="Vista rápida"><i class="fas fa-eye"></i></a>
                        </div>
                    </div>
                    <div class="product-info p-3">
                        <h5 class="product-title">Classic Leather</h5>
                        <div class="product-brand">Reebok</div>
                        <div class="product-price">
                            <span class="current-price">$98,999</span>
                        </div>
                        <button class="btn btn-primary btn-sm w-100 mt-2">Añadir al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="product-card">
                    <div class="product-badge bg-warning">Último</div>
                    <div class="product-thumb">
                        <img src="https://images.puma.net/images/388981/01/sv01/fnd/ARG/w/2000/h/2000/" alt="Sneaker 4" class="img-fluid">
                        <div class="product-action">
                            <a href="#" class="btn-wishlist" data-bs-toggle="tooltip" title="Añadir a favoritos"><i class="far fa-heart"></i></a>
                            <a href="#" class="btn-quickview" data-bs-toggle="tooltip" title="Vista rápida"><i class="fas fa-eye"></i></a>
                        </div>
                    </div>
                    <div class="product-info p-3">
                        <h5 class="product-title">Suede Classic</h5>
                        <div class="product-brand">Puma</div>
                        <div class="product-price">
                            <span class="current-price">$125,999</span>
                        </div>
                        <button class="btn btn-primary btn-sm w-100 mt-2">Añadir al carrito</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-dark">Ver todos los productos</a>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="categories py-5 bg-light">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Categorías Populares</h2>
            <p>Explora nuestras colecciones por categoría</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="category-card position-relative">
                    <img src="https://assets.adidas.com/images/w_383,h_383,f_auto,q_auto,fl_lossy,c_fill,g_auto/7bd806571cd44c33ab16f74b9dd7e594_9366/zapatillas-adizero-boston-12.jpg" alt="Running" class="img-fluid w-100">
                    <div class="category-overlay">
                        <h3>Running</h3>
                        <a href="#" class="btn btn-light">Explorar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="category-card position-relative">
                    <img src="https://images-wp.stockx.com/news/wp-content/uploads/2020/12/Best-Nike-Bball-2020_BlogHeader-1200x1200.png" alt="Basketball" class="img-fluid w-100">
                    <div class="category-overlay">
                        <h3>Basketball</h3>
                        <a href="#" class="btn btn-light">Explorar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="category-card position-relative">
                    <img src="https://acdn-us.mitiendanube.com/stores/986/786/products/027738a4-a120-4774-970a-b2a67a9c730d-673cda2af6b79b02f216330911267738-640-0.jpeg" alt="Lifestyle" class="img-fluid w-100">
                    <div class="category-overlay">
                        <h3>Lifestyle</h3>
                        <a href="#" class="btn btn-light">Explorar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Brands -->
<section class="brands py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Nuestras Marcas</h2>
            <p>Trabajamos con las mejores marcas del mundo</p>
        </div>
        <div class="row align-items-center">
            <div class="col-md-2 col-6 text-center mb-4">
                <img src="<?= base_url('assets/img/nike-logo.png') ?>" alt="Nike" class="img-fluid">
            </div>
            <div class="col-md-2 col-6 text-center mb-4">
                <img src="<?= base_url('assets/img/adidas-logo.png') ?>" alt="Adidas" class="img-fluid">
            </div>
            <div class="col-md-2 col-6 text-center mb-4">
                <img src="<?= base_url('assets/img/puma-logo.png') ?>" alt="Puma" class="img-fluid">
            </div>
            <div class="col-md-2 col-6 text-center mb-4">
                <img src="<?= base_url('assets/img/reebok-logo.png') ?>" alt="Reebok" class="img-fluid">
            </div>
            <div class="col-md-2 col-6 text-center mb-4">
                <img src="<?= base_url('assets/img/newbalance-logo.png') ?>" alt="New Balance" class="img-fluid">
            </div>
            <div class="col-md-2 col-6 text-center mb-4">
                <img src="<?= base_url('assets/img/converse-logo.png') ?>" alt="Converse" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter py-5 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h3>Suscríbete a nuestro newsletter</h3>
                <p class="mb-0">Recibe las últimas novedades y ofertas exclusivas directamente en tu correo.</p>
            </div>
            <div class="col-md-6">
                <form class="newsletter-form d-flex">
                    <input type="email" class="form-control me-2" placeholder="Tu correo electrónico" required>
                    <button type="submit" class="btn btn-primary">Suscribirse</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>