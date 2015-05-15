<div id="filter-rent" class="pushmenu">
    <div class="panel">
        <div class="panel-heading">
            <a onclick="pushMenu('rent')" class="btn btn-warning btn-sm pull-right" href="javascript:void(0)"><i class="fa fa-times fa-2x"></i></a>
            <h4 class="panel-title"><?php echo $wlang->getString('filter', 'title'); ?></h4>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-responsive">
                <tr>
                    <td colspan="2">
                        <p style="font-weight: 300;">
                            <input type="checkbox"  id="useRange-rent" name="useRange-rent" value="1" onclick="chkSlider('rent')" />
                            <label for="range-rent"><?php echo $wlang->getString('filter', 'range'); ?>:</label>
                            <input type="text" id="range-rent" readonly style="border:0; color:#f6931f; font-weight:bold;">
                        </p>
                        <div id="slider-range-rent"></div>
                        <script>
                            $(function () {
                                $("#slider-range-rent").slider({
                                    range: true,
                                    min: 0,
                                    max: 10000,
                                    disabled: true,
                                    values: [2500, 7500],
                                    slide: function (event, ui) {
                                        $("#range-rent").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                                    }
                                });
                                $("#range-rent").val("$" + $("#slider-range-rent").slider("values", 0) + " - $" + $("#slider-range-rent").slider("values", 1));
                            });
                        </script>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="input-group">                                
                            <span class="input-group-addon"><img src="images/date_from.png" /></span>
                            <input type="text" id="date_in-rent" name="date_in-rent" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" />
                            <span class="input-group-addon"><img src="images/date_to.png" /></span>
                            <input type="text" id="date_out-rent" name="date_out-rent" class="form-control" placeholder="<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 8, date('Y'))); ?>" />
                        </div>                   
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon"><img src="images/groups.png" /></span>
                            <select id="group-rent" name="group-rent" class="form-control">
                                <option value="0">TODOS</option>
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
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon"><img src="images/home.png" /></span>
                            <select name="tipo-rent" id="tipo-rent" class="form-control">
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
                            <input type="text" id="place-rent" name="place-rent" class="form-control" placeholder="Salou" />
                            <span class="input-group-addon">
                                <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="$('#place-rent').val('')"><i class="fa fa-times"></i></a>
                            </span>
                        </div>               
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" class="btn btn-default" onclick="doSearch('rent');
                                pushMenu('rent')"><?php echo $wlang->getString('filter', 'search-button'); ?>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<section id="rent" style="background-image:none;background-color: #ECF0F1;">
    <div class="container">        
        <h3 style="display: inline-block">
            <a onclick="pushMenu('rent')" href="javascript:void(0)"><i class="fa fa-bars"></i></a> 
            <?php echo $wlang->getString('rent', 'name'); ?>
        </h3>            
    </div>
    <div id="result-rent" class="container-fluid strip_roll"></div>
    <div id="result-map" class="container-fluid strip_roll"></div>
</section><!-- RENT -->
<div class="section"></div>
<script>
    $(document).ready(function () {
        $('#date_in-rent').datepicker({dateFormat: 'yy-mm-dd'});
        $('#date_out-rent').datepicker({dateFormat: 'yy-mm-dd'});
    });
    doSearch('rent');
</script>