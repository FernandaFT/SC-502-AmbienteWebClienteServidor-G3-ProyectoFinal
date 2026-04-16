<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelNotificacion.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$idUsuario = $_SESSION["IdUsuario"] ?? null;
$pagina = (int)($_GET["pagina"] ?? 1);

if (!$idUsuario) {
    header("Location: inicio_sesion.php");
    exit;
}

// Al entrar a "ver todas", dejarlas como leídas
MarcarTodasComoLeidas($idUsuario);

// Obtener datos de paginación (ya con estado actualizado)
$notificaciones = ObtenerNotificacionesUsuario($idUsuario);

// Obtener información de solicitud para cada notificación
foreach ($notificaciones as &$notif) {
    if (isset($notif['id_usuario_origen'])) {
        $solicitud = ObtenerSolicitudDeNotificacion($notif['id_usuario_origen'], $notif['descripcion']);
        if ($solicitud) {
            $notif['id_solicitud'] = $solicitud['id_solicitud'];
            $notif['tipo_solicitud'] = $solicitud['tipo'];
        } else {
            $notif['id_solicitud'] = null;
            $notif['tipo_solicitud'] = null;
        }
    }
}
unset($notif);

$totalItems = count($notificaciones);
$itemsPorPagina = 15;
$totalPaginas = ceil($totalItems / $itemsPorPagina);

// Validar página
if ($pagina < 1) $pagina = 1;
if ($pagina > $totalPaginas && $totalPaginas > 0) $pagina = $totalPaginas;

// Calcular offset
$offset = ($pagina - 1) * $itemsPorPagina;
$notificacionesPaginadas = array_slice($notificaciones, $offset, $itemsPorPagina);
?>

<link rel="stylesheet" href="../assets/css/historialNotificaciones.css">

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">
                <h5>Historial de Notificaciones</h5>
            </div>
        </div>
        <div class="ibox-body">
            <?php if (empty($notificacionesPaginadas)): ?>
                <div class="alert alert-info">
                    <i class="mdi mdi-information"></i> No hay notificaciones para mostrar.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Desde</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notificacionesPaginadas as $notif): ?>
                                <tr>
                                    <td>
                                        <strong><?php echo htmlspecialchars($notif['nombre_origen']); ?></strong>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars(substr($notif['descripcion'], 0, 100)); ?>
                                        <?php if (strlen($notif['descripcion']) > 100): ?>...<?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $fecha = new DateTime($notif['fecha_creacion']);
                                        echo $fecha->format('d/m/Y H:i');
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $estado = isset($notif['leida']) && $notif['leida'] ? 'Leída' : 'No leída';
                                        $clase = isset($notif['leida']) && $notif['leida'] ? 'badge-success' : 'badge-warning';
                                        ?>
                                        <span class="badge <?php echo $clase; ?>">
                                            <?php echo $estado; ?>
                                        </span>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <?php if ($totalPaginas > 1): ?>
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">
                            <?php if ($pagina > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="inicio.php?vista=historialNotificaciones&pagina=1">Primera</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="inicio.php?vista=historialNotificaciones&pagina=<?php echo $pagina - 1; ?>">Anterior</a>
                                </li>
                            <?php endif; ?>

                            <?php 
                            $inicio = max(1, $pagina - 2);
                            $fin = min($totalPaginas, $pagina + 2);
                            
                            for ($i = $inicio; $i <= $fin; $i++):
                            ?>
                                <li class="page-item <?php echo $i === $pagina ? 'active' : ''; ?>">
                                    <a class="page-link" href="inicio.php?vista=historialNotificaciones&pagina=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($pagina < $totalPaginas): ?>
                                <li class="page-item">
                                    <a class="page-link" href="inicio.php?vista=historialNotificaciones&pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="inicio.php?vista=historialNotificaciones&pagina=<?php echo $totalPaginas; ?>">Última</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

                <!-- Información de paginación -->
                <div class="text-center text-muted mt-3">
                    <small>
                        Mostrando <?php echo $offset + 1; ?> - <?php echo min($offset + $itemsPorPagina, $totalItems); ?> 
                        de <?php echo $totalItems; ?> notificaciones
                    </small>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="../assets/funciones/historialNotificaciones.js"></script>