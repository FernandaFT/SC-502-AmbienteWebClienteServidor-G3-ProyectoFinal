<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelPermiso.php";

// Variables de sesión
$idUsuarioLogueado = $_SESSION["IdUsuario"] ?? null;
$rolUsuario = $_SESSION["Rol"] ?? 0;
$vista = $_GET["vista"] ?? "solicitar_permiso";

// Validar que existe sesión y usuario
if (!$idUsuarioLogueado) {
    header("Location: inicio_sesion.php");
    exit;
}

$mensaje = "";
$categorias = [];
$solicitudes = [];
$solicitudDetalle = null;
$fechaInicio = "";
$fechaFin = "";
$descripcion = "";
$idCategoria = 0;

// ===================== SOLICITAR PERMISO =====================
if (isset($_POST["btnSolicitar"])) {
    $fechaInicio = trim($_POST["fecha_inicio"] ?? "");
    $fechaFin = trim($_POST["fecha_fin"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");
    $idCategoria = (int)($_POST["categoria"] ?? 0);

    // Validar campos vacíos
    if (empty($fechaInicio) || empty($fechaFin) || empty($descripcion) || $idCategoria == 0) {
        $mensaje = "<div class='alert alert-danger'>Todos los campos son obligatorios.</div>";
    } else {
        // Validar rango de fechas
        $validacion = ValidarRangoFechas($fechaInicio, $fechaFin);
        
        if (!$validacion["valido"]) {
            $mensaje = "<div class='alert alert-danger'>" . $validacion["mensaje"] . "</div>";
        } else {
            // Crear solicitud
            $result = CrearSolicitudPermiso($idUsuarioLogueado, $fechaInicio, $fechaFin, $descripcion, $idCategoria);

            if ($result && $result["resultado"] == 1) {
                $mensaje = "<div class='alert alert-success'>" . $result["mensaje"] . "</div>";
                $fechaInicio = "";
                $fechaFin = "";
                $descripcion = "";
                $idCategoria = 0;
            } else {
                $mensaje = "<div class='alert alert-danger'>" . ($result["mensaje"] ?? "Error al crear la solicitud.") . "</div>";
            }
        }
    }
}

// ===================== EVALUAR SOLICITUD =====================
if (isset($_POST["btnEvaluar"])) {
    $idSolicitud = (int)($_POST["id_solicitud"] ?? 0);
    $estado = trim($_POST["estado"] ?? "");
    $motivoRechazo = trim($_POST["motivo_rechazo"] ?? "");
    $observaciones = trim($_POST["observaciones"] ?? "");

    // Validación
    if ($idSolicitud == 0 || empty($estado)) {
        $mensaje = "<div class='alert alert-danger'>Datos incompletos para evaluar la solicitud.</div>";
    } else {
        if ($estado == "Rechazado" && empty($motivoRechazo)) {
            $mensaje = "<div class='alert alert-danger'>Debe indicar un motivo al rechazar la solicitud.</div>";
        } else {
            // Actualizar estado
            $result = ActualizarEstadoPermiso($idSolicitud, $estado, $idUsuarioLogueado, $motivoRechazo, $observaciones);

            if ($result && $result["resultado"] == 1) {
                $mensaje = "<div class='alert alert-success'>" . $result["mensaje"] . "</div>";
            } else {
                $mensaje = "<div class='alert alert-danger'>" . ($result["mensaje"] ?? "Error al actualizar la solicitud.") . "</div>";
            }
        }
    }
}

// ===================== VER DETALLE DE SOLICITUD =====================
if (isset($_GET["id"]) && $vista == "detalle_solicitud") {
    $idSolicitud = (int)$_GET["id"];
    $solicitudDetalle = ObtenerDetalleSolicitud($idSolicitud);
    
    if (!$solicitudDetalle) {
        $mensaje = "<div class='alert alert-danger'>Solicitud no encontrada.</div>";
    }
}

// Cargar categorías para el formulario
$categorias = ObtenerCategoriasPermisos();

// Cargar solicitudes según la vista
if ($vista == "mi_solicitudes") {
    $solicitudes = ObtenerSolicitudesUsuario($idUsuarioLogueado);
}
?>
