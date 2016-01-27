<div style="text-align: center;">
    <img src="../../../images/logo.png"/><br>
    <button class="btn btn-info" alt="Empresas" title="Empresas" onclick="shwdiv(1);"><big><span class="fa fa-building" ></span> Empresas</big></button>
    <button class="btn btn-info" alt="Captacion" title="Captacion" onclick="shwdiv(2);search_p();"><big><span class="fa fa-home" ></span> Captaci&oacute;n</big></button>
    <button class="btn btn-info" alt="Mantenimiento" title="Mantenimiento" onclick="shwdiv(3);"><big><span class="fa fa-wrench" ></span> Mantenimiento</big></button>
</div>
<div id="captacion" name="captacion" style="display: none;">
    <h2>Captaci&oacute;n</h2>
    <input type="text" id="idprospecto" name="idprospecto"class="hidden" /><!---Para guardar las imagenes--->
    <div class="row"><!--Buscador-->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-xs-0">
                            <big>Buscar:</big>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text"  id="searchpros" name="searchpros" style="width:100%; "class="form-control" onkeyup="search_p();"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-xs-0">
                            <big>Actividad:</big>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select id="search2" name="search2" style="width:100%;" class="form-control" onchange="search_p();">
                                    <option></option>
                                    <option value="1">Venta</option>
                                    <option value="2">Alquiler</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="row">
                        <div class="col-xs-0">
                            <big>Fecha:</big>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                               <input type="text"  id="searpros" name="searpros" style="width:100%;" class="form-control" onchange="search_p();"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="row">
                        <div class="col-xs-0">
                            &nbsp;
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <a href="javascript:void(0);" class="btn btn-info" onclick="search_p();"><span class="fa fa-search"></span></a>
                    <a href="javascript:void(1);" onclick="showform();" class="btn btn-primary"><span class="fa fa-user-plus"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- termina buscador-->
    <div id="apn" name="apn" style="display: none;border:1px;">
        <label class="title text-capitalize"><big>Agregar prospecto</big></label>
        <form action="#"  method="post" class="form "id="frmprospect" name="frmprospect">
            <div class="row">
                <div class="col-lg-5">
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div id="title0" class="input-group-addon">Actividad:</div>
                                    <select id="Fil0" name="Fil0" class="form-control" tabindex="0">
                                        <option value="1">Venta</option>
                                        <option value="2">Alquiler</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div id="title1" class="input-group-addon">Nombre:&nbsp;</div>
                                    <input type="text" class="form-control" id="Fil1" name="Fil1" tabindex="1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div id="title2"class="input-group-addon">Tel&eacute;fono:</div>
                                    <input type="text" class="form-control" id="Fil2" name="Fil2" tabindex="2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div id="title3" class="input-group-addon">E-mail:</div>
                                    <input type="email" class="form-control" id="Fil3" name="Fil3" tabindex="3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div id="title4" class="input-group-addon">Direcci&oacute;n:</div>
                                    <input type="email" class="form-control" id="Fil4" name="Fil4" tabindex="4" onkeyup="cont_dire(this.value);">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div id="title5" class="input-group-addon">Web Url:</div>
                                    <input type="text" class="form-control" name="Fil5" id="Fil5" tabindex="5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div id="title6" class="input-group-addon">Notas:</div>
                                    <textarea id="Fil6" name="Fil6" rows="5" cols="300" tabindex="6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div id='mytesting'name="mytesting" class="gmap3" style="width:100%;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-11 text-right">
                    <a href="JavaScript:void(0);"  onclick="saveprospecto();"><label class="btn btn-success">Guardar</label></a>
                </div>
            </div>
        </form>

    </div>
    <div name="resultable" id="resultable" class="content"></div>
    <div id="subeimagen" name="subeimagen" style="display: none;">
    </div>
    <div id="detailpro" name="detailpro"class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" style="width:90%">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
            <div id="bodymodal" name="bodymodal"class="modal-content">
            </div>
        </div>
    </div>
    <!--<div id="editprospecto" name="editprospecto"class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" style="width:90%">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
            <div id="editbody" name="editbody"class="modal-content">
            </div>
        </div>
    </div>-->
    <div class="modal fade" name="editprospecto" id="editprospecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <small><h4 class="modal-title" id="myModalLabel">Editar prospecto</h4></small>
                </div>
                <div id="editbody" class="modal-body text-left">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modPros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Vista Previa</h4>
                </div>
                <div id="modProsContent" class="modal-body" style="overflow: auto;"></div>
            </div>
        </div>
    </div>
</div>
<div id="corp" name="corp"style="display: none;"></div>
<div id="mantenim" name="mantenim"style="display: none;">
    <h2>Mantenimiento</h2>
    <div id="man_cont" name="man_cont">
    </div>
</div>
<div id="taskprospecto" name="taskprospecto" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">

    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div style=" padding-top:5px;padding-right: 10px; "><big>&nbsp;&nbsp;Agregar Tarea</big><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button></div>
            <br>
            <div id="taskbody" name="taskbody"class="modal-content" style="padding: 5%;">
                <form id="frmtask" name="frmtask">
                    <input type="text" class="hidden" id="task0" name="task0">
                    <div class="form-group">
                        <b>Titulo:</b><br>
                        <input type="text" class="form-control" id="task1" name="task1">
                    </div>
                    <div class="form-group">
                        <b>Asignado:</b>
                        <select class="form-control" id="task2" name="task2">
                            <?php
                            $gusr = mysqli_query($CNN, "select username,id from core_user");
                            $opt = null;
                            while ($u = mysqli_fetch_array($gusr)) {
                                $opt.="<option ";
                                if ($u['id'] == $_SESSION['PROSPECTOS']['uid']) {
                                    $opt.="selected ";
                                }
                                $opt.="value='" . $u['id'] . "'>" . $u['username'] . "</option>";
                            }
                            echo $opt;
                            ?>
                        </select>
                    </div>
                    <div class="hidden">
                        <?php
                        $aract = array("", "LLamada", "Fax", "Email", "Cotizar", "Visita", "Demostracion", "Seguimiento");
                        ?>
                        <select class="hidden" id="task3" name="task3" >
                            <?php
                            for ($t = 0; $t < count($aract); $t++) {
                                echo "<option value='" . $aract[$t] . "'>" . $aract[$t] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <b>Fecha</b>
                        <input type="text" class="form-control" id="task4" name="task4" >
                    </div>
                    <div class="form-group">
                        <b>Notas:</b>
                        <textarea class="form-control" name="task5" id="task5"rows="3"></textarea>
                    </div>
                </form>
                <div class="form-group-lg" align="right" style="padding-right:5% "> <button onclick="savetask();" class="btn btn-success">Programar</button></div>
            </div>
        </div>
    </div>
</div>
<div id="dialog_end_task" name="dialog_end_task" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div style=" padding-top:5px;padding-right: 10px; "><big>&nbsp;&nbsp;Finalizar Actividad</big><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button></div>
            <br>
            <div id="end_body" name="end_body"class="modal-content" style="padding: 5%;">
                <input type="text" id="numtask" name="numtask" class="hidden">
                <div class="form-group">
                    <b>Notas:</b>
                    <textarea class="form-control" name="notas_end" id="notas_end"rows="3"></textarea>
                </div>
                <div class="form-group-lg" align="right" style="padding-right:5% "> <button onclick="end_task();" class="btn btn-success">Finalizar</button></div>
            </div>
        </div>
    </div>
</div>

<div id="inciden_add" name="inciden_add" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div style=" padding-top:5px;padding-right: 10px; "><big>&nbsp;&nbsp;Agregar incidencia</big><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button></div>
            <br>
            <div id="inciden_body" name="inciden_body"class="modal-content" style="padding: 5%;">

                <div class="form-group-lg" align="right" style="padding-right:5% "> <button onclick="saveincidenc();" class="btn btn-success">Finalizar</button></div>
            </div>
        </div>
    </div>
</div>
<div id="inciden_final" name="inciden_final" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div style=" padding-top:5px;padding-right: 10px; "><big>&nbsp;&nbsp;Incidencia</big><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button></div>
            <br>
            <div id="ifinal_body" name="ifinal_body"class="modal-content" style="padding: 5%;">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" name="image_content"id="image_content" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Vista Previa</h4>
            </div>
            <div id="modProsimage" class="modal-body" style="overflow: auto;"></div>
        </div>
    </div>
</div>

<div class="modal fade" name="detailhouse" id="detailhouse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <small><h4 class="modal-title" id="myModalLabel">Detalles de la propiedad</h4></small>
            </div>
            <div id="bodytailhoyse" class="modal-body" style="overflow: auto;"></div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="modalpregunta" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div id="preguntabody" class="modal-content" style="padding: 2%;">
            <label class="text-warning"><big>¿Desea eliminar esta incidencia?</big></label>
            <label class="text-info "> <small><h3>Estos cambios no se podran recuperar</h3></small></label>
            <input type="text" id="div_borrador" class="hidden"><br>
            <button class="btn btn-danger" onclick="$('#modalpregunta').modal('hide');">Cancelar</button>
            <button class="btn btn-success" onclick="borraeldiv();">Aceptar</button>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="agregacomentario" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div id="bodyagregacomentario" class="modal-content" style="padding: 2%;">
        </div>
    </div>
</div>
