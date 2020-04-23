<?php
include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB();
$ruta = new Ruta();

$rutaLista  = $rutaDB->listar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My Google Map</title>
  <style>
    #map {
      height: 400px;
      width: 100%;
    }
  </style>
</head>

<body>
  <h1>My Google Map</h1>
  <div id="map"></div>
  <script>
    function initMap() {
      // Map options
      var options = {
        zoom: 8,
        center: {
          lat: 42.3601,
          lng: -71.0589
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
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYAESaIh0eGTc5vNgX-32O22ejjjlgbmc&callback=initMap">
  </script>
</body>

</html>