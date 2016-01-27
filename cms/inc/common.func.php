<?php

if (!function_exists("cat_list")) {

    function cat_list($parent = 0, $css = "") {
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
if (!function_exists('getOption')) {

    function getOption($tbl, $option) {
        global $CNN;
        $q = mysqli_query($CNN, "SELECT * from $tbl WHERE option_name='$option'") or $e = (mysqli_error($CNN));
        $response = false;
        if (!isset($e)) {
            while ($r = mysqli_fetch_array($q)) {
                $response = $r["option_value"];
            }
        } else {
            echo $e;
        }
        return $response;
    }

}
if (!function_exists('getData')) {
    function getData($table, $field, $value, $return) {
        global $CNN;
        $sql = "SELECT * from $table WHERE ";
        if (is_array($field)) {
            $osql = "";
            for ($i = 0; $i < count($field); $i++) {
                if ($osql == "") {
                    $osql .= " {$field[$i]}=\"{$value[$i]}\"";
                } else {
                    $osql .= " AND {$field[$i]}=\"{$value[$i]}\"";
                }
            }
        } else {
            $osql = " $field=\"$value\"";
        }
        $sql.=$osql;
        $q = mysqli_query($CNN, $sql) or $err = mysqli_error($CNN);
        if (!isset($err)) {
            while ($r = mysqli_fetch_array($q)) {
                $str = $r[$return];
            }
        } else {
            $str = "ERROR: " . $err;
        }
        return $str;
    }
}
if (!function_exists('getArr')) {

    function getArr($tbl, $field, $value, $return) {
        global $CNN;
        $q = mysqli_query($CNN, "SELECT * from $tbl WHERE $field='$value'") or $e = (mysqli_error($CNN));
        $response = array();
        $pos = 0;
        if (!isset($e)) {
            while ($r = mysqli_fetch_array($q)) {
                $response[$pos] = $r[$return];
                $pos++;
            }
        } else {
            echo $e;
        }
        return $response;
    }

}
if (!function_exists('random_lipsum')) {

    function random_lipsum($amount = 1, $what = 'paras', $start = 0) {
        return simplexml_load_file("http://www.lipsum.com/feed/xml?amount=$amount&what=$what&start=$start")->lipsum;
    }

}
if (!function_exists('addrows')) {

    function addrows($tbl, $ca, $va) {
        global $CNN;
        $camp = explode(",", $ca);
        $val = explode(",", $va);
        $qry = "Insert into $tbl (";
        for ($c = 0; $c < count($camp); $c++) {
            $qry.=$camp[$c] . ",";
        }
        $qry = substr($qry, 0, -1);
        $qry.=") values (";
        for ($v = 0; $v < count($val); $v++) {
            $qry.="'$val[$v]',";
        }
        $qry = substr($qry, 0, -1);
        $qry.=")";
        $nwadro = mysqli_query($CNN, $qry)or $er = "error al insertar los datos<br>$qry<br>" . mysqli_error($CNN);
        if (!isset($er)) {
            echo "1";
        } else {
            echo $er;
        }
    }

}
if (!function_exists('getcondic')) {
    function getcondic($lng,$cid)
    {
        global $CNN;
        $qy= mysqli_query($CNN,"SELECT * from cms_catalog_translate WHERE  lang='$lng' and aid=$cid")or $e="Error al obtener el dato".  mysqli_error($CNN);
        while($d=  mysqli_fetch_array($qy))
        {
            echo$d['caption'];
        }
    }
}
if (!function_exists('getData2')) {

    function getData2($tbl, $field, $value,$field2,$value2, $return) {
        global $CNN;
        $SQL = "SELECT * from $tbl WHERE $field='$value' and $field2='$value2'";
        $q = mysqli_query($CNN, $SQL) or $e = (mysqli_error($CNN));
        $response = false;
        if (!isset($e)) {
            while ($r = mysqli_fetch_array($q)) {
                $response = $r[$return];
            }
        } else {
            echo $SQL . " - " . $e;
        }
        return $response;
    }
}
if (!function_exists('getData3')) {

    function getData3($tbl, $field, $value,$field2,$value2,$field3,$value3, $return) {
        global $CNN;
        $SQL = "SELECT * from $tbl WHERE $field='$value' and $field2='$value2' and $field3='$value3'";
        $q = mysqli_query($CNN, $SQL) or $e = (mysqli_error($CNN));
        $response = false;
        if (!isset($e)) {
            while ($r = mysqli_fetch_array($q)) {
                $response = $r[$return];
            }
        } else {
            echo $SQL . " - " . $e;
        }
        return $response;
    }
}