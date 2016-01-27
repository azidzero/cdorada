<nav class="navbar navbar-default navbar-fixed-top" style="width: 100%;">
    <div>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse">
                <span class="sr-only"><?php echo $wlang->getString('navbar', 'responsive-menu'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="nav-collapse" style="background:#FFF;">
            <div class="container">
                <div id="top_brand">
                    <ul class="nav navbar-nav social">
                        <li><a href="#"><img src="images/social/facebook.png" width="24" /></a></li>
                        <li><a href="#"><img src="images/social/gplus.png" width="24" /></a></li>
                        <li><a href="#"><img src="images/social/twitter.png" width="24" /></a></li>
                        <li><a href="#"><img src="images/social/youtube.png" width="24" /></a></li>
                    </ul>
                    <ul class="nav navbar-nav social" style="margin-right: 48px;">                    
                        <?php
                        $url = "";
                        if (isset($_REQUEST["m"])) {
                            $url.="$m/";
                        }
                        if (isset($_REQUEST["s"])) {
                            $url.="$s/";
                        }
                        if (isset($_REQUEST["o"])) {
                            $url.="$o";
                        }
                        $wa = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status='1'");
                        while ($wr = mysqli_fetch_array($wa)) {
                            ?>
                            <li><a title="<?php echo $wlang->getString('navbar', 'flag-' . $wr["iso_639_1"]); ?>" href="./<?php echo $wr["iso_639_1"]; ?>/<?php echo $url; ?>">
                                    <img src="images/flag/<?php echo strtoupper($wr["iso_639_1"]); ?>.png" width="32" />
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <a class="navbar-brand" href="#" style="width:25vw;text-align: center;">
                        <img src="images/logo.png" alt="<?php echo $wlang->getString('navbar', 'alt-logo'); ?>" style="width: 25vw;" />
                        <small>Alquiler T&uacute;ristico en la Costa Dorada</small>
                    </a> 

                    <div class="slogan">
                        0034 977 395 854<br/>
                        info@planetgoldholidays.com
                    </div>
                </div>
            </div>
            <div style="background:linear-gradient(#2C3E50 5%,#34495E 95%);">
                <div class="container">
                    <div id="top_menu" style="text-align: center;">                
                        <ul class="nav navbar-nav">
                            <li class="active"><a data-url='home' href="javascript:void(0)" onclick="goto('home')"><?php echo $wlang->getString('navbar', 'menu-home'); ?></a></li>                       
                            <!-- <li><a data-url='property' href="javascript:void(0)" onclick="goto('property')"><?php echo $wlang->getString('navbar', 'menu-rent'); ?></a></li> -->
                            <li><a data-url='deal' href="javascript:void(0)" onclick="goto('deal')"><?php echo $wlang->getString('navbar', 'menu-deal'); ?></a></li>                    
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" data-url='content' href="javascript:void(0)"><?php echo $wlang->getString('navbar', 'menu-content'); ?> <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <?php
                                    $iq = mysqli_query($CNN, "SELECT * from web_activity_category where parent='0'");
                                    while ($ir = mysqli_fetch_array($iq)) {
                                        $str = $ir["name"];
                                        $str = strtoupper($str);
                                        $str = str_replace(" ", "-", $str);
                                        ?>
                                        <li><a href="./<?php echo $lang; ?>/actividades/categorias/<?php echo $str; ?>"><?php echo $ir["name"]; ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>                       
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" data-url='content' href="javascript:void(0)"><?php echo $wlang->getString('navbar', 'menu-info'); ?> <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <?php
                                    $iq = mysqli_query($CNN, "SELECT * from web_info_category where parent='0'");
                                    while ($ir = mysqli_fetch_array($iq)) {
                                        $str = $ir["name"];
                                        $str = strtoupper($str);
                                        $str = str_replace(" ", "-", $str);
                                        ?>
                                        <li><a href="./<?php echo $lang; ?>/informacion/categorias/<?php echo $str; ?>"><?php echo $ir["name"]; ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>                       
                            <li><a data-url='about' href="javascript:void(0)" onclick="goto('about')"><?php echo $wlang->getString('navbar', 'menu-about'); ?></a></li>                       
                            <li><a data-url='contact' href="javascript:void(0)" onclick="goto('contact')"><?php echo $wlang->getString('navbar', 'menu-contact'); ?></a></li>                       
                        </ul>
                    </div><!-- /.navbar-collapse -->      
                </div>
            </div>  
        </div><!-- /.container-fluid -->
    </div>
</nav>