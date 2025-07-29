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

    public static function agregarModelo($IdMarca, $NombreModelo){

        try{

            $conn = Conexion::conectar();
            $conn->beginTransaction();
        
            $stmt = $conn->prepare("INSERT INTO Modelos (
                                IdMarca,
                                NombreModelo) 
                                VALUES (?, ?)");
            $stmt->execute([$IdMarca, $NombreModelo ]);
            $conn->commit();
            return true;

        }catch (Exception $e) {
            if (isset($conn)) $conn->rollBack();
            return 'Error al guardar: ' . $e->getMessage();
        }

    }
}
