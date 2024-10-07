<?php

require_once "conexion.php";


class ModeloVentas
{


    /**
     * Summary of mdlMostrarVentas
     * @param mixed $tabla
     * @param mixed $item
     * @param mixed $valor
     * @return mixed
     */
    static public function mdlMostrarVentas($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :item ORDER BY fecha DESC");
            $stmt->bindParam(":item", $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;

    }


}

?>