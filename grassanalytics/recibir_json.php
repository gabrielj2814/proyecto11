<?php
	error_reporting(E_ALL | E_WARNING | E_ERROR | E_PARSE); //Elimina todos los warning impresos
	$MAX_DATOS_REALTIME=20;

	function crear_carpeta_cliente($path){
		$creacion=true;
		if (!file_exists('./'.$path)) {
			if(!mkdir('./'.$path, 0755, true) || 
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
	
	function guardar_datos($json, $Cliente){
		$path_realtime='./'.$Cliente.'/RealTime/paquete.json';
		if(file_exists($Cliente.'/RealTime/paquete.json')){
			$file_content=json_decode(file_get_contents($path_realtime), true);
			$array_insertar=array_merge($file_content, $json->Paquete);
			if(count($array_insertar)>$GLOBALS['MAX_DATOS_REALTIME']){
				$eliminar=count($array_insertar)-$GLOBALS['MAX_DATOS_REALTIME'];
				$array_insertar=array_slice($array_insertar,$eliminar);
			}
		}else{
			$array_insertar=$json->Paquete;
		}
		file_put_contents($path_realtime,json_encode($array_insertar, JSON_PRETTY_PRINT));
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
				guardar_datos($json, $Cliente);
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