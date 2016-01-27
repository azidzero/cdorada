<?php

include("inc/app.conf.php");
$uname = filter_input(INPUT_POST, "username");
$upass = filter_input(INPUT_POST, "userpass");
$u5 = filter_input(INPUT_POST, "u5");
$q = mysqli_query($CNN, "SELECT * from core_user WHERE username='$uname'");
$n = mysqli_num_rows($q);
$array = Array();
if ($n > 0) {
    while ($r = mysqli_fetch_array($q)) {
        if ($upass == $r["userpass"]) {
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
            $_SESSION['CRS'] = Array(
                'uid' => $r["id"], 
                'uname' => $r["username"], 
                'u5' => $u5,
                'level'=>$r["level"]); // update last activity time stamp
            $array["code"] = 0;
            $array["level"] = $r["level"];
            $array["caption"] = "Bienvenido<br/><b>{$r["user_name"]} {$r["user_last_p"]} {$r["user_last_m"]}</b>";
            $array["u5"] = md5($uname);
        } else {
            $array["code"] = 2;
            $array["caption"] = "La contrase&ntilde;a es incorrecta";
        }
    }
} else {
    $array["code"] = 1;
    $array["caption"] = "No se encontro el usuario";
}
echo json_encode($array);

