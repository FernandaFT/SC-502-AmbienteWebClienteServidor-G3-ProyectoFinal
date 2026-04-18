<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerConsultaAcciones.php";

if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}

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
                                <th>Detalle</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if ($totalSolicitudesAdmin === 0): ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No hay solicitudes para gestionar.</td>
                            </tr>
                            <?php else: ?>
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
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="?vista=detalle_solicitud&amp;id=<?= (int)$solicitud['id_solicitud']; ?>&amp;tipo=<?= urlencode($solicitud['tipo']); ?>&amp;origen=admin&amp;pagina=<?= (int)$pagina; ?>">
                                            Ver detalle
                                        </a>
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
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>

                <?php if ($totalSolicitudesAdmin > 0 && $totalPaginas > 1): ?>
                <nav class="mt-3" aria-label="Paginación">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php echo $pagina <= 1 ? "disabled" : ""; ?>">
                            <a class="page-link" href="?vista=pantallaAccionesAdmin&pagina=<?php echo $pagina - 1; ?>">Anterior</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?php echo $i === $pagina ? "active" : ""; ?>">
                            <a class="page-link" href="?vista=pantallaAccionesAdmin&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo $pagina >= $totalPaginas ? "disabled" : ""; ?>">
                            <a class="page-link" href="?vista=pantallaAccionesAdmin&pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>