<?php
include_once 'DB/VehiculoDB.php';

//session_start();
//if (!isset($_SESSION['admin'])) {

$vehiculoDB = new VehiculoDB();

$id = 0;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$ok = $vehiculoDB->eliminar($id);
if ($ok) {
    echo "eliminado";
    // header("Location: eventos.php");
} else {
    echo "no eliminado";
    // header("Location: ver.php?id=" . $idEvento . "&eliminado=no");
}
//}
