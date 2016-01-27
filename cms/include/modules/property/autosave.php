<?php
include("../../../inc/app.conf.php");
$p = filter_input(INPUT_POST, "op");
switch ($p) {
    case 0:
        $cat=  filter_input(INPUT_POST, "cat");
        $addon=  filter_input(INPUT_POST,"addon");
        $value=filter_input(INPUT_POST,"val");
        $pid=filter_input(INPUT_POST,"pid");
        $pusaddon="insert into cms_property_addons (pid,cid,aid,ovalue)values('$pid','$cat','$addon','$value')";
        $exe=mysqli_query($CNN, $pusaddon) or $e="Error al Autoguardar el elemento: ".mysqli_error($CNN);
        if(!isset($e))
        {
            echo "1";
        }
        else
        {
            echo $e;
        }
        break;
    case 1:
        $cat=  filter_input(INPUT_POST, "cat");
        $addon=  filter_input(INPUT_POST,"addon");
        $pid=filter_input(INPUT_POST,"pid");
        $pusaddon="delete from cms_property_addons where pid='$pid' and cid='$cat' and aid='$addon'";
        $exe=  mysqli_query($CNN, $pusaddon) or $e="Error al Autoguardar el elemento".mysqli_error($CNN);
        if(!isset($e))
        {
            echo "0";
        }
        else
        {
            echo $e;
        }
        break;
    case 2:
         $cat=  filter_input(INPUT_POST, "cat");
        $addon=  filter_input(INPUT_POST,"addon");
        $value=filter_input(INPUT_POST,"val");
        $pid=filter_input(INPUT_POST,"pid");
        $updaddon="update cms_property_addons set ovalue='$value' where pid='$pid' and cid='$cat' and aid='$addon'";
        $upd=  mysqli_query($CNN, $updaddon) or $e="Error al actualizar el valor".mysqli_error($CNN);
        if(!isset($e))
        {
            echo "1";
        }
        else
        {
            echo $e;
        }
        break;
    
}
