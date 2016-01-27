<?php
include("../../../inc/app.conf.php");
$opc = filter_input(INPUT_POST, "op");
switch ($opc) {
    case 0:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * FROM crs_offer_use where id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
}
?>

