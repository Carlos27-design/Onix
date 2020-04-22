<?php

session_start();

include_once 'DB/Modelo.php';
include_once 'DB/ModeloDB.php';

$modelo = new Modelo();
$modeloDB = new ModeloDB();

$txtNombreModelo = null;
$txtMarca = null;

$ok = null;
$message = null;

if (isset($_POST['txtnombremodelo']) && isset($_POST['txtMarca']))
{
    $txtNombreModelo = $_POST['txtnombremodelo'];
    $txtMarca = $_POST['txtMarca'];

    if ($txtNombreModelo != "" && $txtMarca != 0)
    {
        $modelo->id = 0;
        $modelo->nombre = $txtNombreModelo;
        $modelo->marca_id = $txtMarca;

        $ok = $modeloDB->crear($modelo);
        header('Location: ListarModelo.php');
    }
    else
    {
        $message = "rellene los campos";
        $ok = false;
        header('Location: IngresarModelo.php');
    }
}

if ($ok) {
    echo "creado";
    $_SESSION['message'] = '<div class="alert alert-success">
  Modelo Registrado Correctamente
  <a href="#">Bienvenido</a> 
  </div>';
} else {
    echo "no creado";
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}