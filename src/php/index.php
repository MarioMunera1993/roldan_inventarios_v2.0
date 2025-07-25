<?php
// login.php
// Formulario y lógica de inicio de sesión de usuario
session_start();
include_once('./pooConexion.php');

$msg = '';
// Procesa el formulario de login si se envió por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? ''); // Usuario ingresado
    $password = $_POST['password'] ?? '';     // Contraseña ingresada
    if ($usuario && $password) {
        // Guardar la preferencia de base de datos ANTES de conectar
        $conn = Conexion::Conectar();
        // Busca el usuario en la base de datos
        $stmt = $conn->prepare("SELECT IdUsuario, Usuario, PasswordHash FROM Usuarios WHERE Usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();
        // Verifica el hash de la contraseña
        if ($user && password_verify($password, $user['PasswordHash'])) {
            $_SESSION['usuario'] = $user['Usuario'];
            $_SESSION['id_usuario'] = $user['IdUsuario'];
            header('Location: ./home.php'); // Redirige al inicio
            exit();
        } else {
            $msg = '<div class="alert-error">Usuario o contraseña incorrectos.</div>';
        }
    } else {
        $msg = '<div class="alert-error">Ingrese usuario y contraseña.</div>';
    }
}