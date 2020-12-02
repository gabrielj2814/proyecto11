<?php
include('../../bd/campeonato_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>