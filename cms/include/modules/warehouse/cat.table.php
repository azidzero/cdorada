<?php

include("../../../inc/app.conf.php");
$aColumns = array('id', 'parent', 'name');

$sIndexColumn = "id";
$sTable = "warehouse_cat";
//$owner = $_SESSION["CORE"]["corp"]["id"];
$gaSql['user'] = DBU;
$gaSql['password'] = DBP;
$gaSql['db'] = DBB;
$gaSql['server'] = DBH;

$gaSql['link'] = mysqli_connect($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db']) or
        die('No se encuentra la base de datos ' . $gaSql['db']);

$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . mysqli_real_escape_string($CNN, $_GET['iDisplayStart']) . ", " .
            mysqli_real_escape_string($CNN, $_GET['iDisplayLength']);
}

if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " . mysqli_real_escape_string($CNN, $_GET['sSortDir_' . $i]) . ", ";
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

        $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($_GET['sSearch']) . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
} else {
    $sWhere = "";
}

$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM   $sTable $sWhere $sOrder $sLimit";
$rResult = mysqli_query($CNN, $sQuery) or die("#1 " . $sQuery . "<br/>" . mysqli_error($CNN));

// Data set length after filtering
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysqli_query($CNN, $sQuery) or die("#2 " . $sQuery . "<br/>" . mysqli_error());
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

// Total data set length
$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM $sTable";
$rResultTotal = mysqli_query($CNN, $sQuery) or die("#3 " . $sQuery . "<br/>" . mysqli_error());
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
    $row = array();
    // CODIGO
    if($aRow["parent"]!=0){
    $oq = mysqli_query($CNN, "SELECT * from warehouse_cat WHERE id={$aRow['parent']}");
    while ($or = mysqli_fetch_array($oq)) {
        $parent = $or["name"];
    }
    }else{
        $parent = "<strong>Principal</strong>";
    }
    $row[0] = $parent;
    $row[1] = $aRow["name"];
    $row[2] = '<div class="btn-group btn-group-sm">';
    $row[2] .= '<a href="./?m=warehouse&s=cat&o=3&id=' . $aRow[0] . '" class="btn btn-primary" title="Editar"><i class="fa fa-edit"></i></a>';
    $row[2] .= '<a href="./?m=warehouse&s=cat&o=5&id=' . $aRow[0] . '" class="btn btn-danger" title="Eliminar"><i class="fa fa-trash-o"></i></button>';
    $row[2] .= '</div>';
    $output['aaData'][] = $row;
}

echo json_encode($output);
?>