function pregunta(id) {
    if (confirm('¿Desea eliminar este registro?')) {
        var nomform = "del" + id;
        document.nomform.submit();
    } else {
        return false;
    }
}
function addequipment() {
    var sis = document.getElementById("additem").value;
    if (sis.length >= '1')
    {
        var txtarea = document.getElementById("area-equipo");
        var option = document.createElement("option");
        option.text = sis;
        txtarea.add(option);
        document.getElementById("additem").value = "";
        document.getElementById("additem").focus();
    }
}
function removeequipment()
{
    var x = document.getElementById("area-equipo");
    document.getElementById("additem").value = document.getElementById("area-equipo").value;
    x.remove(x.selectedIndex);
}
function equipmentall()
{
    var sele = document.getElementById("area-equipo");
    var no = sele.options.length;
    for (var i = 0; i < no; i++)
    {
        sele.options[i].selected = true;
    }
}

function addext()
{
    var sis = document.getElementById("addextra").value;
    if (sis.length >= '1')
    {
        var txtarea = document.getElementById("extras");
        var option = document.createElement("option");
        option.text = sis;
        txtarea.add(option);
        document.getElementById("addextra").value = "";
        document.getElementById("addextra").focus();
    }
}
function removext()
{
    var x = document.getElementById("extras");
    document.getElementById("addextra").value = document.getElementById("extras").value;
    x.remove(x.selectedIndex);
}
function ocultada(xd)
{

    if (document.getElementById(xd).style.display == "")
    {
        document.getElementById(xd).style.display = "none";
    } else {
        document.getElementById(xd).style.display = "";
    }
}
function cargamodulo()
{
    document.nomform.submit();
}


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