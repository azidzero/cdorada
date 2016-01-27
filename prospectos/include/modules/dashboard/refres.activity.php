<?php
include_once("../../../inc/app.conf.php");
$id=filter_input(INPUT_POST, "idp");
$traetask = mysqli_query($CNN, "select * from crm_activities where uid='" . $_SESSION['PROSPECTOS']['uid'] . "' and activo='1' and pid='$id' order by dateActivity asc");
$ntsk = mysqli_num_rows($traetask);
?>
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

