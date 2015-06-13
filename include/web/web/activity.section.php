<section id="content" class="blog" style="background-image:none">    
    <div class="container-fluid">
        <h3>ACTIVIDADES</h3>
        <?php
        $q = mysqli_query($CNN, "SELECT * from web_activity order by id DESC limit 8") or die(mysqli_error($CNN));

        while ($r = mysqli_fetch_array($q)) {

            $ref = str_pad($r["id"], 6, "0", STR_PAD_LEFT);
            $oid = "cms/content/activity/item_" . $ref . ".jpg";
            $title = str_replace(" ", "-", $r["title"]);
            ?>
            <div class="post">
                <div class="post-background" style="background-image: url('<?php echo $oid; ?>');">
                    <a href="./<?php echo $lang; ?>/actividades/actividad/<?php echo $title; ?>"><?php echo $r["title"]; ?></a> 
                </div>
                <div class="post-body">
                    <p><?php echo $r["short_desc"];?></p>
                    <button class="btn btn-primary pull-right">Ver Actividad</button>
                    <small class="label label-warning"><i class="fa fa-tag"></i> <?php echo getData("web_activity_category", "id", $r["category"], "name"); ?></small>
                    
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="well well-sm">
        <a class="btn btn-warning" href="<?php echo $lang; ?>/actividades/">Ver Todas las Actividades</a>
    </div>
</section>