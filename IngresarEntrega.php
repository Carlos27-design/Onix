<!DOCTYPE html>

<head>
	<!--====== USEFULL META ======-->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Transportation & Agency Template is a simple Smooth transportation and Agency Based Template" />
	<meta name="keywords" content="Portfolio, Agency, Onepage, Html, Business, Blog, Parallax" />

	<!--====== TITLE TAG ======-->
	<title>Mapa</title>

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

	<!--====== STYLESHEETS DATA-TABLE ======-->
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.material.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" rel="stylesheet">

	<!--====== STYLESHEETS DATA-TABLE ======-->
	<script src="https://kit.fontawesome.com/d684b42b31.js" crossorigin="anonymous"></script>


	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

	<script src="Control.OSMGeocoder.js"></script>
	<link rel="stylesheet" href="Control.OSMGeocoder.css" />


	<script src="js/vendor/modernizr-2.8.3.min.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYAESaIh0eGTc5vNgX-32O22ejjjlgbmc&callback=initMap">
	</script>
	<!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


	<!--<script src="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.js"></script>-->
	<!--<link rel="stylesheet" href="https://rawgit.com/k4r573n/leaflet-control-osm-geocoder/master/Control.OSMGeocoder.css" />-->
	<style>
		body {
			padding: 0;
			margin: 0;
		}

		html,
		body,
		#map {
			height: 100%;
			width: 100%;
		}

		#txtdireccionEntrega {
			display: none;
		}
	</style>
</head>

<body>
	<?php include 'nav.php' ?>
	<div class="row">

		<section class="about-area colorful-bg section-padding">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<div class="quote-form-area wow fadeIn">
							<form class="quote-form" action="ActIngresarEntrega.php" method="post">
								<h3>Escoja su dirección en el mapa, por favor.</h3>
								<p class=" width-full">
									<!-- <label for="txtdireccionEntrega">Dirección de Entrega</label> -->
									<input required type="text" name="txtdireccionEntrega" id="txtdireccionEntrega" placeholder="Direccion de Entrega" minlength="3" maxlength="50">
								</p>
								<p class=" width-full">
									<label for="txtIndicaciones">Indicaciones de entrega</label>
									<input required type="text" name="txtIndicaciones" id="txtIndicaciones" placeholder="Indicaciones de su direccion">
								</p>
								<button id="btnIngresar" type="submit">Ingresar Entrega</button>
							</form>

						</div>

					</div>
				</div>
		</section>
	</div>
	<div id="map"></div>




	<script type="text/javascript">
		var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
		var osmAttrib = '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		var osm = new L.TileLayer(osmUrl, {
			attribution: osmAttrib
		});
		var map = new L.Map('map').addLayer(osm).setView([48.5, 2.5], 15);
		var lat = "";
		var lng = "";
		var osmGeocoder = new L.Control.OSMGeocoder({
			placeholder: 'Ingrese su dirección...',
			callback: function(results) {
				var bbox = results[0].boundingbox,
					first = new L.LatLng(bbox[0], bbox[2]),
					second = new L.LatLng(bbox[1], bbox[3]),
					bounds = new L.LatLngBounds([first, second]);
				this._map.fitBounds(bounds);
				lat = first.lat;
				lng = first.lng;
			}
		});
		map.addControl(osmGeocoder);
		$('#btnIngresar').on('click', function() {
			if (lat && lng != "") {
				$("#txtdireccionEntrega").val(lat + "," + lng);
			} else {
				return false;
			}
		});

		// OBTENER LAT Y LNG
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