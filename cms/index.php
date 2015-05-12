<?php
include("inc/app.conf.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CMS</title>        
        <!-- <base href="http://localhost/cdorada/">-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-title" content="Planet Costa Dorada" />
        <!-- CSS -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,600,700,800|Open+Sans+Condensed:300,300italic,700|Raleway:400,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/custom-theme/jquery-ui-1.9.2.custom.css" />
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/todc-bootstrap.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/style.css" />
        <!-- JS -->
        <script src="../js/jquery-1.11.2.min.js"></script>
        <script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="js/jquery.hotkeys.js"></script>
        <script src="../js/bootstrap.min.js"></script>                
        <script src="../js/holder.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
        <script src="../js/gmap3.min.js"></script>        
        <script src="js/bootstrap-wysiwyg.js"></script>        
        <script src="js/main.core.js"></script>
    </head>
    <body>
        <?php
        include("include/sidebar.inc.php");
        ?>
        <div id="content">
            <div class="navbar">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img data-src="holder.js/24x24/social" class="img-rounded" /><i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#">Salir</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-cogs fa-2x"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <?php
                    $mod = $mods[$m];
                    $sec = $mod->getSection();
                    foreach ($sec as $se) {
                        $op = $mod->getOption($se['url']);
                        $nuo = count($op);
                        if ($nuo > 0) {
                            if ($s == $se['url']) {
                                echo "<li class=\"dropdown active\">";
                            } else {
                                echo "<li class=\"dropdown\">";
                            }
                            echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"./?m=$m&s={$se['url']}\"><img src=\"include/modules/$m/s.{$se['url']}.png\" /> {$se['name']} <i class=\"caret\"></i></a>";
                            echo "<ul class=\"dropdown-menu dropdown-menu-right\">";
                            foreach ($op as $option) {

                                echo "<li><a href=\"./?m=$m&s={$se['url']}&o={$option['url']}\">{$option['name']}</a></li>";
                            }
                            echo "</ul>";
                            echo "</li>";
                        } else {
                            if ($s == $se['url']) {
                                echo "<li class=\"active\">";
                            } else {
                                echo "<li>";
                            }
                            echo "<a href=\"./?m=$m&s={$se['url']}\"><img src=\"include/modules/$m/s.{$se['url']}.png\" /> {$se['name']}</a>";
                            echo "</li>";
                        }
                    }
                    ?>
                </ul><!-- Section -->
            </div>
            <div id="main" class="container-fluid">                
                <?php
                $f = "include/modules/$m/$s.inc.php";
                if (file_exists($f)) {
                    include $f;
                } else {
                    include "include/modules/404.inc.php";
                }
                ?>
            </div>
        </div>
    </body>
</html>