<?php
include_once('clases_computadores.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    if ($id > 0) {
        $resultado = Computadores::eliminarMantenimiento($id);
        if ($resultado === true) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $resultado]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
