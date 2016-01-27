<?php

/*
 * # ERROR REPORTING
 */
date_default_timezone_set('America/Mexico_City');
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
 * SESSION
 */
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
/*
 * # Base de Datos
 */
define("DBH", "localhost");
define("DBU", "root");
define("DBP", "0df3f389");
// define("DBP", "sistemas98");
define("DBB", "cdorada");
$CNN = mysqli_connect(DBH, DBU, DBP, DBB);
// Definiciones Comunes
include("common.def.php");
// Common Functions
include("common.func.php");
// Core Classes
include("widget.class.php");
include("module.class.php");
include("theme.class.php");
include("core.class.php");
include("lang.class.php");


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