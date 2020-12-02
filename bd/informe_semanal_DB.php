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


function guardar_area($area,$datos,$id_informe_semanal){
    include("conexion.php");
    $SQL="INSERT INTO informe_semanal_area(informe_semanal_area,idinformesemanal,nombre_usuario_software,fecha) VALUES(".$area.",
    '".$id_informe_semanal."',
    '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
    '".datetime_futbolJoven()."');";
    $link->query($SQL);
    return $link->insert_id;
    $link->close();
}

function guardar_serie($serie,$datos,$id_informe_semanal){
    include("conexion.php");
    $SQL="INSERT INTO informe_semanal_serie(informe_semanal_serie,idinformesemanal,nombre_usuario_software,fecha) VALUES('".$serie."',
    '".$id_informe_semanal."',
    '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
    '".datetime_futbolJoven()."');";
    $link->query($SQL);
    return $link->insert_id;
    $link->close();
}

function eliminar_area($datos){
    include("conexion.php");
    $SQL="DELETE FROM informe_semanal_area WHERE idinformesemanal='".$datos["id_informe_semanal"]."';";
    $link->query($SQL);
}

function eliminar_serie($datos){
    include("conexion.php");
    $SQL="DELETE FROM informe_semanal_serie WHERE idinformesemanal='".$datos["id_informe_semanal"]."';";
    $link->query($SQL);
}

function guardar($datos){
    include("conexion.php");
    $id_formulario=$datos['id_informe'];
    $respuesta=0;
    if($id_formulario!=""){
        $SQL="INSERT INTO informe_semanal (
			descripcion_informe_semanal,
			fecha_informe_semanal,
			nombre_usuario_software,
			fecha
			) VALUES (
			'".utf8_decode($datos['descripcion_informe_semanal'])."',
			'".utf8_decode($datos['fecha_informe_semanal'])."',
			
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
        
        $link->query("
        UPDATE informe_semanal SET descripcion_informe_semanal='".utf8_decode($datos['descripcion_informe_semanal'])."',
		fecha_informe_semanal='".utf8_decode($datos['fecha_informe_semanal'])."',
		nombre_usuario_software='".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
        fecha='".datetime_futbolJoven()."' 
        WHERE idinformesemanal=".$datos['id_informe_semanal']." ;");
        eliminar_area($datos);
        eliminar_serie($datos);
        $respuesta=2;
        $respuesta_array=["id"=>$datos['id_informe_semanal'],"respuesta"=>$respuesta];
        $link->close();
        return $respuesta_array;
    }
}

function consultarTodosLosInformesSemanales(){
    include("conexion.php");
    $validar_estado=false;
    $SQL="SELECT * FROM informe_semanal";
    $result=$link->query($SQL);
    $estado_informe=false;
    $respuesta=["estado"=>false,"datos"=>""];
    while($row=mysqli_fetch_array($result)){
        $estado_informe=true;
        $SQL_area="SELECT * FROM informe_semanal_area WHERE idinformesemanal=".$row["idinformesemanal"]." ";
        $result_area=$link->query($SQL_area);
        $estado_area=false;
        $array_area_informe_semanal=[];
        while($row_area=mysqli_fetch_array($result_area)){
            $array_area_informe_semanal[]=$row_area["informe_semanal_area"];
            $estado_area=true;
        }
        $SQL_serie="SELECT * FROM informe_semanal_serie WHERE informe_semanal_serie.idinformesemanal=".$row["idinformesemanal"]."";
        $result_serie=$link->query($SQL_serie);
        $estado_serie=false;
        $array_serie_informe_semanal=[];
        while($row_serie=mysqli_fetch_array($result_serie)){
            $array_serie_informe_semanal[]=$row_serie["informe_semanal_serie"];
            $estado_serie=true;
        }
        if($estado_serie && $estado_area && $estado_informe){
            $validar_estado=true;
        }
        $row['array_serie_informe_semanal']=$array_serie_informe_semanal;
        $row['array_area_informe_semanal']=$array_area_informe_semanal;
        $datos[]=utf8_converter($row);
        $respuesta["estado"]=$validar_estado;
        $respuesta["datos"]=$datos;
    }
    return $respuesta;
}

function consultarPorRangoDeFecha($datos){
    include("conexion.php");
    $SQL_informe="SELECT * FROM informe_semanal WHERE fecha_informe_semanal BETWEEN '".$datos["fecha_inicio"]."' AND '".$datos["fecha_final"]."' ";
    $respuesta=$link->query($SQL_informe);
    $estado_informe=false;
    // $estado_area=false;
    
    $dato=[];
    while($row=mysqli_fetch_array($respuesta)){
        $estado_area_aciertos=false;
        $estado_informe=true;
        $SQL_area="SELECT * FROM informe_semanal_area WHERE idinformesemanal=".$row["idinformesemanal"]." ;";
        $result_area=$link->query($SQL_area);
        $array_area_informe_semanal=array();
        $contador_aciertos=0;
        while($row_area=mysqli_fetch_array($result_area)){
            if(array_key_exists("array_checkbox_area_filtro_informe_semanal",$datos)){
                $estado_area=false;
                $contador=0;
                while($contador<sizeof($datos["array_checkbox_area_filtro_informe_semanal"])){
                    if($datos["array_checkbox_area_filtro_informe_semanal"][$contador]==$row_area["informe_semanal_area"]){
                        $contador_aciertos++;
                        $estado_area=true;
                        $estado_area_aciertos=true;
                        array_push($array_area_informe_semanal,$row_area["informe_semanal_area"]);
                    }
                    $contador++;
                }
                if(!$estado_area){
                    array_push($array_area_informe_semanal,$row_area["informe_semanal_area"]);
                }
            }
            else{
                array_push($array_area_informe_semanal,$row_area["informe_semanal_area"]);
            }
        }
        
        if(array_key_exists("array_checkbox_area_filtro_informe_semanal",$datos)){
            if($contador_aciertos==sizeof($datos["array_checkbox_area_filtro_informe_semanal"])){///
                $row['array_area_informe_semanal']=$array_area_informe_semanal;
            }
            else{
                if($estado_area_aciertos){
                    // $array_area_informe_semanal=[];
                    $row['array_area_informe_semanal']=$array_area_informe_semanal;
                }
            }
        }
        else{
            $row['array_area_informe_semanal']=$array_area_informe_semanal;
        }

        $SQL_serie="SELECT * FROM informe_semanal_serie WHERE informe_semanal_serie.idinformesemanal=".$row["idinformesemanal"]."";
        $result_serie=$link->query($SQL_serie);
        $array_serie_informe_semanal=[];
        while($row_serie=mysqli_fetch_array($result_serie)){
            $array_serie_informe_semanal[]=$row_serie["informe_semanal_serie"];
        }
        $row['array_serie_informe_semanal']=$array_serie_informe_semanal;
        $dato[]=utf8_converter($row);
    }
    $respuesta_consulta=false;

    if($estado_informe){
        $respuesta_consulta=true;
        if($estado_area_aciertos){
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
    $SQL="DELETE FROM informe_semanal WHERE idinformesemanal=".$id.";";
    $link->query($SQL);
    $link->close();
    return ['estado'=>true];
}

?>