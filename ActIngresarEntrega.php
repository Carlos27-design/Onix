<?php
session_start();

include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entrega = new Entrega();
$entregaDB = new EntregaDB();

$txtdireccionEntrega = null;
$txtIndicaciones = null;

$ok = null;
$message = "";

if (
    isset($_POST['txtdireccionEntrega']) && isset($_POST['txtIndicaciones'])
) {
    $txtdireccionEntrega = $_POST['txtdireccionEntrega'];
    $txtIndicaciones = $_POST['txtIndicaciones'];


    if ($txtdireccionEntrega && $txtIndicaciones != "") {
        $entrega->id = 0;
        $entrega->usuario_id = 1; //SACAR DE SESSION
        $entrega->vehiculo_id = null;
        $entrega->ruta_id = null; //VEHICULO ESCOGE
        $entrega->estado_id = 1; //1 = EN PROCESO
        $entrega->direccionEntrega = $txtdireccionEntrega;
        $entrega->indicaciones = $txtIndicaciones;
        $entrega->nroDocumentoEntregado = null;
        $entrega->fechaInicio = (date("Y-m-d H:i:00", time()));
        $entrega->fechaEntregado = null;




        $ok = $entregaDB->crear($entrega);
    } else {
        $ok = false;
    }

    if ($ok) {
        $_SESSION['message'] = '<div class="alert alert-success">Agregado correctamente</div>';
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger">No agregado.</div>';
    }

    header("Location: listarEntrega.php");
}
