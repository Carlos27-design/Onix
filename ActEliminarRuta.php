<?php

include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB;

$id = 0;

if (isset($_GET['id']))
{
    $id = $_GET['id'];
}

$ok = $rutaDB->Eliminar($id);

if ($ok)
{
    echo "Eliminado";
}
else{
    echo "No eliminado";
}