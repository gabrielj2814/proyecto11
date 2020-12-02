<?php
	error_reporting(E_ALL | E_WARNING | E_ERROR | E_PARSE); //Elimina todos los warning impresos

	function crear_carpeta_cliente($path){
		$creacion=true;
		if (!file_exists('./'.$path)) {
			if(!mkdir('./'.$path, 0755, true) || 
			   //!mkdir('./'.$path.'/Datetime', 0755, true) || 
			   !mkdir('./'.$path.'/RealTime', 0755, true) || 
			   !mkdir('./'.$path.'/Promedio', 0755, true)){
    			$creacion=false;
			}
		}
		return $creacion;
	}

	function eliminar_ficheros($path){
		$files = glob($path.'/*');
		foreach($files as $file){ 
  			if(is_file($file))
    			unlink($file);
		}
	}

	function insertar_json_realtime($path, $array){
		$maximo_numero_datos=20;
		if(file_exists($path)){
			$array_data = json_decode(file_get_contents($path), true);
			$array_data = array_merge($array_data, $array);
			if(count($array_data)>$maximo_numero_datos){
				array_shift($array_data);
			}
			file_put_contents($path, json_encode($array_data, JSON_PRETTY_PRINT));
		}else{
			file_put_contents($path, json_encode($array, JSON_PRETTY_PRINT));
		}
	}
	
	function guardar_realtime($json, $Cliente){
		foreach ($json->Paquete as $Paquete){
			$fp = fopen($Cliente.'/RealTime/paquete.json', 'a');//lo abre y agrega, sino existe lo crea
			fwrite($fp, json_encode($json->Paquete));
			fclose($fp);
		}
	}

	function consultar_acceso($usuario, $password){
		$user="huinganal@grassanalytics.com";
		$pass="admin123";
		if($usuario==$user && $password==$pass){
			return true;
		}else{
			return false;
		}
	}

	$json = json_decode(file_get_contents("php://input"));
	if($json){
		if(consultar_acceso($json->User, $json->Pass)){
			$Cliente=$json->Cliente;
			if(crear_carpeta_cliente($Cliente)){
				$ip_dispositivo=$_SERVER['REMOTE_ADDR'];
				guardar_realtime($json, $Cliente);
				echo "1";//autentificacion exitosa
			}else{
				echo "0";
			}
		}else{
			echo "0";//autentificacion fallida
		}
	}else{
		echo "no";
		header('Location: ../index.html');
	}
?>