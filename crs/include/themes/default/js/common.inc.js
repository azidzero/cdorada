/*
 * ###
 */
$(document).ready(function () {
    /*
    var t = new Trianglify();
    var pattern = t.generate(640, 480);
    document.body.setAttribute('style', 'background-image: ' + pattern.dataUrl);
    */
});
/*
 * 
 */
function jTable(obj, src, data) {
    $('#' + obj).dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": src,
        "oLanguage": {
            "sUrl": "include/themes/default/js/dataTables.spanish.txt"
        },
        "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "sPaginationType": "bs_normal",
        //"sPaginationType": "full_numbers",
        "aaSorting": [[0, "desc"]],
        "fnServerParams": function (aoData) {
            aoData.push({
                "name": "cid",
                "value": data
            });
        }
    });
}