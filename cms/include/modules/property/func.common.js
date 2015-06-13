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
function getJson(uid, oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid, "op": oc},
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
function jsonid(uid, oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid, "op": oc},
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
            $.bootstrapGrowl(data, {type: 'info'});
            /*$("#respuesta").modal('show');
             $("#content_e").html(data);*/
            var table = $('#tbl_admin').DataTable();

            table.ajax.reload(function (json) {
                $('#tbl_admin').val(json.lastInput);
            });
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
            /* $("#respuesta").modal('show');//muestra el div de respuestas
             $("#content_e").html(data);//div dentro de respuesta para cambiar el contenido dinamicamente*/
            //actualiza la tabla al regresar la respuesta
            $.bootstrapGrowl(data, {type: 'info'});
            var table = $('#tbl_admin').DataTable();
            table.ajax.reload(function (json) {
                $('#tbl_admin').val(json.lastInput);
            });
        }
    });
}
//ALTA DE NUEVOS ITEMS
function altaitem()
{
    var req= document.getElementById("newname").value;
    var idreg= document.getElementById("idsav").value;
    if(req!="")
    {
        $.ajax({
            data: $("#formadd").serialize(),
            url: "include/modules/property/save.dat.php",
            type: 'post',
            beforeSend: function () {
                
            },
            success: function (data)
            {
                $("#exampleModal").modal('hide');
                document.getElementById("formadd").reset();
                document.getElementById('idsav').value="0";
                $.bootstrapGrowl(data, {type: 'info'});
                var table = $('#tbl_admin').DataTable();
                table.ajax.reload(function (json) {
                    $('#tbl_admin').val(json.lastInput);
                });
            }
        });
    }
    else
    {
        document.getElementById("newname").focus();
         $.bootstrapGrowl("Se necesita por lo menos el nombre de item", {type: 'warning'});
    }
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
            /* $("#respuesta").modal('show');
             $("#content_e").html(data);*/
            $.bootstrapGrowl(data, {type: 'info'});
            document.getElementById("destino").reset();
        }
    });
}
function jsonloc(uid, oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $("#exampleModal").modal('show');
        $("#e_des_name").val(json.name);
        $("#desid").val(json.id);

    });
}
function jsonloce(uid, oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $("#elimina").modal('show');
        $("#miname").val(json.name);
        $("#e_desid").val(json.id);

    });
}
function editalocali()
{

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

            table.ajax.reload(function (json) {
                $('#tbl_admin').val(json.lastInput);
            });
        }
    });
}
function eliminalocali()
{

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

            table.ajax.reload(function (json) {
                $('#tbl_admin').val(json.lastInput);
            });
        }
    });
}

//****************empieza tipo

function guradatype()
{
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
            document.getElementById("destino").reset();
        }
    });
}



function jdtable(uid, oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        document.getElementById("texto").innerHTML = "";
        //alert("Nombre: " + json.title); // variable[.]campo_json
        document.getElementById("texto").innerHTML += json.title;
        $("#mod_elim").modal('show');
        $("#house_id").val(json.id);

    });
}
function delhouse()
{

    $.ajax({
        data: $("#from_del_hous").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {

        },
        success: function (data)
        {
            $("#mod_elim").modal('hide');
            $("#respuesta").modal('show');
            $("#content_e").html(data);
            var table = $('#tbl_admin').DataTable();

            table.ajax.reload(function (json) {
                $('#tbl_admin').val(json.lastInput);
            });
        }
    });
}
//:::::::::::::: REORDENA GALERIA DE IMAGENES::::::::::::::::::::
$(document).ready(function () {
    $("#menu-pages").sortable({
        update: function (event, ui) {
            $.post("include/modules/property/images.php", {type: "orderPages", pages: $('#menu-pages').sortable('serialize')});
        }
    });
});
Dropzone.autoDiscover = false;
//:::::::::::::::::::::::::::::::::::::ELIMINAIMAGEN
function delpicture(idp, op)
{

    $.ajax({
        data: {op: op, id: idp},
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {

        },
        success: function (data)
        {
            $("#mod_elim").modal('hide');
            $("#respuesta").modal('show');
            $("#content_e").html(data);
            var table = $('#tbl_admin').DataTable();

            table.ajax.reload(function (json) {
                $('#tbl_admin').val(json.lastInput);
            });
        }
    });
}
function traeventana(uid, oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        document.getElementById("tit").innerHTML = "";
        $("#mod_elim").modal('show');
        document.getElementById("tit").innerHTML += json.orden;
        $("#elim_id").val(json.id);
        document.getElementById("gallery_show").innerHTML = "";

    });
}
function recarga()
{
    location.reload();
}
function autosave(camp, camptbl)
{
    var issav = document.getElementById("idsav").value;
    var tablnm = document.getElementById("tablename").value;
    var valcamp = document.getElementById(camp).value;
    var haynombre=document.getElementById("newname").value;
    if(haynombre!='')
    {
        if (valcamp != "")
        {
            if (issav === '0')
            {
                $.ajax({
                    data: {'op': 900, 'value': valcamp, 'tbl': tablnm, 'ctabl': camptbl},
                    url: "include/modules/property/save.dat.php",
                    type: 'post',
                    beforeSend: function () {
                    },
                    success: function (data)
                    {
                        if (!isNaN(data))
                        {
                            var issav = document.getElementById("idsav").value = data;
                            $.bootstrapGrowl("Autoguardado", {type: 'info'});
                        }
                        else
                        {
                            $.bootstrapGrowl("No se autoguardo" + data, {type: 'Warning'});
                        }
                    }
                });
            }
            else
            {
                $.ajax({
                    data: {'op': 901, 'value': valcamp, 'tbl': tablnm, 'ctabl': camptbl, 'idcamp': issav},
                    url: "include/modules/property/save.dat.php",
                    type: 'post',
                    beforeSend: function () {
                    },
                    success: function (data)
                    {
                        if (data == '1')
                        {
                            $.bootstrapGrowl("Autoguardado", {type: 'info'});
                        }
                        else
                        {
                            $.bootstrapGrowl("No se autoguardo" + data, {type: 'Warning'});
                        }
                    }
                });
            }
        }
    }
    else
    {
        document.getElementById("newname").focus();
         $.bootstrapGrowl("Se necesita llenar el nombre de item", {type: 'warning'});
    }
}