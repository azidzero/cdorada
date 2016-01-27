<?php
include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "opcio");
$hou = filter_input(INPUT_POST, "hhou");
$pri = filter_input(INPUT_POST, "pri");
$ref = filter_input(INPUT_POST, "ref");
$da = filter_input(INPUT_POST, "da");
$db = filter_input(INPUT_POST, "db");
$mes = array("", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
$styl = "";
switch ($op) {
    case 0:
        if ($ref != null) {
            $add_ref = " and (a.title like'%$ref%' or a.nota like'%$ref%' or a.reference like'%$ref%')";
        } else {
            $add_ref = " ";
        }
        $addhouse = "";
        if ($da != null && $db != null) {
            $addhouse = " and DATE(a.created) BETWEEN '" . date("Y-m-d", strtotime($da)) . "'  AND '" . date("Y-m-d", strtotime($db)) . "'";
        }
        if ($pri != null || $pri != "") {
            $lqry = "select a.*,(SELECT COUNT(b.id) FROM crm_incidence_gallery  b WHERE b.iid=a.id) AS gale from crm_incidence a where a.pid=$hou and a.status!=9 and a.priority=$pri  $add_ref    $addhouse ORDER BY  a.`status` ASC, a.priority DESC, a.`created` DESC";
        } else {
            $lqry = "select a.*,(SELECT COUNT(b.id) FROM crm_incidence_gallery  b WHERE b.iid=a.id) AS gale from crm_incidence a where a.pid=$hou and a.status!=9 $add_ref   $addhouse ORDER BY  a.`status` ASC, a.priority DESC, a.`created` DESC";
        }
        //echo $lqry;
        $ginci = mysqli_query($CNN, $lqry);
        ?>
        <div class="col-lg-12 text-right"><label onclick="ocultaeldiv(<?php echo $hou; ?>)"><span class="fa fa-close"></span></label></div><br><?php
        while ($i = mysqli_fetch_array($ginci)) {
            $bg = "";
            $styl = "";
            if ($i['status'] != 9) {
                if ($i['priority'] == 0) {
                    $bg = " bg-info";
                }
                if ($i['priority'] == 1) {
                    $bg = " bg-info";
                }
                if ($i['priority'] == 2) {
                    $bg = " bg-warning";
                }
                if ($i['priority'] == 3) {
                    $styl = "background-color:#d9534f;";
                }
            }
            ?>
            <div class="col-lg-2 hover <?php echo $bg; ?> text-capitalize bold " id="div_<?php echo $hou ?>_<?php echo $i['id']; ?>" style="border:2px solid #fff; min-height: 100px;<?php echo $styl; ?>" >
              <!--<div class="heol-md-1 text-right "><span class="fa fa-times-circle-o"></span><label class="trash" onclick="borra_div(<?php echo $hou ?>,<?php echo $i['id']; ?>);"><span class="fa fa-trash"></span></label></div>-->
                <div class="col-lg-14 text-right"><img src="images/opn.png"></div>
                <div onclick='editinc(<?php echo $i['id']; ?>)'>
                    <div class="row">
                        <div class="col-lg-12 ">
                            <label class="label-invert ">Creado:</label> <?php echo date("d", strtotime($i['created'])) . "-" . $mes[date("m", strtotime($i['created']))] . "-" . date("y", strtotime($i['created']))."&nbsp;&nbsp;</small>".date("H:i",strtotime($i['created']))."</small>"; ?><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <big>
                                <?php echo substr($i['title'], 0, 20); ?>
                            </big>
                        </div>
                        <div class="col-lg-2">
                            <?php
                            if ($i["gale"] >= 1) {
                                ?>
                                <span class="fa fa-paperclip fa-2x"></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        break;
    case 1:
        if ($pri != null || $pri != "") {
            $ginci = mysqli_query($CNN, "select a.*,(SELECT COUNT(b.id) FROM crm_incidence_gallery  b WHERE b.iid=a.id) AS gale from crm_incidence a where a.pid=$hou and a.status=9 and a.priority=$pri ORDER BY  a.`status` ASC, a.priority DESC, a.`created` DESC");
        } else {
            $ginci = mysqli_query($CNN, "select a.*,(SELECT COUNT(b.id) FROM crm_incidence_gallery  b WHERE b.iid=a.id) AS gale from crm_incidence a where a.pid=$hou and a.status=9 ORDER BY  a.`status` ASC, a.priority DESC, a.`created` DESC");
        }
        ?><div class="col-lg-12 text-right"><label onclick="ocultaeldiv(<?php echo $hou; ?>)"><span class="fa fa-close"></span></label></div><br><?php
        while ($i = mysqli_fetch_array($ginci)) {
            $bg = "";
            $styl = "";
            if ($i['status'] != 9) {
                if ($i['priority'] == 0) {
                    $bg = " bg-info";
                }
                if ($i['priority'] == 1) {
                    $bg = " bg-info";
                }
                if ($i['priority'] == 2) {
                    $bg = " bg-warning";
                }
                if ($i['priority'] == 3) {
                    $styl = "background-color:#d9534f;";
                }
            }
            ?>
            <div class="col-lg-2 hover <?php echo $bg; ?> text-capitalize bold " id="div_<?php echo $hou ?>_<?php echo $i['id']; ?>" style="border:2px solid #fff; min-height: 100px;<?php echo $styl; ?>" >
              <!--<div class="heol-md-1 text-right "><span class="fa fa-times-circle-o"></span><label class="trash" onclick="borra_div(<?php echo $hou ?>,<?php echo $i['id']; ?>);"><span class="fa fa-trash"></span></label></div>-->
                <div class="col-lg-14 text-right"><img src="images/close.png"></div>
                <div onclick='editinc(<?php echo $i['id']; ?>)'>
                    <div class="row">
                        <div class="col-lg-12 ">
                            <label class="label-invert ">Creado:</label> <?php echo date("d", strtotime($i['created'])) . "-" . $mes[date("m", strtotime($i['created']))] . "-" . date("y", strtotime($i['created'])); ?><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <big>
                                <?php echo substr($i['title'], 0, 20); ?>
                            </big>
                        </div>
                        <div class="col-lg-2">
                            <?php
                            if ($i["gale"] >= 1) {
                                ?>
                                <span class="fa fa-paperclip fa-2x"></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        break;
    case 2:
        if ($pri != null) {

            $ginci = mysqli_query($CNN, "SELECT a.*,(SELECT COUNT(b.id) FROM crm_incidence_gallery  b WHERE b.iid=a.id) AS gale FROM `crm_incidence` a where a.pid=$hou and a.priority=$pri  ORDER BY  a.`status` ASC, a.priority DESC, a.`created` DESC");
        } else {
            $ginci = mysqli_query($CNN, "SELECT a.*,(SELECT COUNT(b.id) FROM crm_incidence_gallery  b WHERE b.iid=a.id) AS gale FROM `crm_incidence` a where a.pid=$hou  ORDER BY  a.`status` ASC, a.priority DESC, a.`created` DESC");
        }
        ?><div class="col-lg-12 text-right"><label onclick="ocultaeldiv(<?php echo $hou; ?>)"><span class="fa fa-close"></span></label></div><br><?php
        while ($i = mysqli_fetch_array($ginci)) {
            $bg = "";
            $styl = "";
            if ($i['status'] != 9) {
                if ($i['priority'] == 0) {
                    $bg = " bg-info";
                }
                if ($i['priority'] == 1) {
                    $bg = " bg-info";
                }
                if ($i['priority'] == 2) {
                    $bg = " bg-warning";
                }
                if ($i['priority'] == 3) {
                    $styl = "background-color:#d9534f;";
                }
            }
            ?>
            <div class="col-lg-2 hover <?php echo $bg; ?> text-capitalize bold " id="div_<?php echo $hou ?>_<?php echo $i['id']; ?>" style="border:2px solid #fff; min-height: 100px;<?php echo $styl; ?>" >
               <!--<div class="heol-md-1 text-right "><span class="fa fa-times-circle-o"></span><label class="trash" onclick="borra_div(<?php echo $hou ?>,<?php echo $i['id']; ?>);"><span class="fa fa-trash"></span></label></div>-->
                <div class="col-lg-14 text-right"><img src="images/<?php
                    if ($i['status'] == 9) {
                        echo "close.png";
                    } else {
                        echo "opn.png";
                    }
                    ?> ">
                    <?php if ($i["gale"] >= 1) { ?> <span class="fa fa-paperclip"></span> <?php } ?> </div>
                <div onclick='editinc(<?php echo $i['id']; ?>)'>
                    <label class="label-invert ">Creado:</label> <?php echo date("d", strtotime($i['created'])) . "-" . $mes[date("m", strtotime($i['created']))] . "-" . date("y", strtotime($i['created'])); ?><br>
                    <big><?php echo substr($i['title'], 0, 20); ?></big>
                    <br>
                    <?php ?>
                    <br>
                </div>
            </div>
            <?php
        }
        break;
    case 5:
        break;
}