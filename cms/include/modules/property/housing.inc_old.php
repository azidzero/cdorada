<h2>Propiedades</h2> 
<?php
switch ($o) {
    case 0:
        ?>
        <form action="./?m=property&s=housing&o=1" method="post" class="form" enctype="multipart/form-data" >
            <h4>Agregar Propiedad</h4>
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#informacion" aria-controls="informacion" role="tab" data-toggle="tab">Informacion</a></li>
                    <li role="presentation" class=""><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
                    <li role="presentation" class=""><a href="#interior" aria-controls="interior" role="tab" data-toggle="tab">Interior</a></li>
                    <li role="presentation" class=""><a href="#exterior" aria-controls="exterior" role="tab" data-toggle="tab">Exterior</a></li>
                    <li role="presentation" class=""><a href="#extra" aria-controls="extra" role="tab" data-toggle="tab">Extra</a></li>
                    <li role="presentation" class=""><a href="#equipamiento" aria-controls="equipamiento" role="tab" data-toggle="tab">Equipamiento</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="informacion">
                        <table class="table table-condensed">
                            <tr>
                            <td width="40%">
                                <div class="input-group">
                                    <span class="input-group-addon">Titulo</span>
                                    <input type="text" id="rent-title" name="rent-title" class="form-control" />
                                </div>
                            </td>
                            <td width="19%">
                                <div class="input-group">
                                    <span class="input-group-addon">Precio $</span>
                                    <input type="text" id="rent-prize" name="rent-prize" size="10" class="form-control" />
                                </div>
                            </td>
                            <td width="13%">
                                <div class="input-group">
                                    <span class="input-group-addon">Cuartos</span>
                                    <input type="number" id="rent-room" name="rent-room" value="0"size="10" min="0"class="form-control"/>
                                </div>
                            </td>
                            <td width="15%">
                                <div class="input-group">
                                    <span class="input-group-addon">Capacidad</span>
                                    <input type="number" id="rent-capa" name="rent-capa" size="10"value="0" min="0"class="form-control" />
                                </div>
                            </td>
                            <td width="13%">
                                <div class="input-group">
                                    <span class="input-group-addon">Ba&ntilde;os</span>
                                    <input type="number" id="rent-bat" name="rent-bat" size="10"value="0" min="0"class="form-control" />
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td width="40%">
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo</span>
                                    <select id="rent-type" name="rent-type" class="form-control" >
                                        <?php
                                        $consulta = "SELECT * from cms_property_type ";
                                        $result = mysqli_query($CNN, $consulta);
                                        while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            ?>
                                            <option value='<?php echo $x['id']; ?>'><?php echo $x['name']; ?></value>
                                            <?php } ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Modo</span>
                                    <select id="rent-mode" name="rent-mode" class="form-control" >
                                        <option value="0">Gestion</option>
                                        <option value="1">Venta</option>
                                        <option value="2">Traspaso</option>
                                    </select>
                                </div>
                            </td>
                            <td colspan="3">
                                <div class="input-group">
                                    <span class="input-group-addon">Destino</span>
                                    <!--<input type="text" id="rent-ubi" name="rent-ubi"  size="200"class="form-control" />-->
                                    <select id="rent-ubi" name="rent-ubi" class="form-control" >
                                        <?php
                                        $consulta = "SELECT * from cms_property_locale ";
                                        $result = mysqli_query($CNN, $consulta);
                                        while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            ?>
                                            <option value='<?php echo $x['id']; ?>'><?php echo $x['name']; ?></value>
                                            <?php } ?>
                                    </select>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td colspan="5">
                                <div class="input-group">
                                    <span class="input-group-addon">Direccion</span>
                                    <input type="text" id="rent-address" name="rent-address"  size="200" class="form-control" />
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td colspan="5">
                                <div class="input-group">
                                    <span class="input-group-addon">Descripcion corta</span>
                                    <input type="text" id="rent-short" name="rent-short"  size="200" class="form-control" />
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td colspan="5">
                                <div class="input-group">
                                    <span class="input-group-addon">Descripcion Larga</span>
                                    <textarea type="text" id="rent-large" name="rent-large" rows="6" cols="100%" class="form-control" /></textarea>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td colspan="5">
                                <div class="input-group">
                                    <span class="input-group-addon">Metadatos&nbsp;&nbsp;</span>
                                    <textarea type="text" id="rent-meta" name="rent-meta" rows="4" cols="100%" class="form-control" /></textarea>
                                </div>
                            </td>
                            </tr>
                            <tr>
                            <td colspan="5">
                                <div class="input-group">
                                    <span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CEO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <textarea type="text" id="rent-ceo" name="rent-ceo" rows="4" cols="100%" class="form-control" /></textarea>
                                </div>
                            </td>
                            </tr>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="general">
                        <h4>General</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_general where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                ?>
                                <tr>
                                <td width="1">
                                    <input type="checkbox" id="gen_<?php echo $or["id"]; ?>" value="1" name="gen_<?php echo $or["id"]; ?>"
                                    <?php
                                    if ($or["faul"] == 1) {
                                        if ($or["required"] == 1) {
                                            ?>
                                                   checked="checked" readonly="readonly" onclick="javascript: return false;"
                                                   <?php
                                               }
                                           }
                                           ?> />
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="gen_<?php echo $or["id"]; ?>_data" name="gen_<?php echo $or["id"]; ?>_data" value="1" /> Si
                                            <input type="radio" id="gen_<?php echo $or["id"]; ?>_data" name="gen_<?php echo $or["id"]; ?>_data" checked="checked" value="0" /> No
                                            <?php
                                            break;
                                        case 1:
                                            ?>
                                            <input size="2" min="0" type="number" id="gen_<?php echo $or["id"]; ?>_data" name="gen_<?php echo $or["id"]; ?>_data" class="form-control" value="1" style="width:64px" />
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <input size="2" min="0" type="text" id="gen_<?php echo $or["id"]; ?>_data" name="gen_<?php echo $or["id"]; ?>_data" class="form-control" placeholder="texto" style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="interior">
                        <h4>Interiores</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_interior where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                ?>
                                <tr>
                                <td width="1">
                                    <input type="checkbox" id="int_<?php echo $or["id"]; ?>" value="1" name="int_<?php echo $or["id"]; ?>"
                                    <?php
                                    if ($or["faul"] == 1) {
                                        if ($or["required"] == 1) {
                                            ?>
                                                   checked="checked" readonly="readonly" onclick="javascript: return false;"
                                                   <?php
                                               }
                                           }
                                           ?>
                                           />
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="in_<?php echo $or["id"]; ?>_data" name="in_<?php echo $or["id"]; ?>_data" value="1" /> Si
                                            <input type="radio" id="in_<?php echo $or["id"]; ?>_data" name="in_<?php echo $or["id"]; ?>_data" checked="checked" value="0" /> No
                                            <?php
                                            break;
                                        case 1:
                                            ?>
                                            <input size="2" min="0" type="number" id="in_<?php echo $or["id"]; ?>_data" name="in_<?php echo $or["id"]; ?>_data" class="form-control" value="1" style="width:64px" />
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <input size="2" min="0" type="text" id="in_<?php echo $or["id"]; ?>_data" name="in_<?php echo $or["id"]; ?>_data" class="form-control" placeholder="texto" style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="exterior">
                        <h4>Exterior</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_exterior where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                ?>
                                <tr>
                                <td width="1">
                                    <input type="checkbox" id="out_<?php echo $or["id"]; ?>" value="1" name="out_<?php echo $or["id"]; ?>" 
                                         <?php
                                    if ($or["faul"] == 1) {
                                        if ($or["required"] == 1) {
                                            ?>
                                                   checked="checked" readonly="readonly" onclick="javascript: return false;"
                                                   <?php
                                               }
                                           }
                                           ?>/>
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="out_<?php echo $or["id"]; ?>_data" name="out_<?php echo $or["id"]; ?>_data" value="1" /> Si
                                            <input type="radio" id="out_<?php echo $or["id"]; ?>_data" name="out_<?php echo $or["id"]; ?>_data" checked="checked" value="0" /> No
                                            <?php
                                            break;
                                        case 1:
                                            ?>
                                            <input size="2" min="0" type="number" id="out_<?php echo $or["id"]; ?>_data" name="out_<?php echo $or["id"]; ?>_data" class="form-control" value="1" style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="extra">
                        <h4>Extra</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_extra where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                ?>
                                <tr>
                                <td width="1">
                                    <input <?php
                                    if ($or["required"] == 1) {
                                        echo " checked=\"checked\"";
                                    }
                                    ?> type="checkbox" id="avo_<?php echo $or["id"]; ?>" value="1" name="avo_<?php echo $or["id"]; ?>" <?php
                                        if ($or["faul"] == 1) {
                                            echo 'readonly="readonly"onclick="javascript: return false;"';
                                        }
                                        ?>/>
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="extra_<?php echo $or["id"]; ?>_data" name="extra_<?php echo $or["id"]; ?>_data" value="1" /> Si
                                            <input type="radio" id="extra_<?php echo $or["id"]; ?>_data" name="extra_<?php echo $or["id"]; ?>_data" checked="checked" value="0" /> No
                                            <?php
                                            break;
                                        case 1:
                                            ?>
                                            <input size="2" min="0" type="number" id="extra_<?php echo $or["id"]; ?>_data" name="extra_<?php echo $or["id"]; ?>_data" class="form-control" value="1" style="width:64px" />
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <input size="2" min="0" type="text" id="extra_<?php echo $or["id"]; ?>_data" name="extra_<?php echo $or["id"]; ?>_data" class="form-control" placeholder="texto" style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="equipamiento">
                        <h4>Equipamiento</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_equip where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                ?>
                                <tr>
                                <td width="1">
                                    <input <?php
                                    if ($or["required"] == 1) {
                                        echo " checked=\"checked\"";
                                    }
                                    ?> type="checkbox" id="equi_<?php echo $or["id"]; ?>" value="1" name="equi_<?php echo $or["id"]; ?>" <?php
                                        if ($or["faul"] == 1) {
                                            echo 'readonly="readonly"onclick="javascript: return false;"';
                                        }
                                        ?>/>
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="equi_<?php echo $or["id"]; ?>_data" name="equi_<?php echo $or["id"]; ?>_data" value="1" /> Si
                                            <input type="radio" id="equi_<?php echo $or["id"]; ?>_data" name="equi_<?php echo $or["id"]; ?>_data" checked="checked" value="0" /> No
                                            <?php
                                            break;
                                        case 1:
                                            ?>
                                            <input size="2" min="0" type="number" id="equi_<?php echo $or["id"]; ?>_data" name="equi_<?php echo $or["id"]; ?>_data" class="form-control" value="1" style="width:64px" />
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <input size="2" min="0" type="text" id="equi_<?php echo $or["id"]; ?>_data" name="equi_<?php echo $or["id"]; ?>_data" class="form-control" placeholder="texto" style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-danger">Enviar</button>
        </div>
        </form>
        <?php
        break;
    case 1:
        $errstr = "";
        $title = filter_input(INPUT_POST, "rent-title");
        $prize = filter_input(INPUT_POST, "rent-prize");
        $room = filter_input(INPUT_POST, "rent-room");
        $capacity = filter_input(INPUT_POST, "rent-capa");
        $bathroom = filter_input(INPUT_POST, "rent-bat");
        $type = filter_input(INPUT_POST, "rent-type");
        $mode = filter_input(INPUT_POST, "rent-mode");
        $place = filter_input(INPUT_POST, "rent-ubi");
        $short = filter_input(INPUT_POST, "rent-short");
        $large = filter_input(INPUT_POST, "rent-large");
        $meta = filter_input(INPUT_POST, "rent-meta");
        $address = filter_input(INPUT_POST, "rent-address");
        $ceo = filter_input(INPUT_POST, "rent-ceo");
        /* $key = array_keys($_REQUEST);
          $data = array();
          foreach ($key as $K) {
          $ex = explode("_", $K);
          if (isset($ex[1])) {
          if (!isset($data[$ex[0]])) {
          $data[$ex[0]] = array();
          }
          if (!isset($data[$ex[0]][$ex[1]])) {
          $data[$ex[0]][$ex[1]] = 0;
          }
          if (isset($ex[2])) {
          $data[$ex[0]][$ex[1]] = $_REQUEST[$K];
          }
          }
          // $data[$ex[0]][$ex[1]] = $ex[2];
          //['gen'][id] = valor;
          //['gen'][id] = valor;
          }
          echo "<pre>";
          print_r($data);
          echo "</pre>";
          $lastid = 77; */
        $insprop = mysqli_query($CNN, "INSERT INTO cms_property(title,prize,room,capacity,bathroom,tipo,modo,location,short_desc,long_desc,metadatos,seo,address)
          VALUES ('$title','$prize','$room','$capacity','$bathroom','$type','$mode','$place','$short','$large','$meta','$ceo','$address')");
        if (!$insprop) {
            ?><div class="inpupt-group" ><p><br/>Lo sentimos, ocurri&oacute; un error. <br>CODE:#0 <?php echo mysqli_error($CNN); ?></h3></div>
            <button  name="regresa" class="btn btn-danger" onclick="window.history.go(-1);
                    return false;"> Regresar </button>
                     <?php
                     $err++;
                 } else {
                     $lastid = mysqli_insert_id($CNN);
                     //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::INTERIOR :::::::::::::::::::::::::::::
                     $interior = mysqli_query($CNN, "select * from cms_property_interior where active=1");
                     $qry_int = "insert into cms_property_e_interior(pid,oid,ovalue)values";
                     while ($e = mysqli_fetch_array($interior)) {
                         if (filter_input(INPUT_POST, "int_" . $e['id']) == 1) {
                             $qry_int.="('$lastid','" . $e['id'] . "',";
                             if (filter_input(INPUT_POST, "in_" . $e['id'] . "_data") == null) {
                                 $qry_int.="NULL),";
                             } else {
                                 $qry_int.="'" . filter_input(INPUT_POST, "in_" . $e['id'] . "_data") . "'),";
                             }
                         }
                     }
                     $qry_int2 = substr($qry_int, 0, -1);
                     $qry_int2.=";";
                     $in = mysqli_query($CNN, $qry_int2);
                     if (!$in) {
                         ?>
                <div class="inpupt-group" ><p><br/>Lo sentimos, ocurri&oacute; un error. <br>CODE:#1 <?php echo mysqli_error($CNN); ?></h3></div>
                <?php
                $err++;
            }

            //:::::::::::::::::::::::::::::::EXTERIOR::::::::::::::::::::::::::::::
            $exterior = mysqli_query($CNN, "select * from cms_property_exterior where active=1");
            $qry_out = "insert into cms_property_e_exterior(pid,oid,ovalue)values";
            while ($e = mysqli_fetch_array($exterior)) {
                if (filter_input(INPUT_POST, "out_" . $e['id']) == 1) {
                    $qry_out.="('$lastid','{$e['id']}',";
                    if (filter_input(INPUT_POST, "out_" . $e['id'] . "_data") == null) {
                        $qry_out.="NULL),";
                    } else {
                        $qry_out.="'" . filter_input(INPUT_POST, "out_" . $e['id'] . "_data") . "'),";
                    }
                }
            }
            $qry_out2 = substr($qry_out, 0, -1);
            $qry_out2.=";";
            $ou = mysqli_query($CNN, $qry_out2);
            if (!$ou) {
                ?>
                <div class="inpupt-group" ><p><br/>Lo sentimos, ocurri&oacute; un error. <br>CODE:#2 <?php echo mysqli_error($CNN); ?></h3></div>
                <?php
                $err++;
            }
            //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::EXTRAS
            $extras = mysqli_query($CNN, "select * from cms_property_extra where active=1");
            $qry_ext = "insert into cms_property_e_extra(pid,oid,ovalue)values";
            while ($e = mysqli_fetch_array($extras)) {

                if (filter_input(INPUT_POST, "avo_" . $e['id']) == 1) {
                    $qry_ext.="('$lastid','{$e['id']}',";
                    if (filter_input(INPUT_POST, "extra_" . $e['id'] . "_data") == null) {
                        $qry_ext.="NULL),";
                    } else {
                        $qry_ext.="'" . filter_input(INPUT_POST, "extra_" . $e['id'] . "_data") . "'),";
                    }
                }
            }
            $qry_ext2 = substr($qry_ext, 0, -1);
            $qry_ext2.=";";
            $et = mysqli_query($CNN, $qry_ext2);
            if (!$et) {
                ?>
                <div class="inpupt-group" ><p><br/>Lo sentimos, ocurri&oacute; un error. <br>CODE:#3 <?php echo mysqli_error($CNN); ?></h3></div>
                <?php
                $err++;
            }
            //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::EQUIPAMIENTO
            $equipo = mysqli_query($CNN, "select * from cms_property_equip where active=1");
            $qry_eq = "insert into cms_property_e_equip(pid,oid,ovalue)values";
            while ($e = mysqli_fetch_array($equipo)) {
                if (filter_input(INPUT_POST, "equi_" . $e['id']) == 1) {
                    $qry_eq.="('$lastid','{$e['id']}',";
                    if (filter_input(INPUT_POST, "equi_" . $e['id'] . "_data") == null) {
                        $qry_eq.="NULL),";
                    } else {
                        $qry_eq.="'" . filter_input(INPUT_POST, "equi_" . $e['id'] . "_data") . "'),";
                    }
                }
            }
            $qry_eq2 = substr($qry_eq, 0, -1);
            $qry_eq2.=";";
            $eq = mysqli_query($CNN, $qry_eq2);
            if (!$eq) {
                ?>
                <div class="inpupt-group" ><p><br/>Lo sentimos, ocurri&oacute; un error. <br>CODE:#4 <?php echo mysqli_error($CNN); ?></h3></div>
                <?php
                $err++;
            }
            //:::::::::::::::::::::::::::::::::::::::::::::::GENERAL
            $general = mysqli_query($CNN, "select * from cms_property_general where active=1");
            $qry_g = "insert into cms_property_e_general(pid,oid,ovalue)values";
            while ($e = mysqli_fetch_array($general)) {
                if (filter_input(INPUT_POST, "gen_" . $e['id']) == 1) {
                    $qry_g.="('$lastid','{$e['id']}',";
                    if (filter_input(INPUT_POST, "gen_" . $e['id'] . "_data") == null) {
                        $qry_g.="NULL),";
                    } else {
                        $qry_g.="'" . filter_input(INPUT_POST, "gen_" . $e['id'] . "_data") . "'),";
                    }
                }
            }
            $qry_g2 = substr($qry_g, 0, -1);
            $qry_g2.=";";
            $err = 0;
            $gral = mysqli_query($CNN, $qry_g2)or $errstr.="<br/>#1 " . mysqli_error($CNN);
            if (!$gral) {
                ?>
                <div class="inpupt-group" ><p><br/>Lo sentimos, ocurri&oacute; un error. <br>CODE:#5 <?php echo mysqli_error($CNN); ?></h3></div>
                <?php
                $err++;
            }
            if ($err == 0) {
                ?>
                <h2><label class="label label-success">GUARDADO CORRECTAMENTE</label></h2>
                <?php
            } else {
                ?>
                <h2>EERROR AL GUARDAR LOS DATOS</h2>
                <button  name="regresa" class="btn btn-danger" onclick="window.history.go(-1);
                        return false;"> Regresar </button>
                         <?php
                     }
                 }

                 break;
             case 2:
                 ?>

        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                <td>ID</td>
                <td>Titulo</td>
                <td>Costo</td>
                <td>Cuartos</td>
                <td>Capacidad</td>
                <td>Tipo</td>
                <td>Modo</td>
                <td width="10%">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/property/property.table.php');
            });
        </script>
        <div class="modal fade" id="respuesta" name="respuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Respuesta</h4>
                    </div>
                    <div class="modal-body" id="content_e" name="content_e">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
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
                        <form id='from_del_hous' name='from_del_hous' method='POST' >
                            <input type="text" name="op" id="op" value="70" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="house_id" id="house_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar?:</label>
                                <div id="texto" name="texto"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="delhouse();">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 3:
        $id = $_REQUEST["id"];
        ?>
        <h2>Editar </h2>
        <form action="./?m=property&s=housing&o=4&id=<?php echo $id; ?>" method="post" class="form" enctype="multipart/form-data" >
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#informacion" aria-controls="informacion" role="tab" data-toggle="tab">Informacion</a></li>
                    <li role="presentation" class=""><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
                    <li role="presentation" class=""><a href="#interior" aria-controls="interior" role="tab" data-toggle="tab">Interior</a></li>
                    <li role="presentation" class=""><a href="#exterior" aria-controls="exterior" role="tab" data-toggle="tab">Exterior</a></li>
                    <li role="presentation" class=""><a href="#extra" aria-controls="extra" role="tab" data-toggle="tab">Extra</a></li>
                    <li role="presentation" class=""><a href="#equipamiento" aria-controls="equipamiento" role="tab" data-toggle="tab">Equipamiento</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="informacion">
                        <?php
                        $gethouse = mysqli_query($CNN, "select * from cms_property where id=$id");
                        while ($h = mysqli_fetch_array($gethouse)) {
                            ?>
                            <table class="table table-condensed">
                                <tr>
                                <td width="40%">
                                    <div class="input-group">
                                        <span class="input-group-addon">Titulo</span>
                                        <input type="text" id="rent-title" name="rent-title"value="<?php echo $h['title']; ?>" class="form-control" />
                                    </div>
                                </td>
                                <td width="19%">
                                    <div class="input-group">
                                        <span class="input-group-addon">Precio $</span>
                                        <input type="text" id="rent-prize" name="rent-prize" size="10"value="<?php echo $h['prize']; ?>" class="form-control" />
                                    </div>
                                </td>
                                <td width="13%">
                                    <div class="input-group">
                                        <span class="input-group-addon">Cuartos</span>
                                        <input type="number" id="rent-room" name="rent-room" value="<?php echo $h['room']; ?>"size="10" min="0"class="form-control"/>
                                    </div>
                                </td>
                                <td width="15%">
                                    <div class="input-group">
                                        <span class="input-group-addon">Capacidad</span>
                                        <input type="number" id="rent-capa" name="rent-capa" size="10"value="<?php echo $h['capacity']; ?>" min="0"class="form-control" />
                                    </div>
                                </td>
                                <td width="13%">
                                    <div class="input-group">
                                        <span class="input-group-addon">Ba&ntilde;os</span>
                                        <input type="number" id="rent-bat" name="rent-bat" size="10"value="<?php echo $h['bathroom']; ?>" min="0"class="form-control" />
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td width="40%">
                                    <div class="input-group">
                                        <span class="input-group-addon">Tipo</span>
                                        <select id="rent-type" name="rent-type" class="form-control" >
                                            <?php
                                            $consulta = "SELECT * from cms_property_type ";
                                            $result = mysqli_query($CNN, $consulta);
                                            while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                ?>
                                                <option value='<?php echo $x['id']; ?>' <?php
                                                if ($x['id'] == $h['tipo']) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $x['name']; ?></value>
                                                        <?php } ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">Modo</span>
                                        <select id="rent-mode" name="rent-mode" class="form-control" >
                                            <option value="0" <?php
                                            if ($h['tipo'] == 0) {
                                                echo "selected";
                                            }
                                            ?>>Gestion</option>
                                            <option value="1" <?php
                                            if ($h['tipo'] == 1) {
                                                echo "selected";
                                            }
                                            ?>>Venta</option>
                                            <option value="2" <?php
                                            if ($h['tipo'] == 2) {
                                                echo "selected";
                                            }
                                            ?>>Traspaso</option>
                                        </select>
                                    </div>
                                </td>
                                <td colspan="3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Ubicacion</span>
                                       <!-- <input type="text" id="rent-ubi" name="rent-ubi" value="<?php echo $h['location']; ?>" size="200"class="form-control" />-->
                                        <select id="rent-ubi" name="rent-ubi" class="form-control" >
                                            <?php
                                            $consulta = "SELECT * from cms_property_locale ";
                                            $result = mysqli_query($CNN, $consulta);
                                            while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                ?>
                                                <option value='<?php echo $x['id']; ?>' <?php
                                                if ($h['location'] == $x['id']) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $x['name']; ?></value>
                                                        <?php } ?>
                                        </select>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td colspan="5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Direccion</span>
                                        <input type="text" id="rent-address" name="rent-address" value="<?php echo $h['address']; ?>" size="200" class="form-control" />
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td colspan="5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Descripcion corta</span>
                                        <input type="text" id="rent-short" name="rent-short" value="<?php echo $h['short_desc']; ?>" size="200" class="form-control" />
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td colspan="5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Descripcion Larga</span>
                                        <textarea type="text" id="rent-large" name="rent-large" rows="6" cols="100%" class="form-control" /><?php echo $h['long_desc']; ?></textarea>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td colspan="5">
                                    <div class="input-group">
                                        <span class="input-group-addon">Metadatos&nbsp;&nbsp;</span>
                                        <textarea type="text" id="rent-meta" name="rent-meta" rows="4" cols="100%" class="form-control" /><?php echo $h['metadatos']; ?></textarea>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td colspan="5">
                                    <div class="input-group">
                                        <span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CEO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        <textarea type="text" id="rent-ceo" name="rent-ceo" rows="4" cols="100%" class="form-control" /><?php echo $h['seo']; ?></textarea>
                                    </div>
                                </td>
                                </tr>
                            </table>
                            <?php
                        }
                        ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="general">
                        <h4>General</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_general where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                $ggral = mysqli_query($CNN, "SELECT * from cms_property_e_general where pid=$id and oid={$or["id"]}")or die(mysqli_error($CNN));
                                $a_vo = null;
                                $val_act = "";
                                while ($g = mysqli_fetch_array($ggral)) {
                                    $a_vo = $g[2];
                                    $val_act = $g[3];
                                }
                                ?>
                                <tr>
                                <td width="1">
                                    <input type="checkbox" id="gen_<?php echo $or["id"]; ?>" value="1" name="gen_<?php echo $or["id"]; ?>"
                                    <?php
                                    if ($or["faul"] == 1) {
                                        if ($or["required"] == 1) {
                                            ?>
                                                   checked="checked" readonly="readonly" onclick="javascript: return false;"
                                                   <?php
                                               } else {
                                                   if ($a_vo != null) {
                                                       ?> checked="checked"<?php
                                                   }
                                               }
                                           }
                                           ?> />
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="gen_<?php echo $or["id"]; ?>_data" name="gen_<?php echo $or["id"]; ?>_data" value="1" <?php
                                            if ($val_act == 1) {
                                                echo 'checked="checked"';
                                            }
                                            ?>/> Si
                                            <input type="radio" id="gen_<?php echo $or["id"]; ?>_data" name="gen_<?php echo $or["id"]; ?>_data" value="0" <?php
                                            if ($val_act == 0) {
                                                echo 'checked="checked"';
                                            }
                                            ?> /> No
                                                   <?php
                                                   break;
                                               case 1:
                                                   ?>
                                            <input size="2" min="0" type="number" id="gen_<?php echo $or["id"]; ?>_data" name="gen_<?php echo $or["id"]; ?>_data" class="form-control" value="<?php echo $val_act; ?>" style="width:64px" />
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <input size="2" min="0" type="text" id="gen_<?php echo $or["id"]; ?>_data" name="gen_<?php echo $or["id"]; ?>_data" class="form-control" placeholder="texto" value="<?php echo $val_act; ?>" style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="interior">
                        <h4>Interiores</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_interior where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                $ggral = mysqli_query($CNN, "SELECT * from cms_property_e_interior where pid=$id and oid={$or["id"]}")or die(mysqli_error($CNN));
                                $a_vo = null;
                                $val_act = "";
                                while ($g = mysqli_fetch_array($ggral)) {
                                    $a_vo = $g[2];
                                    $val_act = $g[3];
                                }
                                ?>
                                <tr>
                                <td width="1">
                                    <input type="checkbox" id="int_<?php echo $or["id"]; ?>" value="1" name="int_<?php echo $or["id"]; ?>"
                                    <?php
                                    if ($or["faul"] == 1) {
                                        if ($or["required"] == 1) {
                                            ?>
                                                   checked="checked" readonly="readonly" onclick="javascript: return false;"
                                                   <?php
                                               } else {
                                                   if ($a_vo != null) {
                                                       ?> checked="checked"<?php
                                                   }
                                               }
                                           }
                                           ?>
                                           />
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="int_<?php echo $or["id"]; ?>_data" name="int_<?php echo $or["id"]; ?>_data" value="1" <?php
                                            if ($val_act == 1) {
                                                echo 'checked="checked"';
                                            }
                                            ?> /> Si
                                            <input type="radio" id="int_<?php echo $or["id"]; ?>_data" name="int_<?php echo $or["id"]; ?>_data" value="0" <?php
                                            if ($val_act == 0) {
                                                echo 'checked="checked"';
                                            }
                                            ?> /> No
                                                   <?php
                                                   break;
                                               case 1:
                                                   ?>
                                            <input size="2" min="0" type="number" id="int_<?php echo $or["id"]; ?>_data" name="int_<?php echo $or["id"]; ?>_data" class="form-control" value="<?php echo $val_act; ?>" style="width:64px" />
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <input size="2" min="0" type="text" id="int_<?php echo $or["id"]; ?>_data" name="int_<?php echo $or["id"]; ?>_data" class="form-control" placeholder="texto"value="<?php echo $val_act; ?>" style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="exterior">
                        <h4>Exterior</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_exterior where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                $ggral = mysqli_query($CNN, "SELECT * from cms_property_e_exterior where pid=$id and oid={$or["id"]}")or die(mysqli_error($CNN));
                                $a_vo = null;
                                $val_act = "";
                                while ($g = mysqli_fetch_array($ggral)) {
                                    $a_vo = $g[2];
                                    $val_act = $g[3];
                                }
                                ?>
                                <tr>
                                <td width="1">
                                    <input type="checkbox" id="out_<?php echo $or["id"]; ?>" value="1" name="out_<?php echo $or["id"]; ?>"
                                    <?php
                                    if ($or["faul"] == 1) {
                                        if ($or["required"] == 1) {
                                            ?>
                                                   checked="checked" readonly="readonly" onclick="javascript: return false;"
                                                   <?php
                                               } else {
                                                   if ($a_vo != null) {
                                                       ?> checked="checked"<?php
                                                   }
                                               }
                                           }
                                           ?>
                                           />
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="out_<?php echo $or["id"]; ?>_data" name="out_<?php echo $or["id"]; ?>_data" value="1" <?php
                                            if ($val_act == 1) {
                                                echo 'checked="checked"';
                                            }
                                            ?> /> Si
                                            <input type="radio" id="out_<?php echo $or["id"]; ?>_data" name="out_<?php echo $or["id"]; ?>_data" value="0" <?php
                                            if ($val_act == 0) {
                                                echo 'checked="checked"';
                                            }
                                            ?>/> No
                                                   <?php
                                                   break;
                                               case 1:
                                                   ?>
                                            <input size="2" min="0" type="number" id="out_<?php echo $or["id"]; ?>_data" name="out_<?php echo $or["id"]; ?>_data" class="form-control" value="<?php echo $val_act; ?>" style="width:64px" />
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <input size="2" min="0" type="text" id="out_<?php echo $or["id"]; ?>_data" name="out_<?php echo $or["id"]; ?>_data" class="form-control" placeholder="texto"value="<?php echo $val_act; ?>" style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="extra">
                        <h4>Extra</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_extra where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                $ggral = mysqli_query($CNN, "SELECT * from cms_property_e_extra where pid=$id and oid={$or["id"]}")or die(mysqli_error($CNN));
                                $a_vo = null;
                                $val_act = "";
                                while ($g = mysqli_fetch_array($ggral)) {
                                    $a_vo = $g[2];
                                    $val_act = $g[3];
                                }
                                ?>
                                <tr>
                                <td width="1">
                                    <input type="checkbox" id="extra_<?php echo $or["id"]; ?>" value="1" name="extra_<?php echo $or["id"]; ?>"
                                    <?php
                                    if ($or["faul"] == 1) {
                                        if ($or["required"] == 1) {
                                            ?>
                                                   checked="checked" readonly="readonly" onclick="javascript: return false;"
                                                   <?php
                                               } else {
                                                   if ($a_vo != null) {
                                                       ?> checked="checked"<?php
                                                   }
                                               }
                                           }
                                           ?>
                                           />
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="extra_<?php echo $or["id"]; ?>_data" name="extra_<?php echo $or["id"]; ?>_data" value="1" <?php
                                            if ($val_act == 1) {
                                                echo 'checked="checked"';
                                            }
                                            ?>/> Si
                                            <input type="radio" id="extra_<?php echo $or["id"]; ?>_data" name="extra_<?php echo $or["id"]; ?>_data" value="0" <?php
                                            if ($val_act == 0) {
                                                echo 'checked="checked"';
                                            }
                                            ?>/> No
                                                   <?php
                                                   break;
                                               case 1:
                                                   ?>
                                            <input size="2" min="0" type="number" id="extra_<?php echo $or["id"]; ?>_data" name="extra_<?php echo $or["id"]; ?>_data" class="form-control" value="<?php echo $val_act; ?>"  style="width:64px" />
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <input size="2" min="0" type="text" id="extra_<?php echo $or["id"]; ?>_data" name="extra_<?php echo $or["id"]; ?>_data" class="form-control" value="<?php echo $val_act; ?>" placeholder="texto" style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="equipamiento">
                        <h4>Equipamiento</h4>
                        <table class="table table-condensed">
                            <?php
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_equip where active=1");
                            while ($or = mysqli_fetch_array($oq)) {
                                $ggral = mysqli_query($CNN, "SELECT * from cms_property_e_equip where pid=$id and oid={$or["id"]}")or die(mysqli_error($CNN));
                                $a_vo = null;
                                $val_act = "";
                                while ($g = mysqli_fetch_array($ggral)) {
                                    $a_vo = $g[2];
                                    $val_act = $g[3];
                                }
                                ?>
                                <tr>
                                <td width="1">
                                    <input type="checkbox" id="equi_<?php echo $or["id"]; ?>" value="1" name="equi_<?php echo $or["id"]; ?>"
                                    <?php
                                    if ($or["faul"] == 1) {
                                        if ($or["required"] == 1) {
                                            ?>
                                                   checked="checked" readonly="readonly" onclick="javascript: return false;"
                                                   <?php
                                               } else {
                                                   if ($a_vo != null) {
                                                       ?> checked="checked"<?php
                                                   }
                                               }
                                           }
                                           ?>
                                           />
                                </td>
                                <td><?php echo $or["name"]; ?></td>
                                <td>
                                    <?php
                                    switch ($or["tipo"]) {
                                        case 0:
                                            ?>
                                            <input type="radio" id="equi_<?php echo $or["id"]; ?>_data" name="equi_<?php echo $or["id"]; ?>_data" value="1"  <?php
                                            if ($val_act == 1) {
                                                echo 'checked="checked"';
                                            }
                                            ?> /> Si
                                            <input type="radio" id="equi_<?php echo $or["id"]; ?>_data" name="equi_<?php echo $or["id"]; ?>_data" value="0"   <?php
                                            if ($val_act == 0) {
                                                echo 'checked="checked"';
                                            }
                                            ?>/> No
                                                   <?php
                                                   break;
                                               case 1:
                                                   ?>
                                            <input size="2" min="0" type="number" id="equi_<?php echo $or["id"]; ?>_data" name="equi_<?php echo $or["id"]; ?>_data" class="form-control" value="<?php echo $val_act; ?>" style="width:64px" />
                                            <?php
                                            break;
                                        case 2:
                                            ?>
                                            <input size="2" type="text" id="equi_<?php echo $or["id"]; ?>_data" name="equi_<?php echo $or["id"]; ?>_data" class="form-control" placeholder="texto" value="<?php echo $val_act; ?>"style="width:64px" />
                                            <?php
                                            break;
                                    }
                                    ?>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-danger">Guardar</button>
        </div>
        </form>

        <?php
        break;
    case 4: //:::::::::::::::::::::::GUARDA ACTUALIZACION
        $title = filter_input(INPUT_POST, "rent-title");
        $prize = filter_input(INPUT_POST, "rent-prize");
        $room = filter_input(INPUT_POST, "rent-room");
        $capacity = filter_input(INPUT_POST, "rent-capa");
        $bathroom = filter_input(INPUT_POST, "rent-bat");
        $type = filter_input(INPUT_POST, "rent-type");
        $mode = filter_input(INPUT_POST, "rent-mode");
        $place = filter_input(INPUT_POST, "rent-ubi");
        $short = filter_input(INPUT_POST, "rent-short");
        $large = filter_input(INPUT_POST, "rent-large");
        $id = $_REQUEST['id'];
        $err = 0;
        $texerror = "";
        $updaprop = mysqli_query($CNN, "UPDATE cms_property SET title = '$title',  prize = '$prize', room= '$room', capacity = '$capacity',  tipo = '$type',  modo = '$mode',  location = '$place',  short_desc = '$short',  long_desc = '$large',  bathroom = '$bathroom' WHERE id = '$id'")or $texerror.="<br/>#0 " . mysqli_error($CNN);
        ;
        $errores = 0;
        if (!$updaprop) {
            $err++;
        }
        $coleccion = array("general", "interior", "exterior", "extra", "equip");
        $dp = array("gen_", "int_", "out_", "extra_", "equi_");
        for ($u = 0; $u <= 4; $u++) {
            $actcamp = "";
            $eqry = null;
            $getarr = mysqli_query($CNN, "select * from cms_property_{$coleccion[$u]} where active=1")or $texerror.="<br/>#1 " . mysqli_error($CNN);
            ;
            while ($c = mysqli_fetch_array($getarr)) {
                $traec = mysqli_query($CNN, "SELECT* FROM cms_property_e_{$coleccion[$u]} where pid=$id and oid={$c['id']}")or $texerror.="<br/>#2 " . mysqli_error($CNN);
                ;
                $nocamp = mysqli_num_rows($traec);
                if ($nocamp == 1) {
                    if (filter_input(INPUT_POST, $dp[$u] . $c["id"]) != null) {
                        $vins = filter_input(INPUT_POST, $dp[$u] . $c["id"] . "_data");
                        if ($vins == null) {
                            $vins = 'NULL';
                        }
                        $actcamp = "update cms_property_e_{$coleccion[$u]} set ovalue='$vins' where oid={$c['id']} and pid=$id;";
                    } else {
                        $actcamp = "delete from cms_property_e_{$coleccion[$u]} where oid={$c['id']} and pid=$id;";
                    }
                } else {
                    $vins = filter_input(INPUT_POST, $dp[$u] . $c["id"] . "_data");
                    if ($vins == null) {
                        $vins = 'NULL';
                    }
                    $actcamp = "insert into cms_property_e_" . $coleccion[$u] . "(pid,oid,ovalue) values('$id','{$c['id']}','$vins');";
                }
                $eqry = mysqli_multi_query($CNN, $actcamp)or $texerror.="<br/>#3 " . mysqli_error($CNN);
                if (!$eqry) {
                    $err++;
                }
            }
        }
        if ($err == 0) {
            ?>
            <h2> <label class="label label-primary"><li class="fa fa-arrow-circle-o-right"> PROPIEDAD GUARDADA CON &Eacute;XITO</li></label></h2>
            <?php
        } else {
            ?>
            <h2> <label class=""><li class="fa fa-arrow-right"> Error al Guardar<?php echo $texerror; ?></li></label></h2>
            <button  name="regresa" class="btn btn-danger" onclick="window.history.go(-1);
                    return false;"> Regresar </button>
                     <?php
                 }


                 break;

             case 7:
                 if (isset($_REQUEST["id"])) {
                     $id = $_REQUEST["id"];
                     ?><i class="fa fa-picture-o"></i><label>Galer&iacute;a</label><br><?php
                     $traedatos=mysqli_query($CNN,"SELECT p.*,b.name as dest FROM cms_property p INNER JOIN cms_property_locale b ON (p.location=b.`id`) WHERE p.id=$id");
                     while($h=  mysqli_fetch_array($traedatos))
                     {
                         echo $h['title']."->$".$h['prize']."->".$h['address']."->".$h['dest'];
                     }

                 } else {
                     $id = 0;
                 }
                 
                         ?>
            
        
        <div id="frmPost" class="dropzone"></div>        
        <script>
            var dz = $("#frmPost").dropzone({
                url: "content/upload/property/upload.inc.php?id=<?php echo $id; ?>",
                complete: function (file) {
                    console.log(file);
                    $.ajax({
                        method: "POST",
                        url: "include/modules/property/gallery.ajax.php",
                        data: {"id": "<?php echo $id; ?>"}
                    }).done(function (data) {
                        $("#gallery_show").html(data);
                    });

                }
            });
            $(document).ready(function () {
                $.ajax({
                    method: "POST",
                    url: "include/modules/property/gallery.ajax.php",
                    data: {"id": "<?php echo $id; ?>"}
                }).done(function (data) {
                    $("#gallery_show").html(data);
                });
            });
        </script>
        <div id="gallery_show" name="gallery_show"></div>
                <!---------------------------------------------DIV MODIFICALE(content_e) para las respuestas de las acciones(editar o eliminar)------------------->
        <div class="modal fade" id="respuesta" name="respuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Respuesta</h4>
                    </div>
                    <div class="modal-body" id="content_e" name="content_e">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="recarga();" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------TERMINA DIV DE RESPUESTAS ------------------->
        <!---------------------------------------------------------------Div con la estructura para mensaje de eliminar el item------------------->
        <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' >
                            <input type="text" name="op" id="op" value="80" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="elim_id" id="elim_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                             <input type="text" value="<?php echo $id; ?>"name="prop_id" id="prop_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar la imagen no?:</label>
                                <div id="tit" name="tit"><div>
                            </div>
                            <input type="text" name="el_id" class="form-control" id="el_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="eliminaitem();">Aceptar</button> 
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
}
