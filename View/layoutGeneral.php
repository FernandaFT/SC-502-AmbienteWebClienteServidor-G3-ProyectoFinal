<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function CSSGeneral()
{
    echo '
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" />';
}

function JSGeneral()
{
    echo '
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
    <script src="../assets/funciones/permisos.js"></script>';
}

function menuEmpleado()
{
    $nombreUsuario = isset($_SESSION["NombreUsuario"]) ? $_SESSION["NombreUsuario"] : "Empleado";
    echo '
    <nav class="sidebar sidebar-offcanvas me-3" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="nav-profile-image">
                        <img src="../assets/images/faces/face1.jpg" alt="profile" />
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2">' . $nombreUsuario . '</span>
                        <span class="text-secondary text-small">Empleado</span>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../vHome/inicio.php">
                    <span class="menu-title">Registro de Horas</span>
                    <i class="mdi mdi-clock-outline menu-icon"></i>
                </a>
            </li>
<li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#vacaciones" aria-expanded="false" aria-controls="vacaciones">
          <span class="menu-title">Solicitud de Vacaciones</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-calendar menu-icon"></i>
        </a>
        <div class="collapse" id="vacaciones">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> 
              <a class="nav-link" href="../vHome/inicio.php?vista=solicitud_vacaciones">
                <i class="mdi mdi-plus-circle"></i> Nueva Solicitud
              </a> 
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#permisos" aria-expanded="false" aria-controls="permisos">
          <span class="menu-title">Solicitud de Permisos</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-calendar-check menu-icon"></i>
        </a>
        <div class="collapse" id="permisos">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=solicitar_permiso">
                <i class="mdi mdi-plus-circle"></i> Solicitar Permiso
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../vHome/inicio.php?vista=mi_solicitudes">
                <i class="mdi mdi-list-status"></i> Mis Solicitudes
              </a>
            </li>
          </ul>
        </div>
      </li>
            <li class="nav-item">
                <a class="nav-link" href="../vHome/inicio.php?vista=solicitud_vacaciones">
                    <span class="menu-title">Solicitud de Vacaciones</span>
                    <i class="mdi mdi-account menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../vHome/inicio.php?vista=perfilUsuario">
                    <span class="menu-title">Perfil Empleado</span>
                    <i class="mdi mdi-account menu-icon"></i>
                </a>
            </li>
        </ul>
    </nav>';
}

function menuSuperiorGeneral()
{
    $nombreUsuario = isset($_SESSION["NombreUsuario"]) ? $_SESSION["NombreUsuario"] : "Usuario";
    echo '
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <a class="navbar-brand brand-logo" href="inicio.php"><img src="../assets/images/logo.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">' . $nombreUsuario . '</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#0" onclick="CerrarSesion()">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Cerrar Sesión </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>';
}

?>