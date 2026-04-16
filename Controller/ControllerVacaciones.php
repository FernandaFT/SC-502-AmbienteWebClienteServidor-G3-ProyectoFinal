<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelVacaciones.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelNotificacion.php";

$vista = $_GET["vista"] ?? "solicitar_vacaciones";
$mensaje = "";
$diasDisponibles = ObtenerDiasDisponibles($_SESSION["IdUsuario"]);

/* SOLICITAR VACACIONES */
if (isset($_POST["btnSolicitar"])) {

    $idUsuario = $_SESSION["IdUsuario"];
    $fechaInicio = $_POST["fecha_inicio"] ?? "";
    $fechaFin = $_POST["fecha_fin"] ?? "";
    $descripcion = trim($_POST["descripcion"] ?? "");
    $inicio = new DateTime($fechaInicio);
    $fin = new DateTime($fechaFin);

    $diasSolicitados = $inicio->diff($fin)->days + 1;

    $result = RegistrarSolicitudVacaciones($idUsuario, $diasSolicitados, $fechaInicio, $fechaFin, $descripcion);
    if ($result && $result["resultado"] == 1) {
        $mensaje = "<div class='alert alert-success'>" . $result["mensaje"] . "</div>";
        
        // Registrar notificación a TODOS los encargados (administradores)
        $encargados = ObtenerTodosEncargados();
        if (!empty($encargados)) {
            $nombreUsuario = $_SESSION["NombreUsuario"] ?? "Un usuario";
            $descripcionNotif = "$nombreUsuario ha creado una solicitud de vacaciones";
            
            // Notificar a cada administrador
            foreach ($encargados as $idEncargado) {
                RegistrarNotificacion($idEncargado, $idUsuario, $descripcionNotif);
            }
        }
    } else {
        $mensaje = "<div class='alert alert-danger'>" .
            ($result["mensaje"] ?? "No se pudo registrar la solicitud.") .
            "</div>";
    }
}
