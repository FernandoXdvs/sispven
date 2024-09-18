<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sispven | Punto de venta</title>

  <link rel="icon" href="vistas/img/plantilla/minlogo.png">

  <!--===============================
  PLUGINS DE CSS
  =================================-->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas\dist\css\adminlte.css">
  <!--Datatables-->
  <link rel="stylesheet" href="./vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">




  <!--===============================
  PLUGINS DE JAVASCRIPT
  =================================-->

  <!-- jQuery -->
  <script src="./vistas/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./vistas/dist/js/adminlte.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="./vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="./vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="./vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="./vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="./vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="./vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="./vistas/plugins/jszip/jszip.min.js"></script>
  <script src="./vistas/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="./vistas/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="./vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="./vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="./vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!--SweetAlert 2-->
  <script src="./vistas/plugins/sweetalert/sweetalert2@11.js"></script>
  <script src="./vistas/plugins/sweetalert2/sweetalert2.all.min.js"></script>



</head>

<!--===============================
  CUERPO DOCUMENTO
  =================================-->

<body class="hold-transition sidebar-mini sidebar-collapse login-page">

  <?php
  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    echo '<div class="wrapper">';
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
        $_GET["ruta"] == "reportes" ||
        $_GET["ruta"] == "salir"
      ) {
        /**Contenido principal */
        include "modulos/" . $_GET["ruta"] . ".php";
      } else {
        include "modulos/404.php";
      }
    } else {
      /**Contenido principal */
      include "modulos/inicio.php";
    }



    /**Footer */
    include "modulos/footer.php";


    echo '<aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>';
    echo '</div>';
  } else {
    include "modulos/login.php";
  }
  ?>

  <!--Js propio-->
  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/usuarios.js"></script>

</body>

</html>