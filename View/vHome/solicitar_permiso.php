<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerPermiso.php";
if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}
?>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-calendar-check"></i> Solicitar Permiso
                </h4>
            </div>

            <div class="card-body p-5">

                <?php
                if (isset($mensaje) && !empty($mensaje)) {
                    echo $mensaje;
                }
                ?>

                <form class="pt-3" method="POST" id="formPermiso" action="?vista=solicitar_permiso">

                    <div class="row">
                        <!-- Fecha Inicio -->
                        <div class="col-md-6 form-group">
                            <label class="fw-bold">
                                Fecha de Inicio <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                class="form-control form-control-lg"
                                id="fecha_inicio"
                                name="fecha_inicio"
                                min="<?php echo date('Y-m-d'); ?>"
                                value="<?php echo isset($fechaInicio) ? htmlspecialchars($fechaInicio) : ""; ?>">
                        </div>

                        <!-- Fecha Fin -->
                        <div class="col-md-6 form-group">
                            <label class="fw-bold">
                                Fecha de Fin <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                class="form-control form-control-lg"
                                id="fecha_fin"
                                name="fecha_fin"
                                min="<?php echo date('Y-m-d'); ?>"
                                value="<?php echo isset($fechaFin) ? htmlspecialchars($fechaFin) : ""; ?>">
                        </div>
                    </div>

                    <!-- Categoría -->
                    <div class="form-group">
                        <label class="fw-bold">
                            Categoría del Permiso <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-select-lg" id="categoria" name="categoria">
                            <option value="">Seleccione una categoría</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?php echo $cat['id_categoria']; ?>"
                                    <?php echo (isset($idCategoria) && $idCategoria == $cat['id_categoria']) ? "selected" : ""; ?>>
                                    <?php echo htmlspecialchars($cat['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Descripción -->
                    <div class="form-group">
                        <label class="fw-bold">
                            Descripción <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control form-control-lg"
                            id="descripcion"
                            name="descripcion"
                            rows="4"
                            maxlength="500"
                            placeholder="Indique el motivo del permiso"><?php echo isset($descripcion) ? htmlspecialchars($descripcion) : ""; ?></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-gradient-primary btn-lg"
                            id="btnSolicitar"
                            name="btnSolicitar"
                            type="submit">
                            ENVIAR SOLICITUD
                        </button>

                        <a href="?vista=mi_solicitudes" class="btn btn-outline-secondary btn-lg">
                            VER MIS SOLICITUDES
                        </a>
                    </div>

                </form>

            </div>
        </div>

        <!-- Información -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Información Importante</h5>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li>Las solicitudes serán evaluadas en un plazo de <strong>2 días hábiles</strong></li>
                    <li>Cada solicitud debe incluir una <strong>descripción detallada</strong></li>
                    <li>Recibirá una notificación cuando se evalúe su solicitud</li>
                </ul>
            </div>
        </div>

    </div>
</div>