<?php
session_start();

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB();
$ruta = new Ruta();


$datos = array();
$datos[]  = $rutaDB->listar();


echo json_encode($datos);
