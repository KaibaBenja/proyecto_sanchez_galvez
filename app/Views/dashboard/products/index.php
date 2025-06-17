<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 1000px;
            margin: 40px auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filter-form input,
        .filter-form select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .filter-form button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img.thumb {
            max-width: 60px;
            height: auto;
            border-radius: 4px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #007bff;
        }

        .btn-delete {
            background-color: crimson;
        }

        .btn-create {
            background-color: green;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-create:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>

    <h2>Productos</h2>

    <a href="<?= site_url('dashboard/products/create') ?>" class="btn-create">+ Crear nuevo producto</a>

    <form method="get" class="filter-form">
        <input type="text" name="search" placeholder="Buscar por nombre..." value="<?= esc($search) ?>">

        <select name="brand">
            <option value="">-- Marca --</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand->id ?>" <?= ($brand->id == $selectedBrand) ? 'selected' : '' ?>>
                    <?= esc($brand->name) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="category">
            <option value="">-- Categoría --</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>" <?= ($category->id == $selectedCategory) ? 'selected' : '' ?>>
                    <?= esc($category->name) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Filtrar</button>
    </form>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Marca</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($products)): ?>
                <tr>
                    <td colspan="6">No se encontraron productos.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td>
                            <?php if (!empty($product->image_url)): ?>
                                <img src="<?= base_url('uploads/' . $product->image_url) ?>" class="thumb">
                            <?php endif; ?>
                        </td>
                        <td><?= esc($product->name) ?></td>
                        <td>$<?= number_format($product->price, 2) ?></td>
                        <td><?= esc($product->brand_name) ?></td>
                        <td><?= esc($product->category_name) ?></td>
                        <td class="actions">
                            <a href="<?= site_url('dashboard/products/edit/' . $product->id) ?>" class="btn btn-edit">Editar</a>
                            <form action="<?= site_url('dashboard/products/delete/' . $product->id) ?>" method="post" onsubmit="return confirm('¿Eliminar este producto?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>