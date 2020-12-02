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

function eliminarEvaluacion($GET){
	include("conexion.php");
	$SQL="DELETE FROM evaluacion_jugador WHERE idevaluacion_jugador=".$GET["id"].";";
	$link->query($SQL);
	$link->close();
	return ["estado"=>true];
}


function guardar_evaluacion($POST){
	$id=registrarEvaluacionJugador($POST);
	$estado=registrarDetallesEvaluacionJugador($POST,$id);
	return $estado;

}

function registrarEvaluacionJugador($POST){
	include("conexion.php");

	if($POST["tipo_formulario"]==="false"){
		$fecha=datetime_futbolJoven();
		$SQL="INSERT INTO evaluacion_jugador(
			total_final_tecnica,
			total_final_tactica,
			total_final_otra,
			total_promedio,
			fecha_evaluacion_jugador,
			posicion_evaluacion_jugador,
			comentario_fortaleza,
			comentario_devilidad,
			comentario_recomendacion,
			fecha_software,
			nombre_usuario_software,
			idfichaJugador
		)
		VALUES(
			".$POST["total_final_tecnica"].",
			".$POST["total_final_tactica"].",
			".$POST["total_final_otra"].",
			".$POST["total_promedio"].",
			'".$POST["fecha_evaluacion_jugador"]."',
			'".$POST["posicion_evaluacion_jugador"]."',
			'".$POST["comentario_fortaleza"]."',
			'".$POST["comentario_devilidad"]."',
			'".$POST["comentario_recomendacion"]."',
			'".$fecha."',
			'".$POST["nombre_usuario_software"]."',
			".$POST["idfichaJugador"]."
	
		)";
		// print($SQL);
		$link->query($SQL);
		$id=$link->insert_id;
		// idfichaJugador
	
		$link->close();
		return $id;
	}
	else{
		$fecha=datetime_futbolJoven();
		$SQL="UPDATE evaluacion_jugador SET
			total_final_tecnica=".$POST["total_final_tecnica"].",
			total_final_tactica=".$POST["total_final_tactica"].",
			total_final_otra=".$POST["total_final_otra"].",
			total_promedio=".$POST["total_promedio"].",
			fecha_evaluacion_jugador='".$POST["fecha_evaluacion_jugador"]."',
			posicion_evaluacion_jugador='".$POST["posicion_evaluacion_jugador"]."',
			comentario_fortaleza='".$POST["comentario_fortaleza"]."',
			comentario_devilidad='".$POST["comentario_devilidad"]."',
			comentario_recomendacion='".$POST["comentario_recomendacion"]."',
			fecha_software='".$fecha."',
			nombre_usuario_software='".$POST["nombre_usuario_software"]."',
			idfichaJugador=".$POST["idfichaJugador"]."
			WHERE idevaluacion_jugador=".$POST["idevaluacion_jugador"].";
		";
		// print($SQL);
		$link->query($SQL);
		eliminarDetallesEvaluacionJugador($POST["idevaluacion_jugador"]);
	
		$link->close();
		return $POST["idevaluacion_jugador"];
	}
	
}

function eliminarDetallesEvaluacionJugador($id){
	include("conexion.php");
    $SQL="DELETE FROM detalle_evaluacion_jugador WHERE idevaluacion_jugador=$id;";
    $link->query($SQL);
    $link->close();
}

function registrarDetallesEvaluacionJugador($POST,$id){
	$fecha=datetime_futbolJoven();
	$lista_sql=[];
	include("conexion.php");
	for($contador=0;$contador<sizeof($POST["array_id_concepto_tipo_evaluacion"]);$contador++){
		$prefijo=$POST["array_id_concepto_tipo_evaluacion"][$contador];
		$id_concepto=explode("_",$prefijo)[0];
		$SQL="INSERT INTO detalle_evaluacion_jugador(
			nota_detalle_evaluacion_jugador,
			comentario_detalle_evaluacion_jugador,
			fecha_software,
			nombre_usuario_software,
			idevaluacion_jugador,
			idevaluacion_concepto
		)
		VALUES(
			".$POST["evaluacion_".$prefijo].",
			'".$POST["comentario_".$prefijo]."',
			'".$fecha."',
			'".$POST["nombre_usuario_software"]."',
			".$id.",
			".$id_concepto."
		)
		";
		$lista_sql[]=$SQL;
	}
	$estado=false;
	for($contador2=0;$contador2<sizeof($lista_sql);$contador2++){
		// print($lista_sql[$contador2]);
		$link->query($lista_sql[$contador2]);
		$estado=$link->insert_id;
    	
	}
	$link->close();
	return ["estado" => $estado];
	
}

function consultarEvaluacionesJugador($id){
	// evaluacion_jugador
	include("conexion.php");
    $SQL="SELECT * FROM evaluacion_jugador WHERE idfichaJugador=$id;";
    // print($SQL);
    $result_evaluacion_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_evaluacion_jugador)){
		$row["detalle_evaluaciones"]=consultarDetalleEvaluacionJugador($row["idevaluacion_jugador"]);
        $array_datos[]=utf8_converter($row);
    }
	$link->close();
	return $array_datos;
}

function consultarDetalleEvaluacionJugador($id){
	include("conexion.php");
    $SQL="SELECT * FROM detalle_evaluacion_jugador WHERE idevaluacion_jugador=$id;";
    $result_detalle_evaluacion_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_detalle_evaluacion_jugador)){
        $array_datos[]=utf8_converter($row);
    }
	$link->close();
	return $array_datos;
}



function cantidadDeJugadoresPorSerie(){
    $catidad_serie=[
		"serie_8" => 0,
		        "serie_9" => 0,
        "serie_10" => 0,
        "serie_11" => 0,
        "serie_12" => 0,
        "serie_13" => 0,
        "serie_14" => 0,
        "serie_15" => 0,
        "serie_16" => 0,
        "serie_17" => 0,
        "serie_20" => 0,
		"serie_99" => 0,
		"serie_15_2" => 0,
		"serie_17_2" => 0,
		"serie_99_2" => 0,
    ];

    // $catidad_serie["serie_8"]=sizeof(consultarPorSerieJugador(8,1));
    // $catidad_serie["serie_9"]=sizeof(consultarPorSerieJugador(9,1));
    // $catidad_serie["serie_10"]=sizeof(consultarPorSerieJugador(10,1));
    // $catidad_serie["serie_11"]=sizeof(consultarPorSerieJugador(11,1));
    // $catidad_serie["serie_12"]=sizeof(consultarPorSerieJugador(12,1));
    // $catidad_serie["serie_13"]=sizeof(consultarPorSerieJugador(13,1));
    // $catidad_serie["serie_14"]=sizeof(consultarPorSerieJugador(14,1));
    // $catidad_serie["serie_15"]=sizeof(consultarPorSerieJugador(15,1));
    // $catidad_serie["serie_16"]=sizeof(consultarPorSerieJugador(16,1));
    // $catidad_serie["serie_17"]=sizeof(consultarPorSerieJugador(17,1));
    // $catidad_serie["serie_20"]=sizeof(consultarPorSerieJugador(20,1));
	// $catidad_serie["serie_99"]=sizeof(consultarPorSerieJugador(99,1));
	// $catidad_serie["serie_15_2"]=sizeof(consultarPorSerieJugador(15,2));
	// $catidad_serie["serie_17_2"]=sizeof(consultarPorSerieJugador(17,2));
	// $catidad_serie["serie_99_2"]=sizeof(consultarPorSerieJugador(99,2));

	$catidad_serie["serie_8"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(8,1));
    $catidad_serie["serie_9"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(9,1));
    $catidad_serie["serie_10"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(10,1));
    $catidad_serie["serie_11"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(11,1));
    $catidad_serie["serie_12"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(12,1));
    $catidad_serie["serie_13"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(13,1));
    $catidad_serie["serie_14"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(14,1));
    $catidad_serie["serie_15"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(15,1));
    $catidad_serie["serie_16"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(16,1));
    $catidad_serie["serie_17"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(17,1));
    $catidad_serie["serie_20"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(20,1));
	$catidad_serie["serie_99"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(99,1));
	$catidad_serie["serie_15_2"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(15,2));
	$catidad_serie["serie_17_2"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(17,2));
	$catidad_serie["serie_99_2"]=sizeof(consultarJugadoresPorSerieYEvaluaciones(99,2));

    // print_r($catidad_serie);

    return $catidad_serie;

}

function cantidadDeValuacionesPorSerie($serie,$sexo){
	return sizeof(consultarJugadoresPorSerieYEvaluaciones($serie,$sexo));
}

function consultarJugadorPorSerie($serie,$sexo){
	$lista_jugadores=consultarPorSerieJugador($serie,$sexo);
	return (sizeof($lista_jugadores)>0)?["respuesta" => true,  "datos" => $lista_jugadores] : ["respuesta" => true,  "datos" => []];
	
}


function consultarPorSerieJugador($serie,$sexo){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador WHERE (fichaJugador.serieActual='$serie' AND sexo= $sexo ) ;";
    // print($SQL);
    $result_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_jugador)){
        $row["posicion"]=calcular_posicion_jugador($row["idfichaJugador"]);
        $array_datos[]=utf8_converter($row);
    }
    $link->close();
    return $array_datos;
}

function consultarJugadoresPorSerieYEvaluaciones($serie,$sexo){
	include("conexion.php");
	$fecha=explode("-",date_futbolJoven())[0]."-".explode("-",date_futbolJoven())[1];

    $SQL="SELECT * FROM fichaJugador,evaluacion_jugador WHERE (fichaJugador.serieActual='$serie' AND sexo= $sexo ) AND (fichaJugador.idfichaJugador=evaluacion_jugador.idfichaJugador) AND( evaluacion_jugador.fecha_software LIKE '%$fecha%' );";
    // print($SQL);
    $result_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_jugador)){
        $row["posicion"]=calcular_posicion_jugador($row["idfichaJugador"]);
        $array_datos[]=utf8_converter($row);
    }
    $link->close();
    return $array_datos;
}

function calcular_posicion_jugador($id){
    
	$jugador['portero'] = 0; 			//1
	$jugador['defensorCentral'] = 0;	//3,4,5,7,  Defensas
	$jugador['lateralIzquierdo'] = 0;            //2,6,      Defensas
	$jugador['lateralDerecho'] = 0;	//9,10,11,14,15,16  Mediocampistas
	$jugador['volanteDefensivo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteIzquierdo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteDerecho'] = 0;		//8,12,13,17,18,22,     Med 
	$jugador['volanteMixto'] = 0;	//19,20,21,			Med
	$jugador['volanteOfensivo'] = 0;			//23,27,            Delanteros
	$jugador['extremoIzquierdo'] = 0;	//24,25,26,28,29   
	$jugador['extremoDerecho'] = 0;	//24,25,26,28,29   
	$jugador['delanteroCentro'] = 0;	//24,25,26,28,29   
	$jugador['posicionPrincipal'] = '';	//24,25,26,28,29
	include("conexion.php");
	$resultado = $link->query("SELECT posicion, numero_posicion FROM posicionCancha WHERE idfichaJugador like ".$id." ORDER BY posicionCancha.numero_posicion DESC");
	$posicion="";
	while($row = mysqli_fetch_array($resultado)){
		$posicion=$row['posicion'];
		if($row['posicion']==1){
			$jugador['portero']=1;
			$jugador['posicionPrincipal']='Arquero';
			
		}else if($row['posicion']==2){
			$jugador['defensorCentral']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Defensor Central';
			//}
		}else if($row['posicion']==3){
			$jugador['lateralIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Izquierdo';
			//}
		}else if($row['posicion']==4){
			$jugador['lateralDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Derecho';
			//}
		}else if($row['posicion']==5){
			$jugador['volanteDefensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Defensivo';
			//}
		}else if($row['posicion']==6){
			$jugador['volanteIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Izquierdo';
			//}
		}else if($row['posicion']==7){
			$jugador['volanteDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Derecho';
			//}
		}else if($row['posicion']==8){
			$jugador['volanteMixto']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Mixto';
			//}
		}else if($row['posicion']==9){
			$jugador['volanteOfensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Ofensivo';
			//}
		}else if($row['posicion']==10){
			$jugador['extremoIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Izquierdo';
			//}
		}else if($row['posicion']==11){
			$jugador['extremoDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Derecho';
			//}
		}else if($row['posicion']==12){
			$jugador['delanteroCentro']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Delantero Centro';
		}
	}
	return ["texto_posicion" => $jugador['posicionPrincipal'],"codigo_posicion" => $posicion];
    
}

function consultarListaPosicionesJugador($id){
    
	$jugador['portero'] = 0; 			//1
	$jugador['defensorCentral'] = 0;	//3,4,5,7,  Defensas
	$jugador['lateralIzquierdo'] = 0;            //2,6,      Defensas
	$jugador['lateralDerecho'] = 0;	//9,10,11,14,15,16  Mediocampistas
	$jugador['volanteDefensivo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteIzquierdo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteDerecho'] = 0;		//8,12,13,17,18,22,     Med 
	$jugador['volanteMixto'] = 0;	//19,20,21,			Med
	$jugador['volanteOfensivo'] = 0;			//23,27,            Delanteros
	$jugador['extremoIzquierdo'] = 0;	//24,25,26,28,29   
	$jugador['extremoDerecho'] = 0;	//24,25,26,28,29   
	$jugador['delanteroCentro'] = 0;	//24,25,26,28,29   
	$jugador['posicionPrincipal'] = '';	//24,25,26,28,29
	include("conexion.php");
	$resultado = $link->query("SELECT posicion, numero_posicion FROM posicionCancha WHERE idfichaJugador like ".$id." ORDER BY posicionCancha.numero_posicion DESC");
	$posicion="";
	$datos=[];
	while($row = mysqli_fetch_array($resultado)){
		$posicion=$row['posicion'];
		if($row['posicion']==1){
			$jugador['portero']=1;
			$jugador['posicionPrincipal']='Arquero';
			
		}else if($row['posicion']==2){
			$jugador['defensorCentral']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Defensor Central';
			//}
		}else if($row['posicion']==3){
			$jugador['lateralIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Izquierdo';
			//}
		}else if($row['posicion']==4){
			$jugador['lateralDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Derecho';
			//}
		}else if($row['posicion']==5){
			$jugador['volanteDefensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Defensivo';
			//}
		}else if($row['posicion']==6){
			$jugador['volanteIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Izquierdo';
			//}
		}else if($row['posicion']==7){
			$jugador['volanteDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Derecho';
			//}
		}else if($row['posicion']==8){
			$jugador['volanteMixto']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Mixto';
			//}
		}else if($row['posicion']==9){
			$jugador['volanteOfensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Ofensivo';
			//}
		}else if($row['posicion']==10){
			$jugador['extremoIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Izquierdo';
			//}
		}else if($row['posicion']==11){
			$jugador['extremoDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Derecho';
			//}
		}else if($row['posicion']==12){
			$jugador['delanteroCentro']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Delantero Centro';
		}
		$datos[]=["texto_posicion" => $jugador['posicionPrincipal'],"codigo_posicion" => $posicion];
	}
	return $datos;
    
}

function calcular_posicion_jugador_2($id,$posicion){
    
	$jugador['portero'] = 0; 			//1
	$jugador['defensorCentral'] = 0;	//3,4,5,7,  Defensas
	$jugador['lateralIzquierdo'] = 0;            //2,6,      Defensas
	$jugador['lateralDerecho'] = 0;	//9,10,11,14,15,16  Mediocampistas
	$jugador['volanteDefensivo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteIzquierdo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteDerecho'] = 0;		//8,12,13,17,18,22,     Med 
	$jugador['volanteMixto'] = 0;	//19,20,21,			Med
	$jugador['volanteOfensivo'] = 0;			//23,27,            Delanteros
	$jugador['extremoIzquierdo'] = 0;	//24,25,26,28,29   
	$jugador['extremoDerecho'] = 0;	//24,25,26,28,29   
	$jugador['delanteroCentro'] = 0;	//24,25,26,28,29   
	$jugador['posicionPrincipal'] = '';	//24,25,26,28,29
	include("conexion.php");
	$resultado = $link->query("SELECT posicion, numero_posicion FROM posicionCancha WHERE posicion='$posicion' AND idfichaJugador like ".$id." ORDER BY posicionCancha.numero_posicion DESC");
	$posicion="";

	while($row = mysqli_fetch_array($resultado)){
		$posicion=$row['posicion'];
		if($row['posicion']==1){
			$jugador['portero']=1;
			$jugador['posicionPrincipal']='Arquero';
			
		}else if($row['posicion']==2){
			$jugador['defensorCentral']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Defensor Central';
			//}
		}else if($row['posicion']==3){
			$jugador['lateralIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Izquierdo';
			//}
		}else if($row['posicion']==4){
			$jugador['lateralDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Derecho';
			//}
		}else if($row['posicion']==5){
			$jugador['volanteDefensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Defensivo';
			//}
		}else if($row['posicion']==6){
			$jugador['volanteIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Izquierdo';
			//}
		}else if($row['posicion']==7){
			$jugador['volanteDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Derecho';
			//}
		}else if($row['posicion']==8){
			$jugador['volanteMixto']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Mixto';
			//}
		}else if($row['posicion']==9){
			$jugador['volanteOfensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Ofensivo';
			//}
		}else if($row['posicion']==10){
			$jugador['extremoIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Izquierdo';
			//}
		}else if($row['posicion']==11){
			$jugador['extremoDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Derecho';
			//}
		}else if($row['posicion']==12){
			$jugador['delanteroCentro']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Delantero Centro';
		}
	}
	return ["texto_posicion" => $jugador['posicionPrincipal'],"codigo_posicion" => $posicion];
    
}

function ver_jugadores ($datos) {
	include("conexion.php");
	$troso_sql="";
	if($datos['campo_busqueda']!=""){
		$troso_sql="AND (concat(nombre, ' ', apellido1, ' ', apellido2) LIKE '%".$datos['campo_busqueda']."%')";
	}
	$dato = [];
	$SQL="SELECT *
	FROM fichaJugador,posicionCancha
	WHERE (serieActual = '".$datos['serieActual']."'
	AND sexo = ".$datos['sexo'].") $troso_sql AND(fichaJugador.idfichaJugador=posicionCancha.idfichaJugador) AND fichaJugador.estado <> 0 AND fichaJugador.estado <> 1 AND fichaJugador.estado <> 3
	;";
	// ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
	// print($SQL);
    $consulta = $link->query($SQL);
    while ($row_jugadores = mysqli_fetch_array($consulta)) {
		$posicion=calcular_posicion_jugador_2($row_jugadores["idfichaJugador"],$row_jugadores["posicion"]);
		$row_jugadores["posicion"]=$posicion["codigo_posicion"];
		$row_jugadores["posicion_texto"]=$posicion["texto_posicion"];
		$row_jugadores["numero_de_evaluaciones"]=sizeof(consultarEvaluacionesJugador($row_jugadores["idfichaJugador"]));
        $posicion_g = 0;
        if ($row_jugadores['posicion'] == 1) {
            $posicion_g = 1;
        } else if ($row_jugadores['posicion'] == 2 || $row_jugadores['posicion'] == 3 || $row_jugadores['posicion'] == 4) {
            $posicion_g = 2;
        } else if ($row_jugadores['posicion'] == 5 || $row_jugadores['posicion'] == 6 || $row_jugadores['posicion'] == 7 || $row_jugadores['posicion'] == 8 || $row_jugadores['posicion'] == 9) {
            $posicion_g = 3;
        } else if ($row_jugadores['posicion'] == 10 || $row_jugadores['posicion'] == 11 || $row_jugadores['posicion'] == 12) {
            $posicion_g = 4;
        }
        $row_jugadores['posicionA'] = $posicion_g;  

        $dato[] = utf8_converter($row_jugadores);
    }

    $link->close();
    return $dato;
}






// function consultarEvaluacionYConceptosJugador($GET){
// 	$listas_conceptos=consultarConceptosPosicion($GET["posicion"]);
// 	$lista_evaluaciones_jugador=consultarEvaluacionesJugador($GET["id"]);
// 	return ["listas_conceptos"=> $listas_conceptos,"lista_evaluaciones_jugador"=> $lista_evaluaciones_jugador];
// }

function consultarEvaluacionYConceptosJugador($GET){
	// $listas_conceptos=consultarConceptosPosicion($GET["posicion"]);
	$lista_evaluaciones_jugador=consultarEvaluacionesJugador($GET["id"]);
	$lista_pociones_jugador=consultarListaPosicionesJugador($GET["id"]);
	$listas_conceptos=[];
	for($contador=0;$contador<sizeof($lista_pociones_jugador);$contador++){
		// codigo_posicion
		$posicion=$lista_pociones_jugador[$contador];
		$lista_conceptos_posicion=consultarConceptosPosicion($posicion["codigo_posicion"]);
		$listas_conceptos["".$posicion["codigo_posicion"]]=$lista_conceptos_posicion;
	}
	
	return ["listas_conceptos"=> $listas_conceptos,"posiciones_jugador"=>$lista_pociones_jugador,"lista_evaluaciones_jugador"=> $lista_evaluaciones_jugador];

}

function consultarConceptosPosicion($posicion){
	include("conexion.php");
	$SQL="SELECT * FROM evaluacion_concepto WHERE posicion_evaluacion_concepto=$posicion AND estado_evaluacion_concepto=1;";
    $result_evaluacion_concepto=$link->query($SQL);
    $datos_evaluacion_concepto=[];
    while($row_evaluacion_concepto=mysqli_fetch_array($result_evaluacion_concepto)){
        $datos_evaluacion_concepto[]=utf8_converter($row_evaluacion_concepto);
    }
    $link->close();
    return $datos_evaluacion_concepto;
}
