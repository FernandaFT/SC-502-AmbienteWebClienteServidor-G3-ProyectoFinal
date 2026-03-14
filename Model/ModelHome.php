<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";


function RegistrarCliente($nombre, $descripcion)
{
    $context = OpenDBPractica();

    $nombre = $context->real_escape_string($nombre);
    $descripcion = $context->real_escape_string($descripcion);

    $sql= "CALL sgh_RegistroCliente('$nombre', '$descripcion')";

    $result = $context->query($sql);
    $respuesta = null;

    if ($result) {
        $respuesta = $result->fetch_assoc();

        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }
    
    CloseDBPractica($context);
    return $respuesta;
}


function ListarClientes($pagina, $registrosPorPagina)
{
    $context = OpenDBPractica();

    $pagina = (int)$pagina;
    $registrosPorPagina = (int)$registrosPorPagina;
    $inicio = ($pagina - 1) * $registrosPorPagina;

    $sql = "CALL sgh_ListarClientes('$inicio', '$registrosPorPagina')";
    $result = $context->query($sql);

    $datos = [];

    if ($result) {

        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }
    }

    CloseDBPractica($context);
    return $datos;
}


function TotalClientes()
{
    $context = OpenDBPractica();

    $sql = "CALL sgh_TotalClientes()";
    $result = $context->query($sql);

    $total = 0;

    if ($result) {

        $fila = $result->fetch_assoc();
        $total = $fila["total"] ?? 0;
    }

    CloseDBPractica($context);
    return $total;
}


function CambiarEstadoCliente($id, $estado)
{
    $context = OpenDBPractica();

    $id = (int)$id;
    $estado = (int)$estado;

    $sql = "CALL sgh_CambiarEstadoCliente($id, $estado)";
    $result = $context->query($sql);

    CloseDBPractica($context);
    return $result;
}


function ObtenerClientePorId($id)
{
    $context = OpenDBPractica();

    $id = (int)$id;

    $sql = "CALL sgh_ObtenerClientePorId('$id')";

    $result = $context->query($sql);

    $cliente = null;

    if ($result) {
        $cliente = $result->fetch_assoc();
    }

    CloseDBPractica($context);
    return $cliente;
}


function ActualizarCliente($id, $nombre, $descripcion)
{
    $context = OpenDBPractica();

    $id = (int)$id;
    $nombre = $context->real_escape_string($nombre);
    $descripcion = $context->real_escape_string($descripcion);

    $sql = "CALL sgh_ActualizarCliente('$id', '$nombre', '$descripcion')";

    $result = $context->query($sql);

    CloseDBPractica($context);
    return $result;
}
