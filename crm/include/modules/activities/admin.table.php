<?php
include("../../../inc/app.conf.php");
$aColumns = array('id', 'title', 'category', 'Fecha','Contacto');
$sIndexColumn = "id";
$sTable = "crm_activities";
echo json_decode($sTable);
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

$sQuery = "SELECT a.id, a.title, a.category, CONCAT_WS(' ', a.timeActivity,a.dateActivity) as Fecha, IF(a.typeCompanyOrPerson = 'company',(SELECT b.name FROM crm_company b WHERE a.idCompanyOrPerson = b.id),  (SELECT c.name FROM crm_contact c WHERE a.idCompanyOrPerson = c.id)) AS Contacto  FROM   $sTable a $sWhere $sOrder $sLimit";
//$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM   $sTable $sWhere $sOrder $sLimit";
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

while ($aRow = mysqli_fetch_array($rResult)) {
    $row = array();
    $row[0] = $aRow['id'];
    $row[1] = $aRow['title'];
    $row[2] = $aRow['category'];
    $row[3] = $aRow['Fecha'];
    $row[4] = $aRow['Contacto'];
    
    $row[5] = "<div class=\"btn-group\">";
    $row[5] .= "<button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">Opciones <span class=\"caret\"></span></button >";
    $row[5] .= "<ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">";
   // $row[5] .= "<li><a href=\"./?m=activities&s=admin&o=1&id={$aRow[0]}\"><i class=\"fa fa-edit\"></i> Ver</a></li>";
    $row[5] .= "<li><a href=\"./?m=activities&s=admin&o=2&id={$aRow[0]}\"><i class=\"fa fa-edit\"></i> Terminar</a></li>";
    $row[5] .= "<li><a href=\"./?m=activities&s=admin&o=3&id={$aRow[0]}\"><i class=\"fa fa-trash\"></i> Eliminar</a></li>";
    $row[5] .= "</ul>";
    $row[5] .= "</div>";
    $output['aaData'][] = $row;
}

echo json_encode($output);
