<?php
session_start();
include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$usuario = new Usuario();
$usuarioDB = new UsuarioDB();

$message = "";

if (
    isset($_POST['txtRut']) && isset($_POST['txtNombre'])
    && isset($_POST['txtApellido'])
    && isset($_POST['txtCorreo']) && isset($_POST['txtNroTelefonico'])
    && isset($_GET['id'])
) {
    $txtRut =  $_POST['txtRut'];
    $txtNombre = $_POST['txtNombre'];
    $txtApellido =  $_POST['txtApellido'];
    $txtCorreo =  $_POST['txtCorreo'];
    $txtNroTelefonico =  $_POST['txtNroTelefonico'];



    if (($txtRut && $txtNombre && $txtApellido &&
        $txtCorreo && $txtNroTelefonico) != "") {
        $usuario = $usuarioDB->buscar($_GET['id']);
        $usuario->id = $_GET['id'];
        $usuario->rut = $txtRut;
        $usuario->nombre = $txtNombre;
        $usuario->apellido = $txtApellido;
        $usuario->correo = $txtCorreo;
        $usuario->nroTelefonico = $txtNroTelefonico;
        $usuario->tipoUsuario_id = 1;
        $ok = $usuarioDB->editar($usuario);
    } else {
        $message = "Debe ingresar todos los datos";
        $ok = false;
    }
}


if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">
  Usuario Editado Correctamente <a href="miPerfil.php"></a> </div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

header("Location: EditarmiPerfil.php?id=" . $_GET['id']);
