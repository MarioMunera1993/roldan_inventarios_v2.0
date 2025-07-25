<?php
include_once 'pooComputadores.php';

// Establecer headers para descarga de Excel
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename=Inventario_Computadores_' . date('Y-m-d') . '.xls');
header('Pragma: no-cache');
header('Expires: 0');

// Obtener los datos
$computadores = Computadores::mostrarTotalComputadores();

// Crear tabla HTML con estilos integrados
echo '
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin: 20px 0;
        font-family: Arial, sans-serif;
    }
    th {
        background-color: #2C3E50;
        color: white;
        font-weight: bold;
        text-align: center;
        padding: 12px 8px;
        border: 1px solid #000;
        font-size: 11pt;
    }
    td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
        font-size: 10pt;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .text-center {
        text-align: center;
    }
    .text-right {
        text-align: right;
    }
</style>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>Placa Computador</th>
            <th>Número Serial</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Sistema Operativo</th>
            <th>Tipo Equipo</th>
            <th>Procesador</th>
            <th>Generación RAM</th>
            <th>RAM (GB)</th>
            <th>Discos Detalle</th>
            <th>MAC Local</th>
            <th>MAC Wifi</th>
            <th>Estado</th>
            <th>Bodega</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>';

// Llenar datos
foreach ($computadores as $computador) {
    echo '<tr>';
    echo '<td class="text-center">' . htmlspecialchars($computador['PlacaComputador'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($computador['SerialNumber'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($computador['marca'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($computador['modelo'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($computador['sistemaOperativo'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="text-center">' . htmlspecialchars($computador['tipoEquipo'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($computador['Procesador'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="text-center">' . htmlspecialchars($computador['genRam'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="text-center">' . htmlspecialchars($computador['ramGb'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($computador['DiscosDetalle'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($computador['MacLocal'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($computador['MacWifi'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="text-center">' . htmlspecialchars($computador['estado'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td class="text-center">' . htmlspecialchars($computador['Bodega'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($computador['Observaciones'], ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
}

echo '</tbody></table></body></html>';

