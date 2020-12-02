<?php
include('../../bd/ffch_ayuda_social_BD.php');
$respuesta=eliminar( $_POST['idinforme_ayuda_social'] );
echo json_encode($respuesta);
?>