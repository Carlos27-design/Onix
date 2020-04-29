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
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-map/3.0-rc1/jquery.ui.map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script type="text/javascript" src="../js/map.js"></script> 


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
            <div id="googleMap" style="width:100%;height:500px"></div>
          </div>

        </div>

      </div>
    </div>
  </section>



 <script>
  $(function() {
	$("#googleMap").gmap({
		'zoom':3
	});
	
	var markers = [];
	
	$("#addMarkerBtnId").click(function() {
		var marker = {
			"lat":$("#lat").val(),
			"lng":$("#lng").val(),
			"title":$("#placeName").val()
		};
		markers.push(marker);
		
		$.each(markers, function(i, m) {
			$("#googleMap").gmap("addMarker", {
				"position":new google.maps.LatLng(m.lat, m.lng),
				"title":m.title
			}).click(function() {
				var contentString = "<table border='1'>" +
						"<tr><td>Place Name : </td><td>"+m.title+"</td></tr>" + 
						"<tr><td>Latitude : </td><td>"+m.lat+"</td></tr>" +
						"<tr><td>Longitude : </td><td>"+m.lng+"</td></tr>" +
						"</table>";
				$("#googleMap").gmap("openInfoWindow", {
					content:contentString
				}, this);
			});
		});
		
	});
	
	$("#findLatLngBtnId").click(function() {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			"address" : $("#placeName").val()
		}, function(results, status) {
			if(status == google.maps.GeocoderStatus.OK) {
				$("#lat").val(results[0].geometry.location.lat().toFixed(6));
				$("#lng").val(results[0].geometry.location.lng().toFixed(6));
			} else {
				alert("Please enter correct place name");
			}
		});
		return false;
	});
});
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