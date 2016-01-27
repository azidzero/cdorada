function doLogin() {
    var u = $('#username').val();
    u = u.toLowerCase();
    umd5 = MD5($.trim(u));
    var p = $('#userpass').val();
    pmd5 = MD5($.trim(p));
    $('#username').val("");
    $('#userpass').val("");
    $.ajax({
        method: 'POST',
        url: 'do.login.php',
        data: {username: u, userpass: pmd5, u5: umd5},
        dataType: 'json'
    }).done(function (response) {
        if (response.code == "0") {
            $('#upicture').css('display', 'none');
            $('#upicture').attr('src', 'content/account/' + response.u5 + '.png');
            $('#upicture').fadeIn();
            $.bootstrapGrowl(response.caption,{
                type:'success'
            });
            setTimeout(function () {
                location.reload();
            }, 3000);
        } else {
            $.bootstrapGrowl(response.caption,{
                type:'danger'
            });
        }
    });
}