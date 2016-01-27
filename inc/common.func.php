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
        if (!is_array($field)) {
            $SQL = "SELECT * from $tbl WHERE $field='$value'";
        } else {
            $SQL = "SELECT * from $tbl WHERE ";
            for ($i = 0; $i < count($field); $i++) {
                if ($i < count($i)) {
                    $SQL .= "{$field[$i]}='{$value[$i]}' ";
                } else {
                    $SQL .= "AND {$field[$i]}='{$value[$i]}' ";
                }
            }
        }
        $q = mysqli_query($CNN, $SQL) or $e = (mysqli_error($CNN));
        $response = false;
        if (!isset($e)) {
            while ($r = mysqli_fetch_array($q)) {
                $response = $r[$return];
            }
        } else {
            $response = $SQL . " - " . $e;
        }
        return $response;
    }

}
if (!function_exists('random_lipsum')) {

    function random_lipsum($amount = 1, $what = 'paras', $start = 0) {
        return simplexml_load_file("http://www.lipsum.com/feed/xml?amount=$amount&what=$what&start=$start")->lipsum;
    }

}

function disponible($pid, $ini, $end) {
    global $CNN;
    $SQL = "SELECT * FROM  crs_reserva WHERE pid='$pid' AND crs_reserva.ini<='$ini' AND crs_reserva.end<='$end'
  OR pid='$pid' AND crs_reserva.ini>='$ini' AND crs_reserva.end<='$end'
  OR pid='$pid' AND crs_reserva.ini<='$end' AND crs_reserva.end >= '$end'";
    $q = mysqli_query($CNN, $SQL) or die(mysqli_error($CNN));
    $n = mysqli_num_rows($q);
    return $n;
}

function calcPrize($pid, $ini, $end) {
    global $CNN;
    $a = new datetime($ini);
    $b = new datetime($end);
    $no = $b->diff($a);
    $na = intval($no->format('%a') / 7);
    $nb = intval($no->format('%a') % 7);
    if ($nb > 0) {
        $na++;
    }
    $SQL = "select crs_rates_detail.*, crs_rates_use.pid from crs_rates_detail inner join crs_rates_use on crs_rates_use.rid=crs_rates_detail.rid where pid='$pid' and '$ini'<date_end and datediff(date_end,'$end')<7";
    $q = mysqli_query($CNN, $SQL);
    $stotal = 0;
    $n = mysqli_num_rows($q);
    if ($n > 0) {
        $x = 1;
        while ($r = mysqli_fetch_array($q)) {
            /*
             * Ofertas
             */
            $dq = mysqli_query("SELECT * from crs_offer where ");
            $c = new datetime($r["date_ini"]);
            $d = new datetime($r["date_end"]);
            $xc = $a->diff($c);
            $xd = $b->diff($d);
            $xc = $xc->format('%R%a');
            $xd = $xd->format('%R%a');            
            if ($xc < 0) {
                $d = 7 + $xc;
            } elseif ($xd > 0) {
                $d = 7 - $xd;
            } else {
                $d = 7;
            }
            $st = $d * $r["diario"];
            $stotal += $st;
            $x++;
        }
        if ($x <=$na) {
            $stotal = 0;
        }
    }
    return round($stotal, 1, PHP_ROUND_HALF_EVEN);
}
