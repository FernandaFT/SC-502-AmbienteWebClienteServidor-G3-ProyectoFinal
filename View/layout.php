<?php

function MostrarCSS()
{
    echo
        '<head>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>SGH</title>

            <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
            <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
            <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
            <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
            <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
            <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
            <link rel="stylesheet" href="../assets/css/style.css">
            <link rel="shortcut icon" href="../assets/images/favicon.png" />
        </head>';
}

function MostrarSideBar()
{
    echo
        '<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../assets/images/faces/face1.jpg" alt="profile" />
                  <span class="login-status online"></span>

                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">Usuario Ejemplo</span>
                  <span class="text-secondary text-small">Empleado</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
        
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Actividad Usuarios</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-lock menu-icon"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="../vHome/inicio.php"> Registro de Horas </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>';
}

function MostrarJS()
{
    echo
        '<script src="../assets/vendors/js/vendor.bundle.base.js"></script>

        <script src="../assets/vendors/chart.js/chart.umd.js"></script>
        <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

        <script src="../assets/js/off-canvas.js"></script>
        <script src="../assets/js/misc.js"></script>
        <script src="../assets/js/settings.js"></script>
        <script src="../assets/js/todolist.js"></script>
        <script src="../assets/js/jquery.cookie.js"></script>';
}

?>