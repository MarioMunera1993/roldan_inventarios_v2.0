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
  <link rel="stylesheet" href="../css/vistaNuevoComputador.css">
</head>
<body>
  <div class="app-container">
    <header class="app-header">
      <div class="app-header__logo">
        <img src="../assest/img/logo.png" alt="Logo Empresa" />
        <span>Ingresar Nuevo Modelo</span>
      </div>
    </header>
    <div class="app-body">
      <aside class="app-sidebar" id="appSidebar">
        <nav class="app-sidebar__nav">
          <ul>
            <li><a href="./home.php" class="app-sidebar__link">Inicio</a></li>
            <li><a href="./vistaTablaTelefonos.php" class="app-sidebar__link">Volver a la tabla</a></li>
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