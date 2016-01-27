<div>
    <h4>Tarifas actualmente activas</h4>
    <table class="table table-condensed table-striped">
        <thead>
            <tr>
                <td width="1">Tarifa</td>
                <td width="1">Inicia</td>
                <td width="1">Termina</td>
                <td width="1">Asignado</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $now = date("Y-m-d");
            $q = mysqli_query($CNN, "SELECT a.name,b.date_ini,b.date_end, (SELECT COUNT(c.pid) FROM crs_rates_use c WHERE c.rid =a.id ) AS noprop FROM crs_rates a INNER JOIN crs_rates_detail b ON a.`id`=b.`rid` WHERE '$now' BETWEEN b.date_ini AND b.date_end");
            while ($r = mysqli_fetch_array($q)) {
                ?>
                <tr>
                    <td class="text-uppercase text-success bold"><?php echo $r["name"]; ?></td>
                    <td><?php echo date("d-m-Y",strtotime($r["date_ini"])); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($r["date_end"])); ?></td>
                    <td ><b><?php echo $r["noprop"]; ?></b> Alojamientos</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
//$CORE->home();