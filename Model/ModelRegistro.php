<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

function RegistrarUsuario($nombre,$correo,$contrasenna,$rol){
    
    $context = OpenDBPractica();

    $sp = "CALL sgh_RegistroUsuario('$nombre', '$correo','$contrasenna','$rol')";
    $result = $context->query($sp);

    CloseDBPractica($context);
    return $result;
}

function ListarUsuarios($pagina, $registrosPorPagina){

    $context = OpenDBPractica();

    $inicio = ($pagina - 1) * $registrosPorPagina;

    $sql = "CALL sgh_ListarUsuarios('$inicio', '$registrosPorPagina')";
    $result = $context->query($sql);

    $datos = [];
    while($fila = $result->fetch_assoc()){
        $datos[] = $fila;
    }

    //limpiar resultados del SP
    $result->free();
    while($context->more_results() && $context->next_result()) {;}

    CloseDBPractica($context);
    return $datos;
}

function TotalUsuarios(){

    $context = OpenDBPractica();

    $sql = "CALL sgh_TotalUsuarios()";
    $result = $context->query($sql);

    $fila = $result->fetch_assoc();

    //limpiar resultados del SP
    $result->free();
    while($context->more_results() && $context->next_result()) {;}

    CloseDBPractica($context);
    return $fila["total"];
}