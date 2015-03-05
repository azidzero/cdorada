<?php

include("../../../inc/app.conf.php");
$aColumns = array('id', 'name', 'abbr', 'units', 'isint');
$url = "./?m=warehouse&s=unit";
$sIndexColumn = "id";
$iu = "";
$sTable = "core_um";

$gaSql['user'] = SQL_U;
$gaSql['password'] = SQL_P;
$gaSql['db'] = SQL_B;
$gaSql['server'] = SQL_H;

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
    $row[0] = $aRow[0];
    $row[1] = $aRow[1];
    $row[2] = $aRow[2];
    $row[3] = $aRow[3];
    if ($aRow[4] == 1) {
        $row[4] = "Si";
    } else {
        $row[4] = "No";
    }
    $row[5] = '<div class="btn-group">
    <a href="' . $url . '&o=3&pid=' . $aRow[0] . '" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a>
    <a href="' . $url . '&o=5&pid=' . $aRow[0] . '" title="Eliminar" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>    
    </div>';
    $output['aaData'][] = $row;
}

echo json_encode($output);
?>