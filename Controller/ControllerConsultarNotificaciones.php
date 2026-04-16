<?php
// ControllerConsultarNotificaciones.php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelNotificacion.php";

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

header('Content-Type: application/json; charset=utf-8');

$idUsuario = $_SESSION["IdUsuario"] ?? null;

if ($idUsuario) {
    try {
        $notificaciones = ObtenerNotificacionesNoLeidas($idUsuario);
        
        // Agregar información de solicitud a cada notificación
        foreach ($notificaciones as &$notif) {
            $solicitud = ObtenerSolicitudDeNotificacion($notif['id_usuario_origen'], $notif['descripcion']);
            if ($solicitud) {
                $notif['id_solicitud'] = $solicitud['id_solicitud'];
                $notif['tipo_solicitud'] = $solicitud['tipo'];
            } else {
                $notif['id_solicitud'] = null;
                $notif['tipo_solicitud'] = null;
            }
        }
        unset($notif);
        
        echo json_encode($notificaciones, JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        error_log("Error al cargar notificaciones: " . $e->getMessage());
        echo json_encode([], JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode([], JSON_UNESCAPED_UNICODE);
}
?>