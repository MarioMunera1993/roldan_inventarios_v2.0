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
                <span>Tabla Usuarios</span>
                <div class="app-header__search">
                    <input type="search" id="searchInput" class="form-input" placeholder="Buscar computador..." style="min-width:220px;">
                    <a href="logout.php" class="button--danger">Cerrar sesión</a>
                </div>
            </div>
        </header>

        <!--Cuerpo de la aplicación-->
        <div class="app-body">
            <aside class="app-sidebar" id="appSidebar">
                <nav class="app-sidebar__nav">
                    <ul>
                        <li><a href="./home.php" class="app-sidebar__link">Inicio</a></li>
                        <li><a href="./vistaTablaComputadores.php" class="app-sidebar__link">Computadores</a></li>
                        <li><a href="./vistaTablaTelefonos.php" class="app-sidebar__link">Telefonos</a></li>
                        <li><a href="./vistaTablaImpresoras.php" class="app-sidebar__link">Impresoras</a></li>
                        <li><a href="#" class="app-sidebar__link">Otros</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="app-main">
                <h1 class="app-main__title">Listado de Usuarios</h1>
                <div class="app-main__actions">
                    <a href="#" class="button button--success">+ Ingresar Nuevo Usuario</a>
                    <a href="#" class="button button--excel">&#128202; Generar Excel</a>
                </div>
                <div class="table-container">
                    <table class="main-table" id="inventoryTable">
                        <thead>
                            <tr>
                                <th>...</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
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