<?php
$dini = $_REQUEST["date_in-property"];
$dend = $_REQUEST["date_out-property"];
$pid = $_REQUEST["pid"];
$na = new datetime($dini);
$nb = new datetime($dend);
$dias = $na->diff($nb);
$noches = $dias->format('%a') - 1;

$adultos = $_REQUEST["no_adult"];
$infantes = $_REQUEST["no_kid"];

$precio = calcPrize($pid, $dini, $dend);
?>
<section id="search" style="margin-top:120px;font-family: 'Open Sans',sans-serif;">
    <div id="checkout" class="container">
        <form action="./<?php echo $lang; ?>/reservar/checkout" method="POST" onsubmit="return checkForm()">
            <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>" />
            <input type="hidden" id="reserva_ini" name="reserva_ini" value="<?php echo $dini; ?>" />
            <input type="hidden" id="reserva_end" name="reserva_end" value="<?php echo $dend; ?>" />
            <input type="hidden" id="reserva_total" name="reserva_total" value="<?php echo $noches; ?>" />
            <input type="hidden" id="reserva_man" name="reserva_man" value="<?php echo $adultos; ?>" />
            <input type="hidden" id="reserva_kid" name="reserva_kid" value="<?php echo $infantes; ?>" />
            <h3>CREAR RESERVACI&Oacute;N</h3>            
            <div class="row">
                <div class="col-sm-8">
                    <strong>DATOS</strong>
                    <table class="table table-condensed" style="font-size: 9pt;">
                        <tr class="warning">
                            <td width="25%">Nombre:</td>
                            <td width="25%">Primer Apellido:</td>
                            <td width="25%">Segundo Apellido:</td>
                            <td width="25%">No.Documento de Identidad</td>
                        </tr>
                        <tr>
                            <td><input class="form-control" type="text" id="user_name" name="user_name" /></td>                        
                            <td><input class="form-control" type="text" id="user_last_p" name="user_last_p" /></td>                        
                            <td><input class="form-control" type="text" id="user_last_m" name="user_last_m" /></td>                        
                            <td><input class="form-control" type="text" id="dni_no" name="dni_no" /></td>                        
                        </tr>
                        <tr class="warning">
                            <td width="25%">Tipo de Documento:</td>
                            <td width="25%">Fecha de Expedici&oacute;n:</td>
                            <td width="25%">Pa&iacute;s de Nacionalidad:</td>
                            <td width="25%">Idioma</td>
                        </tr>
                        <tr>
                            <td><select class="form-control" name="dni_tipo" id="dni_tipo">
                                    <option value="D">DNI</option>
                                    <option value="P">Pasaporte</option>
                                    <option value="C">Permiso de Conducir</option>
                                    <option value="I">Carta o Documento de Identidad</option>
                                    <option value="N">Permiso de Residencia Espa&ntilde;ol</option>
                                    <option value="X">Permiso de Residencia de otro estado miembro de la U.Europea</option>
                                </select>
                            </td>                        
                            <td><input class="form-control" type="text" id="dni_date" name="dni_date" /></td>                        
                            <td><input class="form-control" type="text" id="dni_country" name="dni_country" /></td>                        
                            <td><input class="form-control" type="text" id="dni_lang" name="dni_lang" /></td>                        
                        </tr>
                        <tr class="warning">                            
                            <td>Direccion</td>
                            <td>Localidad</td>
                            <td>C&oacute;digo Postal:</td>
                            <td>Pa&iacute;s: </td>
                        </tr>
                        <tr>                            
                            <td><input class="form-control" type="text" id="user_address" name="user_address" /></td>                        
                            <td><input class="form-control" type="text" id="user_city" name="user_city" /></td>                        
                            <td><input class="form-control" type="text" id="user_cp" name="user_cp" /></td>
                            <td><input class="form-control" type="text" id="user_country" name="user_country" /></td>
                        </tr>
                        <tr class="warning">                            
                            <td>M&oacute;vil: </td>
                            <td>Email: </td>
                        </tr>
                        <tr>                            
                            <td><input class="form-control" type="text" id="user_cellphone" name="user_cellphone" placeholder="000 000-0000" /></td>
                            <td><input class="form-control" type="text" id="user_email" name="user_email" placeholder="example@example.com" /></td>                    
                        </tr>
                    </table>
                    <table class="table table-condensed" style="font-size: 10pt;">
                        <tr class="info">
                            <td colspan="3"><b>M&eacute;todo de Pago</b></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="payment_mode" value="credit_card" checked="" /> Tarjeta de Cr&eacute;dito<br/>
                                <small style="text-align: justify;font-weight: bold;">Pago Online seguro directamente por Internet con tu tarjeta de crédito. Los datos bancarios no transitan ni son conservados por nuestros sistemas.</small>
                            </td>
                            <td><input type="radio" name="payment_mode" value="transferencia" /> Transferencia<br/>
                                <small style="text-align: justify;font-weight: bold;">Debes realizar una transferencia bancaria por el importe indicado en concepto de Depósito de Confirmación a la cuenta bancaria que más tarde te indicaremos.</small>
                            </td>
                            <td><input type="radio" name="payment_mode" value="paypal" /> PayPal<br/>
                                <small style="text-align: justify;font-weight: bold;">Si dispones de una cuenta de PayPal puedes utilizar este medio para abonar el importe correspondiente al Depósito de Confirmación. El pago mediante la pasarela de paypal tiene un recargo del 3%.</small>
                                <br/>
                                <b class="pull-right"><a href="http://www.paypal.com" target="_blank">Que es PayPal</a></b>
                            </td>                                            
                        </tr>
                    </table>                    

                    <?php
                    $SQL = "SELECT * from cms_property WHERE id='$pid'";
                    $q = mysqli_query($CNN, $SQL);
                    while ($r = mysqli_fetch_array($q)) {
                        ?>
                        <strong>Tu alojamiento</strong>
                        <table class="table table-condensed" style="font-size: 9pt;">
                            <tr>
                                <td rowspan="3"><img data-src="holder.js/196x96" /></td>
                                <td>Entrada: <b><?php echo $dini; ?></b></td>                        
                                <td>Salida: <b><?php echo $dend; ?></b></td>                        
                                <td><b><?php echo $noches; ?></b> Noches</td>                        
                            </tr>
                            <tr>
                                <td colspan="3">REF: <b></b></td>
                            </tr>
                            <tr>
                                <td>Adultos: <b><?php echo $adultos ?></b></td>
                                <td>Menores: <b><?php echo $infantes; ?></b></td>
                            </tr>
                        </table>                    
                        <?php
                    }
                    ?>

                </div>
                <div class="col-sm-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h4 class="panel-title">CARGOS</h4>
                        </div>
                        <div class="panel-body" style="font-size: 9pt;">
                            <table class="table table-condensed table-striped" style="font-size: 8pt;font-family: 'Open Sans',sans-serif;">
                                <thead style="font-weight: bold;">
                                    <tr style="border-bottom:1px solid #000;">
                                        <td>CONCEPTO</td>
                                        <td width="1">CANTIDAD</td>
                                        <td width="1">PRECIO</td>
                                        <td width="1">MONTO</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Alojamiento</td>
                                        <td style="text-align: right">1.00</td>
                                        <td style="text-align: right"><?php echo number_format($precio, 2); ?></td>
                                        <td style="text-align: right"><?php echo number_format($precio, 2); ?></td>                                
                                    </tr>
                                    <tr>
                                        <td>Complementos</td>
                                        <td style="text-align: right">0.00</td>
                                        <td style="text-align: right"><?php echo number_format(0, 2); ?></td>
                                        <td style="text-align: right"><?php echo number_format(0, 2); ?></td>                                
                                    </tr>
                                    <tr>
                                        <td>Gastos de Gesti&oacute;n</td>
                                        <td style="text-align: right">1.00</td>
                                        <td style="text-align: right">20.00</td>
                                        <td style="text-align: right">20.00</td>
                                    </tr>
                                    <?php
                                    $total = $precio + 20;
                                    $stotal = 0;
                                    $addon = 0;
                                    foreach ($_REQUEST as $K => $POST) {
                                        if (strstr($K, "extra_") != "") {
                                            $Eid = str_replace("extra_", "", $K);
                                            $t1 = getData("cms_property_extra", "id", $Eid, "name");
                                            $cant = $_REQUEST["extra_c_" . $Eid];
                                            $stotal = $cant * $POST;
                                            if ($t1 != "") {
                                                ?>
                                                <tr>
                                                    <td><?php echo $t1; ?> <small class="text-muted">(Servicio Adicional)</small></td>
                                                    <td style="text-align: right;"><?php echo number_format($cant, 2); ?></td>
                                                    <td style="text-align: right;"><?php echo number_format($POST, 2); ?></td>
                                                    <td style="text-align: right;"><?php echo number_format($stotal, 2); ?></td>
                                                </tr>
                                                <?php
                                                $total += $stotal;
                                                $addon += $stotal;
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot style="font-weight: bold;">
                                    <tr class="danger">
                                        <td colspan="3" style="text-align: right">TOTAL</td>
                                        <td style="text-align: right;"><?php echo number_format($total, 2); ?></td>
                                    </tr>
                                </tfoot>
                            </table>                    
                            <div style="margin-top: 8px;" class="alert alert-info">
                                <b class="text-primary">DEPOSITO PARA CONFIRMACI&Oacute;N (40%)</b><br/>
                                <div style="border-top:1px solid #039;text-align: right">
                                    <sup><span style="min-width: 48px;"><i class="fa fa-euro fa-2x text-info"></i></span></sup>
                                    <span style="font-size: 22pt;"><?php echo number_format($total * 0.4, 2); ?></span>

                                </div>
                                <input type="hidden" id="total_deposito" name="total_deposito" value="<?php echo number_format($total * 0.4, 2); ?>" />
                                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-credit-card fa-2x pull-left"></i> PAGAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            $(document).ready(function () {
                $('#dni_date').datepicker({dateFormat: 'dd-mm-yy'});
            });
            function checkForm() {
                /*
                 * Valida la informacion enviada
                 */
                var f = ['user_name', 'user_last_p', 'user_last_m', 'user_address', 'user_city', 'user_cp', 'user_country',
                    'user_cellphone', 'user_email', 'dni_no', 'dni_date', 'dni_country', 'dni_lang'];
                var e = 0;
                var c = f.length;
                for (i = 0; i < c; i++) {
                    if ($('#' + f[i]).val() == "") {
                        e++
                                ;
                        $('#' + f[i]).css({
                            'background-color': '#E74C3C',
                            'color': '#FFF'
                        }).animate({
                            'background-color': '#FFF',
                            'color': '#333'
                        }, 2000);
                    }
                }
                if (e > 0) {
                    $.growl.error({'title': 'ERROR', 'message': 'Hay informacion requerida que debera llenar'});

                    return false;
                } else {
                    return true;
                }
            }
        </script>
    </div>
</section>