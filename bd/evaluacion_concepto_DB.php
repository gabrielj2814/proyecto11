<?PHP
function datetime_futbolJoven(){
    $datetime_now = new DateTime();
    $datetime_now = $datetime_now->format('Y-m-d H:i:s');
    return $datetime_now;
}

function date_futbolJoven(){
    $datetime_now = new DateTime();
    $datetime_now = $datetime_now->format('Y-m-d');
    return $datetime_now;
}

function utf8_converter($array){
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
            $item = utf8_encode($item); 
        }
    });
    return $array;
}


function guardar($POST){

    if($POST["tipo_formulario"]==="false"){
        return registrar($POST);
    }
    else{
        return actualizar($POST);
    }


}

function registrar($POST){
    // print("reg");
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO evaluacion_concepto(
        evaluacion_concepto,
        evaluacion,
        posicion_evaluacion_concepto,
        estado_evaluacion_concepto,
        fecha_software,
        nombre_usuario_software
    )
    VALUES(
        '".$POST["evaluacion_concepto"]."',
        '".$POST["evaluacion"]."',
        '".$POST["posicion_evaluacion_concepto"]."',
        '".$POST["estado_evaluacion_concepto"]."',
        '".$fecha_software."',
        '".$POST["nombre_usuario_software"]."'
    )  ";
    $link->query($SQL);
    $id=$link->insert_id;
    $link->close();
    return ["estado"=>true,"id"=>$id];
}

function actualizar($POST){
    // print("reg");
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="UPDATE evaluacion_concepto SET
        evaluacion_concepto='".$POST["evaluacion_concepto"]."',
        evaluacion='".$POST["evaluacion"]."',
        posicion_evaluacion_concepto='".$POST["posicion_evaluacion_concepto"]."',
        estado_evaluacion_concepto='".$POST["estado_evaluacion_concepto"]."',
        fecha_software='".$fecha_software."',
        nombre_usuario_software='".$POST["nombre_usuario_software"]."'
        WHERE idevaluacion_concepto=".$POST["idevaluacion_concepto"].";
    ";
    $link->query($SQL);
    $link->close();
    return ["estado"=>true];

}


function consultarTodosLosConceptos(){
    include("conexion.php");
    $SQL="SELECT * FROM evaluacion_concepto;";
    $result_evaluacion_concepto=$link->query($SQL);
    $datos_evaluacion_concepto=[];
    while($row_evaluacion_concepto=mysqli_fetch_array($result_evaluacion_concepto)){
        $datos_evaluacion_concepto[]=utf8_converter($row_evaluacion_concepto);
    }
    $link->close();
    return (sizeof($datos_evaluacion_concepto)>0)?["respuesta" => true, "datos" => $datos_evaluacion_concepto]:["respuesta" => false, "datos" => []];
}


function consultarPorPosicion($POST){
    include("conexion.php");
    $filtro=concatenarPosiciones($POST["array_checkbox_filtro_posicon_evaluacion_concepto"]);
    $SQL="SELECT * FROM evaluacion_concepto WHERE $filtro ;";
    $result_evaluacion_concepto=$link->query($SQL);
    // print($SQL);
    $datos_evaluacion_concepto=[];
    while($row_evaluacion_concepto=mysqli_fetch_array($result_evaluacion_concepto)){
        $datos_evaluacion_concepto[]=utf8_converter($row_evaluacion_concepto);
    }
    $link->close();
    return (sizeof($datos_evaluacion_concepto)>0)?["respuesta" => true, "datos" => $datos_evaluacion_concepto]:["respuesta" => false, "datos" => []];
}

function concatenarPosiciones($posiciones_list){
    $posiciones_str="";
    $posiciones_list_modificada=[];
    if(sizeof($posiciones_list)>1){
        for($contador=0;$contador<sizeof($posiciones_list);$contador++){
            $posiciones_list_modificada[]=" posicion_evaluacion_concepto=".$posiciones_list[$contador]." ";
        }
        $posiciones_str=" ".(implode(" OR ",$posiciones_list_modificada))." ";
    }
    elseif(sizeof($posiciones_list)===1){
        $posiciones_str=" posicion_evaluacion_concepto=".$posiciones_list[0]." ";
    }
    return $posiciones_str;
}


function eliminar($GET){
    include("conexion.php");
    $SQL="DELETE FROM evaluacion_concepto WHERE idevaluacion_concepto=".$GET["id"].";";
    $link->query($SQL);
    $link->close();
    return ["respuesta" => true, "datos" => []];


}






