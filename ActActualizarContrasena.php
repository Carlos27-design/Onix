<?php
session_start();
include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$usuario = new Usuario();
$usuarioDB = new UsuarioDB();

$message = "";

if (
    isset($_POST['txtContrasena']) && isset($_POST['txtContrasenaNueva'])
) {
    $txtContrasena =  $_POST['txtContrasena'];
    $txtContrasenaNueva = $_POST['txtContrasenaNueva'];


    if (($txtContrasena && $txtContrasenaNueva) != "") {
        $usuario = $usuarioDB->buscar($_GET['id']);
        if ($txtContrasena == $usuario->contrasena) {
            $usuario->contrasena = $txtContrasenaNueva;
            $ok = $usuarioDB->editar($usuario);
        } else {
        }
    } else {
        $message = "Debe ingresar todos los datos";
        $ok = false;
    }
}


if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">
  Contraseña Actualizada Correctamente <a href="#"></a> </div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

header("Location: EventoEditar.php?id=" . $_GET['id']);
