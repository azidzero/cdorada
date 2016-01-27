<!-- ##### START HOME -->
<section id="home">
    <?php
    $web->getFeatured();
    ?>
    <div class="container">
        <div class="main-filter row">        
            <div class="filter-content col-md-4 col-lg-4">            
                <form action="./<?php echo $lang; ?>/search/" method="POST" onsubmit="return checkFilter()">
                    <table class="table table-condensed table-responsive">
                        <tr>
                            <td colspan="2">
                                <h4 style="color:#333;"><i class="fa fa-search"></i> <?php echo $wlang->getString("filter", "title"); ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="input-group">                                    
                                    <select id="place" name="place" class="form-control">
                                        <option value="all"><?php echo $wlang->getString("filter", "default-place"); ?></option>
                                        <?php
                                        $q = mysqli_query($CNN, "SELECT * from cms_property_locale");
                                        while ($r = mysqli_fetch_array($q)) {
                                            ?>
                                            <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>

                                            <?php
                                        }
                                        ?>
                                    </select>                            
                                </div>               
                            </td>
                        </tr><!-- Destino -->
                        <tr>
                            <td colspan="2">
                                <div class="input-group">
                                    <select id="group-property" name="group-property" class="form-control">
                                        <option value="0"><?php echo $wlang->getString("filter", "default-group"); ?></option>
                                        <?php
                                        $group_min = getOption('cms_options', 'group_min');
                                        $group_max = getOption('cms_options', 'group_max');
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
                                    <select name="tipo-property" id="tipo-property" class="form-control">
                                        <option value="0"><?php echo $wlang->getString("filter", "default-type"); ?></option>
                                        <?php
                                        $OQ = mysqli_query($CNN, "SELECT * from cms_property_type");
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
                                    <span style="min-width: 48px;" class="input-group-addon"><i class="fa fa-2x fa-sign-in"></i></span>
                                    <input type="text" id="date_in-property" name="date_in-property" class="form-control" placeholder="<?php echo $wlang->getString("filter", "default-arrival"); ?>" />
                                    <span style="min-width: 48px;" class="input-group-addon"><i class="fa fa-2x fa-sign-out"></i></span>
                                    <input type="text" id="date_out-property" name="date_out-property" class="form-control" placeholder="<?php echo $wlang->getString("filter", "default-departure"); ?>" />
                                </div>                   
                            </td>
                        </tr><!-- Fechas -->                                                    
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-warning btn-lg btn-block">
                                    <?php echo $wlang->getString('filter', 'search-button'); ?>
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
                <form id="frm-ref" action="./<?php echo $lang; ?>/search/?method=ref" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $wlang->getString("filter", "label-ref"); ?></span>
                        <input type="text" id="ref" name="ref" class="form-control" placeholder="<?php echo $wlang->getString("filter", "hint-ref"); ?>" />
                        <span class="input-group-addon">
                            <a href='#' class="btn btn-warning"><i class="fa fa-search"></i></a>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-md-8 col-lg-8"></div>
        </div>
    </div>
</section>
<script>
    
    $(document).ready(function () {
        var today = new Date();
        $('#date_in-property').datepicker({
            minDate: 0,
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 3,
            showButtonPanel: true,
            onSelect: function () {
                var d = $('#date_in-property').val();
                var dox = new Date(d);
                var de = dox.addDays(7);
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
</script>