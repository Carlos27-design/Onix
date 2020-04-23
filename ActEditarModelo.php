<?php
session_start();
include_once 'DB/Modelo.php';
include_once 'DB/ModeloDB.php';


$message = "";

$id = null;
$nombre = null;
$marca_id = null;


if (isset($_POST['txtNombre']) && isset($_GET["id"]) && isset($_POST['slcMarca'])) {
  $id = $_GET['id'];
  $nombre = $_POST['txtNombre'];
  $marca_id = $_POST['slcMarca'];

  if (($id && $nombre && $marca_id)  != "") {


    $modelo = new Modelo();
    $modeloDB = new ModeloDB();

    $modelo->id = $id;
    $modelo->nombre = $nombre;
    $modelo->marca_id = $marca_id;

    $ok = $modeloDB->editar($modelo);
  } else {
    $message = "Debe ingresar todos los datos";
    $ok = false;
  }
}


if ($ok) {
  $_SESSION['message'] = '<div class="alert alert-success">
  Editado Correctamente</div>';
} else {
  $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

header("Location: EditarModelo.php?id=" . $id);
