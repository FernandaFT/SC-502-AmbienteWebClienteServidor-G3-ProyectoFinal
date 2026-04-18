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

$esVistaAdmin = isset($_GET["origen"]) && $_GET["origen"] === "admin";
$paginaVolverAdmin = isset($_GET["pagina"]) ? max(1, (int)$_GET["pagina"]) : 1;
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
            $estadoRaw = $solicitudDetalle['estado'] ?? '';
            $estado = match ((string)$estadoRaw) {
                '1', 'Pendiente' => 'Pendiente',
                '2', 'Aprobado' => 'Aprobado',
                '3', 'Rechazado' => 'Rechazado',
                default => (string)$estadoRaw,
            };
            $solicitudGestionada = !in_array((string)$estadoRaw, ['Pendiente', '1'], true);

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

                    <?php if ($solicitudGestionada): ?>

                        <hr>

                        <div class="row mb-4">

                            <div class="col-md-6">
                                <h6 class="text-muted">Evaluado por</h6>
                                <p class="h5">
                                    <?php
                                    $nombreEnc = trim((string)($solicitudDetalle['nombre_encargado'] ?? ''));
                                    echo $nombreEnc !== '' ? htmlspecialchars($nombreEnc) : 'N/A';
                                    ?>
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Fecha respuesta</h6>
                                <p class="h5">
                                    <?php
                                    $fechaResp = $solicitudDetalle['fecha_respuesta'] ?? null;
                                    $tsResp = $fechaResp ? strtotime((string)$fechaResp) : false;
                                    echo ($fechaResp && $tsResp && $tsResp > 0)
                                        ? date('d/m/Y H:i', $tsResp)
                                        : 'N/A';
                                    ?>
                                </p>
                            </div>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="card-footer bg-light">
                    <?php if ($esVistaAdmin): ?>
                    <a href="?vista=pantallaAccionesAdmin&amp;pagina=<?php echo $paginaVolverAdmin; ?>" class="btn btn-outline-secondary">
                        Volver a aprobaciones
                    </a>
                    <?php else: ?>
                    <a href="?vista=mi_solicitudes" class="btn btn-outline-secondary">
                        Volver a mis solicitudes
                    </a>
                    <?php endif; ?>
                </div>

            </div>

        <?php else: ?>

            <div class="alert alert-danger">
                La solicitud no fue encontrada
            </div>

            <a href="<?php echo $esVistaAdmin ? '?vista=pantallaAccionesAdmin&pagina=' . $paginaVolverAdmin : '?vista=mi_solicitudes'; ?>" class="btn btn-outline-primary">
                Volver
            </a>

        <?php endif; ?>

    </div>
</div>