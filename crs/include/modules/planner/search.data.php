<?php
include("../../../inc/app.conf.php");
$op = filter_input(INPUT_POST, "op");
switch ($op) {
    case 0:
        $sem = 0;
        $res = 0;
        $gtot = 0;
        $pid = filter_input(INPUT_POST, "idp");
        $di = date("Y-m-d", strtotime(filter_input(INPUT_POST, "d_i")));
        $df = date("Y-m-d", strtotime(filter_input(INPUT_POST, "d_f")));
        $fi = filter_input(INPUT_POST, "d_i");
        $ff = filter_input(INPUT_POST, "d_f");
        $start_ts = strtotime($fi);
        $end_ts = strtotime($ff);
        $diff = $end_ts - $start_ts;
        $ds = round($diff / 86400);
        $tarifa = mysqli_query($CNN, "SELECT a.* FROM crs_rates a INNER JOIN crs_rates_detail b ON (a.`id`=b.rid) WHERE b.pid=20  AND \"$di\" BETWEEN a.date_ini AND a.date_end AND b.pid=$pid")or $err = "Error al traer la tarifa" . mysqli_error($CNN);
        $n_t = mysqli_num_rows($tarifa);
        if ($n_t >= 1) {
            if (!isset($err)) {
                while ($t = mysqli_fetch_array($tarifa)) {
                    if ($ds >= 7) {
                        $sem = floor($ds / 7);
                        $res = ($ds % 7);
                        $gtot = $sem * $t['semanal'];
                        $pds = $t['semanal'] / 7;
                        $pde = $pds * $res;
                        $gtot+=$pde;
                    } else {
                        $gtot = $ds * $t['diario'];
                    }
                    echo "0|" . number_format($gtot, 2) . "|" . $sem . "|" . $res;
                }
            } else {
                echo "1|" . $err;
            }
        } else {
            echo "1|Esta propiedad no tiene ninguna tarifa asignada";
        }
        break;
    case 1:
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Clientes</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="javascript:void(0)" class="btn btn-success" onclick="addcustomer()" ><span class="fa fa-user-plus"></span></a>
                    </div>
                </div>
                <table id="tbl_cust" class="table table-condensed">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td width="80%">Cliente</td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody class="text-capitalize"></tbody>
                </table>
                <!-----------------------TERMINA TABLA DINAMICA------------------->
                <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
                <script>
                    $(document).ready(function () {
                        jTable('tbl_cust', 'include/modules/planner/customer.table.php');
                    });
                </script>
            </div>
        </div>
        <?php
        break;
    case 2:
        $i_cus=  mysqli_query($CNN, "Insert into crs_reserva_customer (nombre,apellido_p,apellido_m,DNI,direccion,localidad,cp,pais,mobile,email)values('".filter_input(INPUT_POST,"c_name")."','".filter_input(INPUT_POST,"c_ap")."','".filter_input(INPUT_POST,"c_am")."','".filter_input(INPUT_POST,"c_dni")."','".filter_input(INPUT_POST,"c_dire")."','".filter_input(INPUT_POST,"c_loc")."','".filter_input(INPUT_POST,"c_cp")."','".filter_input(INPUT_POST,"c_pai")."','".filter_input(INPUT_POST,"c_tel")."','".filter_input(INPUT_POST,"c_email")."')")or $err="Error al Registrar el cliente<br>".mysqli_error($CNN);
        if(!isset($err))
        {
            echo "1";
        }
        else
        {
            echo $err;
        }
        break;
    case 3:
        echo '[{value:"100",label: "comedero"}]';
        break;
}
