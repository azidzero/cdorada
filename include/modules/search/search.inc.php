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
$uril = $lang . "/buscar/lista";
$urim = $lang . "/buscar/mapa";
if (!isset($_REQUEST["page"])) {
    $page = 1;
} else {
    $page = $_REQUEST["page"];
}
// location
if (isset($_REQUEST["place"])) {
    $place = $_REQUEST["place"];
} else {
    $place = "all";
}
if (isset($_REQUEST["s"])) {
    $v = $_REQUEST["s"];
} else {
    $v = "lista";
}
$bedroom = $_REQUEST["bedroom"];
$people = $_REQUEST["group-property"];
if (isset($_REQUEST["tipo-property"])) {
    $tipo = $_REQUEST["tipo-property"];
} else {
    $tipo = 0;
}
$dini = $_REQUEST["date_in-property"];

if (!isset($_REQUEST["date_in-property"]) || $dini == "") {
    $dini = date("Y-m-d");
    $dtmp = new datetime($dini);
    $itmp = new DateInterval("P7D");
    $dtmp->add($itmp);
    $dend = $dtmp->format("Y-m-d");
} else {
    $dend = $_REQUEST["date_out-property"];
}

$na = new datetime($dini);
$nb = new datetime($dend);
$dias = $na->diff($nb);
?>
<section id="search" style="margin-top:120px;">    
    <div class="container">
        <div class="row">
            <div class="col-sm-3 sidebar">
                <form id="frm-main" method="POST" action="<?php echo $uri; ?>" onsubmit="return checkFilter()">
                    <input type="hidden" id="page" name="page" value="<?php echo $page; ?>" />
                    <table class="table table-condensed table-responsive" style="background:#FFF;">
                        <tr>
                            <td colspan="2">                                
                                <h4><?php echo $wlang->getString("filter", "title"); ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="input-group">
                                    <span class="input-group-addon"><img src="images/map_marker.png" /></span>
                                    <select id="place" name="place" class="form-control">
                                        <option value="all"><?php echo $wlang->getString("filter", "default-place"); ?></option>
                                        <?php
                                        $OQ = mysqli_query($CNN, "SELECT * from cms_property_locale") or die(mysqli_error($CNN));
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
                        </tr><!-- Destino -->
                        <tr>
                            <td colspan="2">
                                <div class="input-group">
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
                        </tr><!-- Dormitorios -->
                        <tr>
                            <td colspan="2">
                                <div class="input-group">
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
                        </tr><!-- Grupo -->
                        <tr>
                            <td colspan="2">
                                <div class="input-group">
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
                        </tr><!-- Tipo -->
                        <tr>
                            <td colspan="2">
                                <div class="input-group">                                
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
                                                });</script>
                                        </td>
                                    </tr><!-- Rango de Precio -->                                   
                                    <?php
                                    ## Special
                                    $aq = mysqli_query($CNN, "SELECT * from cms_catalog");
                                    while ($ar = mysqli_fetch_array($aq)) {
                                        if ($lang == "es") {
                                            $str = $ar["common"];
                                        } else {
                                            $str = getData("cms_catalog_translate", array("aid", "lang"), array($ar["id"], $lang), "caption");
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="2">
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
                            <td colspan="2">
                                <button type="submit" class="btn btn-warning btn-lg btn-block">
                                    <i class="fa fa-search"></i> <?php echo $wlang->getString('filter', 'search-button'); ?>
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>                
            </div>
            <div class="col-sm-9" id="search-result">
            </div>
        </div>
    </div>    
</section>
<!-- Modal More -->
<div class="modal fade" id="modalMore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $wlang->getString("result", "more-title"); ?></h4>
            </div>
            <div class="modal-body" id="showMore"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $wlang->getString("result", "more-close"); ?></button>
            </div>
        </div>
    </div>
</div>
<script>
    var loading = false;
    function loadNewContent() {
        $.ajax({
            type: 'GET',
            url: 'include/modules/search/content.lazy.php',
            success: function (data) {
                if(data != ""){
                    loading = false;
                    $('#search-result').append(data);
                }
            }
        });
    }
    $('#search-result').on('scroll', function () {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            if (!loading) {
                loading = true;
                loadNewContent();
            }
        }
    });
    $(document).ready(function () {
        $('#date_in-property').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0,
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
    function showMore(ref) {
        var dini = $('#date_in-property').val();
        var dend = $('#date_out-property').val();
        $.ajax({
            method: 'POST',
            url: 'include/modules/buscar/more.inc.php',
            data: {'lang': '<?php echo $_REQUEST["lang"]; ?>',
                'id': ref, 'dini': dini, 'dend': dend}
        }).done(function (content) {
            $('#showMore').html(content);
            $('#modalMore').modal('show');
        });
    }

</script>