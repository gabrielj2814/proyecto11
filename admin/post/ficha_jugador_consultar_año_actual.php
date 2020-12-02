<?PHP
include("../../bd/ficha_jugador_DB.php");
$fecha=date_futbolJoven();
$fecha_cortada=explode("-",$fecha);
$respuesta=["ano_actual"=>$fecha_cortada[0]];
print(json_encode($respuesta));
?>