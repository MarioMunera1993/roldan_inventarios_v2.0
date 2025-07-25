<?php

include_once 'pooConexion.php';

class Modelos {
    public static function obtenerModelos() {
        $consulta = Conexion::conectar()->prepare("SELECT
                     IdModelo,
                     NombreModelo
                     FROM Modelos
                     ORDER BY NombreModelo ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerModelosPorMarca($idMarca) {
        $consulta = Conexion::conectar()->prepare("SELECT
                     IdModelo,
                     NombreModelo
                     FROM Modelos
                     WHERE IdMarca = :idMarca
                     ORDER BY NombreModelo ASC;");
        
        $consulta->bindParam(":idMarca", $idMarca, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
