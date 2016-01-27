<?php
include("../../../inc/app.conf.php");
$lng = filter_input(INPUT_POST, "language");
$lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
$language = array();
while ($lr = mysqli_fetch_array($lq)) {
    $language[] = $lr['iso_639_1'];
}
?>
<div class="bg-danger" >
    <form id="nwcat">
        <div class="col-lg-12">
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    foreach ($language as $La) {
                        ?>
                        <li role="presentation" class="<?php
                        if ($La == "es") {
                            echo "active";
                        }
                        ?>">
                            <a href="#tabl_<?php echo $La; ?>" aria-controls="tab_<?php echo $La; ?>" role="tab" data-toggle="tab" class="text-capitalize "><?php echo $La; ?>  <?php if ($La == "es") { ?>
                                    <span class="label label-danger">Requerido</span>
                                    <?php
                                }
                                ?></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php
                    foreach ($language as $Le) {
                        ?>
                        <div role="tabpanel" class="tab-pane <?php
                        if ($Le == 'es') {
                            echo "active";
                        }
                        ?>" id="tabl_<?php echo $Le; ?>" name="tab_<?php echo $Le; ?>">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">Nombre(<?php echo $Le; ?>):</div>
                                    <input type="text" class="form-control" data-save="0" id="namcat_<?php echo $Le; ?>" name="namcat_<?php echo $Le; ?>" placeholder="Nombre de la categoria">
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <input type="text" id="op" name="op" value="0" class="hidden"/>
        <input type="text" id="cat_sav" name="cat_sav" value="0" class="hidden"/>
    </form>
    <div class="col-lg-12 text-right">
        <button class="btn btn-success" id="savecats" onclick="savecatempre()"><i class="fa fa-save"></i> Guardar</button>
    </div>
</div>
<?php
$gc = "select * from web_empre_category where lang='$lng'";
$gcat = mysqli_query($CNN, $gc)or $erra = "error" . mysqli_error($CNN);
if (!isset($erra)) {
    ?>
    <table class="table table-condensed table-bordered table-hover bg-info">
        <thead>
            <tr>
                <th width="1">Categoria</th>
                <th>Lenguaje</th>
                <th>Acci&oacute;n</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($c = mysqli_fetch_array($gcat)) {
                ?>
                <tr class="text-success">
                    <td class="text-capitalize"><?php echo $c["name"]; ?></td>
                    <td><?php echo $c["lang"]; ?></td>
                    <td>
                        <div class="input-group-btn ">
                            <button class="btn btn-info " onclick="editcatempre(<?php echo $c['id']; ?>)"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger " onclick="delcatempre(<?php echo $c['id']; ?>)"><i class="fa fa-remove"></i></button>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
