<!-- ##### START HOME -->
<section id="home">
    <?php
    $web->getFeatured();
    ?>
    <div class="main-filter">        
        <div class="filter-content">            
            <form action="./<?php echo $lang; ?>/buscar/" method="POST">
                <table class="table table-condensed table-responsive" style="background:#FFF;">
                    <tr>
                        <td colspan="2">
                            <h4>Buscar Alquiler</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="input-group">
                                <span class="input-group-addon"><img src="images/map_marker.png" /></span>
                                <select id="place" name="place" class="form-control">
                                    <option value="cambrils">Destinos</option>
                                    <option value="cambrils">Cambrils</option>
                                    <option value="la_pineda">La Pineda</option>
                                    <option value="salou">Salou</option>
                                </select>                            
                            </div>               
                        </td>
                    </tr><!-- Destino -->
                    <tr>
                        <td colspan="2">
                            <div class="input-group">
                                <span class="input-group-addon"><img src="images/groups.png" /></span>
                                <select id="group-property" name="group-property" class="form-control">
                                    <option value="0">Personas</option>
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
                    </tr><!-- Grupo -->
                    <tr>
                        <td colspan="2">
                            <div class="input-group">
                                <span class="input-group-addon"><img src="images/home.png" /></span>
                                <select name="tipo-property" id="tipo-property" class="form-control">
                                    <option value="0">Tipo de Alojamiento</option>
                                    <?php
                                    $OQ = mysqli_query($CNN, "SELECT * from property_type");
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
                                <span class="input-group-addon"><img src="images/date_to.png" /></span>
                                <input type="text" id="date_in-property" name="date_in-property" class="form-control" placeholder="<?php echo date('Y-m-d'); ?>" />
                                <span class="input-group-addon"><img src="images/date_from.png" /></span>
                                <input type="text" id="date_out-property" name="date_out-property" class="form-control" placeholder="<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 8, date('Y'))); ?>" />
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
            <form id="frm-ref" action="./" method="POST">
                <div class="input-group">
                    <span class="input-group-addon">Referencia</span>
                    <input type="text" id="ref" name="ref" class="form-control" placeholder="Buscar por referencia..." />
                    <span class="input-group-addon">
                        <a href='#' class="btn btn-warning"><i class="fa fa-search"></i></a>
                    </span>
                </div>
            </form>
        </div>
    </div>
</section>