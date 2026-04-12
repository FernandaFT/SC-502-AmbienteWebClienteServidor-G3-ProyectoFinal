<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerHome.php";

if (!isset($_SESSION["NombreUsuario"])) {
  header("Location: inicio_sesion.php");
  exit;
}
?>

<div class="row">

  <!-- FORMULARIO -->
  <div class="col-lg-4 auth">

    <div class="auth-form-light text-left p-5 border border-4 rounded">

      <div class="brand-logo">
        <img src="../assets/images/Logo.png">
      </div>

      <h4><?php echo $esEdicion ? "Editar Cliente" : "Registro de Clientes"; ?></h4>

      <?php
      if (isset($mensaje) && !empty($mensaje)) {
        echo $mensaje;
      }
      ?>

      <form class="pt-3" method="POST" id="formRegistroClientes" action="?vista=clientes">

        <?php if ($esEdicion) { ?>
          <input type="hidden" name="id_cliente" value="<?php echo $clienteEditar["id_cliente"]; ?>">
        <?php } ?>

        <div class="form-group">
          <input type="text"
            class="form-control form-control-lg"
            name="nombre"
            placeholder="Nombre del Cliente"
            required
            value="<?php echo $esEdicion ? htmlspecialchars($clienteEditar["nombre"]) : ""; ?>">
        </div>

        <div class="form-group">
          <textarea
            class="form-control form-control-lg"
            name="descripcion"
            placeholder="Descripción del cliente"
            required><?php echo $esEdicion ? htmlspecialchars($clienteEditar["descripcion"]) : ""; ?></textarea>
        </div>

        <div class="mt-3 d-grid gap-2">

          <?php if ($esEdicion) { ?>

            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
              name="btnActualizar"
              type="submit">
              ACTUALIZAR
            </button>

            <a href="?vista=clientes" class="btn btn-light btn-lg">
              CANCELAR
            </a>

          <?php } else { ?>

            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
              name="btnRegistrar"
              type="submit">
              REGISTRAR CLIENTE
            </button>

          <?php } ?>

        </div>

      </form>

    </div>
  </div>


  <!-- TABLA -->
  <div class="col-lg-8">

    <div class="card">
      <div class="card-body">

        <h5 class="mb-3">Clientes registrados</h5>

        <div class="table-responsive">

          <table class="table table-hover">

            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php if (!empty($listaClientes)) { ?>

                <?php foreach ($listaClientes as $c) { ?>

                  <tr>

                    <td><?php echo htmlspecialchars($c["nombre"]); ?></td>

                    <td><?php echo htmlspecialchars($c["descripcion"]); ?></td>

                    <td>
                      <?php if ($c["activo"]) { ?>
                        <span class="badge bg-success">Activo</span>
                      <?php } else { ?>
                        <span class="badge bg-danger">Inactivo</span>
                      <?php } ?>
                    </td>

                    <td>
                      <div class="d-flex gap-2">

                        <a href="?vista=clientes&accion=editar&id=<?php echo $c["id_cliente"]; ?>"
                          class="btn btn-gradient-primary btn-rounded btn-sm">
                          Editar
                        </a>

                        <?php if ($c["activo"]) { ?>

                          <a href="?vista=clientes&accion=inactivarCliente&id=<?php echo $c["id_cliente"]; ?>"
                            class="btn btn-gradient-danger btn-rounded btn-sm">
                            Inactivar
                          </a>

                        <?php } else { ?>

                          <a href="?vista=clientes&accion=activarCliente&id=<?php echo $c["id_cliente"]; ?>"
                            class="btn btn-gradient-success btn-rounded btn-sm">
                            Activar
                          </a>

                        <?php } ?>



                      </div>
                    </td>

                  </tr>

                <?php } ?>

              <?php } else { ?>

                <tr>
                  <td colspan="4">No hay clientes registrados.</td>
                </tr>

              <?php } ?>

            </tbody>

          </table>

          <!-- PAGINACIÓN -->
          <nav class="mt-3">
            <ul class="pagination justify-content-center">

              <li class="page-item <?php echo ($pagina <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?vista=clientes&pagina=<?php echo $pagina - 1; ?>">
                  Anterior
                </a>
              </li>

              <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>
                <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                  <a class="page-link" href="?vista=clientes&pagina=<?php echo $i; ?>">
                    <?php echo $i; ?>
                  </a>
                </li>
              <?php } ?>

              <li class="page-item <?php echo ($pagina >= $totalPaginas) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?vista=clientes&pagina=<?php echo $pagina + 1; ?>">
                  Siguiente
                </a>
              </li>

            </ul>
          </nav>

        </div>

      </div>
    </div>

  </div>

</div>