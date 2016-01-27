<?php
include("../../../inc/app.conf.php");
$p = filter_input(INPUT_POST, "op");
switch ($p) {
    //INSERTA ADDONS
    case 0:
        $catalog = filter_input(INPUT_POST, "catalog"); //catalogo
        $isguard = filter_input(INPUT_POST, "idsav"); //esta guardado
        $tdato = filter_input(INPUT_POST, "tdato"); //tipo de dato
        $valp = filter_input(INPUT_POST, "valp"); //valor
        $reqre = filter_input(INPUT_POST, "raq"); //requerido
        $unit = filter_input(INPUT_POST, "unit"); //unidad
        $dest = filter_input(INPUT_POST, "reqval"); //unidad
        $add = filter_input(INPUT_POST, "addor"); //unidad
        $q1 = "insert into cms_addons(cid,tipo,valor,required,unidad,destino,agregador)values('$catalog','$tdato','$valp','$reqre','$unit','$dest','$add')";
        $qry = mysqli_query($CNN, $q1)or $err = "error al agregar los datos<br>$q1<br>" . mysqli_error($CNN);
        if (!isset($err)) {
            $lin = mysqli_insert_id($CNN);
            $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1"); //lenguajes activos
            $q2 = "insert into cms_addon_translate(tname,aid,lang,caption)values";
            while ($lr = mysqli_fetch_array($lq)) {
                $q2.="('$catalog','$lin','" . $lr['iso_639_1'] . "',"
                        . "'" . filter_input(INPUT_POST, "name_" . $lr['iso_639_1']) . "'),";
            }
            $q2 = substr($q2, 0, -1);
            $lq2 = mysqli_query($CNN, $q2)or $err = "error al ingresar las traducciones" . mysqli_error($CNN);
            if (!isset($err)) {
                echo "<b>Guardado Correctamente</b>";
            } else {
                echo $err;
            }
        } else {
            echo $err;
        }
        break;
    //INSERTA /ACTUALIZA ADDONS DE PROPIEDAD(SOLO CUANDO SE AGREGA UN ELEMENTO DE LA LISTA) CUANDO TIENE EL BOTON DE AGREGAR
    case 1:
        $guard = filter_input(INPUT_POST, "ads");
        $val = $_REQUEST["val"];
        $dest = $_REQUEST["dest"];
        $v = implode("|", $val);
        $d = implode("|", $dest);
        if ($d != null || $v != null) {
            if ($guard < 1) {
                $pid = filter_input(INPUT_POST, "pid");
                $cid = filter_input(INPUT_POST, "cid");
                $aid = filter_input(INPUT_POST, "aid");
                $qry = "insert into cms_property_addons(pid,cid,aid,ovalue,dest)values('$pid','$cid','$aid','$v','$d')";
            } else {
                $qry = "update cms_property_addons set ovalue='$v',dest='$d' where id=$guard";
            }
        } else {
            $qry = "delete from cms_property_addons where id=$guard";
        }
        $doqry = mysqli_query($CNN, $qry) or $err = "0|Error al ingresar el item:" . mysqli_error($CNN);
        if (!isset($err)) {
            if ($guard < 1) {
                $lid = mysqli_insert_id($CNN);
                echo "1|" . $lid;
            } else {
                echo "1|" . $guard;
            }
        } else {
            echo $err;
        }
        break;
    //ACTUALIZA/ELIMINA EL ADDON DE PROPIEDAD(AL ELIMINAR UN ELEMENTO DE LA LISTA) CUANDO TIENE EL BOTON DE AGREGAR
    case 2:
        $up = filter_input(INPUT_POST, "upd");
        $id = filter_input(INPUT_POST, "id");
        if ($up == 1) {
            $val = $_REQUEST["v"];
            $dest = $_REQUEST["d"];
            $v = implode("|", $val);
            $d = implode("|", $dest);
            $qry = "update cms_property_addons set ovalue='$v',dest='$d' where id=$id";
        } else {
            $qry = "delete from cms_property_addons where id=$id";
        }
        $dupd = mysqli_query($CNN, $qry)or $err = "0|ERROR AL REALIZAR LA ACCION" . mysqli_error($CNN);
        if (!isset($err)) {
            if ($up == 1) {
                echo "1|$id";
            } else {
                echo "1|0";
            }
        } else {
            echo $err;
        }
        break;
    //GUARDA LOS CMAPOS DE LA PROPIEDAD QUE NO ESTAN EN ALGUN CATALOGO
    case 3:
        $pid = filter_input(INPUT_POST, "pid");
        $ch = filter_input(INPUT_POST, "camp");
        $val = filter_input(INPUT_POST, "val");
        $updch = "update cms_property set $ch='$val' where id=$pid";
        $eje = mysqli_query($CNN, $updch)or $err = "0|error al actualizar el campo<b>$ch<b>:<br>$updch<br>" . mysqli_error($CNN);
        if (!isset($err)) {
            echo "1|1";
        } else {
            echo $err;
        }
        break;
    //GUARDA LOS ADDONS DE LA PROPIEDAD QUE ESTAN EN UN CATALOGO PERO NO TIENE  EL BOTON DE AGREGAR
    case 4:
        $id = filter_input(INPUT_POST, "id");
        $pid = filter_input(INPUT_POST, "pid");
        $cid = filter_input(INPUT_POST, "cid");
        $aid = filter_input(INPUT_POST, "aid");
        $val = filter_input(INPUT_POST, "val");
        $c = filter_input(INPUT_POST, "ca");
        if ($c == 0) {
            $ch = "ovalue";
        } else {
            $ch = "dest";
        }
        if ($id < 1) {
            $q = "insert into cms_property_addons(pid,cid,aid,$ch)values('$pid','$cid','$aid','$val')";
        } else {
            $q = "update cms_property_addons set $ch='$val' where id=$id";
        }
        $doq = mysqli_query($CNN, $q)or $err = "0|Error al guardar" . mysqli_error($CNN);
        if (!isset($err)) {
            if ($id > 1) {
                echo "1|" . $id;
            } else {
                $i = mysqli_insert_id($CNN);
                echo "1|" . $i;
            }
        } else {
            echo $err;
        }

        break;
    //GUARDA EL NOMBRE DE LA PROPIEDAD(REQUERIDO) Y REGRESA EL ID DE LA PROPIEDAD
    case 5:
        $qry = "insert into cms_property (name)values('" . filter_input(INPUT_POST, 'v') . "')";
        $doq = mysqli_query($CNN, $qry)or $err = "0|ERROR AL CREAR LA PROPIEDAD" . mysqli_error($CNN);
        if (!isset($err)) {
            $nwe = mysqli_insert_id($CNN);
            /* $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
              $lng = array();
              while ($ll = mysqli_fetch_array($lq)) {
              $lng[] = $ll['iso_639_1'];
              }
              $addlng = "insert into cms_property_translate(pid,cname,lang)values";
              foreach ($lng as $L) {
              $addlng.="('$nwe','rent-short','$L'),('$nwe','rent-large','$L'),";
              }
              $addlng = substr($addlng, 0, -1);
              $dolang = mysqli_query($CNN, $addlng) or $err = "0|Error al crear los lenguajes:" . mysqli_error($CNN);
              if (!isset($err)) { */
            echo "1|" . $nwe;
            /* } else {
              echo $err;
              } */
        } else {
            echo $err;
        }
        break;
    case 6:
        $id = filter_input(INPUT_POST, "id"); //id del campos si ya se guardo
        $ch = filter_input(INPUT_POST, "camp");
        $pid = filter_input(INPUT_POST, "pid");
        $val = filter_input(INPUT_POST, "value");
        $arr = explode("_", $ch);
        if ($id >= 1) {
            $q = "update cms_property_translate set caption='$val' where id=$id";
        } else {
            $q = "insert into cms_property_translate(pid,cname,lang,caption)values('{$pid}','{$arr[0]}','{$arr[1]}','$val')";
        }
        $doins = mysqli_query($CNN, $q)or $err = "0|Error al Guardar los datos:<br>" . mysqli_error($CNN);
        if (!isset($err)) {
            if ($id >= 1) {
                echo "1|" . $id;
            } else {
                $nwid = mysqli_insert_id($CNN);
                echo "1|" . $nwid;
            }
        } else {
            echo $err;
        }
        break;
    //guarda los checkbox
    case 7:
        $pid = filter_input(INPUT_POST, "pid");
        $cid = filter_input(INPUT_POST, "cid");
        $aid = filter_input(INPUT_POST, "aid");
        $val = filter_input(INPUT_POST, "val");
        if ($val == 1) {
            $q = "insert into cms_property_addons(pid,cid,aid)values('$pid','$cid','$aid')";
        } else {
            $q = "delete from cms_property_addons where pid=$pid and cid=$cid and aid=$aid";
        }
        $doq = mysqli_query($CNN, $q)or $err = "0|Error al guardar" . mysqli_error($CNN);
        if (!isset($err)) {
            echo "1";
        } else {
            echo $err;
        }
        break;
    /*case 10:
        $name = filter_input(INPUT_POST, "newname");
        $tdato = filter_input(INPUT_POST, "tdato");
        $acvo = filter_input(INPUT_POST, "activ");
        $reqre = filter_input(INPUT_POST, "raq");
        $unit = filter_input(INPUT_POST, "unit");
        $valp = filter_input(INPUT_POST, "valp");
        $isguard = filter_input(INPUT_POST, "idsav");
        if ($isguard == 0) {
            $ins_gral = mysqli_query($CNN, "insert into cms_property_interior (name,tipo,valor,active,required,unidad)values('$name','$tdato','$valp','$acvo','$reqre','$unit')");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                OPERACION EXITOSA
                <?php
            }
        } else {
            $ins_gral = mysqli_query($CNN, "update cms_property_interior set name='$name',tipo='$tdato',valor='$valp',active='$acvo',required='$reqre',unidad='$unit' where id=$isguard");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                OPERACION EXITOSA
                <?php
            }
        }
        break;
    case 11:
        $nbre = filter_input(INPUT_POST, "e_name");
        $datatype = filter_input(INPUT_POST, "e_tdato");
        $isactive = filter_input(INPUT_POST, "e_activ");
        $reque = filter_input(INPUT_POST, "e_raq");
        $unid = filter_input(INPUT_POST, "e_unit");
        $va = filter_input(INPUT_POST, "e_valp");
        $id = filter_input(INPUT_POST, "e_id");
        $actual = mysqli_query($CNN, "UPDATE cms_property_interior SET   name = '$nbre',tipo = '$datatype',valor = '$va',active = '$isactive',required = '$reque',unidad = '$unid' WHERE id =$id");
        if (!$actual) {
            echo "ERROR AL MODIFICAR ESTE CAMPO";
        } else {
            echo"GUARDADO CON EXITO";
        }
        break;
       case 20:
        $name = filter_input(INPUT_POST, "newname");
        $tdato = filter_input(INPUT_POST, "tdato");
        $acvo = filter_input(INPUT_POST, "activ");
        $reqre = filter_input(INPUT_POST, "raq");
        $unit = filter_input(INPUT_POST, "unit");
        $valp = filter_input(INPUT_POST, "valp");
        $isguard = filter_input(INPUT_POST, "idsav");
        if ($isguard == 0) {
            $ins_gral = mysqli_query($CNN, "insert into cms_property_exterior (name,tipo,valor,active,required,unidad)values('$name','$tdato','$valp','$acvo','$reqre','$unit')");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                OPERACION EXITOSA
                <?php
            }
        } else {
            $ins_gral = mysqli_query($CNN, "update cms_property_exterior set name='$name',tipo='$tdato',valor='$valp',active='$acvo',required='$reqre',unidad='$unit' where id=$isguard");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                OPERACION EXITOSA
                <?php
            }
        }
        break;
    case 21:
        $nbre = filter_input(INPUT_POST, "e_name");
        $datatype = filter_input(INPUT_POST, "e_tdato");
        $isactive = filter_input(INPUT_POST, "e_activ");
        $reque = filter_input(INPUT_POST, "e_raq");
        $unid = filter_input(INPUT_POST, "e_unit");
        $va = filter_input(INPUT_POST, "e_valp");
        $id = filter_input(INPUT_POST, "e_id");
        $actual = mysqli_query($CNN, "UPDATE cms_property_exterior SET   name = '$nbre',tipo = '$datatype',valor = '$va',active = '$isactive',required = '$reque',unidad = '$unid' WHERE id =$id");
        if (!$actual) {
            echo "ERROR AL MODIFICAR ESTE CAMPO";
        } else {
            echo"GUARDADO CON EXITO";
        }
        break;
    case 22:
        $id = filter_input(INPUT_POST, "elim_id");
        $isp = mysqli_query($CNN, "select faul from cms_property_exterior where id=$id");
        while ($n = mysqli_fetch_array($isp)) {
            $ispred = $n['faul'];
        }
        if ($ispred == 1) {
            ?>
            <label>No es posible eliminar un item predeterminado por el sistema</label>
            <?php
        } else {
            $del = mysqli_query($CNN, "DELETE from cms_property_exterior where id=$id");
            if (!$del) {
                ?>
                <label >ERROR AL ELIMINAR LOS DATOS</label>
                <?php
            } else {
                ?>
                <label>Eliminado correctamente</label>
                <?php
            }
        }
        break;
    case 30:
        $name = filter_input(INPUT_POST, "newname");
        $tdato = filter_input(INPUT_POST, "tdato");
        $acvo = filter_input(INPUT_POST, "activ");
        $reqre = filter_input(INPUT_POST, "raq");
        $unit = filter_input(INPUT_POST, "unit");
        $valp = filter_input(INPUT_POST, "valp");
        $isguard = filter_input(INPUT_POST, "idsav");
        if ($isguard == 0) {
            $ins_gral = mysqli_query($CNN, "insert into cms_property_equip (name,tipo,valor,active,required,unidad)values('$name','$tdato','$valp','$acvo','$reqre','$unit')");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                OPERACION EXITOSA
                <?php
            }
        } else {
            $ins_gral = mysqli_query($CNN, "update cms_property_equip set name='$name',tipo='$tdato',valor='$valp',active='$acvo',required='$reqre',unidad='$unit' where id=$isguard");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                OPERACION EXITOSA
                <?php
            }
        }
        break;
    case 31:
        $nbre = filter_input(INPUT_POST, "e_name");
        $datatype = filter_input(INPUT_POST, "e_tdato");
        $isactive = filter_input(INPUT_POST, "e_activ");
        $reque = filter_input(INPUT_POST, "e_raq");
        $unid = filter_input(INPUT_POST, "e_unit");
        $va = filter_input(INPUT_POST, "e_valp");
        $id = filter_input(INPUT_POST, "e_id");
        $actual = mysqli_query($CNN, "UPDATE cms_property_equip SET   name = '$nbre',tipo = '$datatype',valor = '$va',active = '$isactive',required = '$reque',unidad = '$unid' WHERE id =$id");
        if (!$actual) {
            echo "ERROR AL MODIFICAR ESTE CAMPO";
        } else {
            echo"GUARDADO CON EXITO";
        }
        break;
    case 32:
        $id = filter_input(INPUT_POST, "elim_id");
        $isp = mysqli_query($CNN, "select faul from cms_property_equip where id=$id");
        while ($n = mysqli_fetch_array($isp)) {
            $ispred = $n['faul'];
        }
        if ($ispred == 1) {
            ?>
            <label>No es posible eliminar un item predeterminado por el sistema</label>
            <?php
        } else {
            $del = mysqli_query($CNN, "DELETE from cms_property_equip where id=$id");
            if (!$del) {
                ?>
                <label>ERROR AL ELIMINAR LOS DATOS</label>
                <?php
            } else {
                ?>
                <label>Eliminado correctamente</label>
                <?php
            }
        }
        break;
    case 40:
        $name = filter_input(INPUT_POST, "newname");
        $tdato = filter_input(INPUT_POST, "tdato");
        $acvo = filter_input(INPUT_POST, "activ");
        $reqre = filter_input(INPUT_POST, "raq");
        $unit = filter_input(INPUT_POST, "unit");
        $valp = filter_input(INPUT_POST, "valp");
        $isguard = filter_input(INPUT_POST, "idsav");
        if ($isguard == 0) {
            $ins_gral = mysqli_query($CNN, "insert into cms_property_extra (name,tipo,valor,active,required,unidad)values('$name','$tdato','$valp','$acvo','$reqre','$unit')");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                OPERACION EXITOSA
                <?php
            }
        } else {
            $ins_gral = mysqli_query($CNN, "update cms_property_extra set name='$name',tipo='$tdato',valor='$valp',active='$acvo',required='$reqre',unidad='$unit' where id=$isguard");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                OPERACION EXITOSA
                <?php
            }
        }
        break;
    case 41:
        $nbre = filter_input(INPUT_POST, "e_name");
        $datatype = filter_input(INPUT_POST, "e_tdato");
        $isactive = filter_input(INPUT_POST, "e_activ");
        $reque = filter_input(INPUT_POST, "e_raq");
        $unid = filter_input(INPUT_POST, "e_unit");
        $va = filter_input(INPUT_POST, "e_valp");
        $id = filter_input(INPUT_POST, "e_id");
        $actual = mysqli_query($CNN, "UPDATE cms_property_extra SET   name = '$nbre',tipo = '$datatype',valor = '$va',active = '$isactive',required = '$reque',unidad = '$unid' WHERE id =$id");
        if (!$actual) {
            echo "ERROR AL MODIFICAR ESTE CAMPO";
        } else {
            echo"GUARDADO CON EXITO";
        }
        break;
    case 42:
        $id = filter_input(INPUT_POST, "elim_id");
        $isp = mysqli_query($CNN, "select faul from cms_property_extra where id=$id");
        while ($n = mysqli_fetch_array($isp)) {
            $ispred = $n['faul'];
        }
        if ($ispred == 1) {
            ?>
            <label>No es posible eliminar un item predeterminado por el sistema</label>
            <?php
        } else {
            $del = mysqli_query($CNN, "DELETE from cms_property_extra where id=$id");
            if (!$del) {
                ?>
                <label >RROR AL ELIMINAR LOS DATOS</label>
                <?php
            } else {
                ?>
                <label >Eliminado correctamente</label>
                <?php
            }
        }
        break;*/
    case 50:
        $t = filter_input(INPUT_POST, "tipo");
        $p = filter_input(INPUT_POST, "parent");
        $n = filter_input(INPUT_POST, "name");
        $sqry = "insert into cms_property_locale (tipo,parent,name)values('$t','$p','$n')";
        $ins = mysqli_query($CNN, $sqry)or $err = "0|Error al insertar <b>$n</b><br>$sqry<br>" . mysqli_error($CNN);
        if (!isset($err)) {
            if($t==1)
            {
                $li=  mysqli_insert_id($CNN);
                echo "1|".$li;
            }
            else
            {
                echo "2|GUARDADO CORRECTAMENTE";
            }
        } else {
            
        }
        break;
    case 51:
        $nbre = filter_input(INPUT_POST, "nme");
        $id = filter_input(INPUT_POST, "id");
        $actual = mysqli_query($CNN, "UPDATE cms_property_locale SET name = '$nbre' WHERE id =$id");
        if (!$actual) {
            echo "0";
        } else {
            echo"1";
        }
        break;
    case 52:
        $id = filter_input(INPUT_POST, "id");
        $del = mysqli_query($CNN, "DELETE from cms_property_locale where id=$id");
        if (!$del) {
            echo "0";
        } else {
            echo "1";
        }

        break;
    case 60:
        $destino = filter_input(INPUT_POST, "des_name");
        $ins_gral = mysqli_query($CNN, "insert into cms_property_type (name)values('$destino')");
        if (!$ins_gral) {
            Echo "0";
        } else {
            echo "1";
        }
        break;
    case 61:
        $nbre = filter_input(INPUT_POST, "e_des_name");
        $id = filter_input(INPUT_POST, "desid");
        $actual = mysqli_query($CNN, "UPDATE cms_property_type SET name = '$nbre' WHERE id =$id");
        if (!$actual) {
            echo "0";
        } else {
            echo"1";
        }
        break;
    case 62:
        $id = filter_input(INPUT_POST, "e_desid");
        $del = mysqli_query($CNN, "DELETE from cms_property_type where id=$id");
        if (!$del) {
            echo "0";
        } else {
            echo "1";
        }
        break;
    case 70:
        $id = filter_input(INPUT_POST, "house_id");
        $col = array("general", "interior", "exterior", "extra", "equip");
        $del = mysqli_query($CNN, "DELETE from cms_property where id=$id");
        if (!$del) {
            echo "0";
        } else {
            $errodel = 0;
            $txterr = "";
            foreach ($col as $c) {
                $del_pro = mysqli_query($CNN, "DELETE from cms_property_e_$c where pid=$id");
                if (!$del_pro) {
                    $errordel++;
                    $txterr.=mysqli_error($CNN);
                }
            }
            if ($errodel == 0) {
                echo "1";
            } else {
                echo $txterr;
            }
        }
        break;
    case 71:
        $camp = filter_input(INPUT_POST, "camp");
        $val = filter_input(INPUT_POST, "value");
        $guard = filter_input(INPUT_POST, "guard");
        $arr = explode("_", $camp);
        if (count($arr) < 2) {
            $cname = explode("-", $camp);
            if ($guard == 0) {
                $hacer = mysqli_query($CNN, "insert into cms_property($cname[1]) values('$val')")or $err = "Error al Autoguardar<br>" . mysqli_error($CNN);
                if (!isset($err)) {
                    $lastid = mysqli_insert_id($CNN);
                    $lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
                    $language = array();
                    while ($lr = mysqli_fetch_array($lq)) {
                        $language[] = $lr['iso_639_1'];
                    }
                    $instrans = "insert into cms_property_translate(pid,cname,lang)values";
                    foreach ($language as $L) {
                        $instrans.="('$lastid','rent-short','$L'),('$lastid','rent-large','$L'),";
                    }
                    $instrans = substr($instrans, 0, -1);
                    $dolang = mysqli_query($CNN, $instrans) or $err = "Error al crear los lenguajes:" . mysqli_error($CNN);
                    if (!isset($err)) {
                        $insadon = mysqli_query($CNN, "select * from cms_addons where required=1");
                        $exec = "insert into cms_property_addons (pid,cid,aid,ovalue) values";
                        while ($e = mysqli_fetch_array($insadon)) {
                            $exec.="('$lastid','" . $e['cid'] . "','" . $e['id'] . "','" . $e['valor'] . "'),";
                        }
                        $exec = substr($exec, 0, -1);
                        $insadonn = mysqli_query($CNN, $exec)or $err = mysqli_error($CNN);
                        if (!isset($err)) {
                            echo "1|" . $lastid;
                        } else {
                            echo "0|" . $err;
                        }
                    } else {
                        echo "0|" . $err;
                    }
                } else {
                    echo "0|" . $err;
                }
            } else {
                $hacer = mysqli_query($CNN, "update cms_property set $cname[1]='$val' where id=$guard")or $err = "Error al Autoguardar" . mysqli_error($CNN);
                if (!isset($err)) {
                    echo "OK|OK";
                } else {
                    echo "0|" . $err;
                }
            }
        } else {
            $lsh = filter_input(INPUT_POST, "sh");
            $llon = filter_input(INPUT_POST, "lon");
            if ($lsh == 0) {
                /*
                  $hacer = mysqli_query($CNN, "insert into cms_property_translate(pid,cname,lang,caption) values('$guard','$arr[0]','$arr[1]','$val')")or $err = "Error al Autoguardar" . mysqli_error($CNN);
                  if (!isset($err)) {
                  $lastid = mysqli_insert_id($CNN);
                  echo "2|" . $lastid;
                  } else {
                  echo "0|" . $err;
                  }
                  } else {
                  $hacer = mysqli_query($CNN, "update cms_property_translate set caption='$val' where id=$guard and cname='$arr[0]' and lang='$arr[1]'")or $err = "Error al Autoguardar" . mysqli_error($CNN);
                  if (!isset($err)) {
                  echo "OK|OK";
                  } else {
                  echo "0|" . $err;
                  } */
            }
        }
        break;
    case 72:
        $tab = filter_input(INPUT_POST, "tab");
        $guard = filter_input(INPUT_POST, "idcamp");
        $getitem = mysqli_query($CNN, "select * from cms_property_$tab");
        if (!$getitem) {
            echo "Error" . die(mysqli_error($CNN));
        } else {
            $inse = "insert into cms_property_e_$tab (pid, oid, ovalue)values";
            while ($t = mysqli_fetch_array($getitem)) {
                if ($t['active'] == 1 && $t['required'] == 1) {
                    $inse.="('$guard','{$t['id']}','{$t['valor']}'),";
                }
            }
            $inse = substr($inse, 0, -1);
            $inse.=";";
            $qry = mysqli_query($CNN, $inse);
            if (!$qry) {
                echo "Error al autoguardar" . die(mysqli_error($CNN));
            } else {
                echo "1";
            }
        }
        break;
    case 73:
        print_r($_REQUEST);
        //Array ( [op] => 73 [val] => 2 [cat] => 1 [addon] => 1 [pid] => 10 ) ;
        /* $name = filter_input(INPUT_POST, "name"); //nombre del item
          $val = filter_input(INPUT_POST, "val"); //valor a insertar
          $iditem = filter_input(INPUT_POST, "iditem"); //id del itempara ubicarlo en la tabla
          $pid = filter_input(INPUT_POST, "prop"); //id de la propiedad
          $it = substr($name, 0, 2);
          $tbl = '';
          switch ($it)
          {
          case 'ge':
          $tbl = 'general';
          break;
          case 'in':
          $tbl = 'interior';
          break;
          case 'ou':
          $tbl = 'exterior';
          break;
          case 'ex':
          $tbl = 'extra';
          break;
          case 'eq':
          $tbl = 'equip';
          break;
          }
          $exi = mysqli_query($CNN, "SELECT * FROM cms_property_e_$tbl WHERE pid=$pid and oid=$iditem");
          $nexi = mysqli_num_rows($exi);
          if ($nexi == 0) {
          $newre = mysqli_query($CNN, "insert into cms_property_e_$tbl (pid,oid,ovalue) values('$pid','$iditem','$val')");
          if (!$newre) {
          echo "error" . die(mysqli_error($CNN));
          } else {
          echo "Autoguardado";
          }
          } else {
          $actre = mysqli_query($CNN, "update cms_property_e_$tbl  set ovalue=$val WHERE pid=$pid and oid=$iditem");
          if (!$actre)
          {
          echo "error" . die(mysqli_error($CNN));
          } else {
          echo "Autoguardado";
          }
          } */
        break;
    case 74:
        $name = filter_input(INPUT_POST, "name"); //nombre del item
        $val = filter_input(INPUT_POST, "val"); //valor a insertar
        $iditem = filter_input(INPUT_POST, "iditem"); //id del itempara ubicarlo en la tabla
        $pid = filter_input(INPUT_POST, "prop"); //id de la propiedad
        $it = substr($name, 0, 2);
        $tbl = '';
        switch ($it) {
            case 'ge':
                $tbl = 'general';
                break;
            case 'in':
                $tbl = 'interior';
                break;
            case 'ou':
                $tbl = 'exterior';
                break;
            case 'ex':
                $tbl = 'extra';
                break;
            case 'eq':
                $tbl = 'equip';
                break;
        }
        $delitem = mysqli_query($CNN, "delete from cms_property_e_$tbl where oid=$iditem  and pid=$pid");
        if (!$delitem) {
            echo "Error al autoguardad" . die(mysqli_error($CNN));
        } else {
            echo "Autoguardado";
        }
        break;
    case 75:
        $name = filter_input(INPUT_POST, "name"); //nombre del item
        $val = filter_input(INPUT_POST, "val"); //valor a insertar
        $iditem = filter_input(INPUT_POST, "iditem"); //id del itempara ubicarlo en la tabla
        $pid = filter_input(INPUT_POST, "prop"); //id de la propiedad
        $it = substr($name, 0, 2);
        $tbl = '';
        switch ($it) {
            case 'ge':
                $tbl = 'general';
                break;
            case 'in':
                $tbl = 'interior';
                break;
            case 'ou':
                $tbl = 'exterior';
                break;
            case 'ex':
                $tbl = 'extra';
                break;
            case 'eq':
                $tbl = 'equip';
                break;
        }
        $savdat = mysqli_query($CNN, "update cms_property_e_$tbl set ovalue='$val' where pid='$pid' and oid='$iditem'");
        if (!$savdat) {
            echo "Error al autoguardad " . die(mysqli_error($CNN));
        } else {
            echo "Autoguardado";
        }
        break;
    case 76:
        $id = filter_input(INPUT_POST, "clonid");
        $getgral = mysqli_query($CNN, "select * from cms_property where id=$id") or $err = "Error al copiar la propiedad" . mysqli_error($CNN);
        echo "select * from cms_property where id=$id";
        if (!isset($err)) {
            $stri = "INSERT INTO cms_property(id,title,prize,room,capacity,tipo,modo,location,short_desc,long_desc,deal,bathroom,metadatos,seo,address)VALUES(";
            $n = 0;
            while ($p = mysqli_fetch_array($getgral)) {
                $stri.="'" . $p[$n] . "',";
                $n++;
                echo $p[$n];
            }
            $stri = substr($stri, 0, -1);
            echo $stri . ")";
        } else {
            echo $err;
        }
        break;
    case 77:
        $id = filter_input(INPUT_POST, "idhou");
        $val = filter_input(INPUT_POST, "val");
        if ($val == 1) {
            $act = 0;
        } else {
            $act = 1;
        }
        $activaprop = mysqli_query($CNN, "Update cms_property set status='$act' where id=$id")or $err = "Error al activar/desactivar";
        if (!isset($err)) {
            if ($val == 1) {
                echo "Propiedad Desactivada";
            } else {
                echo "Propiedad Activada";
            }
        } else {
            echo $err;
        }
        break;
    case 78:
        $camp = filter_input(INPUT_POST, "camp");
        $val = filter_input(INPUT_POST, "value");
        $llon = filter_input(INPUT_POST, "lon");
        $guard = filter_input(INPUT_POST, "guard");
        $arr = explode("_", $camp);
        if ($llon == 0) {
            $hacer = mysqli_query($CNN, "insert into cms_property_translate(pid,cname,lang,caption) values('$guard','$arr[0]','$arr[1]','$val')")or $err = "Error al Autoguardar" . mysqli_error($CNN);
            if (!isset($err)) {
                $lastid = mysqli_insert_id($CNN);
                echo "1|" . $lastid;
            } else {
                echo "0|" . $err;
            }
        } else {
            $hacer = mysqli_query($CNN, "update cms_property_translate set caption='$val' where pid=$guard and cname='$arr[0]' and lang='$arr[1]'")or $err = "Error al Autoguardar" . mysqli_error($CNN);
            if (!isset($err)) {
                echo "OK|OK";
            } else {
                echo "0|" . $err;
            }
        }
        break;
    case 79:
        $camp = filter_input(INPUT_POST, "camp");
        $val = filter_input(INPUT_POST, "value");
        $lsh = filter_input(INPUT_POST, "sho");
        $guard = filter_input(INPUT_POST, "guard");
        $arr = explode("_", $camp);
        if ($lsh == 0) {
            $hacer = mysqli_query($CNN, "insert into cms_property_translate(pid,cname,lang,caption) values('$guard','$arr[0]','$arr[1]','$val')")or $err = "Error al Autoguardar" . mysqli_error($CNN);
            if (!isset($err)) {
                $lastid = mysqli_insert_id($CNN);
                echo "1|" . $lastid;
            } else {
                echo "0|" . $err;
            }
        } else {
            $hacer = mysqli_query($CNN, "update cms_property_translate set caption='$val' where pid=$guard and cname='$arr[0]' and lang='$arr[1]'")or $err = "Error al Autoguardar" . mysqli_error($CNN);
            if (!isset($err)) {
                echo "OK|OK";
            } else {
                echo "0|" . $err;
            }
        }
        break;
    case 80:
        $id = filter_input(INPUT_POST, "elim_id");
        $prop = filter_input(INPUT_POST, "prop_id");
        $q = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE id=$id and pid=$prop") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            unlink("../../../content/upload/property/" . $r['name'] . "_m.jpg");
            unlink("../../../content/upload/property/" . $r['name'] . "_b.jpg");
        }
        $del = mysqli_query($CNN, "DELETE from cms_property_gallery where pid=$prop and id=$id ")OR DIE(mysqli_error($CNN));
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
    case 91:
        $idoff = filter_input(INPUT_POST, "el_id");
        $borrof = mysqli_query($CNN, "delete from cms_property_deal where id=$idoff") or $errooff = "error al borrar" . mysqli_error($CNN);
        if (!isset($errooff)) {
            echo "1";
        } else {
            echo $errooff;
        }
        break;
    case 100:
        $id = filter_input(INPUT_POST, "id");
        ?>
        <script>
            $(function () {
                $("#fini").datepicker({dateFormat: 'dd-mm-yy'});
            });
            $(function () {
                $("#fend").datepicker({dateFormat: 'dd-mm-yy'});
            });

        </script>
        <small>
            <form id="offernew" name="offernew">
                <input type="text" name="op" id="op"value="101" class="hidden"/>
                <input type="text" name="idprop" id="idprop" value="<?php echo $id; ?>" class="hidden"/>
                <table id="tblofer" class="tbl table-condensed">                    <tr>
                        <td colspan="3">Titulo: <input type="text" name="nameoff" id="nameoff" class="form-control" tabindex="1"/></td>
                        <td>Monto: <input type="text" name="addoff" id="addoff" class="form-control" tabindex="2" required/></td>
                    </tr>
                    <tr>
                        <td>Desde:<input type="text" name="fini" id="fini" class="form-control" tabindex="3"/></td>
                        <td>Hasta: <input type="text" name="fend" id="fend" class="form-control"tabindex="4"/></td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <input type="radio" value="0" name="tipeofer" id="tipeofer" tabindex="5"/>Porcent
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" value="1" name="tipeofer" id="tipeofer" tabindex="6"/>Precio
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td><label class="btn btn-info" tabindex="7" alt="Agregar Oferta" title="Agregar Oferta" onclick="inoffer();"><span class="fa fa-plus-circle"></span></label></td>
                    </tr>
                </table>
            </form>
        </small>
        <div id="taofer" name="taofer">
        <?php
        $getarrp = mysqli_query($CNN, "SELECT * FROM crs_property_deal_e_property WHERE pid=$id");
        $proarr = array();
        $pos = 0;
        while ($p = mysqli_fetch_array($getarrp)) {
            $proarr[$pos] = $p['idof'];
            $pos++;
        }
        $exeqry = mysqli_query($CNN, "select * from crs_property_deal");
        ?>

            <table id="misofertas" name="misofertas" class="tbl table-striped" width="100%">
            <?php
            while ($x = mysqli_fetch_array($exeqry)) {
                ?>
                    <tr>
                        <td width="5%">
                            <input type="checkbox" value="<?php echo $x['id']; ?>" id="check_<?php echo $x['id']; ?>" name="check_<?php echo $x['id']; ?>" <?php
            if (in_array($x['id'], $proarr)) {
                echo "checked";
            }
                ?> onclick="addprofunc(<?php echo $id . ',' . $x['id']; ?>);" >
                        </td>
                        <td width="35%">
                                   <?php echo $x['name']; ?>
                        </td>
                        <td width="40%">
                            <?php echo date("d-m-Y", strtotime($x['date_ini'])) . " - " . date("d-m-Y", strtotime($x['date_end'])); ?>
                        </td>
                        <td>
                            <?php
                            if ($x['tipo'] == 0) {
                                echo number_format($x['cant']) . "%";
                            } else {
                                echo number_format($x['cant']);
                            }
                            ?>
                        </td>
                        <td width="10%">
                            <a href="JavaScript:void(0)" alt="Clonar" title="Clonar" onclick="clonaoferta(<?php echo $x['id']; ?>)"><span class="fa fa-copy"></span></a>
                        </td>
                    </tr>
            <?php
        }
        ?>
            </table>
        </div>
        <!--   <script>
            function addprofunc(idhouse)
            {
                alert(idhouse)
            }
        </script>-->
        <?php
        break;
    case 101:
        $nam = filter_input(INPUT_POST, "nameoff");
        $mount = filter_input(INPUT_POST, "addoff");
        $dini = date("Y-m-d", strtotime(filter_input(INPUT_POST, "fini")));
        $dend = date("Y-m-d", strtotime(filter_input(INPUT_POST, "fend")));
        $to = filter_input(INPUT_POST, "tipeofer");
        if ($mount != null && $dini != null && $dend != null && $to != null) {
            if ($dini <= $dend) {
                switch ($to) {
                    case 0:
                        if ($mount > 0 && $mount <= 100) {
                            $qry = mysqli_query($CNN, "insert into cms_property_deal(name,cant,date_ini,date_end,tipo)values('$nam','$mount','$dini','$dend','$to')")or $err = "Errror al insertar" . mysqli_error($CNN);
                            if (!isset($err)) {
                                echo "100";
                            } else {
                                echo $err;
                            }
                        } else {
                            echo "2";
                        }
                        break;
                    case 1:
                        if ($mount > 0) {
                            $qry = mysqli_query($CNN, "insert into cms_property_deal(name,cant,date_ini,date_end,tipo)values('$nam','$mount','$dini','$dend','$to')")or $err = "Errror al insertar" . mysqli_error($CNN);
                            if (!isset($err)) {
                                echo "100";
                            } else {
                                echo $err;
                            }
                        } else {
                            echo "3";
                        }
                        break;
                    default:
                        echo "4";
                        break;
                }
            } else {
                echo "1";
            }
        } else {
            echo "0";
        }
        /*
         * 0: error con valor nulo
         * 1: error de fechas
         * 2: error de porcentaje del 1-100
         * 3: error de monto <= 0
         * 4: otro error
         * 100: INSERTAR CORRECTAMENTE
         */
        break;
    case 102:
        $pid = filter_input(INPUT_POST, "pid");
        $ido = filter_input(INPUT_POST, "idof");
        $qry = mysqli_query($CNN, "insert into crs_property_deal_e_property(pid,idof)values($pid,$ido)")or $er = "Error" . mysqli_error($CNN);
        if (!isset($er)) {
            echo "1";
        } else {
            echo $err;
        }
        break;
    case 103:
        $pid = filter_input(INPUT_POST, "pid");
        $ido = filter_input(INPUT_POST, "idof");
        $qry = mysqli_query($CNN, "delete from crs_property_deal_e_property where pid=$pid and idof=$ido")or $er = "Error" . mysqli_error($CNN);
        if (!isset($er)) {
            echo "1";
        } else {
            echo $err;
        }
        break;
    case 104:
        echo "</form>";
        $id = filter_input(INPUT_POST, "id");
        $exeqry = mysqli_query($CNN, "select * from crs_property_deal where id=$id");
        $cuanmodif = mysqli_query($CNN, "select * from crs_property_deal_e_property where idof=$id");
        $no = mysqli_num_rows($cuanmodif);
        while ($d = mysqli_fetch_array($exeqry)) {
            if ($no >= 1) {
                ?>
                <div class="alert alert-warning"  id="alertmodi" name="alertmodi" role="alert"><div class="col-sm-offset-1" style="margin-left: 95%; " onclick=" $('#alertmodi').remove();" ><b><span class="fa fa-close"></span></b></div>Automaticamente se modificaran <b><?php echo $no; ?></b><br> Propiedades que tienen aplicadas esta oferta </div>
                <?php
            }
            ?>
            <form id="modificaoferta" name="modificaoferta" type="post">
                <input type="text" value="1" name="op" id="op"/>
                <input type="text" value="<?php echo $id; ?>"  name="ido" id="ido"/>
                <table id="tblofer" class="tbl table-condensed">
                    <tr>
                        <td colspan="3">Titulo: <input type="text" name="txtname" id="txtname" class="form-control" value="<?php echo $d['name']; ?>" tabindex="1"/></td>
                        <td>Monto: <input type="text" name="txtmount" id="txtmount" class="form-control" value="<?php echo $d['cant']; ?>" tabindex="2" required/></td>
                    </tr>
                    <tr>
                        <td>Desde:<input type="text" name="d_ini" id="d_ini" class="form-control" value="<?php echo date("d-m-Y", strtotime($d['date_ini'])); ?>" tabindex="3"/></td>
                        <td>Hasta:<input type="text" name="f_end" id="f_end" class="form-control" value="<?php echo date("d-m-Y", strtotime($d['date_ini'])); ?>" tabindex="4"/></td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <input type="radio" value="0" name="txtyp" id="txtyp" <?php
            if ($d['tipo'] == 0) {
                echo "checked=\"true\"";
            }
            ?>tabindex="5"/>Porcent
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" value="1" name="txtyp" id="txtyp" <?php
                            if ($d['tipo'] == 1) {
                                echo "checked=\"true\"";
                            }
            ?> tabindex="6"/>Precio
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="vertical-align: bottom;" align="right">
                            <label class="btn btn-success" tabindex="7" alt="Guardar" title="guardar" onclick="changeofedo();">
                                <span class="fa fa-save">
                                    <B> Salvar</B>
                                </span>
                            </label>
                        </td>
                    </tr>
                </table>
            </form>
            <script>
                $(function () {
                    $("#d_ini").datepicker({dateFormat: 'dd-mm-yy'});
                });
                $(function () {
                    $("#f_end").datepicker({dateFormat: 'dd-mm-yy'});
                });
            </script>
            <?php
        }
        break;
    case 410:
        $nbre = filter_input(INPUT_POST, "newname_e");
        $capt = filter_input(INPUT_POST, "descextra_e");
        $va = filter_input(INPUT_POST, "valp_e");
        $unid = filter_input(INPUT_POST, "unit_e");
        $isactive = filter_input(INPUT_POST, "activ_e");
        $id = filter_input(INPUT_POST, "idsav");
        $actual = mysqli_query($CNN, "UPDATE cms_property_extra SET   name = '$nbre',caption='$capt',valor='$va', active = '$isactive',unidad ='$unid' WHERE id=$id ") or $err = "Error al guardar" . mysqli_error($CNN);
        if (isset($err)) {
            echo "ERROR AL MODIFICAR ESTE CAMPO<br>UPDATE cms_property_extra SET   name = '$nbre',caption='$capt',valor = '$va',active = '$isactive',unidad = '$unid' WHERE id =$id <br>" . $err;
        } else {
            echo"GUARDADO CON EXITO";
        }
        break;
    case 900:
        $valc = filter_input(INPUT_POST, "value");
        $tblname = filter_input(INPUT_POST, "tbl");
        $elcampo = filter_input(INPUT_POST, "ctabl");
        $nisauto = mysqli_query($CNN, "insert into cms_property_$tblname ($elcampo) values('$valc')");
        if (!$nisauto) {
            echo "Error al autoguardar. " . die(mysqli_error($CNN));
        } else {
            $lastid = mysqli_insert_id($CNN);
            echo $lastid;
        }
        break;
    case 901:
        $valc = filter_input(INPUT_POST, "value");
        $tblname = filter_input(INPUT_POST, "tbl");
        $elcampo = filter_input(INPUT_POST, "ctabl");
        $id = filter_input(INPUT_POST, "idcamp");
        $updateautog = mysqli_query($CNN, "update cms_property_$tblname set $elcampo='$valc' where id=$id");
        if (!$updateautog) {
            echo "Error al autoguardar. " . die(mysqli_error($CNN));
        } else {
            echo "1";
        }
        break;
}