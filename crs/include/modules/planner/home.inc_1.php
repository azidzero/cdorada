<?php
/*
 * DEMO
 */
$mini = date('m');
$yini = date('Y');
$dini = new DateTime(date("Y") . '-01-01');
$dend = $dini->add(new DateInterval('P365D'));
$view = 12;
$etot = $dend->format('t');
$limit = 25;
?>
<div class="plan_main">
    <input type="hidden" id="page" name="page" value="1" />
    <table class=" table table-condensed">        
        <tbody>
            <tr>
                <td valign="top" align="left" style="width:20%;position: relative;">                    
                    <div class="pro_res_body">
                        <table class="tbl-pro" width="100%" style="position: absolute;z-index: 998;">
                            <thead>
                                <tr>
                                    <td colspan="3">&nbsp;</td>                                
                                </tr>
                                <tr>
                                    <td>PROPIEDAD</td>
                                    <td>H</td>
                                    <td>C</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $q = mysqli_query($CNN, "SELECT * from cms_property limit $limit");
                                while ($r = mysqli_fetch_array($q)) {
                                    ?>
                                    <tr data-pid="<?php echo $r["id"]; ?>">
                                        <td style="text-align: left;"><?php echo $r["title"]; ?></td>
                                        <td width="1"><?php echo $r["dorm"]; ?></td>
                                        <td width="1"><?php echo $r["capacity"]; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table><!-- property List -->
                    </div>
                    <div style="width:200px;">&nbsp; </div>
                </td>
                <td valign="top" align="left" style="width: 80%;position: relative;">
                    <div class="plan_res_body">
                        <?php
                        $tm = $dini->format('m') + $view;
                        $q = mysqli_query($CNN, "SELECT * from cms_property limit $limit") or die(mysqli_error($CNN));
                        $tw = 0;
                        for ($k = 0; $k < $view; $k++) {
                            $td = date("t", mktime(0, 0, 0, $dini->format('m') + $k, 1, $yini));
                            $td = $td * 24;
                            $tw += $td;
                        }
                        ?>
                        <div class="plan_res_row" style="width:<?php echo $tw; ?>px">
                            <?php
                            for ($k = 0; $k < $view; $k++) {
                                $td = date("t", mktime(0, 0, 0, $dini->format('m') + $k, 1, $yini));
                                $cw = $td * 24;
                                $str = date("M", mktime(0, 0, 0, $dini->format('m') + $k, 1, $yini));
                                ?> 
                                <div class="plan_res_col plan_res_hdr" style="width:<?php echo $cw; ?>px">
                                    <?php echo $str; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="plan_res_row">
                            <?php
                            $x = 0;
                            for ($k = 0; $k < $view; $k++) {
                                $td = date("t", mktime(0, 0, 0, $dini->format('m') + $k, 1, $yini));
                                for ($i = 1; $i < $td + 1; $i++) {
                                    $w = date("w", mktime(0, 0, 0, $dini->format('m') + $k, $i, $yini));
                                    $wcss = "";
                                    if ($w == 0 || $w == 6) {
                                        $wcss = "plan_res_w";
                                    }
                                    if ($i == $td) {
                                        $wcss .=" plan_res_me";
                                    }
                                    ?>
                                    <div 
                                        data-pid="<?php echo $r["id"]; ?>" 
                                        data-x="<?php echo $x; ?>" 
                                        class="plan_res_col <?php echo $wcss; ?>">
                                            <?php echo $i; ?>
                                    </div>
                                    <?php
                                    $x+=24;
                                }
                            }
                            ?>
                        </div>
                        <?php
                        while ($r = mysqli_fetch_array($q)) {
                            ?>
                            <div data-pid="<?php echo $r["id"]; ?>" class="plan_res_row" style="width:<?php echo $tw; ?>px">
                                <?php
                                $x = 0;
                                for ($k = 0; $k < $view; $k++) {
                                    $td = date("t", mktime(0, 0, 0, $mini + $k, 1, $yini));

                                    for ($i = 1; $i < $td + 1; $i++) {
                                        $w = date("w", mktime(0, 0, 0, $mini + $k, $i, $yini));
                                        $datex = date("Y-m-d", mktime(0, 0, 0, $mini + $i, 1, $yini));
                                        $wcss = "";
                                        if ($w == 0 || $w == 6) {
                                            $wcss = "plan_res_w";
                                        }
                                        if ($i == $td) {
                                            $wcss .=" plan_res_me";
                                        }
                                        ?>
                                        <div 
                                            data-pid="<?php echo $r["id"]; ?>" 
                                            data-x="<?php echo $x; ?>" 
                                            data-date="<?php echo $datex; ?>" 
                                            class="plan_res_col <?php echo $wcss; ?>">&nbsp;</div>
                                            <?php
                                            $x+=24;
                                        }
                                    }
                                    /*
                                     * Reservaciones Existentes
                                     */
                                    $rSQL = "SELECT * FROM crs_reserva WHERE 
                                    pid='{$r["id"]}' AND ini<'$dini' AND crs_reserva.end<'$dend'
                                    OR pid='{$r["id"]}' AND ini>='$dini' AND END<='$dend'
                                    OR pid='{$r["id"]}' AND ini<'$dend'";
                                    $rq = mysqli_query($CNN, $rSQL);
                                    while ($rr = mysqli_fetch_array($rq)) {
                                        $ox = new DateTime($rr["ini"]);
                                        $x = intval($ox->format("z")) * 24;
                                        $oxx = new DateTime($rr["end"]);
                                        $xx = intval($oxx->format("z")) * 24;
                                        $rnda = rand(0, 2);
                                        switch ($rnda) {
                                            case 0:$ocss = 'res_stats_free';
                                                break;
                                            case 1:$ocss = 'res_status_pend';
                                                break;
                                            case 2:$ocss = 'res_status_conf';
                                                break;
                                        }
                                        ?>
                                    <div class="res_block" style="left: <?php echo $x; ?>px;width:<?php echo $xx; ?>px;">
                                        <!-- <a class="btn btn-xs btn-primary pull-right" href="javascript:void(0)">&times;</a> -->
                                        <div class="btn-group btn-group-xs">
                                            <a data-toggle="tooltip" data-placement="bottom" title="Origen de la reservacion" class="btn btn-primary"><i class="fa fa-globe"></i></a>
                                            <a data-toggle="tooltip" data-placement="bottom" title="Detalles de Reserva"  class="btn btn-info"><i class="fa fa-eye"></i></a>
                                            <a data-toggle="tooltip" data-placement="bottom" title="Cancelar"  class="btn btn-danger"><i class="fa fa-times"></i></a>
                                        </div>
                                        <div class="res_status <?php echo $ocss; ?>"></div>

                                        <div class="res_bstatus"></div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>                    
                    </div>                    
                </td>
            </tr>
        </tbody>
    </table>
</div><!-- ##### -->
<div id="diag-reserva" class="modal fade">
    <div style="width: 70%;" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reservar</h4>
            </div>
            <div class="modal-body" id="diag-content"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade bs-example-modal-sm" id="multimodal" style="z-index: 9999992;"tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm ">
        <div class="modal-content bg-info" id="body-multimodal" style="padding: 2%;">
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="modalcusto" style="z-index: 9999993;" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="body-cus" style="padding: 2%;">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Agregar Cliente</b></div>
                <div class="panel-body">
                    <form id="frmcus" name="frmcus">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre:</label>
                                    <input type="text" class="form-control" id="c_name" name="c_name" placeholder="NOMBRE" tabindex="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Apellido Paterno:</label>
                                    <input type="text" class="form-control" id="c_name" name="c_ap" placeholder="PATERNO"  tabindex="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Apellido Materno:</label>
                                    <input type="text" class="form-control" id="c_name" name="c_am"placeholder="MATERNO"  tabindex="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">DNI:</label>
                                    <input type="text" class="form-control" id="c_dni" name="c_dni" placeholder="DNI"  tabindex="">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Direcci&oacute;n:</label>
                                    <input type="text" class="form-control" id="c_dire" name="c_dire" placeholder="DIRECCION" tabindex="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Codigo Postal:</label>
                                    <input type="text" class="form-control" id="c_cp" name="c_cp" placeholder="CODIGO POSTAL" tabindex="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Localidad:</label>
                                    <input type="text" class="form-control" id="c_loc" name="c_loc" placeholder="LOCALIDAD"  tabindex="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pa&iacute;s:</label>
                                    <input type="text" class="form-control" id="c_pai" name="c_pai" placeholder="PA&Iacute;S"  tabindex="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tel&eacute;fono:</label>
                                    <input type="text" class="form-control" id="c_tel" name="c_tel" placeholder="TEL&Eacute;FONO" tabindex="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email:</label>
                                    <input type="email" class="form-control" id="c_email" name="c_email" placeholder="EMAIL" tabindex="">
                                </div>
                            </div>
                            <input type="text" id="op" name="op" class="hidden" value="2">
                            <div class="col-lg-12 text-right">
                                <a href="javascript:void(0);" class="btn btn-warning" alt="Cancelar" title="Cancelar" onclick="$('#modalcusto').modal('hide');">Cancelar</a>
                                <a href="javascript:void(0)" class="btn btn-success" alt="Guardar" title="Guardar" onclick="savecus();">Guardar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('a.btn').tooltip();
        $('#loading').fadeOut();
        $('.tbl-main tbody').scroll(function () {
            var a = parseInt($(this).scrollTop());
            var b = parseInt($(this)[0].scrollHeight);
            a = a + 360;
            console.log(a + " - " + b);
            // if (a > b) {
            //     loadMore();
            // }
        });
        $('.plan_res_col').click(function () {
            var x = $(this).attr('data-x');
            var pid = $(this).attr('data-pid');
            var fecha = $(this).attr('data-date');
            newBook(x, pid, fecha);
        });
        $('.tbl-pro tbody tr').mouseover(function () {
            var a = $(this).attr('data-pid');
            $(this).addClass('hover');
            $('.plan_res_row[data-pid=' + a + ']').addClass('hover');
        });
        $('.tbl-pro tbody tr').mouseout(function () {
            var a = $(this).attr('data-pid');
            $(this).removeClass('hover');
            $('.plan_res_row[data-pid=' + a + ']').removeClass('hover');
        });
        $('.plan_res_col').mouseover(function () {
            var a = $(this).parent().attr('data-pid');
            $(this).parent().addClass('hover');
            $('tr[data-pid=' + a + ']').addClass('hover');
        });
        $('.plan_res_col').mouseout(function () {
            var a = $(this).parent().attr('data-pid');
            $(this).parent().removeClass('hover');
            $('tr[data-pid=' + a + ']').removeClass('hover');
        });
    });
    function loadMore() {
        var a = $('#page').val();
        $.ajax({
            method: 'POST',
            url: 'include/modules/planner/grid.planner.php',
            data: {'page': a},
            dataType: 'JSON'
        }).done(function (res) {
            var pro = res.pro;
            var n = pro.length;
            for (i = 0; i < n; i++) {
                var htm = "<tr data-pid=\"" + pro[i].id + "\">";
                htm += "<td>" + pro[i].title + "</td>";
                htm += "<td>" + pro[i].room + "</td>";
                htm += "<td>" + pro[i].capacity + "</td>";
                htm += "</tr>";
                $('.tbl-pro tbody').append(htm);
            }
            var grid = res.grid;
        });
    }
    $(document).ready(function () {
        var a = $(window).height() - 96;
        $('.plan_res_body').height(a).css('overflow-y', 'scroll');
        $('.pro_res_body').height(a).css('overflow-y', 'scroll');
        console.log($(window).width());
        console.log($(window).height());
    });

    function newBook(x, pid, fecha) {
        // var w = 24;
        // var state = "res_stats_free";
        // var html = "<div class=\"res_block\" style=\"left: " + x + "px;width:" + w + "px;\">";
        // html += "<!-- <a class=\"btn btn-xs btn-primary pull-right\" href=\"javascript:void(0)\"><i class=\"fa fa-times\"></i></a> -->";
                //         html += "<div class=\"res_status " + state + "\"></div>&nbsp;";
                //         html += "<div class=\"res_bstatus\"></div>";
                //         html += "</div>";
                //         $('div.plan_res_row[data-pid=' + pid + "]").append(html);
                $.ajax({
                    method: "POST",
                    url: "include/modules/planner/reserva.ajax.php",
                    data: {"pid": pid, "fecha": fecha}
                }).done(function (msg) {
                    $('#diag-content').html(msg);
                    $('#diag-reserva').modal("show");
                });
            }

</script>
