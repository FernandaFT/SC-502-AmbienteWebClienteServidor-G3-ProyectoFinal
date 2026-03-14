<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutGeneral.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerRecuperarC.php";
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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="../assets/images/Logo.png">
              </div>
              <h4>Recuperar Acceso</h4>
              <h6 class="font-weight-light">Te enviaremos un correo electrónico con una contraseña nueva.</h6>
              <?php
                if(isset($_POST["Mensaje"])){
                  echo $_POST["Mensaje"];
              }
              ?>
              <form class="pt-3" method="POST" id="FormRecuperarAcceso" action="">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" 
                         id="correo" name="correo" placeholder="Correo Electrónico">
                </div>
                <div class="mt-3 d-grid gap-2">
                  <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" 
                          id="btnRecuperarAcceso" name="btnRecuperarAcceso">RECUPERAR ACCESO</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">

                  <a href="inicio_sesion.php" class="auth-link text-primary">¿Ya tienes una cuenta?</a>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  JSGeneral();
  ?>
</body>

</html>