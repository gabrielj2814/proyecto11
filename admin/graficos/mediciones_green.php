<?php
	header("Content-type: text/json");
	$GREEN=$_GET['green'];
	$path = '../../grassanalytics/Huinganal/RealTime/paquete.json';
	if(file_exists($path)){
		$json = json_decode(file_get_contents($path), true);
		$paquete = array();
		$temperatura_array = array();
		$humedad_array = array();
		if($json){
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_T'][0])){
				$sensor_T_1=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_T'][0]);
			}else{
				$sensor_T_1=-99;
			}
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_H'][0])){
				$sensor_H_1=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_H'][0]);
			}else{
				$sensor_H_1=-99;
			}
			array_push($temperatura_array, $sensor_T_1);
			array_push($humedad_array, $sensor_H_1);
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_T'][1])){
				$sensor_T_2=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_T'][1]);
			}else{
				$sensor_T_2=-99;
			}
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_H'][1])){
				$sensor_H_2=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_H'][1]);
			}else{
				$sensor_H_2=-99;
			}
			array_push($temperatura_array, $sensor_T_2);
			array_push($humedad_array, $sensor_H_2);
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_T'][2])){
				$sensor_T_3=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_T'][2]);
			}else{
				$sensor_T_3=-99;
			}
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_H'][2])){
				$sensor_H_3=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_H'][2]);
			}else{
				$sensor_H_3=-99;
			}
			array_push($temperatura_array, $sensor_T_3);
			array_push($humedad_array, $sensor_H_3);
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_T'][3])){
				$sensor_T_4=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_T'][3]);
			}else{
				$sensor_T_4=-99;
			}
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_H'][3])){
				$sensor_H_4=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_H'][3]);
			}else{
				$sensor_H_4=-98;
			}
			array_push($temperatura_array, $sensor_T_4);
			array_push($humedad_array, $sensor_H_4);
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_T'][4])){
				$sensor_T_5=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_T'][4]);
			}else{
				$sensor_T_5=-99;
			}
			if(isset($json[count($json)-1]['Hoyo'.$GREEN.'_H'][4])){
				$sensor_H_5=floatval($json[count($json)-1]['Hoyo'.$GREEN.'_H'][4]);
			}else{
				$sensor_H_5=-99;
			}
			array_push($temperatura_array, $sensor_T_5);
			array_push($humedad_array, $sensor_H_5);
			$paquete['datetime']=$json[count($json)-1]['Datetime'];
			$paquete['temperatura']=$temperatura_array;
			$paquete['humedad']= $humedad_array;
			echo json_encode($paquete);
		}else{
			echo "Error al abrir json";
		}
	}else{
		echo "No existe";
	}
?>