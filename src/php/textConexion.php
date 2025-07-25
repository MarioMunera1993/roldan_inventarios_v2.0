<?php
require_once 'pooConexion.php';

$conexion = Conexion::conectar();
if ($conexion) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error al conectar a la base de datos.";
}