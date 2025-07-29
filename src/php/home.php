<?php include_once('./auth.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario - Informático</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <!--Aquí comienza todo el proyecto. El contenedor principal es app-container -->
    <div class="app-container">

        <!--Encabezado-->
        <header class="app-header">
            <div class="app-header__logo">
                <img src="../assest/img/logo.png" alt="Logo Roldán">
                <span>Gestor de Inventario</span>
                <div class="app-header__search">
                    <a href="./logout.php" class="button--danger">Cerrar sesión</a>
                </div>
            </div>
        </header>

        <!--Cuerpo de la aplicación-->
        <div class="app-body">
            <aside class="app-sidebar" id="appSidebar">
                <nav class="app-sidebar__nav">
                    <ul>
                        <li><a href="./vistaTablaComputadores.php" class="app-sidebar__link">Computadores</a></li>
                        <li><a href="./vistaTablaUsuarios.php" class="app-sidebar__link">Usuarios</a></li>
                        <li><a href="./vistaTablaTelefonos.php" class="app-sidebar__link">Teléfonos</a></li>
                        <li><a href="./vistaTablaImpresoras.php" class="app-sidebar__link">Impresoras</a></li>
                        <li><a href="#" class="app-sidebar__link">Otros</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="app-main">
                <h1>Nuevas Funcionalidades</h1>
                <p>Ya deja agregar teléfonos </p>
                <p>Toda la funcionalidad de Equipos esta ok </p>
                <h2>Pendientes</h2>
                <p>Agregar función de editar teléfonos</p>
                <p>Agregar función de descargar archivos de Excel para los teléfonos</p>
                <p>Revisar funcionalidad de javaScrip(Ajax) para realizar filtrado en tiempo real</p>
            </main>
        </div>

        <!--Pie de página-->
        <footer class="app-footer">
            <p>© <span id="currentYear"></span> Grupo Roldán. Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="../js/selecionarAño.js"></script>
</body>
</html>