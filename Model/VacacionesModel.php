<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutGeneral.php"; 
require_once __DIR__ . '/../Model/Conexion.php';

class VacacionesModel {

    public function consultarSolicitudes($idUsuario) {
        $instancia = new Conexion();
        $conexion = $instancia->Conectar();
        $sentencia = "CALL sp_consultar_vacaciones_usuario('$idUsuario')";
        $resultado = mysqli_query($conexion, $sentencia);
        $instancia->Desconectar($conexion);
        return $resultado;
    }

    public function registrarSolicitud($idUsuario, $fechaInicio, $fechaFin, $dias) {
        $instancia = new Conexion();
        $conexion = $instancia->Conectar();
        $sentencia = "CALL sp_registrar_solicitud_vacaciones('$idUsuario', '$fechaInicio', '$fechaFin', '$dias')";
        $resultado = mysqli_query($conexion, $sentencia);
        $instancia->Desconectar($conexion);
        return $resultado;
    }
}
?>