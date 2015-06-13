<script src="../../../js/main.core.js"></script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

switch ($o) {
    case 0:
         ?>
        <h4>Administraci&oacute;n de Empresas</h4>
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Titulo</td>
                    <td>Categoria</td>
                    <td>Fecha</td>
                    <td>Contacto</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function () {
                jTable('tbl_admin','include/modules/activities/admin.table.php');
                //jTable('tbl_admin','crm/include/modules/contacts/category.table.php');
            });
        </script>
        <?php
         
        break; 
    case 1:
            $aid = $_REQUEST["id"];
             $consulta = "SELECT * from crm_contact where id=$aid";
            $result=mysqli_query($CNN,$consulta);
            while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
            {
            ?>     

            <form action="./?m=contacts&s=admin&o=11" class="form" method="post" enctype="multipart/form-data" >
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
                                <strong>Datos adicionales</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                                <div class="input-group">
                                    <span class="input-group-addon">Telefono</span>
                                    <input type="text" id="telephone" name="telephone" value="<?php $post = strpos($x['telephone'], '|'); $strt = substr($x['telephone'], 0, $post); echo $strt;?>" class="form-control" />
                                </div>
                            </td>
                             <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo telefono</span>
                                    <input type="text" id="typeTelephone" name="typeTelephone" value="<?php $post1 = strpos($x['telephone'], '|'); $post2 = strpos($x['telephone'], ';'); $strtf = substr($x['telephone'], $post1 + 1, $post2); echo $strtf;?>" class="form-control" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Correo</span>
                                    <input type="text" id="email" name="email" value="<?php $pos = strpos($x['email'], '|'); $str = substr($x['email'], 0, $pos); echo $str;?>" class="form-control" />
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">Tipo correo</span>
                                    <input type="text" id="typeCorreo" name="typeCorreo" value="<?php $pos1 = strpos($x['email'], '|'); $pos2 = strpos($x['email'], ';'); $stre = substr($x['email'], $pos1 + 1, $pos2); echo $stre;?>" class="form-control" />
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
            
            $correo = $email."|".$typeCorreo.";";
            $telefono = $telephone."|".$typeTelephone.";";
            
            mysqli_query($CNN, "update crm_contact set name='$name',description='$description',contactType='$contactType',company='$company',companyPosition='$companyPosition',telephone='$telefono',email='$correo',webSite='$webSite',typeWeb='$typeWeb',address='$address',city='$city',state='$state',zipCode='$zipCode',country='$country' where id=$vmod");
            ?>
                <h1>GUARDADO CORRECTAMENTE</h1>
                <form action="./?m=contacts&s=admin&o=0" class="form" method="post" enctype="multipart/form-data" >
                <button type="submit" class="btn btn-success">REGRESAR</button>
                </fotm>
            <?php
        break;
     case 2:
           $aid = $_REQUEST["id"];
            
            mysqli_query($CNN, "update crm_activities set activo='NO' where id=$aid");
            ?>
                <h1>GUARDADO CORRECTAMENTE</h1>
                <form action="./?m=activities&s=admin&o=0" class="form" method="post" enctype="multipart/form-data" >
                <button type="submit" class="btn btn-success">REGRESAR</button>
                </fotm>
            <?php
        break;
    case 3:
         $iddel = $_REQUEST["id"];
        $imgnam= str_pad($iddel, 8, "0", STR_PAD_LEFT);
        $nname ="featured-".$imgnam.".jpg";
                 
        mysqli_query($CNN, "delete from crm_activities where id=$iddel");
        ?>
            <h1> SE ELIMINO CORRECTAMENTE</h1>
            <form action="./?m=activities&s=admin&o=0" class="form" method="post" enctype="multipart/form-data" >
            <button type="submit" class="btn btn-success">REGRESAR</button>
            </fotm>
        <?php
        break;
}
