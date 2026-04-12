<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/View/layoutGeneral.php";


if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$rol   = $_SESSION["Rol"] ?? 0;
$vista = $_GET["vista"] ?? "dashboard";

if ($rol == 0) {
  header("Location: inicio_sesion.php");
  exit;
}

// Incluir controlador de permisos si es necesario
if (in_array($vista, ["solicitar_permiso", "mi_solicitudes", "detalle_solicitud"])) {
  include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerPermiso.php";
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
      if ($rol == 1) {
        menuAdmin();
      } elseif ($rol == 2) {
        menuEmpleado();
      }
      ?>

      <div class="main-panel">
        <div class="content-wrapper">

          <?php
          if ($rol == 1 && $vista == "registro") {
            include_once __DIR__ . "/registro.php";
          } elseif ($rol == 1 && $vista == "clientes") {
            include_once __DIR__ . "/clientes.php";
          } elseif ($rol == 1 && $vista == "pantallaAccionesAdmin") {
            include_once __DIR__ . "/pantallaAccionesAdmin.php";
          }elseif ($vista == "cambioContrasenna") {
            include_once __DIR__ . "/../vSeguridad/cambioContrasenna.php";
          } elseif ($vista == "perfilUsuario") {
            include_once __DIR__ . "/perfilUsuario.php";
elseif ($vista == "solicitud_vacaciones") {
            include_once __DIR__ . "/solicitud_vacaciones.php";
        }
        elseif ($vista == "solicitar_permiso") {
            include_once __DIR__ . "/solicitar_permiso.php";
        }
        elseif ($vista == "mi_solicitudes") {
            include_once __DIR__ . "/mi_solicitudes.php";
        }
        elseif ($vista == "detalle_solicitud") {
            include_once __DIR__ . "/detalle_solicitud.php";
        }
          }elseif ($vista == "solicitud_vacaciones") {
            include_once __DIR__ . "/solicitud_vacaciones.php";
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