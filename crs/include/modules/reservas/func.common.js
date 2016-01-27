$(function () {
    $("#ini").datepicker({dateFormat: 'dd-mm-yy'});
});
$(function () {
    $("#end").datepicker({dateFormat: 'dd-mm-yy'});
});
function showprecio(a)
{
    if (a.length >= 1)
    {
        $.ajax({
            data: {op: 0, id: a},
            url: "include/modules/reservas/save.dat.php",
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
function agen(ag)
{
    if (ag === '0')
    {
        document.getElementById("agencia").style.display = "inline";
    }
    else
    {
        document.getElementById("agencia").style.display = "none";
    }
}
function sumacomplementos()
{
    var prec = document.getElementById("costcom").value;
    var depo = document.getElementById("depocom").value;
    var cant = document.getElementById("cantcomp").value;
    if (prec.length <= '0')
    {
        prec = 0;
    }
    if (depo.length <= '0')
    {
        depo = 0;
    }
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
function addcom()
{
    var comple = document.getElementById("namecom").value;
    var prec = document.getElementById("costcom").value;
    var depo = document.getElementById("depocom").value;
    var tot = document.getElementById("totcom").value;
    var cant = document.getElementById("cantcomp").value;
    var yea = tablecomplemento.rows.length;
    yea = yea + 1;
    if (comple.length >= 1)
    {
        $('#tablecomplemento tr:last').after('<tr id="row' + yea + '"><td><input type="text" name="namecom' + yea + '" style="background-color:transparent; border:0px;" id="namecom' + yea + '" value=" ' + comple + '" disabled></td><td>' + cant + '</td><td>' + prec + '</td><td>' + depo + '</td><td>' + tot + '</td><td><label class="btn btn-warning" onclick="delrow(\'row' + yea + '\');" ><span class="fa fa-minus"></span></label></td></tr>');
        var ctot = document.getElementById("pricend").value;
        var adsum = parseInt(tot) + parseInt(ctot);
        document.getElementById("pricend").value = adsum;
        document.getElementById("micosto").innerHTML = adsum;

    }
}
function delrow(ro)
{
    document.getElementById(ro).style.display = "none";
}
function cambiatotal()
{
    var i = document.getElementById("ini").value;
    var e = document.getElementById("end").value;
    var aFecha1 = i.split('-');
    var aFecha2 = e.split('-');
    var fFecha1 = Date.UTC(aFecha1[2], aFecha1[1] - 1, aFecha1[0]);
    var fFecha2 = Date.UTC(aFecha2[2], aFecha2[1] - 1, aFecha2[0]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    var c=document.getElementById("pricend").value;
    var fin=parseInt(c)*dias;
    document.getElementById("pricend").value=fin;
    document.getElementById("micosto").innerHTML = fin;
}