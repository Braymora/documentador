<?php
include 'config/conexion.php';

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


    <link rel="stylesheet" href="CSS/estilo.css">
</head>

<body>
    <header>
        <nav class="menu col-lg-6">
            <img src="imagenes/Logo_Colvatel.png" alt="" class="logo" />
            <ul class="menu-cont">
                <a class="menu-cont__items" href="index.php">Documentos</a>
                <a class="menu-cont__items" href="historial.php">Historial</a>
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

    <div class="container">
        <h1 style="font-size: 20px; text-align: center; color: #0e3858; margin: 20px"><b>Hitorial OC</b></h1>


        <div class="container table-responsive">
            <button type="button" name='export_data' value="Export to excel" class="btn btn-info" onclick="exportar()">Exportar a Excel</button>
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
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM historial ORDER BY id_aprovisionamiento";

                    $resultado = mysqli_query($conexion, $query);
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($data = mysqli_fetch_array($resultado)) {

                    ?>
                            <tr value="<?php echo $data['id']; ?>">
                                <td class="table-items"><?php echo $data['id_aprovisionamiento']; ?></td>
                                <td class="table-items"><?php echo $data['estado_actual']; ?></td>
                                <td class="table-items"><?php echo $data['fecha_creacion']; ?></td>
                                <td class="table-items"><?php echo $data['ans']; ?></td>
                                <td class="table-items"><?php echo $data['cuenta_cliente']; ?></td>
                                <td class="table-items"><?php echo $data['asignado_a']; ?></td>
                                <td class="table-items"><?php echo $data['ciudad_instalacion']; ?></td>
                                <td class="table-items">
                                    <textarea id="anotacion-resumen" name="u_anotacion_resumen" cols="30" rows="4" class="text-obs" readonly data-bs-toggle="modal" data-bs-target="#exampleModal" data-info="<?php echo $data['u_anotacion_resumen']; ?>"><?php echo $data['u_anotacion_resumen']; ?></textarea>

                                </td>
                                <td class="table-items"><?php echo $data['segmento']; ?></td>
                                <td class="tabla-items"><?php echo $data['estado_historial']; ?></td>
                                <td class="tabla-items"><?php echo $data['codigo_historial']; ?></td>
                                <td class="tabla-items"><?php echo $data['info_codigo_historial']; ?></td>
                                <td class="tabla-items"><?php echo $data['fecha_proyeccion_historial']; ?></td>
                                <td class="tabla-items"><textarea name="observaciones_historial" id="" cols="30" rows="4" class="text-obs" disabled=""><?php echo $data['observaciones_historial']; ?></textarea></td>
                                <td class="tabla-items"><?php echo $data['fecha']; ?></td>
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

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });

            //Creamos una fila en el head de la tabla y lo clonamos para cada columna
            $('#example thead tr').clone(true).appendTo('#example thead');

            $('#example thead tr:eq(1) th').each(function(i) {
                var title = $(this).text(); //es el nombre de la columna
                $(this).html('<input type="text" placeholder="Search...' + title + '" />');

                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });
    </script>

    <script src="js/exportar_excel.js"></script>

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