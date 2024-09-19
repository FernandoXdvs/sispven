<?php
class ControladorUsuarios
{

    /**
     * Ingreso usuario
     * @return void
     */
    static public function ctrIngresoUsuario()
    {
        if (isset($_POST['ingUsuario']) && isset($_POST['ingPassword'])) {
            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])
            ) {

                $encriptar = crypt($_POST['ingPassword'], '$2a$07$usesomesillystringforsalt$');

                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST['ingUsuario'];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if ($respuesta['usuario'] == $_POST['ingUsuario'] && $respuesta['password'] == $encriptar) {

                    if ($respuesta['estado'] == 1) {
                        /**Variables de sesion */
                        $_SESSION['iniciarSesion'] = 'ok';
                        $_SESSION['id'] = $respuesta['id'];
                        $_SESSION['nombre'] = $respuesta['nombre'];
                        $_SESSION['usuario'] = $respuesta['usuario'];
                        $_SESSION['perfil'] = $respuesta['perfil'];
                        $_SESSION['foto'] = $respuesta['foto'];

                        /**Regsitrar fecha para saber ultimo login */

                        date_default_timezone_set('America/Mexico_City');
                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');

                        $fechaActual = $fecha . ' ' . $hora;

                        $item1 = "ultimo_login";
                        $valor1 = $fechaActual;

                        $item2 = "id";
                        $valor2 = $respuesta['id'];

                        $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                        if ($ultimoLogin == "ok") {
                            echo '<script>
                            window.location = "inicio";
                            </script>';
                        }

                    } else {
                        echo '<div class="alert alert-danger mt-2">
                        Este usuario no esta activo, contacte a un administrador.</div>';
                    }


                } else {
                    echo '<div class="alert alert-danger mt-2">Error al ingresar, vuelve a intentarlo.</div>';
                }

            }

        }
    }

    /**
     * Crear Usuario
     * @return void
     */
    static public function ctrCrearUsuario()
    {

        if (isset($_POST['nuevoUsuario'])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoNombre']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoUsuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword'])
            ) {

                /**Validar imagen */
                $ruta = "";

                if (isset($_FILES['nuevaFoto']['tmp_name'])) {
                    list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /**Creando nuevo directorio */
                    $directorio = "vistas/img/usuarios/" . $_POST['nuevoUsuario'];
                    mkdir($directorio, 0755);
                    /**De acuerdo al tipo de imagen */

                    if ($_FILES['nuevaFoto']['type'] == 'image/jpeg') {
                        /**Guardamos la imagen en el directorio */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/usuarios/" . $_POST['nuevoUsuario'] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES['nuevaFoto']['type'] == 'image/png') {
                        /**Guardamos la imagen en el directorio */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/usuarios/" . $_POST['nuevoUsuario'] . "/" . $aleatorio . ".png";
                        $origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";

                $encriptar = crypt($_POST['nuevoPassword'], '$2a$07$usesomesillystringforsalt$');

                $datos = array(
                    "nombre" => $_POST['nuevoNombre'],
                    "usuario" => $_POST['nuevoUsuario'],
                    "password" => $encriptar,
                    "perfil" => $_POST['nuevoPerfil'],
                    "foto" => $ruta,
                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                        icon :"success",
                        title: "¡El usuario ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="usuarios";
                            }
                        });
                    </script>';
                }

            } else {
                echo '<script>
                    Swal.fire({
                        icon :"error",
                        title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="usuarios";
                            }
                        });
                    </script>';
            }
        }

    }

    /**
     * Mostrar usuarios
     * @return void
     */
    static public function ctrMostrarUsuarios($item, $valor)
    {
        $tabla = "usuarios";


        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    /**Editar usuario */
    public function ctrEditarUsuario()
    {

        if (isset($_POST['editarUsuario'])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['editarNombre'])
            ) {
                /**Validar imagen */
                $ruta = $_POST['fotoActual'];

                if (isset($_FILES['editarFoto']['tmp_name']) && !empty($_FILES['editarFoto']['tmp_name'])) {
                    list($ancho, $alto) = getimagesize($_FILES['editarFoto']['tmp_name']);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /**Creando nuevo directorio */
                    $directorio = "vistas/img/usuarios/" . $_POST['editarUsuario'];

                    /**Existe imagen en la base de datos */

                    if (!empty($_POST['fotoActual'])) {
                        unlink($_POST['fotoActual']);
                    } else {
                        mkdir($directorio, 0755);
                    }


                    /**De acuerdo al tipo de imagen */

                    if ($_FILES['editarFoto']['type'] == 'image/jpeg') {
                        /**Guardamos la imagen en el directorio */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/usuarios/" . $_POST['editarUsuario'] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES['editarFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES['editarFoto']['type'] == 'image/png') {
                        /**Guardamos la imagen en el directorio */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/usuarios/" . $_POST['editarUsuario'] . "/" . $aleatorio . ".png";
                        $origen = imagecreatefrompng($_FILES['editarFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }


                $tabla = "usuarios";


                if ($_POST['editarPassword'] != "") {
                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarPassword'])) {
                        $encriptar = crypt($_POST['editarPassword'], '$2a$07$usesomesillystringforsalt$');
                    } else {
                        echo '<script>
                    Swal.fire({
                        icon :"error",
                        title: "¡La contraseña no puede ir vacio o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="usuarios";
                            }
                        });
                    </script>';
                    }
                } else {
                    $encriptar = $_POST['passwordActual'];
                }

                $datos = array(
                    "nombre" => $_POST['editarNombre'],
                    "usuario" => $_POST['editarUsuario'],
                    "password" => $encriptar,
                    "perfil" => $_POST['editarPerfil'],
                    "foto" => $ruta,
                );
                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                        icon :"success",
                        title: "¡El usuario ha sido editado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="usuarios";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon :"error",
                        title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="usuarios";
                            }
                        });
                    </script>';
            }

        }
    }


}

?>