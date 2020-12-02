<?php
	$path = 'Huinganal/RealTime/paquete.json';
	if(file_exists($path)){
		$json = json_decode(file_get_contents($path), true);
		if($json){
			echo "Numero de mediciones: ".count($json);
			echo "<br>";
			foreach($json as $dato){
				echo $dato['Datetime'];
				echo "<br>";
			}	
			//echo $json[0]['Datetime'];
			//print_r($json);
	
		}else{
			echo "Error al abrir json";
		}
	}else{
		echo "No existe";
	}

echo("<meta http-equiv='refresh' content='1'>")
?>