<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/Model/ModelHoras.php";

$vista = $_GET["vista"] ?? "horas";
$esEdicion = false;
$registroEditar = null;
$mensaje = "";

// Registrar horas
if (isset($_POST["btnRegistrarHoras"])) {
    $idUsuario = $_SESSION["IdUsuario"] ?? 0;
    $idCliente = (int)($_POST["id_cliente"] ?? 0);
    $idCategoriaHora = (int)($_POST["id_categoria_hora"] ?? 0); // corregido: nombre real
    $cantidad = (int)($_POST["cantidad"] ?? 0);                 // corregido: nombre real
    $descripcion = trim($_POST["descripcion"] ?? "");           // agregado: campo requerido en SP
    $fecha = trim($_POST["fecha"] ?? "");

    if (empty($idUsuario) || empty($idCliente) || empty($idCategoriaHora) || empty($cantidad) || empty($descripcion) || empty($fecha)) {
        $mensaje = "<div class='alert alert-danger'>Todos los campos son obligatorios.</div>";
    } else {
        $result = RegistrarHoras($idUsuario, $idCliente, $idCategoriaHora, $cantidad, $descripcion, $fecha);
        if ($result && $result["resultado"] == 1) {
            $mensaje = "<div class='alert alert-success'>" . $result["mensaje"] . "</div>";
        } else {
            $mensaje = "<div class='alert alert-danger'>" . ($result["mensaje"] ?? "Error al registrar horas.") . "</div>";
        }
    }
}

// Cargar registro para edición
if (isset($_GET["accion"]) && $_GET["accion"] == "editar" && isset($_GET["id"])) {
    $idEditar = (int)$_GET["id"];
    $registroEditar = ObtenerHoraPorId($idEditar);

    if ($registroEditar) {
        $esEdicion = true;
        $vista = "horas";
    } else {
        $mensaje = "<div class='alert alert-danger'>No se encontró el registro de horas.</div>";
    }
}

// Actualizar horas
if (isset($_POST["btnActualizarHoras"])) {
    $idRegistro = (int)($_POST["id_registro"] ?? 0);
    $idCliente = (int)($_POST["id_cliente"] ?? 0);
    $idCategoriaHora = (int)($_POST["id_categoria_hora"] ?? 0); // corregido
    $cantidad = (int)($_POST["cantidad"] ?? 0);                 // corregido
    $descripcion = trim($_POST["descripcion"] ?? "");           // agregado
    $fecha = trim($_POST["fecha"] ?? "");

    if (empty($idRegistro) || empty($idCliente) || empty($idCategoriaHora) || empty($cantidad) || empty($descripcion) || empty($fecha)) {
        $mensaje = "<div class='alert alert-danger'>Todos los campos son obligatorios para actualizar.</div>";
        $esEdicion = true;
        $registroEditar = ObtenerHoraPorId($idRegistro);
    } else {
        $result = EditarHoras($idRegistro, $idCliente, $idCategoriaHora, $cantidad, $descripcion, $fecha);
        if ($result) {
            $mensaje = "<div class='alert alert-success'>Registro de horas actualizado correctamente.</div>";
            $esEdicion = false;
            $registroEditar = null;
        } else {
            $mensaje = "<div class='alert alert-danger'>Error al actualizar el registro de horas.</div>";
            $esEdicion = true;
            $registroEditar = ObtenerHoraPorId($idRegistro);
        }
    }
}

// Paginación
$idUsuario = $_SESSION["IdUsuario"] ?? 0;
$registrosPorPagina = 5;
$pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
if ($pagina < 1) $pagina = 1;

$totalHoras = TotalHorasPorUsuario($idUsuario);
$totalPaginas = ceil($totalHoras / $registrosPorPagina);
if ($totalPaginas < 1) $totalPaginas = 1;
if ($pagina > $totalPaginas) $pagina = $totalPaginas;

$inicio = ($pagina - 1) * $registrosPorPagina;
$listaHoras = ListarHorasPorUsuario($idUsuario, $inicio, $registrosPorPagina);
?>
