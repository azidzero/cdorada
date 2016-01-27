<?php

include("../../../inc/app.conf.php");

$page = $_REQUEST["page"];

$limit = 25;
$start = ($page - 1) * $limit;

$q = mysqli_query($CNN, "SELECT * from cms_property LIMIT $start,$limit");
$pro = array();
while ($r = mysqli_fetch_array($q)) {
    $row = array();
    $row['id'] = $r["id"];
    $row['title'] = utf8_encode($r["title"]);
    $row['room'] = $r["dorm"];
    $row['capacity'] = $r["capacity"];
    $pro[]=$row;
}
$response = array();
$response['pro'] = $pro;
echo json_encode($response);