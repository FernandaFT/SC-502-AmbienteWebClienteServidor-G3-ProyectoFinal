<?php
session_start();
include_once 'layoutGeneral.php'; 

$idUsuarioActivo = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 1;
?>

<div class="main-content"> 
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="m-0 font-weight-bold" style="color: #a855f7;">Nueva Solicitud de Vacaciones</h5>
                    </div>
                    <div class="card-body">
                        <form action="../Controller/ControllerVacaciones.php" method="POST">
                            
                            <input type="hidden" name="id_usuario" value="<?php echo $idUsuarioActivo; ?>">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label font-weight-bold">Fecha de Inicio</label>
                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required onchange="calcularDias()">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label font-weight-bold">Fecha de Finalización</label>
                                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required onchange="calcularDias()">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label font-weight-bold">Días Totales</label>
                                <input type="number" id="dias_solicitados" name="dias_solicitados" class="form-control bg-light" readonly>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn text-white px-4 py-2" style="background: linear-gradient(to right, #a855f7, #6366f1); border: none; border-radius: 5px; font-weight: bold;">
                                    REGISTRAR SOLICITUD
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calcularDias() {
    const inicio = document.getElementById('fecha_inicio').value;
    const fin = document.getElementById('fecha_fin').value;

    if (inicio && fin) {
        const fechaIni = new Date(inicio);
        const fechaFin = new Date(fin);
        const diffTime = fechaFin - fechaIni;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

        if (diffDays > 0) {
            document.getElementById('dias_solicitados').value = diffDays;
        } else {
            document.getElementById('dias_solicitados').value = 0;
            if(fin) alert("La fecha de finalización debe ser posterior a la de inicio.");
        }
    }
}
</script>