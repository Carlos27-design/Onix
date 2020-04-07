<?php
session_start();
include_once 'BD/Usuario.php';
include_once 'BD/UsuarioDB.php';


$message = "";

if (
    isset($_POST['txtRut']) && isset($_POST['txtNombre'])
    && isset($_POST['txtApellido']) && isset($_POST['txtContrasena'])
    && isset($_POST['txtCorreo']) && isset($_POST['txtNroTelefonico'])
    && isset($_GET['id'])
) {
    $txtRut =  $_POST['txtRut'];
    $txtNombre = $_POST['txtNombre'];
    $txtApellido =  $_POST['txtApellido'];
    $txtContrasena =  $_POST['txtContrasena'];
    $txtCorreo =  $_POST['txtCorreo'];
    $txtNroTelefonico =  $_POST['txtNroTelefonico'];



    if (($txtRut && $txtNombre && $txtApellido && $txtContrasena &&
        $txtCorreo && $txtNroTelefonico) != "") {
        $usuario->id = $_GET['id'];
        $usuario->rut = $txtRut;
        $usuario->nombre = $txtNombre;
        $usuario->apellido = $txtApellido;
        $usuario->contrasena = $txtContrasena;
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
  Usuariio Editado Correctamente <a href="#"></a> </div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

// header("Location: EventoEditar.php?id=" . $id);
