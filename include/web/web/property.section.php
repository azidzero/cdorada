<section id="property" style="background-image:none;background-color: #BDF;">
    <div id="pmain" class="container">        
        <div class="pull-right" style="margin-top:28px;">
            <div class="btn-group">
                <a class="btn btn-warning" onclick="pushMenu('property')" href="javascript:void(0)"><i class="fa fa-search"></i> Buscar Alojamiento</a>
                <a class="btn btn-warning" onclick="showMap()" href="javascript:void(0)"><i class="fa fa-map-marker"></i> Ver en Mapa</a>
            </div>
        </div>
        <h3 style="display: inline-block">            
            <?php echo $wlang->getString('property', 'name'); ?>
        </h3>            
    </div>
    <div id="filter-property" class="pushmenu">
        <div class="panel">
            <div class="panel-heading" style="padding:2px;">
                <a onclick="pushMenu('property')" class="btn btn-danger btn-sm pull-right" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                <h4 class="panel-title" style="margin:4px;"><?php echo $wlang->getString('filter', 'title'); ?></h4>
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-responsive">
                    <tr>
                        <td colspan="2">
                            <strong><?php echo $wlang->getString('filter', 'search-property'); ?></strong><br/>
                            <table width="100%">
                                <tr>
                                    <td><input type="checkbox" id="filter_rent" name="filter_rent" value="1" checked="checked" /> <?php echo $wlang->getString('filter', 'filter-rent'); ?></td>                            
                                    <td><input type="checkbox" id="filter_sale" name="filter_sale" value="1" checked="checked" /> <?php echo $wlang->getString('filter', 'filter-sale'); ?></td>                            
                                    <td><input type="checkbox" id="filter_deal" name="filter_deal" value="1" checked="checked" /> <?php echo $wlang->getString('filter', 'filter-deal'); ?></td>                            
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="font-weight: 300;">
                                <input type="checkbox"  id="useRange-property" name="useRange-property" value="1" onclick="chkSlider('property')" />
                                <label for="range-property"><?php echo $wlang->getString('filter', 'range'); ?>:</label>
                                <input type="text" id="range-property" readonly style="border:0; color:#f6931f; font-weight:bold;">
                            </p>
                            <div id="slider-range-property"></div>
                            <script>
                                $(function () {
                                    $("#slider-range-property").slider({
                                        range: true,
                                        min: 0,
                                        max: 10000,
                                        disabled: true,
                                        values: [2500, 7500],
                                        slide: function (event, ui) {
                                            $("#range-property").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                                        }
                                    });
                                    $("#range-property").val("$" + $("#slider-range-property").slider("values", 0) + " - $" + $("#slider-range-property").slider("values", 1));
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="input-group">                                
                                <span class="input-group-addon"><img src="images/date_from.png" /></span>
                                <input type="text" id="date_in-property" name="date_in-property" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" />
                                <span class="input-group-addon"><img src="images/date_to.png" /></span>
                                <input type="text" id="date_out-property" name="date_out-property" class="form-control" placeholder="<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 8, date('Y'))); ?>" />
                            </div>                   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="images/groups.png" /></span>
                                <select id="group-property" name="group-property" class="form-control">
                                    <option value="0">TODOS</option>
                                    <?php
                                    $group_min = getOption('cms_options', 'group_min');
                                    $group_max = getOption('cms_options', 'group_max');
                                    for ($i = $group_min; $i < $group_max + 1; $i++) {
                                        echo "<option value=\"$i\">$i</option>";
                                    }
                                    ?>
                                </select>
                            </div>                 
                        </td>            
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="images/home.png" /></span>
                                <select name="tipo-property" id="tipo-property" class="form-control">
                                    <option value="0">Todo</option>
                                    <?php
                                    $OQ = mysqli_query($CNN, "SELECT * from property_type");
                                    while ($OR = mysqli_fetch_array($OQ)) {
                                        echo "<option value=\"{$OR["id"]}\">{$OR["name"]}</option>";
                                    }
                                    ?>                                    
                                </select>
                            </div>                
                        </td>
                    </tr>                    
                    <tr>
                        <td colspan="2">
                            <div class="input-group">
                                <span class="input-group-addon"><img src="images/map_marker.png" /></span>
                                <input type="text" id="place-property" name="place-property" class="form-control" placeholder="Salou" />
                                <span class="input-group-addon">
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="$('#place-property').val('')"><i class="fa fa-times"></i></a>
                                </span>
                            </div>               
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" class="btn btn-default" onclick="doSearch('property');
                                    pushMenu('property')"><?php echo $wlang->getString('filter', 'search-button'); ?>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>    
    <div id="result-property" class="container"></div>
    <div id="result-map" class="container"></div>
</section><!-- PROPERTY -->
<div id="mod-full" class="modale">
    <div class="modale-container">
        <div class="modale-title">
            <a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" onclick="modale('mod-full')"><i class="fa fa-times"></i></a>
            Full</div>
        <div class="modale-body">
            <div class="row">
                <div class="col-sm-5">                                            
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            for ($j = 1; $j < 6; $j++) {
                                ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo ($j - 1); ?>" class="<?php
                                if ($j == 1) {
                                    echo "active";
                                }
                                ?>"></li>
                                    <?php
                                }
                                ?>                            
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php
                            $array = array(
                                'provincia' => 'provincia',
                                'municipio' => 'municipio',
                                'mode' => 'renta',
                                'type' => 'apartamento',
                                'bedroom' => rand(1, 16),
                                'users' => rand(2, 20)
                            );
                            for ($j = 1; $j < 6; $j++) {
                                $array['ref'] = str_pad(rand(1, 6), 6, "0", STR_PAD_LEFT);
                                $ref = "item_" . $array['ref'] . ".jpg";
                                ?>

                                <div class="item <?php
                                if ($j == 1) {
                                    echo "active";
                                }
                                ?>">
                                    <img src="cms/content/upload/<?php echo $ref; ?>" alt="...">                                
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <table class="table table-condensed" style="background:#FFF;">
                        <tbody><tr>
                                <td>Precio</td>
                                <td colspan="3"><b>$ 785,370.00</b></td>
                            </tr>
                            <tr>
                                <td><img src="images/home_bed.png"> Habitaciones</td>
                                <td><b>5</b></td>                    
                                <td><img src="images/home_users.png"> Capacidad</td>
                                <td><b>2</b></td>
                            </tr>
                            <tr>
                                <td><img src="images/home_type.png"> Tipo</td>
                                <td><b>Estudio</b></td>                    
                                <td><img src="images/home_mode.png"> Modo</td>
                                <td><b>venta</b></td>
                            </tr>
                            <tr>
                                <td><img src="images/map_marker.png"> Ubicación</td>
                                <td colspan="3"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-7">
                    <h4>REFERENCIA</h4>

                    <p style="font-size:9pt;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut mi dictum, posuere urna quis, efficitur ante. Aliquam consectetur ultrices odio, eget facilisis augue tempor in. Integer at arcu magna. Vestibulum quam dui, cursus sit amet eleifend vel, consectetur pharetra ipsum. Vivamus lectus neque, tristique eu dolor in, sollicitudin efficitur sem. Cras eget elit dignissim, tempor sem a, vulputate nunc. Proin posuere scelerisque nibh mollis mollis. Mauris ac ipsum vel sem suscipit dapibus. Duis velit ex, convallis a sollicitudin laoreet, ultricies ut neque. Morbi iaculis sagittis nisl vitae aliquet. Sed interdum iaculis ex, ac interdum dui mollis quis.
                    </p>
                    <div id="full_map" style="width:100%;height: 320px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#date_in-property').datepicker({dateFormat: 'yy-mm-dd'});
        $('#date_out-property').datepicker({dateFormat: 'yy-mm-dd'});
    });
    doSearch('property');
    function showMap() {
        var a = $('#result-property').css('left');
        if (a == 'auto' || a == '0px') {
            $('#result-property').animate({'left': '-100%'}, 500);
            $('#result-map').animate({'left': '0px'}, 500);
            $('#result-map').html("Cargando...");
            $('#result-map').load('include/modules/web/map-search.home.php');
        } else {
            $('#result-property').animate({'left': '0px'}, 500);
            $('#result-map').animate({'left': '100%'}, 500);
        }
    }
</script>