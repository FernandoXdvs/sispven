<?php

class ControladorClientes
{

    /**
     * Summary of ctrCrearCliente
     * @return void
     */
    static public function ctrCrearCliente()
    {
        if (isset($_POST['nuevoCliente'])) {
            /**Validamos que los campos contengan los caracteres permitidos */
            if (
                preg_match(pattern: '/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', subject: $_POST['nuevoCliente']) &&
                preg_match(pattern: '/^[a-zA-Z-0-9]+$/', subject: $_POST['nuevoDocumentoId']) &&
                preg_match(pattern: '/^[()\-0-9 ]+$/', subject: $_POST['nuevoTelefono'])
            ) {

                $tabla = "clientes";

                $datos = array(
                    "nombre" => $_POST['nuevoCliente'],
                    "documento" => $_POST['nuevoDocumentoId'],
                    "email" => $_POST['nuevoEmail'],
                    "telefono" => $_POST['nuevoTelefono'],
                    "direccion" => $_POST['nuevaDireccion'],
                    "fecha_nacimiento" => $_POST['nuevaFechaNacimiento']
                );

                $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                        icon :"success",
                        title: "¡El cliente ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="clientes";
                            }
                        });
                    </script>';
                }



            } else {

                echo '<script>
                Swal.fire({
                    icon :"error",
                    title: "¡El cliente no puede ir con los campos vacios o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm :false,
                    }).then((result)=>{
                        if(result.value){
                            window.location="clientes";
                        }
                    });
                </script>';

            }
        }
    }

    /**
     * Summary of ctrMostrarClientes
     * @param mixed $item
     * @param mixed $valor
     * @return mixed
     */
    static public function ctrMostrarClientes($item, $valor)
    {
        $tabla = "clientes";

        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

        return $respuesta;
    }


    /**
     * Summary of ctrEditarCliente
     * @return void
     */
    static public function ctrEditarCliente()
    {
        if (isset($_POST['editarCliente'])) {
            /**Validamos que los campos contengan los caracteres permitidos */
            if (
                preg_match(pattern: '/^[a-zA-Z-0-9ñÑáéíóúÁÉÍÓÚ ]+$/', subject: $_POST['editarCliente']) &&
                preg_match(pattern: '/^[a-zA-Z-0-9]+$/', subject: $_POST['editarDocumentoId']) &&
                preg_match(pattern: '/^[()\-0-9 ]+$/', subject: $_POST['editarTelefono'])
            ) {

                $tabla = "clientes";

                $datos = array(
                    "id" => $_POST['idCliente'],
                    "nombre" => $_POST['editarCliente'],
                    "documento" => $_POST['editarDocumentoId'],
                    "email" => $_POST['editarEmail'],
                    "telefono" => $_POST['editarTelefono'],
                    "direccion" => $_POST['editarDireccion'],
                    "fecha_nacimiento" => $_POST['editarFechaNacimiento']
                );

                $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                        icon :"success",
                        title: "¡El cliente ha sido modificado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="clientes";
                            }
                        });
                    </script>';
                }



            } else {

                echo '<script>
                Swal.fire({
                    icon :"error",
                    title: "¡El cliente no puede ir con los campos vacios o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm :false,
                    }).then((result)=>{
                        if(result.value){
                            window.location="clientes";
                        }
                    });
                </script>';

            }
        }
    }

    /**
     * Summary of ctrEliminarCliente
     * @return void
     */
    static public function ctrEliminarCliente(){
        if(isset($_GET["idCliente"])){
            $tabla = "clientes";
            $datos = $_GET["idCliente"];

            $respuesta = ModeloClientes::mdlEliminarCliente($tabla,$datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon :"success",
                        title: "¡El cliente ha sido eliminado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="clientes";
                            }
                        });
                    </script>';
            }

        }
    }


}

?>