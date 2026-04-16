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

// Incluir controlador de permisos si es necesario
if (in_array($vista, ["solicitar_permiso", "mi_solicitudes", "detalle_solicitud"])) {
  include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerPermiso.php";
}
// Incluir controlador de horas para la reportería
if (in_array($vista, ["horas", "reporteria", "consultar_reporteria"])) {
  include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerHoras.php";
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
          } elseif ($rol == 1 && $vista == "clientes") {
            include_once __DIR__ . "/clientes.php";
          } elseif ($rol == 1 && $vista == "pantallaAccionesAdmin") {
            include_once __DIR__ . "/pantallaAccionesAdmin.php";
          } elseif ($rol == 1 && ($vista == "reporteria" || $vista == "consultar_reporteria")) {
            include_once __DIR__ . "/consultar_reporteria.php";
          } elseif ($vista == "cambioContrasenna") {
            include_once __DIR__ . "/../vSeguridad/cambioContrasenna.php";
          } elseif ($vista == "perfilUsuario") {
            include_once __DIR__ . "/perfilUsuario.php";
          } elseif ($vista == "horas") {
            include_once __DIR__ . "/../vHome/registroHoras.php";
          } elseif ($vista == "solicitar_permiso") {
            include_once __DIR__ . "/solicitar_permiso.php";
          } elseif ($vista == "mi_solicitudes") {
            include_once __DIR__ . "/mi_solicitudes.php";
          } elseif ($vista == "detalle_solicitud") {
            include_once __DIR__ . "/detalle_solicitud.php";
          } elseif ($vista == "solicitar_vacaciones") {
            include_once __DIR__ . "/solicitar_vacaciones.php";
          } elseif ($vista == "historialNotificaciones") {
            include_once __DIR__ . "/historialNotificaciones.php";
          } elseif ($vista == "dashboard") {
            include_once __DIR__ . "/dashboard.php";
          } else {
            include_once __DIR__ . "/dashboard.php";
          }
          ?>

        </div>
      </div>

    </div>

  </div>

  <?php JSGeneral(); ?>
</body>

</html>