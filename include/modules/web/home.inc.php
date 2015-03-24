<div id="fullpage" class="main">
    <!-- ##### START HOME -->
    <section class="section" id="home"></section>
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
                preload: true,
                transition: ['fade', 'zoomOut', 'swirlLeft', 'blur', 'burn', 'flash'],
                overlay: "css/overlays/05.png"
            });
        });
    </script><!-- ##### EOF HOME -->

    <section id="rent" class="section" style="background-image:url('cms/content/upload/item_000001.jpg')">        
        <div class="container">
            <button onclick="$('#F0').toggle('slow')" type="button" class="btn btn-warning"><i class="fa fa-bars"></i></button> <strong>Alquiler </strong>
            <form action="./<?php echo $lang; ?>/search" method="post" id="F0" style="display: none;">
                <div class="row-fluid" style="background:rgba(255,255,255,0.25) !important;">
                    <div class="col-sm-2">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <a href="#" title="Entrada" class="hint"><img src="images/icons/16/door_in.png" /></a>
                            </span>
                            <input style="background:#FFF url(images/icons/16/date.png) no-repeat center right;" type="text" id="date_in" name="date_in" class="form-control" placeholder="<?php echo date("Y-m-d"); ?>" />
                        </div>
                    </div>                                
                    <div class="col-sm-2">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <a href="#" title="Salida" class="hint"><img src="images/icons/16/door_out.png" /></a>
                            </span>
                            <input type="text" id="date_end" name="date_end" class="form-control" placeholder="<?php echo date("Y-m-d"); ?>" />
                        </div>
                    </div>                                
                    <div class="col-sm-2">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <a href="#" title="Ocupantes" class="hint"><img src="images/icons/16/group.png" /></a>
                            </span>
                            <input type="text" id="ocupantes" name="ocupantes" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <a href="#" title="Dormitorios" class="hint"><img src="images/icons/16/bed.png" /></a>
                            </span>
                            <input type="text" id="dormitorios" name="dormitorios" class="form-control" />
                        </div>
                    </div>                                
                    <div class="col-sm-2">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <a href="#" title="Capacidad" class="hint"><img src="images/icons/16/meeting_workspace.png" /></a>
                            </span>
                            <input type="text" id="capacidad" name="capacidad" class="form-control" />
                        </div>
                    </div>                                
                    <div class="col-sm-2">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <a href="#" title="Localizacion" class="hint"><img src="images/icons/16/map.png" /></a>
                            </span>
                            <input type="text" id="locate" name="locate" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('.hint').tooltip({placement: 'top'});
                    });
                </script>                        
            </form>
        </div>
    </section>
    <section id="sale" class="section" style="background-image:url('cms/content/upload/item_000002.jpg')">
        <h1>Venta</h1>
    </section>
    <section id="deal" class="section" style="background-image:url('cms/content/upload/item_000003.jpg')">
        <h1>Ofertas</h1>
    </section>
    <section id="owner" class="section" style="background-image:url('cms/content/upload/item_000004.jpg')">
        <h1>Propietarios</h1>
    </section>
    <section id="about" class="section" style="background-image:url('cms/content/upload/item_000005.jpg')">
        <h1>Conocenos</h1>
    </section>
    <section id="content" class="section" style="background-image:url('cms/content/upload/item_000006.jpg')">        
        <div class="container">
            <h1>Contenido</h1>
            <div class="row">
                <div class="col-sm-3">
                    <img data-src="holder.js/100%x160/social" class="img-responsive img-rounded" />
                    <h4>Titulo Publicacion</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tristique pharetra risus at scelerisque. Duis tempor pretium quam ut egestas. Nam molestie dolor et felis posuere tristique. Quisque eu odio mollis, semper tellus id, facilisis ligula. Nunc tristique efficitur placerat. Phasellus nulla metus, volutpat vitae sagittis ut, luctus vitae metus. Aliquam vehicula libero nec lacus blandit commodo vel sit amet diam. Integer feugiat ac est a commodo. In egestas quis enim in gravida. Nullam a suscipit mi, sed porttitor augue. Vestibulum maximus libero velit, non ultricies metus condimentum ac. Aliquam ut facilisis dui. Etiam vitae vulputate odio.</p>
                    <a href="#" class="btn btn-warning">Ver M&aacute;s</a>
                </div>
                <div class="col-sm-3">
                    <h1></h1>
                </div>
                <div class="col-sm-3">
                    <h1></h1>
                </div>
                <div class="col-sm-3">
                    <h1></h1>
                </div>
            </div>
            <a href="#" class="btn btn-default btn-lg pull-right">Ver todas las publicaciones</a>
        </div>
    </section>
    <section id="contact" class="section" style="background-image:url('cms/content/upload/item_000000.jpg')">        
        <div class="row-fluid">
            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Formulario de Contacto</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row-fluid">                            
                            <div class="col-sm-3"><strong>Nombre:</strong></div>
                            <div class="col-sm-3"><input type="text" id="frm_name" name="frm_name" class="form-control" /></div>
                            <div class="col-sm-3"><strong>Correo Electronico:</strong></div>
                            <div class="col-sm-3"><input type="text" id="frm_email" name="frm_email" class="form-control" /></div>
                        </div><br/>
                        <div class="row-fluid">
                            <div class="col-sm-3"><strong>Ref.Alojamiento:</strong></div>
                            <div class="col-sm-3"><input type="text" id="frm_ref" name="frm_ref" class="form-control" /></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" style="background:rgba(255,255,255,0.75)">
                <h4><i class="fa fa-clock-o"></i> Horario de Atenci&oacute;n</h4>
                <strong>Lunes - Viernes</strong>: 08.30h - 13.00h y 15.30h - 19.00h<br/>
                <strong>S&aacute;bados</strong>: 10.00h - 14.00h
                <hr noshade />
                <h4><i class="fa fa-map-marker"></i> Direcci&oacute;n</h4>
                Rambla de catalunya n24, 43480 Vila-seca, Tarragona, Espa&ntilde;a.
                <h4><i class="fa fa-phone-square"></i> Tel&eacute;fono(s)</h4>
                +34 977 39 5854
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function () {
        $(".main").onepage_scroll({
            sectionContainer: "section",
            easing: "ease",
            updateURL: true
        });
    });
</script>