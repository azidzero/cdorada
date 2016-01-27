<?php

include("../../../inc/app.conf.php");
$aColumns = array('id', 'name', 'contactType', 'Actividades');
$sIndexColumn = "id";
$sTable = "crm_customer";
$gaSql['user'] = DBU;
$gaSql['password'] = DBP;
$gaSql['db'] = DBB;
$gaSql['server'] = DBH;
$gaSql['link'] = null;

$gaSql['link'] = mysqli_connect($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['link']) or die('No se encuentra la base de datos ' . $gaSql['db']);
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

$sQuery = "SELECT a.id, a.name, a.contactType, IFNULL((SELECT CONCAT_WS(' ',b.category,  b.dateActivity, b.timeActivity) FROM crm_activities b WHERE b.idCompanyOrPerson = a.id and b.activo='SI' GROUP BY a.id LIMIT 1), '') AS Actividades  FROM   $sTable a $sWhere $sOrder $sLimit";
$rResult = mysqli_query($cnn, $sQuery) or die("#1 " . mysqli_error($cnn) . " - " . $sQuery . "<br/>" . mysqli_error());

// Data set length after filtering
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysqli_query($cnn, $sQuery) or die("#2: " . mysqli_error($cnn) . " - " . $sQuery . "<br/>" . mysqli_error());
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
    $row[1] = $aRow['name'];
    switch ($aRow['contactType']) {
        /*
          <option value="0">Prospecto</option>
          <option value="1">No identificado</option>
          <option value="2">Cliente</option>
          <option value="3">Proovedor</option>
          <option value="4">Socio</option>
          <option value="5">Competencia</option>
         * 
         */
        case 0:$row[2]="Prospecto";break;
        case 1:$row[2]="No identificado";break;
        case 2:$row[2]="Cliente";break;
        case 3:$row[2]="Proveedor";break;
        case 4:$row[2]="Socio";break;
        case 5:$row[2]="Compentencia";break;
    }    
    $row[3] = $aRow['Actividades'];

    $row[4] = "<div class=\"btn-group\">";
    $row[4] .= "<button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">Opciones <span class=\"caret\"></span></button >";
    $row[4] .= "<ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">";
    $row[4] .= "<li><a href=\"./?m=crm&s=customer&o=3&id={$aRow[0]}\"><i class=\"fa fa-edit\"></i> Editar</a></li>";
    $row[4] .= "<li><a href=\"./?m=crm&s=customer&o=5&id={$aRow[0]}\"><i class=\"fa fa-trash\"></i> Eliminar</a></li>";
    $row[4] .= "</ul>";
    $row[4] .= "</div>";
    $output['aaData'][] = $row;
}

echo json_encode($output);
