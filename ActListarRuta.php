<?php

session_start();

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB();
$ruta = new Ruta();



// Manejar petición GET
$rutaLista = $rutaDB->listar();

if ($rutaLista) {

    $datos["estado"] = 1; //1 para simbolizar positivo
    $datos["ruta"] = $rutaLista;

    print json_encode($datos);
} else {
    print json_encode(array(
        "estado" => 2,
        "mensaje" => "Ha ocurrido un error"
    ));
}
