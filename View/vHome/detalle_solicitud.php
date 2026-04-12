<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerPermiso.php";
if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}
?>

<div class="row">
    <div class="col-lg-8 mx-auto">

        <?php
        if (isset($mensaje) && !empty($mensaje)) {
            echo $mensaje;
        }
        ?>

        <?php if ($solicitudDetalle): ?>

            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            Detalle de Solicitud
                        </h4>
                        <a href="?vista=mi_solicitudes" class="btn btn-light btn-sm">
                             Volver
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">
                                 Empleado
                            </h6>
                            <h5><?php echo htmlspecialchars($solicitudDetalle['nombre_empleado']); ?></h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <?php
                            $estado = $solicitudDetalle['estado'];
                            $badgeClass = match ($estado) {
                                'Pendiente' => 'bg-warning text-dark',
                                'Aprobado' => 'bg-success',
                                'Rechazado' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                            $icono = match ($estado) {
                                'Pendiente' => 'fa-hourglass-end',
                                'Aprobado' => 'fa-check-circle',
                                'Rechazado' => 'fa-times-circle',
                                default => 'fa-question-circle'
                            };
                            ?>
                            <h6 class="text-muted mb-1">Estado</h6>
                            <h5>
                                <span class="badge <?php echo $badgeClass; ?> p-2">
                                     <?php echo $estado; ?>
                                </span>
                            </h5>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-calendar-start"></i> Fecha de Inicio
                            </h6>
                            <p class="h5"><?php echo date('d/m/Y', strtotime($solicitudDetalle['fecha_inicio'])); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-calendar-end"></i> Fecha de Fin
                            </h6>
                            <p class="h5"><?php echo date('d/m/Y', strtotime($solicitudDetalle['fecha_fin'])); ?></p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                 Categoría
                            </h6>
                            <p class="h5">
                                <span class="badge bg-info"><?php echo htmlspecialchars($solicitudDetalle['categoria']); ?></span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-clock"></i> Solicitado el
                            </h6>
                            <p class="h5"><?php echo date('d/m/Y H:i', strtotime($solicitudDetalle['fecha_solicitud'])); ?></p>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6 class="text-muted mb-2">
                            <i class="fas fa-pencil-alt"></i> Descripción
                        </h6>
                        <div class="p-3 bg-light rounded">
                            <p class="mb-0"><?php echo htmlspecialchars($solicitudDetalle['descripcion']); ?></p>
                        </div>
                    </div>

                    <?php if ($solicitudDetalle['estado'] != 'Pendiente'): ?>
                        <hr>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-user-check"></i> Evaluado por
                                </h6>
                                <p class="h5"><?php echo htmlspecialchars($solicitudDetalle['nombre_encargado'] ?? 'N/A'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-calendar-check"></i> Fecha de Respuesta
                                </h6>
                                <p class="h5"><?php echo $solicitudDetalle['fecha_respuesta'] ? date('d/m/Y H:i', strtotime($solicitudDetalle['fecha_respuesta'])) : 'N/A'; ?></p>
                            </div>
                        </div>

                        <?php if ($solicitudDetalle['estado'] == 'Rechazado' && !empty($solicitudDetalle['motivo_rechazo'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <h6 class="alert-heading">
                                    <i class="fas fa-exclamation-circle"></i> Motivo del Rechazo
                                </h6>
                                <p class="mb-0"><?php echo htmlspecialchars($solicitudDetalle['motivo_rechazo']); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($solicitudDetalle['observaciones'])): ?>
                            <div class="alert alert-info" role="alert">
                                <h6 class="alert-heading">
                                    <i class="fas fa-sticky-note"></i> Observaciones
                                </h6>
                                <p class="mb-0"><?php echo htmlspecialchars($solicitudDetalle['observaciones']); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>

                <div class="card-footer bg-light">
                    <a href="?vista=mi_solicitudes" class="btn btn-outline-secondary">
                         Volver a mis solicitudes
                    </a>
                </div>
            </div>

        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $mensaje ?: "La solicitud no fue encontrada."; ?>
            </div>
            <a href="?vista=mi_solicitudes" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        <?php endif; ?>

    </div>
</div>
