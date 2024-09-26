<?php

class ControladorProductos
{
    /**
     * Summary of ctrMostrarProductos
     * @param mixed $item
     * @param mixed $valor
     * @return void
     */
    static public function ctrMostrarProductos($item, $valor)
    {

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;
    }


    static public function ctrCrearProducto()
    {
        if (isset($_POST['nuevaDescripcion'])) {
            if (
                preg_match(pattern: '/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', subject: $_POST['nuevaDescripcion']) &&
                preg_match(pattern: '/^[0subject: -9]+$/', subject: $_POST["nuevoStock"]) &&
                preg_match(pattern: '/^[0-9.]+$/', subject: $_POST["nuevoPrecioCompra"]) &&
                preg_match(pattern: '/^[0-9.]+$/', subject: $_POST["nuevoPrecioVenta"])
            ) {

                /**Validar imagen */

                $ruta="vistas/img/productos/default/anonymous.png";

                if (isset($_FILES['nuevaImagen']['tmp_name'])) {
                    list($ancho, $alto) = getimagesize($_FILES['nuevaImagen']['tmp_name']);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /**Creando nuevo directorio */
                    $directorio = "vistas/img/productos/" . $_POST['nuevoCodigo'];
                    mkdir($directorio, 0755);
                    /**De acuerdo al tipo de imagen */

                    if ($_FILES['nuevaImagen']['type'] == 'image/jpeg') {
                        /**Guardamos la imagen en el directorio */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/productos/" . $_POST['nuevoCodigo'] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES['nuevaImagen']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES['nuevaImagen']['type'] == 'image/png') {
                        /**Guardamos la imagen en el directorio */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/productos/" . $_POST['nuevoCodigo'] . "/" . $aleatorio . ".png";
                        $origen = imagecreatefrompng($_FILES['nuevaImagen']['tmp_name']);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }



                $tabla = "productos";
                $datos= array(
                    "id_categoria" => $_POST["nuevaCategoria"],
                    "codigo" => $_POST["nuevoCodigo"],
                    "descripcion" => $_POST["nuevaDescripcion"],
                    "stock" => $_POST["nuevoStock"],
                    "precio_compra" => $_POST["nuevoPrecioCompra"],
                    "precio_venta" => $_POST["nuevoPrecioVenta"],
                    "imagen" => $ruta
                );

                $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

                if($respuesta == "ok"){
                    echo '<script>
                    Swal.fire({
                        icon :"success",
                        title: "¡El producto ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm :false,
                        }).then((result)=>{
                            if(result.value){
                                window.location="productos";
                            }
                        });
                    </script>';
                }



            } else {
                echo '<script>
                Swal.fire({
                    icon :"error",
                    title: "¡El producto no puede ir con los campos vacios o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm :false,
                    }).then((result)=>{
                        if(result.value){
                            window.location="productos";
                        }
                    });
                </script>';
            }
        }
    }

}

?>