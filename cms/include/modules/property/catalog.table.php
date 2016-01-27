<?php


$nt = $_REQUEST['ntbl'];

include("../../../inc/app.conf.php");
$aColumns = array('b.aid', 'a.tipo', 'a.valor', 'a.required', 'a.unidad', 'a.valor', 'b.caption', 'b.lang');

$sIndexColumn = "id";
$sTable = "cms_addons a ";
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


$sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM   $sTable inner join cms_addon_translate b on (a.id=b.aid)  $sWhere  and b.tname='$nt' and b.lang='es' $sOrder $sLimit";
$rResult = mysqli_query($cnn, $sQuery) or die("#1 " . $sQuery . "<br/>" . mysqli_error());

// Data set length after filtering
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysqli_query($cnn, $sQuery) or die("#2 " . $sQuery . "<br/>" . mysqli_error());
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];


// Total data set length
$sQuery = "SELECT COUNT(" . $sIndexColumn . ") FROM  $sTable ";
$rResultTotal = mysqli_query($cnn, $sQuery) or die("#3 " . $sQuery . "<br/>" . mysqli_error());
$aResultTotal = mysqli_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];
$iTotal=$iTotal/2;

// Output
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);
$c=1;
while ($aRow = mysqli_fetch_array($rResult)) {
    $row = array();
        $row[0] = $aRow['aid'];
        $row[1] = "<p class='text-uppercase'><b>" . $aRow['caption'] . "</b></p>";
        if ($aRow['tipo'] == 0) {
            $row[2] = "True/False";
        }
        if ($aRow['tipo'] == 1) {
            $row[2] = "Numerico";
        }
        if ($aRow['tipo'] == 2) {
            $row[2] = "Texto";
        }
         if ($aRow['tipo'] == 3) {
            $row[2] = "Multiple";
        }
         if ($aRow['tipo'] == 4) {
            $row[2] = "Cuadro de Texto";
        }
         if ($aRow['tipo'] == 5) {
            $row[2] = "SUMA";
        }
        if ($aRow['required'] == 1) {
            $row[3] = "<b>Requerido</b>";
        } else {
            $row[3] = "No Requerido";
        }
        $row[4] = $aRow['unidad'];
        $row[5] = $aRow['valor'];
        $row[6] = "<div class=\"btn-group\">";
        $row[6] .= "<button type=\"button\" class=\"btn btn-warning dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">Opciones <span class=\"caret\"></span></button >";
        $row[6] .= "<ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">";
        $row[6] .= "<li><a href=\"JavaScript:void(0)\" onclick=\"edit_addon('{$aRow['aid']}','1')\"><i class=\"fa fa-edit\"></i>Editar</a></li>";
         if ($aRow['tipo'] == 5) {
        $row[6] .= "<li><a href=\"JavaScript:void(0)\" onclick=\"issuma('{$aRow[0]}','$nt')\"><i class=\"fa fa-list-ol\"></i>Campos de suma</a></li>";
         }
         $row[6] .= "<li><a href=\"JavaScript:void(0)\" onclick=\"deladon('{$aRow[0]}','3')\"><i class=\"fa fa-trash\"></i> Eliminar</a></li>";
        $row[6] .= "</ul>";
        $row[6] .= "</div>";
        $output['aaData'][] = $row;
        $c++;
    
}
echo json_encode($output);