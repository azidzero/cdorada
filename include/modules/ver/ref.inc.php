<?php
$o = filter_input(INPUT_GET, "o");
$mode = array(
    'renta',
    'venta'
);
$type = array(
    'Apartamento',
    'Atico',
    'Casa',
    'Casa adosada',
    'Chalet',
    'D&uacute;plex',
    'Estudio',
    'Otro',
    'Piso'
);
?>
<section id="ver_head" class="s-header" style="background-image: url('cms/content/upload/item_000001.jpg');">
    <header class="container" style="margin-top: 8px;">
        <h1><small><b>REFERENCIA:</b> <?php echo $o; ?></small><br/>
            <i class="fa fa-map-marker"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        </h1>
        <div class="container">
            <div id="weather" class="row"></div>        
        </div>
    </header>    
</section><!-- HEADER -->
<section class="s-images">
    <div id="slides">
        <ul class="slides-container">
            <?php
            for ($i = 1; $i < 7; $i++) {
                $ref = "item_" . str_pad($i, 6, "0", STR_PAD_LEFT) . ".jpg";
                ?>
                <li>
                    <img src="cms/content/upload/<?php echo $ref; ?>" alt="" />
                    <div class="container">
                        Slide <?php echo $i; ?>
                    </div>
                </li>            
                <?php
            }
            ?>
        </ul>
        <nav class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-chevron-right fa-5x"></i></a>
            <a href="#" class="prev"><i class="fa fa-chevron-left fa-5x"></i></a>
        </nav>
    </div>
    <script>
        $(document).ready(function () {
            $('#slides').superslides({
                play: 3000
            });
        });
    </script>
</section><!-- IMAGES -->

<section class="s-detail">
    <header class="container">
        <h4>Detalles</h4>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3>Descripci&oacute;n</h3>
                <p style="text-align: justify;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut mi dictum, posuere urna quis, efficitur ante. Aliquam consectetur ultrices odio, eget facilisis augue tempor in. Integer at arcu magna. Vestibulum quam dui, cursus sit amet eleifend vel, consectetur pharetra ipsum. Vivamus lectus neque, tristique eu dolor in, sollicitudin efficitur sem. Cras eget elit dignissim, tempor sem a, vulputate nunc. Proin posuere scelerisque nibh mollis mollis. Mauris ac ipsum vel sem suscipit dapibus. Duis velit ex, convallis a sollicitudin laoreet, ultricies ut neque. Morbi iaculis sagittis nisl vitae aliquet. Sed interdum iaculis ex, ac interdum dui mollis quis.<br/>
                    Curabitur nec placerat massa. Nam feugiat libero arcu, eget vestibulum leo facilisis eu. Etiam non pretium enim. Quisque nec mauris rutrum, tempus mi eget, placerat quam. Nulla malesuada neque ornare luctus vehicula. Nam rhoncus cursus semper. Etiam tristique velit consequat diam pharetra porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec at nisi vitae risus vehicula sollicitudin. Quisque velit est, tincidunt ac elit sed, fermentum venenatis metus. Vestibulum a scelerisque arcu, a feugiat neque. Praesent maximus tortor nulla, nec ultrices leo porttitor ut. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                </p>
            </div>
            <div class="col-sm-6">
                <table class="table table-condensed" style="background:#FFF;">
                    <tr>
                        <td>Precio</td>
                        <td colspan="3"><b>$ <?php echo number_format(rand(1, 1000000), 2); ?></b></td>
                    </tr>
                    <tr>
                        <td><img src="images/home_bed.png" /> Habitaciones</td>
                        <td><b><?php echo rand(2, 16); ?></b></td>                    
                        <td><img src="images/home_users.png" /> Capacidad</td>
                        <td><b><?php echo rand(2, 16); ?></b></td>
                    </tr>
                    <tr>
                        <td><img src="images/home_type.png" /> Tipo</td>
                        <td><b><?php echo $type[rand(0, 8)]; ?></b></td>                    
                        <td><img src="images/home_mode.png" /> Modo</td>
                        <td><b><?php echo $mode[rand(0, 1)]; ?></b></td>
                    </tr>
                    <tr>
                        <td><img src="images/map_marker.png" /> Ubicaci&oacute;n</td>
                        <td colspan="3"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit</b></td>
                    </tr>
                </table>
                <div id="locate_map" style="width:100%;height:360px;"></div>
                <script>
                    $('#locate_map').gmap3({
                        map: {
                            //address: "Rambla Catalunya no.24 43480 Vila-seca (Tarragona) España",
                            latLng: [41.109106, 1.148606],
                            options: {
                                zoom: 16,
                                center: [41.109106, 1.148606]
                            }
                        },
                        marker: {
                            //address: "Rambla Catalunya no.24 43480 Vila-seca (Tarragona) España"
                            values: [
                                {latLng: [41.109106, 1.148606], data: 'Oficinas Centrales'}
                            ]
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</section><!-- INFORMATION -->

<section class="s-extra">
    <div class="container">
        <div class="row">
            <h4>Informaci&oacute;n Extra</h4>
            <div class="row">
                <div class="col-sm-3">
                    <table class="table table-condensed table-striped table-bordered">
                        <tr><td>Estancia minima</td><td>7 noches</td></tr>
                        <tr><td>Deposito y gastos adicionales</td><td>Fianza: 420</td></tr>
                        <tr><td>Capacidad Maxima</td><td>12</td></tr>
                        <tr><td>Zona</td><td>Dorada</td></tr>
                        <tr><td>Distancia de la playa</td><td>550 m</td></tr>
                        <tr><td>Localidad</td><td>Cambrils</td></tr>
                        <tr><td>Supermercado m&aacute;s cercano</td><td>450m</td></tr>
                        <tr><td>Metros Construidos (m<sup>2</sup>)</td><td>240</td></tr>
                    </table>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <b>Informaci&oacute;n General</b>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li>Parking</li>
                                <li>Zonas ajardinadas</li>
                                <li>Jardín</li>
                                <li>Terraza</li>
                                <li>Balcón</li>
                                <li>Solarium</li>
                                <li>Piscina privada</li>
                                <li>De nueva construcción</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <b>Interior</b>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li><span class="badge badge-ok"><i class="fa fa-check"></i></span>Sal&oacute;n</li>
                                <li><span class="badge badge-ok"><i class="fa fa-check"></i></span>Comedor</li>
                                <li><span class="badge badge-ok"><i class="fa fa-check"></i></span>Cocina</li>
                                <li><span class="badge badge-ok"><i class="fa fa-check"></i></span>Cocina americana</li>
                                <li><span class="badge badge-ok"><i class="fa fa-check"></i></span>Vitrocer&aacute;mica</li>
                                <li><span class="badge">2</span>Ba&ntilde;os</li>
                                <li><span class="badge">1</span>Aseos</li>
                                <li><span class="badge">5</span>Dormitorios</li>
                                <li><span class="badge">2</span>Camas individuales</li>
                                <li><span class="badge">4</span>Camas dobles</li>
                                <li><span class="badge">2</span>Plegat&iacute;n</li>
                                <li><span class="badge badge-ok"><i class="fa fa-check"></i></span>Mobiliario moderno</li>
                                <li><span class="badge">2</span>Ba&ntilde;eras</li>
                            </ul>
                        </div>

                        <div class="panel-heading">
                            <b>Exterior</b>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li><span class="badge badge-ok"><i class="fa fa-check"></i></span>Instalaciones para ni&ntilde;os</li>
                                <li><span class="badge badge-ok"><i class="fa fa-check"></i></span>Mobiliario de jard&iacute;n</li>
                                <li><span class="badge">1</span>Mesas</li>
                                <li><span class="badge">6</span>Sillas</li>
                                <li><span class="badge">2</span>Tumbonas</li>
                                <li><span class="badge badge-ok"><i class="fa fa-check"></i></span>Ducha exterior</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <b>Equipamiento</b>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li>Calefacción</li>
                                <li>Aire acondicionado</li>
                                <li>Wifi</li>
                                <li>Televisión</li>
                                <li>Antena parabólica</li>
                                <li>Lavadora</li>
                                <li>Lavavajillas</li>
                                <li>Horno</li>
                                <li>Microondas</li>
                                <li>Nevera combi</li>
                                <li>Cafetera goteo</li>
                                <li>Hervidor agua</li>
                                <li>Tostadora</li>
                                <li>Plancha</li>
                                <li>Tabla plancha</li>
                                <li>Barbacoa</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <b>Extras <small class="text-danger">(Bajo pedido previo)</small></b>
                        </div>
                        <div class="panel-body">
                            <ul>
                                <li>Canguro (&euro; / hora)</li>
                                <li>Limpiezas extras</li>
                                <li>Alquiler de coche</li>
                                <li>Alquiler de barcos</li>
                                <li>Reservas Wellness</li>
                                <li>Reservas Golf</li>
                                <li>Alquiler de bicis</li>
                                <li>Excursiones varias</li>
                                <li>Taxi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('section').css('min-height', $(window).height() + 'px');
    $(window).resize(function () {
        $('section').css('min-height', $(window).height() + 'px');
    });
    $(document).ready(function () {
        $.simpleWeather({
            location: 'Lagos de Moreno, Jalisco',
            woeid: '',
            unit: 'c',
            success: function (weather) {
                console.log(weather);
                html = '<div class="col-sm-4">';
                html += '<h3><i class="w icon-' + weather.code + '"></i> ' + weather.temp + '&deg;' + weather.units.temp + '</h3>';
                html += '</div>';
                html += '<div class="col-sm-4"><h3>' + weather.city + ',' + weather.region + '</h3></div>';
                html += '<div class="col-sm-4"><h3>' + weather.wind.direction + ' ' + weather.wind.speed + ' ' + weather.units.speed + '</h3></div>';

                $("#weather").html(html);
            },
            error: function (error) {
                $("#weather").html('<p>' + error + '</p>');
            }
        });
    });
</script>