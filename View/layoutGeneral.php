<?php
//include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Web/Controller/HomeController.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function CSSGeneral()
{
  echo
  '<link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/notificacionesBadge.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" />';
}

function JSGeneral()
{
  $rol = $_SESSION["Rol"] ?? 2;
  echo
  '<script>
    var userRol = ' . $rol . ';
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/funciones/registro.js"></script>
    <script src="../assets/funciones/login.js"></script>
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/jquery.cookie.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/funciones/cerrarSesion.js"></script>
    <script src="../assets/funciones/recuperarAcceso.js"></script>
    <script src="../assets/funciones/cambiarAcceso.js"></script>
    <script src="../assets/funciones/clientes.js"></script>
    <script src="../assets/funciones/horas.js"></script>
    <script src="../assets/funciones/vacaciones.js"></script>
    <script src="../assets/funciones/permisos.js"></script>
    <script src="../assets/funciones/notificaciones.js"></script>
    <script src="../assets/funciones/reporte.js"></script>';
}

function menuEmpleado()
{
  $nombreUsuario = "";
  if (isset($_SESSION["NombreUsuario"])) {
    $nombreUsuario = $_SESSION["NombreUsuario"];
  } else {
    header("Location: login.php");
    exit;
  }

  echo '
  <nav class="sidebar sidebar-offcanvas me-3" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="../vHome/inicio.php?vista=perfilUsuario" class="nav-link">
          <div class="nav-profile-image">
            <div class="profile-avatar bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                 style="width: 45px; height: 45px; font-size: 18px; flex-shrink: 0;">
              ' . strtoupper(substr($nombreUsuario, 0, 1) . substr(strstr($nombreUsuario, " "), 1, 1)) . '
            </div>
            <span class="login-status online"></span>
          </div>

          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2" style="white-space: normal; line-height: 1.2;">' . $nombreUsuario . '</span>
            <span class="text-secondary text-small">Empleado</span>
          </div>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <span class="menu-title">Actividad Colaboradores</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-lock menu-icon"></i>
        </a>

        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=horas">
                <span class="menu-title">Registro de Horas</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=cambioContrasenna">
                Cambiar mi Contraseña
              </a>
            </li>
            
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#permisos" aria-expanded="false" aria-controls="permisos">
          <span class="menu-title">Acciones de Personal</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-calendar-check menu-icon"></i>
        </a>

        <div class="collapse" id="permisos">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=solicitar_permiso">
                Solicitar Permiso
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=solicitar_vacaciones">
                Solicitar Vacación
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=mi_solicitudes">
                 Mis Solicitudes
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../vHome/inicio.php?vista=perfilUsuario">
          <span class="menu-title">Perfil Empleado</span>
          <i class="mdi mdi-account menu-icon"></i>
        </a>
      </li>

    </ul>
  </nav>
  ';
}

function menuAdmin()
{
  $nombreUsuario = "";
  if (isset($_SESSION["NombreUsuario"])) {
    $nombreUsuario = $_SESSION["NombreUsuario"];
  } else {
    header("Location: login.php");
    exit;
  }

  echo '
  <nav class="sidebar sidebar-offcanvas me-3" id="sidebar">
    <ul class="nav">

    <li class="nav-item nav-profile">
        <a href="../vHome/inicio.php?vista=perfilUsuario" class="nav-link">
          <div class="nav-profile-image">
            <div class="profile-avatar bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                 style="width: 45px; height: 45px; font-size: 18px; flex-shrink: 0;">
              ' . strtoupper(substr($nombreUsuario, 0, 1) . substr(strstr($nombreUsuario, " "), 1, 1)) . '
            </div>
            <span class="login-status online"></span>
          </div>

          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2" style="white-space: normal; line-height: 1.2;">' . $nombreUsuario . '</span>
            <span class="text-secondary text-small">Administrador</span>
          </div>
        </a>
      </li>

      <!-- CONFIGURACION -->
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#configuracionMenu" aria-expanded="false">
          <span class="menu-title">Configuración</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-lock menu-icon"></i>
        </a>

        <div class="collapse" id="configuracionMenu">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=registro">
                Creación de Usuarios
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=cambioContrasenna">
                Cambiar mi Contraseña
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=clientes">
                Creación Clientes
              </a>
            </li>

          </ul>
        </div>
      </li>

      <!-- ACCIONES DE PERSONAL -->
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#accionesPersonalMenu" aria-expanded="false">
          <span class="menu-title">Acciones de Personal</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-lock menu-icon"></i>
        </a>

        <div class="collapse" id="accionesPersonalMenu">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=pantallaAccionesAdmin">
                Gestión de Acciones <br> de Personal
              </a>
            </li>

          </ul>
        </div>
      </li>

      <!-- PERFIL -->
      <li class="nav-item">
        <a class="nav-link" href="../vHome/inicio.php?vista=perfilUsuario">
          <span class="menu-title">Perfil Administrador</span>
          <i class="mdi mdi-account menu-icon"></i>
        </a>
      </li>

      <!-- Reporteria -->
      <li class="nav-item">
        <a class="nav-link" href="../vHome/inicio.php?vista=consultar_reporteria">
          <span class="menu-title">Reportería</span>
          <i class="mdi mdi-account menu-icon"></i>
        </a>
      </li>

    </ul>
  </nav>
  ';
}

function menuSuperiorGeneral()
{
  $nombreUsuario = "";
  if (isset($_SESSION["NombreUsuario"])) {
    $nombreUsuario = $_SESSION["NombreUsuario"];
  } else {
    header("Location: login.php");
    exit;
  }

  echo '
        <div class="col-md-12 p-0 m-0">
        </div>
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="inicio.php"><img src="../assets/images/logo.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="inicio.php"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
      
          <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown" style="position: relative;">
                <i class="mdi mdi-bell-outline" style="font-size: 22px;"></i>
                <span id="notificacionesCounter" class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown" style="min-width: 300px;">
                <h6 class="p-3 mb-0">Notificaciones 
                   <a href="../vHome/inicio.php?vista=historialNotificaciones" class="float-end" style="font-size: 11px; text-decoration: none;">Ver todas</a>
                </h6>
                <div class="dropdown-divider"></div>
                
                <div id="notificacionesContainer" style="max-height: 300px; overflow-y: auto;">
                   <p class="text-center p-3 text-muted">Cargando...</p>
                </div>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center small text-primary py-2" href="#" id="marcarTodasLeidasBtn">
                  Marcar como leídas
                </a>
              </div>
            </li>

            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <div class="profile-avatar bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                    style="width: 35px; height: 35px; font-size: 14px; flex-shrink: 0;">
                    ' . strtoupper(substr($nombreUsuario, 0, 1) . substr(strstr($nombreUsuario, " "), 1, 1)) . '
                  </div>
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">' . $nombreUsuario . '</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#0" onclick="CerrarSesion()">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Cerrar Sesión </a>
              </div>
            </li>
            
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>        

          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>';
}
