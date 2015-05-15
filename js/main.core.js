function goto(id) {
    var a = $('#' + id).offset().top - 12;
    $('.navbar-nav li').removeClass('active');
    var x = $.data(document.body, 'url', id);
    $("html, body").animate({scrollTop: a}, 1000);
}

function pushMenu(id) {
    var we = $(window).width();
    var w = $('#filter-' + id).width();
    var p = (w / we) * 100;
    var a = $('#filter-' + id).css('left');
    if (p < 50) {
        if (a == '0px') {
            $('#filter-' + id).css('left', '-25%');
            $('#result-' + id).css({
                'transform': 'scale(1)'
            });
        } else {
            $('#filter-' + id).css('left', '0');
            $('#result-' + id).css({
                'transform': 'scale(0.9)'
            });
        }
    } else {
        if (a == '0px') {
            $('#filter-' + id).css('left', '-90%');
            $('#' + id).css('padding-left', '0px');
            $('#result-' + id).css({
                'transform': 'scale(1)'
            });
        } else {
            $('#filter-' + id).css('left', '0px');
            $('#' + id).css('padding-left', '90%');
            $('#result-' + id).css({
                'transform': 'scale(0.75)'
            });
        }
    }
}
function doSearch(id) {
    var chka = $('#useRange-' + id).is(':checked');
    if (chka == true) {
        var range = $('#range-' + id).val();
        range = range.split(' - ');
        var range_a = range[0];
        var range_b = range[1];
    } else {
        var range_a = 0;
        var range_b = 0;
    }
    var chkb = $('#useDates-' + id).is(':checked');
    if (chkb == true) {
        var date_a = $('#date_in-' + id).val();
        var date_b = $('#date_out-' + id).val();
    } else {
        var date_a = "NO";
        var date_b = "NO";
    }
    var amount = $('#group-' + id).val();
    var tipo = $('#tipo-' + id).val();
    var place = $('#place-' + id).val();

    $.ajax({
        methos: 'POST',
        url: 'http://www.elquirofano.com.mx:8080/cdorada/include/modules/web/search.home.php?lang=<?php echo $lang;?>',
        data: {
            i: id, // Section
            ra: range_a, // Range A
            rb: range_b, // Range B
            da: date_a, // Date A
            db: date_b, // Date B
            group: amount, // Group
            type: tipo, // Type
            marker: place   // WHERE
        }
    }).done(function (response) {
        $('#result-' + id).html(response);
    });
}
function chkSlider(id) {
    var a = $('#useRange-' + id).is(':checked');
    console.log(a);
    if (a == true) {
        $('#slider-range-' + id).slider('enable');
    } else {
        $('#slider-range-' + id).slider('disable');
    }
}
function chkDates(id) {
    var a = $('#useDates-' + id).is(':checked');
    if (a == true) {
        $('#date_in-' + id).removeAttr('disabled');
        $('#date_out-' + id).removeAttr('disabled');
    } else {
        $('#date_in-' + id).attr('disabled', 'disabled');
        $('#date_out-' + id).attr('disabled', 'disabled');
    }
}

function modale(id) {
    var a = $('#' + id).css('opacity');
    console.log(a);
    if (a == '0') {
        $('#' + id).css('display', 'block').css('opacity', '1');
    } else {
        $('#' + id).css('opacity', '0').css('display', 'none');
    }
}

function resize(){
    // $('section').css('min-height', $(window).height() * 0.8 + 'px');        
}