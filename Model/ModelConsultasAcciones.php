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

function AprobarSolicitudModel($id, $tipo, $idEncargado)
{
    $context = OpenDBPractica();

    $id = (int)$id;
    $idEncargado = (int)$idEncargado;

    if ($tipo == "Permiso") {
        $sp = "CALL sgh_AprobarSolicitudPermiso($id, $idEncargado)";
    } else {
        $sp = "CALL sgh_AprobarSolicitudVacaciones($id, $idEncargado)";
    }

    $resultado = mysqli_query($context, $sp);

    CloseDBPractica($context);
    return $resultado;
}

function RechazarSolicitudModel($id, $tipo, $idEncargado)
{
    $context = OpenDBPractica();

    $id = (int)$id;
    $idEncargado = (int)$idEncargado;

    if ($tipo == "Permiso") {
        $sp = "CALL sgh_RechazarSolicitudPermiso($id, $idEncargado)";
    } else {
        $sp = "CALL sgh_RechazarSolicitudVacaciones($id, $idEncargado)";
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

/**
 * Obtener datos básicos del usuario (nombre y correo) para notificaciones por correo.
 * Se usa al aprobar/rechazar solicitudes para avisar al empleado.
 *
 * @param int $idUsuario
 * @return array|null  ['nombre' => string, 'correo' => string] o null si no existe
 */
function ObtenerDatosUsuarioBasicosPorId($idUsuario)
{
    $context = OpenDBPractica();
    $idUsuario = (int)$idUsuario;

    $query = "SELECT nombre, correo
              FROM usuario
              WHERE id_usuario = $idUsuario
              LIMIT 1";

    $datos = null;
    if ($result = $context->query($query)) {
        $row = $result->fetch_assoc();
        if ($row) {
            $datos = [
                'nombre' => $row['nombre'] ?? null,
                'correo' => $row['correo'] ?? null,
            ];
        }
        $result->free();
    }

    CloseDBPractica($context);
    return $datos;
}