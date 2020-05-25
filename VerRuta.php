<?php
//DIBUJAR RUTA
//https://www.youtube.com/watch?v=hRoiG4ZIzeM

session_start();

include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$usuario = new Usuario();
$usuarioDB = new UsuarioDB();

$listaUsuarios = $usuarioDB->listar();

include_once 'DB/Estado.php';
include_once 'DB/EstadoDB.php';

$estado = new Estado();
$estadoDB = new EstadoDB();

$listaEstado = $estadoDB->listar();

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

// =============== ORDEN DE RUTA ==============

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

// =============== ORDEN DE RUTA ==============


$listaLetras = array();
$listaLetras[] = "Inicio";

foreach (range('A', 'Z') as $elements) {

    $listaLetras[] = $elements;
}

?>
<html>

<head>
    <!--====== USEFULL META ======-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Transportation & Agency Template is a simple Smooth transportation and Agency Based Template" />
    <meta name="keywords" content="Portfolio, Agency, Onepage, Html, Business, Blog, Parallax" />

    <!--====== TITLE TAG ======-->
    <title>Entrega Mapa</title>

    <!--====== FAVICON ICON =======-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    <!--====== STYLESHEETS ======-->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/stellarnav.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d684b42b31.js" crossorigin="anonymous"></script>

    <!--====== MAIN STYLESHEETS ======-->
    <link href="style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=Zmt3zLFCEahwQ7lnLsSF0U6j6AmmkGWP"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=Zmt3zLFCEahwQ7lnLsSF0U6j6AmmkGWP"></script>

    <script type="text/javascript">
        window.onload = function() {

            var map,
                dir;

            map = L.map('map', {
                layers: MQ.mapLayer(),
                center: [<?= $listaEntregasRuta[0]['direccionEntrega'] ?>],
                zoom: 9
            });

            dir = MQ.routing.directions();

            dir.route({
                locations: [
                    <?php

                    list($latInicio, $lngInicio) = explode(",", $ruta->direccionInicio);
                    ?>, {
                        latLng: {
                            lat: <?= $latInicio ?>,
                            lng: <?= $lngInicio ?>,
                        }
                    },
                    <?php
                    foreach ($listaEntregasRuta as $e) {
                        if ($e["ruta_id"] == $ruta->id) {
                            list($lat, $lng) = explode(",", $e["direccionEntrega"]);
                    ?>, {
                                latLng: {
                                    lat: <?= $lat ?>,
                                    lng: <?= $lng ?>,
                                }
                            },


                    <?php
                        }
                    }
                    ?>


                ]
            });

            map.addLayer(MQ.routing.routeLayer({
                directions: dir,
                fitBounds: true
            }));
        }
    </script>

    </script>
    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


    <!--<script src="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.js"></script>-->
    <!--<link rel="stylesheet" href="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.css" />-->
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        html,
        body,
        #map {
            height: 100%;
            width: 100%;
        }

        .fa-map-marker-alt {
            color: coral;
        }

        a:hover>.fa-map-marker-alt {
            color: red;
        }
    </style>
</head>

<body>
    <?php include 'nav.php' ?>
    <div class="row">

        <section class="about-area colorful-bg section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="quote-form-area wow fadeIn">
                            <h3>Ruta N° <?= $ruta->id; ?> <a href="#map">Ver en mapa <i class="fas fa-map-marker-alt"></i></a></h3>
                            <div class="row">
                                <?php
                                if (isset($_SESSION['message']) && $_SESSION['message']) {
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                }
                                ?>
                            </div>
                            <form class="quote-form" action="ActEditarRuta.php?id=<?= $ruta->id; ?>" method="post">

                                <p class=" width-full">
                                    <label for="txtdireccionInicioNombre">Dirección de Inicio</label>
                                    <input disabled required type="text" name="txtdireccionInicioNombre" id="txtdireccionInicioNombre" placeholder="Direccion de inicio" maxlength="45" value="<?php echo $ruta->direccionInicioNombre; ?>">
                                </p>

                                <p class=" width-full">
                                    <label for="txtdireccionFinalNombre">Direccion Final</label>
                                    <input disabled required type="text" name="txtdireccionFinalNombre" id="txtdireccionFinalNombre" placeholder="Direccion Final" maxlength="45" value="<?php echo $ruta->direccionFinalNombre; ?>">
                                </p>

                                <p class=" width-full">
                                    <label for="txtNroDocumentoEntregado">N° Documento entregado (opcional)</label>
                                    <input disabled type="text" name="txtNroDocumentoEntregado" id="txtNroDocumentoEntregado" placeholder="N° 00000" maxlength="45" value="<?php echo $entrega->nroDocumentoEntregado; ?>">
                                </p>

                                <label for="txtFechaInicio">Fecha de inicio</label>
                                <p class=" width-half">
                                    <?php
                                    list($fechaInicio, $horaInicio) = explode(" ", $ruta->fechaInicio);
                                    ?>
                                    <input disabled required type="date" name="txtFechaInicio" id="txtFechaInicio" placeholder="Fecha Inicio" value="<?= $fechaInicio; ?>">
                                    <input disabled required class="pull-right" type="time" name="txtHoraInicio" id="txtHoraInicio" value="<?= $horaInicio; ?>">
                                </p>

                                <label for="txtFechaEntrega">Fecha Final</label>
                                <p class=" width-half">
                                    <?php
                                    list($fechaEntregado, $horaEntregado) = explode(" ", $ruta->fechaFin);
                                    ?>
                                    <input disabled type="date" name="txtFechaEntrega" id="txtFechaEntrega" placeholder="Fecha Entrega" value="<?= $fechaEntregado; ?>">
                                    <input disabled class="pull-right" type="time" name="txtHoraEntrega" id="txtHoraEntrega" value="<?= $horaEntregado; ?>">
                                </p>

                                <button id="btnHabilitar" type="button">Habilitar Edición</button>
                                <button hidden type="submit">Actualizar Datos</button>
                            </form>

                            <div class="row">
                                <table id="tbl" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Letra</th>
                                            <th>Usuario</th>
                                            <th>Dirección</th>
                                            <th>Estado</th>
                                            <th></th>
                                            <th>Fecha <br> Inicio</th>
                                            <th>Administrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $x = 1;
                                        foreach ($listaEntregasRuta as $e) {
                                            if ($e['ruta_id'] == $ruta->id) {
                                                $x += 1;
                                        ?>
                                                <tr>
                                                    <td><?= $e['id'] ?></td>

                                                    <td><?= $listaLetras[$x] ?></td>
                                                    <?php
                                                    foreach ($listaUsuarios as $lu) {
                                                        if ($e['usuario_id'] == $lu->id) {
                                                            echo "<td>" . $lu->nombre . "</td>";
                                                        }
                                                    }
                                                    ?>
                                                    <td><?= $e['direccionEntregaNombre'] ?></td>
                                                    <?php
                                                    foreach ($listaEstado as $le) {
                                                        if ($e['estado_id'] == $le->id) {
                                                            echo "<td>" . $le->nombre . "</td>";
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    switch ($e['estado_id']) {
                                                        case 3:
                                                            echo ' <td><i class="fas fa-check"></i></td>';
                                                            break;
                                                        default:
                                                            echo ' <td><i class="fas fa-times"></i></td>';
                                                            break;
                                                    }
                                                    ?>
                                                    <td><?= $e['fechaInicio'] ?></td>
                                                    <td>
                                                        <a title="Actualizar Estado" href="ActActualizarEstado.php?idRuta=<?= $ruta->id; ?> &id=<?= $e['id']; ?>" class="btn"><i class="fas fa-clipboard-check"></i></a>
                                                        <a title="Ver" href="EditarEntrega.php?id=<?= $e['id']; ?>" class="btn"><i class="fas fa-eye"></i></a>
                                                        <a onclick="deleteRuta(<?= $e['id']; ?>)" title="Eliminar" class="btn"><i class="fas fa-trash-alt"></i></a>
                                                    </td>


                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <div id='map' style='width: 100%; height:100%;'></div>

    <style>
        .fa-check {
            color: green;
        }

        .fa-times {
            color: red;
        }

        a {
            color: #ff4081;
        }
    </style>
    <script>
        $('#btnHabilitar').on('click', function() {
            // $("input").prop('disabled', true);

            $("button").prop('hidden', false);
            $("input").prop('disabled', false);
            $("select").prop('disabled', false);

        });

        function deleteRuta(id) {
            var ask = window.confirm("¿Está seguro que desea eliminar esto?");
            if (ask) {
                window.location.href = "ActEliminarEntregadeRuta.php?idRuta=" + <?= $ruta->id ?> + "&idEntrega=" + id;

            }
        }
    </script>


    <!--====== SCRIPTS JS ======-->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>

    <!--====== PLUGINS JS ======-->
    <script src="js/vendor/jquery.easing.1.3.js"></script>
    <script src="js/vendor/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/vendor/jquery.appear.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/stellarnav.min.js"></script>
    <script src="js/contact-form.js"></script>
    <script src="js/jquery.sticky.js"></script>

    <!--===== ACTIVE JS=====-->
    <script src="js/main.js"></script>

</body>

</html>