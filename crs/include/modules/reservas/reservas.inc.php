<h3>RESERVAS</h3>
<?php
switch ($o) {
    case 0:
        ?>
        <small><h3>Agregar</h3></small>
        <br>
        <form  action="./?m=reservas&s=reservas&o=1" method="post" class="form" > 
            <table border="0" class="table-condensed"width="100%">
                <tr>
                    <td width="80%" colspan="2" >
                        <div class="input-group">
                            <div class="input-group-addon"><label>Edificio: <i class="fa fa-building-o"></i></label></div>
                            <select id="building" name="building" class="form-control" onchange="showprecio(this.value)">
                                <option></option>
                                <?php
                                $dec = "select * from cms_property where status=1";
                                echo $dec;
                                $qry = mysqli_query($CNN, $dec)or "error:" . mysqli_error($CNN);
                                while ($p = mysqli_fetch_array($qry)) {
                                    ?><option value="<?php echo $p['id']; ?>" > <?php echo $p['title']; ?> </option><?php
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td style="vertical-align:text-bottom;" align="center"  width="20%"rowspan="5">
                        <label>
                            <h2><small>Costo: &nbsp;</small></h2>
                            <label class="btn-success">
                                <h3> <div id="micosto" name="micosto" style="width:100%">0.00</div></h3>
                            </label>
                        </label>
                        <input type="text" id="pricend" name="pricend" class="hidden">
                    </td>
                </tr>
                <tr>
                    <td >
                        <div class="input-group">
                            <div class="input-group-addon"><label>Entrada <i class="fa fa-calendar"></i></label></div>
                            <input type="text" class="form-control" id="ini" name="ini"  required>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-addon"><label>Salida <i class="fa fa-calendar"></i></label></div>
                            <input type="text" class="form-control" id="end" name="end"   onchange="cambiatotal();" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table >
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-addon"><label>Adultos<i class="fa fa-users"></i></label></div>
                                        <input type="number" class="form-control" min="0"value="0" id="adult" name="adult"  required>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-addon"><label>Ni&ntilde;os <i class="fa fa-child"></i></label></div>
                                        <input type="number" class="form-control" min="0" value="0"id="child" name="child"  required>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-addon"><label>RESERVA POR: <i class="fa fa-building-o"></i></label></div>
                                        <select id="por" name="por" class="form-control" onchange="agen(this.value)">
                                            <option value="0">Agencia</option>
                                            <option value="1" selected>Cliente</option>
                                            <option value="2">Propietario</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-addon"><label>ORIGEN: <i class="fa fa-building-o"></i></label></div>
                                        <select id="source" name="source" class="form-control" >
                                            <option></option>
                                            <option value="0" selected>Internet</option>
                                            <option value="1">Telefono</option>
                                            <option value="2">Correo</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="display: none;" id="agencia" name="agencia">
                    <td colspan="2">
                        <div class="input-group">
                            <div class="input-group-addon"><label>Agencia: <i class="fa fa-archive"></i></label></div>
                            <select id="agency" name="agency" class="form-control" >
                                <option></option>
                                <option value="0" selected>agencia 1</option>
                                <option value="1">agencia 2</option>
                                <option value="2">agencia 3</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        <div class="input-group">
                            <div class="input-group-addon"><label>Inquilino: <i class="fa fa-user-md"></i></label></div>
                            <input type="text" class="form-control" id="inquilino" name="inquilino">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table class="table table-responsive" width="100%">
                            <thead>
                            <th><label>Complemento</label></th>
                            <th width="5%"><label>Cant</label></th>
                            <th><label>Precio</label></th>
                            <th><label>Deposito</label></th>
                            <th><label>Total</label></th>
                            <th>&nbsp;</th>
                            </thead>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-addon"><label><i class="fa fa-outdent"></i></label></div>
                                        <label><input class="form-control"type="text" name="namecom" id="namecom"></label>
                                    </div>
                                </td>
                                <td width="10%">
                                    <div class="input-group">
                                        <div class="input-group-addon"><label><i class="fa fa-tachometer"></i></label></div>
                                        <input class="form-control" value="1" min="0"type="number" name="cantcomp" id="cantcomp"  onkeydown="sumacomplementos()" onkeypress="sumacomplementos()" onfocus="sumacomplementos()"onchange="sumacomplementos()">
                                    </div>
                                </td>
                                <td><div class="input-group">
                                        <div class="input-group-addon"><label><i class="fa fa-money"></i></label></div>
                                        <input class="form-control" type="text" name="costcom" id="costcom"  value="0" min="0" onkeydown="sumacomplementos()" onkeypress="sumacomplementos()" onfocus="sumacomplementos()"onchange="sumacomplementos()">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-addon"><label><i class="fa fa-money"></i></label></div>
                                        <input class="form-control" type="text" name="depocom" id="depocom" value="0" min="0" onkeydown="sumacomplementos()" onkeypress="sumacomplementos()" onfocus="sumacomplementos()"onchange="sumacomplementos()">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-addon"><label><i class="fa fa-money"></i></label></div>
                                        <input type="text" name="totcom" id="totcom" class="form-control">
                                    </div>
                                </td>
                                <td><label class="btn btn-success" onclick="addcom();"><span class="fa fa-plus-circle"></span></label></td>
                            </tr>
                        </table>
                        <div class="banner" style="background-color:#E0ECF5;">
                            <table  id="tablecomplemento" name="tablecomplemento" class="table-striped" width="100%">
                                <thead>
                                <th><label>Complemento</label></th>
                                <th><label>Cantidad</label></th>
                                <th><label>Precio</label></th>
                                <th><label>Deposito</label></th>
                                <th><label>Total</label></th>
                                <th>&nbsp;</th>
                                </thead>
                            </table>
                        </div>
                    </td>
                    <td align="right" style="vertical-align:top;">
                        <h3><button class="btn-success">RESERVAR <span class="fa fa-save"></span></button></h3>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        break;
    case 1:
        ?><h3>Listar</h3>
        <?php
        $arr=$_REQUEST;
        /*echo "<pre>";
        print_r($arr);
        echo "</pre>";*/
        echo $arr["building"];
        $inre="insert into crs_reserva( pid, ini, end, adult,boy, reserva,origen, inquilino,total)values"
                . "(".$arr["building"].",'".date("Y-m-d",strtotime($arr["ini"]))."','".date("Y-m-d",strtotime($arr["end"]))."',".$arr["adult"].",".$arr["child"].",".$arr["por"].",".$arr["source"].", '".$arr["inquilino"]."', ".$arr["pricend"].")";
        echo $inre;
        break;
}
