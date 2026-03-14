<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/UtilitarioController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelRecuperarC.php";

if(isset($_POST["btnRecuperarAcceso"])){

    $correo = $_POST["correo"];

    $result = ValidarCorreoModel($correo);

    if($result){

        //Generar nueva contraseña
        $nuevaContrasenna = GenerarContrasenna();
        $actualizacion = ActualizarContrasennaModel($nuevaContrasenna, $result["id_usuario"]);

        if($actualizacion){
            
            $plantilla = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/emails/recuperarAcceso.html");
            $cuerpoCorreo = str_replace(
                ["{{NOMBRE}}", "{{CONTRASENNA}}"],
                [$result["nombre"], $nuevaContrasenna],
                $plantilla
            );

            EnviarCorreo("Recuperar Acceso", $cuerpoCorreo, $result["correo"]);
            header("Location: ../../View/vHome/inicio_sesion.php");
            exit;
        }
    }
    $_POST["Mensaje"] = "Su información no fue validada correctamente";
}