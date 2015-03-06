<?php
if (isset($_REQUEST["o"])) {
    $o = $_REQUEST['o'];
} else {
    $o = 0;
}
switch ($o) {
    case 0:
        ?>
        <form action="./?m=warehouse&s=move&o=1" method="post">
            <div class="tabbable" style="background:rgba(255,255,255,0.75);border-radius:4px;">
                <ul class="nav nav-tabs">                    
                    <li class="active"><a href="#productos" data-toggle="tab">Productos</a></li>
                    <li><a href="#informacion" data-toggle="tab">Informaci&oacute;n</a></li>
                </ul>
                <div class="tab-content">                        
                    <div id="productos" class="tab-pane active">
                        <table <?php echo TBLcss; ?>>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">Origen</span>
                                        <select id="store_frm" name="store_frm" class="form-control" onchange="$('#sp').autocomplete('option', 'source', 'include/modules/warehouse/move.store.php?m=0&store=' + $(this).val())">
                                            <?php
                                            $sq = mysql_query("select * from warehouse_store");
                                            while ($sr = mysql_fetch_array($sq)) {
                                                echo "<option value=\"{$sr[0]}\">{$sr[1]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>                 
                                    <div class="input-group">                            
                                        <span class="input-group-addon">Producto</span>
                                        <input type="text" id="sp" name="sp" class="form-control" />
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    </div>
                                </td>                                
                                <td><input type="hidden" id="pid" name="pid" value="0" />
                                    <input type="hidden" id="pcode" name="pcode" value="0" />
                                    <div style="background-color:#FFF;font-size: 8pt;font-weight: bold;">
                                        <div id="pselected" class="input-group">                                            
                                            <span id="pname" class="input-group-addon">No se a elegido producto</span>                                           
                                            <a href="#" id="btnReset" class="input-group-addon btn" onclick="resetSelected()"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>                                    
                                </td>
                                <td><div id="store_out" class="well well-small" style="display:none;">Seleccione un producto</div></td>
                                <td>
                                    <button onclick="addMove()" type="button" class="btn btn-danger btn-sm"><i class="fa fa-plus-square"></i> Agregar Producto a la lista</button>
                                </td>
                            </tr>                            
                        </table>
                        <table id="tbl" <?php echo TBLcss; ?>>
                            <thead>
                                <tr>
                                    <td colspan="5" class="text-info"><strong>Productos que ser&aacute;n movidos</strong></td>
                                    <td width="1" rowspan="2"><i class="fa fa-list-alt"></i></td>
                                </tr>
                                <tr>
                                    <td width="1">ID</td>
                                    <td>Origen</td>
                                    <td>C&oacute;digo</td>
                                    <td>Producto</td>
                                    <td width="1">Cantidad</td>                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>                        
                    </div>
                    <div id="informacion" class="tab-pane" style="font-size: 9pt;">
                        <table <?php echo TBLcss; ?>>
                            <tr>
                                <td><div class="input-group">
                                        <span class="input-group-addon">Destino: </span>
                                        <select name="store_to" id="store_to" class="form-control">
                                            <?php
                                            $sq = mysql_query("select * from warehouse_store");
                                            while ($sr = mysql_fetch_array($sq)) {
                                                echo "<option value=\"{$sr[0]}\">{$sr[1]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td><div class="input-group">
                                        <span class="input-group-addon">Fecha:</span>
                                        <input name="date_out" id="date_out" type="text" class="form-control" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="input-group">
                                        <span class="input-group-addon">Env&iacute;a:</span>
                                        <select id="send" name="send" class="form-control">
                                            <?php
                                            $sq = mysql_query("select * from core_user");
                                            while ($sr = mysql_fetch_array($sq)) {
                                                echo "<option value=\"{$sr[0]}\">{$sr[5]} {$sr[6]} {$sr[7]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td><div class="input-group">
                                        <span class="input-group-addon">Autoriza:</span>
                                        <select id="auth" name="auth" class="form-control">
                                            <?php
                                            $sq = mysql_query("select * from core_user");
                                            while ($sr = mysql_fetch_array($sq)) {
                                                echo "<option value=\"{$sr[0]}\">{$sr[5]} {$sr[6]} {$sr[7]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">Recibe:</span>
                                        <select id="recibe" name="recibe" class="form-control">
                                            <?php
                                            $sq = mysql_query("select * from core_user");
                                            while ($sr = mysql_fetch_array($sq)) {
                                                echo "<option value=\"{$sr[0]}\">{$sr[5]} {$sr[6]} {$sr[7]}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <input type="hidden" id="rows" name="rows" />
            <div class="well well-sm">
                <button type="submit" class="btn btn-default">Guardar</button>
            </div>
        </form>
        <script>
            $(document).ready(function() {
                $('#date_out').datepicker({dateFormat: 'yy-mm-dd'});
                var store = $('#store_frm').val();
                $('#sp').autocomplete({
                    source: 'include/modules/warehouse/move.store.php?m=0&store=' + store,
                    minLength: 2,
                    select: function(event, ui) {
                        pid = ui.item.id;
                        $('#store_out').load('include/modules/warehouse/move.store.php', {m: 1, id: pid, store: $('#store_frm').val()});
                        $('#pid').val(ui.item.id);
                        $('#pcode').val(ui.item.code);
                        $('#pname').html(ui.item.value);
                        $('#units').focus();
                        $('#store_out').fadeIn();
                        $("#sp").val("").focus();
                    }
                });
            });
        </script>
        <?php
        break;
    case 1:             
        $store_to = $_REQUEST["store_to"];
        $date_out = $_REQUEST["date_out"];
        $send = $_REQUEST["send"];
        $auth = $_REQUEST["auth"];
        $get = $_REQUEST["recibe"];
        $rows = $_REQUEST["rows"];

        $sq = mysql_query("select * from warehouse_store where id=$store_to");
        while ($sr = mysql_fetch_array($sq)) {
            $sto_to = $sr['name'];
        }
        $rows = str_replace("]", "", $rows);
        $row = explode("[", $rows);
        $arr = Array();
        for ($i = 1; $i < count($row); $i++) {
            $line = Array();
            $line = explode(",", $row[$i]);
            if ($line[0] != "0") {
                $sq = mysql_Query("SELECT * from warehouse_store WHERE id={$line[4]}");
                while ($sr = mysql_fetch_array($sq)) {
                    $sto_frm = $sr['name'];
                }
                product_move($line[0], $line[3], $line[4], $store_to);
                $arr[] = $line;
                ?>
                <div class="alert alert-success">
                    <h4>Se ha movido el producto <b><?php echo $line[2]; ?></b></h4>
                </div>
                <?php
            }
        }
        ?>
        <div class="well well-sm">
            <div class="btn-group">
                <a class="btn btn-primary" href="./?m=warehouse&s=move&o=0"><i class="fa fa-plus-sign-alt"></i> Nuevo Movimiento</a>
                <a class="btn btn-primary" href="./?m=warehouse&s=move&o=2"><i class="fa fa-edit-sign"></i> Ir a administrar</a>
            </div>
        </div>
        <?php
        break;
    case 2:
        ?>                               
        <table id="tbl_admin" <?php echo TBLcss; ?> style="font-size:9pt;">
            <thead>
                <tr>
                    <td>Origen</td>
                    <td>Destino</td>
                    <td width="1">Fecha</td>
                    <td>Env&iacute;a.</td>
                    <td>Autoriza</td>
                    <td>Recibe</td>
                    <td width="1">Recibi&oacute;</td>
                    <td>Estado</td>
                    <td width="158"><i class="fa fa-th"></i></td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script type="text/javascript">
            $(document).ready(function() {
                jTable("tbl_admin", "include/modules/warehouse/move.table.php");
            });
        </script>
        <?php
        break;
    case 3:
        $id = $_REQUEST["id"];
        $q = mysql_query("select * from warehouse_move where id=$id");
        while ($r = mysql_fetch_array($q)) {
            ?>
            <form action="./?m=warehouse&s=move&o=1" method="post">
                <div class="tabbable" style="background:rgba(255,255,255,0.75);border-radius:4px;">
                    <ul class="nav nav-tabs">                    
                        <li class="active"><a href="#productos" data-toggle="tab">Productos</a></li>
                        <li><a href="#informacion" data-toggle="tab">Informacion</a></li>
                    </ul>
                    <div class="tab-content">                        
                        <div id="productos" class="tab-pane active">
                            <table <?php echo TBLcss; ?>>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Origen</span>
                                            <select id="store_frm" name="store_frm" class="form-control" onchange="$('#sp').autocomplete('option', 'source', 'modules/warehouse/move.store.php?m=0&store=' + $(this).val())">
                                                <?php
                                                $sq = mysql_query("select * from warehouse_store");
                                                while ($sr = mysql_fetch_array($sq)) {
                                                    echo "<option value=\"{$sr[0]}\">{$sr[1]}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>                 
                                        <div class="input-group input-append">                            
                                            <span class="input-group-addon">Producto</span>
                                            <input type="text" id="sp" name="sp" class="form-control" />
                                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        </div>
                                    </td>                                
                                    <td>
                                        <div style="background-color:#FFF;font-size: 8pt;font-weight: bold;">
                                            <div id="pselected">
                                                <a href="#" id="btnReset" class="btn btn-mini close" onclick="resetSelected()">&times;</a>
                                                <input type="hidden" id="pid" name="pid" value="0" />
                                                <input type="hidden" id="pcode" name="pcode" value="0" />
                                                <span id="pname">No se a elegido producto</span>
                                            </div>
                                        </div>                                    
                                    </td>
                                    <td><div id="store_out" class="well well-small" style="display:none;">Seleccione un producto</div></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <button onclick="addMove()" type="button" class="btn btn-block"><i class="fa fa-plus-sign-alt"></i> Agregar</button>
                                    </td>
                                </tr>
                            </table>
                            <table id="tbl" <?php echo TBLcss; ?>>
                                <thead>
                                    <tr>
                                        <td colspan="6" class="text-info"><strong>Productos que ser&aacute;n movidos</strong></td>
                                    </tr>
                                    <tr>
                                        <td width="1">ID</td>
                                        <td>Origen</td>
                                        <td>C&oacute;digo</td>
                                        <td>Producto</td>
                                        <td width="1">Cantidad</td>
                                        <td width="1">&nbsp;</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sq = mysql_query("SELECT * from warehouse_move_detail WHERE tid={$r[0]}");
                                    while ($sr = mysql_fetch_array($sq)) {
                                        ?>
                                        <tr>
                                            <td class="pid"><?php echo $sr['pid']; ?></td>
                                            <td class="pstore"><input type="hidden" class="sto" value="<?php echo $sr["sid"]; ?>" /><?php echo getData($sr['sid'], 'warehouse_store', 'name'); ?></td>
                                            <td class="pcode"><?php echo $sr['code']; ?></td>
                                            <td class="pname"><?php echo $sr['name']; ?></td>
                                            <td class="amount"><?php echo $sr['amount']; ?></td>
                                            <td><a class="btn btn-mini" href="#" onclick="delMove(this)"><i class="fa fa-remove"></i></a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>                        
                        </div>
                        <div id="informacion" class="tab-pane" style="font-size: 9pt;">
                            <table <?php echo TBLcss; ?>>
                                <tr>
                                    <td><div class="input-group">
                                            <span class="input-group-addon">Destino: </span>
                                            <select name="store_to" id="store_to" class="form-control">
                                                <?php
                                                $sq = mysql_query("select * from warehouse_store");
                                                while ($sr = mysql_fetch_array($sq)) {
                                                    echo "<option value=\"{$sr[0]}\">{$sr[1]}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><div class="input-group">
                                            <span class="input-group-addon">Fecha:</span>
                                            <input name="date_out" id="date_out" type="text" class="form-control" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div class="input-group">
                                            <span class="input-group-addon">Env&iacute;a:</span>
                                            <select id="send" name="send" class="form-control">
                                                <?php
                                                $sq = mysql_query("select * from core_user");
                                                while ($sr = mysql_fetch_array($sq)) {
                                                    echo "<option value=\"{$sr[0]}\">{$sr[5]} {$sr[6]} {$sr[7]}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><div class="input-group">
                                            <span class="input-group-addon">Autoriza:</span>
                                            <select id="auth" name="auth" class="form-control">
                                                <?php
                                                $sq = mysql_query("select * from core_user");
                                                while ($sr = mysql_fetch_array($sq)) {
                                                    echo "<option value=\"{$sr[0]}\">{$sr[5]} {$sr[6]} {$sr[7]}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Recibe:</span>
                                            <select id="recibe" name="recibe" class="form-control">
                                                <?php
                                                $sq = mysql_query("select * from core_user");
                                                while ($sr = mysql_fetch_array($sq)) {
                                                    echo "<option value=\"{$sr[0]}\">{$sr[5]} {$sr[6]} {$sr[7]}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="rows" name="rows" />
                <div class="well well-sm">
                    <button type="submit" class="btn">Guardar</button>
                </div>
            </form>
            <script>
                $(document).ready(function() {
                    $('#date_out').datepicker({dateFormat: 'yy-mm-dd'});
                    $('#sp').autocomplete({
                        source: 'modules/warehouse/move.store.php?m=0',
                        minLength: 2,
                        select: function(event, ui) {
                            pid = ui.item.id;
                            $('#store_out').load('modules/warehouse/move.store.php', {m: 1, id: pid});
                            $('#pid').val(ui.item.id);
                            $('#pcode').val(ui.item.code);
                            $('#pname').html(ui.item.value);
                            $('#units').focus();
                        }
                    }).focus(function() {
                        $(this).val('');
                    });
                    summary();
                });
            </script>
            <?php
        }
        break;
    case 4:
        if ($_SESSION["CORE"]["branch"] != "0") {
            $store = $_SESSION["CORE"]["branch"];
        } else {
            $store = $_SESSION["CORE"]["matriz"];
        }
        $id = $_REQUEST["id"];

        $sto = $_REQUEST["store_to"];
        $date = $_REQUEST["date_out"];
        $send = $_REQUEST["send"];
        $auth = $_REQUEST["auth"];
        $rec = $_REQUEST["recibe"];
        $e = false;
        mysql_query("UPDATE warehouse_move SET 
            store_frm='$store'
            ,store_to='$sto'
            , date_out='$date'
            , uid_send='$send'
            , uid_auth='$auth'
            , uid_get='$rec' WHERE id=$id") or $e = mysql_error();
        chk("Actualizar Movimiento", $e);
        ?>
        <div class="well well-sm">
            <div class="btn-group">
                <a class="btn" href="./?m=<?php echo $m; ?>&s=<?php echo $s; ?>&o=0"><i class="fa fa-plus-sign-alt"></i> Nuevo</a>
                <a class="btn" href="./?m=<?php echo $m; ?>&s=<?php echo $s; ?>&o=2"><i class="fa fa-edit-sign"></i> Administrar</a>
            </div>
        </div>
        <?php
        break;
    case 5:
        /* Eliminar */
        $pid = $_REQUEST["id"];
        ?>
        <form action="./?m=warehouse&s=move&o=6" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $pid; ?>" />
            <div class="alert alert-danger">
                <h4>Esta seguro de eliminar del Sistema este Movimiento de producto.?<br/><small>Esta acci&oacute;n no se puede deshacer.</small></h4>                        
            </div>
            <div class="btn-group">
                <a href="./?m=warehouse&s=move&o=2" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Cancelar</a>
                <button type="submit" class="btn btn-success">Continuar <i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
        <?php
        break;
    case 6:
        /* Borrar */
        $pid = $_REQUEST["id"];
        $q = mysql_query("delete from warehouse_move where id='$pid'") or $e = mysql_error();
        if (!isset($e)) {
            mysql_query("DELETE from warehouse_move_detail WHERE tid=$pid");
            ?>
            <div class="alert alert-success">
                <h4>El movimiento a sido eliminado!</h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>Ha ocurrido un error!</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="well well-sm">
            <a class="btn btn-info" href="./?m=warehouse&s=move&o=2">Ir a administraci&oacute;n</a>
        </div>
        <?php
        writeLog("$m", $s, "El usuario {$_SESSION["CORE"]["fname"]} elimin&oacute; el producto $pid del sistema");
        break;
    case 7:
        $id = $_REQUEST["id"];
        $ndate = date("Y-m-d");
        mysql_query("UPDATE warehouse_move SET status='1' AND date_get='$ndate' WHERE id=$id") or $e = mysql_error();
        if (!isset($e)) {
            ?>
            <div class="alert alert-success">
                <h4>El movimiento #<?php echo $id; ?> ha sido marcado como entregado.</h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>No se ha podido actualizar el movimiento #<?php echo $id; ?>.</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="well well-sm">
            <div class="btn-group">
                <a class="btn btn-info" href="./?m=warehouse&s=move&o=0"><i class="fa fa-plus-sign-alt"></i> Nuevo Movimiento</a>
                <a class="btn btn-info" href="./?m=warehouse&s=move&o=2"><i class="fa fa-edit-sign"></i> Ir a administraci&oacute;n</a>
            </div>
        </div>
        <?php
        break;
    case 8:
        break;
    case 9:
        $id = $_REQUEST["id"];
        $q = mysql_query("SELECT * from warehouse_move WHERE id=$id");
        while ($r = mysql_fetch_array($q)) {
            for ($i = 0; $i < 2; $i++) {
                $sq = mysql_query("SELECT * from warehouse_move_detail WHERE tid=$id");
                ?>           
                <div class="container" style="min-height:105mm!important;">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel">
                                <?php echo corp_logo('128'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel">
                                <h4><span class="muted">MO</span>-<?php echo str_pad($id, 13, "0", STR_PAD_LEFT); ?></h4>
                                Fecha: <strong><?php echo $r['date_out']; ?></strong><br/>
                                Origen: <strong><?php echo getData($r['store_frm'], 'warehouse_store', 'name'); ?></strong>
                            </div>
                        </div>
                    </div>
                    <table class="table table-condensed table-bordered">
                        <tr>
                            <td>C&Oacute;DIGO</td>
                            <td>PRODUCTO</td>
                            <td>CANTIDAD</td>
                        </tr>
                        <?php
                        while ($sr = mysql_fetch_array($sq)) {
                            $pid = $sr['pid'];
                            ?>
                            <tr>
                                <td><?php echo $sr['code']; ?></td>
                                <td><?php echo $sr['name']; ?></td>
                                <td><?php echo $sr['amount']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <table class="table table-condensed table-bordered" style="text-transform: uppercase;">
                        <thead>
                            <tr style="background:#333;">
                                <td width="33%"><span class="label label-info">Env&iacute;a</span></td>
                                <td><span class="label label-info">Autoriza</span></td>
                                <td width="33%"><span class="label label-info">Recibe</span></td>
                            </tr>
                        </thead>
                        <tr>
                            <td style="text-align: center;"><br/><br/><br/>
                                <hr noshade style="border-top:1px solid #CCC;width:80%;margin:0px auto;" /><b>
                                    <?php
                                    $sq = mysql_query("select * from core_user WHERE id={$r['uid_send']}");
                                    while ($sr = mysql_fetch_array($sq)) {
                                        echo "{$sr[5]} {$sr[6]} {$sr[7]}";
                                    }
                                    ?></b>
                            </td>
                            <td style="text-align: center;"><br/><br/><br/>
                                <hr noshade style="border-top:1px solid #CCC;width:80%;margin:0px auto;" /><b>
                                    <?php
                                    $sq = mysql_query("select * from core_user WHERE id={$r['uid_auth']}");
                                    while ($sr = mysql_fetch_array($sq)) {
                                        echo "{$sr[5]} {$sr[6]} {$sr[7]}";
                                    }
                                    ?></b>
                            </td>
                            <td style="text-align: center;"><br/><br/><br/>
                                <hr noshade style="border-top:1px solid #CCC;width:80%;margin:0px auto;" /><b>
                                    <?php
                                    $sq = mysql_query("select * from core_user WHERE id={$r['uid_get']}");
                                    while ($sr = mysql_fetch_array($sq)) {
                                        echo "{$sr[5]} {$sr[6]} {$sr[7]}";
                                    }
                                    ?></b>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr noshade />
                <?php
            }
        }

        break;
}
?>
<script>
    function resetSelected() {
        $('#pid').val(0);
        $('#pname').html("No se ha seleccionado ningun producto");
        $('#store_out').html('Seleccione un producto');
        $('#store_out').fadeOut();
    }
    function addMove() {
        var pid = $('#pid').val();
        var pcode = $('#pcode').val();
        var pname = $('#pname').html();
        var amount = $('#existencia').val();
        var sto_frm = $('#store_frm').val();
        var sto_txt = $('#store_txt').html();
        var htm = "<tr>";
        htm += "<td class=\"pid\">" + pid + "</td>";
        htm += "<td class=\"pstore\"><input type=\"hidden\" class=\"sto\" value=\"" + sto_frm + "\" />" + sto_txt + "</td>";
        htm += "<td class=\"pcode\">" + pcode + "</td>";
        htm += "<td class=\"pname\">" + pname + "</td>";
        htm += "<td class=\"amount\">" + amount + "</td>";
        htm += "<td><a href=\"#\" class=\"btn btn-xs btn-danger \" onclick=\"delMove(this)\"><i class=\"fa fa-times\"></i></a></td>";
        htm += "</tr>";
        $('#tbl tbody').append(htm);

        $('#units').val('0');
        $('#sp').val('');
        summary();
        $('#sp').val("").focus();
        $('#btnReset').click();
        $('#store_out').fadeOut();

    }
    function delMove(obj) {
        $(obj).closest("tr").remove();
        summary();
        return false;
    }
    function summary() {
        var a = $('.pid');
        var b = $('.pcode');
        var c = $('.pname');
        var d = $('.amount');
        var e = $('.pstore');
        var rows = "";
        var num = a.length;
        for (i = 0; i < num; i++) {
            var txt = "[";
            txt += $(a[i]).html() + ",";
            txt += $(b[i]).html() + ",";
            txt += $(c[i]).html() + ",";
            txt += $(d[i]).html() + ",";
            txt += $(e[i]).children('.sto').val();
            txt += "]";
            rows += txt;
        }
        $('#rows').val(rows);

    }
</script>