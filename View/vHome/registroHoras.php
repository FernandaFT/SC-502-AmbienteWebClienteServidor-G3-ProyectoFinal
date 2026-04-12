<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Controller/ControllerHoras.php";

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

      <h4><?php echo $esEdicion ? "Editar Registro de Horas" : "Registro de Horas"; ?></h4>

      <?php if (!empty($mensaje)) echo $mensaje; ?>

      <form class="pt-3" method="POST" id="formRegistroHoras" action="?vista=horas">
        <?php if ($esEdicion) { ?>
          <input type="hidden" name="id_registro" value="<?php echo $registroEditar["id_registro"]; ?>">
        <?php } ?>

        <div class="form-group">
          <label>Cliente</label>
          <select class="form-control form-control-lg" name="id_cliente" id="id_cliente" >
            <option value="">Seleccione un cliente</option>
            <?php foreach (ListarClientesActivos() as $cli) { ?>
              <option value="<?php echo $cli["id_cliente"]; ?>"
                <?php echo ($esEdicion && $registroEditar["id_cliente"] == $cli["id_cliente"]) ? "selected" : ""; ?>>
                <?php echo htmlspecialchars($cli["nombre"]); ?>
              </option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Categoría</label>
          <select class="form-control form-control-lg" name="id_categoria_hora" id="id_categoria_hora" >
            <option value="">Seleccione una categoría</option>
            <?php foreach (ListarCategoriasHoras() as $cat) { ?>
              <option value="<?php echo $cat["id_categoria_hora"]; ?>"
                <?php echo ($esEdicion && $registroEditar["id_categoria_hora"] == $cat["id_categoria_hora"]) ? "selected" : ""; ?>>
                <?php echo htmlspecialchars($cat["nombre"]); ?>
              </option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Cantidad de horas</label>
          <input type="number"
            class="form-control form-control-lg"
            name="cantidad" id= "cantidad"
            min="1"
            value="<?php echo $esEdicion ? htmlspecialchars($registroEditar["cantidad"]) : ""; ?>">
        </div>

        <div class="form-group">
          <label>Descripción</label>
          <input type="text"
            class="form-control form-control-lg"
            name="descripcion" id="descripcion"
            maxlength="255"
            value="<?php echo $esEdicion ? htmlspecialchars($registroEditar["descripcion"]) : ""; ?>">
        </div>

        <div class="form-group">
          <label>Fecha</label>
          <input type="date"
            class="form-control form-control-lg"
            name="fecha" id="fecha"
            value="<?php echo $esEdicion ? htmlspecialchars($registroEditar["fecha"]) : ""; ?>">
        </div>

        <div class="mt-3 d-grid gap-2">
          <?php if ($esEdicion) { ?>
            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
              name="btnActualizarHoras" id="btnActualizarHoras"
              type="submit">
              ACTUALIZAR
            </button>
            <a href="?vista=horas" class="btn btn-light btn-lg">CANCELAR</a>
          <?php } else { ?>
            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
              name="btnRegistrarHoras" id="btnRegistrarHoras"
              type="submit">
              REGISTRAR HORAS
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
        <h5 class="mb-3">Horas registradas</h5>

        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($listaHoras)) { ?>
                <?php foreach ($listaHoras as $h) { ?>
                  <tr>
                    <td><?php echo htmlspecialchars($h["cliente"]); ?></td>
                    <td><?php echo htmlspecialchars($h["categoria"]); ?></td>
                    <td><?php echo htmlspecialchars($h["cantidad"]); ?></td>
                    <td><?php echo htmlspecialchars($h["descripcion"]); ?></td>
                    <td><?php echo htmlspecialchars($h["fecha"]); ?></td>
                    <td>
                      <a href="?vista=horas&accion=editar&id=<?php echo $h["id_registro"]; ?>"
                        class="btn btn-gradient-primary btn-rounded btn-sm">Editar</a>
                    </td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="6">No hay registros de horas.</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <!-- PAGINACIÓN -->
          <nav class="mt-3">
            <ul class="pagination justify-content-center">
              <li class="page-item <?php echo ($pagina <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?vista=horas&pagina=<?php echo $pagina - 1; ?>">Anterior</a>
              </li>
              <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>
                <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                  <a class="page-link" href="?vista=horas&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
              <?php } ?>
              <li class="page-item <?php echo ($pagina >= $totalPaginas) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?vista=horas&pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

