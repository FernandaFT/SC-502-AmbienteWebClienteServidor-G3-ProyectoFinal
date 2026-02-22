<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/SC-502-AmbienteWebClienteServidor-G3-ProyectoFinal/View/layoutExterno.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/SC-502-AmbienteWebClienteServidor-G3-ProyectoFinal/Controller/HomeController.php";
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
              <h4>¿Nuevo aquí?</h4>
              <h6 class="font-weight-light">Registrarse es facíl. Solo te toma un par de pasos.</h6>

              <form class="pt-3" action="" method="POST" id="formRegistro">

                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" 
                    id="Identificacion" name="Identificacion" placeholder="Identificación">
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" 
                    id="Nombre" name="Nombre" placeholder="Nombre">
                  </div>

                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" 
                    id="Correo" name="Correo" placeholder="Correo">
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" 
                    id="Contrasenna" name="Contrasenna" placeholder="Contraseña">
                  </div>

                  <div class="mt-3 d-grid gap-2">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" 
                    type="submit" id="btnRegistrar" name="btnRegistrar">
                      REGISTRARSE
                    </button>
                  </div>

                  <div class="text-center mt-4 font-weight-light"> 
                      ¿Ya tienes una cuenta? 
                      <a href="inicio_sesion.php" class="text-primary">
                        Iniciar Sesión
                      </a>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="../assets/funciones/registro.js"></script>
</body>

</html>