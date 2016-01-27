<?php

/*
 * # Lenguaje del Sitio o sistema
 */
date_default_timezone_set('America/Mexico_City');
error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);
/*
 * Language
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
    if ($m == 'buscar') {
        $s = "search";
        $_REQUEST["view"] = $_REQUEST["s"];
        $_REQUEST["what"] = $_REQUEST["o"];
        $_REQUEST["where"] = $_REQUEST["se"];
    } else {
        $s = $_REQUEST["s"];
    }
} else {
    if ($m == 'buscar') {
        $s = "search";
    } else {
        $s = "home";
    }
}
if (isset($_REQUEST["o"])) {
    $o = $_REQUEST["o"];
} else {
    $o = "0";
}
if ($m != "web") {
    $include = "include/modules/";
} else {
    $include = "include/web/";
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

include("web.class.php"); /* Common Functions */
include("common.func.php"); /* Common Functions */
include("paypal.conf.php"); /* PayPal Functions */
include('Sermepa/Tpv/Tpv.php'); /* SysRed */
session_start();

$web = new web($CNN);
