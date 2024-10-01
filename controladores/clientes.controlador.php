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
                preg_match(pattern: '/^[()\-0-9 ]+$/', subject: $_POST['nuevoTelefono']) &&
                preg_match(pattern: '/^[#\.\-a-zA-Z0-9 ]+$/', subject: $_POST['nuevaDireccion'])
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


}

?>