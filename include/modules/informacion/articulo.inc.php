<?php ?>
<section id="actividad" class="activity-blog" style="margin-top:110px;">
    <?php
    $o = str_replace("-", " ", $_REQUEST["o"]);
    $q = mysqli_query($CNN, "SELECT * from web_info WHERE title='$o' limit 1");
    while ($r = mysqli_fetch_array($q)) {
        $ref = str_pad($r["id"], 6, "0", STR_PAD_LEFT);
        $oid = "cms/content/info/item_" . $ref . ".jpg";
        ?>
        <header style="background-image: url('<?php echo $oid; ?>');">
            <div class="title">
                <h1><?php echo $r["title"]; ?><br/>
                    <small><?php echo $r["short_desc"]; ?></small>
                </h1>
            </div>
        </header>
        <div class="container">
            <?php echo $r["content"]; ?>
        </div>
        <?php
    }
    ?>
</section>
