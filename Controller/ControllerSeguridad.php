<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/UtilitarioController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelRecuperarC.php";


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["btnCambiarAcceso"])) {

    $nuevaContrasenna = $_POST["NuevaContrasenna"];
    $id_usuario = $_SESSION["IdUsuario"];
    $correo = $_SESSION["Correo"];
    $nombre = $_SESSION["NombreUsuario"];

    $result = ActualizarContrasennaModel($nuevaContrasenna, $id_usuario);

    if ($result) {

        date_default_timezone_set('America/Costa_Rica');
        $plantilla = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/emails/cambioAcceso.html");
        $cuerpoCorreo = str_replace(
            ["{{NOMBRE}}", "{{FECHA}}"],
            [$nombre, date("d/m/Y h:i A")],
            $plantilla
        );

        EnviarCorreo("Cambio de Contraseña", $cuerpoCorreo, $correo);

        session_unset();
        session_destroy();

        echo "<script>window.location.href='/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/vHome/inicio_sesion.php';</script>";
            exit();
    } else {
        $_POST["Mensaje"] = "Su información no fue actualizada correctamente";
    }
}