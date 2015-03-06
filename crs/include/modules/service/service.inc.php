<?php
$o = $this->C->a_o;
switch ($o) {
    case 0:
        ?>
        <form action="./?m=service&s=service&o=1" method="post">
            <h4>Definici&oacute;n de Servicios</h4>
            <table class="table table-condensed">
                <tr>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">&Aacute;rea:</span><select id="area" name="area" class="form-control">
                                <?php
                                $sq = mysql_query("SELECT * from services_area WHERE owner='{$_SESSION["CORE"]["corp"]["id"]}'");
                                while ($sr = mysql_fetch_array($sq)) {
                                    echo "<option value=\"{$sr[0]}\">{$sr["name"]}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">Nombre:</span><input type="text" id="name" name="name" class="form-control" placeholder="Nombre del Area" />
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">C&oacute;digo:</span><input type="text" id="code" name="code" class="form-control" placeholder="Nombre del Area" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="input-group">
                            <span class="input-group-addon">Descripci&oacute;n:</span>
                            <textarea id="desc" name="desc" class="form-control"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="well well-sm">
                <button type="submit" class="btn btn-success">Continuar <i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
        <?php
        break;
}