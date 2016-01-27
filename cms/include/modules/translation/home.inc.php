<?php
//$CORE->home();
include_once('inc/app.conf.php');
$sidi=mysqli_query($CNN, "select * from cms_translation_lang where status=1") or $err="error al leer".mysqli_error($CNN);
echo "<h3> Idiomas activos:</h3>";
while($idi=mysqli_fetch_array($sidi))
{
    echo "<h4>".$idi['name_es'];
    echo "<small> &nbsp;".$idi['iso_639_1']."</small>";
    echo "</h4>";
}
?>