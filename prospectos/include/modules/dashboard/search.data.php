<?php
include_once("../../../inc/app.conf.php");
$text = filter_input(INPUT_POST, "txt");
$text2 = filter_input(INPUT_POST, "txt2");
$text3 = filter_input(INPUT_POST, "txt3");
$arr = explode(",", $text);
$n = count($arr);
if ($n >= 2) {
    $qry = "select a.*,(Select count(b.id) from crm_persons_gallery b where b.pid=a.id ) as att from crm_persons a where (";
    for ($x = 0; $x < $n; $x++) {
        $qry.=" a.name like'%$arr[$x]%' or a.email like'%$arr[$x]%' or a.phone like'%$arr[$x]%' or a.comments like'%$arr[$x]%' or a.address like '%$arr[$x]%' or a.regDate like '%" . date("Y-m-d", strtotime($arr[$x])) . "%' or ";
    }
    $qry = substr($qry, 0, -3);
    $qry.=")";
} else {
    $qry = "select  a.*,(Select count(b.id) from crm_persons_gallery b where b.pid=a.id ) as att from crm_persons a where( a.name like'%$text%' or a.email like'%$text%' or a.phone like'%$text%' or a.comments like'%$text%' or a.address like '%$text%')";
}
if($text3!=null)
{
    $qry.=" and  date(a.regDate)='" . date("Y-m-d", strtotime($text3)) . "'   ";
}
if($text2!=null)
{
   $qry.=" and a.tactividad=$text2 ORDER BY a.regDate DESC"; 
}
else
{
   $qry.="  ORDER BY a.regDate DESC";  
}
$q = mysqli_query($CNN, $qry) or $err = "Error al consultar los datos" . mysqli_error($CNN) or $err = "error en la consulta" . $qry . $mysqli_error($CNN);
if (!isset($err)) {
    $nres = mysqli_num_rows($q);
    if ($nres >= 1) {
        if (!isset($err)) {
            ?>
            <div class="table-responsive">
                <div id="no-more-tables">
                    <table class="col-sm-12  table-striped table-condensed table-hover cf text-capitalize">
                        <thead class="cf">
                            <tr class="text-capitalize text-uppercase">
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Registrado</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($r = mysqli_fetch_array($q)) {
                                ?>
                                <tr>
                                    <td data-title="Nombre:">
                                        <label onclick="showdetail(<?php echo $r['id']; ?>);"><?php if($r["att"]>=1){?><span class="fa fa-paperclip"></span><?php } echo $r['name']; ?></label>
                                    </td>
                                    <td data-title="Correo:"><?php echo $r['email']; ?></td>
                                    <td data-title="Telefono:"><?php echo $r['phone']; ?></td>
                                    <td ata-title="Registrado:"><?php echo date("d-m-Y", strtotime($r['regDate'])); ?></td>
                                    <td data-title="Acci&oacute;n: " align="left">
                                        <a href="javascript:void(0);" title="Agregar Tarea" alt="asignar tarea" onclick="muestratask(<?php echo $r['id']; ?>);"class="btn btn-warning"><span class="fa fa-thumb-tack"></span></a>
                                        <a href="javascript:void(0);" title="Detalles de Contacto" class="btn btn-primary" onclick="showdetail(<?php echo $r['id']; ?>);" alt="Ver detalles de contacto"><span class="fa fa-server"></span></a>
                                        <a href="javascript:void(0);" title="Editar" class="btn btn-info" onclick="editpros(<?php echo $r['id']; ?>);" alt="Editar"><span class="fa fa-edit"></span></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo "<table><tr><td colspan='4'>$err</td></td></table>";
        }
    } else {
        echo "0";
    }
} else {
    echo $err;
}
 