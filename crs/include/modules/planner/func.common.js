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
    $("#ini").datepicker({dateFormat: 'dd-mm-yy', minDate: 'today'});
    $("#end").datepicker({dateFormat: 'dd-mm-yy'});
});
function showprecio(a) {
    if (a.length >= 1)
    {
        $.ajax({
            data: {op: 0, id: a},
            url: "include/modules/planner/save.dat.php",
            type: 'post',
            beforeSend: function () {

            },
            success: function (data)
            {
                document.getElementById("micosto").innerHTML = data;
                document.getElementById("pricend").value = data;
            }
        });
    }
    else
    {
        document.getElementById("micosto").innerHTML = "0.00";
    }
}
function agen(ag) {
    if (ag === '0')
    {
        document.getElementById("agencia").style.display = "inline";
    }
    else
    {
        document.getElementById("agencia").style.display = "none";
    }
}
function sumacomplementos() {
    var prec = document.getElementById("costcom").value;
    //var depo = document.getElementById("depocom").value;-->
    var depo = 0;
    var cant = document.getElementById("cantcomp").value;
    if (prec.length <= '0')
    {
        prec = 0;
    }
    /* if (depo.length <= '0')
     {
     depo = 0;
     }*/
    if (cant.length <= '0')
    {
        cant = 0;
    }
    var sum = parseInt(prec) + parseInt(depo);
    var end = sum * parseInt(cant);
    if (end <= 0)
    {
        end = "0.00";
    }
    //console.log(end);
    document.getElementById("totcom").value = end;
}
function addcom() {
    var sumc = document.getElementById("complement").value;//total de complementos
    var comple = document.getElementById("namecom").value;//nombre de complemento
    var prec = document.getElementById("costcom").value;//costo
    var tot = document.getElementById("totcom").value;//total
    var cant = document.getElementById("cantcomp").value;//numero
    var yea = tablecomplemento.rows.length;//numero de filas de la tabla
    var ctot = document.getElementById("pricend").value;
    var totextras = (parseInt(sumc) + parseInt(tot));
    document.getElementById("complement").value = totextras;
    yea = yea + 1;//siguiente numero de fila de la tabla
    if (comple.length >= 1)
    {
        $('#tablecomplemento tr:last').after('<tr id="row' + yea + '"><td><input type="text" name="namecom[]" class="hidden" value=" ' + comple + '"><label></label>' + comple + '</td><td>' + cant + ' <input type="text" name="c_comp[]" value="' + cant + '" class="hidden"></td><td>' + prec + '<input type="text" value="' + prec + '" name="c_unit[]" class="hidden"></td><td>' + tot + '</td><td><label class="btn btn-warning" onclick="delrow(\'row' + yea + '\');" ><span class="fa fa-minus"></span></label></td></tr>');
        var adsum = parseInt(tot) + parseInt(ctot);
        document.getElementById("pricend").value = adsum;
        document.getElementById("micosto").innerHTML = adsum;
    }
}
function delrow(ro) {
    var ptt = document.getElementById("pricend").value;
    var cplem = document.getElementById("complement").value;
    var linea = document.getElementById("tot_" + ro).value;
    document.getElementById(ro).style.display = "none";
    var restado = cplem - linea;
    var pttres = ptt - linea;
    document.getElementById("complement").value = restado;
    document.getElementById("pricend").value = pttres;
    document.getElementById("micosto").innerHTML = pttres;
}
function cambiatotal() {
    var i = document.getElementById("ini").value;
    var e = document.getElementById("end").value;
    var aFecha1 = i.split('-');
    var aFecha2 = e.split('-');
    var fFecha1 = Date.UTC(aFecha1[2], aFecha1[1] - 1, aFecha1[0]);
    var fFecha2 = Date.UTC(aFecha2[2], aFecha2[1] - 1, aFecha2[0]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    var c = document.getElementById("pricend").value;
    var fin = c * dias;
    document.getElementById("pricend").innerHTML = fin;
    document.getElementById("micosto").innerHTML = fin;
}
function datesuger(fecha) {
    // document.getElementById("pid").value = "";
    // var idp = document.getElementById("property-id").value;
    /* if (idp === '0')
     {
     $.bootstrapGrowl("Seleccione una propiedad", {type: 'danger'});
     $("#aloja").focus();
     }
     else
     {*/
    var di = fecha;
    var d = 8;
    var Fecha = new Date();
    var sFecha = fecha || (Fecha.getDate() + "-" + (Fecha.getMonth() + 1) + "-" + Fecha.getFullYear());
    var sep = sFecha.indexOf('-') != -1 ? '-' : '-';
    var aFecha = sFecha.split(sep);
    var fecha = aFecha[2] + '-' + aFecha[1] + '-' + aFecha[0];
    fecha = new Date(fecha);
    fecha.setDate(fecha.getDate() + parseInt(d));
    var anno = fecha.getFullYear();
    var mes = fecha.getMonth() + 1;
    var dia = fecha.getDate();
    mes = (mes < 10) ? ("0" + mes) : mes;
    dia = (dia < 10) ? ("0" + dia) : dia;
    var fechaFinal = dia + sep + mes + sep + anno;
    $("#end").val(fechaFinal);
    var cmpl = document.getElementById("complement").value;
    $("#aloja").autocomplete({
        minLength: 0,
        source: "include/modules/planner/autocomplete.php?op=1&i=" + di + "&f=" + fechaFinal,
        focus: function (event, ui) {
            $("#aloja").val(ui.item.label);
            return false;
        },
        select: function (event, ui) {
            $("#aloja").val(ui.item.label);
            $("#property-id").val(ui.item.value);
            $("#oferta-id").val(ui.item.idoferta);
            generalaoferta(ui.item.idoferta, di, fechaFinal, ui.item.value);
            return false;
        }
    });
    /*  if (idp !== 0)
     {
     $.ajax({
     data: {"op": 0, "idp": idp, "d_i": di, "d_f": fechaFinal},
     url: "include/modules/planner/search.data.php",
     type: 'post',
     success: function (data)
     {
     var res = data.split("|");
     var tyc = parseInt(res[1]) + parseInt(cmpl);
     switch (res[0])
     {
     case '0':
     //console.log(res);
     document.getElementById("micosto").innerHTML = tyc;
     document.getElementById("pricend").value = tyc;
     
     break;
     case '1':
     document.getElementById("micosto").innerHTML = "0.00";
     $.bootstrapGrowl(res[1], {type: 'danger'});
     break;
     }
     }
     });*/
    // }
    // }
}

function changeend() {
    var idp = document.getElementById("property-id").value;
    var di = document.getElementById("ini").value;
    var df = document.getElementById("end").value;
    var compl = document.getElementById("complement").value;
    if (idp === '0')
    {
        $.bootstrapGrowl("Seleccione una propiedad", {type: 'danger'});
        $("#aloja").focus();
    }
    else
    {
        $.ajax({
            data: {"op": 0, "idp": idp, "d_i": di, "d_f": df},
            url: "include/modules/planner/search.data.php",
            type: 'post',
            success: function (data)
            {
                var res = data.split("|");
                var mitotal = res[1] + compl;
                switch (res[0])
                {
                    case '0':

                        document.getElementById("micosto").innerHTML = mitotal;
                        document.getElementById("pricend").value = mitotal;
                        break;
                    case '1':
                        document.getElementById("micosto").innerHTML = "0.00";
                        $.bootstrapGrowl(res[1], {type: 'danger'});
                        break;
                }
            }
        });
    }
}
function resetprice() {
    var tcomp = document.getElementById("complement").value;
    document.getElementById("pricend").value = tcomp;
    document.getElementById("micosto").innerHTML = tcomp;
    document.getElementById("ini").value = "";
    document.getElementById("end").value = "";
}

function searchin() {
    var ty = document.getElementById("por").value;
    switch (ty)
    {
        case '0':
            //  alert("agencia");
            break;
        case '1':
            $.ajax({
                data: {"op": 1},
                url: "include/modules/planner/search.data.php",
                type: 'post',
                success: function (data)
                {
                    $("#body-multimodal").html(data);
                }
            });
            break;
        case '2':
            //alert("propietario");
            break;
    }
    $("#multimodal").modal("show");
}
function selcustomer(ccus, inqui) {
    document.getElementById("cus-id").value = ccus;
    document.getElementById("inquilino").value = inqui;
    $("#multimodal").modal("hide");
}
function addcustomer() {
    $("#modalcusto").modal('show');
}
function savecus() {
    $.ajax({
        data: $("#frmcus").serialize(),
        url: "include/modules/planner/search.data.php",
        type: 'post',
        success: function (data)
        {
            switch (data)
            {
                case'1':
                    $.bootstrapGrowl("Guardado con &Eacute;xito", {type: 'success'});
                    var table = $('#tbl_cust').DataTable();
                    table.ajax.reload(function (json) {
                        $('#tbl_cust').val(json.lastInput);
                    });
                    $("#modalcusto").modal('hide');
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'warning'});
                    break;
            }
        }
    });
}

$(function () {
    $("#namecom").autocomplete({
        minLength: 0,
        source: "include/modules/planner/autocomplete.php?op=0",
        focus: function (event, ui) {
            $("#namecom").val(ui.item.label);
            return false;
        },
        select: function (event, ui) {
            $("#namecom").val(ui.item.label);
            $("#compval").val(ui.item.value);
            $("#costcom").val(ui.item.price);
            $("#totcom").val(ui.item.price);
            return false;
        }
    });
});

function generalaoferta(ido, ini, end, pid) {
    $.ajax({
        data: {"ido": ido, "ini": ini, "end": end, "pid": pid},
        url: "include/modules/planner/create.offer.php",
        type: 'post',
        success: function (data)
        {
        }
    });
}
function changedate() {
    var ido = document.getElementById("oferta-id").value;
    var pid = document.getElementById("property-id").value;
    var ini = document.getElementById("ini").value;
    var end = document.getElementById("end").value;
    if (ido !== 0 & pid !== 0)
    {
        $.ajax({
            data: {"ido": ido, "ini": ini, "end": end, "pid": pid},
            url: "include/modules/planner/create.offer.php",
            type: 'post',
            success: function (data)
            {
            }
        });
    }
}


///funcion modal reserva
function reserva_sh(pid, ini) {
    $.ajax({
        data: {"pid": pid, "ini": ini},
        url: "include/modules/planner/reserva.ajax.php",
        type: 'post',
        success: function (data)
        {
            $("#cont_reserva").html(data);
            $("#modal_reserva").modal('show');
        }
    });
}
//CHECAR DISPONIBILIDAD
function piddisp(pid) {
    var ini = $("#ini").val();
    var end = $("#end").val();
    $.ajax({
        method: 'POST',
        url: 'include/modules/planner/disponibilidad.ajax.php',
        data: {'pid': pid, 'dini': ini, 'dend': end},
        dataType: 'JSON'
    }).done(function (response) {
        if (response.status == "OK") {
            $('#status').attr('class', 'label label-success').html('DISPONIBLE');
        } else {
            $('#status').attr('class', 'label label-danger').html('NO DISPONIBLE');
        }
    });
}

function res() {
    var w = $(window).width() - $('#sidebar').width() - 24 - 16;
    $('.plan_main').width(w);
    $('#table_main').width(w);
    var wa = 196;
    var wb = w - wa;
    var a = $(window).height() - 240;
    $('.pro_res_body').parent('td').width(wa);
    $('.pro_res_body').width(wa);
    $('.plan_res_body').parent('td').width(wb);
    $('.hdr_calendar').parent('td').width(wb);
    $('.plan_res_body').width(wb);
    $('.hdr_calendar').width(wb);
    $('.pro_res_body').height(a - 16).css('overflow-y', 'scroll');
    $('.plan_res_body').height(a).css('overflow-y', 'scroll');
}/* Resize Window Controller */

function newBook(x, pid, fecha) {

    $.ajax({
        method: "POST",
        url: "include/modules/planner/reserva.ajax.php",
        data: {"pid": pid, "fecha": fecha},
    }).done(function (msg) {
        $('#diag-content').html(msg);
        $('#diag-reserva').modal("show");
    });
}/* Crea la reserva */

function loadMore() {
    var a = $('#page').val();
    $.ajax({
        method: 'POST',
        url: 'include/modules/planner/grid.planner.php',
        data: {'page': a},
        dataType: 'JSON'
    }).done(function (res) {
        var pro = res.pro;
        var n = pro.length;
        for (i = 0; i < n; i++) {
            var htm = "<tr data-pid=\"" + pro[i].id + "\">";
            htm += "<td>" + pro[i].title + "</td>";
            htm += "<td>" + pro[i].room + "</td>";
            htm += "<td>" + pro[i].capacity + "</td>";
            htm += "</tr>";
            $('.tbl-pro tbody').append(htm);
        }
        var grid = res.grid;
    });
}/* LazyLoader para los datos */
function loadReserva() {
    /*
     var w = 24;
     var state = "res_stats_free";
     var html = "<div class=\"res_block\" style=\"left: " + x + "px;width:" + w + "px;\">";
     html += "<!-- <a class=\"btn btn-xs btn-primary pull-right\" href=\"javascript:void(0)\"><i class=\"fa fa-times\"></i></a> -->";
     html += "<div class=\"res_status " + state + "\"></div>&nbsp;";
     html += "<div class=\"res_bstatus\"></div>";
     html += "</div>";
     $('div.plan_res_row[data-pid=' + pid + "]").append(html);
     */
}