<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function RegistrarSolicitudVacaciones($idUsuario,$dias,$fechaInicio,$fechaFin,$descripcion){
    $context = OpenDBPractica();

    $idUsuario = (int)$idUsuario;
    $dias = (int)$dias;
    $fechaInicio = $context->real_escape_string($fechaInicio);
    $fechaFin = $context->real_escape_string($fechaFin);
    $descripcion = $context->real_escape_string($descripcion);

    $sp = "CALL sgh_RegistrarSolicitudVacaciones('$idUsuario','$dias','$fechaInicio','$fechaFin','$descripcion')";

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

function ObtenerDiasDisponibles($idUsuario)
{
    $context = OpenDBPractica();

    $idUsuario = (int)$idUsuario;

    $sp =  "CALL sgh_consultarVacaciones('$idUsuario')";

    $result = $context->query($sp);

    $dias = 0;

    if ($result && $row=$result->fetch_assoc()) {
        
        $dias = $row["vacaciones"] ?? 0;
    }

    CloseDBPractica($context);
    return $dias;
}

function ActualizarVacaciones($idUsuario)
{
    $context = OpenDBPractica();

    $idUsuario = (int)$idUsuario;

    $sp =  "CALL sgh_ActualizarVacaciones('$idUsuario')";

    $context->query($sp);
    CloseDBPractica($context);
}