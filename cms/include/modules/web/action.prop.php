<?php
include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");

$lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
$lgg = array();
while ($lr = mysqli_fetch_array($lq)) {
    $lgg[] = $lr['iso_639_1'];
}
switch ($op) {
    //GUARDA LA CATEGORIA
    case 0:
        $QRY = "insert into web_prop_category (name,lang)values('" . filter_input(INPUT_POST, "namcat_es") . "','es')";
        $EXE = mysqli_query($CNN, $QRY)or $e = "Error al insertar la categoria en <b>'es'</b>" . mysqli_error($CNN);
        if (!isset($e)) {
            $pad = mysqli_insert_id($CNN);
            $ol = 0;
            $qry = "insert into web_prop_category (pid,name,lang)values";
            foreach ($lgg as $g) {
                if ($g != 'es') {
                    $qry.="($pad,'" . filter_input(INPUT_POST, "namcat_" . $g) . "','$g'),";
                    $ol++;
                }
            }
            $qr = substr($qry, 0, -1);
            if ($ol > 0) {
                $inact = mysqli_query($CNN, $qr) or $err = "error al guardar la actividad" . mysqli_error($CNN);
            }
            if (!isset($err)) {
                echo "1|$pad";
            } else {
                echo "0|0|" . $err;
            }
        } else {
            echo "0|0|" . $e;
        }
        break;
    case 1:
        $id = filter_input(INPUT_POST, "cid");
        $getc = "select * from web_prop_category where id=$id or pid=$id";
        $ct = mysqli_query($CNN, $getc) or $e = "Error:" . mysqli_error($CNN);
        if (!isset($e)) {
            $myarr = array();
            while ($t = mysqli_fetch_array($ct)) {
                if (in_array($t['lang'], $lgg)) {
                    $myarr[$t['lang']] = $t['name'];
                }
            }
            echo json_encode($myarr);
        } else {
            echo json_encode($e);
        }
        break;
    case 2:
        $id = filter_input(INPUT_POST, "cat_sav");
        $q = "select * from web_prop_category where id=$id or pid=$id";
        $glng = mysqli_query($CNN, $q) or $e = "error:" . mysqli_error($CNN);
        $arcomp = array();
        while ($ll = mysqli_fetch_array($glng)) {
            $arcomp[] = $ll['lang'];
        }
        $resultado = array_diff($arcomp, $lgg);
        if (count($resultado) >= 1) {
            print_r($resultado);
        } else {
            $mltqry = "update web_prop_category set name='" . filter_input(INPUT_POST, "namcat_es") . "' where id=$id";
            $uplang = mysqli_query($CNN, $mltqry) or $e = mysqli_error($CNN);
            if (!isset($e)) {
                $del = "delete from web_prop_category where pid=$id";
                $dellng = mysqli_query($CNN, $del) or $e = mysqli_error;
                if (!isset($e)) {
                    $ol = 0;
                    $qry = "insert into web_prop_category (pid,name,lang)values";
                    foreach ($lgg as $g) {
                        if ($g != 'es') {
                            $qry.="('$id','" . filter_input(INPUT_POST, "namcat_" . $g) . "','$g'),";
                            $ol++;
                        }
                    }
                    $qr = substr($qry, 0, -1);
                    if ($ol > 0) {
                        $inact = mysqli_query($CNN, $qr) or $err = "error al guardar la actividad" . mysqli_error($CNN);
                    }
                    if (!isset($err)) {
                        echo "1|$id";
                    } else {
                        echo "0|" . $err;
                    }
                } else {
                    echo $e . "<br>" . $del;
                    ;
                }
            } else {
                echo $e;
            }
        }

        break;
    case 3:
        $id = filter_input(INPUT_POST, "cid");
        $noro = mysqli_query($CNN, "select * from web_prop where cat=$id") or $err = "Error al eliminar la categoria<br>" . mysqli_error($CNN);
        if (!isset($err)) {
            $nc = mysqli_num_rows($noro);
            if ($nc <= 0) {
                $elimall = "delete from web_prop_category where id=$id";
                $elcat = mysqli_query($CNN, $elimall)or $er = "error al eliminar" . mysqli_error($CNN);
                if (!isset($er)) {
                    echo "1";
                } else {
                    echo $er;
                }
            } else {
                echo "2";
            }
        } else {
            echo $err;
        }
        break;
    case 80:
        $id = filter_input(INPUT_POST, "elim_id");
        $prop = filter_input(INPUT_POST, "prop_id");
        $q = mysqli_query($CNN, "SELECT * from web_prop_gallery WHERE id=$id and aid=$prop") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            unlink("../../../content/upload/prop" . $r['name'] . "_m.jpg");
            unlink("../../../content/upload/prop" . $r['name'] . "_b.jpg");
        }
        $del = mysqli_query($CNN, "DELETE from web_prop_gallery where aid=$prop and id=$id ")OR DIE(mysqli_error($CNN));
        if (!$del) {
            ?>
            <label >ERROR AL ELIMINAR LOS DATOS</label>
            <?php
        } else {
            ?>
            <label >Eliminado correctamente</label>
            <?php
        }
        break;
}

