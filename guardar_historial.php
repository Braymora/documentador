<?php
$alert = "se han guardado los datos correctamente";
include 'config/conexion.php';

if (isset($_POST['id_aprovisionamiento']) && isset($_POST['estado_actual']) && isset($_POST['fecha_creacion']) && isset($_POST['cuenta_cliente']) && isset($_POST['asignado_a']) && isset($_POST['ciudad_instalacion']) && isset($_POST['u_anotacion_resumen']) && isset($_POST['segmento']) && isset($_POST['estado_historial']) && isset($_POST['codigo_historial']) && isset($_POST['info_codigo_historial']) && isset($_POST['fecha_proyeccion_historial']) && isset($_POST['observaciones_historial'])) {

    $id = $_POST['id'];
    $id_aprovisionamiento = $_POST['id_aprovisionamiento'];
    $estado_actual = $_POST['estado_actual'];
    $fecha_creacion = $_POST['fecha_creacion'];
    $ans = $_POST['ans'];
    $cuenta_cliente = $_POST['cuenta_cliente'];
    $asignado_a = $_POST['asignado_a'];
    $ciudad_instalacion = $_POST['ciudad_instalacion'];
    $u_anotacion_resumen = $_POST['u_anotacion_resumen'];
    $segmento = $_POST['segmento'];
    $estado_historial = $_POST['estado_historial'];
    $codigo_historial = $_POST['codigo_historial'];
    $info_codigo_historial = $_POST['info_codigo_historial'];
    $fecha_proyeccion_historial = $_POST['fecha_proyeccion_historial'];
    $observaciones_historial = $_POST['observaciones_historial'];
    date_default_timezone_set('America/Bogota');
    $fechaactual = date('Y-m-d h:i:s');

    // Convertir la fecha al formato "dia/mes/año"
    $fecha_proyeccion_historial = date('d/m/Y', strtotime($fecha_proyeccion_historial));

    $sql = "INSERT INTO historial (id_aprovisionamiento, estado_actual, fecha_creacion, ans, cuenta_cliente, asignado_a, ciudad_instalacion, u_anotacion_resumen, segmento, estado_historial, codigo_historial, info_codigo_historial, fecha_proyeccion_historial, observaciones_historial, fecha) 
            VALUES ('$id_aprovisionamiento','$estado_actual','$fecha_creacion','$ans','$cuenta_cliente','$asignado_a','$ciudad_instalacion','$u_anotacion_resumen','$segmento','$estado_historial','$codigo_historial','$info_codigo_historial','$fecha_proyeccion_historial','$observaciones_historial','$fechaactual')";

    // Ejecutar la consulta de inserción
    if (mysqli_query($conexion, $sql)) {
        // Consulta de inserción exitosa, ahora actualizamos la columna "u_anotacion_resumen" en la tabla "oc"
        $sql2 = "UPDATE oc SET u_anotacion_resumen = CONCAT(u_anotacion_resumen, '" . $estado_historial . "', '\n', '\$" . $codigo_historial . "', '\$" . $info_codigo_historial . "', '\$" . $fecha_proyeccion_historial . "\$', '\n', '" . $observaciones_historial . "', '\n\n') WHERE id = " . $id;



        // Ejecutar la consulta de actualización
        if (mysqli_query($conexion, $sql2)) {

            echo 'Se guarda datos oc';
        }

        $sql3 = "UPDATE historial SET u_anotacion_resumen = CONCAT(u_anotacion_resumen, ' - ', '$observaciones_historial') WHERE id = $id";
        if (mysqli_query($conexion, $sql3)) {
            # code...
        }
    } else {
        echo "Error al guardar los datos en la tabla 'historial': " . mysqli_error($conexion);
    }

    date_default_timezone_set('America/Bogota');
    $fechaactual = date("Y-m-d h:d:s");

    // Cerrar la conexión
    mysqli_close($conexion);
}
