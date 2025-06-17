<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Crear Producto</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 700px;
            margin: 40px auto;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .stock-row {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            align-items: center;
        }

        .stock-row select,
        .stock-row input {
            flex: 1;
        }

        .remove-btn {
            background-color: crimson;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            flex-shrink: 0;
        }

        .remove-btn:hover {
            background-color: darkred;
        }

        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>

    <?php
    ob_start();
    foreach ($sizes as $size) {
        $id = is_object($size) ? $size->id : $size['id'];
        $label = is_object($size) ? $size->size_label : $size['size_label'];
        echo "<option value=\"{$id}\">" . esc($label) . "</option>";
    }
    $sizesOptions = addslashes(ob_get_clean());
    ?>

    <script>
        const sizesOptions = "<?= $sizesOptions ?>";

        function addStockRow(sizeId = "", newSizeLabel = "", stock = "") {
            const container = document.getElementById('stock-container');
            const row = document.createElement('div');
            row.className = 'stock-row';

            row.innerHTML = `
                <select name="sizes[]" onchange="handleSizeChange(this)" required>
                    <option value="">-- Talle --</option>
                    ${sizesOptions}
                    <option value="__new__">Nuevo talle...</option>
                </select>
                <input type="text" name="new_sizes[]" placeholder="Talle nuevo" style="display:none;" />
                <input type="number" name="stocks[]" placeholder="Stock" required min="0" value="${stock}">
                <button type="button" class="remove-btn" onclick="this.parentNode.remove()">X</button>
            `;

            container.appendChild(row);

            const select = row.querySelector('select[name="sizes[]"]');
            const newSizeInput = row.querySelector('input[name="new_sizes[]"]');

            if (sizeId === "__new__") {
                select.value = "__new__";
                newSizeInput.style.display = 'block';
                newSizeInput.required = true;
                newSizeInput.value = newSizeLabel;
            } else if (sizeId) {
                select.value = sizeId;
                newSizeInput.style.display = 'none';
                newSizeInput.required = false;
            } else {
                select.value = "";
                newSizeInput.style.display = 'none';
                newSizeInput.required = false;
            }
        }

        function handleSizeChange(select) {
            const newSizeInput = select.parentNode.querySelector('input[name="new_sizes[]"]');
            if (select.value === '__new__') {
                newSizeInput.style.display = 'block';
                newSizeInput.required = true;
            } else {
                newSizeInput.style.display = 'none';
                newSizeInput.required = false;
                newSizeInput.value = '';
            }
        }

        window.onload = function() {
            addStockRow(); 
        };
    </script>
</head>

<body>

    <h2>Crear nuevo producto</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="error">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('dashboard/products/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label>Nombre del producto</label>
        <input type="text" name="name" value="<?= old('name') ?>" required>

        <label>Precio</label>
        <input type="number" name="price" value="<?= old('price') ?>" step="0.01" required>

        <label>Descripción</label>
        <textarea name="description"><?= old('description') ?></textarea>

        <label>Marca existente</label>
        <select name="brand_id">
            <option value="">-- Seleccionar --</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand->id ?>" <?= old('brand_id') == $brand->id ? 'selected' : '' ?>><?= esc($brand->name) ?></option>
            <?php endforeach; ?>
        </select>

        <label>O crear nueva marca</label>
        <input type="text" name="new_brand" placeholder="Ej: Nike" value="<?= old('new_brand') ?>">

        <label>Categoría existente</label>
        <select name="category_id">
            <option value="">-- Seleccionar --</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>" <?= old('category_id') == $category->id ? 'selected' : '' ?>><?= esc($category->name) ?></option>
            <?php endforeach; ?>
        </select>

        <label>O crear nueva categoría</label>
        <input type="text" name="new_category" placeholder="Ej: Zapatillas" value="<?= old('new_category') ?>">

        <label>Imagen del producto</label>
        <input type="file" name="image" accept="image/*" required>

        <label>Talles y stock</label>
        <div id="stock-container"></div>
        <button type="button" onclick="addStockRow()">Agregar talle</button>

        <br>
        <button type="submit">Guardar producto</button>
    </form>

</body>

</html>