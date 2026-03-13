<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutGeneral.php";


if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$rol   = $_SESSION["Rol"] ?? 0;
$vista = $_GET["vista"] ?? "dashboard";

// Si no hay sesión válida, manda a login
if ($rol == 0) {
  header("Location: inicio_sesion.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SGH</title>
  <?php CSSGeneral(); ?>
</head>

<body>
  <div class="container-scroller">

    <?php menuSuperiorGeneral(); ?>

    <div class="container-fluid page-body-wrapper">

      <?php
      // Sidebar según rol
      if ($rol == 1) {
        menuAdmin();
      } elseif ($rol == 2) {
        menuEmpleado();
      }
      ?>

      <!-- Panel derecho -->
      <div class="main-panel">
        <div class="content-wrapper">

          <?php
          if ($rol == 1 && $vista == "registro") {
            include_once __DIR__ . "/registro.php";
          } elseif ($vista == "perfilUsuario") {
            include_once __DIR__ . "/perfilUsuario.php";
          } else {
            echo "<h4>Bienvenid@s al SGH</h4>";
          }
          ?>

        </div>
      </div>

    </div>

  </div>

  <?php JSGeneral(); ?>
</body>

</html>