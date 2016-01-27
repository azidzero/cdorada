<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("inc/app.conf.php");
echo "<pre>";
$cat = array('exterior','equip','general','interior');
$cid = array('1','2','3','4');
for ($i = 0; $i < count($cat); $i++) {
    $q = mysqli_query($CNN, "SELECT * from cms_property_{$cat[$i]}");
    while ($r = mysqli_fetch_array($q)) {
        /* id|cid|tipo|valor|active|required|unidad|faul */
        /* id|tname|aid|lang|caption  */
        $SQL = "INSERT INTO cms_addons(cid,tipo,valor,active,required,unidad,faul) 
        VALUES('{$cid[$i]}','{$r["tipo"]}','{$r["valor"]}','{$r["active"]}','{$r["required"]}','{$r["unidad"]}','{$r["faul"]}')";
        $Q = mysqli_query($CNN, $SQL);
        $id = mysqli_insert_id($CNN);
        mysqli_query($CNN, "INSERT INTO cms_addon_translate(tname,aid,lang,caption) VALUES('{$cid[$i]}','$id','es','{$r["name"]}')");
    }
}
echo "</pre>";
