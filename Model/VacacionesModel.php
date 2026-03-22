<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/UtilitarioModel.php";

class VacacionesModel {

    public function guardarSolicitud($datos) {
        $enlace = OpenDBPractica(); 
        
        $id = $datos['id_usuario'];
        $inicio = $datos['fecha_inicio'];
        $fin = $datos['fecha_fin'];
        $dias = $datos['dias_solicitados'];

        
        $sql = "CALL sp_registrar_solicitud_vacaciones('$id', '$inicio', '$fin', '$dias')";
        
        $resultado = mysqli_query($enlace, $sql);

        CloseDBPractica($enlace); 

        return $resultado;
    }
}
?>