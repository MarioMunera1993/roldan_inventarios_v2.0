<?php

include_once 'pooComputadores.php';

class GeneracionRam{
    public static function obtenerGeneracionRam() {
        $consulta = Conexion::conectar()->prepare("SELECT
                     IdGeneracionRam,
                     GeneracionRam
                     FROM genRam
                     ORDER BY GeneracionRam ASC;");

        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}