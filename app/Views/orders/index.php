<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Historial de Compras
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="cart-section">
  <div class="cart-container">
    <h1 class="cart-title">Historial de Compras</h1>

    <div class="search-filters" style="margin-bottom: 30px; background: #f8f9fa; padding: 20px; border-radius: 12px;">
        <form method="get" class="filter-form" style="display: grid; gap: 15px; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
            <div>
                <label for="search" style="display: block; margin-bottom: 5px; font-weight: bold; color: #232442;">Buscar:</label>
                <input type="text" id="search" name="search" 
                       placeholder="ID de compra o producto" 
                       value="<?= esc($search ?? '') ?>" 
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div>
                <label for="date_from" style="display: block; margin-bottom: 5px; font-weight: bold; color: #232442;">Fecha desde:</label>
                <input type="date" id="date_from" name="date_from" 
                       value="<?= esc($dateFrom ?? '') ?>" 
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div>
                <label for="date_to" style="display: block; margin-bottom: 5px; font-weight: bold; color: #232442;">Fecha hasta:</label>
                <input type="date" id="date_to" name="date_to" 
                       value="<?= esc($dateTo ?? '') ?>" 
                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div>
                <label for="sort_by" style="display: block; margin-bottom: 5px; font-weight: bold; color: #232442;">Ordenar por:</label>
                <select id="sort_by" name="sort_by" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                    <option value="created_at" <?= ($sortBy ?? 'created_at') === 'created_at' ? 'selected' : '' ?>>Fecha</option>
                    <option value="total_price" <?= ($sortBy ?? 'created_at') === 'total_price' ? 'selected' : '' ?>>Precio Total</option>
                    <option value="id" <?= ($sortBy ?? 'created_at') === 'id' ? 'selected' : '' ?>>ID de Compra</option>
                </select>
            </div>

            <div>
                <label for="sort_order" style="display: block; margin-bottom: 5px; font-weight: bold; color: #232442;">Orden:</label>
                <select id="sort_order" name="sort_order" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                    <option value="DESC" <?= ($sortOrder ?? 'DESC') === 'DESC' ? 'selected' : '' ?>>Descendente</option>
                    <option value="ASC" <?= ($sortOrder ?? 'DESC') === 'ASC' ? 'selected' : '' ?>>Ascendente</option>
                </select>
            </div>

            <div style="display: flex; gap: 10px; align-items: end;">
                <button type="submit" style="padding: 10px 20px; border: none; background-color: #232442; color: #fff; border-radius: 8px; cursor: pointer; flex: 1;">
                    🔍 Buscar
                </button>
                <a href="<?= base_url('orders') ?>" style="padding: 10px 20px; border: 1px solid #232442; background-color: #fff; color: #232442; border-radius: 8px; text-decoration: none; text-align: center; flex: 1;">
                    🗑️ Limpiar
                </a>
            </div>
        </form>
    </div>

    <?php if (!empty($search) || !empty($dateFrom) || !empty($dateTo)): ?>
        <div class="search-info" style="margin-bottom: 20px; padding: 10px; background: #e3f2fd; border-radius: 8px; border-left: 4px solid #2196f3;">
            <strong>Filtros aplicados:</strong>
            <?php if (!empty($search)): ?>
                <span style="margin-right: 15px;">🔍 Búsqueda: "<?= esc($search) ?>"</span>
            <?php endif; ?>
            <?php if (!empty($dateFrom)): ?>
                <span style="margin-right: 15px;">📅 Desde: <?= date('d/m/Y', strtotime($dateFrom)) ?></span>
            <?php endif; ?>
            <?php if (!empty($dateTo)): ?>
                <span style="margin-right: 15px;">📅 Hasta: <?= date('d/m/Y', strtotime($dateTo)) ?></span>
            <?php endif; ?>
            <span>📊 Ordenado por: <?= $sortBy === 'created_at' ? 'Fecha' : ($sortBy === 'total_price' ? 'Precio Total' : 'ID') ?> (<?= $sortOrder === 'ASC' ? 'Ascendente' : 'Descendente' ?>)</span>
        </div>
    <?php endif; ?>

    <?php if (!empty($orders)): ?>
        <div class="results-count" style="margin-bottom: 20px; color: #666; font-style: italic;">
             <?= count($orders) ?> compra<?= count($orders) !== 1 ? 's' : '' ?>
        </div>

        <?php foreach ($orders as $order): ?>
            <div class="order-card" style="margin-bottom: 20px; border: 1px solid #ddd; border-radius: 12px; padding: 20px; background: #fff;">
                <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 15px;">
                    <h3 style="color: #232442; margin: 0; flex: 1;">
                        Compra #<?= $order['id'] ?> - <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
                    </h3>
                    <a href="<?= base_url('orders/' . $order['id']) ?>" 
                       style="padding: 8px 16px; background: #4caf50;margin-left: 10px; color: white; text-decoration: none; border-radius: 6px; font-size: 0.9em; font-weight: bold; transition: background 0.3s;">
                        🧾 Ver Comprobante
                    </a>
                </div>
                <p style="margin-bottom: 20px;"><strong>Total:</strong> $<?= number_format($order['total_price'], 2) ?></p>

                <table class="cart-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                    <thead>
                        <tr style="background: #f8f9fa;">
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Producto</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Talle</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Cantidad</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Precio</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order['items'] as $item): ?>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 12px;" data-label="Producto"><?= esc($item['product_name']) ?></td>
                                <td style="padding: 12px;" data-label="Talle"><?= esc($item['size_label']) ?></td>
                                <td style="padding: 12px;" data-label="Cantidad"><?= esc($item['quantity']) ?></td>
                                <td style="padding: 12px;" data-label="Precio">$<?= number_format($item['price_at_purchase'], 2) ?></td>
                                <td style="padding: 12px;" data-label="Subtotal">$<?= number_format($item['quantity'] * $item['price_at_purchase'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="cart-empty" style="text-align: center; padding: 40px; color: #666;">
            <?php if (!empty($search) || !empty($dateFrom) || !empty($dateTo)): ?>
                <p style="font-size: 1.2em; margin-bottom: 10px;">🔍 No se encontraron compras</p>
                <p>Intenta ajustar los filtros de búsqueda</p>
            <?php else: ?>
                <p style="font-size: 1.2em; margin-bottom: 10px;">🛒 Aún no realizaste compras</p>
                <p>¡Explora nuestros productos y realiza tu primera compra!</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
  </div>
</section>

<style>
@media (max-width: 768px) {
    .filter-form {
        grid-template-columns: 1fr !important;
    }
    
    .search-filters {
        padding: 15px !important;
    }
    
    .search-info {
        font-size: 0.9em;
    }
    
    .search-info span {
        display: block;
        margin-bottom: 5px;
    }
}
</style>
<?= $this->endSection() ?>
