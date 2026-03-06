<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function RegistrarUsuario($nombre, $correo, $contrasenna, $rol)
{
    $context = OpenDBPractica();

    $nombre = $context->real_escape_string($nombre);
    $correo = $context->real_escape_string($correo);
    $contrasenna = $context->real_escape_string($contrasenna);
    $rol = (int)$rol;

    $sp = "CALL sgh_RegistroUsuario('$nombre', '$correo', '$contrasenna', $rol)";
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

function ListarUsuarios($pagina, $registrosPorPagina)
{
    $context = OpenDBPractica();

    $pagina = (int)$pagina;
    $registrosPorPagina = (int)$registrosPorPagina;
    $inicio = ($pagina - 1) * $registrosPorPagina;

    $sql = "CALL sgh_ListarUsuarios($inicio, $registrosPorPagina)";
    $result = $context->query($sql);

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

function TotalUsuarios()
{
    $context = OpenDBPractica();

    $sql = "CALL sgh_TotalUsuarios()";
    $result = $context->query($sql);

    $total = 0;

    if ($result) {
        $fila = $result->fetch_assoc();
        $total = $fila["total"] ?? 0;

        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $total;
}

function InactivarUsuario($id)
{
    $context = OpenDBPractica();

    $id = (int)$id;
    $sql = "CALL sgh_InactivarUsuario($id)";
    $result = $context->query($sql);

    CloseDBPractica($context);
    return $result;
}

function CambiarEstadoUsuario($id, $estado)
{
    $context = OpenDBPractica();

    $id = (int)$id;
    $estado = (int)$estado;

    $sql = "CALL sgh_CambiarEstadoUsuario($id, $estado)";
    $result = $context->query($sql);

    if ($result instanceof mysqli_result) {
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $result;
}

function ObtenerUsuarioPorId($id)
{
    $context = OpenDBPractica();

    $id = (int)$id;
    $sql = "CALL sgh_ObtenerUsuarioPorId($id)";
    $result = $context->query($sql);

    $usuario = null;

    if ($result) {
        $usuario = $result->fetch_assoc();

        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $usuario;
}

function ActualizarUsuario($id, $nombre, $rol)
{
    $context = OpenDBPractica();

    $id = (int)$id;
    $nombre = $context->real_escape_string($nombre);
    $rol = (int)$rol;

    $sql = "CALL sgh_ActualizarUsuario($id, '$nombre', $rol)";
    $result = $context->query($sql);

    if ($result instanceof mysqli_result) {
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $result;
}