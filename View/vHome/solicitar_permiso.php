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
                            <label for="fecha_inicio" class="fw-bold">
                             Fecha de Inicio <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                class="form-control form-control-lg"
                                id="fecha_inicio"
                                name="fecha_inicio"
                                required
                                min="<?php echo date('Y-m-d'); ?>"
                                value="<?php echo isset($fechaInicio) ? htmlspecialchars($fechaInicio) : ""; ?>">
                            <small class="form-text text-muted">No puede ser anterior a hoy</small>
                        </div>

                        <!-- Fecha Fin -->
                        <div class="col-md-6 form-group">
                            <label for="fecha_fin" class="fw-bold">
                                Fecha de Fin <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                class="form-control form-control-lg"
                                id="fecha_fin"
                                name="fecha_fin"
                                required
                                min="<?php echo date('Y-m-d'); ?>"
                                value="<?php echo isset($fechaFin) ? htmlspecialchars($fechaFin) : ""; ?>">
                            <small class="form-text text-muted">No puede ser más de 30 días</small>
                        </div>
                    </div>

                    <!-- Categoría de Permiso -->
                    <div class="form-group">
                        <label for="categoria" class="fw-bold">
                         Categoría del Permiso <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-select-lg" id="categoria" name="categoria" required>
                            <option value="" disabled selected>Seleccione una categoría</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?php echo $cat['id_categoria']; ?>"
                                    <?php echo (isset($idCategoria) && $idCategoria == $cat['id_categoria']) ? "selected" : ""; ?>>
                                    <?php echo htmlspecialchars($cat['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-muted d-block mt-2" id="descCategoria"></small>
                    </div>

                    <!-- Descripción del Permiso -->
                    <div class="form-group">
                        <label for="descripcion" class="fw-bold">
                            <i class="fas fa-pencil-alt"></i> Descripción <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control form-control-lg"
                            id="descripcion"
                            name="descripcion"
                            rows="4"
                            placeholder="Indique el motivo y detalles de su solicitud de permiso"
                            required
                            maxlength="500"><?php echo isset($descripcion) ? htmlspecialchars($descripcion) : ""; ?></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-gradient-primary btn-lg font-weight-medium" id="btnSolicitar" name="btnSolicitar" type="submit">
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
                <h5 class="mb-0">
                 Información Importante
                </h5>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li>Las solicitudes serán evaluadas en un plazo de <strong>2 días hábiles</strong></li>
                    <li>Cada solicitud debe incluir una <strong>descripción detallada</strong> del motivo</li>
                    <li>Recibirá una notificación cuando se evalúe su solicitud</li>
                </ul>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Contador de caracteres
    const descInput = document.getElementById('descripcion');
    const charCount = document.getElementById('charCount');

    if (descInput) {
        descInput.addEventListener('input', function () {
            charCount.textContent = this.value.length + '/500';
        });
        charCount.textContent = descInput.value.length + '/500';
    }

    // Validar que fecha_fin >= fecha_inicio
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');

    if (fechaInicio && fechaFin) {
        fechaInicio.addEventListener('change', function () {
            fechaFin.min = this.value;
            if (fechaFin.value && fechaFin.value < this.value) {
                fechaFin.value = '';
            }
        });
    }

    // Validar límite de 30 días
    const form = document.getElementById('formPermiso');
    if (form) {
        form.addEventListener('submit', function (e) {
            const inicio = new Date(fechaInicio.value);
            const fin = new Date(fechaFin.value);
            const dias = Math.ceil((fin - inicio) / (1000 * 60 * 60 * 24)) + 1;

            if (dias > 30) {
                e.preventDefault();
                alert('El permiso no puede exceder 30 días. Días solicitados: ' + dias);
                return false;
            }
        });
    }
});
</script>
