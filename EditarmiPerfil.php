<?php
session_start();
include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$usuarioDB = new UsuarioDB();
$usuario = new Usuario();

$idUsuario = 0;
if (isset($_GET["id"])) {
    $idUsuario = $_GET["id"];
    $usuario = $usuarioDB->buscar($idUsuario);
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
    <title>Mi Perfil</title>

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
    <section class="about-area colorful-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="quote-form-area wow fadeIn">
                        <h3>Mis Datos</h3>
                        <div class="row">
                            <?php
                            if (isset($_SESSION['message']) && $_SESSION['message']) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>
                        <form class="quote-form" action="ActEditarUsuario.php?id=<?php echo $usuario->id; ?>" method="post">
                            <p class="width-full">
                                <input required type="text" name="txtRut" id="txtRut" placeholder="RUT" maxlength="20" value="<?php echo $usuario->rut; ?>" readonly>
                            </p>
                            <p class=" width-half">
                                <input required type="text" name="txtNombre" id="txtNombre" placeholder="Nombre" maxlength="45" value="<?php echo $usuario->nombre; ?>">
                                <input required class=" pull-right" type="text" name="txtApellido" id="txtApellido" placeholder="Apellido" maxlength="45" value="<?php echo $usuario->apellido; ?>">
                            </p>
                            <p class=" width-full">
                                <input required type="email" name="txtCorreo" id="txtCorreo" placeholder="Email" maxlength="45" value="<?php echo $usuario->correo; ?>">
                            </p>

                            <p class=" width-full">
                                <input required type="number" name="txtNroTelefonico" id="txtNroTelefonico" placeholder="N° Telefono" maxlength="15" value="<?php echo $usuario->nroTelefonico; ?>">
                            </p>
                            <button type="submit">Actualizar Datos</button>
                        </form>

                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="quote-form-area wow fadeIn">
                        <h3>Actualizar Contraseña</h3>
                        <div class="row">
                            <?php
                            if (isset($_SESSION['message']) && $_SESSION['message']) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>
                        <form class="quote-form" action="ActActualizarContrasena.php?id=<?php echo $usuario->id; ?>" method="post">

                            <p class=" width-full">
                                <input required type="password" name="txtContrasena" id="txtContrasena" placeholder="Contraseña Actual" maxlength="20">
                            </p>
                            <p class=" width-half">
                                <input required type="password" name="txtContrasenaNueva" id="txtContrasenaNueva" placeholder="Contraseña Nueva" maxlength="20">
                                <input required class=" pull-right" type="password" name="txtContrasenaNuevaConf" id="txtContrasenaNuevaConf" placeholder="Confirmar Contraseña Nueva" maxlength="20">
                                <button type="submit" id="actualizar">Actualizar Contraseña</button>
                            </p>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--ABOUT AREA END-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var passCorrecto = false;
            $(document).on('click', '#actualizar', function(e) {
                return passCorrecto;
                alert("Las contraseñas no coinciden");
            });

            $(document).on('focusout', '#txtContrasenaNuevaConf', function(e) {
                var password = $('#txtContrasenaNueva').val();
                var passwordConfirm = $('#txtContrasenaNuevaConf').val();
                if (password == passwordConfirm) {
                    passCorrecto = true;
                    $('#txtContrasenaNueva').css("border", "0 none");
                    $('#txtContrasenaNuevaConf').css("border", "0 none");

                } else {
                    $('#txtContrasenaNueva').css("border", "1px solid red");
                    $('#txtContrasenaNuevaConf').css("border", "1px solid red");

                    alert("Las contraseñas no coinciden");
                }

            });



        });
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