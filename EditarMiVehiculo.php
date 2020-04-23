<?php
session_start();

include_once 'DB/Vehiculo.php';
include_once 'DB/VehiculoDB.php';

$vehiculoDB = new VehiculoDB();
$vehiculo = new Vehiculo();

include_once 'DB/TipoVehiculo.php';
include_once 'DB/TipoVehiculoDB.php';

$tipoVehiculoDB = new TipoVehiculoDB();
$tipoVehiculo = new TipoVehiculo();

$tipoVehiculoLista = $tipoVehiculoDB->listar();

include_once 'DB/Modelo.php';
include_once 'DB/ModeloDB.php';

$modeloDB = new ModeloDB();
$modelo = new Modelo();

$modeloLista = $modeloDB->listar();

include_once 'DB/Marca.php';
include_once 'DB/MarcaDB.php';

$marcaDB = new MarcaDB();
$marca = new Marca();

$idVehiculo = 0;
if (isset($_GET["id"])) {
    $idVehiculo = $_GET["id"];
    $vehiculo = $vehiculoDB->buscar($idVehiculo);
} else {
    header("Location: listarVehiculo.php");
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
    <title>Mi Vehiculo</title>

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
                        <h3>Mi Vehiculo <?php echo $vehiculo->patente; ?></h3>
                        <div class="row">
                            <?php
                            if (isset($_SESSION['message']) && $_SESSION['message']) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>
                        <form class="quote-form" action="ActEditarVehiculo.php?id=<?php echo $vehiculo->id; ?>" method="post">

                            <p class=" width-full">
                                <label for="txtPrecio">Precio</label>
                                <input required class=" pull-right" type="number" name="txtPrecio" id="txtPrecio" placeholder="Precio por kilometro" maxlength="45" value="<?php echo $vehiculo->precio; ?>">
                            </p>
                            <p class=" width-full">
                                <label for="txtLargo">Largo</label>
                                <input required type="text" name="txtLargo" id="txtLargo" placeholder="Largo" maxlength="10" value="<?php echo $vehiculo->largo; ?>">
                            </p>
                            <p class=" width-full">
                                <label for="txtAncho">Ancho</label>
                                <input required class=" pull-right" type="text" name="txtAncho" id="txtAncho" placeholder="Ancho" maxlength="10" value="<?php echo $vehiculo->ancho; ?>">
                            </p>

                            <p class=" width-full">
                                <label for="txtPeso">Peso</label>
                                <input required type="text" name="txtPeso" id="txtPeso" placeholder="Peso" maxlength="10" value="<?php echo $vehiculo->peso; ?>">
                            </p>
                            <p class=" width-full">
                                <label for="slcModelo">Modelo</label>
                                <select name="slcModelo" id="sclModelo">
                                    <?php foreach ($modeloLista as $m) { ?>
                                        <option value="<?php echo $m->id; ?>" <?php if ($vehiculo->modelo_id == $m->id) {
                                                                                    echo ' selected="selected"';
                                                                                } ?>>
                                            <?php echo $m->nombre; ?></option>
                                    <?php } ?>
                                </select>

                            </p>
                            <p class=" width-full">

                                <label for="slcTipoVehiculo">Tipo Vehiculo</label>
                                <br>
                                <select name="slcTipoVehiculo" id="slcTipoVehiculo">
                                    <?php foreach ($tipoVehiculoLista as $t) { ?>
                                        <option value="<?php echo $t->id; ?>" <?php if ($vehiculo->tipoVehiculo_id == $t->id) {
                                                                                    echo ' selected="selected"';
                                                                                } ?>>
                                            <?php echo $t->nombre; ?></option>
                                    <?php } ?>
                                </select>
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