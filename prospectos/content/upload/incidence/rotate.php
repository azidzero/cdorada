<?php
include_once("../../../inc/app.conf.php");
$file=filter_input(INPUT_POST, "file");
$image = $file;
//Destino de la nueva imagen vertical
$image_rotate = $file;
 
//Definimos los grados de rotacion
$degrees = 90;
 
//Creamos una nueva imagen a partir del fichero inicial
$source = imagecreatefromjpeg($image);
 
//Rotamos la imagen 90 grados
$rotate = imagerotate($source, $degrees, 0);
 
//Creamos el archivo jpg vertical
imagejpeg($rotate, $image_rotate);
sleep(1);
echo "90";