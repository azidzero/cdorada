<?php

include("../../../inc/app.conf.php");
if (isset($_REQUEST["id"])) {
    // Load Reserva
} else {
    // New Reserva
    ?>
<div class="row">
    <div class="col-sm-4">
        
    </div>
    <div class="col-sm-8">
        <table class="table table-condensed">
            <tr>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon">ID</span>
                        <input type="text" id="pid" name="pid" class="form-control" />
                        <span class="input-group-addon" id="pname">{NAME}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td><span class="input-group">Entrada:</span>
                    <input type="text" id="date_in" name="date_in" class="form-control" />
                </td>
            </tr>
            <tr>
                <td><span class="input-group">Salida:</span>
                    <input type="text" id="date_out" name="date_out" class="form-control" />
                </td>
            </tr>
        </table>
    </div>
</div>
    <?php

}