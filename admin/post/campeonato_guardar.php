<?php
include('../../bd/campeonato_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>