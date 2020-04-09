<?php
include_once 'DB/MarcaDB.php';

//session_start();
//if (!isset($_SESSION['admin'])) {

$marcaDB = new MarcaDB();

$id = 0;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$ok = $marcaDB->eliminar($id);
if ($ok) {
    echo "eliminado";
    // header("Location: eventos.php");
} else {
    echo "no eliminado";
    // header("Location: ver.php?id=" . $idEvento . "&eliminado=no");
}
//}
