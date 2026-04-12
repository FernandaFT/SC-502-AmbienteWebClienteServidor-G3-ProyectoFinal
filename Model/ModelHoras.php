<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function RegistrarHoras($idUsuario, $idCliente, $idCategoriaHora, $cantidad, $descripcion, $fecha)
{
    $context = OpenDBPractica();
    $sql = "CALL sgh_RegistrarHoras('$idUsuario','$idCliente','$idCategoriaHora','$cantidad','$descripcion','$fecha')";
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

function EditarHoras($idRegistro, $idCliente, $idCategoriaHora, $cantidad, $descripcion, $fecha)
{
    $context = OpenDBPractica();
    $sql = "CALL sgh_EditarHoras('$idRegistro','$idCliente','$idCategoriaHora','$cantidad','$descripcion','$fecha')";
    $result = $context->query($sql);

    if ($result) {
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $result;
}

function ListarHorasPorUsuario($idUsuario, $inicio, $registrosPorPagina)
{
    $context = OpenDBPractica();
    $sql = "CALL sgh_ListarHorasPorUsuario('$idUsuario','$inicio','$registrosPorPagina')";
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

function TotalHorasPorUsuario($idUsuario)
{
    $context = OpenDBPractica();
    $sql = "CALL sgh_TotalHorasPorUsuario('$idUsuario')";
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

function ObtenerHoraPorId($idRegistro)
{
    $context = OpenDBPractica();
    $sql = "CALL sgh_ObtenerHoraPorId('$idRegistro')";
    $result = $context->query($sql);

    $registro = null;
    if ($result) {
        $registro = $result->fetch_assoc();
        $result->free();
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $registro;
}

function ListarCategoriasHoras()
{
    $context = OpenDBPractica();
    // Ajustado: la columna correcta es id_categoria_hora
    $sql = "SELECT id_categoria_hora, nombre FROM categoria_hora";
    $result = $context->query($sql);

    $datos = [];
    if ($result) {
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }
        $result->free();
    }

    CloseDBPractica($context);
    return $datos;
}

function ListarClientesActivos()
{
    $context = OpenDBPractica();
    // Verifica si tu tabla cliente tiene columna 'activo'. Si no, elimina el WHERE.
    $sql = "SELECT id_cliente, nombre FROM cliente";
    $result = $context->query($sql);

    $datos = [];
    if ($result) {
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }
        $result->free();
    }

    CloseDBPractica($context);
    return $datos;
}
function ConsultarReporteHoras($fechaInicio, $fechaFin)
{
    $context = OpenDBPractica();
    // Consulta para separar horas por columna y sumar por empleado y día
    $sql = "SELECT 
                u.NombreUsuario as empleado,
                r.fecha,
                SUM(CASE WHEN r.id_categoria_hora = 1 THEN r.cantidad ELSE 0 END) AS ordinarias,
                SUM(CASE WHEN r.id_categoria_hora = 2 THEN r.cantidad ELSE 0 END) AS extras,
                SUM(CASE WHEN r.id_categoria_hora = 3 THEN r.cantidad ELSE 0 END) AS dobles,
                SUM(r.cantidad) AS total_dia
            FROM registro_horas r
            INNER JOIN usuario u ON r.id_usuario = u.id_usuario
            WHERE r.fecha BETWEEN '$fechaInicio' AND '$fechaFin'
            GROUP BY u.id_usuario, r.fecha
            ORDER BY r.fecha ASC";

    $result = $context->query($sql);

    $datos = [];
    if ($result) {
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }
        $result->free();
        // Limpiamos por si quedan resultados (buena práctica que ya usas)
        while ($context->more_results() && $context->next_result()) { }
    }

    CloseDBPractica($context);
    return $datos;
}
?>