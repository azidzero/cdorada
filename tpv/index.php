<?php

include_once('Sermepa/Tpv/Tpv.php');
try {
    //Key de ejemplo
    $key = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';
    // $key = 'MlnjbStR+KXmu/6SpYPG4wKoksQ7e6mg';

    $redsys = new Sermepa\Tpv\Tpv();
    $redsys->setAmount(rand(10, 600));
    $redsys->setOrder(time());
    // $redsys->setMerchantcode('332365451'); //Reemplazar por el código que proporciona el banco
    $redsys->setMerchantcode('999008881'); //Reemplazar por el código que proporciona el banco
    $redsys->setCurrency('978');
    $redsys->setTransactiontype('0');
    $redsys->setTerminal('01');
    // $redsys->setNotification('http://cdorada.quiroti.com.mx/tpv/complete.php'); //Url de notificacion
    $redsys->setUrlOk('http://cdorada.quiroti.com.mx/tpv/complete.php'); //Url OK
    $redsys->setUrlKo('http://cdorada.quiroti.com.mx/tpv/complete.php'); //Url KO
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
