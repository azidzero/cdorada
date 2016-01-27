<?php

include_once('Sermepa/Tpv/Tpv.php');
try {
    //Key de ejemplo
    $key = 'MlnjbStR+KXmu/6SpYPG4wKoksQ7e6mg';

    $redsys = new Sermepa\Tpv\Tpv();

    $redsys->setAmount(rand(10, 600));
    $redsys->setOrder(rand(time(), 99999999));
    $redsys->setMerchantcode('332365451'); //Reemplazar por el código que proporciona el banco
    $redsys->setCurrency('978');
    $redsys->setTransactiontype('0');
    $redsys->setTerminal('1');
    $redsys->setNotification('http://cdorada.quiroti.com.mx/bbva/complete.php'); //Url de notificacion
    $redsys->setUrlOk('http://cdorada.quiroti.com.mx/bbva/complete.php'); //Url OK
    $redsys->setUrlKo('http://cdorada.quiroti.com.mx/bbva/complete.php'); //Url KO
    $redsys->setVersion('HMAC_SHA256_V1');
    $redsys->setTradeName('PLANET COSTA DORADA');
    $redsys->setTitular('PLANET COSTA DORADA');
    $redsys->setProductDescription('Compras varias');
    $redsys->setEnviroment('test'); //Entorno test

    $signature = $redsys->generateMerchantSignature($key);
    $redsys->setMerchantSignature($signature);

    $form = $redsys->createForm();
} catch (Exception $e) {
    echo $e->getMessage();
}
echo $form;
