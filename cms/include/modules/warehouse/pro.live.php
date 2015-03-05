<?php

include("../../../inc/app.conf.php");
$q = $_REQUEST["term"];
$ean = $q;
$m = $_SESSION["CORE"]["user"]["matriz"];
$b = $_SESSION["CORE"]["user"]["branch"];

$pro = Array();
$sql = mysql_query("select * from warehouse_product where barcode like '%$ean%' or name like '%$q%' or pdesc like '%$q%'") or die(mysql_error());
$n = mysql_num_rows($sql);
if ($n > 0) {
    while ($r = mysql_fetch_array($sql)) {
        $arr['id'] = $r["id"];
        $arr['value'] = $r["name"];
        $arr['code'] = $r["barcode"];

        $arr['prize'] = $r["p_1"];
        $arr['desc'] = $r["pdesc"];
        $pro[] = $arr;
    }
    echo json_encode($pro);
}
?>
