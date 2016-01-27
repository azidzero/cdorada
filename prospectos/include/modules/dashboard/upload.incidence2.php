<?php
$id=  filter_input(INPUT_POST, "id");
echo '
 <div class="row" >
    <div class="col-md-6"><h3>Seleccione sus archivos multimedia:..... </h3></div>
        <div class="col-md-6"><a href="javascript:void(0);" class="btn btn-warning" alt="Cerrar" onclick="oculta2();" title="Cancelar">Cerrar</a></div>
    </div>   
<div id="mizona2" name="mizona2" class="dropzone"></div>';