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
                    <img src="assets/img/adi2000.png" alt="adi2000">
                </figure>
                <div class="content">
                    <p class="category">Lifestyle Shoe</p>
                    <h2>ADI2000</h2>
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
                    <img src="assets/img/jordan4.png" alt="jordan4">
                </figure>
                <div class="content">
                    <p class="category">Lifestyle Shoe</p>
                    <h2>JORDAN 4</h2>
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

    
<?= $this->endSection() ?>