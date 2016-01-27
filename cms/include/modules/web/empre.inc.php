<h3>Empresa</h3>
<?php
$locale = $CORE->modules[$m]->locale;
switch ($o) {
    case 0:
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        ?>
        <h4>Categoria:</h4>
        <form action="./?m=web&s=empre&o=1" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon">Seleccione:</span>
                        <div class="input-group">
                            <select id="post-cat" name="post-cat" class="form-control">
                                <option disabled selected><?php echo $lang->getString("empre", "post-cat-default"); ?></option>
                                <?php
                                $oq = mysqli_query($CNN, "SELECT * from web_emprecategory where pid=0");
                                while ($or = mysqli_fetch_array($oq)) {
                                    echo "<option value=\"{$or["id"]}\">{$or["name"]}</option>";
                                }
                                ?>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-info" onclick="showCatempre('es')" type="button"  title="Administrar Categorias" alt="Administrar Categorias"><i class="fa fa-plus-circle "></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div>
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
                                <?php echo strtoupper($L); ?>
                                <?php if ($L == "es") { ?>
                                    <span class="label label-danger "><?php echo $lang->getString("empre", "post-label-required"); ?></span>
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
                        ?>" id="tab_<?php echo $L; ?>" style="padding:1%;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo $lang->getString("empre", "post-title"); ?>:</span>
                                            <input type="text" id="post-title-<?php echo $L; ?>" name="post-title-<?php echo $L; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group" style="vertical-align:text-top;">
                                            <span class="input-group-addon"><?php echo $lang->getString("empre", "post-cover"); ?>:</span>
                                            <input type="file" id="cover-<?php echo $L; ?>" name="cover-<?php echo $L; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo $lang->getString("empre", "post-short-desc"); ?>:</span>
                                            <input type="text" id="post-short-desc-<?php echo $L; ?>" name="post-short-desc-<?php echo $L; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="hidden" id="post-content-<?php echo $L; ?>" name="post-content-<?php echo $L; ?>" />
                                                <strong><?php echo $lang->getString("empre", "post-content"); ?></strong></span>

                                        </div>
                                    </div>
                                    <div id="post-content-editor-<?php echo $L; ?>"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="well well-sm">
                <button class="btn btn-primary" onclick="unifiyContent()"><?php echo $lang->getString("empre", "post-btn-save"); ?></button>
            </div>
        </form>
        <div class="modal fade bs-example-modal-lg" id="catmodal" style="z-index:999991;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" style="width:40%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body" id="body-cat">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-lg"id="del_modal" style="z-index:999992;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" style="width:20%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" >
                        <div class="alert alert-danger">
                            Desea eliminar la categoria?
                            <input type="text" value="0" class="hidden" id="delcat_val"/>
                        </div>
                        <button type="text" class="btn btn-info" onclick= '$("#del_modal").modal("hide");'>Cancelar</button>
                        <button type="text" class="btn btn-danger" onclick="dodellcatempre()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 1:
        $categ = filter_input(INPUT_POST, "post-cat");
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1") or die(mysqli_error($CNN));
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        $fields = array('post-title', 'post-short-desc', 'post-cat', 'post-content');
        $data = array();

        foreach ($language as $L) {
            unset($e);
            foreach ($fields as $F) {
                $data[$L][$F] = mysqli_real_escape_string($CNN, filter_input(INPUT_POST, $F . "-" . $L));
            }
            // # SAVE
            $date = date("Y-m-d");
            $time = date("H:i:s");
        }
        mysqli_query($CNN, "INSERT INTO web_empre(fecha,hora,cat) VALUES('$date','$time','$categ')") or $e = mysqli_error($CNN);
        if (!isset($e)) {
            echo "<h4>Se ha guardado la actividad.</h4>";
            $id = mysqli_insert_id($CNN);
            $str = md5($id);
            mysqli_query($CNN, "UPDATE web_empre SET str='$str' WHERE id='$id'") or die(mysqli_error($CNN));
            // # DATA
            foreach ($language as $L) {
                unset($le);
                mysqli_query($CNN, "INSERT INTO cdorada_real.web_empre_translate(uid,lang,title,short_desc,content,category)
                    VALUES('$id','$L','{$data[$L]['post-title']}','{$data[$L]['post-short-desc']}','{$data[$L]['post-content']}','$categ')") or $le = mysqli_error($CNN);
                if (!isset($le)) {
                    // # COVER's
                    $path = 'content/empre/item_' . str_pad($id, 6, '0', STR_PAD_LEFT) . "-" . $L . '.jpg';
                    if ($_FILES['cover-' . $L]['error'] == 0) {
                        if (move_uploaded_file($_FILES['cover-' . $L]['tmp_name'], $path)) {
                            echo "<b>Imagen de portada importada para $L</b><br/>";
                        } else {
                            echo "<b class=\"text-danger\">No se pudo actualizar la portada para $L</b><br/>";
                        }
                    }
                } else {
                    echo "<h4>ERROR:</h4>";
                    echo $le;
                }
            }
        } else {
            echo "<h4>ERROR:</h4>";
            echo $e;
        }
        if (!isset($le)) {
            ?>
            <div class="row">
                <div class="col-lg-4">
                    <h2>¿Desea subir imagenes?</h2>
                    <a href="javascript:void(0);" onclick="uploadimage(<?php echo $id; ?>)" class="btn btn-success"><span class="fa fa-image"></span><b>+</b></a>
                </div>
            </div>
            <div class="row hidden" id="info_upload">
                <div class="col-lg-12">
                    <div id="act_ima" class="dropzone"></div>
                    <script>
                        var dz = $("#act_ima").dropzone({
                            maxFilesize: 200,
                            url: "content/upload/empre/upload.inc.php?id=<?php echo $id; ?>",
                            complete: function (file) {
                                $.ajax({
                                    method: "POST",
                                    url: "include/modules/web/galleryempre.ajax.php",
                                    data: {"id": "<?php echo $id; ?>"}
                                }).done(function (data) {
                                    $("#gal_activiy").html(data);
                                });
                            }
                        });
                        $(document).ready(function ()
                        {
                            $.ajax({
                                method: "POST",
                                url: "include/modules/web/galleryempre.ajax.php",
                                data: {"id": "<?php echo $id; ?>"}
                            }).done(function (data) {
                                $("#gal_activiy").html(data);
                            });
                        });
                    </script>
                </div>
                <div class="col-lg-12" id="gal_activiy">
                </div>
            </div>
            <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                        </div>
                        <div class="modal-body" id="elimina_c" name="elimina_c">
                            <form id='form_elim' name='form_elim' method='POST' action="" >
                                <input type="text" name="op" id="op" value="80" class="hidden">
                                <input type="text" name="elim_id" id="elim_id" class="hidden">
                                <input type="text" value="<?php echo $id; ?>"name="empre_id" id="empre_id" class="hidden">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar la imagen?:</label>
                                    <div id="tit" name="tit"><div>
                                        </div>
                                        <input type="text" name="el_id" id="el_id" class="hidden">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-success" id="aceptar" name="aceptar" onclick="eliminaitemimage(<?php echo $id; ?>);">Aceptar</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        break;
    case 2:
        ?>
        <table id="tbl" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Titulo</td>
                    <td>Descripcion Corta</td>
                    <td>Categoria</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function () {
                jTable('tbl', 'include/modules/web/empre.table.php');
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
        <div id="mdlremove" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="alert alert-warning">
                        <h3>Desea eliminar esta imagen?</h3>
                    </div>
                    <div class="modal-footer">
                    <button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button"id="btnacept" class="btn btn-primary">Eliminar</button>
                </div>
                </div>
                
            </div>
        </div>
        <form action="./?m=web&s=empre&o=4" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon">Seleccione:</span>
                        <div class="input-group">
                            <select id="post-cat" name="post-cat" class="form-control">
                                <?php
                                $getcat = mysqli_query($CNN, "select * from web_empre where id=$id")or $err = mysqli_error($CNN);
                                $ct = 0;
                                while ($caa = mysqli_fetch_array($getcat)) {
                                    $ct = $caa['cat'];
                                }
                                ?>
                                        <?php
                                        $oq = mysqli_query($CNN, "SELECT * from web_emprecategory WHERE pid=0");
                                        while ($or = mysqli_fetch_array($oq)) {
                                            echo "<option value=\"{$or["id"]}\"";
                                            if ($ct == $or["id"]) {
                                                echo "selected";
                                            }
                                            echo ">{$or["name"]}</option>";
                                        }
                                        ?>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-info " onclick="showCat('es')" type="button"  title="Administrar Categorias" alt="Administrar Categorias"><i class="fa fa-plus-circle "></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
            <div>
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
                                    <span class="label label-danger"><?php echo $lang->getString("empre", "post-label-required"); ?></span>
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
                        $q = mysqli_query($CNN, "SELECT * from cdorada_real.web_empre_translate WHERE uid='$id' AND lang='$L'");
                        $n = mysqli_num_rows($q);
                        if ($n > 0) {
                            while ($r = mysqli_fetch_array($q)) {
                                $ptitle = $r["title"];
                                $pcontent = $r["content"];
                                $pshort = $r["short_desc"];
                            }
                        }
                        ?>
                        <div role="tabpanel" class="tab-pane <?php
                        if ($L == "es") {
                            echo "active";
                        }
                        ?>" id="tab_<?php echo $L; ?>">
                            <div class="row">
                                <div class="col-lg-6 ">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo $lang->getString("empre", "post-title"); ?>:</span>
                                            <input type="text" id="post-title-<?php echo $L; ?>" name="post-title-<?php echo $L; ?>" class="form-control" value="<?php echo $ptitle; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo $lang->getString("empre", "post-cover"); ?>:</span>
                                            <input type="file" id="cover-<?php echo $L; ?>" name="cover-<?php echo $L; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><?php echo $lang->getString("empre", "post-short-desc"); ?>:</span>
                                            <input type="text" id="post-short-desc-<?php echo $L; ?>" name="post-short-desc-<?php echo $L; ?>" class="form-control" value="<?php echo $pshort; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="hidden" id="post-content-<?php echo $L; ?>" name="post-content-<?php echo $L; ?>" />
                                        <span class="input-group-addon"> <strong><?php echo $lang->getString("empre", "post-content"); ?></strong></span>
                                        <div id="post-content-editor-<?php echo $L; ?>"><?php echo stripslashes($pcontent); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row" id="empre_upload">
                <div class="col-lg-12">
                    <div id="act_ima" class="dropzone"></div>
                    <script>
                        var dz = $("#act_ima").dropzone({
                            maxFilesize: 200,
                            url: "content/upload/empre/upload.inc.php?id=<?php echo $id; ?>",
                            complete: function (file) {
                                $.ajax({
                                    method: "POST",
                                    url: "include/modules/web/galleryempre.ajax.php",
                                    data: {"id": "<?php echo $id; ?>"}
                                }).done(function (data) {
                                    $("#gal_activiy").html(data);
                                });
                            }
                        });
                        $(document).ready(function ()
                        {
                            $.ajax({
                                method: "POST",
                                url: "include/modules/web/galleryempre.ajax.php?id=<?php echo $id; ?>",
                                data: {"id": "<?php echo $id; ?>"}
                            }).done(function (data) {
                                $("#gal_activiy").html(data);
                            });
                        });
                    </script>
                </div>
                <div class="col-lg-12" id="gal_activiy">
                </div>
            </div>
            <div class="well well-sm">
                <button class="btn btn-primary" onclick="unifiyContent()"><?php echo $lang->getString("empre", "post-btn-save"); ?></button>
            </div>
        </form>
        <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' action="" >
                            <input type="text" name="op" id="op" value="80" class="hidden">
                            <input type="text" name="elim_id" id="elim_id" class="hidden">
                            <input type="text" value="<?php echo $id; ?>"name="empre_id" id="empre_id" class="hidden">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar la imagen?:</label>
                                <div id="tit" name="tit"><div>
                                    </div>
                                    <input type="text" name="el_id" id="el_id" class="hidden">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-success" id="aceptar" name="aceptar" onclick="eliminaitemimage(<?php echo $id; ?>);">Aceptar</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 4:
        $cat=  filter_input(INPUT_POST, "post-cat");
        $id = filter_input(INPUT_POST, 'id');
        $upd=  mysqli_query($CNN, "update cdorada_real.web_empre_translate set category=$cat where uid=$id");
        $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1") or die(mysqli_error($CNN));
        $language = array();
        while ($lr = mysqli_fetch_array($lq)) {
            $language[] = $lr['iso_639_1'];
        }
        $fields = array('post-title', 'post-short-desc', 'post-content');
        $data = array();
        foreach ($language as $L) {
            unset($e);
            foreach ($fields as $F) {
                $data[$L][$F] = mysqli_real_escape_string($CNN, filter_input(INPUT_POST, $F . "-" . $L));
            }
            // # SAVE
            $date = date("Y-m-d");
            $time = date("H:i:s");
        }
        // # DATA
        foreach ($language as $L) {
            unset($le);
            $content = $data[$L]['post-content'];
            $SQL = "UPDATE cdorada_real.web_empre_translate SET
          title='{$data[$L]['post-title']}'
          ,short_desc='{$data[$L]['post-short-desc']}'
          ,content='$content' WHERE uid='$id' AND lang='$L'";
            mysqli_query($CNN, $SQL) or $le = mysqli_error($CNN) or $le = mysqli_errno($CNN) . ": " . mysqli_error($CNN);
            if (!isset($le)) {
                echo "<h4>Se ha actualizado la traduccion de la Actividad para <strong>[$L]</strong>.</h4>";
                // # COVER's
                $path = 'content/empre/item_' . str_pad($id, 6, '0', STR_PAD_LEFT) . "-" . $L . '.jpg';
                if ($_FILES['cover-' . $L]['error'] == 0) {
                    if (move_uploaded_file($_FILES['cover-' . $L]['tmp_name'], $path)) {
                        echo "Imagen de portada importada para <strong>[$L]</strong><br/>";
                    } else {
                        echo "<b class=\"text-danger\">No se pudo actualizar la portada para $L</b><br/>";
                    }
                }
            } else {
                echo "<h4>ERROR:</h4>";
                echo $le . "<br/>" . $SQL;
            }
        }
        break;
    case 5:
        $id = filter_input(INPUT_GET, "id");
        ?>
        <form action="./?m=web&s=empre&o=6" method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
            <div class="alert alert-warning">
                <h4>Esta seguro de eliminar</h4>
                <p>Esta accion no se puede deshacer, <strong>esta seguro que deseas continuar?</strong></p>
                <br/>
                <div class="btn-group">
                    <a href="./?m=web&s=empre&o=0" class="btn btn-warning"><i class="fa fa-plus"></i> Agregar Nuevo</a>
                    <a href="./?m=web&s=empre&o=2" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Regresar</a>
                    <button type="submit" class="btn btn-warning">Continuar <i class="fa fa-chevron-right"></i></button>
                </div>
            </div>
        </form>
        <?php
        break;
    case 6:
        $id = filter_input(INPUT_POST, "id");
        mysqli_query($CNN, "DELETE FROM web_empre WHERE id='$id'") or $e = mysqli_error($CNN);
        mysqli_query($CNN, "DELETE FROM web_empre_translate WHERE uid='$id'") or $e = mysqli_error($CNN);
        $getima=  mysqli_query($CNN, "select * from web_empre_gallery where aid=$id ")or $e=mysqli_error($CNN);
        while($ii=  mysqli_fetch_array($getima))
        {
            if(file_exists("content/upload/empre/".$ii['name']."_b.jpg"))
            {
                unlink("content/upload/empre/".$ii['name']."_b.jpg");
            }
            if(file_exists("content/upload/empre/".$ii['name']."_m.jpg"))
            {
           unlink("content/upload/empre/".$ii['name']."_m.jpg");
            }
        }
        mysqli_query($CNN, "DELETE FROM web_empre_gallery WHERE aid='$id'") or $e = mysqli_error($CNN);
        if (!isset($e)) {
            ?>
            <div class="alert alert-info">
                <h3>Se ha eliminado exitosamente!</h3>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h3>Ha ocurrido un error al eliminar !</h3>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        break;
}