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


function guardar_area($area,$datos,$id_informe_mensual){
    include("conexion.php");
    $SQL="INSERT INTO informe_mensual_area(informe_mensual_area,idinforme_mensual,nombre_usuario_software,fecha) VALUES(".$area.",
    '".$id_informe_mensual."',
    '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
    '".datetime_futbolJoven()."');";
    $link->query($SQL);
    return $link->insert_id;
    $link->close();
}

function guardar_serie($serie,$datos,$id_informe_mensual){
    include("conexion.php");
    $SQL="INSERT INTO informe_mensual_serie(informe_mensual_serie,idinforme_mensual,nombre_usuario_software,fecha) VALUES('".$serie."',
    '".$id_informe_mensual."',
    '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
    '".datetime_futbolJoven()."');";
    $link->query($SQL);
    return $link->insert_id;
    $link->close();
}

function guardar_mes($mes,$datos,$id_informe_mensual){
    include("conexion.php");
    $SQL="INSERT INTO informe_mensual_mes(informe_mensual_mes,idinforme_mensual,nombre_usuario_software,fecha) VALUES(".$mes.",
    '".$id_informe_mensual."',
    '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
    '".datetime_futbolJoven()."');";
    $link->query($SQL);
    return $link->insert_id;
    $link->close();
}

function eliminar_area($datos){
    include("conexion.php");
    $SQL="DELETE FROM informe_mensual_area WHERE idinforme_mensual='".$datos["id_informe_mensual"]."';";
    $link->query($SQL);
}

function eliminar_serie($datos){
    include("conexion.php");
    $SQL="DELETE FROM informe_mensual_serie WHERE idinforme_mensual='".$datos["id_informe_mensual"]."';";
    $link->query($SQL);
}

function eliminar_mes($datos){
    include("conexion.php");
    $SQL="DELETE FROM informe_mensual_mes WHERE idinforme_mensual='".$datos["id_informe_mensual"]."';";
    $link->query($SQL);
}

function guardar($datos){
    // 
    include("conexion.php");
    $id_formulario=$datos['id_informe'];
    $respuesta=0;
    if($id_formulario!=""){
        $SQL="INSERT INTO informe_mensual (
			descripcion_informe_mensual,
            ano_informe_mensual,
			nombre_usuario_software,
			fecha
			) VALUES (
			'".utf8_decode($datos['descripcion_informe_mensual'])."',
            '".utf8_decode($datos['ano_informe_mensual'])."',
			
			'".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
			'".datetime_futbolJoven()."'
        )";
        $link->query($SQL);
        $respuesta=1;
        $id=$link->insert_id;
        $respuesta_array=["id"=>$id,"respuesta"=>$respuesta];
        $link->close();
        return $respuesta_array;
    }
    else{
        // print_r($datos);
        $link->query("
        UPDATE informe_mensual SET ano_informe_mensual='".utf8_decode($datos['ano_informe_mensual'])."', descripcion_informe_mensual='".utf8_decode($datos['descripcion_informe_mensual'])."',
		nombre_usuario_software='".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
        fecha='".datetime_futbolJoven()."' 
        WHERE idinforme_mensual=".$datos['id_informe_mensual']." ;");
        eliminar_mes($datos);
        eliminar_area($datos);
        eliminar_serie($datos);
        $respuesta=2;
        $respuesta_array=["id"=>$datos['id_informe_mensual'],"respuesta"=>$respuesta];
        $link->close();
        return $respuesta_array;
    }
}

function consultarTodosLosInformesMensuales(){
    include("conexion.php");
    $validar_estado=false;
    $SQL="SELECT * FROM informe_mensual";
    $result=$link->query($SQL);
    $estado_informe=false;
    $respuesta=["estado"=>false,"datos"=>""];
    while($row=mysqli_fetch_array($result)){
        $estado_informe=true;
        $SQL_area="SELECT * FROM informe_mensual_area WHERE idinforme_mensual=".$row["idinforme_mensual"]." ";
        $result_area=$link->query($SQL_area);
        $estado_area=false;
        $array_area_informe_mensual=[];
        while($row_area=mysqli_fetch_array($result_area)){
            $array_area_informe_mensual[]=$row_area["informe_mensual_area"];
            $estado_area=true;
        }
        $SQL_serie="SELECT * FROM informe_mensual_serie WHERE idinforme_mensual=".$row["idinforme_mensual"]."";
        $result_serie=$link->query($SQL_serie);
        $estado_serie=false;
        $array_serie_informe_mensual=[];
        while($row_serie=mysqli_fetch_array($result_serie)){
            $array_serie_informe_mensual[]=$row_serie["informe_mensual_serie"];
            $estado_serie=true;
        }
        $SQL_mes="SELECT * FROM informe_mensual_mes WHERE idinforme_mensual=".$row["idinforme_mensual"]."";
        $result_mes=$link->query($SQL_mes);
        $estado_mes=false;
        $array_mes_informe_mensual=[];
        while($row_mes=mysqli_fetch_array($result_mes)){
            $array_mes_informe_mensual[]=$row_mes["informe_mensual_mes"];
            $estado_mes=true;
        }
        if($estado_serie && $estado_area && $estado_mes && $estado_informe){
            $validar_estado=true;
        }
        $row['array_serie_informe_mensual']=$array_serie_informe_mensual;
        $row['array_area_informe_mensual']=$array_area_informe_mensual;
        $row['array_mes_informe_mensual']=$array_mes_informe_mensual;
        $datos[]=utf8_converter($row);
        $respuesta["estado"]=$validar_estado;
        $respuesta["datos"]=$datos;
    }
    return $respuesta;
}

function consultarPorRangoDeFecha($datos){
    include("conexion.php");
    $SQL_informe="SELECT * FROM informe_mensual WHERE ano_informe_mensual=".$datos["ano_informe_mensual_filtro"]." ";
    $respuesta=$link->query($SQL_informe);
    $estado_informe=false;
    // $estado_area=false;
    $estado_area_aciertos=false;
    $dato=[];
    while($row=mysqli_fetch_array($respuesta)){
        $estado_informe=true;
        $SQL_area="SELECT * FROM informe_mensual_area WHERE idinforme_mensual=".$row["idinforme_mensual"]." ;";
        $result_area=$link->query($SQL_area);
        $array_area_informe_mensual=array();
        $contador_aciertos=0;
        while($row_area=mysqli_fetch_array($result_area)){
            if(array_key_exists("array_checkbox_area_filtro_informe_mensual",$datos)){
                $estado_area=false;
                $contador=0;
                while($contador<sizeof($datos["array_checkbox_area_filtro_informe_mensual"])){
                    if($datos["array_checkbox_area_filtro_informe_mensual"][$contador]===$row_area["informe_mensual_area"]){
                        $contador_aciertos++;
                        $estado_area=true;
                        $estado_area_aciertos=true;
                        array_push($array_area_informe_mensual,$row_area["informe_mensual_area"]);
                    }
                    $contador++;
                }
                if(!$estado_area){
                    array_push($array_area_informe_mensual,$row_area["informe_mensual_area"]);
                }
            }
            else{
                array_push($array_area_informe_mensual,$row_area["informe_mensual_area"]);
            }
        }
        
        if(array_key_exists("array_checkbox_area_filtro_informe_mensual",$datos)){
            if($contador_aciertos==sizeof($datos["array_checkbox_area_filtro_informe_mensual"])){///
                $row['array_area_informe_mensual']=$array_area_informe_mensual;
            }
            else{
                if($estado_area_aciertos){
                    $row['array_area_informe_mensual']=$array_area_informe_mensual;
                }
            }
        }
        else{
            $row['array_area_informe_mensual']=$array_area_informe_mensual;
        }

///////////////////////////////////////////////////

        $SQL_mes="SELECT * FROM informe_mensual_mes WHERE idinforme_mensual=".$row["idinforme_mensual"]." ;";
        $result_mes=$link->query($SQL_mes);
        $array_mes_informe_mensual=array();
        $estado_mes_aciertos=false;
        $contador_aciertos2=0;
        while($row_mes=mysqli_fetch_array($result_mes)){
            if(array_key_exists("array_checkbox_mes_filtro_informe_mensual",$datos)){
                $estado_mes=false;
                $contador2=0;
                while($contador2<sizeof($datos["array_checkbox_mes_filtro_informe_mensual"])){
                    if($datos["array_checkbox_mes_filtro_informe_mensual"][$contador2]===$row_mes["informe_mensual_mes"]){
                        $contador_aciertos2++;
                        $estado_mes=true;
                        $estado_mes_aciertos=true;
                        array_push($array_mes_informe_mensual,$row_mes["informe_mensual_mes"]);
                    }
                    $contador2++;
                }
                if(!$estado_mes){
                    array_push($array_mes_informe_mensual,$row_mes["informe_mensual_mes"]);
                }
            }
            else{
                array_push($array_mes_informe_mensual,$row_mes["informe_mensual_mes"]);
            }
        }

        if(array_key_exists("array_checkbox_mes_filtro_informe_mensual",$datos)){
            if($contador_aciertos2==sizeof($datos["array_checkbox_mes_filtro_informe_mensual"])){///
                $row['array_mes_informe_mensual']=$array_mes_informe_mensual;
            }
            else{
                if($estado_mes_aciertos){
                    $row['array_mes_informe_mensual']=$array_mes_informe_mensual;
                }
            }
        }
        else{
            $row['array_mes_informe_mensual']=$array_mes_informe_mensual;
        }


///////////////////////////////////////////////////


        $SQL_serie="SELECT * FROM informe_mensual_serie WHERE idinforme_mensual=".$row["idinforme_mensual"]."";
        $result_serie=$link->query($SQL_serie);
        $array_serie_informe_mensual=[];
        while($row_serie=mysqli_fetch_array($result_serie)){
            $array_serie_informe_mensual[]=$row_serie["informe_mensual_serie"];
        }
        $row['array_serie_informe_mensual']=$array_serie_informe_mensual;
        $dato[]=utf8_converter($row);
    }
    $respuesta_consulta=false;
    if($estado_informe){
        if($estado_area_aciertos || $estado_mes_aciertos){
            $respuesta_consulta=true;
            return ["respuesta_consulta"=>$respuesta_consulta,"datos"=>$dato];
        }
        else{
            return ["respuesta_consulta"=>$respuesta_consulta,"datos"=>$dato];
        }
        
    }
    else{
        return ["respuesta_consulta"=>$respuesta_consulta,"datos"=>[]];
    }
}

function eliminar($id){
    include("conexion.php");
    $SQL="DELETE FROM informe_mensual WHERE idinforme_mensual=".$id.";";
    $link->query($SQL);
    $link->close();
    return ['estado'=>true];
}

?>