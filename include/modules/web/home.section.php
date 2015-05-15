<!-- ##### START HOME -->
<section id="home" style="position: relative;">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
            <?php
            for ($j = 1; $j < 6; $j++) {
                $array['ref'] = str_pad(rand(1, 6), 6, "0", STR_PAD_LEFT);
                $ref = "item_" . $array['ref'] . ".jpg";
                ?>
                <div class="<?php
                if ($j == 1) {
                    echo 'active';
                }
                ?> item" style="background-image: url('cms/content/upload/<?php echo $ref; ?>')">
                    <!-- <img src="cms/content/upload/<?php echo $ref; ?>" alt="Slide1" /> -->
                    <div class="carousel-caption">
                        <h3>El lugar perfecto</h3>
                        <p>Los Mejores Planes Vacacionales en la Costa Dorada</p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="main-filter">
        <div class="filter-content">
            <form id="frm-main">
            <table class="table table-condensed table-responsive" style="background:#FFF;">
                <tr>
                    <td colspan="2">
                        <b>Buscar Alquiler</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="input-group">
                            <span class="input-group-addon"><img src="images/map_marker.png" /></span>
                            <select id="place" name="place" class="form-control">
                                <option value="cambrils">Destinos</option>
                                <option value="cambrils">Cambrils</option>
                                <option value="la_pineda">La Pineda</option>
                                <option value="salou">Salou</option>
                            </select>                            
                        </div>               
                    </td>
                </tr><!-- Destino -->
                <tr>
                    <td colspan="2">
                        <div class="input-group">
                            <span class="input-group-addon"><img src="images/groups.png" /></span>
                            <select id="group-property" name="group-property" class="form-control">
                                <option value="0">Personas</option>
                                <?php
                                $group_min = getOption('property_options', 'group_min');
                                $group_max = getOption('property_options', 'group_max');
                                for ($i = $group_min; $i < $group_max + 1; $i++) {
                                    echo "<option value=\"$i\">$i</option>";
                                }
                                ?>
                            </select>
                        </div>                 
                    </td>                                
                </tr><!-- Grupo -->
                <tr>
                    <td colspan="2">
                        <div class="input-group">
                            <span class="input-group-addon"><img src="images/home.png" /></span>
                            <select name="tipo-property" id="tipo-property" class="form-control">
                                <option value="0">Tipo de Alojamiento</option>
                                <?php
                                $OQ = mysqli_query($CNN, "SELECT * from property_type");
                                while ($OR = mysqli_fetch_array($OQ)) {
                                    echo "<option value=\"{$OR["id"]}\">{$OR["name"]}</option>";
                                }
                                ?>                                    
                            </select>
                        </div>                
                    </td>
                </tr><!-- Tipo -->
                <tr>
                    <td colspan="2">
                        <div class="input-group">                                
                            <span class="input-group-addon"><img src="images/date_to.png" /></span>
                            <input type="text" id="date_in-property" name="date_in-property" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" />
                            <span class="input-group-addon"><img src="images/date_from.png" /></span>
                            <input type="text" id="date_out-property" name="date_out-property" class="form-control" placeholder="<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 8, date('Y'))); ?>" />
                        </div>                   
                    </td>
                </tr><!-- Fechas -->                                
                <!--<tr>
                    <td colspan="2">
                        <p style="font-weight: 300;">
                            <input type="checkbox"  id="useRange-property" name="useRange-property" value="1" onclick="chkSlider('property')" />
                            <label style="font-size: 9pt;" for="range-property"><?php echo $wlang->getString('filter', 'range'); ?>:</label>
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
                </tr><!-- Rango de Precio -->
                <!--<tr>
                    <td colspan="2" style="text-transform: uppercase;font-size: 9pt;">
                        <strong><?php echo $wlang->getString('filter', 'search-property'); ?></strong><br/>
                        <table width="100%">
                            <tr>
                                <td><input type="checkbox" id="filter_rent" name="filter_rent" value="1" checked="checked" /> <?php echo $wlang->getString('filter', 'filter-rent'); ?></td>
                                <td><input type="checkbox" id="filter_deal" name="filter_deal" value="1" checked="checked" /> <?php echo $wlang->getString('filter', 'filter-deal'); ?></td>                            
                            </tr>
                        </table>
                    </td>
                </tr><!-- Modalidades -->
                <tr>
                    <td colspan="2">
                        <button type="button" class="btn btn-warning btn-lg btn-block" onclick="doSearch('property');
                                pushMenu('property')"><?php echo $wlang->getString('filter', 'search-button'); ?>
                        </button>
                    </td>
                </tr>
            </table>
        </form>
            <form id="frm-ref" action="./" method="POST">
                <div class="input-group">
                    <span class="input-group-addon">Referencia</span>
                    <input type="text" id="ref" name="ref" class="form-control" placeholder="Buscar por referencia..." />
                    <span class="input-group-addon">
                        <a href='#' class="btn btn-warning"><i class="fa fa-search"></i></a>
                    </span>
                </div>
            </form>
        </div>
    </div>

</section>
