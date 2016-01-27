
<h4>Reservas Registradas</h4>
<table class="table table-condensed">
    <thead>
        <tr style="font-weight: bold;background-color:#FFF;">
            <td>ID</td>
            <td>Fecha</td>
            <td>Hora</td>
            <td>Origen</td>
            <td>Forma de Pago</td>
            <td>Referencia</td>
            <td>Estado</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $q = mysqli_query($CNN, "SELECT * from crs_reserva order by id DESC limit 10");
        while ($r = mysqli_fetch_array($q)) {
            ?>
            <tr>
                <td><?php echo $r['id']; ?></td>
                <td><?php echo $r['fecha']; ?></td>
                <td><?php echo $r['hora']; ?></td>
                <td><?php echo $r['origin']; ?></td>
                <td><?php echo $r['payment_mode']; ?></td>
                <td><?php echo $r['payment_id']; ?></td>
                <td><?php
                    $s = $r['status'];
                    switch ($s) {
                        case '0':
                            echo "<i class=\"text-warning fa fa-clock-o\"></i>";
                            break;
                        case '1':
                            echo "<i class=\"text-success fa fa-check-square\"></i>";
                            break;
                        case '9':
                            echo "<i class=\"text-danger fa fa-times-circle-o\"></i>";
                            break;
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>