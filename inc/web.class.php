<?php

class web {

    private $CNN;

    function __construct($CNN) {
        $this->CNN = $CNN;
    }

    function getFeatured() {
        $q = mysqli_query($this->CNN, "SELECT * from web_featured where status='1' order by fecha DESC,hora DESC") or die(mysqli_error());
        $no = mysqli_num_rows($q);
        ?>
        <div id="featured-home" class="carousel slide" style="background:#ECF0F1;">            
            <div class="carousel-inner">
                <?php
                $n = 1;
                while ($r = mysqli_fetch_array($q)) {
                    $array['ref'] = str_pad($r["id"], 6, "0", STR_PAD_LEFT);
                    $ref = "item_" . $array['ref'] . "-" . $_REQUEST["lang"] . ".jpg";
                    $lq = mysqli_query($this->CNN, "SELECT * from web_featured_translate WHERE uid='{$r['id']}' AND lang='{$_REQUEST["lang"]}'");
                    while ($lr = mysqli_fetch_array($lq)) {
                        $seed = rand(1, 9999);
                        if ($n == 1) {
                            echo "<div class=\"active item\" style=\"background-image: url('cms/content/featured/$ref?seed=$seed');\">";
                        } else {
                            echo "<div class=\"item\" style=\"background-image: url('cms/content/featured/$ref?seed=$seed');\">";
                        }
                        if ($lr["title"] != "") {
                            echo "<div class=\"carousel-caption\">";
                            echo "<h3>{$lr["title"]}</h3>";
                            echo "<p>{$lr["caption"]}</p>";
                            echo "</div>";
                        }
                    }
                    echo "</div>";
                    $n++;
                }
                ?>
            </div>
            <a class="left carousel-control" href="#featured-home" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#featured-home" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
    }

}
