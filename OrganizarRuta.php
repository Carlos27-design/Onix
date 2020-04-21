<?php

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB();
$ruta = new Ruta();

$marcadores = $rutaDB->listar();

$API_KEY = "AIzaSyCvOrdsS58FdhHIfxtrRaeWzMrxU-EY_lw";
 
 

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
    <title>Rutas</title>

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

    <!--====== STYLESHEETS DATA-TABLE ======-->

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.material.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" rel="stylesheet">




    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="home-two">

    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <style>
        body {
            color: black;
        }
    </style>

    <?php include 'nav.php' ?>

    </div>
    </div>
            <div id="mapa"></div>
    </div>

    </div>
    </section>
    <?php

    $marcadores = $rutaDB->listar();

    foreach ($marcadores as $m) {
        $direccionInicio = $m->direccionInicio;
        $direccionFinal = $m->direccionFinal;

        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($direccionInicio) . " " . urldecode($direccionFinal) . '&&sensor=false');

        $geo = json_decode($geo, true);

        if ($geo['status'] == 'OK') {
            $latitud = $geo['result'][0]['geometry']['location']['lat'];
            $longitud = $geo['result'][0]['geometry']['location']['lng'];
        }
        echo "Latitud:" . $latitud . " Longitud :" . $longitud;
    }
    ?>
    <!--ABOUT AREA END-->
 <script async defer src="src=https://maps.googleapis.com/maps/api/js?key=<?php echo $API_KEY; ?>&callback=initMap"></script>
 <script>
     var map;
        var pathCoordinates = Array();
        function initMap() {
                var countryLength
                var mapLayer = document.getElementById("mapa");
                var centerCoordinates = new google.maps.LatLng(<?php echo $latitud?>, <?php echo $longitud?>);
                var defaultOptions = {
                        center : centerCoordinates,
                        zoom : 4
                }
                map = new google.maps.Map(mapLayer, defaultOptions);
                geocoder = new google.maps.Geocoder();
                <?php
            if (! empty($marcadores)) {
            ?>
                countryLength = <?php echo count($marcadores); ?>
                <?php
                foreach ($marcadores as $k => $v) 
                {
            ?>
                geocoder.geocode({
                        'address' : '<?php echo $marcadores[$k]["Ruta"]; ?>'
                }, function(LocationResult, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                                var latitude = LocationResult[0].geometry.location.lat();
                                var longitude = LocationResult[0].geometry.location.lng();
                                pathCoordinates.push({
                                        lat : latitude,
                                        lng : longitude
                                });

                                new google.maps.Marker({
                                        position : new google.maps.LatLng(latitude, longitude),
                                        map : map,
                                        title : '<?php echo $countryResult[$k]["Ruta"]; ?>'
                                });

                                if (countryLength == pathCoordinates.length) {
                                        drawPath();
                                }

                        }
                });
                <?php
                }
            }
            ?>
        }
        function drawPath() {
                new google.maps.Polyline({
                        path : pathCoordinates,
                        geodesic : true,
                        strokeColor : '#FF0000',
                        strokeOpacity : 1,
                        strokeWeight : 4,
                        map : map
                });
        }
         
     
 </script>
</body>

</html>