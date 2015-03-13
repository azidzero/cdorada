<?php
include("inc/app.conf.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php $wlang->getString("header", "title"); ?></title>
        <base href="http://localhost/cdorada/">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,600,700,800|Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/website.css" />
        <link rel="stylesheet" href="css/jquery.fullPage.css"/>
        <link rel="stylesheet" href="css/slide-wrap.css"/>

        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/jquery.slimscroll.min.js"></script>
        <script src="js/jquery.fullPage.min.js"></script>        
        <script src="js/holder.js"></script>
    </head>
    <body>
        <div id="header">

            <div id="logo" style=""><img src="images/logo.png" height="40" /></div>
            <div class="container-fluid">
                <ul class="nav nav-pills nav-social pull-right">
                    <li><a HREF="./es/"><i style="font-size: 20px" class="fa fa-facebook-square"></i></a></li>
                    <li><a HREF="./es/"><i style="font-size: 24px" class="fa fa-twitter-square"></i></a></li>
                    <li><a HREF="./es/"><i style="font-size: 24px" class="fa fa-youtube-square"></i></a></li>
                    <li><a HREF="./es/"><i style="font-size: 24px" class="fa fa-google-plus-square"></i></a></li>
                </ul>
                <ul class="nav nav-pills nav-lang pull-right">
                    <li><a title="<?php echo ($wlang->getString("navbar", "flag-es")); ?>" HREF="./es/"><img src="images/flag/es.png" height="16" /></a></li>
                    <li><a title="<?php echo ($wlang->getString("navbar", "flag-en")); ?>" HREF="./en/"><img src="images/flag/en.png" height="16" /></a></li>
                    <li><a title="<?php echo ($wlang->getString("navbar", "flag-fr")); ?>" HREF="./fr/"><img src="images/flag/fr.png" height="16" /></a></li>
                    <li><a title="<?php echo ($wlang->getString("navbar", "flag-ru")); ?>" HREF="./ru/"><img src="images/flag/ru.png" height="16" /></a></li>
                </ul>
                <ul id="menu" class="nav nav-pills">
                    <li><a href="#home">INICIO</a></li>
                    <li><a href="#rent">ALQUILER</a></li>
                    <li><a href="#sale">VENTA</a></li>
                    <li><a href="#deal">OFERTAS</a></li>
                    <li><a href="#owner">PROPIETARIOS</a></li>
                    <li><a href="#about">CON&Oacute;CENOS</a></li>
                    <li><a href="#content">CONTENIDO</a></li>
                    <li><a href="#contact">CONTACTO</a></li>                    
                </ul>
            </div>
        </div>
        <div id="fullpage">
            <div id="home" class="section">
                <div class="slide">
                    <div class="container">
                        <h1>AA</h1>
                    </div>
                </div>
                <div class="slide">
                    <h1>AA</h1>
                </div>
                <div class="slide">
                    <h1>AA</h1>
                </div>                
            </div><!-- # HOME -->
            <div id="rent" class="section">
                <div class="container-fluid">
                    <h1>Alquiler</h1>
                </div>
            </div><!-- # RENT -->
            <div id="sale" class="section">
                <div class="container-fluid">
                    <h1>Venta</h1>
                </div>
            </div><!-- # SALE -->
            <div id="deal" class="section">
                <div class="container-fluid">
                    <h1>Ofertas</h1>
                </div>
            </div><!-- # DEAL -->
            <div id="owner" class="section">
                <div class="container-fluid">
                    <h1>Propietarios</h1>
                </div>
            </div><!-- # OWNER -->
            <div id="about" class="section">
                <div class="container-fluid">
                    <h1>Quienes somos</h1>
                </div>
            </div><!-- # ABOUT -->
            <div id="content" class="section">
                <div class="container-fluid">
                    <h1>M&aacute;s contenido</h1>
                </div>
            </div><!-- # CONTENT -->
            <div id="contact" class="section">                
                <div class="container-fluid">                    
                    <div class="row-fluid">
                        <div class="col-sm-9">
                            <h1>Contacto</h1>
                            <h4>Form</h4>
                        </div>
                        <div class="col-sm-3">
                            <h4>Informacion</h4>
                        </div>
                    </div>
                    <div class="row-fluid" style="height:320px;background:#EFEFEF;">
                        <div class="col-sm-12">Google Map</div>
                    </div>
                </div>
            </div><!-- # CONTACT -->
        </div>
        <?php
        // include("include/modules/$m/mainnav.inc.php");
        ?>
        <script>
            $(document).ready(function () {
                $('#fullpage').fullpage({
                    anchors: ['home', 'rent', 'sale', 'deal', 'owner', 'about', 'content', 'contact', 'footer'],
                    slidesNavigation: true,
                    scrollOverflow: true,
                    autoScrolling: true,
                    css3: true,
                    resize: false,
                    verticalCentered: true,
                    scrollingSpeed: 1000,
                    menu: '#menu'
                });
            });
        </script>
    </body>
</html>