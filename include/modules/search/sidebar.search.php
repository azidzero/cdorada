<form id="frm-main" method="POST" action="<?php echo $uri; ?>" onsubmit="return checkFilter()">
    <input type="hidden" id="page" name="page" value="<?php echo $page; ?>" />
    <h4>
        <?php echo $wlang->getString("filter", "title"); ?>
    </h4>
    <table class="table table-condensed table-responsive" style="background:#FFF;">        
        <tr>
            <td colspan="2">
                <div class="input-group addon-inverse">
                    <span class="input-group-addon"><img src="images/map_marker.png" /></span>
                    <select id="place" name="place" class="form-control">
                        <option value="all"><?php echo $wlang->getString("filter", "default-place"); ?></option>
                        <?php
                        $OQ = mysqli_query($CNN, "SELECT * from cms_property_locale WHERE tipo='1'") or die(mysqli_error($CNN));
                        while ($OR = mysqli_fetch_array($OQ)) {
                            if ($place == $OR["id"]) {

                                echo "<option selected value=\"{$OR["id"]}\">{$OR["name"]}</option>";
                            } else {
                                echo "<option value=\"{$OR["id"]}\">{$OR["name"]}</option>";
                            }
                        }
                        ?> 
                    </select>                            
                </div>               
            </td>
        </tr>
        <tr>
            <td width="50%">
                <div class="input-group addon-inverse">
                    <span class="input-group-addon"><img src="images/home_bed.png" /></span>
                    <select id="bedroom" name="bedroom" class="form-control">
                        <option value="0"><?php echo $wlang->getString("filter", "default-room"); ?></option>
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
            <td>
                <div class="input-group addon-inverse">
                    <span class="input-group-addon"><img src="images/home_users.png" /></span>
                    <select id="group-property" name="group-property" class="form-control">
                        <option value="0"><?php echo $wlang->getString("filter", "default-group"); ?></option>
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
        </tr>
        <tr>
            <td colspan="2">
                <div class="input-group addon-inverse">
                    <span class="input-group-addon"><img src="images/home.png" /></span>
                    <select name="tipo-property" id="tipo-property" class="form-control">
                        <option value="0"><?php echo $wlang->getString("filter", "default-type"); ?></option>
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
        </tr>
        <tr>
            <td colspan="2">
                <div class="input-group addon-inverse">                                
                    <span class="input-group-addon"><img src="images/date_to.png" /></span>
                    <input type="text" id="date_in-property" name="date_in-property" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" value="<?php echo $dini; ?>" />
                    <span class="input-group-addon"><img src="images/date_from.png" /></span>
                    <input type="text" id="date_out-property" name="date_out-property" class="form-control" placeholder="<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 7, date('Y'))); ?>" value="<?php echo $dend; ?>" />
                </div>                   
            </td>
        </tr>
        <!--
        ### Filtro Avanzado
        -->
        <tr>
            <td colspan="2">
                <a href="javascript:void(0)" onclick="$('#fadvanced').toggle()">
                    <i class="fa fa-bars"></i> <?php echo $wlang->getString("filter", "str-advanced"); ?></a>
            </td>
        </tr>
        <tr id="fadvanced" style="display:none;">
            <td colspan="2">
                <table class="table table-condensed" style="font-size: 9pt;">
                    <tr>
                        <td>
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
                                });</script>
                        </td>
                    </tr><!-- Rango de Precio -->                                   
                    <?php
                    ## Special
                    $aq = mysqli_query($CNN, "SELECT * from cms_catalog where required=0");
                    while ($ar = mysqli_fetch_array($aq)) {
                        if ($lang == "es") {
                            $str = $ar["common"];
                        } else {
                            $str = getData("cms_catalog_translate", array("aid", "lang"), array($ar["id"], $lang), "caption");
                        }
                        ?>
                        <tr>
                            <td>
                                <b><?php echo $str; ?></b>
                                <table class="table table-condensed">
                                    <?php
                                    $sq = mysqli_query($CNN, "SELECT * from cms_addons where cid='{$ar["id"]}'") or die(mysqli_error($CNN));
                                    while ($sr = mysqli_fetch_array($sq)) {
                                        $ostr = getData("cms_addon_translate", array('tname', 'aid', 'lang'), array($ar["id"], $sr["id"], $lang), 'caption');
                                        ?>
                                        <tr>
                                            <td width="24"><input type="checkbox" id="e_<?php echo $ar["id"] . "_" . $sr['id']; ?>" name="e_<?php echo $ar['id'] . "_" . $sr['id']; ?>" value="1" /></td>
                                            <td><?php echo $ostr; ?></td>
                                        </tr>                                                
                                        <?php
                                    }
                                    ?>
                                </table>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>                                                               
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit" class="btn btn-warning btn-lg btn-block">
                    <i class="fa fa-search"></i> <?php echo $wlang->getString('filter', 'search-button'); ?>
                </button>
            </td>
        </tr>
    </table>
</form>
<script>
    $(document).ready(function () {
        $('#date_in-property').datepicker({
            minDate: 0,
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 3,
            showButtonPanel: true,
            onSelect: function () {
                var d = $('#date_in-property').val();
                var dox = new Date(d);
                var de = dox.addDays(8);
                $('#date_out-property').datepicker('option', 'minDate', de);
                // $('#date_out-property').datepicker('show');
            },
            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
        });

        $('#date_out-property').datepicker({
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 3,
            showButtonPanel: true,
            onSelect: function () {
                var d = $('#date_out-property').val();
                $('#date_out-property').datepicker('option', 'minDate', d);
            },
            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
        });
    });
    function sticky_relocate() {
        var window_top = $(window).scrollTop();
        var div_top = $('#main').offset().top;
        if (window_top > div_top) {
            var W = $('#frm-main').parent().width();
            $('#frm-main').addClass('filter-fixed');
            $('#frm-main').css('width',(W)+'px');
        } else {
            $('#frm-main').removeClass('filter-fixed');
        }
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });
</script>