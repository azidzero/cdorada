<?php
$id=  filter_input(INPUT_POST, "id");
echo '
 <div class="row" >
    <div class="col-md-6"><h3>Desea subir imagenes para este prospecto?</h3></div>
        <div class="col-md-6"><a href="javascript:void(0);" class="btn btn-warning" alt="Cerrar" onclick="oculta();" title="Cancelar">Cerrar</a></div>
    </div>   
<div id="mizona" name="mizona" class="dropzone"></div>';