<div id="fullpage">    
    <section class="section" id="search" style="background-image:url('cms/content/upload/item_000001.jpg')">
        <form action="./<?php echo $lang; ?>/search" method="post" id="F0">
            <div class="container">
                <strong><?php echo $wlang->getString("search", "title"); ?></strong>
                <div class="row" style="background:rgba(255,255,255,0.25) !important;">
                    <div class="col-sm-10">
                        <div class="row">            
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <a href="#" title="<?php echo $wlang->getString("filter", "txt_field_a"); ?>" class="hint"><img src="images/icons/16/door_in.png" /></a>
                                    </span>
                                    <input type="text" id="date_ini" name="date_in" class="form-control" placeholder="<?php echo date("Y-m-d"); ?>" />
                                </div>
                            </div>                                
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <a href="#" title="<?php echo $wlang->getString("filter", "txt_field_b"); ?>" class="hint"><img src="images/icons/16/door_out.png" /></a>
                                    </span>
                                    <input type="text" id="date_end" name="date_end" class="form-control" placeholder="<?php echo date("Y-m-d"); ?>" />
                                </div>
                            </div>                                
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <a href="#" title="<?php echo $wlang->getString("filter", "txt_field_c"); ?>" class="hint"><img src="images/icons/16/group.png" /></a>
                                    </span>
                                    <select id="ocupantes" name="ocupantes" class="form-control">
                                        <?php
                                        for ($i = 1; $i < 16; $i++) {
                                            echo "<option value=\"$i\">$i</option>\n";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <a href="#" title="<?php echo $wlang->getString("filter", "txt_field_d"); ?>" class="hint"><img src="images/icons/16/bed.png" /></a>
                                    </span>
                                    <select id="dormitorios" name="dormitorios" class="form-control">
                                        <?php
                                        for ($i = 1; $i < 6; $i++) {
                                            echo "<option value=\"$i\">$i</option>\n";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>                                
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <a href="#" title="<?php echo $wlang->getString("filter", "txt_field_e"); ?>" class="hint"><img src="images/icons/16/meeting_workspace.png" /></a>
                                    </span>
                                    <select id="capacidad" name="capacidad" class="form-control">
                                        <?php
                                        for ($i = 4; $i < 13; $i++) {
                                            echo "<option value=\"$i\">$i</option>\n";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>                                
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <a href="#" title="<?php echo $wlang->getString("filter", "txt_field_f"); ?>" class="hint"><img src="images/icons/16/map.png" /></a>
                                    </span>
                                    <input type="text" id="locate" name="locate" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('.hint').tooltip({placement: 'top'});
                        $('#date_ini').datepicker({dateFormat: 'yy-mm-dd'});
                        $('#date_end').datepicker({dateFormat: 'yy-mm-dd'});
                    });
                </script>                        
        </form>
        <?php
        print_r($_REQUEST);
        ?>        
    </section>

</div>    