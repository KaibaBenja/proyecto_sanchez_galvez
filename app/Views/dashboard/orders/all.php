<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Todas las Compras
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="cart-section">
    <div class="cart-container">
        <h1 class="cart-title">Historial de Compras (Todos los usuarios)</h1>

        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <h3>Compra #<?= $order['id'] ?> - <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></h3>
                    <p><strong>Usuario:</strong> <?= esc($order['user']['name']) ?> (<?= esc($order['user']['email']) ?>)</p>
                    <p><strong>Total:</strong> $<?= $order['total_price'] ?></p>

                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Talle</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order['items'] as $item): ?>
                                <tr>
                                    <td data-label="Producto"><?= esc($item['product_name']) ?></td>
                                    <td data-label="Talle"><?= esc($item['size_label']) ?></td>
                                    <td data-label="Cantidad"><?= esc($item['quantity']) ?></td>
                                    <td data-label="Precio">$<?= esc($item['price_at_purchase']) ?></td>
                                    <td data-label="Subtotal">$<?= esc($item['quantity'] * $item['price_at_purchase']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="cart-empty">No hay compras registradas.</p>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection() ?>