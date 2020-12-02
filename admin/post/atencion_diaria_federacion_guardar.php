<?PHP
include("../../bd/atencion_diaria_federacion_BD.php");
// print_r($_POST);
if(array_key_exists("indique_incidente",$_POST)){
    if($_POST["indique_incidente"]!=""){
        $_POST["contexto_incidente_formulario"]=registrarContextoIncidente($_POST);
    }
}
$id_atencion_diaria=guardarAtencionDiaria($_POST);
if(array_key_exists("array_checkbox_tratamiento_aplicado_atencion_diaria",$_POST)){
    for($contador=0;$contador<sizeof($_POST["array_checkbox_tratamiento_aplicado_atencion_diaria"]);$contador++){
        $tratamiento=$_POST["array_checkbox_tratamiento_aplicado_atencion_diaria"][$contador];
        registrarTratamientoAtencionDiaria($_POST,$tratamiento,$id_atencion_diaria);
    }
}

if(array_key_exists("array_checkbox_trabajo_readaptador_atencion_diaria",$_POST)){
    for($contador3=0;$contador3<sizeof($_POST["array_checkbox_trabajo_readaptador_atencion_diaria"]);$contador3++){
        $trabajo_readaptador=$_POST["array_checkbox_trabajo_readaptador_atencion_diaria"][$contador3];
        registrarTrabajoRedaptorAtencionDiaria($_POST,$trabajo_readaptador,$id_atencion_diaria);
    }
}

if(array_key_exists("array_recomendacion_alta",$_POST)){
    for($contador4=0;$contador4<sizeof($_POST["array_recomendacion_alta"]);$contador4++){
        $recomendacion_alta=$_POST["array_recomendacion_alta"][$contador4];
        registrarRecomendacionesAltaAtencionDiaria($_POST,$recomendacion_alta,$id_atencion_diaria);
    }
}

if(array_key_exists("array_checkbox_alta_deportiva_atencion_diaria",$_POST)){
    if(sizeof($_POST["array_checkbox_alta_deportiva_atencion_diaria"])>0){
        for($contador5=0;$contador5<sizeof($_POST["array_checkbox_alta_deportiva_atencion_diaria"]);$contador5++){
            $alta_deportiva=$_POST["array_checkbox_alta_deportiva_atencion_diaria"][$contador5];
            registrarAltaDeportiva($_POST,$alta_deportiva,$id_atencion_diaria);
        }
    }
}
// print_r($_POST["codigo_cuerpo_frente"]);

if(array_key_exists("array_codigo_cuerpo_frente",$_POST)){
    if(sizeof($_POST["array_codigo_cuerpo_frente"])>0){
        for($contador6=0;$contador6<sizeof($_POST["array_codigo_cuerpo_frente"]);$contador6++){
            $codigo="frt-".$_POST["array_codigo_cuerpo_frente"][$contador6];
            $zona=$_POST["array_zona_cuerpo_frente"][$contador6];
            registrarLesionesCuerpo($_POST,$codigo,$zona,$id_atencion_diaria);
        }
    }
}


if(array_key_exists("array_codigo_cuerpo_tracera",$_POST)){
    if(sizeof($_POST["array_codigo_cuerpo_tracera"])>0){
        for($contador6=0;$contador6<sizeof($_POST["array_codigo_cuerpo_tracera"]);$contador6++){
            $codigo="bck-".$_POST["array_codigo_cuerpo_tracera"][$contador6];
            $zona=$_POST["array_zona_cuerpo_tracera"][$contador6];
            registrarLesionesCuerpo($_POST,$codigo,$zona,$id_atencion_diaria);
        }
    }
}

if(array_key_exists("array_examen_solicitado",$_POST)){
    if($_POST["examen_solicitado"]==="1"){
        for($contador2=0;$contador2<sizeof($_POST["array_examen_solicitado"]);$contador2++){
            $examen=$_POST["array_examen_solicitado"][$contador2];
            registrarExamenesSolicitadosAtencionDiaria($_POST,$examen,$id_atencion_diaria);
        }
    }
}

if(array_key_exists("array_recomendacion",$_POST)){
    for($contador7=0;$contador7<sizeof($_POST["array_recomendacion"]);$contador7++){
        $numero=$_POST["array_recomendacion"][$contador7];
        if($numero==="1"){
            $fecha_reposo=$_POST["1_reposo_deportivo"];
            registrarRecomendacionConfecha($numero,$id_atencion_diaria,$fecha_reposo,$_POST);
        }
        else if($numero==="2"){
            $fecha_reposo=$_POST["2_reposo_total"];
            registrarRecomendacionConfecha($numero,$id_atencion_diaria,$fecha_reposo,$_POST);
        }
        else{
            registrarRecomendacionSinfecha($numero,$id_atencion_diaria,$_POST);
        }

    }
}

if($id_atencion_diaria!=NULL){
    $respuesta=["estado"=>true,"respuesta"=>$id_atencion_diaria];
}
else{
    $respuesta=["estado"=>false,"respuesta"=>0];
}
print(json_encode($respuesta))

?>