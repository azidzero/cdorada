<?php

session_start();
$uid = $_SESSION["CORE"]["user"]["id"];
$msconf = "../../../inc/app.conf.php";
if (file_exists($msconf)) {
    include($msconf);
} else {
    die("No se puede cargar la configuracion");
}

$aColumns = array('id', 'store_frm', 'store_to', 'date_out', 'uid_send', 'uid_auth', 'uid_get', 'date_get', 'status');

$sIndexColumn = "id";
$iu = "";
$sTable = "warehouse_move";

$gaSql['user'] = SQL_U;
$gaSql['password'] = SQL_P;
$gaSql['db'] = SQL_B;
$gaSql['server'] = SQL_H;
$gaSql['link'] = mysql_pconnect($gaSql['server'], $gaSql['user'], $gaSql['password']) or
        die('No se puede conectar al servidor: ' . mysql_error());

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
    }
    $sWhere = substr_replace($sWhere, "", -3);
} else {
    
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
    $row[0] = "<span class=\"label label-warning\">No existe</span>";
    $sq = mysql_query("select * from warehouse_store where id={$aRow[1]}");
    while ($sr = mysql_fetch_array($sq)) {
        $row[0] = $sr['name'];
    }
    $row[1] = "<span class=\"label label-warning\">No existe</span>";
    $sq = mysql_query("select * from warehouse_store where id={$aRow[2]}");
    while ($sr = mysql_fetch_array($sq)) {
        $row[1] = $sr['name'];
    }
    $row[2] = $aRow[3];

    $sq = mysql_query("select * from core_user where id={$aRow[4]}");
    while ($sr = mysql_fetch_Array($sq)) {
        $row[3] = "{$sr[5]} {$sr[6]} {$sr[7]}";
    }
    $sq = mysql_query("select * from core_user where id={$aRow[5]}");
    while ($sr = mysql_fetch_Array($sq)) {
        $row[4] = "{$sr[5]} {$sr[6]} {$sr[7]}";
    }
    $sq = mysql_query("select * from core_user where id={$aRow[6]}");
    while ($sr = mysql_fetch_Array($sq)) {
        $row[5] = "{$sr[5]} {$sr[6]} {$sr[7]}";
    }

    $row[6] = $aRow[7];
    if ($aRow[8] == 0) {
        $row[7] = "<span class=\"label label-important\">No se ha entregado</span>";
    } else {
        $row[7] = "<span class=\"label label-info\">Entregado</span>";
    }


    $row[8] = '<div class="btn-group btn-group-sm">';


    if ($aRow[6] == $uid) {
        if ($aRow['status'] != 1) {
            $row[8].='<a href="./?m=warehouse&s=move&o=3&id=' . $aRow[0] . '" class="btn btn-primary" title="Editar"><i class="icon-edit"></i></a>';
            $row[8].='<a href="./?m=warehouse&s=move&o=5&id=' . $aRow[0] . '" class="btn btn-danger" title="Eliminar"><i class="icon-trash"></i></a>';
            $row[8].='<a href="./?m=warehouse&s=move&o=7&id=' . $aRow[0] . '" class="btn btn-success" title="Recepcion"><i class=" icon-share"></i></a>';
        }
    }
    $row[8].='<a href="./?m=warehouse&s=move&o=9&id=' . $aRow[0] . '" class="btn btn-default" title="Imprimir"><i class="icon-print"></i></a>';
    $row[8].='</div>';

    $output['aaData'][] = $row;
}

echo json_encode($output);
?>