<?php
include('../../bd/scouting_centro_BD.php');
$respuesta=eliminar_estadistica_informe_scouting( $_POST['idestadistica_informe_csj'] );
echo json_encode($respuesta);
?>