<?php
include('../../bd/informe_carga_BD.php');
$respuesta=ver_informe_carga_filtro_id( $_POST['id_informe_carga'] );
echo json_encode($respuesta);
?>