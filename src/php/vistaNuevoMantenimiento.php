<?php
// vista_mantenimiento_computador.php
include_once('../php/auth.php');
include_once('pooComputadores.php');

// --- Configuración de validación de archivos ---
$maxFileSize = 5 * 1024 * 1024; // 5MB
$allowedTypes = [
    'application/pdf',
    'image/jpeg',
    'image/png',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
];

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IdComputador = $_POST['IdComputador'];
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
        $resultado = Computadores::guardarMantenimiento($IdComputador, $Descripcion, $Fecha, $archivo);
        if ($resultado === true) {
            $msg = '<div class="alert-success">Mantenimiento guardado correctamente.</div>';
        } else {
            $msg = '<div class="alert-error">' . htmlspecialchars($resultado) . '</div>';
        }
    }
}
// Obtener computadores para el select
$computadores = Computadores::mostrarTotalComputadores();
// Obtener mantenimientos para visualización
$mantenimientos = Computadores::listarMantenimientos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrar Mantenimiento</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/vistaNuevoComputador.css" />
  <link rel="stylesheet" href="../css/vistaNuevoMantenimiento.css" />
</head>
<body>
  <div class="app-container">
    <header class="app-header">
      <div class="app-header__logo">
        <img src="../assest/img/logo.png" alt="Logo Empresa" />
        <span>Registrar Mantenimiento</span>
      </div>
      <div style="position:absolute;top:1rem;right:2rem;">
        <a href="logout.php" class="button button--danger" style="background:#e74c3c;color:#fff;padding:0.5rem 1rem;border-radius:4px;text-decoration:none;font-weight:bold;">Cerrar sesión</a>
      </div>
    </header>
    <div class="app-body">
      <aside class="app-sidebar" id="appSidebar">
        <nav class="app-sidebar__nav">
          <ul>
            <li><a href="../pages/home.html" class="app-sidebar__link">Inicio</a></li>
            <li><a href="vistaTablaComputadores.php" class="app-sidebar__link">Volver a la tabla computadores</a></li>
          </ul>
        </nav>
      </aside>
      <main class="app-main">
        <h1 class="app-main__title">Registrar Mantenimiento de Computador</h1>
        <?php echo $msg; ?>
        <section class="form-section">
          <form class="data-form" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
              <div class="form-group">
                <label for="IdComputador" class="form-label">Computador:</label>
                <select name="IdComputador" id="IdComputador" class="form-select" required>
                  <option value="">Seleccione Computador</option>
                  <?php foreach ($computadores as $c): ?>
                    <option value="<?php echo htmlspecialchars($c['IdComputador']); ?>">Placa: <?php echo htmlspecialchars($c['PlacaComputador']); ?> | Serial: <?php echo htmlspecialchars($c['SerialNumber']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="Descripcion" class="form-label">Descripción del Mantenimiento:</label>
                <textarea name="Descripcion" id="Descripcion" class="form-textarea" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="Fecha" class="form-label">Fecha:</label>
                <input type="date" name="Fecha" id="Fecha" class="form-input" required />
              </div>
              <div class="form-group">
                <label for="ArchivoAdjunto" class="form-label">Archivo Adjunto (opcional):</label>
                <input type="file" name="ArchivoAdjunto" id="ArchivoAdjunto" class="form-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="button button--success">Guardar Mantenimiento</button>
              <a href="vistaTablaComputadores.php" class="button button--secondary">Cancelar</a>
            </div>
          </form>
        </section>
        <section>
          <h2 style="margin-top:2rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;">
            <span>Historial de Mantenimientos</span>
            <input type="search" id="searchMantInput" class="form-input" placeholder="Buscar mantenimiento..." style="min-width:220px;max-width:320px;">
          </h2>
          <table class="table-mant" id="mantTable">
            <thead>
              <tr>
                <th>Placa</th>
                <th>Serial</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Archivo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($mantenimientos as $m): ?>
                <tr>
                  <td><?php echo htmlspecialchars($m['PlacaComputador']); ?></td>
                  <td><?php echo htmlspecialchars($m['SerialNumber']); ?></td>
                  <td><?php echo htmlspecialchars($m['Descripcion']); ?></td>
                  <td><?php echo htmlspecialchars($m['Fecha']); ?></td>
                  <td>
                    <?php if ($m['ArchivoAdjunto']): ?>
                      <a href="<?php echo htmlspecialchars($m['ArchivoAdjunto']); ?>" target="_blank">Descargar</a>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="vistaEditarMantenimiento.php?id=<?php echo $m['IdMantenimiento']; ?>" class="button button--edit" style="padding:0.3rem 0.8rem;font-size:0.95rem;">Editar</a>
                    <button type="button" class="button button--danger btn-eliminar-mant" data-id="<?php echo $m['IdMantenimiento']; ?>" style="padding:0.3rem 0.8rem;font-size:0.95rem;margin-left:0.5rem;">Eliminar</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </section>
      </main>
    </div>
    <footer class="app-footer">
      <p>© <span id="currentYear"></span> Grupo Roldan. Todos los derechos reservados.</p>
    </footer>
  </div>
  <script src="../js/selecionarAño.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/vistaNuevoMantenimiento.js"></script>
</body>
</html>