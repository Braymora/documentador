<?php

require 'vendor/autoload.php'; // Incluir el archivo autoload.php de PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'config/conexion.php';

if (isset($_POST['export_data'])) {
    // Obtener los datos de la tabla historial
    $query = "SELECT * FROM historial";
    $resultado = mysqli_query($conexion, $query);

    // Crear un objeto Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar encabezados de columna
    $sheet->setCellValue('A1', 'id_aprovisionamiento');
    $sheet->setCellValue('B1', 'estado_actual');
    $sheet->setCellValue('C1', 'fecha_creacion');
    $sheet->setCellValue('D1', 'cuenta_cliente');
    $sheet->setCellValue('E1', 'asignado_a');
    $sheet->setCellValue('F1', 'ciudad_instalacion');
    $sheet->setCellValue('G1', 'u_anotacion_resumen');
    $sheet->setCellValue('H1', 'segmento');
    $sheet->setCellValue('I1', 'estado_historial');
    $sheet->setCellValue('J1', 'codigo_historial');
    $sheet->setCellValue('K1', 'info_codigo_historial');
    $sheet->setCellValue('L1', 'observaciones_historial');
    $sheet->setCellValue('M1', 'fecha');

    // Agregar los datos
    $row = 2;
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($data = mysqli_fetch_assoc($resultado)) {
            $sheet->setCellValue('A' . $row, $data['id_aprovisionamiento']);
            $sheet->setCellValue('B' . $row, $data['estado_actual']);
            $sheet->setCellValue('C' . $row, $data['fecha_creacion']);
            $sheet->setCellValue('D' . $row, $data['cuenta_cliente']);
            $sheet->setCellValue('E' . $row, $data['asignado_a']);
            $sheet->setCellValue('F' . $row, $data['ciudad_instalacion']);
            $sheet->setCellValue('G' . $row, $data['u_anotacion_resumen']);
            $sheet->setCellValue('H' . $row, $data['segmento']);
            $sheet->setCellValue('I' . $row, $data['estado_historial']);
            $sheet->setCellValue('J' . $row, $data['codigo_historial']);
            $sheet->setCellValue('K' . $row, $data['info_codigo_historial']);
            $sheet->setCellValue('L' . $row, $data['observaciones_historial']);
            $sheet->setCellValue('M' . $row, $data['fecha']);
            $row++;
        }
    }

    // Crear un objeto Writer para XLSX
    $writer = new Xlsx($spreadsheet);

    // Guardar el archivo
    $filename = 'archivo.xlsx';
    $writer->save($filename);

    // Descargar el archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}

// Cerrar la conexión
mysqli_close($conexion);

?>
