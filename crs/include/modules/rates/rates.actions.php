<?php
include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
$semana = array(
    "Domingo",
    "Lunes",
    "Martes",
    "Miercoles",
    "Jueves",
    "Viernes",
    "S&aacute;bado");

switch ($op) {
    case 0:
        $tit = filter_input(INPUT_POST, "tit");
        $ingrat = mysqli_query($CNN, "insert into crs_rates (name,date_create)value('$tit',CURRENT_TIMESTAMP)") or $err = "error al ingresar el nombre de la Tarifa<br>" . mysqli_error($CNN);
        if (!isset($err)) {
            echo "1|" . mysqli_insert_id($CNN) . "|";
        } else {
            echo "0|" . $err;
        }
        break;
    case 1:
        $rid = filter_input(INPUT_POST, "idtar");
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

        $daqry = "INSERT INTO crs_rates_detail"
                . "(rid,date_ini, date_end, mini,des,diario,semanal,restringir,checkin,checkout)"
                . "VALUES ('$rid','$ini','$end','$min','$des','$pd','$ps','$restr','$in','$out')";
        $insdet = mysqli_query($CNN, $daqry) or $err = "Error al guardar el periodo<br>$daqry<br> " . mysqli_error($CNN);
        if (!isset($err)) {
            $lid = mysqli_insert_id($CNN);
            $ret = "1|";
            $ret = "1|";
            $ret.='<tr id="data_' . $lid . '"><td>' . $lid . '</td><td>' . date("d-m-Y", strtotime($ini)) . '</td><td>' . date("d-m-Y", strtotime($end)) . '</td><td>' . $min . '</td><td>' . $pd . '</td><td>' . $ps . '</td><td>' . $des . '</td>';
            if ($restr >= 1) {
                $ret.='<td>' . $semana[$in] . '</td>';
                $ret.='<td>' . $semana[$out] . '</td>';
            } else {
                $ret.='<td>N/A</td>';
                $ret.='<td>N/A</td>';
            }
            $ret.='<td><i class="btn btn-info fa fa-edit" alt="Editar periodo" title="Editar periodo"onclick="edit_tar(' . $lid . ')"></i><i class="btn btn-danger fa fa-eraser" onclick="removetar(' . $lid . ')" alt="Eliminar periodo" title="Eliminar periodo"></i></td>';
            $myqry = mysqli_query($CNN, "update crs_rates set date_update=CURRENT_TIMESTAMP WHERE id=$rid")or $err = "error al actualizar" . mysqli_error($CNN);
            if (!isset($err)) {
                echo $ret;
            } else {
                echo $err;
            }
        } else {
            echo $err;
        }

        break;
    case 10:
        $tit = filter_input(INPUT_POST, "tit");
        $grd = filter_input(INPUT_POST, "grd");
        $ingrat = mysqli_query($CNN, "update crs_rates set name='$tit' where id=$grd") or $err = "error al ingresar el nombre de la Tarifa<br>" . mysqli_error($CNN);
        if (!isset($err)) {
            echo "1|" . mysqli_insert_id($CNN) . "|";
        } else {
            echo "0|" . $err;
        }
        break;
    case 100:
        ?>
        <script>
            $(function () {
                $("#tar-ini").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }});
            });
            $(function () {
                $("#tar-end").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                });
            });</script>
        <div class="row">
            <div class="col-lg-12" id="ratetitle">
                <div class="inpupt-group">
                    <big><label class="label label-warning">Titulo</label></big>
                    <input type="text" id="t_title" name="t_title" class="form-control" placeholder="Nombre de la tarifa" onblur="autosavetitle();"data-toggle="tooltip" data-placement="bottom" title="Presione Esc para cancelar.">
                </div>
            </div>
        </div>
        <form id="newtar" method="post" disabled="true">
            <input type="text" name="idtar" id="idtar" class="hidden"><!---id de la tarifa--->
            <input type="text" name="op" id="op" value="1" class="hidden"><!--opcion para realizar cambios-->
            <input type="text" name="idperiodo" id="idperiodo" value="0" class="hidden"><!---periodo de la tarifa-->
            <div class="row">
                <div class="col-lg-12">
                    <h4><label class="label label-info title ">Periodos</label></h4>
                </div>
                <div class="col-lg-4 bg-">
                    <div class="form-group">
                        <div class="input-group label-warning">
                            <div class="input-group-addon "><i class="fa fa-calendar"></i> COMIENZA:</div>
                            <input type="text" class="form-control" id="tar-ini" name="tar-ini" onchange="checadate();">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="input-group label-warning">
                            <div class="input-group-addon "><i class="fa fa-calendar"></i> FINALIZA:</div>
                            <input type="text" class="form-control" id="tar-end" name="tar-end" onchange="checadatend()" required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div class="input-group label-warning">
                            <div class="input-group-addon "> Minimo:</div>
                            <select id="tar-estan" name="tar-estan" class="form-control">
                                <?php
                                for ($i = 1; $i <= 15; $i++) {
                                    ?><option value="<?php echo $i; ?>" <?php
                                    if ($i == 7) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $i; ?> Noche(s)</option><?php
                                        }
                                        ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="input-group label-warning">
                            <div class="input-group-addon ">Rebaja:</div>
                            <input type="text" class="form-control" id="tar-reb" name="tar-reb" data-toggle="tooltip" data-placement="top" title="Del precio semanal, solo si no se cumple el minimo de d&iacute;as.">
                            <div class="input-group-addon">%</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="input-group label-warning">
                            <div class="input-group-addon "><i class="fa fa-eur "></i> Costo Semanal:</div>
                            <input type="text" class="form-control" id="tar-price_s" name="tar-price_s"  onkeyup="priced(this.value)">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="input-group label-warning">
                            <div class="input-group-addon "><i class="fa fa-eur "></i> Costo Diario:</div>
                            <input type="text" class="form-control" id="tar-price" name="tar-price" readonly >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="input-group label-warning">
                            <div class="input-group-addon ">Restringir dia de E/S</div>
                            <select id="tar-ing" name="tar-ing" class="form-control" onchange="changeres(this.value);" data-toggle="tooltip" data-placement="top" title="Restringir el d&iacute;a de Entrada y Salida? ">
                                <option value="0">NO</option>
                                <option value="1">SI</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group label-warning">
                        <div class="input-group-addon ">Entrada:</div>
                        <select id="tar-checkin" name="tar-checkin" class="form-control" disabled>
                            <?php
                            for ($i = 0; $i < count($semana); $i++) {
                                ?><option value="<?php echo $i; ?>"><?php echo $semana[$i]; ?></option><?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group label-warning">
                        <div class="input-group-addon ">Salida:</div>
                        <select id="tar-checkout" name="tar-checkout" class="form-control" disabled>
                            <?php
                            for ($i = 0; $i < count($semana); $i++) {
                                ?><option value="<?php echo $i; ?>"<?php
                                if ($i == 6) {
                                    echo "selected";
                                }
                                ?>><?php echo $semana[$i]; ?></option><?php
                                    }
                                    ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="row">
            <div class="col-lg-12 text-right">
                <button type="button" class="btn btn-primary" onclick="saveperiodo();">Guardar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="c_periodos">
            </div>
        </div>
        <?php
        break;
    case 101:
        $id = filter_input(INPUT_POST, "id");
        $getbl = " select * from crs_rates_detail where rid=$id";
        $rows = mysqli_query($CNN, $getbl);
        $nr = mysqli_num_rows($rows);
        if ($nr >= 1) {
            ?>
            <table class="table table-condensed table-condensed table-striped" >
                <thead>
                    <tr>
                        <th>Per&iacute;odo</th>
                        <th>Estancia minima</th>
                        <th>Precio Diario</th>
                        <th>% Reduccion</th>
                        <th>D&iacute;a de Entrada</th>
                        <th>D&iacute;a de Salida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($r = mysqli_fetch_array($rows)) {
                        ?>
                        <tr id="data">
                            <td>Comienza el:<b> <?php echo date("d-m-Y", strtotime($r['date_ini'])); ?></b><br>finaliza: <b><?php echo date("d-m-Y", strtotime($r['date_end'])) ?></b></td>
                            <td><?php echo $r['mini']; ?></td>
                            <td><?php echo $r['diario']; ?></td>
                            <td><?php echo $r['des']; ?>%</td>
                            <?php
                            if ($r['checkin'] >= 0) {
                                ?><td><?php echo $semana[$r['checkin']]; ?></td> <?php
                            } else {
                                ?><td>N/A</td> <?php
                            }
                            ?>
                            <?php
                            if ($r['checkout'] >= 0) {
                                ?><td><?php echo $semana[$r['checkout']]; ?></td> <?php
                            } else {
                                ?><td>N/A</td> <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            ?>
        <div class="alert alert-info bold"><b><h4>SIN PERIODOS ASIGNADOS</h4></b></div>
            <?php
        }
        break;
    case 102:
        $rid = filter_input(INPUT_POST, "rid");
        $showt = "select * from crs_rates_detail where rid=$rid";
        $srow = mysqli_query($CNN, $showt);
        ?>
        <br>
        <table id="table_per" class="table table-condensed table-striped table-hover" style="background:#90a4ae;" id="t_rang">
            <thead>
                <tr class="text-capitalize table-bordered " style="text-transform: uppercase;">
                    <th>Id</th>
                    <th>Comienza</th>
                    <th>Finaliza</th>
                    <th>Estancia Minima</th>
                    <th>Precio Diario</th>
                    <th>Precio Semanal</th>
                    <th>% Reducci&oacute;n</th>
                    <th>D&iacute;a de entrada</th>
                    <th>D&iacute;a de salida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($r = mysqli_fetch_array($srow)) {
                    ?>
                    <tr id="data_<?php echo $r['id']; ?>">
                        <td><?php echo $r['id'] ?></td>
                        <td><?php echo date("d-m-Y", strtotime($r['date_ini'])); ?></td>
                        <td><?php echo date("d-m-Y", strtotime($r['date_end'])); ?></td>
                        <td><?php echo $r['mini']; ?> Noche(s)</td>
                        <td><?php echo $r['diario']; ?></td>
                        <td><?php echo $r['semanal']; ?></td>
                        <td><?php echo $r['des']; ?></td>
                        <?php
                        if ($r['checkin'] >= 0) {
                            ?><td><?php echo $semana[$r['checkin']]; ?></td> <?php
                        } else {
                            ?><td>N/A</td> <?php
                        }
                        ?>
                        <?php
                        if ($r['checkout'] >= 0) {
                            ?><td><?php echo $semana[$r['checkout']]; ?></td> <?php
                        } else {
                            ?><td>N/A</td> <?php
                        }
                        ?>
                        <td><i class="btn btn-info fa fa-edit" alt="Editar periodo" title="Editar periodo"onclick="edit_tar(<?php echo $r['id'] ?>)"></i><i class="btn btn-danger fa fa-eraser" onclick="removetar(<?php echo $r['id'] ?>)" alt="Eliminar periodo" title="Eliminar periodo"></i></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        break;
    case 103:
        $rid = filter_input(INPUT_POST, "rid");
        $gname = mysqli_query($CNN, "select * from crs_rates where id=$rid");
        while ($n = mysqli_fetch_array($gname)) {
            echo strtoupper($n['name']);
        }
        break;
    case 104:
        $id = filter_input(INPUT_POST, "rid");
        $my = mysqli_query($CNN, "select * from crs_rates where id=$id");
        while ($d = mysqli_fetch_array($my)) {
            ?>
            <div class="row" style="max-width: 100%; z-index: 1;">
                <div class="col-lg-12">
                    <?php echo $d['name']; ?>
                </div>
                <div class="col-lg-12">
                    Creado el: <b><?php echo date("d-m-Y", strtotime($d['date_create'])); ?></b> <br> a las: <b><?php echo date("H:i:s", strtotime($d['date_create'])); ?></b>
                </div>
                <div class="col-lg-12">
                    <?php
                    if ($d['date_update'] != null) {
                        ?>
                        Ultima modificacion: <b> <?php echo date("d-m-Y", strtotime($d['date_update'])); ?></b> <br> a las: <b><?php echo date("H:i:s", strtotime($d['date_update'])); ?></b>
                    <?php }
                    ?>
                </div>
            </div>
            <?php
        }
        break;
    case 110:
        $nam = filter_input(INPUT_POST, "nam");
        ?>
        <table class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th width='1'></th>
                    <th width="20%">Nombre</th>
                    <th width="79%">Opcion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getname = mysqli_query($CNN, "select * from crs_rates where name like'%$nam%' order by name asc");
                while ($tf = mysqli_fetch_array($getname)) {
                    ?><tr>
                        <td><?php
                            echo $tf['id'];
                            ?>
                        </td>
                        <td class="text-uppercase bold "><?php
                            echo $tf['name'];
                            ?>
                        </td>
                        <td align="rigth">
                            <button onclick="showDetail('<?php echo $tf['id']; ?>')" id="btn-<?php echo $tf['id']; ?>" type="button" class="btn btn-xs btn-primary"><i class="fa fa-chevron-down"></i></button>
                            <!--<button onclick='addperiodo();' class="btn btn-default  " alt='AGREGAR PERIODO A LA TARIFA' TITLE='AGREGAR PERIODO A LA TARIFA'><i class="fa fa-plus-circle"></i></button>-->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success">Acciones</button>
                                <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="javascript:void(0);" onclick="editaperiodos(<?php echo $tf['id']; ?>)"><i class="fa fa-edit"></i> Editar</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" onclick="addtartoprop(<?php echo $tf['id']; ?>);"><i class="fa fa-plus-square"></i> Asignar Alojamiento</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"onclick="duplicate(<?php echo $tf['id']; ?>);"><i class="fa fa-files-o "></i> Clonar</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"onclick="showdetail(<?php echo $tf['id']; ?>);"><i class="fa fa-info"></i> Detalles</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"onclick="delrangos(<?php echo $tf['id']; ?>);"><i class="fa fa-calendar-o warning "></i> Eliminar periodos</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);"onclick="del_tarifa(<?php echo $tf['id']; ?>);"><i class="fa fa-trash-o"></i> Eliminar Tarifa</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        break;
    case 111:
        $myid = filter_input(INPUT_POST, "id");
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title " id="exampleModalLabel">Eliminar periodos</h4>
        </div>
        <div class="modal-body">
            <?php
            $chkhou = "select count(pid) as hasig from crs_rates_use where rid=$myid";
            $ckh = mysqli_query($CNN, $chkhou)or $err = "Error #1:Error al checar las casas" . mysqli_error($CNN) . "<br>";
            $var_h = 0;
            while ($r = mysqli_fetch_array($ckh)) {
                $var_h = $r['hasig'];
            }
            if ($var_h >= 1) {
                ?>
                <div class="alert alert-warning" role="alert">
                    <h4>Error al eliminar los periodos de la tarifa:<br> Contiene <b><?php echo $var_h; ?></b> alojamientos asignados</h4>
                </div>
                <?php
            } else {
                $dp = "select count(id) as peri from crs_rates_detail where rid=$myid";
                $ckh = mysqli_query($CNN, $dp)or $err = "Error #2:Error al checar los periodos" . mysqli_error($CNN) . "<br>";
                $var_p = 0;
                while ($r = mysqli_fetch_array($ckh)) {
                    $var_p = $r['peri'];
                }
                if ($var_p >= 1) {
                    ?>
                    <div class="alert alert-danger " role="alert">
                        <big>
                            Se Eliminaran <b> <?php echo $var_p; ?></b> Periodos<br><big>Estos cambios <b>NO</b> seran reversibles</big><br>
                            ¿Desea Continuar?
                        </big>
                        <br>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="do_del_per(<?php echo $myid; ?>)">Aceptar</button>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-info " role="alert">
                        <big>
                            Esta tarifa no contiene ningun periodo asignado
                        </big>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
        break;
    case 112:
        $tid = filter_input(INPUT_POST, "rid");
        $delpe = "delete from crs_rates_detail where rid=$tid";
        $dp = mysqli_query($CNN, $delpe)or $err = "Error al eliminar los periodos de la tarifa" . mysqli_error($CNN);
        if (!isset($err)) {
            $myqry = mysqli_query($CNN, "update crs_rates set date_update=CURRENT_TIMESTAMP WHERE id=$tid")or $err = "error al actualizar" . mysqli_error($CNN);
            if (!isset($err)) {
                echo "1|1";
            } else {
                echo "0|" . $err;
            }
        } else {
            echo"0|" . $err;
        }
        break;
    case 113:
        $myid = filter_input(INPUT_POST, "id");
        $nmb = mysqli_query($CNN, "select name from crs_rates where id=$myid");
        $n = "NONAME";
        while ($N = mysqli_fetch_array($nmb)) {
            $n = $N['name'];
        }
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title " id="exampleModalLabel">Eliminar La Tarifa: <b><?php echo strtoupper($n) ?></b></h4>
        </div>
        <div class="modal-body">
            <?php
            $chkhou = "select count(pid) as hasig from crs_rates_use where rid=$myid";
            $ckh = mysqli_query($CNN, $chkhou)or $err = "Error #1:Error al checar las casas" . mysqli_error($CNN) . "<br>";
            $var_h = 0;
            while ($r = mysqli_fetch_array($ckh)) {
                $var_h = $r['hasig'];
            }
            if ($var_h >= 1) {
                ?>
                <div class="alert alert-warning" role="alert">
                    <h4>Error al borrar la tarifa:<br> Contiene <b><?php echo $var_h; ?></b> alojamientos asignados</h4>
                </div>
                <?php
            } else {
                $dp = "select count(id) as peri from crs_rates_detail where rid=$myid";
                $ckh = mysqli_query($CNN, $dp)or $err = "Error #2:Error al checar los periodos" . mysqli_error($CNN) . "<br>";
                $var_p = 0;
                while ($r = mysqli_fetch_array($ckh)) {
                    $var_p = $r['peri'];
                }
                if ($var_p >= 1) {
                    ?>
                    <div class="alert alert-danger " role="alert">
                        <big>
                            Al eliminar la Tarifa, Se Eliminaran <b> <?php echo $var_p; ?></b> Periodos<br><h3><big><b>Estos cambios NO seran reversibles</b></big></h3><br>
                            ¿Desea Continuar?
                        </big>
                        <br>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="do_del_tarifa(<?php echo $myid; ?>, 0)">Aceptar</button>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger " role="alert">
                        <big>
                            <b>ESTA ACCION<h3> NO SERA REVERSIBLE</h3></b><br>
                            ¿Desea eliminar la tarifa: <b><?php echo strtoupper($n) ?></b>?
                        </big>
                        <br>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="do_del_tarifa(<?php echo $myid; ?>, 1)">Aceptar</button>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
        break;
    case 114:
        $tid = filter_input(INPUT_POST, "id");
        $extra = filter_input(INPUT_POST, "ext");
        $ok=1;
        if ($extra == 0) {
            $delpe = "delete from crs_rates_detail where rid=$tid";
            $dp = mysqli_query($CNN, $delpe)or $err = "Error al eliminar los periodos de la tarifa" . mysqli_error($CNN);
            if (!isset($err)) {
                $ok = 1;
            } else {
                
                $ok=0;
            }
        }
        if($ok==1)
        {
            $rempe = "delete from crs_rates where id=$tid";
            $rp=  mysqli_query($CNN, $rempe)or $err.="<br><br><b>Error al eliminar la tarifa</b>".mysqli_error($CNN);
           if(!isset($err))
           {
               echo "1|1";
           }
           else
           {
                echo"0|" . $err;
           }
        }
        else
        {
            echo"0|" . $err;
        }
        break;
}
