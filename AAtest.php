<?php
session_start();

include_once "DB/Ruta.php";
include_once "DB/RutaDB.php";

$ruta = new Ruta();
$rutaDB = new RutaDB();

$ruta->id = 0;
$ruta->direccionInicio = "-40.915741, -73.155399";
$ruta->direccionFinal = "-40.915830, -73.156926";
$ruta->distancia = "500.7";
$ruta->fechaInicio = "2020-5-5 10:00";
$ruta->fechaFin = "2020-5-6 20:00";

$rutaDB->crear($ruta);





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    Hola
</body>

</html>