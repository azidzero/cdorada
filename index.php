<?php
include("inc/app.conf.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $wlang->getString("header", "title"); ?></title>
        <base href="http://www.elquirofano.com.mx:8080/cdorada/">
        <!-- <base href="http://localhost/cdorada/">-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,600,700,800|Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/custom-theme/jquery-ui-1.9.2.custom.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />                
        <link rel="stylesheet" href="css/vegas.min.css" />
        <link rel="stylesheet" href="css/website.css" />

        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="js/bootstrap.min.js"></script>        
        <script src="js/holder.js"></script>                
        <script src="js/vegas.min.js"></script>
        <script src="js/main.core.js"></script>
    </head>
    <body>
        <div id="menu">            
            <div id="nav-social" class="navbar pull-right">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-social">
                        <i class="fa fa-comments"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-social">
                    <ul class="navbar-nav nav">
                        <li><a href="#" alt="<?php echo $wlang->getString("social", "facebook"); ?>"><img src="images/social/facebook.png" width="24" /></a></li>                
                        <li><a href="#" alt="<?php echo $wlang->getString("social", "google-plus"); ?>"><img src="images/social/gplus.png" width="24" /></a></li>                
                        <li><a href="#" alt="<?php echo $wlang->getString("social", "twitter"); ?>"><img src="images/social/twitter.png" width="24" /></a></li>                
                        <li><a href="#" alt="<?php echo $wlang->getString("social", "youtube"); ?>"><img src="images/social/youtube.png" width="24" /></a></li>                
                    </ul>
                </div>
            </div>
            <div id="nav-lang" class="navbar pull-right">
                <!-- Split button -->
                <div class="btn-group">
                    <button type="button" class="btn">
                        <?php
                        echo '<img src="images/flag/' . strtoupper($lang) . '.png" width="24" /> ' . strtoupper($lang);
                        ?></button>
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" alt="<?php echo $wlang->getString("navbar", "flag-es"); ?>"><img src="images/flag/ES.png" width="24" /> ES</a></li>
                        <li><a href="en/" alt="<?php echo $wlang->getString("navbar", "flag-en"); ?>"><img src="images/flag/EN.png" width="24" /> EN</a></li>
                        <li><a href="fr/" alt="<?php echo $wlang->getString("navbar", "flag-fr"); ?>"><img src="images/flag/FR.png" width="24" /> FR</a></li>
                        <li><a href="ru/" alt="<?php echo $wlang->getString("navbar", "flag-ru"); ?>"><img src="images/flag/RU.png" width="24" /> RU</a></li>
                    </ul>
                </div>
            </div>
            <a class="off-canvas" href="javascript:void(0)" onclick="offCanvas()"><i class="fa fa-bars"></i></a>
            <a id="logo" href="#"><img src="images/logo.png" width="256" /></a>
            <strong id="locale">POS</strong>
        </div>
        <div id="menu-left" class="mnu-l-hidden">
            <a class="pull-right btn off-canvas-close" href="javascript:void(0)" onclick="offCanvas()">
                <i class="fa fa-times"></i>
            </a>                             
            <ul class="nav" style="width:80%;background:transparent;">
                <li><a href="./"><?php echo $wlang->getString("navbar", "menu-home"); ?></a></li>
                <li><a href="./<?php echo $wlang->getAbrv(); ?>/rent"><?php echo $wlang->getString("navbar", "menu-rent"); ?></a></li>
                <li><a href="./<?php echo $wlang->getAbrv(); ?>/sale"><?php echo $wlang->getString("navbar", "menu-sale"); ?></a></li>
                <li><a href="./<?php echo $wlang->getAbrv(); ?>/deal"><?php echo $wlang->getString("navbar", "menu-deal"); ?></a></li>
                <li><a href="./<?php echo $wlang->getAbrv(); ?>/owner"><?php echo $wlang->getString("navbar", "menu-owner"); ?></a></li>
                <li><a href="./<?php echo $wlang->getAbrv(); ?>/about"><?php echo $wlang->getString("navbar", "menu-about"); ?></a></li>
                <li><a href="./<?php echo $wlang->getAbrv(); ?>/content"><?php echo $wlang->getString("navbar", "menu-content"); ?></a></li>
                <li><a href="./<?php echo $wlang->getAbrv(); ?>/contact"><?php echo $wlang->getString("navbar", "menu-contact"); ?></a></li>
            </ul>                            
        </div>
        <script>
            function offCanvas() {
                var a = $('#menu-left').css('left');
                $('#home').parent().css('perspective', '1500px');
                if (a == "0px") {
                    $('#menu-left').addClass('mnu-l-hidden');
                    $('#menu-left').removeClass('mnu-l-show');

                } else {
                    $('#menu-left').removeClass('mnu-l-hidden');
                    $('#menu-left').addClass('mnu-l-show');
                }
            }

        </script>
        <div id="content">
            <?php
            include("include/modules/$m/$s.inc.php");
            ?>
        </div>
        <script>
            actualY = 0;
            var actualS = "home";
            $(document).ready(function () {
                $(window).scroll(function () {
                    actualY = $(window).scrollTop();
                });
            });

        </script>
    </body>
</html>