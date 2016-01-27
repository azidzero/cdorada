<?php
include_once("../../../inc/app.conf.php");
mysqli_query($CNN,"INSERT INTO crm_activities(pid,title,category,dateActivity,description,activo,uid,mkuid,datecreate)VALUES('".$_REQUEST['task0']."','".$_REQUEST['task1']."','".$_REQUEST['task3']."','".date("Y-m-d",strtotime($_REQUEST['task4']))."','".$_REQUEST['task5']."','1','".$_REQUEST['task2']."','".$_SESSION['PROSPECTOS']['uid']."',CURRENT_TIMESTAMP)")or $err="error al insertar".mysqli_error($CNN);
if(!isset($err))
{
   $notask=mysqli_query($CNN,"select * from crm_activities where uid='".$_SESSION['PROSPECTOS']['uid']."' and activo='1'");
   $nt=mysqli_num_rows($notask);
   echo $nt;
   
}
else
{
    echo "0";
}