<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerPermiso.php";
if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}
?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                     Mis Solicitudes de Permiso
                    </h4>
                    <a href="?vista=solicitar_permiso" class="btn btn-light btn-sm">
                     Nueva Solicitud
                    </a>
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
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Período</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Solicitado el</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($solicitudes as $solicitud): ?>
                                    <tr>
                                        <td class="text-center" style="width: 50px;">
                                            <strong><?php echo date('d/m/Y', strtotime($solicitud['fecha_inicio'])); ?></strong>
                                            <br>
                                            <small class="text-muted">hasta</small>
                                            <br>
                                            <strong><?php echo date('d/m/Y', strtotime($solicitud['fecha_fin'])); ?></strong>
                                        </td>
                                        <td class="text-center" style="width: 50px;">
                                            <span class="badge bg-info">
                                                <?php echo htmlspecialchars($solicitud['categoria']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center" style="width: 50px;">
                                            <small><?php echo htmlspecialchars(substr($solicitud['descripcion'], 0, 50)) . (strlen($solicitud['descripcion']) > 50 ? '...' : ''); ?></small>
                                        </td>
                                        <td class="text-center" style="width: 50px;">
                                            <small><?php echo date('d/m/Y H:i', strtotime($solicitud['fecha_solicitud'])); ?></small>
                                        </td>
                                        <td class="text-center" style="width: 50px;">
                                            <?php
                                            $estado = $solicitud['estado'];
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
                                            <span class="badge <?php echo $badgeClass; ?>">
                                             <?php echo $estado; ?>
                                            </span>
                                        </td>
                                        <td class="text-center" style="width: 50px;">
                                            <a href="?vista=detalle_solicitud&id=<?php echo $solicitud['id_solicitud']; ?>" 
                                               class="btn btn-sm btn-outline-primary" title="Ver detalles">
                                                Detalle solicitud
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


