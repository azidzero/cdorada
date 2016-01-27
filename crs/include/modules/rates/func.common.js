$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
$(function () {
    $("#tar-ini").datepicker({dateFormat: 'dd-mm-yy',
        beforeShow: function () {
            setTimeout(function () {
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        }});
});
$(function () {
    $("#tar-end").datepicker({dateFormat: 'dd-mm-yy',
        beforeShow: function () {
            setTimeout(function () {
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        }
    });
});
$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
    $("#fecha").datepicker();
});
function addtariff()
{
    var vis = document.getElementById("addtar").style.display;
    if (vis === 'none')
    {
        document.getElementById("addtar").style.display = 'inline';
        cleartarifa();
    }
    else if (vis === 'inline')
    {
        document.getElementById("addtar").style.display = 'none';
    }

}
function savetarriff()
{
    $.ajax({
        data: $("#savetariff").serialize(),
        url: "include/modules/rates/save.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            if (data == 1)
            {
                $("#addtar").hide();
                $("#mod_elim").modal('hide');
                $.bootstrapGrowl("guardado exitosamente", {type: 'success'});
                var table = $('#rates_tbl').DataTable();
                table.ajax.reload(function (json) {
                    $('#rates_tbl').val(json.lastInput);
                });
                document.getElementById("savetariff").reset();
            }
            else
            {
                $.bootstrapGrowl(data, {type: 'warning'});
            }
        }
    });
}
function deltariff(uid, oc)
{
    $.ajax({
        method: "POST",
        url: "include/modules/rates/catalog.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json'
    }).done(function (json) {
        if (json == '1')
        {
            $.bootstrapGrowl("Guardado correctamente", {type: 'success'});
            var table = $('#rates_tbl').DataTable();
            table.ajax.reload(function (json) {
                $('#rates_tbl').val(json.lastInput);
            });
        }
        else
        {
            $.bootstrapGrowl(json, {type: 'warning'});
        }
    });
}
function getJson(uid, oc) {
    $.ajax({
        method: "POST",
        url: "include/modules/rates/catalog.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        //$("#addtar").show();
        document.getElementById("addtar").style.display = 'inline';
        $("#tar-title").val(json.title);
        var fecha = json.date_ini.split("-");
        var fecha2 = json.date_end.split("-");
        $("#tar-ini").val(fecha[2] + "-" + fecha[1] + "-" + fecha[0]);
        $("#tar-end").val(fecha2[2] + "-" + fecha2[1] + "-" + fecha2[0]);
        $("#tar-price").val(json.diario);
        $("#tar-price2").val(json.semanal);
        $("#tar-reb").val(json.descu);
        $("#isedit").val(json.id);
        $("#tar-estan").val(json.minimo);
    });
}
function guardatarifa()
{
    var tit = document.getElementById("tar-title").value;
    var di = document.getElementById("tar-ini").value;
    var de = document.getElementById("tar-end").value;
    var cost = document.getElementById("tar-price").value;
    var edit = document.getElementById("isedit").value;
    var asig = document.getElementById("tar-asig").value;
    var det = document.getElementById("rat-detail").value;
    var op = document.getElementById("op").value;
    if (tit.lenght >= 1 || di.length >= 1 || de.length >= 1 || cost >= 1)
    {
        switch (op)
        {
            case '0':
                $.ajax({
                    data: {"op": op, "isedit": edit, "tar-title": tit, "tar-ini": di, "tar-end": de, "tar-price": cost, "tar-asig": asig, "rat-detail": det},
                    url: "include/modules/rates/save.dat.php",
                    type: 'post',
                    beforeSend: function () {
                    },
                    success: function (data)
                    {
                        var pos = data.indexOf("|");
                        if (pos >= 1)
                        {
                            var res = data.split("|");
                            document.getElementById("isedit").value = res[0];
                            document.getElementById("op").value = res[1];
                            $('#tabla_tarifa tr:first').after('<tr><td>' + di + '</td><td>' + de + '</td><td>' + cost + '</td><td>' + res[2] + '</td></tr>');//agregamos los datos a la tabla
                            document.getElementById("tar-ini").value = "";//limpiamos campo
                            document.getElementById("tar-end").value = "";//limpiamos campo
                            document.getElementById("tar-price").value = "";//limpiamos campo
                            document.getElementById("tar-title").disabled = true;
                            document.getElementById("tar-asig").disabled = true;
                            $.bootstrapGrowl("Guardado correctamente", {type: 'success'});
                        }
                        else
                        {
                            $.bootstrapGrowl(data, {type: 'warning'});
                        }
                    }
                });
                break;
            case '1':
            {
                $.ajax({
                    data: {"op": op, "isedit": edit, "tar-ini": di, "tar-end": de, "tar-price": cost},
                    url: "include/modules/rates/save.dat.php",
                    type: 'post',
                    beforeSend: function () {
                    },
                    success: function (data)
                    {
                        //$.bootstrapGrowl(data, {type: 'info'});
                        var pos = data.indexOf("|");
                        if (pos >= 1)
                        {
                            var res = data.split("|");
                            document.getElementById("isedit").value = res[0];
                            document.getElementById("op").value = res[1];
                            $('#tabla_tarifa tr:first').after('<tr><td>' + di + '</td><td>' + de + '</td><td>' + cost + '</td><td>' + res[2] + '</td></tr>');//agregamos los datos a la tabla
                            document.getElementById("tar-ini").value = "";//limpiamos campo
                            document.getElementById("tar-end").value = "";//limpiamos campo
                            document.getElementById("tar-price").value = "";//limpiamos campo
                            $.bootstrapGrowl("Guardado correctamente", {type: 'success'});
                        }
                        else
                        {
                            $.bootstrapGrowl(data, {type: 'warning'});
                        }
                    }
                });
            }
        }
    }
    else
    {
        $.bootstrapGrowl("Verifique todos sus datos", {type: 'info'});
    }

}
function cleartarifa()
{
    document.getElementById("tar-title").value = "";
    document.getElementById("tar-ini").value = "";
    document.getElementById("tar-end").value = "";
    document.getElementById("tar-price").value = "";
    document.getElementById("tar-price2").value = "";
    document.getElementById("tar-reb").value = "";
    document.getElementById("op").value = "0";
    document.getElementById("isedit").value = "0";
}
function addtartoprop(id)
{
    document.getElementById("ioferta").value = id;
    $.ajax({
        data: {"op": '1', "idof": id, "x": ""},
        url: "include/modules/rates/save.dat.php",
        type: 'post',
        success: function (data)
        {
            $("#procont").html(data);
            $("#addpro").modal('show');
        }
    });
}
function searchhouse(text)
{
    var id = document.getElementById("ioferta").value;
    $.ajax({
        data: {"op": '1', "idof": id, "x": text},
        url: "include/modules/rates/save.dat.php",
        type: 'post',
        success: function (data)
        {
            $("#procont").html(data);
        }
    });
}
function upproperty(id, rid)
{
    $.ajax({
        data: {"op": '2', "pid": id, "rid": rid},
        url: "include/modules/rates/save.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("Guardado correctamente", {type: 'success'});
            }
            else
            {
                $.bootstrapGrowl(data, {type: 'warning'});
            }
        }
    });
}

/*NUEVAS FUNCIONES*/
function swhaddrate()
{
    $("#namewindow").html("NUEVO");
    $.ajax({
        data: {"op": '100'},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#bodytar").html(data);
        }
    });
    $("#adt").modal("show");
    //document.getElementById("op").value = "1";
    $("#t_title").focus();

}
function autosavetitle()
{
    var titulo = document.getElementById("t_title").value;
    var sav = document.getElementById("idtar").value;
    if (sav<1)
    {
        $.ajax({
            data: {"op": '0', "tit": titulo},
            url: "include/modules/rates/rates.actions.php",
            type: 'post',
            success: function (data)
            {
                var t = data.split("|");
                switch (t[0])
                {
                    case '1':
                        $.bootstrapGrowl("Nombre de la tarifa Guardada Correctamente", {type: 'success'});
                        $("#ratetitle").html("<h4><B>" + titulo + "</B></h4>");
                        $("#idtar").val(t[1]);
                        $('#newtar').prop('disabled', false);
                        $("#c_periodos").html('<table id="table_per" class="table table-condensed" id="t_rang"><thead><tr class="text-capitalize table-bordered"><th></th><th>Comienza</th><th>Finaliza</th><th>Estancia Minima</th><th>Precio Diario</th><th>% Reducci&oacute;n</th><th>D&iacute;a de entrada</th><th>D&iacute;a de salida</th><th>Acciones</th></tr></thead><tbody></tbody></table>')
                        filtratabla(titulo, 110);
                        break;
                    case '0':
                        $.bootstrapGrowl(t[1], {type: 'Danger'});
                        break;
                }
            }
        });
    }
    else
    {
        $.ajax({
            data: {"op": '10', "tit": titulo,"grd":sav},
            url: "include/modules/rates/rates.actions.php",
            type: 'post',
            success: function (data)
            {
                var t = data.split("|");
                switch (t[0])
                {
                    case '1':
                        $.bootstrapGrowl("Nombre de la tarifa Actualizada Correctamente", {type: 'success'});
                        $("#ratetitle").html("<h4><B>" + titulo + "</B></h4>");
                        filtratabla(titulo, 110);
                        break;
                    case '0':
                        $.bootstrapGrowl(t[1], {type: 'Danger'});
                        break;
                }
            }
        });
    }
}
function changeres(res)
{
    console.log(res);
    if (res === '1')
    {
        $('#tar-checkout').prop('disabled', false);
        $('#tar-checkin').prop('disabled', false);
    }
    else
    {
        $('#tar-checkout').prop('disabled', true);
        $('#tar-checkin').prop('disabled', true);
    }

}
function saveperiodo()
{
    var isg = document.getElementById("idtar").value;
    var perio = document.getElementById("idperiodo").value;
    if (isg >= 1)
    {
        if (perio === '0')
        {
            $.ajax({
                data: $("#newtar").serialize(),
                url: "include/modules/rates/rates.actions.php",
                type: 'post',
                success: function (data)
                {
                    var arr = data.split("|");
                    switch (arr[0])
                    {
                        case '1':
                            $.ajax({
                                data: {"op": 102, "rid": isg},
                                url: "include/modules/rates/rates.actions.php",
                                type: 'post',
                                success: function (data)
                                {
                                    $("#c_periodos").html(data);
                                }
                            });
                            document.getElementById("newtar").reset();
                            $('#tar-checkout').prop('disabled', true);
                            $('#tar-checkin').prop('disabled', true);
                            document.getElementById("idtar").value = isg;
                            $.bootstrapGrowl("GUARDADO CORRECTAMENTE", {type: 'success'});
                            break;
                        default:
                            $.bootstrapGrowl(arr[0], {type: 'Danger'});
                            break;
                    }
                }
            });
        }
        else
        {
            //update
            document.getElementById("op").value = "10";
            $.ajax({
                data: $("#newtar").serialize(),
                url: "include/modules/rates/save.dat.php",
                type: 'post',
                success: function (data)
                {
                    var dat = data.split("|");
                    switch (dat[0])
                    {
                        case '1':
                            $.bootstrapGrowl("GUARDADO CORRECTAMENTE", {type: 'success'});
                            document.getElementById("newtar").reset();
                            $('#tar-checkout').prop('disabled', true);
                            $('#tar-checkin').prop('disabled', true);
                            $("#data_" + perio).children().remove();
                            $("#data_" + perio).append(dat[1]);
                            document.getElementById("idtar").value = isg;
                            document.getElementById("op").value = "1";
                            modif(isg);
                            break;
                        default:
                            $.bootstrapGrowl(dat[1], {type: 'Danger'});
                            break;
                    }

                }
            });
        }
    }
    else
    {
        $.bootstrapGrowl("NO SE HA GUARDADO EL NOMBRE DE LA TARIFA, VERIFIQUE PORFAVOR", {type: 'Danger'});
    }
}
function showDetail(id) {
    var a = $('#btn-' + id).hasClass('open');
    var ctl = "";
    if (a === true) {
        $('#btn-' + id).removeClass('open').html('<i class="fa fa-chevron-down"></i>');
        $('#details-' + id).remove();
    } else {
        $('#btn-' + id).addClass('open').html('<i class="fa fa-chevron-up"></i>');
        $.ajax({
            data: {"op": 101, "id": id},
            url: "include/modules/rates/rates.actions.php",
            type: 'post',
            success: function (data)
            {
                $('#btn-' + id).parent().parent().after('<tr id="details-' + id + '"><td colspan="3">' + data + '</td></tr>');
            }
        });
    }
}
function editaperiodos(rid)
{

    $.ajax({
        data: {"op": '100'},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#bodytar").html(data);
        }
    });
    $.ajax({
        data: {"op": 102, "rid": rid},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#c_periodos").html(data);
        }
    });
    $.ajax({
        data: {"op": 103, "rid": rid},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#t_title").val(data);
            document.getElementById("idtar").value = rid;
        }
    });
    $("#namewindow").html("Editar");
    $("#adt").modal("show");
}
function edit_tar(rid)
{
    $.ajax({
        method: "POST",
        url: "include/modules/rates/catalog.json.php",
        data: {"id": rid, "op": "100"},
        dataType: 'json'
    }).done(function (json) {
        $("#tar-ini").val(json.date_ini);
        $("#tar-end").val(json.date_end);
        $("#tar-estan").val(json.mini);
        $("#tar-reb").val(json.des);
        $("#tar-price_s").val(json.semanal);
        $("#tar-price").val(json.diario);
        $("#tar-ing").val(json.restringir);
        if (json.restringir === '1')
        {
            $('#tar-checkout').prop('disabled', false);
            $('#tar-checkin').prop('disabled', false);
        }
        else
        {
            $('#tar-checkout').prop('disabled', true);
            $('#tar-checkin').prop('disabled', true);
        }
        $("#tar-checkin").val(json.checkin);
        $("#tar-checkout").val(json.checkout);
        $("#idperiodo").val(json.id);
        modif(rid);
    });
}
function removetar(id)
{
    $("#delper").modal("show");
    $("#el_id").val(id);

}
function del_per()
{
    $.ajax({
        method: "POST",
        url: "include/modules/rates/catalog.json.php",
        data: {"id": document.getElementById("el_id").value, "op": 101},
        dataType: 'json'
    }).done(function (json) {
        if (json === '1')
        {
            $.bootstrapGrowl("Eliminado correctamente", {type: 'success'});
            $('#data_' + document.getElementById("el_id").value).remove();
            $("#delper").modal("hide");
        }
        else
        {
            $.bootstrapGrowl(json, {type: 'warning'});
        }
    });
}
function duplicate(tid)
{
    document.getElementById("namedup").value = null;
    document.getElementById("idclon").value = 0;
    $("#duplicate_tarifa").modal("show");
    document.getElementById("idclon").value = tid;

}
function doclon()
{
    var nam = document.getElementById("namedup").value;
    var idc = document.getElementById("idclon").value;
    if (nam.length > 1)
    {
        $.ajax({
            method: "POST",
            url: "include/modules/rates/catalog.json.php",
            data: {"op": 102, "copy": idc, "name": nam},
            dataType: 'json'
        }).done(function (json) {
            if (json === '1')
            {
                $.bootstrapGrowl("Clonado correctamente", {type: 'success'});
                $("#duplicate_tarifa").modal("hide");
                filtratabla(nam, 110);
                document.getElementById("search_tar").value = nam;
                document.getElementById("namedup").value = null;
                document.getElementById("idclon").value = 0;
            }
            else
            {
                $.bootstrapGrowl(json, {type: 'warning'});
            }
        });
    }
    else
    {
        $.bootstrapGrowl("Llene un nombre para la tarifa que desea duplicar", {type: 'warning'});
        document.getElementById("namedup").focus();
    }
}
function modif(rid)
{
    $.ajax({
        method: "POST",
        url: "include/modules/rates/catalog.json.php",
        data: {"id": rid, "op": 103},
        dataType: 'json'
    }).done(function (json) {
    });
}
function showdetail(rid)
{
    $.ajax({
        data: {"op": 104, "rid": rid},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#detailtar").html(data);
            $("#detail").modal("show");
        }
    });
}

function priced(val)
{
    val = val / 7;
    var decimales = 2;
    var flotante = parseFloat(val);
    var resultado = Math.round(flotante * Math.pow(10, decimales)) / Math.pow(10, decimales);
    $("#tar-price").val(resultado);

}
function checadate()
{
    var pr = document.getElementById("idperiodo").value;
    if (pr === '0')
    {
        var tar = document.getElementById("idtar").value;
        var fecha = document.getElementById("tar-ini").value;
        $.ajax({
            method: "POST",
            url: "include/modules/rates/catalog.json.php",
            data: {"op": 200, "fecha": fecha, "tarifa": tar},
            dataType: 'json'
        }).done(function (json) {
            var resp = json.split("|");
            if (resp[0] === '1')
            {
                $.bootstrapGrowl("Esta fecha ya tiene una tarifa asignada", {type: 'warning'});
                document.getElementById("tar-ini").value = resp[1];
                document.getElementById("tar-end").value = resp[1];
                checadate();
            }
        });
    }
}
function checadatend()
{

    var pr = document.getElementById("idperiodo").value;
    if (pr === '0')
    {
        var tar = document.getElementById("idtar").value;
        var fecha = document.getElementById("tar-end").value;
        $.ajax({
            method: "POST",
            url: "include/modules/rates/catalog.json.php",
            data: {"op": 200, "fecha": fecha, "tarifa": tar},
            dataType: 'json'
        }).done(function (json) {
            var resp = json.split("|");
            if (resp[0] === '1')
            {
                $.bootstrapGrowl("Esta fecha ya tiene una tarifa asignada", {type: 'warning'});
                document.getElementById("tar-end").value = resp[1];
                checadate();
            }
        });
    }
}
function filtratabla(nam, op)
{
    $.ajax({
        data: {"op": op, "nam": nam},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#container_tarifa").html(data);
        }
    });
}
function delrangos(id)
{

    $.ajax({
        data: {"op": 111, "id": id},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#mdl_conten").html(data);
            $("#mdl_gen").modal("show");
        }
    });
}

function do_del_per(rid)
{
    $.ajax({
        data: {"op": 112, "rid": rid},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            var nw = data.split("|");
            if (nw[0] === '1')
            {
                $.bootstrapGrowl("Vaciado exitosamente", {type: 'success'});
                filtratabla("", 110);
                $("#mdl_gen").modal("hide");
            }
            else
            {
                $.bootstrapGrowl(nw[1], {type: 'warning'});
            }
        }
    });
}
function del_tarifa(id)
{
    $.ajax({
        data: {"op": 113, "id": id},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            $("#mdl_conten").html(data);
            $("#mdl_gen").modal("show");
        }
    });
}
function do_del_tarifa(tid, op)
{
    $.ajax({
        data: {"op": 114, "id": tid, "ext": op},
        url: "include/modules/rates/rates.actions.php",
        type: 'post',
        success: function (data)
        {
            var res = data.split("|");
            if (res[0] === '1')
            {
                $.bootstrapGrowl("Eliminado exitosamente", {type: 'success'});
                filtratabla("", 110);
                $("#mdl_gen").modal("hide");
            }
            else
            {
                $.bootstrapGrowl(res[1], {type: 'warning'});
            }
        }
    });
}