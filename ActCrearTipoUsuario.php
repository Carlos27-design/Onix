<?php
session_start();

include_once 'DB/TipoUsuario.php';
include_once 'DB/TipoUsuarioDB.php';

$ok = null;
$message = null;

$tipoUsuario = new TipoUsuario();
$tipoUsuarioDB = new TipoUsuarioDB();

$txtnombreTipoUsuario = null;

if (isset($_POST['txtNombreTipoUsuario']))
{
    $txtnombreTipoUsuario = $_POST['txtNombreTipoUsuario'];
    
    if ($txtnombreTipoUsuario != "")
    {
        $tipoUsuario->id = 0;
        $tipoUsuario->nombre = $txtnombreTipoUsuario;

        $ok = $tipoUsuarioDB->crear($tipoUsuario);
        header("Location: ListarTipoUsuario.php");
        
    }else
    {
        $message = "rellene el campo";
        $ok = false;
        header("Location: Index.php");
    }
    
}