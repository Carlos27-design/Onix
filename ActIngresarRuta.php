<?php

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$ruta = new Ruta();
$rutaDB = new RutaDB();

$txtDireccionInicio = null;
$txtDireccionFinal = null;
$txtDistancia = null;
$txtFechaInicio = null;
$txtFechaFin = null;

$ok = null;
$message = "";

if (isset($_POST['txtDireccionInicio']) && isset($_POST['txtDireccionFinal']) && isset($_POST['txtDistancia']) && 
isset($_POST['txtFechaInicio']) && isset($_POST['txtFechaFin']))
{
    $txtDireccionInicio = $_POST['txtDireccionInicio'];
    $txtDireccionFinal = $_POST['txtDireccionFinal'];
    $txtDistancia = $_POST['txtDistancia'];
    $txtFechaInicio = $_POST['txtFechaInicio'];
    $txtFechaFin = $_POST['txtFechaFin'];

    if ($txtDireccionInicio && $txtDireccionFinal && $txtDistancia && $txtFechaInicio && $txtFechaFin != "")
    {
        $ruta->id = 0;
        $ruta->direccionInicio = $txtDireccionInicio;
        $ruta->direccionFinal = $txtDireccionFinal;
        $ruta->distancia = $txtDistancia;
        $ruta->fechaInicio = $txtFechaInicio;
        $ruta->fechaFin = $txtFechaFin;

        $ok = $rutaDB->crear($ruta);
        echo 'Se ha ingresado con exito';
    }else
    {
        $ok = false;
        echo 'Faltan por ingresar datos';
    }
    
}