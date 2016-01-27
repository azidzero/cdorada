<?php
include_once("../../../inc/app.conf.php");
$idt=  filter_input(INPUT_POST, "ntk");
$notas=  filter_input(INPUT_POST, "not");
mysqli_query($CNN, "update crm_activities set note_end='$notas',activo=2, endDateActivity=CURRENT_TIMESTAMP WHERE ID=$idt")or $err="Error al finalizar la actividad".mysqli_error($CNN);
if(!isset($err))
{
    echo "1";
}
else
{
    echo $err;
}