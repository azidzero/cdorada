<?php
include("inc/app.conf.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php $wlang->getString("header", "title"); ?></title>
        <base href="http://www.elquirofano.com.mx:8080/cdorada/">
        <!-- <base href="http://localhost/cdorada/">-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,600,700,800|Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/custom-theme/jquery-ui-1.9.2.custom.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />                
        <link rel="stylesheet" href="css/onepage-scroll.css" />
        <link rel="stylesheet" href="css/vegas.min.css" />
        <link rel="stylesheet" href="css/website.css" />

        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="js/bootstrap.min.js"></script>        
        <script src="js/holder.js"></script>
        <script src="js/jquery.onepage-scroll.min.js"></script>
        <script src="js/vegas.min.js"></script>
    </head>
    <body>
        <div id="menu">
            <ul class="navbar-nav nav pull-right">
                <li class="active"><a href="#"><img src="images/flag/ES.png" width="24" /></a></li>
                <li><a href="en/"><img src="images/flag/EN.png" width="24" /></a></li>
                <li><a href="fr/"><img src="images/flag/FR.png" width="24" /></a></li>
                <li><a href="ru/"><img src="images/flag/RU.png" width="24" /></a></li>
                <li class="divider"></li>
                <li><a href="#"><img src="images/social/facebook.png" width="24" /></a></li>                
                <li><a href="#"><img src="images/social/gplus.png" width="24" /></a></li>                
                <li><a href="#"><img src="images/social/twitter.png" width="24" /></a></li>                
                <li><a href="#"><img src="images/social/youtube.png" width="24" /></a></li>                
            </ul>
            <a class="off-canvas" href="javascript:void(0)" onclick="offCanvas()"><i class="fa fa-bars fa-2x"></i></a>
            <a href="#"><img src="images/logo.png" width="256" /></a>
        </div>
        <div id="menu-left">
            <div class="row-fluid">
                <a class="pull-right btn off-canvas-close" href="javascript:void(0)" onclick="offCanvas()">
                    <i class="fa fa-times"></i>
                </a>                             
                <ul class="nav" style="width:80%;">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#rent">Alquiler</a></li>
                    <li><a href="#sale">Venta</a></li>
                    <li><a href="#deal">Ofertas</a></li>
                    <li><a href="#owner">Propietarios</a></li>
                    <li><a href="#about">Acerca de</a></li>
                    <li><a href="#content">Contenido</a></li>
                    <li><a href="#contact">Contacto</a></li>
                </ul>                
            </div>
        </div>
        <script>
            function offCanvas() {
                var a = $('#menu-left').css('left');
                if (a == "0px") {
                    $('#menu-left').css('left', '-50%');
                } else {
                    $('#menu-left').css('left', '0px');
                }
            }
        </script>
        <?php
        include("include/modules/$m/$s.inc.php");
        ?>        
    </body>
</html>