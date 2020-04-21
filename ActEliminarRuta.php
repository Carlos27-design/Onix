<?php
session_start();
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB;

$id = 0;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$ok = $rutaDB->Eliminar($id);

if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">Eliminado correctamente</div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">Error al eliminar</div>';
}

header("Location: listarruta.php");
