<html> 
    <body> 
        <?php
        echo "<pre>";
        print_r($_REQUEST);
        echo "</pre>";
        include_once('Sermepa/Tpv/Tpv.php');
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
        ?>
    </body> 
</html> 