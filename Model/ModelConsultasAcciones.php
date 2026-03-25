<?php
function ObtenerMisSolicitudes($idUsuario)
{
    $context = OpenDBPractica();
    $sp = "CALL sgh_ObtenerAccionesPersonal('$idUsuario')";
    $result = $context->query($sp);
    CloseDBPractica($context);

    return $result;
}

function DetalleSolicitud($id_solicitud)
{
    $context = OpenDBPractica();
    $sp = "CALL sgh_detalleSolicitud('$id_solicitud')";
    $result = $context->query($sp);
    $datos = $result->fetch_assoc();
    CloseDBPractica($context);

    return $datos;
}