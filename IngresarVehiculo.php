<?php
session_start();

include_once './DB/TipoVehiculo.php';
include_once './DB/TipoVehiculoDB.php';

$tipovehiculo = new TipoVehiculo();
$tipovehiculoDB = new TipoVehiculoDB();

include_once './DB/Modelo.php';
include_once './DB/ModeloDB.php';

$modelo = new Modelo();
$modeloDB = new ModeloDB();

include_once './DB/Usuario.php';
include_once './DB/UsuarioDB.php';

$usuario = new Usuario();
$usuarioDB = new UsuarioDB();
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
    <title>Nuevo Vehiculo</title>

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
    <section class="about-area colorful-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="quote-form-area wow fadeIn">
                        <h3>Agregar nuevo vehiculo</h3>
                        <form method="POST" class="quote-form" action="ActIngresarVehiculo.php">
                            <p class="width-full">
                                <input required type="text" name="txtpatente" id="txtpatente" placeholder="Ingrese Patente">
                            </p>
                            <p class="width-full">
                                <input required type="number" name="txtlargo" id="txtlargo" placeholder="Largo">

                            </p>
                            <p class="width-full">
                                <input required type="number" name="txtancho" id="txtancho" placeholder="Ancho">

                            </p>
                            <p class="width-full">
                                <input required type="number" name="txtpeso" id="txtpeso" placeholder="Peso">

                            </p>
                            <p class="width-full">
                                <input required type="number" name="txtprecio" id="txtprecio" placeholder="Precio por viaje">
                            </p>

                            <p class="widht-full">
                                <?php
                                $listaTV = $tipovehiculoDB->listar();
                                $listaM = $modeloDB->listar();
                                $listaU = $usuarioDB->listar();
                                ?>
                                <select name="txttipovehiculo" required>
                                    <option value="">Seleccione el tipo de vehiculo</option>
                                    <?php
                                    foreach ($listaTV as $ltv) {
                                        echo '<option value="' . $ltv->id . '">' . $ltv->nombre . '</option>';
                                    }
                                    ?>
                                </select>
                            </p>
                            <p class="widht-full">
                                <select name="txtmodelo" required>
                                    <option value="">Seleccione modelo</option>
                                    <?php
                                    foreach ($listaM as $lm) {
                                        echo '<option value="' . $lm->id . '">' . $lm->nombre . '</option>';
                                    }
                                    ?>
                                </select>
                            </p>
                            <p class="widht-full">
                                <select name="txtusuario" required>
                                    <option value="">Seleccione usuario</option>
                                    <?php
                                    foreach ($listaU as $lu) {
                                        echo '<option value="' . $lu->id . '">' . $lu->nombre . '</option>';
                                    }
                                    ?>
                                </select>



                            </p>
                            <button type="submit" class="btn btn-submit">Registrar Vehiculo</button>
                        </form>
                    </div>
                </div>
    </section>


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