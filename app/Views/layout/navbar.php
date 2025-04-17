<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="SneakerZone Logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        Hombre
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Running</a></li>
                        <li><a class="dropdown-item" href="#">Basketball</a></li>
                        <li><a class="dropdown-item" href="#">Lifestyle</a></li>
                        <li><a class="dropdown-item" href="#">Training</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown">
                        Mujer
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Running</a></li>
                        <li><a class="dropdown-item" href="#">Lifestyle</a></li>
                        <li><a class="dropdown-item" href="#">Training</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Niños</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ofertas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Colecciones</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar zapatillas..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>