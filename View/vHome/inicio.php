<?php
  include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutGeneral.php";
  include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutAdmin.php";
  include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutEmpleado.php";
  if (session_status() === PHP_SESSION_NONE)
  {
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SGH</title>
    <?php
      CSSGeneral();
    ?>
  </head>
  <body>
    <div class="container-scroller">
      <?php
      GeneralContenido();
       $rol = $_SESSION["Rol"];
       if($rol==1){
          contenidoAdmin();
       }elseif($rol==2){
          contenidoEmpleado();
       }
      ?>
      </div>
    <?php
      JSGeneral();
    ?>
  </body>
</html>