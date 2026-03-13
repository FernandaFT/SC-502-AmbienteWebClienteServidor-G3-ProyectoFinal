<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelLogin.php";
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}
if(isset($_POST["btnInicioSesion"])){

    //Validaciones
    $correo= $_POST["correo"];
    $contra= $_POST["password"];

    $result= InicioSesion($correo, $contra);

    if ($result) {
        $_SESSION["NombreUsuario"] = $result["nombre"];
        $_SESSION["Rol"] = $result["rol"];
        $_SESSION["Correo"] = $result["correo"];
        $_SESSION["Fecha"] = $result["fecha_registro"];
        header("Location: ../../View/vHome/inicio.php");
        exit;
    }else{
        $_POST["Mensaje"]="Usuario no encontrado, intente nuevamente";
    }
}

if(isset($_POST["btnCerrarSesion"])){
    session_unset();
    session_destroy();

    echo json_encode("OK");
}

?>