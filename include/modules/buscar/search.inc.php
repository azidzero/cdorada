<?php
$url = "";
if (isset($_REQUEST["lang"])) {
    $url.="$lang/";
}
if (isset($_REQUEST["m"])) {
    $url.="$m/";
}
if (isset($_REQUEST["s"])) {
    $url.="$s/";
}
if (isset($_REQUEST["o"])) {
    $url.="$o";
}
$uri = $_SERVER["REQUEST_URI"];
if (!isset($_REQUEST["page"])) {
    $page = 1;
} else {
    $page = $_REQUEST["page"];
}
if (isset($_REQUEST["place"])) {
    $place = $_REQUEST["place"];
} else {
    $place = "";
}
if (isset($_REQUEST["view"])) {
    $v = $_REQUEST["view"];
} else {
    $v = "lista";
}
$bedroom = $_REQUEST["bedroom"];
$people = $_REQUEST["group"];
$tipo = $_REQUEST["tipo"];
?>
<section id="search" style="margin-top:110px;">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="col-md-3 sidebar">
                <form id="frm-main" method="post" action="<?php echo $uri; ?>">
                    <input type="hidden" id="page" name="page" value="<?php echo $page; ?>" />
                    <table class="table table-condensed table-responsive" style="background:#FFF;">
                        <tr>
                            <td colspan="2">
                                <div class="btn-group pull-right">
                                    <a href="javascript:void(0)" onclick="$('#frm-main').attr('action', '<?php echo $uril; ?>').submit()" class="btn btn-warning">Ver Lista</a>
                                    <a href="javascript:void(0)" onclick="$('#frm-main').attr('action', '<?php echo $urim; ?>').submit()" class="btn btn-warning">Ver en Mapa</a>
                                </div>
                                <h4>Buscar Alquiler</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="images/map_marker.png" /></span>
                                    <select id="l" name="location" class="form-control">
                                        <option value="0">Destinos</option>
                                        <?php
                                        $OQ = mysqli_query($CNN, "SELECT * from cms_property_locale") or die(mysqli_error($CNN));
                                        while ($OR = mysqli_fetch_array($OQ)) {
                                            if ($_REQUEST["location"] == $OR["id"]) {
                                                echo "<option selected=\"selected\" value=\"{$OR["id"]}\">{$OR["name"]}</option>";
                                            } else {
                                                echo "<option value=\"{$OR["id"]}\">{$OR["name"]}</option>";
                                            }
                                        }
                                        ?> 
                                    </select>                            
                                </div>               
                            </td>
                        </tr><!-- Destino -->
                        <tr>
                            <td colspan="2">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="images/home_bed.png" /></span>
                                    <select id="bedroom" name="bedroom" class="form-control">
                                        <option value="0">Dormitorios</option>
                                        <?php
                                        $dorm_min = getOption('cms_options', 'dorm_min');
                                        $dorm_max = getOption('cms_options', 'dorm_max');
                                        for ($x = $dorm_min; $x < $dorm_max + 1; $x++) {
                                            if ($_REQUEST["bedroom"] == $x) {
                                                echo "<option selected=\"selected\" value=\"$x\">$x</option>";
                                            } else {
                                                echo "<option value=\"$x\">$x</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>                 
                            </td>                                
                        </tr><!-- Dormitorios -->
                        <tr>
                            <td colspan="2">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="images/groups.png" /></span>
                                    <select id="group-property" name="group-property" class="form-control">
                                        <option value="0">Personas</option>
                                        <?php
                                        $group_min = getOption('cms_options', 'group_min');
                                        $group_max = getOption('cms_options', 'group_max');
                                        for ($i = $group_min; $i < $group_max + 1; $i++) {
                                            if ($_REQUEST["group-property"] == $i) {
                                                echo "<option selected=\"selected\" value=\"$i\">$i</option>";
                                            } else {
                                                echo "<option value=\"$i\">$i</option>";
                                            }
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
                                        $OQ = mysqli_query($CNN, "SELECT * from cms_property_type");
                                        while ($OR = mysqli_fetch_array($OQ)) {
                                            if ($_REQUEST["tipo-property"] == $OR["id"]) {
                                                echo "<option selected=\"selected\" value=\"{$OR["id"]}\">{$OR["name"]}</option>";
                                            } else {
                                                echo "<option value=\"{$OR["id"]}\">{$OR["name"]}</option>";
                                            }
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
                                    <input type="text" id="date_in-property" name="date_in-property" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" value="<?php echo $_REQUEST["date_in-property"]; ?>" />
                                    <span class="input-group-addon"><img src="images/date_from.png" /></span>
                                    <input type="text" id="date_out-property" name="date_out-property" class="form-control" placeholder="<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 8, date('Y'))); ?>" value="<?php echo $_REQUEST["date_out-property"]; ?>" />
                                </div>                   
                            </td>
                        </tr><!-- Fechas -->
                        <!--
                        ###
                        ### Filtro Avanzado
                        ###
                        -->
                        <tr>
                            <td colspan="2">
                                <a href="javascript:void(0)" onclick="$('#fadvanced').toggle()"><i class="fa fa-bars"></i> Opciones Avanzadas</a>
                            </td>
                        </tr>
                        <tr id="fadvanced" style="display:none;">
                            <td colspan="2">
                                <table class="table table-condensed" style="font-size: 9pt;">
                                    <tr>
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
                                                        min: <?php echo getOption('cms_options', 'prize_min'); ?>,
                                                        max: <?php echo getOption('cms_options', 'prize_max'); ?>,
                                                        disabled: true,
                                                        values: [<?php echo getOption('cms_options', 'prize_max') / 4; ?>, <?php echo getOption('cms_options', 'prize_max') / 4 * 3; ?>],
                                                        slide: function (event, ui) {
                                                            $("#range-property").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                                                        }
                                                    });
                                                    $("#range-property").val("$" + $("#slider-range-property").slider("values", 0) + " - $" + $("#slider-range-property").slider("values", 1));
                                                });
                                            </script>
                                        </td>
                                    </tr><!-- Rango de Precio -->
                                    <tr>
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
                                            <b>Exterior</b>
                                            <table class="table table-condensed">
                                                <?php
                                                $sq = mysqli_query($CNN, "SELECT * from cms_property_exterior");
                                                while ($sr = mysqli_fetch_array($sq)) {
                                                    ?>
                                                    <tr>
                                                        <td width="24"><input type="checkbox" id="e_<?php echo $sr[0]; ?>" name="e_<?php echo $sr[0]; ?>" value="1" /></td>
                                                        <td><?php echo $sr["name"]; ?></td>
                                                    </tr>                                                
                                                    <?php
                                                }
                                                ?>
                                            </table>                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <b>Interior</b>
                                            <table class="table table-condensed">
                                                <?php
                                                $sq = mysqli_query($CNN, "SELECT * from cms_property_interior") or die(mysqli_error($CNN));
                                                while ($sr = mysqli_fetch_array($sq)) {
                                                    ?>
                                                    <tr>
                                                        <td width="24"><input type="checkbox" id="i_<?php echo $sr[0]; ?>" name="i_<?php echo $sr[0]; ?>" value="1" /></td>
                                                        <td><?php echo $sr["name"]; ?></td>
                                                    </tr>                                                
                                                    <?php
                                                }
                                                ?>
                                            </table>                                            
                                        </td>
                                    </tr>                                    
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-warning btn-lg btn-block">
                                    <i class="fa fa-search"></i> <?php echo $wlang->getString('filter', 'search-button'); ?>
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>                
            </div>
            <div class="col-sm-9">
                <?php
                $q = mysqli_query($CNN, "SELECT * from cms_property") or die(mysqli_error($CNN));
                $n = mysqli_num_rows($q);
                $limit = 5;
                $pages = intval($n / $limit) + 1;
                $offset = ($page - 1) * $limit;
                $q = mysqli_query($CNN, "SELECT * from cms_property order by id DESC LIMIT $offset,$limit") or die(mysqli_error($CNN));
                ?>
                <h4>Resultados</h4>                                
                Se econtr&aacuteron <strong><?php echo $n; ?></strong> resultados
                <?php
                if ($v == "mapa") {
                    ?>
                    <div id="mapa-filtro" style="width:100%;height:480px;"></div>
                    <script>
                        $('#mapa-filtro').gmap3({
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
                    <?php
                }
                ?>
                <div id="search-result">
                    <?php
                    while ($r = mysqli_fetch_array($q)) {
                        $rid = str_pad($r["id"], 8, "0", STR_PAD_LEFT);
                        ?>
                        <div class="container-fluid box" id="item-<?php echo $rid; ?>">
                            <div class="row-fluid">
                                <div class="col-sm-6">
                                    <h4><?php echo $r["title"]; ?></h4>
                                    <div id="carousel-<?php echo $rid; ?>" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <?php
                                            $noq = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='{$r["id"]}'") or die(mysqli_error($CNN));
                                            $num = mysqli_num_rows($noq);
                                            for ($j = 1; $j < $num + 1; $j++) {
                                                ?>
                                                <li data-target="#carousel-<?php echo $rid; ?>" data-slide-to="<?php echo $j - 1; ?>" class="<?php
                                                if ($j == 1) {
                                                    echo "active";
                                                }
                                                ?>">
                                                </li>
                                                <?php
                                            }
                                            ?>                                            
                                        </ol>
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            <?php
                                            $j = 1;
                                            while ($or = mysqli_fetch_array($noq)) {
                                                $ref = $or["name"] . "_m.jpg";
                                                ?>
                                                <div class="<?php
                                                if ($j == 1) {
                                                    echo 'active';
                                                }
                                                ?> item" style="background-image: url('cms/content/upload/property/<?php echo $ref; ?>');background-position:bottom;"></div>
                                                     <?php
                                                     $j++;
                                                 }
                                                 ?>
                                        </div>
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-<?php echo $rid; ?>" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-<?php echo $rid; ?>" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <span class="label label-invert pull-right">
                                        <i class="fa fa-moon-o"></i> 6 NOCHES
                                    </span>
                                    <h4>$<?php echo number_format($r["prize"], 2); ?></h4>
                                    <table class="table table-condensed" style="width:100%;color:#000;">
                                        <tr>
                                            <td colspan="3">                                                
                                                <i class="fa fa-map-marker"></i> <?php echo getData("cms_property_locale", "id", $r["location"], "name"); ?> <br/>
                                                <i class="fa fa-building"></i> <?php echo getData("cms_property_type", "id", $r["tipo"], "name"); ?> <br/>
                                            </td>
                                            <td width="40"><img title="Dormitorio(s)" data-toggle="tooltip" src="images/home_bed.png" /> <sup class="badge badge-data"><?php echo $r["room"]; ?></sup></td>
                                            <td width="40"><img title="Persona(s)" data-toggle="tooltip" src="images/home_users.png" /> <sup class="badge badge-data"><?php echo $r["capacity"]; ?></sup></td>
                                            <td width="40"><img title="Ba&ntilde;o(s)" data-toggle="tooltip" src="images/home_bath.png" /> <sup class="badge badge-data"><?php echo $r["bathroom"]; ?></sup></td>
                                        </tr>
                                    </table>
                                    <div class="btn-group btn-group-justified">
                                        <a target="_blank" href="<?php echo $lang; ?>/ver/ref/<?php echo $rid; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-list-alt"></i> M&Aacute;S INFORMACION</a>
                                        <a target="_blank" href="<?php echo $lang; ?>/reservar/<?php echo $rid; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-inbox"></i> RESERVAR</a>
                                    </div>
                                </div>
                            </div>
                            <p style="font-family: 'Arial';font-size: 10pt;text-align: justify;font-weight: 300;">
                                <?php echo $r["short_desc"]; ?>
                            </p>
                        </div>
                        <?php
                    }
                    if ($pages > 10) {
                        $page_min = $page - 5;
                    } else {
                        $page_min = 1;
                    }
                    if ($pages > 10) {
                        $page_max = $page + 5;
                    } else {
                        $page_max = $pages + 1;
                    }
                    ?>
                    <ul class="pagination">
                        <li <?php
                        if ($page == 1) {
                            echo "class=\"disabled\"";
                        }
                        ?>>
                            <a href="javascript:void(0)" onclick="$('#page').val(<?php echo $page - 1; ?>);
                                    $('#frm-main').submit();" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for ($i = $page_min; $i < $page_max; $i++) {
                            ?>
                            <li class="<?php
                            if ($page == $i) {
                                echo "active";
                            }
                            ?>">
                                <a href="javascript:void(0)" onclick="$('#page').val(<?php echo $i; ?>);
                                        $('#frm-main').submit();"><?php echo $i; ?></a></li>
                                <?php
                            }
                            ?>

                        <li <?php
                        if ($page == $pages) {
                            echo "class=\"disabled\"";
                        }
                        ?>>
                            <a href="javascript:void(0)" onclick="$('#page').val(<?php echo $page + 1; ?>);
                                    $('#frm-main').submit();" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
</section>
<script>
    $(document).ready(function () {
        $('#date_in-property').datepicker({
            dateFormat: 'yy-mm-dd',
            onClose: function (selectedDate) {
                $("#date_out-property").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#date_out-property').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'top'
            });
        });
    });

</script>