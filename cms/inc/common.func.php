<?php

if (!function_exists("cat_list")) {

    function cat_list($parent = 0, $css="") {
        global $CNN;
        $q = mysqli_query($CNN, "SELECT * from warehouse_cat WHERE parent=$parent") or $e = mysqli_error($CNN);
        if (!isset($e)) {
            $n = mysqli_num_rows($q);
            if ($n > 0) {
                echo "<ul class=\"$css\">";
                while ($r = mysqli_fetch_array($q)) {
                    echo "<li><a href=\"#\">{$r["name"]}</a>";
                    cat_list($r["id"]);
                }
                echo "</ul>";
            }
        } else {
            echo $e;
        }
    }

}