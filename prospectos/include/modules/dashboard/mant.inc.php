<?php
include_once("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
$mes = array("", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
switch ($op) {
    case 0:
        ?>
        <!--- FILTRO DE BUSQUEDA
        lINEA 1---->
        <div class="row">
            <div class="col-lg-5">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon"><span class="fa fa-exclamation-circle"></span> Busqueda:</span>            
                    <select id="typesearch" class="form-control" onchange="changeselect();
                                    search_h();">
                        <option value="0">Propiedad</option>
                        <option value="1" selected>Incidencia</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="input-group input-group-lg">                     
                    <input type="text" class="form-control" id="findh" name="findh"onkeyup="search_h();" placeholder="Ingrese el nombre de la propiedad o titulo de la incidencia" />
                    <div class="input-group-btn">
                        <button class="btn btn-info" onclick="search_h();">
                            <span class="fa fa-search "></span> Buscar</button>
                    </div>
                </div>
            </div>            
        </div>
        <!---FILTRO DE BUSQUEDA LINEA 2--->
        <div class="row">
            <div class="col-lg-3 text-right">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Desde: </div>
                        <input type="text" id="ifech_a" name="ifech_a" class='form-control' />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-left">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Al: </div>
                        <input type="text" id="ifech_b" name="ifech_b" class='form-control'>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Prioridad: </div>
                        <select id="prioridadid" class="form-control" onchange="search_h();">
                            <option value=""></option>
                            <option value="3">Alta</option>
                            <option value="2">Media</option>
                            <option value="1">Baja</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Ubicacion: </div>
                        <select id="ubica" name="ubica" class="form-control" onchange="search_h();">
                            <option value="">Todos</option>
                            <?php
                            $gmun = mysqli_query($CNN, "select * from cms_property_locale");
                            while ($l = mysqli_fetch_array($gmun)) {
                                echo "<option value='" . $l['id'] . "'>" . $l['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <script> $(function () {
                $("#ifech_a").datepicker({dateFormat: 'dd-mm-yy'});
            });
            $(function () {
                $("#ifech_b").datepicker({dateFormat: 'dd-mm-yy'});
            });
        </script>
        <div id='search-result' class="col-lg-12" style="min-width: 100%; min-height: 100%;padding: 1px;">
        </div>
        <?php
        break;
    case 1:
        $ubica = filter_input(INPUT_POST, "ub");
        $prioridad = filter_input(INPUT_POST, "prio");
        $find = filter_input(INPUT_POST, "find");
        $f1 = filter_input(INPUT_POST, "f1");
        $f2 = filter_input(INPUT_POST, "f2");
        $tys = filter_input(INPUT_POST, "tys");
        switch ($tys) {
            case '0':// Busqueda por propiedad
                if ($ubica != null) {
                    $fpro = mysqli_query($CNN, "SELECT id,title,address FROM cms_property where title like'%$find%' and location=$ubica");
                } else {
                    $fpro = mysqli_query($CNN, "SELECT id,title,address FROM cms_property where title like'%$find%'");
                }
                $nfpro = mysqli_num_rows($fpro); //numero de resultados
                if ($nfpro >= 1) {
                    ?>
                    <table class="table table-striped table-responsive " width="100%" border="0" cellspacing="0;">
                        <?php
                        while ($p = mysqli_fetch_array($fpro)) {
                            if ($prioridad != null) {
                                $ginci = mysqli_query($CNN, "select * from crm_incidence where pid=" . $p['id'] . " and priority='$prioridad'  and status<9 ORDER BY created DESC");
                            } else {
                                $ginci = mysqli_query($CNN, "select * from crm_incidence where pid=" . $p['id'] . " and status<9 ORDER BY created DESC");
                            }
                            $noin = mysqli_num_rows($ginci);
                            $add = str_replace(" ", "+", $p['address']);
                            ?>
                            <tr id="padre" name="padre">
                                <td>
                                    <table class="table-responsive" widht="100%" border="0">
                                        <tr>
                                            <td width="1">
                                                <button  onclick="moredetail2(<?php echo $p['id']; ?>, '0', '<?php echo $prioridad; ?>')" class="btn btn-primary"> <span class="badge"> <div id="ipend_<?php echo $p['id']; ?>" ><?php echo $noin; ?></div></span></button>
                                            </td>
                                            <td width='1'>
                                                <div class="dropdown info">
                                                    <button id="dLabel_<?php echo $p['id']; ?>" type="button"class="btn btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class='fa fa-bars'></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li onclick="moredetail(<?php echo $p['id']; ?>, '0', '<?php echo $prioridad; ?>')"><a href="javascript:void(0);"><span class="fa fa-folder-open"></span> Abiertos</a></li>
                                                        <li onclick="moredetail(<?php echo $p['id']; ?>, '1', '<?php echo $prioridad; ?>')"><a href="javascript:void(0);"><span class="fa fa-times"></span> Cerrados</a></li>
                                                        <li onclick="moredetail(<?php echo $p['id']; ?>, '2', '<?php echo $prioridad; ?>')"><a href="javascript:void(0);"><span class="fa fa-list-alt"></span> Todos</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td width='1'>
                                                <button class='btn btn-warning' alt="Agregar incidencia"  title="Agregar incidencia" onclick="addincidencia(<?php echo $p['id']; ?>)"><b><big><span class='fa fa-plus-square-o'></span></big></b></button>
                                            </td>
                                            <td>
                                                <button class='btn btn-success' alt="Ir a maps"  title="Ir a Maps" onclick="window.open('https://www.google.com.mx/maps/place/<?php echo $add; ?>');"><big><span class='fa fa-map-marker'></span></big></button>
                                            </td>
                                            <td widht="90%">
                                                <a href="javascript:void(0);"title="<?php echo strtoupper($p['title']); ?>" alt="<?php echo $p['title']; ?>"onclick="viewdetail(<?php echo $p['id']; ?>)" ><label class="bold"><b><big><?php echo strtoupper($p['title']); ?></big></b></label></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr id="detail_<?php echo $p['id']; ?>" name="detail_<?php echo $p['id']; ?>" style="display:none;">
                                <td>
                                    <div class="row" id="listrow_<?php echo $p['id']; ?>" style="width:auto; max-width:90%; padding-left: 2%;">
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                } else {
                    ?>
                    <div class="col-lg-12 bg-danger text-uppercase text-center" >
                        <h3>Seleccione otro criterio de busqueda</h3>
                    </div>
                    <?php
                }
                break;
            case '1': //Busqueda por incidencia
                if ($prioridad == null) {
                    $qprio = " ";
                } else {
                    $qprio = " and priority=$prioridad ";
                }
                if ($f1 == null && $f2 == null && $find == null) {
                    if ($ubica != null) {
                        $myqrfin = "SELECT id as pid FROM cms_property where location=$ubica";
                    } else {
                        $myqrfin = "SELECT id as pid FROM cms_property";
                    }
                } else {
                    $addqry = "";
                    if ($f1 != null && $f2 != null) {
                        $addqry = "and date(created) BETWEEN '" . date("y-m-d", strtotime($f1)) . "'  AND '" . date("y-m-d", strtotime($f2)) . "' ";
                    }
                    if ($ubica != null) {
                        $myqrfin = "SELECT * FROM crm_incidence WHERE (title like'%" . $find . "%' or nota like'%$find%' or reference like'%$find%') " . $addqry . " " . $qprio . "  group by pid ";
                    } else {
                        $myqrfin = "SELECT * FROM crm_incidence WHERE (title like'%" . $find . "%' or nota like'%$find%' or reference like'%$find%') " . $addqry . " " . $qprio . "  group by pid ";
                    }
                }
                $gprop = mysqli_query($CNN, $myqrfin) or $err = "error: " . mysqli_error($CNN);
                if (!isset($err)) {
                    $nopro = mysqli_num_rows($gprop);
                } else {
                    echo $err . "<br>" . $myqrfin;
                    $nopro = 0;
                }
                if ($nopro >= 1) {
                    ?>
                    <br>
                    <table class='table table-striped table-responsive'>
                        <?php
                        if ($ubica != null) {
                            $up = "and location=$ubica ";
                        } else {
                            $up = "";
                        }
                        while ($c = mysqli_fetch_array($gprop)) {

                            $ghou = mysqli_query($CNN, "select * from cms_property where id=" . $c['pid'] . " " . $up);
                            while ($k = mysqli_fetch_array($ghou)) {
                                $add = str_replace(" ", "+", $k['address']);
                                $addhouse = "";
                                if ($f1 != null && $f2 != null) {
                                    $addhouse = " and date(created) BETWEEN '" . date("Y-m-d", strtotime($f1)) . "'  AND '" . date("Y-m-d", strtotime($f2)) . "'";
                                }
                                $elqry = "SELECT * FROM crm_incidence WHERE pid=" . $k['id'] . " and (title like'%" . $find . "%' or nota like'%$find%' or reference like'%$find%') " . $addhouse . " and status<9 ";
                                $incide = mysqli_query($CNN, $elqry);
                                //$nocide = 0;
                                $nocide = mysqli_num_rows($incide);
                                ?>
                                <tr id="padre" name="padre">
                                    <td>
                                        <table class="table table-condensed" border="0">
                                            <tr>
                                                <td width="1">
                                                    <button  onclick="moredetail2(<?php echo $k['id']; ?>, '0', '<?php echo $prioridad; ?>', '<?php echo $find; ?>', '<?php echo $f1; ?>', '<?php echo $f2; ?>')" class="btn btn-primary"> <span class="badge"> <div id="ipend_<?php echo $k['id']; ?>" ><?php echo $nocide; ?></div></span></button>
                                                </td>
                                                <td width="1">
                                                    <div class="dropdown info">
                                                        <button id="dLabel_<?php echo $k['id']; ?>" type="button"class="btn btn-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class='fa fa-bars'></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li onclick="moredetail(<?php echo $k['id']; ?>, '0', '<?php echo $prioridad; ?>', '<?php echo $find ?>', '<?php echo $f1; ?>', '<?php echo $f2; ?>')"><a href="javascript:void(0);"><span class="fa fa-folder-open"></span> Abiertos</a></li>
                                                            <li onclick="moredetail(<?php echo $k['id']; ?>, '1', '<?php echo $prioridad; ?>', '<?php echo $find ?>', '<?php echo $f1; ?>', '<?php echo $f2; ?>')"><a href="javascript:void(0);"><span class="fa fa-times"></span> Cerrados</a></li>
                                                            <li onclick="moredetail(<?php echo $k['id']; ?>, '2', '<?php echo $prioridad; ?>', '<?php echo $find ?>', '<?php echo $f1; ?>', '<?php echo $f2; ?>')"><a href="javascript:void(0);"><span class="fa fa-list-alt"></span> Todos</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td width='1'>
                                                    <button class='btn btn-warning' alt="Agregar incidencia"  title="Agregar incidencia" onclick="addincidencia(<?php echo $k['id']; ?>)"><span class='fa fa-plus-square-o'></span></button>
                                                </td>
                                                <td width="1">
                                                    <button class='btn btn-success' alt="Ir a maps"  title="Ir a Maps" onclick="window.open('https://www.google.com.mx/maps/place/<?php echo $add; ?>');"><big><span class='fa fa-map-marker'></span></big></button>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);"title="<?php echo strtoupper($k['title']); ?>" alt="<?php echo $k['title']; ?>"onclick="viewdetail(<?php echo $k['id']; ?>)" ><label class="bold"><b><big><?php echo strtoupper($k['title']); ?></big></b></label></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr id="detail_<?php echo $k['id']; ?>" name="detail_<?php echo $k['id']; ?>"  style="display: none; width:auto;">
                                    <td style="width:auto" class="alert-">
                                        <div class="row" id="listrow_<?php echo $k['id']; ?>" style="width:auto;padding-left: 5%;">
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                    <?php
                }
                break;
        }
        break;
    case 2:
        $myuser = $_SESSION['PROSPECTOS']['uid'];
        $pid = filter_input(INPUT_POST, "pid");
        $nxt = 0;
        $qry = mysqli_query($CNN, "select max(id) as mixd from crm_incidence");
        while ($m = mysqli_fetch_array($qry)) {
            $nxt = $m['mixd'];
        }
        $nxt++;
        //echo "<big>folio: " . $nxt . "</big>";
        $inc = mysqli_query($CNN, "insert into crm_incidence(pid,status,uid,title,created,priority)values('$pid',1,'$myuser' ,'Incidencia: " . date("d-m-Y") . "',CURRENT_TIMESTAMP,1)") or $err = "error al crear el folio" . mysqli_error($CNN);
        if (!isset($err)) {
            ?>
            <script>
                $.bootstrapGrowl("Incidencia creada", {type: 'info'});
            </script>
            <div class="row">
                <div class="col-lg-6 ">Creado:<b> <?php echo date("d") . "-" . $mes[date("m")] . "-" . date("Y"); ?></b></div>
                <div class="col-lg-6 text-right">Status:<b>Abierto</b><img src="images/opn.png"></div>
            </div>
            <input type="text" id="numfolio" value="<?php echo $nxt; ?>" class="hidden">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Nombre: </div>
                            <input type="text" id="in_title" class="form-control bold" value="Incidencia: <?php echo date("d-m-Y"); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                 <div class="col-lg-12">
                     <div class="form-group">
                         <div class="input-group">
                             <div class="input-group-addon">Zona: </div>-->
            <input type="text" id="in0" class="hidden" />
            <!--   </div>
            </div>
            </div>
            </div>-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Prioridad: </div>
                            <select id="in" class="form-control">
                                <option value="1">Baja</option>
                                <option value="2">Media</option>
                                <option value="3">Alta</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Notas: </div>
                            <textarea class="form-control" name="in1" id="in1"rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <a href="javascript:void(0);" onclick="mediaincidencia(<?php echo $nxt; ?>);" class="btn btn-info"><span class="fa fa-picture-o"><b>+</b></span></a><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="imgnew" name="imgnew" style="display: none;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-right">
                    <button onclick="cancela_incidencia(<?php echo $nxt; ?>);" class="btn btn-danger">Borrar</button>
                    <button onclick="incidend(<?php echo $nxt; ?>,<?php echo $pid; ?>);" class="btn btn-success">Guardar</button>
                </div>
            </div>
            <?php
        } else {
            ?>
            <script>
                $.bootstrapGrowl("<?php echo $err; ?>", {type: 'warning'});
            </script>
            <?php
        }
        break;
    case 3:
        $id = filter_input(INPUT_POST, "id");
        $tit = filter_input(INPUT_POST, "tit");
        $ref = filter_input(INPUT_POST, "ref");
        $not = filter_input(INPUT_POST, "not");
        $prio = filter_input(INPUT_POST, "prio");
        $udinci = mysqli_query($CNN, "update crm_incidence set reference='$ref',nota='$not',status='1',title='$tit',priority='$prio' where id=$id") or $erro = "Error al guardar los datos" . mysqli_error($CNN);
        if (!isset($erro)) {
            echo "1";
        } else {
            echo $erro;
        }
        break;
    case 4:
        $id = filter_input(INPUT_POST, "id");
        $read = "";
        $traedatos = mysqli_query($CNN, "select * from crm_incidence where id=$id");
        while ($d = mysqli_fetch_array($traedatos)) {
            if ($d['status'] == 9) {
                $read = "readonly";
            }
            ?>
            <div>
                <div class="row">
                    <div class="col-lg-6 ">Creado:<b> <?php echo date("d") . "-" . $mes[date("m")] . "-" . date("Y"); ?></b></div>
                    <div class="col-lg-6 text-right">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Status: </div>
                                <select id="stat_inci" class="form-control" <?php echo $read; ?>>
                                    <option value="9" <?php
                                    if ($d['status'] == 9) {
                                        echo "selected";
                                    }
                                    ?>>Finalizado</option>
                                    <option value="1" <?php
                                    if ($d['status'] == 1) {
                                        echo "selected";
                                    }
                                    ?>>Abierto</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Nombre: </div>
                                <input type="text" id="in_0"  value='<?php echo $d['title']; ?>' class="form-control" <?php echo $read; ?>>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  <div class="row">
                      <div class="col-lg-12">
                          <div class="form-group">
                              <div class="input-group">
                                  <div class="input-group-addon">Zona: </div>-->
                <input type="text" id="in_1" value="<?php echo $d['reference']; ?>"placeholder="Referencia" class="hidden" <?php echo $read; ?>>
                <!--     </div>
                 </div>
             </div>
            </div>-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Prioridad: </div>
                                <select id="in_in" class="form-control" <?php echo $read; ?> >
                                    <option value="1" <?php
                                    if ($d['priority'] == 1 || $d['priority'] == 0) {
                                        echo "selected";
                                    }
                                    ?>>Bajo</option>
                                    <option value="2" <?php
                                    if ($d['priority'] == 2) {
                                        echo "selected";
                                    }
                                    ?>>Media</option>
                                    <option value="3" <?php
                                    if ($d['priority'] == 3) {
                                        echo "selected";
                                    }
                                    ?>>Alta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="form-group">
                     <b>Referencia:</b><br>
                     <input type="text" id="in_1" value="<?php echo $d['reference']; ?>"placeholder="Referencia" class="form-control" <?php echo $read; ?>>
                 </div>-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Notas: </div>
                                <textarea class="form-control"id="in_2" rows="3"  <?php echo $read; ?>><?php echo $d['nota']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-lg-12' id="gellery" name="gallery">
                    <?php
                    $qy = mysqli_query($CNN, "select * from crm_incidence_gallery where iid=$id")or die(mysqli_error($CNN));
                    while ($i = mysqli_fetch_array($qy)) {
                        ?>
                        <div class="col-sm-4">
                            <input type="text" value="0" id="ang_i_<?php echo $i['namei']; ?>_m.jpg" name="ang_i_<?php echo $i['namei']; ?>_m.jpg" class="hidden">
                            <img id="srima_<?php echo $i['namei']; ?>" name="srima_<?php echo $i['namei']; ?>"class="img thumbnail" onclick="imgProOpen2('<?php echo $i['namei']; ?>')" src="content/upload/incidence/<?php echo $i['namei']; ?>_m.jpg?<?php echo rand(); ?>" title="Imagen" width="100%" />
                            <button class="btn-success" onclick="rotateimage_incide('<?php echo $i['namei']; ?>');"><span class="fa fa-repeat"></span> 90&deg;</button>
                            <br>
                        </div>
                        <?php
                    }
                    ?>
                </div><br>
                <?php
                if ($d['status'] != 9) {
                    ?>
                    <a href="javascript:void(0);" onclick="mediaincidencia2(<?php echo $id; ?>);" class="btn btn-info"><span class="fa fa-picture-o"></span><b>+</b></a><br><br>
                    <?php
                }
                ?>
                <div id="imgnew2"style="display: none;"></div>
                <br>
                <div class="form-group-lg" align="right" style="padding-right:5% ">
                    <?php
                    if ($d['status'] == 9) {
                        ?>
                        <button onclick='$("#inciden_final").modal("hide");' class="btn btn-success">Cerrar</button>
                        <?php
                    } else {
                        ?>
                        <button onclick="incidesavechange(<?php echo $d['id']; ?>);" class="btn btn-success">Guardar Cambios</button>

                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        break;
    case 5:
        $id = filter_input(INPUT_POST, "id");
        $endinci = mysqli_query($CNN, "Update crm_incidence set status=9 where id=$id");
        break;
    case 6:
        $id = filter_input(INPUT_POST, "id");
        $tit = filter_input(INPUT_POST, "tit");
        $ref = filter_input(INPUT_POST, "ref");
        $not = filter_input(INPUT_POST, "not");
        $prio = filter_input(INPUT_POST, "prio");
        $final = filter_input(INPUT_POST, "final");
        if ($final == 9) {
            $updanot = mysqli_query($CNN, "update crm_incidence set title='$tit',nota='$not',status='$final', reference='$ref', changed=CURRENT_TIMESTAMP where id=$id");
        } else {
            $updanot = mysqli_query($CNN, "update crm_incidence set title='$tit',nota='$not',priority='$prio',status='$final', reference='$ref', changed=CURRENT_TIMESTAMP where id=$id");
        }
        break;
    case 7:
        $id = filter_input(INPUT_POST, "id");
        $getral = mysqli_query($CNN, "select * from cms_property where id=$id");
        while ($l = mysqli_fetch_array($getral)) {
            ?>
            <div class="col-lg-12 text-uppercase">
                <big><b>
                        <?php
                        echo $l['title'];
                        ?>
                    </b>
                </big>
            </div>
            <div class="col-lg-12 text-uppercase">
                <b>Direcci&oacute;n:</b>
                <?php
                echo $l['address'];
                ?>
            </div>
            <div class="col-lg-12 text-uppercase">
                <b>Descripci&oacute;n: </b>
                <?php
                echo $l['short_desc'];
                ?>
            </div>
            <?php
            $dire = str_replace(' ', '+', $l['address']);
            ?>
            <a href="https://www.google.com/maps/place/<?php echo $dire; ?>" alt="Abrir en Google maps" title="Abrir en Google maps" target="_blank"><button class="btn btn-success"><span class="fa fa-map-marker"></span></button></a>
            <div id="localized" class="gmap3" style="width:400px; height: 400px;"></div>
            <script>
                $("#localized").gmap3({
                    marker: {
                        address: "<?php echo $l['address']; ?>"
                    },
                    map: {
                        options: {
                            zoom: 14
                        }
                    }
                });
            </script>
            <?php
        }
        break;
    case 8:
        $id = filter_input(INPUT_POST, "id");
        $trae = mysqli_query($CNN, "SELECT * from crm_incidence where id=$id");
        while ($i = mysqli_fetch_array($trae)) {
            ?>
            <div class="col-lg-4 hover bg-info text-capitalize bold" style="border:2px solid #fff ;min-width: 200px;" onclick='editinc(<?php echo $i['id']; ?>)'>
                <big>
                    <?php echo $i['id']; ?><br>
                    <?php echo $i['title']; ?><br>
                    <?php echo date("d-m-y", strtotime($i['created'])); ?><br>
                </big>
            </div>
            <?php
        }
        break;
    case 9:
        $id = filter_input(INPUT_POST, "id");
        $pie = explode("_", $id);
        $gall = mysqli_query($CNN, "select * from crm_incidence_gallery where iid=" . $pie['2']);
        $ngall = mysqli_num_rows($gall);
        if ($ngall >= 1) {
            while ($f = mysqli_fetch_array($gall)) {
                unlink("../../../content/upload/incidence/" . $f['namei'] . "_m.jpg");
            }
            $galldel = mysqli_query($CNN, "delete from crm_incidence_gallery where iid=" . $pie['2'])or $err .= "error al borrar la galeria" . mysqli_error($CNN);
        }
        $delinc = mysqli_query($CNN, "delete from crm_incidence where id=" . $pie[2])or $err2 = "error al borrar la incidencia" . mysqli_error($CNN);
        if (!isset($err) && !isset($err2)) {
            echo "1";
        } else {
            echo $err;
        }
        break;
    case 10:
        $id = filter_input(INPUT_POST, "id");
        //$pie = explode("_", $id);
        $gall = mysqli_query($CNN, "select * from crm_incidence_gallery where iid=" . $id);
        $ngall = mysqli_num_rows($gall);
        if ($ngall >= 1) {
            while ($f = mysqli_fetch_array($gall)) {
                unlink("../../../content/upload/incidence/" . $f['namei'] . "_m.jpg");
            }
            $galldel = mysqli_query($CNN, "delete from crm_incidence_gallery where iid=" . $id)or $err .= "error al borrar la galeria" . mysqli_error($CNN);
        }
        $delinc = mysqli_query($CNN, "delete from crm_incidence where id=" . $id)or $err2 = "error al borrar la incidencia" . mysqli_error($CNN);
        if (!isset($err) && !isset($err2)) {
            echo "1";
        } else {
            echo $err;
        }
        break;
}
