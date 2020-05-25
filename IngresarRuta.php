<?php
session_start();

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB();
$ruta = new Ruta();


?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <!--====== USEFULL META ======-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Transportation & Agency Template is a simple Smooth transportation and Agency Based Template" />
    <meta name="keywords" content="Portfolio, Agency, Onepage, Html, Business, Blog, Parallax" />

    <!--====== TITLE TAG ======-->
    <title>Ruta</title>

    <!--====== FAVICON ICON =======-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <!--====== STYLESHEETS ======-->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/stellarnav.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!--====== MAIN STYLESHEETS ======-->
    <link href="style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

    <script src="Control.OSMGeocoder.js"></script>
    <link rel="stylesheet" href="Control.OSMGeocoder.css" />
    <script src="https://kit.fontawesome.com/d684b42b31.js" crossorigin="anonymous"></script>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        #map {
            height: 80%;
            width: 100%;
        }


        #txtDireccionInicio {
            display: block;

        }

        input {
            border: 0 none;
            padding: 10px;
            width: 100%;
        }

        #btnBuscar {
            background: #5d6b82 none repeat scroll 0 0;
            border: 0 none;
            color: #fff;
            letter-spacing: 2px;
            padding: 10px 20px;
            text-transform: uppercase;
            -webkit-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        #btnBuscar:hover {
            background: #f39c12;
            color: #fff;
        }

        .fa-map-marker-alt {
            color: coral;
        }

        a:hover>.fa-map-marker-alt {
            color: red;
        }
    </style>

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="home-two">

    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <?php include 'nav.php' ?>


    <!--ABOUT AREA-->
    <section class="about-area colorful-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="quote-form-area wow fadeIn">
                        <h3>Agregar Ruta</h3>
                        <p class=" width-full">

                            <h3><a href="#map">Seleccione la dirección en el mapa para una mayor presición, por favor <i class="fas fa-map-marker-alt"></i></a></h3>
                        </p>
                        <div class="row">
                            <?php
                            if (isset($_SESSION['message']) && $_SESSION['message']) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>
                        <form class="quote-form" action="ActIngresarRuta.php" method="post">
                            <p class=" width-full">
                                <!-- <label for="txtDireccionInicio">Dirección de Entrega</label> -->
                                <input required type="text" name="txtDireccionInicio" id="txtDireccionInicio" placeholder="Direccion de Entrega Lat,Lng" minlength="3" maxlength="50">
                            </p>
                            <p class=" width-full">
                                <label for="txtDireccionInicioNombre">Dirección Inicio</label>
                                <input required type="text" name="txtDireccionInicioNombre" id="txtDireccionInicioNombre" placeholder="Direccion Inicio" maxlength="50">
                            </p>
                            <!-- <p class=" width-full">
                                <label for="txtDireccionFinalNombre">Dirección Final</label>
                                <input required type="text" name="txtDireccionFinal" id="txtDireccionFinal" placeholder="Direccion Final" maxlength="50">
                            </p> -->
                            <!-- <p class=" width-full">
                                <label for="txtDistancia">Distancia</label>
                                <input required type="text" name="txtDistancia" id="txtDistancia" placeholder="Distancia a Recorrer">
                            </p> -->
                            <label for="txtFechaInicio">Fecha y Hora Inicio</label>
                            <p class=" width-half">
                                <input required type="date" name="txtFechaInicio" id="txtFechaInicio">
                                <input required class="pull-right" type="time" name="txtHoraInicio" id="txtHoraInicio">
                            </p>
                            <label for="txtFechaFin">Fecha y Hora Fin</label>
                            <p class=" width-half">
                                <input required type="date" name="txtFechaFin" id="txtFechaFin" placeholder="Fecha Fin">
                                <input required class="pull-right" type="time" name="txtHoraFin" id="txtHoraFin">
                            </p>


                            <button type="submit">Crear Ruta</button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
    <div id="map"></div>






    <script type="text/javascript">
        var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        var osmAttrib = '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        var osm = new L.TileLayer(osmUrl, {
            attribution: osmAttrib
        });
        var map = new L.Map('map').addLayer(osm).setView([48.5, 2.5], 15);
        var lat = "";
        var lng = "";
        var osmGeocoder = new L.Control.OSMGeocoder({
            placeholder: 'Escriba su dirección completa aquí...',
            callback: function(results) {
                var bbox = results[0].boundingbox,
                    first = new L.LatLng(bbox[0], bbox[2]),
                    second = new L.LatLng(bbox[1], bbox[3]),
                    bounds = new L.LatLngBounds([first, second]);
                this._map.fitBounds(bounds);
                lat = first.lat;
                lng = first.lng;
            }
        });

        map.addControl(osmGeocoder);

        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("<h6>Haz seleccionado esto como tu dirección de entrega</h6>")
                .openOn(map);
            $("#txtDireccionInicio").val(e.latlng.lat + "," + e.latlng.lng);

        }

        map.on('click', onMapClick);

        // OBTENER LAT Y LNG
        $('#btnBuscar').on('click', function() {
            var direccion = $('#txtBuscar').val();
            if (lat && lng != "") {
                $("#txtDireccionInicio").val(lat + "," + lng);
            }

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