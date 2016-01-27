<?php
include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
$semana = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "S&aacute;bado");
switch ($op) {
    case 1:
        $id = filter_input(INPUT_POST, "idof");
        $txt = filter_input(INPUT_POST, "x");
        $nmb = mysqli_query($CNN, "select name from crs_rates where id=$id");
        $n = "NONAME";
        while ($N = mysqli_fetch_array($nmb)) {
            $n = $N['name'];
        }
        ?>
        <script>
            $("#nombretarifa").html('<?php echo $n;?>');
        </script>
        <?php
        $gethous = "select pid from crs_rates_use where rid=$id";
        $checkhou = mysqli_query($CNN, $gethous);
        $arr = array();
        $b = 0;
        while ($m = mysqli_fetch_array($checkhou)) {
            $arr[$b] = $m['pid'];
            $b++;
        }
        ?>
        <table class="table table-condensed table-hover table-striped" style="background: #dfdfdf; ">
            <thead>
                <tr class="text-uppercase bold bg-info">
                    <th>Asignada</th>
                    <th>Propiedad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $gpro = mysqli_query($CNN, "select * from cms_property where title like'%$txt%'")or $err = "Error al consultar las propiedades" . mysqli_error($CNN);
                if (!isset($err)) {
                    while ($p = mysqli_fetch_array($gpro)) {
                        ?>
                        <tr>
                            <td><input type="checkbox" class="form-control" value="<?php echo $p['id']; ?>" <?php
                                       if (in_array($p['id'], $arr)) {
                                           echo 'checked="checked"';
                                       }
                                       ?>onclick="upproperty(<?php echo $p['id']; ?>,<?php echo $id; ?>);"></td>
                            <td><?php echo $p['title']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        break;
    case 2:
        $pid = filter_input(INPUT_POST, "pid");
        $rid = filter_input(INPUT_POST, "rid");
        $getex = "select * from crs_rates_use where rid=$rid and pid=$pid";
        $gt = mysqli_query($CNN, $getex);
        $ngt = mysqli_num_rows($gt);
        if ($ngt >= 1) {
            $que = "delete from crs_rates_use where rid=$rid and pid=$pid";
        } else {
            $que = "insert into crs_rates_use (rid, pid) values($rid,$pid)";
        }
        $exec = mysqli_query($CNN, $que) or $err = "error al realizar la accion" . mysqli_error($CNN);
        if (!isset($err)) {
            echo "1";
        } else {
            echo $err;
        }

        break;
    case 10:
        $rid = filter_input(INPUT_POST, "idtar");
        $per = filter_input(INPUT_POST, "idperiodo");
        $ini = date("Y-m-d", strtotime(filter_input(INPUT_POST, "tar-ini")));
        $end = date("Y-m-d", strtotime(filter_input(INPUT_POST, "tar-end")));
        $min = filter_input(INPUT_POST, "tar-estan");
        $des = filter_input(INPUT_POST, "tar-reb");
        $pd = filter_input(INPUT_POST, "tar-price");
        $ps = filter_input(INPUT_POST, "tar-price_s");
        $restr = filter_input(INPUT_POST, "tar-ing");
        if ($restr == 1) {
            $in = filter_input(INPUT_POST, "tar-checkin");
            $out = filter_input(INPUT_POST, "tar-checkout");
        } else {
            $in = "-1";
            $out = "-1";
        }
        $upd = "update crs_rates_detail set  date_ini='$ini',date_end='$end',mini='$min',des='$des', diario='$pd', semanal='$ps',restringir='$restr', checkin='$in',checkout='$out' where id=$per";
        $execupda = mysqli_query($CNN, $upd)or $err = mysqli_error($CNN);
        if (!isset($err)) {
            $ret = "1|";
            $ret.='<td>' . $per . '</td><td>' . date("d-m-Y", strtotime($ini)) . '</td><td>' . date("d-m-Y", strtotime($end)) . '</td><td>' . $min . ' Noche(s)</td><td>' . $pd . '</td><td>' . $ps . '</td><td>' . $des . '</td>';
            if ($restr >= 1) {
                $ret.='<td>' . $semana[$in] . '</td>';
                $ret.='<td>' . $semana[$out] . '</td>';
            } else {
                $ret.='<td>N/A</td>';
                $ret.='<td>N/A</td>';
            }
            $ret.='<td><i class="btn btn-info fa fa-edit" alt="Editar periodo" title="Editar periodo"onclick="edit_tar(' . $per . ')"></i><i class="btn btn-danger fa fa-eraser" onclick="removetar(' . $per . ')" alt="Eliminar periodo" title="Eliminar periodo"></i></td></tr>';
            $myqry = mysqli_query($CNN, "update crs_rates set date_update=CURRENT_TIMESTAMP WHERE id=$rid")or $err = "error al actualizar" . mysqli_error($CNN);
            if (!isset($err)) {
                echo $ret;
            } else {
                echo $err;
            }
        } else {
            echo "0|" . $err;
        }
        break;
}