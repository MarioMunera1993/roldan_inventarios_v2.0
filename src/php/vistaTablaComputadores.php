<?php
include_once('../php/auth.php');
include_once 'pooComputadores.php';
?>
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
            <button class="hamburger" id="hamburgerBtn" aria-label="Abrir menú">&#9776;</button>
            <div class="app-header__logo">
                <img src="../assest/img/logo.png" alt="Logo Roldán">
                <span>Tabla Computadores</span>
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
                        <li><a href="./vistaTablaUsuarios.php" class="app-sidebar__link">Usuarios</a></li>
                        <li><a href="./vistaTablaTelefonos.php" class="app-sidebar__link">Teléfonos</a></li>
                        <li><a href="./vistaTablaImpresoras.php" class="app-sidebar__link">Impresoras</a></li>
                        <li><a href="#" class="app-sidebar__link">Otros</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="app-main">
                <h1 class="app-main__title">Listado de Computadores</h1>
                <div class="app-main__actions">
                    <a href="./vistaNuevoComputador.php" class="button button--success">+ Ingresar Nuevo Computador</a>
                    <a href="#" class="button button--excel">&#128202; Generar Excel</a>
                </div>
                <div class="table-container">
                    <table class="main-table" id="inventoryTable">
                        <thead>
                            <tr>
                                <th>PlacaComputador</th>
                                <th>NumeroSerial</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>SistemaOperativo</th>
                                <th>TipoEquipo</th>
                                <th>Procesador</th>
                                <th>GenRAM</th>
                                <th>RAM (GB)</th>
                                <th>DiscosDetalle</th>
                                <th>MAC Local</th>
                                <th>MAC Wifi</th>
                                <th>Estado</th>
                                <th>Bodega</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Llamada al método para obtener los datos de los computadores
                            $consulta = Computadores::mostrarTotalComputadores();
                            foreach ($consulta as $computador): ?>
                            <tr>
                                <td><?php echo $computador['PlacaComputador']; ?></td>
                                <td><?php echo $computador['SerialNumber']; ?></td>
                                <td><?php echo $computador['marca']; ?></td>
                                <td><?php echo $computador['modelo']; ?></td>
                                <td><?php echo $computador['sistemaOperativo']; ?></td>
                                <td><?php echo $computador['tipoEquipo']; ?></td>
                                <td><?php echo $computador['Procesador']; ?></td>
                                <td><?php echo $computador['genRam']; ?></td>
                                <td><?php echo $computador['ramGb']; ?></td>
                                <td><?php echo $computador['DiscosDetalle']; ?></td>
                                <td><?php echo $computador['MacLocal']; ?></td>
                                <td><?php echo $computador['MacWifi']; ?></td>
                                <td><?php echo $computador['estado']; ?></td>
                                <td><?php echo $computador['Bodega']; ?></td>
                                <td><?php echo $computador['Observaciones']; ?></td>
                                <td>
                                    <a href="vistaEditarComputador.php?id=<?php echo $computador['PlacaComputador']; ?>" class="button--edit">Editar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
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
    <script src="../js/tablaComputadores.js"></script>
    <script src="../js/descargaExcelComputadores.js"></script>
    <script src="../js/menuHamburguesa.js"></script>
</body>
</html>