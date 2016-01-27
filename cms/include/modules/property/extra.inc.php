<?php
$lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
$language = array();
while ($lr = mysqli_fetch_array($lq)) {
    $language[] = $lr['iso_639_1'];
}
$activ_autosave = 0;
?>
<div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
            </div>
            <div class="modal-body" id="elimina_c" name="elimina_c">
                <form id='form_elim' name='form_elim' method='POST' >
                    <input type="text" name="op" id="op" value="3" class="hidden"/>
                    <input type="text" name="iddel" id="iddel"   class="hidden"/>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar?:</label>
                        <div id="elim_na" class="text-uppercase "></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="dell_extra()">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------TERMINA DIV DE ELIMINACION -------------------------------->
<!------------------------------------------------------INICIA DIV PARA LA EDICION DE LOS ITEMS DE LA TABLA------------------->
<div class="modal fade" id="mod_extra" name="mod_extra" style="z-index:99991;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;" >
        <div class="modal-content" id="extraconten" >
        </div>
    </div>
</div>
<!-------------------------------------------------------------TERMINA DIV PARA EDITAR LOS ITEMS ----------------------------->
<!-----------------------------------------------------------INICIA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
<div class="modal fade" id="exampleModal" tabindex="-1" style="z-index: 9999991;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content" id="alta_newextra">
        </div>
    </div>
</div>
<!---------------------------------------------------------------TERMINA DIV PARA DAR DE ALTA NUEVOS ITEMS EN LA TABLA------------------->
<!-------------------------------------TITULO------------------->
<h4>Extras
    <button type="button" class="btn btn-primary" onclick="openextra();"><i class="fa fa-plus"></i></button>
</h4>
<!-----------------------TABLA DINAMICA------------------->
<table id="tbl_extras" class="table table-condensed">
    <thead>
        <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>Costo</td>
            <td>Unidad</td>
            <td>Activo</td>
            <td width="1">&nbsp;</td>
        </tr>
    </thead>
    <tbody style="align:center;"></tbody>
</table>
<!-----------------------TERMINA TABLA DINAMICA------------------->
<!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
<script>
    $(document).ready(function () {
        jTable('tbl_extras', 'include/modules/property/catalog_extra.table.php');
    });
    function unifiyContent() 
    {
        <?php
        foreach ($language as $t)
        {
            ?>
            $('#post_descextra_<?php echo $t; ?>').val($('#descextra_<?php echo $t; ?>').code());
            <?php
        }
        ?>
        savextra();
    }
</script>
<!-----------------------TERMINA SCRIPT------------------->