<?php
//DIBUJAR RUTA
//https://www.youtube.com/watch?v=hRoiG4ZIzeM

include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entregaDB = new EntregaDB();
$entrega = new Entrega();

include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$usuarioDB = new UsuarioDB();
$usuario = new Usuario();

$usuarioLista  = $usuarioDB->listar();


include_once 'DB/Vehiculo.php';
include_once 'DB/VehiculoDB.php';

$vehiculoDB = new VehiculoDB();
$vehiculo = new Vehiculo();

$vehiculoLista  = $vehiculoDB->listar();


include_once 'DB/Estado.php';
include_once 'DB/EstadoDB.php';

$estadoDB = new EstadoDB();
$estado = new Estado();

$estadoLista  = $estadoDB->listar();

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB();
$ruta = new Ruta();

$rutaLista  = $rutaDB->listar();

$idEntrega = 0;


session_start();
if (!(isset($_SESSION['usu']) && $_SESSION['usu'])) {
    header('Location: IniciarSesion.php');
} else {
    $usuario = $_SESSION['usu'];
    $entregaLista  = $entregaDB->listarMisEntregas($usuario->id);
    if (isset($_GET["id"])) {
        $idEntrega = $_GET["id"];
        $entrega = $entregaDB->buscar($idEntrega);
        if ($entrega->usuario_id != $usuario->id) {
            header("Location: listarEntrega.php");
        }
    } else {
        header("Location: listarEntrega.php");
    }
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

    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


    <script src="Control.OSMGeocoder.js"></script>
    <link rel="stylesheet" href="Control.OSMGeocoder.css" />


    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYAESaIh0eGTc5vNgX-32O22ejjjlgbmc&callback=initMap">
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
                            <h3>Entrega N° <?= $entrega->id; ?> <a href="#map">Ver ubicación en mapa <i class="fas fa-map-marker-alt"></i></a></h3>
                            <div class="row">
                                <?php
                                if (isset($_SESSION['message']) && $_SESSION['message']) {
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                }
                                ?>
                            </div>
                            <form class="quote-form" action="ActEditarEntrega.php?id=<?= $entrega->id; ?>" method="post">
                                <p class=" width-full">
                                    <label for="slcUsuario">Usuario que pidió la entrega</label>
                                    <br>
                                    <select name="slcUsuario" id="slcUsuario" disabled>

                                        <?php foreach ($usuarioLista as $u) { ?>
                                            <option value="<?= $u->id; ?>" <?php if ($entrega->usuario_id == $u->id) {
                                                                                echo ' selected="selected"';
                                                                            } ?>>
                                                <?= $u->nombre; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>

                                <p class=" width-full">
                                    <label for="slcVehiculo">Vehiculo a cargo</label>
                                    <br>
                                    <select name="slcVehiculo" id="slcVehiculo" disabled>
                                        <option value="0">Seleccione Vehiculo</option>
                                        <?php foreach ($vehiculoLista as $v) { ?>
                                            <option value="<?= $v->id; ?>" <?php if ($entrega->vehiculo_id == $v->id) {
                                                                                echo ' selected="selected"';
                                                                            } ?>>
                                                <?= $v->patente; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>

                                <p class=" width-full">
                                    <label for="slcRuta">Ruta tomada</label>
                                    <br>
                                    <select name="slcRuta" id="slcRuta" disabled>
                                        <option value="0">Seleccione Ruta</option>
                                        <?php foreach ($rutaLista as $r) { ?>
                                            <option value="<?= $r->id; ?>" <?php if ($entrega->ruta_id == $r->id) {
                                                                                echo ' selected="selected"';
                                                                            } ?>>
                                                <?= $r->direccionInicioNombre . " -> " . $r->direccionFinalNombre; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>

                                <p class=" width-full">
                                    <label for="slcEstado">Estado</label>
                                    <br>
                                    <select name="slcEstado" id="slcEstado" disabled>
                                        <?php foreach ($estadoLista as $e) { ?>
                                            <option value="<?= $e->id; ?>" <?php if ($entrega->estado_id == $e->id) {
                                                                                echo ' selected="selected"';
                                                                            } ?>>
                                                <?= $e->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </p>

                                <p class=" width-full">
                                    <label for="txtdireccionEntregaNombre">Dirección de Entrega</label>
                                    <input disabled required type="text" name="txtdireccionEntregaNombre" id="txtdireccionEntregaNombre" placeholder="Nombre" maxlength="45" value="<?php echo $entrega->direccionEntregaNombre; ?>">
                                </p>

                                <p class=" width-full">
                                    <label for="txtdireccionEntrega">Coordenadas de Entrega</label>
                                    <input disabled required type="text" name="txtdireccionEntrega" id="txtdireccionEntrega" placeholder="Latitud y longitud" maxlength="45" value="<?php echo $entrega->direccionEntrega; ?>">
                                </p>

                                <p class=" width-full">
                                    <label for="txtIndicaciones">Indicaciones</label>
                                    <input disabled required type="text" name="txtIndicaciones" id="txtIndicaciones" placeholder="Indicaciones" maxlength="45" value="<?php echo $entrega->indicaciones; ?>">
                                </p>

                                <p class=" width-full">
                                    <label for="txtNroDocumentoEntregado">N° Documento entregado (opcional)</label>
                                    <input disabled type="text" name="txtNroDocumentoEntregado" id="txtNroDocumentoEntregado" placeholder="N° 00000" maxlength="45" value="<?php echo $entrega->nroDocumentoEntregado; ?>">
                                </p>

                                <label for="txtFechaInicio">Fecha de inicio</label>
                                <p class=" width-half">
                                    <?php
                                    list($fechaInicio, $horaInicio) = explode(" ", $entrega->fechaInicio);
                                    ?>
                                    <input disabled required type="date" name="txtFechaInicio" id="txtFechaInicio" placeholder="Fecha Inicio" value="<?= $fechaInicio; ?>">
                                    <input disabled required class="pull-right" type="time" name="txtHoraInicio" id="txtHoraInicio" value="<?= $horaInicio; ?>">
                                </p>

                                <label for="txtFechaEntrega">Fecha de Entrega</label>
                                <p class=" width-half">
                                    <?php
                                    list($fechaEntregado, $horaEntregado) = explode(" ", $entrega->fechaEntregado);
                                    ?>
                                    <input disabled type="date" name="txtFechaEntrega" id="txtFechaEntrega" placeholder="Fecha Entrega" value="<?= $fechaEntregado; ?>">
                                    <input disabled class="pull-right" type="time" name="txtHoraEntrega" id="txtHoraEntrega" value="<?= $horaEntregado; ?>">
                                </p>



                                <?php if ($usuario->tipoUsuario_id != 7) : ?>
                                    <button id="btnHabilitar" type="button">Habilitar Edición</button>
                                <?php endif; ?>

                                <button hidden type="submit">Actualizar Datos</button>
                            </form>

                        </div>
                    </div>
                </div>
        </section>
    </div>
    <div id="map" style="height: 100%"></div>
    <script type="text/javascript" src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>

    <!-- INICIAR MAPA -->
    <script>
        <?php
        $e = $entregaDB->Buscar($_GET["id"]);
        list($lat, $lng) = explode(",", $e->direccionEntrega);

        ?>
        var demoMap = L.map('map').setView([<?= $lat ?>, <?= $lng ?>], 14);
        var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        var osmAttrib = 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
        var osm = new L.TileLayer(osmUrl, {
            minZoom: 8,
            maxZoom: 20,
            attribution: osmAttrib
        });


        osm.addTo(demoMap);
    </script>
    <!-- AGREGAR MARCADORES -->
    <script>
        <?php


        list($lat, $lng) = explode(",", $entrega->direccionEntrega);
        // echo "L.marker([" . $lat . "," . $lng . "]).addTo(demoMap);"; VERSION BASICA


        echo "var cords = [" . $lat . "," . $lng . "];";
        echo "var marker = L.marker(cords);";
        foreach ($usuarioLista as $lu) {
            if ($entrega->usuario_id == $lu->id) {
                echo "marker.bindPopup('Cliente: " . $lu->nombre . "<br>Dirección: " . $entrega->direccionEntregaNombre . "');";
            }
        }


        echo "marker.addTo(demoMap);";
        ?>
    </script>

    <script>
        $('#btnHabilitar').on('click', function() {
            // $("input").prop('disabled', true);

            $("button").prop('hidden', false);
            $("input").prop('disabled', false);
            $("select").prop('disabled', false);

        });
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