<?php
$o = filter_input(INPUT_GET, "o");

$id = intval($o);
$query = "SELECT 
cms_property.*,
cms_property_locale.name AS pro_locale,
cms_property_type.name AS pro_tipo
FROM cms_property,cms_property_locale,cms_property_type
WHERE cms_property.id='$id' 
AND cms_property_locale.id=cms_property.location
AND cms_property_type.id=cms_property.tipo";
$q = mysqli_query($CNN, $query) or die(mysqli_error($CNN));
while ($r = mysqli_fetch_array($q)) {
    ?>
    <div class="container" style="margin-top: 116px;">
        <pre>
            <?php
            print_r($_REQUEST);
            ?>
        </pre>
        <div class="row">
            <div id="search" class="col-sm-4">
                <div class="well well-sm">
                    <h2><?php echo $r["title"]; ?><br/>
                        <small><?php echo $r["ref"]; ?></small>
                    </h2>
                    <span><i class="fa fa-2x fa-building"></i> <b><?php echo $r["pro_tipo"]; ?></b></span> - 
                    <span><i class="fa fa-2x fa-map-marker"></i> <b><?php echo $r["pro_locale"]; ?></b></span>
                </div>
                <p><b>Revisar Disponibilidad</b></p>
                <div class="input-group">                                
                    <span class="input-group-addon"><img src="images/date_to.png" /></span>
                    <input type="text" id="date_in-property" name="date_in-property" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" value="<?php echo $_REQUEST["date_in-property"]; ?>" />
                    <span class="input-group-addon"><img src="images/date_from.png" /></span>
                    <input type="text" id="date_out-property" name="date_out-property" class="form-control" placeholder="<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 8, date('Y'))); ?>" value="<?php echo $_REQUEST["date_out-property"]; ?>" />
                </div>
                <hr noshade />
                <!-- No. Adult -->
                <div class="input-group">                                
                    <span class="input-group-addon"style="border-color:transparent;"><img src="images/filter_adult.png" /></span>
                    <span class="input-group-btn">
                        <button onclick="minus('no_adult')" type="button" class="btn btn-warning btn-lg btn-default"><i class="fa fa-minus"></i></button>
                    </span>
                    <input size="4" type="text" id="no_adult" name="no_adult" class="form-control" placeholder="Adultos" value="1" />
                    <span class="input-group-btn">
                        <button onclick="plus('no_adult')" type="button" class="btn btn-warning btn-lg btn-default"><i class="fa fa-plus"></i></button>
                    </span>                    
                    <!-- No. Kid's -->
                    <span class="input-group-addon" style="border-color:transparent;"><img src="images/filter_child.png" /></span>
                    <span class="input-group-btn">
                        <button onclick="minus('no_kid')" type="button" class="btn btn-warning btn-lg btn-default"><i class="fa fa-minus"></i></button>
                    </span>
                    <input size="4" type="text" id="no_kid" name="no_kid" class="form-control" placeholder="Ni&ntilde;os" value="1" />
                    <span class="input-group-btn">
                        <button onclick="plus('no_kid')" type="button" class="btn btn-warning btn-lg btn-default"><i class="fa fa-plus"></i></button>
                    </span>
                </div>
                <div class="alert alert-warning" style="padding:4px;margin:4px;">
                    <h1 style="text-align: right;margin:2px;">
                        <span style="font-size: 8pt;" class="label label-warning pull-left">PRECIO</span>
                        $ <span id="actual_prize">9,999.99</span>
                    </h1>
                </div>
                <button type="button" class="btn disabled btn-warning btn-lg btn-block">RESERVAR</button><br/>
                <div style="padding:8px;text-align:center;">
                    <img src='/images/badge_cdorada.png' width="128" />
                </div>

                <script>
                    function minus(obj) {
                        var a = parseInt($('#' + obj).val());
                        if (a > 0) {
                            a--;
                        }
                        $('#' + obj).val(a);
                    }
                    function plus(obj) {
                        var a = parseInt($('#' + obj).val());
                        a++;
                        $('#' + obj).val(a);
                    }
                    
                </script>
            </div>
            <div class="col-sm-8">
                <div id="p-picture" class="container-fluid">
                    <div class="well well-sm">
                        <h4>Forograf&iacute;as</h4>
                        <?php
                        $noq = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                        $num = mysqli_num_rows($noq);
                        if ($num > 0) {
                            ?>
                            <div class="banner">
                                <ul>
                                    <?php
                                    while ($or = mysqli_fetch_array($noq)) {
                                        $ref = $or["name"] . "_b.jpg";
                                        ?>
                                        <li style="background-image: url('cms/content/upload/property/<?php echo $ref; ?>')"></li>
                                        <?php
                                    }
                                    ?>
                                </ul>        
                            </div>
                            <?php
                        } else {
                            ?>
                            <b>No hay fotografias</b>
                            <?php
                        }
                        ?>
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
                </div><!-- IMAGES -->
                <div class="section">&nbsp;</div>
                <div id="p-info">
                    <header class="container">
                        <h4>Informaci&oacute;n</h4>
                    </header>
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <h3>Descripci&oacute;n</h3>
                            <p style="text-align: justify;"><?php echo $r["long_desc"]; ?></p>

                            <div>
                                <table class="table table-condensed" style="background:#FFF;">
                                    <tr>
                                        <td>Precio</td>
                                        <td colspan="7"><b>$ <?php echo number_format($r["prize"], 2); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td><img src="images/home_bed.png" /> Habitaciones</td>
                                        <td><b><?php echo $r["room"]; ?></b></td>                    
                                        <td><img src="images/home_users.png" /> Capacidad</td>
                                        <td><b><?php echo $r["capacity"]; ?></b></td>
                                        <td><img src="images/home_type.png" /> Tipo</td>
                                        <td><b><?php echo getData("cms_property_type", "id", $r["tipo"], "name"); ?></b></td>                                                            
                                        <td><img src="images/map_marker.png" /> Ubicaci&oacute;n</td>
                                        <td colspan="3"><b><?php echo getData("cms_property_locale", "id", $r["location"], "name"); ?></b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>                        
                    </div>
                </div><!-- INFORMATION -->
                <div class="section">&nbsp;</div>
                <div id="p-detail" class="s-extra">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <h4>Informaci&oacute;n Detallada</h4>
                            <div class="row">
                                <table class="table table-condensed">
                                    <tr>
                                        <td>Estancia m&iacute;nima</td>
                                        <td>7 noches</td>                                    
                                        <td>Deposito y gastos adicionales</td>
                                        <td>Fianza: 420</td>                                    
                                        <td>Capacidad M&aacute;xima</td>
                                        <td>12</td>
                                        <td>Zona</td>
                                        <td>Dorada</td>
                                    </tr>
                                    <tr>
                                        <td>Distancia de la playa</td><td>550 m</td>
                                        <td>Localidad</td><td>Cambrils</td>
                                        <td>Supermercado m&aacute;s cercano</td><td>450m</td>
                                        <td>Metros Construidos (m<sup>2</sup>)</td><td>240</td>
                                    </tr>
                                </table>
                                <div class="col-sm-3">

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
                </div>
                <div id="p-available">
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
                                if ($i == $mo + 3) {
                                    echo "</div><div class=\"row\">";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="container-fluid">
                        <div class="row-fluid">
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

            </div>
        </div>
        <?php
        ?>
    </div>
    <?php
}
?>
