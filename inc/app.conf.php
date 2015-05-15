<?php

/*
 * # Lenguaje del Sitio o sistema
 */

include("lang.class.php");

if (!isset($_REQUEST["lang"])) {
    header("Location:./es/");
} else {
    $lang = $_REQUEST["lang"];
}
/*
 * Modulo de trabajo o sitio Web
 */
if (isset($_REQUEST["m"])) {
    $m = $_REQUEST["m"];
} else {
    $m = "web";
}
/*
 * Seccion del Modulo
 */
if (isset($_REQUEST["s"])) {
    $s = $_REQUEST["s"];
} else {
    $s = "home";
}
if (isset($_REQUEST["o"])) {
    $o = $_REQUEST["o"];
} else {
    $o = "0";
}
/*
 * BASE DE DATOS
 */
define("DBH", "localhost");
define("DBU", "root");
define("DBP", "0df3f389");
define("DBB", "cdorada");

$CNN = mysqli_connect(DBH, DBU, DBP, DBB);

$wlang = new lang($lang);
$wlang->loadModule($m);
setcookie("lang", $lang);
include("common.func.php"); /* Common Functions */