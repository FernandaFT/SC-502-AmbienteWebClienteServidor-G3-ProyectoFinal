<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerRegistro.php";
?>

<?php
CSS();
?>

<div class="row">

  <!-- FORMULARIO -->
  <div class="col-lg-4 auth">

    <div class="auth-form-light text-left p-5 border border-4 rounded">
      <div class="brand-logo">
        <img src="../assets/images/Logo.png">
      </div>

      <h4>Registro de Empleados</h4>


      <?php
      if (isset($_POST["Mensaje"])) {
        echo $_POST["Mensaje"];
      }
      ?>

      <form class="pt-3" method="POST" id="formRegistro">
        <div class="form-group">
          <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Nombre">
        </div>

        <div class="form-group">
          <input type="email" class="form-control form-control-lg" id="correo" name="correo" placeholder="Correo Electrónico">
        </div>

        <div class="form-group">
          <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Contraseña">
        </div>

        <div class="form-group">
          <select class="form-select form-select-lg" id="rol" name="rol" required>
            <option value="" selected disabled>Seleccione el rol</option>
            <option value="1">Administrador</option>
            <option value="2">Empleado</option>
          </select>
        </div>

        <div class="mt-3 d-grid gap-2">
          <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
            id="btnRegistro" name="btnRegistro" type="submit">
            REGISTRAR EMPLEADO
          </button>
        </div>

      </form>
    </div>
  </div>


  <!-- TABLA -->
  <div class="col-lg-8">

    <div class="card">
      <div class="card-body">

        <h5 class="mb-3">Empleados registrados</h5>

        <div class="table-responsive" id="tablaEmpleados">

          <table class="table table-hover">

            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
              </tr>
            </thead>

            <tbody>
              <?php if (!empty($listaUsuarios)) { ?>
                <?php foreach ($listaUsuarios as $u) { ?>

                  <tr>
                    <td><?php echo $u["id_usuario"]; ?></td>
                    <td><?php echo $u["nombre"]; ?></td>
                    <td><?php echo $u["correo"]; ?></td>

                    <td>
                      <?php if ($u["rol"] == 1) { ?>
                        <span class="badge bg-warning text-dark">Admin</span>
                      <?php } else { ?>
                        <span class="badge bg-info">Empleado</span>
                      <?php } ?>
                    </td>

                    <td>
                      <?php if ($u["estado"]) { ?>
                        <span class="badge bg-success">Activo</span>
                      <?php } else { ?>
                        <span class="badge bg-danger">Inactivo</span>
                      <?php } ?>
                    </td>
                  </tr>

                <?php } ?>
              <?php } else { ?>

                <tr>
                  <td colspan="5">No hay usuarios registrados.</td>
                </tr>

              <?php } ?>
            </tbody>

          </table>

          <!-- PAGINACIÓN -->
          <nav class="mt-3">
            <ul class="pagination justify-content-center">

              <li class="page-item <?php echo ($pagina <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="inicio.php?vista=registro&pagina=<?php echo $pagina - 1; ?>">Anterior</a>
              </li>

              <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>

                <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                  <a class="page-link" href="inicio.php?vista=registro&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>

              <?php } ?>

              <li class="page-item <?php echo ($pagina >= $totalPaginas) ? 'disabled' : ''; ?>">
                <a class="page-link" href="inicio.php?vista=registro&pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
              </li>

            </ul>
          </nav>

        </div>

      </div>
    </div>

  </div>

</div>

<?php
JS();
?>