<?php

include("../../../inc/app.conf.php");

$id = filter_input(INPUT_POST, "id");
$field = filter_input(INPUT_POST, "field");
$value = filter_input(INPUT_POST, "value");
$json = array();
if ($id == "0") {
    // # NEW
    mysqli_query($CNN, "INSERT INTO crm_customer($field) VALUES('$value')") or $e = mysqli_errno($CNN) . ": " . mysqli_error($CNN);
    if (!isset($e)) {
        $id = mysqli_insert_id($CNN);
        $status = "OK";
        $message = "ACTUALIZADO!";
    } else {
        $id = "0";
        $status = "ERROR";
        $message = $e;
    }
} else {
    mysqli_query($CNN, "UPDATE crm_customer SET $field='$value' WHERE id='$id'") or $e = mysqli_errno($CNN) . ": " . mysqli_error($CNN);
    if (!isset($e)) {
        $status = "OK";
        $message = "ACTUALIZADO!";
    } else {
        $status = "ERROR";
        $message = $e;
    }
}
$json['id'] = $id;
$json['status'] = $status;
$json['message'] = $message;
echo json_encode($json);
