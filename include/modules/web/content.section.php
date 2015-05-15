<section id="content" class="blog" style="background-image:url('cms/content/upload/item_000006.jpg')">
    <h3>BLOG</h3>
    <div class="blog" style="padding:0px;margin:0px;">
        <?php
        for ($i = 0; $i < 8; $i++) {

            $ref = str_pad(rand(1, 6), 6, "0", STR_PAD_LEFT);
            $oid = "cms/content/upload/item_" . $ref . ".jpg";
            ?>
            <div class="post">
                <div class="post-container" style="background-image: url('<?php echo $oid; ?>');">
                    <div><small class="label label-danger">ETC...</small><br/>
                        <small class="label label-info">{<?php echo date("Y-m-d"); ?>}</small></div>
                    <a href="./<?php echo $lang;?>/actividades/actividad/<?php echo $i;?>">
                        <h3>
                            {blog_title}                                                                       
                        </h3>               
                    </a> 

                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>