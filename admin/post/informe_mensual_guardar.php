<?PHP
include("../../bd/informe_mensual_DB.php");
// print_r($_POST);
$respuesta=guardar($_POST);
$contador_0=0;
while($contador_0<sizeof($_POST["array_checkbox_mes_formulario_mensual"])){
    $serie=$_POST["array_checkbox_mes_formulario_mensual"][$contador_0];
    guardar_mes($serie,$_POST,$respuesta["id"]);
    $contador_0++;
}
$contador_1=0;
while($contador_1<sizeof($_POST["array_checkbox_area_formulario_mensual"])){
    $area=$_POST["array_checkbox_area_formulario_mensual"][$contador_1];
    guardar_area($area,$_POST,$respuesta["id"]);
    $contador_1++;
}
$contador_2=0;
while($contador_2<sizeof($_POST["array_checkbox_serie_formulario_mensual"])){
    $serie=$_POST["array_checkbox_serie_formulario_mensual"][$contador_2];
    guardar_serie($serie,$_POST,$respuesta["id"]);
    $contador_2++;
}
$respuesta_servidor=["respuesta_servidor"=>$respuesta["respuesta"]];
print(json_encode($respuesta_servidor));

?>