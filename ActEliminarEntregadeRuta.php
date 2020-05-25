<?php
session_start();

include_once 'DB/EntregaDB.php';
include_once 'DB/Entrega.php';

$entregaDB = new EntregaDB();
$entrega = new Entrega();


//if (!isset($_SESSION['admin'])) {


$idRuta = 0;
$idEntrega = 0;

if (isset($_GET["idRuta"]) && isset($_GET["idEntrega"])) {
    $idRuta = $_GET["idRuta"];
    $idEntrega = $_GET["idEntrega"];
    $entrega = $entregaDB->buscar($idEntrega);
    $entrega->ruta_id = null;
    $entrega->estado_id = 1;
    $ok = $entregaDB->editar($entrega);
}




if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">Eliminado correctamente</div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">Error al eliminar</div>';
}

header("Location: verRuta.php?id=" . $idRuta);
