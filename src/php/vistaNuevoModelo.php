<?php
include_once('../php/auth.php');
include_once 'pooMarcas.php';
include_once 'pooModelos.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IdMarca = $_POST['IdMarca'];
    $NombreModelo = trim($_POST['NombreModelo']);
    $resultado = Modelos::agregarModelo($IdMarca, $NombreModelo);
    if ($resultado === true) {
        $msg = '<script>alert("Modelo agregado correctamente."); window.location.href = "vistaNuevoTelefono.php";</script>';
    } else {
        $msg = '<script>alert("' . addslashes($resultado) . '"); window.history.back();</script>';
    }
    echo $msg;
    exit();
}
$marcas = Marcas::obtenerMarcas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ingresar Nuevo Modelo</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/ingresar_nuevo_computador.css" />
</head>
<body>
  <div class="app-container">
    <header class="app-header">
      <div class="app-header__logo">
        <img src="../assest/images/logo.png" alt="Logo Empresa" />
        <span>Ingresar Nuevo Modelo</span>
      </div>
    </header>
    <div class="app-body">
      <aside class="app-sidebar" id="appSidebar">
        <nav class="app-sidebar__nav">
          <ul>
            <li><a href="../index.html" class="app-sidebar__link">Inicio</a></li>
            <li><a href="tabla_computadores.php" class="app-sidebar__link">Volver a la tabla</a></li>
          </ul>
        </nav>
      </aside>
      <main class="app-main">
        <h1 class="app-main__title">Ingresar Nuevo Modelo</h1>
        <section class="form-section">
          <form class="data-form" method="POST" action="">
            <div class="form-grid">
              <div class="form-group">
                <label for="IdMarca" class="form-label">Marca:</label>
                <select name="IdMarca" id="IdMarca" class="form-select" required>
                  <option value="">Seleccione Marca</option>
                  <?php foreach ($marcas as $marca): ?>
                    <option value="<?php echo $marca['IdMarca']; ?>"><?php echo htmlspecialchars($marca['Nombre']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="NombreModelo" class="form-label">Nombre del Modelo:</label>
                <input type="text" name="NombreModelo" id="NombreModelo" class="form-input" required />
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="button button--success">Guardar Modelo</button>
              <a href="tabla_computadores.php" class="button button--secondary">Cancelar</a>
            </div>
          </form>
        </section>
      </main>
    </div>
    <footer class="app-footer">
      <p>© <span id="currentYear"></span> Grupo Roldan. Todos los derechos reservados.</p>
    </footer>
  </div>
  <script src="../js/menuHamburguesa.js"></script>
  <script src="../js/selecionarAño.js"></script>
</body>
</html>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario - Informático</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/vistaNuevoComputador.css">
    <script src="../js/formNuevoTelefono.js"></script>
</head>

<body>
    <!--Aquí comienza todo el proyecto. El contenedor principal es app-container -->
    <div class="app-container">

        <!--Encabezado-->
        <header class="app-header">
            <button class="hamburger" id="hamburgerBtn" aria-label="Abrir menú">&#9776;</button>
            <div class="app-header__logo">
                <img src="../assest/img/logo.png" alt="Logo Roldán">
                <span>nuevoTelefono</span>
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
                        <li><a href="../pages/home.html" class="app-sidebar__link">Inicio</a></li>
                        <li><a href="#" class="app-sidebar__link">.</a></li>
                        <li><a href="#" class="app-sidebar__link">.</a></li>
                        <li><a href="#" class="app-sidebar__link">.</a></li>
                        <li><a href="#" class="app-sidebar__link">.</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="app-main">
                <h1 class="app-main__title">Ingreso Nuevo Teléfono</h1>
                <section class="form-section" id="formNuevoComputador">
                    <form class="data-form" id="formComputador" action="getNuevoTelefono.php" method="POST">
                        <div class="form-grid">
                            <!-- Fila 1 -->
                            <div class="form-group">
                                <label for="PlacaTelefono" class="form-label">Placa del Teléfono</label>
                                <input type="text" id="PlacaTelefono" name="PlacaTelefono" class="form-input"
                                    required>
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

                            <div class="form-group">
                                <label for="IdTipo" class="form-label">Tipo Telefono:</label>
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
                                <label for="ipTelefono" class="form-label">Ip Telefono:</label>
                                <input type="text" id="ipTelefono" name="ipTelefono" class="form-input"
                                    placeholder="192.168.20.2" />
                            </div>

                            <div class="form-group">
                                <label for="Mac" class="form-label">MAC:</label>
                                <input type="text" id="Mac" name="Mac" class="form-input"
                                    placeholder="AA-BB-CC-DD-EE-FF" />
                            </div>

                            <div class="form-group">
                                <label for="fechaCompra" class="form-label">Fecha Compra:</label>
                                <input type="date" id="fechaCompra" name="FechaCompra" class="form-input" required />
                            </div>

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
                                <label for="Precio" class="form-label">Precio</label>
                                <input type="text" id="Precio" name="Precio" class="form-input"
                                    required>
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
                                    Guardar Telefono
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
    
</body>

</html>