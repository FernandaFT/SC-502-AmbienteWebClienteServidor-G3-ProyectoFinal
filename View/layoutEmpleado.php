<?php
//include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Web/Controller/HomeController.php";
if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}

function contenidoEmpleado(){
  $nombreUsuario = $_SESSION["NombreUsuario"];
  echo
  '<div class="container-fluid page-body-wrapper">

        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../assets/images/faces/face1.jpg" alt="profile" />
                  <span class="login-status online"></span>

                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">'. $nombreUsuario .'</span>
                  <span class="text-secondary text-small">Empleado</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
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
                    <a class="nav-link" href="../vHome/inicio.php"> Registro de Horas</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        </div>';
}