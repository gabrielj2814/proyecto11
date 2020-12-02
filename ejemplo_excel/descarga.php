<?php
	require_once '../phpexcel/Classes/PHPExcel.php';
	$nombre_documento = "GolfAnalytics_Reporte_De_Amor";
	$titulo_hoja = "Mensaje de amor";
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Hola mi amor!');
	$objPHPExcel->getActiveSheet()->setTitle($titulo_hoja);
	//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	//header('Content-Disposition: attachment;filename="'.$nombre_documento.'.xlsx"');
	//header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter->save('php://output');
	$objWriter->save($nombre_documento.".xlsx");
	echo $nombre_documento.".xlsx";

?>