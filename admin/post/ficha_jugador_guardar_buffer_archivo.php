<?PHP
	
if($_FILES['archivo_pdf']['name'] == '') { 
  $respuesta = 'Error';
} else {

	if(!file_exists("../temp")){
		mkdir("../temp",0777,true);
	}

	$totalArchivos=$_POST['id_pdf'];
	$extension = end(explode(".", $_FILES['archivo_pdf']['name'])); 
	$upload_folder ='../temp';

	$datos=['.pdf'];

	for ($i=0; $i < 7 ; $i++) { 
		$archivador = $upload_folder . '/' . $totalArchivos. $datos[$i];
		unlink($archivador);
	}

	$nombre_archivo = $_FILES['archivo_pdf']['name'];
	$nombre_archivo = $totalArchivos .'.'. $extension;

	$tipo_archivo = $_FILES['archivo_pdf']['type'];
	$tamano_archivo = $_FILES['archivo_pdf']['size'];
	$tmp_archivo = $_FILES['archivo_pdf']['tmp_name'];
	$archivador = $upload_folder . '/' . $nombre_archivo;

	$respuesta = 'Exitoso';
	if (!move_uploaded_file($tmp_archivo, $archivador)) {
	    
	    $respuesta = 'Error';

	}else{
	    $respuesta = 'Exitoso';
	}
	
}

echo $respuesta;

?>