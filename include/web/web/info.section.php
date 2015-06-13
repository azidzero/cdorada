<section id="info" style="background-image:url('images/area-owner.jpg')">
    <div class="container">
        <h3>INFORMACION DE VIAJE</h3>
        <div class="row blog-info">
            <?php
            $i = 0;
            $q = mysqli_query($CNN, "SELECT * from web_info order by id DESC limit 8") or die(mysqli_error($CNN));
            while ($r = mysqli_fetch_array($q)) {
                $ref = str_pad($r["id"], 6, "0", STR_PAD_LEFT);
                $oid = "cms/content/info/item_" . $ref . ".jpg";
                $title = str_replace(" ", "-", $r["title"]);
                ?>

                <div class=" info-item" style="background-image: url('<?php echo $oid; ?>');">                  
                    <small class="label">
                        <i class="fa fa-tag"></i> <?php echo getData("web_activity_category", "id", $r["category"], "name"); ?>
                    </small>
                    <a href="./<?php echo $lang; ?>/informacion/articulo/<?php echo $title; ?>">
                        <h4><?php echo $r["title"]; ?></h4>
                    </a>
                </div>

                <?php
                $i++;
                if ($i > 0 && $i % 2 == 0) {
                    echo "</div><div class=\"row blog-info\">";
                }
            }
            ?>
        </div>
    </div>
</section>