<?php

include("../../../inc/app.conf.php");
$id = $_REQUEST["sid"];
$q = mysqli_query($CNN, "SELECT * from services_area_acc WHERE area='$id'");
$n = mysqli_num_rows($q);
if ($n > 0) {
    echo "<table " . TBLcss . ">";
    while ($r = mysqli_fetch_array($q)) {
        echo "<tr><td width=\"1\"><input type=\"checkbox\" id=\"A{$r[0]}\" name=\"A{$r[0]}\" value=\"{$r[0]}\" /></td><td>{$r['name']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<div class='alert alert-warning'>No hay lista de accesorios para esta &aacute;rea</div>";
}