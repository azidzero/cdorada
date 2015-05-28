<?php
switch ($o) {
    case 0:
        ?>
        <form id="frmService" action="./?m=service&s=order&o=1" method="post" >
            <div class="row-fluid">
                <div class="col-sm-3">
                    <strong>INFORMACI&Oacute;N DE CONTACTO</strong>
                    <table class="table table-condensed" style="font-size: 9pt;">                        
                        <tbody>
                            <tr>
                                <td><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" id="customer" name="customer" class="form-control" placeholder="Nombre Completo del Cliente" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" id="phone" name="phone" class="form-control" placeholder="No. de Tel&eacute;fono" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Correo Electr&oacute;nico" />
                                    </div>
                                </td>
                            </tr>                                    
                    </table>
                </div>
                <div class="col-sm-3">
                    <strong>INFORMACI&Oacute;N DE EQUIPO(S)</strong>
                    <table class="table table-condensed">                        
                        <tr>
                            <td colspan="2">
                                <div class="input-group">
                                    <span class="input-group-addon">&Aacute;rea</span>
                                    <select id="area" name="area" class="form-control">
                                        <?php
                                        $sq = mysqli_query($this->C->CNN, "select * from service_area");
                                        while ($sr = mysqli_fetch_array($sq)) {
                                            echo "<option value=\"{$sr[0]}\">{$sr[2]}</option>";
                                        }
                                        ?>
                                    </select><a href="javascript:void(0)" class="input-group-addon" onclick="showArea()"><i class="fa fa-refresh"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>                            
                            <td colspan="2">
                                <span class="label label-default">Observaciones:</span><br/>
                                <textarea name="dev_desc" id="dev_desc" class="form-control" rows="1"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span class="label label-default">No.Serie del Equipo o IMEI:</span>
                                <input type="text" id="serie" name="serie" class="form-control" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <input type="text" class="form-control" id="brand" name="brand" placeholder="Marca" />
                                </div>
                            </td>                       
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <input type="text" class="form-control" id="model" name="model" placeholder="Modelo" />
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>            
            <div class="row-fluid">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Servicio(s) que solicita:</strong></div>
                        <div class="panel-body" id='serv_area' style="height:240px;overflow: auto;"></div>
                    </div>                    
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Accesorio(s) recibido(s):</strong></div>
                        <div class="panel-body" id='acc_area' style="height:240px;overflow: auto;"></div>
                    </div>
                </div>
            </div>
            <div>
                <table class="table table-condensed">
                    <tr>
                        <td colspan="2"><strong>Informaci&oacute;n Adicional</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <span class="label label-default">Descripci&oacute;n del Problema:</span><br/>
                            <textarea rows="1" class="form-control" id="problem" name="problem" placeholder="Motivo por el cual el cliente trae el equipo a revision"></textarea>
                        </td>
                        <td>
                            <span class="label label-default">Informaci&oacute;n Adicional:</span><br/>
                            <textarea rows="1" style="width:98%" id="details" name="details" placeholder="Usuario,Contrase&ntilde;a o informacion importante"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="label label-default">Presupuesto</span><br/>
                            <div class="input-group"><span class="input-group-addon"><strong>$</strong></span><input type="text" class="form-control" id="budget" name="budget" /></div>
                        </td>                                
                        <td><span class="label label-default">Fecha tentativa de entrega</span><br/>
                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="due_date" name="due_date" /></div>
                        </td>
                    </tr>
                </table>                        
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-block" onclick="addDevice()"><i class="fa fa-plus-sign"></i> Agregar Equipo</button>
            </div>
            <div>
                <strong>Equipos Registrados</strong>
                <table id="tblDevice" class="table table-condensed">
                    <thead>
                        <tr style="background:#EFEFEF;color:#333;">
                            <td>&Aacute;rea</td>
                            <td>Serie o IMEI</td>
                            <td>Marca</td>
                            <td>Modelo</td>                    
                            <td>Servicios</td>
                            <td>Accesorios</td>
                            <td>Problema</td>
                            <td>Informaci&oacute;n</td>
                            <td>Observaciones</td>
                            <td>Presupuesto</td>
                            <td>Fecha</td>
                            <td width="1"><i class="fa fa-list"></i></td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <input type="hidden" id="summary" name="summary" />
            </div>
            <div class="well well-sm">
                <button type="submit" name="submit_me" class="btn btn-lg btn-success">Guardar</button>
            </div>
        </form>
        <script>
            $(document).ready(function () {
                $('#due_date').datepicker({dateFormat: 'yy-mm-dd'});
                $('#frmService').submit(function (e) {
                    var self = this;
                    e.preventDefault();
                    var tblOut = "";
                    var tblData = "";
                    $("#tblDevice tbody tr").each(function () {
                        tblData = "";
                        var num = $(this).children('td').length;
                        var obj = $(this).children('td');
                        for (i = 0; i < num - 1; i++) {
                            if (tblData == "") {
                                tblData = $(obj[i]).html();
                            } else {
                                tblData += ";" + $(obj[i]).html();
                            }
                        }
                        if (tblOut == "") {
                            tblOut = tblData;
                        } else {
                            tblOut += "|" + tblData;
                        }
                    });
                    $('#summary').val(tblOut);
                    self.submit();
                });
            });
            function showArea() {
                $('#serv_area').load('include/modules/service/service.list.php', {sid: $('#area').val()});
                $('#acc_area').load('include/modules/service/acc.list.php', {sid: $('#area').val()});
            }
            function addDevice() {
                var area = $('#area').val();
                var htm = "<tr>";
                htm += "<td>" + $('#area').val() + "</td>";
                htm += "<td>" + $('#serie').val() + "</td>";
                $('#serie').val('');
                htm += "<td>" + $('#brand').val() + "</td>";
                $('#brand').val('');
                htm += "<td>" + $('#model').val() + "</td>";
                $('#model').val('');
                var ser = "";
                $('#area_' + area + " input[type=checkbox]:checked").each(function () {
                    if (ser == "") {
                        ser = $(this).val();
                    } else {
                        ser += ", " + $(this).val();
                    }
                    $(this).click();
                });
                htm += "<td>" + ser + "</td>";
                var acc = "";
                $('#acc_' + area + " input[type=checkbox]:checked").each(function () {
                    if (acc == "") {
                        acc = $(this).val();
                    } else {
                        acc += ", " + $(this).val();
                    }
                    $(this).click();
                });
                htm += "<td>" + acc + "</td>";
                htm += "<td>" + $('#problem').val() + "</td>";
                $('#problem').val('');
                htm += "<td>" + $('#details').val() + "</td>";
                $('#details').val('');
                htm += "<td>" + $('#dev_desc').val() + "</td>";
                $('#dev_desc').val('');
                htm += "<td>" + $('#budget').val() + "</td>";
                $('#budget').val('');
                htm += "<td>" + $('#due_date').val() + "</td>";
                $('#due_date').val('');
                htm += "<td><button onclick=\"removeDevice(this)\" class=\"btn btn-warning btn-small\"><i class=\"fa fa-trash\"></i></button></td>";
                htm += "</tr>";
                $('#tblDevice tbody').append(htm);
            }
            function removeDevice(src) {
                $(src).parent().parent('tr').remove();
            }
        </script>
        <?php
        break;
    case 1:
        // Personal
        $customer = $_REQUEST["customer"];
        $phone = $_REQUEST["phone"];
        $email = $_REQUEST["email"];
        $nextel = $_REQUEST["nextel"];
        $off = $_REQUEST["place"];
        $sum = explode("|", $_REQUEST["summary"]);
        $amount = 0;
        /*
         * 
         */
        $uid = $_SESSION["uid"];
        $date = date("Y-m-d");
        $time = date("H:i:s");
        /*
         * EMAIL
         */
        $mail = new PHPMailer();
        $mail->SetFrom('contacto@quiro.mx', 'Contacto');
        $mail->AddReplyTo('contacto@quiro.mx', 'Contacto');
        $mail->AddAddress("contacto@quiro.mx", "Contacto");
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "tls";
        $mail->SMTPKeepAlive = true;                  // SMTP connection will not close after each email sent
        $mail->Host = "mail.quiro.mx"; // sets the SMTP server
        $mail->Port = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username = "contacto@quiro.mx"; // SMTP account username
        $mail->Password = "quirofa5";        // SMTP account password
        /*
         * DATA
         */
        $SQL = "INSERT INTO 
            service_order(customer,phone,email,nextel,received_office,received_date,received_time,received_user) 
            VALUES('$customer','$phone','$email','$nextel','$off','$date','$time','$uid')";
        mysqli_query($SQL) or $e = mysqli_error();
        if (!isset($e)) {
            $oid = mysqli_insert_id();
            $mail->Subject = "Nueva Orden de Servicio #$oid";
            ?>
            <div class="alert alert-info">
                <h4>Se a creado la orden de servicio #<?php echo $oid; ?></h4><br/>
                <table class="table table-condensed" style="background-color: #F2F2F2;">                    
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($sum); $i++) {
                            list($area, $serie, $brand, $model, $service, $acc, $problem, $info, $desc, $budget, $due_date) = explode(";", $sum[$i]);
                            $er = "";
                            $sq = mysqli_query("select * from pos_services_area where id=$area");
                            while ($sr = mysqli_fetch_array($sq)) {
                                $aname = $sr[1];
                                $aown = $sr[2];
                            }
                            $sq = mysqli_query("select * from pos_users where id=$aown");
                            while ($sr = mysqli_fetch_array($sq)) {
                                $owner_name = "{$sr[3]} {$sr[4]}";
                                $owner_email = $sr[7];
                            }
                            $ohtml = "";
                            mysqli_query("INSERT INTO 
                                service_order_detail(s oid,area,serie,brand,model,services,accesories,problem,info,comments,budget,due_date) 
                                VALUES('$oid','$area','$serie','$brand','$model','$service','$acc','$problem','$info','$desc','$budget','$due_date')") or $er = mysqli_error();
                            if ($er == "") {
                                //
                                $mail->AddAddress($owner_email, $owner_name);
                                //                                
                                $amount+=$budget;
                                $ahtml = "
                                <tr>
                                    <td width=\"1\"><strong>Area:</strong></td><td>$aname</td>
                                    <td width=\"1\"><strong>Serie:</strong></td><td>$serie</td>
                                </tr>
                                <tr>
                                    <td width=\"1\"><strong>Marca:</strong></td><td>$brand</td>
                                    <td width=\"1\"><strong>Modelo:</strong></td><td>$model</td>
                                </tr>
                                <tr>
                                    <td width=\"1\"><strong>Servicios:</strong></td><td>$service</td>
                                    <td width=\"1\"><strong>Accesorios:</strong></td><td>$acc</td>
                                </tr>
                                <tr>
                                    <td width=\"1\"><strong>Problema:</strong></td><td>$problem</td>
                                    <td width=\"1\"><strong>Informacion:</strong></td><td>$info</td>
                                </tr>
                                <tr>
                                    <td width=\"1\"><strong>Comentarios:</strong></td><td>$desc</td>
                                    <td width=\"1\"><strong>Presupuesto:</strong></td><td>$budget</td>
                                </tr>
                                <tr>
                                    <td width=\"1\"><strong>Fecha:</strong></td><td>$due_date</td>
                                    <td colspan=\"2\" width=\"50%\">&nbsp;</td>
                                </tr>";
                                echo $ahtml;
                                $ohtml.=$ahtml;
                            } else {
                                ?>
                                <tr>
                                    <td colspan="11">
                                        <div class="alert alert-danger">
                                            <strong>ERROR:</strong> <?php echo $er; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            $uname = $_SESSION["user"];
            $message = "
<html lang=\"en\">
    <head>
        <title>Sistema de Ordenes de Servicio</title>
        <link rel=\"stylesheet\" href=\"http://pos.quiro.mx/css/bootstrap.min.css\" />
        <link rel=\"stylesheet\" href=\"http://pos.quiro.mx/css/bootstrap-responsive.min.css\" />
        <link rel=\"stylesheet\" href=\"http://pos.quiro.mx/css/general.css\" />
    </head>
    <body>
        <div class=\"container-fluid\">
            <div class=\"row-fluid\">
                <table class=\"table table-condensed table-bordered\" style=\"font-family:'Georgia';\">
                    <tr>
                        <td colspan=\"4\">
                            <h3>Nueva &Oacute;rden de Servicio #$oid</h3>
                        </td>
                    </tr>
          <tr>
            <td><strong>Fecha:</strong></td>
            <td>$date</td>
            <td><strong>Hora:</strong></td>
            <td>$time</td>
            </tr>
          <tr>
            <td><strong>Captur&oacute;:</strong></td>
            <td>$uname</td>
            <td><strong>Cliente:</strong></td>
            <td>$customer</td>
            </tr>          
            <tr>
            <td><strong>Tel&eacute;fono:</strong></td>
            <td>$phone</td>
            <td><strong>Correo Electr&oacute;nico:</strong></td>
            <td>$email</td>
          </tr>
          <tr class=\"info\">
          <td colspan=\"4\"><strong>Informaci&oacute;n</strong></td>
          </tr>
          $ohtml
          </table>
          </div>
          </div>
          </body>
          </html>";
            $mail->MsgHTML($message);
            if (!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            ?>
            <div class="alert alert-success">
                <h4>Se a guardado la orden de servicio</h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-error">
                <h4>Ocurrio un error mientras se guardaba la orden de servicio</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="form-actions">
            <div class="btn-group">
                <a class="btn" href="./terminal/?m=service&o=0"><i class="fa fa-plus-sign"></i> Nuevo</a>
                <a class="btn" href="./terminal/?m=service&o=2"><i class="fa fa-edit"></i> Ir a la adminstracion</a>
            </div>
        </div>
        <?php
        break;
    case 2:
        ?>
        <input type="hidden" id="sid" name="sid" />
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td width="1">#</td>
                    <td><i class="fa fa-user"></i></td>
                    <td><i class="fa fa-phone"></i></td>
                    <td><i class="fa fa-envelope-alt"></i></td>
                    <td><i class="fa fa-phone-sign"></i></td>

                    <td><i class="fa fa-building"></i></td>
                    <td><i class="fa fa-calendar"></i></td>
                    <td><i class="fa fa-time"></i></td>
                    <td><i class="fa fa-user-md"></i></td>

                    <td>Estado</td>
                    <td>Total</td>
                    <td><i class="fa fa-th"></i></td>
                </tr>
            </thead>
            <tbody>                
            </tbody>
        </table>
        <div id="mod-service" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="mod-title">Detalles de &Oacute;rden de Servicio</h3>
            </div>
            <div class="modal-body">
                <p><i class="fa fa-spinner fa fa-spin"></i> Cargando…</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            </div>
        </div>
        <script type="text/javascript">
            $('#mod-service').on('show', function () {
                var sid = $('#sid').val();
                $('#mod-title').html('Detalles de la &Oacute;rden de Servicio #' + sid);
                $('.modal-body').load('terminal/service.live.php', {id: sid});
            });
            $(document).ready(function () {
                jTable("tbl_admin", "terminal/service.table.php?");
            });
        </script>
        <?php
        break;
    case 3:
        $q = mysqli_query("select * from pos_service where id={$_REQUEST["sid"]}");
        while ($r = mysqli_fetch_array($q)) {
            ?>
            <form action="./terminal/?m=service&o=4" method="post">
                <input type="hidden" id="sid" name="sid" value="<?php echo $_REQUEST["sid"]; ?>" />
                <table class="table table-condensed">                
                    <tr>
                        <td width="20%"><strong>Cliente:</strong></td>
                        <td width="20%"><div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" id="customer" name="customer" value="<?php echo $r["customer"]; ?>" /></div></td>
                        <td rowspan="2"><span class="label label-default">Descripci&oacute;n del Problema:</span><br/>
                            <textarea rows="2" style="width:98%" id="problem" name="problem"><?php echo $r["aproblem"]; ?></textarea>
                        </td>                    
                    </tr>
                    <tr>
                        <td><strong>Telefono:</strong></td>
                        <td><div class="input-group"><span class="input-group-addon"><i class="fa fa-th"></i></span><input type="text" id="phone" name="phone" value="<?php echo $r["phone"]; ?>" /></div></td>
                    </tr>
                    <tr>
                        <td><strong>Correo Electr&oacute;nico:</strong></td>
                        <td><div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span><input type="text" id="email" name="email" value="<?php echo $r["email"]; ?>" /></div></td>
                        <td rowspan="2"><span class="label label-default">Informaci&oacute;n Adicional:</span><br/>
                            <textarea rows="2" style="width:98%" id="details" name="details"><?php echo $r["ainfo"]; ?></textarea>
                        </td>
                    </tr>           
                    <tr>
                        <td><strong>&Aacute;rea de Trabajo:</strong></td>
                        <td><select id="area" name="area">
                                <option <?php
                                if ($r["area"] == 0) {
                                    echo "selected=\"selected\"";
                                }
                                ?> value="0">C&oacute;mputo</option>
                                <option <?php
                                if ($r["area"] == 1) {
                                    echo "selected=\"selected\"";
                                }
                                ?>  value="1">Telefon&iacute;a</option>
                            </select>
                        </td>                    
                    </tr>
                    <tr>
                        <td><strong>Marca:</strong></td>
                        <td><input class="form-control" type="text" id="brand" name="brand" value="<?php echo $r["brand"]; ?>" /></td>
                        <td rowspan="2"><span class="label label-default">Equipo Recibido:</span><br/>
                            <textarea rows="2" style="width:98%" id="equip" name="equip"><?php echo $r["acc"]; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Modelo:</strong></td>
                        <td><input class="form-control" type="text" id="model" name="model" value="<?php echo $r["model"]; ?>"  /></td>
                    </tr>                              
                    <tr>
                        <td><strong>Presupuesto:</strong></td>
                        <td class="input-group"><span class="input-group-addon"><strong>$</strong></span><input type="text" class="form-control" id="budget" name="budget" value="<?php echo $r["prize"]; ?>"  /></td>
                        <td rowspan="2"><span class="label label-default">Descripci&oacute;n del Servicio:</span><br/>
                            <textarea rows="2" id="service" name="service" style="width:98%" ><?php echo $r["aservice"]; ?></textarea>
                        </td>

                    </tr>
                    <tr>
                        <td><strong>Fecha de entrega<sub><small>[Estimada]</small></sub></strong></td>
                        <td class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="due_date" name="due_date" value="<?php echo $r["due_date"]; ?>" /></td>
                    </tr>
                </table>
                <div class="form-actions">
                    <button type="submit" class="btn btn-large btn-success"> Actualizar</button>
                </div>
            </form>            
            <?php
        }
        break;
    case 4:
        $uid = $_SESSION["uid"];
        $sid = $_REQUEST["sid"];
        $customer = $_REQUEST["customer"];
        $email = $_REQUEST["email"];
        $phone = $_REQUEST["phone"];
        $sql = "UPDATE pos_service SET uid='$uid',";
        $sql .=" area='{$_REQUEST["area"]}',";
        $sql .=" customer='{$_REQUEST["customer"]}',";
        $sql .=" phone='{$_REQUEST["phone"]}',";
        $sql .=" email='{$_REQUEST["email"]}',";
        $sql .=" brand='{$_REQUEST["brand"]}',";
        $sql .=" model='{$_REQUEST["model"]}',";
        $sql .=" aservice='{$_REQUEST["service"]}',";
        $sql .=" ainfo='{$_REQUEST["details"]}',";
        $sql .=" aproblem='{$_REQUEST["problem"]}' WHERE id=$sid";
        $q = mysqli_query($sql) or $e = mysqli_error();
        /*
         * EMAIL
         */
        $mail = new PHPMailer();
        $mail->SetFrom('contacto@quiro.mx', 'Contacto');
        $mail->AddReplyTo('contacto@quiro.mx', 'Contacto');
        if ($_REQUEST["area"] == 0) {
            $mail->AddAddress("luis_romo@quiro.mx", "Luis Cuauhtemoc Romo Guerra");
        } else {
            $mail->AddAddress("edgar_partida@quiro.mx", "Edgar Partida");
        }
        $mail->AddAddress("contacto@quiro.mx", "Contacto");

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "tls";
        $mail->SMTPKeepAlive = true;                  // SMTP connection will not close after each email sent
        $mail->Host = "mail.quiro.mx"; // sets the SMTP server
        $mail->Port = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username = "contacto@quiro.mx"; // SMTP account username
        $mail->Password = "quirofa5";        // SMTP account password
        $mail->Subject = "Actualizacion de Orden de Servicio #$sid";
        $uname = $_SESSION["user"];
        $message = "<html lang=\"en\">
    <head>
    	<title>Sistema de Ordenes de Servicio</title>
        <link rel=\"stylesheet\" href=\"http://pos.quiro.mx/css/bootstrap.min.css\" />
        <link rel=\"stylesheet\" href=\"http://pos.quiro.mx/css/bootstrap-responsive.min.css\" />
        <link rel=\"stylesheet\" href=\"http://pos.quiro.mx/css/general.css\" />
    </head>
    <body>
        <div class=\"container\">
            <div class=\"row\">
                <table class=\"table table-condensed table-bordered\">
                    <tr>
                        <td colspan=\"2\">
                            <h3>Nueva &Oacute;rden de Servicio #$sid<br/>
                                <small>$date</small>
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Captur&oacute;:</strong></td>
                        <td>$uname</td>
                    </tr>
                    <tr>
                        <td><strong>Cliente:</strong></td>
                        <td>$customer</td>
                    </tr>
                    <tr>
                        <td><strong>Tel&eacute;fono:</strong></td>
                        <td>$phone</td>
                    </tr>
                    <tr>
                        <td><strong>Correo Electr&oacute;nico:</strong></td>
                        <td>$email</td>
                    </tr>
                    <tr class=\"info\">
                        <td colspan=\"2\"><strong>Informaci&oacute;n</strong></td>
                    </tr>
                    <tr>
                        <td>Marca: </td>
                        <td>{$_REQUEST["brand"]}</td>
                    </tr>
                    <tr>
                        <td>Modelo: </td><td>{$_REQUEST["model"]}</td>
                    </tr>
                    <tr>
                        <td>Servicio que solicita: </td><td>{$_REQUEST["service"]}</td>
                    </tr>
                    <tr>
                        <td>Detalles: </td><td>{$_REQUEST["details"]}</td>
                    </tr>
                    <tr>
                        <td>Problema: </td><td>{$_REQUEST["problem"]}</td>
                    </tr>
                    <tr>
                        <td>Equipo Recibido: </td><td>{$_REQUEST["equip"]}</td>                            
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>";

        $mail->MsgHTML($message);
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        if ($e == "") {
            ?>
            <div class="alert alert-success">
                <h4>Se a actualizado al &Oacute;rden de Servicio <?php echo $_REQUEST["Sid"]; ?></h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>&Oacute;rrio un error al intentar actualizar la &Oacute;rden de Servicio <?php echo $_REQUEST["Sid"]; ?></h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="form-actions">
            <div class="btn-group">
                <a class="btn btn-large btn-info" href="terminal/?m=service&o=0"><i class="fa fa-plus"></i> Nueva &Oacute;rden de Servicio</a>
                <a class="btn btn-large btn-info" href="terminal/?m=service&o=2"><i class="fa fa-edit"></i> Administrar Ordenes de Servicio</a>
                <a class="btn btn-large btn-info" href="terminal/?m=print&o=1&sid=<?php echo $_REQUEST["sid"]; ?>"><i class="fa fa-print"></i> Imprimir</a>
            </div>
        </div>
        <?php
        break;
    case 5:
        $sid = $_REQUEST["sid"];
        ?>
        <form action="terminal/?m=service&o=6" method="post">
            <input type="hidden" id="sid" name="sid" value="<?php echo $sid; ?>" />
            <div class="alert alert-danger">
                <h4>Estas a punto de eliminar la &Oacute;rden de Servicio #<?php echo $sid; ?></h4>
                <p><strong>IMPORTANTE:</strong> Esta acci&oacute;n no se puede deshacer, estas seguro de continuar?</p>
            </div>
            <div class="form-actions">
                <div class="btn-group">
                    <a onclick="history.back()" class="btn btn-large btn-danger"><i class="fa fa-chevron-left fa fa-white"></i> Regresar</a>
                    <button type="submit" class="btn btn-large btn-success">Continuar <i class="fa fa-chevron-right fa fa-white"></i></button>
                </div>
            </div>
        </form>
        <?php
        break;
    case 6:
        $sid = $_REQUEST["sid"];
        $q = mysqli_Query("DELETE from pos_service where id=$sid") or $e = mysqli_error();
        if ($e == "") {
            ?>
            <div class="alert alert-success">
                <h4>Se a eliminado al &Oacute;rden de Servicio #<?php echo $_REQUEST["sid"]; ?></h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>&Oacute;rrio un error al intentar eliminar la &Oacute;rden de Servicio <?php echo $_REQUEST["sid"]; ?></h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="form-actions">
            <div class="btn-group">
                <a class="btn btn-large btn-info" href="terminal/?m=service&o=0"><i class="fa fa-plus"></i> Nueva &Oacute;rden de Servicio</a>
                <a class="btn btn-large btn-info" href="terminal/?m=service&o=2"><i class="fa fa-edit"></i> Administrar Ordenes de Servicio</a>
            </div>
        </div>
        <?php
        break;
    case 7:
        $sid = $_REQUEST["sid"];
        ?>
        <form action="terminal/?m=service&o=8" method="post">
            <input type="hidden" id="sid" name="sid" value="<?php echo $sid; ?>" />
            <div class="alert alert-danger">
                <h4>Estas a punto de <strong>CONFIRMAR</strong> la &Oacute;rden de Servicio #<?php echo $sid; ?></h4>
                <p><strong>IMPORTANTE:</strong> Esta acci&oacute;n autorizara a realizar las acciones sugeridas por el cliente generando costos, estas seguro de continuar?</p>
            </div>
            <div class="form-actions">
                <div class="btn-group">
                    <a onclick="history.back()" class="btn btn-large btn-danger"><i class="fa fa-chevron-left fa fa-white"></i> Regresar</a>
                    <button type="submit" class="btn btn-large btn-success">Continuar <i class="fa fa-chevron-right fa fa-white"></i></button>
                </div>
            </div>
        </form>
        <?php
        break;
    case 8:
        $sid = $_REQUEST["sid"];
        $q = mysqli_query("UPDATE pos_service set status=3 where id=$sid") or $e = mysqli_error();
        /*
         * EMAIL #2
         */
        require_once('../core/phpMailer/class.phpmailer.php');
        $mail = new PHPMailer();


        $to = "contacto@quiro.mx";
        $ton = "Contacto";

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPKeepAlive = true;                  // SMTP connection will not close after each email sent
        $mail->Host = "mail.quiro.mx"; // sets the SMTP server
        $mail->Port = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username = "contacto@quiro.mx"; // SMTP account username
        $mail->Password = "quirofa5";        // SMTP account password
        $mail->SetFrom('contacto@quiro.mx', 'Contacto');
        $mail->AddReplyTo('contacto@quiro.mx', 'Contacto');
        $mail->AddAddress($to, $ton);
        $mail->Subject = "Actualizacion de Orden de Servicio #$sid";

        $message .="<div class=\container\">";
        $message .="<div class=\row\">";
        $message .="<table class=\"table table-condensed table-bordered\">";
        $message .= "<tr><td colspan=\"2\"><h4>&Oacute;rden de Servicio #$sid<br/><small>$date</small></h4></td></tr>";
        $message .= "<tr><td colspan=\"2\">Se ha Confirmado por parte del cliente que se realizen las operaciones para la &Oacute;rden de Servicio</td></tr>";
        $message .= "</table>";
        $message .= "</div>";
        $message .= "</div>";
        $message .= "</html>";

        $mail->MsgHTML($message);
        $mail->Send();

        if ($e == "") {
            ?>
            <div class="alert alert-success">
                <h4>Se a actualizado al &Oacute;rden de Servicio #<?php echo $_REQUEST["sid"]; ?></h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>&Oacute;rrio un error al intentar actualizar la &Oacute;rden de Servicio <?php echo $_REQUEST["sid"]; ?></h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        ?>
        <div class="form-actions">
            <div class="btn-group">
                <a class="btn btn-large btn-info" href="terminal/?m=service&o=0"><i class="fa fa-plus"></i> Nueva &Oacute;rden de Servicio</a>
                <a class="btn btn-large btn-info" href="terminal/?m=service&o=2"><i class="fa fa-edit"></i> Administrar Ordenes de Servicio</a>
            </div>
        </div>
        <?php
        break;
    case 9:
        $id = $_REQUEST["sid"];
        $sq = mysqli_query("select * from pos_service where id=$id");
        while ($sr = mysqli_fetch_array($sq)) {
            ?>
            <form action="./terminal/?m=service&o=10" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                <?php
                if ($sr["prize"] == "0.00") {
                    // No se a asignado costo
                    ?>
                    <div class="well well-small">
                        Costo de la Operacion: <input type="text" id="prize" name="prize" />
                    </div>
                    <?php
                } else {
                    // Se a asignado costo
                    ?>
                    <div class="alert alert-info">
                        Costo de la Operacion:
                        <input type="hidden" id="prize" name="prize" value="<?php echo $sr["prize"]; ?>" /><strong>$ <?php echo number_format($sr["prize"], 2); ?></strong>
                    </div>
                    <?php
                }
                ?>
                <div>
                    Lugar de entrega: <select id="delivery" name="delivery">
                        <?php
                        $tq = mysqli_query("select * from pos_store");
                        while ($tr = mysqli_fetch_array($tq)) {
                            ?>
                            <option value="<?php echo $tr[0]; ?>"><?php echo $tr[1]; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="alert alert-warning">
                    <h4>
                        Se va a marcar el servicio como completado, estas seguro de continuar?
                    </h4>
                </div>
                <div class="form-actions">
                    <button class="btn btn-large" type="submit">Continuar <i class="fa fa-chevron-right"></i></button>
                </div>
            </form>
            <?php
        }
        break;
    case 10:
        $prize = $_REQUEST["prize"];
        $id = $_REQUEST["id"];
        $date = date("Y-m-d");
        $delivery = $_REQUEST["delivery"];
        mysqli_query("UPDATE pos_service set status=6,prize='$prize',due_date='$date',delivery='$delivery' where id=$id");
        ?>
        <div class="alert alert-info">
            <h2>Orden de Servicio #<?php echo $id; ?> marcada como completada.</h2>
        </div>
        <?php
        break;
}
?>