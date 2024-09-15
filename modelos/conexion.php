<?php
class Conexion
{
    /**
     * Realiza la conexión a la base de datos
     * @return PDO
     */
    static public function conectar()
    {
        $conexion = "mysql:host=localhost;dbname=sispven";
        $usuario = "root";
        $password = "root";
        $link = new PDO($conexion, $usuario, $password);

        /*
        $link->exec("set names utf-8");
        */

        return $link;
    }
}
?>