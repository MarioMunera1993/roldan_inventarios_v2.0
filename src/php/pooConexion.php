<?php

class Conexion{

    public static function conectar(){
        $servername = "localhost";
        $username = "groldan";
        $password = "groldan2026*";
        //$dbname = "inventario_tecnologico_prueba";
        $dbname = "inventario_tecnologico";

        try {
            $conn = new PDO("sqlsrv:server=$servername;Database=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Mejor manejo: lanzar excepción para que el error se capture arriba
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
        return $conn;
    }
}

?>