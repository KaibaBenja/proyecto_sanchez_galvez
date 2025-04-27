<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Comercialización
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="comercializacion">
    <div class="comercializacion-container">
        <div class="comercializacion-text">
            <h1>Comercialización</h1>
            <p>En SneakersHouse buscamos que tu experiencia de compra sea simple, segura y rápida. A continuación, te detallamos toda la información que necesitás saber para realizar tu pedido con total confianza.</p>
            
            <h2>Tipos de Entregas</h2>
            <ul>
                <li><strong>Retiro en tienda:</strong> Podés retirar tu pedido personalmente en nuestro local sin costo adicional.</li>
                <li><strong>Entrega a domicilio:</strong> Servicio disponible en la ciudad y zonas cercanas. Entregas dentro de las 24/48 hs hábiles.</li>
                <li><strong>Envío nacional:</strong> Realizamos envíos a todo el país a través de servicios logísticos de confianza.</li>
            </ul>

            <h2>Formas de Envío</h2>
            <ul>
                <li><strong>Correo privado:</strong> Opciones rápidas con seguimiento en tiempo real.</li>
                <li><strong>Correo nacional:</strong> Para zonas más alejadas, con tarifas accesibles.</li>
                <li><strong>Entrega express:</strong> Envío en el mismo día para compras realizadas antes de las 12 hs (solo en zonas habilitadas).</li>
            </ul>

            <h2>Formas de Pago</h2>
            <ul>
                <li><strong>Tarjetas de crédito y débito:</strong> Aceptamos todas las principales tarjetas. Opción de cuotas sin interés en promociones bancarias.</li>
                <li><strong>Transferencia bancaria:</strong> 10% de descuento abonando mediante transferencia.</li>
                <li><strong>Mercado Pago:</strong> Operaciones 100% seguras y posibilidad de financiación.</li>
                <li><strong>Pago en efectivo:</strong> Solo disponible para retiros en tienda.</li>
            </ul>

            <h2>Información adicional</h2>
            <p>Todos los pedidos son procesados en un máximo de 24 hs hábiles. 
            Una vez despachado tu paquete, te enviaremos el número de seguimiento para que puedas controlar el estado de tu envío en todo momento.</p>

            <p>Si tenés alguna duda o necesitás asistencia personalizada, nuestro equipo de atención al cliente está listo para ayudarte.</p>
        </div>
        <div class="comercializacion-image">
            <img src="assets/img/envio.png" alt="Comercialización y Envíos">
        </div>
    </div>
</section>
<?= $this->endSection() ?>
