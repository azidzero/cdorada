<?php
include("../../../inc/app.conf.php");
$id = $_REQUEST["id"];
$im_pre = "im" . str_pad($id, 4, "0", STR_PAD_LEFT);  // im0000_
$type = str_replace("image/", "", $_FILES["file"]["type"]);
list($wo, $ho) = getimagesize($_FILES["file"]["tmp_name"]);
switch ($type) {
    case 'jpeg':
        $im = imagecreatefromjpeg($_FILES["file"]["tmp_name"]);
        break;
    case 'png':
        $im = imagecreatefrompng($_FILES["file"]["tmp_name"]);
        break;
    case 'gif':
        $im = imagecreatefromgif($_FILES["file"]["tmp_name"]);
        break;
}
$q = mysqli_query($CNN, "INSERT INTO web_info_gallery(aid) VALUES('$id')");
$nid = mysqli_insert_id($CNN);
$oid = str_pad($nid, 2, "0", STR_PAD_LEFT);
$w_m = 512;     // Ancho medio
$w_b = 1080;    // Ancho Full
$h_m = $w_m * $ho / $wo;
$h_b = $w_b * $ho / $wo;
$imm = imagecreatetruecolor($w_m, $h_m);
$imb = imagecreatetruecolor($w_b, $h_b);
imagecopyresampled($imm, $im, 0, 0, 0, 0, $w_m, $h_m, $wo, $ho);
imagecopyresampled($imb, $im, 0, 0, 0, 0, $w_b, $h_b, $wo, $ho);
imagejpeg($imm, $im_pre . "_" . $oid . "_m.jpg", 100);
imagejpeg($imm, $im_pre . "_" . $oid . "_b.jpg", 100);
$file = $im_pre . "_" . $oid;
mysqli_query($CNN, "UPDATE web_info_gallery SET name='$file' WHERE id=$nid");