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

</head>

<body>
  <h1>Onix Demo Maps</h1>
  <div id="map" style="height: 100%"></div>
  <script type="text/javascript" src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>

  <!-- INICIAR MAPA -->
  <script>
    var demoMap = L.map('map').setView([-40.574505, -73.131920], 9); // 10 PARA OSORNO
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
          echo "marker.bindPopup('Cliente: " . $lu->nombre . "<br>Dirección: ');";
        }
      }


      echo "marker.addTo(demoMap);";
    }
    ?>
  </script>


</body>

</html>