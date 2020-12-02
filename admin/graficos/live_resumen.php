<?php
	header("Content-type: text/json");
	include('../../config/datos.php');
	$CONFIGURACION_HORA=-3; //Se le restan 3 horas a la hora del sistema
	//echo date_default_timezone_get();
	$NUMERO_DATOS=$_GET['datos'];
	$GREEN=$_GET['green'];
	$path = '../../grassanalytics/Huinganal/AllTime/paquete.json';
	if(file_exists($path)){
		$json = json_decode(file_get_contents($path), true);
		$paquete = array();
		$T_S1= array();
		$T_S2= array();
		$T_S3= array();
		$T_S4= array();
		$T_S5= array();
		$H_S1= array();
		$H_S2= array();
		$H_S3= array();
		$H_S4= array();
		$H_S5= array();
		
		if($json){
			for($i=0;$i<count($json);$i++){
				$x = strtotime($json[$i]['Datetime'].' +'.$CONFIGURACION_HORA.' hours')*1000;
				$sensor_T_1=-99;
				$sensor_T_2=-99;
				$sensor_T_3=-99;
				$sensor_T_4=-99;
				$sensor_T_5=-99;
				$sensor_H_1=-99;
				$sensor_H_2=-99;
				$sensor_H_3=-99;
				$sensor_H_4=-99;
				$sensor_H_5=-99;
				
				if($sensores_green[$GREEN][0]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][0])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][0]))){
						$sensor_H_1=floatval($json[$i]['Hoyo'.$GREEN.'_H'][0]);
						$aux = array($x, $sensor_H_1);
						array_push($H_S1, $aux);
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][0])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][0]))){
						$sensor_T_1=floatval($json[$i]['Hoyo'.$GREEN.'_T'][0]);
						$aux = array($x, $sensor_T_1);
						array_push($T_S1, $aux);
					}
					//echo "SensorT_1: ".$sensor_T_1;
				}
				if($sensores_green[$GREEN][1]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][1])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][1]))){
						$sensor_H_2=floatval($json[$i]['Hoyo'.$GREEN.'_H'][1]);
						$aux = array($x, $sensor_H_2);
						array_push($H_S2, $aux);
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][1])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][1]))){
						$sensor_T_2=floatval($json[$i]['Hoyo'.$GREEN.'_T'][1]);
						$aux = array($x, $sensor_T_2);
						array_push($T_S2, $aux);
					}
					//echo "SensorT_2: ".$sensor_T_2;
				}
				if($sensores_green[$GREEN][2]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][2])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][2]))){
						$sensor_H_3=floatval($json[$i]['Hoyo'.$GREEN.'_H'][2]);
						$aux = array($x, $sensor_H_3);
						array_push($H_S3, $aux);
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][2])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][2]))){
						$sensor_T_3=floatval($json[$i]['Hoyo'.$GREEN.'_T'][2]);
						$aux = array($x, $sensor_T_3);
						array_push($T_S3, $aux);
					}
					//echo "SensorT_3: ".$sensor_T_3;
				}
				if($sensores_green[$GREEN][3]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][3])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][3]))){
						$sensor_H_4=floatval($json[$i]['Hoyo'.$GREEN.'_H'][3]);
						$aux = array($x, $sensor_H_4);
						array_push($H_S4, $aux);
					
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][3])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][3]))){
						$sensor_T_4=floatval($json[$i]['Hoyo'.$GREEN.'_T'][3]);
						$aux = array($x, $sensor_T_4);
						array_push($T_S4, $aux);
						
					}
					//echo "SensorT_4: ".$sensor_T_4;
				}
				if($sensores_green[$GREEN][4]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][4])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][4]))){
						$sensor_H_5=floatval($json[$i]['Hoyo'.$GREEN.'_H'][4]);
						$aux = array($x, $sensor_H_5);
						array_push($H_S5, $aux);
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][4])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][4]))){
						$sensor_T_5=floatval($json[$i]['Hoyo'.$GREEN.'_T'][4]);
						$aux = array($x, $sensor_T_5);
						array_push($T_S5, $aux);
					}
					//echo "SensorT_5: ".$sensor_T_5;
				}
			}
			$paquete['H_S1']=$H_S1;
			$paquete['H_S2']=$H_S2;
			$paquete['H_S3']=$H_S3;
			$paquete['H_S4']=$H_S4;
			$paquete['H_S5']=$H_S5;
			$paquete['T_S1']=$T_S1;
			$paquete['T_S2']=$T_S2;
			$paquete['T_S3']=$T_S3;
			$paquete['T_S4']=$T_S4;
			$paquete['T_S5']=$T_S5;
			//$paquete['humedad']= $humedad_array;
			echo json_encode($paquete);
		}else{
			echo "Error al abrir json";
		}
	}else{
		echo "No existe";
	}
?>