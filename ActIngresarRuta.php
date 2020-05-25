<?php
session_start();

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$ruta = new Ruta();
$rutaDB = new RutaDB();

$txtDireccionInicioNombre = null;
$txtdireccionInicio = null;
$txtDireccionFinal = null;
$txtDistancia = null;
$txtFechaInicio = null;
$txtFechaFin = null;
$txtHoraInicio = null;
$txtHoraFin = null;

$ok = null;
$message = "";

if (
    isset($_POST['txtDireccionInicioNombre']) && isset($_POST['txtDireccionInicio']) &&
    isset($_POST['txtFechaInicio']) && isset($_POST['txtFechaFin']) && isset($_POST['txtHoraInicio']) && isset($_POST['txtHoraFin'])
) {
    $txtDireccionInicioNombre = $_POST['txtDireccionInicioNombre'];
    $txtDireccionInicio = $_POST['txtDireccionInicio'];
    $txtFechaInicio = $_POST['txtFechaInicio'];
    $txtHoraInicio = $_POST['txtHoraInicio'];
    $txtFechaFin = $_POST['txtFechaFin'];
    $txtHoraFin = $_POST['txtHoraFin'];

    if ($txtDireccionInicioNombre && $txtDireccionInicio && $txtFechaInicio && $txtHoraInicio && $txtFechaFin && $txtHoraFin != "") {
        $ruta->id = 0;
        $ruta->direccionInicioNombre = $txtDireccionInicioNombre;
        $ruta->direccionInicio = $txtDireccionInicio;
        $ruta->direccionFinal = "0";
        $ruta->direccionFinalNombre = "0";
        $ruta->distancia = 0;
        $ruta->fechaInicio = $txtFechaInicio . " " . $txtHoraInicio;
        $ruta->fechaFin = $txtFechaFin . " " . $txtHoraFin;

        $ok = $rutaDB->crear($ruta);
    } else {
        $ok = false;
    }

    if ($ok) {
        $_SESSION['message'] = '<div class="alert alert-success">Agregado correctamente</div>';
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger">No agregado.</div>';
    }
}
header("Location: listarruta.php");
