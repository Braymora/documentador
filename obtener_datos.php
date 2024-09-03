<?php
// Aquí debes incluir la configuración de la conexión a la base de datos
include 'config/conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Realizar la consulta para obtener los datos actualizados
    $query = "SELECT u_anotacion_resumen FROM oc WHERE id = $id";
    $result = mysqli_query($conexion, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);
        echo $data['u_anotacion_resumen'];
    }
}
?>
