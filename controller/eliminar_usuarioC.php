<?php
session_start();
include_once "../config/conexion.php";

// Verificar si se recibió un ID válido en la URL
if (empty($_GET['id'])) {
    $_SESSION['error'] = "ID de usuario no válido";
    header('Location: ../listaUsuarios.php');
    exit;
}

$id_encoded = $_GET['id'];
$id = base64_decode($id_encoded);

$query_delete = "UPDATE usuarios SET estado = 0 WHERE id_usuario = ?";
$stmt = $conexion->prepare($query_delete);
$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    $_SESSION['success'] = "Usuario eliminado exitosamente";
} else {
    $_SESSION['error'] = "No se pudo eliminar el usuario";
}

$stmt->close();
$conexion->close();

header("Location: ../listaUsuarios.php");
exit();
?>
