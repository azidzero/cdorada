<?php
include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
switch ($op) {
    case 0:
        ?>
        <div class="modal fade" id="askoffer" name="askoffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' >
                            <input type="text" name="op" id="op" value="3" class="hidden"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar la oferta?</label>
                                <input type="text" name="el_id" class="form-control" id="el_id" class="hidden"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="deloffer()">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="propoffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog"  >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Asignar-----------------> Propiedades a la Oferta</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='addprof' name='addprof' method='POST' >
                            <div id="contentoff" name="contentoff">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-info" onclick="showoffer();"><span class="fa fa-plus"></span></button>
        <div id="addoffer" name="addoffer" style="display:none;">
            <form id="sendoffer" name="sendoffer" method="post">
                <input type="text" id="op" name="op" value="0" class="hidden">
                <input type="text" id="isedit" name="isedit" value="" class="hidden">
                <table class="table-condensed" width="100%">
                    <tr>
                        <td width="25%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Oferta</label></big>
                                <input type="text" id="titleo" name="titleo" class="form-control">
                            </div>
                        </td>
                        <td width="20%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Inicio</label></big>
                                <input type="text" class="form-control" id="datepicker" name="datepicker" required>
                            </div>
                        </td>
                        <td width="20%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Final</label></big>
                                <input type="text" class="form-control" id="datepicker2" name="datepicker2" required>
                            </div>
                        </td>
                        <td width="15%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Cantidad</label></big>
                                <input type="text" class="form-control"  id="cantidad" name="cantidad" required>
                            </div>
                        </td>
                        <td width="20%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Tipo</label></big><br>
                                <input type="radio" name="options" id="option1" value="0"autocomplete="off" checked> Porcentaje %
                                <br>
                                <input type="radio" name="options" id="option1" value="1" autocomplete="off"> Cantidad €
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <button  type="submit" class="btn btn-success" onclick="guardaoffer();">Guardar</button>
        </div>
        <input type="text" id="id_edit" name="id_edit" class="form-control" value="0">
        <table id="example" name="example" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Oferta</td>
                    <td>F. Inicio</td>
                    <td>F. Final</td>
                    <td>Desc/Prize</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <script>
            $(document).ready(function () {
                jTable('example', 'include/modules/offer/offer.table.php');
            });
        </script>
        <?php
        break;
    case 1:
        ?>
        <script>
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $(function () {
                $("#datepicker").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                });
            });
            $(function () {
                $("#datepicker2").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                });
            });
            $(function () {
                $("#shini").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                });
            });
            $(function () {
                $("#shend").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                });
            });
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
        </script>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Agregar Oferta</h4>
        </div>
        <div class="modal-body" id="elimina_c" name="elimina_c">
            <form id="sendoffer" name="sendoffer" method="post">
                <input type="text" id="op" name="op" value="0" class="hidden">
                <input type="text" id="isedit" name="isedit" value="" class="hidden">
                <table class="table-condensed" width="100%">
                    <tr>
                        <td width="25%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Nombre de la Oferta</label></big>
                                <input type="text" id="titleo" name="titleo" class="form-control">
                            </div>
                        </td>
                        <td width="20%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Desde</label></big>
                                <input type="text" class="form-control" id="datepicker" name="datepicker" required>
                            </div>
                        </td>
                        <td width="20%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Hasta</label></big>
                                <input type="text" class="form-control" id="datepicker2" name="datepicker2" required>
                            </div>
                        </td>
                        <td width="15%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Monto</label></big>
                                <input type="text" class="form-control"  id="cantidad" name="cantidad" required>
                            </div>
                        </td>
                        <td width="20%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Tipo</label></big><br>
                                <input type="radio" name="options" id="option1" value="0"autocomplete="off" checked> Porcentaje %
                                <br>
                                <input type="radio" name="options" id="option1" value="1" autocomplete="off"> Monto €
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            <div class="inpupt-group">
                                <big><label class="label label-default">Visible desde:</label></big>
                                <input type="text" class="form-control"  id="shini" name="shini" required>
                            </div>
                        </td>
                        <td>
                            <div class="inpupt-group">
                                <big><label class="label label-default">Hasta:</label></big>
                                <input type="text" class="form-control"  id="shend" name="shend" required>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="guardaoffer()">Aceptar</button>
        </div>
        <?php
        break;
    case 2:
        $idof = filter_input(INPUT_POST, "id");
        $geto = "select count(id) as cas from crs_offer_use where idof='$idof'";
        $gpo = mysqli_query($CNN, $geto)or $err = "error en el qry<br>$geto<br>" . mysqli_error($CNN);
        $ofta = 0;
        if (!isset($err)) {
            while ($oid = mysqli_fetch_array($gpo)) {
                $ofta = $oid['cas'];
            }
        } else {
            echo $err;
        }
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Eliminar<?php echo $ofta; ?></h4>
        </div>
        <div class="modal-body">
            <?php
            if ($ofta >= 1) {
                ?>
                <div class="alert alert-info " role="alert">
                    <big>
                        <big><b>Hay alojamientos asignados a esta oferta<br>primero elimine las ofertas de los alojamientos</b></big>
                    </big>
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-danger " role="alert">
                    <big>
                        <h3><big><b>Estos cambios NO seran reversibles</b></big></h3><br>
                        ¿Desea Continuar?
                    </big>
                </div>
                <br>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="deloffer(<?php echo $idof; ?>)">Aceptar</button>
                <?php
            }
            ?>
        </div>
        <?php
        break;
    case 3:
        $id = filter_input(INPUT_POST, "idof");
        $qry = "select * from crs_offer where id=$id";
        $SQL = mysqli_query($CNN, $qry);
        ?>
        <script>
            $(function () {
                $("#datepicker").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                });
            });
            $(function () {
                $("#datepicker2").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                });
            });
            $(function () {
                $("#shini").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                });
            });
            $(function () {
                $("#shend").datepicker({dateFormat: 'dd-mm-yy',
                    beforeShow: function () {
                        setTimeout(function () {
                            $('.ui-datepicker').css('z-index', 99999999999999);
                        }, 0);
                    }
                });
            });
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
        </script>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Editar Oferta</h4>
        </div>
        <div class="modal-body" id="elimina_c" name="elimina_c">
            <form id="sendoffer" name="sendoffer" method="post">
                <input type="text" id="op" name="op" value="0" class="hidden">
                <input type="text" id="isedit" name="isedit" value="<?php echo $id; ?>" class="hidden">
                <?php
                while ($f = mysqli_fetch_array($SQL)) {
                    ?>
                    <table class="table-condensed" width="100%">
                        <tr>
                            <td width="25%">
                                <div class="inpupt-group">
                                    <big><label class="label label-default">Nombre de la Oferta</label></big>
                                    <input type="text" id="titleo" name="titleo" class="form-control" value="<?php echo strtoupper($f['name']); ?>">
                                </div>
                            </td>
                            <td width="20%">
                                <div class="inpupt-group">
                                    <big><label class="label label-default">Desde</label></big>
                                    <input type="text" class="form-control" id="datepicker" name="datepicker" value="<?php echo date("d-m-Y", strtotime($f['date_ini'])); ?>" required>
                                </div>
                            </td>
                            <td width="20%">
                                <div class="inpupt-group">
                                    <big><label class="label label-default">Hasta</label></big>
                                    <input type="text" class="form-control" id="datepicker2" name="datepicker2" value="<?php echo date("d-m-Y", strtotime($f['date_end'])); ?>"required>
                                </div>
                            </td>
                            <td width="15%">
                                <div class="inpupt-group">
                                    <big><label class="label label-default">Monto</label></big>
                                    <input type="text" class="form-control"  id="cantidad" name="cantidad"value="<?php echo $f['cant']; ?>" required>
                                </div>
                            </td>
                            <td width="20%">
                                <div class="inpupt-group">
                                    <big><label class="label label-default">Tipo</label></big><br>
                                    <input type="radio" name="options" id="option1" value="0"autocomplete="off"<?php
                                    if ($f['tipo'] == 0) {
                                        echo "checked";
                                    }
                                    ?>> Porcentaje %
                                           <br>
                                    <input type="radio" name="options" id="option1" value="1" autocomplete="off"<?php
                                    if ($f['tipo'] == 1) {
                                        echo "checked";
                                    }
                                    ?> > Monto €
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <div class="inpupt-group">
                                    <big><label class="label label-default">Visible desde:</label></big>
                                    <input type="text" class="form-control"  id="shini" name="shini"value="<?php echo date("d-m-Y",strtotime($f['show_ini'])); ?>" required>
                                </div>
                            </td>
                            <td>
                                <div class="inpupt-group">
                                    <big><label class="label label-default">Hasta:</label></big>
                                    <input type="text" class="form-control"  id="shend" name="shend" value="<?php echo date("d-m-Y",strtotime($f['show_end'])); ?>" required>
                                </div>
                            </td>
                        </tr>
                    </table>
            <?php
        }
        ?>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="guardaoffer()">Aceptar</button>
        </div>
        <?php
        break;
}