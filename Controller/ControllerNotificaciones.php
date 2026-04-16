<?php
// ControllerNotificaciones.php - API AJAX para acciones de notificaciones
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelNotificacion.php";

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

header('Content-Type: application/json; charset=utf-8');

$idUsuario = $_SESSION["IdUsuario"] ?? null;
$action = $_GET["action"] ?? null;

if (!$idUsuario) {
    echo json_encode(['success' => false, 'message' => 'No autenticado'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Obtener notificaciones NO leídas (para dropdown)
if ($action === 'obtener_no_leidas') {
    $notificaciones = ObtenerNotificacionesNoLeidas($idUsuario);
    echo json_encode([
        'success' => true,
        'notificaciones' => $notificaciones,
        'cantidad' => count($notificaciones)
    ], JSON_UNESCAPED_UNICODE);
}
// Contar notificaciones NO leídas (para badge)
elseif ($action === 'contar') {
    $notificaciones = ObtenerNotificacionesNoLeidas($idUsuario);
    echo json_encode([
        'success' => true,
        'contador' => count($notificaciones)
    ], JSON_UNESCAPED_UNICODE);
}
// Obtener todas las notificaciones (para historial)
elseif ($action === 'obtener_todas') {
    $notificaciones = ObtenerNotificacionesUsuario($idUsuario);
    echo json_encode([
        'success' => true,
        'notificaciones' => $notificaciones,
        'total' => count($notificaciones)
    ], JSON_UNESCAPED_UNICODE);
}
// Marcar una notificación como leída (la notificación desaparece del contenedor)
elseif ($action === 'marcar_leida') {
    $idNotificacion = (int)($_GET["id"] ?? 0);
    
    if ($idNotificacion > 0 && MarcarNotificacionLeida($idNotificacion)) {
        // Obtener el contador actualizado de no leídas
        $notificacionesNoLeidas = ObtenerNotificacionesNoLeidas($idUsuario);
        echo json_encode([
            'success' => true, 
            'contador' => count($notificacionesNoLeidas),
            'message' => 'Notificación marcada como leída'
        ], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al marcar'], JSON_UNESCAPED_UNICODE);
    }
}
// Marcar todas como leídas (todas desaparecen del contenedor)
elseif ($action === 'marcar_todas') {
    if (MarcarTodasComoLeidas($idUsuario)) {
        echo json_encode([
            'success' => true, 
            'contador' => 0,
            'message' => 'Todas marcadas como leídas'
        ], JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al marcar'], JSON_UNESCAPED_UNICODE);
    }
}
else {
    echo json_encode(['success' => false, 'message' => 'Acción no válida'], JSON_UNESCAPED_UNICODE);
}
?>
