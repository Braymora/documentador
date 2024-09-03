<!-- Inicio del script PHP -->
<?php
session_start(); // Iniciar sesión de PHP
if (isset($_SESSION['rol']) && $_SESSION['rol'] != 1) {
    header(("location: index.php"));
}



include_once 'config/conexion.php'; // Incluir el archivo de conexión a la base de datos

$iduser = base64_decode($_REQUEST['id']); // Decodificar y obtener el ID del usuario


// Consulta SQL para obtener los datos del usuario
$query = "SELECT u.id_usuario, u.nombre, u.correo, u.clave, u.nombre_usuario, u.estado, u.id_rol, r.id_rol,
                 r.nombre_rol
                FROM usuarios u 
                INNER JOIN roles r ON u.id_rol = r.id_rol 
                WHERE u.id_usuario = ? AND u.estado = 1";

$stmt = $conexion->prepare($query); // Preparar la consulta SQL
$stmt->bind_param("i", $iduser); // Asociar el ID del usuario como parámetro a la consulta preparada
$stmt->execute(); // Ejecutar la consulta
$resultado = $stmt->get_result(); // Obtener el resultado de la consulta
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="../assets/iconos/logo.ico" />

    <!-- Enlace iconos bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384 EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">

    <title>Editar usuarios</title>

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="CSS/editar_usuario/editar_usuario.css">
    <link rel="stylesheet" href="CSS/editar_usuario/validarCampos.css">
    <link rel="stylesheet" href="CSS/estilo.css">


</head>

<body>
    <header>
        <nav class="menu col-lg-6">
            <ul class="menu-cont">
                <a class="menu-cont__items" href="index.php">Documentos</a>
                <a class="menu-cont__items" href="historial.php">Historial</a>
                <li class="menu-cont__items">
                    <a>Usuario</a>
                    <ul class="sub-menu">
                        <li class="item1">
                            <a href="crearUsuarios.php">Crear usuarios</a>
                        </li>
                        <li>
                            <a href="listaUsuarios.php">Lista de usuarios</a>
                        </li>
                    </ul>
                    <i class="bi bi-caret-down"></i>
                </li>
            </ul>
            <div class="col-lg-6">
                <ul class="navbar-nav d-flex justify-content-end">
                    <div class="cont-info">
                        <li class="nav-item"> <span><?php echo $_SESSION['nombre']; ?></span> </li>
                        <li class="nav-item"> <a class="nav-link" href="cerrar_sesion.php"><i class="bi bi-arrow-left-square"></i></a> </li>
                    </div>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="d-flex justify-content-center align-items-center vh-100">

            <section class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="titulo_user">Editar usuario</h1>
                        <?php

                        while ($datos = $resultado->fetch_object()) { ?>
        
                            <form action="controller/editar_usuarioC.php" method="post" id="formulario">
                                <input type="hidden" name="id" value="<?= $datos->id_usuario; ?>">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>
                                            <em>Nombre:</em>
                                            <input class="form-control" type="text" placeholder="Ingrese nombre completo" name="name" id="name" value="<?= $datos->nombre; ?>" required>
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <em>Correo :</em>
                                            <input class="form-control" type="email" placeholder="Ingrese correo del usuario" name="email" id="email" value="<?= $datos->correo; ?>">
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <em>Usuario:</em>
                                            <input class="form-control" type="text" placeholder="Ingrese nombre del usuario" name="mane_user" id="mane_user" value="<?= $datos->nombre_usuario; ?>" required>
                                            <div class="text-danger small">¡Importante! Si se modifica el usuario, se debe ingresar al sistema con este usuario.</div>
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <em>Contraseña :</em>
                                            <input class="form-control" type="password" placeholder="Ingrese contraseña nueva" name="clave" id="clave">
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- ====================Selecionar Zona y Selecionar Rol==================== -->

                                <div class="row g-3 mb-2">
                                    <div class="col-md-6">
                                        <label>
                                            <em>Rol:</em>
                                            <select name="id_rol" id="id_rol" class="form-select" required>
                                                <option value="">Seleccione el Rol</option>
                                                <?php
                                                $rolesQuery = mysqli_query($conexion, "SELECT id_rol, nombre_rol FROM roles");
                                                while ($rol = mysqli_fetch_assoc($rolesQuery)) {
                                                    $id_rol = $rol['id_rol'];
                                                    $nombre_rol = $rol['nombre_rol'];
                                                    $selected = ($id_rol == $datos->id_rol) ? "selected" : "";
                                                    echo "<option value=\"$id_rol\" $selected>$nombre_rol</option>";
                                                }
                                                ?>
                                            </select>
                                            <span></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12 text-center"> <!-- Agrega la clase text-center para centrar el botón -->
                                        <button type="submit" class="contenedor_usuario--btn">Actualizar</button>
                                    </div>
                                    <div class="col-md-12 text-center"> <!-- Agrega la clase text-center para centrar el botón -->
                                        <a class="btn btn-warning" href="listaUsuarios.php" role="button">Volver</a>
                                    </div>
                                </div>

                            </form>
                        <?php }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="js/editar_usuario/validarCampos.js"></script>

</body>

</html>