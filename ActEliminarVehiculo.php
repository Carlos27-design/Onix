<?php
session_start();
include_once 'DB/VehiculoDB.php';

//session_start();
//if (!isset($_SESSION['admin'])) {

$vehiculoDB = new VehiculoDB();

$id = 0;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$ok = $vehiculoDB->eliminar($id);
if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">Eliminado correctamente</div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">Error al eliminar</div>';
}

header("Location: listarVehiculo.php");
