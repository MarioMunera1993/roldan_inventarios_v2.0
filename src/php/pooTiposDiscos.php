<?php

include_once 'pooConexion.php';

class TiposDiscos{
    public static function obtenerTiposDiscos(){
        $consulta = Conexion::conectar()->prepare("SELECT
            IdTipoDisco,
            NombreTipo
            FROM TiposDisco
            ORDER BY NombreTipo ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

}