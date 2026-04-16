<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelConsultasAcciones.php";

$mensaje = "";

if (isset($_POST["btnAprobar"])) {
    $id_accion = $_POST["Solicitud_id"] ?? 0;
    $tipo = $_POST["tipo"];

    $result = AprobarSolicitudModel($id_accion, $tipo);

    if ($result) {
        $mensaje = "<div class='alert alert-success'>Solicitud aprobada correctamente.</div>";
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al aprobar la solicitud.</div>";
    }
}

if (isset($_POST["btnRechazar"])) {
    $id_accion = $_POST["Solicitud_id"] ?? 0;
    $tipo = $_POST["tipo"];

    $result = RechazarSolicitudModel($id_accion, $tipo);

    if ($result) {
        $mensaje = "<div class='alert alert-success'>Solicitud rechazada correctamente.</div>";
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al rechazar la solicitud.</div>";
    }
}

$registrosPorPagina = 5;
$pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
if ($pagina < 1) {
    $pagina = 1;
}

$todosSolicitudesAdmin = ObtenerSolicitudes();
$totalSolicitudesAdmin = count($todosSolicitudesAdmin);
$totalPaginas = (int)ceil($totalSolicitudesAdmin / $registrosPorPagina);
if ($totalPaginas < 1) {
    $totalPaginas = 1;
}
if ($pagina > $totalPaginas) {
    $pagina = $totalPaginas;
}

$offset = ($pagina - 1) * $registrosPorPagina;
$solicitudes = array_slice($todosSolicitudesAdmin, $offset, $registrosPorPagina);