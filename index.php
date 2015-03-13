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

        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/jquery.slimscroll.min.js"></script>
        <script src="js/jquery.fullPage.min.js"></script>        
        <script src="js/holder.js"></script>
    </head>
    <body>
        <div id="header">            
            <ul id="nav-lang" class="nav nav-pills nav-lang pull-right">
                <li><a title="<?php echo ($wlang->getString("navbar", "flag-es")); ?>" HREF="./es/"><img src="images/flag/es.png" height="16" /></a></li>
                <li><a title="<?php echo ($wlang->getString("navbar", "flag-en")); ?>" HREF="./en/"><img src="images/flag/en.png" height="16" /></a></li>
                <li><a title="<?php echo ($wlang->getString("navbar", "flag-fr")); ?>" HREF="./fr/"><img src="images/flag/fr.png" height="16" /></a></li>
                <li><a title="<?php echo ($wlang->getString("navbar", "flag-ru")); ?>" HREF="./ru/"><img src="images/flag/ru.png" height="16" /></a></li>
            </ul>
            <ul id="nav-social" class="nav nav-pills nav-social pull-right">
                <li><a HREF="./es/"><i style="font-size: 20px" class="fa fa-facebook-square"></i></a></li>
                <li><a HREF="./es/"><i style="font-size: 24px" class="fa fa-twitter-square"></i></a></li>
                <li><a HREF="./es/"><img src="images/social/youtube.png" width="24" /></a></li>
                <li><a HREF="./es/"><i style="font-size: 24px" class="fa fa-google-plus-square"></i></a></li>
            </ul>
            <ul id="menu" class="nav navbar-nav" >
                <li><div id="logo" style=""><img src="images/logo.png" height="40" /></div></li>
                <li data-menuanchor="menu-home" class="active"><a href="#home">INICIO</a></li>
                <li data-menuanchor="menu-rent"><a href="#rent">ALQUILER</a></li>
                <li data-menuanchor="menu-sale"><a href="#sale">VENTA</a></li>
                <li data-menuanchor="menu-deal"><a href="#deal">OFERTAS</a></li>
                <li data-menuanchor="menu-owner"><a href="#owner">PROPIETARIOS</a></li>
                <li data-menuanchor="menu-about"><a href="#about">CON&Oacute;CENOS</a></li>
                <li data-menuanchor="menu-content"><a href="#content">CONTENIDO</a></li>
                <li data-menuanchor="menu-contact"><a href="#contact">CONTACTO</a></li>                    
            </ul>
        </div>
        <div id="fullpage">
            <div id="home" class="section active">
                <div class="slide" style="background-image:url('cms/content/upload/item_000000.jpg')">
                    <div class="container right">
                        <h1>Ow</h1>
                    </div>

                </div>
                <div class="slide">
                    <h1>Ow</h1>
                </div>
            </div>
            <div id="rent" class="section"></div>
            <div id="sale" class="section"></div>
            <div id="deal" class="section"></div>
            <div id="owner" class="section"></div>
            <div id="about" class="section"></div>
            <div id="content" class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <img data-src="holder.js/100%x160/social" class="img-responsive img-rounded" />
                            <h4>Titulo Publicacion</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tristique pharetra risus at scelerisque. Duis tempor pretium quam ut egestas. Nam molestie dolor et felis posuere tristique. Quisque eu odio mollis, semper tellus id, facilisis ligula. Nunc tristique efficitur placerat. Phasellus nulla metus, volutpat vitae sagittis ut, luctus vitae metus. Aliquam vehicula libero nec lacus blandit commodo vel sit amet diam. Integer feugiat ac est a commodo. In egestas quis enim in gravida. Nullam a suscipit mi, sed porttitor augue. Vestibulum maximus libero velit, non ultricies metus condimentum ac. Aliquam ut facilisis dui. Etiam vitae vulputate odio.</p>
                            <a href="#" class="btn btn-warning">Ver M&aacute;s</a>
                        </div>
                        <div class="col-sm-3">
                            <h1></h1>
                        </div>
                        <div class="col-sm-3">
                            <h1></h1>
                        </div>
                        <div class="col-sm-3">
                            <h1></h1>
                        </div>
                    </div>
                    <a href="#" class="btn btn-default btn-lg pull-right">Ver todas las publicaciones</a>
                </div>
                
            </div>
            <div id="contact" class="section"></div>
        </div>
        <?php
        // include("include/modules/$m/mainnav.inc.php");
        ?>
        <script>
            $(document).ready(function () {
                $('#fullpage').fullpage({
                    sectionsColor: ['#16A085', '#27AE60', '#2980B9', '#8E44AD', '#2C3E50', '#F39C12', '#D35400', '#C0392B'],
                    anchors: ['menu-home', 'menu-rent', 'menu-sale', 'menu-deal', 'menu-owner', 'menu-about', 'menu-content', 'menu-contact'],
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