<?php
$activ_autosave = 0;
$lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
$language = array();
while ($lr = mysqli_fetch_array($lq)) {
    $language[] = $lr['iso_639_1'];
}
?>
<!-------------------DIV GENERICO------------------->
<div class="modal fade" id="modalgral" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="gral_cont">
        </div>
    </div>
</div>
<div class="modal fade" id="gral2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="gral_cont2">
        </div>
    </div>
</div>
<!----------------------ELIMINAR ITEM------------------->
<div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" id="cont_elimadon" >
        </div>
    </div>
</div>
<?php
switch ($o) {
    default:
        ?>
        <h2>Catalogo:</h2>
        <h4><b><?php  echo getData("cms_catalog", "id", $o, 'common');?></b></h4>
        <button type = "button" class = "btn btn-primary" alt = "Agregar Item al catalogo" title = "Agregar Item al catalogo" onclick = "muestramodal('<?php echo $o; ?>');">
            <b>
                <i class = "fa fa-plus"></i>
            </b>
        </button>
        <!-----------------------TABLA DINAMICA------------------->
        <table id = "tbl_admin" class = "table table-condensed">
            <thead>
                <tr>
                    <td width = "1">ID</td>
                    <td width = "15%">Nombre</td>
                    <td>Tipo de Dato</td>
                    <td>Requerido</td>
                    <td>Unidad</td>
                    <td>Val</td>
                    <td width = "1">&nbsp;
                    </td>
                </tr>
            </thead>
            <tbody style = "align:center;"></tbody>
        </table>
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/property/catalog.table.php?ntbl=<?php echo $o; ?>');
            });
        </script>
        <?php
        break; //TERMINA GENERAL.....
        //break;
    case 40:
        ?>
        <h2>ADMINISTRADOR DE CATALOGOS</h2>
        <button class="btn btn-success" alt="Agregar Catalogo" title="Agregar Catalogo" onclick="newcat();" ><i class="fa fa-plus-circle fa-2x"></i></button><br><br>
        <div class="col-lg-8" id="div-cont">
            <table id="tbl_cats" class="table table-striped  table-hover table-bordered table-condensed">
                <thead>
                    <tr class="text-uppercase bg-primary">
                        <th width="1">ID</th>
                        <th>CATALOGO</th>
                        <th>ADDONS</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody class="bg-success ">
                    <?php
                    $wh = mysqli_query($CNN, "SELECT * FROM cms_catalog");
                    while ($w = mysqli_fetch_array($wh)) {
                        ?>
                        <tr id="row_<?php echo $w['id']; ?>">
                            <td>
                                <?php echo $w['id']; ?>
                            </td>
                            <td><?php echo utf8_decode($w['common']); ?></td>
                            <td>
                                <?php
                                $count = mysqli_query($CNN, "select * from cms_addons where cid={$w['id']}");
                                $noc = mysqli_num_rows($count);
                                echo $noc;
                                ?>
                            </td>
                            <td>
                                <?php if ($w['required'] ==0) {
                                    ?>
                                    <div class=" btn-group ">
                                        <button class="btn btn-danger"alt="Eliminar" title="Eliminar"onclick="delcat(<?php echo $w['id']; ?>)"><i class="fa fa-trash"></i></button>
                                        <button class="btn btn-warning"alt="Editar" title="Editar"onclick="editcat(<?php echo $w['id']; ?>)"><i class="fa fa-edit "></i></button>
                                    </div>
                                <?php }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        break;
}