<?php

include("../../../inc/app.conf.php");
$aColumns = array('id', 'name_es','status','iso_639_1');

$sIndexColumn = "name_es";
$sTable = "cms_translation_lang";
$gaSql['user'] = DBU;
$gaSql['password'] = DBP;
$gaSql['db'] = DBB;
$gaSql['server'] = DBH;
$gaSql['link'] = null;
$gaSql['link'] = mysqli_connect($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['link']) or
        die('No se encuentra la base de datos ' . $gaSql['db']);
$cnn = $gaSql['link'];

$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . mysqli_real_escape_string($cnn, $_GET['iDisplayStart']) . ", " .
            mysqli_real_escape_string($cnn, $_GET['iDisplayLength']);
}

if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " . mysqli_real_escape_string($cnn, $_GET['sSortDir_' . $i]) . ", ";
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

        $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($cnn, $_GET['sSearch']) . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
} else {
    $sWhere = "";
}

$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM   $sTable $sWhere $sOrder $sLimit";
$rResult = mysqli_query($cnn, $sQuery) or die("#1 " . $sQuery . "<br/>" . mysqli_error());

// Data set length after filtering
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysqli_query($cnn, $sQuery) or die("#2 " . $sQuery . "<br/>" . mysqli_error());
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

// Total data set length
$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM $sTable";
$rResultTotal = mysqli_query($cnn, $sQuery) or die("#3 " . $sQuery . "<br/>" . mysqli_error());
$aResultTotal = mysqli_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];


// Output
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

while ($aRow = mysqli_fetch_array($rResult)) 
{
    $row = array();
    $row[0] = $aRow['id'];
    $row[1] = $aRow['name_es'];
    if($aRow[2]==1&&$aRow[0]==14)
    {
        $row[2] ='<input type="checkbox" id="lang_'.$aRow[0].'" name="lang_'.$aRow[0].'" checked="checked" readonly="readonly"onclick="javascript: return false;"/>';
    }
else{
    if($aRow[2]==1)
    {
     $row[2] ='<input type="checkbox" id="lang_'.$aRow[0].'" name="lang_'.$aRow[0].'" checked="checked" onchange="checklanguage('.$aRow[0].',0);"/>';   
    }else{
    $row[2] ='<input type="checkbox" id="lang_'.$aRow[0].'" name="lang_'.$aRow[0].'" onclick="checklanguage('.$aRow[0].',1);" />';
    }
}
$row[3] =  utf8_decode($aRow['iso_639_1']);
    $output['aaData'][] = $row;
}

echo json_encode($output);
?>