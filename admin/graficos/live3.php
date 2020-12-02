<?php
	header("Content-type: text/json");
	include('../../config/datos.php');
	$CONFIGURACION_HORA=-3; //Se le restan 3 horas a la hora del sistema
	//echo date_default_timezone_get();
	$NUMERO_DATOS=$_GET['datos'];
	$GREEN=$_GET['green'];
	$path = '../../grassanalytics/Huinganal/RealTime/paquete.json';
	if(file_exists($path)){
		$json = json_decode(file_get_contents($path), true);
		$paquete = array();
		$temperatura_array = array();
		$humedad_array = array();
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
				$contador_T=0;
				$contador_H=0;
				$suma_T=0;
				$suma_H=0;
				if($sensores_green[$GREEN][0]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][0])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][0]))){
						$sensor_T_1=floatval($json[$i]['Hoyo'.$GREEN.'_T'][0]);
						$suma_T=$suma_T + $sensor_T_1;
						$contador_T++;
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][0])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][0]))){
						$sensor_H_1=floatval($json[$i]['Hoyo'.$GREEN.'_H'][0]);
						$suma_H=$suma_H + $sensor_H_1;
						$contador_H++;
					}
					//echo "SensorT_1: ".$sensor_T_1;
				}
				if($sensores_green[$GREEN][1]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][1])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][1]))){
						$sensor_T_2=floatval($json[$i]['Hoyo'.$GREEN.'_T'][1]);
						$suma_T=$suma_T + $sensor_T_2;
						$contador_T++;
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][1])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][1]))){
						$sensor_H_2=floatval($json[$i]['Hoyo'.$GREEN.'_H'][1]);
						$suma_H=$suma_H + $sensor_H_2;
						$contador_H++;
					}
					//echo "SensorT_2: ".$sensor_T_2;
				}
				if($sensores_green[$GREEN][2]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][2])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][2]))){
						$sensor_T_3=floatval($json[$i]['Hoyo'.$GREEN.'_T'][2]);
						$suma_T=$suma_T + $sensor_T_3;
						$contador_T++;
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][2])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][2]))){
						$sensor_H_3=floatval($json[$i]['Hoyo'.$GREEN.'_H'][2]);
						$suma_H=$suma_H + $sensor_H_3;
						$contador_H++;
					}
					//echo "SensorT_3: ".$sensor_T_3;
				}
				if($sensores_green[$GREEN][3]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][3])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][3]))){
						$sensor_T_4=floatval($json[$i]['Hoyo'.$GREEN.'_T'][3]);
						$suma_T=$suma_T + $sensor_T_4;
						$contador_T++;
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][3])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][3]))){
						$sensor_H_4=floatval($json[$i]['Hoyo'.$GREEN.'_H'][3]);
						$suma_H=$suma_H + $sensor_H_4;
						$contador_H++;
					}
					//echo "SensorT_4: ".$sensor_T_4;
				}
				if($sensores_green[$GREEN][4]==1){
					if(intval($json[$i]['Hoyo'.$GREEN.'_T'][4])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_T'][4]))){
						$sensor_T_5=floatval($json[$i]['Hoyo'.$GREEN.'_T'][4]);
						$suma_T=$suma_T + $sensor_T_5;
						$contador_T++;
					}
					if(intval($json[$i]['Hoyo'.$GREEN.'_H'][4])!=-99 && !empty(intval($json[$i]['Hoyo'.$GREEN.'_H'][4]))){
						$sensor_H_5=floatval($json[$i]['Hoyo'.$GREEN.'_H'][4]);
						$suma_H=$suma_H + $sensor_H_5;
						$contador_H++;
					}
					//echo "SensorT_5: ".$sensor_T_5;
				}
				if($contador_H!=0){
					$y = ($suma_H) / $contador_H;
					$aux = array($x, $y);
					array_push($humedad_array, $aux);
				}
				if($contador_T!=0){
					$y = ($suma_T) / $contador_T;
					$aux = array($x, $y);
					array_push($temperatura_array, $aux);
				}
			}
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