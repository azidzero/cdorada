<section id="deal">
    <div class="container">
        <h4 class="text-danger"><i class="fa fa-calendar-o"></i> <?php echo $wlang->getString("deal", "title"); ?></h4>
        <div class="slick">
            <?php
            $today = date("Y-m-d");
            $sq = mysqli_query($CNN, "SELECT cms_property_deal.*,cms_property_deal_e_property.pid FROM cms_property_deal,cms_property_deal_e_property WHERE '$today' BETWEEN date_ini AND date_end AND cms_property_deal.id=cms_property_deal_e_property.idof;") or die(mysqli_error($CNN));
            $no = 0;
            while ($sr = mysqli_fetch_array($sq)) {
                ?>
                <div class="container">
                    <?php
                    $pid = $sr["pid"];
                    $nprize = $sr["cant"];
                    $q = mysqli_query($CNN, "SELECT * from cms_property WHERE id=$pid") or die(mysqli_error($sq));
                    while ($r = mysqli_fetch_array($q)) {
                        $rid = str_pad($r["id"], 8, "0", STR_PAD_LEFT);
                        ?>
                        <div>
                            <div class="row">
                                <div class="col-sm-4" style="padding:8px;">                                    
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
                                <div class="col-sm-8">
                                    <div>
                                        <div class="pull-right" style="background-color:#F60;color:#FFF;font-family: 'Open Sans',sans-serif;font-size: 24pt;padding:4px;">
                                            <small><sup><i class="fa fa-eur"></i></sup></small> 
        <?php echo number_format($r["prize"], 2); ?>
                                        </div>
                                        <h4><?php echo $r["title"]; ?> <small><i class="fa fa-building"></i> <u><?php echo getData("cms_property_type", "id", $r["tipo"], "name"); ?></u>
                                                en <i class="fa fa-map-marker"></i> <u><?php echo getData("cms_property_locale", "id", $r["location"], "name"); ?></u></small>
                                        </h4>
                                    </div>
                                    <table class="table table-condensed" style="text-transform: uppercase;font-family: 'Raleway';font-size: 9pt;">
                                        <tr>
                                            <td width='1'><img src="images/home_bed.png" /></td>
                                            <td><?php echo $wlang->getString("deal", "label-bedroom"); ?></td>
                                            <td><strong><?php echo $r['room']; ?></strong></td>
                                            <td width='1'><img src="images/home_users.png" /></td>
                                            <td><?php echo $wlang->getString("deal", "label-capacity"); ?></td>
                                            <td><strong><?php echo $r['capacity']; ?></strong></td>
                                            <td width='1'><img src="images/home_bath.png" /></td>
                                            <td><?php echo $wlang->getString("deal", "label-bathroom"); ?></td>
                                            <td><strong><?php echo $r['bathroom']; ?></strong></td>
                                        </tr>
                                    </table>                                     
                                    <b style="font-size:11pt;" class="text-danger">Caracter&iacute;sticas</b>
                                    <div style="font-family: 'Raleway',sans-serif;font-size:8pt;background:#EEE;border-top:1px solid #DDD;">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#general-<?php echo $r['id']; ?>" aria-controls="general-<?php echo $r['id']; ?>" role="tab" data-toggle="tab">Generales</a></li>
                                            <li role="presentation"><a href="#interior-<?php echo $r['id']; ?>" aria-controls="interior-<?php echo $r['id']; ?>" role="tab" data-toggle="tab">Interior</a></li>
                                            <li role="presentation"><a href="#exterior-<?php echo $r['id']; ?>" aria-controls="exterior-<?php echo $r['id']; ?>" role="tab" data-toggle="tab">Exterior</a></li>
                                            <li role="presentation"><a href="#equipment-<?php echo $r['id']; ?>" aria-controls="equipment-<?php echo $r['id']; ?>" role="tab" data-toggle="tab">Equipamiento</a></li>
                                            <li role="presentation"><a href="#extra-<?php echo $r['id']; ?>" aria-controls="extra-<?php echo $r['id']; ?>" role="tab" data-toggle="tab">Extras</a></li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="general-<?php echo $r['id']; ?>">
                                                <table class="table table-condensed">
                                                    <tr>
                                                        <?php
                                                        $oq = mysqli_query($CNN, "SELECT * from cms_property_e_general WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                                                        $xr = 0;
                                                        while ($or = mysqli_fetch_array($oq)) {
                                                            if ($or["ovalue"] == "1") {
                                                                ?>
                                                                <td style="text-transform: uppercase;padding:4px;">
                                                                    <?php
                                                                    echo "<i class=\"text-success fa fa-check-circle\"></i> <strong>" . getData("cms_property_general", "id", $or["oid"], "name") . "</strong>";
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            }

                                                            if ($xr == 3) {
                                                                $xr = 0;
                                                                echo "</tr><tr>";
                                                            } else {
                                                                $xr++;
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div role="tabpanel" class="tab-panel" id="interior-<?php echo $r['id']; ?>">
                                                <table class="table table-condensed">
                                                    <tr>
                                                        <?php
                                                        $oq = mysqli_query($CNN, "SELECT * from cms_property_e_interior WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                                                        $xr = 0;
                                                        while ($or = mysqli_fetch_array($oq)) {
                                                            if ($or["ovalue"] == "1") {
                                                                ?>
                                                                <td style="text-transform: uppercase;padding:4px;">
                                                                    <?php
                                                                    echo "<i class=\"text-success fa fa-check-circle\"></i> <strong>" . getData("cms_property_general", "id", $or["oid"], "name") . "</strong>";
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            }

                                                            if ($xr == 3) {
                                                                $xr = 0;
                                                                echo "</tr><tr>";
                                                            } else {
                                                                $xr++;
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div role="tabpanel" class="tab-panel" id="exterior-<?php echo $r['id']; ?>">
                                                <table class="table table-condensed">
                                                    <tr>
                                                        <?php
                                                        $oq = mysqli_query($CNN, "SELECT * from cms_property_e_exterior WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                                                        $xr = 0;
                                                        while ($or = mysqli_fetch_array($oq)) {
                                                            if ($or["ovalue"] == "1") {
                                                                ?>
                                                                <td style="text-transform: uppercase;padding:4px;">
                                                                    <?php
                                                                    echo "<i class=\"text-success fa fa-check-circle\"></i> <strong>" . getData("cms_property_general", "id", $or["oid"], "name") . "</strong>";
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            }

                                                            if ($xr == 3) {
                                                                $xr = 0;
                                                                echo "</tr><tr>";
                                                            } else {
                                                                $xr++;
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div role="tabpanel" class="tab-panel" id="equipment-<?php echo $r['id']; ?>">
                                                <table class="table table-condensed">
                                                    <tr>
                                                        <?php
                                                        $oq = mysqli_query($CNN, "SELECT * from cms_property_e_equip WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                                                        $xr = 0;
                                                        while ($or = mysqli_fetch_array($oq)) {
                                                            if ($or["ovalue"] == "1") {
                                                                ?>
                                                                <td style="text-transform: uppercase;padding:4px;">
                                                                    <?php
                                                                    echo "<i class=\"text-success fa fa-check-circle\"></i> <strong>" . getData("cms_property_general", "id", $or["oid"], "name") . "</strong>";
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            }

                                                            if ($xr == 3) {
                                                                $xr = 0;
                                                                echo "</tr><tr>";
                                                            } else {
                                                                $xr++;
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div role="tabpanel" class="tab-panel" id="extra-<?php echo $r['id']; ?>">
                                                <table class="table table-condensed">
                                                    <tr>
                                                        <?php
                                                        $oq = mysqli_query($CNN, "SELECT * from cms_property_e_extra WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                                                        $xr = 0;
                                                        while ($or = mysqli_fetch_array($oq)) {
                                                            if ($or["ovalue"] == "1") {
                                                                ?>
                                                                <td style="text-transform: uppercase;padding:4px;">
                                                                    <?php
                                                                    echo "<i class=\"text-success fa fa-check-circle\"></i> <strong>" . getData("cms_property_general", "id", $or["oid"], "name") . "</strong>";
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            }

                                                            if ($xr == 3) {
                                                                $xr = 0;
                                                                echo "</tr><tr>";
                                                            } else {
                                                                $xr++;
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <h4><?php echo $wlang->getString("deal", "calendar-title"); ?></h4>
                                    <div class="row-fluid" style="font-size:8pt;margin:0px;">
                                        <?php
                                        $y = 2015;
                                        $mo = date("m");
                                        for ($i = $mo; $i < $mo + 8; $i++) {
                                            $w = date("w", mktime(0, 0, 0, $i, 1, $y));
                                            $t = date("t", mktime(0, 0, 0, $i, 1, $y));
                                            ?>
                                            <div class="col-sm-3">
                                                <div class="web-calendar">
                                                    <div class="web-calendar-h"><h4><?php echo date("M", mktime(0, 0, 0, $i, 1, 2015)); ?></h4></div>
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
                                            if ($i == $mo + 3) {
                                                echo "</div><div class=\"row-fluid\">";
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
            <div class="well well-sm">
                <a href="./<?php echo $lang; ?>/deal" class="btn btn-warning"><?php echo $wlang->getString("deal", "button-all"); ?></a>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        /*$('.slick').slick({
         adaptiveHeight: true
         });*/
    });
</script>