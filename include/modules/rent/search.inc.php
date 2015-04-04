<section>
    <div class="container">
        <form action="<?php echo $lang;?>/<?php echo $m;?>/search">
        <div class="row">
            <div class="col-sm-2">                
                <div class="input-group">
                    <span class="input-group-addon">
                        <a class="hint" title="" href="#" data-original-title="Entrada"><img src="images/icons/16/door_in.png"></a>
                    </span>
                    <input type="text" placeholder="2015-03-24" class="form-control" name="date_in" id="date_in" />
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group">
                    <span class="input-group-addon">
                        <a class="hint" title="" href="#" data-original-title="Salida"><img src="images/icons/16/door_out.png"></a>
                    </span>
                    <input type="text" placeholder="2015-03-24" class="form-control" name="date_end" id="date_end">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group">
                    <span class="input-group-addon">
                        <a class="hint" title="" href="#" data-original-title="Ocupantes"><img src="images/icons/16/group.png"></a>
                    </span>
                    <input type="text" class="form-control" name="ocupantes" id="ocupantes">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group">
                    <span class="input-group-addon">
                        <a class="hint" title="" href="#" data-original-title="Dormitorios"><img src="images/icons/16/bed.png"></a>
                    </span>
                    <input type="text" class="form-control" name="dormitorios" id="dormitorios">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group">
                    <span class="input-group-addon">
                        <a class="hint" title="" href="#" data-original-title="Capacidad"><img src="images/icons/16/meeting_workspace.png"></a>
                    </span>
                    <input type="text" class="form-control" name="capacidad" id="capacidad">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group">
                    <span class="input-group-addon">
                        <a class="hint" title="" href="#" data-original-title="Localizacion"><img src="images/icons/16/map.png"></a>
                    </span>
                    <input type="text" class="form-control" name="locate" id="locate">
                </div>
                <br/>                
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn"><i class="fa fa-search"></i> Buscar</button>
        </div>
        </form>
    </div>
    <div class="container">
        <h1>Resultados de la Busqueda</h1>
        <div class="row-fluid">
            <?php
            for ($i = 0; $i < 25; $i++) {
                ?>
                <div class="col-sm-3">
                    <div class="well well-sm">
                        <img class="img-responsive img-rounded" data-src="holder.js/100%x160/social" />
                        <h4>Titulo</h4>
                        <p>Lorem Ipsum dolor a sit. Lorem Ipsum dolor a sit.</p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('#date_in').datepicker({dateFormat: 'yy-mm-dd'});
        $('#date_end').datepicker({dateFormat: 'yy-mm-dd'});
        $('.hint').tooltip();
    });

</script>