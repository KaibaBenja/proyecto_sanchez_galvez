<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Carrito de Compras
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="cart-section">
    <div class="cart-container">
        <h1 class="cart-title">Carrito de Compras</h1>

        <?php if (!empty($cartItems)): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr class="cart-item-row">
                            <td data-label="Producto"><?= esc($item['name']) ?></td>
                            <td data-label="Precio">$<?= esc($item['price']) ?></td>
                            <td data-label="Cantidad"><?= esc($item['quantity']) ?></td>
                            <td data-label="Total">$<?= esc($item['price'] * $item['quantity']) ?></td>
                            <td data-label="Acciones" class="cart-actions">
                                <form method="post" action="<?= base_url('/cart/remove/' . $item['id']) ?>">
                                    <button type="submit" class="remove-btn">Eliminar</button>
                                </form>
                                <form action="<?= base_url('/cart/checkout') ?>" method="post" class="checkout-form">
                                    <button type="submit" class="checkout-btn">Finalizar compra</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="cart-empty">Tu carrito está vacío.</p>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection() ?>