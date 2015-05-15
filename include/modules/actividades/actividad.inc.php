<?php
$src = $_REQUEST["o"];
$name = str_replace("-", " ", $src);
?>
<section id="actividad" class="blog">    
    <div class="container">        
        <div class="row">            
            <div class="col-sm-9">
                <?php
                if ($o != 0) {
                    ?>
                    <div style="padding:8px;float:right;background:#039;color:#FFF;">
                        <img style="filter:invert(1);-webkit-filter:invert(1);" src="images/calendar.png" /> <?php echo date("Y-m-d"); ?>
                    </div>
                    <h2 style="font-size: 28pt"><?php echo random_lipsum(rand(4, 16), 'words'); ?></h2>
                    <img class="img-responsive img-thumbnail" data-src="holder.js/100%x196/social" />
                    <p class="activity-tags"></p>
                    <div style="text-align: justify;">
                        <?php
                        echo random_lipsum(3,'paras',rand(1,10));
                        ?>
                    </div>
                    <hr noshade />
                    <h3>Actividades Relacionadas</h3>
                    <div class="row">
                        <?php
                        for ($x = 0; $x < 3; $x++) {
                            ?>
                            <div class="col-sm-4">
                                <h4><?php echo random_lipsum(rand(4, 10), 'words',$x); ?></h4>
                                <div style="font-size: 9pt;"><?php echo random_lipsum(rand(20, 40), 'words'); ?></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    // Lista de Actividades
                    ?>
                    <div class="posts">
                        <?php
                        for ($i = 0; $i < 8; $i++) {
                            $ref = str_pad(rand(1, 6), 6, "0", STR_PAD_LEFT);
                            $oid = "cms/content/upload/item_" . $ref . ".jpg";
                            ?>
                            <div class="post">
                                <div class="post-container" style="background-image: url('<?php echo $oid; ?>');">
                                    <div>
                                        <small class="label label-danger">CATEGORIA</small> | 
                                        <small class="label label-info"><i class="fa fa-map-marker"></i> Ubicacion</small>
                                    </div>
                                    <a href="./<?php echo $lang; ?>/actividades/actividad/<?php echo $i; ?>">
                                        <h4>Nombre de Actividad</h4>               
                                    </a> 
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div style="text-align:center;">
                        <button id="btnMore" type="button" onclick="loadMore()" class="btn btn-warning">Cargar M&aacute;s</button>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="#">
                            <img data-src="holder.js/100%x196/social" class="img-responsive img-thumbnail" />
                        </a>
                        <h4>Otras actividades</h4>
                        <ul class="nav">
                            <?php
                            for ($i = 1; $i < rand(3, 10); $i++) {
                                ?>
                                <li><a href="#">Cateogoria <?php echo $i; ?></a>
                                    <ul class="nav sub-nav">
                                        <?php
                                        for ($j = 1; $j < rand(3, 10); $j++) {
                                            ?>
                                            <li><a href="#">Actividad <?php echo $j; ?></a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <a href="#">
                            <img data-src="holder.js/100%x196/social/text:Publicidad" class="img-responsive img-thumbnail" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="section"></div>
<script>
    var page = 1;
    function loadMore() {
        var txt = $('#btnMore').html();
        $('#btnMore').css('text-shadow', 'none');
        $('#btnMore').html('<i class="fa fa-spin fa-circle-o-notch"></i> Cargando Actividades');
        setTimeout(function () {
            var o = $('#posts').html();
            $('#posts').append(o + o);
            $('#btnMore').html(txt);
        }, 2000);
    }
</script>