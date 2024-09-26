<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos
{
    /**
     * Mostrar tabla productos
     * @return void
     */
    public function mostrarTablaProductos()
    {
        $item = null;
        $valor = null;

        /**Solicitamos todos los productos */
        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        $datosJson = '{
            "data": [';
        for ($i = 0; $i < count($productos); $i++) {

            /**Si el producto tiene imagen la colocamos en la tabla, si no asignamos una por default */
            if ($productos[$i]['imagen'] != null) {
                $imagen = "<img src='" . $productos[$i]['imagen'] . "' width='40px'>";
            } else {
                $imagen = "<img src='vistas/img/productos/default/anonymous.png' width='40px'>";
            }

            /*Si hay ventas se colocan en la tabla, en caso de que no, se coloca 0 */
            if ($productos[$i]['ventas'] != null) {
                $ventas = $productos[$i]['ventas'];
            } else {
                $ventas = 0;
            }

            /**Si la descripcion contiene comillas, las eliminamos para evitar problemas con el Json */
            if (preg_match('/"/', $productos[$i]['descripcion'])) {
                $descripcion = str_replace(array('"', "'", ";"), '', $productos[$i]['descripcion']);
            } else {
                $descripcion = $productos[$i]['descripcion'];
            }

            $item = "id";
            $valor = $productos[$i]["id_categoria"];

            /**Obtenemos las categorias dependiendo el id del producto */
            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            /**Estilizamos el stock dependiendo el estado en que se encuentre es decir proximo a terminarse o con exceso */
            if($productos[$i]['stock']<=10){
                $stock = "<button class='btn btn-danger'>".$productos[$i]['stock'] ."</button>";
            }else if($productos[$i]['stock']>11 && $productos[$i]['stock']<=15){
                $stock = "<button class='btn btn-warning'>".$productos[$i]['stock'] ."</button>";
            }else{
                $stock = "<button class='btn btn-success'>".$productos[$i]['stock'] ."</button>";
            }
            

            /**Todas las acciones */
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]['id'] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pen'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='" . $productos[$i]["id"] . "' codigo='" . $productos[$i]["codigo"] . "' imagen='" . $productos[$i]["imagen"] . "'><i class='fa fa-times'></i></button></div>";


            $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $imagen . '",
                    "' . $productos[$i]['codigo'] . '",
                    "' . $descripcion . '",
                    "' . $categorias['categoria'] . '",
                    "' .$stock. '",
                    "' . $productos[$i]['precio_compra'] . '",
                    "' . $productos[$i]['precio_venta'] . '",
                    "' . $ventas . '",
                    "' . $productos[$i]['fecha'] . '",
                    "' . $botones . '"
                ],';
        }


        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= '
            ]
        }';

        echo $datosJson;
    }
}

/**Activar tabla de productos */
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();

?>