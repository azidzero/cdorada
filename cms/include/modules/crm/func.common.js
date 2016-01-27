function autoSave(se, obj) {
    var v = $('#' + obj).val();
    var i = $('#id').val();
    $.ajax({
        url: 'include/modules/crm/' + se + ".auto.php",
        method: 'POST',
        data: {
            id: i,
            field: obj,
            value: v
        },
        dataType: 'json'
    }).done(function (response) {        
        var nid = response.id;
       
        $('#id').val(nid);
        var status = response.status;
        var m = response.message;
        if (status == 'OK') {
            $.bootstrapGrowl(m, {type: 'info'});
        } else {
            $.bootstrapGrowl(m, {type: 'danger'});
        }
    });
}
