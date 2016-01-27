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
    cms_property.dorm, 
    cms_property.bano,     
    cms_property.hutt,     
    cms_property.link youtube,     
    cms_property.localidad,     
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
$sql .= " AND cms_property_type.id = cms_property.tipo \n";
$sql .= " AND cms_property.id='$id'";
$q = mysqli_query($CNN, $sql) or die(mysqli_error($CNN));
// # Disponible??
while ($r = mysqli_fetch_array($q)) {
    /*
     * Prize
     */
    $oSQL = "SELECT crs_rates_use.pid, crs_rates_detail.* FROM crs_rates_detail 
                    INNER JOIN crs_rates_use ON crs_rates_detail.rid = crs_rates_use.rid
                    WHERE crs_rates_use.pid = '{$r["id"]}' AND '$dini' 
                        BETWEEN crs_rates_detail.date_ini AND crs_rates_detail.date_end order by crs_rates_detail.diario";
    $oq = mysqli_query($CNN, $oSQL) or die(mysqli_error());
    $on = mysqli_num_rows($oq);
    if ($on > 0) {
        while ($or = mysqli_fetch_array($oq)) {
            $prize = $or["diario"];
        }
    } else {
        $prize = 0;
    }
    echo "<h4>$oSQL</h4>";
    $str_long = getData('cms_property_translate', array('pid', 'cname', 'lang'), array($id, 'rent-large', $lang), 'caption');
    ?>
    <div id="main_more" class="container-fluid">
        <?php
        $sq = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='$id' limit 1");
        $sn = mysqli_num_rows($sq);
        if ($sn > 0) {
            ?>
            <div class="row-fluid">
                <?php
                while ($sr = mysqli_fetch_array($sq)) {
                    $file = "cms/content/upload/property/{$sr['name']}_m.jpg";
                    ?>
                    <div style="position: relative;;background-size:cover;height:320px;background-image: url('<?php echo $file; ?>')">
                        <small class="label label-danger pull-right">
                            <span style="font-weight: 300;">REFERENCIA: </span>
                            <?php echo $r["hutt"]; ?>
                        </small>
                        <h3 style="padding:8px;position: absolute;bottom: 0px;width:100%;color:#FFF;background:rgba(0,0,0,0.75)">
                            <?php echo $r["propiedad"]; ?>
                        </h3>
                    </div>
                    <?php
                }
                ?>
            </div><!-- HEADER -->           
            <?php
        } else {
            
        }
        ?>

        <div class="row-fluid">            
            <div class="col-sm-8">                
                <div id="p-picture" class="container-fluid">
                    <?php
                    include('gallery.more.php');
                    ?>
                </div><!-- IMAGES -->
                <div class="container-fluid">
                    <p><?php echo $str_long; ?></p>
                </div>
                <div id="p-detail" class="s-extra">
                    <?php
                    include('addon.more.php');
                    ?>
                </div><!-- Add on -->
                <div id="p-available">
                    <?php
                    include("calendar.more.php");
                    ?>
                </div><!-- Availability -->
                <div id="p-map">

                </div><!-- Map -->
                <script>
                    function re() {
                        $('section').css('min-height', z + 'px');
                    }
                    $('section').css('min-height', $(window).height() + 'px');
                    $(window).resize(function () {
                        //re();
                    });
                    //re();
                    $(document).ready(function () {
                        z = $(window).height();
                        $('#p-picture').css('min-height', (z - 210) + 'px');
                        $('.banner ul li').css('min-height', (z - 210) + 'px');
                        /*
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
                         */
                    });
                </script>

            </div>
            <div id="reserva-detail" class="col-sm-4">              
                <form target="_blank" action="./<?php echo $lang; ?>/reservar/start" method="POST" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" name="pid"  value="<?php echo $id; ?>" />
                    <div style="padding:4px;margin:4px;border:1px solid #CCC;">
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
                                $precio = $prize;
                                ?> <?php echo $wlang->getString("moreinfo", "str-night"); ?>
                            </small>
                            <small class="pull-left label label-warning" style="font-size: 8pt;margin:0px;">
                                <?php echo $wlang->getString("moreinfo", "str-prize"); ?>
                            </small>
                            <br/>
                            &euro; <span id="total" data-value="<?php echo ($precio); ?>"><?php echo ($precio); ?></span>
                        </h3>
                        <input type="hidden" id="ptotal" name="ptotal" value="<?php echo number_format($precio, 2); ?>" />
                        <input type="hidden" id="ototal" name="ototal" value="0.00" />
                    </div>
                    <button type="submit" class="btn btn-warning btn-lg btn-block"><?php echo $wlang->getString("moreinfo", "str-book"); ?></button><br/>
                    <div class="row-fluid">                                                
                        <div>
                            <?php
                            print_r($r);
                            ?>
                            <table class="table table-condensed" style="background:#FFF;font-size:9pt;">                                   
                                <tr>
                                    <td><img src="images/home_bed.png" /> <?php echo $wlang->getString("moreinfo", "str-room"); ?>: <b><?php echo $r["dorm"]; ?></b></td>
                                    <td><img src="images/home_users.png" /> <?php echo $wlang->getString("moreinfo", "str-people"); ?>: <b><?php echo $r["capacity"]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><img src="images/home_type.png" /> <?php echo $wlang->getString("moreinfo", "str-type"); ?>: <b><?php echo $r["tipo_h"]; ?></b></td>                                                                                        
                                    <td><img src="images/map_marker.png" /> <?php echo $wlang->getString("moreinfo", "str-locale"); ?>: <b><?php echo $r["lugar"]; ?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>                                    
                    <p><b><?php echo $wlang->getString("moreinfo", "check-a"); ?></b></p>
                    <div class="input-group">                                
                        <span class="input-group-addon"><img width="24" src="images/date_to.png" /></span>
                        <input type="text" id="date_in-property" name="date_in-property" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" value="<?php echo $dini; ?>" />
                        <span class="input-group-addon"><img width="24" src="images/date_from.png" /></span>
                        <input type="text" id="date_out-property" name="date_out-property" class="form-control" placeholder="<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 8, date('Y'))); ?>" value="<?php echo $dend; ?>" />
                    </div>
                    <hr noshade />
                    <div style="border:1px solid #CCC;background:#CCC;">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#reserva-people" aria-controls="reserva-people" role="tab" data-toggle="tab">Ocupantes</a></li>
                            <li role="presentation"><a href="#reserva-addon" aria-controls="reserva-addon" role="tab" data-toggle="tab">Complementos</a></li>
                        </ul>                    
                        <!-- Tab panes -->
                        <div class="tab-content" style="background:#FFF;">
                            <div role="tabpanel" class="tab-pane active" id="reserva-people">
                                <table class="table table-condensed">
                                    <tr>
                                        <td width="1">
                                            <img src="images/filter_adult.png" />
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button onclick="minus('no_adult')" type="button" class="btn btn-warning btn-default">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </span>
                                                <input size="4" type="text" id="no_adult" min="1" max="" name="no_adult" class="form-control" placeholder="Adultos" value="1" />
                                                <span class="input-group-btn">
                                                    <button onclick="plus('no_adult')" type="button" class="btn btn-warning btn-default">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        <td width="1">
                                            <img src="images/filter_child.png" />
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button onclick="minus('no_kid')" type="button" class="btn btn-warning btn-lg btn-default">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </span>
                                                <input size="4" type="text" id="no_kid" name="no_kid" class="form-control" placeholder="Ni&ntilde;os" value="0" />
                                                <span class="input-group-btn">
                                                    <button onclick="plus('no_kid')" type="button" class="btn btn-warning btn-lg btn-default">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>                                
                            </div>                       
                            <div role="tabpanel" class="tab-pane" id="reserva-addon">
                                <div class="container-fluid">
                                    <?php
                                    // cms_property_extra
                                    $oq = mysqli_query($CNN, "SELECT * from cms_property_extra");
                                    $on = mysqli_num_rows($oq);
                                    if ($on > 0) {
                                        ?>
                                        <div class="row-fluid">
                                            <!-- <b><?php echo $wlang->getString("moreinfo", "str-addon"); ?></b> -->
                                            <table class="table table-condensed" style="font-size:8pt;">
                                                <?php
                                                while ($or = mysqli_fetch_array($oq)) {
                                                    if ($lang == "es") {
                                                        $label = $or["name"];
                                                        $desc = $or["common"];
                                                    } else {

                                                        $label = getData("cms_property_extra_translate", array('eid', 'lang', 'camp'), array($or["id"], $lang, 'newname'), 'caption');
                                                        $desc = getData("cms_property_extra_translate", array('eid', 'lang', 'camp'), array($or["id"], $lang, 'descextra'), 'caption');
                                                    }
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
                                                                <?php ?>
                                                        </td>
                                                        <td width="1">
                                                            <span style="font-size:9pt;font-weight:300;text-align: right;" class="label label-invert"><i class="fa fa-euro"></i> <?php echo $or["valor"]; ?></span>
                                                        </td>
                                                        <td>
                                                            <button 
                                                                type="button"
                                                                class="btn btn-sm btn-danger pull-right" 
                                                                data-toggle="popover" 
                                                                title="<?php echo $label; ?>" 
                                                                data-container="body" 
                                                                data-content="<?php echo $desc; ?>" 
                                                                data-trigger="focus" 
                                                                placement="right">
                                                                <i class="fa fa-question-circle"></i>
                                                            </button>
                                                            <?php echo $label; ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                $nox = 1;
                                                while ($or = mysqli_fetch_array($oq)) {
                                                    $label = $or["name"];
                                                    $ot = getData("cms_property_extra", "id", $or["oid"], "tipo");
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
                                                                    <?php ?>
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
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

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
        </div>
        <script>
            $('#modalMore').scroll(function (e) {
                var a = parseInt($(this).scrollTop());
                if (a > 380) {
                    $('#reserva-detail').addClass('fixed-reserva');
                    $('#reserva-detail').css('top', (a - 32) + 'px');
                } else {
                    $('#reserva-detail').removeClass('fixed-reserva');
                    $('#reserva-detail').css('top', 'auto');
                }
            });
        </script>
        <?php ?>
    </div>
    <?php
}
?>