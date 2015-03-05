<?php
session_start();
$uid = $_SESSION["CORE"]["uid"];
$msconf = "../../content/app.conf.php";
if (file_exists($msconf)) {
    include($msconf);
} else {
    die("No se puede cargar la configuracion");
}
$pid = $_REQUEST["pid"];
if (!isset($_REQUEST["oid"])) {
    $sq = mysql_query("select * from warehouse_product where pro_id='$pid'");
    $sn = mysql_num_rows($sq);
    if ($sn > 0) {
        ?>
        <table <?php echo TBLcss; ?>>
            <thead>
                <tr>
                    <td width="1">&nbsp;</td>
                    <td>C&Oacute;DIGO</td>
                    <td>PRODUCTO</td>
                    <td>CANTIDAD</td>
                    <td>PRECIO</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($sr = mysql_fetch_array($sq)) {
                    ?>
                    <tr>
                        <td><input onclick="chStatus(this)" type="checkbox" name="pro_<?php echo $sr[0]; ?>"  id="pro_<?php echo $sr[0]; ?>" value="1" /></td>
                        <td><?php echo $sr['code']; ?></td>
                        <td><?php echo $sr['name']; ?></td>
                        <td><input class="input-mini" disabled="disabled" type="text" name="cant_<?php echo $sr[0]; ?>" id="cant_<?php echo $sr[0]; ?>" placeholder="0" /></td>
                        <td><input class="input-mini" disabled="disabled" type="text" name="prize_<?php echo $sr[0]; ?>" id="prize_<?php echo $sr[0]; ?>" placeholder="0" /></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <div class="alert alert-warning">No hay productos que se pidan a este proveedor.</div>
        <?php
    }
} else {
    $sq = mysql_query("select * from buy_order_detail where order_id='{$_REQUEST["oid"]}'");
    while ($sr = mysql_fetch_array($sq)) {
        $pid[$sr['pid']] = true;
        $amo[$sr['pid']] = $sr['amount'];
        $pri[$sr['pid']] = $sr['prize'];
    }
    $sq = mysql_query("select * from warehouse_product where pro_id='$pid'");
    $sn = mysql_num_rows($sq);
    if ($sn > 0) {
        ?>
        <strong>Actualizacion de productos</strong>
        <table <?php echo TBLcss; ?>>
            <thead>
                <tr>
                    <td width="1">&nbsp;</td>
                    <td>C&Oacute;DIGO</td>
                    <td>PRODUCTO</td>
                    <td>CANTIDAD</td>
                    <td>PRECIO</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($sr = mysql_fetch_array($sq)) {
                    ?>
                    <tr>
                        <td><input <?php
            if ($pid[$sr[0]] == true) {
                echo "checked=\"checked\"";
            }else{
                echo $pid[$sr[0]];
            }
                    ?> onclick="chStatus(this)" type="checkbox" name="pro_<?php echo $sr[0]; ?>"  id="pro_<?php echo $sr[0]; ?>" value="1" /></td>
                        <td><?php echo $sr['code']; ?></td>
                        <td><?php echo $sr['name']; ?></td>
                        <td><input <?php
                    if ($pid[$sr[0]] == true) {
                        echo "value=\"{$amo[$sr[0]]}\"";
                    }
                    ?> class="input-mini" <?php if($pid[$sr[0]]!=true){ echo "disabled=\"disabled\"";}?> type="text" name="cant_<?php echo $sr[0]; ?>" id="cant_<?php echo $sr[0]; ?>" placeholder="0" /></td>
                        <td><input <?php
                    if ($pid[$sr[0]] == true) {
                        echo "value=\"{$pri[$sr[0]]}\"";
                    }
                    ?>  class="input-mini" <?php if($pid[$sr[0]]!=true){ echo "disabled=\"disabled\"";}?> type="text" name="prize_<?php echo $sr[0]; ?>" id="prize_<?php echo $sr[0]; ?>" placeholder="0" /></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <div class="alert alert-warning">No hay productos que se pidan a este proveedor.</div>
        <?php
    }
}
?>
