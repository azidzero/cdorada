<?php

include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
switch ($op) {
    case 0:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * FROM crs_rates WHERE id=$id") or die(mysqli_error($CNN));
        $json = array();
        $n = mysqli_num_rows($q);
        while ($r = mysqli_fetch_array($q)) {
            $json = $r;
        }
        echo json_encode($json);
        break;
    case 1:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "delete from crs_rates where id=$id")or $err = "Error al borrar esta propiedad" . mysqli_error($CNN);
        if (!isset($err)) {
            $json = "1";
        } else {
            $json = $err;
        }
        echo json_encode($json);
        break;
    case 100:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * FROM crs_rates_detail WHERE id=$id") or die(mysqli_error($CNN));
        $json = array();
        $n = mysqli_num_rows($q);
        while ($r = mysqli_fetch_array($q)) {
            $json = $r;
        }
        echo json_encode($json);
        break;
    case 101:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "delete from  crs_rates_detail WHERE id=$id") or $err = (mysqli_error($CNN));
        if (!isset($err)) {
            mysqli_query($CNN, "update_crs_rates set date_update=CURRENT_TIMESTAMP WHERE id=$id");
            $myqry = mysqli_query($CNN, "update crs_rates set date_update=CURRENT_TIMESTAMP WHERE id=$id")or $err = "error al actualizar" . mysqli_error($CNN);
            if (!isset($err)) {
                echo json_encode("1");
            } else {
                echo json_encode($err);
            }
        } else {
            echo json_encode($err);
        }
        break;
    case 102:
        $id = filter_input(INPUT_POST, "copy");
        $nam = filter_input(INPUT_POST, "name");
        $ingrat = mysqli_query($CNN, "insert into crs_rates (name,date_create)value('$nam',CURRENT_TIMESTAMP)") or $err = "error al ingresar el nombre de la Tarifa<br>" . mysqli_error($CNN);
        if (!isset($err)) {
            $newid = mysqli_insert_id($CNN);
            $acopy = "SELECT date_ini,date_end,mini,des,diario,restringir,checkin,checkout FROM crs_rates_detail WHERE rid=$id";
            $cpy = mysqli_query($CNN, $acopy)or $err = "error al obtener las filas:--> $acopy" . mysqli_error($CNN);
            $valores = array();
            $nwqry = "INSERT INTO crs_rates_detail"
                    . "(rid,date_ini, date_end, mini,des,diario,restringir,checkin,checkout)"
                    . "VALUES";
            if (!isset($err)) {
                while ($c = mysqli_fetch_array($cpy)) {
                    $valores = $c;
                    $nwqry.="('$newid','$valores[0]','$valores[1]','$valores[2]','$valores[3]','$valores[4]','$valores[5]','$valores[6]','$valores[7]'),";
                }
            } else {
                echo $err;
            }
            $nwqry = substr($nwqry, 0, -1);
            $excec = mysqli_query($CNN, $nwqry) or $err = "Error al copiar los Periodos" . mysqli_error($CNN);
            if (!isset($err)) {
                echo json_encode("1");
            } else {
                echo json_encode($err);
            }
        } else {
            echo json_encode($err);
        }
        break;
    case 103:
        $id = filter_input(INPUT_POST, "rid");
        $myqry = mysqli_query($CNN, "update crs_rates set date_update=CURRENT_TIMESTAMP WHERE id=$id")or $err = "error al actualizar" . mysqli_error($CNN);
        if (!isset($err)) {
            echo "1";
        } else {
            echo $err;
        }
        break;
    case 200:
        $f = date("Y-m-d", strtotime(filter_input(INPUT_POST, "fecha")));
        $t = filter_input(INPUT_POST, "tarifa");
        $find = "select * from crs_rates_detail where rid=$t and '$f' between date_ini and date_end";
        $rows = mysqli_query($CNN, $find);
        $nr = mysqli_num_rows($rows);
        if ($nr > 0) {
            while ($d = mysqli_fetch_array($rows)) {
                $ffin = $d['date_end'];
            }
            $nuevafecha = date('d-m-Y', strtotime("$ffin + 1 day"));
            $fend = date('d-m-Y', strtotime("$nuevafecha + 7 day"));
            echo json_encode("1|" . $nuevafecha . "|" . $fend);
        } else {
            echo json_encode("0|1");
        }

        break;
}
