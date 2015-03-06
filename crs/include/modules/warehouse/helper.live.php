<?php
include("../../../inc/app.conf.php");
$pid = $_REQUEST["pid"];
$m = $_REQUEST["mode"];
switch ($m) {
    case '0':
        /* Store */
        $q = mysql_query("select * from warehouse_product where id='$pid'");
        while ($r = mysql_fetch_array($q)) {
            $store = $r["store"];
            $u = $r["units"];
        }
        if (strstr($store, ",") != "") {
            // Multiple
            $store = str_replace("[", "", $store);
            $store = str_replace("]", "", $store);
            $s = explode(",", $store);
            ?>
            <select id="store" name="store">
                <?php
                for ($i = 0; $i < count($s); $i++) {
                    $sql = mysql_query("select * from warehouse_store where id='{$s[$i]}'");
                    while ($res = mysql_fetch_array($sql)) {
                        $istore = $res["name"];
                    }
                    ?>
                    <option value="<?php echo $s[$i] ?>"><?php echo $istore ?></option>
                    <?php
                }
                ?>
            </select>
            <?php
        } else {
            $sql = mysql_query("select * from warehouse_store where id='$store'");
            while ($res = mysql_fetch_array($sql)) {
                $sname = $res["name"];
            }
            ?>
            <input type="hidden" id="store" name="store" value="<?php echo $store ?>" /><div class="alert alert-info"><?php echo $sname ?><sup><small>(<?php echo $u; ?>)</small></sup></div>
            <?php
        }
        break;
    case '1':
        $cid = $_REQUEST["cid"];
        $tid = $_REQUEST["tid"];
        $total = $_REQUEST["total"];
        /* CREDITO DISPONIBLE */
        $q = mysql_query("select * from warehouse_customer where id='$cid'");
        $n = mysql_num_rows($q);
        if ($n > 0) {
            while ($r = mysql_fetch_array($q)) {
                $ca = $r["credit_amount"];
                $cw = $r["creditw_amount"];
            }
        }
        /* CREDITO USADO */
        $q = mysql_query("select * from warehouse_ticket where id_customer='$cid' and status!='1' and status!='4' ");
        $n = mysql_num_rows($q);
        if ($n >= 0) {
            $cre_used = 0;
            while ($r = mysql_fetch_array($q)) {
                $cre_used+=$r["amount"];
                /* CREDITO PAGADO */
            }
        }
        $c_left = $ca - $cre_used - $total;
        if ($ca == 0) {
            echo true;
        } elseif ($c_left > 0) {
            echo true;
        } else {
            echo false;
        }
        break;
    case '2':
        $cid = $_REQUEST["cid"];
        $total = $_REQUEST["total"];
        /* CREDITO DISPONIBLE */
        $q = mysql_query("select * from warehouse_customer where id='$cid'");
        $n = mysql_num_rows($q);
        if ($n > 0) {
            while ($r = mysql_fetch_array($q)) {
                $ca = $r["credit_amount"];
                $cw = $r["creditw_amount"];
            }
        }
        /* CREDITO USADO */
        $q = mysql_query("select * from warehouse_ticket where id_customer='$cid' and status!='1' and status!='4' ");
        $n = mysql_num_rows($q);
        if ($n >= 0) {
            $cre_used = 0;
            while ($r = mysql_fetch_array($q)) {
                $cre_used+=$r["amount"];
                /* CREDITO PAGADO */
            }
        }
        $c_left = $ca - $cre_used - $total;
        if ($ca == 0) {
            echo true;
        } elseif ($c_left > 0) {
            echo true;
        } else {
            echo false;
        }
        break;
}
?>
