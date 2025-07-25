<?php

include_once 'pooConexion.php';

class SistemasOperativos {
    public static function obtenerSistemasOperativos() {
        $consulta = Conexion::conectar()->prepare("SELECT
                     IdSistemaOperativo,
                     Nombre
                     FROM SistemaOperativo
                     ORDER BY Nombre ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}