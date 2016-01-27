function jTable(obj, src, data) {
    $('#' + obj).dataTable({
        "bJQueryUI": true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": src,
        "oLanguage": {
            "sUrl": "js/dataTables.spanish.txt"
        },
        "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>"
    });
}

//***********************************************************************INICIAN FUNCIONES PROPIEDADES 
//TRAE LOS DATOS PARA EDITAR LOS ITEMS
function getJson(uid,oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid,"op":oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        //alert("Nombre: " + json.name); // variable[.]campo_json
        $("#mod_e").modal('show');
        $("#e_name").val(json.name);
        $("#e_tdato").val(json.tipo);
        $("#e_activ").val(json.active);
        $("#e_raq").val(json.required);
        $("#e_unit").val(json.unidad);
        $("#e_valp").val(json.valor);
        $("#e_id").val(json.id);

    });
}
//TRAE DATOS PARA ELIMINAR LOS ITEMS
 function jsonid(uid,oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid,"op":oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $("#mod_elim").modal('show');
        $("#elim_na").val(json.name);
        $("#elim_id").val(json.id);
    });
}
//EDICION DE LOS ITEMS
function manda_alta()
{
    $.ajax({
        data: $("#formedit").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
            
        },
        success: function (data)
        {
            $("#mod_e").modal('hide');
            $("#respuesta").modal('show');
            $("#content_e").html(data);
            var table = $('#tbl_admin').DataTable();
 
            table.ajax.reload( function ( json ) {
                $('#tbl_admin').val( json.lastInput );
            } );
        }
    });
}
//ELIMINAR LOS ITEMS
function eliminaitem()
{
    $.ajax({
        data: $("#form_elim").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
            
        },
        success: function (data)
        {
            $("#mod_elim").modal('hide');//oculta para no perder la estructura del div
            $("#respuesta").modal('show');//muestra el div de respuestas
            $("#content_e").html(data);//div dentro de respuesta para cambiar el contenido dinamicamente
            //actualiza la tabla al regresar la respuesta
            var table = $('#tbl_admin').DataTable(); 
            table.ajax.reload( function ( json ) {
                $('#tbl_admin').val( json.lastInput );
            } );
        }
    });
}
//ALTA DE NUEVOS ITEMS
function altaitem(){
    $.ajax({
        data: $("#formadd").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
            
        },
        success: function (data){
            $("#exampleModal").modal('hide');
            $("#respuesta").modal('show');
            $("#content_e").html(data);
            var table = $('#tbl_admin').DataTable();
            $("#formadd")[0 ].reset();
            table.ajax.reload( function ( json ) {
                $('#tbl_admin').val( json.lastInput );
            } );
        }
    });
}
//*********************************************TERMINAN FUNCIONES PROPIEDADES */
function guradalocali()
{
    $.ajax({
        data: $("#destino").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
            
        },
        success: function (data)
        {
            $("#respuesta").modal('show');
            $("#content_e").html(data);
            document.getElementById("destino").reset();
        }
    });
}
function jsonloc(uid,oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid,"op":oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $("#exampleModal").modal('show');
        $("#e_des_name").val(json.name);
        $("#desid").val(json.id);
        
    });
}
function jsonloce(uid,oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid,"op":oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $("#elimina").modal('show');
        $("#miname").val(json.name);
        $("#e_desid").val(json.id);
        
    });
}
function editalocali(){

    $.ajax({
        data: $("#e_destino").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
            
        },
        success: function (data)
        {
            $("#exampleModal").modal('hide');
            $("#respuesta").modal('show');
            $("#content_e").html(data);
            var table = $('#tbl_admin').DataTable();
 
            table.ajax.reload( function ( json ) {
                $('#tbl_admin').val( json.lastInput );
            } );
        }
    });
}
function eliminalocali(){

    $.ajax({
        data: $("#eliminadestino").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
            
        },
        success: function (data)
        {
            $("#elimina").modal('hide');
            $("#respuesta").modal('show');
            $("#content_e").html(data);
            var table = $('#tbl_admin').DataTable();
 
            table.ajax.reload( function ( json ) {
                $('#tbl_admin').val( json.lastInput );
            } );
        }
    });
}

//****************empieza tipo

function guradatype(){
    $.ajax({
        data: $("#type").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
            
        },
        success: function (data)
        {
            $("#respuesta").modal('show');
            $("#content_e").html(data);
            $('#des_name').val("");
        }
    });
}