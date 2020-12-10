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

function consultarUltimaAtencionJugadorSerie($serie,$sexo){
    $jugadoreUltimaAtencion=[];
    $jugadores=consultarJugadoresSerie($serie,$sexo);
    for($contador=0;$contador<sizeof($jugadores);$contador++){
        $jugador=$jugadores[$contador];
        $atencionesDiariasJugador=consultarAtencionesDiariaJugador($jugador["idfichaJugador"]);
        $atencion=obtenerUltimaAtencion($atencionesDiariasJugador);
        if(!empty($atencion)){
            $jugador["ultimaAtencion"]=$atencion;
            $jugador["numeroTotalDeAtenciones"]=sizeof($atencionesDiariasJugador);
            $jugadoreUltimaAtencion[]=$jugador;
        }
    }
    // print  $contadorJugadoresDeBaja;
    return $jugadoreUltimaAtencion;
}

function consultarJugadoreDeBajasSerie($serie,$sexo){
    $jugadoreDeBaja=[];
    $jugadores=consultarJugadoresSerie($serie,$sexo);
    for($contador=0;$contador<sizeof($jugadores);$contador++){
        $jugador=$jugadores[$contador];
        $atencionesDiariasJugador=consultarAtencionesDiariaJugador($jugador["idfichaJugador"]);
        $baja=obtenerUltimaBajaJugador($atencionesDiariasJugador,"1");
        if(!empty($baja)){
            $jugador["atencionDiariaBaja"]=$baja;
            $jugadoreDeBaja[]=$jugador;
        }
    }
    // print  $contadorJugadoresDeBaja;
    return $jugadoreDeBaja;
}

function consultarBajasSerie($serie,$sexo){
    $contadorJugadoresDeBaja=0;
    $jugadores=consultarJugadoresSerie($serie,$sexo);
    for($contador=0;$contador<sizeof($jugadores);$contador++){
        $jugador=$jugadores[$contador];
        $atencionesDiariasJugador=consultarAtencionesDiariaJugador($jugador["idfichaJugador"]);
        $estado=analizarEstadoDeAtencionesDiarias($atencionesDiariasJugador,"1");
        if(!$estado && $estado!==0){
            $contadorJugadoresDeBaja++;
        }
    }
    // print  $contadorJugadoresDeBaja;
    return $contadorJugadoresDeBaja;
}

function consultarReintegroDeportivo($serie,$sexo){
    $contadorJugadoresReintegro=0;
    $jugadores=consultarJugadoresSerie($serie,$sexo);
    for($contador=0;$contador<sizeof($jugadores);$contador++){
        $jugador=$jugadores[$contador];
        $atencionesDiariasJugador=consultarAtencionesDiariaJugador($jugador["idfichaJugador"]);
        $estado=analizarEstadoDeAtencionesDiarias($atencionesDiariasJugador,"3");
        if($estado && $estado!==0){
            $contadorJugadoresReintegro++;
        }
    }
    // print  $contadorJugadoresReintegro;
    return $contadorJugadoresReintegro;
}

function consultarAptoParaJugar($serie,$sexo){
    $contadorJugadoresAptoParaJugar=0;
    $jugadores=consultarJugadoresSerie($serie,$sexo);
    for($contador=0;$contador<sizeof($jugadores);$contador++){
        $jugador=$jugadores[$contador];
        $atencionesDiariasJugador=consultarAtencionesDiariaJugador($jugador["idfichaJugador"]);
        $estado=analizarEstadoDeAtencionesDiarias($atencionesDiariasJugador,"1");
        
        if($estado && $estado!==0){
            $contadorJugadoresAptoParaJugar++;
        }
        
    }
    // print  $contadorJugadoresAptoParaJugar;
    return $contadorJugadoresAptoParaJugar;
}

function consultarAptoParaEntrenar($serie,$sexo){
    $contadorJugadoresAptoParaEntrenar=0;
    $jugadores=consultarJugadoresSerie($serie,$sexo);
    for($contador=0;$contador<sizeof($jugadores);$contador++){
        $jugador=$jugadores[$contador];
        $atencionesDiariasJugador=consultarAtencionesDiariaJugador($jugador["idfichaJugador"]);
        $estado=analizarEstadoDeAtencionesDiarias($atencionesDiariasJugador,"2");
        if($estado && $estado!==0){
            $contadorJugadoresAptoParaEntrenar++;
        }
    }
    // print  $contadorJugadoresAptoParaEntrenar;
    return $contadorJugadoresAptoParaEntrenar;
}

function consultarJugadoresSerie($serie,$sexo){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador WHERE serieActual='".$serie."' AND sexo= $sexo;";
    // print($SQL);
    $result_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_jugador)){
        // $posicion=consultarListaPosicionesJugador();
        $posicion=consultarListaPosicionesJugador($row["idfichaJugador"]);
        // print_r($posicion);
        $row["posicionTexto"]=(empty($posicion))?[]:$posicion[0]["texto_posicion"];
        $array_datos[]=utf8_converter($row);
    }
    $link->close();
    return $array_datos;
}

function consultarAtencionesDiariaJugador($id){
    include("conexion.php");
    $SQL="SELECT * FROM atencion_diaria_federacion WHERE idfichaJugador=".$id.";";
    $result_atencion=$link->query($SQL);
    $datos=[];
    while($row_atencion_diaria=mysqli_fetch_array($result_atencion)){

        // $SQL_tratamiento_aplicado="SELECT * FROM tratamiento_aplicado_atencion_diaria_federacion WHERE  idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"].";";
        // $result_tratamiento_aplicado=$link->query($SQL_tratamiento_aplicado);
        // $datos_tratamiento_aplicado=[];
        // while($row_tratamiento_aplicado=mysqli_fetch_array($result_tratamiento_aplicado)){
        //     $datos_tratamiento_aplicado[]=utf8_converter($row_tratamiento_aplicado);
        // }
        // $row_atencion_diaria["lista_tratamiento"]=$datos_tratamiento_aplicado;

        // $SQL_tranajo_readaptor="SELECT * FROM trabajo_readaptador_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"]."";
        // $result_trabajo_readaptador=$link->query($SQL_tranajo_readaptor);
        // $datos_trabajo=[];
        // while($row_trabajo=mysqli_fetch_array($result_trabajo_readaptador)){
        //     $datos_trabajo[]=utf8_converter($row_trabajo);
        // }
        // $row_atencion_diaria["trabajo_readaptor"]= $datos_trabajo;

        // $SQL_recomendacion="SELECT * FROM recomendacion_alta_atencion_diaria_federacion WHERE  idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"].";";
        // $result_recomendacion=$link->query($SQL_recomendacion);
        // $datos_recomendacion=[];
        // while($row_recomendacion=mysqli_fetch_array($result_recomendacion)){
        //     $datos_recomendacion[]=utf8_converter($row_recomendacion);
        // }
        // $row_atencion_diaria["lista_recomendacion"]=$datos_recomendacion;

        if($row_atencion_diaria["idinforme_medico"]!==NULL){
            $SQL_informe_medico="SELECT * FROM informe_medico WHERE  idinforme_medico=".$row_atencion_diaria["idinforme_medico"].";";
            $result_informe_medico=$link->query($SQL_informe_medico);
            $datos_informe_medico=[];
            while($row_informe_medico=mysqli_fetch_array($result_informe_medico)){
                $datos_informe_medico[]=utf8_converter($row_informe_medico);
            }
            $row_atencion_diaria["informe_medico"]=$datos_informe_medico;
        }
        
        // $SQL_recomendacion="SELECT * FROM recomendaciones_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"]."";
        // $result_recomendacion=$link->query($SQL_recomendacion);
        // $datos_recomendacion=[];
        // while($row_recomendacion=mysqli_fetch_array($result_recomendacion)){
        //     $datos_recomendacion[]=utf8_converter($row_recomendacion);
        // }
        // $row_atencion_diaria["recomendaciones"]= $datos_recomendacion;

        $datos[]=utf8_converter($row_atencion_diaria);
    }
    $link->close();
    return (sizeof($datos)>0)? $datos: [];
}

function analizarEstadoDeAtencionesDiarias($atenciones,$estadoJugador){
    $estado=0;
    for($contador=0;$contador<sizeof($atenciones);$contador++){
        $atencion=$atenciones[$contador];
        if($atencion["estado_jugador"]===$estadoJugador){
            $estado=true;
        }
        else{
            $estado=false;
        }
    }
    return $estado;
}

function obtenerUltimaBajaJugador($atenciones,$estadoJugador){
    $estado=[];
    for($contador=0;$contador<sizeof($atenciones);$contador++){
        $atencion=$atenciones[$contador];
        if($atencion["estado_jugador"]===$estadoJugador){
            $estado=[];
        }
        else{
            $estado=$atencion;
        }
    }
    // print($contador);
    return $estado;
}

function obtenerUltimaAtencion($atenciones){
    // return $atenciones[sizeof($atenciones)-1];
    return (sizeof($atenciones)>0)?$atenciones[sizeof($atenciones)-1]:[];
}

function consultarEstadoJugadoresSerie($serie,$sexo){
    $infoSerie=[];
    $infoSerie["jugadores"]=consultarJugadoresSerie($serie,$sexo);
    $infoSerie["bajas"]=consultarBajasSerie($serie,$sexo);
    $infoSerie["reintegro"]=consultarReintegroDeportivo($serie,$sexo);
    $infoSerie["aptoParaJugar"]=consultarAptoParaJugar($serie,$sexo);
    $infoSerie["aptoParaEntrenar"]=consultarAptoParaEntrenar($serie,$sexo);
    $infoSerie["jugadoreDeBaja"]=consultarJugadoreDeBajasSerie($serie,$sexo);
    $infoSerie["ultimaAtencionjugadores"]=consultarUltimaAtencionJugadorSerie($serie,$sexo);
    return $infoSerie;
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


