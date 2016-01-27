<div class="modal fade" id="newoffer" tabindex="-1" role="dialog" style="z-index:9999999;" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"style="width: 80%;" >
        <div class="modal-content" id="cont_offerta" >
        </div>
    </div>
</div>
<div class="modal fade" id="askoffer" name="askoffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style=width:30%;" >
        <div class="modal-content" id="cont_ask" >
        </div>
    </div>
</div>
<div class="modal fade" id="propoffer" name="propoffer" tabindex="-1"style="z-index: 9999;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"  style="width:80%">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Asignar Propiedades a la Oferta</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Filtrar</h4>
                        <input type="text" id="namealoja" onkeyup="filtraloja(this.value);"class="form-control">
                        <input type="text" id="ofertami" class="hidden">
                    </div>                   
                </div>
                <div id="contentoff" > 
                        
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-info" onclick="showoffer();"><span class="fa fa-plus"></span></button>
<input type="text" id="id_edit" name="id_edit" class="form-control" value="0">
<br><br>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <b>BUSCAR:</b><input type="text" id="findoff" onkeypress="searchof(this.value);" placeholder="NOMBRE DE OFERTA" class="input-group-lg" style="width:60%;">
            </div>
        </div>
        <div class="col-lg-12" id="tablecont">
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        searchof("");
    });
</script>