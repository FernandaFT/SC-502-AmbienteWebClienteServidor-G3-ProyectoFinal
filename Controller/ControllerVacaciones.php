<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/VacacionesModel.php";

if (isset($_POST["btnEnviarSolicitud"])) {
    $datos = array(
        'id_usuario'       => $_POST["txtIdUsuario"],
        'fecha_inicio'     => $_POST["txtFechaInicio"],
        'fecha_fin'        => $_POST["txtFechaFin"],
        'dias_solicitados' => $_POST["txtDias"]
    );

    $objModel = new VacacionesModel();
    $resultado = $objModel->guardarSolicitud($datos);

    if ($resultado) {
        header("Location: ../View/solicitud_vacaciones.php?msj=success");
    } else {
        header("Location: ../View/solicitud_vacaciones.php?msj=error");
    }
}

