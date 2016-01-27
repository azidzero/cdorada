<?php
include("../../../inc/app.conf.php");
$id = filter_input(INPUT_POST, "id");
$q = mysqli_query($CNN, "SELECT * from crs_rates WHERE id='$id'") or die(mysqli_error($CNN));
$json = array();
while ($r = mysqli_fetch_array($q)) {
    $json = $r;
}
echo json_encode($json);
