<?php
require 'vendor/autoload.php'; // Incluye el archivo autoload.php de PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

include 'config/conexion.php';

// Se verifica si se seleccionó un archivo
if (empty($_FILES['datos']['tmp_name'])) {
    header("Location: index.php");
    exit();
}

// Ruta del archivo temporal
$archivo = $_FILES['datos']['tmp_name'];

// Carga el archivo Excel utilizando PhpSpreadsheet
$spreadsheet = IOFactory::load($archivo);
$worksheet = $spreadsheet->getActiveSheet();

// Obtén el número de filas y columnas
$filas = $worksheet->getHighestRow();
$columnas = $worksheet->getHighestColumn();

for ($row = 2; $row <= $filas; $row++) {
    $id_aprovisionamiento = $worksheet->getCell('A' . $row)->getValue();
    $estado_actual = $worksheet->getCell('B' . $row)->getValue();
    $fecha_creacion = $worksheet->getCell('C' . $row)->getValue();
    $ans = $worksheet->getCell('D' . $row)->getValue();
    $cuenta_cliente = $worksheet->getCell('E' . $row)->getValue();
    $asignado_a = $worksheet->getCell('F' . $row)->getValue();
    $ciudad_instalacion = $worksheet->getCell('G' . $row)->getValue();
    $u_anotacion_resumen = $worksheet->getCell('H' . $row)->getValue();
    $segmento = $worksheet->getCell('I' . $row)->getValue();

    $fecha_creacion = $worksheet->getCell('C' . $row)->getValue();
    $fecha_creacion = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha_creacion);

    // Formatear la fecha en el formato de la base de datos (Y-m-d H:i:s)
    $fecha_creacion_formatted = $fecha_creacion->format('d/m/Y');




    // Preparar los datos para la inserción
    $id_aprovisionamiento = mysqli_real_escape_string($conexion, $id_aprovisionamiento);
    $estado_actual = mysqli_real_escape_string($conexion, $estado_actual);
    $fecha_creacion = mysqli_real_escape_string($conexion, $fecha_creacion->format('d/m/Y'));
    $ans = mysqli_real_escape_string($conexion, $ans);
    $cuenta_cliente = mysqli_real_escape_string($conexion, $cuenta_cliente);
    $asignado_a = mysqli_real_escape_string($conexion, $asignado_a);
    $ciudad_instalacion = mysqli_real_escape_string($conexion, $ciudad_instalacion);
    $u_anotacion_resumen = mysqli_real_escape_string($conexion, $u_anotacion_resumen);
    $segmento = mysqli_real_escape_string($conexion, $segmento);

    mysqli_query($conexion, "SET NAMES 'utf8'");


    // Verificar si el registro ya existe en la base de datos
    $consulta_existencia = "SELECT id_aprovisionamiento FROM oc WHERE id_aprovisionamiento = '$id_aprovisionamiento'";
    $resultado = mysqli_query($conexion, $consulta_existencia);

    if (mysqli_num_rows($resultado) > 0) {
        // El registro ya existe, realizar la actualización
        $actualizar = "UPDATE oc SET estado_actual = '$estado_actual', fecha_creacion = '$fecha_creacion', ans = '$ans', cuenta_cliente = '$cuenta_cliente', asignado_a = '$asignado_a', ciudad_instalacion = '$ciudad_instalacion', u_anotacion_resumen = '$u_anotacion_resumen', segmento = '$segmento'
                       WHERE id_aprovisionamiento = '$id_aprovisionamiento'";

        mysqli_query($conexion, $actualizar);
    } else {
        // El registro no existe, realizar la inserción
        $insertar = "INSERT INTO oc (id_aprovisionamiento, estado_actual, fecha_creacion, ans, cuenta_cliente, asignado_a, ciudad_instalacion, u_anotacion_resumen, segmento)
                     VALUES ('$id_aprovisionamiento', '$estado_actual', '$fecha_creacion', '$ans', '$cuenta_cliente', '$asignado_a', '$ciudad_instalacion', '$u_anotacion_resumen', '$segmento')";

        mysqli_query($conexion, $insertar);
    }
}

// Verificar si hubo errores en la ejecución de la consulta
if (mysqli_errno($conexion)) {
    echo "Error al importar el archivo Excel: " . mysqli_error($conexion);
    header("location: index.php");
} else {
    echo "Archivo Excel importado correctamente a la base de datos.";
    header("location: index.php");
}

// Procesar el archivo Excel si es válido
// ...


// Cerrar la conexión
mysqli_close($conexion);
