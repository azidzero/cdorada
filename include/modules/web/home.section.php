<!-- ##### START HOME -->
<section class="section" id="home">
    <div id="filter" class="col-sm-4" style="background:#2980B9;border:1px solid #CCC;padding:4px;">
        <div>
            <strong>Fechas</strong>
            <div class="row">
                <div class="col-sm-6">
                    <img src="images/ui/door_in.png" /><input type="text" size="12" id="date_ini" class="input-date"/>
                </div>
                <div class="col-sm-6">
                    <img src="images/ui/door_out.png" /><input type="text" size="12" id="date_end" class="input-date"/>
                </div>
            </div>
        </div>
        <div>            
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <img id="no_user" src="images/ui/user_default.png" /> Ocupantes
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_1.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_2.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_3.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_4.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_5.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_more.png" /></a></li>                    
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <img id="no_user" src="images/ui/bed.png" /> Dormitorios
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_1.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_2.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_3.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_4.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_5.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_more.png" /></a></li>                    
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    <img id="no_user" src="images/ui/users_3.png" /> Capacidad
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_1.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_2.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_3.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_4.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_5.png" /></a></li>                    
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"><img src="images/ui/users_more.png" /></a></li>                    
                </ul>
                <div>
                    <img src="images/ui/location.png" /> Ubicacion
                    <input type="text" id="sLocate" />
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.input-date').datepicker({dateFormat: 'yy-mm-dd'});
        });
    </script>
    <div class="container">
        <div id="sucon">
            <?php
            for ($i = 0; $i < 6; $i++) {
                ?>
                <div id="su_<?php echo $i; ?>" class="su">
                    <h1>Titulo <?php echo $i; ?>! <small>Autor</small></h1>
                    <table class="table table-condensed">
                        <tr>
                            <td><i class="fa fa-group"></i> <strong>4</strong></td>
                            <td><i class="fa fa-bed"></i> <strong>2</strong></td>
                            <td><i class="fa fa-angle-double-up"></i> <strong>2</strong></td>
                            <td><i class="fa fa-map-marker"></i> <strong>Lugar en el que se encuentra</strong></td>
                        </tr>
                    </table>
                    <p style="text-align: justify;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at ornare orci. 
                        Sed dignissim pulvinar accumsan. Maecenas ut orci non arcu porta posuere eget et sapien. 
                        Nam consequat ex vel congue vehicula. Integer tristique dolor id quam viverra, eu laoreet 
                        ligula eleifend. Interdum et malesuada fames ac ante ipsum primis in faucibus.
                    </p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('body').vegas({
            slides: [
                {src: 'cms/content/upload/item_000001.jpg', delay: 4000}, // STR_PAD 6 de ID; Delay
                {src: 'cms/content/upload/item_000002.jpg', delay: 4000},
                {src: 'cms/content/upload/item_000003.jpg', delay: 4000},
                {src: 'cms/content/upload/item_000004.jpg', delay: 4000},
                {src: 'cms/content/upload/item_000005.jpg', delay: 4000}
            ],
            animation: ['kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight'],
            transition: ['fade', 'zoomOut', 'swirlLeft', 'zoomIn', 'swirlRight'],
            walk: function (index, slideSettings) {
                $('.su').css('right', '-100%').css('display', 'none');
                $('#su_' + index).css('right', '0px').css('display', 'block');
            }
        });
    });
</script><!-- ##### EOF HOME -->