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
/*
 * 
 */
$wlang = new lang($lang);
$wlang->loadModule($m);
