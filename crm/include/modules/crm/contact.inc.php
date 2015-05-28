<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

switch ($o) {
    case 0:
        ?>
        <form id="frmService" action="./?m=crm&s=contact&o=1" method="post" >
            <div class="row-fluid">
                <div class="col-sm-8">
                    <strong>INFORMACI&Oacute;N DE CONTACTO</strong>
                    <table class="table table-condensed" style="font-size: 9pt;">                        
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Datos personales</strong>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" id="nameContact" name="nameContact" class="form-control" placeholder="Nombre Completo del Cliente" />
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
                                        <input type="text" id="company" name="company" class="form-control" placeholder="Empresa" />
                                   
                                        <span class="input-group-addon"></span>
                                        <input type="text" id="companyPosition" name="companyPosition" class="form-control" placeholder="Posición" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Datos adicionales</strong>
                                    <div class="input-group">
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
                    
                     <button type="submit" class="btn btn-warning">Guardar datos</button> 
                     <br></br>
                </div>
            </div>
        </form>
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
        
        mysqli_query($CNN, "INSERT INTO crm_contact(name, contacttype, company, companyposition, telephone, email, website, typeweb, address, city, state, zipcode, country, description) VALUES('$name','$tipoC','$company','$companyPosition','$telephone','$email','$webSite','$tipoW','$address','$city','$state','$zipCode','$country','$description')");
        $nid = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
        $nname = str_replace("temp.jpg", "featured-" . $nid . ".jpg", $target_path);
        if (!isset($e)) {
                ?>
                <div class="alert alert-success">
                    <h4>Se a Agregado el contacto en el Sistema</h4>
                    <form action="./?m=crm&s=contact&o=2" class="form" method="post" enctype="multipart/form-data" >
                    <button type="submit" class="btn btn-success">REGRESAR</button>
                </div>
        <?php
        }
        break;
        case 2:
            $consulta = "SELECT * from crm_contact ";
              $result=mysqli_query($CNN,$consulta);

              ?>
             <table name="table_dest" id="table_dest" width="100%">
                 <thead >
                      <tr>
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Empresa</th>
                          <th>Posicion</th>
                          <th>Telefono</th>
                          <th>Correo</th>
                          <th>Ciudad</th>
                          <th>Estado</th>
                          <th>Codigo Postal</th>
                          <th>Pais</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
                      {
                          echo "<tr>
                                     <td>$x[id]</td>
                                     <td> $x[name]</td>
                                     <td> $x[company]</td>
                                     <td> $x[companyPosition]</td>
                                     <td> $x[telephone]</td>
                                     <td> $x[email]</td>
                                     <td> $x[city]</td>
                                     <td> $x[state]</td>
                                     <td> $x[zipCode]</td>
                                     <td> $x[country]</td>
                                 <td>
                                 <table width=\"100%\"><tr><td>
                                 <form name=\"del$x[id]\" id=\"del$x[id]\" action=\"./?m=crm&s=contact&o=12\" method=\"post\" ONSUBMIT=\"return pregunta($x[id]);\">
                                      <input type=\"text\" value=\"$x[id]\"id=\"id_del\" name=\"id_del\"/> 
                                   <button><img src='images/cancel.png' alt='Eliminar' title='Eliminar'/></button>
                                  </form>
                                   </td><td>
                                  <form id=\"$x[id]\"action=\"./?m=crm&s=contact&o=10\" method=\"post\">
                                       <input type=\"text\" value=\"$x[id]\"id=\"id_edit\" name=\"id_edit\"/>                        
                                     <button type=\"submit\"><img src='images/edit.png' alt='Editar' title='Editar' /></button>
                                   </form></td></tr></table>
                                  </td>
                              </tr>";
                      }
                      ?>
                  </tbody>
              </table>
              <?php
        break;
        case 10:
            $aid = filter_input(INPUT_POST, "id_edit");
             $consulta = "SELECT * from crm_contact where id=$aid";
            $result=mysqli_query($CNN,$consulta);
            while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
            {
            ?>     

            <form action="./?m=crm&s=contact&o=11" class="form" method="post" enctype="multipart/form-data" >
                <input type="text" value="<?php echo $aid; ?>" name="val_mod" style=" width:1px;height: 1px; visibility:hidden;"/>
                <div class="well well-sm">
                    <b>Editar contacto</b>
                    <table class="table table-condensed">
                        <tr>
                            <td>
                                <strong>Datos personales</strong>
                                <div class="input-group">
                                    <span class="input-group-addon">Nombre</span>
                                    <input type="text" value="<?php echo $x['name']; ?>" id="name" name="name" class="form-control" />                        
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo contacto</span>
                                    <input type="text" id="contactType" name="contactType" value="<?php echo $x['contactType'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Empresa</span>
                                    <input type="text" id="company" name="company" value="<?php echo $x['company'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Posición</span>
                                    <input type="text" id="companyPosition" name="companyPosition" value="<?php echo $x['companyPosition'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Datos adicionales</strong>
                                <div class="input-group">
                                    <span class="input-group-addon">Telefono</span>
                                    <input type="text" id="telephone" name="telephone" value="<?php echo $x['telephone'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Correo</span>
                                    <input type="text" id="email" name="email" value="<?php echo $x['email'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Sitio web</span>
                                    <input type="text" id="webSite" name="webSite" value="<?php echo $x['webSite'];?>" class="form-control" />
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo sitio</span>
                                    <input type="text" id="typeWeb" name="typeWeb" value="<?php echo $x['typeWeb'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Direcci&oacute;n</strong>
                                <div class="input-group">
                                    <span class="input-group-addon">Direccion</span>
                                    <input type="text" id="address" name="address" value="<?php echo $x['address'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Ciudad</span>
                                    <input type="text" id="city" name="city" value="<?php echo $x['city'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Estado</span>
                                    <input type="text" id="state" name="state" value="<?php echo $x['state'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Código postal</span>
                                    <input type="text" id="zipCode" name="zipCode" value="<?php echo $x['zipCode'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">País</span>
                                    <input type="text" id="country" name="country" value="<?php echo $x['country'];?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            
                            <td rowspan="3">
                                <strong>Descripci&oacute;n</strong>
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
         case 11:
            $name = filter_input(INPUT_POST, "name");
            $description = filter_input(INPUT_POST, "description");
            $contactType = filter_input(INPUT_POST, "contactType");
            $company = filter_input(INPUT_POST, "company");
            $companyPosition = filter_input(INPUT_POST, "companyPosition");
            $telephone = filter_input(INPUT_POST, "telephone");
            $email = filter_input(INPUT_POST, "email");
            $webSite = filter_input(INPUT_POST, "webSite");
            $typeWeb = filter_input(INPUT_POST, "typeWeb");
            $address = filter_input(INPUT_POST, "address");
            $city = filter_input(INPUT_POST, "city");
            $state = filter_input(INPUT_POST, "state");
            $zipCode = filter_input(INPUT_POST, "zipCode");
            $country = filter_input(INPUT_POST, "country");
            $vmod = filter_input(INPUT_POST, "val_mod");
            mysqli_query($CNN, "update crm_contact set name='$name',description='$description',contactType='$contactType',company='$company',companyPosition='$companyPosition',telephone='$telephone',email='$email',webSite='$webSite',typeWeb='$typeWeb',address='$address',city='$city',state='$state',zipCode='$zipCode',country='$country' where id=$vmod");
            ?>
                <h1>GUARDADO CORRECTAMENTE</h1>
                <form action="./?m=crm&s=contact&o=2" class="form" method="post" enctype="multipart/form-data" >
                <button type="submit" class="btn btn-success">REGRESAR</button>
                </fotm>
            <?php
        break;
    case 12:
         $iddel = filter_input(INPUT_POST, "id_del");
        $imgnam= str_pad($iddel, 8, "0", STR_PAD_LEFT);
        $nname ="featured-".$imgnam.".jpg";
                 
        mysqli_query($CNN, "delete from crm_contact where id=$iddel");
        ?>
            <h1> SE ELIMINO CORRECTAMENTE</h1>
            <form action="./?m=crm&s=contact&o=2" class="form" method="post" enctype="multipart/form-data" >
            <button type="submit" class="btn btn-success">REGRESAR</button>
            </fotm>
        <?php
        break;
    }
?>