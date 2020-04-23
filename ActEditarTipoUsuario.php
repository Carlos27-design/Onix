<?php
session_start();
include_once 'DB/TipoUsuario.php';
include_once 'DB/TipoUsuarioDB.php';


$message = "";

$id = null;
$nombre = null;


if (isset($_POST['txtNombre']) && isset($_GET["id"])) {
  $id = $_GET['id'];
  $nombre = $_POST['txtNombre'];

  if (($id && $nombre) != "") {


    $tipoUsuario = new TipoUsuario();
    $tipoUsuarioDB = new TipoUsuarioDB();

    $tipoUsuario->id = $id;
    $tipoUsuario->nombre = $nombre;

    $ok = $tipoUsuarioDB->editar($tipoUsuario);
  } else {
    $message = "Debe ingresar todos los datos";
    $ok = false;
  }
}


if ($ok) {
  $_SESSION['message'] = '<div class="alert alert-success">
  Tipo Usuario editado </div>';
} else {
  $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

header("Location: EditarTipoUsuario.php?id=" . $id);
