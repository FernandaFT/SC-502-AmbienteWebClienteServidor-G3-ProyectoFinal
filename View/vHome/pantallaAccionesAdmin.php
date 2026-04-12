<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerConsultaAcciones.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelConsultasAcciones.php";

if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}

//Todas las solicitudes para aprobar o rechazar
$solicitudes = ObtenerSolicitudes();
?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0">

            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">
                    Aprobación de Acciones de Personal
                </h4>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Tipo</th>
                                <th>Período</th>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Estado</th>
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

                                    <td><?= $solicitud['id_solicitud']; ?></td>

                                    <td><?= $solicitud['usuario']; ?></td>

                                    <td>
                                        <span class="badge <?= $badgeTipo ?>">
                                            <?= $solicitud['tipo']; ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?= date('d/m/Y', strtotime($solicitud['fecha_inicio'])); ?>
                                        <br>
                                        <small class="text-muted">
                                            hasta
                                            <?= date('d/m/Y', strtotime($solicitud['fecha_fin'])); ?>
                                        </small>
                                    </td>

                                    <td><?= $solicitud['categoria']; ?></td>

                                    <td>
                                        <?= substr($solicitud['descripcion'], 0, 40); ?>
                                    </td>

                                    <td>
                                        <span class="badge <?= $badgeEstado ?>">
                                            <?= $estado ?>
                                        </span>
                                    </td>

                                    <td>

                                        <form method="POST">

                                            <input type="hidden" id="Solicitud_id" name="Solicitud_id" value="<?= $solicitud['id_solicitud']; ?>">
                                            <input type="hidden" name="tipo" id="tipo" value="<?= $solicitud['tipo']; ?>">
                                            <?php if ($estado == 'Pendiente' || $estado == '1'): ?>

                                                <button type="submit"
                                                    name="btnAprobar"
                                                    id="btnAprobar"
                                                    class="btn btn-sm btn-success">
                                                    Aprobar
                                                </button>

                                                <button type="submit"
                                                    name="btnRechazar"
                                                    id="btnRechazar"
                                                    class="btn btn-sm btn-danger">
                                                    Rechazar
                                                </button>

                                            <?php else: ?>

                                                <span class="text-muted">Sin acciones</span>

                                            <?php endif; ?>

                                        </form>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>