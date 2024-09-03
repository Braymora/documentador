<?php
define('BD_HOST', 'localhost'); 
define('BD_USER', 'root'); 
define('BD_PASSWORD', ''); 
define('BD_NAME', 'documentador');

$conexion = mysqli_connect(BD_HOST, BD_USER, BD_PASSWORD, BD_NAME);

if ($conexion->connect_errno) {
    echo "Falló la conexión a MySql: (" . $conexion->connect_errno . ")" . $conexion->connect_error;
    exit();
}

// Establecer la codificación de caracteres en UTF-8
mysqli_set_charset($conexion, "utf8");

return $conexion;
?>

