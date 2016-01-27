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
function showoffer()
{
    $.ajax({
        data: {'op': 1},
        url: "include/modules/offer/offer.inc.php",
        type: 'post',
        success: function (data)
        {
            $("#cont_offerta").html(data);
            $("#newoffer").modal("show");
        }
    });
}
function guardaoffer()
{
    $.ajax({
        data: $("#sendoffer").serialize(),
        url: "include/modules/offer/save.dat.php",
        type: 'post',
        success: function (data)
        {
            switch (data)
            {
                case '0':
                    $.bootstrapGrowl("Especifique un nombre v&aacute;lido", {type: 'warning'});
                    $("#project").focus();
                    break;
                case '1':
                    $('#sendoffer').each(function () {
                        this.reset();
                    });
                    $("#project-description").html("");
                    //document.getElementById("addoffer").style.display = 'none';
                    $.bootstrapGrowl("Guardado con &eacute;xito", {type: 'success'});
                    $("#newoffer").modal("hide");
                    var table = $('#example').DataTable();
                    table.ajax.reload(function (json) {
                        $('#example').val(json.lastInput);
                    });
                    break;
                case '2':
                    $.bootstrapGrowl("LLene todos sus datos", {type: 'warning'});
                    $("#datepicker").focus();
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'danger'});
                    break;
            }
        }
    });
}

function askdeloffer(id)
{
    $.ajax({
        data: {'op': 2, "id": id},
        url: "include/modules/offer/offer.inc.php",
        type: 'post',
        success: function (data)
        {
            $("#cont_ask").html(data);
            $("#askoffer").modal('show');
        }
    });

}
function deloffer(id) {
    $.ajax({
        data: {"op": 3, "el_id": id},
        url: "include/modules/offer/save.dat.php",
        type: 'post',
        success: function (data)
        {
            $("#askoffer").modal('hide');
            if (data !== '1')
            {
                $.bootstrapGrowl(data, {type: 'danger'});
            }
            else
            {
                $.bootstrapGrowl("eliminado con exito", {type: 'success'});
            }
            var table = $('#example').DataTable();
            table.ajax.reload(function (json) {
                $('#example').val(json.lastInput);
            });
        }
    });
}

function editaoffer(id)
{
    $.ajax({
        data: {'op': 3, "idof": id},
        url: "include/modules/offer/offer.inc.php",
        type: 'post',
        success: function (data)
        {
            $("#cont_offerta").html(data);
            $("#newoffer").modal("show");
        }
    });
}

function addoffprop(id)
{
    $.ajax({
        data: {'id': id, 'op': 1, "txt": ""},
        url: "include/modules/offer/save.dat.php",
        type: 'post',
        success: function (data)
        {
            $("#ofertami").val(id);
            $('#contentoff').html(data);
            $("#propoffer").modal('show');
        }
    });
}
function filtraloja(txt)
{
    var id = document.getElementById("ofertami").value;
    $.ajax({
        data: {'id': id, 'op': 1, "text": txt},
        url: "include/modules/offer/save.dat.php",
        type: 'post',
        success: function (data)
        {
            $('#contentoff').html(data);
            $("#propoffer").modal('show');
        }
    });
}

function asigoffer(prop, iof)
{
    if (document.getElementById("prop_" + prop).checked === true)
    {
        var h = 1;
    }
    else
    {
        var h = 0;
    }
    // var iof = document.getElementById("idoffer").value;
    $.ajax({
        data: {'idof': iof, 'op': 2, 'prop': prop, 'act': h},
        url: "include/modules/offer/save.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            switch (data)
            {
                case '1':
                    $.bootstrapGrowl("Oferta asignada", {type: 'success'});
                    document.getElementById("asi_" + prop).disabled = false;
                    break;
                case '2':
                    $.bootstrapGrowl("oferta retirada", {type: 'info'});
                    document.getElementById("asi_" + prop).disabled = true;
                    document.getElementById("asi_" + prop).checked = false;
                    break;
                case '3':
                    document.getElementById("prop_" + prop).checked = false;
                    $.bootstrapGrowl("No contiene ninguna tarifa asignada", {type: 'info'});
                    break;
                default:
                    $.bootstrapGrowl(data, {type: 'danger'});
                    break;
            }
        }
    });
}
function preview(pid, rid)
{
    $.ajax({
        data: {'op': 4, 'pid': pid, 'rid': rid},
        url: "include/modules/offer/save.dat.php",
        type: 'post',
        success: function (data)
        {
            $("#previewrate").html("");
            $("#previewrate").html(data);
        }
    });
}
function searchof(text)
{
    $.ajax({
        data: {'op': 5, 'text': text},
        url: "include/modules/offer/save.dat.php",
        type: 'post',
        success: function (data)
        {
            $("#tablecont").html("");
            $("#tablecont").html(data);
        }
    });
}

function inpor(pid, rid)
{
    var checkbox = $('input:checkbox[name^=portasig]:checked');
    if (checkbox.length <= 6)
    {
        var ch = document.getElementById("asi_" + pid).checked;
        if (ch === true)
        {
            var va = 1;
        }
        else
        {
            var va = 0;
        }
        $.ajax({
            data: {'op': 6, 'rid': rid, "pid": pid, "chk": va},
            url: "include/modules/offer/save.dat.php",
            type: 'post',
            success: function (data)
            {
                switch (data)
                {
                    case '1':
                        $.bootstrapGrowl("Colocado en portada", {type: 'success'});
                        break;
                    case '2':
                        $.bootstrapGrowl("Retirado de portada", {type: 'success'});
                        break;
                    default:
                        $.bootstrapGrowl(data, {type: 'danger'});
                        break;
                }
            }
        });
    }
    else
    {
        $.bootstrapGrowl("llego al limite de Ofertas en portada", {type: 'danger'});
        document.getElementById("asi_" + pid).checked = false;
    }

}