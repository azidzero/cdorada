<section id="buscar" style="margin-top:120px;">
    <?php
    if (!isset($_REQUEST["page"])) {
        $page = 1;
    } else {
        $page = $_REQUEST["page"];
    }
    ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php
            $start = ($page - 1) * 8;
            $SQL = "SELECT * from web_info";
            $q = mysqli_query($CNN, $SQL) or die($SQL . ": " . mysqli_error($CNN));
            $n = mysqli_num_rows($q);
            $SQL = "SELECT * from web_info LIMIT $start,8";
            $q = mysqli_query($CNN, $SQL) or die($SQL . ": " . mysqli_error($CNN));
            $no = mysqli_num_rows($q);
            while ($r = mysqli_fetch_array($q)) {
                $title = getData("web_info_translate", array('lang', 'uid'), array($lang, $r['id']), 'title');
                if ($title == "") {
                    $olang = "es";
                } else {
                    $olang = $lang;
                }
                $SQL = "SELECT * from web_info_translate WHERE uid='{$r["id"]}' AND lang='$olang'";
                $oq = mysqli_query($CNN, $SQL) or die($SQL . ": " . mysqli_error($CNN));
                while ($or = mysqli_fetch_array($oq)) {
                    $ref = str_pad($or["uid"], 6, "0", STR_PAD_LEFT);
                    $img = "/cms/content/info/item_" . $ref . "-$lang.jpg";
                    $title = str_replace(" ", "-", $or["title"]);
                    $url = "./$lang/informacion/articulo/$title" . "_" . $r["id"];
                    ?>
                    <div class="col-sm-3">                        
                        <div class="panel panel-default">
                            <div style="padding-top:4px;width: 100%;height: 128px;background-size: cover;background-image:url('<?php echo $img; ?>')">
                                <span class="label label-info pull-right"><i class="fa fa-tag"></i> <?php
                                    if ($or["category"] != "0") {
                                        $tag = getData("web_info_category", "id", $or["category"], "name");
                                    } else {
                                        $tag = "Sin Categoria";
                                    }
                                    echo $tag;
                                    ?></span>
                                <span class="label label-warning pull-right"><i class="fa fa-flag"></i> <?php echo $or["lang"]; ?></span>
                            </div>
                            <div class="panel-body" style="padding-top:4px;margin-top:0px;">
                                <h4><?php echo $or["title"]; ?></h4>
                                <p class="well well-sm"><?php echo $or["short_desc"]; ?></p>
                            </div>
                            <div class="panel-footer">
                                <a href="<?php echo $url; ?>" class="btn btn-primary">Ver mas</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>