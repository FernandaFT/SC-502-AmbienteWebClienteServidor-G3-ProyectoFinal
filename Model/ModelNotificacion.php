<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

/**
 * Registrar nueva notificación en la tabla notificacion
 * @param int $idDestino - ID del usuario que recibe la notificación
 * @param int $idOrigen - ID del usuario que genera la notificación
 * @param string $descripcion - Descripción de la notificación
 * @return bool - Resultado de la inserción
 */
function RegistrarNotificacion($idDestino, $idOrigen, $descripcion) {
    // Validación de parámetros requeridos
    if (!$idDestino || !$idOrigen || !$descripcion) {
        error_log("RegistrarNotificacion: Parámetro inválido. Destino: $idDestino, Origen: $idOrigen");
        return false;
    }
    
    $context = OpenDBPractica();
    $idDestino = (int)$idDestino;
    $idOrigen = (int)$idOrigen;
    $descripcion = $context->real_escape_string($descripcion);
    
    // INSERT directo en tabla notificacion (singular)
    $query = "INSERT INTO notificacion (id_usuario_destino, id_usuario_origen, descripcion, leida, fecha_creacion) 
              VALUES ($idDestino, $idOrigen, '$descripcion', 0, NOW())";
    
    $result = $context->query($query);
    CloseDBPractica($context);
    
    return $result;
}

/**
 * Obtener notificaciones de un usuario (para historial - todas las notificaciones)
 * @param int $idUsuario - ID del usuario destino
 * @return array - Array con todas las notificaciones (leídas y no leídas)
 */
function ObtenerNotificacionesUsuario($idUsuario) {
    $context = OpenDBPractica();
    $idUsuario = (int)$idUsuario;
    
    // Query para historial - TODAS las notificaciones sin filtro de leida
    $query = "SELECT 
                n.id_notificacion,
                n.id_usuario_origen,
                n.descripcion,
                n.fecha_creacion,
                n.leida,
                u.nombre AS nombre_origen
              FROM notificacion n
              INNER JOIN usuario u ON n.id_usuario_origen = u.id_usuario
              WHERE n.id_usuario_destino = $idUsuario
              ORDER BY n.fecha_creacion DESC";
    
    $datos = [];
    if ($result = $context->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }
        $result->free();
    }
    
    CloseDBPractica($context);
    return $datos;
}

/**
 * Obtener SOLO notificaciones NO LEÍDAS de un usuario (para dropdown)
 * @param int $idUsuario - ID del usuario destino
 * @return array - Array con las últimas 10 notificaciones NO LEÍDAS
 */
function ObtenerNotificacionesNoLeidas($idUsuario) {
    $context = OpenDBPractica();
    $idUsuario = (int)$idUsuario;
    
    // Query para dropdown - SOLO no leídas
    $query = "SELECT 
                n.id_notificacion,
                n.id_usuario_origen,
                n.descripcion,
                n.fecha_creacion,
                n.leida,
                u.nombre AS nombre_origen
              FROM notificacion n
              INNER JOIN usuario u ON n.id_usuario_origen = u.id_usuario
              WHERE n.id_usuario_destino = $idUsuario AND n.leida = 0
              ORDER BY n.fecha_creacion DESC
              LIMIT 10";
    
    $datos = [];
    if ($result = $context->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }
        $result->free();
    }
    
    CloseDBPractica($context);
    return $datos;
}

/**
 * Marcar notificación como leída (opcional)
 * @param int $idNotificacion - ID de la notificación
 * @return bool
 */
function MarcarNotificacionLeida($idNotificacion) {
    $context = OpenDBPractica();
    $idNotificacion = (int)$idNotificacion;
    
    $query = "UPDATE notificacion 
              SET leida = 1 
              WHERE id_notificacion = $idNotificacion";
    
    $result = $context->query($query);
    CloseDBPractica($context);
    
    return $result;
}

/**
 * Obtener ID del encargado de un usuario
 * Por defecto retorna el ID del administrador (rol 1) como encargado
 * @param int $idUsuario - ID del usuario (no se usa actualmente)
 * @return int - ID del encargado (admin) o 0 si no existe
 */
function ObtenerEncargado($idUsuario) {
    $context = OpenDBPractica();
    $idUsuario = (int)$idUsuario;
    
    // Buscar un usuario administrador (rol 1) como encargado
    $query = "SELECT id_usuario FROM usuario WHERE rol = 1 LIMIT 1";
    
    $idEncargado = 0;
    if ($result = $context->query($query)) {
        $row = $result->fetch_assoc();
        if ($row && isset($row['id_usuario'])) {
            $idEncargado = (int)$row['id_usuario'];
        }
        $result->free();
    }
    
    CloseDBPractica($context);
    return $idEncargado;
}

/**
 * Obtener TODOS los administradores (encargados) - SIN DUPLICADOS
 * @return array - Array de IDs de administradores con rol = 1 (sin duplicados)
 */
function ObtenerTodosEncargados() {
    $context = OpenDBPractica();
    
    // Buscar todos los usuarios administradores (rol 1) - USA DISTINCT para evitar duplicados
    $query = "SELECT DISTINCT id_usuario FROM usuario WHERE rol = 1 ORDER BY id_usuario";
    
    $encargados = [];
    if ($result = $context->query($query)) {
        while ($row = $result->fetch_assoc()) {
            if (isset($row['id_usuario'])) {
                $encargados[] = (int)$row['id_usuario'];
            }
        }
        $result->free();
    }
    
    CloseDBPractica($context);
    return $encargados;
}

/**
 * Marcar todas las notificaciones de un usuario como leídas
 * @param int $idUsuario - ID del usuario destino
 * @return bool
 */
function MarcarTodasComoLeidas($idUsuario) {
    $context = OpenDBPractica();
    $idUsuario = (int)$idUsuario;
    
    $query = "UPDATE notificacion 
              SET leida = 1 
              WHERE id_usuario_destino = $idUsuario AND leida = 0";
    
    $result = $context->query($query);
    CloseDBPractica($context);
    
    return $result;
}

/**
 * Obtener ID de solicitud relacionada a una notificación
 * @param int $idOrigen - ID del usuario que originó la notificación
 * @param string $descripcion - Descripción de la notificación
 * @return array - Array con 'id_solicitud' y 'tipo' o null
 */
function ObtenerSolicitudDeNotificacion($idOrigen, $descripcion) {
    $context = OpenDBPractica();
    $idOrigen = (int)$idOrigen;
    $descripcion = $context->real_escape_string($descripcion);
    
    // Determinar el tipo de solicitud
    $tipo = 'Permiso'; // Por defecto
    if (strpos(strtolower($descripcion), 'vacaciones') !== false) {
        $tipo = 'Vacaciones';
    }
    
    // Buscar en solicitud_permiso si es Permiso
    if ($tipo === 'Permiso') {
        $query = "SELECT id_solicitud FROM solicitud_permiso 
                  WHERE id_usuario = $idOrigen 
                  ORDER BY fecha_solicitud DESC 
                  LIMIT 1";
    } 
    // Buscar en solicitud_vacaciones si es Vacaciones
    else {
        $query = "SELECT id_solicitud FROM solicitud_vacaciones 
                  WHERE id_usuario_solicita = $idOrigen 
                  ORDER BY fecha_solicitud DESC 
                  LIMIT 1";
    }
    
    $resultado = null;
    if ($result = $context->query($query)) {
        $row = $result->fetch_assoc();
        if ($row && isset($row['id_solicitud'])) {
            $resultado = [
                'id_solicitud' => (int)$row['id_solicitud'],
                'tipo' => $tipo
            ];
        }
        $result->free();
    }
    
    CloseDBPractica($context);
    return $resultado;
}
?>

