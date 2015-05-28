<h2>Propiedades</h2>
<?php
switch ($o) 
{
    case 0:
        ?>
        <form action="./?m=web&s=rental&o=1" class="form" method="post" enctype="multipart/form-data" >
            <div class="well well-sm">
                <b>Crear Nueva Propiedad</b>
                <table class="table table-condensed">
                    <tr>
                        <td width="40%">
                            <div class="input-group">
                                <span class="input-group-addon">Titulo</span>
                                <input type="text" id="rent-title" name="rent-title" class="form-control" />                        
                            </div>
                        </td>
                        <td width="15%">
                            <div class="input-group">
                                <span class="input-group-addon">Precio $</span>
                                <input type="text" id="fent-prize" name="rent-prize" size="10" class="form-control" />
                            </div>
                        </td>
                        <td width="15%">
                            <div class="input-group">
                                <span class="input-group-addon">Cuartos</span>
                                <input type="number" id="rent-room" name="rent-room" value="0"size="10" min="0"class="form-control"/>
                            </div>
                        </td>
                        <td width="15%">
                            <div class="input-group">
                                <span class="input-group-addon">Capacidad</span>
                                <input type="number" id="rent-capa" name="rent-capa" size="10"value="0" min="0"class="form-control" />
                            </div>
                        </td>
                         <td width="15%">
                            <div class="input-group">
                                <span class="input-group-addon">Ba&ntilde;os</span>
                                <input type="number" id="rent-bat" name="rent-bat" size="10"value="0" min="0"class="form-control" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <div class="input-group">
                                <span class="input-group-addon">Tipo</span>
                                <select id="rent-type" name="rent-type" class="form-control" >
                                    <?php
                                    $consulta = "SELECT * from property_type ";
                                    $result=mysqli_query($CNN,$consulta);
                                     while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
                                     {
                                         ?>
                                          <option value='<?php echo $x['id']; ?>'><?php echo $x['name']; ?></value>
                                     <?php }?>
                                </select>
                            </div>
                        </td>
                        <td >
                            <div class="input-group">
                                <span class="input-group-addon">Modo</span>
                                 <select id="rent-mode" name="rent-mode" class="form-control" >
                                     <option value="0">Gestion</option>
                                     <option value="1">Venta</option>
                                     <option value="2">Traspaso</option>
                                 </select>
                            </div>
                        </td>
                        <td colspan="3">
                            <div class="input-group">
                                <span class="input-group-addon">Ubicacion</span>
                                <input type="text" id="rent-ubi" name="rent-ubi"  size="200"class="form-control" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="input-group">
                                <span class="input-group-addon">Descripcion corta</span>
                                <input type="text" id="rent-short" name="rent-short"  size="200" class="form-control" />
                            </div>
                        </td>
                        <!--<td>
                            <div class="input-group">
                                <span class="input-group-addon">Im&aacute;gen</span>
                                <input type="file" id="feat-image" name="feat-image" class="form-control" />
                            </div>
                        </td>-->
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="input-group">
                                <span class="input-group-addon">Descripcion Larga</span>
                                <textarea type="text" id="rent-short" name="rent-short" rows="6" cols="100%" class="form-control" /></textarea>
                            </div>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-danger">Enviar</button>
            </div>
        </form>
    <?php
    break;
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

