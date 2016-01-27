<h2>Ubicaciones</h2>
<div class="modal fade" id="respuesta" name="respuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:35%" >
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--<h4 class="modal-title" id="exampleModalLabel">Respuesta</h4>-->
            </div>
            <div class="modal-body" id="content_e" name="content_e">
                <div class="text-danger">
                    <h2> No se puede eliminar, contiene elementos asociados a esta ubicacion</h2>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editelemnt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Editar</h4>
            </div>
            <div class="modal-body">
                <div class="form-caracteristicas">
                    <label for="recipient-name" class="control-label">Editar <span id="txubic"></span>:</label>
                    <input type="text" name="e_des_name" id="e_des_name" class="form-control"/>
                    <input type="text" name="desid" id="desid" class="hidden"/>
                </div>
                <div class="text-danger">
                    <b><i class="fa fa-warning"></i>Esta accion afectara sus propiedades</b>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="editalocali();">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delthis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:20%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
            </div>
            <div class="modal-body">
                <form id='eliminadestino' name='eliminadestino' method='POST'>
                    <div class="form-caracteristicas">
                        <div class="text-danger">
                            <big>¿Esta seguro que desea Eliminar <span id="delnm"></span> ?</big>
                        </div>
                        <input type="text" id="idname" class="hidden"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="eliminalocali();">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<?php
switch ($o) {
    case 0:
        ?>
        <button class="btn btn-success" onclick="shlc('1')" alt="Provincia" title="PROVINCIA"><i class="fa fa-map-marker"></i> Provincia</button>
        <button class="btn btn-success" onclick="shlc('2')" alt="Localidad" title="LOCALIDAD"><i class="fa fa-location-arrow"></i> Localidad</button>
        <button class="btn btn-success" onclick="shlc('3')" alt="Zona" title="ZONA"><i class="fa fa-street-view"></i> Zona</button>
        <br>
        <br>
        <div class="row hidden" id="addprov">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><b>Provincia</b></div>
                        <input type="text" class="form-control" id="provincia" placeholder="PROVINCIA">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-success" alt="GUARDAR" onclick="savdst('1')" title="GUARDAR"><i class="fa fa-save"></i></button>
            </div>
        </div>
        <div class="row hidden" id="showprov">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><b>Provincias</b></div>
                        <select id="detprov" class="form-control">
                            <option disabled selected>Selecciona..</option>
                            <?php
                            $aqry = "select * from cms_property_locale where tipo=1 ";
                            $ado = mysqli_query($CNN, $aqry)or $err = mysqli_error();
                            if (!isset($err)) {
                                while ($sd = mysqli_fetch_array($ado)) {
                                    ?><option value="<?php echo $sd['id']; ?>"><?php echo strtoupper($sd['name']); ?></option><?php
                                }
                            }
                            ?>
                        </select>
                        <?php
                        if (isset($err)) {
                            echo $err;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row hidden" id="addloc">
            <div class="col-lg-6" >
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><b>localidad</b></div>
                        <input type="text" class="form-control" id="localidad" placeholder="LOCALIDAD">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-success" alt="GUARDAR"onclick="savdst('2')" title="GUARDAR"><i class="fa fa-save"></i></button>
            </div>
        </div>
        <div class="row hidden" id="showloc">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><b>Localidades</b></div>
                        <select id="detloc" class="form-control" >
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row hidden" id="addzon">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><b>Zona</b></div>
                        <input type="text" class="form-control" id="zona" placeholder="ZONA">
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-success" alt="GUARDAR" onclick="savdst('3')" title="GUARDAR"><i class="fa fa-save"></i></button>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                // Parametros para el combo
                $("#detprov").change(function () {
                    $("#detprov option:selected").each(function () {
                        elegido = $(this).val();
                        $.post("./include/modules/property/locale.action.php", {elegido: elegido}, function (data) {
                            $("#detloc").html(data);
                        });
                    });
                });
            });
        </script>
        <?php
        break;
    case 2:
        $stre = "SELECT a.id,a.name,(SELECT COUNT(b.parent) FROM cms_property_locale b WHERE b.parent=a.id) AS noel FROM cms_property_locale a WHERE a.tipo=1";
        $C = mysqli_query($CNN, $stre)or $err = "Error al consultar" . mysqli_error($CNN);
        if (!isset($err)) {
            while ($ca = mysqli_fetch_array($C)) {
                ?> <div class="row" style="padding-left:2%;">
                    <div class="col-lg-12"  style="border-top: 2px solid #cccccc;">
                        <!----PROVINCIA---->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12 bg-primary">
                                        <h4>
                                            <i class="fa fa-map-marker"></i>
                                            <b>
                                                 <span id="text_<?php echo $ca['id'];?>">
                                                            <?php echo $ca['name']; ?>
                                                        </span>
                                            </b>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xs-1 bg-primary" style='padding-top: 3.6px;'>
                                <div class="btn-group-sm " data-toggle="buttons">
                                    <button class="btn btn-warning" onclick='editdst(<?php echo $ca['id']; ?>)'><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger" onclick='delca(<?php echo $ca['id'].",".$ca['noel']; ?>)'><i class="fa fa-remove"></i></button>
                                </div> <h4></h4>
                            </div>
                        </div>
                        <div class="row"><!----LOCALIDAD---->
                        <?php
                            $sub = "SELECT a.id, a.name,(SELECT COUNT(b.parent) FROM cms_property_locale b WHERE b.parent=a.id) AS noel FROM cms_property_locale a WHERE a.tipo=2 and a.parent={$ca['id']}";
                            $S = mysqli_query($CNN, $sub)or $err = "Error al consultar" . mysqli_error($CNN);
                            if (!isset($err)) {
                            while ($su = mysqli_fetch_array($S)) {
                                ?>
                                <div class="row" style="padding-left:2%;">
                                    <div class="col-lg-offset-2"></div>
                                    <div class="col-lg-3  bg-info" >
                                        <big>
                                            <b>
                                                <i class="fa fa-location-arrow"></i> 
                                                <span id="text_<?php echo $su['id'];?>">
                                                    <?php echo $su['name']; ?>
                                                </span>
                                            </b>
                                        </big>
                                    </div>
                                    <div class="col-lg-3  bg-info" style="padding-top:2.5px;">
                                        <div class="btn-group-sm">
                                            <button class="btn-warning" onclick='editdst(<?php echo $su['id']; ?>)'><i class="fa fa-edit"></i></button>
                                            <button class="btn-danger" onclick='delca(<?php echo $su['id'].",".$su['noel']; ?>)'><i class="fa fa-remove"></i></button>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                            if($su['noel']>0)
                            {
                                ?>
                                <div class="row" style="padding-left:3.5%; margin:2px;">
                                    <div class="col-lg-6">
                                        <?php
                                        $zo = "SELECT a.id, a.name FROM cms_property_locale a WHERE a.tipo=3 and a.parent={$su['id']}";
                                        $Z = mysqli_query($CNN, $zo)or $err = "Error al consultar" . mysqli_error($CNN);
                                        if (!isset($err)) {
                                            while ($zo = mysqli_fetch_array($Z)) {
                                                ?>
                                                <div class="row" style="border-top: 1px solid #cccccc;">
                                                    <div class="col-lg-5">
                                                        <b><i class="fa fa-street-view"></i> 
                                                        <span id="text_<?php echo $zo['id'];?>">
                                                            <?php echo $zo['name']; ?>
                                                        </span>
                                                        </b>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <div class="btn-group-sm">
                                                            <button class="btn-default" onclick='editdst(<?php echo $zo['id']; ?>)'><i class="fa fa-edit"></i></button>
                                                            <button class="btn-default" onclick='delca(<?php echo $zo['id']; ?>,0);'><i class="fa fa-remove"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                            } else {
                                                echo $err;
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            }
                        } else {
                            echo $err;
                        }
                        ?>
                    </div>
                </div>
            </div>
        <br>
        <?php
        }
    } else {
        echo $err;
    }
    break;
    case 10:
        $pad = filter_input(INPUT_POST, "tipo");
        $aqry = "select * from cms_property_locale where padre=$pad ";
        $ado = mysqli_query($CNN, $aqry)or $err = mysqli_error();
        $salida = "";
        if (!isset($err)) {
            while ($sd = mysqli_fetch_array($ado)) {
                $salida.='<option value="<?php echo $sd[0]; ?>">' . strtoupper($sd['name']) . '</option>';
            }
        }
        echo $salida;
        break;
}
