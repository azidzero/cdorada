<section id="deal">
    <div class="container">
        <h4 class="text-danger"><i class="fa fa-calendar-o"></i><?php echo $wlang->getString("deal","title");?></h4>
        <div class="slick">
            <?php
            $sq = mysqli_query($CNN, "SELECT * from cms_property_deal");
            $no = 0;
            while ($sr = mysqli_fetch_array($sq)) {
                ?>
                <div class="container-fluid">
                    <?php
                    $pid = $sr["pid"];
                    $nprize = $sr["new_prize"];
                    $q = mysqli_query($CNN, "SELECT * from cms_property WHERE id=$pid") or die(mysqli_error($sq));
                    while ($r = mysqli_fetch_array($q)) {
                        $rid = str_pad($r["id"], 8, "0", STR_PAD_LEFT);
                        ?>
                        <div>
                            <div class="row-fluid">
                                <div class="col-sm-6">
                                    <h3 class="pull-right" style="color:#F60;">
                                        <i class="fa fa-eur"></i> <?php echo number_format($r["prize"], 2); ?>                                    
                                    </h3>
                                    <h4><i class="fa fa-home"></i> <?php echo getData("cms_property_type", "id", $r["tipo"], "name"); ?><br/><small>en <?php echo getData("cms_property_locale", "id", $r["location"], "name"); ?></small></h4>
                                    <div id="carousel-<?php echo $rid; ?>" class="carousel slide" data-ride="carousel-<?php echo $rid; ?>" style="border:1px solid #CCC;">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <?php
                                            $noq = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                                            $num = mysqli_num_rows($noq);
                                            for ($j = 1; $j < $num + 1; $j++) {
                                                ?>
                                                <li data-target="#carousel-<?php echo $rid; ?>" data-slide-to="<?php echo $j - 1; ?>" class="<?php
                                                if ($j == 1) {
                                                    echo "active";
                                                }
                                                ?>">
                                                </li>
                                                <?php
                                            }
                                            ?>                                            
                                        </ol>
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            <?php
                                            $j = 1;
                                            while ($or = mysqli_fetch_array($noq)) {
                                                $ref = $or["name"] . "_m.jpg";
                                                ?>
                                                <div class="<?php
                                                if ($j == 1) {
                                                    echo 'active';
                                                }
                                                ?> item" style="background-image: url('cms/content/upload/property/<?php echo $ref; ?>');background-position:bottom;"></div>
                                                     <?php
                                                     $j++;
                                                 }
                                                 ?>
                                        </div>
                                        <!-- Controls -->
                                        <a style="color:#000;" class="left carousel-control" href="#carousel-<?php echo $rid; ?>" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a style="color:#000;" class="right carousel-control" href="#carousel-<?php echo $rid; ?>" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <table style="width:100%;color:#039;font-size: 9pt;" class="table table-condensed">
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <span class="label label-primary pull-right"><?php echo $r[0];?></span>
                                                    <b><?php echo $r["title"]; ?></b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><img src="images/home_bed.png" data-toggle="tooltip" title="" data-original-title="Dormitorio(s)"><?php echo $wlang->getString("deal","label-bedroom");?>: <strong><?php echo $r['room'];?></strong></td>
                                                <td><img src="images/home_users.png" data-toggle="tooltip" title="" data-original-title="Persona(s)"><?php echo $wlang->getString("deal","label-capacity");?>: <strong><?php echo $r['capacity'];?></strong></sup></td>
                                                <td><img src="images/home_bath.png" data-toggle="tooltip" title="" data-original-title="Baño(s)"><?php echo $wlang->getString("deal","label-bathroom");?>: <strong><?php echo $r['bathroom'];?></strong></sup></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="container-fluid">
                                        <div class="row-fluid" style="font-family: 'Raleway',sans-serif;font-size:9pt;">
                                            <?php
                                            $oq = mysqli_query($CNN, "SELECT * from cms_property_e_general WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                                            while ($or = mysqli_fetch_array($oq)) {
                                                ?>
                                                <div class="col-xs-6 col-sm-4 col-md-3">
                                                    <?php
                                                    echo "<strong>" . getData("cms_property_general", "id", $or["oid"], "name") . "</strong>:<br/>" . $or["ovalue"];
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <h4><?php echo $wlang->getString("deal","calendar-title");?></h4>
                                    <div class="row" style="font-size:8pt;margin:0px;">
                                        <?php
                                        $y = 2015;
                                        $mo = date("m");
                                        for ($i = $mo; $i < $mo + 6; $i++) {
                                            $w = date("w", mktime(0, 0, 0, $i, 1, $y));
                                            $t = date("t", mktime(0, 0, 0, $i, 1, $y));
                                            ?>
                                            <div class="col-sm-4">
                                                <div class="web-calendar">
                                                    <div class="web-calendar-h">
                                                        <h4><?php echo date("M", mktime(0, 0, 0, $i, 1, 2015)); ?></h4>
                                                    </div>
                                                    <div class="web-calendar-b">
                                                        <table width="100%">
                                                            <thead style="text-align:center;background-color:#039;color:#FFF;">
                                                                <tr>
                                                                    <td width="16">D</td>
                                                                    <td width="16">L</td>
                                                                    <td width="16">M</td>
                                                                    <td width="16">I</td>
                                                                    <td width="16">J</td>
                                                                    <td width="16">V</td>
                                                                    <td width="16">S</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <?php
                                                                    for ($j = 0; $j < $w; $j++) {
                                                                        echo '<td class="disabled">&nbsp;</td>';
                                                                    }
                                                                    for ($j = 1; $j < $t + 1; $j++) {
                                                                        $wo = date("w", mktime(0, 0, 0, $i, $j, $y));
                                                                        $date = date("Y-m-d", mktime(0, 0, 0, $i, $j, $y));
                                                                        if ($wo == 0) {
                                                                            echo "</tr><tr>";
                                                                        }
                                                                        echo "<td>$j</td>";
                                                                    }
                                                                    for ($k = $wo + 1; $k < 7; $k++) {
                                                                        echo '<td class="disabled">&nbsp;</td>';
                                                                    }
                                                                    ?>                                                                                        
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if ($i == $mo + 2) {
                                                echo "</div><div class=\"row\">";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $n++;
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="well well-sm">
            <a href="#" class="btn btn-warning"><?php echo $wlang->getString("deal","button-all");?></a>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('.slick').slick({
            adaptiveHeight: true
        });
    });
</script>