<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerLogin.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutGeneral.php";

if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}
?>

<div class="row">
    <div class="col-lg-10 mx-auto">
        
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">HU 08: Generación de Reportería</h4>
                </div>
            </div>

            <div class="card-body">
                <p class="text-muted mb-4">
                    Seleccione un rango de fechas para generar el conteo de horas (ordinarias, extras y dobles) por empleado.
                </p>

                <form action="mostrar_reporte.php" method="POST">
                    <div class="row mb-4">
                        <div class="col-md-5">
                            <h6 class="text-muted">Fecha Inicio</h6>
                            <input type="date" name="txtFechaInicio" class="form-control" required>
                        </div>

                        <div class="col-md-5">
                            <h6 class="text-muted">Fecha Fin</h6>
                            <input type="date" name="txtFechaFin" class="form-control" required>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" name="btnGenerarReporte" class="btn btn-primary w-100">
                                <i class="mdi mdi-file-document"></i> Generar
                            </button>
                        </div>
                    </div>
                </form>

                <hr>

                <div class="alert alert-info border-0 shadow-sm">
                    <i class="mdi mdi-information-outline"></i> 
                    El reporte mostrará el total acumulado de horas por categoría y el detalle diario.
                </div>
            </div>

            <div class="card-footer bg-light">
                <p class="small text-muted mb-0">SGH - Sistema de Gestión de Horas</p>
            </div>
        </div>
    </div>
</div>