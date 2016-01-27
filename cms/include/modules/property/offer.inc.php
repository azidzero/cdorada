<h3>Ofertas</h3>
<?php
switch ($o) {
    case 0:
        ?>
        <div class="modal fade" id="askoffer" name="askoffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' >
                            <input type="text" name="op" id="op" value="91" style="visibility:hidden; width: 0px;height: 0px;"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea la oferta?</label> <input type="text" name="el_id" class="form-control" id="el_id" style="visibility:hidden; width: 1px;height: 1px;"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="deloffer()">Aceptar</button> 
                    </div>
                </div>
            </div>       
       </div>
        <div class="modal fade" id="propoffer" name="propoffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" >
                    <div class="modal-content" >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Asignar Propiedades a la Oferta</h4>
                        </div>
                        <div class="modal-body" id="elimina_c" name="elimina_c">
                            <form id='addprof' name='addprof' method='POST' >
                                <div id="contentoff" name="contentoff">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>        






        <button class="btn btn-info" onclick="showoffer();"><span class="fa fa-plus"></span></button>
        <div id="addoffer" name="addoffer" style="display:none;">
            <form id="sendoffer" name="sendoffer" method="post">
                <input type="text" id="op" name="op" value="90" class="hidden">
                <input type="text" id="isedit" name="isedit" value="" class="hidden">
                <table class="table-condensed" width="100%">
                    <tr>
                    <td width="25%">
                        <div class="inpupt-group"> 
                            <big><label class="label label-default">Oferta</label></big>
                            <input type="text" id="titleo" name="titleo" class="form-control">
                        </div>
                    </td>
                    <td width="20%">
                        <div class="inpupt-group"> 
                            <big><label class="label label-default">Inicio</label></big>
                            <input type="text" class="form-control" id="datepicker" name="datepicker" required>
                        </div>
                    </td>
                    <td width="20%">
                        <div class="inpupt-group"> 
                            <big><label class="label label-default">Final</label></big>
                            <input type="text" class="form-control" id="datepicker2" name="datepicker2" required>
                        </div>
                    </td>
                    <td width="15%">
                        <div class="inpupt-group"> 
                            <big><label class="label label-default">Cantidad</label></big>
                            <input type="text" class="form-control"  id="cantidad" name="cantidad" required>
                        </div>
                    </td>
                    <td width="20%">
                        <div class="inpupt-group"> 
                            <big><label class="label label-default">Tipo</label></big><br>
                            <input type="radio" name="options" id="option1" value="0"autocomplete="off" checked> Porcentaje %
                            <br>
                            <input type="radio" name="options" id="option1" value="1" autocomplete="off"> Cantidad €
                        </div>
                    </td>
                    </tr>
                </table>
            </form> 
            <button  type="submit" class="btn btn-success" onclick="guardaoffer();">Guardar</button>
        </div>
        <input type="text" id="id_edit" name="id_edit" class="form-control" value="0">
        <table id="example" name="example" class="table table-condensed">
            <thead>
                <tr>
                <td>ID</td>
                <td>Oferta</td>
                <td>F. Inicio</td>
                <td>F. Final</td>
                <td>Desc/Prize</td>	
                <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <script> $(document).ready(function () {
                jTable('example', 'include/modules/property/offer.table.php');
            });
        </script>
        <?php
        break;
    case 1:
        break;
}