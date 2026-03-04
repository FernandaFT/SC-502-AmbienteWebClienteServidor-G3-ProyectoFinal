<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function InicioSesion($correo, $contra){

    $context = OpenDBPractica();

    $sp = "CALL sgh_InicioSesion('$correo','$contra')";
    $result = $context->query($sp);

    $datos=null;

    while($fila=$result->fetch_assoc()){
        $datos=$fila;   
    }

    CloseDBPractica($context);
    return $datos;
}

?>
