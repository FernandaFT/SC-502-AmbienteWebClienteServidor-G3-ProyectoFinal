<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function ObtenerDatosDashboard($idUsuario, $rol)
{
    $context = OpenDBPractica();

    $idUsuario = (int)$idUsuario;
    $rol = (int)$rol;

    $sp = "CALL sgh_ObtenerDatosDashboard('$idUsuario', '$rol')";
    $result = $context->query($sp);

    $datos = null;

    if ($result) {
        $datos = $result->fetch_assoc();

        $result->free();
        while ($context->more_results() && $context->next_result()) {
        }
    }

    CloseDBPractica($context);
    return $datos;
}
