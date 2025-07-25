<?php

include_once 'pooConexion.php';

class Bodegas{

    public static function obtenerBodegas(){

        $consulta = Conexion::conectar()->prepare("SELECT
            IdUbicacion,
            Nombre
            FROM Ubicaciones
            ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}