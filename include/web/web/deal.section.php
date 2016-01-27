<section id="deal">
    <h4 class="text-danger" style="font-weight: 300;text-transform: uppercase;">
        <i class="fa fa-calendar-o"></i> <?php echo $wlang->getString("deal", "title"); ?>
    </h4>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php
            $today = date("Y-m-d");
            $dsql = "SELECT crs_offer_use.pid, crs_offer_use.featured, crs_offer.* FROM crs_offer_use, crs_offer WHERE crs_offer.id=crs_offer_use.idof AND crs_offer_use.featured='1' AND NOW() BETWEEN crs_offer.show_ini AND crs_offer.show_end;";
            $sq = mysqli_query($CNN, $dsql) or die(mysqli_error($CNN));
            $no = 0;
            while ($sr = mysqli_fetch_array($sq)) {
                /*
                 * Imagen Cover, primera en la galeria
                 */
                $gq = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='{$sr["pid"]}' ORDER BY orden ASC LIMIT 1");
                $gn = mysqli_num_rows($gq);
                if ($gn > 0) {
                    while ($gr = mysqli_fetch_array($gq)) {
                        $cover = "cms/content/upload/property/" . $gr["name"] . "_m.jpg";
                    }
                } else {
                    $cover = "images/s_rent.jpg";
                }
                ?>
                <div class="col-sm-4" data-deal="<?php echo $sr["crs_offer_use.id"]; ?>">
                    <div class="deal" style="background-image:url('<?php echo $cover; ?>');">
                        <div class="ribbon"><span>OFERTA</span></div>
                        <?php
                        $pid = $sr["id"];
                        $nprize = $sr["cant"];
                        $q = mysqli_query($CNN, "SELECT * from cms_property WHERE id='{$sr["pid"]}'") or die(mysqli_error($sq));
                        while ($r = mysqli_fetch_array($q)) {
                            $rid = str_pad($r["id"], 8, "0", STR_PAD_LEFT);
                            ?>
                            <div class="well well-sm">                                    
                                <div class="pull-right" style="font-size: 24pt;padding:4px;margin-top:16px;">
                                    <?php
                                    if ($sr['tipo'] == '0') {
                                        ?>
                                        <small><sup><i class="fa fa-eur"></i></sup></small> 
                                        <?php echo number_format($sr["cant"], 2); ?>
                                        <?php
                                    } else {
                                        ?>                                        
                                        <?php echo number_format($sr["cant"], 2); ?>
                                        <small><sup>%</sup></small> 
                                        <?php
                                    }
                                    ?>
                                </div>
                                <h4 style="width: 100%;white-space: nowrap"><?php echo $r["title"]; ?><br/>
                                    <small>
                                        <i class="fa fa-building"></i> <?php echo getData("cms_property_type", "id", $r["tipo"], "name"); ?>
                                        en <i class="fa fa-map-marker"></i> <?php echo getData("cms_property_locale", "id", $r["location"], "name"); ?>
                                    </small>
                                </h4>
                            </div>
                            <table class="table table-condensed" style="text-transform: uppercase;font-size:9pt;background:rgba(255,255,255,0.8);">
                                <tr>
                                    <td width="1">
                                        <img src="images/home_bed.png" /><br/>
                                        <?php echo $wlang->getString("deal", "label-bedroom"); ?>
                                        <span class="label label-success"><?php echo $r['room']; ?></span>
                                    </td>                                   
                                    <td width='1'>
                                        <img src="images/home_users.png" /><br/>
                                        <?php echo $wlang->getString("deal", "label-capacity"); ?>
                                        <span class="label label-success"><?php echo $r['capacity']; ?></span>
                                    </td>
                                    <td width='1'>
                                        <img src="images/home_bath.png" /><br/>
                                        <?php echo $wlang->getString("deal", "label-bathroom"); ?>                                        
                                        <span class="label label-success"><?php echo $r['bathroom']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <a href="javascript:void(0)" class="btn btn-primary pull-right">Aprovechar oferta</a>
                                    </td>
                                </tr>
                            </table>                                
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div style="margin-top:16px;">
        <div class="row">
            <div class="col-sm-6">
                <img src="images/unicef_banner.png" class="img-thumbnail" />                    
            </div>
            <div class="col-sm-3">
                <img data-src="holder.js/100%x200/lava" class="img-thumbnail" />
            </div>
            <div class="col-sm-3">
                <img src="images/owner_banner_es.png" class="img-thumbnail" />
            </div>
        </div>
    </div>    
</section>
<script>
    $(document).ready(function () {
        $('.slick').slick({
            infintite: true

        });
    });
</script>