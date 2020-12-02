<?php
include('../../bd/club_BD.php');
$respuesta=eliminar( $_POST['idclub'] );
echo json_encode($respuesta);
?>