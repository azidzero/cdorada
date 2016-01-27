<section id="actividad" class="activity-blog" style="margin-top:110px;">
    <?php
    $limit = 8;
    if (!isset($_REQUEST["page"])) {
        $page = 1;
    } else {
        $page = $_REQUEST["page"];
    }
    $offs = ($page - 1) * $limit;
    $cat = $_REQUEST["o"];
    $cat = str_replace("-", " ", $cat);
    $cq = mysqli_query($CNN, "SELECT * from web_info_cat WHERE name='$cat'");
    while ($cr = mysqli_fetch_array($cq)) {
        $catid = $cr["id"];
    }
    $catid = 1;
    ?>
    <div class="container-fluid">
        <h3>INFO.VIAJE - <?php echo $cat; ?></h3>
        <?php
        $olang = $lang;
        $q = mysqli_query($CNN, "SELECT * from web_info where cat='$catid' order by id DESC LIMIT 8") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            /*
             * TRANSLATE
             */
            $oq = mysqli_query($CNN, "SELECT * from web_info_translate WHERE uid='{$r['id']}' AND title!='' AND lang='$olang'") or $le = mysqli_error($CNN);
            $on = mysqli_num_rows($oq);
            if ($on == 0) {
                $olang = "es";
                $oq = mysqli_query($CNN, "SELECT * from web_info_translate WHERE uid='{$r['id']}' AND title!='' AND lang='$olang'") or $le = mysqli_error($CNN);
            }

            if (!isset($le)) {
                while ($or = mysqli_fetch_array($oq)) {
                    $ref = str_pad($r["id"], 6, "0", STR_PAD_LEFT);
                    $oid = "cms/content/info/item_" . $ref . "-" . $olang . ".jpg";
                    $title = str_replace(" ", "-", $or["title"]);
                    $url = "./$olang/informacion/articulo/$title" . "_" . $r["id"];
                    ?>
                    <div class="post">
                        <div class="post-background" style="background-image: url('<?php echo $oid; ?>');">
                            <a href="<?php echo $url; ?>"><?php echo $or["title"]; ?></a> 
                        </div>
                        <div class="post-body">
                            <p><?php echo $or["short_desc"]; ?></p>
                            <a href="<?php echo $url; ?>" class="btn btn-primary pull-right">Ver Actividad</a>
                            <small class="label label-warning"><i class="fa fa-tag"></i> <?php echo getData("web_info_category", "id", $or["category"], "name"); ?></small>

                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
</section>
