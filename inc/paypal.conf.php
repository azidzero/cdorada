<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Paypal\Api\Payer;
use Paypal\Api\Details;
use Paypal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require __DIR__ . '/vendor/autoload.php';
$site = $_SERVER["HTTP_HOST"];
$paypalUrlComplete = "http://$site/" . $lang . "/reservar/complete/";
$paypalUrlCancel = "http://$site/" . $lang . "/reservar/cancel/";
$api = new ApiContext(
        new OAuthTokenCredential(
        'ARAQ7jrxuKbb6zsUfdAWMYQQPmqU6TV9vJr9K5MzAjNZ_UUHVnxJlSbLZhTGw92AWImsu3ILVob-69Xd', 'EPvdjPntzvc3bX16wJRxwElilluhgmvStfzTV3VFOuyfvtTqGLIc5AdCVu3p83idNjkJ-7qGELgbP7U5'
        )
);
$api->setConfig([
    'mode' => 'sandbox',
    'http.ConnectionTimeOut' => 30,
    'log.LogEnabled' => true,
    'log.FileName' => 'paypal.log',
    'log.LogLevel' => 'FINE',
    'validation.level' => 'log'
]);
