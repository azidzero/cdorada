<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

switch ($o) {
    case 0:
        ?>
        <form id="frmService" action="./?m=company&s=plus&o=1" method="post" >
            <div class="row-fluid">
                <div>
                    <strong>INFORMACI&Oacute;N DE LA EMPRESA</strong>
                    <div class="row-fluid">
                
                    <table class="table table-condensed" style="font-size: 9pt;" >                   
                        <tbody>
                            <tr>
                                <strong>Datos comerciales</strong>
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
                                <td><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Correo Electr&oacute;nico" />
                                        <td>    
                                        <div class="input-group">
                                        <select id="emailType" name="emailType" class="form-control" onchange="chkMode()">
                                            <option value="0">Trabajo</option>
                                            <option value="1">Personal</option>
                                            <option value="2">Otro</option>
                                        </select>
                                    </div>
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
                                        <span class="input-group-addon"></span>
                                        <input type="text" id="currency" name="currency" class="form-control" placeholder="Tipo de cambio" />
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
                     <br></br>
                    </div>
                </div>
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
        
        if($telephoneType == 0){
            $tipoT = "Trabajo";
        } else if($telephoneType == 1){
            $tipoT = "Personal";
        } else if($telephoneType == 2){
            $tipoT = "Otro";
        }
        $telefono = $telephone."|".$tipoT.";";
        
        if($emailType == 0){
            $tipoE = "Trabajo";
        } else if($emailType == 1){
            $tipoE = "Personal";
        } else if($emailType == 2){
            $tipoE = "Otro";
        }
        $correo = $email."|".$tipoE.";";
        
        if($contactType == 0){
            $tipoC = "Prospecto";
        } else if($contactType == 1){
            $tipoC = "No identificado";
        } else if($contactType == 2){
            $tipoC = "Cliente";
        } else if($contactType == 3){
            $tipoC = "Proovedor";
        } else if($contactType == 4){
            $tipoC = "Socio";
        } else if($contactType == 5){
            $tipoC = "Competencia";
        }
        
        if($typeWeb == 0){
            $tipoW = "Sitio web";
        } else if($typeWeb == 1) {
            $tipoW = "Skype";
        } else if($typeWeb == 2) {
            $tipoW = "Twitter";
        } else if($typeWeb == 3) {
            $tipoW = "LinkedIn";
        } else if($typeWeb == 4) {
            $tipoW = "Facebook";
        } else if($typeWeb == 5) {
            $tipoW = "LiveJournal";
        } else if($typeWeb == 6) {
            $tipoW = "MySpace";
        } else if($typeWeb == 7) {
            $tipoW = "Gmail";
        } else if($typeWeb == 8) {
            $tipoW = "Blogger";
        } else if($typeWeb == 9) {
            $tipoW = "Yahoo";
        } else if($typeWeb == 10) {
            $tipoW = "MSN";
        } else if($typeWeb == 11) {
            $tipoW = "ICQ";
        } else if($typeWeb == 12) {
            $tipoW = "Jabber";
        } else if($typeWeb == 13) {
            $tipoW = "AIM";
        }
        
        mysqli_query($CNN, "INSERT INTO crm_company(name, contacttype, telephone, email, website, typeweb, address, city, state, zipcode, country, description, currency, commercialDenomination) VALUES('$name','$tipoC','$telefono','$correo','$webSite','$tipoW','$address','$city','$state','$zipCode','$country','$description', '$currency', '$commercialDenomination')");
        $nid = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
        $nname = str_replace("temp.jpg", "featured-" . $nid . ".jpg", $target_path);
        if (!isset($e)) {
                ?>
                <div class="alert alert-success">
                    <h4>Se a Agregado la empresa en el Sistema</h4>
                    <form action="./?m=company&s=admin&o=0" class="form" method="post" enctype="multipart/form-data" >
                    <button type="submit" class="btn btn-success">REGRESAR</button>
                    </form>
                    <form action="./?m=company&s=plus" class="form" method="post" enctype="multipart/form-d" >
                    <button type="submit" class="btn btn-success">Regresar y generar un nueva empresa</button>
                    </form>
                </div>
        <?php
        }
    break;
}
