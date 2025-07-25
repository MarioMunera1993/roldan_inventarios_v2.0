<?php

include_once 'pooConexion.php';

class Tipos{
    public static function obtenerTipos(){
        $consulta = Conexion::conectar()->prepare("SELECT
            IdTipo,
            Nombre
            FROM Tipos
            ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}