<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos
{

    public $idCategoria;

    /**Crear el codigo del producto mediante su categoria */
    public function ajaxCrearCodigoProducto()
    {
        $item = "id_categoria";
        $valor = $this->idCategoria;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);

    }

}

if (isset($_POST["idCategoria"])) {
    $codigoProducto = new AjaxProductos();
    $codigoProducto->idCategoria = $_POST['idCategoria'];
    $codigoProducto->ajaxCrearCodigoProducto();
}

?>