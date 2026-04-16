<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

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

    $sp = "CALL sgh_RegistrarNotificacion($idDestino, $idOrigen, '$descripcion')";
    $result = $context->query($sp);

    if ($result instanceof mysqli_result) {
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $result ? true : false;
}


function ObtenerNotificacionesUsuario($idUsuario) {
    $context = OpenDBPractica();
    $idUsuario = (int)$idUsuario;

    $sp = "CALL sgh_ObtenerNotificacionesUsuario($idUsuario)";
    $result = $context->query($sp);

    $datos = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }
    
    CloseDBPractica($context);
    return $datos;
}


function ObtenerNotificacionesNoLeidas($idUsuario) {
    $context = OpenDBPractica();
    $idUsuario = (int)$idUsuario;

    $sp = "CALL sgh_ObtenerNotificacionesNoLeidas($idUsuario)";
    $result = $context->query($sp);

    $datos = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }
    
    CloseDBPractica($context);
    return $datos;
}


function MarcarNotificacionLeida($idNotificacion) {
    $context = OpenDBPractica();
    $idNotificacion = (int)$idNotificacion;

    $sp = "CALL sgh_MarcarNotificacionLeida($idNotificacion)";
    $result = $context->query($sp);
    if ($result instanceof mysqli_result) {
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }
    CloseDBPractica($context);
    
    return $result ? true : false;
}

function ObtenerTodosEncargados() {
    $context = OpenDBPractica();

    $sp = "CALL sgh_ObtenerTodosEncargados()";
    $result = $context->query($sp);

    $encargados = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            if (isset($row['id_usuario'])) {
                $encargados[] = (int)$row['id_usuario'];
            }
        }
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }
    
    CloseDBPractica($context);
    return $encargados;
}

function MarcarTodasComoLeidas($idUsuario) {
    $context = OpenDBPractica();
    $idUsuario = (int)$idUsuario;

    $sp = "CALL sgh_MarcarTodasNotificacionesLeidas($idUsuario)";
    $result = $context->query($sp);
    if ($result instanceof mysqli_result) {
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }
    CloseDBPractica($context);
    
    return $result ? true : false;
}


function MarcarNotificacionesEncargadosSolicitudComoLeidas($idUsuarioOrigen, $tipo) {
    $context = OpenDBPractica();

    $idUsuarioOrigen = (int)$idUsuarioOrigen;

    $tipo = $context->real_escape_string((string)$tipo);
    $sp = "CALL sgh_MarcarNotificacionesEncargadosSolicitudComoLeidas($idUsuarioOrigen, '$tipo')";
    $result = $context->query($sp);
    if ($result instanceof mysqli_result) {
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $result ? true : false;
}

function ObtenerSolicitudDeNotificacion($idOrigen, $descripcion) {
    $context = OpenDBPractica();
    $idOrigen = (int)$idOrigen;
    $descripcion = $context->real_escape_string($descripcion);

    $sp = "CALL sgh_ObtenerSolicitudDeNotificacion($idOrigen, '$descripcion')";
    $result = $context->query($sp);

    $resultado = null;
    if ($result) {
        $row = $result->fetch_assoc();
        if ($row && isset($row['id_solicitud']) && $row['id_solicitud'] !== null) {
            $resultado = [
                'id_solicitud' => (int)$row['id_solicitud'],
                'tipo' => $row['tipo'] ?? null
            ];
        }
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $resultado;
}
?>

