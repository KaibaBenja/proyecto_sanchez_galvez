<h2>Crear nuevo producto</h2>

<?php if (session()->getFlashdata('error')): ?>
    <div class="error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form action="<?= site_url('/products/store') ?>" method="post">
    <!-- Nombre del producto -->
    <label>Nombre:</label>
    <input type="text" name="name" required><br>

    <!-- Marca: puede ser ID o nombre -->
    <label>Marca (nombre o ID):</label>
    <input type="text" name="brand" placeholder="Ej: Nike o 1" required><br>

    <!-- Categoría: puede ser ID o nombre -->
    <label>Categoría (nombre o ID):</label>
    <input type="text" name="category" placeholder="Ej: Running o 2" required><br>

    <!-- Precio -->
    <label>Precio:</label>
    <input type="number" name="price" step="0.01" required><br>

    <!-- Descripción -->
    <label>Descripción:</label>
    <textarea name="description"></textarea><br>

    <!-- Imagen (URL por ahora) -->
    <label>URL de imagen:</label>
    <input type="text" name="image_url" placeholder="https://..."><br>

    <hr>

    <h4>Talles y Stock</h4>
    <div id="sizes-container">
        <div class="size-group">
            <label>Talle:</label>
            <input type="text" name="sizes[0][label]" placeholder="Ej: 40" required>
            <label>Stock:</label>
            <input type="number" name="sizes[0][stock]" required>
            <button type="button" onclick="removeSize(this)">Eliminar</button>
        </div>
    </div>

    <button type="button" onclick="addSize()">Agregar talle</button><br><br>

    <button type="submit">Guardar producto</button>
</form>

<script>
let sizeIndex = 1;

function addSize() {
    const container = document.getElementById('sizes-container');
    const group = document.createElement('div');
    group.className = 'size-group';

    group.innerHTML = `
        <label>Talle:</label>
        <input type="text" name="sizes[${sizeIndex}][label]" required>
        <label>Stock:</label>
        <input type="number" name="sizes[${sizeIndex}][stock]" required>
        <button type="button" onclick="removeSize(this)">Eliminar</button>
    `;

    container.appendChild(group);
    sizeIndex++;
}

function removeSize(button) {
    button.parentElement.remove();
}
</script>
