<?php
switch ($o) {
    case 0:
        ?>
        <form action="./?m=service&s=area&o=1" method="post">
            <h4>Definici&oacute;n de &Aacute;rea de Servicio</h4>
            <table class="table table-condensed">
                <tr>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">C&oacute;digo:</span><input type="text" id="code" name="code" placeholder="XXX" class="form-control" />
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">Nombre:</span><input type="text" id="name" name="name" placeholder="Nombre del Area" class="form-control" />
                        </div>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success">Continuar <i class="fa fa-chevron-right"></i></button>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        break;
    case 1:
        $code = $_REQUEST["code"];
        $name = $_REQUEST["name"];
        mysqli_query($this->C->CNN, "INSERT INTO service_area(code,name) VALUES('$code','$name')") or $e = mysqli_errno() . ": " . mysqli_error();
        if (!isset($e)) {
            ?>
            <div class="alert alert-success">
                <h4>Se ha agregado el &aacute;rea <?php echo $name; ?> al sistema</h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>No se ha agregado el &aacute;rea <?php echo $name; ?> al sistema</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="well well-sm">
            <div class="btn-group">
                <a href="./?m=service&s=area&o=0" class="btn btn-default">Agregar Nueva &Aacute;rea</a>
                <a href="./?m=service&s=area&o=2" class="btn btn-default">Ir a adminstrar</a>
            </div>
        </div>
        <?php
        break;
    case 2:
        ?>
        <table id="tbl" class="table table-condensed">
            <thead>
                <tr>
                    <td>C&oacute;digo</td>
                    <td>&Aacute;rea</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function () {
                jTable('tbl', 'include/modules/service/area.table.php');
            });
        </script>
        <?php
        break;
    case 3:
        $id = $_REQUEST["id"];
        $q = mysqli_query($this->C->CNN, "SELECT * from service_area WHERE id=$id");
        while ($r = mysqli_fetch_array($q)) {
            ?>
            <form action="./?m=service&s=area&o=4" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $r["id"]; ?>" />
                <h4>Definici&oacute;n de &Aacute;rea de Servicio</h4>
                <table class="table table-condensed">
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">C&oacute;digo:</span>
                                <input type="text" id="code" name="code" placeholder="XXX" class="form-control" value="<?php echo $r["code"]; ?>" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Nombre:</span>
                                <input type="text" id="name" name="name" placeholder="Nombre del Area" class="form-control" value="<?php echo $r["name"]; ?>" />
                            </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success">Continuar <i class="fa fa-chevron-right"></i></button>
                        </td>
                    </tr>
                </table>
            </form>
            <?php
        }
        break;
    case 4:
        $id = $_REQUEST["id"];
        $code = $_REQUEST["code"];
        $name = $_REQUEST["name"];
        mysqli_query($this->C->CNN, "UPDATE service_area SET code='$code',name='$name' WHERE id=$id") or ( $e = mysqli_error($this->C->CNN));
        if (!isset($e)) {
            ?>
            <div class="panel panel-success">
                <div class="panel-body">
                    <h4>Se ha actualizado el &aacute;rea de Servicio</h4>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="panel panel-danger">
                <div class="panel-body">
                    <h4>No se ha actualizado el &aacute;rea de Servicio</h4>
                    <p><?php echo $e; ?>
                </div>
            </div>
            <?php
        }
        break;
    case 5:
        break;
    case 6:
        break;
}