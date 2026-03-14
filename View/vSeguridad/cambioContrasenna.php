<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerSeguridad.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutGeneral.php";
if (!isset($_SESSION["NombreUsuario"])) {
  header("Location: ../vHome/inicio_sesion.php");
  exit;
}
?>

<div class="row justify-content-center">

    <div class="col-lg-5 auth">

        <div class="auth-form-light text-left p-5 border border-4 rounded">

            <div class="brand-logo text-center">
                <img src="../assets/images/Logo.png">
            </div>

            <h4 class="text-center mb-4">Cambio de Contraseña</h4>

            <?php
            if (isset($_POST["Mensaje"])) {
                echo '<div class="alert alert-danger text-center">' . $_POST["Mensaje"] . '</div>';
            }
            ?>

            <form class="pt-3" method="POST" action="" id="FormCambiarContrasenna">

                <div class="form-group">
                    <label><strong>Nueva Contraseña</strong></label>
                    <input type="password" class="form-control form-control-lg"
                        id="NuevaContrasenna" name="NuevaContrasenna" placeholder="Contraseña">
                </div>

                <div class="form-group">
                    <label><strong>Confirmar Contraseña</strong></label>
                    <input type="password" class="form-control form-control-lg"
                        id="ConfirmarContrasenna" name="ConfirmarContrasenna" placeholder="Contraseña">
                </div>

                <div class="mt-3 d-grid gap-2">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                        id="btnCambiarAcceso" name="btnCambiarAcceso">CAMBIAR CONTRASEÑA</button>
                </div>

            </form>

        </div>

    </div>

</div>