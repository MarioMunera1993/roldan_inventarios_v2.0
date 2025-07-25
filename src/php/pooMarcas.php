<?php

include_once 'pooConexion.php';

class Marcas {
    public static function obtenerMarcas() {
        $consulta = Conexion::conectar()->prepare("SELECT
                     IdMarca,
                     Nombre
                     FROM Marcas
                     ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
