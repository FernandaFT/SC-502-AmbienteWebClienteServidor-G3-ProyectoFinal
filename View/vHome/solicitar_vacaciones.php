<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerVacaciones.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelVacaciones.php";
if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}
ActualizarVacaciones($_SESSION["IdUsuario"]);
$diasDisponibles = ObtenerDiasDisponibles($_SESSION["IdUsuario"]);

?>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-lg border-0">

            <div class="card-header bg-gradient-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-plane-departure"></i> Solicitar Vacaciones
                </h4>
            </div>

            <div class="card-body p-5">
                <?php
                
                if (isset($mensaje) && !empty($mensaje)) {
                    echo $mensaje;
                }
                ?>
                <div id="mensajeVacaciones"></div>
                <form class="pt-3" method="POST" id="formVacaciones" action="?vista=solicitar_vacaciones">

                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label class="fw-bold">Fecha Inicio *</label>
                            <input type="date"
                                class="form-control form-control-lg"
                                id="fecha_inicio"
                                name="fecha_inicio"
                                min="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label class="fw-bold">Fecha Fin *</label>
                            <input type="date"
                                class="form-control form-control-lg"
                                id="fecha_fin"
                                name="fecha_fin"
                                min="<?php echo date('Y-m-d'); ?>">
                        </div>

                    </div>

                    <!-- Dias calculados -->
                    <div class="form-group mt-3">
                        <label class="fw-bold">Días solicitados</label>
                        <input type="text"
                            class="form-control form-control-lg"
                            id="dias"
                            name="dias"
                            value=""
                            readonly>
                    </div>

                    <!-- Dias disponibles -->
                    <div class="form-group mt-3">
                        <label class="fw-bold">Días disponibles</label>
                        <input type="text"
                            class="form-control form-control-lg text-success fw-bold"
                            id="diasDisponibles"
                            value="<?php echo $diasDisponibles ?? 0; ?>"
                            readonly>
                    </div>

                    <div class="form-group mt-3">
                        <label class="fw-bold">Descripción *</label>
                        <textarea
                            class="form-control form-control-lg"
                            name="descripcion"
                            rows="4"
                            required
                            maxlength="500"></textarea>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button class="btn btn-gradient-primary btn-lg" name="btnSolicitar" type="submit">
                            ENVIAR SOLICITUD
                        </button>

                        <a href="?vista=mi_solicitudes" class="btn btn-outline-secondary btn-lg">
                            MIS SOLICITUDES
                        </a>
                    </div>

                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Información Importante</h5>
            </div>
            <div class="card-body">
                <ul class="mb-0">
                    <li>Las solicitudes serán evaluadas en un plazo de <strong>2 días hábiles</strong></li>
                    <li>Su saldo actual de vacaciones es de <strong><?php echo (int)($diasDisponibles ?? 0); ?> días</strong>; no puede solicitar más días de los disponibles</li>
                    <li>Se recomienda <strong>anticipar la solicitud</strong> con la mayor antelación posible respecto a las fechas deseadas</li>
                    <li>Incluya una <strong>descripción detallada</strong> del período y motivo de su ausencia</li>
                    <li>Recibirá una notificación cuando se evalúe su solicitud</li>
                </ul>
            </div>
        </div>
    </div>
</div>