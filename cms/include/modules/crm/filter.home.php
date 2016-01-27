<?php
include("../../../inc/app.conf.php");
$query = "SELECT * from crm_customer ";
$s = filter_input(INPUT_POST, "search");
if ($s != "") {
    $query .= "WHERE name like '%$s%' ";
    $query .= "OR commercialDenomination like '%$s%'";
    $query .= "OR address1 like '%$s%'";
    $query .= "OR address2 like '%$s%'";
    $query .= "OR city like '%$s%'";
    $query .= "OR state like '%$s%'";
    $query .= "OR zipCode like '%$s%'";
    $query .= "OR phone like '%$s%'";
    $query .= "OR cellphone like '%$s%'";
    $query .= "OR fax like '%$s%'";
    $query .= "OR email like '%$s%'";
}
$cq = mysqli_query($CNN, $query) or die(mysqli_error($CNN));
$n = mysqli_num_rows($cq);
if ($n > 0) {
    while ($cr = mysqli_fetch_array($cq)) {
        $ctype = $cr["contactType"];
        ?>
        <div class="col-sm-3" style="padding:8px;">
            <table style="font-size:9pt;" style="width:100%;border:1px solid #EFEFEF;">
                <tr>
                    <td rowspan="4" width="64">
                        <img data-src="holder.js/64x64?theme=sky" class="img-circle" />
                    </td>
                    <td><strong><?php echo $cr["name"]; ?></strong></td>
                </tr>
                <tr>
                    <td><i class="fa fa-map-marker"></i> <?php echo "{$cr["city"]}, {$cr["state"]}"; ?></td>
                </tr>
                <tr>
                    <td><i class="fa fa-phone"></i> <?php echo $cr["phone"]; ?></td>
                </tr>
                <tr>
                    <td><i class="fa fa-envelope"></i> <?php echo $cr["email"] ?></td>
                </tr>
            </table>
        </div>
        <?php
    }
} else {
    echo "No se encontraron resultados para <strong>$s</strong>.";
}
?>
<script>
    Holder.run();
</script>