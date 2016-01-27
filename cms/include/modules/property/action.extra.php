<?php
include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
$lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
$language = array();
$activ_autosave = 0;
while ($lr = mysqli_fetch_array($lq)) {
    $language[] = $lr['iso_639_1'];
}
switch ($op) {
    case 0:
        $descrip = filter_input(INPUT_POST, "post_descextra_es");
        $descrip = mysqli_real_escape_string($CNN, $descrip);
        $iext = "insert into cms_property_extra (name,common,valor,unidad,unico, active)values('" . filter_input(INPUT_POST, "newname_es") . "','$descrip ','" . filter_input(INPUT_POST, "valp") . "','" . filter_input(INPUT_POST, "unit") . "','" . filter_input(INPUT_POST, "unic") . "','" . filter_input(INPUT_POST, "activ") . "')";
        $svex = mysqli_query($CNN, $iext)or $errex = "Error al Guardar su item Extra <br>" . mysqli_error($CNN);
        if (!isset($errex)) {
            $excecute = 0;
            $lid = mysqli_insert_id($CNN);
            $inlang = "insert into cms_property_extra_translate (eid,camp,lang,caption)values";
            foreach ($language as $la) {
                if ($la != 'es') {
                    $nm = filter_input(INPUT_POST, "newname_$la");
                    $nm = mysqli_real_escape_string($CNN, $nm);
                    $dsc = filter_input(INPUT_POST, "post_descextra_$la");
                    $dsc = mysqli_real_escape_string($CNN, $dsc);
                    $inlang.="('$lid','newname','$la','$nm'),";
                    $inlang.="('$lid','descextra','$la','$dsc'),";
                    $excecute++;
                }
            }
            if ($excecute >= 1) {
                $inlang = substr($inlang, 0, -1);
                $do = mysqli_query($CNN, $inlang)or $errex = "Error al guardar" . mysqli_error($CNN);
                if (!isset($errex)) {
                    echo "1";
                } else {
                    echo $errex;
                }
            } else {
                echo "1";
            }
        } else {
            echo $errex;
        }
        break;
    case 1:
        $arrlang = array();
        $id = filter_input(INPUT_POST, "id");
        $getall = "select lang from cms_property_extra_translate where eid=$id";
        $edit = mysqli_query($CNN, $getall) or $err = "Error al  obtener los datos" . mysqli_error($CNN);
        while ($ro = mysqli_fetch_array($edit)) {
            $arrlang[] = $ro['lang'];
        }
        $and = array_diff($language, $arrlang);
        $noro = count($and);
        $uu = 0;
        $leng = "insert into cms_property_extra_translate (eid,camp,lang,caption)values";
        if ($noro >= 1) {
            foreach ($and as $aa) {
                if ($aa != "es") {
                    $leng.="('$id','newname','$aa',''),";
                    $leng.="('$id','descextra','$aa',''),";
                    $uu++;
                }
            }
        }
        if ($uu >= 1) {
            $leng = substr($leng, 0, -1);
            $ejec = mysqli_query($CNN, $leng) or $err = mysqli_error($CNN)or $e = mysqli_error($CNN);
            if (isset($err)) {
                echo "error:" . $err;
            }
        }
        $gnames = array();
        $trans = "select * from cms_property_extra_translate where eid=$id";
        $des = mysqli_query($CNN, $trans);
        while ($tt = mysqli_fetch_array($des)) {
            $gnames[$tt['camp'] . '_' . $tt['lang']] = $tt['caption'];
        }
        $getall = mysqli_query($CNN, "select * FROM cms_property_extra  where id=$id");
        while ($e = mysqli_fetch_array($getall)) {
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Edita Extra</h4>
            </div>
            <div class="modal-body">
                <form id="editextra" action="" method="post">
                    <input type="text" name="op" id="op" value="2" class="hidden"/>
                    <input type="text" name="idsav" id="idsav" value="<?php echo $id; ?>" class="hidden"/>
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
                                    <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab" class="text-capitalize">
                                        <?php echo $L; ?>
                                        <?php if ($L == "es") { ?>
                                            <span class="label label-danger">Requerido</span>
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
                                <div role="tabpanel"style="padding:0%;" class="tab-pane  <?php
                                if ($L == "es") {
                                    echo "active";
                                }
                                ?> " id="tab_<?php echo $L; ?>">
                                    <br>
                                    <div class="row ">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><b>Nombre:</b><small>(<?php echo $L; ?>)</small></div>
                                                    <input type="text" name="newname_<?php echo $L; ?>" value="<?php
                                                    if ($L == 'es') {
                                                        echo $e['name'];
                                                    } else {
                                                        echo $gnames["newname_" . $L];
                                                    }
                                                    ?>" class="form-control" id="newname_<?php echo $L; ?>" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><b>Descripci&oacute;n:</b><small>(<?php echo $L; ?>)</small></div>
                                                </div>
                                            </div>
                                            <div  id="descextra_<?php echo $L; ?>"><?php
                                                if ($L == "es") {
                                                    echo $e['common'];
                                                } else {
                                                    echo $gnames["descextra_" . $L];
                                                }
                                                ?></div>
                                            <input type="text"class="hidden" name="post_descextra_<?php echo $L; ?>" id="post_descextra_<?php echo $L; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>Costo:</b></div>
                                    <input type="text" name="valp" id='valp' value="<?php echo $e['valor']; ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>Medida:</b></div>
                                    <input type="text" name="unit" id='unit' value="<?php echo $e['unidad']; ?>" class="form-control" placeholder="km, hrs, dias..." />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="unic" value="1" id='unic'<?php
                                    if ($e['unico'] == 1) {
                                        echo "checked";
                                    }
                                    ?>  /> Pago &Uacute;nico
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>Activo:</b></div>
                                    <select id="activ" name="activ"  class="form-control" >
                                        <option value="0" <?php
                                        if ($e['active'] == 0) {
                                            echo "selected";
                                        }
                                        ?>>NO</option >
                                        <option value="1" <?php
                                        if ($e['active'] == 1) {
                                            echo "selected";
                                        }
                                        ?>>SI</option >
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id=guard_e" name="guard_e" class="btn btn-primary" onclick="updatedit();">Guardar</button>
            </div>
            <script>
                $(document).ready(function ()
                {
            <?php
            foreach ($language as $t) {
                ?>
                        $('#descextra_<?php echo $t; ?>').summernote({height: 240});
                <?php
            }
            ?>
                });
                function updatedit()
                {
            <?php
            foreach ($language as $t) {
                ?>
                        $('#post_descextra_<?php echo $t; ?>').val($('#descextra_<?php echo $t; ?>').code());
                <?php
            }
            ?>
                    updextra();
                }
            </script>
            <?php
        }
        break;
    case 2:
        $id = filter_input(INPUT_POST, 'idsav');
        $descrip = filter_input(INPUT_POST, "post_descextra_es");
        $descrip = mysqli_real_escape_string($CNN, $descrip);
        $iext = "update cms_property_extra set name='" . filter_input(INPUT_POST, "newname_es") . "',common='$descrip',valor='" . filter_input(INPUT_POST, "valp") . "',unidad='" . filter_input(INPUT_POST, "unit") . "',unico='" . filter_input(INPUT_POST, "unic") . "', active='" . filter_input(INPUT_POST, "activ") . "' where id=$id";
        $svex = mysqli_query($CNN, $iext)or $errex = "Error al Actualizar su Extra <br>" . mysqli_error($CNN);
        if (!isset($errex)) {
            $excecute = 0;
            $lid = mysqli_insert_id($CNN);
            $inlang = "";
            foreach ($language as $la) {
                if ($la != 'es') {
                    $nm = filter_input(INPUT_POST, "newname_$la");
                    $nm = mysqli_real_escape_string($CNN, $nm);
                    $dsc = filter_input(INPUT_POST, "post_descextra_$la");
                    $dsc = mysqli_real_escape_string($CNN, $dsc);
                    $inlang.= "update cms_property_extra_translate set caption='$nm' where eid='$id' and camp='newname' and lang='$la';";
                    $inlang.= "update cms_property_extra_translate set caption='$dsc' where eid='$id' and camp='descextra' and lang='$la';";
                    unset($nm, $dsc);
                    $excecute++;
                }
            }
            if ($excecute >= 1) {
                if (mysqli_multi_query($CNN, $inlang)) {
                    do {
                        if ($rsu = mysqli_store_result($CNN)) {
                            while ($row = mysqli_fetch_row($rsu)) {
                                //  printf("%s\n", $row[0]);
                            }
                            mysqli_free_result($rsu);
                        }
                        if (mysqli_more_results($CNN)) {
                            
                        }
                    } while (mysqli_next_result($CNN) && mysqli_more_results($CNN));
                }
                echo "1";
            } else {
                echo "1";
            }
        } else {
            echo $errex;
        }
        break;
    case 3:
        $id = filter_input(INPUT_POST, "iddel");
        $delall = "delete from cms_property_extra_translate where eid=$id";
        $d1 = mysqli_query($CNN, $delall)or $e = "error al eliminar los lenguajes" . mysqli_error($CNN);
        if (!isset($e)) {
            $delex = "delete from cms_property_extra where id=$id";
            $d2 = mysqli_query($CNN, $delex)or $e = "error al eliminar el item extra" . mysqli_error($CNN);
            if (!isset($e)) {
                echo "1";
            } else {
                echo $e;
            }
        } else {
            echo $e;
        }

        break;
    case 4:
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Nuevo Extra</h4>
        </div>
        <div class="modal-body">
            <form id='frmextra' name='frmextra' method='POST'>
                <input type="text" name="tablename" id="tablename" value="extra" class="hidden"/>
                <input type="text" name="op" id="op" value="0" class="hidden"/>
                <input type="text" name="idsav" id="idsav" value="0" class="hidden"/>
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
                                <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab" class="text-capitalize">
                                    <?php echo $L; ?>
                                    <?php if ($L == "es") { ?>
                                        <span class="label label-danger">Requerido</span>
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
                            <div role="tabpanel"style="padding:0%;" class="tab-pane  <?php
                            if ($L == "es") {
                                echo "active";
                            }
                            ?> " id="tab_<?php echo $L; ?>">
                                <br>
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><b>Nombre:</b><small>(<?php echo $L; ?>)</small></div>
                                                <input type="text" name="newname_<?php echo $L; ?>" class="form-control" id="newname_<?php echo $L; ?>" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><b>Descripci&oacute;n:</b><small>(<?php echo $L; ?>)</small></div>
                                            </div>
                                        </div>
                                        <div  id="nw_descextra_<?php echo $L; ?>"></div>
                                        <input type="text" class="hidden" name="post_descextra_<?php echo $L; ?>" id="post_descextra_<?php echo $L; ?>" value=""/>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><b>Costo:</b></div>
                                <input type="text" name="valp" id='valp' class="form-control" <?php if ($activ_autosave == 1) { ?> onblur="autosave(this.name, 'valor');"<?php } ?>/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><b>Medida:</b></div>
                                <input type="text" name="unit" id='unit' class="form-control" placeholder="km, hrs, dias..."/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="unic" value="1" id='unic'/> Pago &Uacute;nico
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><b>Activo:</b></div>
                                <select id="activ" name="activ"  class="form-control" >
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="unifiyContent();">Guardar</button>
        </div>
        <script>
            sumernote_a();
            function unifiyContent()
            {
        <?php
        foreach ($language as $t) {
            ?>
                    $('#post_descextra_<?php echo $t; ?>').val($('#nw_descextra_<?php echo $t; ?>').code());
            <?php
        }
        ?>
                savextra();
            }
        </script>
        <?php
        break;
}
