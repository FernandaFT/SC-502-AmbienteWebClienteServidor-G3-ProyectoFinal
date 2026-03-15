<?php
require_once 'UtilitarioModel.php'; 

class VacacionesModel {

    public function guardarSolicitud($datos) {
        $enlace = OpenDBPractica(); 
        
        $id = $datos['id_usuario'];
        $inicio = $datos['fecha_inicio'];
        $fin = $datos['fecha_fin'];
        $dias = $datos['dias_solicitados'];

        $sql = "INSERT INTO solicitud_vacaciones (id_usuario, fecha_inicio, fecha_fin, dias_solicitados, estado) 
                VALUES ('$id', '$inicio', '$fin', '$dias', 'Pendiente')";
        
        $resultado = mysqli_query($enlace, $sql);

        CloseDBPractica($enlace); 

        return $resultado;
    }
}
?>