<script src="../../../js/functions.crm.js"></script>
<?php
switch ($o) {
    case 0:
        ?>
<script>
    var cantidad = 0,
    countar = 0,
    cantidadPhone = 0,
    cantidadSite = 0;
    
var emails = [0];
    
function addGroupEmail(){
    cantidad ++;
    var rowText,
        rowSelect,
        rowButton,
        rowButtonDel;
    var dtxtEmail="email" + cantidad.toString();
    var dcmbEmail ="emailType" + cantidad.toString();
    var dbtnAddFieldsEmail ="btnAddFieldsEmail" + cantidad.toString();
    var dbtnDelFieldsEmail ="btnQuitFieldsEmail" + cantidad.toString();
    var dspamEmail ="spamEmail" + cantidad.toString();
    var ddivtxtEmail ="divtxtEmail" + cantidad.toString();
    var ddivcmbEmail ="divcmbEmail" + cantidad.toString();
    var ddivbtnAddEmail ="divbtnAddEmail" + cantidad.toString();
    var ddivbtnDelEmail ="divbtnDelEmail" + cantidad.toString();
    var dtrEmail ="trEmail" + cantidad.toString();
    var brtxtEmail ="brtxtEmail" + cantidad.toString();
    var brcmbEmail ="brcmbEmail" + cantidad.toString();
    var brbtnAddEmail ="brbtnAddEmail" + cantidad.toString();
    var brbtnDelEmail ="brbtnDelEmail" + cantidad.toString();

    rowText = $('<br id="'+brtxtEmail+'"><tr id="'+dtrEmail+'"><td><div id="'+ddivtxtEmail+'" class="input-group"><span id="'+dspamEmail+'" class="input-group-addon"><i class="fa fa-envelope"></i></span><input type="text" id="'+dtxtEmail+'" onblur="onFocusEmail();" name="email" class="form-control" placeholder="Correo Electr&oacute;nico" /></div></td>');
    $('#txc').append(rowText);
    rowSelect = $('<br id="'+brcmbEmail+'"><td><div id="'+ddivcmbEmail+'" class="input-group"><select id="'+dcmbEmail+'" name="emailType" class="form-control" onchange="onFocusEmail()"><option value="Trabajo">Trabajo</option><option value="Personal">Personal</option><option value="Otro">Otro</option></select></div></td>');
    $('#slc').append(rowSelect);
    rowButton = $('<br id="'+brbtnAddEmail+'"><td><div id="'+ddivbtnAddEmail+'" class="input-group"><input id="'+dbtnAddFieldsEmail+'" + cantidad type="button" value="add" onclick="addGroupEmail();" class="form-control"/></div></td>');
    $('#btac').append(rowButton);
    rowButtonDel = $('<br id="'+brbtnDelEmail+'"><td><div id="'+ddivbtnDelEmail+'" class="input-group"><input id="'+dbtnDelFieldsEmail+'" name=cantidad type="button" value="quit" onclick="quitGroupEmail(this);" class="form-control"/></div></td></tr>');
    $('#btqc').append(rowButtonDel);
}   
function quitGroupEmail(param){
                                                //$('#btac').parent().remove();
    var id = $(param).attr("id");
    var n = id.toString().substring(18, id.length);
    if(n !== "0"){
    $('#divtxtEmail'+n).remove();
    $('#divcmbEmail'+n).remove();
    $('#divbtnAddEmail'+n).remove();
    $('#divbtnDelEmail'+n).remove();
    $('#trEmail'+n).remove();
    $('#spamEmail'+n).remove();
    $('#email'+n).remove();
    $('#emailType'+n).remove();
    $('#btnAddFieldsEmail'+n).remove();
    $('#brtxtEmail'+n).remove();
    $('#brcmbEmail'+n).remove();
    $('#brbtnAddEmail'+n).remove();
    $('#brbtnDelEmail'+n).remove();
    $('#'+id).remove();
    }
}
function addGroupPhone(){
    cantidadPhone ++;
    var rowTextPhone,
        rowSelectPhone,
        rowButtonAddPhone,
        rowButtonDelPhone;

    var txtPhone="phone" + cantidadPhone.toString();
    var cmbPhone ="telephoneType" + cantidadPhone.toString();
    var btnAddFieldsPhone ="btnAddFieldsPhone" + cantidadPhone.toString();
    var btnDelFieldsPhone ="btnDelFieldsPhone" + cantidadPhone.toString();
    var spamPhone ="spamPhone" + cantidadPhone.toString();
    var divtxtPhone ="divtxtPhone" + cantidadPhone.toString();
    var divcmbPhone ="divcmbPhone" + cantidadPhone.toString();
    var divbtnAddPhone ="divbtnAddPhone" + cantidadPhone.toString();
    var divbtnDelPhone ="divbtnDelPhone" + cantidadPhone.toString();
    var trPhone ="trPhone" + cantidadPhone.toString();
    var brtxtPhone ="brtxtPhone" + cantidadPhone.toString();
    var brcmbPhone ="brcmbPhone" + cantidadPhone.toString();
    var brbtnAddPhone ="brbtnAddPhone" + cantidadPhone.toString();
    var brbtnDelPhone ="brbtnDelPhone" + cantidadPhone.toString();    

    rowTextPhone = $('<br id="'+brtxtPhone+'"><tr id="'+trPhone+'"><td><div id="'+divtxtPhone+'" class="input-group"><span id="'+spamPhone+'" class="input-group-addon"><i class="fa fa-phone"></i></span><input type="text" id="'+txtPhone+'"  onblur="onFocusTelefono();" name="phone" class="form-control" placeholder="Tel&eacute;fono" /></div></td>');
    $('#txp').append(rowTextPhone);
    rowSelectPhone = $('<br id="'+brcmbPhone+'"><td><div id="'+divcmbPhone+'" class="input-group"><select id="'+cmbPhone+'" name="telephoneType" class="form-control" onchange="onFocusTelefono()"><option value="Trabajo">Trabajo</option><option value="Personal">Personal</option><option value="Otro">Otro</option></select></div></td>');
    $('#slp').append(rowSelectPhone);
    rowButtonAddPhone = $('<br id="'+brbtnAddPhone+'"><td><div id="'+divbtnAddPhone+'" class="input-group"><input id="'+btnAddFieldsPhone+'" type="button" value="add" onclick="addGroupPhone();" class="form-control"/></div></td></tr>');
    $('#btp').append(rowButtonAddPhone);
    rowButtonDelPhone = $('<br id="'+brbtnDelPhone+'"><td><div id="'+divbtnDelPhone+'" class="input-group"><input id="'+btnDelFieldsPhone+'" name=cantidad type="button" value="quit" onclick="quitGroupPhone(this);" class="form-control"/></div></td></tr>');
    $('#btqp').append(rowButtonDelPhone);
}
function quitGroupPhone(param){
    //$('#btac').parent().remove();
    var id = $(param).attr("id");
    var n = id.toString().substring(17, id.length);
    if(n !== "0"){
        $('#divtxtPhone'+n).remove();
        $('#divcmbPhone'+n).remove();
        $('#divbtnAddPhone'+n).remove();
        $('#divbtnDelPhone'+n).remove();
        $('#trPhone'+n).remove();
        $('#spamPhone'+n).remove();
        $('#Phone'+n).remove();
        $('#PhoneType'+n).remove();
        $('#btnAddFieldsPhone'+n).remove();
        $('#brtxtPhone'+n).remove();
        $('#brcmbPhone'+n).remove();
        $('#brbtnAddPhone'+n).remove();
        $('#brbtnDelPhone'+n).remove();
        $('#'+id).remove();
    }
}
function addGroupWebSite(){
    cantidadSite ++;
    var rowText,
        rowSelect,
        rowButton,
        rowButtonDelPhone;
    var txtSite="webSite" + cantidadSite.toString();
    var cmbSite ="typeWeb" + cantidadSite.toString();
    var btnAddFieldsSite ="btnAddFieldsSite" + cantidadSite.toString();
    var btnDelFieldsSite ="btnDelFieldsSite" + cantidadSite.toString();
    var spamSite ="spamSite" + cantidadSite.toString();
    var divtxtSite ="divtxtSite" + cantidadSite.toString();
    var divcmbSite ="divcmbSite" + cantidadSite.toString();
    var divbtnAddSite ="divbtnAddSite" + cantidadSite.toString();
    var divbtnDelSite ="divbtnDelSite" + cantidadSite.toString();
    var trSite ="trSite" + cantidadSite.toString();
    var brtxtSite ="brtxtSite" + cantidadSite.toString();
    var brcmbSite ="brcmbSite" + cantidadSite.toString();
    var brbtnAddSite ="brbtnAddSite" + cantidadSite.toString();
    var brbtnDelSite ="brbtnDelSite" + cantidadSite.toString();    

    rowText = $('<br id="'+brtxtSite+'"><trid="'+trSite+'"><td><div id="'+divtxtSite+'" class="input-group"><span id="'+spamSite+'" class="input-group-addon"><i class="fa fa-sitemap"></i></span><input type="text" id="'+txtSite+'"  onblur="onFocusPaginaWeb();"  name="webSite" class="form-control" placeholder="Sitio web/redes sociales" /></div></td>');
    $('#txs').append(rowText);
    rowSelect = $('<br id="'+brcmbSite+'"><td><div id="'+divcmbSite+'" class="input-group"><select id="'+cmbSite+'" name="typeWeb" class="form-control" onchange="onFocusPaginaWeb()"><option value="Sitio web">Sitio web</option><option value="Skype">Skype</option><option value="Twitter">Twitter</option><option value="LinkedIn">LinkedIn</option><option value="Facebook">Facebook</option><option value="LiveJournal">LiveJournal</option><option value="MySpace">MySpace</option><option value="Gmail">Gmail</option><option value="Blogger">Blogger</option><option value="Yahoo">Yahoo</option><option value="MSN">MSN</option><option value="ICQ">ICQ</option><option value="Jabber">Jabber</option><option value="AIM">AIM</option> </select></div></td>');
    $('#sls').append(rowSelect);
    rowButton = $('<br id="'+brbtnAddSite+'"><td><div id="'+divbtnAddSite+'" class="input-group"><input id="'+btnAddFieldsSite+'" type="button" value="add" onclick="addGroupWebSite();" class="form-control"/></div></td></tr>');
    $('#bts').append(rowButton);
    rowButtonDelPhone = $('<br id="'+brbtnDelSite+'"><td><div id="'+divbtnDelSite+'" class="input-group"><input id="'+btnDelFieldsSite+'" name=cantidad type="button" value="quit" onclick="quitGroupSite(this);" class="form-control"/></div></td></tr>');
    $('#btqs').append(rowButtonDelPhone);
}   
function quitGroupSite(param){
    //$('#btac').parent().remove();
    var id = $(param).attr("id");

    var n = id.toString().substring(16, id.length);

    if(n !== "0"){
        $('#divtxtSite'+n).remove();
        $('#divcmbSite'+n).remove();
        $('#divbtnAddSite'+n).remove();
        $('#divbtnDelSite'+n).remove();
        $('#trSite'+n).remove();
        $('#spamSite'+n).remove();
        $('#Site'+n).remove();
        $('#typeWeb'+n).remove();
        $('#btnAddFieldsSite'+n).remove();
        $('#brtxtSite'+n).remove();
        $('#brcmbSite'+n).remove();
        $('#brbtnAddSite'+n).remove();
        $('#brbtnDelSite'+n).remove();
        $('#'+id).remove();
    }
}

function onFocusEmail() {
   var contarC = 0;
   var texto = "";
   $(document).ready(function(){

        $("#txc").find(':input').each(function() {
            var ex = 11,
                index = 0;
            while(ex > 10){
                try {
                    if(contarC === 0){
                        if(document.getElementById("email"+contarC).value !== ""){
                            texto = "values('"+document.getElementById("email"+contarC).value + "', '" +document.getElementById("emailType"+contarC).value +"', 0),";
                        }
                    }
                    else {
                        if(document.getElementById("email"+contarC).value !== ""){
                            texto += "('"+document.getElementById("email"+contarC).value + "', '" +document.getElementById("emailType"+contarC).value +"', 0),";
                        }
                    }
                     ex = 1;
                     index = 0;
                }
                catch(err) {
                    if(index > 100) {
                        break;
                    }
                    else {
                        index ++;
                    }
                }
            }
          contarC++;                                                       
        });
   });
document.getElementById("correos").value = texto;
}
function onFocusTelefono() {
    var contarP = 0;
   var texto = "";
   $(document).ready(function(){

        $("#txp").find(':input').each(function() {
            var ex = 11,
                index = 0;
            while(ex > 10){
                try {
                    if(contarP === 0){
                     texto = "values('"+document.getElementById("phone"+contarP).value + "', '" +document.getElementById("telephoneType"+contarP).value +"', 0),";
                    }
                    else {
                       try {
                        texto += "('"+document.getElementById("phone"+contarP).value + "', '" +document.getElementById("telephoneType"+contarP).value +"', 0),";
                        }
                        catch(err){
                            alert(err.toString());
                        }
                    }
                    
                     ex = 1;
                     index = 0;
                    
                }
                catch(err) {
                    if(index > 100) {
                        break;
                    }
                    else {
                        index ++;
                    }
                }
            }
          contarP++;                                                       
        });
   });
document.getElementById("telefonos").value = texto;
}
function onFocusPaginaWeb() {
   var contarP = 0;
   var texto = "";
   $(document).ready(function(){

        $("#txs").find(':input').each(function() {
            var ex = 11,
                index = 0;
            while(ex > 10){
                try {
                    if(contarP === 0){
                     texto = "values('"+document.getElementById("webSite"+contarP).value + "', '" +document.getElementById("typeWeb"+contarP).value +"', 0),";
                    }
                    else {
                        texto += "('"+document.getElementById("webSite"+contarP).value + "', '" +document.getElementById("typeWeb"+contarP).value +"', 0),";
                    }
                     ex = 1;
                     index = 0;
                }
                catch(err) {
                    if(index > 100) {
                        break;
                    }
                    else {
                        index ++;
                    }
                }
            }
          contarP++;                                                       
        });
   });
document.getElementById("tipositio").value = texto;
}
</script>
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
                                            <option value="No identificado">No identificado</option>
                                            <option value="Cliente">Cliente</option>
                                            <option value="Proovedor">Proovedor</option>
                                            <option value="Socio">Socio</option>
                                            <option value="Competencia">Competencia</option>
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
                                <td id="txc"> <strong>Correo (s)</strong>
                                    <div class="input-group">
                                        <span id="spamEmail0" class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" id="email0" name="email" onblur="onFocusEmail();"  class="form-control" placeholder="Correo Electr&oacute;nico" />
                                    </div>
                                </td>
                                <td id="slc"> 
                                    <br>
                                    <div class="input-group">
                                        <select id="emailType0" name="emailType" class="form-control" onchange="onFocusEmail()">
                                            <option value="Trabajo">Trabajo</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                </td>
                                <td id="btac">
                                    <br>
                                    <div class="input-group">
                                        <input id="btnAddFieldsEmail0" type="button" value="add" onclick="addGroupEmail();" class="form-control"/>
                                    </div>
                                </td>
                                <td id="btqc">
                                    <br>
                                    <div class="input-group">
                                        <input id="btnQuitFieldsEmail0" type="button" value="quit" onclick="quitGroupEmail(this);" class="form-control"/>
                                    </div>
                                </td>
                                <td id="btqx">
                                    <br>
                                    <div class="input-group">
                                        <input type="text" id="correos" name="correos" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                               
                                <td id="txp"> <strong>Telefono (s)</strong>
                                    <div class="input-group">
                                        <span id="spamPhone0" class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="text" id="phone0" name="phone" onblur="onFocusTelefono();" class="form-control" placeholder="Tel&eacute;fono" />
                                    </div>
                                </td>
                                <td id="slp">
                                    <br>
                                    <div class="input-group">
                                        <select id="telephoneType0" name="telephoneType" class="form-control" onchange="onFocusTelefono()">
                                            <option value="Trabajo">Trabajo</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                </td>
                                <td id="btp">
                                    <br>
                                    <div class="input-group">
                                        <input id="btnAddFieldsPhone0" type="button" value="add" onclick="addGroupPhone();" class="form-control"/>
                                    </div>
                                </td>
                                <td id="btqp">
                                    <br>
                                    <div class="input-group">
                                        <input id="btnDelFieldsPhone0" type="button" value="quit" onclick="quitGroupPhone(this);" class="form-control"/>
                                    </div>
                                </td>
                                <td id="btqx">
                                    <br>
                                    <div class="input-group">
                                        <input type="text" id="telefonos" name="telefonos" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                
                                <td id="txs"> <strong>Sitio(s) web</strong>
                                    <div class="input-group">
                                            <span id="spamSite0" class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                                            <input type="text" id="webSite0" onblur="onFocusPaginaWeb();" name="webSite" class="form-control" placeholder="Sitio web/redes sociales" />
                                    </div>
                                </td>
                                <td id="sls">
                                    <br>
                                    <div class="input-group">    
                                        <select id="typeWeb0" name="typeWeb" class="form-control" onchange="onFocusPaginaWeb()">
                                            <option value="Sitio web">Sitio web</option>
                                            <option value="Skype">Skype</option>
                                            <option value="Twitter">Twitter</option>
                                            <option value="LinkedIn">LinkedIn</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="LiveJournal">LiveJournal</option>
                                            <option value="MySpace">MySpace</option>
                                            <option value="Gmail">Gmail</option>
                                            <option value="Blogger">Blogger</option>
                                            <option value="Yahoo">Yahoo</option>
                                            <option value="MSN">MSN</option>
                                            <option value="ICQ">ICQ</option>
                                            <option value="Jabber">Jabber</option>
                                            <option value="AIM">AIM</option> 
                                        </select>
                                    </div>
                                </td>
                                <td id="bts">
                                    <br>
                                    <div class="input-group">
                                        <input id="btnAddFieldswebSite0" type="button" value="add" onclick="addGroupWebSite();" class="form-control"/>
                                    </div>
                                </td>
                                <td id="btqs">
                                    <br>
                                    <div class="input-group">
                                        <input id="btnDelFieldsSite0" type="button" value="quit" onclick="quitGroupSite(this);" class="form-control"/>
                                    </div>
                                </td>
                                <td id="btfx">
                                    <br>
                                    <div class="input-group">
                                        <input type="text" id="tipositio" name="tipositio" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <strong>Direcci&oacute;n</strong>
                                    <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" id="address" name="address" class="form-control" placeholder="Dirección" />
                                        <!-- <textarea id="address" name="address" class="form-control" rows="5" placeholder="Dirección"></textarea> -->
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                
                                <td>
                                
                                <div class="input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" id="city" name="city" class="form-control" placeholder="Ciudad" />
                                         
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
                     <br>
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
        $address = filter_input(INPUT_POST, "address");
        $city = filter_input(INPUT_POST, "city");
        $state = filter_input(INPUT_POST, "state");
        $zipCode = filter_input(INPUT_POST, "zipCode");
        $country = filter_input(INPUT_POST, "country");
        $description = filter_input(INPUT_POST, "description");
        $telephoneType = filter_input(INPUT_POST, "telephoneType");
        $emailType = filter_input(INPUT_POST, "emailType");
        $correos = filter_input(INPUT_POST, "correos");
        $telefonos = filter_input(INPUT_POST, "telefonos");
        $tipositio = filter_input(INPUT_POST, "tipositio");
        
        
        $corr = substr($correos, 0,(strlen($correos) -1));
        $tel = substr($telefonos, 0,(strlen($telefonos) -1));
        $tipos = substr($tipositio, 0,(strlen($tipositio) -1));
        
        $varCorr = "insert into crm_contact_email (email, typeEmail, idContact) ".$corr.";";
        $varPhone = "insert into crm_contact_phone (phone, typePhone, idContact) ".$tel.";";
        $varWeb = "insert into crm_contact_website (webSite, typeWeb, idContact) ".$tipos.";";
        
        //echo '<script>alert("'.$tipositio.$tipos.$varWeb.'")</script>';
        
        mysqli_query($CNN, "INSERT INTO crm_contact(name, contacttype, company, companyposition, address, city, state, zipcode, country, description) VALUES('$name','$contactType','$company','$companyPosition','$address','$city','$state','$zipCode','$country','$description')");
        $nid = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
        $nname = str_replace("temp.jpg", "featured-" . $nid . ".jpg", $target_path);
        
        $fVarCorr = str_replace(", 0", ", ". $nid, $varCorr);
        $fVarPhone = str_replace(", 0", ", ". $nid , $varPhone);
        $fVarWeb = str_replace(", 0", ", ". $nid, $varWeb);
        
        
        
        if($varCorr != ""){
            mysqli_query($CNN, $fVarCorr);
            $nidCor = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
            $nnameCor = str_replace("temp.jpg", "featured-" . $nidCor . ".jpg", $target_path);
        }
        
        if($varPhone != ""){
            mysqli_query($CNN, $fVarPhone);
            $nidPho = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
            $nnamePho = str_replace("temp.jpg", "featured-" . $nidPho . ".jpg", $target_path);
        }
        
        if($varWeb != ""){
            mysqli_query($CNN, $fVarWeb);
            $nidWeb = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
            $nnameWeb = str_replace("temp.jpg", "featured-" . $nidWeb . ".jpg", $target_path);
        }
        
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
    case 2:
         ?>
        <h4>Administraci&oacute;n de Personas</h4>
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Tipo</td>
                    <td>Empresa</td>
                    <td>Actividades</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function () {
                jTable('tbl_admin','include/modules/crm/contact.table.php');
            });
        </script>
        <?php
        
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
            