<?php
include("../../../inc/app.conf.php");
$p = filter_input(INPUT_POST, "op");
switch ($p) {
    case 0:
        $id = filter_input(INPUT_POST, "id");
        $selh = mysqli_query($CNN, "SELECT a.*,b.* FROM crs_rates_detail a INNER JOIN crs_rates b ON (a.`rid`=b.`id`) WHERE a.pid=$id AND '".date("Y-m-d")."' BETWEEN b.`date_ini` AND b.`date_end`")or mysqli_error($CNN);
        $nres = mysqli_num_rows($selh);
        if ($nres >= 2) 
        {
            
        } else {
            while ($pp = mysqli_fetch_array($selh)) 
            {
                echo number_format($pp['diario'], 2);
            }
        }
        break;
    case 1:
        break;
}

