<?php
include("../../../inc/app.conf.php");
$id=filter_input(INPUT_POST, "gal");
$q = mysqli_query($CNN, "SELECT COUNT(id) as noreg FROM crm_persons_gallery WHERE pid='$id'") or die(mysqli_error($CNN));
while ($r = mysqli_fetch_array($q)) {
    echo $r['noreg'];
}
