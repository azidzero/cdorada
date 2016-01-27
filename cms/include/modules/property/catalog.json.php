<?php
include("../../../inc/app.conf.php");
$id = filter_input(INPUT_GET, "id");
$q = mysqli_query($CNN, "SELECT * from cms_property_deal WHERE id='$id'") or die(mysqli_error($CNN));
$json = array();
while ($r = mysqli_fetch_array($q)) {
    $json = $r;
}
echo json_encode($json);