<?php
include 'config/conexion.php';

if (isset($_POST['id'])) {

$id_finalizar =  $_POST['id'];

$query = "UPDATE oc SET estado_oc = 0 WHERE estado_oc = 1 AND id = $id_finalizar ";
mysqli_query($conexion, $query);

}