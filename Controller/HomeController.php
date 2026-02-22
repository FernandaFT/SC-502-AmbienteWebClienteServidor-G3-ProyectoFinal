<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/SC-502-AmbienteWebClienteServidor-G3-ProyectoFinal/Model/HomeModel.php";


if(isset($_POST["btnRegistrar"]))
{
    $identificacion = $_POST["Identificacion"];
    $nombre = $_POST["Nombre"];
    $correo = $_POST["Correo"];
    $contrasenna = $_POST["Contrasenna"];

    $result= Registrar($identificacion,$nombre, $correo, $contrasenna);

    if($result)
        {
            header("Location: ../../View/vHome/inicio_sesion.php");
            exit;
        }else{
            $_POST["Mensaje"] = "Su información no fue registrada correctamente";
        }
}