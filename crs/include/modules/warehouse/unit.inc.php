
<div class="row">
    <?php
    $o = $_REQUEST["o"];
    switch ($o) {
        case 0:
            ?>
            <form class="form" action="./?m=warehouse&s=unit&o=1" method="post">
                <table class="table table-condensed table-bordered">
                    <tr>
                        <td>Unidad de medida:</td>
                        <td>Abreviatura:</td>
                        <td>Unidades:</td>
                        <td>Unidades Enteras:</td>
                    </tr>
                    <tr>
                        <td><input class="input-small" type="text" id="name" name="name" placeholder="ej. Metro" /></td>
                        <td><input class="input-small"  type="text" id="abbr" name="abbr" placeholder="ej. M" /></td>
                        <td><input class="input-small"  type="text" id="vol" name="vol" placeholder="ej. 2" /></td>
                        <td><input type="checkbox" id="onlyInt" name="onlyInt" value="1" /> Solo unidades enteras</td>
                    </tr>
                    <tr>
                        <td colspan="5"><button class="btn btn-primary" type="submit">Continuar <i class="fa fa-chevron-right"></i></button></td>
                    </tr>
                </table>
                <div class="alert alert-info">No se permite dar de alta unidades de medida de una sola "<strong>UNIDAD</strong>" o con ese nombre, ya que esa es la unidad base</div>
            </form>
            <?php
            break;
        case 1:
            $name = $_REQUEST["name"];
            $abbr = $_REQUEST["abbr"];
            $units = $_REQUEST["vol"];
            $int = $_REQUEST["onlyInt"];
            $q = mysql_query("INSERT INTO core_um(name,abbr,units,isint) VALUES('$name','$abbr',$units,'$int')") or $e = mysql_error();
            if (!isset($e)) {
                ?>
                <div class="alert alert-info">
                    <h4 class="alert-heading">Se a registrado <?php echo $name; ?></h4>
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
            ?>
            <div class="well well-sm">
                <div class="btn-group">
                    <a class="btn btn-primary" href="./?m=warehouse&s=unit&o=0">Agregar Otro</a>
                    <a class="btn btn-primary" href="./?m=warehouse&s=unit&o=2">Ver Registros</a>
                </div>
            </div>
            <?php
            break;
        case 2:
            ?>
            <table id="tbl_pro" <?php echo TBLcss; ?>>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Unidad</th>   
                        <th>Abbr.</th>
                        <th>Unidades</th>
                        <th>Solo Enteros</th>                        
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    jTable('tbl_pro', 'include/modules/warehouse/unit.table.php');
                });
            </script>
            <?php
            break;
        case 3:
            $pid = $_REQUEST["pid"];
            $q = mysql_query("select * from core_um where id=$pid") or die(mysql_error());
            while ($r = mysql_fetch_array($q)) {
                ?>
                <form class="form" action="./?m=warehouse&s=unit&o=4" method="post">
                    <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>" />
                    <table class="table table-condensed table-bordered">
                        <tr>
                            <td>Unidad de medida:</td>
                            <td>Abreviatura:</td>
                            <td>Unidades:</td>
                            <td>Unidades Enteras:</td>
                        </tr>
                        <tr>
                            <td><input class="input-small" type="text" id="name" name="name" placeholder="ej. Metro" value="<?php echo $r["name"]; ?>" /></td>
                            <td><input class="input-small"  type="text" id="abbr" name="abbr" placeholder="ej. M" value="<?php echo $r["abbr"]; ?>" /></td>
                            <td><input class="input-small"  type="text" id="vol" name="vol" placeholder="ej. 2" value="<?php echo $r["units"]; ?>" /></td>
                            <td><input <?php
                                if ($r["isint"] == 1) {
                                    echo "checked=\"checked\"";
                                }
                                ?> type="checkbox" id="onlyInt" name="onlyInt" value="1" /> Solo unidades enteras</td>
                        </tr>
                        <tr>
                            <td colspan="5"><button class="btn btn-primary" type="submit">Continuar <i class="fa fa-chevron-right"></i></button></td>
                        </tr>
                    </table>
                    <div class="alert alert-info">No se permite dar de alta unidades de medida de una sola "<strong>UNIDAD</strong>" o con ese nombre, ya que esa es la unidad base</div>
                </form>
                <?php
            }
            break;
        case 4:
            $sql = "UPDATE core_um set ";
            $sql .= "name='{$_REQUEST["name"]}',";
            $sql .= "abbr='{$_REQUEST["abbr"]}',";
            $sql .= "units='{$_REQUEST["vol"]}',";
            $sql .= "isint='{$_REQUEST["onlyInt"]}'";
            $sql .= " WHERE id={$_REQUEST["pid"]}";
            mysql_Query($sql) or $e = mysql_error();
            if (!isset($e)) {
                ?>
                <h3 class="alert alert-info">Se a actualizado la unidad de medida</h3>                            
                <?php
            } else {
                ?>
                <h3>Ha ocurrido un error</h3>
                <p>
                    <?php
                    echo $sql . ":<br/>" . $e;
                    ?>
                </p>
                <?php
            }
            ?>

            <div class="well well-sm">
                <div class="btn-group">
                    <a href="./?m=warehouse&s=unit&o=2" class="btn btn-primary" >Ir a administrar</a>
                    <a href="./?m=warehouse&s=unit&o=0" class="btn btn-primary" >Agregar Nuevo</a>
                </div>
            </div>
            <?php
            break;
        case 5:
            $pid = $_REQUEST["pid"];
            ?>
            <form action="./?m=warehouse&s=unit&o=6" method="post">
                <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>" />
                <h4>Eliminar Unidad de Medida</h4>
                <div class="alert alert-danger">
                    <h4>Esta a punto eliminar la unidad de medida seleccionada<small> Esta accion no se puede deshacer...</small></h4>
                    <strong>Estas seguro(a) que deseas continuar?</strong>
                </div>
                <div class="well well-sm">
                    <div class="btn-group">
                        <a class="btn btn-default" href="./?m=warehouse&s=unit&o=2"><i class="fa fa-chevron-left"></i> Regresar</a>
                        <button type="submit" class="btn btn-primary">Continuar <i class="fa fa-chevron-right"></i></button>
                    </div>
                </div>
            </form>
            <?php
            break;
        case 6:
            $pid = $_REQUEST["pid"];
            $q = mysql_query("delete from core_um where id='$pid'") or $e = mysql_error();
            if (!isset($e)) {
                ?>
                <div class="alert alert-success">   
                    <h3>Unidad de medida eliminada!</h3>
                </div>

                <?php
            } else {
                ?>
                <div class="alert alert-success">
                    <h3>Ha ocurrido un Error!</h3>
                    <p><?php echo $e; ?></p>
                </div>
                <?php
            }
            ?>
            <div class="well well-sm">
                <div class="btn-group">
                    <a href="./?m=warehouse&s=unit&o=2" class="btn btn-primary">Ir a administrar</a>
                    <a href="./?m=warehouse&s=unit&o=0" class="btn btn-primary">Nuevo</a>
                </div>
            </div>
            <?php
            break;
    }
    ?>
</div>