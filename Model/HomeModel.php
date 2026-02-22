<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/SC-502-AmbienteWebClienteServidor-G3-ProyectoFinal/Model/UtilitarioModel.php";

function Registrar($identificacion,$nombre, $correo, $contrasenna)
{
    $context = OpenDataBase();

    $sp = "CALL sp_Registrar('$identificacion', '$nombre', '$correo', '$contrasenna')";
    $result = $context -> query($sp);

    CloseDataBase($context);
    return $result;
}