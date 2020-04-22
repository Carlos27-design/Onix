<?php

session_start();

include_once 'DB/Marca.php';
include_once 'DB/MarcaDB.php';

$txtNombreMarca = null;

$marca = new Marca();
$marcaDB = new MarcaDB();

$ok = null;
$message = null;


if (isset($_POST['txtnombremarca']))
{
    $txtNombreMarca = $_POST['txtnombremarca'];

    if($txtNombreMarca != "")
    {
        $marca->id = 0;
        $marca->nombre = $txtNombreMarca;

        $ok = $marcaDB->crear($marca);
        header("Location:ListarMarca.php");
    }
    else
    {
        $message = "Ingrese algun dato";
        $ok = false;
        header("Location: index.php");
    }
}

if ($ok) {
    echo "creado";
    $_SESSION['message'] = '<div class="alert alert-success">
  Marca Registrado Correctamente
  <a href="#">Bienvenido</a> 
  </div>';
} else {
    echo "no creado";
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}
