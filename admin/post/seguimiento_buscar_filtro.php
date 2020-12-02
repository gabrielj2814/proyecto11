<?PHP
include("../../bd/seguimiento_BD.php");
$respuesta=consultarSeguimiento($_POST);
print(json_encode($respuesta));
?>