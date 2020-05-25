<?php
//DIBUJAR RUTA
//https://www.youtube.com/watch?v=hRoiG4ZIzeM
session_start();
include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entregaDB = new EntregaDB();
$entrega = new Entrega();

$entregaLista  = $entregaDB->listar();

include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$usuarioDB = new UsuarioDB();
$usuario = new Usuario();

$usuarioLista  = $usuarioDB->listar();
?>
<html>

<head>

  <title>Tutorial leaflet.js</title>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


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

  <!--====== MAIN STYLESHEETS ======-->
  <link href="style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">

  <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=Zmt3zLFCEahwQ7lnLsSF0U6j6AmmkGWP
"></script>
  <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=Zmt3zLFCEahwQ7lnLsSF0U6j6AmmkGWP
"></script>


</head>

<body>
  <?php include 'nav.php' ?>
  <h1>Dirección de entregas</h1>
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
    foreach ($entregaLista as $e) {
      list($lat, $lng) = explode(",", $e->direccionEntrega);
      // echo "L.marker([" . $lat . "," . $lng . "]).addTo(demoMap);"; VERSION BASICA


      echo "var cords = [" . $lat . "," . $lng . "];";
      echo "var marker = L.marker(cords);";
      foreach ($usuarioLista as $lu) {
        if ($e->usuario_id == $lu->id) {
          echo "marker.bindPopup('Cliente: " . $lu->nombre . "<br>Dirección: " . $e->direccionEntregaNombre . "');";
        }
      }


      echo "marker.addTo(demoMap);";
    }
    ?>
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