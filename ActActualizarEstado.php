<?php
session_start();
include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entrega = new Entrega();
$entregaDB = new EntregaDB();

$message = "";
$idRuta = 0;

if (isset($_GET["id"]) && isset($_GET["idRuta"])) {

    $id =  $_GET['id'];
    $idRuta = $_GET["idRuta"];


    if (($id) != "") {

        $entrega = $entregaDB->buscar($id);
        $entrega->id = $id;
        $entrega->estado_id = 3;
        $entrega->fechaEntregado = (date("Y-m-d H:i:00", time()));

        $ok = $entregaDB->editar($entrega);
    } else {
        $message = "Debe ingresar todos los datos";
        $ok = false;
    }
}


if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">
  Estado Actualizado Correctamente</div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">
  ' . $message . '</div>';
}

header("Location: verRuta.php?id=" . $idRuta);
