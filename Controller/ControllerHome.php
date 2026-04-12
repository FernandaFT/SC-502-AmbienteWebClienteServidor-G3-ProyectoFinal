<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelHome.php";

$vista = $_GET["vista"] ?? "clientes";

$esEdicion = false;
$clienteEditar = null;
$mensaje = "";

/* REGISTRAR CLIENTE */
if (isset($_POST["btnRegistrar"])) {

    $nombre = trim($_POST["nombre"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");

    if (empty($nombre) || empty($descripcion)) {

        $mensaje = "<div class='alert alert-danger'>Todos los campos son obligatorios.</div>";
        $esEdicion = false;
        $clienteEditar = null;
    } else {

        $result = RegistrarCliente($nombre, $descripcion);

        if ($result && $result["resultado"] == 1) {

            $mensaje = "<div class='alert alert-success'>" . $result["mensaje"] . "</div>";
            $esEdicion = false;
            $clienteEditar = null;
        } else {

            $mensaje = "<div class='alert alert-danger'>" . $result["mensaje"] . "</div>";
            $esEdicion = false;
            $clienteEditar = null;
        }
    }
}


/* ACTIVAR / INACTIVAR CLIENTE */
if (isset($_GET["accion"]) && isset($_GET["id"])) {

    $id = (int)$_GET["id"];
    $accion = $_GET["accion"];

    if ($accion == "inactivarCliente") {
        CambiarEstadoCliente($id, 0);
        $mensaje = "<div class='alert alert-success'>Cliente inactivado.</div>";
    }

    if ($accion == "activarCliente") {
        CambiarEstadoCliente($id, 1);
        $mensaje = "<div class='alert alert-success'>Cliente activado.</div>";
    }
}


/* CARGAR CLIENTE PARA EDITAR */
if (
    !isset($_POST["btnRegistrar"]) &&
    !isset($_POST["btnActualizar"]) &&
    isset($_GET["accion"]) &&
    $_GET["accion"] == "editar" &&
    isset($_GET["id"])
) {

    $idEditar = (int)$_GET["id"];
    $clienteEditar = ObtenerClientePorId($idEditar);

    if ($clienteEditar) {

        $esEdicion = true;
        $vista = "clientes";
    } else {

        $mensaje = "<div class='alert alert-danger'>No se encontró el cliente.</div>";
    }
}


/* ACTUALIZAR CLIENTE */
if (isset($_POST["btnActualizar"])) {

    $id = (int)($_POST["id_cliente"] ?? 0);
    $nombre = trim($_POST["nombre"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");

    if (empty($id) || empty($nombre) || empty($descripcion)) {

        $mensaje = "<div class='alert alert-danger'>Todos los campos son obligatorios para actualizar.</div>";
        $esEdicion = true;
        $clienteEditar = ObtenerClientePorId($id);
    } else {

        $result = ActualizarCliente($id, $nombre, $descripcion);

        if ($result) {

            $mensaje = "<div class='alert alert-success'>Cliente actualizado correctamente.</div>";
            $esEdicion = false;
            $clienteEditar = null;
        } else {

            $mensaje = "<div class='alert alert-danger'>Error al actualizar el cliente.</div>";
            $esEdicion = true;
            $clienteEditar = ObtenerClientePorId($id);
        }
    }
}


/* PAGINACIÓN */
$registrosPorPagina = 5;
$pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;

if ($pagina < 1) {
    $pagina = 1;
}

$totalClientes = TotalClientes();
$totalPaginas = ceil($totalClientes / $registrosPorPagina);

if ($totalPaginas < 1) {
    $totalPaginas = 1;
}

if ($pagina > $totalPaginas) {
    $pagina = $totalPaginas;
}

$listaClientes = ListarClientes($pagina, $registrosPorPagina);
