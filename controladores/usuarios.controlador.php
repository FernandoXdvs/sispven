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
                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST['ingUsuario'];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if ($respuesta['usuario'] == $_POST['ingUsuario'] && $respuesta['password'] == $_POST['ingPassword']) {
                    $_SESSION['iniciarSesion'] = 'ok';
                    echo '<script>
                        window.location = "inicio";
                    </script>';
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
                        $ruta = "vistas/img/usuarios/". $_POST['nuevoUsuario']."/".$aleatorio.".jpg";
                        $origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES['nuevaFoto']['type'] == 'image/png') {
                        /**Guardamos la imagen en el directorio */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/usuarios/". $_POST['nuevoUsuario']."/".$aleatorio.".png";
                        $origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";
                $datos = array(
                    "nombre" => $_POST['nuevoNombre'],
                    "usuario" => $_POST['nuevoUsuario'],
                    "password" => $_POST['nuevoPassword'],
                    "perfil" => $_POST['nuevoPerfil'],
                    "foto" => $ruta,
                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla,$datos);

                if($respuesta == "ok"){
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

}

?>