<?php
include("../../../inc/app.conf.php");
$id = filter_input(INPUT_POST, "id");
$q = mysqli_query($CNN, "SELECT * from crs_property_deal WHERE id='$id'") or die(mysqli_error($CNN));
$json = array();
$n = mysqli_num_rows($q);
while ($r = mysqli_fetch_array($q)) {
    $json = $r;
}
echo json_encode($json);