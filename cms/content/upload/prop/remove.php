<?php
include("../../../inc/app.conf.php");
$img=  filter_input(INPUT_POST, "img");
$aid=  filter_input(INPUT_POST, "aid");
$im_pre = "im" . str_pad($img, 4, "0", STR_PAD_LEFT);  // im0000_
$oid = str_pad($aid, 2, "0", STR_PAD_LEFT);
$nam=$im_pre . "_" . $oid . "_m.jpg";
$nam2=$im_pre . "_" . $oid . "_b.jpg";
$errdel=0;
$ret=1;
if($errdel>0)
{
    $ret=0;
}
 else {
    $qrydel="delete from web_prop_gallery where name='".$im_pre . "_" . $oid . "'";
    $rm=  mysqli_query($CNN, $qrydel) or $err="error al desvincular la imagen".mysqli_error($CNN);
    if(!isset($err))
    {
        $ret=1;
    }
 else {
       $ret="0".$err; 
    }
}

if(file_exists($nam))
{
    unlink($nam);
    if(!file_exists($nam))
    {
        $errdel++;
    }
}
if(file_exists($nam2))
{
   unlink($nam2);
    if(!file_exists($nam2))
    {
        $errdel++;
    }
}

echo $ret;