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
function checklanguage(id, op)
{
    var parameters = {"op": op, "id": id};
    $.ajax({
        data: parameters,
        url: "include/modules/translation/save.dat.php",
        type: 'post',
        beforeSend: function () {
        },
        success: function (data)
        {
            $.bootstrapGrowl(data, {type: 'info'});
            reload();
        }
    });
}
function reload()
{
    var table = $('#tbl_admin').DataTable();

    table.ajax.reload(function (json) {
        $('#tbl_admin').val(json.lastInput);
    });
}


function traeform()
{
    var idio = document.getElementById('lang_trad').value;
    if (idio.length > 0)
    {
        var parameters = {"idlang": idio, "op": 10}//datos a enviar
        $.ajax({//preparas el envio
            data: parameters,//le agregas los datos
            url: "include/modules/translation/save.dat.php",//le dices a donde se va a ir y ejecutar el archivo
            type: 'post',//metodo de envío post, get, json... (yo prefiero el post
            beforeSend: function () {//que va a realizar antes de enviar los datos
            },
            success: function (data)//si se envio, recive en la variable data el resultado que arrojaste en tu archivo .php
            {
               $("#form_lang").html(data);//hago lo que se me de la gana con el data
            }
        });
    }
}
