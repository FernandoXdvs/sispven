<!--Barra de navegación-->
<nav class="main-header navbar navbar-expand navbar-green navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <!--Botón de navegación-->
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!--Perfil usuario-->
        <li class="nav-item">
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <?php
                            if ($_SESSION['foto'] != "") {
                                echo '<img src="' . $_SESSION['foto'] . '" class="user-image"
                                            style="width: 25px; height:25px;">';
                            } else {
                                echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image"
                                style="width: 25px; height:25px;">';
                            }
                            ?>
                            <span class="hidden-xs">
                                <?php
                                echo $_SESSION['nombre'];
                                ?>
                            </span>
                        </a>
                        <!--Dropdown-toggle -->
                        <ul class="dropdown-menu">
                            <li class="user-body">
                                <div class="pull-right">
                                    <a href="salir" class="btn btn-default btn-flat">Salir</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </li>
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!--Fullscreen-->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>

</nav>