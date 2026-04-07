<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelDashboard.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["IdUsuario"]) || !isset($_SESSION["NombreUsuario"]) || !isset($_SESSION["Rol"])) {
    header("Location: inicio_sesion.php");
    exit;
}

$idUsuario = $_SESSION["IdUsuario"];
$nombreUsuario = $_SESSION["NombreUsuario"];
$rol = (int)$_SESSION["Rol"];

$datosDashboard = ObtenerDatosDashboard($idUsuario, $rol);

date_default_timezone_set('America/Costa_Rica');

$horaActual = date("h:i A");
$fechaActual = date("d/m/Y");
$horaNumero = (int)date("H");

if ($horaNumero < 12) {
    $saludo = "Buenos días";
} elseif ($horaNumero < 18) {
    $saludo = "Buenas tardes";
} else {
    $saludo = "Buenas noches";
}

$diasVacaciones = (int)($datosDashboard["vacaciones"] ?? 0);

/* EMPLEADO */
if ($rol === 2) {
    $horasTotales = (int)($datosDashboard["horas_totales"] ?? 0);
    $solicitudesPendientes = (int)($datosDashboard["pendientes_usuario"] ?? 0);

    $ultimoCliente = $datosDashboard["cliente"] ?? "Sin registros";
    $ultimaCategoria = $datosDashboard["categoria"] ?? "Sin categoría";
    $ultimaCantidad = (int)($datosDashboard["cantidad"] ?? 0);
    $ultimaFecha = $datosDashboard["fecha"] ?? "Sin fecha";
}

/* ADMIN */
if ($rol === 1) {
    $solicitudesPorRevisar = (int)($datosDashboard["pendientes_admin"] ?? 0);
}
