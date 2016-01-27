<?php

include_once("../../../inc/app.conf.php");
$notask = mysqli_query($CNN, "select * from crm_activities where uid='" . $_SESSION['PROSPECTOS']['uid'] . "' and activo='1'");
$nt = mysqli_num_rows($notask);
echo $nt;

