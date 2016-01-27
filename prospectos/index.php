<?php
include("inc/app.conf.php");
$lang = new lang($m);
/*
 * # INICIO DEL NUCLEO
 */
$CORE = new CORE($m, $s, $o, $CNN);
$CORE->loadModule();
$mods = $CORE->getModules();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PROSPECTOS</title>
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
        <link rel="stylesheet" href="css/dropzone.min.css" />
        <link rel="stylesheet" href="css/basic.min.css" />
        <link rel="stylesheet" href="css/summernote.css" />
        <link rel="stylesheet" href="css/summernote-bs3.css" />
        <?php
        if (!isset($_SESSION["PROSPECTOS"])) {
            ?>
            <link rel="stylesheet" href="css/login.css" />
            <?php
        }
        ?>

        <link rel="stylesheet" href="include/modules/<?php echo $m; ?>/style.css" /><!-- Hoja de Estilo Propia del Modulo -->
        <!-- JS -->
        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="js/jquery.hotkeys.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.js"></script>
        <script src="js/datatables.bootstrap.js"></script>
        <script src="js/holder.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
        <script src="js/gmap3.min.js"></script>
        <script src="js/bootstrap-wysiwyg.js"></script>
        <script src="js/dropzone.min.js"></script>
        <script src="js/summernote.min.js"></script>
        <script src="js/summernote-es-ES.js"></script>
        <script src="js/jquery.bootstrap-growl.min.js"></script>
        <script src="js/main.core.js"></script>
        <script src="js/jQueryRotate.js"></script>
        <script src="js/MD5.js"></script>
        <script src="include/modules/<?php echo $m; ?>/func.common.js"></script><!-- Funciones Propias del Modulo -->
    </head>
    <body>
        <?php
        if (isset($_SESSION["PROSPECTOS"])) {
            //  include("include/sidebar.inc.php");
            $tttsk = mysqli_query($CNN, "select * from crm_activities where uid='" . $_SESSION['PROSPECTOS']['uid'] . "' and activo='1'");
            $ntk = mysqli_num_rows($tttsk);
            ?>
            <div id="content" background-color="red">
                <div class="navbar ">
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="Javascript:void(0);"><i class="fa fa-user fa-2x"></i></a></li><!--href="./?m=account"-->
                        <li id="btntask" name="btntask">
                            <div class="btn btn-primary" id="indice_notask" name="indice_notask"><?php echo $ntk; ?></div>
                        </li>
                        <?php
                        if ($_SESSION["PROSPECTOS"]["level"] == "0") {
                            ?>
                            <li><a href="./?m=admin"><i class="fa fa-cogs fa-2x"></i></a></li>
                            <?php
                        }
                        ?>
                            <li><a href="./logout.php"><i class="fa fa-sign-out fa-2x"></i></a></li>
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
            <?php
        } else {
            include("include/modules/web/login.form.php");
        }
        ?>
    </body>
</html>
<script>
    $(document).ready(function () {
        function getRandValue() {
            $.ajax({
                data: null,
                url: "include/modules/dashboard/actualizadiv.php",
                type: 'post',
                success: function (data)
                {
                    document.getElementById("indice_notask").innerHTML = data;
                }
            });
        }
        setInterval(getRandValue, 60000);
    });
</script>