<?php

session_start();

include_once 'DB/Vehiculo.php';
include_once 'DB/VehiculoDB.php';

$txtPatente = null;
$txtLargo = null;
$txtAncho = null;
$txtPeso = null;
$txtPrecio = null;
$txtTipoVehiculo = null;
$txtModelo = null;
$txtUsuario = null;

$vehiculo = new Vehiculo();
$VehiculoDB = new VehiculoDB();

$ok = null;
$message = null;

if (
    isset($_POST['txtpatente']) && isset($_POST['txtlargo']) && isset($_POST['txtancho']) &&
    isset($_POST['txtpeso']) && isset($_POST['txtprecio']) && isset($_POST['txttipovehiculo']) &&
    isset($_POST['txtmodelo']) && isset($_POST['txtusuario'])
    )
{

    $txtPatente = $_POST['txtpatente'];
    $txtLargo = $_POST['txtlargo'];
    $txtAncho = $_POST['txtancho'];
    $txtPeso = $_POST['txtpeso'];
    $txtPrecio = $_POST['txtprecio'];
    $txtTipoVehiculo = $_POST['txttipovehiculo'];
    $txtModelo = $_POST['txtmodelo'];
    $txtUsuario = $_POST['txtusuario'];

    if (
        $txtPatente && $txtLargo && $txtAncho && $txtPeso && $txtPrecio != "" && $txtTipoVehiculo && $txtModelo && $txtUsuario !=0
        )
        {
            $vehiculo->id = 0;
            $vehiculo->patente = $txtPatente;
            $vehiculo->largo = $txtLargo;
            $vehiculo->ancho = $txtAncho;
            $vehiculo->peso = $txtPeso;
            $vehiculo->precio = $txtPrecio;
            $vehiculo->tipoVehiculo_id = $txtTipoVehiculo;
            $vehiculo->modelo_id = $txtModelo;
            $vehiculo->usuario_id = $txtUsuario;

            $ok = $VehiculoDB->crear($vehiculo);
            header("Location: ListarVehiculo.php");
        }
        else
        {
            $message = "Tiene que ingresar todos los datos";
            $ok = false;
            header("Location: index.php");
        }


}