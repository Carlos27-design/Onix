<?php

session_start();

include_once 'DB/Vehiculo.php';
include_once 'DB/VehiculoDB.php';

$vehiculo = new Vehiculo();
$vehiculoDB = new VehiculoDB();


?>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>Lista de Asistentes</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <meta charset="UTF-8">
    <meta name="description" content="HALO photography portfolio template">
    <meta name="keywords" content="photography, portfolio, onepage, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="shortcut icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.css" />



</head>

<div class="row">
            <h3>Informacion de Usuario</h3>
        </div>
        <br>
        <div class="">

            <table id="grid" class="table table-light" style="width:100%">
                <thead>
                    <tr>
                        <th>Patente</th>
                        <th>Largo</th>
                        <th>Ancho</th>
                        <th>Peso</th>
                        <th>Precio</th>
                        <th>Tipo Usuario</th>
                        <th>Modelo</th>
                        <th>Usuario</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lista = $vehiculoDB->listar();
                    foreach ($lista as $l) {
                    ?>    
                        <tr class=" text-center">
                            <!-- datos de la tabla sacada de la base de datos -->
                            
                            <td><?php echo $l->patente ?></td>
                            <td><?php echo $l->largo ?></td>
                            <td><?php echo $l->ancho ?></td>
                            <td><?php echo $l->peso ?></td>
                            <td><?php echo $l->precio ?></td>
                            <td><?php echo $l->tipoVehiculo_id ?></td>
                            <td><?php echo $l->modelo_id ?></td>
                            <td><?php echo $l->usuario_id ?></td>

                        </tr>
                        
                    <?php
                    }
                    ?>

                </tbody>

            </table>

        </div>
    </div>
</html>

<script>

<script src="js/main.js"></script>
<!--====== Javascripts & Jquery ======-->
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js
"></script>