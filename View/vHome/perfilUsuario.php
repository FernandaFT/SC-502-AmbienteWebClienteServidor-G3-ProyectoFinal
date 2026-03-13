<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION["NombreUsuario"])) {
  header("Location: inicio_sesion.php");
  exit;
} else {
  $nombre = $_SESSION["NombreUsuario"];
  $correo = $_SESSION["Correo"];
  $rol = $_SESSION["Rol"];
  $fecha = $_SESSION["Fecha"];

  /* Convertir rol */
  $rolTexto = "";
  if ($rol == 1) {
    $rolTexto = "Administrador";
  } elseif ($rol == 2) {
    $rolTexto = "Empleado";
  }
}
?>

<div class="row justify-content-center">

  <div class="col-lg-5 auth">

    <div class="auth-form-light text-left p-5 border border-4 rounded">

      <div class="brand-logo text-center">
        <img src="../assets/images/Logo.png">
      </div>

      <h4 class="text-center mb-4">Perfil de Usuario</h4>

      <form class="pt-3">

        <!-- Nombre -->
        <div class="form-group mb-3">
          <label><strong>Nombre</strong></label>
          <input type="text"
            class="form-control form-control-lg"
            value="<?php echo htmlspecialchars($nombre); ?>"
            readonly>
        </div>

        <!-- Correo -->
        <div class="form-group mb-3">
          <label><strong>Correo Electrónico</strong></label>
          <input type="email"
            class="form-control form-control-lg"
            value="<?php echo htmlspecialchars($correo); ?>"
            readonly>
        </div>

        <!-- Rol -->
        <div class="form-group mb-3">
          <label><strong>Rol</strong></label>
          <input type="text"
            class="form-control form-control-lg"
            value="<?php echo $rolTexto; ?>"
            readonly>
        </div>

        <!-- Fecha de ingreso -->
        <div class="form-group mb-3">
          <label><strong>Fecha de Ingreso</strong></label>
          <input type="text"
            class="form-control form-control-lg"
            value="<?php echo date("d/m/Y", strtotime($fecha)); ?>"
            readonly>
        </div>

      </form>

    </div>

  </div>

</div>