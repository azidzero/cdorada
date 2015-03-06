<?php
switch ($o) {
    case 0:
        ?>
        <form action="./?m=warehouse&s=store&o=1" method="post">
            <strong>Detalles de almac&eacute;n</strong>
            <div class="row-fluid">
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon">Nombre:</span>
                        <input class="form-control"  type="text" id="name" name="name" />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon">Tipo de Ubicaci&oacute;n:</span>
                        <select id="mode" name="mode" class="form-control" onchange="chkMode()">
                            <option value="0">Matriz</option>
                            <option value="1">Sucursal</option>
                            <option value="2">Almac&eacute;n</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon">Matriz</span>                                
                        <select id="matriz" name="matriz" class="form-control" disabled="disabled">
                            <option value="0">Ninguna</option>
                            <?php
                            $sq = mysqli_query($this->C->CNN, "select * from warehouse_store where mode=0") or die(mysqli_error($this->C->CNN));

                            while ($sr = mysqli_fetch_array($sq)) {
                                ?>
                                <option value="<?php echo $sr[0]; ?>"><?php echo $sr[1]; ?></option>
                                <?php
                            }
                            ?>
                        </select>                                
                    </div>
                    <span class="label label-danger"><small><i class="fa fa-warning-sign"></i> Solo si eligi&oacute; Sucursal o Almac&eacute;n</small></span>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon">Lista de Precios.</span>
                        <select class="form-control" id="plist" name="plist">
                            <option value="1">Lista 1</option>
                            <option value="2">Lista 2</option>
                            <option value="3">Lista 3</option>
                            <option value="4">Lista 4</option>
                            <option value="5">Lista 5</option>
                            <option value="6">Lista 6</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon">Calle:</span>
                        <input class="form-control" type="text" id="street" name="street"  />
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group">
                        <span class="input-group-addon">No. Exterior:</span>
                        <input class="form-control"  type="text" id="noe" name="noe"  />
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group">
                        <span class="input-group-addon">No. Interior:</span>
                        <input class="form-control"  type="text" id="noi" name="noi"  />
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon">Colonia:</span>
                        <input class="form-control"  type="text" id="colony" name="colony"  />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group input-append">
                            <span class="input-group-addon">Estado:</span>
                            <select id="estado" name="estado" class="form-control">
                                <?php
                                $sq = mysqli_query($this->C->CNN, "select * from core_geo_state");
                                while ($sr = mysqli_fetch_array($sq)) {
                                    ?>
                                    <option value="<?php echo $sr[1]; ?>"><?php echo utf8_encode($sr[2]); ?></option>
                                    <?php
                                }
                                ?>
                            </select><span class="input-group-addon">
                                <a href="javascript:void(0)" onclick="getCity('estado', 'sel_city')"><i class="fa fa-search"></i></a>
                            </span>
                        </div>
                </div>
                <div class="col-sm-4"><div id="sel_city" class="input-group"><strong>Ciudad:</strong> Seleccionar primero un estado</div></div>
            </div>
            <div class="row-fluid">
                <div class="col-sm-4">
                    <div class="input-group">
                            <span class="input-group-addon">C&oacute;digo Postal:</span>
                            <input class="form-control"  type="text" id="cp" name="cp" />
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                            <span class="input-group-addon">Correo Electr&oacute;nico:</span>
                            <input class="form-control"  type="text" id="email" name="email" />
                        </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                            <span class="input-group-addon">Tel&eacute;fono:</span>
                            <input class="form-control" type="text" id="phone" name="phone"  />
                        </div>
                </div>
            </div>          
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Crear Almac&eacute;n <i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
        <script>
            function chkMode() {
                var a = $('#mode').val();
                if (a > 0) {
                    $('#matriz').removeAttr('disabled');
                } else {
                    $('#matriz').val("0");
                    $('#matriz').attr('disabled', 'disabled');
                }
            }
        </script>
        <?php
        break;
    case 1:
        if (isset($_REQUEST["doInvoice"])) {
            $inv = 1;
        } else {
            $inv = 0;
        }
        $owner = $_SESSION["CORE"]["corp"]["id"];
        $cnt = strlen($_REQUEST["serie"]);
        if ($cnt > 0 && $cnt <= 2) {
            $sql = "insert into warehouse_store(name,street,noi,noe,colony,phone,email,estado,ciudad,cp,serie,mode,owner,p_list,doInvoice) VALUES(";
            $sql .= "'{$_REQUEST["name"]}',";
            $sql .= "'{$_REQUEST["street"]}',";
            $sql .= "'{$_REQUEST["noi"]}',";
            $sql .= "'{$_REQUEST["noe"]}',";
            $sql .= "'{$_REQUEST["colony"]}',";
            $sql .= "'{$_REQUEST["phone"]}',";
            $sql .= "'{$_REQUEST["email"]}',";
            $sql .= "'{$_REQUEST["estado"]}',";
            $sql .= "'{$_REQUEST["city"]}',";
            $sql .= "'{$_REQUEST["cp"]}',";
            $sql .= "'{$_REQUEST["serie"]}',";
            $sql .= "'{$_REQUEST["mode"]}',";
            $sql .= "'$owner',";
            $sql .= "'{$_REQUEST["plist"]}',";
            $sql .= "'$inv')";
            $q = mysqli_query($sql) or $e = mysqli_error();
            if (!isset($e)) {
                ?>
                <div class="alert alert-success">
                    <h4>Se a Agregado el Almac&eacute;n <b><?php echo $_REQUEST["name"]; ?></b> en el Sistema</h4>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger">
                    <h4>Ha ocurrido un error!!!</h4>
                    <p><?php echo $e; ?></p>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>ERROR:</h4>
                <p>La serie para este almac&eacute;n debe ser uno o dos caracteres</p>
                <a class="btn btn-danger" href="#" onclick="window.history.back()"><i class="fa fa-backward"></i> Regresar</a>
            </div>
            <?php
        }
        ?>
        <div class="well well-sm">
            <a class="btn btn-default" href="./?m=warehouse&s=store&o=0"> Agregar Nuevo</a>
            <a class="btn btn-default" href="./?m=warehouse&s=store&o=2"> Ir a la administraci&oacute;n</a>
        </div>
        <?php
        break;
    case 2:
        ?>
        <table id="tbl_admin" class="table table-condensed table-bordered table-striped">
            <thead>
                <tr>
                    <td width="1">No.</td>
                    <td>Nombre</td>
                    <td>Direcci&oacute;n</td>
                    <td>Estado</td>
                    <td>Ciudad</td>
                    <td width="1">Tel&eacute;fono</td>
                    <td>Correo Electr&oacute;nico</td>                    
                    <td width="1">Serie</td>
                    <td width="1">Tipo</td>
                    <td width="128"><i class="fa fa-th-list"></i></td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function () {
                jTable("tbl_admin", "include/modules/warehouse/store.table.php");
            });
        </script>
        <?php
        break;
    case 3:
        $id = $_REQUEST["id"];
        $q = mysqli_query("select * from warehouse_store where id=$id") or die(mysqli_error());
        while ($r = mysqli_fetch_array($q)) {
            ?>
            <form action="./?m=warehouse&s=store&o=4" method="post">
                <input id="id" name="id" value="<?php echo $id; ?>" type="hidden" />
                <table <?php echo TBLcss; ?>>
                    <tr class="info">                    
                        <td colspan="2"><strong>Detalles de almac&eacute;n</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Nombre:</span>
                                <input class="form-control"  type="text" id="name" name="name" value="<?php echo $r["name"]; ?>" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Tipo de Ubicaci&oacute;n:</span>
                                <select id="mode" name="mode" class="form-control" onchange="chkMode()">
                                    <?php
                                    if ($r['mode'] == 0) {
                                        echo "<option selected=\"selected\" value=\"0\">Matriz</option>";
                                    } else {
                                        echo "<option value=\"0\">Matriz</option>";
                                    }
                                    if ($r['mode'] == 1) {
                                        echo "<option selected=\"selected\" value=\"1\">Sucursal</option>";
                                    } else {
                                        echo "<option value=\"1\">Sucursal</option>";
                                    }
                                    if ($r['mode'] == 2) {
                                        echo "<option selected=\"selected\" value=\"2\">Almacen</option>";
                                    } else {
                                        echo "<option value=\"2\">Almacen</option>";
                                    }
                                    ?>                                    
                                </select>
                            </div>
                        </td>                                          
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Matriz</span>                                
                                <select id="matriz" name="matriz" class="form-control" <?php
                                if ($r['owner'] == "0") {
                                    echo "disabled=\"disabled\"";
                                }
                                ?> >
                                    <option value="0">Ninguna</option>
                                    <?php
                                    $sq = mysqli_query("select * from warehouse_store where mode=0");
                                    while ($sr = mysqli_fetch_array($sq)) {
                                        ?>
                                        <option <?php
                                        if ($r['owner'] == $sr[0]) {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> value="<?php echo $sr[0]; ?>"><?php echo $sr[1]; ?></option>
                                            <?php
                                        }
                                        ?>
                                </select>    
                                <span class="input-group-addon"><small><i class="fa fa-warning-sign"></i> Solo si eligi&oacute; Sucursal o Almac&eacute;n</small></span>
                            </div>
                        </td>
                        <td class="alert-danger">                            
                            <div class="input-group input-append">
                                <span class="input-group-addon">Serie:</span>
                                <input class="form-control" maxlength="3" type="text" id="serie" name="serie" value="<?php echo $r['serie']; ?>" />                                
                            </div>
                            <span class="label label-danger"><small><i class="fa fa-warning-sign"></i> Para Facturaci&oacute;n</small></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Lista de Precios.</span>
                                <select class="form-control" id="plist" name="plist">
                                    <option <?php
                                    if ($r["p_list"] == "1") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> value="1">Lista 1</option>
                                    <option <?php
                                    if ($r["p_list"] == "2") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> value="2">Lista 2</option>
                                    <option <?php
                                    if ($r["p_list"] == "3") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> value="3">Lista 3</option>
                                    <option <?php
                                    if ($r["p_list"] == "4") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> value="4">Lista 4</option>
                                    <option <?php
                                    if ($r["p_list"] == "5") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> value="5">Lista 5</option>
                                    <option <?php
                                    if ($r["p_list"] == "6") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> value="6">Lista 6</option>
                                </select>
                            </div>
                        </td>
                        <td><div class="input-group">
                                <span class="input-group-addon"><input type="checkbox" id="doInvoice" name="doInvoice" value="1" <?php
                                    if ($r['doInvoice'] == '1') {
                                        echo "checked=\"checked\"";
                                    }
                                    ?> /></span>
                                <span class="input-group-addon">Se Generan Facturas desde esta ubicaci&oacute;n</span>
                            </div>
                        </td>
                    </tr>
                    <tr class="info">
                        <td colspan="2"><strong>Ubicaci&oacute;n del almac&eacute;n</strong></td>
                    </tr>
                    <tr>
                        <td class="alert-danger">
                            <div class="input-group">
                                <span class="input-group-addon">Calle:</span>
                                <input class="form-control"  type="text" id="street" name="street" value="<?php echo $r['street']; ?>" />
                            </div>
                        </td>
                        <td class="alert-danger">
                            <div class="input-group">
                                <span class="input-group-addon">No. Exterior:</span>
                                <input class="form-control"  type="text" id="noe" name="noe" value="<?php echo $r['noe']; ?>" />
                            </div>
                        </td>                        
                    </tr>
                    <tr>
                        <td class="alert-danger">
                            <div class="input-group">
                                <span class="input-group-addon">No. Interior:</span>
                                <input class="form-control"  type="text" id="noi" name="noi" value="<?php echo $r['noe']; ?>" />
                            </div>
                        </td>
                        <td class="alert-danger">
                            <div class="input-group">
                                <span class="input-group-addon">Colonia:</span>
                                <input class="form-control"  type="text" id="colony" name="colony" value="<?php echo $r['colony']; ?>" />
                            </div>
                        </td
                    </tr>
                    <tr>
                        <td class="alert-danger">
                            <div class="input-group">
                                <span class="input-group-addon">Estado:</span>
                                <select id="estado" name="estado" class="form-control">
                                    <?php
                                    $sq = mysqli_query("select * from core_geo_state");
                                    while ($sr = mysqli_fetch_array($sq)) {
                                        ?>
                                        <option <?php
                                        if ($r['estado'] == $sr[1]) {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> value="<?php echo $sr[1]; ?>"><?php echo utf8_encode($sr[2]); ?></option>
                                            <?php
                                        }
                                        ?>
                                </select>
                                <a class="input-group-addon" href="javascript:void(0)" onclick="getCity('estado', 'sel_city')"><i class="fa fa-search"></i></a>
                            </div>
                        </td>
                        <td class="alert-danger">
                            <div class="input-group" id="sel_city">Seleccionar primero un estado</div>                            
                        </td>
                    </tr>
                    <tr>
                        <td class="alert-danger">
                            <div class="input-group">
                                <span class="input-group-addon">C&oacute;digo Postal:</span>
                                <input class="form-control"  type="text" id="cp" name="cp" value="<?php echo $r['cp']; ?>" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Correo Electr&oacute;nico:</span>
                                <input class="form-control"  type="text" id="email" name="email" value="<?php echo $r['email']; ?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Tel&eacute;fono:</span>
                                <input class="form-control" type="text" id="phone" name="phone" value="<?php echo $r['phone']; ?>" />
                            </div>
                        </td>
                    </tr>
                </table>
                <div>
                    <span class="label label-danger"><strong>Obligatorio para el Sistema de Facturaci&oacute;n</strong></span>
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-default">Actualizar Almac&eacute;n <i class="fa fa-chevron-right"></i></button>
                </div>
            </form>
            <script>
                function chkMode() {
                    var a = $('#mode').val();
                    if (a > 0) {
                        $('#matriz').removeAttr('disabled');
                    } else {
                        $('#matriz').val("0");
                        $('#matriz').attr('disabled', 'disabled');
                    }
                }
                $(document).ready(function () {
                    getCity('estado', 'sel_city', '<?php echo $r['ciudad']; ?>');
                });
            </script>
            <?php
        }
        break;
    case 4:

        $sql = "UPDATE warehouse_store SET ";
        $sql.= "name='{$_REQUEST["name"]}'";
        $sql.= ",street='{$_REQUEST["street"]}'";
        $sql.= ",noi='{$_REQUEST["noi"]}'";
        $sql.= ",noe='{$_REQUEST["noe"]}'";
        $sql.= ",colony='{$_REQUEST["colony"]}'";
        $sql.= ",phone='{$_REQUEST["phone"]}'";
        $sql.= ",email='{$_REQUEST["email"]}'";
        $sql.= ",estado='{$_REQUEST["estado"]}'";
        $sql.= ",ciudad='{$_REQUEST["city"]}'";
        $sql.= ",cp='{$_REQUEST["cp"]}'";
        $sql.= ",serie='{$_REQUEST["serie"]}'";
        $sql.= ",mode='{$_REQUEST["mode"]}'";
        $sql.= ",owner='{$_REQUEST["matriz"]}'";
        $sql.= ",p_list='{$_REQUEST["plist"]}'";
        if (isset($_REQUEST["doInvoice"])) {
            $sql.= ",doInvoice='1'";
        } else {
            $sql.= ",doInvoice='0'";
        }
        $sql.= " WHERE id={$_REQUEST["id"]}";

        mysqli_query($sql) or $e = mysqli_error();
        if (!isset($e)) {
            ?>
            <div class="alert alert-success">
                <h4>Se a actualizado el Almacen</h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>Ha ocurrido un error al tratar de actualizado el Almacen</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="well well-sm">
            <div class=" btn-group">
                <a class="btn btn-default" href="./?m=warehouse&s=store&o=2"><i class="fa fa-chevron-left"></i> Regresar</a>
                <a class="btn btn-default" href="./?m=warehouse&s=store&o=0">Nuevo <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        <?php
        break;
    case 5:
        $id = $_REQUEST["id"];
        ?>
        <form action="./?m=warehouse&s=store&o=matriz&o=6" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
            <div class="alert alert-danger">
                <h4>Estas a punto de eliminar esta Oficina Matriz</h4>
                <p>Esta accion no se puede deshacer, esta seguro de continuar?</p>
                <div class="input-group">
                    <span class="input-group-addon">Mover los productos al siguiente almacen</span>
                    <select id="store_to" name="store_to" class="form-control">
                        <?php
                        $sq = mysqli_query("SELECT * from warehouse_store");
                        while ($sr = mysqli_fetch_array($sq)) {
                            echo "<option value=\"{$sr[0]}\">{$sr[1]}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="well well-sm">
                <div class="btn-group">
                    <a class="btn btn-default" href="./?m=warehouse&s=store&o=2"><i class="fa fa-chevron-left"></i> Regresar</a>
                    <button type="submit" class="btn btn-default">Continuar <i class="fa fa-chevron-right"></i></button>
                </div>
            </div>
        </form>
        <?php
        break;
    case 6:
        $id = $_REQUEST["id"];
        $sto = $_REQUEST["store_to"];
        $sq = mysqli_query("SELECT * from warehouse_product WHERE store like '%$id%'");
        $sn = mysqli_num_rows($sq);
        while ($sr = mysqli_fetch_array($sq)) {
            if (strstr($sr['store'], ",") != "") {
                $os = explode(",", $sr["store"]);
                $us = explode(",", $sr["store"]);
                for ($i = 0; $i < count($os); $i++) {
                    $store[$os[$i]] += $us[$i];
                }
            } else {
                $store[$sr["store"]] += $sr["units"];
            }
            $store[$sto]+=$store[$id];
            unset($store[$id]);
            $res_sto = implode(",", array_keys($store));
            $res_uni = implode(",", $store);
            mysqli_query("UPDATE warehouse_product SET store='$res_sto',units='$res_uni' WHERE id={$sr[0]}") or $e = mysqli_error();
        }
        mysqli_query("delete from warehouse_store where id=$id") or $e = mysqli_error();
        if ($e == "") {
            ?>
            <div class="alert alert-success">
                <h4>Se a eliminado la oficina matriz</h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>Ha ocurrido un error al tratar de eliminar la oficina matriz</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="well well-sm">
            <div class=" btn-group">
                <a class="btn btn-default" href="./?m=warehouse&s=store&o=2"><i class="fa fa-chevron-left"></i> Regresar</a>
                <a class="btn btn-default" href="./?m=warehouse&s=store&o=0">Nuevo <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        <?php
        break;
}