<?php

/*
 * # Base de Datos
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

define("DBH", "localhost");
define("DBU", "root");
define("DBP", "0df3f389");
define("DBB", "siga_quiro");
$CNN = mysqli_connect(DBH, DBU, DBP, DBB);
// Definiciones Comunes
include("common.def.php");
// Common Functions
include("common.func.php");

include("widget.class.php");
include("module.class.php");
include("theme.class.php");
include("core.class.php");

if (isset($_REQUEST["m"])) {
    $m = $_REQUEST["m"];
} else {
    $m = "dashboard";
}
if (isset($_REQUEST["s"])) {
    $s = $_REQUEST["s"];
} else {
    $s = "home";
}
if (isset($_REQUEST["o"])) {
    $o = $_REQUEST["o"];
} else {
    $o = 0;
}
