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
function openextra()
{
    $.ajax({
        data: {"op": 4},
        url: "include/modules/property/action.extra.php",
        type: 'post',
        success: function (data)
        {
            $("#alta_newextra").html('');
            $("#alta_newextra").html(data);
            $("#exampleModal").modal('show');
            $('#frmextra')[0].reset();
            $.ajax({
                method: "POST",
                url: "include/modules/property/catalogo.json.php",
                data: {"op": 11},
                dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
            }).done(function (json) {
                for (var a = 0; a < json.length; a++) {
                    $('#descextra_' + json[a]).summernote({height: 240});
                }
            });

        }
    });

}
function sumernote_a()
{
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"op": 11},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        for (var a = 0; a < json.length; a++) {
            $('#nw_descextra_' + json[a]).summernote({height: 240});
        }
    });
}
function sumernote_b()
{
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"op": 11},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        for (var a = 0; a < json.length; a++) {
            $('#rent-large_' + json[a]).summernote({height: 240});
            $('#rent-large_' + json[a]).attr('onblur', 'saveshort(this.name, this.value);');
        }
    });
}
//TRAE LOS DATOS PARA EDITAR LOS ITEMS
function getJson(uid, oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        //alert("Nombre: " + json.name); // variable[.]campo_json

        $("#e_name").val(json.name);
        $("#e_tdato").val(json.tipo);
        $("#e_activ").val(json.active);
        $("#e_raq").val(json.required);
        $("#e_unit").val(json.unidad);
        $("#e_valp").val(json.valor);
        $("#e_id").val(json.id);
        $("#mod_e").modal('show');
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
//ELIMINAR LOS ITEMS
function eliminaitemimage(elaid)
{
    $.ajax({
        data: $("#form_elim").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {

        },
        success: function (data)
        {
            $("#mod_elim").modal('hide');
            $.bootstrapGrowl(data, {type: 'info'});
            var table = $('#tbl_admin').DataTable();
            table.ajax.reload(function (json) {
                $('#tbl_admin').val(json.lastInput);
            });
            $("#gallery_show").html();
            $.ajax({
                method: "POST",
                url: "include/modules/property/gallery.ajax.php",
                data: {"id": elaid}
            }).done(function (data) {
                $("#gallery_show").html(data);
            });
            //:::::::::::::::::::::::::
        }
    });
}
//ALTA DE NUEVOS ITEMS
function req_val()
{
    var ch = document.getElementById("reqval").checked;
    if (ch === true)
    {
        document.getElementById("valp").disabled = false;
    } else
    {
        document.getElementById("valp").disabled = true;
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
    var did = $("#desid").val();
    var nm = $("#e_des_name").val();
    $.ajax({
        data: {"op": 51, "id": did, "nme": nm},
        url: "include/modules/property/save.dat.php",
        type: 'post',
        success: function (data)
        {
            if (data === '0')
            {
                $.bootstrapGrowl("Error al Modificar", {type: 'info'});
            }
            if (data === '1')
            {
                $("#editelemnt").modal("hide");
                $("#text_" + did).html(nm);
            }
        }
    });
}
function eliminalocali()
{
    var uid = $("#idname").val();
    $.ajax({
        data: {"op": 52, "id": uid},
        url: "include/modules/property/save.dat.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("ELIMINADO CORRECTAMENTE", {type: 'success'});
                $("#delthis").modal("hide");
                location.reload();
            } else
            {
                $.bootstrapGrowl("Error al eliminar", {type: 'Warning'});
            }
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
            if (data == 0)
            {
                $.bootstrapGrowl("Error al Guardar", {type: 'Warning'});
            }
            if (data == 1)
            {
                $.bootstrapGrowl("Guardado con Exito", {type: 'success'});
                document.getElementById("dest_name").value = "";
            }
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
            switch (data)
            {
                case '0':
                    $.bootstrapGrowl("Error al eliminar", {type: 'Warning'});
                    break
                case '1':
                    $.bootstrapGrowl("Eliminado Correctamente", {type: 'success'});
                    var table = $('#tbl_admin').DataTable();

                    table.ajax.reload(function (json) {
                        $('#tbl_admin').val(json.lastInput);
                    });
                    break
                default:
                    $.bootstrapGrowl(data, {type: 'Warning'});
                    var table = $('#tbl_admin').DataTable();
                    table.ajax.reload(function (json) {
                        $('#tbl_admin').val(json.lastInput);
                    });
                    break;
            }
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
        data: {op: 0, id: a},
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



//:::::::::::para las imagenes
function traeventana(uid, oc, elaid) {

    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $("#mod_elim").modal('show');
        document.getElementById("tit").innerHTML += json.orden;
        $("#elim_id").val(json.id);


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
    var haynombre = document.getElementById("newname_es").value;
    if (haynombre != '')
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
                        } else
                        {
                            $.bootstrapGrowl("No se autoguardo" + data, {type: 'Warning'});
                        }
                    }
                });
            } else
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
                        } else
                        {
                            $.bootstrapGrowl("No se autoguardo" + data, {type: 'Warning'});
                        }
                    }
                });
            }
        }
    } else
    {
        document.getElementById("newname").focus();
        $.bootstrapGrowl("Se necesita llenar el nombre de item", {type: 'warning'});
    }
}

function savehousing(champ, val)
{
    var save = document.getElementById("idsav").value;
    var exc = 1;
    switch (save)
    {
        //CUANDO EL TITULO NO SE HA GUARDADO ***REQUISITO PRINCIPAL
        case '0':
            if (champ === 'rent-title') {
                if (val.length <= 0)
                {
                    //document.getElementById('rent-title').focus();
                    $.bootstrapGrowl("LLENE EL NOMBRE DE LA PROPIEDAD", {type: 'warning'});
                } else
                {
                    $.ajax({
                        data: {'op': 71, 'camp': champ, 'value': val, 'guard': save},
                        url: "include/modules/property/save.dat.php",
                        type: 'post',
                        success: function (data)
                        {
                            var spl = data.split("|")
                            switch (spl[0])
                            {
                                case '1':
                                    $.bootstrapGrowl("AUTOGUARDADO CORRECTAMENTE", {type: 'success'});
                                    document.getElementById("idsav").value = spl[1];
                                    break;
                                default:
                                    $.bootstrapGrowl(spl[1], {type: 'danger'});
                                    break;
                            }
                        }
                    });
                }
            } else
            {

                document.getElementById('rent-title').focus();
                $.bootstrapGrowl("ERROR: NOSE HA GUARDADO EL NOMBRE DE LA PROPIEDAD", {type: 'warning'});
            }
            break;
            //CUANDO YA ESTA GUARDADO EL CAMPO DE TITULO QUE ES REQUISITO UNICO
        default:
            var shl = document.getElementById("shlang").value;
            var lol = document.getElementById("lonlang").value;
            if (val.length >= 1) {
                $.ajax({
                    data: {'op': 71, 'camp': champ, 'value': val, 'guard': save, "sh": shl, "lon": lol},
                    url: "include/modules/property/save.dat.php",
                    type: 'post',
                    success: function (data)
                    {
                        var spl = data.split("|")
                        switch (spl[0])
                        {
                            case 'OK':
                                $.bootstrapGrowl("AUTOGUARDADO CORRECTAMENTE", {type: 'success'});
                                break;
                            case '2':
                                $.bootstrapGrowl("AUTOGUARDADO CORRECTAMENTE", {type: 'success'});
                                document.getElementById("savelang").value = spl[1];
                                break;
                            default:
                                $.bootstrapGrowl(spl[1], {type: 'danger'});
                                break;
                        }
                    }
                });
            }
            break;
    }
}
function savelong(champ, val)
{
    var lol = document.getElementById("lonlang").value;
    var save = $("#rent-name").attr("data-pid");
    if (save >= 1)
    {
        var lg = champ.split("_");
        if (lg[0] === 'rent-large')
        {
            $('#' + champ).val($('#data-rent-large_' + lg[1]).code());
            val = $('#data-rent-large_' + lg[1]).val();
        }
        if (val.length >= 1) {
            $.ajax({
                data: {'op': 78, 'camp': champ, 'guard': save, 'value': val, "lon": lol},
                url: "include/modules/property/save.dat.php",
                type: 'post',
                success: function (data)
                {
                    var spl = data.split("|")
                    switch (spl[0])
                    {
                        case '1':
                            $.bootstrapGrowl("AUTOGUARDADO CORRECTAMENTE", {type: 'success'});
                            document.getElementById("lonlang").value = spl[1];
                            break;
                        case 'OK':
                            $.bootstrapGrowl("AUTOGUARDADO CORRECTAMENTE", {type: 'success'});
                            break;
                        default:
                            $.bootstrapGrowl(spl[1], {type: 'danger'});
                            break;
                    }
                }
            });
        }
    } else
    {
        document.getElementById('rent-title').focus();
        $.bootstrapGrowl("ERROR: NOSE HA GUARDADO EL NOMBRE DE LA PROPIEDAD", {type: 'warning'});
    }
}
function saveshort(champ, val)
{
    var pid = $("#rent-name").attr("data-pid");
    if (pid >= 1)
    {
        if (val.length >= 1) {
            var chid = $("#" + champ).attr('data-save');
            $.ajax({
                data: {'op': 6, 'camp': champ, 'pid': pid, 'value': val, "id": chid},
                url: "include/modules/property/save.dat.php",
                type: 'post',
                success: function (data)
                {
                    var spl = data.split("|")
                    if (spl[0] === '1')
                    {
                        $("#" + champ).attr('data-save', spl[1]);
                        $.bootstrapGrowl("GUARDADO EXITOSAMENTE", {type: 'success'});
                    } else
                    {
                        $.bootstrapGrowl(spl[1], {type: 'warning'});
                    }
                }
            });
        }
    } else
    {
        document.getElementById('rent-name').focus();
        $.bootstrapGrowl("ERROR: NOSE HA GUARDADO EL NOMBRE DE LA PROPIEDAD", {type: 'warning'});
    }
}
/*
 function autosavetab(nam)
 {
 var guard = document.getElementById("idsav").value;
 var tabact = document.getElementById("tabsav_" + nam).value;
 if (guard > 0)
 {
 if (tabact != 1)
 {
 $.ajax({
 data: {'op': 72, 'tab': nam, 'idcamp': guard},
 url: "include/modules/property/save.dat.php",
 type: 'post',
 beforeSend: function () {
 },
 success: function (data)
 {
 document.getElementById("tabsav_" + nam).value = data;
 }
 });
 }
 } else
 {
 document.getElementById("rent-title").focus();
 }
 }*/

function saveitem(cat, addon)
{

    var sav = document.getElementById("idsav").value;
    if (sav >= 1)
    {
        var check = document.getElementById(cat + "_" + addon);
        var a = check.dataset.save;
        switch (a)
        {
            case '100':
                break;
            default:
                var val = document.getElementById(cat + "_" + addon + "_data").value;
                $.ajax({
                    data: {'op': a, 'val': val, 'cat': cat, 'addon': addon, 'pid': sav},
                    url: "include/modules/property/autosave.php",
                    type: 'post',
                    success: function (data)
                    {
                        if (data === '1' || data === '0')
                        {
                            $.bootstrapGrowl("AUTOGUARDADO CORRECTAMENTE", {type: 'success'});
                            check.dataset.save = data;
                        } else
                        {
                            $.bootstrapGrowl(data, {type: 'danger'});
                        }
                    }
                });
                break;
        }
    } else
    {
        document.getElementById(cat + "_" + addon).checked = false;
        $.bootstrapGrowl("<b>ERROR:</b><br> No se ha guardado Nombre del alojamiento", {type: 'danger'});
    }
}
function save_value(cat, addon, val)
{
    var save = document.getElementById(cat + "_" + addon).dataset.save;
    if (save === '1')
    {
        var sav = document.getElementById("idsav").value;
        if (sav >= 1)
        {
            $.ajax({
                data: {'op': 2, 'val': val, 'cat': cat, 'addon': addon, 'pid': sav},
                url: "include/modules/property/autosave.php",
                type: 'post',
                success: function (data)
                {
                    if (data === '1')
                    {
                        $.bootstrapGrowl("AUTOGUARDADO CORRECTAMENTE", {type: 'success'});
                    } else
                    {
                        $.bootstrapGrowl(data, {type: 'warning'});
                    }
                }
            });
        }
    }
}
function clearmapa()
{
    $('#test').gmap3({
            clear: {
                  last: true
            }
      });
}
function mapadire()
{
    var d = $("#rent-address").val();
    var p = $('#rent-provincia option:selected').text();
    var l = $('#rent-localidad option:selected').text();
    var z = $('#rent-zona option:selected').text();
    var no = document.getElementById("dirho_num").value;
    var direccion = d + ',' + p + ',' + l + ',' + z;
    console.log(direccion);
    var coord = "";
    if (no >= '1')
    {
        $('#test').gmap3({
                clear: {
                      last: true
                }
          });
    }
    $(function () {

        $("#test").gmap3({
            marker: {
                id: "calle",
                address: direccion,
                options: {
                    draggable: true
                },
                events: {
                    dragend: function (marker) {
                        $(this).gmap3({
                            getaddress: {
                                latLng: marker.getPosition(),
                                callback: function (results) {
                                    var map = $(this).gmap3("get"),
                                            infowindow = $(this).gmap3({get: "infowindow"}),
                                            content = direccion;
                                    coord = marker.getPosition();
                                    splt(coord);
                                    if (infowindow) {
                                        infowindow.open(map, marker);
                                        infowindow.setContent(content);
                                        splt(coord);
                                    } else {
                                        $(this).gmap3({
                                            infowindow: {
                                                anchor: marker,
                                                options: {content: content}
                                            }
                                        });
                                        splt(coord);
                                    }
                                }
                            }
                        });
                    }
                }
            },
            map: {
                options: {
                    zoom: 12
                }
            },
            autofit: {}
        });
    });
    no += 1;
    $("#dirho_num").val(no);
}
function splt(coo)
{
    var res = coo.toString();
    var res2 = res.substring(1, res.length - 1);
    var arr = res2.split(",");
    document.getElementById("lat").value = arr[0];
    document.getElementById("long").value = arr[1];
}
function status()
{
    var stt = document.getElementById("rent-status").value;
    if (stt == '0')
    {
        document.getElementById("rent-status").value = "1";
    }
    if (stt == '1')
    {
        document.getElementById("rent-status").value = "0";
    }
}
function activacasa(idho, val)
{
    $.ajax({
        data: {'op': 77, 'idhou': idho, 'val': val},
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            $.bootstrapGrowl(data, {type: 'info'});
            var table = $('#tbl_admin').DataTable();
            table.ajax.reload(function (json) {
                $('#tbl_admin').val(json.lastInput);
            });
        }
    });
}
function cargamapa()
{
    // var ubic = document.getElementById("rent-ubi").value;
    var address = document.getElementById("rent-address").value;
    $("#test").gmap3({
        marker: {
            address: address,
            options:
                    {
                        draggable: true
                    }
        },
        map: {
            options: {
                zoom: 12
            }
        }
    });
}
function offeraction(opc, id)
{
    if (id === "nulo")
    {
        id = null;
        id = document.getElementById('idsav').value;
    }
    switch (opc)
    {
        case '0':
            $.ajax({
                data: {'op': 100, 'id': id},
                url: "include/modules/property/save.dat.php",
                type: 'post',
                beforeSend: function () {
                },
                success: function (data)
                {
                    $("#mdloffer").modal('show');
                    $("#conbody").html(data);
                }
            });
            break;
        case '1':
            $("#mdloffer").modal('show');
            break;
    }
}
function clonaoferta(id)
{
    $.ajax({
        method: "POST",
        url: "include/modules/property/getcat.json.php",
        data: {"id": id},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $("#fini").val(json.date_ini);
        $("#fend").val(json.date_end);
        $("#nameoff").val(json.name + " - edit");
        $("#addoff").val(json.cant);
    });
}
function inoffer()
{
    $.ajax({
        data: $("#offernew").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            /*
             * 0: error con valor nulo
             * 1: error de fechas
             * 2: error de porcentaje del 1-100
             * 3: error de monto <= 0
             * 4: otro error
             * 100: INSERTAR CORRECTAMENTE
             */
            switch (data)
            {
                case '0':
                    $.bootstrapGrowl("LLene todos los campos", {type: 'warning'});
                    break;
                case '1':
                    $.bootstrapGrowl("Verifique que la fecha de inicio sea menor a la final", {type: 'warning'});
                    break;
                case '2':
                    $.bootstrapGrowl("El porcentaje de descuento va de 1 a 100 verifique su porcentaje", {type: 'warning'});
                    break;
                case '3':
                    $.bootstrapGrowl("Su monto debe de ser mayor a 0", {type: 'warning'});
                    break;
                case '4':
                    $.bootstrapGrowl("Lo sentimos, sucedio un error, consulte a su administrador", {type: 'warning'});
                    break;
                case '100':
                    $.bootstrapGrowl("GUARDADO CORRECTAMENTE", {type: 'success'});
                    $.ajax({
                        data: $("#offernew").serialize(),
                        url: "include/modules/property/tbloffer.table.php",
                        type: 'post',
                        beforeSend: function () {
                        },
                        success: function (data)
                        {
                            //$("#taofer").html("");
                            $("#taofer").html(data);
                        }
                    });
                    document.getElementById("offernew").reset();
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'warning'});
                    break;
            }
        }
    });
}
function addprofunc(idhouse, chk)
{
    if (document.getElementById("check_" + chk).checked === true)
    {
        $.ajax({
            data: {"pid": idhouse, "idof": chk, "op": '102'},
            url: "include/modules/property/save.dat.php",
            type: 'post',
            beforeSend: function () {
            },
            success: function (data)
            {
                switch (data)
                {
                    case "1":
                        $.bootstrapGrowl("Guardado correctamente", {type: 'success'});
                        $.ajax({
                            method: "POST",
                            url: "include/modules/property/getcat.json.php",
                            data: {"id": chk},
                            dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
                        }).done(function (json) {
                            var t = null;
                            if (json.tipo === '0')
                            {
                                t = "%";
                            } else
                            {
                                t = "";
                            }
                            var fecha = json.date_ini.split("-");
                            var fecha2 = json.date_end.split("-");
                            var f1 = fecha[2] + "-" + fecha[1] + "-" + fecha[0];
                            var f2 = fecha2[2] + "-" + fecha2[1] + "-" + fecha2[0];
                            $('#tbl_ofertas tr:last').after('<tr id="row' + json.id + '"><td>' + json.name + '</td><td>-' + json.cant + t + '</td><td>' + f1 + '</td><td>' + f2 + '</td><td><div class="btn-group"><button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Opciones <span class="caret"></span></button ><ul class="dropdown-menu dropdown-menu-left" role="menu"><li><a href="JavaScript:void(0)" onclick="editofferaction(' + json.id + ');"><i class="fa fa-edit"></i>Editar</a></li><li><a href="JavaScript:void(0);" onclick="ocultarfila(' + json.id + ',' + idhouse + ') \"><i class="fa fa-trash"></i> Eliminar</a></li></ul></div></td></tr>');
                        });

                        break;
                    default:
                        $.bootstrapGrowl(data, {type: 'warning'});
                        break;
                }
            }
        });
    } else
    {
        $.ajax({
            data: {"pid": idhouse, "idof": chk, "op": '103'},
            url: "include/modules/property/save.dat.php",
            type: 'post',
            beforeSend: function () {
            },
            success: function (data)
            {
                switch (data)
                {
                    case "1":
                        $.bootstrapGrowl("Guardado correctamente", {type: 'success'});
                        $('#row' + chk).remove();
                        break;
                    default:
                        $.bootstrapGrowl(data, {type: 'warning'});
                        break;
                }
            }
        });
    }
}

function ocultarfila(id_fila, idh)
{
    $.ajax({
        data: {"pid": idh, "idof": id_fila, "op": '103'},
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            switch (data)
            {
                case "1":
                    $.bootstrapGrowl("Guardado correctamente", {type: 'success'});
                    $('#row' + id_fila).remove();
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'warning'});
                    break;
            }
        }
    });
}
function editofferaction(ofer)
{
    $.ajax({
        data: {'op': 104, 'id': ofer},
        url: "include/modules/property/save.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            $("#mdloffer").modal('show');
            $("#conbody").html();
            $("#conbody").html(data);
        }
    });
}
function changeofedo()
{
    $.ajax({
        data: $("#modificaoferta").serialize(),
        url: "include/modules/property/save2.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            switch (data)
            {
                case '1':
                    $.bootstrapGrowl("guardado correctamente", {type: 'success'});
                    $("#mdloffer").modal('hide');
                    var ro = document.getElementById("ido").value;
                    $('#row' + ro).remove();
                    $.ajax({
                        method: "POST",
                        url: "include/modules/property/getcat.json.php",
                        data: {"id": ro},
                        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
                    }).done(function (json) {
                        var t = null;
                        if (json.tipo === '0')
                        {
                            t = "%";
                        } else
                        {
                            t = "";
                        }
                        var fecha = json.date_ini.split("-");
                        var fecha2 = json.date_end.split("-");
                        var f1 = fecha[2] + "-" + fecha[1] + "-" + fecha[0];
                        var f2 = fecha2[2] + "-" + fecha2[1] + "-" + fecha2[0];
                        $('#tbl_ofertas tr:last').after('<tr id="row' + json.id + '"><td>' + json.name + '</td><td>-' + json.cant + t + '</td><td>' + f1 + '</td><td>' + f2 + '</td><td><div class="btn-group"><button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Opciones <span class="caret"></span></button ><ul class="dropdown-menu dropdown-menu-left" role="menu"><li><a href="JavaScript:void(0)" onclick="editofferaction(' + json.id + ');"><i class="fa fa-edit"></i>Editar</a></li><li><a href="JavaScript:void(0);" onclick="ocultarfila(' + json.id + ',' + +') \"><i class="fa fa-trash"></i> Eliminar</a></li></ul></div></td></tr>');
                    });
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'alert'});
                    break;
            }
        }
    });
}

/********funciones tarifas de propiedad***********/
$(function () {
    $("#ini_f").datepicker({dateFormat: 'dd-mm-yy'});
});
$(function () {
    $("#end_f").datepicker({dateFormat: 'dd-mm-yy'});
});
function cattarif(id)
{
    $.ajax({
        data: {'op': 2, 'id': id},
        url: "include/modules/property/save2.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            $("#ctarifa").modal('show');
            $("#cbody").html(data);
        }
    });

}

function duplicatarifa(itar, pid)
{
    document.getElementById("c_tarifa").style.display = "inline";
    $.ajax({
        method: "POST",
        url: "include/modules/property/tarifa.json.php",
        data: {"id": itar},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $("#namet").val(json.title + " clonada");
        $("#costd").val(json.diario);
        $("#costs").val(json.semanal);
        $("#mind").val(json.minimo);
        $("#rebajad").val(json.descu);
        var fecha = json.date_ini.split("-");
        var fecha2 = json.date_end.split("-");
        $("#f1").val(fecha[2] + "-" + fecha[1] + "-" + fecha[0]);
        $("#f2").val(fecha2[2] + "-" + fecha2[1] + "-" + fecha2[0]);
    });
}
function saveclontarifa()
{
    $.ajax({
        data: $("#clontarifa").serialize(),
        url: "include/modules/property/save2.dat.php",
        type: 'post',
        success: function (data)
        {
            var ret = data.split("|");
            switch (parseInt(ret[0]))
            {
                case 0:
                    $.bootstrapGrowl(ret[1], {type: 'warning'});
                    break;
                case 1:
                    document.getElementById("clontarifa").reset();
                    $.bootstrapGrowl("Guardado con Exito", {type: 'success'});
                    document.getElementById("c_tarifa").style.display = "none";
                    $.ajax({
                        method: "POST",
                        url: "include/modules/property/tarifa.json.php",
                        data: {"id": ret[1]},
                        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
                    }).done(function (json) {
                        $('#tar_asign tr:last').after('<tr><td width="1"><input type="checkbox" value="' + json.id + '" id="check_' + json.id + '" name="check_' + json.id + '"onclick="(\'' + json.id + '\',\'' + json.id + '\')"></td><td width="20%">' + json.title + '</td><td width="20%" align="center">' + json.date_ini + '"<br> al <br> "' + json.date_end + '</td><td>' + json.minimo + 'd&iacute;as</td><td>' + json.diario + '</td><td>' + json.semanal + '</td><td>' + json.descu + '</td><td width="2"><a href="JavaScript:void(0);" alt="Clonar" title="Clonar" onclick="duplicatarifa(' + json.id + ')"><span class="fa fa-copy"></span></a></td></tr>');
                    });
                    break;
            }
        }
    });
}
function save_tarifa(pid, taid)
{
    $.ajax({
        data: {'op': 4, 'pid': pid, "taid": taid},
        url: "include/modules/property/save2.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            $('#tabla_tarifa tr:last').after(data);
        }
    });
}
function eliminatar(pid, rid)
{
    $("#content_delt").html("<h2>¿Desea quitar esta tarifa de la propiedad?</h2><br><a href='Javascript:void(0);' class='btn btn-info' onclick='$(\"#de_tarifa\").modal(\"hide\");'>Cancelar</a><a href='Javascript:void(0);' class='btn btn-danger' onclick='borratar(" + pid + "," + rid + " )'>Eliminar</a>");
    $("#de_tarifa").modal("show");
}
function borratar(pid, rid)
{
    $.ajax({
        data: {'op': 5, 'pid': pid, "rid": rid},
        url: "include/modules/property/save2.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            switch (data)
            {
                case '1':

                    $("#tarid_" + rid).remove();
                    $("#de_tarifa").modal("hide");
                    $.bootstrapGrowl("Eliminado correctamente", {type: 'success'});
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'warning'});
                    break;
            }
        }
    });

}
function checaguarda()
{
    //document.getElementById("con_tyo").style.display="inline";
}

function savextra()
{
    $.ajax({
        data: $("#frmextra").serialize(),
        url: "include/modules/property/action.extra.php",
        type: 'post',
        success: function (data)
        {
            switch (data)
            {
                case '1':
                    document.getElementById("frmextra").reset();
                    $("#exampleModal").modal('hide');
                    $.bootstrapGrowl("Guardado correctamente", {type: 'success'});
                    var table = $('#tbl_extras').DataTable();
                    table.ajax.reload(function (json) {
                        $('#tbl_extras').val(json.lastInput);
                    });
                    break;
                default:
                    $.bootstrapGrowl("data", {type: 'danger'});
                    break;
            }

        }
    });

}
function editextra(id, oc)
{
    $.ajax({
        data: {"op": 1, "id": id},
        url: "include/modules/property/action.extra.php",
        type: 'post',
        success: function (data)
        {
            $("#extraconten").html(data);
            $("#mod_extra").modal('show');
        }
    });
}
function savedit()
{
    $.ajax({
        data: $("#editextra").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
        success: function (data)
        {
            $("#mod_extra").modal('hide');
            $.bootstrapGrowl(data, {type: 'success'});
            var table = $('#tbl_extras').DataTable();
            table.ajax.reload(function (json) {
                $('#tbl_extras').val(json.lastInput);
            });
        }
    });
}
function delextra(uid, oc)
{
    $.ajax({
        method: "POST",
        url: "include/modules/property/catalogo.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $("#mod_elim").modal('show');
        $("#elim_na").html("<h3 >" + json.name + "</h3>");
        $("#iddel").val(json.id);
    });
}
function dell_extra()
{
    $.ajax({
        data: $("#form_elim").serialize(),
        type: "POST",
        url: "include/modules/property/action.extra.php",
        success: function (data)
        {
            if (data === '1')
            {
                $("#mod_elim").modal('hide');
                var table = $('#tbl_extras').DataTable();
                table.ajax.reload(function (json) {
                    $('#tbl_extras').val(json.lastInput);
                });
                $.bootstrapGrowl("BORRADO CORRECTAMENTE", {type: 'success'});
            } else
            {
                $.bootstrapGrowl("ocurrio un error:" + data, {type: 'danger'});
            }
        }
    });
}
function updextra()
{
    $.ajax({
        data: $("#editextra").serialize(),
        url: "include/modules/property/action.extra.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $("#mod_extra").modal('hide');
                $.bootstrapGrowl("ACTUALIZADO CORRECTAMENTE", {type: 'success'});
                var table = $('#tbl_extras').DataTable();
                table.ajax.reload(function (json) {
                    $('#tbl_extras').val(json.lastInput);
                });
            } else
            {
                $.bootstrapGrowl("ERROR:" + data, {type: 'WARNING'});
            }
        }
    });
}



/*****************ABRE VENTANA PARA AGREGAR UN NUEVO ITEM************************/
function muestramodal(tb)
{
    $.ajax({
        data: {"table": tb, "opc": 0},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#gral_cont").html(data);
            $("#modalgral").modal("show");
        }
    });
}
function prevw()
{
    var n = $("#name_es").val();
    var t = $("#tdato").val();
    if (t === '1' || t === '2')
    {
        document.getElementById("valp").disabled = false;
    } else
    {
        document.getElementById("valp").disabled = true;
    }
    var m = $("#unit").val();
    var txt = $("#valp").val();
    var ht = document.getElementById("reqval").checked;
    $.ajax({
        data: {"op": t, "nm": n, "med": m, "ht": ht, "txt": txt},
        url: "include/modules/property/addon.preview.php",
        type: 'post',
        success: function (data)
        {
            $("#prvw").html(data);
        }
    });


}
function issuma(cid, cat)
{
    $.ajax({
        data: {"op": '11', "cid": cat, 'pad': cid},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#gral_cont2").html(data);
            $("#gral2").modal('show');
        }
    });

}
function asuma(cid, pad)
{
    var no = $("#val_" + cid).val();
    var chk = document.getElementById("ch_" + cid).checked;
    $.ajax({
        data: {"op": '12', "id": cid, 'chk': chk, 'no': no, 'pad': pad},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("ASIGNADO CORRECTAMENTE", {type: 'success'});
                if (chk === true)
                {
                    document.getElementById("val_" + cid).disabled = true;
                } else
                {
                    document.getElementById("val_" + cid).disabled = false;
                }
            } else
            {
                $.bootstrapGrowl(data, {type: 'warning'});
            }
        }
    });
}
/*********************Guarda los datos del nuevo item********************/
function altaitem()
{
    var req = document.getElementById("name_es").value;
    var idreg = document.getElementById("idsav").value;
    if (req.length >= 1)
    {
        $.ajax({
            data: $("#formadd").serialize(),
            url: "include/modules/property/save.dat.php",
            type: 'post',
            success: function (data)
            {
                $("#modalgral").modal("hide");
                document.getElementById("formadd").reset();
                document.getElementById('idsav').value = "0";
                $.bootstrapGrowl(data, {type: 'success'});
                var table = $('#tbl_admin').DataTable();
                table.ajax.reload(function (json) {
                    $('#tbl_admin').val(json.lastInput);
                });
            }
        });
    } else
    {
        document.getElementById("name_es").focus();
        $.bootstrapGrowl("Se necesita por lo menos el nombre de item", {type: 'warning'});
    }
}
/******************* MANDA LLAMAR LOS ITEMS EDITARLOS **********************/
function edit_addon(uid, oc) {
    $.ajax({
        data: {"itemid": uid, "op": oc},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#gral_cont").html(data);
            $("#modalgral").modal("show");
        }
    });
}
/*****************GUARDA EL ITEM YA EDITADO ***********************/
function manda_alta()
{
    $.ajax({
        data: $("#formedit").serialize(),
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $("#modalgral").modal('hide');
                $.bootstrapGrowl("actualizado correctamente", {type: 'success'});
                var table = $('#tbl_admin').DataTable();
                table.ajax.reload(function (json) {
                    $('#tbl_admin').val(json.lastInput);
                });
            } else
            {
                $.bootstrapGrowl("Ocurrio un error" + data, {type: 'info'});
            }
        }
    });
}

/**********ELIMINAR LOS ADDONS************/
function deladon(uid, oc) {
    $.ajax({
        data: {"op": oc, "id": uid},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#cont_elimadon").html(data);
            $("#mod_elim").modal('show');
        }
    });
}
function eliminaitem(id)
{
    $.ajax({
        data: {"op": 4, "itm": id},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("ELIMINADO CORRECTAMENTE", {type: 'success'});
                var table = $('#tbl_admin').DataTable();
                table.ajax.reload(function (json) {
                    $('#tbl_admin').val(json.lastInput);
                });
                $("#mod_elim").modal('hide');
            } else
            {
                $.bootstrapGrowl(data, {type: 'warning'});
            }
        }
    });
}
function newcat()
{
    $.ajax({
        data: {"op": 5},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#cont_elimadon").html(data);
            $("#mod_elim").modal('show');
        }
    });
}
function savecat()
{
    $.ajax({
        data: $("#add_cat").serialize(),
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            var nwar = data.split("|");
            switch (nwar[0])
            {
                case '1':
                    $.bootstrapGrowl("Creado con exito", {type: 'success'});
                    $("#mod_elim").modal('hide');
                    $('#tbl_cats tr:last').after(nwar[1]);
                    location.reload();
                    break;
                case '2':
                    $.bootstrapGrowl(nwar[1], {type: 'danger'});
                    break
                case '0':
                    $.bootstrapGrowl(nwar[1], {type: 'danger'});
                    break;
            }
        }
    });
}
function delcat(id)
{
    $.ajax({
        data: {"op": 7, "id": id},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#cont_elimadon").html(data);
            $("#mod_elim").modal('show');
        }
    });
}
function borracat(id)
{
    $.ajax({
        data: {"op": 8, "id": id},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("Eliminado correctamente", {type: 'success'});
                $('#row_' + id).remove();
                $("#mod_elim").modal('hide');
                location.reload();
            } else
            {
                $.bootstrapGrowl(data, {type: 'danger'});
            }
        }
    });
}
function editcat(id)
{
    $.ajax({
        data: {"op": 9, "id": id},
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#cont_elimadon").html(data);
            $("#mod_elim").modal('show');
        }
    });
}
function updacat(id)
{
    $.ajax({
        data: $("#add_cat").serialize(),
        url: "include/modules/property/addons.actions.php",
        type: 'post',
        success: function (data)
        {
            var nwar = data.split("|");
            switch (nwar[0])
            {
                case '1':
                    $.bootstrapGrowl("Actualizado con exito", {type: 'success'});
                    $("#mod_elim").modal('hide');
                    $('#row_' + id).html(nwar[1]);
                    location.reload();
                    break;
                case '2':
                    $.bootstrapGrowl(nwar[1], {type: 'danger'});
                    break
                case '0':
                    $.bootstrapGrowl(nwar[1], {type: 'danger'});
                    break;
            }
        }
    });

}
function updatacampos(name, value)
{
    var pid = $("#idsav").val();
    $.ajax({
        data: {"op": 3, "camp": name, "val": value, "pid": pid},
        url: "include/modules/property/save.dat.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("GUARDADO CON EXITO", {type: 'success'});
            } else
            {
                $.bootstrapGrowl(data, {type: 'danger'});
            }
        }
    });
}
function clon_house(idc, op)
{
    $.ajax({
        data: {"op": 6},
        url: "include/modules/property/save2.dat.php",
        type: 'post',
        success: function (data)
        {
            $("#content_clon").html(data);
            $("#id_clon").val(idc);
            $("#clonehou").modal('show');
        }
    });
}
function do_clon()
{
    var nam = document.getElementById("namealoja").value;
    var idc = document.getElementById("id_clon").value;
    $.ajax({
        data: {"op": 7, "nam": nam, "idc": idc},
        url: "include/modules/property/save2.dat.php",
        type: 'post',
        success: function (data)
        {
            var ar = data.split("|");
            if (ar[0] === '1')
            {
                $("#clonehou").modal('hide');
                $.bootstrapGrowl("CLONADO CON EXITO", {type: 'success'});
                location.href = "./?m=property&s=housing&o=3&id=" + ar[1];
            } else
            {
                $.bootstrapGrowl(ar[1], {type: 'danger'});
            }
        }
    });
}
function clon_addon(id, cid)
{
    var g = $("#rent-name").attr("data-pid");
    //g = 1;
    if (g >= 1)
    {
        var n = $("#ova_" + id + "_0").val();
        var t = $("#textextra_" + id + "_0").val();
        if (n > 0 && t.length > 0)
        {
            var filas = $("#table_" + id + " tbody tr").length;
            var nf = filas + 1;
            var co = 1;
            $("#table_" + id + " thead tr:eq(0)").clone().attr('id', "hij_" + id + "_" + nf).appendTo("#table_" + id + " tbody");
            $("#hij_" + id + "_" + nf + "  input.form-control").each(function () {
                if (co === 1)
                {
                    $(this).attr('id', 'ova_' + id + '_' + nf);
                    $(this).attr('name', 'ova_' + id + '_' + nf);
                    $(this).attr('data-inpt', id);
                    co++;
                } else
                {
                    $(this).attr('id', 'textextra_' + id + '_' + nf);
                    $(this).attr('name', 'textextra_' + id + '_' + nf);
                    $(this).attr('data-txt', id);
                    co = 1;
                }
            });
            $('#hij_' + id + "_" + nf).children('td:eq(2)').html('<a href="javascript:void(0)" onclick="delrowclon(' + id + ',' + nf + ');" class="btn btn-warning "><i class="fa fa-remove "></i></a>');
            $("#ova_" + id + "_0").val('0');
            $("#textextra_" + id + "_0").val('');
            var saved = document.getElementById("row_" + id);
            var ados = saved.getAttribute("data-save");
            var values = $("input[data-inpt='" + id + "']")
                    .map(function () {
                        return $(this).val();
                    }).get();
            var destin = $("input[data-txt='" + id + "']")
                    .map(function () {
                        return $(this).val();
                    }).get();
            $.ajax({
                data: {"op": 1, "val": values, "dest": destin, "cid": cid, "pid": g, "aid": id, "ads": ados},
                url: "include/modules/property/save.dat.php",
                type: 'post',
                success: function (data)
                {
                    var arr = data.split("|");
                    if (arr[0] === '1')
                    {
                        $("#row_" + id).attr("data-save", arr[1]);
                        $.bootstrapGrowl("GUARDADO CORRECTAMENTE", {type: 'success'});
                    } else
                    {
                        $.bootstrapGrowl(arr[1], {type: 'warning'});
                    }
                }
            });
        } else
        {
            $.bootstrapGrowl("Sus valores no son validos", {type: 'warning'});
        }
    } else
    {
        $.bootstrapGrowl("ERROR: No se ha guardado la propiedad", {type: 'danger'});
    }
}
function bluradon(ro)
{
    var saved = document.getElementById("row_" + ro);
    var ados = saved.getAttribute("data-save");
     var values = $("input[data-inpt='" + ro + "']")
                .map(function () {
                    return $(this).val();
                }).get();
        var destin = $("input[data-txt='" + ro + "']")
                .map(function () {
                    return $(this).val();
                }).get();
        $.ajax({
            data: {"op": 2, "upd": 1, "id": ados, "v": values, "d": destin},
            url: "include/modules/property/save.dat.php",
            type: 'post',
            success: function (data)
            {
                var ar = data.split("|");
                if (ar[0] === '1')
                {
                    $("#row_" + ro).attr("data-save", ar[1]);
                    $.bootstrapGrowl("GUARDADO CON EXITO", {type: 'success'});
                } else
                {
                    $.bootstrapGrowl(ar[1], {type: 'danger'});
                }
            }
        });
}
//ELIMINAR LA FILA
function delrowclon(ro, aid)
{
    $("#hij_" + ro + '_' + aid).remove();//eliminar la fila de l atabla
    var fl = $("#table_" + ro + " tbody tr").length;//contar numero de filas en tbody
    var saved = document.getElementById("row_" + ro);
    var ados = saved.getAttribute("data-save");
    if (fl > 0)
    {
        var values = $("input[data-inpt='" + ro + "']")
                .map(function () {
                    return $(this).val();
                }).get();
        var destin = $("input[data-txt='" + ro + "']")
                .map(function () {
                    return $(this).val();
                }).get();
        $.ajax({
            data: {"op": 2, "upd": 1, "id": ados, "v": values, "d": destin},
            url: "include/modules/property/save.dat.php",
            type: 'post',
            success: function (data)
            {
                var ar = data.split("|");
                if (ar[0] === '1')
                {
                    $("#row_" + ro).attr("data-save", ar[1]);
                    $.bootstrapGrowl("GUARDADO CON EXITO", {type: 'success'});
                } else
                {
                    $.bootstrapGrowl(ar[1], {type: 'danger'});
                }
            }
        });
    } else
    {
        $.ajax({
            data: {"op": 2, "upd": 0, "id": ados},
            url: "include/modules/property/save.dat.php",
            type: 'post',
            success: function (data)
            {
                var ar = data.split("|");
                if (ar[0] === '1')
                {
                    $("#row_" + ro).attr("data-save", ar[1]);
                    $.bootstrapGrowl("GUARDADO CON EXITO", {type: 'success'});
                } else
                {
                    $.bootstrapGrowl(ar[1], {type: 'danger'});
                }
            }
        });
    }
}
function savhou(camp, val)
{
    var tit = $("#rent-name").attr("data-save");
    if (tit > 0)
    {
        var pid = $("#rent-name").attr("data-pid");
        var cam = camp.split('-');
        $.ajax({
            data: {"op": 3, "pid": pid, 'camp': cam[1], 'val': val},
            url: "include/modules/property/save.dat.php",
            type: 'post',
            success: function (data)
            {
                var ar = data.split("|");
                if (ar[0] === '1')
                {
                    $.bootstrapGrowl("GUARDADO CON EXITO", {type: 'success'});
                } else
                {
                    $.bootstrapGrowl(ar[1], {type: 'danger'});
                }
            }
        });
    }
    //cuando no se ha guardado la propiedad
    else
    {
        if (val.length > 3 && camp === 'rent-name')
        {
            $.ajax({
                data: {"op": 5, "c": 'name', "v": val},
                url: "include/modules/property/save.dat.php",
                type: 'post',
                success: function (data)
                {
                    var ar = data.split("|");
                    if (ar[0] === '1')
                    {
                        $("#rent-name").attr("data-save", '1');
                        $("#rent-name").attr("data-pid", ar[1]);
                        $.bootstrapGrowl("GUARDADO CON EXITO", {type: 'success'});
                    } else
                    {
                        $.bootstrapGrowl(ar[1], {type: 'danger'});
                    }
                }
            });
        } else
        {
            if ($("#" + camp).attr("type") === 'number')
            {
                $("#" + camp).val("0");
            } else
            {
                $("#" + camp).val("");
            }
            $.bootstrapGrowl("ERROR: el nombre de la propiedad debe tener al menos 3 caracteres", {type: 'danger'});
            document.getElementById("rent-name").focus();
        }
    }
}
function sav_pit(cid, aid, val, chm)
{
    var tit = $("#rent-name").attr("data-save");
    if (tit > 0)
    {
        var err = 0;
        var proc = $.isNumeric(val);
        if (proc === true)
        {
            if (val < 1)
            {
                err++;
            }
        } else
        {
            if (val.length === 0)
            {
                err++;
            }
        }

        if (err === 0)
        {
            var sav = $("#ova_" + aid + "_0").attr("data-save");
            var pid = $("#rent-name").attr("data-pid");
            $.ajax({
                data: {"op": 4, "pid": pid, "cid": cid, "aid": aid, "val": val, "id": sav, "ca": chm},
                url: "include/modules/property/save.dat.php",
                type: 'post',
                success: function (data)
                {
                    var dt = data.split("|");
                    if (dt[0] === '1')
                    {
                        $("#ova_" + aid + "_0").attr("data-save", dt[1]);
                        $.bootstrapGrowl("GUARDADO CON EXITO", {type: 'success'});
                    } else
                    {
                        $.bootstrapGrowl("ERROR:<br>" + dt[1], {type: 'danger'});
                    }
                }
            });
        }
    } else
    {
        $.bootstrapGrowl("ERROR: No se ha guardado la propiedad", {type: 'danger'});
        document.getElementById("rent-name").focus();
    }
}
function savchbox(cid, aid, val)
{
    var tit = $("#rent-name").attr("data-save");
    if (tit > 0)
    {
        var ins = 0;
        if (val === true)
        {
            ins = 1;
        }
        var pid = $("#rent-name").attr("data-pid");
        $.ajax({
            data: {"op": 7, "pid": pid, "cid": cid, "aid": aid, "val": ins},
            url: "include/modules/property/save.dat.php",
            type: 'post',
            success: function (data)
            {

                if (data === '1')
                {
                    $("#ova_" + aid + "_0").attr("data-save", data);
                    $.bootstrapGrowl("GUARDADO CON EXITO", {type: 'success'});
                } else
                {
                    $.bootstrapGrowl("ERROR:<br>" + data, {type: 'danger'});
                }
            }
        });
    } else
    {
        if (val === true)
        {
            document.getElementById("ova_" + aid + "_0").checked = false;
        }
        $.bootstrapGrowl("ERROR: No se ha guardado la propiedad", {type: 'danger'});
        document.getElementById("rent-name").focus();
    }
}
function capacity(nam, val, no)
{
    if (val.length < 1)
    {
        val = 0;
    }
    var tit = $("#rent-name").attr("data-save");
    if (tit > 0)
    {
        var mtot = 0;
        $("input[name='sum\\[\\]']").map(function () {
            if ($(this).val() > 0) {
                mtot += $(this).attr("data-val") * $(this).val();
            }
        }).get();
        $("#capacity").html(mtot);
        $("#capacity_n").val(mtot);
        savhou('rent-capacity', mtot);
    } else
    {
        $.bootstrapGrowl("ERROR: el nombre de la propiedad debe tener al menos 3 caracteres", {type: 'danger'});
        document.getElementById(nam).value = '0';
    }
}
function shlc(id)
{
    switch (id)
    {
        case '1':
            $("#addprov").attr("class", "row");
            $("#showprov").attr("class", "row hidden");
            $("#addloc").attr("class", "row hidden");
            $("#showloc").attr("class", "row hidden");
            $("#addzon").attr("class", "row hidden");
            $("#showzon").attr("class", "row hidden");
            break;
        case '2':
            $("#addprov").attr("class", "row hidden");
            $("#showprov").attr("class", "row");
            $("#addloc").attr("class", "row");
            $("#showloc").attr("class", "row hidden");
            $("#addzon").attr("class", "row hidden");
            $("#showzon").attr("class", "row hidden");
            break;
        case '3':
            $("#addprov").attr("class", "row hidden");
            $("#showprov").attr("class", "row");
            $("#addloc").attr("class", "row hidden");
            $("#showloc").attr("class", "row");
            $("#addzon").attr("class", "row ");
            break;

    }
}
function savdst(ty)
{
    switch (ty)
    {
        case'1':
            var name = $("#provincia").val();
            var tipo = 1;
            var parent = 0;
            break;
        case'2':
            var name = $("#localidad").val();
            var tipo = 2;
            var parent = $("#detprov").val();
            break;
        case'3':
            var name = $("#zona").val();
            var tipo = 3;
            var parent = $("#detloc").val();
            break;
    }
    $.ajax({
        data: {"op": 50, "tipo": tipo, "parent": parent, "name": name},
        url: "include/modules/property/save.dat.php",
        type: 'post',
        success: function (data)
        {
            var arr = data.split("|");
            switch (arr[0])
            {
                case '0':
                    $.bootstrapGrowl(arr[1], {type: 'danger'});
                    break;
                case '1':
                    $.bootstrapGrowl("Guardado Correctamente", {type: 'success'});
                    $("#detprov").append($('<option>', {
                        value: arr[1],
                        text: name
                    }));
                    $("#addprov").attr("class", "row hidden");
                    $("#showprov").attr("class", "row hidden");
                    $("#addloc").attr("class", "row hidden");
                    $("#showloc").attr("class", "row hidden");
                    $("#addzon").attr("class", "row hidden");
                    $("#showzon").attr("class", "row hidden");
                    $("#localidad").val("");
                    $("#provincia").val("");
                    $("#zona").val("");
                    break;
                case '2':
                    $.bootstrapGrowl("Guardado Correctamente", {type: 'success'});
                    $("#addprov").attr("class", "row hidden");
                    $("#showprov").attr("class", "row hidden");
                    $("#addloc").attr("class", "row hidden");
                    $("#showloc").attr("class", "row hidden");
                    $("#addzon").attr("class", "row hidden");
                    $("#showzon").attr("class", "row hidden");
                    $("#localidad").val("");
                    $("#provincia").val("");
                    $("#zona").val("");
                    break;
            }
            $("#localidad").val("");
            $("#provincia").val("");
            $("#zona").val("");
        }
    });
}
function editdst(id)
{
    var vf = $("#text_" + id).html();
    $("#txubic").html(vf);
    $("#editelemnt").modal("show");
    $("#desid").val(id);
}
function delca(id, noom)
{
    if (noom < 1)
    {
        var vf = $("#text_" + id).html();
        $("#delnm").html(vf);
        $("#idname").val(id);
        $("#delthis").modal("show");
    } else
    {
        $("#respuesta").modal("show");
    }
}
function addselect()
{
    var va = $("#addvp").val();
    $("#valmulti").append($('<option>', {
        value: va,
        text: va
    }));
     $("#addvp").val();
}