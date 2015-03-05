<?php
switch ($o) {
    case 0:
        ?>
        <form action="./?m=warehouse&s=carriage&o=1" method="post">
            <h4>Nuevo Transporte</h4>
            <table <?php echo TBLcss; ?>>
                <tr>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">Marca</span><input type="text" id="brand" name="brand" class="form-control" />
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">Modelo</span><input type="text" id="model" name="model" class="form-control" />                            
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">A&ntilde;o</span><input type="text" id="year" name="year" class="form-control" />                            
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">Placas</span><input type="text" id="placa" name="placa" class="form-control" />                            
                        </div>
                    </td>
                </tr>
            </table>
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Continuar <i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
        <?php
        break;
    case 1:
        $placa = $_REQUEST["placa"];
        $q = mysql_query("SELECT * from warehouse_carriage WHERE placa='$placa'");
        $n = mysql_num_rows($q);
        if ($n > 0) {
            ?>
            <div class="alert alert-warning">
                <h4>Error al dar de alta el veh&iacute;culo</h4>
                <p>Ya existen un veh&iacute;culo registrado con las placas: <?php echo $placa; ?></p>
            </div>
            <?php
        } else {
            mysql_Query("INSERT INTO warehouse_carriage(brand,model,year,placa,owner) VALUES('{$_REQUEST["brand"]}','{$_REQUEST["model"]}','{$_REQUEST["year"]}','{$_REQUEST["placa"]}','{$_SESSION["CORE"]["corp"]["id"]}')") or $e = mysql_errno() . ": " . mysql_error();
            if (!isset($e)) {
                ?>
                <div class="alert alert-success">
                    <h4>Se a Agregado el Veh&iacute;culo con las placas <b><?php echo $_REQUEST["placa"]; ?></b> en el Sistema</h4>
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
        }
        ?>
        <div class="well well-sm">
            <a class="btn btn-default" href="./?m=warehouse&s=carraige&o=0"> Agregar Nuevo</a>
            <a class="btn btn-default" href="./?m=warehouse&s=carriage&o=2"> Ir a la administraci&oacute;n</a>
        </div>
        <?php
        break;
    case 2:
        ?>
        <table id="tbl_admin" class="table table-condensed table-bordered table-striped">
            <thead>
                <tr>
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>A&ntilde;o</td>
                    <td>Placas</td>                    
                    <td width="128"><i class="fa fa-th-list"></i></td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function() {
                jTable("tbl_admin", "include/modules/warehouse/carriage.table.php");
            });
        </script>
        <?php
        break;
    case 3:
        $id = $_REQUEST["id"];
        $q = mysql_query("select * from warehouse_carriage where id=$id") or die(mysql_error());
        while ($r = mysql_fetch_array($q)) {
            ?>
            <form action="./?m=warehouse&s=carriage&o=4" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                <h4>Nuevo Transporte</h4>
                <table <?php echo TBLcss; ?>>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Marca</span><input type="text" id="brand" name="brand" class="form-control" value="<?php echo $r["brand"]; ?>" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Modelo</span><input type="text" id="model" name="model" class="form-control" value="<?php echo $r["model"]; ?>" />                            
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">A&ntilde;o</span><input type="text" id="year" name="year" class="form-control" value="<?php echo $r["year"]; ?>" />                            
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Placas</span><input type="text" id="placa" name="placa" class="form-control" value="<?php echo $r["placa"]; ?>" />                            
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Continuar <i class="fa fa-chevron-right"></i></button>
                </div>
            </form>
            <?php
        }
        break;
    case 4:

        $sql = "UPDATE warehouse_carriage SET ";
        $sql.= "brand='{$_REQUEST["brand"]}'";
        $sql.= ",model='{$_REQUEST["model"]}'";
        $sql.= ",year='{$_REQUEST["year"]}'";
        $sql.= ",placa='{$_REQUEST["placa"]}'";        
        $sql.= " WHERE id={$_REQUEST["id"]}";
        mysql_query($sql) or $e = mysql_error();
        if (!isset($e)) {
            ?>
            <div class="alert alert-success">
                <h4>Se a actualizado el veh&iacute;culo con placas <?php echo $_REQUEST["placa"];?></h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>Ha ocurrido un error al tratar de actualizado el Veh&iacute;culo</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="well well-sm">
            <div class=" btn-group">
                <a class="btn btn-default" href="./?m=warehouse&s=carriage&o=2"><i class="fa fa-chevron-left"></i> Regresar</a>
                <a class="btn btn-default" href="./?m=warehouse&s=carriage&o=0">Nuevo <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        <?php
        break;
    case 5:
        $id = $_REQUEST["id"];
        ?>
        <form action="./?m=warehouse&s=carriage&o=6" method="post">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
            <div class="alert alert-danger">
                <h4>Estas a punto de eliminar este vech&iacute;culo</h4>
                <p>Esta acci&oacute;n no se puede deshacer, esta seguro de continuar?</p>                
            </div>
            <div class="well well-sm">
                <div class="btn-group">
                    <a class="btn btn-default" href="./?m=warehouse&s=carriage&o=2"><i class="fa fa-chevron-left"></i> Regresar</a>
                    <button type="submit" class="btn btn-default">Continuar <i class="fa fa-chevron-right"></i></button>
                </div>
            </div>
        </form>
        <?php
        break;
    case 6:
        $id = $_REQUEST["id"];       
        mysql_query("delete from warehouse_carriage WHERE id=$id") or $e = mysql_error();
        if (!isset($e)) {
            ?>
            <div class="alert alert-success">
                <h4>Se a eliminado el vech&iacute;culo</h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>Ha ocurrido un error al tratar de eliminar el veh&iacute;culo</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="well well-sm">
            <div class=" btn-group">
                <a class="btn btn-default" href="./?m=warehouse&s=carriage&o=2"><i class="fa fa-chevron-left"></i> Regresar</a>
                <a class="btn btn-default" href="./?m=warehouse&s=carriage&o=0">Nuevo <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
        <?php
        break;
}