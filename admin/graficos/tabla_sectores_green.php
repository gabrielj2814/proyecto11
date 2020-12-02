<?php
	header("Content-type: text/json");
	$path = '../../grassanalytics/Huinganal/RealTime/paquete.json';
	if(file_exists($path)){
		$json = json_decode(file_get_contents($path), true);
		$paquete = array();
		$temperatura_array = array();
		$humedad_array = array();
		$hoyo = array();
		if($json){
			$ultima_medicion=count($json)-1;
			for($i=1;$i<=18;$i++){
				
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_T'][0])){
					array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][0]));
				}else{
					array_push($temperatura_array, -99);
				}
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_T'][1])){
					array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][1]));
				}else{
					array_push($temperatura_array, -99);
				}
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_T'][2])){
					array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][2]));
				}else{
					array_push($temperatura_array, -99);
				}
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_T'][3])){
					array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][3]));
				}else{
					array_push($temperatura_array, -99);
				}
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_T'][4])){
					array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][4]));
				}else{
					array_push($temperatura_array, -99);
				}
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_H'][0])){
					array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][0]));
				}else{
					array_push($humedad_array, -99);
				}
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_H'][1])){
					array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][1]));
				}else{
					array_push($humedad_array, -99);
				}
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_H'][2])){
					array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][2]));
				}else{
					array_push($humedad_array, -99);
				}
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_H'][3])){
					array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][3]));
				}else{
					array_push($humedad_array, -99);
				}
				if(isset($json[$ultima_medicion]['Hoyo'.$i.'_H'][4])){
					array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][4]));
				}else{
					array_push($humedad_array, -99);
				}
				/*
				array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][0]));
				array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][1]));
				array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][2]));
				array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][3]));
				array_push($temperatura_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_T'][4]));
				array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][0]));
				array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][1]));
				array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][2]));
				array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][3]));
				array_push($humedad_array, floatval($json[$ultima_medicion]['Hoyo'.$i.'_H'][4]));
				*/
				$paquete['green_'.$i.'_T'] = $temperatura_array;
				$paquete['green_'.$i.'_H'] = $humedad_array;
				unset($temperatura_array); 
				unset($humedad_array); 
				$temperatura_array = array(); 
				$humedad_array = array();
			}
			$paquete['datetime'] = $json[$ultima_medicion]['Datetime'];
			echo json_encode($paquete);
		}else{
			echo "Error al abrir json";
		}
	}else{
		echo "No existe";
	}
?>