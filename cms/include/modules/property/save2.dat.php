<?php
include("../../../inc/app.conf.php");
$mes = array("", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
$p = filter_input(INPUT_POST, "op");
switch ($p) {
    case 1:
        $id = filter_input(INPUT_POST, "ido");
        $nam = filter_input(INPUT_POST, "txtname");
        $mount = filter_input(INPUT_POST, "txtmount");
        $dini = date("Y-m-d", strtotime(filter_input(INPUT_POST, "d_ini")));
        $dend = date("Y-m-d", strtotime(filter_input(INPUT_POST, "f_end")));
        $to = filter_input(INPUT_POST, "txtyp");
        $upd = mysqli_query($CNN, "update cms_property_deal set name='$nam',cant='$mount',date_ini='$dini',date_end='$dend',tipo='$to' where id=$id")or $err = "error al actualizar sus datos" . mysqli_error($CNN);
        if (!isset($err)) {
            echo "1";
        } else {
            echo $err;
        }
        break;
    case 2:
        $id = filter_input(INPUT_POST, "id");
        ?>
        <script>
            $(function () {
                $("#f1").datepicker({dateFormat: 'dd-mm-yy'});
                $('#f1').css('z-index', 99999999999999);
            });
            $(function () {
                $("#f2").datepicker({dateFormat: 'dd-mm-yy'});
                $('#f2').css('z-index', 99999999999999);
            });
        </script>
        <div id="c_tarifa" style="display: none;"
             <div  class="row">
                <div class="col-lg-12">
                    <form id="clontarifa" name="clontarifa" action="" method="post">
                        <input type="text" name="op" id="op"value="3" class="hidden"/><!--opcion para clonar tarifa-->
                        <input type="text" name="idprop" id="idprop" value="<?php echo $id; ?>" class="hidden"/><!--propiedad  para las opciones de tarifa-->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Titulo</div>
                                        <input type="text" id="namet" name="namet"  class="form-control" tabindex="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Precio Diario</div>
                                        <input type="text" id="costd" name="costd" class="form-control" tabindex="2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Precio Semanal</div>
                                        <input type="text" id="costs" name="costs" class="form-control" tabindex="3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Minimo: </div>
                                        <input type="number" id="mind" name="mind" value="7"size="3" min="0" class="form-control" tabindex="4">
                                        <div class="input-group-addon">D&iacute;as</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">Rebaja Diaria</div>
                                        <input type="text" id="rebajad" name="rebajad" class="form-control"tabindex="5">
                                        <div class="input-group-addon">%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="fa fa-calendar-o"></span> Desde: </div>
                                        <input type="text" id="f1" name="f1" tabindex="6" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="fa fa-calendar-o"></span> Hasta:</div>
                                        <input type="text" id="f2" name="f2" tabindex="7" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div clas="row">
                        <div class="col-lg-12 text-right">
                            <a href="javascript:void(0);" class="btn btn-success" tabindex="8" onclick="saveclontarifa();" ><span class="fa fa-floppy-o"></span> Guardar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="panel panel-default">
                        <div class="panel-heading"><big>Listado de Tarifas</big></div>
                        <div class="panel-body">
                            <div id="taofer" name="taofer">
                                <?php
                                $getarrp = mysqli_query($CNN, "SELECT * FROM crs_rates_detail WHERE pid=$id");
                                $proarr = array();
                                $pos = 0;
                                while ($p = mysqli_fetch_array($getarrp)) {
                                    $proarr[$pos] = $p['rid'];
                                    $pos++;
                                }
                                $exeqry = mysqli_query($CNN, "select * from crs_rates");
                                ?>
                                <table id="tar_asign" name="tar_asign" class="table table-striped" width="100%" border="0">
                                    <tr>
                                        <th></th>
                                        <th>Titulo</th>
                                        <th>Del- al</th>
                                        <th>Minimo</th>
                                        <th>Diario</th>
                                        <th>Semanal</th>
                                        <th>Desc.</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    while ($x = mysqli_fetch_array($exeqry)) {
                                        ?>
                                        <tr>
                                            <td width="1">
                                                <input type="checkbox" value="<?php echo $x['id']; ?>" id="check_<?php echo $x['id']; ?>" name="check_<?php echo $x['id']; ?>" <?php
                                                if (in_array($x['id'], $proarr)) {
                                                    echo "checked";
                                                }
                                                ?> onclick="save_tarifa(<?php echo $id . ',' . $x['id']; ?>);" >
                                            </td>
                                            <td width="20%">
                                                <?php echo $x['title']; ?>
                                            </td>
                                            <td width="20%" align="center">
                                                <?php echo date("d-m-Y", strtotime($x['date_ini'])) . "<br> al <br> " . date("d-m-Y", strtotime($x['date_end'])); ?>
                                            </td>
                                            <td>
                                                <?php echo $x['minimo'] . " d&iacute;as"; ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($x['diario'], 2); ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($x['semanal'], 2); ?>
                                            </td>
                                            <td>
                                                <?php echo $x['descu'] . " %"; ?>
                                            </td>
                                            <td width="2">
                                                <a href="JavaScript:void(0);" alt="Clonar" title="Clonar" onclick="duplicatarifa(<?php echo $x['id']; ?>)"><span class="fa fa-copy"></span></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            break;
        case 3:
            $qry = "Insert into crs_rates (title,date_ini,date_end,minimo,descu,diario,semanal) "
                    . "values('" . filter_input(INPUT_POST, 'namet') . "','" . date("Y-m-d", strtotime(filter_input(INPUT_POST, 'f1'))) . "','" . date("Y-m-d", strtotime(filter_input(INPUT_POST, 'f2'))) . "','"
                    . "" . filter_input(INPUT_POST, 'mind') . "','" . filter_input(INPUT_POST, 'rebajad') . "','"
                    . "" . filter_input(INPUT_POST, 'costd') . "','" . filter_input(INPUT_POST, 'costs') . "')";
            $ins = mysqli_query($CNN, $qry)or $err = "Error en el query: <b>" . $qry . "<b><br>" . mysqli_error($CNN);
            if (!isset($err)) {
                echo "1|" . mysqli_insert_id($CNN);
            } else {
                echo "0|" . $err;
            }
            break;
        case 4:
            $pid = filter_input(INPUT_POST, "pid");
            $taid = filter_input(INPUT_POST, "taid");
            $addrate = mysqli_query($CNN, "insert into crs_rates_detail(rid,pid,asigned)values('$taid','$pid',CURRENT_TIMESTAMP)")or $errins = "Error al insertar los dato" . mysqli_error($CNN);
            if (!isset($errins)) {
                $gettarifa = mysqli_query($CNN, " select * from crs_rates where id=$taid") or $err = mysqli_errno($CNN);
                while ($t = mysqli_fetch_array($gettarifa)) {
                    ?>
                    <tr id="tarid_<?php echo $t['id']; ?>">
                        <td><span class="fa fa-shield"></span></td>
                        <td class="text-capitalize "><?php echo $t['title']; ?>d&iacute;as</td>
                        <td><?php echo $t['minimo']; ?>d&iacute;as</td>
                        <td><?php echo $t['diario']; ?></td>
                        <td><?php echo $t['semanal']; ?></td>
                        <td><?php echo date("d", strtotime($t['date_ini'])) . "-" . $mes[number_format(date("m", strtotime($t['date_ini'])))] . "-" . date("Y", strtotime($t['date_ini'])); ?></td>
                        <td><?php echo date("d", strtotime($t['date_end'])) . "-" . $mes[number_format(date("m", strtotime($t['date_end'])))] . "-" . date("Y", strtotime($t['date_end'])); ?></td>
                        <td>
                            <div class="input-group">
                                <a href="javascript:void(0);" class="btn btn-danger" onclick="eliminatar(<?php echo $pid . "," . $t['id'] ?>)" alt="Quitar tarifa" title="Quitar tarifa"><span class="fa fa-trash-o"></span></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                
            }
            break;
        case 5:
            $pid = filter_input(INPUT_POST, "pid");
            $rid = filter_input(INPUT_POST, "rid");
            $del = mysqli_query($CNN, "delete from crs_rates_detail where rid=$rid and pid=$pid") or $err = "Error al borrar la asignacion" . mysqli_error($CNN);
            if (!isset($err)) {
                echo "1";
            } else {
                echo $err;
            }
            break;

        case 6:
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Clonar propiedad</h4>
            </div>
            <div class="modal-body">
                <p>Ingrese el nombre con el que desea clonar el alojamiento:</p>
                <input type="text" class="form-control " id="namealoja" placeholder="Nombre del alojamiento clonado">
                <input type="text" class="hidden " id="id_clon" value="" placeholder="Nombre del alojamiento clonado">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="do_clon();">CLONAR</button>
            </div>
            <?php
            break;
        case 7:
            $id = filter_input(INPUT_POST, "idc");
            $nm = filter_input(INPUT_POST, "nam");
            $clogr = "insert into cms_property(prize,room,capacity,tipo,modo,location,short_desc,long_desc,deal,bathroom,servicios,metadatos,seo,address,ref,status,lat,longi,ord)"
                    . "select a.prize,a.room,a.capacity,a.tipo,a.modo,a.location,a.short_desc,a.long_desc,a.deal,a.bathroom,a.servicios,a.metadatos,a.seo,a.address,a.ref,a.status,a.lat,a.longi,a.ord from cms_property a where a.id=$id";
            $ins = mysqli_query($CNN, $clogr) or $e = "Error al clonar la propiedad<br>$clogr<br>" . mysqli_error($CNN);
            if (!isset($e)) {
                $nwpid = mysqli_insert_id($CNN);
                $updtit = "update cms_property set title='$nm' where id=$nwpid";
                $innow = mysqli_query($CNN, $updtit)or $e = "Error al clonar la propiedad<br>$updtit<br>" . mysqli_error($CNN);
                if (!isset($e)) {
                    $ado="insert into cms_property_addons(pid,cid,aid,ovalue)values";
                    $rows=  mysqli_query($CNN, " select cid,aid,ovalue from cms_property_addons where pid=$id");
                    while($r=  mysqli_fetch_array($rows) )
                    {
                        $ado.="('$nwpid','{$r['cid']}','{$r['aid']}','{$r['ovalue']}'),";
                    }
                    $ado=  substr($ado, 0,-1);
                    $insend=  mysqli_query($CNN, $ado)or $e = "Error al clonar la propiedad<br>$ado<br>" . mysqli_error($CNN);
                    if(!isset($e))
                    {
                        echo "1|".$nwpid;
                    }
                    else
                    {
                       echo "0|".$e;
                    }
                }
                else
                {
                   echo "0|".$e;
                }
            } else {
               echo "0|".$e;
            }
            break;
    }