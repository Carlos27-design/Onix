<?php
//https://developer.mapquest.com/documentation/leaflet-plugins/routing/
//Rutas

session_start();
include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entregaDB = new EntregaDB();
$entrega = new Entrega();

$entregaLista  = $entregaDB->listar();


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
                center: [<?= $entregaLista[0]->direccionEntrega ?>],
                zoom: 9
            });

            dir = MQ.routing.directions();

            dir.route({
                locations: [

                    <?php
                    foreach ($entregaLista as $e) {
                        list($lat, $lng) = explode(",", $e->direccionEntrega);
                    ?>, {
                            latLng: {
                                lat: <?= $lat ?>,
                                lng: <?= $lng ?>,
                            }
                        },


                    <?php
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
</head>

<body>

    <?php include 'nav.php' ?>

    <h4>Agregar una tabla, con el significado de cada marcador</h4>
    <h5>Ejemplo</h5>
    <h5>A = Tomas Burgos</h5>
    <h5>B = Santo Domingo</h5>

    <div id='map' style='width: 100%; height:100%;'></div>


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