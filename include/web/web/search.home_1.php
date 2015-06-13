<?php
/*
 * Busqueda para renta
 */
$limit = 10;
$id = filter_input(INPUT_POST, "i");
$ra = filter_input(INPUT_POST, "ra");
$rb = filter_input(INPUT_POST, "rb");
$da = filter_input(INPUT_POST, "da");
$db = filter_input(INPUT_POST, "db");
$group = filter_input(INPUT_POST, "group");
$type = filter_input(INPUT_POST, "type");
$marker = filter_input(INPUT_POST, "marker");
$page = filter_input(INPUT_POST, "page");
$REF = explode("/", $_SERVER["HTTP_REFERER"]);
$lang = $REF[count($REF) - 2];

?>
<div class="row-fluid">
    <?php
    for ($i = 0; $i < 8; $i++) {
        $oid = rand(1, 3);
        switch ($oid) {
            case 1:$csl = 'danger';
                $cst = "VENTA";
                break;
            case 2:$csl = 'warning';
                $cst = "RENTA";
                break;
            case 3:$csl = 'info';
                $cst = "OFERTA";
                break;
        }
        ?>
        <div class="block col-sm-3">
            <div  class="home_block" style="background-image: url('cms/content/upload/item_<?php echo str_pad(rand(1, 6), 6, '0', STR_PAD_LEFT); ?>.jpg');">
                <table width="50%" style="font-weight: 300;background:#FFF;color:#000;float:right">
                    <tr>
                        <td><b class="text-danger" style="font-size:14pt;text-align: right">$ <?php echo number_format(rand(1, 1000000), 2); ?></b></td>
                        <td colspan="2">APARTAMENTO</td>
                        <td>
                            <span class="label label-<?php echo $csl; ?>"><i class="fa fa-tag"></i> <?php echo $cst; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="home_label">                                
                                <i class="fa fa-map-marker"></i> PROVINCIA, MUNICIPIO<br/>
                                <a href="javascript:void(0)" onclick="modale('mod-full')" class="btn btn-xs btn-primary">VER EN MAPA</a>
                            </span>
                        </td>
                        <td width="40"><img title="Dormitorios" data-toggle="tooltip" src="images/home_bed.png" /> <sup class="badge"><?php echo rand(2, 16); ?></sup></td>
                        <td width="40"><img title="Capacidad" data-toggle="tooltip" src="images/home_users.png" /> <sup class="badge badge-danger"><?php echo rand(2, 16); ?></sup></td>
                        <td width="40"><img title="Ba&ntilde;o(s)" data-toggle="tooltip" src="images/home_bath.png" /> <sup class="badge badge-danger"><?php echo rand(1, 6); ?></sup></td>
                    </tr>
                </table><br/><br/><br/><br/>

                <h4 style="float:right;text-align: right;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                <div class="caption">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor urna et tortor consectetur luctus. Etiam vitae pharetra elit, vitae rhoncus orci. Morbi sed metus lorem.
                    <a target="_blank" href="./<?php echo $lang; ?>/ver/ref/<?php echo str_pad(rand(1, 1000), 8, "0", STR_PAD_LEFT); ?>" class="btn btn-sm btn-info btn-block">
                        <i class="fa fa-external-link"></i> Ver informaci&oacute;n completa</a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            placement: 'bottom'
        });
    });
</script>
