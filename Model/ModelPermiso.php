<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

// Crear una nueva solicitud de permiso
function CrearSolicitudPermiso($idUsuario, $fechaInicio, $fechaFin, $descripcion, $idCategoria)
{
    $context = OpenDBPractica();

    $idUsuario = (int)$idUsuario;
    $fechaInicio = $context->real_escape_string($fechaInicio);
    $fechaFin = $context->real_escape_string($fechaFin);
    $descripcion = $context->real_escape_string($descripcion);
    $idCategoria = (int)$idCategoria;

    $sp = "CALL sgh_CrearSolicitudPermiso($idUsuario, '$fechaInicio', '$fechaFin', '$descripcion', $idCategoria)";
    $result = $context->query($sp);

    $respuesta = null;

    if ($result) {
        $respuesta = $result->fetch_assoc();

        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $respuesta;
}

// Obtener solicitudes pendientes
function ObtenerSolicitudesPendientes($idEncargado)
{
    $context = OpenDBPractica();

    $idEncargado = (int)$idEncargado;

    $sp = "CALL sgh_ObtenerSolicitudespendientes($idEncargado)";
    $result = $context->query($sp);

    $datos = [];

    if ($result) {
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }

        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $datos;
}

// Obtener solicitudes de un usuario
function ObtenerSolicitudesUsuario($idUsuario)
{
    $context = OpenDBPractica();

    $idUsuario = (int)$idUsuario;

    $sp = "CALL sgh_ObtenerSolicitudesUsuario($idUsuario)";
    $result = $context->query($sp);

    $datos = [];

    if ($result) {
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }

        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $datos;
}

// Obtener detalles de una solicitud específica
function ObtenerDetalleSolicitud($idSolicitud)
{
    $context = OpenDBPractica();

    $idSolicitud = (int)$idSolicitud;

    $sp = "CALL sgh_ObtenerDetalleSolicitud($idSolicitud)";
    $result = $context->query($sp);

    $respuesta = null;

    if ($result) {
        $respuesta = $result->fetch_assoc();

        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $respuesta;
}

// Actualizar estado de una solicitud
function ActualizarEstadoPermiso($idSolicitud, $estado, $idEncargado, $motivoRechazo = "", $observaciones = "")
{
    $context = OpenDBPractica();

    $idSolicitud = (int)$idSolicitud;
    $estado = $context->real_escape_string($estado);
    $idEncargado = (int)$idEncargado;
    $motivoRechazo = $context->real_escape_string($motivoRechazo);
    $observaciones = $context->real_escape_string($observaciones);

    $sp = "CALL sgh_ActualizarEstadoPermiso($idSolicitud, '$estado', $idEncargado, '$motivoRechazo', '$observaciones')";
    $result = $context->query($sp);

    $respuesta = null;

    if ($result) {
        $respuesta = $result->fetch_assoc();

        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $respuesta;
}

// Obtener categorías de permisos
function ObtenerCategoriasPermisos()
{
    $context = OpenDBPractica();

    $sp = "CALL sgh_ListarCategoriasPermisos()";
    $result = $context->query($sp);

    $datos = [];

    if ($result) {
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }

        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $datos;
}

// Validar rango de fechas
function ValidarRangoFechas($fechaInicio, $fechaFin)
{
    $inicio = strtotime($fechaInicio);
    $fin = strtotime($fechaFin);
    $hoy = strtotime(date('Y-m-d'));

    if ($inicio === false || $fin === false) {
        return ["valido" => false, "mensaje" => "Las fechas no tienen un formato válido."];
    }

    if ($inicio < $hoy) {
        return ["valido" => false, "mensaje" => "La fecha de inicio no puede ser anterior a hoy."];
    }

    if ($fin < $inicio) {
        return ["valido" => false, "mensaje" => "La fecha de fin debe ser posterior a la fecha de inicio."];
    }

    $diasSolicitados = ($fin - $inicio) / (24 * 3600) + 1;
    if ($diasSolicitados > 30) {
        return ["valido" => false, "mensaje" => "El permiso no puede exceder 30 días."];
    }

    return ["valido" => true, "mensaje" => "Fechas válidas"];
}
?>
