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
$txtHoraInicio = null;
$txtHoraFin = null;

$ok = null;
$message = "";

if (isset($_POST['txtDireccionInicio']) && isset($_POST['txtDireccionFinal']) && isset($_POST['txtDistancia']) && 
isset($_POST['txtFechaInicio']) && isset($_POST['txtFechaFin']) && isset($_POST['txtHoraInicio']) && isset($_POST['txtHoraFin']))
{
    $txtDireccionInicio = $_POST['txtDireccionInicio'];
    $txtDireccionFinal = $_POST['txtDireccionFinal'];
    $txtDistancia = $_POST['txtDistancia'];
    $txtFechaInicio = $_POST['txtFechaInicio'];
    $txtHoraInicio = $_POST['txtHoraInicio'];
    $txtFechaFin = $_POST['txtFechaFin'] ;
    $txtHoraFin = $_POST['txtHoraFin'];

    if ($txtDireccionInicio && $txtDireccionFinal && $txtDistancia && $txtFechaInicio && $txtHoraInicio && $txtFechaFin && $txtHoraFin != "")
    {
        $ruta->id = 0;
        $ruta->direccionInicio = $txtDireccionInicio;
        $ruta->direccionFinal = $txtDireccionFinal;
        $ruta->distancia = $txtDistancia;
        $ruta->fechaInicio = $txtFechaInicio && $txtHoraInicio;
        $ruta->fechaFin = $txtFechaFin && $txtHoraFin;

        $ok = $rutaDB->crear($ruta);
        echo 'Se ha ingresado con exito';
    }else
    {
        $ok = false;
        echo 'Faltan por ingresar datos';
    }
    
}