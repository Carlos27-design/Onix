<?php

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
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css">



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
        <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
        <div id="map" class="map map-home" style="margin:12px 0 12px 0;height:400px;"></div>
        
        <?php
               
                $marcadores = $rutaDB->listar();
                foreach($marcadores as $m){
                        $name = urlencode( $m->direccionInicio );
                }
                $baseUrl = 'http://nominatim.openstreetmap.org/search?format=json&q=Chile';
                $data = file_get_contents( "{$baseUrl}{$name}&limit=110" );
                $json = json_decode( $data );
                $lat = $json[0]->lat;
                $lon = $json[0]->lon;
        ?>
                
                <?php var_dump( $json[0] ); ?>

        <script>
                
                var lat=<?php printf( '%0.3f', $lat ); ?>
                var lon=<?php printf( '%0.3f', $lon ); ?>
	        var osmUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
		osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
		osm = L.tileLayer(osmUrl, {maxZoom: 18, attribution: osmAttrib});
	        var map = L.map('map').setView([lat, lon], 17).addLayer(osm);
	        L.marker([lat, lon])
		.addTo(map)
		.bindPopup('La Catedral de la Habana.')
		.openPopup();
        </script>

        </div>

        </div>
        </section>
        
        <!--ABOUT AREA END-->
       
        
</body>

</html>