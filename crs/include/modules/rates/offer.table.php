<?php

include("../../../inc/app.conf.php");
$aColumns = array('id', 'title','date_ini','date_end','diario','semanal','minimo','descu');

$sIndexColumn = array("id","title",'date_ini','date_end');
$sTable = "crs_rates";
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

$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM   $sTable $sWhere $sOrder $sLimit ";
$rResult = mysqli_query($cnn, $sQuery) or die("#1 " . $sQuery . "<br/>" . mysqli_error());

// Data set length after filtering
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysqli_query($cnn, $sQuery) or die("#2 " . $sQuery . "<br/>" . mysqli_error());
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

// Total data set length
$sQuery = "SELECT COUNT(" . $sIndexColumn[1] . ") FROM $sTable";
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
    $row[0] = "<h4>".$aRow['id']."</h4>";
    $traedat=  mysqli_query($CNN, "select title,date_ini,date_end from crs_rates where id={$aRow['id']}");
    while($r=mysqli_fetch_array($traedat))
    {
         $row[1]="<h4><label class=\"label label-info\">".strtoupper($r['title'])."</label></h4>Del: <b>".date("d-m-Y",strtotime($r['date_ini']))."</b> al <b>".date("d-m-Y",strtotime($r['date_end']))."</b>";
    }
   $row[2] = $aRow['minimo']." Noches";
   $row[3] = "€ ".number_format($aRow['diario'],2);
   $row[4] = "€ ".number_format($aRow['semanal'],2);
   $row[5] =$aRow['descu']." %";  
   $row[6] = "<div class=\"btn-group\">";
   $row[6] .= "<button type=\"button\" class=\"btn btn-success dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">Opcion <span class=\"caret\"></span></button >";
   $row[6] .= "<ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">";
   $row[6] .= "<li><a href=\"JavaScript:void(0)\" onclick=\"getJson('{$aRow[0]}','0')\"><i class=\"fa fa-edit\"></i>Editar</a></li>";
   $row[6] .= "<li><a href=\"JavaScript:void(0)\" onclick=\"deltariff('{$aRow[0]}','1')\"><i class=\"fa fa-trash\"></i> Eliminar</a></li>";
   $row[6] .= "<li><a href=\"JavaScript:void(0)\" onclick=\"addtartoprop('{$aRow[0]}')\"><i class=\"fa fa-plus\"></i> Asignar prop</a></li>";
   $row[6] .= "</ul>";
   $row[6] .= "</div>";
   $output['aaData'][] = $row;
}

echo json_encode($output);
?>