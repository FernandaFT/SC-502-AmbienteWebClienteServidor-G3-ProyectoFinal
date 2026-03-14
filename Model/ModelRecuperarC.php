<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function ValidarCorreoModel($correo)
{
    try{
        $content = OpenDBPractica();

        $sp = "CALL sgh_ValidarCorreo('$correo')";
        $result = $content->query($sp);

        $datos = null;
        while($fila = $result -> fetch_assoc())
        {
            $datos = $fila;
        }

        CloseDBPractica($content);
        return $datos;
    }
    catch(Exception $e)
    {
        return null;
    }
}

function ActualizarContrasennaModel($nuevaContrasenna, $id_usuario)
{
    try{
        $content = OpenDBPractica();

        $sp= "CALL sgh_ActualizarContrasenna('$nuevaContrasenna', '$id_usuario')";
        $result = $content->query($sp);

        CloseDBPractica($content);
        return $result;
    }
    catch(Exception $e)
    {
        return false;
    }

}