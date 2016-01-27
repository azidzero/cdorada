<?php ?>
<section class="activity-blog" style="margin-top:110px;">
    <div class="container-fluid">
        <?php
        $external = explode('_', $_REQUEST["o"]);
        $o = str_replace("-", " ", $external[0]);
        $id = $external[1];
        $olang = $lang;
        $q = mysqli_query($CNN, "SELECT * from web_activity_translate WHERE uid='$id' and lang='$olang' and title!=''  limit 1");
        $n = mysqli_num_rows($q);
        $langflag = true;
        if ($n == 0) {
            $olang = "es";
            $langflag = true;
            $q = mysqli_query($CNN, "SELECT * from web_activity_translate WHERE uid='$id' and lang='$olang' and title!=''  limit 1");
        }
        while ($r = mysqli_fetch_array($q)) {
            $ref = str_pad($r["uid"], 6, "0", STR_PAD_LEFT);
            $oid = "cms/content/activity/item_" . $ref . "-$olang.jpg";
            ?>
            <header style="background-image: url('<?php echo $oid; ?>');">                
                <?php
                if ($langflag == false) {
                    ?>
                    <div class="pull-right label label-danger">No Disponible</div>
                    <?php
                }
                ?>
                <div class="title">

                    <h1><?php echo $r["title"]; ?><br/>
                        <small><?php echo $r["short_desc"]; ?></small>
                    </h1>
                </div>
            </header>
            <div class="row-fluid">
                <?php
                echo "<div class=\"col-sm-12\">" . stripslashes($r["content"]) . "</div>";

                $q = mysqli_query($CNN, "SELECT * from web_activity_gallery WHERE aid='$id' ORDER BY web_activity_gallery.orden ASC") or die(mysqli_error($CNN));
                $nid = mysqli_num_rows($q);
                $p = 0;
                $numsrc = array();
                while ($r = mysqli_fetch_array($q)) {
                    $ord = $r['order'];
                    $numsrc[$p] = "cms/content/upload/activity/" . $r['name'] . "_m.jpg";
                    $p++;
                }
                ?>
            </div>

            <div class="row-fluid">
                <div class="col-sm-12">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="background:#333;">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php for ($x = 0; $x < $nid; $x++) {
                                ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $x; ?>" <?php if ($x == 0) { ?> class="active" <?php } ?>></li>
                            <?php }
                            ?>
                        </ol>       
                        <center>
                            <div class="carousel-inner" role="listbox">
                                <?php
                                for ($y = 0; $y < $nid; $y++) {
                                    if ($y <= 0) {
                                        ?>
                                        <div class="item active">
                                            <img src="<?php echo $numsrc[$y]; ?>" alt="." />
                                            <!-- <div class="carousel-caption">
                                            carrusel
                                            </div>-->
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="item" id="img1" name="img1">
                                            <img src="<?php echo $numsrc[$y]; ?>" alt="..."   />
                                            <!-- <div class="carousel-caption">
                                                 <button onclick="alert('hola');" class="btn btn-success">Borrar</button>
                                             </div>-->
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </center>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
