<?php
session_start();

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$ruta = new Usuario();
$rutaDB = new UsuarioDB();

$message = "";

if(isset($_POST['txtDireccionInicio']) && isset($_POST['txtDireccionFinal']) && isset($_POST['txtDistancia']) && 
isset($_POST['txtFechaInicio']) && isset($_POST['txtFechaFin']))
{
    $txtDireccionInicio = $_POST['txtDireccionInicio'];
    $txtDireccionFinal = $_POST['txtDireccionFinal'];
    $txtDistancia = $_POST['txtDistancia'];
    $txtFechaInicio = $_POST['txtFechaInicio'];
    $txtFechaFin = $_POST['txtFechaFin'];

    if ($txtDireccionInicio && $txtDireccionFinal && $txtDistancia && $txtFechaInicio && $txtFechaFin != "" )
    {
        $ruta = $rutaDB->buscar($_GET['id']);
        $ruta->id = $_GET['id'];
        $ruta->direccionInicio = $txtDireccionInicio;
        $ruta->direccionFinal = $txtDireccionFinal;
        $ruta->distancia = $txtDistancia;
        $ruta->fechaInicio = $txtFechaInicio;
        $ruta->fechaFin = $txtFechaFin;

        $ok = $rutaDB->editar($ruta);
    }
    else
    {
        $ok = false;
        $message = "Tiene que ingresar todos los datos";
    }
}

if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">
  Ruta Editada Correctamente </div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}