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
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYAESaIh0eGTc5vNgX-32O22ejjjlgbmc&callback=initMap">
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
  <h1>My Google Map</h1>
  <div id="map"></div>
  <script>
    function initMap() {
      // Map options
      var options = {
        zoom: 15,
        center: {
          <?php
          $r = $rutaDB->Buscar($_GET["id"]);
          list($lat, $lng) = explode(",", $r->direccionInicio);

          echo "lat:" . $lat . ",";
          echo "lng:" . $lng;

          ?>
        }
      }

      // New map
      var map = new google.maps.Map(document.getElementById('map'), options);

      // Listen for click on map
      google.maps.event.addListener(map, 'click', function(event) {
        // Add marker
        addMarker({
          coords: event.latLng
        });
      });

      /*
      // Add marker
      var marker = new google.maps.Marker({
        position:{lat:42.4668,lng:-70.9495},
        map:map,
        icon:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
      });

      var infoWindow = new google.maps.InfoWindow({
        content:'<h1>Lynn MA</h1>'
      });

      marker.addListener('click', function(){
        infoWindow.open(map, marker);
      });
      */

      // Array of markers
      var markers = [

        {
          coords: {
            lat: 42.8584,
            lng: -70.9300
          },
          content: '<h1>Amesbury MA</h1>',
          iconImage: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
        },
        <?php
        foreach ($rutaLista as $r) {
          list($lat, $lng) = explode(",", $r->direccionInicio);
          echo "{";
          echo "coords: {";
          echo "lat:" . $lat . ",";
          echo "lng:" . $lng;
          echo "}";
          echo "},";
        }
        ?>

      ];

      // Loop through markers
      for (var i = 0; i < markers.length; i++) {
        // Add marker
        addMarker(markers[i]);
      }

      // Add Marker Function
      function addMarker(props) {
        var marker = new google.maps.Marker({
          position: props.coords,
          map: map,
          //icon:props.iconImage
        });

        // Check for customicon
        if (props.iconImage) {
          // Set icon image
          marker.setIcon(props.iconImage);
        }

        // Check content
        if (props.content) {
          var infoWindow = new google.maps.InfoWindow({
            content: props.content
          });

          marker.addListener('click', function() {
            infoWindow.open(map, marker);
          });
        }
      }
    }
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