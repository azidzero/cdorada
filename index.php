<?php
include("inc/app.conf.php");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">        
        <title>Document</title>

        <base href="http://localhost/cdorada/">

        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/website.css" />

        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/holder.js"></script>
    </head>
    <body>
        <?php
        include("include/modules/general/mainnav.inc.php");
        ?>
        <div id="main" class="container-fluid">                        
            <?php
            /*
            $f = "include/modules/$m/$s.inc.php";
            if (file_exists($f)) {
                include($f);
            } else {
                echo $f;
            }*/
            print_r($_REQUEST);
            ?>                        
        </div>
    </body>
</html>