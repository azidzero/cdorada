<div id="sidebar">
    <div class="container-fluid">
        <div id="sidebar-header" class="sidebar-module" style="background:rgba(0,24,72,0.95)">
            <img src="images/logo.png" width="100%" />
            <div style="padding:8px;">
                <div class="btn-group btn-group-sm pull-righ btn-group-justified">
                    <a target="_blank" class="btn btn-danger" href="/"><i class="fa fa-home"></i></a>                    
                    <a class="btn btn-danger" href="./logout.php"><i class="fa fa-sign-out"></i></a>
                </div>
            </div>
        </div><!-- header -->
        <div id="sidebar-user" class="sidebar-module">
            <div class="row">
                <div class="col-sm-4">
                    <img data-src="holder.js/52x52/social" class="img-circle" style="margin:4px auto;" />
                </div>
                <div class="col-sm-8">                        
                   {usuario}<br/> 
                    <small>{puesto}</small>                        
                </div>
            </div>
        </div><!-- user area -->
        <div id="sidebar-modules" class="sidebar-module">
            <ul class="nav list-group">
                <li><div class="list-group-header" style="background:rgba(0,24,72,0.95)">M&oacute;dulos</div></li>
                <?php
                foreach ($mods as $mod) {
                    ?>
                    <li <?php
                    if ($m == $mod->url) {
                        echo 'class="active"';
                    }
                    ?>>
                        <a href="./?m=<?php echo $mod->url; ?>" class="list-group-item">
                            <img src="include/modules/<?php echo $mod->url; ?>/icon.png"/> 
                            <span class="badge">0</span> <?php echo $mod->name; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div><!-- modules -->
    </div>
</div>