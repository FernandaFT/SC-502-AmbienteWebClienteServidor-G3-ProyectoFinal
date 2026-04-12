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
    </div>
</div>