<?php
include_once('../php/auth.php');
include_once('pooComputadores.php');

$maxFileSize = 5 * 1024 * 1024; // 5MB
$allowedTypes = [
    'application/pdf',
    'image/jpeg',
    'image/png',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
];

$msg = '';
if (!isset($_GET['id'])) {
    die('ID de mantenimiento no especificado.');
}
$id = intval($_GET['id']);
$mantenimiento = Computadores::obtenerMantenimientoPorId($id);
if (!$mantenimiento) {
    die('Mantenimiento no encontrado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Descripcion = htmlspecialchars($_POST['Descripcion']);
    $Fecha = $_POST['Fecha'];
    $archivo = $_FILES['ArchivoAdjunto'] ?? null;
    // Validación de archivo
    if ($archivo && $archivo['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($archivo['size'] > $maxFileSize) {
            $msg = '<div class="alert-error">El archivo es demasiado grande. Máximo 5MB.</div>';
        } elseif (!in_array($archivo['type'], $allowedTypes)) {
            $msg = '<div class="alert-error">Tipo de archivo no permitido.</div>';
        }
    }
    if (!$msg) {
        $resultado = Computadores::editarMantenimiento($id, $Descripcion, $Fecha, $archivo);
        if ($resultado === true) {
            $msg = '<div class="alert-success">Mantenimiento actualizado correctamente.</div>';
            // Refrescar datos
            $mantenimiento = Computadores::obtenerMantenimientoPorId($id);
        } else {
            $msg = '<div class="alert-error">' . htmlspecialchars($resultado) . '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Mantenimiento</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/vistaNuevoComputador.css" />
  <style>
    .alert-success { color: #2ecc71; font-weight: bold; margin-bottom: 1rem; }
    .alert-error { color: #e74c3c; font-weight: bold; margin-bottom: 1rem; }
  </style>
</head>
<body>
  <div class="app-container">
    <header class="app-header">
      <div class="app-header__logo">
        <img src="../assest/images/logo.png" alt="Logo Empresa" />
        <span>Editar Mantenimiento</span>
      </div>
      <div style="position:absolute;top:1rem;right:2rem;">
        <a href="logout.php" class="button button--danger" style="background:#e74c3c;color:#fff;padding:0.5rem 1rem;border-radius:4px;text-decoration:none;font-weight:bold;">Cerrar sesión</a>
      </div>
    </header>
    <div class="app-body">
      <aside class="app-sidebar" id="appSidebar">
        <nav class="app-sidebar__nav">
          <ul>
            <li><a href="../index.html" class="app-sidebar__link">Inicio</a></li>
            <li><a href="vistaNuevoMantenimiento.php" class="app-sidebar__link">Volver a mantenimientos</a></li>
          </ul>
        </nav>
      </aside>
      <main class="app-main">
        <h1 class="app-main__title">Editar Mantenimiento</h1>
        <?php echo $msg; ?>
        <section class="form-section">
          <form class="data-form" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Computador:</label>
                <input type="text" class="form-input" value="Placa: <?php echo htmlspecialchars($mantenimiento['PlacaComputador']); ?> | Serial: <?php echo htmlspecialchars($mantenimiento['SerialNumber']); ?>" disabled />
              </div>
              <div class="form-group">
                <label for="Descripcion" class="form-label">Descripción del Mantenimiento:</label>
                <textarea name="Descripcion" id="Descripcion" class="form-textarea" rows="3" required><?php echo htmlspecialchars($mantenimiento['Descripcion']); ?></textarea>
              </div>
              <div class="form-group">
                <label for="Fecha" class="form-label">Fecha:</label>
                <input type="date" name="Fecha" id="Fecha" class="form-input" value="<?php echo htmlspecialchars($mantenimiento['Fecha']); ?>" required />
              </div>
              <div class="form-group">
                <label for="ArchivoAdjunto" class="form-label">Archivo Adjunto (opcional):</label>
                <?php if ($mantenimiento['ArchivoAdjunto']): ?>
                  <div style="margin-bottom:0.5rem;">
                    <a href="<?php echo htmlspecialchars($mantenimiento['ArchivoAdjunto']); ?>" target="_blank">Archivo actual</a>
                  </div>
                <?php endif; ?>
                <input type="file" name="ArchivoAdjunto" id="ArchivoAdjunto" class="form-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="button button--success">Actualizar Mantenimiento</button>
              <a href="vistaNuevoMantenimiento.php" class="button button--secondary">Cancelar</a>
            </div>
          </form>
        </section>
      </main>
    </div>
    <footer class="app-footer">
      <p>© <span id="currentYear"></span> Grupo Roldan. Todos los derechos reservados.</p>
    </footer>
  </div>
  <script src="../js/main.js"></script>
</body>
</html>