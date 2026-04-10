<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerDashboard.php";
?>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100 bg-gradient-danger card-img-holder text-white">
            <div class="card-body d-flex align-items-center">
                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <div class="row align-items-center">
                    <div class="col-md-8 d-flex align-items-center">
                        <i class="fa fa-user-circle-o fa-2x me-3"></i>
                        <div>
                            <h6>Bienvenid@</h6>
                            <h5><?php echo $saludo; ?></h5>
                            <p><?php echo $nombreUsuario; ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <i class="fa fa-clock-o fa-2x me-3"></i>
                        <div>
                            <h6>Hora</h6>
                            <h5><?php echo $horaActual; ?></h5>
                            <p><?php echo $fechaActual; ?></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">


    <?php if ($rol === 2) { ?>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100 bg-gradient-primary card-img-holder text-white">
                <div class="card-body d-flex align-items-center">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <i class="fa fa-smile-o fa-2x me-3"></i>
                    <div>
                        <h6>Vacaciones</h6>
                        <h4><?php echo $diasVacaciones; ?> días</h4>
                        <small>Disponibles</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100 bg-gradient-primary card-img-holder text-white">
                <div class="card-body d-flex align-items-center">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <i class="fa fa-history fa-2x me-3"></i>
                    <div>
                        <h6>Horas Totales</h6>
                        <h4><?php echo $horasTotales; ?> h</h4>
                        <small>Registradas</small>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($rol === 1) { ?>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100 bg-gradient-primary card-img-holder text-white">
                <div class="card-body d-flex align-items-center">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <i class="fa fa-paste fa-2x me-3"></i>
                    <div>
                        <h6>Solicitudes por revisar</h6>
                        <h4><?php echo $solicitudesPorRevisar; ?></h4>
                        <small>En espera</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100 bg-gradient-primary card-img-holder text-white">
                <div class="card-body d-flex align-items-center">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <i class="fa fa-id-card-o fa-2x me-3"></i>
                    <div>
                        <h6>Usuarios registrados</h6>
                        <h4><?php echo $totalUsuarios; ?></h4>
                        <small>Activos en el sistema</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100 bg-gradient-primary card-img-holder text-white">
                <div class="card-body d-flex align-items-center">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <i class="fa fa-users fa-2x me-3"></i>
                    <div>
                        <h6>Clientes activos</h6>
                        <h4><?php echo $clientesActivos; ?></h4>
                        <small>En operación</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100 bg-gradient-primary card-img-holder text-white">
                <div class="card-body d-flex align-items-center">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <i class="fa fa-handshake-o fa-2x me-3"></i>
                    <div>
                        <h6>Solicitudes procesadas</h6>
                        <h4><?php echo $solicitudesAprobadas; ?> Aprobadas</h4>
                        <small><?php echo $solicitudesRechazadas; ?> rechazadas</small>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

<?php if ($rol === 2) { ?>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100 bg-gradient-primary card-img-holder text-white">
                <div class="card-body d-flex align-items-center">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <i class="fa fa-file-text-o fa-2x me-3"></i>
                    <div>
                        <h6>Solicitudes Pendientes</h6>
                        <h3><?php echo $solicitudesPendientes; ?></h3>
                        <small>En espera</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100 bg-gradient-primary card-img-holder text-white">
                <div class="card-body d-flex align-items-start">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <i class="fa fa-pencil-square-o fa-2x me-3"></i>
                    <div>
                        <h6>Último Registro</h6>
                        <p>
                            <strong><?php echo $ultimaCantidad; ?> h</strong> •
                            <?php echo $ultimoCliente; ?> •
                            <?php echo $ultimaCategoria; ?> •
                            <?php echo $ultimaFecha; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php } ?>