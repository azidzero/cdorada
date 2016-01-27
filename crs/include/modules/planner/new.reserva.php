<?php
$pid = filter_input(INPUT_POST, "pid");
$ini = new DateTime(filter_input(INPUT_POST, "fecha") . " 00:00:00"); // 2016-01-01
$wini = $ini->format('w');
$end = new DateTime($ini->format('Y-m-d') . " 00:00:00");
$end->add(new DateInterval('P6D'));
$wend = $end->format('w');
$diff = $ini->diff($end);
$noche = $diff->d;
$namepid = getData("cms_property", "id", $pid, 'title');

$SQL = "SELECT COUNT(*) reservas FROM crs_reserva WHERE pid='$pid' AND crs_reserva.ini BETWEEN '{$ini->format('Y-m-d')}' AND '{$end->format('Y-m-d')}' OR pid='$pid' AND '{$ini->format('Y-m-d')}'>=crs_reserva.ini AND '{$end->format('Y-m-d')}'<=crs_reserva.end OR pid='$pid' AND crs_reserva.end BETWEEN '{$ini->format('Y-m-d')}' AND '{$end->format('Y-m-d')}'";
$sq = mysqli_query($CNN, $SQL) or die(mysqli_error($CNN));
while ($sr = mysqli_fetch_array($sq)) {
    $sn = $sr["reservas"];
}
$costo = 0;
if ($sn > 0) {
    $status = "danger disabled";
    $stattex = "NO DISPONIBLE";
} else {
    $status = "success";
    $stattex = "DISPONIBLE";
    $pq = mysqli_query($CNN, "SELECT crs_rates_use.rid,crs_rates_detail.* FROM  crs_rates_use LEFT JOIN crs_rates_detail ON crs_rates_detail.rid=crs_rates_use.rid WHERE crs_rates_use.pid='$pid' AND date_ini BETWEEN '{$ini->format('Y-m-dx')}' AND '{$end->format('Y-m-d')}'") or die(mysqli_error($CNN));
    $pn = mysqli_num_rows($pq);
    if ($pn > 0) {
        $tarifas = true;
        while ($pr = mysqli_fetch_array($pq)) {
            $stra = strtotime($pr["date_ini"]);
            $strb = strtotime($pr["date_end"]);
            $strx = strtotime($ini->format('Y-m-d'));
            $stry = strtotime($end->format('Y-m-d'));
            /*
             * [--###][##---][-----]
             * [-----][#####][-----]
             * [-----][---##][###--]
             */
            if ($strx > $stra && $stry > $strb) {
                $x = new Datetime($ini->format('Y-m-d'));
                $xx = new DateTime($pr_["date_end"]);
                $xo = $x->diff($xx);
                $costo += $xo->d * $pr["diario"];
            } elseif ($strx < $stra && $stry > $stra && $stry < $strb) {
                $x = new Datetime($pr["date_ini"]);
                $xx = new DateTime($end->format('Y-m-d'));
                $xo = $x->diff($xx);
                $costo += $xo->d * $pr["diario"];
            } elseif ($stra >= $strx && $stry <= $strb) {
                $x = new Datetime($ini->format('Y-m-d'));
                $xx = new DateTime($end->format('Y-m-d'));
                $xo = $x->diff($xx);
                $costo += $xo->d * $pr["diario"];
            }
        }
    } else {
        $tarifas = false;
    }
}
$costo = round($costo, 0, PHP_ROUND_HALF_UP);
?>
<div class="container-fluid">    
    <div class="row-fluid">
        <?php
        if ($tarifas == true) {
            ?>
            <div class="col-sm-4">
                <div class="alert alert-<?php echo $status; ?>" style="height:52px;">
                    <button onclick="booking()" type="button" class="btn btn-lg btn-<?php echo $status; ?> pull-right">RESERVAR</button>
                    <span id="status" class="label label-pill label-<?php echo $status; ?>"><?php echo $stattex; ?></span><br/>
                    ID: <span id="oid" style="font-weight:bold">00000000</span>
                </div>                
                <input type="hidden" id="reservaid" name="reservaid" value="<?php $reservaid; ?>" />
                <b>Resumen de Reserva</b>
                <table class="table table-condensed total" style="font-size: 9pt;background:transparent;">
                    <thead style="font-weight: bold;">
                        <tr>
                            <td>Concepto</td>
                            <td width="1">Cant.</td>
                            <td width="1">Monto</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tarifa<br/><small><span><?php echo $noche; ?></span> Noche(s)</small></td>
                            <td width="1" class="amount number">1.00</td>
                            <td width="1" class="prize number"><?php echo number_format($costo, 2); ?></td>
                        </tr>
                        <tr>
                            <td>Gastos de Gesti&oacute;n:</td>
                            <td class="amount number">1.00</td>
                            <td class="prize number">20.00</td>
                        </tr>
                        <tr class="addons">
                            <td>Complementos:</td>
                            <td class="amount number">0.00</td>
                            <td class="prize number">0.00</td>
                        </tr>
                    </tbody>
                    <tfoot style="font-size:11pt;font-weight: bold;white-space: nowrap;">
                        <tr>
                            <td colspan="2">TOTAL</td>
                            <td class="real_total">20.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">DEPOSITO<small class="muted">(40%)</small></td>
                            <td class="real_deposito">20.00</td>
                        </tr>
                    </tfoot>
                </table>

                <b>PAGADO</b>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                </div>
                <b>Facturaci&oacute;n</b>
                <table class="table table-condensed">
                    <tr>
                        <td><button type="button" class="btn btn-block btn-primary disabled"><i class="fa fa-file-archive-o"></i> FACTURAR</button></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-8">
                <ul class="nav nav-tabs" role="tablist" style="background:#CCC;">
                    <li role="presentation" class="active"><a href="#reserva" aria-controls="home" role="tab" data-toggle="tab">Reserva</a></li>
                    <li role="presentation"><a href="#addons" aria-controls="addons" role="tab" data-toggle="tab">Complementos</a></li>
                    <li role="presentation"><a href="#cliente" aria-controls="cliente" role="tab" data-toggle="tab">Cliente</a></li>
                    <li role="presentation"><a href="#payment" aria-controls="payment" role="tab" data-toggle="tab">Cobranza</a></li>
                    <li role="presentation"><a href="#documento" aria-controls="documento" role="tab" data-toggle="tab">Documentos</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="reserva" style="padding:5px;">
                        <table class="table table-condensed">
                            <tr>
                                <td colspan="4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="fa fa-calendar"></span> <b>Entrada</b></div>
                                        <input type="text" class="form-control" id="ini" name="ini" value="<?php echo $ini->format('Y-m-d'); ?>" tabindex="1">
                                    </div>
                                </td>
                                <td colspan="4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="fa fa-calendar"></span> <b>Salida</b></div>
                                        <input type="text" class="form-control" id="end" name="end" value="<?php echo $end->format('Y-m-d'); ?>" tabindex="2">
                                    </div>
                                </td>
                                <td colspan="4">
                                    <div class="btn-group btn-group-sm">
                                        <a href="javascript:void(0);" class="btn btn-primary" alt="Checar Disponiblidad" onclick="piddisp(<?php echo $pid; ?>)" title="Checar Disponibilidad"><i class="fa fa-flag"></i> Verificar</a>                                        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>"> 
                                    <div id="pname">
                                        PROPIEDAD: <b><?php
                                            $pname = getData('cms_property', 'id', $pid, 'title');
                                            echo $pname;
                                            ?></b>
                                    </div> 
                                </td>                                
                                <td colspan="4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><label>Adultos<i class="fa fa-users"></i></label></div>
                                        <input type="number" class="form-control" min="1" value="1" id="adult" name="adult"  tabindex="3">
                                    </div>
                                </td>
                                <td colspan="4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><label>Ni&ntilde;os <i class="fa fa-child"></i></label></div>
                                        <input type="number" class="form-control" min="0" value="0"id="child" name="child"  tabindex="4">
                                    </div>
                                </td>
                            </tr>                                        
                            <tr>
                                <td colspan="6">
                                    <div class="input-group">
                                        <div class="input-group-addon"><label>RESERVA POR: <i class="fa fa-building-o"></i></label></div>
                                        <select id="por" name="por" class="form-control" onchange="agen(this.value)" tabindex="5">
                                            <option value="0">Agencia</option>
                                            <option value="1" selected>Cliente</option>
                                            <option value="2">Propietario</option>
                                        </select>
                                    </div>
                                </td>
                                <td colspan="6">
                                    <div class="input-group">
                                        <div class="input-group-addon">ORIGEN: <i class="fa fa-building-o" tabindex="6"></i></div>
                                        <select id="source" name="source" class="form-control" >
                                            <option value="null">Directo</option>
                                            <option value="0">Internet</option>
                                            <option value="1">Tel&eacute;fono</option>
                                            <option value="2">Correo Electr&oacute;nico</option>
                                            <option value="3">Captaci&oacute;n</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table >
                        <textarea id="sumaddon" class="form-control" name="sumaddon"></textarea>
                        <div class="row">
                            <div class="col-sm-12" id="agencia" style="display:none;" >
                                <br>
                                <div class="input-group">
                                    <div class="input-group-addon"><label>Agencia: <i class="fa fa-archive"></i></label></div>
                                    <select id="agency" name="agency" class="form-control" >
                                        <option value="0" selected>agencia 1</option>
                                        <option value="1">agencia 2</option>
                                        <option value="2">agencia 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="addons">
                        <table id="table-addon" class="table table-condensed">
                            <thead style="display:block;width:100%;">
                                <tr>
                                    <td width='32'>&nbsp;</td>
                                    <td width='384'>COMPLEMENTO</td>
                                    <td width='96'>CANT.</td>
                                    <td width='96'>PRECIO.</td>
                                    <td width='96'>MONTO</td>
                                </tr>
                            </thead>
                            <tbody style="min-height:320px;overflow-y:scroll;display:block;width:100%;">
                                <?php
                                $oq = mysqli_query($CNN, "SELECT * from cms_property_extra");
                                while ($or = mysqli_fetch_array($oq)) {
                                    ?>
                                    <tr  data-addon='<?php echo $or["id"]; ?>'>
                                        <td width='32'>
                                            <input class="habilita" type="checkbox" name="e_<?php echo $or["id"]; ?>" id="e_<?php echo $or["id"]; ?>" value="1" />
                                        </td>
                                        <td width='384'><?php echo $or["name"]; ?></td>
                                        <td width='96'><input type="number" disabled="disabled" name="c_<?php echo $or["id"]; ?>" id="c_<?php echo $or["id"]; ?>" class="form-control cant" value="0" /></td>
                                        <td width='96'><input type="number" disabled="disabled" name="p_<?php echo $or["id"]; ?>" id="p_<?php echo $or["id"]; ?>" class="form-control prize" value="0" /></td>
                                        <td width='96'><input type="number" disabled="disabled" name="m_<?php echo $or["id"]; ?>" id="m_<?php echo $or["id"]; ?>" class="form-control" value="0" /></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="cliente">
                        <div class="row-fluid">
                            <div class="col-sm-1">
                                <a href="Javascript:void(0)" alt="Seleccionar" title="Seleccionar" class="btn btn-info" onclick="searchin()"><b><span class="fa fa-search-plus"></span></b></a>
                            </div>
                            <div class="col-sm-11">
                                <div class="input-group">
                                    <div class="input-group-addon"><label>Inquilino: <i class="fa fa-user-md"></i></label></div>
                                    <input type="text" class="form-control" id="inquilino" name="inquilino" tabindex="7">
                                    <input type="text" class="hidden" id="cus-id" name="cus-id">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="payment">
                        <div>
                            <b id="pay-label-action">Nuevo Pago</b>
                            <table class="table table-condensed">
                                <tr>
                                    <td>Fecha</td>
                                    <td>Importe</td>
                                    <td>Tipo de Pago</td>
                                    <td>Modo de Pago</td>
                                </tr>
                                <tr>
                                    <td><input type="text" id="pay-date" name="pay-date" value="<?php echo date("Y-m-d"); ?>" class="form-control" /></td>                                
                                    <td><input type="text" id="pay-amount" name="pay-amount" value="0" /></td>                                
                                    <td><select id="pay-type" name="pay-type" class="form-control">
                                            <option value="1">Deposito [Confirmaci&oacute;n]</option>
                                            <option value="1">Resto del Pago</option>
                                            <option value="1">Pago del Total</option>
                                            <option value="1">Pago Parcial</option>
                                            <option value="1">Solo Complementos</option>
                                            <option value="1">Abono</option>
                                            <option value="1">Fianza</option>
                                        </select>
                                    </td>
                                    <td><select id="pay-type" name="pay-type" class="form-control">
                                            <option value="1">TPV</option>
                                            <option value="1">Transferencia</option>
                                            <option value="1">Deposito</option>
                                            <option value="1">Tarjeta de Cr&eacute;dito</option>                                        
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <b class="muted">Anotaciones</b>
                                        <textarea id="notes" name="notes" class="form-control"></textarea>
                                    </td>
                                </tr>
                            </table>
                            <button type="button" class="btn btn-success">PROCESAR</button>
                        </div>
                        <table class="table table-condensed" style="font-size:9pt;">
                            <tr>
                                <td valign="top" align="left" width="100%">
                                    <b>Pagos Registrados</b>
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <td>ID</td>
                                                <td>FECHA</td>
                                                <td>MONTO</td>
                                                <td>FACTURA</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </td>                                
                            </tr>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="documento">
                        <h4>Documentos</h4>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <h4>No hay tarifas disponibles para el rango de fechas elegidas</h4>
            <?php
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.cant').on('keyup', function () {
            calcular();
        });
        $('.cant').on('click', function () {
            calcular();
        });
        $('.prize').on('keyup', function () {
            calcular();
        });
        $('.prize').on('click', function () {
            calcular();
        });
        calcular();

        $('.habilita').on('click', function () {
            var a = $(this).is(':checked');
            if (a == true) {
                var x = $(this).parent('td').parent('tr').children('td').children('input[type=number]').removeAttr('disabled').val('1');
            } else {
                var x = $(this).parent('td').parent('tr').children('td').children('input[type=number]').attr('disabled', 'disabled').val(0);
            }
        });
        $("#ini").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: '<?php echo $ini->format('Y-m-d'); ?>',
            onClose: function (selectedDate) {
                $("#end").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#end").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: '<?php echo $end->format('Y-m-d'); ?>'
        });
    });
    function calcular() {
        var tr = $('#table-addon tbody tr');
        var n = tr.length;
        if (n > 0) {
            var atotal = 0;
            for (i = 0; i < n; i++) {
                var pid = $(tr[i]).attr('data-addon');
                if ($('#e_' + pid).is(':checked')) {
                    var a = $('#c_' + pid).val();
                    var b = $('#p_' + pid).val();
                    var c = a * b;
                    $('#m_' + pid).val(c);
                    atotal += c;
                }
            }
            $('tr.addons').children('td.amount').html(1);
            $('tr.addons').children('td.prize').html(atotal);
        }
        /*
         * Grand
         */
        var tr = $('.total tbody tr');
        var n = tr.length;
        if (n > 0) {
            var stotal = 0;
            for (i = 0; i < n; i++) {
                var amount = $(tr[i]).children('td.amount');
                var prize = $(tr[i]).children('td.prize');
                y = amount.length;
                for (x = 0; x < y; x++) {
                    var a = parseFloat($(amount[x]).html());
                    var b = parseFloat($(prize[x]).html());
                    stotal += a * b;
                }

            }
        }
        $('.real_total').html(stotal);
    }
    function booking() {
        var can = checkBooking();
    }
    function checkBooking() {
        var ini = $('#ini').val();          // Inicia la Reserva
        var end = $('#end').val();          // Fin de la Reserva
        var adult = $('#adult').val();      // Adultos
        var child = $('#child').val();      // Menores
        var por = $('#por').val();          // Quien realiza la reserva
        var source = $('#source').val();    // origen de la reservacion
        var cid = $('#cus-id').val();       // Customer ID

        var tr = $('#table-addon tbody tr');
        var n = tr.length;
        var addon = "";
        if (n > 0) {
            var atotal = 0;
            for (i = 0; i < n; i++) {
                var pid = $(tr[i]).attr('data-addon');
                if ($('#e_' + pid).is(':checked')) {
                    console.log('#e_' + pid)
                    var a = $('#c_' + pid).val();
                    var b = $('#p_' + pid).val();
                    var c = a * b;
                    $('#m_' + pid).val(c);
                    atotal += c;
                    addon += "[" + pid + "|" + a + "|" + b + "]";
                }
            }
            $('#summadon').val(addon);
            $('tr.addons').children('td.amount').html(1);
            $('tr.addons').children('td.prize').html(atotal);
        }
    }
</script>
<?php
