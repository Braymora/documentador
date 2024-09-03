<?php
//crea o reanuda una sesión existente, lo que permite al servidor almacenar información específica del usuario en la sesión
session_start();

require 'config/conexion.php';

if (isset($_SESSION['rol']) && $_SESSION['rol'] != 1) {
    header(("location: index.php"));
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Enlace iconos bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384 EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">


    <title>Crear usuarios</title>
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="CSS/estilo_Usuarios.css">
    <link rel="stylesheet" href="CSS/validarCampos.css">
    <link rel="stylesheet" href="CSS/estilo.css">

</head>

<body>
    <header>
        <nav class="menu col-lg-6">
            <img src="imagenes/Logo_Colvatel.png" alt="" class="logo" />
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
            <div>
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
        <section class="contenerdor">
            <div class="conInfouser">
                <h1 class="titulo_user">Registro de usuario</h1>
                <form action="controller/crear_usuarioC.php" class="contenedor_usuario" method="post" id="formulario">

                    <!-- Alertas -->
                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>¡Éxito!</strong> <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>¡Error!</strong> <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>

                    <div class="contenerdor_usuario--datos">
                        <label>
                            <em>Nombre:</em>
                            <input class="contenerdor_usuario--datos-input" type="text" placeholder="Ingrese nombre completo" name="name" id="name" required>
                            <span></span>
                        </label>
                        <label>
                            <em>Correo:</em>
                            <input class="contenerdor_usuario--datos-input" type="email" placeholder="Ingrese correo del usuario" name="email" id="email" required>
                            <span></span>
                        </label>

                        <!--<label>
              <em>Teléfono:</em>
              <input class="contenerdor_usuario--datos-input" type="text" placeholder="Ingrese teléfono" name="tel" id="tel" required>
              <span></span>
            </label> -->

                        <label>
                            <em>Contraseña:</em>
                            <input class="contenerdor_usuario--datos-input inputPassword" type="password" placeholder="Ingrese contraseña" name="clave" id="clave" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                            <span></span>
                            <div id="message">
                                <h3>La contraseña debe contener lo siguiente:</h3>
                                <p id="letter" class="invalid">A <b>Minúsculas</b> Letra</p>
                                <p id="capital" class="invalid">A <b>Mayúscula (Mayúscula)</b> Letra</p>
                                <p id="number" class="invalid">A <b>Número</b></p>
                                <p id="length" class="invalid">Mínimo <b>8 caracteres</b></p>
                            </div>
                        </label>
                        <label>
                            <em>Usuario:</em>
                            <input class="contenerdor_usuario--datos-input" type="text" placeholder="Ingrese nombre del usuario" name="mane_user" id="mane_user" required>
                            <span></span>
                        </label>
                    </div>
                    <div class="contenerdor_usuario--opciones">

                        <!--Selecionar Rol-->
                        <div class="contenerdor_usuario--opcionesRol">
                            <?php
                            $query_rol = mysqli_query($conexion, "SELECT * FROM roles");
                            $result_rol = mysqli_num_rows($query_rol);
                            mysqli_close($conexion);
                            ?>
                            <div class="opcionesRol">
                                <label>
                                    <em>Rol:</em>
                                    <select name="rol" id="rol" class="opcionesRol-opciones" required>
                                        <option value="">Seleccione el Rol</option>
                                        <?php
                                        if ($result_rol > 0) {
                                            while ($rol = mysqli_fetch_array($query_rol)) {
                                        ?>
                                                <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['nombre_rol']; ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="contenedor_usuario--btn">Guardar</button>
                </form>
            </div>
        </section>
    </main>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="js/crear_usuario/validarCampos.js"></script>
    <script src="js/crear_usuario/validarClave.js"></script>

</body>

</html>