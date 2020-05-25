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



	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

	<script src="Control.OSMGeocoder.js"></script>
	<link rel="stylesheet" href="Control.OSMGeocoder.css" />


	<script src="js/vendor/modernizr-2.8.3.min.js"></script>

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
								<p class=" width-full">
									<h3>Seleccione su dirección en el mapa para una mayor presición, por favor.</h3>
								</p>

								<p class=" width-full">
									<!-- <label for="txtdireccionEntrega">Dirección de Entrega</label> -->
									<input required type="text" name="txtdireccionEntrega" id="txtdireccionEntrega" placeholder="Direccion de Entrega Lat,Lng" minlength="3" maxlength="50">
								</p>
								<p class=" width-full">
									<label for="txtdireccionEntregaNombre">Dirección de Entrega</label>
									<input required type="text" name="txtdireccionEntregaNombre" id="txtdireccionEntregaNombre" placeholder="Direccion de Entrega Nombre" minlength="3" maxlength="50">
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
			placeholder: 'Escriba su dirección completa aquí...',
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

		var popup = L.popup();

		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("<h6>Haz seleccionado esto como tu dirección de entrega</h6>")
				.openOn(map);
			$("#txtdireccionEntrega").val(e.latlng.lat + "," + e.latlng.lng);

		}

		map.on('click', onMapClick);

		// OBTENER LAT Y LNG
		$('#btnBuscar').on('click', function() {
			var direccion = $('#txtBuscar').val();
			if (lat && lng != "") {
				$("#txtdireccionEntrega").val(lat + "," + lng);
			}

		});
	</script>
	<style>
		input {
			border: 0 none;
			padding: 10px;
			width: 100%;
		}

		#btnBuscar {
			background: #5d6b82 none repeat scroll 0 0;
			border: 0 none;
			color: #fff;
			letter-spacing: 2px;
			padding: 10px 20px;
			text-transform: uppercase;
			-webkit-transition: all 0.3s ease 0s;
			transition: all 0.3s ease 0s;
		}

		#btnBuscar:hover {
			background: #f39c12;
			color: #fff;
		}
	</style>
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