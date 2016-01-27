<?php
include("../../../inc/app.conf.php");
$pid = filter_input(INPUT_POST, "pid");
$date_ini = filter_input(INPUT_POST, "date_ini");
$date = explode("-", $date_ini);
$date_end = date("Y-m-d", mktime(0, 0, 0, $date[1], $date[2] + 7, $date[0]));
?>
<table class="table table-condensed">
    <tr>
        <td>
            <div class="input-group">
                <span class="input-group-addon">Propiedad</span>
                <input size="2" type="text" disabled="disabled" id="pid" name="pid" value="<?php echo $pid; ?>" class="form-control" />
            </div>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" id="date_ini" name="date_ini" value="<?php echo $date_ini; ?>" class="form-control" />
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" id="date_end" name="date_end" value="<?php echo $date_end; ?>" class="form-control" />
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="input-group">
                <span class="input-group-addon"><b>Agencia:</b></span>
                <select id="agencia" name="agencia" class="form-control">
                    <option value="0">Ninguna</option>
                    <?php
                    ?>
                </select>
        </td>
        <td><div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i> Agente</span>
                <select id="agente" name="agente" class="form-control">
                    <option value="0">Ninguno</option>
                </select>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="input-group">
                <span class="input-group-addon"><b>Reserva realizada por: </b></span>
                <input type="text" id="reservo" name="reservo" class="form-control" />
            </div>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-addon"><b>Medio: </b></span>
                <select id="reserva_medio" name="reserva_medio" class="form-control">
                    <option value="0">Ninguno</option>
                </select>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="input-group">
                <span class="input-group-addon">Adultos:</span>
                <input type="text" id="reserva_a" name="reserva_a" class="form-control" />
            </div>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-addon">Ni&ntilde;os:</span>
                <input type="text" id="reserva_k" name="reserva_k" class="form-control" />
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <b>Solicitudes:</b>
            <div>

            </div>
        </td>
    </tr>
</table>
<?php
