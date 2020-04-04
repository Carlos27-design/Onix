<?php
session_start();

include_once "DB/Modelo.php";
include_once "DB/ModeloDB.php";

$modelo = new Modelo();
$modeloDB = new ModeloDB();

$modelo->id = 1;
$modelo->nombre = "captiva";
$modelo->marca_id = 1;
print_r($modeloDB->listar());

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