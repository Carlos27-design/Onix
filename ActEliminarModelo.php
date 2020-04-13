<?php
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
    echo "eliminado";
    // header("Location: eventos.php");
} else {
    echo "no eliminado";
    // header("Location: ver.php?id=" . $idEvento . "&eliminado=no");
}
//}
