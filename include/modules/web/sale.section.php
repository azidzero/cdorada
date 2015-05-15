<section id="sale" style="background-image:url('cms/content/upload/item_000003.jpg');">
    <div class="container">
        <h3><a onclick="pushMenu('sale')" href="javascript:void(0)"><i class="fa fa-bars"></i></a> VENTA</h3>
    </div>
    <div id="filter-sale" class="pushmenu">
        <div class="panel">
            <div class="panel-heading">
                <a onclick="pushMenu('sale')" class="btn btn-default btn-sm pull-right" href="javascript:void(0)"><i class="fa fa-times fa-2x"></i></a>
                <h4 class="panel-title">Filtrar</h4>
            </div>
            <div class="panel-body">
                <table class="table table-condensed table-responsive">
                    <tr>
                        <td colspan="2">
                            <p style="font-weight: 300;">
                                <input type="checkbox"  id="useRange-sale" name="useRange-sale" value="1" onclick="chkSlider('sale')" />
                                <label for="range-sale">Rango:</label>
                                <input type="text" id="range-sale" readonly style="border:0; color:#f6931f; font-weight:bold;">
                            </p>
                            <div id="slider-range-sale"></div>
                            <script>
                                $(function () {
                                    $("#slider-range-sale").slider({
                                        range: true,
                                        min: 0,
                                        max: 10000,
                                        disabled: true,
                                        values: [2500, 7500],
                                        slide: function (event, ui) {
                                            $("#range-sale").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                                        }
                                    });
                                    $("#range-sale").val("$" + $("#slider-range-sale").slider("values", 0) + " - $" + $("#slider-range-sale").slider("values", 1));
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="input-group">
                                <span class="input-group-addon"><input onclick="chkDates('sale')" type="checkbox" id="useDates-sale" name="useDates-sale" value="1" /></span>
                                <span class="input-group-addon"><img src="images/date_from.png" /></span>
                                <input disabled="disabled" type="text" id="date_in-sale" name="date_in-sale" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" />
                                <span class="input-group-addon"><img src="images/date_to.png" /></span>
                                <input disabled="disabled" type="text" id="date_out-sale" name="date_out-sale" class="form-control" />
                            </div>                   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="images/groups.png" /></span>
                                <select id="group-sale" name="group-sale" class="form-control">
                                    <option value="0">TODOS</option>
                                </select>
                            </div>                 
                        </td>            
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon"><img src="images/home.png" /></span>
                                <select name="tipo-sale" id="tipo-sale" class="form-control">
                                    <option value="0">Todo</option>
                                    <option value="6">Casa adosada</option>
                                    <option value="1">Apartamento</option>
                                    <option value="13">Otro</option>
                                    <option value="22">D&uacute;plex</option>
                                    <option value="7">Piso</option>
                                    <option value="2">Chalet</option>
                                    <option value="10">Atico</option>
                                    <option value="5">Estudio</option>
                                    <option value="17">Casa</option>
                                </select>
                            </div>                
                        </td>
                    </tr>                    
                    <tr>
                        <td colspan="2">
                            <div class="input-group">
                                <span class="input-group-addon"><img src="images/map_marker.png" /></span>
                                <input type="text" id="place-sale" name="place-sale" class="form-control" placeholder="Salou" />
                                <span class="input-group-addon">
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="$('#place-sale').val('')"><i class="fa fa-times"></i></a>
                                </span>
                            </div>               
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" class="btn btn-default" onclick="doSearch('sale');
                                    pushMenu('sale')">Buscar</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>  
    <h3>RESULTADOS</h3>
    <div id="result-sale" class="container-fluid strip_roll">

    </div>
</section><!-- RENT -->
<div id="" class="">
    <div id="" class="">

    </div>
</div>
<script>
    $(document).ready(function () {
        $('#date_in-sale').datepicker({dateFormat: 'yy-mm-dd'});
        $('#date_out-sale').datepicker({dateFormat: 'yy-mm-dd'});
    });   
    doSearch('sale');    
</script>