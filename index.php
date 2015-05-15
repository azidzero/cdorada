<?php
include("inc/app.conf.php");
?>
<!doctype html>
<html lang="<?php echo $lang;?>">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $wlang->getString("header", "title"); ?></title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-title" content="Planet Costa Dorada" />
        <!-- AUTO META -->        
        <base href="http://www.elquirofano.com.mx:8080/cdorada/">        
        <script src="js/pace.min.js"></script>
        <link rel="stylesheet" href="css/pace.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,600,700,800|Open+Sans+Condensed:300,300italic,700|Raleway:400,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/custom-theme/jquery-ui-1.9.2.custom.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/todc-bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />                
        <link rel="stylesheet" href="css/website.css" />
        <link rel="stylesheet" href="css/section.css" />        
        <link rel="stylesheet" href="css/weather.css" />
        <link rel="stylesheet" media="print" href="css/print.css" />

        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="js/bootstrap.min.js"></script>                                
        <script src="js/holder.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
        <script src="js/gmap3.min.js"></script>        
        <script src="js/jquery.simpleWeather.min.js"></script>
        <script src="js/main.core.js"></script>
    </head>
    <body>
        <?php
        include("include/modules/web/mainnav.inc.php");
        ?>
        <div id="main">
        <?php
        include("include/modules/$m/$s.inc.php");
        ?>
        </div>
            <?php
            include("include/modules/web/footer.inc.php");
            ?>
    </body>
</html>