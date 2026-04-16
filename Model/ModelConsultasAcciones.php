<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function ObtenerMisSolicitudes($idUsuario)
{
    $context = OpenDBPractica();
    $sp = "CALL sgh_ObtenerAccionesPersonal('$idUsuario')";
    $result = $context->query($sp);
    CloseDBPractica($context);

    return $result;
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

    while ($fila = mysqli_fetch_assoc($result)) {
        $datos[] = $fila;
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

/**
 * Obtener el ID del usuario que realizó la solicitud
 * @param int $id_solicitud - ID de la solicitud
 * @param string $tipo - Tipo de solicitud ('Permiso' o 'Vacaciones')
 * @return int - ID del usuario o 0 si no existe
 */
function ObtenerIdUsuarioSolicitante($id_solicitud, $tipo)
{
    $context = OpenDBPractica();
    $id_solicitud = (int)$id_solicitud;
    $idUsuario = 0;

    if ($tipo === "Permiso") {
        $query = "SELECT id_usuario FROM solicitud_permiso WHERE id_solicitud = $id_solicitud LIMIT 1";
    } else {
        $query = "SELECT id_usuario_solicita as id_usuario FROM solicitud_vacaciones WHERE id_solicitud = $id_solicitud LIMIT 1";
    }

    if ($result = $context->query($query)) {
        $row = $result->fetch_assoc();
        if ($row && isset($row['id_usuario'])) {
            $idUsuario = (int)$row['id_usuario'];
        }
        $result->free();
    }

    CloseDBPractica($context);
    return $idUsuario;
}