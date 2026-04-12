<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerPermiso.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelConsultasAcciones.php";
if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}
$solicitudes = ObtenerMisSolicitudes($_SESSION["IdUsuario"]);
?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        Mis Solicitudes de Acciones de Personal
                    </h4>

                    <div class="d-flex gap-2">
                        <a href="?vista=solicitar_permiso" class="btn btn-light btn-sm">
                            Nuevo Permiso
                        </a>

                        <a href="?vista=solicitar_vacaciones" class="btn btn-light btn-sm">
                            Nueva Vacación
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <?php
                if (isset($mensaje) && !empty($mensaje)) {
                    echo $mensaje;
                }
                ?>

                <?php if (empty($solicitudes)): ?>
                    <div class="alert alert-info" role="alert">
                        No tienes solicitudes registradas.
                        <a href="?vista=solicitar_permiso" class="alert-link">Crea una nueva.</a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Período</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Fecha solicitud</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($solicitudes as $solicitud): ?>

                                    <?php
                                    $estado = $solicitud['estado'];

                                    $badgeEstado = match ($estado) {
                                        'Pendiente', '1' => 'bg-warning text-dark',
                                        'Aprobado', '2' => 'bg-success',
                                        'Rechazado', '3' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };

                                    $badgeTipo = $solicitud['tipo'] == 'Vacaciones'
                                        ? 'bg-primary'
                                        : 'bg-info';
                                    ?>

                                    <tr>

                                        <td><?php echo $solicitud['id_solicitud']; ?></td>

                                        <td>
                                            <span class="badge <?php echo $badgeTipo; ?>">
                                                <?php echo $solicitud['tipo']; ?>
                                            </span>
                                        </td>

                                        <td>
                                            <?php echo date('d/m/Y', strtotime($solicitud['fecha_inicio'])); ?>
                                            <br>
                                            <small class="text-muted">
                                                hasta
                                                <?php echo date('d/m/Y', strtotime($solicitud['fecha_fin'])); ?>
                                            </small>
                                        </td>

                                        <td>
                                            <?php echo $solicitud['categoria']; ?>
                                        </td>

                                        <td>
                                            <?php echo substr($solicitud['descripcion'], 0, 40); ?>
                                        </td>

                                        <td>
                                            <span class="badge <?php echo $badgeEstado; ?>">
                                                <?php echo $estado; ?>
                                            </span>
                                        </td>

                                        <td>
                                            <?php echo date('d/m/Y', strtotime($solicitud['fecha_solicitud'])); ?>
                                        </td>

                                        <td>
                                            <a href="?vista=detalle_solicitud&id=<?php echo $solicitud['id_solicitud']; ?>&tipo=<?php echo $solicitud['tipo']; ?>"
                                                class="btn btn-sm btn-outline-primary">
                                                Ver
                                            </a>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>