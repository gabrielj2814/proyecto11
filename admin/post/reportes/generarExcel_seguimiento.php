<?php
require_once '../../../phpexcel/Classes/PHPExcel.php';
include("../../../bd/seguimiento_BD.php");

///////////////////////// DATOS POST ENTRANTE /////////////////////////////////

$excel_a_cargar = 'plantillas/excel_seguromedico_seguimiento_sw.xls';
$nombre_documento_salida = "excel_seguimiento";

//echo"Cargando excel a RAM...<br />";
/////////// CARGAR EXCEL //////////////

$tipo_documento = PHPExcel_IOFactory::identify($excel_a_cargar);
$objReader = PHPExcel_IOFactory::createReader($tipo_documento);
$objPHPExcel = $objReader->load($excel_a_cargar);

///////// EDITAR EL EXCEL /////////

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue("c2",$_POST["fecha_completa"]);
$inicio_numero_fila_libre_accion=37;
$contador_libre_eleccion=1;
$inicio_numero_fila_coordinada=8;
$contador_coordinada=1;
for($contador=0;$contador<sizeof($_POST["array_id_seguimiento"]);$contador++){
	$seguimiento=consultarSeguimientoId($_POST["array_id_seguimiento"][$contador]);
	$nombre_jugador=$seguimiento[0]["nombre"]." ".$seguimiento[0]["apellido1"]." ".$seguimiento[0]["apellido2"];
	if($seguimiento[0]["modalidad_seguimiento"]==="1"){
		// respuestaSiNo
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue("B".$inicio_numero_fila_libre_accion,$contador_libre_eleccion)
		->setCellValue("C".$inicio_numero_fila_libre_accion,$nombre_jugador)
		->setCellValue("D".$inicio_numero_fila_libre_accion,mostrarSaludJugador($seguimiento[0]["prevision"]))
		->setCellValue("E".$inicio_numero_fila_libre_accion,$seguimiento[0]["diagnostico_seguimiento"])
		->setCellValue("F".$inicio_numero_fila_libre_accion,$seguimiento[0]["numero_caso_seguimiento"])
		->setCellValue("G".$inicio_numero_fila_libre_accion,formatoDDMMAAAA($seguimiento[0]["fecha_accidente_seguimiento"]))
		->setCellValue("H".$inicio_numero_fila_libre_accion,formatoDDMMAAAA($seguimiento[0]["fecha_denuncia_seguimiento"]))
		->setCellValue("I".$inicio_numero_fila_libre_accion,formatoDDMMAAAA($seguimiento[0]["fecha_plazo_maximo_30_seguimiento"]))
		->setCellValue("J".$inicio_numero_fila_libre_accion,respuestaSiNo($seguimiento[0]["pendiente_ano_anterior_seguimiento"]))
		->setCellValue("K".$inicio_numero_fila_libre_accion,respuestaSiNo($seguimiento[0]["entrega_documento_seguimiento"]))
		->setCellValue("L".$inicio_numero_fila_libre_accion,respuestaSiNo($seguimiento[0]["continuidad_tratamiento_seguimiento"]))
		->setCellValue("M".$inicio_numero_fila_libre_accion,formatoDDMMAAAA($seguimiento[0]["fecha_plazo_maximo_90_seguimiento"]))
		->setCellValue("N".$inicio_numero_fila_libre_accion,formatoDDMMAAAA($seguimiento[0]["fecha_plazo_maximo_180_seguimiento"]))
		->setCellValue("O".$inicio_numero_fila_libre_accion,formatoDDMMAAAA($seguimiento[0]["fecha_plazo_reembolzo_seguimiento"]));
		$contador_libre_eleccion++;
		$inicio_numero_fila_libre_accion++;
	}
	elseif($seguimiento[0]["modalidad_seguimiento"]==="2"){
		$lista_campo_excel=[
			"L",
			"M",
			"N",
			"O",
			"P",
			"Q",
			"R",
			"S",
			"T",
			"U",
			"V"
		];
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue("B".$inicio_numero_fila_coordinada,$contador_coordinada)
		->setCellValue("C".$inicio_numero_fila_coordinada,$nombre_jugador)
		->setCellValue("D".$inicio_numero_fila_coordinada,mostrarSaludJugador($seguimiento[0]["prevision"]))
		->setCellValue("E".$inicio_numero_fila_coordinada,$seguimiento[0]["diagnostico_seguimiento"])
		->setCellValue("F".$inicio_numero_fila_coordinada,$seguimiento[0]["numero_caso_seguimiento"])
		->setCellValue("G".$inicio_numero_fila_coordinada,formatoDDMMAAAA($seguimiento[0]["fecha_denuncia_seguimiento"]))
		->setCellValue("H".$inicio_numero_fila_coordinada,formatoDDMMAAAA($seguimiento[0]["fecha_atencion_seguimiento"]))
		->setCellValue("I".$inicio_numero_fila_coordinada,campoVacio($seguimiento[0]["centro_atencion_seguimiento"]))
		->setCellValue("J".$inicio_numero_fila_coordinada,campoVacio($seguimiento[0]["centro_derivacion_seguimiento"]))
		->setCellValue("K".$inicio_numero_fila_coordinada,campoVacio($seguimiento[0]["medico_tratante_seguimiento"]));
		for($contador2=0;$contador2<sizeof($seguimiento[0]["detalles_atencion_seguimiento"]);$contador2++){
			$dato_celda=$seguimiento[0]["detalles_atencion_seguimiento"][$contador2]["centro_atencion_detalle_atencion_seguimiento"]." ".$seguimiento[0]["detalles_atencion_seguimiento"][$contador2]["fecha_atencion_detalle_atencion_seguimiento"]." hrs";
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue($lista_campo_excel[$contador2].$inicio_numero_fila_coordinada,$dato_celda);
		}
		$contador_coordinada++;
		$inicio_numero_fila_coordinada++;
	}
}





//hasta aca tenemos cargada la plantilla excel y situados en la pagina 0


//echo"->Excel cargado correctamente!<br />";


// for($i=2;$i<=209;$i++){
// 	//PARA OBTENER UN DATO
//     $dato = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue();
//     //insertar_datos($dato);	
//     //PARA INSERTAR
//     $objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'hola');

// }
	
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

function mostrarSaludJugador($prevision){
	$texto_salud=[
		'',
		'Ninguna',
		'Fonasa A',
		'Fonasa B',
		'Fonasa C',
		'Fonasa D',
		'Fonasa C',
		'Isapre Banmedica',
		'Isapre Vida tres',
		'Isapre Colmena',
		'Isapre Consalud',
		'Isapre Cruz blanza',
		'Isapre Nueva Más Vida',
		'Capredena',
		'Dipreca',
		'Isapre Fusat',
		'Isapre Isalud',
		'PRAIS'
	];
	return $texto_salud[(int)$prevision];
}

function formatoDDMMAAAA($fecha){
	$fecha_explotada=explode("-",$fecha);
	return $fecha_explotada[2]."-".$fecha_explotada[1]."-".$fecha_explotada[0];
}

function respuestaSiNo($respuesta){
	$respuesta_estado="";
	if($respuesta==="1"){
		$respuesta_estado="Si";
	}
	elseif($respuesta==="0"){
		$respuesta_estado="No";
	}
	return $respuesta_estado;
}

function campoVacio($campo){
	if($campo===NULL){
		$campo="";
	}
	return $campo;
}


?>