<?php
include("../../../inc/app.conf.php");
$id=filter_input(INPUT_POST, "idprop");
$getarrp = mysqli_query($CNN, "SELECT * FROM cms_property_deal_e_property WHERE pid=$id");
$proarr = array();
$pos = 0;
while ($p = mysqli_fetch_array($getarrp)) {
    $proarr[$pos] = $p['idof'];
    $pos++;
}
$exeqry = mysqli_query($CNN, "select * from cms_property_deal");
?>
<table id="misofertas" name="misofertas" class="tbl table-striped" width="100%">
    <?php
    while ($x = mysqli_fetch_array($exeqry)) {
        ?>
        <tr> 
            <td width="5%">
                <input type="checkbox" value="<?php echo $x['id']; ?>" id="check_<?php echo $x['id']; ?>" name="check_<?php echo $x['id']; ?>" <?php
                if (in_array($x['id'], $proarr)) {
                    echo "checked";
                }
                ?> >
            </td>
            <td width="35%">
                <?php echo $x['name']; ?>
            </td>
            <td width="40%">
                <?php echo date("d-m-Y", strtotime($x['date_ini'])) . " - " . date("d-m-Y", strtotime($x['date_end'])); ?>
            </td>
            <td>
                <?php
                if ($x['tipo'] == 0) {
                    echo number_format($x['cant']) . "%";
                } else {
                    echo number_format($x['cant']);
                }
                ?>
            </td>
            <td width="10%">
                <a href="JavaScript:void(0)" alt="Clonar" title="Clonar" onclick="clonaoferta(<?php echo $x['id']; ?>)"><span class="fa fa-copy"></span></a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>