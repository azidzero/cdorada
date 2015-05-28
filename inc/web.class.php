<?php

class web {

    private $CNN;

    function __construct($CNN) {
        $this->CNN = $CNN;
    }

    function getFeatured() {
        ?>
        <div id="featured-home" class="carousel slide">
            <div class="carousel-inner">
                <?php
                $q = mysqli_query($this->CNN, "SELECT * from web_featured where status='1'") or die(mysqli_error());
                $n = 1;
                while ($r = mysqli_fetch_array($q)) {
                    $array['ref'] = str_pad($r["id"], 8, "0", STR_PAD_LEFT);
                    $ref = "featured-" . $array['ref'] . ".jpg";
                    if ($n == 1) {
                        echo "<div class=\"active item\" style=\"background-image: url('cms/content/featured/$ref');\">";
                    } else {
                        echo "<div class=\"active item\" style=\"background-image: url('cms/content/featured/$ref');\">";
                    }
                    echo "<div class=\"carousel-caption\">";
                    echo "<h3>{$r["title"]}</h3>";
                    echo "<p>{$r["caption"]}</p>";
                    echo "</div>";
                    echo "</div>";
                    $n++;
                }
                ?>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
    }

}
