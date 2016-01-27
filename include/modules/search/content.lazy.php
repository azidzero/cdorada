<?php
include("../../../inc/app.conf.php");

$dini = $_REQUEST["sdate"];
$dend = $_REQUEST["edate"];
$page = $_REQUEST["page"];
$page++;
$sql = "SELECT 
    cms_property.* 
    FROM 
    cms_property 
    WHERE 
    cms_property.id NOT IN 
    (SELECT crs_reserva.pid FROM crs_reserva WHERE crs_reserva.ini>='$dini' AND crs_reserva.end<='$dend')";

$q = mysqli_query($CNN, $sql) or die($sql . ": " . mysqli_error($CNN));
$n = mysqli_num_rows($q);

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
    $oSQL = "SELECT crs_rate.pid, crs_rates_detail.* FROM crs_rates_detail 
                    INNER JOIN crs_rates_use ON crs_rates_detail.rid = crs_rates_use.rid
                    WHERE crs_rates_use.pid = '{$r["id"]}' AND '$now' BETWEEN crs_rates_detail.date_ini AND crs_rates_detail.date_end order by crs_rates_detail.diario";
    $oq = mysqli_query($CNN, $oSQL) or print(mysqli_error());
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
            $gq = mysqli_query($CNN, "SELECT * from cms_property_gallery where pid='{$r["id"]}' limit 1");
            $gn = mysqli_num_rows($gq);
            if ($gn > 0) {
                ?>
                <div class="banner" style="min-height:240px;width:360px;">
                    <?php
                    while ($gr = mysqli_fetch_array($gq)) {
                        $file = "cms/content/upload/property/{$gr['name']}_m.jpg";
                        ?>
                        <div style="height:240px;background-image:url('<?php echo $file; ?>')"></div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            } else {
                ?>
                <div class="banner" style="min-height:240px;width:360px;">                               
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
                                ?>
                            </span>
                        </td>
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
            </div>
        </div><!-- DESCRIPTION -->
    </div>
    <?php
}
if ($pages > $page) {
    ?>                        
    <script>
        $(document).ready(function () {
            page =<?php echo $page; ?>;
            laasyload=true;
        });
    </script>
    <?php
}else{
    ?>
    <script>
        lazyLoad = false;
    </script>
    <?php    
}
?>