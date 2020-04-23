<?php

session_start();

include_once 'DB/Marca.php';
include_once 'DB/MarcaDB.php';

$txtNombreMarca = null;

$marca = new Marca();
$marcaDB = new MarcaDB();

$ok = null;
$message = null;


if (isset($_POST['txtnombremarca'])) {
  $txtNombreMarca = $_POST['txtnombremarca'];

  if ($txtNombreMarca != "") {
    $marca->id = 0;
    $marca->nombre = $txtNombreMarca;

    $ok = $marcaDB->crear($marca);
  } else {
    $message = "Ingrese algun dato";
    $ok = false;
  }
}

if ($ok) {

  echo "creado";
  $_SESSION['message'] = '<div class="alert alert-success">
  Marca Registrado Correctamente

  </div>';
} else {

  $_SESSION['message'] = '<div class="alert alert-danger">No registrado</div>';
}
header("Location:ListarMarca.php");
