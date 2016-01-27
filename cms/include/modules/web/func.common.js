Dropzone.autoDiscover = false;
function unifiyContent() {
    $('#post-content-es').val($('#post-content-editor-es').code());
    $('#post-content-en').val($('#post-content-editor-en').code());
    $('#post-content-fr').val($('#post-content-editor-fr').code());
    $('#post-content-ru').val($('#post-content-editor-ru').code());
}
$(document).ready(function () {
    $('#post-content-editor-es').summernote({height: 240});
    $('#post-content-editor-en').summernote({height: 240});
    $('#post-content-editor-fr').summernote({height: 240});
    $('#post-content-editor-ru').summernote({height: 240});
});
/*Ventana de categorias */
//actividades
function showCat(lang) {
    $.ajax({
        method: 'POST',
        url: 'include/modules/web/cat.admin.php',
        data: {language: lang}
    }).done(function (response) {
        $("#catmodal").modal('show');
        $("#gridSystemModalLabel").html('Administrador de Categorias');
        $("#body-cat").html(response);
    });
}
//info viaje
function showCatinfo(lang) {
    $.ajax({
        method: 'POST',
        url: 'include/modules/web/cat.admin.info.php',
        data: {language: lang}
    }).done(function (response) {
        $("#catmodal").modal('show');
        $("#gridSystemModalLabel").html('Administrador de Categorias');
        $("#body-cat").html(response);
    });
}


/*GUARDAR CATEGORIA*/
//ACTIVIDAD
function savecat()
{
    var n = $("#namcat_es").val();
    if (n.length >= 1)
    {
        $.ajax({
            data: $("#nwcat").serialize(),
            url: "include/modules/web/action.activity.php",
            type: 'post',
            success: function (data)
            {
                var arr = data.split("|");
                switch (arr[0])
                {
                    case '1':
                        $("#catmodal").modal('hide');
                        $('#post-cat').append('<option value="' + arr[1] + '"selected="selected">' + n + '</option>');

                        $.bootstrapGrowl("AGREGADO CORRECTAMENTE", {type: 'success'});
                        break;
                    case '0':
                        $.bootstrapGrowl(arr[1], {type: 'warning'});
                        break;
                }
            }
        });
    }
}


function traeventana(uid, oc, elaid) {
    $.ajax({
        method: "POST",
        url: "include/modules/web/catalogo.json.php",
        data: {"id": uid, "op": oc},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        document.getElementById("tit").innerHTML += json.name;
        $("#elim_id").val(json.id);
        $("#mod_elim").modal('show');
    });

}
function eliminaitemimage(elaid)
{
    $.ajax({
        data: $("#form_elim").serialize(),
        url: "include/modules/web/action.activity.php",
        type: 'post',
        success: function (data)
        {
            $("#mod_elim").modal('hide');
            $.ajax({
                method: "POST",
                url: "include/modules/web/gallery.ajax.php",
                data: {"id": elaid}
            }).done(function (data) {
                $("#gal_activiy").html(data);
            });
            //:::::::::::::::::::::::::
        }
    });
}
function guradatype() {
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
function editalocali() {

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
function eliminalocali() {

    $.ajax({
        data: $("#eliminadestino").serialize(),
        url: "include/modules/property/save.dat.php",
        type: 'post',
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
function editcat(cid)
{
    document.getElementById("nwcat").reset();
    $.ajax({
        method: "POST",
        url: "include/modules/web/action.activity.php",
        data: {"cid": cid, "op": 1},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $.each(json, function (k, v) {
            $("#namcat_" + k).val(v);
        });
        $('#savecats').attr({onclick: 'updatecats(' + cid + ');'});
    });
}
function updatecats(cid)
{
    document.getElementById("op").value = "2";
    document.getElementById("cat_sav").value = cid;
    var n = $("#namcat_es").val();
    if (n.length >= 1)
    {
        $.ajax({
            data: $("#nwcat").serialize(),
            url: "include/modules/web/action.activity.php",
            type: 'post',
            success: function (data)
            {
                var arr = data.split("|");
                switch (arr[0])
                {
                    case '1':
                        $("#catmodal").modal('hide');
                        $("#post-cat option[value='" + arr[1] + "']").remove();
                        $('#post-cat').append('<option value="' + arr[1] + '" >' + n + '</option>');
                        document.getElementById("nwcat").reset();
                        $.bootstrapGrowl("AGREGADO CORRECTAMENTE", {type: 'success'});
                        break;
                    case '0':
                        $.bootstrapGrowl(arr[1], {type: 'warning'});
                        break;
                }
            }
        });
    }
}

function delcat(cid)
{
    $("#delcat_val").val(cid);
    $("#del_modal").modal("show");
}
function dodellcat()
{
    var cid = $("#delcat_val").val();
    $.ajax({
        data: {"op": 3, "cid": cid},
        url: "include/modules/web/action.activity.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $("#post-cat option[value='" + cid + "']").remove();
                $("#del_modal").modal("hide");
                $("#catmodal").modal('hide');
                $.bootstrapGrowl("Eliminado Correctamente", {type: 'success'});
            } else
            {
                if (data === "2")
                {
                    $.bootstrapGrowl("No se puede eliminar, tiene elementos asignados", {type: 'warning'});
                } else
                {
                    $.bootstrapGrowl(data, {type: 'warning'});
                }
            }
        }
    });
}
function uploadimage()
{
    $("#info_upload").attr("class", "row");
}
function prerem(eid, img)
{
    $("#btnacept").attr("onclick", "removeimg(" + eid + "," + img + ")");
    $("#mdlremove").modal("show");
}
function removeimg(eid, img)
{
    $("#mdlremove").modal("hide");
    $.ajax({
        data: {"aid": eid, "img": img},
        url: "content/upload/activity/remove.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("Imagen Eliminada correctamente", {type: 'success'});
                $("#page_" + eid).remove();
                $.ajax({
                    method: "POST",
                    url: "include/modules/web/gallery.ajax.php",
                    data: {"id": img}
                }).done(function (data) {
                    $("#gal_activiy").html(data);
                });
            } else
            {
                $.bootstrapGrowl("No se puede eliminar", {type: 'warning'});
            }
        }
    });
}

/*******************Info Viaje******************/
//INFO VIAJE
function savecatinfo()
{
    var n = $("#namcat_es").val();
    if (n.length >= 1)
    {
        $.ajax({
            data: $("#nwcat").serialize(),
            url: "include/modules/web/action.info.php",
            type: 'post',
            success: function (data)
            {
                var arr = data.split("|");
                switch (arr[0])
                {
                    case '1':
                        $("#catmodal").modal('hide');
                        $('#post-cat').append('<option value="' + arr[1] + '"selected="selected">' + n + '</option>');

                        $.bootstrapGrowl("AGREGADO CORRECTAMENTE", {type: 'success'});
                        break;
                    case '0':
                        $.bootstrapGrowl(arr[1], {type: 'warning'});
                        break;
                }
            }
        });
    }
}
function editcatinfo(cid)
{
    document.getElementById("nwcat").reset();
    $.ajax({
        method: "POST",
        url: "include/modules/web/action.info.php",
        data: {"cid": cid, "op": 1},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $.each(json, function (k, v) {
            $("#namcat_" + k).val(v);
        });
        $('#savecats').attr({onclick: 'updatecatsinfo(' + cid + ');'});
    });
}
function updatecatsinfo(cid)
{
    document.getElementById("op").value = "2";
    document.getElementById("cat_sav").value = cid;
    var n = $("#namcat_es").val();
    if (n.length >= 1)
    {
        $.ajax({
            data: $("#nwcat").serialize(),
            url: "include/modules/web/action.info.php",
            type: 'post',
            success: function (data)
            {
                var arr = data.split("|");
                switch (arr[0])
                {
                    case '1':
                        $("#catmodal").modal('hide');
                        $("#post-cat option[value='" + arr[1] + "']").remove();
                        $('#post-cat').append('<option value="' + arr[1] + '" >' + n + '</option>');
                        document.getElementById("nwcat").reset();
                        $.bootstrapGrowl("AGREGADO CORRECTAMENTE", {type: 'success'});
                        break;
                    case '0':
                        $.bootstrapGrowl(arr[1], {type: 'warning'});
                        break;
                }
            }
        });
    }
}

function delcatinfo(cid)
{
    $("#delcat_val").val(cid);
    $("#del_modal").modal("show");
}
function dodellcatinfo()
{
    var cid = $("#delcat_val").val();
    $.ajax({
        data: {"op": 3, "cid": cid},
        url: "include/modules/web/action.info.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $("#post-cat option[value='" + cid + "']").remove();
                $("#del_modal").modal("hide");
                $("#catmodal").modal('hide');
                $.bootstrapGrowl("Eliminado Correctamente", {type: 'success'});
            } else
            {
                if (data === "2")
                {
                    $.bootstrapGrowl("No se puede eliminar, tiene elementos asignados", {type: 'warning'});
                } else
                {
                    $.bootstrapGrowl(data, {type: 'warning'});
                }
            }
        }
    });
}
function prerem(eid, img)
{
    $("#btnacept").attr("onclick", "removeimginfo(" + eid + "," + img + ")");
    $("#mdlremove").modal("show");
}
function removeimginfo(eid, img)
{
    $("#mdlremove").modal("hide");
    $.ajax({
        data: {"aid": eid, "img": img},
        url: "content/upload/info/remove.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("Imagen Eliminada correctamente", {type: 'success'});
                $("#page_" + eid).remove();
                $.ajax({
                    method: "POST",
                    url: "include/modules/web/galleryinfo.ajax.php",
                    data: {"id": img}
                }).done(function (data) {
                    $("#gal_activiy").html(data);
                });
            } else
            {
                $.bootstrapGrowl("No se puede eliminar", {type: 'warning'});
            }
        }
    });
}


/***********************PROPIETARIOS***********************/
function savecatprop()
{
    var n = $("#namcat_es").val();
    if (n.length >= 1)
    {
        $.ajax({
            data: $("#nwcat").serialize(),
            url: "include/modules/web/action.prop.php",
            type: 'post',
            success: function (data)
            {
                var arr = data.split("|");
                switch (arr[0])
                {
                    case '1':
                        $("#catmodal").modal('hide');
                        $('#post-cat').append('<option value="' + arr[1] + '"selected="selected">' + n + '</option>');

                        $.bootstrapGrowl("AGREGADO CORRECTAMENTE", {type: 'success'});
                        break;
                    case '0':
                        $.bootstrapGrowl(arr[1], {type: 'warning'});
                        break;
                }
            }
        });
    }
}
function editcatinfo(cid)
{
    document.getElementById("nwcat").reset();
    $.ajax({
        method: "POST",
        url: "include/modules/web/action.prop.php",
        data: {"cid": cid, "op": 1},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $.each(json, function (k, v) {
            $("#namcat_" + k).val(v);
        });
        $('#savecats').attr({onclick: 'updatecatsprop(' + cid + ');'});
    });
}
function updatecatsprop(cid)
{
    document.getElementById("op").value = "2";
    document.getElementById("cat_sav").value = cid;
    var n = $("#namcat_es").val();
    if (n.length >= 1)
    {
        $.ajax({
            data: $("#nwcat").serialize(),
            url: "include/modules/web/action.prop.php",
            type: 'post',
            success: function (data)
            {
                var arr = data.split("|");
                switch (arr[0])
                {
                    case '1':
                        $("#catmodal").modal('hide');
                        $("#post-cat option[value='" + arr[1] + "']").remove();
                        $('#post-cat').append('<option value="' + arr[1] + '" >' + n + '</option>');
                        document.getElementById("nwcat").reset();
                        $.bootstrapGrowl("AGREGADO CORRECTAMENTE", {type: 'success'});
                        break;
                    case '0':
                        $.bootstrapGrowl(arr[1], {type: 'warning'});
                        break;
                }
            }
        });
    }
}

function delcatprop(cid)
{
    $("#delcat_val").val(cid);
    $("#del_modal").modal("show");
}
function dodellcatprop()
{
    var cid = $("#delcat_val").val();
    $.ajax({
        data: {"op": 3, "cid": cid},
        url: "include/modules/web/action.prop.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $("#post-cat option[value='" + cid + "']").remove();
                $("#del_modal").modal("hide");
                $("#catmodal").modal('hide');
                $.bootstrapGrowl("Eliminado Correctamente", {type: 'success'});
            }
            else
            {
            if (data === "2")
            {
                $.bootstrapGrowl("No se puede eliminar, tiene elementos asignados", {type: 'warning'});
            } else
            {
                $.bootstrapGrowl(data, {type: 'warning'});
            }
        }
        }
    });
}
function prerem(eid, img)
{
    $("#btnacept").attr("onclick", "removeimgprop(" + eid + "," + img + ")");
    $("#mdlremove").modal("show");
}
function removeimgprop(eid, img)
{
    $("#mdlremove").modal("hide");
    $.ajax({
        data: {"aid": eid, "img": img},
        url: "content/upload/prop/remove.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("Imagen Eliminada correctamente", {type: 'success'});
                $("#page_" + eid).remove();
                $.ajax({
                    method: "POST",
                    url: "include/modules/web/galleryprop.ajax.php",
                    data: {"id": img}
                }).done(function (data) {
                    $("#gal_activiy").html(data);
                });
            } else
            {
                $.bootstrapGrowl("No se puede eliminar", {type: 'warning'});
            }
        }
    });
}
function showCatprop(lang) {
    $.ajax({
        method: 'POST',
        url: 'include/modules/web/cat.admin.prop.php',
        data: {language: lang}
    }).done(function (response) {
        $("#catmodal").modal('show');
        $("#gridSystemModalLabel").html('Administrador de Categorias');
        $("#body-cat").html(response);
    });
}
function editcatprop(cid)
{
    document.getElementById("nwcat").reset();
    $.ajax({
        method: "POST",
        url: "include/modules/web/action.prop.php",
        data: {"cid": cid, "op": 1},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $.each(json, function (k, v) {
            $("#namcat_" + k).val(v);
        });
        $('#savecats').attr({onclick: 'updatecatsprop(' + cid + ');'});
    });
}



























/***********************empresa***********************/
function savecatempre()
{
    var n = $("#namcat_es").val();
    if (n.length >= 1)
    {
        $.ajax({
            data: $("#nwcat").serialize(),
            url: "include/modules/web/action.empre.php",
            type: 'post',
            success: function (data)
            {
                var arr = data.split("|");
                switch (arr[0])
                {
                    case '1':
                        $("#catmodal").modal('hide');
                        $('#post-cat').append('<option value="' + arr[1] + '"selected="selected">' + n + '</option>');

                        $.bootstrapGrowl("AGREGADO CORRECTAMENTE", {type: 'success'});
                        break;
                    case '0':
                        $.bootstrapGrowl(arr[1], {type: 'warning'});
                        break;
                }
            }
        });
    }
}
function editcatempre(cid)
{
    document.getElementById("nwcat").reset();
    $.ajax({
        method: "POST",
        url: "include/modules/web/action.empre.php",
        data: {"cid": cid, "op": 1},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $.each(json, function (k, v) {
            $("#namcat_" + k).val(v);
        });
        $('#savecats').attr({onclick: 'updatecatsprop(' + cid + ');'});
    });
}
function updatecatsempre(cid)
{
    document.getElementById("op").value = "2";
    document.getElementById("cat_sav").value = cid;
    var n = $("#namcat_es").val();
    if (n.length >= 1)
    {
        $.ajax({
            data: $("#nwcat").serialize(),
            url: "include/modules/web/action.empre.php",
            type: 'post',
            success: function (data)
            {
                var arr = data.split("|");
                switch (arr[0])
                {
                    case '1':
                        $("#catmodal").modal('hide');
                        $("#post-cat option[value='" + arr[1] + "']").remove();
                        $('#post-cat').append('<option value="' + arr[1] + '" >' + n + '</option>');
                        document.getElementById("nwcat").reset();
                        $.bootstrapGrowl("AGREGADO CORRECTAMENTE", {type: 'success'});
                        break;
                    case '0':
                        $.bootstrapGrowl(arr[1], {type: 'warning'});
                        break;
                }
            }
        });
    }
}

function delcatempre(cid)
{
    $("#delcat_val").val(cid);
    $("#del_modal").modal("show");
}
function dodellcatempre()
{
    var cid = $("#delcat_val").val();
    $.ajax({
        data: {"op": 3, "cid": cid},
        url: "include/modules/web/action.empre.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $("#post-cat option[value='" + cid + "']").remove();
                $("#del_modal").modal("hide");
                $("#catmodal").modal('hide');
                $.bootstrapGrowl("Eliminado Correctamente", {type: 'success'});
            } else
            {
                if (data === "2")
                {
                    $.bootstrapGrowl("No se puede eliminar, tiene elementos asignados", {type: 'warning'});
                } else
                {
                    $.bootstrapGrowl(data, {type: 'warning'});
                }
            }

        }
    });
}
function prerem(eid, img)
{
    $("#btnacept").attr("onclick", "removeimgempre(" + eid + "," + img + ")");
    $("#mdlremove").modal("show");
}
function removeimgempre(eid, img)
{
    $("#mdlremove").modal("hide");
    $.ajax({
        data: {"aid": eid, "img": img},
        url: "content/upload/empre/remove.php",
        type: 'post',
        success: function (data)
        {
            if (data === '1')
            {
                $.bootstrapGrowl("Imagen Eliminada correctamente", {type: 'success'});
                $("#page_" + eid).remove();
                $.ajax({
                    method: "POST",
                    url: "include/modules/web/galleryempre.ajax.php",
                    data: {"id": img}
                }).done(function (data) {
                    $("#gal_activiy").html(data);
                });
            } else
            {
                $.bootstrapGrowl("No se puede eliminar", {type: 'warning'});
            }
        }
    });
}
function showCatempre(lang) {
    $.ajax({
        method: 'POST',
        url: 'include/modules/web/cat.admin.empre.php',
        data: {language: lang}
    }).done(function (response) {
        $("#catmodal").modal('show');
        $("#gridSystemModalLabel").html('Administrador de Categorias');
        $("#body-cat").html(response);
    });
}
function editcatempre(cid)
{
    document.getElementById("nwcat").reset();
    $.ajax({
        method: "POST",
        url: "include/modules/web/action.empre.php",
        data: {"cid": cid, "op": 1},
        dataType: 'json' // esto es para decirle que esperamos el resultado en formato json
    }).done(function (json) {
        $.each(json, function (k, v) {
            $("#namcat_" + k).val(v);
        });
        $('#savecats').attr({onclick: 'updatecatsprop(' + cid + ');'});
    });
}