<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelConsultasAcciones.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelNotificacion.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/UtilitarioController.php";

$mensaje = "";

if (isset($_POST["btnAprobar"])) {
    $id_accion = $_POST["Solicitud_id"] ?? 0;
    $tipo = $_POST["tipo"];

    // Obtener el ID del usuario que hizo la solicitud
    $idUsuarioSolicitante = ObtenerIdUsuarioSolicitante($id_accion, $tipo);
    $idEncargado = (int)($_SESSION["IdUsuario"] ?? 0);

    $result = AprobarSolicitudModel($id_accion, $tipo, $idEncargado);

    if ($result) {
        $mensaje = "<div class='alert alert-success'>Solicitud aprobada correctamente.</div>";
        
        // Generar notificación al empleado que solicitó
        if ($idUsuarioSolicitante > 0) {
            $tipoSolicitud = ($tipo === "Permiso") ? "permiso" : "vacaciones";
            $nombreAdmin = $_SESSION["NombreUsuario"] ?? "Un administrador";
            $descripcionNotif = "$nombreAdmin ha aprobado tu solicitud de $tipoSolicitud";
            RegistrarNotificacion($idUsuarioSolicitante, $_SESSION["IdUsuario"], $descripcionNotif);

            // Ocultar/quitar la notificación pendiente para otros administradores
            MarcarNotificacionesEncargadosSolicitudComoLeidas($idUsuarioSolicitante, $tipo);

            // Enviar correo al empleado (mismo nivel de formato que el sistema)
            $datosEmpleado = ObtenerDatosUsuarioBasicosPorId($idUsuarioSolicitante);
            if ($datosEmpleado && !empty($datosEmpleado["correo"])) {
                date_default_timezone_set('America/Costa_Rica');
                $plantilla = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/emails/accionPersonalAprobada.html");
                $cuerpoCorreo = str_replace(
                    ["{{NOMBRE}}", "{{TIPO}}", "{{FECHA}}"],
                    [$datosEmpleado["nombre"] ?? "Usuario", ucfirst($tipoSolicitud), date("d/m/Y h:i A")],
                    $plantilla
                );
                EnviarCorreo("Solicitud aprobada", $cuerpoCorreo, $datosEmpleado["correo"]);
            }
        }
    } else {
        $mensaje = "<div class='alert alert-danger'>Error al aprobar la solicitud.</div>";
    }
}

if (isset($_POST["btnRechazar"])) {
    $id_accion = $_POST["Solicitud_id"] ?? 0;
    $tipo = $_POST["tipo"];

    // Obtener el ID del usuario que hizo la solicitud
    $idUsuarioSolicitante = ObtenerIdUsuarioSolicitante($id_accion, $tipo);
    $idEncargado = (int)($_SESSION["IdUsuario"] ?? 0);

    $result = RechazarSolicitudModel($id_accion, $tipo, $idEncargado);

    if ($result) {
        $mensaje = "<div class='alert alert-success'>Solicitud rechazada correctamente.</div>";
        
        // Generar notificación al empleado que solicitó
        if ($idUsuarioSolicitante > 0) {
            $tipoSolicitud = ($tipo === "Permiso") ? "permiso" : "vacaciones";
            $nombreAdmin = $_SESSION["NombreUsuario"] ?? "Un administrador";
            $descripcionNotif = "$nombreAdmin ha rechazado tu solicitud de $tipoSolicitud";
            RegistrarNotificacion($idUsuarioSolicitante, $_SESSION["IdUsuario"], $descripcionNotif);

            // Ocultar/quitar la notificación pendiente para otros administradores
            MarcarNotificacionesEncargadosSolicitudComoLeidas($idUsuarioSolicitante, $tipo);

            // Enviar correo al empleado (mismo nivel de formato que el sistema)
            $datosEmpleado = ObtenerDatosUsuarioBasicosPorId($idUsuarioSolicitante);
            if ($datosEmpleado && !empty($datosEmpleado["correo"])) {
                date_default_timezone_set('America/Costa_Rica');
                $plantilla = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/emails/accionPersonalRechazada.html");
                $cuerpoCorreo = str_replace(
                    ["{{NOMBRE}}", "{{TIPO}}", "{{FECHA}}"],
                    [$datosEmpleado["nombre"] ?? "Usuario", ucfirst($tipoSolicitud), date("d/m/Y h:i A")],
                    $plantilla
                );
                EnviarCorreo("Solicitud rechazada", $cuerpoCorreo, $datosEmpleado["correo"]);
            }
        }
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