<?php
include_once 'DB/TipoUsuarioDB.php';

//session_start();
//if (!isset($_SESSION['admin'])) {

$tipousuarioDB = new TipoUsuarioDB();

$id = 0;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$ok = $tipousuarioDB->eliminar($id);
if ($ok) {
    echo "eliminado";
    // header("Location: eventos.php");
} else {
    echo "no eliminado";
    // header("Location: ver.php?id=" . $idEvento . "&eliminado=no");
}
//}
