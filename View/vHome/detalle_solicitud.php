<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerPermiso.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelConsultasAcciones.php";
if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}
if ($vista == "detalle_solicitud" && isset($_GET["id"]) && isset($_GET["tipo"])) {

    $idSolicitud = $_GET["id"];
    $tipoSolicitud = $_GET["tipo"];

    $solicitudDetalle = DetalleSolicitud($idSolicitud, $tipoSolicitud);
    
}
?>

<div class="row">
    <div class="col-lg-10 mx-auto">

        <?php
        if (isset($mensaje) && !empty($mensaje)) {
            echo $mensaje;
        }
        ?>

        <?php if ($solicitudDetalle): ?>

            <?php
            $estado = $solicitudDetalle['estado'];

            $badgeEstado = match ($estado) {
                'Pendiente' => 'bg-warning text-dark',
                'Aprobado' => 'bg-success',
                'Rechazado' => 'bg-danger',
                default => 'bg-secondary'
            };

            $badgeTipo = ($solicitudDetalle['tipo'] == "Vacaciones")
                ? "bg-primary"
                : "bg-info";
            ?>

            <div class="card shadow-lg border-0">

                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            Detalle de Acción de Personal
                        </h4>
                        <a href="?vista=mi_solicitudes" class="btn btn-light btn-sm">
                            Volver
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <!-- encabezado -->
                    <div class="row mb-4">

                        <div class="col-md-4">
                            <h6 class="text-muted">Empleado</h6>
                            <h5><?php echo htmlspecialchars($solicitudDetalle['nombre_empleado']); ?></h5>
                        </div>

                        <div class="col-md-4">
                            <h6 class="text-muted">Tipo</h6>
                            <h5>
                                <span class="badge <?php echo $badgeTipo; ?>">
                                    <?php echo $solicitudDetalle['tipo']; ?>
                                </span>
                            </h5>
                        </div>

                        <div class="col-md-4 text-md-end">
                            <h6 class="text-muted">Estado</h6>
                            <h5>
                                <span class="badge <?php echo $badgeEstado; ?>">
                                    <?php echo $estado; ?>
                                </span>
                            </h5>
                        </div>

                    </div>

                    <hr>

                    <!-- fechas -->
                    <div class="row mb-4">

                        <div class="col-md-4">
                            <h6 class="text-muted">Fecha Inicio</h6>
                            <p class="h5">
                                <?php echo date('d/m/Y', strtotime($solicitudDetalle['fecha_inicio'])); ?>
                            </p>
                        </div>

                        <div class="col-md-4">
                            <h6 class="text-muted">Fecha Fin</h6>
                            <p class="h5">
                                <?php echo date('d/m/Y', strtotime($solicitudDetalle['fecha_fin'])); ?>
                            </p>
                        </div>

                        <div class="col-md-4">
                            <h6 class="text-muted">Fecha Solicitud</h6>
                            <p class="h5">
                                <?php echo date('d/m/Y H:i', strtotime($solicitudDetalle['fecha_solicitud'])); ?>
                            </p>
                        </div>

                    </div>

                    <hr>

                    <!-- categoria -->
                    <div class="row mb-4">

                        <div class="col-md-6">
                            <h6 class="text-muted">Categoría</h6>
                            <p class="h5">
                                <span class="badge bg-secondary">
                                    <?php echo $solicitudDetalle['categoria']; ?>
                                </span>
                            </p>
                        </div>

                        <?php if (!empty($solicitudDetalle['dias_solicitados'])): ?>
                        <div class="col-md-6">
                            <h6 class="text-muted">Días solicitados</h6>
                            <p class="h5">
                                <?php echo $solicitudDetalle['dias_solicitados']; ?>
                            </p>
                        </div>
                        <?php endif; ?>

                    </div>

                    <hr>

                    <!-- descripcion -->
                    <div class="mb-4">
                        <h6 class="text-muted">Descripción</h6>
                        <div class="p-3 bg-light rounded">
                            <?php echo nl2br(htmlspecialchars($solicitudDetalle['descripcion'])); ?>
                        </div>
                    </div>

                    <?php if ($estado != 'Pendiente'): ?>

                        <hr>

                        <div class="row mb-4">

                            <div class="col-md-6">
                                <h6 class="text-muted">Evaluado por</h6>
                                <p class="h5">
                                    <?php echo $solicitudDetalle['nombre_encargado'] ?? 'N/A'; ?>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Fecha respuesta</h6>
                                <p class="h5">
                                    <?php 
                                    echo $solicitudDetalle['fecha_respuesta']
                                        ? date('d/m/Y H:i', strtotime($solicitudDetalle['fecha_respuesta']))
                                        : 'N/A';
                                    ?>
                                </p>
                            </div>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="card-footer bg-light">
                    <a href="?vista=mi_solicitudes" class="btn btn-outline-secondary">
                        Volver a mis solicitudes
                    </a>
                </div>

            </div>

        <?php else: ?>

            <div class="alert alert-danger">
                La solicitud no fue encontrada
            </div>

            <a href="?vista=mi_solicitudes" class="btn btn-outline-primary">
                Volver
            </a>

        <?php endif; ?>

    </div>
</div>