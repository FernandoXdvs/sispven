<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sispven | Punto de venta</title>

  <!--===============================
  PLUGINS DE CSS
  =================================-->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./vistas/dist/css/adminlte.css">

  <!--===============================
  PLUGINS DE JAVASCRIPT
  =================================-->

  <!-- jQuery -->
  <script src="./vistas/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./vistas/dist/js/adminlte.min.js"></script>

</head>

<!--===============================
  CUERPO DOCUMENTO
  =================================-->

<body class="hold-transition sidebar-mini sidebar-collapse">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php
    /**Header o cabecera */
    include "modulos/header.php";
    /**Menu lateral */
    include "modulos/menu.php";

    if (isset($_GET["ruta"])) {
      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "categorias" ||
        $_GET["ruta"] == "productos" ||
        $_GET["ruta"] == "clientes" ||
        $_GET["ruta"] == "ventas" ||
        $_GET["ruta"] == "crear-venta" ||
        $_GET["ruta"] == "reportes"
      ) {
        /**Contenido principal */
        include "modulos/" . $_GET["ruta"] . ".php";
      }
    } else {
      /**Contenido principal */
      include "modulos/inicio.php";
    }



    /**Footer */
    include "modulos/footer.php";
    ?>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->

    <!-- /.content-wrapper -->

    <!--FOOTER-->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


</body>

</html>