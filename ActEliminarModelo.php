<?php
session_start();
include_once 'DB/modeloDB.php';

//session_start();
//if (!isset($_SESSION['admin'])) {

$modeloDB = new ModeloDB();

$id = 0;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$ok = $modeloDB->eliminar($id);

if ($ok) {
    $_SESSION['message'] = '<div class="alert alert-success">Eliminado correctamente</div>';
} else {
    $_SESSION['message'] = '<div class="alert alert-danger">Error al eliminar</div>';
}

header("Location: listarModelo.php");
