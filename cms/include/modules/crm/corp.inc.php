<?php
switch ($o) {
    case 0:
        ?>
        <form id="frmService" action="./?m=crm&s=corp&o=1" method="post" >
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
                <button type="submit" class="btn btn-warning">Guardar datos</button>
            </div>
        </form>
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
                jTable('tbl_admin', 'include/modules/crm/corp.table.php');
            });
        </script>
        <?php
        break;
    case 3:
        $aid = $_REQUEST["id"];
        $consulta = "SELECT * from crm_company where id=$aid";
        $result = mysqli_query($CNN, $consulta);
        while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>     
            <form action="./?m=crm&s=corp&o=4" class="form" method="post" enctype="multipart/form-data" >
                <input type="text" value="<?php echo $aid; ?>" name="val_mod" style=" width:1px;height: 1px; visibility:hidden;"/>
                <div class="well well-sm">
                    <b>Editar empresa</b>
                    <table class="table table-condensed">
                        <tr>
                            <td>
                                <strong>Datos comerciales</strong>
                                <div class="input-group">
                                    <span class="input-group-addon">Nombre</span>
                                    <input type="text" value="<?php echo $x['name']; ?>" id="name" name="nameCompany" class="form-control" />                        
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Denominación comercial</span>
                                    <input type="text" value="<?php echo $x['commercialDenomination']; ?>" id="commercialDenomination" name="commercialDenomination" class="form-control" />                        
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo empresa</span>
                                    <input type="text" id="contactType" name="contactType" value="<?php echo $x['contactType']; ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Correo</span>
                                    <input type="text" id="email" name="email" value="<?php
                                    $pos = strpos($x['email'], '|');
                                    $str = substr($x['email'], 0, $pos);
                                    echo $str;
                                    ?>" class="form-control" />
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo correo</span>
                                    <input type="text" id="typeCorreo" name="typeCorreo" value="<?php
                                    $pos1 = strpos($x['email'], '|');
                                    $pos2 = strpos($x['email'], ';');
                                    $stre = substr($x['email'], $pos1 + 1, $pos2);
                                    echo $stre;
                                    ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Telefono</span>
                                    <input type="text" id="telephone" name="telephone" value="<?php
                                    $post = strpos($x['telephone'], '|');
                                    $strt = substr($x['telephone'], 0, $post);
                                    echo $strt;
                                    ?>" class="form-control" />
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo telefono</span>
                                    <input type="text" id="typeTelephone" name="typeTelephone" value="<?php
                                    $post1 = strpos($x['telephone'], '|');
                                    $post2 = strpos($x['telephone'], ';');
                                    $strtf = substr($x['telephone'], $post1 + 1, $post2);
                                    echo $strtf;
                                    ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Sitio web</span>
                                    <input type="text" id="webSite" name="webSite" value="<?php echo $x['webSite']; ?>" class="form-control" />
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo sitio</span>
                                    <input type="text" id="typeWeb" name="typeWeb" value="<?php echo $x['typeWeb']; ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo de cambio</span>
                                    <input type="text" id="currency" name="currency" value="<?php echo $x['currency']; ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Direcci&oacute;n</strong>
                                <div class="input-group">
                                    <span class="input-group-addon">Direccion</span>
                                    <input type="text" id="address" name="address" value="<?php echo $x['Address']; ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Ciudad</span>
                                    <input type="text" id="city" name="city" value="<?php echo $x['city']; ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Estado</span>
                                    <input type="text" id="state" name="state" value="<?php echo $x['state']; ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Código postal</span>
                                    <input type="text" id="zipCode" name="zipCode" value="<?php echo $x['zipCode']; ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">País</span>
                                    <input type="text" id="country" name="country" value="<?php echo $x['country']; ?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="3">
                                <strong>Dscripci&oacute;n</strong>
                                <div class="input-group">
                                    <span class="input-group-addon">Descripción</span>
                                    <textarea id="description" name="description" class="form-control" rows="5"><?php echo $x['description']; ?></textarea>
                                </div>
                            </td>
                        </tr>
                      <!--  <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Im&aacute;gen</span>
                                    <input type="file" id="feat-image" name="feat-image" class="form-control" />
                                </div>
                            </td>
                        </tr>-->
                    </table>
                    <button type="submit" class="btn btn-danger">Guardar Cambios</button>
                </div>
            </form>
            <?php
        }
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
