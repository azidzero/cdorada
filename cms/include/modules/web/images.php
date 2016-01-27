<?php
include("../../../inc/app.conf.php");
parse_str($_POST['pages'], $pageOrder);
$pos= 0;
$valo="";
foreach ($pageOrder['page'] as $key => $value) {
    $image= mysqli_query($CNN, "update cms_property_gallery set orden='$pos' where id=$value;");
    if($image) {
        $valo.= $value."|";
    }
    else
    {
        echo "error";
    }
    $pos++;
}
$valo = substr($valo, 0, -1);
echo $valo;