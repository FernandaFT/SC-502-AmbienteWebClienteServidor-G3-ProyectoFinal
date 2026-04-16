<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelPermiso.php";

include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelNotificacion.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelConsultasAcciones.php";


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
$totalMisSolicitudes = 0;
$paginaSolicitudes = 1;
$totalPaginasSolicitudes = 1;
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
                
                // Registrar notificación a TODOS los encargados (administradores)
                $encargados = ObtenerTodosEncargados();
                if (!empty($encargados)) {
                    $nombreUsuario = $_SESSION["NombreUsuario"] ?? "Un usuario";
                    $descripcionNotif = "$nombreUsuario ha creado una solicitud de permiso";
                    
                    // Notificar a cada administrador
                    foreach ($encargados as $idEncargado) {
                        RegistrarNotificacion($idEncargado, $idUsuarioLogueado, $descripcionNotif);
                    }
                }
                
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

// Cargar categorías para el formulario
$categorias = ObtenerCategoriasPermisos();

if ($vista === "mi_solicitudes") {
    $registrosPorPagina = 5;
    $paginaSolicitudes = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
    if ($paginaSolicitudes < 1) {
        $paginaSolicitudes = 1;
    }
    $todasMisSolicitudes = ObtenerMisSolicitudes($idUsuarioLogueado);
    $totalMisSolicitudes = count($todasMisSolicitudes);
    $totalPaginasSolicitudes = (int)ceil($totalMisSolicitudes / $registrosPorPagina);
    if ($totalPaginasSolicitudes < 1) {
        $totalPaginasSolicitudes = 1;
    }
    if ($paginaSolicitudes > $totalPaginasSolicitudes) {
        $paginaSolicitudes = $totalPaginasSolicitudes;
    }
    $offset = ($paginaSolicitudes - 1) * $registrosPorPagina;
    $solicitudes = array_slice($todasMisSolicitudes, $offset, $registrosPorPagina);
}

