<?php

session_start();
$msconf = "../../../inc/app.conf.php";
if (file_exists($msconf)) {
    include($msconf);
} else {
    die("No se puede cargar la configuracion");
}
// Informacion
if (isset($_REQUEST["store"])) {
    $store = $_REQUEST["store"];
} else {
    $store = 0;
}
if (isset($_REQUEST["cats"])) {
    $cat = $_REQUEST["cats"];
} else {
    $cat = 0;
}
$sql = "SELECT * from warehouse_store";
$sq = mysql_query($sql) or die(mysql_error());
while ($sr = mysql_fetch_array($sq)) {
    $lid = $sr['p_list'];
    $sto_name = $sr['name'];
}

// Crea un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Establecer propiedades
$objPHPExcel->getProperties()
        ->setCreator("Quiro - Tecnologia en Informatica")
        ->setLastModifiedBy("Quiro - Tecnologia en Informatica")
        ->setTitle("Lista de Precios")
        ->setSubject("intranet 1.0.0")
        ->setDescription("Plantilla para actualizar lista de precios")
        ->setKeywords("Excel Office 2007 openxml php QuiroTI")
        ->setCategory("Plantillas");
// Formato
$objPHPExcel->getDefaultStyle()->getFont()->setName('Segoe UI');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
// Agregar Informacion   
/*
 * Hoja de Nuevo Charter
 */

$oSheet = new PHPExcel_Worksheet($objPHPExcel, 'Nuevo');
$objPHPExcel->addSheet($oSheet, 0);
// Informacion
$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'PID')
        ->setCellValue('B1', 'CODIGO DE BARRAS')
        ->setCellValue('C1', 'REFERENCIA')
        ->setCellValue('D1', 'PRODUCTO')
        ->setCellValue('E1', 'DESCRIPCION')
        ->setCellValue('F1', 'PRECIO 1')
        ->setCellValue('G1', 'PRECIO 2')
        ->setCellValue('H1', 'PRECIO 3')
        ->setCellValue('I1', 'PRECIO 4')
        ->setCellValue('J1', 'PRECIO 5')
        ->setCellValue('K1', 'PRECIO 6')
        ->setCellValue('L1', 'MARCA')
        ->setCellValue('M1', 'UNIDAD DE MEDIDA')
        ->setCellValue('N1', 'MINIMO')
        ->setCellValue('O1', 'MAXIMO')        
;
$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);

$styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => 'FF333333'),),),);
$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray($styleArray);
$sql = "SELECT * FROM warehouse_product";
$osql = "";
if ($store != "0") {
    $osql .= " WHERE store like '%$store%'";
}
if ($cat != "0") {
    if ($osql == "") {
        $osql = " WHERE cat='$cat'";
    } else {
        $osql .= " AND cat='$cat'";
    }
}
$osql.= " LIMIT 5000";
$sq = mysql_query($sql . $osql) or die(mysql_error());
$i = 2;
while ($sr = mysql_fetch_array($sq)) {
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $i, $sr["id"])
            ->setCellValue('B' . $i, $sr["barcode"])
            ->setCellValue('C' . $i, $sr["ref"])
            ->setCellValue('D' . $i, $sr["name"])
            ->setCellValue('E' . $i, $sr['pdesc'])
            ->setCellValue('F' . $i, $sr['p_1'])
            ->setCellValue('G' . $i, $sr['p_2'])
            ->setCellValue('H' . $i, $sr['p_3'])
            ->setCellValue('I' . $i, $sr['p_4'])
            ->setCellValue('J' . $i, $sr['p_5'])
            ->setCellValue('K' . $i, $sr['p_6'])
            ->setCellValue('L' . $i, $sr['brand'])
            ->setCellValue('M' . $i, $sr['um'])
            ->setCellValue('N' . $i, $sr['min'])
            ->setCellValue('O' . $i, $sr['max'])            
    ;
    $objPHPExcel->getActiveSheet()->getCell('B' . $i)->setValueExplicit($sr["barcode"], PHPExcel_Cell_DataType::TYPE_STRING);
    $i++;
}
$objPHPExcel->getActiveSheet()->getStyle('A2:O' . ($i - 1))->applyFromArray($styleArray);
// Redimensionar por el contenido de las Celdas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="tarifas.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>
