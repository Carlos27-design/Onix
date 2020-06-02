<?php
$hostname_localhost = "localhost";
$database_localhost = "id";
$username_localhost = "root";
$password_localhost = "12345";

$json = array();

$conexion = mysqli_connect($hostname_localhost, $username_localhost, $password_localhost, $database_localhost);
$consulta = "select * from rutas";
$resultado = mysqli_query($conexion, $consulta);

while ($row = mysqli_fetch_row($resultado)) {
    $json[] = $row;
}
mysqli_close($conexion);
echo json_encode($json);
