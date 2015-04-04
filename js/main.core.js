$(document).ready(function () {
    $(window).resize(function () {
        updater();
    });
    updater();
    function updater() {
        var W = $(window).width();
        var H = $(window).height();
        $('#sucon').width(W+"px");
        $('section').height(H);
        $('section').css('min-height', H + 'px');       
        $('#content').width((W-17) + "px");
    }
});
function offCanvas() {
    var a = $('#menu-left').css('left');
    $('#home').parent().css('perspective', '1500px');
    if (a == "0px") {
        $('#menu-left').addClass('mnu-l-hidden');
        $('#menu-left').removeClass('mnu-l-show');

    } else {
        $('#menu-left').removeClass('mnu-l-hidden');
        $('#menu-left').addClass('mnu-l-show');
    }
}