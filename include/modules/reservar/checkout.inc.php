<?php

use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Api\Address;
use PayPal\Api\FundingInstrument;
use PayPal\Api\CreditCard;

/*
 * Data Create Customer
 */
$user_name = filter_input(INPUT_POST, "user_name");
$user_last_p = filter_input(INPUT_POST, "user_last_p");
$user_last_m = filter_input(INPUT_POST, "user_last_m");
$user_address = filter_input(INPUT_POST, "user_address");
$user_city = filter_input(INPUT_POST, "user_city");
$user_cp = filter_input(INPUT_POST, "user_cp");
$user_country = filter_input(INPUT_POST, "user_country");
$user_cellphone = filter_input(INPUT_POST, "user_cellphone");
$user_email = filter_input(INPUT_POST, "user_email");
/*
 * Data Documento de Identificacion
 */
$dni_no = filter_input(INPUT_POST, "dni_no");
$dni_tipo = filter_input(INPUT_POST, "dni_tipo");
$dni_date = filter_input(INPUT_POST, "dni_date");
$dni_country = filter_input(INPUT_POST, "dni_country");
$dni_lang = filter_input(INPUT_POST, "dni_lang");

$SQL1 = "INSERT INTO crs_customer('full_name','first_name','last_name','address','city','cp','cellphone','email',
    'dni_number','dni_tipo','dni_exp','dni_nac','dni_lang','origin','extra') VALUES(
    '$user_name','$user_last_p','$user_last_m','$user_address','$user_city','$user_cp','$user_cellphone','$user_email',
    '$dni_no','$dni_tipo','$dni_date','$dni_country','$dni_lang','INTERNET',''";
mysqli_query($CNN, $SQL1) or $e_customer = mysqli_error($CNN);
if (!isset($e_customer)) {
    // OK
    $customer_id = mysqli_insert_id($CNN);
} else {
    echo "<div class=\"alert alert-danger\">";
    echo $e_customer;
    echo "</div>";
}
/*
 * Data Reserva
 */
$pid = filter_input(INPUT_POST, "pid");
$dini = filter_input(INPUT_POST, "reserva_ini");
$dend = filter_input(INPUT_POST, "reserva_end");
$dtotal = filter_input(INPUT_POST, "reserva_total");
$dman = filter_input(INPUT_POST, "reserva_man");
$dkid = filter_input(INPUT_POST, "reserva_kid");
$SQL2 = "INSERT INTO crs_reserva(pid,ini,end,adult,boy,reserva,origen,inquilino,total,status) 
    VALUES('$pid','$dini','$dend','$dman','$dkid','','INTERNET','$customer_id','$dtotal','0')";
mysqli_query($CNN, $SQL2);
$idr = mysqli_insert_id($CNN);


/*
 * Pago
 */

$payment_total = calcPrize($pid, $dini, $dend);
$payment_mode = filter_input(INPUT_POST, "payment_mode");
$total_deposito = filter_input(INPUT_POST, "total_deposito");
?>
<section id="checkout" style="margin-top:120px;">
    <div class="container">
        <h3>CHECKOUT</h3>
        <?php
        $_SESSION["payment"] = $_REQUEST;

        switch ($payment_mode) {
            case 'credit_card':
                try {
                    //Key de ejemplo
                    $key = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
                    // $key = 'MlnjbStR+KXmu/6SpYPG4wKoksQ7e6mg';
                    $redsys = new Sermepa\Tpv\Tpv();
                    $redsys->setAmount($total_deposito);
                    $redsys->setOrder(time());
                    // $redsys->setMerchantcode('332365451'); //Reemplazar por el código que proporciona el banco
                    $redsys->setMerchantcode('999008881'); //Reemplazar por el código que proporciona el banco
                    $redsys->setCurrency('978');
                    $redsys->setTransactiontype('0');
                    $redsys->setTerminal('01');
                    // $redsys->setNotification('http://cdorada.quiroti.com.mx/tpv/complete.php'); //Url de notificacion
                    $redsys->setUrlOk('http://cdorada.quiroti.com.mx/' . $lang . '/reservar/complete/'); //Url OK
                    $redsys->setUrlKo('http://cdorada.quiroti.com.mx/' . $lang . '/reservar/complete/'); //Url KO
                    $redsys->setVersion('HMAC_SHA256_V1');
                    $redsys->setTradeName('PLANET COSTA DORADA');
                    // $redsys->setTitular('Pedro Risco');
                    $redsys->setProductDescription('Compras varias');
                    $redsys->setEnviroment('test'); //Entorno test

                    $signature = $redsys->generateMerchantSignature($key);
                    $redsys->setMerchantSignature($signature);

                    $form = $redsys->createForm();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                echo $form;
                break;
            case 'paypal':
                $pid = filter_input(INPUT_POST, 'pid');
                $reserva_ini = filter_input(INPUT_POST, 'reserva_ini'); // Desde Cuando
                $reserva_end = filter_input(INPUT_POST, 'reserva_end'); // Hasta cuando
                $reserva_total = filter_input(INPUT_POST, 'reserva_total'); // No. noches
                $reserva_man = filter_input(INPUT_POST, 'reserva_man');     // Adultos
                $reserva_kid = filter_input(INPUT_POST, 'reserva_kid');     // Niños

                $user_name = filter_input(INPUT_POST, 'user_name');         // Quien registra
                $user_last_p = filter_input(INPUT_POST, 'user_last_p');     // Apellido paterno
                $user_last_m = filter_input(INPUT_POST, 'user_last_m');     // apellido materno
                $user_dni = filter_input(INPUT_POST, 'user_dni');           // DNI
                $user_address = filter_input(INPUT_POST, 'user_address');   // Direccion
                $user_city = filter_input(INPUT_POST, 'user_city');         // Ciudad
                $user_cp = filter_input(INPUT_POST, 'user_cp');             // CP
                $user_country = filter_input(INPUT_POST, 'user_country');   // Pais
                $user_cellphone = filter_input(INPUT_POST, 'user_cellphone'); // Celular
                $user_email = filter_input(INPUT_POST, 'user_email');       // Email

                $payment_mode = filter_input(INPUT_POST, 'payment_mode');   // Tipo de pago paypal/ credit_card
                $cc_tipo = filter_input(INPUT_POST, 'tipo');                // tipo de tarjeta de credito visa/mastercard/american express/ **
                $cc_number = str_replace(" ", "", filter_input(INPUT_POST, 'number'));  // no. tarjeta
                $cc_first_name = filter_input(INPUT_POST, 'cc-first-name');             // first name
                $cc_last_name = filter_input(INPUT_POST, 'cc-last-name');               // last name
                $cc_expiry = filter_input(INPUT_POST, 'expiry');                        // expira xx/xxxx
                list($cc_ex_month, $cc_ex_year) = explode(' / ', $cc_expiry);
                $cc_cvc = filter_input(INPUT_POST, 'cvc');                              // Cvc

                $total_alojamiento = filter_input(INPUT_POST, 'total_alojamiento');     // total alojamiento
                $total_addon = filter_input(INPUT_POST, 'total_addon');                 // total addon 
                $total_expense = filter_input(INPUT_POST, 'total_expense');             // total gestion
                $total = filter_input(INPUT_POST, 'grand_total');                       // total
                $total_deposito = filter_input(INPUT_POST, 'total_deposito');           // total de deposito

                $q = mysqli_query($CNN, "SELECT cms_property.*,cms_property_locale.name locale FROM cms_property,cms_property_locale WHERE cms_property.id=1 AND cms_property_locale.id=cms_property.location");
                while ($r = mysqli_fetch_array($q)) {
                    $locale = $r["locale"];
                }

                $strCaption = "ALOJAMIENTO EN $locale ";
                $strCaption .= "PARA $reserva_man ADULTO(S)";
                if ($reserva_kid > 0) {
                    $strCaption .= ", Y $reserva_kid MENOR(ES)";
                }
                $strCaption .= " DESDE $reserva_ini HASTA $reserva_end";

                $payer = new Payer();
                $details = new Details();
                $amount = new Amount();
                $transaction = new Transaction();
                $payment = new Payment();
                $redirectUrls = new RedirectUrls();
                $address = new Address();
                $card = new CreditCard();
                $fi = new FundingInstrument();

                $payer->setPaymentMethod($payment_mode);


                /*
                 * PayPal Account
                 */
                $details->setShipping("0.00");
                $details->setTax('0.00');
                $details->setSubtotal($total);

                $amount->setCurrency('EUR')
                        ->setTotal($total)
                        ->setDetails($details);

                $transaction->setAmount($amount)
                        ->setDescription($strCaption);

                $payment->setIntent('sale')
                        ->setPayer($payer)
                        ->setTransactions(array($transaction));


                $redirectUrls->setReturnUrl($paypalUrlComplete);
                $redirectUrls->setCancelUrl($paypalUrlCancel);
                $payment->setRedirectUrls($redirectUrls);
                ?>
                <div id="escapingBallG">
                    <div id="escapingBall_1" class="escapingBallG"></div>
                </div>
                <?php
                try {
                    $res = $payment->create($api);
                    echo "<pre>";
                    $paymentId = $payment->getId();
                    $hash = md5($paymentId);
                    $_SESSION["paypal_hash"] = $hash;
                    $fecha = date("Y-m-d");
                    $time = date("H:i:s");
                    $SQL = "INSERT INTO crs_reserva(fecha,hora,origin,payment_mode,payment_id,hash,status) "
                            . "VALUES('$fecha','$time','online','$payment_mode','{$payment->getId()}','$hash','0')";
                    mysqli_query($CNN, $SQL);
                    $rid = mysqli_insert_id($CNN);
                    $_SESSION["rid"] = $rid;
                    if ($payment_mode == "credit_card") {
                        $status = $payment->getState();
                        if ($status == "approved") {
                            mysqli_query($CNN, "UPDATE crs_reserva SET status='1' WHERE hash='$hash'");
                        }
                        foreach ($payment->getLinks() as $link) {
                            if ($link->getRel() == "self") {
                                $redirectUrl = $link->getHref();
                            }
                            ?>
                            <script>
                                $(document).ready(function () {
                                    window.location.replace("<?php echo $paypalUrlComplete; ?>");
                                });
                            </script>
                            <?php
                        }
                    } else {
                        foreach ($payment->getLinks() as $link) {
                            if ($link->getRel() == "approval_url") {
                                $redirectUrl = $link->getHref();
                            }
                            ?>
                            <script>
                                $(document).ready(function () {
                                    window.location.replace("<?php echo $redirectUrl; ?>");
                                });
                            </script>
                            <?php
                        }
                    }
                    "</pre>";
                } catch (PayPalConnectionException $ex) {
                    echo "<h4>{$ex->getMessage()}</h4>";
                    echo "<pre>";
                    $data = $ex->getTrace();
                    print_r($data);
                    echo "</pre>";
                }
        }
        ?>
    </div>
</section>