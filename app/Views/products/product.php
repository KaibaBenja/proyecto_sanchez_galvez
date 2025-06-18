<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Producto
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="product-detail">
    <div class="detail-container">
        <div class="product-images">
            <img src="<?= base_url('public/uploads/' . esc($product['image_url'])) ?>" alt="<?= esc($product['name']) ?>">
        </div>

        <div class="product-info">
            <h1><?= esc($product['name']) ?></h1>
            <p><strong>Marca:</strong> <?= esc($product['brand_name']) ?></p>
            <p><strong>Categoría:</strong> <?= esc($product['category_name']) ?></p>
            <p><strong>Precio:</strong> $<?= esc($product['price']) ?></p>
            <p><strong>Descripción:</strong> <?= esc($product['description']) ?></p>

            <h4>Talles disponibles</h4>
            <div class="size-selection">
                <?php if (!empty($sizes)): ?>
                    <div class="size-buttons">
                        <?php
                        $unique_sizes = [];
                        foreach ($sizes as $size) {
                            if (!isset($unique_sizes[$size->size_label])) {
                                $unique_sizes[$size->size_label] = $size;
                        ?>
                                <button type="button"
                                    class="size-btn"
                                    data-size-id="<?= esc($size->size_id) ?>"
                                    data-stock="<?= esc($size->stock) ?>"
                                    data-size-label="<?= esc($size->size_label) ?>">
                                    <?= esc($size->size_label) ?>
                                    <span class="stock-info">(<?= esc($size->stock) ?>)</span>
                                </button>
                        <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="quantity-selector">
                        <label for="quantity">Cantidad:</label>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn" id="decreaseQuantity">-</button>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" required readonly>
                            <button type="button" class="quantity-btn" id="increaseQuantity">+</button>
                        </div>
                    </div>
                <?php else: ?>
                    <p>No hay talles disponibles.</p>
                <?php endif; ?>
            </div>

            <form method="post" action="<?= base_url('/cart/add') ?>" id="addToCartForm">
                <input type="hidden" name="product_id" value="<?= esc($product['id']) ?>">
                <input type="hidden" name="size_id" id="selected_size_id">
                <input type="hidden" name="quantity" id="selected_quantity">

                <button type="submit" class="btn" id="addToCartBtn" <?= empty($sizes) ? 'disabled' : '' ?>>Agregar al carrito</button>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const sizeButtons = document.querySelectorAll('.size-btn');
                    const quantityInput = document.getElementById('quantity');
                    const selectedSizeId = document.getElementById('selected_size_id');
                    const selectedQuantity = document.getElementById('selected_quantity');
                    const addToCartBtn = document.getElementById('addToCartBtn');
                    const decreaseBtn = document.getElementById('decreaseQuantity');
                    const increaseBtn = document.getElementById('increaseQuantity');
                    const addToCartForm = document.getElementById('addToCartForm');

                    let selectedSize = null;

                    sizeButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            const stock = parseInt(e.currentTarget.dataset.stock);

                            if (selectedSize) {
                                selectedSize.classList.remove('selected');
                            }

                            e.currentTarget.classList.add('selected');
                            selectedSize = e.currentTarget;

                            selectedSizeId.value = e.currentTarget.dataset.sizeId;
                            console.log("Talle seleccionado:", e.currentTarget.dataset.sizeId);

                            quantityInput.max = stock;
                            if (parseInt(quantityInput.value) > stock) {
                                quantityInput.value = stock;
                            }

                            selectedQuantity.value = quantityInput.value;
                            addToCartBtn.disabled = false;
                        });
                    });

                    decreaseBtn.addEventListener('click', function() {
                        const currentValue = parseInt(quantityInput.value);
                        if (currentValue > 1) {
                            quantityInput.value = currentValue - 1;
                            selectedQuantity.value = quantityInput.value;
                        }
                    });

                    increaseBtn.addEventListener('click', function() {
                        const currentValue = parseInt(quantityInput.value);
                        const maxValue = parseInt(quantityInput.max);
                        if (currentValue < maxValue) {
                            quantityInput.value = currentValue + 1;
                            selectedQuantity.value = quantityInput.value;
                        }
                    });

                    addToCartForm.addEventListener('submit', function(e) {
                        if (!selectedSizeId.value) {
                            e.preventDefault();
                            alert('Por favor seleccione un talle antes de agregar al carrito');
                        }
                    });
                });
            </script>
        </div>
    </div>
</section>
<?= $this->endSection() ?>