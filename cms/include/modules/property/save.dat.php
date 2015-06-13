<?php
include("../../../inc/app.conf.php");
$p = filter_input(INPUT_POST, "op");
switch ($p) {
    case 0:
        $name = filter_input(INPUT_POST, "newname");
        $tdato = filter_input(INPUT_POST, "tdato");
        $acvo = filter_input(INPUT_POST, "activ");
        $reqre = filter_input(INPUT_POST, "raq");
        $unit = filter_input(INPUT_POST, "unit");
        $valp = filter_input(INPUT_POST, "valp");
        $isguard = filter_input(INPUT_POST, "idsav");
        if ($isguard == 0) {
            $ins_gral = mysqli_query($CNN, "insert into cms_property_general (name,tipo,valor,active,required,unidad)values('$name','$tdato','$valp','$acvo','$reqre','$unit')");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                  OPERACION EXITOSA
                <?php
            }
        }
        else
        {
             $ins_gral = mysqli_query($CNN, "update cms_property_general set name='$name',tipo='$tdato',valor='$valp',active='$acvo',required='$reqre',unidad='$unit' where id=$isguard");
            if (!$ins_gral) {
                Echo"Error al insertar los datos" . mysqli_error($CNN);
            } else {
                ?>
                  OPERACION EXITOSA
                <?php
            }
        }
        break;
    case 1://GUARDAR LOS CAMBIOS PROPERTY_GENERAL
        $nbre = filter_input(INPUT_POST, "e_name");
        $datatype = filter_input(INPUT_POST, "e_tdato");
        $isactive = filter_input(INPUT_POST, "e_activ");
        $reque = filter_input(INPUT_POST, "e_raq");
        $unid = filter_input(INPUT_POST, "e_unit");
        $va = filter_input(INPUT_POST, "e_valp");
        $id = filter_input(INPUT_POST, "e_id");
        $actual = mysqli_query($CNN, "UPDATE cms_property_general SET   name = '$nbre',tipo = '$datatype',valor = '$va',active = '$isactive',required = '$reque',unidad = '$unid' WHERE id =$id");
        if (!$actual) {
            echo "ERROR AL MODIFICAR ESTE CAMPO";
        } else {
            echo"GUARDADO CON EXITO";
        }
        break;
    case 2://ELIMINA ITEM PROPERTY_GENERAL
        $id = filter_input(INPUT_POST, "elim_id");
        $isp = mysqli_query($CNN, "select faul from cms_property_general where id=$id");
        while ($n = mysqli_fetch_array($isp)) {
            $ispred = $n['faul'];
        }
        if ($ispred == 1) {
            ?>
            <label class="label-warning"><h2>No es posible eliminar un item predeterminado por el sistema</h2></label>
            <?php
        } else {
            $del = mysqli_query($CNN, "DELETE from cms_property_general where id=$id");
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
    case 10:
        $name = filter_input(INPUT_POST, "newname");
        $tdato = filter_input(INPUT_POST, "tdato");
        $acvo = filter_input(INPUT_POST, "activ");
        $reqre = filter_input(INPUT_POST, "raq");
        $unit = filter_input(INPUT_POST, "unit");
        $valp = filter_input(INPUT_POST, "valp");
        $ins_gral = mysqli_query($CNN, "insert into cms_property_interior (name,tipo,valor,active,required,unidad)values('$name','$tdato','$valp','$acvo','$reqre','$unit')");
        if (!$ins_gral) {
            Echo"<h4>Error al insertar los datos</h4>" . mysqli_error($CNN);
        } else {
            ?>OPERACION EXITOSA
            <?php
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
    case 12:
        $id = filter_input(INPUT_POST, "elim_id");
        $isp = mysqli_query($CNN, "select faul from cms_property_interior where id=$id");
        while ($n = mysqli_fetch_array($isp)) {
            $ispred = $n['faul'];
        }
        if ($ispred == 1) {
            ?>
            <label>No es posible eliminar un item predeterminado por el sistema</label>
            <?php
        } else {
            $del = mysqli_query($CNN, "DELETE from cms_property_interior where id=$id");
            if (!$del) {
                ?>
                <label >ERROR AL ELIMINAR LOS DATOS</label>
                <?php
            } else {
                ?>
                <label >Eliminado correctamente</label>
                <?php
            }
        }
        break;
    case 20:
        $name = filter_input(INPUT_POST, "newname");
        $tdato = filter_input(INPUT_POST, "tdato");
        $acvo = filter_input(INPUT_POST, "activ");
        $reqre = filter_input(INPUT_POST, "raq");
        $unit = filter_input(INPUT_POST, "unit");
        $valp = filter_input(INPUT_POST, "valp");
        $ins_gral = mysqli_query($CNN, "insert into cms_property_exterior (name,tipo,valor,active,required,unidad)values('$name','$tdato','$valp','$acvo','$reqre','$unit')");
        if (!$ins_gral) {
            Echo"<h4>Error al insertar los datos</h4>" . mysqli_error($CNN);
        } else {
            ?>OPERACION EXITOSA
            <?php
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
        $ins_gral = mysqli_query($CNN, "insert into cms_property_equip (name,tipo,valor,active,required,unidad)values('$name','$tdato','$valp','$acvo','$reqre','$unit')");
        if (!$ins_gral) {
            Echo"<h4>Error al insertar los datos</h4>" . mysqli_error($CNN);
        } else {
            ?>OPERACION EXITOSA
            <?php
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
        $ins_gral = mysqli_query($CNN, "insert into cms_property_extra (name,tipo,valor,active,required,unidad)values('$name','$tdato','$valp','$acvo','$reqre','$unit')");
        if (!$ins_gral) {
            Echo"<h4>Error al insertar los datos</h4>" . mysqli_error($CNN);
        } else {
            ?>OPERACION EXITOSA
            <?php
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
        break;
    case 50:
        $destino = filter_input(INPUT_POST, "des_name");
        $ins_gral = mysqli_query($CNN, "insert into cms_property_locale (name)values('$destino')");
        if (!$ins_gral) {
            Echo"<h4>Error al insertar el destino</h4>" . mysqli_error($CNN);
        } else {
            ?>OPERACION EXITOSA
            <?php
        }
        break;
    case 51:
        $nbre = filter_input(INPUT_POST, "e_des_name");
        $id = filter_input(INPUT_POST, "desid");
        $actual = mysqli_query($CNN, "UPDATE cms_property_locale SET name = '$nbre' WHERE id =$id");
        if (!$actual) {
            echo "ERROR AL MODIFICAR ESTE CAMPO";
        } else {
            echo"GUARDADO CON EXITO";
        }
        break;
    case 52:
        $id = filter_input(INPUT_POST, "e_desid");
        $del = mysqli_query($CNN, "DELETE from cms_property_locale where id=$id");
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
    case 60:
        $destino = filter_input(INPUT_POST, "des_name");
        $ins_gral = mysqli_query($CNN, "insert into cms_type (name)values('$destino')");
        if (!$ins_gral) {
            Echo"<h4>Error al insertar el destino</h4>" . mysqli_error($CNN);
        } else {
            ?>OPERACION EXITOSA
            <?php
        }
        break;
    case 61:
        $nbre = filter_input(INPUT_POST, "e_des_name");
        $id = filter_input(INPUT_POST, "desid");
        $actual = mysqli_query($CNN, "UPDATE cms_type SET name = '$nbre' WHERE id =$id");
        if (!$actual) {
            echo "<h3>ERROR AL MODIFICAR ESTE CAMPO</h3>";
        } else {
            echo"<h3>GUARDADO CON EXITO</h3>";
        }
        break;
    case 62:
        $id = filter_input(INPUT_POST, "e_desid");
        $del = mysqli_query($CNN, "DELETE from cms_type where id=$id");
        if (!$del) {
            ?>
            <label >ERROR AL ELIMINAR LOS DATOS</label>
            <?php
        } else {
            ?>
            <label>Eliminado correctamente</label>
            <?php
        }
        break;
    case 70:
        $id = filter_input(INPUT_POST, "house_id");
        $col=array("general","interior","exterior","extra","equip");
        $del = mysqli_query($CNN, "DELETE from cms_property where id=$id");
        if (!$del) {
            ?>
                <label ><h2>ERROR AL ELIMINAR LOS DATOS</h2></label>
                <?php
        } else {
            $errodel=0;
            $txterr="";
            foreach($col as $c)
            {
                $del_pro = mysqli_query($CNN, "DELETE from cms_property_e_$c where pid=$id");
                if (!$del_pro) {
                    $errordel++;
                    $txterr.=mysqli_error($CNN);
                }
            }
            if($errodel==0)
                {
                    ?>Eliminado Correctamente<?php
                }
                else
                {
                     ?>Eliminado con errores<br/><?php echo $txterr;
                     
                }
        }
        break;
    case 80:
        $id = filter_input(INPUT_POST, "elim_id");
        $prop = filter_input(INPUT_POST, "prop_id");
        $q = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE id=$id and pid=$prop") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            unlink("../../../content/upload/property/".$r['name']."_m.jpg");
            unlink("../../../content/upload/property/".$r['name']."_b.jpg");
        }
        $del = mysqli_query($CNN, "DELETE from cms_property_gallery where pid=$prop and id=$id " )OR DIE(mysqli_error($CNN));
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
    case 900:
        $valc = filter_input(INPUT_POST, "value");
        $tblname = filter_input(INPUT_POST, "tbl");
        $elcampo= filter_input(INPUT_POST, "ctabl");
        $nisauto=mysqli_query($CNN, "insert into cms_property_$tblname ($elcampo) values('$valc')");
        if(!$nisauto)
        {
            echo "Error al autoguardar. ".die(mysqli_error($CNN));
        }
        else
        {
            $lastid = mysqli_insert_id($CNN);
            echo $lastid;
        }
        break;
        case 901:
            $valc = filter_input(INPUT_POST, "value");
            $tblname = filter_input(INPUT_POST, "tbl");
            $elcampo= filter_input(INPUT_POST, "ctabl");
            $id= filter_input(INPUT_POST, "idcamp");
            $updateautog=mysqli_query($CNN, "update cms_property_$tblname set $elcampo='$valc' where id=$id");
            if(!$updateautog)
                {
                echo "Error al autoguardar. ".die(mysqli_error($CNN));
                }
                else
                    {
                    echo "1";
                    }
        break;
        
}