<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelRegistro.php";

$vista = $_GET["vista"] ?? "registro";

$esEdicion = false;
$usuarioEditar = null;
$mensaje = "";

/* REGISTRAR USUARIO */
if (isset($_POST["btnRegistro"])) {

    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $contrasenna = trim($_POST["password"] ?? "");
    $rol = (int)($_POST["rol"] ?? 0);

    if (empty($nombre) || empty($correo) || empty($contrasenna) || empty($rol)) {
        $mensaje = "<div class='alert alert-danger'>Todos los campos son obligatorios.</div>";
    } else {
        $result = RegistrarUsuario($nombre, $correo, $contrasenna, $rol);

        if ($result && $result["resultado"] == 1) {
            $mensaje = "<div class='alert alert-success'>" . $result["mensaje"] . "</div>";
        } else {
            $mensaje = "<div class='alert alert-danger'>" . ($result["mensaje"] ?? "No se pudo registrar el usuario.") . "</div>";
        }
    }
}

/* ACTIVAR / INACTIVAR */
if (isset($_GET["accion"]) && isset($_GET["id"])) {

    $id = (int)$_GET["id"];
    $accion = $_GET["accion"];

    if ($accion == "inactivar") {
        CambiarEstadoUsuario($id, 0);
        header("Location: ../View/vHome/inicio.php?vista=registro");
        exit();
    }

    if ($accion == "activar") {
        CambiarEstadoUsuario($id, 1);
        header("Location: ../View/vHome/inicio.php?vista=registro");
        exit();
    }
}

/* CARGAR DATOS PARA EDITAR */
if (isset($_GET["accion"]) && $_GET["accion"] == "editar" && isset($_GET["id"])) {
    $idEditar = (int)$_GET["id"];
    $usuarioEditar = ObtenerUsuarioPorId($idEditar);

    if ($usuarioEditar) {
        $esEdicion = true;
        $vista = "registro";
    } else {
        $mensaje = "<div class='alert alert-danger'>No se encontró el usuario a editar.</div>";
    }
}

/* ACTUALIZAR USUARIO */
if (isset($_POST["btnActualizar"])) {

    $id = (int)($_POST["id_usuario"] ?? 0);
    $nombre = trim($_POST["nombre"] ?? "");
    $rol = (int)($_POST["rol"] ?? 0);

    if (empty($id) || empty($nombre) || empty($rol)) {
        $mensaje = "<div class='alert alert-danger'>Nombre y rol son obligatorios para actualizar.</div>";
    } else {
        $result = ActualizarUsuario($id, $nombre, $rol);

        if ($result) {
            $mensaje = "<div class='alert alert-success'>Usuario actualizado correctamente.</div>";
            $usuarioEditar = null;
            $esEdicion = false;
            $vista = "registro";
        } else {
            $mensaje = "<div class='alert alert-danger'>Error al actualizar usuario.</div>";
        }
    }
}

/* PAGINACIÓN */
$registrosPorPagina = 5;
$pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;

if ($pagina < 1) {
    $pagina = 1;
}

$totalUsuarios = TotalUsuarios();
$totalPaginas = ceil($totalUsuarios / $registrosPorPagina);

if ($totalPaginas < 1) {
    $totalPaginas = 1;
}

if ($pagina > $totalPaginas) {
    $pagina = $totalPaginas;
}

$listaUsuarios = ListarUsuarios($pagina, $registrosPorPagina);
?>