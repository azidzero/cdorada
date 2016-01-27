<?php
include_once ('../../../inc/app.conf.php');
if (isset($_REQUEST["reservaid"])) {
    $reservaid = filter_input(INPUT_POST, "reservaid");
    include('load.reserva.php');
} else {
    $reservaid = 0;
    include('new.reserva.php');
}
