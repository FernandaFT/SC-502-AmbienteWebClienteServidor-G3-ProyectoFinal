<?php 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutGeneral.php"; 
    include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/VacacionesModel.php"; 
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Vacaciones - Proyecto Final</title>
    <?php CSSGeneral(); ?>
</head>
<body>
    <div class="container-scroller">
        <?php menuSuperiorGeneral(); ?>

        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <?php if(isset($_GET["msj"]) && $_GET["msj"] == "success"): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>¡Éxito!</strong> Tu solicitud ha sido registrada correctamente.
                        </div>
                    <?php endif; ?>

                    <?php if(isset($_GET["msj"]) && $_GET["msj"] == "error"): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> No se pudo procesar la solicitud. Revisa los datos.
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Nueva Solicitud</h4>
                                    <p class="card-description">Ingresa las fechas de tu descanso</p>
                                    
                                    <form action="/SC-502-AmbienteWebClienteServidor-G3-ProyectoFinal/Controller/VacacionesController.php" method="POST">
                                    <input type="hidden" name="txtIdUsuario" value="<?php echo $_SESSION['IdUsuario']; ?>">                                        <div class="form-group">
                                            <label>Fecha de Inicio</label>
                                            <input type="date" name="txtFechaInicio" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Fecha de Finalización</label>
                                            <input type="date" name="txtFechaFin" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Días a solicitar</label>
                                            <input type="number" name="txtDias" class="form-control" placeholder="Ej: 5" min="1" required>
                                        </div>

                                        <button type="submit" name="btnEnviarSolicitud" class="btn btn-primary mr-2">Enviar Solicitud</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Mi Historial de Solicitudes</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Inicio</th>
                                                    <th>Fin</th>
                                                    <th>Días</th>
                                                    <th>Estado</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $objModel = new VacacionesModel();
                                                    $datos = $objModel->consultarSolicitudes($_SESSION["IdUsuario"]);

                                                    if($datos) {
                                                        while($fila = mysqli_fetch_array($datos)) {
                                                            echo "<tr>";
                                                            echo "<td>" . $fila["fecha_inicio"] . "</td>";
                                                            echo "<td>" . $fila["fecha_fin"] . "</td>";
                                                            echo "<td>" . $fila["dias_solicitados"] . "</td>";
                                                            
                                                            $claseBadge = ($fila["estado_solicitud"] == 'Pendiente') ? 'badge-warning' : 'badge-success';
                                                            echo "<td><label class='badge $claseBadge'>" . $fila["estado_solicitud"] . "</label></td>";
                                                            
                                                            echo "<td>
                                                                    <button class='btn btn-outline-danger btn-sm'>
                                                                        <i class='fa fa-trash'></i>
                                                                    </button>
                                                                  </td>";
                                                            echo "</tr>";
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> </div>
            </div>
        </div>
    </div>

    <?php JSGeneral(); ?>
</body>
</html>