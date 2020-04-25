<?php
include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB();
$ruta = new Ruta();

$rutaLista  = $rutaDB->listar();
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Google Geocoder</title>
  <script src="js/vendor/jquery-1.12.4.min.js"></script>

  <script src="js/vendor/bootstrap.min.js"></script>

  <style>
    body,
    body * {
      margin: 0;
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .buscador {
      text-align: center;
      padding: 30px 0px;
    }

    .buscador #direccion {
      margin: 10px auto;
      width: 100%;
      padding: 7px;
      max-width: 250px;
    }

    .buscador #buscar {
      margin: 0 auto;
      max-width: 250px;
      padding: 7px;
      color: #FFFFFF;
      background: #f2777a;
      border: 2px solid #f2777a;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <div class="buscador">
    <h2>Ingrese una dirección</h2>
    <input type="text" id="direccion">
    <div id="buscar">Buscar</div>
  </div>

  <div id="mapa-geocoder" class="mapa" style="width:100%;display:block;position:absolute;background:#f2777a;"></div>

  <script src="assets/js/jquery-2.1.0.min.js"></script>
  <script>
    $(document).ready(function() {

      $(window).on("load resize", function() {
        var alturaBuscador = $(".buscador").outerHeight(true),
          alturaVentana = $(window).height(),
          alturaMapa = alturaVentana - alturaBuscador;

        $("#mapa-geocoder").css("height", alturaMapa + "px");
      });

      function localizar(elemento, direccion) {
        var geocoder = new google.maps.Geocoder();

        var map = new google.maps.Map(document.getElementById(elemento), {
          zoom: 16,
          scrollwheel: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        geocoder.geocode({
          'address': direccion
        }, function(results, status) {
          if (status === 'OK') {
            var resultados = results[0].geometry.location,
              resultados_lat = resultados.lat(),
              resultados_long = resultados.lng();

            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
          } else {
            var mensajeError = "";
            if (status === "ZERO_RESULTS") {
              mensajeError = "No hubo resultados para la dirección ingresada.";
            } else if (status === "OVER_QUERY_LIMIT" || status === "REQUEST_DENIED" || status === "UNKNOWN_ERROR") {
              mensajeError = "Error general del mapa.";
            } else if (status === "INVALID_REQUEST") {
              mensajeError = "Error de la web. Contacte con Name Agency.";
            }
            alert(mensajeError);
          }
        });
      }

      $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyDYAESaIh0eGTc5vNgX-32O22ejjjlgbmc", function() {
        $("#buscar").click(function() {
          var direccion = $("#direccion").val();
          if (direccion !== "") {
            localizar("mapa-geocoder", direccion);
          }
        });
      });

    });
  </script>
</body>

<!--====== SCRIPTS JS ======-->

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