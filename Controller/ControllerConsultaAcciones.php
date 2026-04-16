<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelConsultasAcciones.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelNotificacion.php";

if (isset($_POST["btnAprobar"])) {
    $id_accion = $_POST["Solicitud_id"] ?? 0;
    $tipo = $_POST["tipo"];

    // Obtener el ID del usuario que hizo la solicitud
    $idUsuarioSolicitante = ObtenerIdUsuarioSolicitante($id_accion, $tipo);

    $result = AprobarSolicitudModel($id_accion, $tipo);

    if ($result) {
        $mensaje = "<div class='alert alert-success'>Solicitud aprobada correctamente.</div>";
        
        // Generar notificación al empleado que solicitó
        if ($idUsuarioSolicitante > 0) {
            $tipoSolicitud = ($tipo === "Permiso") ? "permiso" : "vacaciones";
            $nombreAdmin = $_SESSION["NombreUsuario"] ?? "Un administrador";
            $descripcionNotif = "$nombreAdmin ha aprobado tu solicitud de $tipoSolicitud";
            RegistrarNotificacion($idUsuarioSolicitante, $_SESSION["IdUsuario"], $descripcionNotif);
        }
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al aprobar la solicitud.</div>";
    }
}

if (isset($_POST["btnRechazar"])) {
    $id_accion = $_POST["Solicitud_id"] ?? 0;
    $tipo = $_POST["tipo"];

    // Obtener el ID del usuario que hizo la solicitud
    $idUsuarioSolicitante = ObtenerIdUsuarioSolicitante($id_accion, $tipo);

    $result = RechazarSolicitudModel($id_accion, $tipo);

    if ($result) {
        $mensaje = "<div class='alert alert-success'>Solicitud rechazada correctamente.</div>";
        
        // Generar notificación al empleado que solicitó
        if ($idUsuarioSolicitante > 0) {
            $tipoSolicitud = ($tipo === "Permiso") ? "permiso" : "vacaciones";
            $nombreAdmin = $_SESSION["NombreUsuario"] ?? "Un administrador";
            $descripcionNotif = "$nombreAdmin ha rechazado tu solicitud de $tipoSolicitud";
            RegistrarNotificacion($idUsuarioSolicitante, $_SESSION["IdUsuario"], $descripcionNotif);
        }
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al rechazar la solicitud.</div>";
    }
}