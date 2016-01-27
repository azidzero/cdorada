<h2>Tarifas</h2>
<?php
switch ($op) {
    case 0:
        ?>
        <small><h4>Agregar</h4></small>
         <button class="btn btn-danger " onclick="swhaddrate();"><span class="fa fa-plus"></span></button>
<!-----NUEVA TARIFA Y VER ANTERIORES----->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" style="z-index: 9999;" role="dialog" id="adt" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog" style="width:90%;">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div id="namewindow"> <h4 class="modal-title">Nueva tarifa</h4></div>
                    </div>
                    <div class="modal-body bg-info" id="bodytar">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>
<!---------------------REMUEVE EL PERIODO DENTRO DE LA TARIFA------------------------>
<div class="modal fade" id="delper" tabindex="-1" style="z-index: 99991;"role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog"  style="width:20%;">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text"  id="el_id" class="hidden"/>
                        <label class="control-label">¿Eliminar desea eleminar este periodo?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="del_per()">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
<!-----modal generico----->
        <div class="modal fade" id="mdl_gen" tabindex="-1" style="z-index: 99991;"role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog"  style="width:30%;">
                <div class="modal-content" id="mdl_conten" >
                </div>
            </div>
        </div>
<!-----VACIAR LOS PERIODOS DE LA TARIFA----->
        <div class="modal fade" id="rangos_del" tabindex="-1" style="z-index: 99991;"role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog"  style="width:20%;">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">¿DESEA BORRAR LOS PERIODOS DE ESTA TARIFA?</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="do_del_per()">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
<!-----CLONAR LA TARIFA----->
        <div class="modal fade" id="duplicate_tarifa" tabindex="-1" style="z-index: 99991;"role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog"  style="width:30%;">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">¿Desea duplicar la tarifa?</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text"  id="idclon" class="hidden"/>
                        <b>¿Que nombre desea usar?</b>
                        <div class="input-group-lg ">
                            <input type="text"  id="namedup" class="form-control"/>
                        </div>                                             
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                        <button type="button" class="btn btn-success" onclick="doclon()">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
<!-----VER DETALLES DE LA TARIFA----->
        <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog"  style="width:30%;">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Detalles<div id="nombredetalle"></div></h4>
                    </div>
                    <div class="modal-body" style="max-width: 100%" id="detailtar">
                    </div>
                </div>
            </div>
        </div>
<!-----ASIGNAR PROPIEDAD A LA TARIFA----->
        <div class="modal fade" id="addpro"  name="addpro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div  class="modal-dialog" role="document">
                <div class="modal-content" id="hous_rate">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Alojamientos de la tarifa<div id="nombretarifa"></div></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-10">
                                <b>FILTRAR:</b> <input type="text" id="namehouse" class="form-control" onkeyup="searchhouse(this.value);"placeholder="ESCRIBE EL NOMBRE DE LA PROPIEDAD">
                                <input type="text" id="ioferta" class="hidden">
                            </div>
                        </div>
                        <div id="procont" name="procont">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
<!-------------------FILTRO DE  LA TABLA-------------------------->
        <div class="row container-fluid">
            <div class="col-xs-1 text-right" style="vertical-align: bottom; ">
                <h4>Filtrar:</h4>
            </div>
            <div class="col-lg-6 text-left" style="vertical-align:bottom;">
                <input type="text" class="form-control" id="search_tar" onkeyup="filtratabla(this.value, 110);">
            </div>
        </div>
<!---OFERTAS TABLA-->
        <div class="div-contain" id="container_tarifa">
            <table class="table table-condensed table-striped table-hover">
                <thead class="text-uppercase bold ">
                    <tr>
                        <th width='1'></th>
                        <th width="20%" >Nombre</th>
                        <th width="79%">Opcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getname = mysqli_query($CNN, "select * from crs_rates order by name asc");
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
        </div>
        <?php
        break;
}

