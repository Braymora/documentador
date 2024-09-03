<?php
include 'config/conexion.php';
header('Content-Type: text/html; charset=UTF-8');

mysqli_set_charset($conexion, "utf8");

session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">

    <!-- Enlace iconos bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384 EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/cr-1.6.2/r-2.4.1/rr-1.3.3/sb-1.4.2/sp-2.1.2/sl-1.6.2/datatables.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">



    <link rel="stylesheet" href="CSS/estilo.css">
    <link rel="stylesheet" href="CSS/validarCampos.css">

</head>

<body>
    <header>
        <nav class="menu col-lg-6">
            <img src="imagenes/Logo_Colvatel.png" alt="" class="logo" />
            <ul class="menu-cont">
                <?php
                if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                ?>
                    <a class="menu-cont__items" href="index.php">Documentos</a>
                <?php } ?>

                <?php
                if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
                ?>
                    <a class="menu-cont__items" href="historial.php">Historial</a>
                <?php } ?>

                <?php
                if ($_SESSION['rol'] == 1) {
                ?>
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
                <?php } ?>
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

    <div class="cont">
        <h1 style="font-size: 20px; text-align: center; color: #0e3858; margin: 20px"><b>Formulario Documentación OC</b></h1>
        <div class="row">
            <div class="col-md-7">
                <!-- Input y btn importar -->
                <?php
                if ($_SESSION['rol'] == 1) {
                ?>
                    <form action="import_excel.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input class="form-control" name="datos" type="file" id="formFileMultiple" multiple accept=".xlsx">
                        </div>
                        <div class="importar">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
        <div class="cont table-responsive" id="cont-table">

            <table id="example" class="display" style="width:100%">

                <thead>
                    <tr>
                        <th>id.Aprovisionamiento</th>
                        <th>Estado Actual</th>
                        <th>Fecha Creación</th>
                        <th>Tiempo Máximo Entrega (ANS)</th>
                        <th>Cuenta Cliente</th>
                        <th>Asignado A</th>
                        <th>Ciudad Instalación</th>
                        <th>Última Anotación Resumen</th>
                        <th>Segmento</th>
                        <th>Estado</th>
                        <th>Código</th>
                        <th>Info.Código</th>
                        <th>Fecha proyección</th>
                        <th>Observación</th>
                        <th>Documentado
                            <label for="filtro">Filtrar por:</label>
                            <select id="filtro">
                                <option value="">Todos</option>
                                <option value="1">SI</option>
                                <option value="2">NO</option>
                            </select>
                        </th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT o.id, o.id_aprovisionamiento, o.estado_actual, o.fecha_creacion, o.ans, o.cuenta_cliente, o.asignado_a, o.ciudad_instalacion, o.u_anotacion_resumen, o.segmento
                    FROM oc o 
                    WHERE estado_oc = 1
                     ORDER BY o.id_aprovisionamiento";

                    $resultado = mysqli_query($conexion, $query);
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($data = mysqli_fetch_array($resultado)) {

                    ?>
                            <tr value="<?php echo $data['id']; ?>" class="fila-datos">
                                <td class="table-items" name="id_aprovisionamiento"><?php echo $data['id_aprovisionamiento']; ?></td>
                                <td class="table-items" name="estado_actual"><?php echo $data['estado_actual']; ?></td>
                                <td class="table-items" name="fecha_creacion"><?php echo $data['fecha_creacion']; ?></td>
                                <td class="table-items" name="ans"><?php echo $data['ans']; ?></td>
                                <td class="table-items" name="cuenta_cliente"><?php echo $data['cuenta_cliente']; ?></td>
                                <td class="table-items" name="asignado_a"><?php echo $data['asignado_a']; ?></td>

                                <td class="table-items" name="ciudad_instalacion"><?php echo $data['ciudad_instalacion']; ?></td>

                                <td class="table-items">
                                    <textarea id="anotacion-resumen" name="u_anotacion_resumen" cols="30" rows="4" class="text-obs" readonly data-bs-toggle="modal" data-bs-target="#exampleModal" data-info="<?php echo $data['u_anotacion_resumen']; ?>"><?php echo $data['u_anotacion_resumen']; ?></textarea>

                                </td>


                                <td class="table-items" name="segmento"><?php echo $data['segmento']; ?></td>
                                <td class="tabla-items">
                                    <label>

                                        <?php
                                        $sql_estados = mysqli_query($conexion, "SELECT * FROM estados");
                                        $result_estados = mysqli_num_rows($sql_estados);
                                        ?>
                                        <select name="estado_historial" id="" class="selectEstado" required>
                                            <option value="" selected>Selecciona un estado</option>
                                            <?php
                                            if ($result_estados > 0) {
                                                while ($row_estado = mysqli_fetch_array($sql_estados)) {
                                            ?>
                                                    <option value="<?php echo $row_estado['nombre_estado']; ?>" data-nombre="<?php echo $row_estado['nombre_estado']; ?>"><?php echo $row_estado['nombre_estado']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span></span>
                                    </label>
                                </td>
                                <td class="tabla-items">
                                    <?php
                                    $sql = mysqli_query($conexion, "SELECT * FROM codigos");
                                    $result = mysqli_num_rows($sql);
                                    ?>
                                    <select name="codigo_historial" id="" class="selectCodigo">
                                        <option value="" selected>Selecciona un código</option>
                                        <?php
                                        if ($result > 0) {
                                            while ($row = mysqli_fetch_array($sql)) {
                                        ?>
                                                <option value="<?php echo $row['num_codigo']; ?>" data-nombre="<?php echo $row['nombre_codigo']; ?>"><?php echo $row['num_codigo']; ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                        <span></span>
                                    </select>
                                </td>
                                <td class="tabla-items"><textarea name="info_codigo_historial" id="" cols="30" rows="2" disabled></textarea></td>
                                <td class="tabla-items"><input type="date" name="fecha_proyeccion_historial" class="form-control"></td>
                                <td class="tabla-items"><textarea name="observaciones_historial" id="" cols="30" rows="4" class="text-obs"></textarea></td>
                                <td>
                                    <input type="hidden" value="<?php echo $data['id']; ?>" id="id_oc">
                                    <select name="codigo-<?php echo $data['id']; ?>" id="selectCodigo-<?php echo $data['id']; ?>" class="selectCodigo">
                                        <option value="">Selecciona opción</option>
                                        <option value="1">SI</option>
                                        <option value="2">NO</option>
                                    </select>
                                    <div class="form-group select">
                                        <label for="result-<?php echo $data['id']; ?>"></label>
                                        <input type="hidden" name="result-<?php echo $data['id']; ?>" id="result-<?php echo $data['id']; ?>" class="form-control">
                                    </div>
                                    <div class="capaResultado"></div>
                                </td>
                                <td class="btn-guardarInfo">
                                    <button type="button" class="btn btn-success btn-xs guardar" data-id="<?php echo $data['id']; ?>">Guardar datos</button>
                                    <button type="button" class="btn btn-danger btn-xs finalizar" data-id="<?php echo $data['id']; ?>">Finalizar</button>
                                </td>

                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/guardarHistorial.js"></script>
    <script src="js/info_nombre_codigo.js"></script>
    <script src="js/tabla.js"></script>
    <script src="js/accion.js"></script>
    <script src="js/finalizar.js"></script>
    <script src="js/select_Si_No.js"></script>
    <script src="js/validarCamposIndex.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Modal textarea -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Última Anotación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="modalTexto" style="height: 400px; width:100%" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const textAreas = document.querySelectorAll("textarea[data-bs-toggle='modal']");
            const modal = new bootstrap.Modal(document.getElementById("exampleModal"));

            textAreas.forEach(function(textArea) {
                textArea.addEventListener("click", function() {
                    const info = this.value;
                    const modalTexto = document.getElementById("modalTexto");
                    modalTexto.textContent = info;
                    modal.show();
                });
            });
        });
    </script>




</body>

</html>