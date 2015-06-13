<?php
$o = filter_input(INPUT_GET, "o");
?>
<ul id="smenu" class="nav nav-pills" style="width: 100%;position: fixed;top:110px;left:0px;z-index:1010;height:40px;background:rgba(255,255,255,0.85);">    
    <li class="active"><a data-url="p-picture" href="javascript:void(0)">FOTOGRAF&Iacute;AS</a></li>
    <li><a data-url="p-info" href="javascript:void(0)">INFORMACI&Oacute;N</a></li>
    <li><a data-url="p-detail" href="javascript:void(0)">INFORMACI&Oacute;N DETALLADA</a></li>
    <li><a data-url="p-available" href="javascript:void(0)">DISPONIBILIDAD</a></li>
</ul>
<?php
$id = intval($o);
$q = mysqli_query($CNN, "SELECT * from cms_property WHERE id=$id") or die(mysqli_error($CNN));
while ($r = mysqli_fetch_array($q)) {
    ?>
    <!--
    <section id="p-home" class="s-header" style="background-image: url('cms/content/upload/item_000001.jpg');padding-top:140px;">
        <header class="container" style="margin-top: 8px;">
            <h1><small><b>REFERENCIA:</b> <?php echo $o; ?></small><br/>
                <i class="fa fa-map-marker"></i> <?php echo getData("cms_property_locale", "id", $r["location"], "name"); ?>
            </h1>
            <div class="container">
                <div id="weather" class="row"></div>        
            </div>
        </header>    
    </section><!-- HEADER -->
    <div class="section">&nbsp;</div>
    <section id="p-picture" class="container-fluid" style="margin-top:120px;">
        <div class="well well-sm">
            <h4>Forograf&iacute;as</h4>
            <div class="banner">
                <ul>
                    <?php
                    $noq = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                    $num = mysqli_num_rows($noq);
                    while ($or = mysqli_fetch_array($noq)) {
                        $ref = $or["name"] . "_b.jpg";
                        ?>
                        <li style="background-image: url('cms/content/upload/property/<?php echo $ref; ?>')"></li>
                        <?php
                    }
                    ?>
                </ul>        
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.banner').unslider({
                    dots: true,
                    fluid: true,
                    speed: 500,
                    delay: 3000
                });
            });
        </script>
    </section><!-- IMAGES -->
    <div class="section">&nbsp;</div>
    <section id="p-info" class="s-detail">
        <header class="container">
            <h4>Informaci&oacute;n</h4>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Descripci&oacute;n</h3>
                    <p style="text-align: justify;"><?php echo $r["long_desc"]; ?></p>
                </div>
                <div class="col-sm-6">
                    <table class="table table-condensed" style="background:#FFF;">
                        <tr>
                            <td>Precio</td>
                            <td colspan="3"><b>$ <?php echo number_format($r["prize"], 2); ?></b></td>
                        </tr>
                        <tr>
                            <td><img src="images/home_bed.png" /> Habitaciones</td>
                            <td><b><?php echo $r["room"]; ?></b></td>                    
                            <td><img src="images/home_users.png" /> Capacidad</td>
                            <td><b><?php echo $r["capacity"]; ?></b></td>
                        </tr>
                        <tr>
                            <td><img src="images/home_type.png" /> Tipo</td>
                            <td><b><?php echo getData("cms_property_type", "id", $r["tipo"], "name"); ?></b></td>                    
                            <td><img src="images/home_mode.png" /> Modo</td>
                            <td><b><?php echo $mode[rand(0, 1)]; ?></b></td>
                        </tr>
                        <tr>
                            <td><img src="images/map_marker.png" /> Ubicaci&oacute;n</td>
                            <td colspan="3"><b><?php echo getData("cms_property_locale", "id", $r["location"], "name"); ?></b></td>
                        </tr>
                    </table>
                    <div id="locate_map" style="width:100%;height:360px;"></div>
                    <script>
                        $('#locate_map').gmap3({
                            map: {
                                address: "<?php echo getData("cms_property_locale", "id", $r["location"], "name"); ?> España",
                                // latLng: [41.109106, 1.148606],
                                options: {
                                    zoom: 16
                                }
                            },
                            marker: {
                                address: "<?php echo getData("cms_property_locale", "id", $r["location"], "name"); ?> España"

                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </section><!-- INFORMATION -->
    <div class="section">&nbsp;</div>
    <section id="p-detail" class="s-extra">
        <div class="container">
            <div class="row">
                <h4>Informaci&oacute;n Detallada</h4>
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
    <section id="p-available">
        <div class="container-fluid">
            <h3>DISPONIBILIDAD</h3>
            <div class="row">
                <?php
                $y = 2015;
                $mo = date("m");
                for ($i = $mo; $i < $mo + 8; $i++) {
                    $w = date("w", mktime(0, 0, 0, $i, 1, $y));
                    $t = date("t", mktime(0, 0, 0, $i, 1, $y));
                    ?>
                    <div class="col-sm-3">
                        <div class="web-calendar">
                            <div class="web-calendar-h">
                                <h4><?php echo date("M", mktime(0, 0, 0, $i, 1, 2015)); ?></h4>
                            </div>
                            <div class="web-calendar-b">
                                <table class="table table-condensed table-bordered">
                                    <thead style="text-align:center;background-color:#039;color:#FFF;">
                                        <tr>
                                            <td>D</td>
                                            <td>L</td>
                                            <td>M</td>
                                            <td>I</td>
                                            <td>J</td>
                                            <td>V</td>
                                            <td>S</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            for ($j = 0; $j < $w; $j++) {
                                                echo '<td class="disabled">&nbsp;</td>';
                                            }
                                            for ($j = 1; $j < $t + 1; $j++) {
                                                $wo = date("w", mktime(0, 0, 0, $i, $j, $y));
                                                $date = date("Y-m-d", mktime(0, 0, 0, $i, $j, $y));
                                                if ($wo == 0) {
                                                    echo "</tr><tr>";
                                                }
                                                echo "<td>$j</td>";
                                            }
                                            for ($k = $wo + 1; $k < 7; $k++) {
                                                echo '<td class="disabled">&nbsp;</td>';
                                            }
                                            ?>                                                                                        
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($i==$mo+3){
                        echo "</div><div class=\"row\">";
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <script>
        function re() {
            z = $(window).height();
            $('section').css('min-height', z + 'px');
            $('#p-picture').css('min-height', (z - 210) + 'px');
            $('.banner ul li').css('min-height', (z - 210) + 'px');
        }
        $('section').css('min-height', $(window).height() + 'px');
        $(window).resize(function () {
            re();
        });
        re();
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
            $('#smenu li a').click(function () {
                $('#smenu li').removeClass('active');
                $(this).parent().addClass('active');
                var href = $(this).data('url');
                console.log(href);
                var y = $('#' + href).offset().top;
                y = y - 150;
                $('html,body').animate({
                    scrollTop: y + 'px'
                }, 1000);
            });

        });
    </script>
    <?php
}
?>