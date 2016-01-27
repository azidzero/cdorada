<h2>Tipos</h2> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Editar Localidad</h4>
                    </div>
                    <div class="modal-body">
                        <form id='e_destino' name='e_destino' method='POST'>
                            <input type="text" name="op" id="op" value="61" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="desid" id="desid" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-caracteristicas">
                                <label for="recipient-name" class="control-label">Editar Localizacion:</label>
                                <input type="text" name="e_des_name" class="form-actions" style="width: 50%"id="e_des_name"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="editalocali();">Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade" id="elimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body">
                        <form id='eliminadestino' name='eliminadestino' method='POST'>
                            <input type="text" name="op" id="op" value="62" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <input type="text" name="e_desid" id="e_desid" style="visibility:hidden; width: 1px;height: 1px;"/>
                            <div class="form-caracteristicas">
                                <label for="recipient-name" class="control-label">Eliminar la  Localizacion:</label>
                                <input type="text" name="miname" class="form-actions"  id="miname"/>
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
        <form id='type' name='type' method='POST'>
            <input type="text" name="op" id="op" value="60" class="hidden"/>
            <div class="form-caracteristicas">
                <label for="recipient-name" class="control-label"><h2><i class="fa fa-plus-circle"></i> Nuevo tipo:</h2></label>
                <input type="text" name="dest_name" class="form-actions" style="width: 50%"id="dest_name"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="guradatype();">Guardar</button> 
            </div>
        </form>
        <?php
        break;
    case 2:
        ?>
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/property/type.table.php');
            });
        </script>
        <?php
        break;
}
