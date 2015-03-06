<?php
/*
 * @package:    Actualizador de precios
 * @module:     WAREHOUSE
 */
$msconf = "../../../inc/app.conf.php";
if (file_exists($msconf)) {
    include($msconf);
} else {
    die("No se puede cargar la configuracion");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Importacion de documentos</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Intranet System">
        <meta name="author" content="Quiro T.I.">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,700,800,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../../../include/themes/default/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../../include/themes/default/css/default.css" />
        <link rel="stylesheet" href="../../../include/themes/default/css/font-awesome.min.css" />
    </head>
    <body>
        <?php
// obtenemos los datos del archivo
        $tamano = $_FILES["file"]['size'];
        $tipo = $_FILES["file"]['type'];
        $archivo = $_FILES["file"]['name'];
        $prefijo = substr(md5(uniqid(rand())), 0, 6);

        if ($archivo != "") {
            // guardamos el archivo a la carpeta files
            $destino = "../../upload/" . $prefijo . "_" . $archivo;
            if (copy($_FILES['file']['tmp_name'], $destino)) {
                /*
                 * LECTURA DE ARCHIVO
                 */
                $status = "Archivo cargado: <b>" . $archivo . "</b>";
                $objPHPExcel = PHPExcel_IOFactory::load($destino);
                $objPHPExcel->getSheet(0);
                /*
                 * 
                 */
                $y = 2;
                ?>
                <div class="container">
                    <div class="row">
                        <div class="jumbotron">
                            <h4>
                                IMPORTANDO PRODUCTOS DESDE DOCUMENTO DE Microsoft<sup>&copy;</sup> EXCEL<sup>&reg;</sup> 2007                        
                            </h4>
                        </div>
                        <strong>Leyendo productos desde el documento</strong>
                        <ul class="nav nav-list" style="height:240px;overflow:auto;">
                            <?php
                            $j = 0;
                            $k = 0;
                            $id = "0";
                            while ($id != "") {
                                $id = $objPHPExcel->getActiveSheet()->getCell("A" . $y)->getValue();
                                if ($id != "") {
                                    $codigo = $objPHPExcel->getActiveSheet()->getCell("B" . $y)->getValue();
                                    $producto = $objPHPExcel->getActiveSheet()->getCell("D" . $y)->getValue();
                                    $l1 = $objPHPExcel->getActiveSheet()->getCell("F" . $y)->getValue();
                                    $l2 = $objPHPExcel->getActiveSheet()->getCell("G" . $y)->getValue();
                                    $l3 = $objPHPExcel->getActiveSheet()->getCell("H" . $y)->getValue();
                                    $l4 = $objPHPExcel->getActiveSheet()->getCell("I" . $y)->getValue();
                                    $l5 = $objPHPExcel->getActiveSheet()->getCell("J" . $y)->getValue();
                                    $l6 = $objPHPExcel->getActiveSheet()->getCell("K" . $y)->getValue();
                                    $l7 = $objPHPExcel->getActiveSheet()->getCell("L" . $y)->getValue();
                                    if ($l1 != 0 && $l1 != "" && $l2 != 0 && $l2 != "" && $l3 != 0 && $l3 != "" && $l4 != 0 && $l4 != "" && $l5 != 0 && $l5 != "") {
                                        unset($e);
                                        mysql_query("UPDATE warehouse_product SET 
                                p_1='$l1'
                                ,p_2='$l2'
                                ,p_3='$l3'
                                ,p_4='$l4'
                                ,p_5='$l5'
                                ,p_6='$l6'
                                ,brand='$l7'
                                WHERE id='$id'") or $e = mysql_error();
                                        $j++;
                                        if (!isset($e)) {
                                            echo "<li class=\"text-success\"><i class=\"icon-check\"></i> Producto <strong>$producto</strong> actualizado.</li>";
                                        }
                                    } else {
                                        $k++;
                                    }
                                    $y++;
                                }
                            }
                            ?>
                        </ul>
                        <div class="alert alert-info" style="text-transform: uppercase !important;">
                            <h4>
                                <small>Productos Actualizados: </small><strong><?php echo $j; ?></strong><br/>                                
                            </h4>
                            <p class="text-warning"><strong><?php echo $k; ?></strong> productos no pudieron ser actualizados</p>
                        </div>
                        <?php
                        // Productos Nuevos                
                        ?>
                        <ul class="nav nav-list" style="max-height:240px;overflow:auto;">
                            <?php
                            $j = 0;
                            $k = 0;
                            $name = "0";
                            while ($name != "") {
                                $barcode = $objPHPExcel->getActiveSheet()->getCell("B" . $y)->getValue();
                                $ref = $objPHPExcel->getActiveSheet()->getCell("C" . $y)->getValue();
                                $name = $objPHPExcel->getActiveSheet()->getCell("D" . $y)->getValue();
                                if ($name != "") {
                                    $pdesc = $objPHPExcel->getActiveSheet()->getCell("E" . $y)->getValue();
                                    $p_1 = $objPHPExcel->getActiveSheet()->getCell("F" . $y)->getValue();
                                    $p_2 = $objPHPExcel->getActiveSheet()->getCell("G" . $y)->getValue();
                                    $p_3 = $objPHPExcel->getActiveSheet()->getCell("H" . $y)->getValue();
                                    $p_4 = $objPHPExcel->getActiveSheet()->getCell("I" . $y)->getValue();
                                    $p_5 = $objPHPExcel->getActiveSheet()->getCell("J" . $y)->getValue();
                                    $p_6 = $objPHPExcel->getActiveSheet()->getCell("K" . $y)->getValue();
                                    $brand = $objPHPExcel->getActiveSheet()->getCell("L" . $y)->getValue();
                                    $um = $objPHPExcel->getActiveSheet()->getCell("M" . $y)->getValue();
                                    $min = $objPHPExcel->getActiveSheet()->getCell("N" . $y)->getValue();
                                    $max = $objPHPExcel->getActiveSheet()->getCell("O" . $y)->getValue();
                                    $unit = $objPHPExcel->getActiveSheet()->getCell("P" . $y)->getValue();
                                    if ($unit == "") {
                                        $unit = 0;
                                    }
                                    $owner = $_SESSION["CORE"]["corp"]["id"];
                                    unset($e);
                                    mysql_query("INSERT INTO warehouse_product(barcode,ref,name,pdesc,p_1,p_2,p_3,p_4,p_5,p_6,brand,um,min,max,owner,units) VALUES('$barcode','$ref','$name','$pdesc','$p_1','$p_2','$p_3','$p_4','$p_5','$p_6','$brand','$um','$min','$max','$owner','$unit')") or $e = mysql_error();
                                    $j++;
                                    if (!isset($e)) {
                                        echo "<li class=\"text-success\"><i class=\"fa fa-check-square\"></i> Producto <strong>$name</strong> agregado.</li>";
                                        $nid = mysql_insert_id();
                                        $noid = str_pad($nid, 8, "0", STR_PAD_LEFT);
                                        if ($barcode == "") {
                                            unset($se);
                                            mysql_query("update warehouse_product SET barcode='$noid' WHERE id=$nid") or $se = mysql_error();
                                            if (isset($se)) {
                                                echo "<li>$se</li>";
                                            }
                                        }
                                        if ($ref == "") {
                                            unset($se);
                                            mysql_query("update warehouse_product SET ref='$noid' WHERE id=$nid") or $se = mysql_error();
                                            if (isset($se)) {
                                                echo "<li>$se</li>";
                                            }
                                        }
                                    }
                                    $y++;
                                }
                            }
                            ?>
                        </ul>
                        <div class="alert alert-info" style="text-transform: uppercase !important;">
                            <h4>
                                <small>Productos Importados: </small><strong><?php echo $j; ?></strong><br/>                                
                            </h4>
                            <p class="text-warning"><strong><?php echo $k; ?></strong> productos no pudieron ser actualizados</p>
                        </div>
                        <div class="well well-sm">
                            <button onclick="window.close()" class="btn btn-info"><i class="icon-remove"></i> CERRAR</button>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                $status = "Error al subir el archivo";
            }
        } else {
            $status = "Error al subir archivo";
        }
        ?>

    </body>
</html>
