<?php

include_once 'pooConexion.php';

class Telefonos {

    //traera todos los Telefonos con sus caracteristicas
    public static function mostrarTotalTelefonos() {
        $consulta = Conexion::conectar()->prepare("SELECT
                    t.PlacaTelefono,
                    m.Nombre AS MarcaTelefono,
                    md.NombreModelo AS ModeloTelefono,
                    tp.Nombre AS TipoTelefono,
                    t.IpTelefono,
                    t.Mac,
                    t.FechaCompra,
                    e.Nombre AS EstadoTelefono,
                    t.Precio,
                    t.Notas
                    FROM Telefonos AS t
                    JOIN Modelos AS md ON md.IdModelo = t.IdModelo
                    JOIN Marcas AS m ON md.IdMarca = m.IdMarca
                    JOIN Tipos AS tp ON t.IdTipoTelefono = tp.IdTipo
                    JOIN Estados AS e ON t.IdEstado = e.IdEstado
                    JOIN Ubicaciones AS u ON t.IdUbicacion = u.IdUbicacion ");
        $consulta->execute();
        $datos = $consulta->fetchAll();
        return $datos;
    }
    
    // Inserta un nuevo computador y sus datos relacionados
    public static function insertarNuevoTelefono(){
        
        try{

            $conn = Conexion::conectar();
            $conn->beginTransaction();

            $PlacaTelefono = $_POST['PlacaTelefono'];
            $IdMarca = $_POST['IdMarca'];
            $IdModelo = $_POST['IdModelo'];
            $IdTipo = $_POST['IdTipo'];
            $IpTelefono = $_POST['ipTelefono'];
            $Mac = $_POST['Mac'];
            $fechaCompra = $_POST['FechaCompra'];
            $IdEstado = $_POST['IdEstado'];
            $Precio = $_POST['Precio'];
            $IdUbicacion = $_POST['IdUbicacion'];
            $Observaciones = $_POST['Observaciones'];

            $stmt = $conn->prepare("INSERT INTO Telefonos (
                                PlacaTelefono,
                                IdMarca,  
                                IdModelo, 
                                IdTipoTelefono,
                                IpTelefono,
                                Mac, 
                                FechaCompra, 
                                IdEstado, 
                                IdUbicacion,
                                Precio, 
                                Notas) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$PlacaTelefono, $IdMarca, $IdModelo, $IdTipo, $IpTelefono, $Mac, $fechaCompra, $IdEstado, $IdUbicacion, $Precio, $Observaciones, ]);
            $conn->commit();
            return true;

        }catch (Exception $e) {
            if (isset($conn)) $conn->rollBack();
            return 'Error al guardar: ' . $e->getMessage();
        }

    }
    

}




    
    // Inserta un nuevo computador y sus datos relacionados
    /*
        try {
            
            

            // 1. Modelo: usar el IdModelo recibido directamente
            $IdModelo = $_POST['IdModelo'];
            $stmt = $conn->prepare("SELECT IdModelo FROM Modelos WHERE IdModelo = ?");
            $stmt->execute([$IdModelo]);
            $row = $stmt->fetch();
            if (!$row) {
                $conn->rollBack();
                return "El modelo seleccionado no existe. <a href='vista_ingresar_nuevo_modelo.php' style='color:#3498db;font-weight:bold;'>Crear modelo</a>";
            }
            //Resivimos datos
            

            

            // 2. Telefonos
            

            

            // Validación de placa
            $stmt = $conn->prepare("SELECT PlacaTelefono FROM Telefonos WHERE PlacaTelefono = ?");
            $stmt->execute([$PlacaTelefono]);
            if ($stmt->fetch()) {
                $conn->rollBack();
                return "Placa de PC ya se encuentra registrada";
            }
            if ($PlacaTelefono >= 2001 || $PlacaTelefono <= 2999) {
                $conn->rollBack();
                return "El número de placa admitida debe estar en el rango del (2001) al (2999)";
            }

            $stmt = $conn->prepare("INSERT INTO Telefonos (
                            PlacaTelefono,
                            IdMarca,  
                            IdModelo, 
                            IdTipoTelefono,
                            IpTelefono,
                            Mac, 
                            FechaCompra, 
                            IdEstado, 
                            IdUbicacion,
                            Precio, 
                            Notas) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$PlacaTelefono, $IdMarca, $IdModelo, $IdTipo, $IpTelefono, $Mac, $fechaCompra, $IdEstado, $IdUbicacion, $Precio, $Observaciones, ]);
            $IdTelefono = $conn->lastInsertId();
            $stmt->execute([$IdTelefono]);

            
        } catch */

             

    /*

     // Devuelve los datos de un computador para edición
    public static function obtenerDatosParaEditar($placa) {
        $conn = Conexion::conectar();
        $stmt = $conn->prepare("SELECT c.*, mo.NombreModelo, mo.IdMarca, ca.Procesador, ca.IdGeneracionRam, ca.MemoriaRAM_GB, r.MacLocal, r.MacWifi, 
            d1.DescripcionDisco AS MarcaDisco1, d1.CapacidadGB AS CapacidadDisco1, d1.IdTipoDisco AS TipoDisco1,
            d2.DescripcionDisco AS MarcaDisco2, d2.CapacidadGB AS CapacidadDisco2, d2.IdTipoDisco AS TipoDisco2
            FROM Computadores c
            JOIN Modelos mo ON c.IdModelo = mo.IdModelo
            JOIN Caracteristicas ca ON ca.IdComputador = c.IdComputador
            LEFT JOIN Red r ON r.IdComputador = c.IdComputador
            LEFT JOIN DiscosDuros d1 ON d1.IdCaracteristica = ca.IdCaracteristica AND d1.IdDiscoDuro = (
                SELECT MIN(dd.IdDiscoDuro) FROM DiscosDuros dd WHERE dd.IdCaracteristica = ca.IdCaracteristica)
            LEFT JOIN DiscosDuros d2 ON d2.IdCaracteristica = ca.IdCaracteristica AND d2.IdDiscoDuro = (
                SELECT MAX(dd.IdDiscoDuro) FROM DiscosDuros dd WHERE dd.IdCaracteristica = ca.IdCaracteristica AND dd.IdDiscoDuro != d1.IdDiscoDuro)
            WHERE c.PlacaComputador = ?");
        $stmt->execute([$placa]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Edita un computador y sus datos relacionados
    public static function editarComputador() {
        try {
            $conn = Conexion::conectar();
            $conn->beginTransaction();
            $PlacaEquipo = $_POST['PlacaComputador'];
            $SerialNumber = $_POST['SerialNumber'];
            $IdModelo = $_POST['IdModelo'];
            // Validar que el modelo existe, pero NO crear uno nuevo
            $stmt = $conn->prepare("SELECT IdModelo FROM Modelos WHERE IdModelo = ?");
            $stmt->execute([$IdModelo]);
            $row = $stmt->fetch();
            if (!$row) {
                $conn->rollBack();
                return "El modelo seleccionado no existe. <a href='vista_ingresar_nuevo_modelo.php' style='color:#3498db;font-weight:bold;'>Crear modelo</a>";
            }
            $IdSistemaOperativo = $_POST['IdSistemaOperativo'];
            $IdTipo = $_POST['IdTipo'];
            $IdEstado = $_POST['IdEstado'];
            $IdUbicacion = $_POST['IdUbicacion'];
            $Observaciones = $_POST['Observaciones'];
            $Procesador = $_POST['Procesador'];
            $GeneracionRam = $_POST['GeneracionRam'];
            $MemoriaRAM = $_POST['MemoriaRAM'];
            $MarcaDisco1 = $_POST['MarcaDisco1'];
            $CapacidadDisco1 = $_POST['CapacidadDisco1'];
            $TipoDisco1 = $_POST['TipoDisco1'];
            $MarcaDisco2 = $_POST['MarcaDisco2'];
            $CapacidadDisco2 = $_POST['CapacidadDisco2'];
            $TipoDisco2 = $_POST['TipoDisco2'];
            $MacLocal = $_POST['MacLocal'];
            $MacWifi = $_POST['MacWifi'];
            $fechaCompra = $_POST['FechaCompra'];

            // 1. Actualizar Computadores
            $stmt = $conn->prepare("UPDATE Computadores SET SerialNumber=?, IdModelo=?, IdSistemaOperativo=?, IdTipo=?, IdEstado=?, IdUbicacion=?, Observaciones=?, FechaCompra=? WHERE PlacaComputador=?");
            $stmt->execute([$SerialNumber, $IdModelo, $IdSistemaOperativo, $IdTipo, $IdEstado, $IdUbicacion, $Observaciones, $fechaCompra, $PlacaEquipo]);

            // Obtener IdComputador
            $stmt = $conn->prepare("SELECT IdComputador FROM Computadores WHERE PlacaComputador=?");
            $stmt->execute([$PlacaEquipo]);
            $row = $stmt->fetch();
            $IdComputador = $row['IdComputador'];

            // 3. Actualizar Caracteristicas
            $stmt = $conn->prepare("SELECT IdCaracteristica FROM Caracteristicas WHERE IdComputador=?");
            $stmt->execute([$IdComputador]);
            $row = $stmt->fetch();
            if ($row) {
                $IdCaracteristica = $row['IdCaracteristica'];
                $stmt = $conn->prepare("UPDATE Caracteristicas SET Procesador=?, IdGeneracionRam=?, MemoriaRAM_GB=? WHERE IdCaracteristica=?");
                $stmt->execute([$Procesador, $GeneracionRam, $MemoriaRAM, $IdCaracteristica]);
            } else {
                $stmt = $conn->prepare("INSERT INTO Caracteristicas (IdComputador, Procesador, IdGeneracionRam, MemoriaRAM_GB) VALUES (?, ?, ?, ?)");
                $stmt->execute([$IdComputador, $Procesador, $GeneracionRam, $MemoriaRAM]);
                $IdCaracteristica = $conn->lastInsertId();
            }

            // 4. Actualizar Discos Duros (borrar e insertar de nuevo)
            $conn->prepare("DELETE FROM DiscosDuros WHERE IdCaracteristica=?")->execute([$IdCaracteristica]);
            if ($MarcaDisco1 && $TipoDisco1) {
                $stmt = $conn->prepare("INSERT INTO DiscosDuros (IdCaracteristica, DescripcionDisco, IdTipoDisco, CapacidadGB) VALUES (?, ?, ?, ?)");
                $stmt->execute([$IdCaracteristica, $MarcaDisco1, $TipoDisco1, $CapacidadDisco1]);
            }
            if ($MarcaDisco2 && $TipoDisco2) {
                $stmt = $conn->prepare("INSERT INTO DiscosDuros (IdCaracteristica, DescripcionDisco, IdTipoDisco, CapacidadGB) VALUES (?, ?, ?, ?)");
                $stmt->execute([$IdCaracteristica, $MarcaDisco2, $TipoDisco2, $CapacidadDisco2]);
            }

            // 5. Actualizar Red
            $stmt = $conn->prepare("SELECT IdRed FROM Red WHERE IdComputador=?");
            $stmt->execute([$IdComputador]);
            if ($stmt->fetch()) {
                $stmt = $conn->prepare("UPDATE Red SET MacLocal=?, MacWifi=? WHERE IdComputador=?");
                $stmt->execute([$MacLocal, $MacWifi, $IdComputador]);
            } else {
                $stmt = $conn->prepare("INSERT INTO Red (IdComputador, MacLocal, MacWifi) VALUES (?, ?, ?)");
                $stmt->execute([$IdComputador, $MacLocal, $MacWifi]);
            }

            $conn->commit();
            return true;
        } catch (Exception $e) {
            if (isset($conn)) $conn->rollBack();
            return 'Error al actualizar: ' . $e->getMessage();
        }
    }
    
    // Guarda un registro de mantenimiento con archivo adjunto
    public static function guardarMantenimiento($IdComputador, $Descripcion, $Fecha, $archivo) {
        try {
            // Validación de IdComputador
            if (!is_numeric($IdComputador) || intval($IdComputador) <= 0) {
                throw new Exception('IdComputador inválido.');
            }
            $conn = Conexion::conectar();
            $conn->beginTransaction();

            // Guardar archivo en el servidor
            $rutaDestino = null;
            if ($archivo && $archivo['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = basename($archivo['name']);
                $directorio = __DIR__ . '/../assest/adjuntos/';
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777, true);
                }
                $nombreFinal = uniqid('mnt_') . '_' . $nombreArchivo;
                $rutaAbsoluta = $directorio . $nombreFinal;
                if (move_uploaded_file($archivo['tmp_name'], $rutaAbsoluta)) {
                    // Guardar ruta relativa para la base de datos
                    $rutaDestino = '../assest/adjuntos/' . $nombreFinal;
                } else {
                    throw new Exception('No se pudo mover el archivo adjunto.');
                }
            }

            // Insertar registro en la tabla de mantenimientos
            $stmt = $conn->prepare("INSERT INTO Mantenimientos (IdComputador, Descripcion, Fecha, ArchivoAdjunto) VALUES (?, ?, ?, ?)");
            $stmt->execute([$IdComputador, $Descripcion, $Fecha, $rutaDestino]);

            $conn->commit();
            return true;
        } catch (Exception $e) {
            if (isset($conn)) $conn->rollBack();
            return 'Error al guardar mantenimiento: ' . $e->getMessage();
        }
    }

    // Devuelve el historial de mantenimientos con datos de computador y archivo
    public static function listarMantenimientos() {
        $conn = Conexion::conectar();
        $sql = "SELECT m.IdMantenimiento, c.PlacaComputador, c.SerialNumber, m.Descripcion, m.Fecha, m.ArchivoAdjunto
                FROM Mantenimientos m
                JOIN Computadores c ON m.IdComputador = c.IdComputador
                ORDER BY m.Fecha DESC, m.IdMantenimiento DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Obtener un mantenimiento por ID (para edición)
    public static function obtenerMantenimientoPorId($id) {
        $conn = Conexion::conectar();
        $sql = "SELECT m.*, c.PlacaComputador, c.SerialNumber FROM Mantenimientos m JOIN Computadores c ON m.IdComputador = c.IdComputador WHERE m.IdMantenimiento = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Editar un mantenimiento existente
    public static function editarMantenimiento($id, $Descripcion, $Fecha, $archivo) {
        try {
            $conn = Conexion::conectar();
            $conn->beginTransaction();
            // Obtener mantenimiento actual
            $stmt = $conn->prepare("SELECT * FROM Mantenimientos WHERE IdMantenimiento = ?");
            $stmt->execute([$id]);
            $mant = $stmt->fetch();
            if (!$mant) {
                $conn->rollBack();
                return 'Mantenimiento no encontrado.';
            }
            $rutaDestino = $mant['ArchivoAdjunto'];
            if ($archivo && $archivo['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = basename($archivo['name']);
                $directorio = '../assest/mantenimientos/';
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777, true);
                }
                $rutaDestino = $directorio . uniqid('mnt_') . '_' . $nombreArchivo;
                move_uploaded_file($archivo['tmp_name'], $rutaDestino);
            }
            $stmt = $conn->prepare("UPDATE Mantenimientos SET Descripcion=?, Fecha=?, ArchivoAdjunto=? WHERE IdMantenimiento=?");
            $stmt->execute([$Descripcion, $Fecha, $rutaDestino, $id]);
            $conn->commit();
            return true;
        } catch (Exception $e) {
            if (isset($conn)) $conn->rollBack();
            return 'Error al actualizar mantenimiento: ' . $e->getMessage();
        }
    }

    // Eliminar un mantenimiento por ID
    public static function eliminarMantenimiento($id) {
        try {
            $conn = Conexion::conectar();
            $conn->beginTransaction();
            $stmt = $conn->prepare("SELECT ArchivoAdjunto FROM Mantenimientos WHERE IdMantenimiento = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            if (!$row) {
                $conn->rollBack();
                return 'Mantenimiento no encontrado.';
            }
            // Eliminar archivo adjunto si existe
            if ($row['ArchivoAdjunto'] && file_exists($row['ArchivoAdjunto'])) {
                @unlink($row['ArchivoAdjunto']);
            }
            $stmt = $conn->prepare("DELETE FROM Mantenimientos WHERE IdMantenimiento = ?");
            $stmt->execute([$id]);
            $conn->commit();
            return true;
        } catch (Exception $e) {
            if (isset($conn)) $conn->rollBack();
            return 'Error al eliminar mantenimiento: ' . $e->getMessage();
        }
    }*/