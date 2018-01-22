<section id="content" class="blog" style="background-image:none">    
    <div class="container-fluid">
        <h3>ACTIVIDADES</h3>
        <?php
        $olang = $lang;
        $q = mysqli_query($CNN, "SELECT * from web_activity order by id DESC limit 8") or die(mysqli_error($CNN));        
        while ($r = mysqli_fetch_array($q)) {
            /*
             * TRANSLATE
             */
            $oq = mysqli_query($CNN, "SELECT * from web_activity_translate WHERE uid='{$r['id']}' AND title!='' AND lang='$olang'") or $le = mysqli_error($CNN);
            $on = mysqli_num_rows($oq);
            if($n==0){
                $olang = "es";
                $oq = mysqli_query($CNN, "SELECT * from web_activity_translate WHERE uid='{$r['id']}' AND title!='' AND lang='$olang'") or $le = mysqli_error($CNN);
            }
            if (!isset($le)) {
                while ($or = mysqli_fetch_array($oq)) {
                    $ref = str_pad($r["id"], 6, "0", STR_PAD_LEFT);
                    $oid = "cms/content/activity/item_" . $ref . "-" . $olang . ".jpg";
                    $title = str_replace(" ", "-", $or["title"]);
                    $url = "./$olang/actividades/actividad/$title" . "_" . $r["id"];
                    ?>
                    <div class="post">
                        <div class="post-background" style="background-image: url('<?php echo $oid; ?>');">
                            <a href="<?php echo $url;?>"><?php echo $or["title"]; ?></a> 
                        </div>
                        <div class="post-body">
                            <p><?php echo $or["short_desc"]; ?></p>
                            <a href="<?php echo $url;?>" class="btn btn-primary pull-right">Ver Actividad</a>
                            <small class="label label-warning"><i class="fa fa-tag"></i> <?php echo getData("web_activity_category", "id", $or["category"], "name"); ?></small>

                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
    <div class="well well-sm">
        <a class="btn btn-warning" href="<?php echo $olang; ?>/actividades/">Ver Todas las Actividades</a>
    </div>
</section>