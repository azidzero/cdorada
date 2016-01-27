<?php
include_once("../../../inc/app.conf.php");
$f1=filter_input(INPUT_POST, "Fil1");
$elqry=mysqli_query($CNN,"insert into crm_persons(tactividad,name,phone,email,address,url,comments,regDate,uid)"
        . "value('".filter_input(INPUT_POST, "Fil0")."','".filter_input(INPUT_POST, "Fil1")."','".filter_input(INPUT_POST, "Fil2")."','".filter_input(INPUT_POST, "Fil3")."',"
        . "'".filter_input(INPUT_POST, "Fil4")."','".filter_input(INPUT_POST, "Fil5")."','".filter_input(INPUT_POST, "Fil6")."',CURRENT_TIMESTAMP,'".$_SESSION['PROSPECTOS']['uid']."')")or $err="error".  mysqli_error($CNN);
if(!isset($err))
{
   echo mysqli_insert_id($CNN);
}
else
{
    echo "Error:".$err;
}
    
