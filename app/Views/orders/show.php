<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Comprobante de Compra #<?= $order['id'] ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="cart-section">
    <div class="cart-container">
        <div class="receipt-header" style="text-align: center; margin-bottom: 30px; padding: 20px; background: linear-gradient(135deg, #232442 0%, #3f51b5 100%); color: white; border-radius: 12px;">
            <h1 style="margin: 0; font-size: clamp(1.5em, 4vw, 2em); font-weight: bold;">🧾 COMPROBANTE DE COMPRA</h1>
            <p style="margin: 10px 0 0 0; font-size: clamp(1em, 3vw, 1.2em); opacity: 0.9;">Gracias por tu compra</p>
        </div>

        <div class="receipt-info" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div class="customer-info" style="background: #f8f9fa; padding: 20px; border-radius: 12px; border-left: 4px solid #232442;">
                <h3 style="color: #232442; margin-bottom: 15px; font-size: clamp(1.1em, 3vw, 1.3em);">👤 Información del Cliente</h3>
                <div style="line-height: 1.8;">
                    <p style="color: #666; margin-bottom: 8px;"><strong>Nombre:</strong> <?= esc($order['user_name']) ?></p>
                    <p style="color: #666; margin-bottom: 8px;"><strong>Email:</strong> <?= esc($order['user_email']) ?></p>
                    <p style="color: #666; margin-bottom: 0;"><strong>ID de Cliente:</strong> #<?= $order['user_id'] ?></p>
                </div>
            </div>

            <div class="order-info" style="background: #f8f9fa; padding: 20px; border-radius: 12px; border-left: 4px solid #4caf50;">
                <h3 style="color: #232442; margin-bottom: 15px; font-size: clamp(1.1em, 3vw, 1.3em);">📋 Información de la Orden</h3>
                <div style="line-height: 1.8;">
                    <p style="color: #666; margin-bottom: 8px;"><strong>Número de Compra:</strong> #<?= $order['id'] ?></p>
                    <p style="color: #666; margin-bottom: 8px;"><strong>Fecha de Compra:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
                    <p style="color: #666; margin-bottom: 0;"><strong>Estado:</strong> <span style="color: #4caf50; font-weight: bold;">✅ Completada</span></p>
                </div>
            </div>
        </div>

        <div class="products-section" style="margin-bottom: 30px;">
            <h2 style="color: #232442; margin-bottom: 20px; font-size: clamp(1.4em, 4vw, 1.8em); text-align: center;">🛍️ Productos Comprados</h2>
            
            <div class="products-grid" style="display: grid; gap: 20px;">
                <?php foreach ($order['items'] as $item): ?>
                    <div class="product-item" style="background: white; border: 1px solid #ddd; border-radius: 12px; padding: 20px; display: grid; grid-template-columns: auto 1fr auto; gap: 20px; align-items: center;">
                        <div class="product-image" style="width: 80px; height: 80px; border-radius: 8px; overflow: hidden; background: #f5f5f5; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <?php if (!empty($item['image_url'])): ?>
                                <img src="<?= base_url('public/uploads/' . $item['image_url']) ?>" 
                                     alt="<?= esc($item['product_name']) ?>" 
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <span style="color: #999; font-size: 2em;">🛍️</span>
                            <?php endif; ?>
                        </div>

                        <div class="product-details" style="min-width: 0;">
                            <h4 style="color: #232442; margin: 0 0 8px 0; font-size: clamp(1em, 3vw, 1.2em); word-wrap: break-word;"><?= esc($item['product_name']) ?></h4>
                            <p style="margin: 5px 0; color: #666; font-size: clamp(0.9em, 2.5vw, 1em);"><strong>Talle:</strong> <?= esc($item['size_label']) ?></p>
                            <p style="margin: 5px 0; color: #666; font-size: clamp(0.9em, 2.5vw, 1em);"><strong>Cantidad:</strong> <?= esc($item['quantity']) ?></p>
                        </div>

                        <div class="product-prices" style="text-align: right; flex-shrink: 0;">
                            <p style="margin: 5px 0; color: #666; font-size: clamp(0.8em, 2.5vw, 1em);"><strong>Precio unitario:</strong></p>
                            <p style="margin: 5px 0; font-size: clamp(1em, 3vw, 1.1em); color: #232442;">$<?= number_format($item['price_at_purchase'], 2) ?></p>
                            <p style="margin: 5px 0; color: #666; font-size: clamp(0.8em, 2.5vw, 1em);"><strong>Subtotal:</strong></p>
                            <p style="margin: 5px 0; font-size: clamp(1.1em, 3vw, 1.2em); font-weight: bold; color: #4caf50;">$<?= number_format($item['quantity'] * $item['price_at_purchase'], 2) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="totals-section" style="background: #f8f9fa; padding: 25px; border-radius: 12px; margin-bottom: 30px;">
            <h3 style="color: #232442; margin-bottom: 20px; font-size: clamp(1.2em, 4vw, 1.5em); text-align: center;">💰 Resumen de Totales</h3>
            
            <div class="totals-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div class="total-item" style="text-align: center; padding: 15px; background: white; border-radius: 8px;">
                    <p style="margin: 0 0 5px 0; color: #666; font-size: clamp(0.8em, 2.5vw, 0.9em);">Subtotal</p>
                    <p style="margin: 0; font-size: clamp(1.1em, 3vw, 1.3em); font-weight: bold; color: #232442;">$<?= number_format($subtotal, 2) ?></p>
                </div>
                
                <div class="total-item" style="text-align: center; padding: 15px; background: white; border-radius: 8px;">
                    <p style="margin: 0 0 5px 0; color: #666; font-size: clamp(0.8em, 2.5vw, 0.9em);">Envío</p>
                    <p style="margin: 0; font-size: clamp(1.1em, 3vw, 1.3em); font-weight: bold; color: #232442;">$0.00</p>
                </div>
                
                <div class="total-item" style="text-align: center; padding: 15px; background: white; border-radius: 8px;">
                    <p style="margin: 0 0 5px 0; color: #666; font-size: clamp(0.8em, 2.5vw, 0.9em);">Impuestos</p>
                    <p style="margin: 0; font-size: clamp(1.1em, 3vw, 1.3em); font-weight: bold; color: #232442;">$0.00</p>
                </div>
                
                <div class="total-item" style="text-align: center; padding: 15px; background: #4caf50; border-radius: 8px; color: white;">
                    <p style="margin: 0 0 5px 0; font-size: clamp(0.8em, 2.5vw, 0.9em); opacity: 0.9;">TOTAL</p>
                    <p style="margin: 0; font-size: clamp(1.3em, 4vw, 1.5em); font-weight: bold;">$<?= number_format($order['total_price'], 2) ?></p>
                </div>
            </div>
        </div>

        <div class="additional-info" style="background: #e3f2fd; padding: 20px; border-radius: 12px; border-left: 4px solid #2196f3; margin-bottom: 30px;">
            <h3 style="color: #232442; margin-bottom: 15px; font-size: clamp(1.1em, 3vw, 1.3em);">ℹ️ Información Adicional</h3>
            <div style="line-height: 1.6;">
                <p style="color: #666; margin-bottom: 8px; font-size: clamp(0.9em, 2.5vw, 1em);"><strong>Método de Pago:</strong> Pago en efectivo al momento de la entrega</p>
                <p style="color: #666; margin-bottom: 8px; font-size: clamp(0.9em, 2.5vw, 1em);"><strong>Estado de Envío:</strong> Pendiente de confirmación</p>
                <p style="color: #666; margin-bottom: 8px; font-size: clamp(0.9em, 2.5vw, 1em);"><strong>Tiempo de Entrega Estimado:</strong> 3-5 días hábiles</p>
                <p style="color: #666; margin-bottom: 0; font-size: clamp(0.9em, 2.5vw, 1em);"><strong>Política de Devolución:</strong> 30 días desde la compra</p>
            </div>
        </div>

        <div class="action-buttons" style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="<?= base_url('orders') ?>" style="padding: 12px 25px; background: #232442; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; transition: background 0.3s; font-size: clamp(0.9em, 2.5vw, 1em);">
                ← Volver al Historial
            </a>
            
            <button onclick="window.print()" style="padding: 12px 25px; background: #4caf50; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-size: clamp(0.9em, 2.5vw, 1em);">
                🖨️ Imprimir Comprobante
            </button>
        </div>

        <div class="receipt-footer" style="text-align: center; margin-top: 40px; padding: 20px; background: #f5f5f5; border-radius: 12px;">
            <p style="margin: 0; color: #666; font-size: clamp(0.8em, 2.5vw, 0.9em); line-height: 1.5;">
                Este es un comprobante oficial de compra. Guárdalo para futuras referencias.<br>
                Para consultas sobre tu pedido, contacta a nuestro servicio al cliente.
            </p>
        </div>
    </div>
</section>

<style>
@media print {
    .action-buttons {
        display: none !important;
    }
    
    .receipt-header {
        background: #232442 !important;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }
    
    .total-item {
        background: white !important;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }
    
    .cart-container {
        max-width: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
}

@media (min-width: 1200px) {
    .receipt-info {
        grid-template-columns: 1fr 1fr !important;
    }
    
    .totals-grid {
        grid-template-columns: repeat(4, 1fr) !important;
    }
    
    .product-item {
        grid-template-columns: 80px 1fr auto !important;
    }
}

@media (max-width: 1199px) and (min-width: 768px) {
    .receipt-info {
        grid-template-columns: 1fr 1fr !important;
    }
    
    .totals-grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    
    .product-item {
        grid-template-columns: 80px 1fr auto !important;
    }
    
    .action-buttons {
        gap: 20px !important;
    }
}

@media (max-width: 767px) and (min-width: 480px) {
    .receipt-info {
        grid-template-columns: 1fr !important;
        gap: 15px !important;
    }
    
    .totals-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
    }
    
    .product-item {
        grid-template-columns: 1fr !important;
        text-align: center !important;
        gap: 15px !important;
    }
    
    .product-image {
        margin: 0 auto !important;
        width: 100px !important;
        height: 100px !important;
    }
    
    .product-prices {
        text-align: center !important;
    }
    
    .action-buttons {
        flex-direction: column !important;
        align-items: center !important;
        gap: 10px !important;
    }
    
    .action-buttons a,
    .action-buttons button {
        width: 100% !important;
        max-width: 300px !important;
        text-align: center !important;
    }
}

/* Estilos para móviles pequeños */
@media (max-width: 479px) {
    .receipt-info {
        grid-template-columns: 1fr !important;
        gap: 15px !important;
    }
    
    .totals-grid {
        grid-template-columns: 1fr !important;
        gap: 10px !important;
    }
    
    .product-item {
        grid-template-columns: 1fr !important;
        text-align: center !important;
        gap: 15px !important;
        padding: 15px !important;
    }
    
    .product-image {
        margin: 0 auto !important;
        width: 80px !important;
        height: 80px !important;
    }
    
    .product-prices {
        text-align: center !important;
    }
    
    .action-buttons {
        flex-direction: column !important;
        align-items: center !important;
        gap: 10px !important;
    }
    
    .action-buttons a,
    .action-buttons button {
        width: 100% !important;
        max-width: 280px !important;
        text-align: center !important;
        padding: 15px 20px !important;
    }
    
    .receipt-header {
        padding: 15px !important;
    }
    
    .customer-info,
    .order-info,
    .additional-info {
        padding: 15px !important;
    }
    
    .totals-section {
        padding: 20px !important;
    }
    
    .receipt-footer {
        padding: 15px !important;
    }
}

/* Estilos para pantallas muy pequeñas */
@media (max-width: 360px) {
    .cart-container {
        padding: 10px !important;
    }
    
    .receipt-header {
        padding: 10px !important;
    }
    
    .customer-info,
    .order-info,
    .additional-info {
        padding: 10px !important;
    }
    
    .product-item {
        padding: 10px !important;
    }
    
    .totals-section {
        padding: 15px !important;
    }
    
    .action-buttons a,
    .action-buttons button {
        max-width: 250px !important;
        padding: 12px 15px !important;
    }
}

/* Mejoras generales de responsividad */
.product-details h4 {
    word-break: break-word;
    overflow-wrap: break-word;
}

.product-prices {
    white-space: nowrap;
}

/* Hover effects para botones */
.action-buttons a:hover,
.action-buttons button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* Transiciones suaves */
.product-item,
.total-item,
.customer-info,
.order-info,
.additional-info {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.product-item:hover,
.total-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
</style>
<?= $this->endSection() ?> 