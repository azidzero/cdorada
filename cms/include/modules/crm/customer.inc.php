<?php
switch ($o) {
    case 0:
        ?>
        <h4>Nuevo Cliente</h4>
        <input type="hidden" id="id" name="id" value="0" />
        <div class="row-fluid">
            <div class="col-sm-8">
                <table class="table table-condensed">
                    <tr>
                        <td rowspan="3" width="96">
                            <img data-src="holder.js/96x96?theme=social"
                        </td>
                        <td rowspan="3" style="vertical-align: middle;">
                            <strong>Nombre:</strong> <small>¿Es una empresa? <input type="checkbox" id="isCorp" name="isCorp" value="1" /></small><br/>
                            <input type="text" id="name" name="name" style="font-size:28pt;width:100%;"  />
                        </td>
                        <td width="33%">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-plus"></i>Tipo empresa:</span>
                                <select id="contactType" name="contactType" class="form-control" onchange="chkMode()">
                                    <option value="0">Prospecto</option>
                                    <option value="1">No identificado</option>
                                    <option value="2">Cliente</option>
                                    <option value="3">Proovedor</option>
                                    <option value="4">Socio</option>
                                    <option value="5">Competencia</option>
                                </select>
                            </div><br/>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" id="commercialDenomination" name="commercialDenomination" class="form-control" placeholder="Denominación comercial" />

                            </div>
                        </td>
                    </tr>
                    <tr id="contact-row">
                        <td colspan="2">
                            <div class="input-group">
                                <span class="input-group-addon">Empresa</span>
                                <select id="corp" name="corp" class="form-control">
                                    <option value="0">Ninguna</option>
                                    <?php
                                    $oq = mysqli_query($CNN, "SELECT * from crm_customer");
                                    while ($or = mysqli_fetch_array($oq)) {
                                        echo "<option value=\"{$or["id"]}\">{$or["name"]}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table table-condensed">
                    <tr>
                        <td width="25%" rowspan="4"><strong>Direcci&oacute;n</strong></td>
                        <td rowspan="4">
                            <input type="text" id="address1" name="address1" placeholder="Calle, no" /><br/>
                            <input type="text" id="address2" name="address2" placeholder="Colonia" /><br/>
                            <input type="text" id="city" name="city" placeholder="ciudad" /><br/>
                            <input type="text" id="state" name="state" placeholder="estado/provincia" /><br/>
                            <input type="text" id="zipCode" name="zipCode" placeholder="cp" /><br/>
                        </td>
                        <td><strong>Telefono</strong></td>
                        <td><input type="text" id="phone" name="phone" /></td>
                    </tr>
                    <tr>
                        <td><strong>M&oacute;vil</strong></td>
                        <td><input type="text" id="cellphone" name="cellphone" /></td>
                    </tr>
                    <tr>
                        <td><strong>Fax</strong></td>
                        <td><input type="text" id="fax" name="fax" /></td>
                    </tr>
                    <tr>
                        <td><strong>Correo Electr&oacute;nico</strong></td>
                        <td><input type="text" id="email" name="email" /></td>
                    </tr>                    
                </table>
                <table class="table table-condensed">
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Divisa</span>
                                <select id="currency" name="currency" class="form-control">
                                    <?php
                                    $oq = mysqli_query($CNN, "SELECT * from core_currency WHERE status='1'");
                                    while ($or = mysqli_fetch_array($oq)) {
                                        echo "<option value=\"{$or['code']}\">{$or["currency"]}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <h4>Actividades</h4>
                <ul class="nav">
                    <li><a href="#"><span class="badge pull-right">0</span> Reuniones</a></li>
                    <li><a href="#"><span class="badge pull-right">0</span> Llamadas</a></li>
                    <li><a href="#"><span class="badge pull-right">0</span> Ventas</a></li>
                    <li><a href="#"><span class="badge pull-right">0</span> Incidencias</a></li>
                    <li><a href="#"><span class="badge pull-right">0</span> Tareas</a></li>
                </ul>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('input[type=text]').blur(function () {
                    var oid = $(this).attr('id');
                    console.log(oid);
                    autoSave('customer', oid);
                });
                $('select').blur(function () {
                    var oid = $(this).attr('id');
                    console.log(oid);
                    autoSave('customer', oid);
                });
                $('#isCorp').click(function () {
                    if ($(this).is(':checked')) {
                        $('#contact-row').css('display', 'none');
                    } else {

                        $('#contact-row').css('display', '');
                    }
                });
            });
        </script>
        <!-- 
        <div class="row-fluid">
            <strong>INFORMACI&Oacute;N DE LA EMPRESA</strong>
            <table class="table table-condensed" style="font-size: 9pt;" >                   
                <tbody>
                    <tr>
                        <td><strong>Datos comerciales</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" id="nameCompany" name="nameCompany" class="form-control" placeholder="Nombre de la empresa" />

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" id="commercialDenomination" name="commercialDenomination" class="form-control" placeholder="Denominación comercial" />

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-plus"></i>Tipo empresa:</span>
                                <select id="contactType" name="contactType" class="form-control" onchange="chkMode()">
                                    <option value="0">Prospecto</option>
                                    <option value="1">No identificado</option>
                                    <option value="2">Cliente</option>
                                    <option value="3">Proovedor</option>
                                    <option value="4">Socio</option>
                                    <option value="5">Competencia</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%"><div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Correo Electr&oacute;nico" />
                            </div>
                        </td>
                        <td>    
                            <div class="input-group">
                                <select id="emailType" name="emailType" class="form-control" onchange="chkMode()">
                                    <option value="0">Trabajo</option>
                                    <option value="1">Personal</option>
                                    <option value="2">Otro</option>
                                </select>
                            </div>                                
                        </td>
                    </tr>
                    <tr>
                        <td><div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Tel&eacute;fono" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <select id="telephoneType" name="telephoneType" class="form-control" onchange="chkMode()">
                                    <option value="0">Trabajo</option>
                                    <option value="1">Personal</option>
                                    <option value="2">Otro</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                                <input type="text" id="webSite" name="webSite" class="form-control" placeholder="Sitio web/redes sociales" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">    
                                <select id="typeWeb" name="typeWeb" class="form-control" onchange="chkMode()">
                                    <option value="0">Sitio web</option>
                                    <option value="1">Skype</option>
                                    <option value="2">Twitter</option>
                                    <option value="3">LinkedIn</option>
                                    <option value="4">Facebook</option>
                                    <option value="5">LiveJournal</option>
                                    <option value="6">MySpace</option>
                                    <option value="7">Gmail</option>
                                    <option value="8">Blogger</option>
                                    <option value="9">Yahoo</option>
                                    <option value="10">MSN</option>
                                    <option value="11">ICQ</option>
                                    <option value="12">Jabber</option>
                                    <option value="13">AIM</option> 
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <select id="currency" name="currency" class="form-control" placeholder="Divisa">
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Direcci&oacute;n</strong>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" id="city" name="city" class="form-control" placeholder="Ciudad" />

                            </div>
                        </td>
                        <td rowspan="4">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <textarea id="address" name="address" class="form-control" rows="5" placeholder="Dirección"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" id="state" name="state" class="form-control" placeholder="Estado" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" id="zipCode" name="zipCode" class="form-control" placeholder="Código Postal" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" id="country" name="country" class="form-control" placeholder="País" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="4">
                            <strong>Descripci&oacute;n</strong>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <textarea id="description" name="description" class="form-control" rows="5" placeholder="Descripción"></textarea>
                            </div>
                        </td>
                    </tr>
            </table>
        -->
        <!-- <button type="submit" class="btn btn-warning">Guardar datos</button> -->        
        <?php
        break;
    case 1:
        $target_path = "content/upload/cms/temp.jpg";

        $name = filter_input(INPUT_POST, "nameCompany");
        $contactType = filter_input(INPUT_POST, "contactType");
        $commercialDenomination = filter_input(INPUT_POST, "commercialDenomination");
        $telephone = filter_input(INPUT_POST, "phone");
        $email = filter_input(INPUT_POST, "email");
        $webSite = filter_input(INPUT_POST, "webSite");
        $typeWeb = filter_input(INPUT_POST, "typeWeb");
        $currency = filter_input(INPUT_POST, "currency");
        $address = filter_input(INPUT_POST, "address");
        $city = filter_input(INPUT_POST, "city");
        $state = filter_input(INPUT_POST, "state");
        $zipCode = filter_input(INPUT_POST, "zipCode");
        $country = filter_input(INPUT_POST, "country");
        $description = filter_input(INPUT_POST, "description");
        $telephoneType = filter_input(INPUT_POST, "telephoneType");
        $emailType = filter_input(INPUT_POST, "emailType");

        if ($telephoneType == 0) {
            $tipoT = "Trabajo";
        } else if ($telephoneType == 1) {
            $tipoT = "Personal";
        } else if ($telephoneType == 2) {
            $tipoT = "Otro";
        }
        $telefono = $telephone . "|" . $tipoT . ";";

        if ($emailType == 0) {
            $tipoE = "Trabajo";
        } else if ($emailType == 1) {
            $tipoE = "Personal";
        } else if ($emailType == 2) {
            $tipoE = "Otro";
        }
        $correo = $email . "|" . $tipoE . ";";

        if ($contactType == 0) {
            $tipoC = "Prospecto";
        } else if ($contactType == 1) {
            $tipoC = "No identificado";
        } else if ($contactType == 2) {
            $tipoC = "Cliente";
        } else if ($contactType == 3) {
            $tipoC = "Proovedor";
        } else if ($contactType == 4) {
            $tipoC = "Socio";
        } else if ($contactType == 5) {
            $tipoC = "Competencia";
        }

        if ($typeWeb == 0) {
            $tipoW = "Sitio web";
        } else if ($typeWeb == 1) {
            $tipoW = "Skype";
        } else if ($typeWeb == 2) {
            $tipoW = "Twitter";
        } else if ($typeWeb == 3) {
            $tipoW = "LinkedIn";
        } else if ($typeWeb == 4) {
            $tipoW = "Facebook";
        } else if ($typeWeb == 5) {
            $tipoW = "LiveJournal";
        } else if ($typeWeb == 6) {
            $tipoW = "MySpace";
        } else if ($typeWeb == 7) {
            $tipoW = "Gmail";
        } else if ($typeWeb == 8) {
            $tipoW = "Blogger";
        } else if ($typeWeb == 9) {
            $tipoW = "Yahoo";
        } else if ($typeWeb == 10) {
            $tipoW = "MSN";
        } else if ($typeWeb == 11) {
            $tipoW = "ICQ";
        } else if ($typeWeb == 12) {
            $tipoW = "Jabber";
        } else if ($typeWeb == 13) {
            $tipoW = "AIM";
        }

        mysqli_query($CNN, "INSERT INTO crm_company(name, contacttype, telephone, email, website, typeweb, address, city, state, zipcode, country, description, currency, commercialDenomination) VALUES('$name','$tipoC','$telefono','$correo','$webSite','$tipoW','$address','$city','$state','$zipCode','$country','$description', '$currency', '$commercialDenomination')");
        $nid = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
        $nname = str_replace("temp.jpg", "featured-" . $nid . ".jpg", $target_path);
        if (!isset($e)) {
            ?>
            <div class="alert alert-success">
                <h4>Se a Agregado la empresa en el Sistema</h4>
                <form action="./?m=crm&s=corp&o=0" class="form" method="post" enctype="multipart/form-data" >
                    <button type="submit" class="btn btn-success">REGRESAR</button>
                </form>
                <form action="./?m=crm&s=corp" class="form" method="post" enctype="multipart/form-d" >
                    <button type="submit" class="btn btn-success">Regresar y generar un nueva empresa</button>
                </form>
            </div>
            <?php
        }
        break;
    case 2:
        ?>
        <h4>Administraci&oacute;n de Empresas</h4>
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Tipo</td>
                    <td>Actividades</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/crm/customer.table.php');
            });
        </script>
        <?php
        break;
    case 3:
        $id = filter_input(INPUT_GET, "id");
        $consulta = "SELECT * from crm_customer where id=$id";
        $result = mysqli_query($CNN, $consulta);
        while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>     
<h4>Actualizacion de Cliente</h4>
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
        <div class="row-fluid">
            <div class="col-sm-8">
                <table class="table table-condensed">
                    <tr>
                        <td rowspan="3" width="96">
                            <img data-src="holder.js/96x96?theme=social"
                        </td>
                        <td rowspan="3" style="vertical-align: middle;">
                            <strong>Nombre:</strong> <small>¿Es una empresa? <input type="checkbox" id="isCorp" name="isCorp" value="1" /></small><br/>
                            <input type="text" id="name" name="name" value="<?php echo $x["name"];?>" style="font-size:28pt;width:100%;"  />
                        </td>
                        <td width="33%">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-plus"></i>Tipo empresa:</span>
                                <select id="contactType" name="contactType" class="form-control" onchange="chkMode()">
                                    <option value="0" <?php if($x["contactType"]==0){ echo "selected=\"selected\"";}?>>Prospecto</option>
                                    <option value="1" <?php if($x["contactType"]==1){ echo "selected=\"selected\"";}?>>No identificado</option>
                                    <option value="2" <?php if($x["contactType"]==2){ echo "selected=\"selected\"";}?>>Cliente</option>
                                    <option value="3" <?php if($x["contactType"]==3){ echo "selected=\"selected\"";}?>>Proovedor</option>
                                    <option value="4" <?php if($x["contactType"]==4){ echo "selected=\"selected\"";}?>>Socio</option>
                                    <option value="5" <?php if($x["contactType"]==5){ echo "selected=\"selected\"";}?>>Competencia</option>
                                </select>
                            </div><br/>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" id="commercialDenomination" name="commercialDenomination" class="form-control" placeholder="Denominación comercial" value="<?php echo $x["commercialDenomination"];?>" />

                            </div>
                        </td>
                    </tr>
                    <tr id="contact-row">
                        <td colspan="2">
                            <div class="input-group">
                                <span class="input-group-addon">Empresa</span>
                                <select id="corp" name="corp" class="form-control">
                                    <option value="0">Ninguna</option>
                                    <?php
                                    $oq = mysqli_query($CNN, "SELECT * from crm_customer");
                                    while ($or = mysqli_fetch_array($oq)) {
                                        echo "<option value=\"{$or["id"]}\">{$or["name"]}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="table table-condensed">
                    <tr>
                        <td width="25%" rowspan="4"><strong>Direcci&oacute;n</strong></td>
                        <td rowspan="4">
                            <input type="text" id="address1" name="address1" placeholder="Calle, no" value="<?php echo $x["address1"];?>" /><br/>
                            <input type="text" id="address2" name="address2" placeholder="Colonia" value="<?php echo $x["address2"];?>" /><br/>
                            <input type="text" id="city" name="city" placeholder="ciudad" value="<?php echo $x["city"];?>" /><br/>
                            <input type="text" id="state" name="state" placeholder="estado/provincia" value="<?php echo $x["state"];?>" /><br/>
                            <input type="text" id="zipCode" name="zipCode" placeholder="cp" value="<?php echo $x["zipCode"];?>" /><br/>
                        </td>
                        <td><strong>Telefono</strong></td>
                        <td><input type="text" id="phone" name="phone" value="<?php echo $x["phone"];?>" /></td>
                    </tr>
                    <tr>
                        <td><strong>M&oacute;vil</strong></td>
                        <td><input type="text" id="cellphone" name="cellphone" value="<?php echo $x["cellphone"];?>" /></td>
                    </tr>
                    <tr>
                        <td><strong>Fax</strong></td>
                        <td><input type="text" id="fax" name="fax" value="<?php echo $x["fax"];?>" /></td>
                    </tr>
                    <tr>
                        <td><strong>Correo Electr&oacute;nico</strong></td>
                        <td><input type="text" id="email" name="email" value="<?php echo $x["email"];?>" /></td>
                    </tr>                    
                </table>
                <table class="table table-condensed">
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Divisa</span>
                                <select id="currency" name="currency" class="form-control">
                                    <?php
                                    $oq = mysqli_query($CNN, "SELECT * from core_currency WHERE status='1'");
                                    while ($or = mysqli_fetch_array($oq)) {
                                        echo "<option value=\"{$or['code']}\">{$or["currency"]}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4">
                <h4>Actividades</h4>
                <ul class="nav">
                    <li><a href="#"><span class="badge pull-right">0</span> Reuniones</a></li>
                    <li><a href="#"><span class="badge pull-right">0</span> Llamadas</a></li>
                    <li><a href="#"><span class="badge pull-right">0</span> Ventas</a></li>
                    <li><a href="#"><span class="badge pull-right">0</span> Incidencias</a></li>
                    <li><a href="#"><span class="badge pull-right">0</span> Tareas</a></li>
                </ul>
            </div>
        </div>
            <?php
        }
        ?>
        
        <script>
            $(document).ready(function () {
                $('input[type=text]').blur(function () {
                    var oid = $(this).attr('id');
                    console.log(oid);
                    autoSave('customer', oid);
                });
                $('select').blur(function () {
                    var oid = $(this).attr('id');
                    console.log(oid);
                    autoSave('customer', oid);
                });
                $('#isCorp').click(function () {
                    if ($(this).is(':checked')) {
                        $('#contact-row').css('display', 'none');
                    } else {

                        $('#contact-row').css('display', '');
                    }
                });
            });
        </script>
        <?php
        break;
    case 4:
        $nameCompany = filter_input(INPUT_POST, "nameCompany");
        $commercialDenomination = filter_input(INPUT_POST, "commercialDenomination");
        $description = filter_input(INPUT_POST, "description");
        $contactType = filter_input(INPUT_POST, "contactType");
        $currency = filter_input(INPUT_POST, "currency");
        $telephone = filter_input(INPUT_POST, "telephone");
        $typeTelephone = filter_input(INPUT_POST, "typeTelephone");
        $email = filter_input(INPUT_POST, "email");
        $typeCorreo = filter_input(INPUT_POST, "typeCorreo");
        $webSite = filter_input(INPUT_POST, "webSite");
        $typeWeb = filter_input(INPUT_POST, "typeWeb");
        $address = filter_input(INPUT_POST, "address");
        $city = filter_input(INPUT_POST, "city");
        $state = filter_input(INPUT_POST, "state");
        $zipCode = filter_input(INPUT_POST, "zipCode");
        $country = filter_input(INPUT_POST, "country");
        $vmod = filter_input(INPUT_POST, "val_mod");

        $correo = $email . "|" . $typeCorreo . ";";
        $telefono = $telephone . "|" . $typeTelephone . ";";

        mysqli_query($CNN, "update crm_company set name='$nameCompany',description='$description',contactType='$contactType',currency='$currency',telephone='$telefono',email='$correo',webSite='$webSite',typeWeb='$typeWeb',address='$address',city='$city',state='$state',zipCode='$zipCode',country='$country', commercialDenomination='$commercialDenomination' where id=$vmod");
        ?>
        <h1>GUARDADO CORRECTAMENTE</h1>
        <form action="./?m=crm&s=corp&o=0" class="form" method="post" enctype="multipart/form-data" >
            <button type="submit" class="btn btn-success">REGRESAR</button>
        </form>
        <?php
        break;
    case 5:
        break;
    case 6:
        break;
}
