<?php
include("../../../inc/app.conf.php");

if (!isset($_REQUEST["month"])) {
    $M = date("m");
} else {
    $M = $_REQUEST["month"];
}
if (!isset($_REQUEST["year"])) {
    $Y = date("Y");
} else {
    $Y = $_REQUEST["year"];
}
$date = explode("-", date("Y-m-d", mktime(0, 0, 0, $M, 1, $Y)));
$t = date("t", mktime(0, 0, 0, $date[1], $date[2], $date[0]));
$tw = ($t) * 24;
?>
<div class="gantt-header">
    <div class="gantt-row" style="width:<?php echo $tw; ?>px">
        <div class="input-group">
            <span class="input-group-addon">MES:</span>
            <select id="mes" name="mes" class="form-control">
                <?php
                for ($i = 1; $i < 13; $i++) {
                    ?>
                    <option <?php
                    if ($i == $M) {
                        echo "selected=\"selected\"";
                    }
                    ?> value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
                        <?php
                    }
                    ?>
            </select>
            <span class="input-group-addon">A&Ntilde;O:</span>
            <select id="year" name="year" class="form-control">
                <?php
                for ($xx = 2015; $xx < 2025; $xx++) {
                    ?>
                    <option <?php
                    if ($Y == $xx) {
                        echo "selected=\"selected\"";
                    }
                    ?> value="<?php echo $xx; ?>"><?php echo $xx; ?></option>
                        <?php
                    }
                    ?>
            </select>
            <span class="input-group-btn">
                <a href="javascript:void(0)" onclick="updateGrid()" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
            </span>
        </div>
    </div>
    <div class="gantt-row" style="width:<?php echo $tw - 24; ?>px;text-align:center;font-weight:900;">
        <?php
        for ($i = 1; $i < $t + 1; $i++) {
            ?>
            <div class="gantt-col"><?php echo $i; ?></div><!-- grid -->
            <?php
        }
        ?>
    </div><!-- Line -->
</div><!-- header -->
<div class="gantt-container">
    <?php
    $q = mysqli_query($CNN, "SELECT * from cms_property");
    while ($r = mysqli_fetch_array($q)) {
        ?>
        <div data-property="<?php echo $r["id"]; ?>" class="gantt-row" style="width:<?php echo $tw - 24; ?>px">
            <?php
            for ($i = 1; $i < $t + 1; $i++) {
                $w = date("w", mktime(0, 0, 0, $date[1], $i, $date[0]));
                $ndate = date("Y-m-d", mktime(0, 0, 0, $date[1], $i, $date[0]));
                if ($w != "0" && $w != "6") {
                    ?>
                    <div data-property="<?php echo $r["id"]; ?>" data-date="<?php echo $ndate; ?>" class="gantt-col">&nbsp;</div><!-- grid -->
                    <?php
                } else {
                    ?>
                    <div data-property="<?php echo $r["id"]; ?>" data-date="<?php echo $ndate; ?>" class="gantt-col weekend">&nbsp;</div><!-- grid -->
                    <?php
                }
            }
            ?>
        </div><!-- Line -->
        <?php
    }
    ?>
</div>