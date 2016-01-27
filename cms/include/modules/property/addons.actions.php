<?php
include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
$activ_autosave = 0;
$lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
$language = array();
while ($lr = mysqli_fetch_array($lq)) {
    $language[] = $lr['iso_639_1'];
}
switch ($op) {
//AGREGA EL CONTENIO A LA MODAL
    default :
        $tab = filter_input(INPUT_POST, "table");
        ?>
        <div class="modal-header">
            <button type="button" class="close alert-danger" data-dismiss="modal" aria-label="Close"><b><span aria-hidden="true">&times;</span></b></button>
            <label class="modal-title text-uppercase" id="exampleModalLabel"><?php echo getData("cms_catalog", "id", $tab, 'common'); ?><br><small>Agregar</small></label>
        </div>
        <div class="modal-body">
            <form id='formadd' name='formadd' class="form" method='POST'>
                <input type="text" name="catalog" id="catalog" value="<?php echo $tab; ?>" class="hidden"/>
                <input type="text" name="op" id="op" value="0" class="hidden"/>
                <input type="text" name="idsav" id="idsav" value="0" class="hidden"/>
                <div class="row " style="padding: 1%;">
                    <div class="col-lg-12">
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
                            <div class="tab-content" style="padding-bottom:.5%;padding-top: 1%;">
                                <?php
                                foreach ($language as $L) {
                                    ?>
                                    <div role="tabpanel"style="padding:0%;" class="tab-pane  <?php
                                    if ($L == "es") {
                                        echo "active";
                                    }
                                    ?> " id="tab_<?php echo $L; ?>">
                                        <div class="row ">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon  alert-info"><b>Nombre<small><?php echo "(" . $L . ")"; ?></small>:</b></div>
                                                        <input type="text" name="name_<?php echo $L; ?>" id="name_<?php echo $L; ?>" class="form-control " placeholder="NOMBRE" <?php
                                                        if ($L == 'es') {
                                                            echo 'onblur="prevw()"';
                                                        }
                                                        ?>/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon alert-info"><b>Tipo:</b></span>
                                <select id="tdato" name="tdato"class="form-control  alert-info" onchange="prevw();">
                                    <option value="" disabled selected>Selecciona...</option>
                                    <option value="0" title="Decision" >SI/NO</option >
                                    <option value="1" title="Campo numerico">Numerico</option >
                                    <option value="2" title="Campo de Texto">Texto</option >
                                    <!--<option value="3" title="Campo de Seleccion">Multiple</option >
                                    <option value="4" title="Cuadro de texto">Cuadro de texto</option >-->
                                    <!--<option value="5" title="suma">Suma</option>-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-info"><b>Valor:</b></div>
                                <input type="text" name="valp" class="form-control" id='valp' onblur="prevw();" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 hidden" id="addselect">
                         <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-info"><b>Valor:</b></div>
                                <input type="text" name="addvp" class="form-control" id='addvp'>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-info"><b>Valor:</b></div>
                                <select  multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-info"><b>Requerido:</b></div>
                                <select id="raq" name="raq"  class="form-control  alert-info" onblur="prevw()">
                                    
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon alert-info"><b>Medida:</b></div>
                                <input type="text" name="unit" id='unit' class="form-control  alert-info" placeholder="vacio si no aplica" onblur="prevw()"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group text-left">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <b>A&ntilde;adir Destino:</b>   <input type="checkbox" value="1" id="reqval" name="reqval" onclick="req_val();prevw()" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group text-left">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <b>Agregar mas:</b>  <input type="checkbox" value="1" id="addor" name="addor" onclick="req_val();prevw()">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </form>
            <br>
            <div id="prvw">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="altaitem();">Guardar</button>
        </div>
        <?php
        break;
    //Editar el item y guardar los cambios
    case 1:
        $id = filter_input(INPUT_POST, "itemid");
        $nams = "select lang,caption,tname from cms_addon_translate where aid=$id";
        $gtnlan = mysqli_query($CNN, $nams);
        $arr = array();
        $tab = null;
        $falt = 0;
        $lg = array(); //lenguaje de array
        while ($g = mysqli_fetch_array($gtnlan)) {
            //$tab = null;
            $arr[$g['lang']] = $g['caption'];
            $tab = $g['tname'];
            $lg[$falt] = $g['lang'];
            $falt++;
        }
        $result = array_diff($language, $lg);
        $new = "insert into cms_addon_translate  (tname,aid,lang,caption) values";
        foreach ($result as $u) {
            $new.="('$tab','$id','$u',''),";
        }
        $new = substr($new, 0, -1);
        $gtnw = mysqli_query($CNN, $new)or $err = "error al ingresar nuevo lenguaje" . mysqli_error($CNN);
        if (!isset($err)) {
            unset($arr);
            $arr = array();
            $nmb = "select lang,caption,tname from cms_addon_translate where aid=$id";
            $gtl = mysqli_query($CNN, $nams);
            while ($g = mysqli_fetch_array($gtl)) {
                $tab = null;
                $arr[$g['lang']] = $g['caption'];
                $tab = $g['tname'];
            }
        }
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel"><?php echo getData("cms_catalog", "id", $tab, 'common'); ?><br><small>Editar</small></h4>
        </div>
        <div class="modal-body">
            <form id='formedit' name='formedit' class="form" method='POST'>
                <input type="text" name="catalog" id="catalog" value="<?php echo $tab; ?>" class="hidden"/>
                <input type="text" name="op" id="op" value="2" class="hidden"/>
                <input type="text" name="idsav" id="idsav" value="<?php echo $id; ?>" class="hidden"/>
                <div class="row " style="padding: 1%;">
                    <div class="col-lg-12">
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
                            <div class="tab-content" style="padding-bottom:.5%;padding-top: 1%;">
                                <?php
                                foreach ($language as $L) {
                                    ?>
                                    <div role="tabpanel"style="padding:0%;" class="tab-pane  <?php
                                    if ($L == "es") {
                                        echo "active";
                                    }
                                    ?> " id="tab_<?php echo $L; ?>">
                                        <div class="row ">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Nombre<small><?php echo "(" . $L . ")"; ?></small>:</div>
                                                        <input type="text" name="name_<?php echo $L; ?>" id="name_<?php echo $L; ?>" value="<?php echo $arr[$L] ?>" class="form-control " placeholder="NOMBRE"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $SQL = mysqli_query($CNN, "select * from cms_addons where id=$id");
                while ($ro = mysqli_fetch_array($SQL)) {
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon alert-info"><b>Tipo:</b></span>
                                    <select id="tdato" name="tdato"class="form-control  alert-info" onchange="prevw()">
                                        <option value="" disabled selected>Selecciona...</option>
                                        <option value="0" <?php
                                        if ($ro['tipo'] == 0) {
                                            echo "selected";
                                        }
                                        ?> title="Decision" >SI/NO</option >
                                        <option value="1" <?php
                                        if ($ro['tipo'] == 1) {
                                            echo "selected";
                                        }
                                        ?> title="Campo numerico">Numerico</option >
                                        <option value="2" <?php
                                        if ($ro['tipo'] == 2) {
                                            echo "selected";
                                        }
                                        ?> title="Campo de Texto">Texto</option >
                                        <!--<option value="3"<?php
                                        if ($ro['tipo'] == 3) {
                                            echo "selected";
                                        }
                                        ?> title="Campo de Seleccion">Multiple</option >
                                        <option value="4" <?php
                                        if ($ro['tipo'] == 4) {
                                            echo "selected";
                                        }
                                        ?> title="Cuadro de texto">Cuadro de texto</option >-->
                                        <option value="5" <?php
                                        if ($ro['tipo'] == 5) {
                                            echo "selected";
                                        } ?> title="suma">Suma</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon alert-info"><b>Valor:</b></div>
                                    <input type="text" name="valp" class="form-control" id='valp' value="<?php echo $ro['valor']; ?>" onblur="prevw();" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon alert-info"><b>Requerido:</b></div>
                                    <select id="raq" name="raq"  class="form-control  alert-info" onblur="prevw()">
                                        <option value="0" <?php
                                        if ($ro['required'] == 0) {
                                            echo "selected";
                                        }
                                        ?>>NO</option >
                                        <option value="1" <?php
                                        if ($ro['required'] == 1) {
                                            echo "selected";
                                        }
                                        ?>>SI</option >
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon alert-info"><b>Medida:</b></div>
                                    <input type="text" name="unit" id='unit' class="form-control  alert-info"value="<?php echo $ro['unidad']; ?>" placeholder="vacio si no aplica" onblur="prevw()"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-left">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <b>A&ntilde;adir Destino:</b>  <input type="checkbox" value="1" id="reqval" name="reqval" onclick="req_val();prevw()"  <?php
                                        if ($ro['destino'] == 1) {
                                            echo "checked";
                                        }
                                        ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-left">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <b>Agregar mas:</b>  <input type="checkbox" value="1" id="addor" name="addor" onclick="req_val();prevw()"  <?php
                                        if ($ro['agregador'] == 1) {
                                            echo "checked";
                                        }
                                        ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="manda_alta();">Guardar</button>
        </div>
        <?php
        break;
    case 2:
        $id = filter_input(INPUT_POST, "idsav"); //id
        $catalog = filter_input(INPUT_POST, "catalog"); //catalogo
        $isguard = filter_input(INPUT_POST, "idsav"); //esta guardado
        $tdato = filter_input(INPUT_POST, "tdato"); //tipo de dato
        $valp = filter_input(INPUT_POST, "valp"); //valor
        $reqre = filter_input(INPUT_POST, "raq"); //requerido
        $unit = filter_input(INPUT_POST, "unit"); //unidad
        $dest = filter_input(INPUT_POST, "reqval"); //unidad
        $add = filter_input(INPUT_POST, "addor"); //unidad
        //cid,tipo,valor,required,unidad,destino
        $actual = mysqli_query($CNN, "UPDATE cms_addons SET tipo = '$tdato',valor = '$valp',required = '$reqre',unidad = '$unit',agregador='$add', destino='$dest' WHERE id =$id")or $err = "error al actualizar" . mysqli_error($CNN);
        if (!isset($err)) {
            $updtrans = "";
            foreach ($language as $LANG) {
                $updtrans .= "update cms_addon_translate set caption='" . filter_input(INPUT_POST, 'name_' . $LANG) . "' where  lang='$LANG' and aid=$id and tname='$catalog';";
            }
            if (mysqli_multi_query($CNN, $updtrans)) {
                do {
                    /* almacenar primer juego de resultados */
                    if ($resu = mysqli_store_result($CNN)) {
                        while ($row = mysqli_fetch_row($resu)) {
                            // printf("%s\n", $row[0]);
                        }
                        mysqli_free_result($resu);
                    }
                    /* mostrar divisor */
                    if (mysqli_more_results($CNN)) {
                        //printf("-----------------\n");
                    }
                } while (mysqli_next_result($CNN) && mysqli_more_results($CNN));
            }
            echo "1";
        } else {
            echo $err;
        }
        break;
    case 3:
        $id = filter_input(INPUT_POST, "id");
        $item = "";
        $mno = mysqli_query($CNN, "select * from cms_addon_translate where aid=$id and lang='es'");
        while ($i = mysqli_fetch_array($mno)) {
            $item = $i['caption'];
        }
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
        </div>
        <div class="modal-body">
            <div class="lert alert-danger text-justify text-uppercase">
                <h4>Al eliminar este elemento del catalogo, afectara sus alojamientos</h4><br>
                <h3>Este cambio <b>NO sera reversible</b></h3>
                <b> ¿Desea continuar?</b>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="eliminaitem(<?php echo $id; ?>)">Aceptar</button>
        </div>
        <?php
        break;
    case 4:
        $id = filter_input(INPUT_POST, "itm");
        $borra = mysqli_query($CNN, "delete from cms_property_catalogs where id=$id")or $err = "error al borrar el item" . mysqli_error($CNN);
        if (!isset($err)) {
            $delang = mysqli_query($CNN, "delete from cms_addon_translate where aid=$id")or $err = "Error al eliminar el item #2" . mysqli_error($CNN);
            if (!isset($err)) {
                echo "1";
            } else {
                echo $err;
            }
        }
        break;
    case 5:
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Agregar Catalogo</h4>
        </div>
        <div class="modal-body">
            <form id='add_cat' name='add_cat' class="form" method='POST'>
                <div class="row ">
                    <div class="col-lg-12">
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
                            <div class="tab-content" style="padding-bottom:.5%;padding-top: 1%;">
                                <?php
                                foreach ($language as $L) {
                                    ?>
                                    <div role="tabpanel"style="padding:0%;" class="tab-pane  <?php
                                    if ($L == "es") {
                                        echo "active";
                                    }
                                    ?> " id="tab_<?php echo $L; ?>">
                                        <div class="row ">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Nombre<small><?php echo "(" . $L . ")"; ?></small>:</div>
                                                        <input type="text" name="name_<?php echo $L; ?>" id="name_<?php echo $L; ?>" class="form-control input-lg " placeholder="NOMBRE"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="op" name="op" value="6" class="hidden">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="savecat();">Guardar</button>
        </div>
        <?php
        break;
    case 6:
        $nes = utf8_encode(filter_input(INPUT_POST, "name_es"));
        $getname = mysqli_query($CNN, "select * from cms_catalog where common='$nes'");
        $nor = mysqli_num_rows($getname);
        if ($nor <= 0) {
            $ines = mysqli_query($CNN, "insert into cms_catalog (common) values('$nes')")or $err = "No se pudo guardar el catalogo<br>" . mysqli_error($CNN);
            if (!isset($err)) {
                $ado = mysqli_insert_id($CNN);
                $olang = "insert into cms_catalog_translate (aid,lang,caption)values";
                foreach ($language as $l) {
                    if ($l != 'es') {
                        $olang.="('$ado','$l','" . filter_input(INPUT_POST, 'name_' . $l) . "'),";
                    }
                }
                $qrylang = substr($olang, 0, -1);
                $ex = mysqli_query($CNN, $qrylang) or $err = "error al crear el catalogo:<br>$qrylang<br>" . mysqli_error($CNN);
                if (!isset($err)) {
                    echo '1|<tr id="row_' . $ado . '">'
                    . '<td >' . $ado . '</td>'
                    . '<td>' . $nes . '</td>'
                    . '<td>0</td>'
                    . '<td>'
                    . '<div class=" btn-group ">'
                    . '<button class="btn btn-danger"alt="Eliminar" title="Eliminar"onclick="delcat(' . $ado . ')"><i class="fa fa-trash"></i></button>'
                    . '<button class="btn btn-warning"alt="Editar" title="Editar"onclick="editcat(' . $ado . ')"><i class="fa fa-edit "></i></button>'
                    . '</div>'
                    . '</td>'
                    . '</tr>';
                } else {
                    echo "0|" . $err;
                }
            } else {
                echo "0|" . $err;
            }
        } else {
            echo "2|Ya existe un catalogo con este nombre";
        }
        break;
    case 7:
        $id = filter_input(INPUT_POST, "id");
        $item = "";
        $mno = mysqli_query($CNN, "select * from cms_catalog where id=$id");
        while ($i = mysqli_fetch_array($mno)) {
            $item = $i['common'];
        }
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger" id="exampleModalLabel">Eliminar</h4>
        </div>
        <div class="modal-body" style="padding:0px;">
            <div class="lert alert-danger text-justify text-uppercase" style="padding: 2%;">
                <h4>Al eliminar el catalogo <b><?php echo utf8_decode($item); ?></b>, afectara sus alojamientos</h4><br>
                <h3>Este cambio <b>NO sera reversible</b></h3>
                <b> ¿Desea continuar?</b>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="borracat(<?php echo $id; ?>)">Aceptar</button>
        </div>
        <?php
        break;
    case 8:
        $id = filter_input(INPUT_POST, "id");
        $del = mysqli_query($CNN, "DELETE FROM cms_catalog_translate WHERE aid=$id") or $err = "error al eliminar los idiomas del catalogo" . mysqli_error($CNN);
        if (!isset($err)) {
            $del2 = mysqli_query($CNN, "DELETE FROM cms_catalog WHERE id=$id") or $err = "error al eliminar los idiomas del catalogo" . mysqli_error($CNN);
            if (!isset($err)) {
                echo "1";
            } else {
                echo $err;
            }
        } else {
            echo $err;
        }
        break;
    case 9:
        $id = filter_input(INPUT_POST, "id");
        $item = "";
        $mno = mysqli_query($CNN, "select * from cms_catalog where id=$id");
        while ($i = mysqli_fetch_array($mno)) {
            $item = $i['common'];
        }
        $exis = mysqli_query($CNN, "select * from cms_catalog_translate");
        $arrex = array();
        while ($h = mysqli_fetch_array($exis)) {
            if ($h['lang'] != "es") {
                $arrex[$h['lang']] = $h['lang'];
            }
        }
        $notin = array_diff($language, $arrex);
        foreach ($notin as $nt) {
            if ($nt != 'es') {
                $ret = addrows("cms_catalog_translate", "aid,lang", "$id,$nt");
            }
        }
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Editar Catalogo</h4>
        </div>
        <div class="modal-body">
            <form id='add_cat' name='add_cat' class="form" method='POST'>
                <div class="row ">
                    <div class="col-lg-12">
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
                            <div class="tab-content" style="padding-bottom:.5%;padding-top: 1%;">
                                <?php
                                foreach ($language as $L) {
                                    ?>
                                    <div role="tabpanel"style="padding:0%;" class="tab-pane  <?php
                                    if ($L == "es") {
                                        echo "active";
                                    }
                                    ?> " id="tab_<?php echo $L; ?>">
                                        <div class="row ">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">Nombre<small><?php echo "(" . $L . ")"; ?></small>:</div>
                                                        <input type="text" name="name_<?php echo $L; ?>" id="name_<?php echo $L; ?>"value="<?php
                                                        if ($L == "es") {
                                                            echo utf8_decode($item);
                                                        } else {
                                                            echo getcondic("$L", "$id");
                                                        }
                                                        ?>" class="form-control input-lg " placeholder="NOMBRE"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="op" name="op" value="10" class="hidden">
                <input type="text" id="id" name="id" value="<?php echo $id; ?>" class="hidden">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="updacat(<?php echo $id; ?>);">Actualizar</button>
        </div>
        <?php
        break;
    case 10:
        $id = filter_input(INPUT_POST, "id");
        $nes = utf8_decode(filter_input(INPUT_POST, "name_es"));
        $getname = mysqli_query($CNN, "select * from cms_catalog where common='$nes'");
        $nor = mysqli_num_rows($getname);
        if ($nor <= 1) {
            $ines = mysqli_query($CNN, "update cms_catalog set common='$nes' where id=$id")or $err = "No se pudo Actualizar el catalogo<br>" . mysqli_error($CNN);
            if (!isset($err)) {
                $ado = mysqli_insert_id($CNN);
                $olang = "";
                foreach ($language as $l) {
                    if ($l != 'es') {
                        $olang.="update cms_catalog_translate set caption='" . filter_input(INPUT_POST, 'name_' . $l) . "' where aid=$id and lang='$l');";
                    }
                }
                $qrylang = substr($olang, 0, -1);
                if (mysqli_multi_query($CNN, $qrylang)) {
                    do {
                        /* almacenar primer juego de resultados */
                        if ($resu = mysqli_store_result($CNN)) {
                            while ($row = mysqli_fetch_row($resu)) {
                                // printf("%s\n", $row[0]);
                            }
                            mysqli_free_result($resu);
                        }
                        /* mostrar divisor */
                        if (mysqli_more_results($CNN)) {
                            //printf("-----------------\n");
                        }
                    } while (mysqli_next_result($CNN) && mysqli_more_results($CNN));
                }
                echo '1|'
                . '<td >' . $id . '</td>'
                . '<td>' . utf8_encode($nes) . '</td>'
                . '<td>0</td>'
                . '<td>'
                . '<div class=" btn-group ">'
                . '<button class="btn btn-danger"alt="Eliminar" title="Eliminar"onclick="delcat(' . $id . ')"><i class="fa fa-trash"></i></button>'
                . '<button class="btn btn-warning"alt="Editar" title="Editar" onclick="editcat(' . $id . ')"><i class="fa fa-edit "></i></button>'
                . '</div>'
                . '</td>';
            } else {
                echo "0|" . $err;
            }
        } else {
            echo "2|Ya existe un catalogo con este nombre";
        }
        break;
    //MODAL->MUESTRA LOS CAMPOS DE CATALOGO
    case 11:
        $cid = filter_input(INPUT_POST, "cid");
        $pad = filter_input(INPUT_POST, "pad");
        $geado = "SELECT (SELECT b.caption FROM cms_addon_translate b WHERE b.aid=a.id AND b.lang='es') AS ncam, a.* FROM cms_addons a WHERE a.tipo=1 and a.cid=$cid";
        $gc = mysqli_query($CNN, $geado) or $e = mysqli_error($CNN);
        if (!isset($e)) {
            ?>
            <div class="modal-header">
                <button type="button" class="close alert-danger" data-dismiss="modal" aria-label="Close"><b><span aria-hidden="true">&times;</span></b></button>
                <label class="modal-title text-uppercase" id="exampleModalLabel"><small>Agregar</small></label>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row text-uppercase bg-primary">
                            <div class="col-xs-1"></div>
                            <div class="col-xs-2">Valor</div>
                            <div class="col-xs-9">Campo</div>
                        </div>
                    </div>
                    <?php
                    while ($i = mysqli_fetch_array($gc)) {
                        $str=$str2="";
                        if(getData2('cms_addons_sum', 'parent',$pad,'aid',$i['id'],'id')>0)
                        {
                            $str="checked";
                            $str2="disabled";
                        }
                        ?>
                        <div class="col-md-12 hover" style=".hover{background-color: #d6e9c6;} ">
                            <div class="row">
                                <div class="col-xs-1">
                                    <input type="checkbox" onclick="asuma(<?php echo $i['id'] . "," . $pad; ?>)" name="ch_<?php echo $i['id']; ?>" id="ch_<?php echo $i['id']; ?>"<?php echo $str;?>>
                                </div>
                                <div class="col-xs-2">
                                    <input type="number"  class="form-control" min="1" value="1" data-id="v_<?php echo $i['id']; ?>" id="val_<?php echo $i['id']; ?>" name="val_<?php echo $i['id']; ?>" <?php echo $str2;?>>
                                </div>
                                <div class="col-xs-9">
                                    <?php
                                    echo $i['ncam'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-warning">
                <h3>
                    <?php echo $e; ?>
                </h3>
            </div>
            <?php
        }
        break;
    //GUARDA EL LOS CAMPOS A SUMAR/ELIMINA
    case 12:
        $ck = filter_input(INPUT_POST, "chk");
        $id = filter_input(INPUT_POST, "id");
        $no = filter_input(INPUT_POST, "no");
        $pad = filter_input(INPUT_POST, "pad");
        if ($ck == 'true') {
            $dqry = " insert into cms_addons_sum(parent,aid,val) values($pad,$id,$no)";
        } else {
            $dqry = "delete from cms_addons_sum where parent=$pad and aid=$id";
        }
        $dosu = mysqli_query($CNN, $dqry)or $e = mysqli_error($CNN);
        if (!isset($e)) {
            echo "1";
        } else {
            echo $e;
        }
        break;
}