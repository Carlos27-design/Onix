<?php
// $hostname_localhost = "localhost";
// $database_localhost = "id";
// $username_localhost = "root";
// $password_localhost = "12345";
$hostname_localhost = "localhost";
$database_localhost = "onix";
$username_localhost = "root";
$password_localhost = "password";

$datos = array();
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $conexion = mysqli_connect($hostname_localhost, $username_localhost, $password_localhost, $database_localhost);
    $consulta = "SELECT * from entrega where ruta_id = '{$id}'";
    $resultado = mysqli_query($conexion, $consulta);

    while ($row = mysqli_fetch_row($resultado)) {
        $datos[] = $row;
    }
    var_dump($datos);
    echo json_encode($datos);
    mysqli_close($conexion);
} else {
    $resulta["success"] = 0;
    $resulta["message"] = "Ws no retorna";
}
