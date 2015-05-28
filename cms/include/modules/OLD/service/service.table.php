<?php

include("../config.php");

$aColumns = array('id', 'customer', 'phone', 'email', 'nextel', 'status',
    'received_office', 'received_date', 'received_time', 'received_user',
    'delivery_office', 'delivery_date', 'delivery_time', 'delivery_user', 'amount');

$sIndexColumn = "id";
$iu = "";
$sTable = "service_order";

$gaSql['user'] = $dbuser;
$gaSql['password'] = $dbpass;
$gaSql['db'] = $dbbase;
$gaSql['server'] = $dbhost;

$gaSql['link'] = mysql_pconnect($gaSql['server'], $gaSql['user'], $gaSql['password']) or
        die('No se puede conectar al servidor');

mysql_select_db($gaSql['db'], $gaSql['link']) or
        die('No se encuentra la base de datos ' . $gaSql['db']);

$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . mysql_real_escape_string($_GET['iDisplayStart']) . ", " .
            mysql_real_escape_string($_GET['iDisplayLength']);
}

if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
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

        $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
        $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string(EAN13($_GET['sSearch'])) . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
}

$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM   $sTable $sWhere $sOrder $sLimit";
$rResult = mysql_query($sQuery, $gaSql['link']) or die("#1 " . $sQuery . "<br/>" . mysql_error());

/* Data set length after filtering */
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysql_query($sQuery, $gaSql['link']) or die("#2 " . $sQuery . "<br/>" . mysql_error());
$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM $sTable";
$rResultTotal = mysql_query($sQuery, $gaSql['link']) or die("#3 " . $sQuery . "<br/>" . mysql_error());
$aResultTotal = mysql_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];


/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

while ($aRow = mysql_fetch_array($rResult)) {
    $row = array();
    /* ALMACEN */
    $row[0] = $aRow[0]; # ID    
    $row[1] = $aRow[1]; # Cliente    
    $row[2] = $aRow[2]; # Telefono    
    $row[3] = $aRow[3]; # Email    
    $row[4] = $aRow[4]; # Nextel   
    $row[5] = $aRow[6]; # Oficina
    $row[6] = $aRow[7]; # Fecha
    $row[7] = $aRow[8]; # Hora
    $row[8] = $aRow[9]; # Usuario    

    $row[9] = $aRow[5]; # Estado
    $row[10] = $aRow[14]; # Total
    $row[11] = "<div class=\"btn-group\">";
    $row[11].= "<a href=\"./terminal/?m=service&o=3\" class=\"btn\"><i class=\"icon-edit\"></i></a>";
    $row[11].= "</div>";

    $output['aaData'][] = $row;
}

echo json_encode($output);
?>