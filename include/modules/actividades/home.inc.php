<section id="actividad" class="blog" style="margin-top:130px;">    
    <div class="container">
        <h3>Actividades</h3>
        <div class="row">
            <div class="col-sm-9">
                <?php
                $q = mysqli_query($CNN, "SELECT * from web_activity order by id DESC limit 12") or die(mysqli_error($CNN));
                ?>
                <div class="container">

                    <?php
                    while ($r = mysqli_fetch_array($q)) {
                        $ref = str_pad($r["id"], 6, "0", STR_PAD_LEFT);
                        $oid = "cms/content/activity/item_" . $ref . ".jpg";
                        $title = str_replace(" ", "-", $r["title"]);
                        ?>
                        <div class="col-sm-4" style="background-image:url('<?php echo $oid; ?>');background-size:cover;min-height:196px;">
                            <h4><?php echo $r["title"]; ?></h4>
                            <p><?php echo $r["short_desc"]; ?></p>
                            <a class="btn btn-warning" href='./<?php echo $lang; ?>/actividades/actividad/<?php echo $title; ?>'>M&aacute;s informaci&oacute;n</a>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div class="col-sm-3">

            </div>
        </div>
    </div>
</section>