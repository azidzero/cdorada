<?php
session_start();
$m = $_REQUEST["m"];
if (isset($_REQUEST["term"])) {
    $term = utf8_encode($_REQUEST["term"]);
}
if (isset($_REQUEST["store"])) {
    $store = $_REQUEST["store"];
}
$msconf = "../../../inc/app.conf.php";
if (file_exists($msconf)) {
    include($msconf);
} else {
    die("No se puede cargar la configuracion");
}
switch ($m) {
    case 0:
        // Search product
        $sq = mysql_query("select * from warehouse_product where "
                . "barcode like '%$term%' or "
                . "ref like '%$term%' or "
                . "brand like '%$term%' or "
                . "name like '%$term%' or "
                . "pdesc like '%$term%'") or die(mysql_error());
        $json = Array();
        while ($sr = mysql_fetch_array($sq)) {
            if ($sr['store'] != "") {
                $pos = $sr['store'];
                $pou = $sr['units'];
                if (strstr($pos, ",") != "") {
                    $pxs = explode(",", $pos);
                    $pxu = explode(",", $pou);
                    for ($i = 0; $i < count($pxs); $i++) {
                        if ($store == $pxs[$i]) {
                            if ($pxu > 0) {
                                $arr = Array();
                                $arr['id'] = $sr[0];
                                $arr['value'] = $sr['name'];
                                $arr['code'] = $sr['barcode'];
                                $json[] = $arr;
                            }
                        }
                    }
                } else {
                    if ($pos == $store) {
                        if ($pou > 0) {
                            $arr = Array();
                            $arr['id'] = $sr[0];
                            $arr['value'] = $sr['name'];
                            $arr['code'] = $sr['barcode'];
                            $json[] = $arr;
                        }
                    }
                }
            } else {
                if ($sr['unavailable'] == '1') {
                    $arr = Array();
                    $arr['id'] = $sr[0];
                    $arr['value'] = $sr['name'];
                    $arr['code'] = $sr['barcode'];
                    $json[] = $arr;
                }
            }
        }

        echo json_encode($json);
        break;
    case 1:
        $id = $_REQUEST["id"];
        $q = mysql_query("select * from warehouse_product where id=$id") or die(mysql_error());
        while ($r = mysql_fetch_array($q)) {
            $dbs = $r['store'];
            $dbu = $r['units'];
            if (strstr($dbs, ",") != "") {
                // Multiple
                $xs = explode(",", $dbs);
                $xu = explode(",", $dbu);
                $sq = mysql_query("select * from warehouse_store where id=$store");
                while ($sr = mysql_fetch_array($sq)) {
                    $store_txt = $sr['name'];
                }
                for ($i = 0; $i < count($xs); $i++) {
                    if ($xs[$i] == $store) {
                        ?>
                        <div class="alert alert-info">
                            <strong id="store_txt"><?php echo $store_txt; ?></strong>(<?php echo $xu[$i]; ?>)
                        </div>
                        <strong>Unidades:</strong><br/>
                        <input type="text" class="input-mini" id="existencia" name="existencia" value="1" />
                        <script>
                            $(document).ready(function() {
                                $('#existencia').spinner({max:<?php echo $xu[$i]; ?>, min: 1});
                            });
                        </script>
                        <?php
                    }
                }
            } else {
                // Unique
                if ($dbs != "0" && $dbu != '0' && $dbs!="") {
                    $sq = mysql_query("select * from warehouse_store where id=$dbs") or die(mysql_error());
                    while ($sr = mysql_fetch_array($sq)) {
                        ?>
                        <div class="alert alert-info">                            
                            <strong id="store_txt"><?php echo $sr['name']; ?></strong>(<?php echo $dbu; ?>)
                        </div>
                        <strong>Unidades:</strong><br/>
                        <input type="text" class="input-mini" id="existencia" name="existencia" value="1" />
                        <script>
                            $(document).ready(function() {
                                $('#existencia').spinner({max:<?php echo $dbu; ?>, min: 1});
                            });
                        </script>
                        <?php
                    }
                } else {
                    ?>
                    <div class="text-error">Sin existencias</div>
                    <?php
                }
            }
        }

        break;
}