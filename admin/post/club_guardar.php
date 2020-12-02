<?php
include('../../bd/club_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>