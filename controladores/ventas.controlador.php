<?php 

class ControladorVentas{

    /**
     * Summary of ctrMostrarVentas
     * @param mixed $item
     * @param mixed $valor
     * @return void
     */
    static public function ctrMostrarVentas($item, $valor){
        $tabla = "ventas";
        $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

        return $respuesta;
    }
}

?>