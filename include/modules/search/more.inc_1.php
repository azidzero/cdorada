<?php
$lang = $_REQUEST["lang"];
include("../../../inc/app.conf.php");
$o = filter_input(INPUT_POST, "id");
$dini = filter_input(INPUT_POST, "dini");
if ($dini == "") {
    $dini = date("Y-m-d");
    $dtmp = new datetime($dini);
    $itmp = new DateInterval("P7D");
    $dtmp->add($itmp);
    $dend = $dtmp->format("Y-m-d");
} else {
    $dend = filter_input(INPUT_POST, "dend");
}

$na = new datetime($dini);
$nb = new datetime($dend);
$dias = $na->diff($nb);
$noches = $dias->format("%a") - 1;

$id = intval($o);

// # Tarifa 
$sql = "SELECT 
    crs_rates.*, 
    crs_rates_use.pid, 
    cms_property.title propiedad, \n";
$sql .= " cms_property.capacity, 
    cms_property.room, 
    cms_property.bathroom, 
    cms_property.short_desc, 
    cms_property.long_desc, 
    cms_property_locale.name lugar, 
    cms_property_type.name tipo_h \n";
$sql .= " FROM 
    crs_rates, 
    crs_rates_use, 
    crs_rates_detail, 
    cms_property, 
    cms_property_locale, 
    cms_property_type \n";
$sql .= " WHERE  
    '$dini' BETWEEN date_ini AND date_end \n";
$sql .= " AND crs_rates_detail.rid = crs_rates.id \n";
$sql .= " AND cms_property.id = crs_rates_use.pid \n";
$sql .= " AND cms_property_locale.id = cms_property.location \n";
$sql .= " AND cms_property_type.id = cms_property.tipo \n";
$sql .= " AND cms_property.id='$id'";
$q = mysqli_query($CNN, $sql) or die(mysqli_error($CNN));
// # Disponible??
while ($r = mysqli_fetch_array($q)) {
    ?>
    <div class="container">        
        <div class="row">
            <div id="search" class="col-sm-4">              
                <form target="_blank" action="./<?php echo $lang; ?>/reservar/start" method="POST" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="pid"  value="<?php echo $id; ?>" />
                    <div class="row-fluid">
                        <h4><?php echo $r["propiedad"]; ?><br/>
                            <small><?php echo $r["ref"]; ?></small>
                        </h4>
                        <p style="text-align: justify;font-size: 9pt;"><?php echo $r["long_desc"]; ?></p>
                        <div>
                            <table class="table table-condensed" style="background:#FFF;font-size:9pt;">                                   
                                <tr>
                                    <td><img src="images/home_bed.png" /> Habitaciones: <b><?php echo $r["room"]; ?></b></td>
                                    <td><img src="images/home_users.png" /> Capacidad: <b><?php echo $r["capacity"]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><img src="images/home_type.png" /> Tipo: <b><?php echo $r["tipo_h"]; ?></b></td>                                                                                        
                                    <td><img src="images/map_marker.png" /> Ubicaci&oacute;n: <b><?php echo $r["lugar"]; ?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>                                    
                    <p><b>Revisar Disponibilidad</b></p>
                    <div class="input-group">                                
                        <span class="input-group-addon"><img src="images/date_to.png" /></span>
                        <input type="text" id="date_in-property" name="date_in-property" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" value="<?php echo $dini; ?>" />
                        <span class="input-group-addon"><img src="images/date_from.png" /></span>
                        <input type="text" id="date_out-property" name="date_out-property" class="form-control" placeholder="<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 8, date('Y'))); ?>" value="<?php echo $dend; ?>" />
                    </div>
                    <hr noshade />
                    <!-- No. Adult -->
                    <div class="input-group">                                
                        <span class="input-group-addon"style="border-color:transparent;"><img src="images/filter_adult.png" /></span>
                        <span class="input-group-btn">
                            <button onclick="minus('no_adult')" type="button" class="btn btn-warning btn-lg btn-default"><i class="fa fa-minus"></i></button>
                        </span>
                        <input size="4" type="text" id="no_adult" min="1" max="" name="no_adult" class="form-control" placeholder="Adultos" value="1" />
                        <span class="input-group-btn">
                            <button onclick="plus('no_adult')" type="button" class="btn btn-warning btn-lg btn-default"><i class="fa fa-plus"></i></button>
                        </span>                    
                        <!-- No. Kid's -->
                        <span class="input-group-addon" style="border-color:transparent;"><img src="images/filter_child.png" /></span>
                        <span class="input-group-btn">
                            <button onclick="minus('no_kid')" type="button" class="btn btn-warning btn-lg btn-default"><i class="fa fa-minus"></i></button>
                        </span>
                        <input size="4" type="text" id="no_kid" name="no_kid" class="form-control" placeholder="Ni&ntilde;os" value="0" />
                        <span class="input-group-btn">
                            <button onclick="plus('no_kid')" type="button" class="btn btn-warning btn-lg btn-default"><i class="fa fa-plus"></i></button>
                        </span>
                    </div>
                    <div class="alert alert-warning" style="padding:4px;margin:4px;">
                        <h3 style="padding:0px;margin:0px;text-align: right;font-size: 24pt;line-height: 0.75em;">                        
                            <small class="pull-right label label-danger" style="font-size: 9pt;margin:0px;font-weight:300;">
                                <?php
                                $noches = $dias->format('%a') - 1;
                                echo $noches;
                                $semana = intval($noches / 7);
                                $extra = $noches % 7;
                                $pw = $r["semanal"] * $semana;
                                $pd = $r["diario"] * $extra;
                                $precio = calcPrize($r["pid"], $dini, $dend);
                                ?> noches</small>
                            <small class="pull-left label label-warning" style="font-size: 8pt;margin:0px;">PRECIO</small>
                            <br/>
                            &euro; <span id="total" data-value="<?php echo ($precio); ?>"><?php echo ($precio); ?></span>
                        </h3>
                        <input type="hidden" id="ptotal" name="ptotal" value="<?php echo number_format($precio, 2); ?>" />
                        <input type="hidden" id="ototal" name="ototal" value="0.00" />
                    </div>
                    <div class="row-fluid">
                        <?php
                        $see = array('extra');
                        $set = array('Servicios Adicionales');
                        foreach ($see as $K => $sea) {
                            $oq = mysqli_query($CNN, "SELECT * from cms_property_$sea");
                            $on = mysqli_num_rows($oq);
                            if ($on > 0) {
                                ?>
                                <div class="row">
                                    <b><?php echo $set[$K]; ?></b>
                                    <table class="table table-condensed" style="font-size:8pt;">
                                        <?php
                                        $nox = 1;
                                        while ($or = mysqli_fetch_array($oq)) {
                                            $label = $or["name"];
                                            $ot = getData("cms_property_" . $sea, "id", $or["oid"], "tipo");
                                            $show = true;
                                            if ($show == true) {
                                                ?>                                                                                                    
                                                <tr>
                                                    <td width="1">
                                                        <input
                                                            data-id="<?php echo $or["id"]; ?>"
                                                            data-unique="<?php echo $or["unico"]; ?>"                                                            
                                                            class="calcExtra" 
                                                            type="checkbox" 
                                                            id="extra_<?php echo $or["id"]; ?>" 
                                                            name="extra_<?php echo $or["id"]; ?>" 
                                                            value="<?php echo $or["valor"]; ?>"
                                                            />
                                                    </td>
                                                    <td width="96">
                                                        <input
                                                            data-ref="<?php echo $or["id"]; ?>"
                                                            class="extraCant"
                                                            type="text"
                                                            size="2"
                                                            min="1" 
                                                            value="1" 
                                                            name="extra_c_<?php echo $or["id"]; ?>" 
                                                            id="extra_c_<?php echo $or["id"]; ?>" 
                                                            <?php
                                                            if ($or["unico"] == '1') {
                                                                ?>disabled 
                                                                <?php
                                                            }
                                                            ?>

                                                            />
                                                            <?php
                                                            ?>
                                                    </td>
                                                    <td width="1">
                                                        <span style="font-size:9pt;font-weight:300;text-align: right;" class="label label-invert">&euro; <?php echo $or["valor"]; ?></span>
                                                    </td>
                                                    <td>
                                                        <button 
                                                            type="button"
                                                            class="btn btn-sm btn-danger pull-right" 
                                                            data-toggle="popover" 
                                                            title="<?php echo $label; ?>" 
                                                            data-container="body" 
                                                            data-content="<?php echo $or["caption"]; ?>" 
                                                            data-trigger="focus" 
                                                            placement="right">
                                                            <i class="fa fa-question-circle"></i>
                                                        </button>
                                                        <?php echo $label; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-warning btn-lg btn-block">RESERVAR</button><br/>
                    <div style="padding:8px;text-align:center;">
                        <img src='/images/badge_cdorada.png' width="128" />
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="popover"]').popover();
                            $('.extraCant').blur(function () {
                                calcTotal();
                            });
                            $('.calcExtra').click(function () {
                                calcTotal();
                            });
                            $('#date_in-property').datepicker({
                                dateFormat: 'yy-mm-dd',
                                onClose: function (selectedDate) {
                                    $("#date_out-property").datepicker("option", "minDate", selectedDate);
                                }
                            });
                            $('#date_out-property').datepicker({
                                dateFormat: 'yy-mm-dd'
                            });
                        });
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
                        function checkout() {
                            var total = $('#total').val();
                            var details;
                        }

                        function calcTotal() {
                            var a = parseFloat($('#total').attr('data-value'));
                            var chk = $('.calcExtra');
                            var n = chk.length;
                            var s = 0;
                            for (i = 0; i < n; i++) {
                                if ($(chk[i]).is(':checked')) {
                                    var id = $(chk[i]).attr('data-id');
                                    var u = $(chk[i]).attr('data-unique');
                                    var p = $(chk[i]).val();
                                    var c = 1;
                                    if (u == "0") {
                                        c = parseFloat($('#extra_c_' + id).val());
                                    }
                                    var no = p * c;
                                    s += parseFloat(no);
                                }
                            }
                            a = a + s;
                            $('#total').html(a.toFixed(2));
                            $('#ototal').val(a.toFixed(2));
                        }
                        calcTotal();
                    </script>
                </form>
            </div>
            <div class="col-sm-8">                
                <div id="p-picture" class="container-fluid">
                    <div class="well well-sm">
                        <h4>Forograf&iacute;as</h4>
                        <?php
                        $noq = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='$id'") or die(mysqli_error($CNN));
                        $num = mysqli_num_rows($noq);
                        if ($num > 0) {
                            ?>
                            <div class="banner">
                                <ul>
                                    <?php
                                    while ($or = mysqli_fetch_array($noq)) {
                                        $ref = $or["name"] . "_b.jpg";
                                        $file = 'cms/content/upload/property/' . $ref . ".jpg";
                                        if (file_exists($file)) {
                                            ?>
                                            <li style="background-image: url(<?php echo $file; ?>)"></li>
                                            <?php
                                        }
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
                <div id="p-detail" class="s-extra">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <h4>Informaci&oacute;n Detallada</h4>
                            <?php
                            $see = array('general', 'interior', 'exterior', 'equip');
                            $set = array('General', 'Interior', 'Exterior', 'Equipamiento');
                            foreach ($see as $K => $sea) {
                                $oq = mysqli_query($CNN, "SELECT * from cms_property_e_$sea WHERE pid='$id'");
                                $on = mysqli_num_rows($oq);
                                if ($on > 0) {
                                    ?>
                                    <div class="row">
                                        <b><?php echo $set[$K]; ?></b>
                                        <table class="table table-condensed">
                                            <tr>
                                                <?php
                                                $nox = 1;
                                                while ($or = mysqli_fetch_array($oq)) {
                                                    $label = getData("cms_property_" . $sea, "id", $or["oid"], "name");
                                                    $ot = getData("cms_property_" . $sea, "id", $or["oid"], "tipo");
                                                    $show = true;
                                                    if ($show == true) {
                                                        ?>                                                                                                    
                                                        <td width="1">
                                                            <?php
                                                            if ($ot != "0") {
                                                                echo "<span class=\"label label-invert\">{$or["ovalue"]}</span>";
                                                            } else {
                                                                switch ($or["ovalue"]) {
                                                                    case '0': echo "<i class=\"fa fa-minus-square text-danger\"></i>";
                                                                        break;
                                                                    case '1': echo "<i class=\"fa fa-check-square text-success\"></i>";
                                                                        break;
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $label; ?></td>
                                                        <?php
                                                        if ($nox % 4 == 0) {
                                                            echo "</tr><tr>";
                                                            $nox = 1;
                                                        } else {
                                                            $nox++;
                                                        }
                                                    }
                                                }
                                                ?>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

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