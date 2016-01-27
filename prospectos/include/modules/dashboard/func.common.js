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
$(function () {
    $("#searpros").datepicker({dateFormat: 'dd-mm-yy'});
    $('#searpros').css('zIndex', 999999);
});
$("#mimapa").gmap3();
function cont_dire(dir)
{
    $("#mytesting").gmap3({
        marker: {
            id: "dire",
            address: dir
        },
        map: {
            options: {
                zoom: 5
            }
        },
        autofit: {}
    });
}
function mymapload(dir)
{
    $("#mimapa").gmap3({
        marker: {
            id: "direcc",
            address: dir
        },
        map: {
            options: {
                zoom: 9
            }
        },
        autofit: {}
    });
}
function shwdiv(id)
{
    switch (id)
    {
        case 1:
            document.getElementById("captacion").style.display = "none";
            document.getElementById("mantenim").style.display = "none";
            document.getElementById("corp").style.display = "inline";
            break;
        case 2:
            document.getElementById("corp").style.display = "none";
            document.getElementById("mantenim").style.display = "none";
            document.getElementById("captacion").style.display = "inline";
            break;
        case 3:
            document.getElementById("corp").style.display = "none";
            document.getElementById("captacion").style.display = "none";
            document.getElementById("mantenim").style.display = "inline";
            $.ajax({
                data: {"op": 0},
                url: "include/modules/dashboard/mant.inc.php",
                type: 'post',
                success: function (data)
                {
                    $("#man_cont").html(data);
                }
            });
            break;
    }

}

function aggre(ppid)
{
    $.ajax({
        data: {"op": 1, "id": ppid},
        url: "include/modules/dashboard/actions.data.php",
        type: 'post',
        success: function (data)
        {
            $("#bodyagregacomentario").html(data);
            $("#agregacomentario").modal('show');
        }
    });

}
function savecoment(ppid)
{
    var txt = document.getElementById("miscomentarios").innerHTML;
    txt = txt + "<br>" + document.getElementById("addc").value;
    $.ajax({
        data: {"op": 2, "id": ppid, "text": txt},
        url: "include/modules/dashboard/actions.data.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $("#agregacomentario").modal('hide');
                document.getElementById("miscomentarios").innerHTML = txt;
            }
            else
            {
                $.bootstrapGrowl("ERROR AL GUARDAR LOS DATOS", {type: 'danger'});
            }

        }
    });
}
function saveprospecto()
{
    var val = null;
    var ax = 1;
    var err = 0;
    var camp = null;
    for (ax = 0; ax < 7; ax++)
    {
        val = document.getElementById('Fil' + ax).value;
        camp = document.getElementById("title" + ax).innerHTML;
        if (val.length === 0)
        {
            //$.bootstrapGrowl("llene el campo" + camp, {type: 'warning'});
            camp = null;
            //err++;
        }
        val = null;
    }
    if (err === 0)
    {
        var arr = [];
        var a = 0;
        for (a = 1; a <= 5; a++)
        {
            arr[a] = document.getElementById('Fil' + a).value;
        }
        err = 0;
        $.ajax({
            data: $("#frmprospect").serialize(),
            url: "include/modules/dashboard/save.prospect.php",
            type: 'post',
            beforeSend: function () {
            },
            success: function (data)
            {
                switch (data)
                {
                    case 'Error':
                        $.bootstrapGrowl("ERROR AL GUARDAR LOS DATOS", {type: 'danger'});
                        break;
                    default:
                        $.bootstrapGrowl("GUARDADO CON EXITO", {type: 'success'});
                        $("#idprospecto").val(data);
                        document.getElementById("frmprospect").reset();
                        document.getElementById("apn").style.display = 'none';
                        document.getElementById("subeimagen").style.display = 'inline';
                        var axid = document.getElementById("idprospecto").value;
                        $.ajax({
                            data: {"id": axid},
                            url: "include/modules/dashboard/upload.image.php",
                            type: 'post',
                            success: function (data)
                            {
                                document.getElementById("subeimagen").innerHTML = data;
                                $("div#mizona").dropzone({
                                    url: "content/upload/property/upload.inc.php?id=" + document.getElementById("idprospecto").value
                                });
                            }
                        });
                        break;
                }
            }
        });
    }
}
function imgProOpen(img) {
    var ang = parseInt(360) - parseInt(document.getElementById("ang_" + img + "_m.jpg").value);
    var htm = "<img src=\"content/upload/property/" + img + "_m.jpg\" class=\"img-thumbnail\" id='img_bigp'name='img_bigp'/>";
    $('#modProsContent').html(htm);
    $('#modPros').modal('show');
    $("#img_bigp").rotate(ang);
}
function imgProOpen2(img) {
    var htm = "<img src=\"content/upload/incidence/" + img + "_m.jpg?"+Math.random()+"\" class=\"img-thumbnail\" id='img_bigp'name='img_bigp'/>";
    $('#modProsimage').html(htm);
    $('#image_content').modal('show');
}
function search_p()
{
    $("#resultable").val();
    document.getElementById("searchpros").style.display = "inline";
    var busca = document.getElementById("searchpros").value;
    var busca2 = document.getElementById("search2").value;
    var busca3 = document.getElementById("searpros").value;
    if (busca3.length <= 0)
    {
        busca3 = null;
    }
    $.ajax({
        data: {"txt": busca, "txt2": busca2, "txt3": busca3},
        url: "include/modules/dashboard/search.data.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            switch (data)
            {
                case '0':
                    document.getElementById("resultable").style.display = "none";
                    document.getElementById("apn").style.display = "inline";
                    break
                default:
                    document.getElementById("resultable").style.display = "inline";
                    document.getElementById("resultable").innerHTML = data;
                    document.getElementById("apn").style.display = "none";
                    break;
            }

        }
    });
}
function showform()
{
    var stt = document.getElementById("apn").style.display;
    var edotable = document.getElementById("resultable").style.display;
    if (stt === 'none')
    {
        document.getElementById("apn").style.display = "inline";
        if (edotable !== 'none')
        {
            document.getElementById("resultable").style.display = "none";
        }
    }
    else
    {
        document.getElementById("apn").style.display = "none";
    }
}
function oculta()
{
    document.getElementById("subeimagen").style.display = "none";
}
function showdetail(id)
{
    $.ajax({
        data: {"id": id, "op": '0'},
        url: "include/modules/dashboard/actions.data.php",
        type: 'post',
        success: function (data)
        {
            document.getElementById("bodymodal").innerHTML = data;
            $("#detailpro").modal("show");
            $.ajax({
                data: {"id": id},
                url: "include/modules/dashboard/dire.json.php",
                type: 'post',
                success: function (data)
                {
                    $("#mimapa").gmap3({
                        marker: {
                            id: "direcc",
                            address: data
                        },
                        map: {
                            options: {
                                zoom: 9
                            }
                        },
                        autofit: {}
                    });
                }
            });
        }
    });
}
function cierramodal()
{
    $("#detailpro").modal("hide");
}

function nuevaimagen(idx)
{
    var noimg = null;
    $.ajax({
        data: {"gal": idx},
        url: "include/modules/dashboard/data.json.php",
        type: 'post',
        success: function (data)
        {
            if (parseInt(data) <= 4)
            {
                $.ajax({
                    data: {"id": idx},
                    url: "include/modules/dashboard/upload.image2.php",
                    type: 'post',
                    success: function (data)
                    {
                        document.getElementById("imgnew").style.display = "inline";
                        document.getElementById("imgnew").innerHTML = data;
                        $("div#mizona").dropzone({
                            url: "content/upload/property/upload.inc.php?id=" + idx,
                            success: function ()
                            {
                                $.ajax({
                                    data: {"myd": idx},
                                    url: "include/modules/dashboard/refresh.gallery.php",
                                    type: 'post',
                                    success: function (data)
                                    {
                                        document.getElementById("gellery").innerHTML = data;
                                    }
                                });
                            }
                        });
                    }
                });
            }
            else
            {
                $.bootstrapGrowl("Solo puede subir un maximo de 5 fotos", {type: 'warning'});
            }
        }
    });
}
function oculta2()
{
    document.getElementById("imgnew2").style.display = "none";
}
function oculta_img()
{
    document.getElementById("imgnew").style.display = "none";
}
function llamada() {
    alert("hello");
}
function muestratask(pid)
{
    $("#taskprospecto").modal("show");
    $("#task0").val(pid);
}
function savetask()
{
    var l = 0;
    var vl = null;
    var chmp = null;
    var err = 0;
    for (l = 1; l <= 4; l++)
    {
        vl = document.getElementById("task" + l).value;
        if (vl.length === 0)
        {
            err++;
            switch (l)
            {
                case 1:
                    chmp = "Titulo";
                    break;
                case 2:
                    chmp = "Asignado";
                    break;
                case 3:
                    chmp = "Actividad";
                    break;
                case 4:
                    chmp = "Fecha";
                    break;
            }
            $.bootstrapGrowl("LLene el campo " + chmp, {type: 'warning'});
            chmp = null;
        }
        vl = null;
    }
    if (err === 0)
    {
        var pid = document.getElementById("task0").value;
        $.ajax({
            data: $("#frmtask").serialize(),
            url: "include/modules/dashboard/save.task.php",
            type: 'post',
            success: function (data)
            {
                switch (data)
                {
                    default:
                        $("#taskprospecto").modal("hide");
                        document.getElementById("frmtask").reset();
                        $.bootstrapGrowl("Guardado Correctamente", {type: 'success'});
                        if (document.getElementById("tabletask") !== null)
                        {

                            $.ajax({
                                data: {"idp": pid},
                                url: "include/modules/dashboard/refres.activity.php",
                                type: 'post',
                                success: function (data)
                                {
                                    document.getElementById("mistareas").innerHTML = data;
                                }
                            });
                        }
                        break;
                    case '0':
                        $.bootstrapGrowl("Error al Guardar la tarea", {type: 'danger'});
                        break;
                }

            }
        });
    }
}
$(function () {
    $("#task4").datepicker({dateFormat: 'dd-mm-yy'});
});
function finalizatarea(idtk)
{
    $("#numtask").val(idtk);
    $("#dialog_end_task").modal("show");
}
function end_task()
{
    var not = document.getElementById("notas_end").value;
    var idtask = document.getElementById("numtask").value;
    $.ajax({
        data: {"ntk": idtask, "not": not},
        url: "include/modules/dashboard/activity.end.php",
        type: 'post',
        success: function (data)
        {
            switch (data)
            {
                case '1':
                    $("#dialog_end_task").modal("hide");
                    $.bootstrapGrowl("Finalizado con exito", {type: 'success'});
                    $("#rowac_" + idtask).remove();
                    break;
                default:
                    $.bootstrapGrowl("Error al Finalizar la tarea", {type: 'danger'});
                    break;
            }
        }
    });
}
function rotate()
{
    var nimg = document.getElementById("nameimg").value;
    var angulo = document.getElementById("anguloimg").value;
    angulo = parseInt(angulo);
    var rot = 360;
    nimg = nimg + "_m.jpg";
    $.ajax({
        data: {"file": nimg},
        url: "content/upload/property/rotate.php",
        type: 'post',
        success: function (data)
        {
            data = parseInt(data);
            angulo = parseInt(angulo) + parseInt(data);
            rot = parseInt(rot) - parseInt(angulo);
            $("#img_bigp").rotate(rot);
            $("#ima_" + nimg).rotate(rot);
            document.getElementById("anguloimg").value = angulo;
        }
    });
}
function rotateimage_incide(nimg)
{
    var n2 = "srima_" + nimg;
    nimg = nimg + "_m.jpg";
    var angulo = document.getElementById("ang_i_" + nimg).value;
    angulo = parseInt(angulo);
    var rot = 360;
    $.ajax({
        data: {"file": nimg},
        url: "content/upload/incidence/rotate.php",
        type: 'post',
        success: function (data)
        {
            data = parseInt(data);
            angulo = parseInt(angulo) + parseInt(data);
            rot = parseInt(rot);            
            $("#"+n2).rotate(rot);
            $("#"+n2).attr('src', 'content/upload/incidence/' + nimg + '?' + Math.random());
            document.getElementById("ang_i_" + nimg).value = angulo;
        }
    });
}


function rotateimage(nimg)
{
    var n2 = "#" + nimg;
    nimg = nimg + "_m.jpg";
    var angulo = document.getElementById("ang_" + nimg).value;
    angulo = parseInt(angulo);
    var rot = 360;
    $.ajax({
        data: {"file": nimg},
        url: "content/upload/property/rotate.php",
        type: 'post',
        success: function (data)
        {
            data = parseInt(data);
            angulo = parseInt(angulo) + parseInt(data);
            rot = parseInt(rot) - parseInt(angulo);
            $(n2).rotate(rot);
            $('#n2').attr('src', 'content/upload/property/' + nimg + '?' + Math.random());
            document.getElementById("ang_" + nimg).value = angulo;
        }
    });
}

function search_h()
{
    var fh = $("#findh").val();
    var prio = null;
    var ubica = null;
    prio = document.getElementById("prioridadid").value;
    ubica = document.getElementById("ubica").value;
    var f1 = document.getElementById("ifech_a").value;
    var f2 = document.getElementById("ifech_b").value;
    var tys = document.getElementById("typesearch").value;
    var errdate = 0;
    if (f1.length === 0 && f2.length !== 0)
    {
        $.bootstrapGrowl("Seleccione su Fecha Inicial", {type: 'warning'});
        $("#ifech_a").focus();
        errdate++;
    }
    if (f2.length === 0 && f1.length !== 0)
    {
        $.bootstrapGrowl("Seleccione su Fecha Final", {type: 'warning'});
        $("#ifech_a").focus();
        errdate++;
    }
    if (f2 < f1)
    {

        $.bootstrapGrowl("Su fecha Final debe ser mayor a la Inicial", {type: 'warning'});
        $("#ifech_b").focus();
        errdate++;
    }
    if (errdate <= 0)
    {
        //alert("entro");
        $.ajax({
            data: {"op": 1, "find": fh, "f1": f1, "f2": f2, "tys": tys, "ub": ubica, "prio": prio},
            url: "include/modules/dashboard/mant.inc.php",
            type: 'post',
            success: function (data)
            {
                $("#search-result").html(data);
            }
        });
    }
}
function moredetail(row, ty, pri, ref, da, db)
{
    var sta = document.getElementById("detail_" + row).style.display;
    $.ajax({
        data: {"opcio": ty, "hhou": row, "pri": pri, "ref": ref, "da": da, "db": db},
        url: "include/modules/dashboard/find.data.php",
        type: 'post',
        success: function (data)
        {
            $("#detail_" + row).html(data);
        }
    });
    document.getElementById("detail_" + row).style.display = 'inline';
}
function moredetail2(row, ty, pri, ref, da, db)
{
    var sta = document.getElementById("detail_" + row).style.display;
    if (sta === 'none')
    {
        $.ajax({
            data: {"opcio": ty, "hhou": row, "pri": pri, "ref": ref, "da": da, "db": db},
            url: "include/modules/dashboard/find.data.php",
            type: 'post',
            success: function (data)
            {
                $("#detail_" + row).html(data);
            }
        });
        document.getElementById("detail_" + row).style.display = 'inline';
    }
    else
    {
        document.getElementById("detail_" + row).style.display = 'none';
    }
}
function addincidencia(pid)
{
    $.ajax({
        data: {"op": 2, "pid": pid},
        url: "include/modules/dashboard/mant.inc.php",
        type: 'post',
        success: function (data)
        {
            $("#inciden_add").modal('show');
            $("#inciden_body").html(data);
            var rid = document.getElementById("numfolio").value;
            $.ajax({
                data: {"op": 8, "id": rid},
                url: "include/modules/dashboard/mant.inc.php",
                type: 'post',
                success: function (data)
                {
                    $("#listrow_" + pid).append(data); //agrega al div la incidencia
                }
            });
        }
    });
}

function mediaincidencia(idx)
{
    $.ajax({
        data: {"id": idx},
        url: "include/modules/dashboard/upload.incidence.php",
        type: 'post',
        success: function (data)
        {
            document.getElementById("imgnew").style.display = "inline";
            document.getElementById("imgnew").innerHTML = data;
            $("div#mizona").dropzone({
                url: "content/upload/incidence/upload.inc.php?id=" + idx,
                success: function ()
                {
                    /* $.ajax({
                     data: {"myd": idx},
                     url: "include/modules/dashboard/refresh.gallery.php",
                     type: 'post',
                     success: function (data)
                     {
                     document.getElementById("gellery").innerHTML = data;
                     }
                     });*/
                }
            });
        }
    });
}
function mediaincidencia2(idx)
{
    $.ajax({
        data: {"id": idx},
        url: "include/modules/dashboard/upload.incidence2.php",
        type: 'post',
        success: function (data)
        {
            document.getElementById("imgnew2").style.display = "inline";
            document.getElementById("imgnew2").innerHTML = data;
            $("div#mizona2").dropzone({
                url: "content/upload/incidence/upload.inc.php?id=" + idx,
                success: function (file)
                {
                }
            });
        }
    });
}
function incidend(iid, pid)
{
    var prio = document.getElementById("in").value;
    var tit = document.getElementById("in_title").value;
    var ref = document.getElementById("in0").value;
    ;
    var not = document.getElementById("in1").value;
    $.ajax({
        data: {"op": '3', "id": iid, "not": not, "ref": ref, "prio": prio, "tit": tit},
        url: "include/modules/dashboard/mant.inc.php",
        type: 'post',
        success: function (data)
        {
            switch (data)
            {
                case '1':
                    $.bootstrapGrowl("Guardado con exito", {type: 'success'});
                    $("#inciden_add").modal('hide');
                    //alert(document.getElementById("ipend_"+pid).innerHTML);
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'danger'});
                    break;
            }
        }
    });
}
function editinc(id)
{
    $.ajax({
        data: {"op": '4', "id": id},
        url: "include/modules/dashboard/mant.inc.php",
        type: 'post',
        success: function (data)
        {
            $("#ifinal_body").html(data);
            $("#inciden_final").modal('show');
        }
    });
}
function finalincidencia(id)
{
    $.ajax({
        data: {"op": '5', "id": id},
        url: "include/modules/dashboard/mant.inc.php",
        type: 'post',
        success: function (data)
        {
            $.bootstrapGrowl("Finalizado con exito", {type: 'success'});
            $("#inciden_final").modal('hide');
        }
    });
}
function incidesavechange(id)
{
    var prio = document.getElementById("in_in").value;
    var tit = document.getElementById("in_0").value;
    var ref = document.getElementById("in_1").value;
    ;
    var not = document.getElementById("in_2").value;
    var status = document.getElementById("stat_inci").value;
    $.ajax({
        data: {"op": '6', "id": id, "tit": tit, "ref": ref, "not": not, "prio": prio, "final": status},
        url: "include/modules/dashboard/mant.inc.php",
        type: 'post',
        success: function (data)
        {
            $.bootstrapGrowl("Guardado con exito", {type: 'success'});
            $.ajax({
                data: {"op": '4', "id": id},
                url: "include/modules/dashboard/mant.inc.php",
                type: 'post',
                success: function (data)
                {
                    $("#ifinal_body").html(data);
                }
            });
        }
    });
}
function changeselect()
{
    var ty = document.getElementById("typesearch").value;
    if (parseInt(ty) === 0)
    {
        document.getElementById("ifech_a").disabled = true;
        document.getElementById("ifech_b").disabled = true;
    }
    else
    {
        document.getElementById("ifech_a").disabled = false;
        document.getElementById("ifech_b").disabled = false;
    }
}
$(function () {
    $("#ifech_a").datepicker({dateFormat: 'dd-mm-yy'});
});
$(function () {
    $("#ifech_b").datepicker({dateFormat: 'dd-mm-yy'});
});
function viewdetail(idp)
{
    $.ajax({
        data: {"op": '7', "id": idp},
        url: "include/modules/dashboard/mant.inc.php",
        type: 'post',
        success: function (data)
        {
            $("#detailhouse").modal('show');
            $("#bodytailhoyse").html(data);
        }
    });
}
function borra_div(pad, hij)
{
    $("#modalpregunta").modal('show');
    $("#div_borrador").val("div_" + pad + "_" + hij);
}
function borraeldiv()
{
    var a = $("#div_borrador").val();
    $.ajax({
        data: {"op": '9', "id": a},
        url: "include/modules/dashboard/mant.inc.php",
        type: 'post',
        success: function (data)
        {
            switch (data)
            {
                case'1':
                    $("#" + a).remove();
                    $("#modalpregunta").modal('hide');
                    $.bootstrapGrowl("Eliminado con exito", {type: 'success'});
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'danger'});
                    break;
            }

        }
    });
}
function cancela_incidencia(id)
{
    $.ajax({
        data: {"op": '10', "id": id},
        url: "include/modules/dashboard/mant.inc.php",
        type: 'post',
        success: function (data)
        {
            switch (data)
            {
                case '1':

                    $("#inciden_add").modal('hide');
                    // $.bootstrapGrowl("Eliminado con exito", {type: 'success'});
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'danger'});
                    break;
            }
        }
    });
}
function chkbutt1()
{
    var ch = document.getElementById("option1").checked;
    if (ch === true)
    {
        document.getElementById("mypriory").style.display = "inline";
    }
    else
    {
        document.getElementById("mypriory").style.display = "none";
    }
}
function chkbutt2()
{
    var ch = document.getElementById("option2").checked;
    if (ch === true)
    {
        document.getElementById("myubica").style.display = "inline";
    }
    else
    {
        document.getElementById("myubica").style.display = "none";
    }
}
function ocultaeldiv(id)
{
    document.getElementById("detail_" + id).style.display = "none";
}
function editpros(pid)
{
    $.ajax({
        data: {"op": '0', "pid": pid},
        url: "include/modules/dashboard/pros.data.php",
        type: 'post',
        success: function (data)
        {
            $("#editbody").html(data);
            $("#editprospecto").modal("show");
        }
    });
}
function updateprospecto(id)
{
    $.ajax({
        data: $("#edit_pros").serialize(),
        url: "include/modules/dashboard/pros.data.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            if (data === '1')
            {
                $("#editprospecto").modal("hide");
                search_p();
            }
            else
            {
                $.bootstrapGrowl("ERROR AL GUARDAR LOS DATOS" + data, {type: 'danger'});
            }
        }
    });

}