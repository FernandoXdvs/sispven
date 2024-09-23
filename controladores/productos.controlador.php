<?php

class ControladorProductos
{
    /**
     * Summary of ctrMostrarProductos
     * @param mixed $item
     * @param mixed $valor
     * @return void
     */
    static public function ctrMostrarProductos($item, $valor){

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;
    }

}

?>