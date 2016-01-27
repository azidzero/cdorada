<?php
/*
 * DEMO
 */
$mini = date('m');
$yini = date('Y');
$dini = new DateTime(date("Y") . '-01-01');

$dend = new DateTime($dini->format('Y-m-d'));
$dend = $dend->add(new DateInterval('P365D'));
$view = 12;
$etot = $dend->format('t');
$limit = 25;
?>
<div class="row" style="padding:8px;background:#FFF;border-bottom: 1px solid #999;">
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon">
                <input type="checkbox" id="filter_a" name="filter_a" value="1" /><i class="fa fa-map-marker"></i>
            </span>
            <select class="form-control" id="data_a" name="data_a">
                <?php
                $fq = mysqli_query($CNN, "SELECT * from cms_property_locale where parent=0");
                while ($fr = mysqli_fetch_array($fq)) {
                    echo "<option value=\"{$fr["id"]}\">{$fr["name"]}</option>";
                }
                ?>
            </select>
        </div>        
    </div>
    <div class="col-sm-3">
        <div class="input-group">
            <span class="input-group-addon">
                <input type="checkbox" id="filter_b" name="filter_b" value="1" /><i class="fa fa-building"></i>
            </span>
            <select class="form-control" id="data_b" name="data_b">
                <?php
                $fq = mysqli_query($CNN, "SELECT * from cms_property_type");
                while ($fr = mysqli_fetch_array($fq)) {
                    echo "<option value=\"{$fr["id"]}\">{$fr["name"]}</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-sm-1">
        <div class="input-group">
            <span class="input-group-addon">
                <input type="checkbox" id="filter_c" name="filter_c" value="1" />
            </span>
            <select class="form-control" id="data_c" name="data_c">                
                <?php
                
                for($x=1;$x<8;$x++){
                    echo "<option value=\"$x\">$x</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <input class="form-control" type="text" id="sf" name="sf" placeholder="Buscar por Termino" />
    </div>        
    <div class="col-sm-2">
        <button type="button" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Filtrar</button>
    </div>
</div>
<div class="plan_main">
    <input type="hidden" id="page" name="page" value="1" />
    <table id="table_main" class=" table table-condensed" width="100%">
        <thead>
            <tr>
                <td width="25%" valign="top" align="left" >
                    <div>
                        <table class="tbl-pro" width="100%">
                            <thead>
                                <tr>
                                    <td colspan="3">&nbsp;</td>                                
                                </tr>
                                <tr>
                                    <td>PROPIEDAD</td>
                                    <td width="24">H</td>
                                    <td width="24">C</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </td>
                <td width="75%">
                    <div class="hdr_calendar">
                        <table class="table-pro" width="100%">
                            <thead>
                                <tr>
                                    <?php
                                    $ka = new DateTime($dini->format('Y-m-d'));
                                    for ($i = $dini->format('m'); $i < $dini->format('m') + $view; $i++) {
                                        $t = $ka->format('t');
                                        $w = $t * 24;
                                        if ($i % 2 == 0) {
                                            echo "<td class=\"mopar\" colspan=\"$t\">";
                                        } else {
                                            echo "<td colspan=\"$t\">";
                                        }
                                        echo $ka->format('M');
                                        echo "</td>";
                                        $ka = $ka->add(new DateInterval('P1M'));
                                    }
                                    ?>                                    
                                </tr>
                                <tr>
                                    <?php
                                    $ka = new DateTime($dini->format('Y-m-d'));
                                    for ($i = $dini->format('m'); $i < $dini->format('m') + $view; $i++) {
                                        $t = $ka->format('t');
                                        for ($j = 1; $j < $t + 1; $j++) {
                                            $tmp = $ka->format('Y-m-d');
                                            echo "<td data-date=\"$tmp\">";
                                            echo $ka->format('d');
                                            echo "</td>";
                                            $ka = $ka->add(new DateInterval('P1D'));
                                        }
                                    }
                                    ?>   
                                </tr>
                            </thead>
                        </table>
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td valign="top" align="left" style="width:25%;position: relative;">                    
                    <div class="pro_res_body">
                        <table class="tbl-pro" width="100%">                            
                            <tbody>
                                <?php
                                $q = mysqli_query($CNN, "SELECT * from cms_property limit $limit");
                                while ($r = mysqli_fetch_array($q)) {
                                    ?>
                                    <tr data-pid="<?php echo $r["id"]; ?>">
                                        <td style="text-align: left;"><?php echo $r["title"]; ?></td>
                                        <td width="24"><?php echo $r["dorm"]; ?></td>
                                        <td width="24"><?php echo $r["capacity"]; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table><!-- property List -->
                    </div>
                </td>
                <td valign="top" align="left" style="width: 75%;position: relative;">
                    <div class="plan_res_body">
                        <table class="tbl-pro" width="100%">                            
                            <tbody>
                                <?php
                                $q = mysqli_query($CNN, "SELECT * from cms_property limit $limit");
                                while ($r = mysqli_fetch_array($q)) {
                                    $x = 0;
                                    ?>
                                    <tr class="plan_res_row" data-pid="<?php echo $r["id"]; ?>">
                                        <?php
                                        $ka = new DateTime($dini->format('Y-m-d'));
                                        for ($i = $dini->format('m'); $i < $dini->format('m') + $view; $i++) {
                                            $t = $ka->format('t');
                                            for ($j = 1; $j < $t + 1; $j++) {
                                                $adate = $ka->format('Y-m-d');
                                                $weekday = $ka->format('w');
                                                if ($weekday == "6" || $weekday == '0') {
                                                    $wcss = "plan_res_w";
                                                } else {
                                                    $wcss = "";
                                                }
                                                ?>
                                                <td class="plan_res_col <?php echo $wcss; ?>" data-pid="<?php echo $r["id"]; ?>" data-date="<?php echo $adate; ?>" data-x="<?php echo $x; ?>">&nbsp;</td>
                                                <?php
                                                $ka = $ka->add(new DateInterval('P1D'));
                                                $x+=24;
                                            }
                                        }
                                        ?>   
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
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
        $("a.btn").tooltip();
        $("#loading").fadeOut();
        $('.pro_res_body').on('scroll', function () {
            var a = $(this).scrollTop();
            $('.plan_res_body').scrollTop(a);
        });
        $('.plan_res_body').on('scroll', function () {
            var a = $(this).scrollTop();
            var x = $(this).scrollLeft();
            $('.pro_res_body').scrollTop(a);
            $('.hdr_calendar').scrollLeft(x);
        });
        $('.hdr_calendar').on('scroll', function () {
            var x = $(this).scrollLeft();
            $('.plan_res_body').scrollLeft(x);
        });
        $('.tbl-main tbody').scroll(function () {
            var a = parseInt($(this).scrollTop());
            var b = parseInt($(this)[0].scrollHeight);
            a = a + 360;
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
        /*
         * Drag and Drop Dates
         */

        $('.tbl-pro tbody tr td').mouseover(function () {
            var x = $(this).attr('data-date');
            var y = $('.hdr_calendar .table-pro thead tr td[data-date=' + x + ']').html();
            $('.hdr_calendar .table-pro thead tr td[data-date=' + x + ']').addClass('hover');
        });
        $('.tbl-pro tbody tr td').mouseout(function () {
            var x = $(this).attr('data-date');
            $('.hdr_calendar .table-pro thead tr td[data-date=' + x + ']').removeClass('hover');
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
        res();
    });

    $(window).on('resize', function () {
        res();
    });

</script>
