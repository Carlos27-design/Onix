<?php

include_once 'DB/Estado.php';
include_once 'DB/EstadoDB.php';

$estado = new Estado();
$estadoDB = new EstadoDB();

$listaEstado = $estadoDB->listar();
include_once 'DB/Vehiculo.php';
include_once 'DB/VehiculoDB.php';

$vehiculo = new Vehiculo();
$vehiculoDB = new VehiculoDB();


$vehiculoLista  = $vehiculoDB->listar();


include_once 'DB/TipoVehiculo.php';
include_once 'DB/TipoVehiculoDB.php';

$tipoVehiculo = new TipoVehiculo();
$tipovehiculoDB = new TipoVehiculoDB();

include_once 'DB/Modelo.php';
include_once 'DB/ModeloDB.php';

$modelo = new Modelo();
$modeloDB = new ModeloDB();

include_once 'DB/Usuario.php';
include_once 'DB/UsuarioDB.php';

$usuario = new Usuario();
$usuarioDB = new UsuarioDB();
$listaUsuarios = $usuarioDB->listar();

include_once 'DB/Entrega.php';
include_once 'DB/EntregaDB.php';

$entregaDB = new EntregaDB();
$entrega = new Entrega();
$entregaLista  = $entregaDB->listar();

$mostrarTabla = false;

$fechaInicio = "";
$fechaFin = "";
session_start();

if (!(isset($_SESSION['usu']) && $_SESSION['usu'])) {
    header('Location: IniciarSesion.php');
}
if (isset($_POST['slcVehiculo']) && isset($_POST['txtFechaInicio']) && isset($_POST['txtFechaFin'])) {

    $mostrarTabla = true;
    $id = $_POST['slcVehiculo'];
    $fechaInicio = $_POST['txtFechaInicio'];
    $fechaFin = $_POST['txtFechaFin'];
    if ($id == 0) {
        $listaReporte = $entregaDB->reporteTodosVehiculos($fechaInicio, $fechaFin);
    } else {
        $listaReporte = $entregaDB->reportePorVehiculo($id, $fechaInicio, $fechaFin);
    }
}
$suma = 0;
$cantidadViajes = 0;
$patente = "";


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
    <title>Vehiculos</title>

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
    <style>
        body {
            color: black;
        }
    </style>

    <?php include 'nav.php' ?>


    <!--ABOUT AREA-->
    <section class="about-area colorful-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="quote-form-area wow fadeIn">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Reporte de Vehiculo <?= $patente ?></h3>
                            </div>

                        </div>
                        <div class="row">
                            <form method="POST" class="quote-form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="col-md-3">
                                    <p class="width-full">
                                        <p class=" width-full">

                                            <select name="slcVehiculo" id="slcVehiculo">
                                                <option value="0">Seleccione Vehiculo</option>
                                                <?php foreach ($vehiculoLista as $v) { ?>
                                                    <option value="<?= $v->id; ?>" <?php if ($entrega->vehiculo_id == $v->id) {
                                                                                        echo ' selected="selected"';
                                                                                    } ?>>
                                                        <?= $v->patente ?></option>
                                                <?php } ?>
                                            </select>
                                        </p>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <p class="width-full">
                                        <input type="date" name="txtFechaInicio" id="txtFechaInicio" placeholder="Fecha Inicial" required>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <p class="width-full">
                                        <input type="date" name="txtFechaFin" id="txtFechaFin" placeholder="Fecha Final" required>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <p class="width-full">
                                        <button type="submit" class="btn btn-submit">Filtrar</button>
                                    </p>
                                </div>
                            </form>

                        </div>
                        <div class="row">
                            <?php
                            if (isset($_SESSION['message']) && $_SESSION['message']) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>
                        <?php if ($mostrarTabla) : ?>

                            <table id="tbl" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
                                        <th>Dirección <br> de Entrega</th>
                                        <th>Fecha <br> Inicio</th>
                                        <?php if ($id == 0) : ?>
                                            <th>Vehiculo</th>
                                        <?php endif; ?>
                                        <th>Precio <br> por viaje</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($listaReporte as $e) {
                                        $cantidadViajes += 1;
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


                                            <td><?= $e->direccionEntregaNombre ?></td>
                                            <td><?= substr($e->fechaInicio, 0, 10) ?></td>

                                            <?php
                                            foreach ($vehiculoLista as $lv) {
                                                if ($e->vehiculo_id == $lv->id) {
                                                    if ($id == 0) {
                                                        echo "<td> " . $lv->patente . "</td>";
                                                    }
                                                    echo "<td> $ " . $lv->precio . "</td>";
                                                    $patente = $lv->patente;
                                                    $suma += $lv->precio;
                                                }
                                            }
                                            ?>


                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>

                            <?php if ($id != 0) : ?>
                                <div class="row">
                                    <h4>
                                        <div class="col-md-6">
                                            Vehiculo a cargo:
                                        </div>
                                        <div class="col-md-6">
                                            <?= $patente ?>
                                        </div>
                                    </h4>
                                </div>

                            <?php endif; ?>
                            <div class="row">
                                <h4>
                                    <div class="col-md-6">
                                        fechas:
                                    </div>
                                    <div class="col-md-6">
                                        <?= $fechaInicio . " - " . $fechaFin ?>
                                    </div>
                                </h4>
                            </div>
                            <div class="row">
                                <h4>
                                    <div class="col-md-6">
                                        Dinero Total viajes:
                                    </div>
                                    <div class="col-md-6">
                                        <?= "$ " . $suma ?>
                                    </div>
                                </h4>
                            </div>
                            <div class="row">
                                <h4>
                                    <div class="col-md-6">
                                        Cantidad de viajes realizados:
                                    </div>
                                    <div class="col-md-6">
                                        <?= $cantidadViajes ?>
                                    </div>
                                </h4>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            </div>

        </div>
    </section>
    <!--ABOUT AREA END-->
    <style>
        .fa-check {
            color: green;
        }

        .fa-times {
            color: red;
        }

        table span {
            display: none;
        }
    </style>
    <script>
        function deleteItem(id) {
            var ask = window.confirm("¿Está seguro que desea eliminar esto?");
            if (ask) {
                window.location.href = "ActEliminarVehiculo.php?id=" + id;

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


    <!--===== DATA-TABLE=====-->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


    <script>
        $(window).on("ready", function() {
            alert();
            $("button").addClass("basicBTN");
        });
        $(document).ready(function() {
            $('#tbl').DataTable({
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                },
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                //ELIMINAR PARA MOSTRAR EL LENGHTMENU
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'pdf']

            });

        });
    </script>

    <!--===== DATA-TABLE=====-->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

</body>

</html>