<?php

include_once 'DB/Ruta.php';
include_once 'DB/RutaDB.php';

$rutaDB = new RutaDB();
$ruta = new Ruta();


$idRuta = 0;
if (isset($_GET["id"])) {
    $idRuta = $_GET["id"];
    $ruta = $rutaDB->buscar($idRuta);
}


?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <!--====== USEFULL META ======-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Transportation & Agency Template is a simple Smooth transportation and Agency Based Template" />
    <meta name="keywords" content="Portfolio, Agency, Onepage, Html, Business, Blog, Parallax" />

    <!--====== TITLE TAG ======-->
    <title>Editar Ruta</title>

    <!--====== FAVICON ICON =======-->
    <link rel="shortcut icon" type="image/ico" href="img/favicon.png" />

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

    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="home-two">

    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <?php include 'nav.php' ?>


    <!--ABOUT AREA-->
    <section class="about-area gray-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="quote-form-area wow fadeIn">
                        <h3>Editar Ruta</h3>
                        <form class="quote-form" action="ActEditarRuta.php?id=<?php echo $ruta->id; ?>" method="post">

                            <p class=" width-full">
                                <label for="txtDireccionInicio">Dirección Inicio</label>
                                <input required type="text" name="txtDireccionInicio" id="txtDireccionInicio" placeholder="Direccion Inicio" maxlength="50" value="<?php echo $ruta->direccionInicio; ?>">
                            </p>
                            <p class=" width-full">
                                <label for="txtDireccionFinal">Dirección Final</label>
                                <input required type="text" name="txtDireccionFinal" id="txtDireccionFinal" placeholder="Direccion Final" maxlength="50" value="<?php echo $ruta->direccionFinal; ?>">
                            </p>
                            <p class=" width-full">
                                <label for="txtDistancia">Distancia</label>
                                <input required type="text" name="txtDistancia" id="txtDistancia" placeholder="Distancia a Recorrer" value="<?php echo $ruta->distancia; ?>">
                            </p>
                            <label for="txtFechaInicio">Fecha y Hora Inicio</label>
                            <p class=" width-half">
                                <?php
                                list($fechaInicio, $horaInicio) = explode(" ", $ruta->fechaInicio);
                                ?>
                                <input required type="date" name="txtFechaInicio" id="txtFechaInicio" value="<?php echo $fechaInicio; ?>">
                                <input required class="pull-right" type="time" name="txtHoraInicio" id="txtHoraInicio" value="<?php echo $horaInicio; ?>">
                            </p>
                            <label for="txtFechaFin">Fecha y Hora Fin</label>
                            <p class=" width-half">
                                <?php
                                list($fechaFinal, $horaFinal) = explode(" ", $ruta->fechaFin);
                                ?>
                                <input required type="date" name="txtFechaFin" id="txtFechaFin" placeholder="Fecha Fin" value="<?php echo $fechaFinal; ?>">
                                <input required class="pull-right" type="time" name="txtHoraFin" id="txtHoraFin" value="<?php echo $horaFinal; ?>">
                            </p>


                            <button type="submit">Actualizar Datos</button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
    <!--ABOUT AREA END-->



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