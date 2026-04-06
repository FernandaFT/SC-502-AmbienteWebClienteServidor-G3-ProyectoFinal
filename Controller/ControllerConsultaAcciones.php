<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelConsultasAcciones.php";

if (isset($_POST["btnAprobar"])) {
    $id_accion = $_POST["Solicitud_id"] ?? 0;
    $tipo = $_POST["tipo"];

    $result = AprobarSolicitudModel($id_accion, $tipo);

    if ($result) {
        $mensaje = "<div class='alert alert-success'>Solicitud aprobada correctamente.</div>";
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al aprobar la solicitud.</div>";
    }
}

if (isset($_POST["btnRechazar"])) {
    $id_accion = $_POST["Solicitud_id"] ?? 0;
    $tipo = $_POST["tipo"];

    $result = RechazarSolicitudModel($id_accion, $tipo);

    if ($result) {
        $mensaje = "<div class='alert alert-success'>Solicitud rechazada correctamente.</div>";
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al rechazar la solicitud.</div>";
    }
}