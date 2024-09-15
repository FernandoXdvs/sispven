<?php
class ControladorUsuarios
{

    /**
     * Ingreso usuario
     * @return void
     */
    public function ctrIngresoUsuario()
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

                if ($respuesta['usuario'] == $_POST['ingUsuario']  && $respuesta['password'] == $_POST['ingPassword']) {
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

}

?>