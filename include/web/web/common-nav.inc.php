<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="margin:0px;padding:0px;">
                <img src="images/logo.png" width="220" alt="" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="nav-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a data-url='home' href="<?php echo $lang;?>/" >Inicio</a></li>                       
                <li><a data-url='rent' href="<?php echo $lang;?>/rent" >Renta</a></li>                       
                <li><a data-url='sale' href="<?php echo $lang;?>/sale" >Venta</a></li>                       
                <li><a data-url='deal' href="<?php echo $lang;?>/deal" >Ofertas</a></li>                       
                <li><a data-url='owner' href="<?php echo $lang;?>/owner" >Propietarios</a></li>                       
                <li><a data-url='content' href="<?php echo $lang;?>/content" >Contenido</a></li>                       
                <li><a data-url='about' href="<?php echo $lang;?>/about" >Quienes Somos</a></li>                       
                <li><a data-url='contact' href="<?php echo $lang;?>/contact" >Contacto</a></li>                       
            </ul>

            <ul class="nav navbar-nav navbar-right">                        
                <li class="dropdown">
                    <a id="actual_lang" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="images/flag/ES.png" height="24" /> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="./en/"><img src="images/flag/EN.png" width="32" /> English</a></li>                                
                        <li><a href="./es/"><img src="images/flag/ES.png" width="32" /> Espa&ntilde;ol</a></li>                                
                        <li><a href="./fr/"><img src="images/flag/FR.png" width="32" /> français</a></li>                                
                        <li><a href="./ru/"><img src="images/flag/RU.png" width="32" /> русский</a></li>
                    </ul>
                </li>
                <li class="social"><a href="#"><img src="images/social/facebook.png" width="24" /></a></li>
                <li class="social" class="social"><a href="#"><img src="images/social/gplus.png" width="24" /></a></li>
                <li class="social"><a href="#"><img src="images/social/twitter.png" width="24" /></a></li>
                <li class="social"><a href="#"><img src="images/social/youtube.png" width="24" /></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>