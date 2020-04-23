<?php
session_start();
include_once 'DB/TipoVehiculoDB.php';

//session_start();
//if (!isset($_SESSION['admin'])) {

$tipoVehiculoDB = new TipoVehiculoDB();

$id = 0;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$ok = $tipoVehiculoDB->eliminar($id);

if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">Eliminado correctamente</div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">Error al eliminar</div>';
}

header("Location: listarTipoVehiculo.php");
