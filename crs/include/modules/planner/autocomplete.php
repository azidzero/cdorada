<?php

include("../../../inc/app.conf.php");
$op = $_REQUEST["op"];
$term = trim(strip_tags($_GET['term']));
switch ($op) {
    case 0:
        $result = mysqli_query($CNN, "select id,name,valor from cms_property_extra where name like'%$term%'");
        while ($row = mysqli_fetch_array($result)) {//loop through the retrieved values
            $row["label"] = $row['name'];
            $row["value"] = $row['id'];
            $row["price"] = $row['valor'];
            $row_set[] = $row; //build an array
        }
        echo json_encode($row_set);
        break;
    case 1:
        //print_r($_REQUEST);
        $i = date("y-m-d", strtotime($_REQUEST['i']));
        $f = $_REQUEST['f'];
        $term = trim(strip_tags($_GET['term']));
        $result = mysqli_query($CNN, "SELECT c.id,c.title,b.id AS idoferta,b.title AS oferta FROM crs_rates_detail  a INNER JOIN crs_rates b ON a.rid=b.id INNER JOIN cms_property c ON c.id=a.pid WHERE  '$i'BETWEEN b.date_ini AND b.date_end and c.title like'%$term%'");
        $nor = mysqli_num_rows($result);
        if ($nor >= 1) {
            while ($row = mysqli_fetch_array($result)) {//loop through the retrieved values
                $row["label"] = $row['title'];
                $row["value"] = $row['id'];
                $row["idoferta"] = $row['idoferta'];
                $row_set[] = $row; //build an array
            }
            echo json_encode($row_set);
        } else {
            $row = array();
            $row["label"] = "SIN RESULTADOS";
            $row["value"] = 0;
            $row["idoferta"] = 0;
            $row_set[] = $row; //build an array
            echo json_encode($row_set);
        }
        break;
}