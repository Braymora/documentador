<?php
session_start();

include_once "../config/conexion.php";

if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['mane_user']) && !empty($_POST['clave']) && !empty($_POST['id_rol'])) {

    $id_usuario = $_POST['id'];
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
    $hashedPass = password_hash($clave, PASSWORD_DEFAULT);
    $mane_user = $_POST['mane_user'];
    $id_rol = $_POST['id_rol'];

    // Verificar que el ID proporcionado en el formulario existe en la base de datos
    $stmt = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo '<div class="alert alert-danger mt-4">El ID del usuario no existe</div>';
        exit;
    }

    // Actualizar los datos del usuario en la base de datos
    $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, correo = ?, clave = ?, nombre_usuario = ?, id_rol = ? WHERE id_usuario = ?");
    $stmt->bind_param("ssssii", $nombre, $email, $hashedPass, $mane_user, $id_rol, $id_usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = "Actualización exitosa";
        header("Location: ../listaUsuarios.php");
        exit();
    } else {
        $_SESSION['error'] = "No han ocurrido cambios al actualizar el usuario";
        header("Location: ../listaUsuarios.php");
        exit();
    }
} else {
    $_SESSION['falta'] = "Los datos están vacíos";
    header("Location: ../listaUsuarios.php");
    exit();
}
