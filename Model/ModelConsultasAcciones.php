<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function ObtenerMisSolicitudes($idUsuario)
{
    $context = OpenDBPractica();
    $idUsuario = (int)$idUsuario;
    $sp = "CALL sgh_ObtenerAccionesPersonal('$idUsuario')";
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

function DetalleSolicitud($id_solicitud, $tipo_solicitud)
{
    $context = OpenDBPractica();
    $sp = "CALL sgh_detalleSolicitud('$id_solicitud', '$tipo_solicitud')";
    $result = $context->query($sp);
    $datos = $result->fetch_assoc();
    CloseDBPractica($context);

    return $datos;
}

function ObtenerSolicitudes()
{
    $context = OpenDBPractica();
    $sp = "CALL sgh_ObtenerSolicitudesGestionar()";
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

function AprobarSolicitudModel($id, $tipo)
{
    $context = OpenDBPractica();

    if ($tipo == "Permiso") {
        $sp = "CALL sgh_AprobarSolicitudPermiso('$id')";
    } else {
        $sp = "CALL sgh_AprobarSolicitudVacaciones('$id')";
    }

    $resultado = mysqli_query($context, $sp);

    CloseDBPractica($context);
    return $resultado;
}

function RechazarSolicitudModel($id, $tipo)
{
    $context = OpenDBPractica();

    if ($tipo == "Permiso") {
        $sp = "CALL sgh_RechazarSolicitudPermiso('$id')";
    } else {
        $sp = "CALL sgh_RechazarSolicitudVacaciones('$id')";
    }

    $resultado = mysqli_query($context, $sp);

    CloseDBPractica($context);
    return $resultado;
}