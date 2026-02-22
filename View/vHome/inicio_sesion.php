<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/SC-502-AmbienteWebClienteServidor-G3-ProyectoFinal/View/layoutExterno.php";
?>

<!DOCTYPE html>
<html lang="en">

<?php
MostrarCSS();
?>

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
                <h4>¡Bienvenidos!<br>Sistema de Gestión de Horas</h4>
                <h6 class="font-weight-light">Inicie sesión para continuar.</h6>
                <form class="pt-3">
                  <div class="form-group" action="" method="POST">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Usuario">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Contraseña">
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="inicio.php">INICIAR SESIÓN</a>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Manterse registrado </label>
                    </div>
                    <a href="#" class="auth-link text-primary">¿Has olvidado tu contraseña?</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> ¿No tienes una cuenta? <a href="registro.php" class="text-primary">Crear</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
MostrarJS();
?>
  </body>
</html>