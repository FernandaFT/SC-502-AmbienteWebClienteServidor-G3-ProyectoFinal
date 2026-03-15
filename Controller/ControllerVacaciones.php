<?php
require_once '../Model/VacacionesModel.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = new VacacionesModel();
    $datos = [
        'id_usuario' => 1, 
        'fecha_inicio' => $_POST['fecha_inicio'],
        'fecha_fin' => $_POST['fecha_fin'],
        'dias_solicitados' => $_POST['dias_solicitados']
    ];

    if ($model->guardarSolicitud($datos)) {
        echo "<script>alert('¡Solicitud enviada!'); window.location.href='../View/solicitudVacaciones.php';</script>";
    } else {
        echo "<script>alert('Error al guardar'); window.history.back();</script>";
    }
}
?>