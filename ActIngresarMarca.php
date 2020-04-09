<?php

session_start();

include_once 'DB/Marca.php';
include_once 'Db/MarcaDB.php';

$txtNombreMarca = null;

$marca = new Marca();
$marcaDB = new MarcaDB();

$ok = null;
$message = null;


if (isset($_POST['txtnombremarca']))
{
    $txtNombreMarca = $_POST['txtnombremarca'];

    if($txtNombreMarca != "")
    {
        $marca->id = 0;
        $marca->nombre = $txtNombreMarca;

        $ok = $marcaDB->crear($marca);
    }
    else
    {
        $message = "Ingrese algun dato";
        $ok = false;
    }
}
