<?php
if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}

$clientes = ListarClientesActivos();
$filtros = $_SESSION["reporte_filtros"] ?? [];
$datos = $datosReportePaginados ?? [];
$hayDatosReporte = !empty($_SESSION["reporte_horas"] ?? []);

$fvInicio = $filtros["fechaInicio"] ?? "";
$fvFin = $filtros["fechaFin"] ?? "";
$fvCliente = isset($filtros["id_cliente"]) ? (string)(int)$filtros["id_cliente"] : "";
?>

<div class="container mt-4">

    <h3 class="mb-1">Reporte de horas</h3>
    <p class="text-muted small">Filtre por rango de fechas y cliente. El resultado muestra empleado, categoría de actividad, clasificación (ordinaria, extra o doble) y cantidad total de horas.</p>

    <?php if (!empty($mensajeReporte)) {
        echo $mensajeReporte;
    } ?>
    <form id="FormReporteHoras" method="POST" action="inicio.php?vista=reporteria" class="mt-3">

        <div class="row g-3">

            <div class="col-md-4">
                <label class="form-label" for="fechaInicio">Fecha inicio</label>
                <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" value="<?= htmlspecialchars($fvInicio) ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label" for="fechaFin">Fecha fin</label>
                <input type="date" name="fechaFin" id="fechaFin" class="form-control" value="<?= htmlspecialchars($fvFin) ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label" for="id_cliente">Cliente</label>
                <select name="id_cliente" id="id_cliente" class="form-control">
                    <option value="0" <?= $fvCliente === "" || $fvCliente === "0" ? "selected" : "" ?>>Todos los clientes</option>
                    <?php foreach ($clientes as $c) {
                        $id = (int)$c["id_cliente"];
                        $sel = $fvCliente !== "" && (string)$id === $fvCliente ? " selected" : "";
                        echo "<option value=\"{$id}\"" . $sel . ">" . htmlspecialchars($c["nombre"]) . "</option>";
                    } ?>
                </select>
            </div>

        </div>

        <div class="mt-4 d-flex flex-wrap gap-2">
            <button type="submit" name="btnGenerarReporte" class="btn btn-primary" id="btnGenerarReporte">
                Generar reporte
            </button>
            <button type="submit" name="btnExportarExcel" class="btn btn-success" id="btnExportarExcel">
                Descargar Excel (CSV)
            </button>
        </div>

    </form>

    <form method="POST" action="inicio.php?vista=reporteria" class="d-inline">
        <button type="submit" name="btnLimpiarFiltrosReporte" class="btn btn-outline-secondary mt-2" id="btnLimpiarFiltrosReporte">
            Limpiar filtros
        </button>
    </form>

    <hr class="my-4">

    <?php if ($hayDatosReporte): ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover mt-2">
                <thead class="table-light">
                    <tr>
                        <th>Empleado</th>
                        <th>Categoría</th>
                        <th>Clasificación</th>
                        <th class="text-end">Cantidad de horas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $fila): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila["empleado"] ?? "") ?></td>
                            <td><?= htmlspecialchars($fila["categoria"] ?? "") ?></td>
                            <td><?= htmlspecialchars($fila["clasificacion_hora"] ?? "") ?></td>
                            <td class="text-end"><?= htmlspecialchars((string)($fila["cantidad_horas"] ?? "")) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (($totalPaginasReporte ?? 1) > 1): ?>
        <nav class="mt-3" aria-label="Paginación del reporte">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($paginaReporte ?? 1) <= 1 ? "disabled" : "" ?>">
                    <a class="page-link" href="?vista=reporteria&pagina_reporte=<?= (int)($paginaReporte ?? 1) - 1 ?>">Anterior</a>
                </li>
                <?php for ($i = 1; $i <= (int)($totalPaginasReporte ?? 1); $i++): ?>
                <li class="page-item <?= $i === (int)($paginaReporte ?? 1) ? "active" : "" ?>">
                    <a class="page-link" href="?vista=reporteria&pagina_reporte=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?= ($paginaReporte ?? 1) >= (int)($totalPaginasReporte ?? 1) ? "disabled" : "" ?>">
                    <a class="page-link" href="?vista=reporteria&pagina_reporte=<?= (int)($paginaReporte ?? 1) + 1 ?>">Siguiente</a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>

    <?php endif; ?>

</div>
