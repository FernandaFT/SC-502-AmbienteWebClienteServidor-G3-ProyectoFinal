<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelRegistro.php";

if(isset($_POST["btnRegistro"])){
    
    //Validaciones
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasenna = $_POST["password"];
    $rol = $_POST["rol"];

    $result = RegistrarUsuario($nombre,$correo,$contrasenna,$rol);

    if($result){
        $_POST["Mensaje"] = "Usuario registrado correctamente";
    }else{
        $_POST["Mensaje"] = "Error al registrar usuario";
    }
}
$registrosPorPagina = 5;

$pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : 1;

$totalUsuarios = TotalUsuarios();

$totalPaginas = ceil($totalUsuarios / $registrosPorPagina);

$listaUsuarios = ListarUsuarios($pagina, $registrosPorPagina);