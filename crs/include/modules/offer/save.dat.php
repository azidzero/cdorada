<?php
include("../../../inc/app.conf.php");
$p = filter_input(INPUT_POST, "op");
switch ($p) {
    //guardar la oferta y/o editarla
    case 0:
        $nameof = filter_input(INPUT_POST, "titleo");
        $fs = date("Y-m-d", strtotime(filter_input(INPUT_POST, "datepicker")));
        $fe = date("Y-m-d", strtotime(filter_input(INPUT_POST, "datepicker2")));
        $prize = filter_input(INPUT_POST, "cantidad");
        $editar = filter_input(INPUT_POST, "isedit");
        $tipo = filter_input(INPUT_POST, "options");
        $shi = date("Y-m-d", strtotime(filter_input(INPUT_POST, "shini")));
        $she = date("Y-m-d", strtotime(filter_input(INPUT_POST, "shend")));
        if ($editar == null) {
            if ($nameof != null) {
                if ($fs == null || $fe == null || $prize == null || $prize == 0) {
                    echo "2";
                } else {
                    $indea = mysqli_query($CNN, "INSERT INTO crs_offer (name,cant,date_ini,date_end,tipo,date_create,show_ini,show_end)VALUES ('$nameof','$prize','$fs','$fe','$tipo',current_timestamp,'$shi','$she')")or $err = "Error:" . mysqli_error($CNN);
                    if (!isset($err)) {
                        echo "1";
                    } else {
                        echo $err;
                    }
                }
            } else {
                echo "0";
            }
        } else {
            $indea = mysqli_query($CNN, "update crs_offer set name='$nameof',date_update=CURRENT_TIMESTAMP,cant='$prize',date_ini='$fs',date_end='$fe',show_ini='$shi',show_end='$she', tipo='$tipo' where id=$editar")or $err = "Error:" . mysqli_error($CNN);
            if (!isset($err2)) {
                echo "1";
            } else {
                echo $err;
            }
        }
        break;
    //muestra las tablas
    case 1:
        $id = filter_input(INPUT_POST, "id"); //id de la oferta
        $txt = filter_input(INPUT_POST, "text");
        $al = "SELECT * FROM cms_property where title like'%$txt%'";
        $SQL = mysqli_query($CNN, $al);
        $qry = "select * from crs_offer_use where idof=$id";
        $MYS = mysqli_query($CNN, $qry);
        $arr = array();
        $co = 0;
        while ($li = mysqli_fetch_array($MYS)) {
            $arr[$co] = $li['pid'];
            $co++;
        }
        ?>
        <div class="row" style="max-width: 100%;">
            <div class="col-lg-6">
                <table class="table table-condensed table-striped table-hover">
                    <thead class="title">
                        <tr>
                            <td>Asignada</td>
                            <td>Alojamiento</td>
                            <td>Portada</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($r = mysqli_fetch_array($SQL)) {
                            ?>
                            <tr id="<?php echo $r['id']; ?>" onclick="preview('<?php echo $r['id']; ?>', '<?php echo $id; ?>');" >
                                <td>
                                    <input type="checkbox" id="prop_<?php echo $r['id']; ?>" onclick="asigoffer('<?php echo $r['id']; ?>', '<?php echo $id; ?>');
                                                        preview('<?php echo $r['id']; ?>', '<?php echo $id; ?>')" <?php
                                           if (in_array($r['id'], $arr, true)) {
                                               echo "checked";
                                           }
                                           ?>>
                                </td>
                                <td>
                                    <?php echo strtoupper($r['title']); ?>
                                </td>
                                <td>
                                    <input type="checkbox" id='asi_<?php echo $r['id']; ?>' name="portasig[]" onclick="inpor('<?php echo $r['id']; ?>', '<?php echo $id; ?>')" <?php if (in_array($r['id'], $arr, true)) {
                            
                        } else {
                            echo "disabled";
                        } ?>>
                                </td>
                            </tr>
            <?php
        }
        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6" id="previewrate">
            </div>
        </div>
        <?php
        break;
    //Guardar la oferta en la propiedad
    case 2:
        $idof = filter_input(INPUT_POST, "idof");
        $prop = filter_input(INPUT_POST, "prop");
        $act = filter_input(INPUT_POST, "act");
        $getof = mysqli_query($CNN, "select * from crs_offer where id=$idof");
        while ($i = mysqli_fetch_array($getof)) {
            $tr = "SELECT crs_offer_use.pid, crs_offer.* FROM  crs_offer_use, crs_offer "
                    . "WHERE  crs_offer_use.pid='$prop' AND crs_offer.id=crs_offer_use.`idof` AND '" . $i['date_ini'] . "'< date_ini AND '" . $i['date_end'] . "'>date_ini"
                    . " OR crs_offer_use.pid='$prop' AND crs_offer.id=crs_offer_use.`idof` AND '" . $i['date_ini'] . "'>=date_ini AND '" . $i['date_end'] . "'<=date_end "
                    . "OR crs_offer_use.pid='$prop' AND crs_offer.id=crs_offer_use.`idof` AND '" . $i['date_ini'] . "'<=date_end AND '" . $i['date_end'] . "'>=date_end";
        }
        $hayof = mysqli_query($CNN, $tr)or $err = mysqli_error($CNN);
        $not = mysqli_num_rows($hayof);
        if ($not <= 0||$act==0) {
            if ($act == '1') {
                $qry = "insert into crs_offer_use (pid,idof) values('$prop','$idof')";
            }
            if ($act == '0') {
                $qry = "delete from crs_offer_use where pid='$prop' and idof='$idof'";
            }
            $exqry = mysqli_query($CNN, $qry)or $error = "error al realizar la accion:" . mysqli_error($CNN) . "--->" . $qry;
            if (!isset($error)) {
                if ($act == '1') {
                    echo "1";
                }
                if ($act == '0') {
                    echo "2";
                }
            } else {
                echo $error;
            }
        } else {
            echo "3";
        }
        break;
    //Borrar la oferta
    case 3:
        $idoff = filter_input(INPUT_POST, "el_id");
        $borrof = mysqli_query($CNN, "delete from crs_offer where id=$idoff") or $errooff = "error al borrar" . mysqli_error($CNN);
        if (!isset($errooff)) {
            echo "1";
        } else {
            echo $errooff;
        }
        break;
    //Preview de las ofertas
    case 4:
        $rid = filter_input(INPUT_POST, "rid");
        $pid = filter_input(INPUT_POST, "pid");
        $selda = "select * from crs_offer where id=$rid";
        $getof = mysqli_query($CNN, $selda);
        $desc = 0;
        $tip = "";
        while ($of = mysqli_fetch_array($getof)) {
            $desc = $of['cant'];
            $tip = $of['tipo'];
            $qry = "SELECT	c.* FROM crs_rates_use b INNER JOIN  crs_rates a ON (b.`rid`=a.`id`AND b.pid=$pid) INNER JOIN crs_rates_detail c ON (a.id=c.rid) "
                    . "WHERE b.pid='$pid' AND c.date_end<'" . $of['date_end'] . "' AND"
                    . " c.date_ini>'" . $of['date_ini'] . "' OR '" . $of['date_ini'] . "' BETWEEN c.date_ini  AND c.date_end OR '" . $of['date_end'] . "' BETWEEN c.date_ini  "
                    . "AND c.date_end GROUP BY c.`id`";
        }
        //echo "<b>".$qry."</b>";
        $dota = mysqli_query($CNN, $qry)or $err = "No se puede crear la vista previa de la tabla" . mysqli_error($CNN);
        $noro = mysqli_num_rows($dota);
        if (!isset($err)) {
            if ($noro >= 1) {
                ?>
                <table class="table table-responsive table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Dese:</th>
                            <th>Hasta:</th>
                            <th>Antes:</th>
                            <th>Descuento:</th>
                            <th>Aplicado:</th>
                        </tr>
                    </thead>
                    <tbody class="bg-success ">
                                <?php
                                while ($t = mysqli_fetch_array($dota)) {
                                    ?>
                            <tr>
                                <td>
                    <?php echo $t['date_ini']; ?>
                                </td>
                                <td>
                    <?php echo $t['date_end']; ?>
                                </td>
                                <td>
                                    <?php echo $t['semanal']; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($tip == 0) {
                                        echo $desc . "%";
                                    } else {
                                        echo number_format($desc, 2);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($tip == 0) {
                                        $tdesc = $t['semanal'] - ($t['semanal'] * ($desc / 100));
                                    } else {
                                        $tdesc = $t['semanal'] - $desc;
                                    }
                                    echo number_format($tdesc, 2);
                                    ?>
                                </td>
                            </tr>
                    <?php
                }
                ?>
                    </tbody>
                </table>
                <?php
            } else {
                ?>
                <div class="alert alert-danger ">
                    no hay tarifas para esta propiedad en el periodo de la oferta
                </div>
                    <?php
                }
            } else {
                ?>
            <div class="alert alert-danger ">
            <?php echo $err; ?>
            </div>
            <?php
        }
        break;
    //Tabla con resultados
    case 5:
        $text = filter_input(INPUT_POST, "text");
        $getof = "SELECT a.* FROM crs_offer a WHERE a.name LIKE'%$text%'";
        $go = mysqli_query($CNN, $getof) or $e = "error al consultar las ofertas" . mysqli_error($CNN);
        $noff = mysqli_num_rows($go);
        if (!isset($e)) {
            if ($noff >= 1) {
                ?>
                <table class="table table-striped table-hover bg-primary" style="color:#000;" >
                    <thead>
                        <tr class="text-uppercase" style="background-color: #003399; color:#fff; ">
                            <th>Id</th>
                            <th>Oferta</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Desc/Prize</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                while ($io = mysqli_fetch_array($go)) {
                    ?>
                            <tr>
                                <td><?php echo $io['id']; ?></td>
                                <td class="text-uppercase "><b><?php echo $io['name']; ?></b></td>
                                <td><?php
                                    echo date("d-m-Y", strtotime($io['date_ini']));
                                    ;
                                    ?></td>
                                <td><?php
                                    echo date("d-m-Y", strtotime($io['date_end']));
                                    ;
                                    ?></td>
                                <td><?php
                                    echo $io['cant'];
                                    if ($io['tipo'] == 0) {
                                        echo "%";
                                    } else {
                                        echo "€";
                                    }
                                    ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Opcion <span class="caret"></span></button >
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li><a href="JavaScript:void(0)" onclick="editaoffer('<?php echo $io['id']; ?>')"><i class="fa fa-edit"></i>Editar</a></li>
                                            <li><a href="JavaScript:void(0)" onclick="askdeloffer('<?php echo $io['id']; ?>')"><i class="fa fa-trash"></i> Eliminar</a></li>
                                            <li><a href="JavaScript:void(0)" onclick="addoffprop('<?php echo $io['id']; ?>')"><i class="fa fa-plus"></i> Asignar prop</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                    <?php
                }
                ?>
                    </tbody>
                </table>
                <?php
            } else {
                ?>
                <div class="alert alert-info ">
                    No se encontraron resultados
                </div>
                    <?php
                }
            } else {
                ?>
            <div class="alert alert-warning ">
            <?php echo $e; ?>
            </div>
            <?php
        }
        break;
    case 6:
        $idof = filter_input(INPUT_POST, "rid");
        $prop = filter_input(INPUT_POST, "pid");
        $act = filter_input(INPUT_POST, "chk");
        $qry = "update crs_offer_use  set featured='$act' where pid='$prop' and idof='$idof'";
        $exqry = mysqli_query($CNN, $qry)or $error = "error al realizar la accion:" . mysqli_error($CNN) . "--->" . $qry;
        if (!isset($error)) {
            if ($act == '1') {
                echo "1";
            }
            if ($act == '0') {
                echo "2";
            }
        } else {
            echo $error;
        }
        break;
}
