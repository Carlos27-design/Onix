<?php
session_start();
include_once 'DB/TipoVehiculo.php';
include_once 'DB/TipoVehiculoDB.php';


$message = "";

$id = null;
$nombre = null;


if (isset($_POST['txtNombre']) && isset($_GET["id"])) {
    $id = $_GET['id'];
    $nombre = $_POST['txtNombre'];

    if (($id && $nombre) != "") {


        $tipoVehiculo = new TipoVehiculo();
        $tipoVehiculoDB = new TipoVehiculoDB();

        $tipoVehiculo->id = $id;
        $tipoVehiculo->nombre = $nombre;

        $ok = $tipoVehiculoDB->editar($tipoVehiculo);
    } else {
        $message = "Debe ingresar todos los datos";
        $ok = false;
    }
}


if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">
  Tipo Vehiculo Editado Correctamente </div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

header("Location: EditarTipoVehiculo.php?id=" . $id);
