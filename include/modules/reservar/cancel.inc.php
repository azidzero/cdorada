<section id="checkout" style="margin-top:120px;">
    <div class="container">
        <h3 class="text-danger">SE HA CANCELADO LA OPERACI&Oacute;N!</h3>
        <?php
        $hash = $_SESSION["paypal_hash"];
        $rid = $_SESSION["rid"];
        $SQL = "DELETE from crs_reserva WHERE hash='$hash'";
        mysqli_query($CNN, $SQL);
        unset($_SESSION["paypal_hash"]);
        $SQL = "DELETE from crs_reserva_customer WHERE rid='$rid'";mysqli_query($CNN, $SQL);
        $SQL = "DELETE from crs_reserva_detail WHERE rid='$rid'";mysqli_query($CNN, $SQL);
        $SQL = "DELETE from crs_reserva_property WHERE rid='$rid'";mysqli_query($CNN, $SQL);
        unset($_SESSION["rid"]);
        ?>
        <a href="./" class="btn btn-primary">Ir al Inicio</a>
    </div>
</section>