<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerHoras.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutGeneral.php";
    
    // Aquí ya puedes usar $datosReporte en el foreach
?>
View/layoutGeneral.php";
if (!isset($_SESSION["NombreUsuario"])) {
    header("Location: inicio_sesion.php");
    exit;
}

$fechaInicio = $_POST['txtFechaInicio'] ?? null;
$fechaFin = $_POST['txtFechaFin'] ?? null;
?>

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Resultado del Reporte</h4>
                <a href="?vista=consultar_reporteria" class="btn btn-light btn-sm">Nueva Consulta</a>
            </div>
            
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Rango Seleccionado:</h6>
                        <h5>Desde: <?php echo date('d/m/Y', strtotime($fechaInicio)); ?> Hasta: <?php echo date('d/m/Y', strtotime($fechaFin)); ?></h5>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th>Empleado</th>
                                <th>Fecha</th>
                                <th>Ordinarias</th>
                                <th>Extras</th>
                                <th>Dobles</th>
                                <th>Total Día</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center">Cargando datos del servidor...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-light text-end">
                <button onclick="window.print();" class="btn btn-outline-secondary">
                    <i class="mdi mdi-printer"></i> Imprimir Reporte
                </button>
            </div>
        </div>
    </div>
</div>