<?php
$url = "";
if (isset($_REQUEST["lang"])) {
    $url.="$lang/";
}
if (isset($_REQUEST["m"])) {
    $url.="$m/";
}
if (isset($_REQUEST["s"])) {
    $url.="$s/";
}
if (isset($_REQUEST["o"])) {
    $url.="$o";
}

$uri = $_SERVER["REQUEST_URI"];
$uril = $lang . "/search/lista";
$urim = $lang . "/search/mapa";

if (!isset($_REQUEST["page"])) {
    $page = 1;
} else {
    $page = $_REQUEST["page"];
}
// location
if (isset($_REQUEST["place"])) {
    $place = $_REQUEST["place"];
} else {
    $place = "all";
}
if (isset($_REQUEST["s"])) {
    $v = $_REQUEST["s"];
} else {
    $v = "lista";
}
$bedroom = $_REQUEST["bedroom"];
$people = $_REQUEST["group-property"];
if (isset($_REQUEST["tipo-property"])) {
    $tipo = $_REQUEST["tipo-property"];
} else {
    $tipo = 0;
}
$dini = $_REQUEST["date_in-property"];

if (!isset($_REQUEST["date_in-property"]) || $dini == "") {
    $dini = date("Y-m-d");
    $dtmp = new datetime($dini);
    $itmp = new DateInterval("P7D");
    $dtmp->add($itmp);
    $dend = $dtmp->format("Y-m-d");
} else {
    $dend = $_REQUEST["date_out-property"];
}

$na = new datetime($dini);
$nb = new datetime($dend);
$dias = $na->diff($nb);
?>
<section id="search" style="margin-top:120px;">    
    <div class="container">
        <div class="row">
            <div class="col-sm-3 sidebar"><?php include('include/modules/search/sidebar.search.php'); ?></div>
            <div class="col-sm-9" id="search-result"><?php include("content.lazy.php"); ?>
            </div>
        </div>
    </div>    
</section>
<!-- Modal More -->
<div class="modal fade" id="modalMore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $wlang->getString("result", "more-title"); ?></h4>
            </div>
            <div class="modal-body" id="showMore"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $wlang->getString("result", "more-close"); ?></button>
            </div>
        </div>
    </div>
</div>
<script>

    var loading = false;
    var winTop = $(window).scrollTop();
    var docHeight = $(document).height();
    var winHeight = $(window).height();
    if ((winTop / (docHeight - winHeight)) > 0.95) {
        if (!loading) {
            loading = true;
            loadNewContent();//call function to load content when scroll reachs PAGE bottom                
        }
    }
    function loadNewContent() {
        $.ajax({
            type: 'GET',
            url: 'include/modules/search/content.lazy.php',
            data: {
                'lang': '<?php echo $lang; ?>',
                'page': $('#page').val(),
                'sdate': $('#date_in-property').val(),
                'edate': $('#date_out-property').val()},
            success: function (data) {
                if (data != "") {
                    loading = false;
                    $('#search-result').append(data);
                }
            }
        });
    }
    $('#search-result').on('scroll', function () {
        if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            if (!loading) {
                loading = true;
                loadNewContent();
            }
        }
    });
    $(document).ready(function () {
        loadNewContent();
        $('#date_in-property').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            onClose: function (selectedDate) {
                $("#date_out-property").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#date_out-property').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'top'
            });
        });
    });
    function showMore(ref) {
        var dini = $('#date_in-property').val();
        var dend = $('#date_out-property').val();
        $.ajax({
            method: 'POST',
            url: 'include/modules/buscar/more.inc.php',
            data: {'lang': '<?php echo $_REQUEST["lang"]; ?>',
                'id': ref, 'dini': dini, 'dend': dend}
        }).done(function (content) {
            $('#showMore').html(content);
            $('#modalMore').modal('show');
        });
    }

</script>