<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/sneaker-style.css">
    <title><?= $this->renderSection('title') ?></title>
</head>
<body>
    <header>
        <figure class="logo">
            <img src="assets/img/logo.png" alt="Logo" class="logo__image">
        </figure>
        <nav>
            <ul>
                <li>Home</li>
                <li>Info</li>
                <li>Login</li>
            </ul>
        </nav>
    </header>
    <section class="carousel">
        <div class="list">
            <div class="item active">
                <figure>
                    <img src="assets/img/jordan1.png" alt="">
                </figure>
                <div class="content">
                    <p class="category">Lifestyle Shoe</p>
                    <h2>NIKE JORDAN 1 CHICAGO</h2>
                    <p class="description">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ducimus, nihil accusamus a dolor labore vel error voluptas voluptates! Saepe, rem?
                    </p>
                    <div class="more">
                        <button>Añadir al carrito</button>
                        <button>Mostrar más</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <figure>
                    <img src="assets/img/jordan11.png" alt="">
                </figure>
                <div class="content">
                    <p class="category">Lifestyle Shoe</p>
                    <h2>NIKE JORDAN 11</h2>
                    <p class="description">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ducimus, nihil accusamus a dolor labore vel error voluptas voluptates! Saepe, rem?
                    </p>
                    <div class="more">
                        <button>Añadir al carrito</button>
                        <button>Mostrar más</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <figure>
                    <img src="assets/img/jordan4.png" alt="">
                </figure>
                <div class="content">
                    <p class="category">Lifestyle Shoe</p>
                    <h2>NIKE JORDAN 4</h2>
                    <p class="description">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ducimus, nihil accusamus a dolor labore vel error voluptas voluptates! Saepe, rem?
                    </p>
                    <div class="more">
                        <button>Añadir al carrito</button>
                        <button>Mostrar más</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="arrows">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <div class="indicators">
            <div class="number">01</div>
            <ul>
                <li class="active"></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </section>

    <script src="assets/css/sneaker.js"></script>
</body>