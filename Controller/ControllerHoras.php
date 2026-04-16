<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelHoras.php";

$vista = $_GET["vista"] ?? "horas";
$esEdicion = false;
$registroEditar = null;
$mensaje = "";
$mensajeReporte = "";

function HorasValidarRangoFechas($fechaInicio, $fechaFin)
{
    $d1 = DateTime::createFromFormat("Y-m-d", $fechaInicio);
    $d2 = DateTime::createFromFormat("Y-m-d", $fechaFin);
    if (!$d1 || !$d2) {
        return false;
    }
    return $d1 <= $d2;
}

function HorasNormalizarClasificacion($valor)
{
    $v = trim((string)$valor);
    $permitidas = ["Ordinaria", "Extra", "Doble"];
    return in_array($v, $permitidas, true) ? $v : "Ordinaria";
}

if (isset($_POST["btnLimpiarFiltrosReporte"])) {
    unset($_SESSION["reporte_horas"], $_SESSION["reporte_filtros"], $_SESSION["mensaje_reporte"]);
    header("Location: inicio.php?vista=reporteria");
    exit;
}

if (isset($_POST["btnExportarExcel"])) {
    $fechaInicio = trim($_POST["fechaInicio"] ?? "");
    $fechaFin = trim($_POST["fechaFin"] ?? "");
    $idCliente = (int)($_POST["id_cliente"] ?? 0);

    if ($fechaInicio === "" || $fechaFin === "") {
        $_SESSION["mensaje_reporte"] = "<div class='alert alert-warning'>Indique fecha de inicio y fecha fin.</div>";
        header("Location: inicio.php?vista=reporteria");
        exit;
    }
    if (!HorasValidarRangoFechas($fechaInicio, $fechaFin)) {
        $_SESSION["mensaje_reporte"] = "<div class='alert alert-danger'>La fecha de inicio no puede ser posterior a la fecha fin.</div>";
        header("Location: inicio.php?vista=reporteria");
        exit;
    }

    $datosExport = ObtenerReporteHoras($fechaInicio, $fechaFin, $idCliente);
    if (empty($datosExport)) {
        $_SESSION["mensaje_reporte"] = "<div class='alert alert-info'>No hay datos para el rango y filtros seleccionados. No se generó el archivo.</div>";
        $_SESSION["reporte_filtros"] = [
            "fechaInicio" => $fechaInicio,
            "fechaFin" => $fechaFin,
            "id_cliente" => $idCliente,
        ];
        header("Location: inicio.php?vista=reporteria");
        exit;
    }

    $_SESSION["reporte_filtros"] = [
        "fechaInicio" => $fechaInicio,
        "fechaFin" => $fechaFin,
        "id_cliente" => $idCliente,
    ];
    $_SESSION["reporte_horas"] = $datosExport;
    ExportarReporteHorasCsv($datosExport);
    exit;
}

if (isset($_POST["btnGenerarReporte"])) {
    $fechaInicio = trim($_POST["fechaInicio"] ?? "");
    $fechaFin = trim($_POST["fechaFin"] ?? "");
    $idCliente = (int)($_POST["id_cliente"] ?? 0);

    $_SESSION["reporte_filtros"] = [
        "fechaInicio" => $fechaInicio,
        "fechaFin" => $fechaFin,
        "id_cliente" => $idCliente,
    ];

    if ($fechaInicio === "" || $fechaFin === "") {
        $mensajeReporte = "<div class='alert alert-warning'>Indique fecha de inicio y fecha fin.</div>";
    } elseif (!HorasValidarRangoFechas($fechaInicio, $fechaFin)) {
        $mensajeReporte = "<div class='alert alert-danger'>La fecha de inicio no puede ser posterior a la fecha fin.</div>";
    } else {
        $datosRep = ObtenerReporteHoras($fechaInicio, $fechaFin, $idCliente);
        $_SESSION["reporte_horas"] = $datosRep;
        if (empty($datosRep)) {
            $mensajeReporte = "<div class='alert alert-info'>No se encontraron registros para los filtros seleccionados.</div>";
        } else {
            $mensajeReporte = "<div class='alert alert-success'>Reporte generado correctamente.</div>";
        }
    }
}

if ($mensajeReporte === "" && !empty($_SESSION["mensaje_reporte"])) {
    $mensajeReporte = $_SESSION["mensaje_reporte"];
    unset($_SESSION["mensaje_reporte"]);
}

// Registrar horas
if (isset($_POST["btnRegistrarHoras"])) {
    $idUsuario = $_SESSION["IdUsuario"] ?? 0;
    $idCliente = (int)($_POST["id_cliente"] ?? 0);
    $idCategoriaHora = (int)($_POST["id_categoria_hora"] ?? 0);
    $clasificacionHora = HorasNormalizarClasificacion($_POST["clasificacion_hora"] ?? "Ordinaria");
    $cantidad = (int)($_POST["cantidad"] ?? 0);                 
    $descripcion = trim($_POST["descripcion"] ?? "");          
    $fecha = trim($_POST["fecha"] ?? "");

    $result = RegistrarHoras($idUsuario, $idCliente, $idCategoriaHora, $clasificacionHora, $cantidad, $descripcion, $fecha);
    if ($result && $result["resultado"] == 1) {
        $mensaje = "<div class='alert alert-success'>" . $result["mensaje"] . "</div>";
    } else {
        $mensaje = "<div class='alert alert-danger'>" . ($result["mensaje"] ?? "Error al registrar horas.") . "</div>";
    }
}

// Cargar registro para edición
if (isset($_GET["accion"]) && $_GET["accion"] == "editar" && isset($_GET["id"])) {
    $idEditar = (int)$_GET["id"];
    $registroEditar = ObtenerHoraPorId($idEditar);

    if ($registroEditar) {
        $esEdicion = true;
        $vista = "horas";
    } else {
        $mensaje = "<div class='alert alert-danger'>No se encontró el registro de horas.</div>";
    }
}

// Actualizar horas
if (isset($_POST["btnActualizarHoras"])) {
    $idRegistro = (int)($_POST["id_registro"] ?? 0);
    $idCliente = (int)($_POST["id_cliente"] ?? 0);
    $idCategoriaHora = (int)($_POST["id_categoria_hora"] ?? 0);
    $clasificacionHora = HorasNormalizarClasificacion($_POST["clasificacion_hora"] ?? "Ordinaria");
    $cantidad = (int)($_POST["cantidad"] ?? 0);                 
    $descripcion = trim($_POST["descripcion"] ?? "");          
    $fecha = trim($_POST["fecha"] ?? "");

    $result = EditarHoras($idRegistro, $idCliente, $idCategoriaHora, $clasificacionHora, $cantidad, $descripcion, $fecha);
    if ($result) {
        $mensaje = "<div class='alert alert-success'>Registro de horas actualizado correctamente.</div>";
        $esEdicion = false;
        $registroEditar = null;
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al actualizar el registro de horas.</div>";
        $esEdicion = true;
        $registroEditar = ObtenerHoraPorId($idRegistro);
    }
}

// Paginación reporte de horas (datos en sesión)
$registrosPorPaginaReporte = 5;
$paginaReporte = isset($_GET["pagina_reporte"]) ? (int)$_GET["pagina_reporte"] : 1;
if ($paginaReporte < 1) {
    $paginaReporte = 1;
}
$totalPaginasReporte = 1;
$datosReportePaginados = [];
$todasFilasReporte = $_SESSION["reporte_horas"] ?? [];
if (!empty($todasFilasReporte)) {
    $nReporte = count($todasFilasReporte);
    $totalPaginasReporte = (int)ceil($nReporte / $registrosPorPaginaReporte);
    if ($totalPaginasReporte < 1) {
        $totalPaginasReporte = 1;
    }
    if ($paginaReporte > $totalPaginasReporte) {
        $paginaReporte = $totalPaginasReporte;
    }
    $datosReportePaginados = array_slice(
        $todasFilasReporte,
        ($paginaReporte - 1) * $registrosPorPaginaReporte,
        $registrosPorPaginaReporte
    );
}

// Paginación listado de horas del empleado
$idUsuario = $_SESSION["IdUsuario"] ?? 0;
$registrosPorPagina = 5;
$pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
if ($pagina < 1) $pagina = 1;

$totalHoras = TotalHorasPorUsuario($idUsuario);
$totalPaginas = ceil($totalHoras / $registrosPorPagina);
if ($totalPaginas < 1) $totalPaginas = 1;
if ($pagina > $totalPaginas) $pagina = $totalPaginas;

$inicio = ($pagina - 1) * $registrosPorPagina;
$listaHoras = ListarHorasPorUsuario($idUsuario, $inicio, $registrosPorPagina);

