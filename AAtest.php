<?php
session_start();

include_once "DB/Usuario.php";
include_once "DB/UsuarioDB.php";

$usuario = new Usuario();
$usuarioDB = new UsuarioDB();



$usuarioDB->eliminar(1);





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