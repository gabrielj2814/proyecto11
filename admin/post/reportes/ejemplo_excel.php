<?php
	require_once '../../../phpexcel/Classes/PHPExcel.php';
	include('../../../bd/controlDeCarga_BD.php');
		///////////////////////// DATOS POST ENTRANTE /////////////////////////////////
		$excel_a_cargar = 'plantillas/datos_gps.xls';
		$nombre_documento_salida = "excel_inyectado";
		//echo"Cargando excel a RAM...<br />";
		/////////// CARGAR EXCEL //////////////
		$tipo_documento = PHPExcel_IOFactory::identify($excel_a_cargar);
		$objReader = PHPExcel_IOFactory::createReader($tipo_documento);
		$objPHPExcel = $objReader->load($excel_a_cargar);
		///////// EDITAR EL EXCEL /////////



		$objPHPExcel->setActiveSheetIndex(0); //cambiar paginas

        //hasta aca tenemos cargada la plantilla excel y situados en la pagina 0


	    //echo"->Excel cargado correctamente!<br />";
		
		
for($i=2;$i<=209;$i++){
	//PARA OBTENER UN DATO
    $dato = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue();
    //insertar_datos($dato);	
    //PARA INSERTAR
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'hola');
    
    
    	
   
}
	
///////// EXPORTAR EXCEL /////
		
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("../../reportes_excel/".$nombre_documento_salida.".xlsx");
echo $nombre_documento_salida.".xlsx";





function insertar_datos($dato){
            
            include("../../../bd/conexion.php");
            $link->query("INSERT INTO cargas_externas (
			fecha 
			) VALUES (
			'".$dato."'
			)
            ");
            
            $link->close();
            
            
        }

      

		
		
		
	
?>