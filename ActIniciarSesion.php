<?php

session_start();

include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$rut = null;
$contrasena = null;

if(isset($_POST['txtRut']) && isset($_POST['txtContrasena']))
{
    $rut = $_POST['txtRut'];
    $contrasena = $_POST['txtContrasena'];

    if($rut && $contrasena != null)
    {
        $usuario = new Usuario();
        $UsuarioDB = new UsuarioDB();
        $usu = $UsuarioDB->login($rut, $contrasena);
        
        if($usu != null)
        {
            $_SESSION['usu'] = $usu;
            header("Location: index.php");
        }else
        {
            $_SESSION['message'] = '<div class="alert alert-danger">Usuario no encontrado</div>';
            header("Location: index.php");
        }
    }
    else
    {
        header("Location: index.php");
    }
    
}