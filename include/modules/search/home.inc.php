<?php
$place = filter_input(INPUT_POST, "place");
$group = filter_input(INPUT_POST, "group-property");
$dini = filter_input(INPUT_POST, "date_in-property");
$dend = filter_input(INPUT_POST, "date_out-property");

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
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4"><?php include('sidebar.search.php'); ?></div>
        <div class="col-sm-8 col-md-8 col-lg-8" id="search-result">
            <?php
            $sql = "SELECT cms_property.* FROM cms_property WHERE cms_property.id NOT IN (SELECT crs_reserva.pid FROM crs_reserva WHERE crs_reserva.ini>='$dini' AND crs_reserva.end<='$dend')";

            $q = mysqli_query($CNN, $sql) or die($sql . ": " . mysqli_error($CNN));
            $n = mysqli_num_rows($q);
            ?>
            <div class="well well-sm" style="border-bottom:1px solid #CCC;">
                <div class="btn-group pull-right btn-group-vertical">                    
                    <a href="javascript:void(0)" onclick="showMap()" class="btn btn-warning"><i class="fa fa-map-o"></i> <?php echo $wlang->getString('result', 'show-map'); ?></a>
                </div>
                <h4><?php echo $wlang->getString("result", "title"); ?></h4>                                
                <?php echo $wlang->getString("result", "found-left"); ?><strong><?php echo $n; ?></strong><?php echo $wlang->getString("result", "found-right"); ?>
            </div>
            <div id="search_map">
                <?php
                include('map.more.php');
                ?>
            </div>
            <?php
            $limit = 10;
            $pages = intval($n / $limit) + 1;
            $offset = ($page - 1) * $limit;
            $sql.= " limit $offset, $limit";
            $now = date("Y-m-d");
            $q = mysqli_query($CNN, $sql) or die(mysqli_error($CNN));
            $n = mysqli_num_rows($q);
            ?>

            <?php
            while ($r = mysqli_fetch_array($q)) {
                $link = $r["link"];
                $oSQL = "SELECT crs_rates_use.pid, crs_rates_detail.* FROM crs_rates_detail 
                    INNER JOIN crs_rates_use ON crs_rates_detail.rid = crs_rates_use.rid
                    WHERE crs_rates_use.pid = '{$r["id"]}' AND '$now' BETWEEN crs_rates_detail.date_ini AND crs_rates_detail.date_end order by crs_rates_detail.diario";
                $oq = mysqli_query($CNN, $oSQL) or die(mysqli_error());
                $on = mysqli_num_rows($oq);
                if ($on > 0) {
                    while ($or = mysqli_fetch_array($oq)) {
                        $prize = $or["diario"];
                    }
                } else {
                    $prize = 0;
                }
                ?>              
                <div data-id="<?php echo $r["id"]; ?>" class="row" style="box-shadow: 0px 2px 1px rgba(0,0,0,0.25);background:#FFF;border:1px solid #BDC3C7;margin-bottom: 8px;padding-bottom: 4px;border-radius:0px 0px 4px 4px;">
                    <div class="col-sm-12" style="background-color:#2C3E50;color:#FFF;padding:8px;margin-bottom: 4px;">
                        <div class="label pull-right" style="background-color:#7F8C8D"><?php echo $r["hutt"]; ?></div>
                        <b><?php echo $r["title"]; ?></b>
                    </div><!-- HEADER -->
                    <div class="col-sm-6">
                        <?php
                        $gq = mysqli_query($CNN, "SELECT * from cms_property_gallery where pid='{$r["id"]}'");
                        $gn = mysqli_num_rows($gq);
                        if ($gn > 0) {
                            ?>
                            <div id="slide<?php echo $r["id"]; ?>" class="carousel slide" data-ride="carousel" style="height: 240px;">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox" style="height: 240px;">
                                    <ol class="carousel-indicators">
                                        <?php
                                        for ($gx = 0; $gx < $gn; $gx++) {
                                            ?>
                                            <li data-target="#slide<?php echo $r["id"]; ?>" data-slide-to="<?php echo $gx; ?>" class="<?php if ($gx == "0") {
                                    echo "active";
                                } ?>"></li>
                                            <?php
                                        }
                                        ?>
                                    </ol>
                                    <?php
                                    $item = 0;
                                    while ($gr = mysqli_fetch_array($gq)) {
                                        $file = "cms/content/upload/property/{$gr['name']}_m.jpg";
                                        if ($item == 0) {
                                            ?>
                                            <div class="item active" style="height: 240px;">
                                                <img src="<?php echo $file; ?>" alt="...">
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="item" style="height: 240px;"><img src="<?php echo $file; ?>" alt="..."></div>
                                            <?php
                                        }
                                        $item++;
                                    }
                                    ?>
                                </div>

                                <!-- Controls -->
                                <a style="height: 240px;" class="left carousel-control" href="#slide<?php echo $r["id"]; ?>" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="height: 240px;"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a style="height: 240px;" class="right carousel-control" href="#slide<?php echo $r["id"]; ?>" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="height: 240px;"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>                                
                            <?php
                        } else {
                            ?>
                            <div class="banner">                               
                                No hay im&aacute;genes para mostrar
                            </div>
                            <?php
                        }
                        ?>
                    </div><!-- GALLERY -->
                    <div class="col-sm-6">
                        <div style="padding:4px;">
                            <?php
                            if ($prize > 0) {
                                ?>
                                <span style="font-size:13pt;font-family: 'Open Sans Condensed',sans-serif;text-transform: uppercase;font-weight: bold;color:#999;">
                                    Desde <span style="font-size:18pt;color:#E74C3C;"><?php echo $prize; ?>&euro;</span> / D&iacute;a
                                </span>
                                <br/>
                                <button onclick="showMore('<?php echo $r['id']; ?>')" style="padding: 4px;" type="button" class="btn btn-block btn-warning">
                                    <i style="opacity:0.5;" class="fa fa-calendar-check-o fa-2x pull-left"></i>
                                    <span style="font-size:13pt;">RESERVA AHORA!</span>
                                </button>
                                <?php
                            } else {
                                ?>
                                <button type="button" class="btn btn-block btn-info">
                                    <i class="fa pull-right fa-2x fa-question-circle"></i> PREGUNTAR
                                </button>
                                <?php
                            }
                            ?><!-- ACTIONS -->
                            <table width="100%">
                                <tr>
                                    <td width="50%"><img src="/images/search_location.png" /> <span class="label label-primary"><?php
                                            $localidad = getData("cms_property_locale", "id", $r["localidad"], "name");
                                            echo $localidad;
                                            ?></span></td>
                                    <td><img src="/images/search_type.png" /> <span class="label label-primary"><?php
                                            $tipo = getData("cms_property_type", "id", $r["tipo"], "name");
                                            echo $tipo;
                                            ?></span></td>
                                </tr>
                            </table><!-- LOCATION -->
                            <table class="table table-condensed" style="color:#000;background:#EFEFEF;margin-bottom: 4px;">
                                <tbody>
                                    <tr>
                                        <td><p style="font-family: 'Arial';font-size: 10pt;text-align: justify;font-weight: 300;"></p>
                                        </td>
                                        <td width="40"><img title="" data-toggle="tooltip" src="images/home_bed.png" data-original-title=" Dormitorio(s)"><sup class="badge badge-data"><?php echo $r["dorm"]; ?></sup></td>
                                        <td width="40"><img title="" data-toggle="tooltip" src="images/home_users.png" data-original-title=" Persona(s)"><sup class="badge badge-data"><?php echo $r["capacity"]; ?></sup></td>
                                        <td width="40"><img title="" data-toggle="tooltip" src="images/home_bath.png" data-original-title=" Baño(s)"><sup class="badge badge-data"><?php echo $r["bano"]; ?></sup></td>
                                    </tr>
                                </tbody>
                            </table><!-- FEATURES -->
                            <div style="font-size:9pt;font-weight: bold;text-align: justify;">
                                <?php
                                $str = getData("cms_property_translate", array('pid', 'cname', 'lang'), array($r["id"], 'rent-short', $lang), 'caption');
                                echo $str;
                                ?>
                            </div><!-- SHORT DESC -->
                            <div style="padding:8px">
                                <?php
                                if ($r["link"] != "") {
                                    ?>
                                    <a href="javascript:void(0)" onclick="showVideo('<?php echo $r["id"]; ?>')" class="btn btn-danger" style="vertical-align: middle;margin-bottom:-8px;">
                                        <i class="fa fa-2x fa-youtube-play"></i> Ver Video
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div><!-- DESCRIPTION -->
                </div>
                <?php
            }
            ?>                        
            <script>
                $(document).ready(function () {
                    /*$('.banner').unslider({
                     autoplay: false,
                     nav: true,
                     arrows: false
                     });*/
                });

            </script>
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
            <div class="modal-footer" style="text-align:left;">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $wlang->getString("result", "more-close"); ?></button>
            </div>
        </div>
    </div>
</div>
<script>
    var page = 1;
    var lazyLoad = true;
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
        if (lazyLoad === true) {
            $.ajax({
                type: 'POST',
                url: 'include/modules/search/content.lazy.php',
                data: {
                    'lang': '<?php echo $lang; ?>',
                    'page': page,
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
    }
    $(document).scroll(function (e) {
        var a = $(this).scrollTop();
        var b = $('#search-result').innerHeight();
        var c = $('#search-result')[0].scrollHeight;
        if (a > b * 0.8) {
            if (!loading) {
                loading = true;
                loadNewContent();
            }
        }

    });
    $(document).ready(function () {
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
            url: 'include/modules/search/more.inc.php',
            data: {'lang': '<?php echo $_REQUEST["lang"]; ?>',
                'id': ref, 'dini': dini, 'dend': dend}
        }).done(function (content) {
            $('#showMore').html(content);
            $('#modalMore').modal('show');
        });
    }

</script>