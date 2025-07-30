<?php
include_once('../php/auth.php');
include_once 'pooTelefonos.php';
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
                <span>Tabla Teléfonos</span>
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
                        <li><a href="./vistaTablaComputadores.php" class="app-sidebar__link">Computadores</a></li>
                        <li><a href="./vistaTablaImpresoras.php" class="app-sidebar__link">Impresoras</a></li>
                        <li><a href="#" class="app-sidebar__link">Otros</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="app-main">
                <h1 class="app-main__title">Listado de Teléfonos</h1>
                <div class="app-main__actions">
                    <a href="vistaNuevoTelefono.php" class="button button--success">+ Ingresar Nuevo Teléfono</a>
                    <a href="#" class="button button--excel">&#128202; Generar Excel</a>
                </div>
                <div class="table-container">
                    <table class="main-table" id="inventoryTable">
                        <thead>
                            <tr>
                                <th>PlacaTeléfono</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Serial</th>
                                <th>TipoTeléfono</th>
                                <th>IP</th>
                                <th>MAC</th>
                                <th>FechaCompra</th>
                                <th>Estado</th>
                                <th>Precio</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Llamada al método para obtener los datos de los Telefonos
                            $consulta = Telefonos::mostrarTotalTelefonos();
                            foreach ($consulta as $Telefono): ?>
                            <tr>
                                <td><?php echo $Telefono['PlacaTelefono']; ?></td>
                                <td><?php echo $Telefono['MarcaTelefono']; ?></td>
                                <td><?php echo $Telefono['ModeloTelefono']; ?></td>
                                <td><?php echo $Telefono['Serial']; ?></td>
                                <td><?php echo $Telefono['TipoTelefono']; ?></td>
                                <td><?php echo $Telefono['IpTelefono']; ?></td>
                                <td><?php echo $Telefono['Mac']; ?></td>
                                <td><?php echo $Telefono['FechaCompra']; ?></td>
                                <td><?php echo $Telefono['EstadoTelefono']; ?></td>
                                <td><?php echo $Telefono['Precio']; ?></td>
                                <td><?php echo $Telefono['Notas']; ?></td>
                                <td>
                                    <a href="vistaEditarComputador.php?id=<?php echo $computador['PlacaTelefono']; ?>" class="button--edit">Editar</a>
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