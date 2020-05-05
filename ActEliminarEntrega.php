<?php
session_start();
include_once 'DB/EntregaDB.php';

//session_start();
//if (!isset($_SESSION['admin'])) {

$entregaDB = new EntregaDB();

$id = 0;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$ok = $entregaDB->eliminar($id);

if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">Eliminado correctamente</div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">Error al eliminar</div>';
}

header("Location: listarEntrega.php");
