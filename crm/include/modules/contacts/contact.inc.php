<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor. 
 */

switch ($o) {
    case 0:
        ?>
        <form id="frmService" action="./?m=contacts&s=contact&o=1" method="post" >
            <div class="row-fluid">
                <div class="col-sm-8">
                    <strong>INFORMACI&Oacute;N DE LA PERSONA</strong>
                    <table class="table table-condensed" style="font-size: 9pt;">                        
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Datos personales</strong>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" id="nameContact" name="nameContact" class="form-control" placeholder="Nombre Completo" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon">Tipo contacto:</span>
                                        <select id="contactType" name="contactType" class="form-control" onchange="chkMode()">
                                            <option value="0">No identificado</option>
                                            <option value="1">Cliente</option>
                                            <option value="2">Proovedor</option>
                                            <option value="3">Socio</option>
                                            <option value="4">Competencia</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                       <!-- <input type="text" id="company" name="company" class="form-control" placeholder="Empresa" /> -->
                                        <select id="company" name="company" class="form-control" onchange="chkMode()">
                                             <?php
                                                function db_createlist($linkID,$default,$query,$blank)
                                                {
                                                    if($blank)
                                                    {
                                                        print("<option select value=\"0\">$blank</option>");
                                                    }

                                                    $resultID = mysqli_query($linkID,$query);
                                                    $num       = mysqli_num_rows($resultID); 

                                                    for ($i=0;$i<$num;$i++)
                                                    {
                                                        $row = mysqli_fetch_row($resultID);
                                                        
                                                        print("<option value=\"$row[0]\">$row[0]</option>");
                                                    }
                                                }
                                                ?> 
                                            <?php 
    // default is 0, no entry will be selected.
                                                db_createlist($CNN,0,
                                                        "select name from crm_company","Sleccione una empresa...");
                                            ?>
                                        </select>
                                   
                                        <span class="input-group-addon"></span>
                                        <input type="text" id="companyPosition" name="companyPosition" class="form-control" placeholder="Posición" />
                                    </div>
                                    <strong>Datos adicionales</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" id="phone" name="phone" class="form-control" placeholder="No. de Tel&eacute;fono" />
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
                                <td><div class="input-group">
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
                    
                    <button type="submit" class="btn btn-success">Guardar datos</button>
                    
                </div>
                     <br></br>
                </div>
            </div>
        </form>
        <form action="./?m=contacts&s=home" class="form" method="post" enctype="multipart/form-data" >
            
         </fotm> 
        
        <?php
        break;
     case 1:
        $target_path = "content/upload/cms/temp.jpg";
         
        $name = filter_input(INPUT_POST, "nameContact");
        $contactType = filter_input(INPUT_POST, "contactType");
        $company = filter_input(INPUT_POST, "company");
        $companyPosition = filter_input(INPUT_POST, "companyPosition");
        $telephone = filter_input(INPUT_POST, "phone");
        $email = filter_input(INPUT_POST, "email");
        $webSite = filter_input(INPUT_POST, "webSite");
        $typeWeb = filter_input(INPUT_POST, "typeWeb");
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
            $tipoC = "No identificado";
        } else if($contactType == 1){
            $tipoC = "Cliente";
        } else if($contactType == 2){
            $tipoC = "Proovedor";
        } else if($contactType == 3){
            $tipoC = "Socio";
        } else if($contactType == 4){
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
        
        mysqli_query($CNN, "INSERT INTO crm_contact(name, contacttype, company, companyposition, telephone, email, website, typeweb, address, city, state, zipcode, country, description) VALUES('$name','$tipoC','$company','$companyPosition','$telefono','$correo','$webSite','$tipoW','$address','$city','$state','$zipCode','$country','$description')");
        $nid = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
        $nname = str_replace("temp.jpg", "featured-" . $nid . ".jpg", $target_path);
        if (!isset($e)) {
                ?>
                <div class="alert alert-success">
                    <h4>Se a Agregado el contacto en el Sistema</h4>
                    <div>
                    <form action="./?m=contacts&s=admin&o=0" class="form" method="post" enctype="multipart/form-data" >
                    <button type="submit" class="btn btn-success">Regresar</button>
                    </form>
                        </div>
                    <div>
                     <form action="./?m=contacts&s=contact&o=0" class="form" method="post" enctype="multipart/form-data" >
                    <button type="submit" class="btn btn-success">Regresar y generar un nuevo contacto</button>
                    </form>
                    </div>
                </div>
        <?php
        }
        break;
       
    }
?>

          <!-- function addfield(where, tipo,nombre, caption){
            var fld = "<div class=\"input-goup\">";
                fld += "<span class="\"input-group-addon\">"+caption+"</spam>";
            switch(tipo){
                case 'text':
                //entrada de datos
                fld+="<input type="\"text\" id=\"" + nombre+"\" name=\"" + nombre + "\" class=\"form-control\" />";
                break;
                }
             fld +="</div>"
            $('#'+where).append(fld);
            }
            
             
            }
            <div id="grpphone"></div> -->
            