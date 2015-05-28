<section id="content" class="blog" style="background-image:none">
    <h3>ACTIVIDADES</h3>
    <div class="post-area">
        <?php
        for ($i = 0; $i < 8; $i++) {

            $ref = str_pad(rand(1, 6), 6, "0", STR_PAD_LEFT);
            $oid = "cms/content/upload/item_" . $ref . ".jpg";
            ?>
            <div class="post">
                <div class="post-background" style="background-image: url('<?php echo $oid; ?>');"></div>
                <div class="post-body">                    
                    <small class="label label-danger"><i class="fa fa-map-marker"></i> <?php echo random_lipsum(2, 'words'); ?></small>                                        
                    <a href="./<?php echo $lang; ?>/actividades/actividad/<?php echo $i; ?>">
                        <h3>
                            <?php echo random_lipsum(1, 'words'); ?>
                        </h3>               
                    </a> 

                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <a class="btn btn-warning" href="actividades/">Ver Todas las Actividades</a>
</section>