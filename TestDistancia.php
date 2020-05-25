<?PHP
session_start();

include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entregaDB = new EntregaDB();
$entrega = new Entrega();

$entregaLista  = $entregaDB->listar();

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';


$rutaDB = new RutaDB();
$ruta = new Ruta();

$rutaLista  = $rutaDB->listar();
$idRuta = 0;
if (isset($_GET["id"])) {
    $idRuta = $_GET["id"];
    $ruta = $rutaDB->buscar($idRuta);
} else {
    header("Location: listarRuta.php");
}

$listaEntregasRuta = array();
foreach ($entregaLista as $e) {
    if ($e->ruta_id == $ruta->id) {

        list($lat, $lng) = explode(",", $e->direccionEntrega);
        list($latInicio, $lngInicio) = explode(",", $ruta->direccionInicio);
        $kms =  distance($lat, $lng, $latInicio, $lngInicio, "K");

        $e->distanciaKM = $kms;

        $listaEntregasRuta[] = $e;
    }
}

function distance($lat1, $lon1, $lat2, $lon2, $unit)
{

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}
$listaEntregasRuta = json_decode(json_encode($listaEntregasRuta), true);

uasort($listaEntregasRuta, function ($a, $b) {
    if ($a['distanciaKM'] == $b['distanciaKM']) {
        return 0;
    }
    return ($a['distanciaKM'] < $b['distanciaKM']) ? -1 : 1;
});

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

</head>

<body>

</body>

</html>