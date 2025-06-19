<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png') ?>" />
    <title>SneakersHouse | Tienda de Zapatillas Premium</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/sneaker-style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/about.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/comercializacion.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/contact.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/terms.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/brands.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/products.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/cart.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/edit-form.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <title><?= $this->renderSection('title') ?></title>
</head>

<body>
    <?= $this->include('layout/header') ?>
    <?= $this->renderSection('content') ?>
    <?= $this->include('components/brands') ?>
    <?= $this->include('layout/footer') ?>

    <script src="<?= base_url('assets/js/sneaker.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/navbar.js') ?>"></script>
    <script src="<?= base_url('assets/js/auth.js') ?>"></script>

</body>

</html>