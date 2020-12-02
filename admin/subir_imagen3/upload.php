<?php

//upload.php


if(isset($_POST["image"])){
	//echo $_POST["image"]
	$data = $_POST["image"];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = 'buffer_imagen.png';
	file_put_contents($imageName, $data);
	//echo '<img src="subir_imagen3/'.$imageName.'" class="img-thumbnail" />';
	echo "subir_imagen3/".$imageName;
	
}

?>