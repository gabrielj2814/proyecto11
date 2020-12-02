<?php
include('../../bd/cuestionarioM_DB.php');
$respuesta = cuestionario_login($_POST);
echo json_encode($respuesta);
?>
