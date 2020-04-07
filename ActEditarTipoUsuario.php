<?php
session_start();
include_once 'BD/TipoUsuario.php';
include_once 'BD/TipoUsuarioDB.php';


$message = "";

$id = null;
$nombre = null;


if (isset($_POST['txtNombre']) && isset($_GET["id"])) {
    $id = $_GET['id'];
    $nombre = $_POST['txtNombre'];

    if (($id && $nombre) != "") {


        $usuario = new Usuario();
        $usuarioDB = new UsuarioDB();

        $usuario->idEvento = $id;
        $usuario->nombre = $nombre;

        $ok = $nombreDB->editar($usuario);
    } else {
        $message = "Debe ingresar todos los datos";
        $ok = false;
    }
}


if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">
  Evento Editado Correctamente <a href="eventos.php">Haga clíck aquí para ver la lista de eventos</a> </div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

// header("Location: EventoEditar.php?id=" . $id);
