<section id="actividad" class="blog" style="">    
    <div class="container">
        <h3>PUBLICACIONES</h3>
        <div class="row">
            <div class="col-sm-9">
                <?php
                for ($i = 0; $i < 5; $i++) {
                    ?>                
                    <div class="post">
                        <div class="post-left">                            
                            <img data-src="holder.js/240x124/social" />
                            <?php
                            $n = rand(1, 5);
                            for ($j = 0; $j < $n; $j++) {
                                ?>
                                <a href="javascript:void(0)"><span class="post-cat">categoria <?php echo $j; ?></span></a>                            
                                <?php
                            }
                            ?>
                        </div>
                        <div class="post-right">
                            <div style="height: 28px;">
                                <a href="#" class="post-date">
                                    <img src="images/calendar.png" /> <?php echo date("Y-m-d"); ?>
                                </a> &nbsp; 
                                <a class="post-author" href="#"><img src="images/home_users.png" /> LOREM IPSUM DOLOR SIT AMET</a>
                            </div>
                            <a class="post-title" href="#">
                                LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT,LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT
                            </a><br/>                            
                            <p>
                                "No: never saw such a book; heard of it, though. But now, tell me, Stubb, do you suppose that that devil you was speaking of just now, was the same you say is now on board the Pequod?"<br/>
                                "Am I the same man that helped kill this whale? Doesn't the devil live for ever; who ever heard that the devil was dead? Did you ever see any parson a wearing mourning for the devil? And if the devil has a latch-key to get into the admiral's cabin, don't you suppose he can crawl into a porthole? Tell me that, Mr. Flask?"
                            </p><br/>
                            <p style="text-align:right;">
                                <a class="btn">M&aacute;s Informaci&oacute;n</a>
                            </p>
                        </div>
                    </div>                
                    <?php
                }
                ?>
            </div>
            <div class="col-sm-3">
                <img data-src="holder.js/100%x640/social" />
            </div>
        </div>
    </div>
</section>