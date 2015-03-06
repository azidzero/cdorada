<?php
$o = $this->C->a_o;
$url = "./?m={$this->C->a_m}&s={$this->C->a_s}";
switch ($o) {
    case 0:
        ?>
        <form action="<?php echo "$url&o=1"; ?>" method="post">
            <h4>Producto Nuevo</h4>
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#tab_general" data-toggle="tab">General</a></li>
                <li><a href="#tab_conf" data-toggle="tab">Configuraci&oacute;n</a></li>
                <li><a href="#tab_prize" data-toggle="tab">Listas de Precios</a></li>
                <li><a href="#tab_cat" data-toggle="tab">Categor&iacute;as</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_general">
                    <table class="table table-condensed" style="font-size:9pt;">                               
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">C&oacute;digo de Barras:</span>
                                    <input name="p_code" type="text" class="required form-control" id="p_code" size="13" />
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">C&oacute;digo Interno:</span>
                                    <input name="p_ref" type="text" class="form-control" id="p_ref" size="13" />
                                </div>
                            </td> 
                            <td rowspan="2">
                                <div class="input-group">
                                    <span class="input-group-addon">Concepto/Descripci&oacute;n:</span>
                                    <textarea name="p_name" class="form-control required" id="p_name"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><div class="input-group">
                                    <span class="input-group-addon">Marca</span>
                                    <input type="text" id="brand" name="brand" class="form-control" />
                                </div>                                    
                            </td>
                        </tr>                        
                        <tr>
                            <td colspan="4">
                                <strong class="text-danger">Descripci&oacute;n Larga:</strong><br />
                                <textarea name="p_desc" cols="40" rows="1" id="p_desc" style="width:98%" class="form-control"></textarea>
                            </td>                           
                        </tr>                                
                    </table>
                </div>
                <div class="tab-pane" id="tab_conf">
                    <table class="table table-condensed" style="font-size:9pt;">                                
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">U. de medida:</span>
                                    <select  id="p_size" name="p_size" class="form-control required">
                                        <?php
                                        $sq = mysqli_query($this->C->CNN, "select * from core_um");
                                        while ($sr = mysqli_fetch_array($sq)) {
                                            echo "<option value=\"{$sr['name']}\">{$sr['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">M&iacute;n.:</span>
                                    <input name="p_min" type="text" class="form-control" id="p_min" />
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">M&aacute;x.</span>
                                    <input name="p_max" type="text" class="form-control" id="p_max" />
                                </div>
                            </td>       
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon"><input type="checkbox" id="granel" name="granel" value="1" class="pull-left" /></span>
                                    <span class="input-group-addon">Este producto se vende a Granel</span>
                                </div>                                
                            </td>
                            <td><div class="input-group">
                                    <span class="input-group-addon"><input type="checkbox" id="service" name="service" value="1" class="pull-left" /></span>
                                    <span class="input-group-addon">Es un Servicio</span>
                                </div>
                            </td>                                               
                            <td><div class="input-group">
                                    <span class="input-group-addon"><input type="checkbox" id="expires" name="expires" value="1" class="pull-left" /></span>
                                    <span class="input-group-addon">Este producto Caduca</span>
                                </div>
                            </td>

                        </tr>                     
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon"><input type="checkbox" id="unavailable" name="unavailable" value="1" class="pull-left" /></span>
                                    <span class="input-group-addon">Vender aunque no haya existencia</span>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Proveedor:</span>
                                    <select name="p_prove" class="form-control" id="p_prove">
                                        <option selected="selected" value="0">Sin Proveedor</option>
                                        <?php
                                        $s = mysqli_query($this->C->CNN, "select * from crm_corp WHERE isProvider=1") or die(mysqli_error($this->C->CNN));
                                        $n = mysqli_num_rows($s);
                                        if ($n > 0) {
                                            while ($t = mysqli_fetch_array($s)) {
                                                ?>
                                                <option value="<?php echo $t["id"] ?>"><?php echo utf8_encode($t["name"]); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon"><input type="checkbox" id="iva" name="iva" value="1" class="pull-left" /></span>
                                    <span class="input-group-addon">Producto exento de I.V.A.</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane" id="tab_prize">
                    <table class="table table-condensed" style="font-size:9pt;">                       
                        <tr class="error" style="font-weight:800 !important;color:#B94A48;">
                            <td>Lista 1</td>
                            <td>Lista 2</td>
                            <td>Lista 3</td>
                            <td>Lista 4</td>
                            <td>Lista 5</td>
                            <td>Lista 6</td>
                        </tr>
                        <tr class="error">
                            <td><input type="text" class="form-control" id="p_1" name="p_1" placeholder="0.00" /></td>
                            <td><input type="text" class="form-control" id="p_2" name="p_2" placeholder="0.00" /></td>
                            <td><input type="text" class="form-control" id="p_3" name="p_3" placeholder="0.00" /></td>
                            <td><input type="text" class="form-control" id="p_4" name="p_4" placeholder="0.00" /></td>
                            <td><input type="text" class="form-control" id="p_5" name="p_5" placeholder="0.00" /></td>
                            <td><input type="text" class="form-control" id="p_6" name="p_6" placeholder="0.00" /></td>
                        </tr>
                    </table>
                    <span style="font-size:100%;" class="label label-danger">Todos los precios deber&aacute;n ser expresados con I.V.A., el sistema desglosar&aacute; el I.V.A. al momento de Facturar</span>
                </div>
                <div class="tab-pane" id="tab_cat">
                    <table class="table table-condensed" style="font-size:9pt;">                        
                        <tr>
                            <td width="50%">
                                <div class="well well-sm">
                                    <strong>Categor&iacute;a Seleccionada: </strong>
                                    <input type="hidden" id="cats" name="cats" value="0" />
                                    <div id="cat_man" class="">Ninguna</div>
                                </div>
                                <div id="catman" style="height:240px;overflow:auto;background:#036;font-size:8pt;"></div>
                            </td>                            
                            <td>
                                <strong>Ubicacion del producto:</strong>
                                <table class="table table-condensed table-bordered">
                                    <tr>
                                        <td>Zona</td>
                                        <td>Pasillo</td>
                                        <td>Anaquel</td>
                                        <td>Repisa</td>                                        
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control" id="pos_zone" name="pos_zone" /></td>
                                        <td><input type="text" class="form-control" id="pos_hall" name="pos_hall" /></td>
                                        <td><input type="text" class="form-control" id="pos_rack" name="pos_rack" /></td>
                                        <td><input type="text" class="form-control" id="pos_shelf" name="pos_shelf" /></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>                        
                    </table>
                </div>                        
            </div>
            <div class="well well-sm">
                <button type="submit" class="btn btn-default"><i class="fa fa-check-sign"></i> Guardar Producto</button>
            </div>
        </form>
        <script>
            $(document).ready(function () {
                $('#catman').load('include/modules/warehouse/cat.live.php');
            });
        </script>
        <?php
        break;
    case 1:
        $code = $_REQUEST["p_code"];
        $sq = mysqli_query("SELECT * from warehouse_product WHERE barcode='$code'");
        $sn = mysqli_num_rows($sq);
        if ($sn > 0) {
            ?>
            <div class="alert alert-warning">
                <h4>Ocurri&oacute; un error</h4>
                <strong>El sistema ya tiene un producto registrado con el mismo c&oacute;digo de barras!</strong>
            </div>
            <?php
        } else {

            $ref = $_REQUEST["p_ref"];
            $name = $_REQUEST["p_name"];
            $pdesc = $_REQUEST["p_desc"];
            $brand = $_REQUEST["brand"];
            $um = $_REQUEST["p_size"];
            if (isset($_REQUEST["expires"])) {
                $expire = 1;
            } else {
                $expire = 0;
            }
            if (isset($_REQUEST["granel"])) {
                $granel = 1;
            } else {
                $granel = 0;
            }
            if (isset($_REQUEST["service"])) {
                $service = 1;
            } else {
                $service = 0;
            }
            if (isset($_REQUEST["unavailable"])) {
                $unavailable = 1;
            } else {
                $unavailable = 0;
            }
            $min = $_REQUEST["p_min"];
            $max = $_REQUEST["p_max"];
            $pid = $_REQUEST["p_prove"];
            $p1 = $_REQUEST["p_1"];
            $p2 = $_REQUEST["p_2"];
            $p3 = $_REQUEST["p_3"];
            $p4 = $_REQUEST["p_4"];
            $p5 = $_REQUEST["p_5"];
            $p6 = $_REQUEST["p_6"];
            if (isset($_REQUEST["iva"])) {
                $iva = 0;
            } else {
                $iva = 1;
            }
            $cat = $_REQUEST["catm"];
            $sql = "INSERT INTO warehouse_product(barcode,ref,name,pdesc,p_1,p_2,p_3,p_4,p_5,p_6,brand,um,min,max,pid,expire,granel,unavailable,cat,isService,owner,iva) "
                    . "VALUES('$code','$ref','$name','$pdesc','$p1','$p2','$p3','$p4','$p5','$p6','$brand','$um','$min','$max','$pid','$expire','$granel','$unavailable','$cat','$service','$owner','$iva')";
            $q = mysqli_query($sql) or $e = mysqli_error();
            if (!isset($e)) {
                ?>
                <div class="alert alert-info">
                    <h4 class="alert-heading"><small>Se ha registrado el producto</small> <?php echo $name; ?></h4>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger">
                    <h4 class="alert-heading">Ha ocurrido un error:</h4>
                    <p>
                        <?php echo $e; ?>
                    </p>
                </div>
                <?php
            }
        }
        ?>
        <div class="well well-sm">
            <div class="btn-group">
                <a class="btn btn-primary" href="./?m=warehouse&s=product&o=0"><i class="fa fa-plus-square"></i> Agregar Nuevo</a>
                <a class="btn btn-primary" href="./?m=warehouse&s=product&o=2"><i class="fa fa-edit"></i> Ir a administrar</a>
            </div>
        </div>
        <?php
        break;
    case 2:
        ?>                               
        <table id="tbl_admin" <?php echo TBLcss; ?> style="font-size:9pt;">
            <thead>
                <tr>
                    <td width="128">Existencias</td>
                    <td width="1">C&oacute;digo</td>
                    <td width="1">Ref.</td>
                    <td>Producto</td>
                    <td width="35%">Descripci&oacute;n Larga</td>
                    <td width="1">Tipo</td>
                    <td width="15%">Acciones</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script type="text/javascript">
            $(document).ready(function () {
                jTable("tbl_admin", "include/modules/warehouse/product.table.php", '<?php echo $cat; ?>');
            });
        </script>
        <?php
        break;
    case 3:
        /* Edicion */
        $pid = $_REQUEST["pid"];
        $q = mysqli_query("select *,(select warehouse_cat.name from warehouse_cat where warehouse_cat.id=warehouse_product.cat) as cat_name from warehouse_product where id='$pid'");
        $n = mysqli_num_rows($q);
        if ($n > 0) {
            while ($r = mysqli_fetch_array($q)) {
                ?>
                <form action="<?php echo "$url&o=4"; ?>" method="post">
                    <input type="hidden" id="id" name="id" value="<?php echo $pid; ?>" />
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#tab_general" data-toggle="tab">General</a></li>
                        <li><a href="#tab_conf" data-toggle="tab">Configuraci&oacute;n</a></li>
                        <li><a href="#tab_prize" data-toggle="tab">Listas de Precios</a></li>
                        <li><a href="#tab_cat" data-toggle="tab">Categor&iacute;as</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_general">
                            <table <?php echo TBLcss; ?> style="font-size:9pt;">                               
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">C&oacute;digo de Barras:</span>
                                            <input name="p_code" type="text" class="required form-control" id="p_code" size="13" value="<?php echo $r["barcode"]; ?>" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">C&oacute;digo Interno:</span>
                                            <input name="p_ref" type="text" class="form-control" id="p_ref" size="13" value="<?php echo $r["ref"]; ?>" />
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Concepto/Descripci&oacute;n:</span>
                                            <textarea name="p_name" class="form-control required" id="p_name"><?php echo $r["name"]; ?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" rowspan="2">
                                        <strong class="text-danger">Descripci&oacute;n Larga:</strong><br />
                                        <textarea name="p_desc" cols="40" rows="2" id="p_desc" style="width:98%" class="form-control"><?php echo $r["pdesc"]; ?></textarea>
                                    </td>                            
                                </tr>                        
                                <tr>
                                    <td><div class="input-group">
                                            <span class="input-group-addon">Marca</span>
                                            <input type="text" id="brand" name="brand" class="form-control" value="<?php echo $r["brand"]; ?>" />
                                        </div>                                    
                                    </td>                            
                                </tr>                                
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_conf">
                            <table <?php echo TBLcss; ?> style="font-size:9pt;">                                
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">U. de medida:</span>
                                            <select  id="p_size" name="p_size" class="form-control required">
                                                <?php
                                                $sq = mysqli_query("select * from core_um");
                                                while ($sr = mysqli_fetch_array($sq)) {
                                                    if ($sr["name"] == $r["um"]) {
                                                        echo "<option selected=\"selected\" value=\"{$sr['name']}\">{$sr['name']}</option>";
                                                    } else {
                                                        echo "<option value=\"{$sr['name']}\">{$sr['name']}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">M&iacute;n.:</span>
                                            <input name="p_min" type="text" class="form-control" id="p_min" value="<?php echo $r["min"]; ?>" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">M&aacute;x.</span>
                                            <input name="p_max" type="text" class="form-control" id="p_max" value="<?php echo $r["max"]; ?>" />
                                        </div>
                                    </td>       
                                </tr>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon"><input <?php
                                                if ($r['granel'] == 1) {
                                                    echo "checked=\"checked\"";
                                                }
                                                ?> type="checkbox" id="granel" name="granel" value="1" class="pull-left" /></span>
                                            <span class="input-group-addon">Este producto se vende a Granel</span>
                                        </div>                                
                                    </td>
                                    <td><div class="input-group">
                                            <span class="input-group-addon"><input <?php
                                                if ($r['isService'] == 1) {
                                                    echo "checked=\"checked\"";
                                                }
                                                ?> type="checkbox" id="service" name="service" value="1" class="pull-left" /></span>
                                            <span class="input-group-addon">Es un Servicio</span>
                                        </div>
                                    </td>                                               
                                    <td><div class="input-group">
                                            <span class="input-group-addon"><input <?php
                                                if ($r['expire'] == 1) {
                                                    echo "checked=\"checked\"";
                                                }
                                                ?> type="checkbox" id="expires" name="expires" value="1" class="pull-left" /></span>
                                            <span class="input-group-addon">Este producto Caduca</span>
                                        </div>
                                    </td>                                    
                                </tr>                     
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon"><input <?php
                                                if ($r['unavailable'] == 1) {
                                                    echo "checked=\"checked\"";
                                                }
                                                ?> type="checkbox" id="unavailable" name="unavailable" value="1" class="pull-left" /></span>
                                            <span class="input-group-addon">Vender aunque no haya existencia</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon">Proveedor:</span>
                                            <select name="p_prove" class="form-control" id="p_prove">
                                                <option selected="selected" value="0">Sin Proveedor</option>
                                                <?php
                                                $s = mysqli_query("select * from purchase_provider");
                                                $n = mysqli_num_rows($s);
                                                if ($n > 0) {
                                                    while ($t = mysqli_fetch_array($s)) {
                                                        ?>
                                                        <option value="<?php echo $t["id"] ?>"><?php echo utf8_encode($t["name"]); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><div class="input-group">
                                            <span class="input-group-addon"><input checked="checked" type="checkbox" id="iva" name="iva" value="1" class="pull-left" /></span>
                                            <span class="input-group-addon">Producto con I.V.A.</span>
                                        </div>
                                    </td>     
                                </tr>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_prize">
                            <table <?php echo TBLcss; ?> style="font-size:9pt;">                       
                                <tr class="error" style="font-weight:800 !important;color:#B94A48;">
                                    <td>Lista 1</td>
                                    <td>Lista 2</td>
                                    <td>Lista 3</td>
                                    <td>Lista 4</td>
                                    <td>Lista 5</td>
                                    <td>Lista 6</td>
                                </tr>
                                <tr class="error">
                                    <td><input type="text" class="form-control" id="p_1" name="p_1" placeholder="0.00" value="<?php echo $r["p_1"]; ?>" /></td>
                                    <td><input type="text" class="form-control" id="p_2" name="p_2" placeholder="0.00" value="<?php echo $r["p_2"]; ?>" /></td>
                                    <td><input type="text" class="form-control" id="p_3" name="p_3" placeholder="0.00" value="<?php echo $r["p_3"]; ?>" /></td>
                                    <td><input type="text" class="form-control" id="p_4" name="p_4" placeholder="0.00" value="<?php echo $r["p_4"]; ?>" /></td>
                                    <td><input type="text" class="form-control" id="p_5" name="p_5" placeholder="0.00" value="<?php echo $r["p_5"]; ?>" /></td>
                                    <td><input type="text" class="form-control" id="p_6" name="p_6" placeholder="0.00" value="<?php echo $r["p_6"]; ?>" /></td>
                                </tr>
                            </table>
                            <span style="font-size:100%;" class="label label-danger">Todos los precios deber&aacute;n ser expresados con I.V.A., el sistema desglosar&aacute; el I.V.A. al momento de Facturar</span>
                        </div>
                        <div class="tab-pane" id="tab_cat">
                            <table <?php echo TBLcss; ?> style="font-size:9pt;">                        
                                <tr>
                                    <td width="196">
                                        <div class="input-group">
                                            <input type="text" id="catm" name="catm" class="form-control" />
                                            <a class="input-group-addon btn btn-default" href="#" onclick="addCat()"><i class="fa fa-plus-sign-alt" /></i> Agregar</a>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="hidden" id="cats" name="cats" value="0" />
                                        <div id="cat_man" class="">Ninguna</div>                                
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <span class="label label-info">
                                            Describa la categor&iacute;a(s) separadas por <i>/</i>. Ejem.: Categoria Padre/Categoria Secundaria/Otra
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>                        
                    </div>
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-default"><i class="fa fa-check-sign"></i> Guardar Producto</button>
                    </div>
                </form>                
                <?php
            }
        } else {
            ?>
            <table <?php echo TBLcss; ?>>
                <tr class="first">
                    <td><h3>El producto no se encuentra en la base de datos.!</h3></td>
                </tr>
            </table>
            <?php
        }
        break;
    case 4:
        /* Actualizacion */
        $id = $_REQUEST["id"];
        $code = $_REQUEST["p_code"];
        $ref = $_REQUEST["p_ref"];
        $name = utf8_decode($_REQUEST["p_name"]);
        $desc = utf8_decode($_REQUEST["p_desc"]);
        $brand = $_REQUEST["brand"];
        $size = $_REQUEST["p_size"];
        $min = $_REQUEST["p_min"];
        $max = $_REQUEST["p_max"];
        $pro = $_REQUEST["p_prove"];
        $p_1 = $_REQUEST["p_1"];
        $p_2 = $_REQUEST["p_2"];
        $p_3 = $_REQUEST["p_3"];
        $p_4 = $_REQUEST["p_4"];
        $p_5 = $_REQUEST["p_5"];
        $p_6 = $_REQUEST["p_6"];
        $cat = $_REQUEST["cats"];
        if (isset($_REQUEST["expires"])) {
            $exp = true;
        } else {
            $exp = false;
        }
        if (isset($_REQUEST["granel"])) {
            $gran = true;
        } else {
            $gran = false;
        }
        if (isset($_REQUEST["unavailable"])) {
            $una = true;
        } else {
            $una = false;
        }
        if (isset($_REQUEST["service"])) {
            $ser = true;
        } else {
            $ser = false;
        }
        if (isset($_REQUEST["iva"])) {
            $iva = 1;
        } else {
            $iva = 0;
        }
        $q = mysqli_query("update warehouse_product set um='$size'
            ,barcode='$code'
            ,ref='$ref'
            ,name='$name'
            ,pdesc='$desc'            
            ,p_1='$p_1'
            ,p_2='$p_2'
            ,p_3='$p_3'
            ,p_4='$p_4'
            ,p_5='$p_5'
            ,p_6='$p_6'
            ,brand='$brand'
            ,min='$min'
            ,max='$max'
            ,pid='$pro'
            ,expire='$exp'
            ,granel='$gran'
            ,cat='$cat'
            ,isService='$ser'
            ,iva='$iva'
            ,unavailable='$una'            
            where id=$id") or $e = mysqli_error();
        if (!isset($e)) {
            ?>
            <div class="alert alert-info">
                <h4>Se a actualizado el producto! <small><?php echo $name; ?></small></h4>
            </div>
            <div class="well well-sm">
                <a class="btn btn-primary" href="<?php echo $url; ?>&o=2"><i class="fa fa-chevron-left"></i> Regresar</a>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>Ocurrio un error: <small><?php echo $e; ?></small></h4>
            </div>
            <div class="well well-sm">
                <a class="btn btn-primary" href="<?php echo $url; ?>&o=2"><i class="fa fa-chevron-left"></i> Regresar</a>
            </div>
            <?php
        }
        writeLog("$m", $s, "El usuario {$_SESSION["CORE"]["user"]["name"]} actualizo la informacion del producto $name");
        break;
    case 5:
        /* Eliminar */
        $pid = $_REQUEST["pid"];
        ?>
        <form action="./?m=warehouse&s=product&o=6" method="post">
            <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>" />
            <div class="alert alert-danger">
                <h4>Esta seguro de eliminar del Sistema este producto.?<br/><small>Esta accion no se puede deshacer.</small></h4>                        
            </div>
            <div class="btn-group">

                <a href="./?m=warehouse&o=2" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Cancelar</a>
                <button type="submit" class="btn btn-success">Continuar <i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
        <?php
        break;
    case 6:
        /* Borrar */
        $pid = $_REQUEST["pid"];
        $q = mysqli_query("select * from warehouse_product where id='$pid'");
        while ($r = mysqli_fetch_array($q)) {
            $name = $r['name'];
        }
        $q = mysqli_query("delete from warehouse_product where id='$pid'") or $e = mysqli_error();

        if ($e == "") {
            ?>
            <div class="alert alert-success">
                <h4>El producto a sido eliminado!</h4>
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
            <a class="btn btn-info" href="./?m=warehouse&s=product&o=2">Ver Productos</a>
        </div>
        <?php
        writeLog("$m", $s, "El usuario {$_SESSION["CORE"]["fname"]} elimin&oacute; el producto $name del sistema");
        break;
    case 7:
        /* Mover Producto de un almacen a otro */
        $pid = $_REQUEST["pid"];
        $q = mysqli_query("select * from warehouse_store where owner='$owner'");
        $n = mysqli_num_rows($q);
        if ($n > 0) {
            while ($r = mysqli_fetch_array($q)) {
                $store = $r["name"];
                $sid = $r["id"];
                $sq = mysqli_query("select * from warehouse_product where id=$pid") or die(mysqli_error());
                $ar['u'] = 0;
                $ar['s'] = $sid;
                $ar['n'] = $r['name'];
                while ($rq = mysqli_fetch_array($sq)) {
                    $pname = $rq['name'];
                    if (strstr($rq['store'], ",") != "") {
                        // Multi
                        $stores = explode(",", $rq['store']);
                        $units = explode(",", $rq['units']);
                        $tunit = 0;
                        for ($i = 0; $i < count($stores); $i++) {
                            $tunit+=$units[$i];
                            if ($stores[$i] == $sid) {
                                $ar['u'] = $units[$i];
                            }
                        }
                    } else {
                        // Unidades
                        if ($rq['store'] == $sid) {
                            $ar['u'] = $rq['units'];
                            $tunit+=$rq['units'];
                        }
                    }
                }
                $arr[] = $ar;
            }
        }
        ?>

        <div class="row">
            <div class="span3">
                <h4 class="alert alert-info">Producto:</h4>
                <strong><?php echo $pname; ?><sup><small>(<?php echo $tunit; ?> unidades)</small></sup></strong>
            </div>
            <div class="span9">
                <?php
                for ($i = 0; $i < count($arr); $i++) {
                    $c = $arr[$i]['u'];
                    if ($c > 0) {
                        ?>
                        <form action="<?php echo $url; ?>&o=8" method="post">
                            <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>"  />
                            <input type="hidden" id="store_frm" name="store_frm" value="<?php echo $arr[$i]['s']; ?>"  />
                            <table class="table table-condensed table-bordered">
                                <tr>
                                    <td>Almacen</td>
                                    <td>Existencia</td>
                                    <td>Unidades Disponibles</td>
                                    <td>Almacen de Destino</td>
                                    <td rowspan="2">
                                        <button type="submit" class="btn btn-primary"><img alt="" src="images/prov.png"> Mover</button>
                                    </td>
                                </tr>
                                <tr class="success">
                                    <td><?php echo $arr[$i]['n']; ?></td>
                                    <td><small> <?php echo $arr[$i]['u']; ?> unidades.</small></td>
                                    <td><input type="text" id="store_num" name="store_num" value="<?php echo $arr[$i]['u']; ?>" /></td>
                                    <td><select id="store_to" name="store_to">
                                            <?php
                                            $q = mysqli_query("select * from warehouse_store");
                                            while ($r = mysqli_fetch_Array($q)) {
                                                if ($r['id'] != $arr[$i]['s']) {
                                                    ?>
                                                    <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>

                                </tr>
                            </table>
                        </form>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-error">
                            <h4>El almacen <b><?php echo $arr[$i]['n']; ?></b><small> no tiene este producto.</small></h4>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
        break;
    case 8:
        $pid = $_REQUEST["pid"];
        $num = $_REQUEST["store_num"];
        $frm = $_REQUEST["store_frm"];
        $to = $_REQUEST["store_to"];
        // Baja
        product_move($pid, $num, $frm, $to);
        ?>
        <div class="alert alert-info">
            <h4>Se ha movido el producto!</h4>
        </div>
        <div class="well well-sm">
            <a class="btn" href="<?php echo $url; ?>&o=2">Ver Productos</a>
        </div>
        <?php
        break;
    case 9:
        /*
         * Existencias
         *
         */
        $q = mysqli_query("select * from warehouse_store where owner='$owner'");
        $store = array('0' => 'Ninguno');
        while ($r = mysqli_fetch_array($q)) {
            $store[$r['id']] = $r['name'];
        }
        $q = mysqli_query("select * from warehouse_product WHERE owner='$owner'");
        $n = mysqli_num_rows($q);
        $store_value = 0;
        if ($n > 0) {
            ?>
            <table id="tbl" <?php echo TBLcss; ?> >
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>ALMACEN</td>
                        <td>CAT.</td>
                        <td>CODIGO</td>
                        <td>REF.</td>
                        <td>PRODUCTO</td>
                        <td>PRECIO</td>
                        <td>VALOR</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($r = mysqli_fetch_array($q)) {
                        $sq = mysqli_query("SELECT * from warehouse_product_move WHERE id={$r[0]} order by id DESC LIMIT 1");
                        $sn = mysqli_num_rows($sq);
                        $pp = 0;
                        if ($n > 0) {
                            while ($sr = mysqli_fetch_array($sq)) {
                                $pp = $sr["PP"];
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo $r[0]; ?></td>
                            <td>
                                <?php
                                $tunit = 0;
                                $sx = explode(",", $r['store']);
                                $ux = explode(",", $r['units']);
                                if (count($sx) > 1) {
                                    echo "<table " . TBLcss . ">";
                                    for ($i = 0; $i < count($sx); $i++) {
                                        if ($ux[$i] > 0) {
                                            echo "<tr><td><a href=\"#\">" . $store[$sx[$i]] . "</a></td><td width=\"48\">{$ux[$i]}</td></tr>";
                                        }
                                        $tunit+=$ux[$i];
                                    }
                                    echo "</table>";
                                } else {
                                    if ($pp > 0) {
                                        echo "<table " . TBLcss . ">";
                                        echo "<tr><td><a href=\"#\">" . $store[$r['store']] . "</a></td><td width=\"48\">{$r['units']}</td></tr>";
                                        echo "</table>";
                                        $tunit+=$r['units'];
                                    } else {
                                        echo "<table " . TBLcss . ">";
                                        echo "<tr><td><a href=\"#\">Sin Existencia</a></td></tr>";
                                        echo "</table>";
                                    }
                                }
                                ?>
                            </td>
                            <td><i class="fa fa-tag"></i>
                                <?php
                                if ($r['cat'] != "") {
                                    echo $r['cat'];
                                } else {
                                    echo "Sin Categor&iacute;a";
                                }
                                ?>
                            </td>
                            <td><?php echo $r['barcode']; ?></td>
                            <td><?php echo $r['ref']; ?></td>
                            <td><strong><?php echo $r['name']; ?></strong> <small><?php echo $r['pdesc']; ?></small></td>
                            <td><?php echo $pp; ?></td>
                            <td><?php echo number_format($pp * $tunit, 2); ?></td>

                        </tr>
                        <?php
                        $store_value+=($pp * $tunit);
                    }
                    ?>
                </tbody>
            </table>
            <script>
                $(document).ready(function () {
                    oTable('#tbl');
                });
            </script>
            <div style="text-align: right;">
                <h3 class="alert-heading"><sup><small>Total: </small></sup><?php echo number_format($store_value, 2); ?></h3>
            </div>
            <?php
        }
        break;
    case 10:
        /* Alta de Producto */
        $pid = $_REQUEST["pid"];
        $q = mysqli_query("SELECT * from warehouse_product WHERE id=$pid and owner='$owner'");
        $n = mysqli_num_rows($q);
        if ($n > 0) {
            while ($r = mysqli_fetch_array($q)) {
                ?>                    
                <form action="<?php echo $url; ?>&o=11" method="post">
                    <table <?php echo TBLcss; ?>>
                        <tr>
                            <td colspan="4"><h4>Registro de Entrada de Producto</h4></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <?php
                                if ($pid == "") {
                                    ?>
                                    <div id="proSelect" class="input-group">
                                        <span class="input-group-addon">Producto que esta dando de alta:</span>
                                        <input type="text" id="pro_q" maxlength="12" class="form-control"  />
                                    </div>
                                    <div id="proSelected" style="display: none;"></div>
                                    <?php
                                } else {
                                    ?>
                                    <div id="proSelect" class="input-group" style="display:none">
                                        <span class="input-group-addon">Producto que esta dando de alta:</span>
                                        <input type="text" id="pro_q"  placeholder="Buscar producto..." class="form-control"  />
                                    </div>
                                    <div id="proSelected" class="input-group" style="display: block;">
                                        <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>" />
                                        <div class="alert alert-success">
                                            <strong><?php echo $r['name']; ?></strong>
                                            <a class="close" onclick="$('#pro_q').val('');
                                                    $('#proSelect').css('display', 'block');
                                                    $('#proSelected').html('').css('display', 'none');">&times;</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><div class="input-group">
                                    <span class="input-group-addon">Unidades:</span>
                                    <input name="pnum" type="text" id="pnum" class="form-control" />
                                </div>
                            </td>
                            <td><div class="input-group">
                                    <span class="input-group-addon">Precio de Compra:</span>
                                    <input name="ppri" type="text" id="ppri" class="form-control" />
                                </div>
                            </td>
                            <td><div class="input-group">
                                    <span class="input-group-addon">Proveedor:</span>
                                    <select name="ppro" id="ppro" class="select form-control">
                                        <option value="0">Sin proveedor</option>
                                        <?php
                                        $q = mysqli_query("select * from purchase_provider order by name");
                                        while ($r = mysqli_fetch_array($q)) {
                                            echo "<option value=\"{$r["id"]}\">" . utf8_encode($r["name"]) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><div class="input-group">
                                    <span class="input-group-addon">Almac&eacute;n:</span>
                                    <select name="psto" id="psto" class="form-control">
                                        <?php
                                        $q = mysqli_query("select * from warehouse_store") or die(mysqli_error());
                                        while ($r = mysqli_fetch_array($q)) {
                                            $sid = $r[0];
                                            $sname = $r[1];
                                            ?>
                                            <option value="<?php echo $sid; ?>"><?php echo $sname; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <?php
                                if ($r['expire'] == '1') {
                                    ?>
                                    <div class="input-group">
                                        <span class="input-group-addon">Fecha de Caducidad:</span>
                                        <input name="expire_date" id="expire_date" />
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            $('#expire_date').datepicker({dateFormat: 'Y-m-d'})
                                        });
                                    </script>
                                    <?php
                                } else {
                                    ?>
                                    <strong class="text-success">Producto Sin Caducidad</strong>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr class="last">
                            <td colspan="4">
                                <button class="btn btn-primary" type="submit">
                                    Dar de Alta
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#pro_q').autocomplete({
                            source: 'include/modules/warehouse/pro.live.php',
                            minLength: 2,
                            select: function (event, ui) {
                                $('#proSelect').css('display', 'none');
                                var htm = '<input type="hidden" id="pid" name="pid" value="' + ui.item.id + '" />';

                                htm += "<div class=\"alert\">" + ui.item.value;
                                htm += '<a class="close" onclick="$(\'#pro_q\').val(\'\');$(\'#proSelect\').css(\'display\',\'block\');$(\'#proSelected\').html(\'\').css(\'display\',\'none\');">&times;</a>';
                                +"</div>";

                                $('#proSelected').html(htm);
                                $('#proSelected').css('display', 'block');
                            }
                        });
                    });

                </script>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>ERROR: <small>El producto que desea dar de alta no existe!</small></h4>
            </div>
            <?php
        }
        break;
    case 11:
        $pid = $_REQUEST["pid"];
        $num = $_REQUEST["pnum"];
        $pbuy = $_REQUEST["ppri"];
        $pro = $_REQUEST["ppro"];
        $store = $_REQUEST["psto"];
        product_up($pid, $num, $store);
        /* Informacion del Producto */
        $q = mysqli_query("select * from warehouse_product where id=$pid");
        while ($r = mysqli_fetch_array($q)) {
            $name = $r["name"];
        }
        /* Informacion del Almacen */
        $q = mysqli_query("select * from warehouse_store where id=$store");
        while ($r = mysqli_fetch_array($q)) {
            $storen = $r["name"];
        }
        /* Realizar Alta de Producto */
        $a1 = date("Y-m-d");
        $a2 = date("H:i:s");
        $a3 = $_SESSION["CORE"]["user"]["name"];
        $a4 = "Alta";
        $a5 = "El usuario <b>$a3</b> dio de alta <b>$num</b> unidad(es) del producto <b>$name</b> al almac&eacute;n <b>$storen</b>
                    <br/>Fecha de Registro: <b>$a1</b> a las <b>$a2</b>";
        $q = mysqli_query("insert into warehouse_moves(fecha,hora,user_id,action,description) VALUES('$a1','$a2','$a3','$a4','$a5')");
        ?>
        <div class="alert alert-info">
            <h4><?php echo $a5; ?></h4>                    
        </div>
        <div class="well well-sm">
            <a class="btn btn-primary" href="<?php echo $url; ?>&o=2">Ver Productos</a>
        </div>
        <?php
        writeLog("$m", $s, "El usuario {$_SESSION["CORE"]["user"]["name"]} di&oacute; de alta $num unidades del procuto $name al almacen $storen");
        break;
    case 12:
        /* Baja de producto */
        $pid = $_REQUEST["pid"];
        ?>
        <form action="<?php echo $url; ?>&o=13" method="post">
            <table <?php echo TBLcss; ?>>
                <tr class="first">
                    <td colspan="2"><h4>Dar de Baja un producto</h4></td>
                </tr>                    
                <tr>
                    <td>Producto:</td>
                    <td>
                        <?php
                        if ($pid == "") {
                            ?>
                            <div id="proSelect">
                                <input type="text" id="pro_q" maxlength="12"  />
                            </div>
                            <div id="proSelected" style="display: none;">                                    
                            </div>
                            <?php
                        } else {
                            $q = mysqli_query("select * from warehouse_product where id=$pid");
                            while ($r = mysqli_fetch_array($q)) {
                                $pname = $r["name"];
                            }
                            ?>
                            <div id="proSelect" style="display:none">
                                <input type="text" id="pro_q" maxlength="12"  />
                            </div>
                            <div id="proSelected" style="display: block;">
                                <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>" />
                                <div class="alert alert-success">
                                    <strong><?php echo $pname; ?></strong>
                                    <a class="close" onclick="$('#pro_q').val('');
                                            $('#proSelect').css('display', 'block');
                                            $('#proSelected').html('').css('display', 'none');">&times;</a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Cantidad:</td>
                    <td>
                        <input type="text" id="cantidad" name="cantidad" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td>Almac&eacute;n:</td>
                    <td>
                        <div id="show_store">
                            <button type="button" class="btn btn-primary btn-small" onclick="loadStore()">
                                <i class="fa fa-search"></i> Ver Almacenes
                            </button>
                        </div>
                        <div id="astore"></div>
                    </td>
                </tr>
                <tr class="second">
                    <td>Motivo:</td>
                    <td>
                        <select id="type" name="type" class="form-control">
                            <option value="0">Elija...</option>
                            <option value="1">Extravio</option>
                            <option value="2">Da&ntilde;o</option>
                            <option value="3">Cortes&iacute;a</option>
                            <option value="4">Devoluci&oacute;n</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Descripci&oacute;n:</td>
                    <td><textarea class="form-control" cols="25" rows="3" id="desc" name="desc"></textarea></td>
                </tr>
                <tr>
                    <td>Responsable:</td>
                    <td>
                        <select id="user" name="user" class="form-control">
                            <?php
                            $q = mysqli_query("select * from core_user");
                            while ($r = mysqli_fetch_array($q)) {
                                echo '<option value="' . $r["id"] . '">' . $r["user_name"] . " " . $r["user_last_p"] . " " . $r["user_last_m"] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="well well-sm">
                <button class="btn btn-danger" onclick="doDown()">
                    Dar de Baja
                </button>
            </div>
        </form>
        <script type="text/javascript">
            function loadStore() {
                if ($('#pid').val() != '') {
                    $('#astore').load('include/modules/warehouse/helper.live.php', {mode: 0, pid: $('#pid').val()})
                } else {
                    alert('Debes seleccionar un producto...')
                }
            }
            $(document).ready(function () {
                $('#pro_q').autocomplete({
                    source: 'almacen/pro.live.php',
                    minLength: 2,
                    select: function (event, ui) {
                        $('#proSelect').css('display', 'none');
                        var htm = '<input type="hidden" id="pid" name="pid" value="' + ui.item.id + '" />';

                        htm += "<div class=\"alert\">" + ui.item.value;
                        htm += '<a class="close" onclick="$(\'#pro_q\').val(\'\');$(\'#proSelect\').css(\'display\',\'block\');$(\'#proSelected\').html(\'\').css(\'display\',\'none\');">&times;</a>';
                        +"</div>";

                        $('#proSelected').html(htm);
                        $('#proSelected').css('display', 'block');
                    }
                });
            });

        </script>
        <?php
        break;
    case 13:
        /* Realizar baja de producto */
        $type = $_REQUEST["type"];
        switch ($type) {
            case '1':
                $ra = "Extrav&iacute;o";
                break;
            case '2':
                $ra = "Da&ntilde;o";
                break;
            case '3':
                $ra = "Cortes&iacute;a";
                break;
            case '4':
                $ra = "Devoluci&oacute;";
                break;
            default:
                $ra = "Otra";
        }
        $pid = $_REQUEST["pid"];
        $cant = $_REQUEST["cantidad"];
        $store = $_REQUEST["store"];
        $desc = $_REQUEST["desc"];
        $user = $_REQUEST["user"];
        $date = date("Y-m-d");
        $time = date("H:i:s");
        /* Quitar el producto del almacen */
        product_down($pid, $cant, $store);
        /* AGREGAR EL REGISTRO DE BAJA */
        $sql = "insert into warehouse_down(fecha,hora,razon,producto,cantidad,almacen,descripcion,responsable)";
        $sql .= "VALUES('$date','$time','$ra','$pid','$cant','$store','$desc','$user')";
        $q = mysqli_query($sql) or $e = mysqli_error();
        $q = mysqli_query("select * from warehouse_product where id=$pid");
        while ($r = mysqli_fetch_array($q)) {
            $name = $r["name"];
        }
        $q = mysqli_query("select * from warehouse_store where id=$store");
        while ($r = mysqli_fetch_array($q)) {
            $storen = $r["name"];
        }
        ?>
        <h4>Se ha dado de baja <?php echo $cant; ?> unidades del producto "<?php echo $name; ?>" <small>dado de baja debido a <b><?php echo $ra; ?></b> reportado por <b><?php echo $_SESSION["CORE"]["user"]["name"]; ?></b></small></h4>
        <div class="well well-sm">
            <a class="btn btn-primary" href="<?php echo $url; ?>&o=2">Ver Productos</a>
        </div>
        <?php
        writeLog("$m", $s, "El usuario {$_SESSION["CORE"]["user"]["name"]} di&oacute; de baja $cant unidades del producto $name del almac&eacute;n $storen por $ra");
        break;
    case 14:
        $owner = $_SESSION["CORE"]["corp"]["id"];
        $pid = $_REQUEST["pid"];
        $q = mysqli_query("SELECT * from warehouse_product WHERE id=$pid");
        $n = mysqli_num_rows($q);
        if ($n > 0) {
            while ($r = mysqli_fetch_array($q)) {
                $pname = $r["name"];
                $p_1 = $r["p_1"];
            }
            ?>
            <form action="./?m=warehouse&s=product&o=15" method="post">
                <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>" />
                <div class="alert alert-success">
                    <h4><small>ALTA DE </small><?php echo $pname; ?></h4>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <td colspan="6">
                                <p class="text-info">
                                    <strong>Tipo de Acci&oacute;n a realizar:</strong>
                                    <input type="radio" name="tipo" value="E" checked="checked" /> Entrada
                                    <input type="radio" name="tipo" value="S" /> Salida
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <th>Fecha:</th>
                            <th>Hora:</th>
                            <th>Unidades:</th>
                            <th>P.Unitario:</th>
                            <th>Proveedor:</th>
                            <th>Almac&eacute;n:</th>
                        </tr>
                    </thead>
                    <tr>
                        <td><input type="text" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" size="8" /></td>                        
                        <td><input type="text" class="form-control" id="time" name="time" placeholder="00:00" value="<?php echo date("H:i"); ?>" size="3" /></td>                        
                        <td><input type="text" class="form-control" id="U" name="U" value="1" size="1" /></td>                        
                        <td><input type="text" class="form-control" id="PU" name="PU" value="<?php echo $p_1; ?>" size="4" /></td>                        
                        <td><select id="pro" name="pro" class="form-control">
                                <option value="0">Ninguno</option>
                                <?php
                                $sq = mysqli_query("SELECT * from crm_corp WHERE isProvider='1' and owner='{$_SESSION["CORE"]["corp"]["id"]}'");
                                while ($sr = mysqli_fetch_array($sq)) {
                                    echo "<option value=\"{$sr[0]}\">" . utf8_encode($sr["name"]) . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><select id="store" name="store" class="form-control">
                                <?php
                                $sq = mysqli_query("SELECT * from warehouse_store WHERE owner='$owner'");
                                while ($sr = mysqli_fetch_array($sq)) {
                                    echo "<option value=\"{$sr[0]}\">{$sr['name']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><div class="input-group">
                                <span class="input-group-addon">Informacion adicional:</span>
                                <textarea id="comm" name="comm" class="form-control"></textarea>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="well well-sm">
                    <div class="btn-group">
                        <a href="./?m=warehouse&s=product&o=2" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-primary">Guardar <i class="fa fa-chevron-right"></i></button>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#date').datepicker({dateFormat: 'yy-mm-dd'});
                        $('#U').spinner();
                    });
                </script>
            </form>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>NO se encontro&oacute; el producto seleccionado</h4>
            </div>
            <?php
        }
        break;
    case 15:
        $pid = $_REQUEST["pid"];        // # ID de Producto
        $store = $_REQUEST["store"];    // # Almacen al que va dirigida
        $time = $_REQUEST["time"];      // # Hora de Registro
        $mode = $_REQUEST["tipo"];      // # Tipo de Movimiento E:Entrada, S:Salida
        $date = $_REQUEST["date"];      // # Fecha del Registro
        $u = $_REQUEST["U"];            // # U Unidades
        $PU = $_REQUEST["PU"];          // # PU Precio de Compra
        $pro = $_REQUEST["pro"];        // # Proveedor
        $comm = $_REQUEST["comm"];      // # Comentario acerca de esta alta.

        $pname = getData($pid, "warehouse_product", "name");
        product_up($pid, $u, $store);
        ?>
        <h4>Se han dado de alta  <?php echo $u; ?> Unidades del producto <?php echo $pname; ?></h4>
        <div class="well well-sm">
            <a href="./?m=warehouse&s=product&o=2" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Regresar</a>
        </div>
        <?php
        break;
    case 20:
        ?>
        <form target="blank" action="./include/modules/warehouse/prize.download.php" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="well well-small">
                        <div id="phpTree" style="width:98%;margin:0px auto;"></div>
                        <script>
                            $(document).ready(function () {
                                phpTree('phpTree', 'inc/phpTree.addon.php');
                            });
                        </script>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="cat_sel">
                        <b>No tiene ning&uacute;na Categor&iacute;a</b>
                        <input type="hidden" id="cats" name="cats" value="0" />
                    </div>
                    <div>
                        <strong>Seleccione Tienda:</strong><br/>
                        <select id="store" name="store" class="form-control">
                            <option value="0">Todas</option>
                            <?php
                            $sq = mysqli_query("select * from warehouse_store");
                            while ($sr = mysqli_fetch_array($sq)) {
                                ?>
                                <option value="<?php echo $sr[0]; ?>"><?php echo $sr[1]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                            
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Continuar <i class="fa fa-chevron-right"></i></button>
                    </div>
                </div>                        
            </div>
        </form>
        <?php
        break;
    case 21:
        ?>
        <div class="page-header">
            <h3>Actualizaci&oacute;n de Listas de Precios<small> desde un archivo de Excel<sup>&reg;</sup> 2007</small></h3>
        </div>
        <form target="blank" action="./include/modules/warehouse/prize.upload.php" method="post" enctype="multipart/form-data">
            <div class="alert alert-success">
                <strong>Seleccionar Archivo:</strong><br/>
                <input type="file" id="file" name="file" /><br/><br/>
                <button type="submit" class="btn btn-success btn-large"><i class="fa fa-upload-alt"></i> Enviar Archivo</button>
                <input name="action" type="hidden" value="upload" />
                <br/>
                <small>
                    Seleccionar el archivo de <strong>Excel</strong><sup>&reg;</sup> 2007 que ha descargado con los precios actualizados. No se soporta otro formato de archivos
                </small>
            </div>
        </form>
        <?php
        break;
    case 30:
        $q = mysqli_query("SELECT * from warehouse_product");
        while ($r = mysqli_fetch_array($q)) {
            $id = $r["id"];
            if (strstr($r["store"], ",") != "") {
                $s = explode(",", $r['store']);
                $u = explode(",", $r['units']);
                for ($i = 0; $i < count($s); $i++) {
                    if ($s[$i] == "") {
                        $u[$i - 1]+=$u[$i];
                        unset($s[$i]);
                        unset($u[$i]);
                    }
                }
                $s = implode(",", $s);
                $u = implode(",", $u);
            } else {
                $s = $r["store"];
                $u = $r["units"];
            }
            if ($s != "") {
                mysqli_query("UPDATE warehouse_product set store='$s',units='$u' WHERE id=$id") or $e = mysqli_error();
                if (!isset($e)) {
                    echo "<h4>Actualizado...</h4>";
                } else {
                    echo "<h4>ERROR id $id</h4>";
                }
            }
        }
        break;
}
?>
<script>
    function addCat() {
        var a = $('#catm').val();
        if (a != "") {
            var O = a.split("/");
            var isA = a.search("/");
            if (isA > 0) {
                // Array
                var htm = "";
                for (i = 0; i < O.length; i++) {
                    if (i == 0) {
                        htm += "<span class=\"label label-default\">" + O[i] + "</span>";
                        $('#cats').val(O[i]);
                    } else {
                        htm += " <strong>/</strong> <span class=\"label label-default\">" + O[i] + "</span>";
                        var Ox = $('#cats').val() + "/" + O[i];
                        $('#cats').val(Ox);
                    }
                }
                $('#cat_man').html(htm);
            } else {
                if ($('#cat_man').html() == "Ninguna") {
                    var htm = "<span class=\"label label-default\">" + a + "</span>";
                    $('#cat_man').html(htm);
                    $('#cats').val(a);
                } else {
                    var htm = " <strong>/</strong> <span class=\"label label-default\">" + a + "</span>";
                    var aHTML = $('#cat_man').html();
                    var b = $('#cats').val() + "/" + a;
                    $('#cats').val(b);
                    $('#cat_man').html(aHTML + htm);
                }
            }
        }
        $('#catm').val("");
    }
</script>
