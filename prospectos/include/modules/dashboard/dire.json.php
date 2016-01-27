<?php
include("../../../inc/app.conf.php");
$id=filter_input(INPUT_POST, "id");
$q = mysqli_query($CNN, "SELECT * from crm_persons WHERE id='$id'") or die(mysqli_error($CNN));
$json="";
while ($r = mysqli_fetch_array($q)) {
    $json= $r['address'];
}
echo $json;