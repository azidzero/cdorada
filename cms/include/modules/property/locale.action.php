<?php
include_once ('../../../inc/app.conf.php');
$pad = filter_input(INPUT_POST, "elegido");
$aqry = "select * from cms_property_locale where parent='$pad'";
$ado = mysqli_query($CNN, $aqry)or $err = mysqli_error($CNN);
$salida = '<option disabled selected></option>';
if (!isset($err)) {
    while ($sd = mysqli_fetch_array($ado)) {
        $salida.='<option value="'.$sd['id'].'">' . strtoupper($sd['name']) . '</option>';
    }
    echo $salida;
}
else
{
    echo $err;
}

