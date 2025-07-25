<?php
include_once 'pooModelos.php';

if(isset($_POST['idMarca'])) {
    $idMarca = $_POST['idMarca'];
    $modelos = Modelos::obtenerModelosPorMarca($idMarca);
    echo json_encode($modelos);
} else {
    echo json_encode([]);
}
?>
