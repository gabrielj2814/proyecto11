<?php
include('../../bd/campeonato_BD.php');
$respuesta=eliminar( $_POST['idcampeonato'] );
echo json_encode($respuesta);
?>