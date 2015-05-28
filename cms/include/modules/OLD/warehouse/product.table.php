<?php

include("../../../inc/app.conf.php");
$aColumns = array('id', 'barcode', 'ref', 'name', 'pdesc', 'p_1', 'p_2', 'p_3', 'p_4', 'p_5', 'p_6', 'brand', 'um', 'store', 'units', 'min', 'max', 'pid', 'expire', 'granel', 'cat', 'isService');

$sIndexColumn = "id";
$sTable = "warehouse_product";
// $owner = $_SESSION["CORE"]["corp"]["id"];
$gaSql['user'] = SQL_U;
$gaSql['password'] = SQL_P;
$gaSql['db'] = SQL_B;
$gaSql['server'] = SQL_H;

$gaSql['link'] = mysqli_connect($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db']);
$cnn = $gaSql['link'];

$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . mysqli_real_escape_string($cnn, $_GET['iDisplayStart']) . ", " .
            mysqli_real_escape_string($gaSql['link'], $_GET['iDisplayLength']);
}

if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " . mysqli_real_escape_string($gaSql['link'],$_GET['sSortDir_' . $i]) . ", ";
        }
    }
    $sOrder = substr_replace($sOrder, "", -2);
    if ($sOrder == "ORDER BY") {
        $sOrder = "";
    }
}

$sWhere = "";
if ($_GET['sSearch'] != "") {
    $sWhere = "WHERE ";
    for ($i = 0; $i < count($aColumns); $i++) {

        $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($_GET['sSearch']) . "%' and owner='$owner' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
} else {
    $sWhere = "WHERE owner='$owner'";
}

$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM   $sTable $sWhere $sOrder $sLimit";
$rResult = mysqli_query($sQuery, $gaSql['link']) or die("#1 " . $sQuery . "<br/>" . mysqli_error());

// Data set length after filtering
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysqli_query($sQuery, $gaSql['link']) or die("#2 " . $sQuery . "<br/>" . mysqli_error());
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

// Total data set length
$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM $sTable";
$rResultTotal = mysqli_query($sQuery, $gaSql['link']) or die("#3 " . $sQuery . "<br/>" . mysqli_error());
$aResultTotal = mysqli_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];


// Output
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

while ($aRow = mysqli_fetch_array($rResult)) {
    $aRow['{campo}']
            
    $row = array();
    // ALMACEN 
    $r = $aRow["store"];
    $data = "";
    $num = 0;
    if (strstr($r, ",") != "") {
        // multi        
        $e = explode(",", $r);
        $f = explode(",", $aRow["units"]);
        $amin = $aRow["min"];
        $amax = $aRow["max"];
        $atotal = 0;
        for ($i = 0; $i < count($e); $i++) {
            $atotal+= $f[$i];
        }
        $data = "<ul class=\"list-unstyled\">";
        for ($i = 0; $i < count($e); $i++) {
            $apor = floatval($f[$i] / $atotal);
            if ($e[$i] != "") {
                $sql = mysqli_query("select * from warehouse_store where id={$e[$i]}") or die("#4 " . $sql . "<br/>" . mysqli_error());
                while ($res = mysqli_fetch_array($sql)) {
                    $store = $res["name"];
                }
                $data.="<li>({$f[$i]})$store<br/>";
                $data.="<div class=\"progress\">";
                $data.="<div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"$apor\" aria-valuemin=\"0\" aria-valuemax=\"$atotal\" style=\"width: $apor%;\"><span class=\"sr-only\"></span></div>";
                $data.="</div>";
                $data.="</li>";
                $num+=$f[$i];
            }
        }
        $data.="</ul>";
    } else {
        if ($r != "0") {
            $data = "<ul class=\"list-unstyled\">";
            if ($r != "") {
                $query = "select * from warehouse_store where id=$r";
                $sql = mysqli_query($query) or die("#5 " . $query . ": " . mysqli_error());
                $n = mysqli_num_rows($sql);
                if ($n > 0) {
                    while ($res = mysqli_fetch_array($sql)) {
                        $store = $res["name"];
                    }
                    $data.= "<li>({$aRow["units"]}) $store</li>";
                }
                $num+=$aRow["units"];
            } else {
                $data.="<li><span class=\"label label-warning\">Sin existencia</span></li>";
            }
            $data.="</ul>";
        } else {
            $data = "<span class=\"label label-warning\">Sin Existencia</span>";
        }
    }
    $row[0] = $data;
    if ($num > 0) {
        $row["DT_RowClass"] = "success";
    } else {
        $row["DT_RowClass"] = "danger";
    }
    // CODIGO
    $row[1] = $aRow["barcode"];
    $row[2] = $aRow["ref"];
    $id = $row[1];
    // NOMBRE
    $row[3] = $aRow["name"]; //utf8_encode($aRow["3"]);
    // DESC.
    $row[4] = utf8_encode($aRow["pdesc"]); //utf8_encode($aRow["4"]);   
    if ($aRow['isService'] == 1) {
        $row[5] = "SERVICIO";
    } else {
        $row[5] = "PRODUCTO";
    }
    $row[6] = '<div class="btn-group btn-group-sm">
    <a href="./?m=warehouse&s=product&o=3&pid=' . $aRow[0] . '" class="btn btn-primary" title="Editar")"><i class="fa fa-edit"></i></a>
    <a href="./?m=warehouse&s=product&o=5&pid=' . $aRow[0] . '" title="Eliminar" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';

    if ($aRow['isService'] == "0") {
        $row[6].='
            <a href="./?m=warehouse&s=product&o=14&pid=' . $aRow[0] . '" title="Movimientos" class="btn btn-default"><i class="glyphicon glyphicon-sort"></i></a>';
    }
    $row[6].='</div>';
    
    $output['aaData'][] = $row;
}

echo json_encode($output);
?>