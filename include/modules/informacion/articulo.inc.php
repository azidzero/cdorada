<?php ?>
<section id="actividad" class="activity-blog" style="margin-top:110px;">
    <?php
    $external = explode('_', $_REQUEST["o"]);
    $o = str_replace("-", " ", $external[0]);
    $id = $external[1];
    $olang = $lang;
    $q = mysqli_query($CNN, "SELECT * from web_info_translate WHERE uid='$id' and lang='$olang' and title!='' limit 1");
    $n = mysqli_num_rows($q);    
    if($n==0){
        $olang = "es";
        $q = mysqli_query($CNN, "SELECT * from web_info_translate WHERE uid='$id' and lang='$olang' and title!='' limit 1");
    }
    while ($r = mysqli_fetch_array($q)) {
        $ref = str_pad($r["uid"], 6, "0", STR_PAD_LEFT);
        $oid = "cms/content/info/item_" . $ref . "-$olang.jpg";
        ?>
        <header style="background-image: url('<?php echo $oid; ?>');">
            <div class="title">
                <h1><?php echo $r["title"]; ?><br/>
                    <small><?php echo $r["short_desc"]; ?></small>
                </h1>
            </div>
        </header>
        <div class="container">
            <?php echo stripslashes($r["content"]); ?>
        </div>
        <?php
    }
    ?>
</section>
