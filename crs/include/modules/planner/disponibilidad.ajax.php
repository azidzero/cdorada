<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('../../../inc/app.conf.php');
$pid = $_REQUEST["pid"];
$dini = $_REQUEST["dini"];
$dend = $_REQUEST["dend"];
$array = array();
$array['error'] = array('disponibilidad' => null, 'tarifas' => null);
$costo = 0;
$dias = 0;
$q = mysqli_query($CNN, "SELECT COUNT(*) reservas FROM crs_reserva WHERE pid='$pid' AND crs_reserva.ini BETWEEN '$dini' AND '$dend' OR pid='$pid' AND '$dini'>=crs_reserva.ini AND '$dend'<=crs_reserva.end OR pid='$pid' AND crs_reserva.end BETWEEN '$dini' AND '$dend'") or $array['error']['disponibilidad'] = mysqli_error($CNN);
if ($array['error']['disponibilidad'] == null) {
    while ($r = mysqli_fetch_array($q)) {
        $n = $r["reservas"];
    }
    if ($n > 0) {
        $array['status'] = "ERROR";
    } else {
        $array["status"] = "OK";
        $SQL = "SELECT crs_rates_use.rid,crs_rates_detail.* FROM  crs_rates_use LEFT JOIN crs_rates_detail ON crs_rates_detail.rid=crs_rates_use.rid WHERE crs_rates_use.pid='$pid' AND date_ini BETWEEN '$dini' AND '$dend'";
        $oq = mysqli_query($CNN, $SQL) or $array["error"]['tarifas'] = mysqli_error($CNN);
        $on = mysqli_num_rows($oq);
        if ($on > 0) {
            $array["tarifas"] = "SI";
            while ($or = mysqli_fetch_array($oq)) {
                $ox = array();
                $ox['date_ini'] = $or["date_ini"];
                $ox['date_end'] = $or["date_end"];
                $ox['diario'] = $or["diario"];

                $xa = new DateTime($dini);
                $xb = new DateTime($dend);
                $xc = new DateTime($or["date_ini"]);
                $xd = new DateTime($or["date_end"]);
                $l1 = $xa->getTimestamp();
                $l2 = $xb->getTimestamp();
                $l3 = $xc->getTimestamp();
                $l4 = $xd->getTimestamp();
                // [---##][###--][-----]
                // [-----][#####][-----]
                // [-----][---##][###--]
                if ($l1 >= $l3 && $l2 > $l4) {
                    $ref = $xa->diff($xd);
                } elseif ($l1 >= $l3 && $l2 <= $l4) {
                    $ref = $xa->diff($xb);
                } elseif ($l1 < $l3 && $l2 > $l1) {
                    $ref = $xc->diff($xb);
                }
                $costo += $or["diario"] * $ref->d;
                $dias+= $ref->d;

                $array['tarifa'][] = $ox;
            }
        } else {
            $array["tarifas"] = "NO";
        }
    }
}
$array["costo"] = $costo;
$array["dias"] = $dias;
echo json_encode($array);
