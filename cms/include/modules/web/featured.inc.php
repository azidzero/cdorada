<h4><img src="include/modules/<?php echo $m; ?>/s.<?php echo $s; ?>.png" /> Elementos destacados</h4>
<?php
switch ($o) {
    case 0:
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        ?>        
        <form action="./?m=web&s=featured&o=1" class="form" method="post" enctype="multipart/form-data" >
            <div>
                <b>Crear Elemento Destacado</b>
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    foreach ($language as $L) {
                        ?>
                        <li role="presentation" class="<?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>">
                            <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab">
                                <?php echo $L; ?>
                                <?php if ($L == "es") { ?>
                                    <span class="label label-danger"><?php echo $lang->getString("activity", "post-label-required"); ?></span>
                                    <?php
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php
                    foreach ($language as $L) {
                        ?>
                        <div role="tabpanel" class="tab-pane <?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>" id="tab_<?php echo $L; ?>">
                            <table class="table table-condensed">
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Titulo</span>
                                            <input type="text" id="feat-title-<?php echo $L; ?>" name="feat-title-<?php echo $L; ?>" class="form-control" />                        
                                        </div>
                                    </td>
                                    <td rowspan="2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Mensaje</span>
                                            <textarea id="feat-caption-<?php echo $L; ?>" name="feat-caption-<?php echo $L; ?>" class="form-control" rows="3"></textarea>
                                        </div>
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Im&aacute;gen</span>
                                            <input type="file" id="feat-image-<?php echo $L; ?>" name="feat-image-<?php echo $L; ?>" class="form-control" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="well well-sm">
                <button type="submit" class="btn btn-danger">Enviar</button>
            </div>
        </form>
        <?php
        break;
    case 1:
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        $fields = array('feat-title', 'feat-caption');
        $data = array();
        foreach ($language as $L) {
            unset($e);
            foreach ($fields as $F) {
                $data[$L][$F] = filter_input(INPUT_POST, $F . "-" . $L);
            }
            // # SAVE
            $date = date("Y-m-d");
            $time = date("H:i:s");
        }
        mysqli_query($CNN, "INSERT INTO web_featured(fecha,hora) VALUES('$date','$time')") or $e = mysqli_error($CNN);
        if (!isset($e)) {
            echo "<div class=\"alert alert-info\"><h4>Se ha guardado el elemento destacado.</h4>";
            $id = mysqli_insert_id($CNN);
            $str = md5($id);
            mysqli_query($CNN, "UPDATE web_featured SET str='$str' WHERE id='$id'");
            // # DATA
            foreach ($language as $L) {
                unset($le);
                mysqli_query($CNN, "INSERT INTO web_featured_translate(uid,lang,title,caption) 
                    VALUES('$id','$L','{$data[$L]['feat-title']}','{$data[$L]['feat-caption']}')") or $le = mysqli_error($CNN);
                if (!isset($le)) {
                    // # COVER's
                    $path = 'content/featured/item_' . str_pad($id, 6, '0', STR_PAD_LEFT) . "-" . $L . '.jpg';
                    if ($_FILES['feat-image-' . $L]['error'] == 0) {
                        if (move_uploaded_file($_FILES['feat-image-' . $L]['tmp_name'], $path)) {
                            echo "<b>Imagen de portada importada para $L</b><br/>";
                        } else {
                            echo "<b class=\"text-danger\">No se pudo actualizar la portada para $L</b><br/>";
                        }
                    }
                }
            }
            echo "</div>";
        } else {
            echo "<div class=\"alert alert-danger\"><h4>ERROR:</h4>$e</div>";
        }
        ?>
        <div class="well well-sm">
            <div class="btn-group">
                <a href="./?m=web&s=featured&o=0" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Nuevo</a>
                <a href="./?m=web&s=featured&o=2" class="btn btn-primary"><i class="fa fa-table"></i> Ir a administrar</a>
            </div>
        </div>
        <?php
        break;
    case 2:
        ?>        
        <table name="table_dest" id="table_dest" class="table table-condensed">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Titulo</td>
                    <td>Descripci&oacute;n</td>
                    <td width="96">&nbsp;</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <script>
            $(document).ready(function () {
                jTable('table_dest', 'include/modules/web/featured.table.php');
            });
        </script>                

        <?php
        break;
    case 3:
        $id = filter_input(INPUT_GET, "id");
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        ?>        
        <form action="./?m=web&s=featured&o=4" class="form" method="post" enctype="multipart/form-data" >
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
            <div>
                <b>Actualizar Elemento Destacado</b>
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    foreach ($language as $L) {
                        ?>
                        <li role="presentation" class="<?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>">
                            <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab">
                                <?php echo $L; ?>
                                <?php if ($L == "es") { ?>
                                    <span class="label label-danger"><?php echo $lang->getString("activity", "post-label-required"); ?></span>
                                    <?php
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php
                    foreach ($language as $L) {
                        $sq = mysqli_query($CNN, "SELECT * from web_featured_translate WHERE uid='$id' AND lang='$L'");
                        while ($sr = mysqli_fetch_array($sq)) {
                            $title = $sr["title"];
                            $caption = $sr["caption"];
                            $uid = $sr["uid"];
                        }
                        ?>
                        <div role="tabpanel" class="tab-pane <?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>" id="tab_<?php echo $L; ?>">
                            <table class="table table-condensed">
                                <tr>
                                    <td colspan="2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Titulo</span>
                                            <input type="text" id="feat-title-<?php echo $L; ?>" name="feat-title-<?php echo $L; ?>" class="form-control" value="<?php echo $title; ?>" />                        
                                        </div>
                                    </td>
                                    <td rowspan="2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Mensaje</span>
                                            <textarea id="feat-caption-<?php echo $L; ?>" name="feat-caption-<?php echo $L; ?>" class="form-control" rows="3"><?php echo $caption; ?></textarea>
                                        </div>
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Im&aacute;gen</span>
                                            <input type="file" id="feat-image-<?php echo $L; ?>" name="feat-image-<?php echo $L; ?>" class="form-control" />
                                        </div>
                                    </td>
                                    <?php
                                    $iurl = "content/featured/item_" . str_pad($uid, 6, "0", STR_PAD_LEFT) . "-" . $L . ".jpg";
                                    ?>
                                    <td width="96">
                                        <a href="javascript:void(0)" onclick="showImage('<?php echo $iurl; ?>')" class="btn btn-block btn-warning"><i class="fa fa-picture-o"></i> Ver Actual</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="well well-sm">
                <button type="submit" class="btn btn-danger">Enviar</button>
            </div>
        </form>
        <?php
        break;
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        ?>        
        <form action="./?m=web&s=featured&o=1" class="form" method="post" enctype="multipart/form-data" >            
            <div>
                <b>Crear Elemento Destacado</b>
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    foreach ($language as $L) {
                        ?>
                        <li role="presentation" class="<?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>">
                            <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab">
                                <?php echo $L; ?>
                                <?php if ($L == "es") { ?>
                                    <span class="label label-danger"><?php echo $lang->getString("activity", "post-label-required"); ?></span>
                                    <?php
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php
                    foreach ($language as $L) {
                        ?>
                        <div role="tabpanel" class="tab-pane <?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>" id="tab_<?php echo $L; ?>">
                            <table class="table table-condensed">
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Titulo</span>
                                            <input type="text" id="feat-title-<?php echo $L; ?>" name="feat-title-<?php echo $L; ?>" class="form-control" />                        
                                        </div>
                                    </td>
                                    <td rowspan="2">
                                        <div class="input-group">
                                            <span class="input-group-addon">Mensaje</span>
                                            <textarea id="feat-caption-<?php echo $L; ?>" name="feat-caption-<?php echo $L; ?>" class="form-control" rows="3"></textarea>
                                        </div>
                                    </td>
                                </tr>                                
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Im&aacute;gen</span>
                                            <input type="file" id="feat-image-<?php echo $L; ?>" name="feat-image-<?php echo $L; ?>" class="form-control" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="well well-sm">
                <button type="submit" class="btn btn-danger">Enviar</button>
            </div>
        </form>
        <?php
        break;
    case 4:
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        $fields = array('feat-title', 'feat-caption');
        $data = array();
        foreach ($language as $L) {
            unset($e);
            foreach ($fields as $F) {
                $data[$L][$F] = filter_input(INPUT_POST, $F . "-" . $L);
            }
            // # SAVE
            $date = date("Y-m-d");
            $time = date("H:i:s");
        }

        $id = filter_input(INPUT_POST, 'id');
        // # DATA
        foreach ($language as $L) {
            unset($le);
            mysqli_query($CNN, "UPDATE web_featured_translate SET title='{$data[$L]['feat-title']}',caption='{$data[$L]['feat-caption']}' WHERE uid='$id' and lang='$L'") or $le = mysqli_error($CNN);
            echo "<h4>SE ha acatualizado el elemento destacado para [<strong>$L</strong>]</h4>";
            if (!isset($le)) {
                // # COVER's
                $path = 'content/featured/item_' . str_pad($id, 6, '0', STR_PAD_LEFT) . "-" . $L . '.jpg';
                if ($_FILES['feat-image-' . $L]['error'] == 0) {
                    if (move_uploaded_file($_FILES['feat-image-' . $L]['tmp_name'], $path)) {
                        echo "<b>Imagen de portada importada para $L</b><br/>";
                    } else {
                        echo "<b class=\"text-danger\">No se pudo actualizar la portada para $L</b><br/>";
                    }
                }
            }
        }
        ?>
        <div class="well well-sm">
            <div class="btn-group">
                <a href="./?m=web&s=featured&o=0" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Nuevo</a>
                <a href="./?m=web&s=featured&o=2" class="btn btn-primary"><i class="fa fa-table"></i> Ir a administrar</a>
            </div>
        </div>
        <?php
        break;
    case 5:
        $id = filter_input(INPUT_GET, "id");
        ?>
        <form action="./?m=web&s=featured&o=6" method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
            <div class="alert alert-warning">
                <h4>Esta seguro de eliminar el elemento destacado</h4>
                <p>Esta acci&oacute;n no se puede deshacer, <strong>esta seguro que deseas continuar?</strong></p>
                <br/>
                <div class="btn-group">
                    <a href="./?m=web&s=featured&o=0" class="btn btn-warning"><i class="fa fa-plus"></i> Agregar Nuevo</a>
                    <a href="./?m=web&s=featured&o=2" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Regresar</a>
                    <button type="submit" class="btn btn-warning">Continuar <i class="fa fa-chevron-right"></i></button>
                </div>
            </div>
        </form>
        <?php
        break;
    case 6:
        $id = filter_input(INPUT_POST, "id");
        mysqli_query($CNN, "DELETE FROM web_activity WHERE id='$id'") or $e = mysqli_error($CNN);
        mysqli_query($CNN, "DELETE FROM web_activity_translate WHERE uid='$id'") or $e = mysqli_error($CNN);
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $L = $lr['iso_639_1'];
            $path = 'content/featured/item_' . str_pad($id, 6, '0', STR_PAD_LEFT) . "-" . $L . '.jpg';
            if (file_exists($path)) {
                unlink($path);
            }
        }
        if (!isset($e)) {
            ?>
            <div class="alert alert-info">
                <h4>Se ha eliminado la el elemento destacado exitosamente!</h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>Ha ocurrido un error al eliminar el elemento destacado!</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="well well-sm">
            <div class="btn-group">
                <a href="./?m=web&s=featured&o=0" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Nuevo</a>
                <a href="./?m=web&s=featured&o=2" class="btn btn-primary"><i class="fa fa-table"></i> Ir a administrar</a>
            </div>
        </div>
        <?php
        break;
}
?>
<script>
    function closeImage() {
        $('.cmodal').fadeOut('fast');
        setTimeout(function () {
            $('.cmodal').remove();
        }, 1000);

    }
    function showImage(url) {
        var html = "<div id=\"tmpModal\" class=\"cmodal\">";
        html += "<div class=\"panel panel-primary\">";
        html += "<div class=\"panel-heading\">";
        html += "<a onclick=\"closeImage()\" href=\"javascript:void(0)\" class=\"btn btn-danger pull-right\">";
        html += "<i class=\"fa fa-times\"></i></a><h4>Vista Previa</h4>";
        html += "</div>";

        html += "<div class=\"panel-body\" style=\"overflow:auto;height:80vh;\"><img width=\"100%\" src=\"" + url + "\" /></div>";
        html += "</div>";
        $('#main').append(html);
    }
</script>  
<?php

function iresize($image, $size, $mode = "H") {
    list($ancho, $alto) = getimagesize($image);
    switch ($mode) {
        case 'H':
            $w = $size;
            $h = ($size * $alto) / $ancho;
            break;
        case 'V':
            $w = ($size * $ancho) / $alto;
            $h = $size;
            break;
    }
    $imagen_p = imagecreatetruecolor($w, $h);
    $imagen = imagecreatefromjpeg($image);
    imagecopyresampled($imagen_p, $imagen, 0, 0, 0, 0, $w, $h, $ancho, $alto);
    imagejpeg($imagen_p, $image, 100);
}
