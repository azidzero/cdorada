<div id="main-nav" class="navbar navbar-fixed-top navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"><?php $wlang->getString("header", "responsive-menu"); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="margin:0px;padding:0px;"><img src="images/logo.png" width="320" alt="" /></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="pull-right">
                <div style="display: inline-table;">
                    <a HREF="./es/"><img src="images/flag/es.png" height="16" /> <?php echo utf8_decode($wlang->getString("navbar", "flag-es")); ?></a>
                    <a HREF="./en/"><img src="images/flag/en.png" height="16" /> <?php echo utf8_decode($wlang->getString("navbar", "flag-en")); ?></a>
                    <a HREF="./fr/"><img src="images/flag/fr.png" height="16" /> <?php echo utf8_decode($wlang->getString("navbar", "flag-fr")); ?></a>
                    <a HREF="./ru/"><img src="images/flag/ru.png" height="16" /> <?php echo utf8_decode($wlang->getString("navbar", "flag-ru")); ?></a>
                </div>
                <br/>
                <div style="" id="social-menu">
                    <a HREF="./es/"><i style="font-size: 20px" class="fa fa-facebook-square"></i></a>                            
                    <a HREF="./es/"><i style="font-size: 24px" class="fa fa-twitter-square"></i></a>                            
                    <a HREF="./es/"><i style="font-size: 24px" class="fa fa-youtube-square"></i></a>                            
                    <a HREF="./es/"><i style="font-size: 24px" class="fa fa-google-plus-square"></i></a>                            
                </div>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li><a href="#">Alquiler</a></li>
                    <li><a href="#">Venta</a></li>
                    <li><a href="#">Ofertas</a></li>
                    <li><a href="#">Propietarios</a></li>
                    <li><a href="#">Quienes somos</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle='dropdown' href='#'>M&aacute;s contenido <i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href='#'>Paginas Secundarias</a></li>
                        </ul>
                    </li>
                    <li><a href='#'>Contacto</a></li>
                </ul>
            </div>
        </div>
    </div>                
</div>