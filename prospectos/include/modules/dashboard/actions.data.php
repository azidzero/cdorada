<?php
include_once("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
switch ($op) {
    case 0:
        $id = filter_input(INPUT_POST, "id");
        $qry = mysqli_query($CNN, "select a.*,(select count(id) from crm_persons_gallery where pid=$id)as att from crm_persons a where a.id=$id");
        ?>
        <table class="table-responsive table-striped" border="0" width="100%" >
            <thead>
                <tr class="title" align="right">
                    <td>
                        <div style="padding-right: 1%;">
                            <big> <span class="fa fa-close" alt="Cerrar" title="Cerrar" style="cursor:default;" onclick="cierramodal()"></span></big>
                        </div>
                    </td>
                </tr>
            </thead>
            <tr style='vertical-align: top;'>
                <td>
                    <div style="padding-left:2%;">
                        <?php
                        while ($r = mysqli_fetch_array($qry)) {
                            ?>
                            <h3><span class="fa fa-user"></span><?php echo strtoupper($r['name']); ?></h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <big><span class="fa fa-envelope"></span>&nbsp;<label>Email:&nbsp; </label><?php echo strtoupper($r['email']); ?> </big>
                                        </div>
                                        <div class="col-lg-12">
                                            <big><span class="fa fa-clock-o"></span><label>&nbsp;Creado:&nbsp;</label><?php echo date("d-m-y", strtotime($r['regDate'])); ?> </big>
                                        </div>
                                        <div class="col-lg-12">
                                            <big><span class="fa fa-phone"></span><label>Telefono:</label><?php echo strtoupper($r['phone']); ?><br> </big>
                                        </div>
                                        <div class="col-lg-12">
                                            <big><span class="fa fa-location-arrow"></span><label> Direcci&oacute;n:&nbsp; </label><?php echo strtoupper($r['address']); ?></big>
                                        </div>
                                        <div class="col-lg-12">
                                            <big><span class="fa fa-link"></span><label> URL:&nbsp; </label><?php echo strtoupper($r['url']); ?></big>
                                        </div>
                                        <div class="col-lg-12">
                                            <big><span class="fa fa-file-text-o"></span> <label>&nbsp;Comentarios:&nbsp;</label></big>
                                        </div>
                                        <div class="col-lg-12 ">
                                            <small><a href="javascript:void(0);" alt="Agregar comentario" title="Agregar comentario" onclick="aggre(<?php echo $id; ?>);"class="btn btn-default"><span class="fa fa-plus-circle"></span></a></small>
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="miscomentarios"> <?php echo strtoupper($r['comments']); ?></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="mimapa" class='gmap3' style="width:100%;"></div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div role="tabpanel">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#informacion" aria-controls="informacion" role="tab" data-toggle="tab">Tareas</a></li>
                                            <!-- <li role="presentation" ><a href="#form2" aria-controls="form2" role="tab" data-toggle="tab">Oportunidades</a></li> -->
                                            <li role="presentation" ><a href="#gall" aria-controls="gall" role="tab" data-toggle="tab">
                                                    <?php
                                                    if ($r['att'] != '0') {
                                                        ?><span class="fa fa-paperclip"></span>&nbsp;<?php
                                                    }
                                                    ?>Imagenes</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="informacion">
                                                <br>
                                                <?php
                                                $traetask = mysqli_query($CNN, "select * from crm_activities where uid='" . $_SESSION['PROSPECTOS']['uid'] . "' and activo='1' and pid='$id' order by dateActivity asc");
                                                $ntsk = mysqli_num_rows($traetask);
                                                ?>
                                                <label class="btn btn-info"> <span class="fa fa-star"></span><?php echo $ntsk; ?> Tareas</label>
                                                <a href="javascript:void(0);" onclick='muestratask(<?php echo $id; ?>);' title='Agregar Tarea' alt='Agregar Tarea' class='btn btn-success'><span class="fa fa-thumb-tack"> Agregar tarea</span></a>
                                                <br>
                                                <br>
                                                <div id="mistareas" name="mistareas">
                                                    <table class="table table-condensed" id="tabletask" name="tabletask" width="50%">
                                                        <thead class="text-uppercase bold">
                                                            <tr>
                                                                <td>Titulo</td>
                                                                <td>Categoria</td>
                                                                <td>Fecha</td>
                                                                <td>Acci&oacute;n</td>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        while ($tk = mysqli_fetch_array($traetask)) {
                                                            if ($tk['dateActivity'] < date("Y-m-d")) {
                                                                ?><tr name="rowac_<?php echo $tk['id']; ?>" id="rowac_<?php echo $tk['id']; ?>" class="bg-warning "><?php
                                                            } else {
                                                                ?><tr name="rowac_<?php echo $tk['id']; ?>" id="rowac_<?php echo $tk['id']; ?>"><?php
                                                                }
                                                                ?>
                                                                <td>
                                                                    <?php echo $tk['title']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $tk['category']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo date("d-m-Y", strtotime($tk['dateActivity'])); ?>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-warning" alt="Finalizar" title="Finalizar" onclick="finalizatarea(<?php echo $tk['id']; ?>)"><span class="fa fa-hand-o-right"></span> Finalizar</button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane " id="gall">
                                                <div class="row-fluid">
                                                    <a href="javascript:void(0);" onclick="nuevaimagen(<?php echo $id; ?>);" class="btn btn-info"><span class="fa fa-picture-o"><b>+</b></span></a><br><br>
                                                    <div id="imgnew" name="imgnew" style="display: none;"></div>
                                                    <br>
                                                    <div id="gellery" name="gallery">
                                                        <?php
                                                        $qy = mysqli_query($CNN, "select * from crm_persons_gallery where pid=$id")or die(mysqli_error($CNN));
                                                        while ($i = mysqli_fetch_array($qy)) {
                                                            ?>
                                                            <div class="col-sm-3">
                                                                <input type="text" value="0" id="ang_<?php echo $i['name']; ?>_m.jpg" name="ang_<?php echo $i['name']; ?>_m.jpg" class="hidden">
                                                                <img class="img thumbnail" name="<?php echo $i['name']; ?>" id="<?php echo $i['name']; ?>" onclick="imgProOpen('<?php echo $i['name']; ?>')" src="content/upload/property/<?php echo $i['name']; ?>_m.jpg?<?php echo rand(); ?>" title="Imagen" width="100%" />
                                                                <button class="btn-success" onclick="rotateimage('<?php echo $i['name']; ?>');"><span class="fa fa-repeat"> 90&deg;</span></button>
                                                                <br>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </td>
            </tr>
        </table>
        <?php
        break;
    case 1:
        $id = filter_input(INPUT_POST, "id");
        ?>
        <h3>Agregar comentario:</h3>
        <textarea id="addc" name="addc" rows="5" cols="300" tabindex="6"></textarea><br>
        <a href="javascript:void(0);" onclick="savecoment(<?php echo $id; ?>)" class="btn btn-success">Guardar</a>
        <?php
        break;
    case 2:
        $id = filter_input(INPUT_POST, "id");
        $txt = filter_input(INPUT_POST, "text");
        $my=  mysqli_query($CNN, "update crm_persons set comments='$txt' where id=$id") or $err="error al actualizar".  mysqli_error($CNN);
        if(!isset($err))
        {
          echo "1"  ;
        }
        else
            {
            echo $err;
        }
        break;
}

