<?php

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

    function getData($tbl, $field, $value, $return) {
        global $CNN;
        //echo "SELECT * from $tbl WHERE $field='$value'";
        $SQL = "SELECT * from $tbl WHERE $field='$value'";
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
if (!function_exists('random_lipsum')) {

    function random_lipsum($amount = 1, $what = 'paras', $start = 0) {
        return simplexml_load_file("http://www.lipsum.com/feed/xml?amount=$amount&what=$what&start=$start")->lipsum;
    }

}