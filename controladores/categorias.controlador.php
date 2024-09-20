<?php

class ControladorCategorias
{

    /**Crear categorias */

    static public function ctrCrearCategoria()
    {
        if (isset($_POST['nuevaCategoria'])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevaCategoria'])) {

                $tabla = "categorias";

                $datos = $_POST["nuevaCategoria"];

                $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                        icon :"success",
                        title: "¡La categoría ha sido guardada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="categorias";
                            }
                        });
                    </script>';
                }


            } else {
                echo '<script>
                Swal.fire({
                    icon :"error",
                    title: "¡La categoría no puede ir vacia o llevar caracteres esécoañes!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm :false,
                    }).then((result)=>{
                        if(result.value){
                            window.location="categorias";
                        }
                    });
                </script>';
            }
        }
    }

}

?>