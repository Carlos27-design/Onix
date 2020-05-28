<?php
include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$json = file_get_contents('php://input');
$obj = json_decode($json);

$usuario = new Usuario();
$usuarioDB = new UsuarioDB();

$usuario = $obj->{'usuario'};

list($rut, $password) = explode("-", $usuario);
if (($rut && $password) != null) {

    try {

        $usua = $usuarioDB->login($rut, $password);

        if ($usua != null) {
            $json = "Iniciado";
        } else {
            $json = "Error en rut/password";
        }
    } catch (Exception $ex) {
        $json = $ex->getMessage();
    }
}
