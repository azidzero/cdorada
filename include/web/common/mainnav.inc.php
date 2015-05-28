<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" style="width:100%;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse">
                <span class="sr-only"><?php echo $wlang->getString('navbar', 'responsive-menu'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="nav-collapse">
            <div id="top_brand">
                <a class="navbar-brand" href="#">
                    <img src="images/logo.png" style="height:70px;" alt="<?php echo $wlang->getString('navbar', 'alt-logo'); ?>" />
                </a>
                <ul class="nav navbar-nav navbar-right social">
                    <li><span class="slogan"><i>Alquiler T&uacute;ristico en la Costa Dorada</i></span></li>
                    <?php
                    $url = "";
                    if(isset($_REQUEST["m"])){ $url.="$m/";}
                    if(isset($_REQUEST["s"])){ $url.="$s/";}
                    if(isset($_REQUEST["o"])){ $url.="$o";}
                    ?>
                    <li><a href="./en/<?php echo $url;?>"><img src="images/flag/EN.png" width="18" /> <?php echo $wlang->getString('navbar', 'flag-en'); ?></a></li>                                
                    <li><a href="./es/<?php echo $url;?>"><img src="images/flag/ES.png" width="18" /> <?php echo $wlang->getString('navbar', 'flag-es'); ?></a></li>                                
                    <li><a href="./fr/<?php echo $url;?>"><img src="images/flag/FR.png" width="18" /> <?php echo $wlang->getString('navbar', 'flag-fr'); ?></a></li>                                
                    <li><a href="./ru/<?php echo $url;?>"><img src="images/flag/RU.png" width="18" /> <?php echo $wlang->getString('navbar', 'flag-ru'); ?></a></li>
                    <li><a href="#"><img src="images/social/facebook.png" width="24" /></a></li>
                    <li><a href="#"><img src="images/social/gplus.png" width="24" /></a></li>
                    <li><a href="#"><img src="images/social/twitter.png" width="24" /></a></li>
                    <li><a href="#"><img src="images/social/youtube.png" width="24" /></a></li>
                </ul>
                <div style="position: absolute;bottom:0px;right:0px;padding:6px;color:#F60;text-transform: none;">
                    0034 977 395 854 / info@planetgoldholidays.com
                </div>
            </div>
            <div id="top_menu">                
                <ul class="nav navbar-nav" style="margin-left:102px;width:80%;">
                    <li class="active"><a data-url='home' href="javascript:void(0)" onclick="goto('home')"><?php echo $wlang->getString('navbar', 'menu-home'); ?></a></li>                       
                    <li><a data-url='property' href="javascript:void(0)" onclick="goto('property')"><?php echo $wlang->getString('navbar', 'menu-rent'); ?></a></li>
                    <li><a data-url='deal' href="javascript:void(0)" onclick="goto('deal')"><?php echo $wlang->getString('navbar', 'menu-deal'); ?></a></li>
                    <li><a data-url='owner' href="javascript:void(0)" onclick="goto('owner')"><?php echo $wlang->getString('navbar', 'menu-owner'); ?></a></li>                                           
                    <li><a data-url='content' href="javascript:void(0)" onclick="goto('content')"><?php echo $wlang->getString('navbar', 'menu-content'); ?></a></li>                       
                    <li><a data-url='content' href="javascript:void(0)" onclick="goto('info')"><?php echo $wlang->getString('navbar', 'menu-info'); ?></a></li>                       
                    <li><a data-url='about' href="javascript:void(0)" onclick="goto('about')"><?php echo $wlang->getString('navbar', 'menu-about'); ?></a></li>                       
                    <li><a data-url='contact' href="javascript:void(0)" onclick="goto('contact')"><?php echo $wlang->getString('navbar', 'menu-contact'); ?></a></li>                       
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
</nav>