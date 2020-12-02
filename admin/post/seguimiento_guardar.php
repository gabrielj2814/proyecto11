<?PHP
include("../../bd/seguimiento_BD.php");
$modalidad=guardar($_POST);
if($modalidad["modalidad"]==="2"){
    if(array_key_exists("array_fecha_detalle_atencion",$_POST)){
        for($contador=0;$contador<sizeof($_POST["array_fecha_detalle_atencion"]);$contador++){
            $fecha=$_POST["array_fecha_detalle_atencion"][$contador];
            $centro=$_POST["array_centro_atencion_detalle_atencion"][$contador];
            $detalle=$_POST["array_detalle_atencion"][$contador];
            guardarDetallesAtencion($_POST,$fecha,$centro,$detalle,$modalidad["id"]);
        }
    }
}
if($modalidad["id"]!=NULL){
    $respuesta=["estado"=>true,"respuesta"=>$modalidad["id"]];
}
else{
    $respuesta=["estado"=>false,"respuesta"=>0];
}
print(json_encode($respuesta))
// print_r($_POST);

?>