<?php
//DIBUJAR RUTA
//https://www.youtube.com/watch?v=hRoiG4ZIzeM

session_start();

include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$usuario = new Usuario();
$usuarioDB = new UsuarioDB();

$listaUsuarios = $usuarioDB->listar();

include_once 'DB/Estado.php';
include_once 'DB/EstadoDB.php';

$estado = new Estado();
$estadoDB = new EstadoDB();

$listaEstado = $estadoDB->listar();

include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entregaDB = new EntregaDB();
$entrega = new Entrega();

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$entregaLista  = $entregaDB->listar();

$rutaDB = new RutaDB();
$ruta = new Ruta();

$rutaLista  = $rutaDB->listar();

$idRuta = 0;
if (isset($_GET["id"])) {
    $idRuta = $_GET["id"];
    $ruta = $rutaDB->buscar($idRuta);
} else {
    header("Location: listarRuta.php");
}

?>
<html>

<head>
    <!--====== USEFULL META ======-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Transportation & Agency Template is a simple Smooth transportation and Agency Based Template" />
    <meta name="keywords" content="Portfolio, Agency, Onepage, Html, Business, Blog, Parallax" />

    <!--====== TITLE TAG ======-->
    <title>Entrega Mapa</title>

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
    <script src="https://kit.fontawesome.com/d684b42b31.js" crossorigin="anonymous"></script>

    <!--====== MAIN STYLESHEETS ======-->
    <link href="style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">



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

        .fa-map-marker-alt {
            color: coral;
        }

        a:hover>.fa-map-marker-alt {
            color: red;
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
                            <h3>Ruta N° <?= $ruta->id; ?> <a href="#map">Ver en mapa <i class="fas fa-map-marker-alt"></i></a></h3>
                            <div class="row">
                                <?php
                                if (isset($_SESSION['message']) && $_SESSION['message']) {
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                }
                                ?>
                            </div>
                            <form class="quote-form" action="ActEditarRuta.php?id=<?= $ruta->id; ?>" method="post">

                                <p class=" width-full">
                                    <label for="txtdireccionInicioNombre">Dirección de Inicio</label>
                                    <input disabled required type="text" name="txtdireccionInicioNombre" id="txtdireccionInicioNombre" placeholder="Direccion de inicio" maxlength="45" value="<?php echo $ruta->direccionInicioNombre; ?>">
                                </p>

                                <p class=" width-full">
                                    <label for="txtdireccionFinalNombre">Direccion Final</label>
                                    <input disabled required type="text" name="txtdireccionFinalNombre" id="txtdireccionFinalNombre" placeholder="Direccion Final" maxlength="45" value="<?php echo $ruta->direccionFinalNombre; ?>">
                                </p>

                                <p class=" width-full">
                                    <label for="txtNroDocumentoEntregado">N° Documento entregado (opcional)</label>
                                    <input disabled type="text" name="txtNroDocumentoEntregado" id="txtNroDocumentoEntregado" placeholder="N° 00000" maxlength="45" value="<?php echo $entrega->nroDocumentoEntregado; ?>">
                                </p>

                                <label for="txtFechaInicio">Fecha de inicio</label>
                                <p class=" width-half">
                                    <?php
                                    list($fechaInicio, $horaInicio) = explode(" ", $ruta->fechaInicio);
                                    ?>
                                    <input disabled required type="date" name="txtFechaInicio" id="txtFechaInicio" placeholder="Fecha Inicio" value="<?= $fechaInicio; ?>">
                                    <input disabled required class="pull-right" type="time" name="txtHoraInicio" id="txtHoraInicio" value="<?= $horaInicio; ?>">
                                </p>

                                <label for="txtFechaEntrega">Fecha Final</label>
                                <p class=" width-half">
                                    <?php
                                    list($fechaEntregado, $horaEntregado) = explode(" ", $ruta->fechaFin);
                                    ?>
                                    <input disabled type="date" name="txtFechaEntrega" id="txtFechaEntrega" placeholder="Fecha Entrega" value="<?= $fechaEntregado; ?>">
                                    <input disabled class="pull-right" type="time" name="txtHoraEntrega" id="txtHoraEntrega" value="<?= $horaEntregado; ?>">
                                </p>

                                <button id="btnHabilitar" type="button">Habilitar Edición</button>
                                <button hidden type="submit">Actualizar Datos</button>
                            </form>

                            <div class="row">
                                <table id="tbl" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Fecha <br> Inicio</th>
                                            <th>Administrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($entregaLista as $e) {
                                            if ($e->ruta_id == $ruta->id) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $e->id ?></td>

                                                    <?php
                                                    foreach ($listaUsuarios as $lu) {
                                                        if ($e->usuario_id == $lu->id) {
                                                            echo "<td>" . $lu->nombre . "</td>";
                                                        }
                                                    }
                                                    ?>

                                                    <?php
                                                    foreach ($listaEstado as $le) {
                                                        if ($e->estado_id == $le->id) {
                                                            echo "<td>" . $le->nombre . "</td>";
                                                        }
                                                    }
                                                    ?>
                                                    <td><?= $e->fechaInicio ?></td>
                                                    <td>
                                                        <a title="Ver" href="EditarEntrega.php?id=<?php echo $e->id; ?>" class="btn"><i class="fas fa-eye"></i></a>
                                                        <a onclick="deleteRuta(<?php echo $e->id; ?>)" title="Eliminar" class="btn"><i class="fas fa-trash-alt"></i></a>
                                                    </td>


                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <div id="map" style="height: 100%"></div>
    <script type="text/javascript" src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>

    <!-- INICIAR MAPA -->
    <script>
        <?php
        $e = $rutaDB->Buscar($_GET["id"]);
        list($lat, $lng) = explode(",", $e->direccionInicio);

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


        list($lat, $lng) = explode(",", $entrega->direccionEntrega);
        // echo "L.marker([" . $lat . "," . $lng . "]).addTo(demoMap);"; VERSION BASICA


        echo "var cords = [" . $lat . "," . $lng . "];";
        echo "var marker = L.marker(cords);";
        foreach ($usuarioLista as $lu) {
            if ($entrega->usuario_id == $lu->id) {
                echo "marker.bindPopup('Cliente: " . $lu->nombre . "<br>Dirección: " . $entrega->direccionEntregaNombre . "');";
            }
        }


        echo "marker.addTo(demoMap);";
        ?>
    </script>
    <script>
        $('#btnHabilitar').on('click', function() {
            // $("input").prop('disabled', true);

            $("button").prop('hidden', false);
            $("input").prop('disabled', false);
            $("select").prop('disabled', false);

        });

        function deleteRuta(id) {
            var ask = window.confirm("¿Está seguro que desea eliminar esto?");
            if (ask) {
                window.location.href = "ActEliminarEntregadeRuta.php?idRuta="
                <?= $ruta->id ?> + "&id=" + id;

            }
        }
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