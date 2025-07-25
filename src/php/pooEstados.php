<?php

include_once 'pooConexion.php';

class Estados{

    public static function obtenerEstados(){

        $consulta = Conexion::conectar()->prepare("SELECT
            IdEstado,
            Nombre
            FROM Estados
            ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}