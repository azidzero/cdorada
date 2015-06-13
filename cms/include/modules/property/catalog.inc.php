<h2>Catalogos</h2> 
<?php
$activ_autosave=1;
switch ($o) {
    case 0:
        ?>
        <!---------------------------------------------------------------Div con la estructura para mensaje de eliminar el item------------------->
        <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' >
                            <input type="text" name="op" id="op" value="2" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="elim_id" id="elim_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar?:</label>
                                <label>
                                    <input type="text" name="elim_na" class="form-control-static" id="elim_na" readonly/>
                            </div>
                            <input type="text" name="el_id" class="form-control" id="el_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="eliminaitem()">Aceptar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------------------------------TERMINA DIV DE ELIMINACION -------------------------------->
        <!------------------------------------------------------INICIA DIV PARA LA EDICION DE LOS ITEMS DE LA TABLA------------------->
        <div class="modal fade" id="mod_e" name="mod_e" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Editar  General</h4>
                    </div>
                    <div class="modal-body">
                        <form id='formedit' name='formedit' method='POST' action="./?m=property&s=catalog&o=2">
                            <input type="text" name="e_id"  id="e_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="op" id="op" value="1" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="e_name" class="form-control" id="e_name" />
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="e_tdato" name="e_tdato" class="form-control"> 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="e_activ" name="e_activ"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Requerido:</label>
                                <select id="e_raq" name="e_raq"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="e_unit" id='e_unit' class="form-control" placeholder="vacio si no aplica"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="e_valp" id='e_valp' class="form-control" />
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id=guard_e" name="guard_e" class="btn btn-primary" onclick="manda_alta();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------TERMINA DIV PARA EDITAR LOS ITEMS ----------------------------->
        <!-----------------------------------------------------------INICIA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Nuevo General</h4>
                    </div>
                    <input type="text" name="tablename" id="tablename" value="general" style="visibility:hidden; width: 1px;height: 1px;"/>
                    <div class="modal-body">
                        <form id='formadd' name='formadd' method='POST'>
                            <input type="text" name="op" id="op" value="0" style="visibility:hidden; width: 1px;height: 1px;"/>
                             <input type="text" name="idsav" id="idsav" value="0" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="newname" class="form-control" id="newname" <?php if($activ_autosave==1){ ?>onblur="autosave(this.name,'name');" <?php }?>>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="tdato" name="tdato" class="form-control" <?php if($activ_autosave==1){ ?> onchange="autosave(this.name,'tipo');" onblur="autosave(this.name,'tipo');"  onclick="autosave(this.name,'tipo');"<?php }?> > 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="activ" name="activ"  class="form-control" <?php if($activ_autosave==1){ ?> onchange="autosave(this.name,'active');" onblur="autosave(this.name,'active');" onclick="autosave(this.name,'active');"<?php }?>>
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label" >Requerido:</label>
                                <select id="raq" name="raq"  class="form-control" <?php if($activ_autosave==1){ ?> onchange="autosave(this.name,'required');" onblur="autosave(this.name,'required');" onclick="autosave(this.name,'required');"<?php }?>>
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="unit" id='unit' class="form-control" placeholder="vacio si no aplica" <?php if($activ_autosave==1){ ?> onblur="autosave(this.name,'unidad');"<?php }?>/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="valp" id='valp' class="form-control" <?php if($activ_autosave==1){ ?> onblur="autosave(this.name,'valor');"<?php } ?>/>
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="altaitem();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------TERMINA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <!-------------------------------------TITULO------------------->
        <h4>General 
            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
        </h4>
        <!-----------------------TABLA DINAMICA------------------->
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Tipo de Dato</td>
                    <td>Activo</td>
                    <td>Requerido</td>
                    <td>Unidad</td>
                    <td>Val</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/property/catalog.table.php');
            });
        </script>
        <!-----------------------TERMINA SCRIPT------------------->
        <?php
        break; //TERMINA GENERAL.....
    case 10:
        ?>
        <!---------------------------------------------DIV MODIFICALE(content_e) para las respuestas de las acciones(editar o eliminar)------------------
        <div class="modal fade" id="respuesta" name="respuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Respuesta</h4>
                    </div>
                    <div class="modal-body" id="content_e" name="content_e">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>-->
        <!---------------------------------------------------------------TERMINA DIV DE RESPUESTAS ------------------->
        <!---------------------------------------------------------------Div con la estructura para mensaje de eliminar el item------------------->
        <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' >
                            <input type="text" name="op" id="op" value="12" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="elim_id" id="elim_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar?:</label>
                                <label>
                                    <input type="text" name="elim_na" class="form-control-static" id="elim_na" readonly/>
                            </div>
                            <input type="text" name="el_id" class="form-control" id="el_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="eliminaitem()">Aceptar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------------------------------TERMINA DIV DE ELIMINACION -------------------------------->
        <!------------------------------------------------------INICIA DIV PARA LA EDICION DE LOS ITEMS DE LA TABLA------------------->
        <div class="modal fade" id="mod_e" name="mod_e" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Nuevo Interior</h4>
                    </div>
                    <div class="modal-body">
                        <form id='formedit' name='formedit' method='POST' >
                            <input type="text" name="e_id"  id="e_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="op" id="op" value="11" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="e_name" class="form-control" id="e_name"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="e_tdato" name="e_tdato" class="form-control"> 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="e_activ" name="e_activ"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Requerido:</label>
                                <select id="e_raq" name="e_raq"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="e_unit" id='e_unit' class="form-control" placeholder="vacio si no aplica"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="e_valp" id='e_valp' class="form-control" />
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id=guard_e" name="guard_e" class="btn btn-primary" onclick="manda_alta();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------TERMINA DIV PARA EDITAR LOS ITEMS ----------------------------->
        <!-----------------------------------------------------------INICIA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Edita Interior</h4>
                    </div>
                    <div class="modal-body">
                        <form id='formadd' name='formadd' method='POST'>
                            <input type="text" name="op" id="op" value="10" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="newname" class="form-control" id="newname"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="tdato" name="tdato" class="form-control"> 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="activ" name="activ"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Requerido:</label>
                                <select id="raq" name="raq"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="unit" id='unit' class="form-control" placeholder="vacio si no aplica"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="valp" id='valp' class="form-control" />
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="altaitem();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------TERMINA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <!-------------------------------------TITULO------------------->
        <h4>Interior 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
        </h4>
        <!-----------------------TABLA DINAMICA------------------->
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Tipo de Dato</td>
                    <td>Activo</td>
                    <td>Requerido</td>
                    <td>Unidad</td>
                    <td>Val</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/property/catalog_int.table.php');
            });
        </script>
        <!-----------------------TERMINA SCRIPT------------------->
        <?php
        break; //TERMINA INTERIOR.....
     case 20:
        ?>
        <!---------------------------------------------------------------Div con la estructura para mensaje de eliminar el item------------------->
        <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' >
                            <input type="text" name="op" id="op" value="22" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="elim_id" id="elim_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar?:</label>
                                <label>
                                    <input type="text" name="elim_na" class="form-control-static" id="elim_na" readonly/>
                            </div>
                            <input type="text" name="el_id" class="form-control" id="el_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="eliminaitem()">Aceptar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------------------------------TERMINA DIV DE ELIMINACION -------------------------------->
        <!------------------------------------------------------INICIA DIV PARA LA EDICION DE LOS ITEMS DE LA TABLA------------------->
        <div class="modal fade" id="mod_e" name="mod_e" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Nuevo Interior</h4>
                    </div>
                    <div class="modal-body">
                        <form id='formedit' name='formedit' method='POST' >
                            <input type="text" name="e_id"  id="e_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="op" id="op" value="21" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="e_name" class="form-control" id="e_name"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="e_tdato" name="e_tdato" class="form-control"> 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="e_activ" name="e_activ"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Requerido:</label>
                                <select id="e_raq" name="e_raq"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="e_unit" id='e_unit' class="form-control" placeholder="vacio si no aplica"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="e_valp" id='e_valp' class="form-control" />
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id=guard_e" name="guard_e" class="btn btn-primary" onclick="manda_alta();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------TERMINA DIV PARA EDITAR LOS ITEMS ----------------------------->
        <!-----------------------------------------------------------INICIA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Nuevo Interior</h4>
                    </div>
                    <div class="modal-body">
                        <form id='formadd' name='formadd' method='POST'>
                            <input type="text" name="op" id="op" value="20" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="newname" class="form-control" id="newname"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="tdato" name="tdato" class="form-control"> 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="activ" name="activ"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Requerido:</label>
                                <select id="raq" name="raq"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="unit" id='unit' class="form-control" placeholder="vacio si no aplica"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="valp" id='valp' class="form-control" />
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="altaitem();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------TERMINA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <!-------------------------------------TITULO------------------->
        <h4>Exterior 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
        </h4>
        <!-----------------------TABLA DINAMICA------------------->
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Tipo de Dato</td>
                    <td>Activo</td>
                    <td>Requerido</td>
                    <td>Unidad</td>
                    <td>Val</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/property/catalog_ext.table.php');
            });
        </script>
        <!-----------------------TERMINA SCRIPT------------------->
        <?php
        break; //TERMINA exterior.....
    case 30:
        ?>
        <!---------------------------------------------DIV MODIFICALE(content_e) para las respuestas de las acciones(editar o eliminar)------------------->
        <div class="modal fade" id="respuesta" name="respuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Respuesta</h4>
                    </div>
                    <div class="modal-body" id="content_e" name="content_e">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------TERMINA DIV DE RESPUESTAS ------------------->
        <!---------------------------------------------------------------Div con la estructura para mensaje de eliminar el item------------------->
        <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' >
                            <input type="text" name="op" id="op" value="32" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="elim_id" id="elim_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar?:</label>
                                <label>
                                    <input type="text" name="elim_na" class="form-control-static" id="elim_na" readonly/>
                            </div>
                            <input type="text" name="el_id" class="form-control" id="el_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="eliminaitem()">Aceptar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------------------------------TERMINA DIV DE ELIMINACION -------------------------------->
        <!------------------------------------------------------INICIA DIV PARA LA EDICION DE LOS ITEMS DE LA TABLA------------------->
        <div class="modal fade" id="mod_e" name="mod_e" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Nuevo General</h4>
                    </div>
                    <div class="modal-body">
                        <form id='formedit' name='formedit' method='POST' >
                            <input type="text" name="e_id"  id="e_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="op" id="op" value="31" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="e_name" class="form-control" id="e_name"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="e_tdato" name="e_tdato" class="form-control"> 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="e_activ" name="e_activ"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Requerido:</label>
                                <select id="e_raq" name="e_raq"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="e_unit" id='e_unit' class="form-control" placeholder="vacio si no aplica"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="e_valp" id='e_valp' class="form-control" />
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id=guard_e" name="guard_e" class="btn btn-primary" onclick="manda_alta();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------TERMINA DIV PARA EDITAR LOS ITEMS ----------------------------->
        <!-----------------------------------------------------------INICIA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Nuevo General</h4>
                    </div>
                    <div class="modal-body">
                        <form id='formadd' name='formadd' method='POST'>
                            <input type="text" name="op" id="op" value="30" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="newname" class="form-control" id="newname"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="tdato" name="tdato" class="form-control"> 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="activ" name="activ"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Requerido:</label>
                                <select id="raq" name="raq"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="unit" id='unit' class="form-control" placeholder="vacio si no aplica"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="valp" id='valp' class="form-control" />
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="altaitem();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------TERMINA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <!-------------------------------------TITULO------------------->
        <h4>Equipamiento 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
        </h4>
        <!-----------------------TABLA DINAMICA------------------->
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Tipo de Dato</td>
                    <td>Activo</td>
                    <td>Requerido</td>
                    <td>Unidad</td>
                    <td>Val</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/property/catalog_equ.table.php');
            });
        </script>
        <!-----------------------TERMINA SCRIPT------------------->
        <?php
        break; //TERMINA EQUIPAMIENTO.....
    case 40:
        ?>
        <!---------------------------------------------DIV MODIFICALE(content_e) para las respuestas de las acciones(editar o eliminar)------------------->
        <div class="modal fade" id="respuesta" name="respuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Respuesta</h4>
                    </div>
                    <div class="modal-body" id="content_e" name="content_e">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------TERMINA DIV DE RESPUESTAS ------------------->
        <!---------------------------------------------------------------Div con la estructura para mensaje de eliminar el item------------------->
        <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' >
                            <input type="text" name="op" id="op" value="42" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="elim_id" id="elim_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar?:</label>
                                <label>
                                    <input type="text" name="elim_na" class="form-control-static" id="elim_na" readonly/>
                            </div>
                            <input type="text" name="el_id" class="form-control" id="el_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="eliminaitem()">Aceptar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------------------------------TERMINA DIV DE ELIMINACION -------------------------------->
        <!------------------------------------------------------INICIA DIV PARA LA EDICION DE LOS ITEMS DE LA TABLA------------------->
        <div class="modal fade" id="mod_e" name="mod_e" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Nuevo General</h4>
                    </div>
                    <div class="modal-body">
                        <form id='formedit' name='formedit' method='POST' >
                            <input type="text" name="e_id"  id="e_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="op" id="op" value="41" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="e_name" class="form-control" id="e_name"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="e_tdato" name="e_tdato" class="form-control"> 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="e_activ" name="e_activ"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Requerido:</label>
                                <select id="e_raq" name="e_raq"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="e_unit" id='e_unit' class="form-control" placeholder="vacio si no aplica"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="e_valp" id='e_valp' class="form-control" />
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id=guard_e" name="guard_e" class="btn btn-primary" onclick="manda_alta();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------TERMINA DIV PARA EDITAR LOS ITEMS ----------------------------->
        <!-----------------------------------------------------------INICIA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Nuevo General</h4>
                    </div>
                    <div class="modal-body">
                        <form id='formadd' name='formadd' method='POST'>
                            <input type="text" name="op" id="op" value="40" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nombre:</label>
                                <input type="text" name="newname" class="form-control" id="newname"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Tipo de dato:</label>
                                <select id="tdato" name="tdato" class="form-control"> 
                                    <option value="0">SI/NO</option >
                                    <option value="1">Numerico</option >
                                    <option value="2">Texto</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Activo:</label>
                                <select id="activ" name="activ"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Requerido:</label>
                                <select id="raq" name="raq"  class="form-control">
                                    <option value="0">NO</option >
                                    <option value="1">SI</option >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Unidad de medida:</label>
                                <input type="text" name="unit" id='unit' class="form-control" placeholder="vacio si no aplica"/>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Valor Predeterminado:</label>
                                <input type="text" name="valp" id='valp' class="form-control" />
                            </div>  
                        </form>                              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="altaitem();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------TERMINA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
        <!-------------------------------------TITULO------------------->
        <h4>Equipamiento 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus"></i></button>
        </h4>
        <!-----------------------TABLA DINAMICA------------------->
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Tipo de Dato</td>
                    <td>Activo</td>
                    <td>Requerido</td>
                    <td>Unidad</td>
                    <td>Val</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/property/catalog_extra.table.php');
            });
        </script>
        <!-----------------------TERMINA SCRIPT------------------->
        <?php
        break; //TERMINA EQUIPAMIENTO.....
}