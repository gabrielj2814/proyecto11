<?php
	$id_imagen=$_GET['id'];
	copy('../subir_imagen3/buffer_imagen_jugador.png', '../foto_jugadoresAnalisis/'.$_GET['id'].'.png');
	echo "1";
?>