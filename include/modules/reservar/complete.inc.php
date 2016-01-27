<?php
$data = $_SESSION["payment"];
$payment_mode = $data["payment_mode"];
?>
<section id="complete" style="margin-top:120px;">
    <div class="container">
        <pre>
            <?php
            print_r($data);
            
            switch ($payment_mode) {
                case 'credit_card':
                    echo "<pre>";
                    print_r($_REQUEST);
                    echo "</pre>";
                    try {
                        $redsys = new Sermepa\Tpv\Tpv();
                        $key = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';

                        $parameters = $redsys->getMerchantParameters($_GET["Ds_MerchantParameters"]);
                        $DsResponse = $parameters["Ds_Response"];
                        $DsResponse += 0;
                        echo "<pre>";
                        print_r($parameters);
                        echo "</pre>";
                        if ($redsys->check($key, $_GET) && $DsResponse <= 99) {
                            //acciones a realizar si es correcto, por ejemplo validar una reserva, mandar un mail de OK, guardar en bbdd o contactar con mensajería para preparar un pedido
                            echo "<h4>OK</h4>";
                        } else {
                            //acciones a realizar si ha sido erroneo
                            echo "<h4>ERROR</h4>";
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                    break;
            }
            /*
              use PayPal\Api\Payment;
              use PayPal\Api\PaymentExecution;
              use PayPal\Exception\PayPalConnectionException;
              $payerId = $_GET["PayerID"];
              $paymentId = getData('crs_reserva', 'id', $_SESSION['rid'], 'payment_id');
              $payment = Payment::get($paymentId, $api);
              $execution = new PaymentExecution();
              $execution->setPayerId($payerId);
              try {
              $payment->execute($execution, $api);
              mysqli_query($CNN, "UPDATE crs_reserva SET status=1 WHERE id='{$_SESSION["rid"]}'");
              } catch (PayPalConnectionException $ex) {
              echo "<pre>";
              print_r($ex);
              echo "</pre>";
              } */
            ?>
        </pre>

        <script>
            $(document).ready(function () {
                // window.location.replace("./<?php echo $lang; ?>/reservar/completed");
            });
        </script>        
        <?php ?>

    </div>
</section>