<?php

include_once "DB/TipoVehiculo.php";
include_once "DB/TipoVehiculoDB.php";

$tipoVehiculo = new TipoVehiculo();
$tipoVehiculoDB = new TipoVehiculoDB();

$txtNombreTipoVehiculo = null;

$ok = null;
$message = null;

if(isset($_POST['txtnombretipovehiculo']))
{
    $txtNombreTipoVehiculo = $_POST['txtnombretipovehiculo'];

    if($txtNombreTipoVehiculo != "")
    {
        $tipoVehiculo->id = 0;
        $tipoVehiculo->nombre = $txtNombreTipoVehiculo;

        $ok = $tipoVehiculoDB->crear($tipoVehiculo);

        header("Location: ListarTipoVehiculo.php");
    }
    else
    {
        $message = "Rellene el campo";
        $ok = false;
        header("Location: index.php");
    }
}

if ($ok) {
    echo "creado";
    $_SESSION['message'] = '<div class="alert alert-success">
  Tipo Vehiculo Registrado Correctamente
  <a href="#">Bienvenido</a> 
  </div>';
} else {
    echo "no creado";
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}