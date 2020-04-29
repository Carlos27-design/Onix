<?php
include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB();
$ruta = new Ruta();

$rutaLista  = $rutaDB->listar();
?>

<!DOCTYPE html>

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

  <!--====== STYLESHEETS DATA-TABLE ======-->
  <script src="https://kit.fontawesome.com/d684b42b31.js" crossorigin="anonymous"></script>



  <script src="js/vendor/modernizr-2.8.3.min.js"></script>
  
  </script>
  <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<style>
  #map {
    height: 400px;
    width: 100%;
  }
</style>

<body>
  <?php include 'nav.php' ?>


  <section class="about-area colorful-bg section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="quote-form-area wow fadeIn">
            <h1 hidden>My Google Map</h1>
            <h1>Direcciones de inicio</h1>
            <div id="map"></div>
          </div>

        </div>

      </div>
    </div>
  </section>



 
        <script>
                 <?php
               
                        $marcadores = $rutaDB->listar();
                        foreach($rutaLista as $r){
                          $name = urlencode( $r->direccionInicio );
                        }
                        $baseUrl = 'http://nominatim.openstreetmap.org/search?format=json&q=';
                         $data = file_get_contents( "{$baseUrl}{$name}&limit=1" );
                          $json = json_decode( $data );
                          $lat = $json[0]->lat;
                          $lon = $json[0]->lon;
                  ?>
               
               <?php var_dump( $json[0] ); ?>

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

</body>

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

</html>