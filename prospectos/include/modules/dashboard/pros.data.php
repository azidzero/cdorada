<?php
include_once("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
switch ($op) {
    case 0:
        $pid = filter_input(INPUT_POST, "pid");
        $getpid = mysqli_query($CNN, "select * from crm_persons where id=$pid")or $errpid = "Error al consultar el prospecto" . mysqli_error($CNN);
        if (!isset($errpid)) {
            while ($r = mysqli_fetch_array($getpid)) {
                ?>
                <form action="#"  method="post" id="edit_pros" name="edit_pros">
                    <input type="text" class="hidden" id="op" name="op" vaLue="1">
                    <input type="text" class="hidden" id="pid" name="pid" vaLue="<?php echo $pid; ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group text-left">
                                <div class="input-group">
                                    <div class="input-group-addon">Actividad: </div>
                                    <select id="ep_tacti" name="ep_tacti"  class="form-control "   tabindex="0" required="true">
                                        <option value="1" <?php
                                        if ($r['tactividad'] == 1) {
                                            echo "selected";
                                        }
                                        ?>>Venta</option>
                                        <option value="2" <?php
                                        if ($r['tactividad'] == 2) {
                                            echo "selected";
                                        }
                                        ?>>Alquiler</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group text-left">
                                <div class="input-group">
                                    <div class="input-group-addon">Nombre: </div>
                                    <input id="ep_name" name="ep_name" type="text" class="form-control text-capitalize" value="<?php echo $r['name']; ?>"  tabindex="1" required="true"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">Tel&eacute;fono: </div>
                                    <input id="ep_tel" name="ep_tel" type="text" class="form-control text-capitalize" value="<?php echo $r['phone']; ?>"  tabindex="1" required="true"/>
                                </div>
                            </div>
                        </div></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">email </div>
                                    <input id="ep_ema" name="ep_ema" type="text" class="form-control text-capitalize" value="<?php echo $r['email']; ?>"  tabindex="1" required="true"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Direccion </div>
                                            <input id="ep_dire" name="ep_dire" type="text" class="form-control text-capitalize" value="<?php echo $r['address']; ?>"  tabindex="1" required="true"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Web url: </div>
                                            <input id="ep_url" name="ep_url" type="text" class="form-control text-capitalize" value="<?php echo $r['url']; ?>"  tabindex="1" required="true"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">Comentario</div>
                                            <textarea id="ep_coment" name="ep_coment" class="form-control text-capitalize"  rows="5" cols="300" tabindex="6"><?php echo $r['comments']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <a href="JavaScript:void(0)"  onclick="updateprospecto();"><label class="btn btn-success">Guardar</label></a>
                                </div>
                            </div>
                            </form>

                            <?php
                        }
                    }
                    break;
                case 1:
                    $id = filter_input(INPUT_POST, "pid");
                    $myupdp=mysqli_query($CNN, "update crm_persons set name='".filter_input(INPUT_POST,"ep_name")."', phone='".filter_input(INPUT_POST,"ep_tel")."',email='".filter_input(INPUT_POST,"ep_ema")."',address='".filter_input(INPUT_POST,"ep_dire")."',url='".filter_input(INPUT_POST,"ep_url")."',comments='".filter_input(INPUT_POST,"ep_coment")."' where id=$id") or $err="error al guardar los datos".  mysqli_error($CNN);
                    if(!isset($err))
                    {
                        echo "1";
                    }
                    else
                    {
                        echo $err;
                    }
                    break;
            }