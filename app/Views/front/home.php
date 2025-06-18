<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>


<?= $this->section('content') ?>
    <section class="carousel">
        <div class="list">
            <div class="item active">
                <figure>
                    <img src="assets/img/jordan1.png" alt="jordan1">
                </figure>
                <div class="content">
                    <p class="category">Lifestyle Shoe</p>
                    <h2>JORDAN 1</h2>
                    
                    <div class="more">
                        <button onclick="window.location.href='<?= site_url('productos') ?>'">Añadir al carrito</button>
                        <button onclick="window.location.href='<?= site_url('productos') ?>'">Mostrar más</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <figure>
                    <img src="assets/img/adi2000.png" alt="adi2000">
                </figure>
                <div class="content">
                    <p class="category">Lifestyle Shoe</p>
                    <h2>ADI2000</h2>
                    
                    <div class="more">
                        <button onclick="window.location.href='<?= site_url('productos') ?>'">Añadir al carrito</button>
                        <button onclick="window.location.href='<?= site_url('productos') ?>'">Mostrar más</button>
                    </div>
                </div>
            </div>
            <div class="item">
                <figure>
                    <img src="assets/img/jordan4.png" alt="jordan4">
                </figure>
                <div class="content">
                    <p class="category">Lifestyle Shoe</p>
                    <h2>JORDAN 4</h2>
                    
                    <div class="more">
                        <button onclick="window.location.href='<?= site_url('productos') ?>'">Añadir al carrito</button>
                        <button onclick="window.location.href='<?= site_url('productos') ?>'">Mostrar más</button>
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

    
<?= $this->endSection() ?>