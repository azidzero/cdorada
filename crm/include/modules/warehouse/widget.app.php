<!-- WIDGET CONTENT -->
<div class="panel-body">
    <?php
    $owner = $_SESSION["CORE"]["corp"]["id"];
    $q = mysql_query("SELECT * from warehouse_product where owner='$owner'");
    while ($r = mysql_fetch_array($q)) {
        $s = $r["store"];
        $u = $r["units"];
        $mi = $r["min"];
        $ma = $r["max"];
        $min = Array();
        $max = Array();
        $cad = Array();
        if (strstr($s, ",") != "") {
            // Multiple
            $sa = explode(",", $s);
            $ua = explode(",", $u);
            for ($i = 0; $i < count($ua); $i++) {
                if ($ua[$i] <= $mi) {
                    $min[] = Array($r["name"], $sa[$i], $mi - $ua[$i]);
                }
                if ($ua[$i] >= $ma) {
                    $max[] = Array($r["name"], $sa[$i], $ma - $ua[$i]);
                }
            }
        } else {
            // Unique
            if ($u <= $mi) {
                $min[] = Array($r["name"], $s, $u);
            }
            if ($u >= $ma) {
                $max[] = Array($r["name"], $s, $u);
            }
        }
    }
    ?>
    <table id="product_order" <?php echo TBLcss; ?>>
        <thead>
            <tr>
                <td width="33%"><div><strong><i class="fa fa-minus-square"></i> POR PEDIR</strong></div></td>
                <td width="33%"><div><strong><i class="fa fa-plus-square"></i> SOBRANTES</strong></div></td>
                <td width="34%"><div><strong><i class="fa fa-calendar"></i> POR CADUCAR.</strong></div></td>                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php
                    echo "<table class=\"table table-condensed table-bordered\">";
                    if (count($min) > 0) {
                        for ($i = 0; $i < count($min); $i++) {
                            if ($min[$i][0] != 0) {
                                $store = getData($min[$i][1], "warehouse_store", "name");
                            } else {
                                $store = "Ninguno";
                            }
                            echo "<tr><td>" . $min[$i][0] . "</td><td>" . $store . "</td><td><span class=\"label label-danger\">" . $min[$i][2] . "</span></td></tr>";
                        }
                    } else {
                        echo "<tr><td>NINGUNO</td></tr>";
                    }
                    echo "</table>";
                    ?>
                </td>
                <td>
                    <?php
                    echo "<table class=\"table table-condensed table-bordered\">";
                    if (count($max) > 0) {
                        for ($i = 0; $i < count($max); $i++) {
                            if ($max[$i][0] != 0) {
                                $store = getData($max[$i][1], "warehouse_store", "name");
                            } else {
                                $store = "Ninguno";
                            }
                            $store = getData($max[$i][1], "warehouse_store", "name");
                            echo "<tr><td>" . $max[$i][0] . "</td><td>" . $store . "</td><td><span class=\"label label-warning\">" . $max[$i][2] . "</span></td></tr>";
                        }
                    } else {
                        echo "<tr><td>NINGUNO</td></tr>";
                    }
                    echo "</table>";
                    ?>
                </td>            
                <td><?php
                    echo "<table class=\"table table-condensed\">";
                    if (count($cad) > 0) {
                        for ($i = 0; $i < count($cad); $i++) {
                            $store = getData($cad[$i][1], "warehouse_store", "name");
                            echo "<tr><td>" . $cad[$i][0] . "</td><td>" . $store . "</td><td>" . $cad[$i][2] . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td>NINGUNO</td></tr>";
                    }
                    echo "</table>";
                    ?>
                </td>            
            </tr>               
        </tbody>
    </table>
</div>