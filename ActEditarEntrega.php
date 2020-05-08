<?php
session_start();
include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entrega = new Entrega();
$entregaDB = new EntregaDB();

$message = "";

if (
    isset($_POST['slcUsuario'])
    && isset($_POST['slcVehiculo'])
    && isset($_POST['slcRuta'])
    && isset($_POST['slcEstado'])
    && isset($_POST['txtdireccionEntregaNombre'])
    && isset($_POST['txtdireccionEntrega'])
    && isset($_POST['txtIndicaciones'])
    && isset($_POST['txtNroDocumentoEntregado'])
    && isset($_POST['txtFechaInicio'])
    && isset($_POST['txtHoraInicio'])
    && isset($_POST['txtFechaEntrega'])
    && isset($_POST['txtHoraEntrega'])
) {
    $slcUsuario =  $_POST['slcUsuario'];
    $slcVehiculo =  $_POST['slcVehiculo'];
    $slcRuta = $_POST['slcRuta'];
    $txtdireccionEntregaNombre =  $_POST['txtdireccionEntregaNombre'];
    $txtdireccionEntrega =  $_POST['txtdireccionEntrega'];
    $txtIndicaciones =  $_POST['txtIndicaciones'];
    $txtNroDocumentoEntregado =  $_POST['txtNroDocumentoEntregado'];
    $txtFechaInicio =  $_POST['txtFechaInicio'];
    $txtHoraInicio =  $_POST['txtHoraInicio'];
    $txtFechaEntrega =  $_POST['txtFechaEntrega'];
    $txtHoraEntrega =  $_POST['txtHoraEntrega'];
    $id =  $_GET['id'];



    if (($slcUsuario && $txtdireccionEntregaNombre && $txtdireccionEntrega &&
        $txtFechaInicio && $txtHoraInicio) != "") {

        $entrega = $entregaDB->buscar($_GET['id']);
        $entrega->id = $_GET['id'];
        $entrega->usuario_id = $slcUsuario;

        if ($slcVehiculo == 0) {
            $entrega->vehiculo_id = null;
        } else {
            $entrega->vehiculo_id = $slcVehiculo;
        }

        if ($slcRuta == 0) {
            $entrega->ruta_id = null;
        } else {
            $entrega->ruta_id = $slcRuta;
        }


        $entrega->direccionEntregaNombre = $txtdireccionEntregaNombre;
        $entrega->direccionEntrega = $txtdireccionEntrega;
        $entrega->indicaciones = $txtIndicaciones;
        $entrega->nroDocumentoEntregado = $txtNroDocumentoEntregado;
        $entrega->fechaInicio = $txtFechaInicio . " " . $txtHoraInicio;
        $entrega->fechaEntregado = $txtFechaEntrega . " " . $txtHoraEntrega;

        $ok = $entregaDB->editar($entrega);
    } else {
        $message = "Debe ingresar todos los datos";
        $ok = false;
    }
}


if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">
  Entrega Editada Correctamente </div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

header("Location: EditarEntrega.php?id=" . $_GET['id']);
