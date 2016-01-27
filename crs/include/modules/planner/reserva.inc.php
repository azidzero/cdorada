<?php
include("../../../inc/app.conf.php");
$pid = $_REQUEST["pid"];
$ini = $_REQUEST["date_ini"];
$end = $_REQUEST["date_end"];
$title = getData("cms_property", "id", $pid, "title");

function calcTarifa($pid, $start, $end) {
    global $CNN;
    $prize = 0;
    $sql = "SELECT 
  crs_rates_detail.*,
  crs_rates_use.pid ,
  crs_rates_use.rid
FROM 
  crs_rates_use,
  crs_rates_detail
WHERE 
  crs_rates_use.pid='$pid' AND crs_rates_detail.rid=crs_rates_use.rid AND '$start' >=crs_rates_detail.date_ini
  OR crs_rates_use.pid='$pid' AND crs_rates_detail.rid=crs_rates_use.rid AND '$start' <=crs_rates_detail.date_end
  OR crs_rates_use.pid='$pid' AND crs_rates_detail.rid=crs_rates_use.rid AND '$end' >=crs_rates_detail.date_ini
  OR crs_rates_use.pid='$pid' AND crs_rates_detail.rid=crs_rates_use.rid AND '$end' <=crs_rates_detail.date_end";
    $q = mysqli_query($CNN, $sql);
    while ($r = mysqli_fetch_array($q)) {
        $a = new DateTime($r['date_ini']);
        $b = new DateTime($r['date_end']);
    }
    return $prize;
}
?>
<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#reserva" aria-controls="home" role="tab" data-toggle="tab">Reservacion</a></li>
        <li role="presentation"><a href="#customer" aria-controls="customer" role="tab" data-toggle="tab">Inquilino</a></li>
        <li role="presentation"><a href="#addon" aria-controls="addon" role="tab" data-toggle="tab">Complementos</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="reserva">
            <table class="tabel table-condensed">
                <tr>
                    <td rowspan="8">
                        <div id="reserva_total">0.00</div>
                    </td>
                    <td>Alojamiento:</td>
                    <td><input type="hidden" name="pid" /> <?php echo $title; ?>
                </tr>
                <tr>
                    <td>Entrada:</td>
                    <td><input type="text" namne="date_ini" class="form-control" value="<?php echo $ini; ?>" /></td>
                </tr>
                <tr>
                    <td>Salida:</td>
                    <td><input type="text" namne="date_out" class="form-control" value="<?php echo $end; ?>" /></td>
                </tr>
                <tr>
                    <td>Mediante:</td>
                    <td><select id="medio" name="medio" class="form-control">
                            <option value="internet">Internet</option>
                            <option value="oficina">Oficina</option>
                            <option value="email">Email</option>
                            <option value="telefono">Telefono</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Salida:</td>
                    <td><input type="text" namne="date_out" class="form-control" value="<?php echo $end; ?>" /></td>
                </tr>

            </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="customer">
            <table class="table table-condensed">
                <tr>
                    <td><div class="input-group">
                            <span class="input-group-addon">Codigo</span>
                            <input type="text" id="code" name="code" value="0" class="form-control disabled" />
                        </div>                        
                    </td>
                    <td colspan="2">
                        <div class="input-group">
                            <input type="text" id="sc" name="sc" class="form-control" />
                            <span class="input-group-btn">
                                <a href="javascript:void(0)" class="btn btn-default"><i class="fa fa-search"></i></a>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" id="c_name" name="c_name" class="form-control" /></td>
                    <td>Primer Apellido</td>
                    <td><input type="text" id="c_first" name="c_first" class="form-control" /></td>
                    <td>Segundo Apellido</td>
                    <td><input type="text" id="c_last" name="c_last" class="form-control" /></td>
                </tr>
                <tr>
                    <td>No.Documento de Identidad</td>
                    <td><input type="text" id="dni_no" name="dni_no" class="form-control" /></td>
                    <td>Tipo de Documento</td>
                    <td><select id="dni_tipo" name="dni_tipo" class="form-control">
                            <option value="D">DNI</option>
                            <option value="P">Pasaporte</option>
                            <option value="C">Permiso de Conducir</option>
                            <option value="I">Carta o Documento de Identidad</option>
                            <option value="N">Permiso de Residencia Espa&ntilde;ol</option>
                            <option value="X">Permiso de Residencia de otro estado miembro de la U.Europea</option>
                        </select></td>                    
                    <td>Fecha de Expdici&oacute;n</td>
                    <td><input type="text" id="dni_exp" name="dni_exp" class="form-control" /></td>                    
                </tr>
                <tr>
                    <td>Pa&iacute;s de Nacionalidad</td>
                    <td><input type="text" id="dni_country" name="dni_country" class="form-control" /></td>
                    <td>Idioma</td>
                    <td><input type="text" id="dni_lang" name="dni_lang" class="form-control" /></td>
                </tr>
                <tr>                    
                    <td>Direcci&oacute;n</td>
                    <td><input type="text" id="c_address" name="c_address" class="form-control" /></td>
                    <td>Localidad</td>
                    <td><input type="text" id="c_locale" name="c_locale" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Codigo Postal</td>
                    <td><input type="text" id="c_cp" name="c_cp" class="form-control" /></td>                    
                    <td>Movil</td>
                    <td><input type="text" id="c_cellphone" name="c_cellphone" class="form-control" /></td>
                    <td>Correo Electronico</td>
                    <td><input type="text" id="c_email" name="c_email" class="form-control" /></td>
                </tr>
                <tr>
                    <td colspan="6"><div class="input-group">
                            <span class="input-group-addon"> Observaciones</span>
                            <textarea id="c_name" name="c_name" class="form-control"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div role="tabpanel" class="tab-pane" id="addon"></div>
    </div>
</div>