<?php
session_start();
include_once 'DB/Vehiculo.php';
include_once 'DB/VehiculoDB.php';

$vehiculo = new Vehiculo();
$vehiculoDB = new VehiculoDB();

$message = "";

if (
    isset($_POST['txtPrecio'])
    && isset($_POST['txtLargo'])
    && isset($_POST['txtAncho'])
    && isset($_POST['txtPeso'])
    && isset($_POST['slcModelo'])
    && isset($_POST['slcTipoVehiculo'])
    && isset($_GET['id'])
) {
    $txtPrecio =  $_POST['txtPrecio'];
    $txtLargo =  $_POST['txtLargo'];
    $txtAncho = $_POST['txtAncho'];
    $txtPeso =  $_POST['txtPeso'];
    $slcModelo =  $_POST['slcModelo'];
    $slcTipoVehiculo =  $_POST['slcTipoVehiculo'];
    $id =  $_GET['id'];



    if (($txtPrecio && $txtLargo && $txtAncho &&
        $txtPeso && $slcModelo && $slcTipoVehiculo) != "") {
        $vehiculo = $vehiculoDB->buscar($_GET['id']);
        $vehiculo->id = $_GET['id'];
        $vehiculo->precio = $txtPrecio;
        $vehiculo->largo = $txtLargo;
        $vehiculo->ancho = $txtAncho;
        $vehiculo->peso = $txtPeso;
        $vehiculo->modelo_id = $slcModelo;
        $vehiculo->tipoVehiculo_id = $slcTipoVehiculo;
        $ok = $vehiculoDB->editar($vehiculo);
    } else {
        $message = "Debe ingresar todos los datos";
        $ok = false;
    }
}


if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">
  Vehiculo Editado Correctamente <a href="MiVehiculo.php"></a> </div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

header("Location: EditarMiVehiculo.php?id=" . $_GET['id']);
