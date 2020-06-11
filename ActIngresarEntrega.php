<?php
include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$usuario = new Usuario();
$usuarioDB = new UsuarioDB();

include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entrega = new Entrega();
$entregaDB = new EntregaDB();

$txtdireccionEntrega = null;
$txtIndicaciones = null;


session_start();

if (!(isset($_SESSION['usu']) && $_SESSION['usu'])) {
    header('Location: IniciarSesion.php');
} else {
    $usuario = $_SESSION['usu'];
}


$ok = null;
$message = "";

if (
    isset($_POST['txtdireccionEntrega']) && isset($_POST['txtIndicaciones']) && isset($_POST['txtdireccionEntregaNombre'])
) {
    $txtdireccionEntrega = $_POST['txtdireccionEntrega'];
    $txtIndicaciones = $_POST['txtIndicaciones'];
    $txtdireccionEntregaNombre = $_POST['txtdireccionEntregaNombre'];


    if ($txtdireccionEntrega && $txtIndicaciones != "") {
        $entrega->id = 0;
        $entrega->usuario_id = $usuario->id;
        $entrega->vehiculo_id = null; //VEHICULO ESCOGE
        $entrega->ruta_id = null; //VEHICULO ESCOGE
        $entrega->estado_id = 1; //1 = EN PROCESO
        $entrega->direccionEntrega = $txtdireccionEntrega;
        $entrega->direccionEntregaNombre = $txtdireccionEntregaNombre;
        $entrega->indicaciones = $txtIndicaciones;
        $entrega->nroDocumentoEntregado = null;
        $entrega->fechaInicio = (date("Y-m-d H:i:00", time()));
        $entrega->fechaEntregado = "0000-00-00";




        $ok = $entregaDB->crear($entrega);
    } else {
        $ok = false;
    }

    if ($ok) {
        $_SESSION['message'] = '<div class="alert alert-success">Agregado correctamente</div>';
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger">No agregado.</div>';
    }

    header("Location: listarEntrega.php");
}
