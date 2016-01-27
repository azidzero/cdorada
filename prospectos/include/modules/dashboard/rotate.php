<?php
include_once("../../../inc/app.conf.php");
$file=filter_input(INPUT_POST, "file");
$nombre_archivo ="localhost/cdorada/prospectos/content/upload/property/".$file;
$grados = -90;
header('Content-type: image/jpg');
$origen = imagecreatefromjpeg($nombre_archivo);
$rotar = imagerotate($origen, $grados, 0);
imagejpeg($rotar);
echo "90";