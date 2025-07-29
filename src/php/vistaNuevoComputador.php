<?php
include_once('../php/auth.php');
include_once 'pooComputadores.php';
include_once 'pooMarcas.php';
include_once 'pooModelos.php';
include_once 'pooSistemasOperativos.php';
include_once 'pooGenRam.php';
include_once 'pooTiposDispositivos.php';
include_once 'pooTiposDiscos.php';
include_once 'pooEstados.php';
include_once 'pooUbicaciones.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario - Informático</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/vistaNuevoComputador.css">
    <script src="../js/formNuevoComputador.js"></script>
</head>

<body>
    <!--Aquí comienza todo el proyecto. El contenedor principal es app-container -->
    <div class="app-container">

        <!--Encabezado-->
        <header class="app-header">
            <button class="hamburger" id="hamburgerBtn" aria-label="Abrir menú">&#9776;</button>
            <div class="app-header__logo">
                <img src="../assest/img/logo.png" alt="Logo Roldán">
                <span>GetComputadores</span>
                <div class="app-header__search">
                    <a href="#" class="button--danger">Cerrar sesión</a>
                </div>
            </div>
        </header>

        <!--Cuerpo de la aplicación-->
        <div class="app-body">
            <aside class="app-sidebar" id="appSidebar">
                <nav class="app-sidebar__nav">
                    <ul>
                        <li><a href="./home.php" class="app-sidebar__link">Inicio</a></li>
                        <li><a href="vistaNuevoMantenimiento.php" class="app-sidebar__link">Ingresar Mantenimiento</a></li>
                        <li><a href="#" class="app-sidebar__link">.</a></li>
                        <li><a href="#" class="app-sidebar__link">.</a></li>
                        <li><a href="#" class="app-sidebar__link">.</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="app-main">
                <h1 class="app-main__title">Ingreso Nuevo Computador</h1>
                <section class="form-section" id="formNuevoComputador">
                    <form class="data-form" id="formComputador" action="getNuevoComputador.php" method="POST">
                        <div class="form-grid">
                            <!-- Fila 1 -->
                            <div class="form-group">
                                <label for="PlacaComputador" class="form-label">Placa del Computador</label>
                                <input type="text" id="PlacaComputador" name="PlacaComputador" class="form-input"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="SerialNumber" class="form-label">Número de Serie</label>
                                <input type="text" id="SerialNumber" name="SerialNumber" class="form-input" required>
                            </div>

                            <div class="form-group">
                                <label for="IdMarca" class="form-label">Marca</label>
                                <select name="IdMarca" id="IdMarca" class="form-input" required>
                                    <option value="">Seleccione una marca</option>
                                    <?php
                                    // Llenar el select con las marcas disponibles
                                    $marcas = Marcas::obtenerMarcas();
                                    foreach ($marcas as $marca): ?>
                                    <option value="<?php echo $marca['IdMarca']; ?>">
                                        <?php echo $marca['Nombre']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="IdModelo" class="form-label">Modelo</label>
                                <select name="IdModelo" id="IdModelo" class="form-input" required>
                                    <option value="">Seleccione un modelo</option>
                                    <?php
                                    // Llenar el select con los modelos disponibles
                                    $modelos = Modelos::obtenerModelos();
                                    foreach ($modelos as $modelo): ?>
                                    <option value="<?php echo $modelo['IdModelo']; ?>">
                                        <?php echo $modelo['NombreModelo']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Fila 3 -->
                            <div class="form-group">
                                <label for="IdSistemaOperativo" class="form-label">Sistema Operativo</label>
                                <select name="IdSistemaOperativo" id="IdSistemaOperativo" class="form-input" required>
                                    <option value="">Seleccione un sistema operativo</option>
                                    <?php
                                    // Llenar el select con los sistemas operativos disponibles
                                    $sistemasOperativos = SistemasOperativos::obtenerSistemasOperativos();
                                    foreach ($sistemasOperativos as $sistema): ?>
                                    <option value="<?php echo $sistema['IdSistemaOperativo']; ?>">
                                        <?php echo $sistema['Nombre']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Fila 4 -->
                            <div class="form-group">
                                <label for="procesador" class="form-label">Procesador:</label>
                                <input type="text" id="procesador" name="Procesador" class="form-input"
                                    placeholder="Ej: Intel i7 12Gen 1.5Ghz" />
                            </div>

                            <div class="form-group">
                                <label for="genRam" class="form-label">Generación RAM:</label>
                                <select class="form-input" name="GeneracionRam" id="generacionRam">
                                    <option value="">Seleccione Generacion</option>
                                    <?php
                                    // Llenar el select con las generaciones de RAM disponibles
                                    $generacionesRam = GeneracionRam::obtenerGeneracionRam();
                                    $consulta = $generacionesRam;
                                    foreach ($consulta as $fila): ?>
                                    <option value="<?php echo $fila['IdGeneracionRam']; ?>">
                                        <?php echo $fila['GeneracionRam'];  ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Fila 5 -->
                            <div class="form-group">
                                <label for="memoriaRam" class="form-label">Memoria RAM (GB):</label>
                                <input type="number" id="memoriaRam" name="MemoriaRAM" class="form-input" min="1"
                                    placeholder="Ej: 32"/>
                            </div>
                            <div class="form-group">
                                <label for="IdTipo" class="form-label">Tipo Dispositivo:</label>
                                <select class="form-input" name="IdTipo" id="IdTipo">
                                    <option value="">Seleccione Tipo</option>
                                    <?php
                                    // Llenar el select con los tipos disponibles
                                    $tipos = Tipos::obtenerTipos();
                                    foreach ($tipos as $tipo): 
                                    ?>
                                    <option value="<?php echo $tipo['IdTipo']; ?>">
                                        <?php echo $tipo['Nombre'];  ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fechaCompra" class="form-label">Fecha Compra:</label>
                                <input type="date" id="fechaCompra" name="FechaCompra" class="form-input" required />
                            </div>

                            <!-- Sección Discos -->
                            <fieldset class="form-fieldset form-grid__span-2">
                                <legend class="form-legend">Almacenamiento</legend>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="discoDuro1" class="form-label">Marca Disco 1:</label>
                                        <input type="text" id="MarcaDisco1" name="MarcaDisco1" class="form-input"
                                            placeholder="Ej: Westwer Digital" />
                                    </div>

                                    <div class="form-group">
                                        <label for="discoDuro1" class="form-label">Capacidad Disco1:</label>
                                        <input type="text" id="CapacidadDisco1" name="CapacidadDisco1"
                                            class="form-input" placeholder="Ej: 512, 1000" />
                                    </div>


                                    <div class="form-group">
                                        <label for="TipoDisco1" class="form-label">Tipo Disco 1:</label>
                                        <select name="TipoDisco1" id="TipoDisco1" class="form-input" required>
                                            <option value="">Seleccione Tipo Disco</option>
                                            <?php
                                            // Llenar el select con los tipos de disco disponibles
                                            $discos = TiposDiscos::obtenerTiposDiscos();
                                            foreach ($discos as $disco): ?>
                                            <option value="<?php echo $disco['IdTipoDisco']; ?>">
                                                <?php echo $disco['NombreTipo']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="discoDuro2" class="form-label">Marca Disco2(Opcional):</label>
                                        <input type="text" id="MarcaDisco2" name="MarcaDisco2" class="form-input"
                                            placeholder="Ej: Westwer Digital" />
                                    </div>

                                    <div class="form-group">
                                        <label for="discoDuro2" class="form-label">capacidad Disco 2(Opcional):</label>
                                        <input type="text" id="CapacidadDisco2" name="CapacidadDisco2"
                                            class="form-input" placeholder="Ej: 500" />
                                    </div>

                                    <div class="form-group">
                                        <label for="TipoDisco2" class="form-label">Tipo Disco 2:</label>
                                        <select name="TipoDisco2" id="TipoDisco2" class="form-input">
                                            <option value="">Seleccione Tipo Disco</option>
                                            <?php
                                            // Llenar el select con los tipos de disco disponibles
                                            $discos = TiposDiscos::obtenerTiposDiscos();
                                            foreach ($discos as $disco): ?>
                                            <option value="<?php echo $disco['IdTipoDisco']; ?>">
                                                <?php echo $disco['NombreTipo']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Fila Conectividad -->
                            <div class="form-group">
                                <label for="macLocal" class="form-label">MAC Local (Ethernet):</label>
                                <input type="text" id="macLocal" name="MacLocal" class="form-input"
                                    placeholder="00-1A-2B-3C-4D-5E" />
                            </div>
                            <div class="form-group">
                                <label for="macWifi" class="form-label">MAC Wifi:</label>
                                <input type="text" id="macWifi" name="MacWifi" class="form-input"
                                    placeholder="AA-BB-CC-DD-EE-FF" />
                            </div>

                            <!-- Fila Estado y Ubicación -->
                            <div class="form-group">
                                <label for="idEstado" class="form-label">Estado:</label>
                                <select name="IdEstado" id="idEstado" class="form-input" required>
                                    <option value="">Seleccione un Estado</option>
                                    <?php
                                    // Llenar el select con los estados disponibles
                                    $estados = Estados::obtenerEstados();
                                    foreach ($estados as $estado): ?>
                                    <option value="<?php echo $estado['IdEstado']; ?>">
                                        <?php echo $estado['Nombre']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="IdUbicacion" class="form-label">Ubicación/Bodega:</label>
                                <select name="IdUbicacion" id="IdUbicacion" class="form-input" required>
                                    <option value="">Seleccione Ubicación</option>
                                    <?php
                                    $bodegas = Bodegas::obtenerBodegas();
                                    foreach ($bodegas as $bodega):
                                    ?>
                                    <option value="<?php echo $bodega['IdUbicacion'] ?>"><?php echo $bodega['Nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Observaciones -->
                            <div class="form-group form-grid__span-2">
                                <label for="observaciones" class="form-label">Observaciones:</label>
                                <textarea id="observaciones" name="Observaciones" class="form-textarea"
                                    rows="4"></textarea>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="button button--success">
                                    Guardar Computador
                                </button>
                                <button type="button" class="button button--secondary" id="btnCancelarNuevoComputador">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
            </main>
        </div>

        <!--Pie de página-->
        <footer class="app-footer">
            <p>© <span id="currentYear"></span> Grupo Roldán. Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="../js/menuHamburguesa.js"></script>
    <script src="../js/selecionarAño.js"></script>
</body>

</html>