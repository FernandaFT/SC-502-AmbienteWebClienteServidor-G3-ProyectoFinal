<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function RegistrarHoras($idUsuario, $idCliente, $idCategoriaHora, $clasificacionHora, $cantidad, $descripcion, $fecha)
{
    $context = OpenDBPractica();
    $clasificacionHora = $context->real_escape_string($clasificacionHora);
    $sql = "CALL sgh_RegistrarHoras('$idUsuario','$idCliente','$idCategoriaHora','$clasificacionHora','$cantidad','$descripcion','$fecha')";
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


function EditarHoras($idRegistro, $idCliente, $idCategoriaHora, $clasificacionHora, $cantidad, $descripcion, $fecha)
{
    $context = OpenDBPractica();
    $clasificacionHora = $context->real_escape_string($clasificacionHora);
    $sql = "CALL sgh_EditarHoras('$idRegistro','$idCliente','$idCategoriaHora','$clasificacionHora','$cantidad','$descripcion','$fecha')";
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

function ObtenerReporteHoras($fechaInicio, $fechaFin, $idCliente)
{
    $conn = OpenDBPractica();
    $idCliente = (int)$idCliente;

    $sql = "SELECT u.nombre AS empleado,
                   cat.nombre AS categoria,
                   rh.clasificacion_hora AS clasificacion_hora,
                   SUM(rh.cantidad) AS cantidad_horas
            FROM registro_horas rh
            INNER JOIN usuario u ON rh.id_usuario = u.id_usuario
            INNER JOIN categoria_hora cat ON rh.id_categoria_hora = cat.id_categoria_hora
            WHERE rh.fecha BETWEEN ? AND ?";

    if ($idCliente > 0) {
        $sql .= " AND rh.id_cliente = ?";
    }

    $sql .= " GROUP BY u.id_usuario, u.nombre, cat.id_categoria_hora, cat.nombre, rh.clasificacion_hora
              ORDER BY u.nombre ASC, cat.nombre ASC, rh.clasificacion_hora ASC";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        CloseDBPractica($conn);
        return [];
    }

    if ($idCliente > 0) {
        $stmt->bind_param("ssi", $fechaInicio, $fechaFin, $idCliente);
    } else {
        $stmt->bind_param("ss", $fechaInicio, $fechaFin);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $datos = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $datos[] = $row;
        }
    }
    $stmt->close();
    CloseDBPractica($conn);
    return $datos;
}

function ExportarReporteHorasCsv(array $datos)
{
    $filename = "reporte_horas_" . date("Y-m-d_His") . ".csv";
    header("Content-Type: text/csv; charset=UTF-8");
    header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
    header("Cache-Control: max-age=0");
    echo "\xEF\xBB\xBF";

    $out = fopen("php://output", "w");
    fputcsv($out, ["Empleado", "Categoría", "Clasificación (Ordinaria/Extra/Doble)", "Cantidad de horas"], ";");
    foreach ($datos as $row) {
        fputcsv($out, [
            $row["empleado"] ?? "",
            $row["categoria"] ?? "",
            $row["clasificacion_hora"] ?? "",
            $row["cantidad_horas"] ?? "",
        ], ";");
    }
    fclose($out);
}
?>