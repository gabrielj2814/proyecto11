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

function consultarJugadoresSinAltaMedica($GET){
    $lista_jugadores=consultarJugadoresSerie($GET["serie"],$GET["sexo"]);
    // print_r($lista_jugadores);
    $jugadores_sin_alta_medica=[];
    for($contador=0;$contador<sizeof($lista_jugadores);$contador++){
        $informes=consultarInformeMedicoJuagdor($lista_jugadores[$contador]["idfichaJugador"]);

        for($contador2=0;$contador2<sizeof($informes);$contador2++){
            $controles=consultarControl($informes[$contador2]["idinforme_medico"]);
            $altas_medicas=consultarAltaMedica($informes[$contador2]["idinforme_medico"]);
            if(sizeof($controles)>0){
                if(sizeof($altas_medicas)===0){
                    // print("holll");
                    $jugador=$lista_jugadores[$contador];
                    $jugador["informe_medico"]=$informes[$contador2];
                    $jugadores_sin_alta_medica[]=$jugador;
                }
            }
        }
    }
    return (sizeof($jugadores_sin_alta_medica)>0)?["respuesta"=> true, "datos" => $jugadores_sin_alta_medica]:["respuesta"=> false, "datos" =>[]];
} 




function consultarJugadoresHistorialLesiones($POST){
    $listas_jugadores_infrome=[];
    $ano="";
    $tipo="";
    for($contador=0;$contador<sizeof($POST["array_checkbox_centro_medico_filtro_jugador"]);$contador++){
        $id=$POST["array_checkbox_centro_medico_filtro_jugador"][$contador];
        $jugador=consultarJugador($id);
        if(array_key_exists("nombre",$jugador)){
            // $jugador["informes_medicos"]
            if(array_key_exists("array_checkbox_centro_medico_filtro_ano",$POST)){
                $ano=concatenarAnosFiltros($POST["array_checkbox_centro_medico_filtro_ano"]);
            }
            if(array_key_exists("array_checkbox_centro_medico_filtro_tipo_informe",$POST)){
                $tipo=concatenarTipoInformeFiltros($POST["array_checkbox_centro_medico_filtro_tipo_informe"]);
            }
            // print($tipo);
            $informes_medicos=consultarInformeMedicoJuagdorAnoYTipo($jugador["idfichaJugador"],$ano,$tipo);
            if(sizeof($informes_medicos)>0){
                for($contador2=0;$contador2<sizeof($informes_medicos);$contador2++){
                    $altas_medicas=consultarAltaMedica($informes_medicos[$contador2]["idinforme_medico"]);
                    $altas_deportivas=consultarAltaDeportiva($informes_medicos[$contador2]["idinforme_medico"]);
                    if(sizeof($altas_medicas)>0){
                        $informes_medicos[$contador2]["alta_medica"]=$altas_medicas;
                    }
                    else{
                        $informes_medicos[$contador2]["alta_medica"]=[];
                    }
                    if(sizeof($altas_deportivas)>0){
                        $informes_medicos[$contador2]["alta_deportiva"]=$altas_deportivas;
                    }
                    else{
                        $informes_medicos[$contador2]["alta_deportiva"]=[];
                    }
                }
                $jugador["informes_medicos"]=$informes_medicos;
                $listas_jugadores_infrome[]=$jugador;
            }
        }
    }
    return (sizeof($listas_jugadores_infrome)>0)?["respuesta"=> true, "datos" => $listas_jugadores_infrome]:["respuesta"=> false, "datos" =>[]];
} 
























function consultarJugadorHistorialLesiones($id){
    $listas_jugadores_infrome=[];
    $jugador=consultarJugador($id);
    if(array_key_exists("nombre",$jugador)){
            // $jugador["informes_medicos"]
            // print($tipo);
            $numero_de_lesiones=0;
            $tiempo_de_baja=0;
            $informes_medicos=consultarInformeMedicoJuagdorAnoYTipo($jugador["idfichaJugador"],"","");
            $lista_nuevos_incidentes=consultarNuevosIncidentes($jugador["idfichaJugador"]);
            $cantidad_atenciones=sizeof($lista_nuevos_incidentes);
            if(sizeof($informes_medicos)>0){
                for($contador2=0;$contador2<sizeof($informes_medicos);$contador2++){
                    $altas_medicas=consultarAltaMedica($informes_medicos[$contador2]["idinforme_medico"]);
                    $altas_deportivas=consultarAltaDeportiva($informes_medicos[$contador2]["idinforme_medico"]);
                    if(sizeof($altas_medicas)>0){
                        $informes_medicos[$contador2]["alta_medica"]=$altas_medicas;
                    }
                    else{
                        $informes_medicos[$contador2]["alta_medica"]=[];
                    }
                    if(sizeof($altas_deportivas)>0){
                        $informes_medicos[$contador2]["alta_deportiva"]=$altas_deportivas;
                    }
                    else{
                        $informes_medicos[$contador2]["alta_deportiva"]=[];
                    }
                    $tiempo_de_baja+=(int)$informes_medicos[$contador2]["agregado_dias_de_baja"];
                    $numero_de_lesiones++;
                }
                $jugador["total_tiempo_de_baja"]=$tiempo_de_baja;
                $jugador["total_numero_de_lesiones"]=$numero_de_lesiones;
                $jugador["total_atenciones_diarias"]=$cantidad_atenciones;
                $jugador["informes_medicos"]=$informes_medicos;
                $listas_jugadores_infrome[]=$jugador;
            }
            else{
                $jugador["total_tiempo_de_baja"]=$tiempo_de_baja;
                $jugador["total_numero_de_lesiones"]=$numero_de_lesiones;
                $jugador["total_atenciones_diarias"]=$cantidad_atenciones;
                $jugador["informes_medicos"]=[];
                $listas_jugadores_infrome[]=$jugador;
            }
    }

    return (sizeof($listas_jugadores_infrome)>0)?["respuesta"=> true, "datos" => $listas_jugadores_infrome]:["respuesta"=> false, "datos" =>[]];
} 


































function concatenarAnosFiltros($anos_list){
    $anos_str="";
    $anos_list_modificada=[];
    if(sizeof($anos_list)>1){
        for($contador=0;$contador<sizeof($anos_list);$contador++){
            $anos_list_modificada[]="agregado_fecha_lesion  LIKE '%".$anos_list[$contador]."%'";
        }
        $anos_str="AND (".(implode(" OR ",$anos_list_modificada)).")";
    }
    elseif(sizeof($anos_list)===1){
        $anos_str="AND (agregado_fecha_lesion  LIKE '%$anos_list[0]%')";
    }
    return $anos_str;
}

function concatenarTipoInformeFiltros($tipos_list){
    $tipos_str="";
    $tipos_list_modificada=[];
    if(sizeof($tipos_list)>1){
        for($contador=0;$contador<sizeof($tipos_list);$contador++){
            $tipos_list_modificada[]="tipo=".$tipos_list[$contador]."";
        }
        $tipos_str="AND (".(implode(" OR ",$tipos_list_modificada)).")";
    }
    elseif(sizeof($tipos_list)===1){
        $tipos_str="AND (tipo=$tipos_list[0])";
    }
    return $tipos_str;
}

function consultarEstadoEquipo(){
    $lista_jugadores=consultarJugadores();
    $total_hoy_atenciones_diarias=consularAtencionDiariasHoy();
    $numero_de_jugadores_disponible=sizeof($lista_jugadores);
    $numero_sin_alta_medica=0;
    $numero_sin_alta_deportiva=0;
    for($contador=0;$contador<sizeof($lista_jugadores);$contador++){
        $informes=consultarInformeMedicoJuagdor($lista_jugadores[$contador]["idfichaJugador"]);

        for($contador2=0;$contador2<sizeof($informes);$contador2++){
            $controles=consultarControl($informes[$contador2]["idinforme_medico"]);
            $altas_medicas=consultarAltaMedica($informes[$contador2]["idinforme_medico"]);
            $altas_deportivas=consultarAltaDeportiva($informes[$contador2]["idinforme_medico"]);
            if(sizeof($controles)>0){
                if(sizeof($altas_medicas)===0){
                    $numero_sin_alta_medica++;
                }
                if(sizeof($altas_deportivas)===0){
                    $numero_sin_alta_deportiva++;
                    $numero_de_jugadores_disponible--;
                }
            }
        }
    }

    return [
        "jugadores_disponibles" =>$numero_de_jugadores_disponible,
        "jugadores_sin_alta_medica" =>$numero_sin_alta_medica,
        "jugadores_sin_alta_deportiva" =>$numero_sin_alta_deportiva,
        "atenciones_diarias_hoy" =>$total_hoy_atenciones_diarias
    ];

} 

function consultarJugadores(){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador,club WHERE fichaJugador.idclub=club.idclub ;";
    $result_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_jugador)){
        $row["posicion"]=calcular_posicion_jugador($row["idfichaJugador"]);
        $array_datos[]=utf8_converter($row);
    }
    $link->close();
    return $array_datos;
}

function consultarJugadoresSerie($serie,$sexo){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador WHERE (serieActual='$serie' AND sexo= $sexo );";
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

function consultarJugador($id){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador WHERE idfichaJugador=$id;";
    // print($SQL);
    $result_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_jugador)){
        $row["posicion"]=calcular_posicion_jugador($row["idfichaJugador"]);
        $array_datos[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($array_datos)>0)?$array_datos[0] : [];
}

function consularAtencionDiariasHoy(){
    include("conexion.php");
    $fecha=date_futbolJoven();
    $SQL="SELECT * FROM atencion_diaria WHERE fecha_software LIKE '%".$fecha."%' ;";
    $atencion_diaria_result=$link->query($SQL);
    $datos_atencion_diaria=[];
    while($row_atencion_diaria=mysqli_fetch_array($atencion_diaria_result)){
        $datos_atencion_diaria[]=utf8_converter($row_atencion_diaria);
    }
    $link->close();
    return sizeof($datos_atencion_diaria);
}

function consultarInformeMedicoJuagdor($id){
    include("conexion.php");
    $SQL="SELECT * FROM informe_medico WHERE idfichaJugador=".$id.";";
    // print($SQL);
    $informe_medico_result=$link->query($SQL);
    $datos_informe_medico=[];
    while($row_informe_medico=mysqli_fetch_array($informe_medico_result)){
        $datos_informe_medico[]=utf8_converter($row_informe_medico);
    }
    $link->close();
    return $datos_informe_medico;
}

function consultarInformeMedicoJuagdorAnoYTipo($id,$ano,$tipo){
    include("conexion.php");
    $SQL="SELECT * FROM informe_medico WHERE idfichaJugador=".$id." $ano $tipo;";
    // print($SQL);
    $informe_medico_result=$link->query($SQL);
    $datos_informe_medico=[];
    while($row_informe_medico=mysqli_fetch_array($informe_medico_result)){
        $datos_informe_medico[]=utf8_converter($row_informe_medico);
    }
    $link->close();
    return $datos_informe_medico;
}

function consultarControl($id_informe){
    include("conexion.php");
    $SQL="SELECT * FROM atencion_diaria WHERE idinforme_medico=".$id_informe." AND tipo_atencion_atencion_diaria=2;";
    $atencion_diaria_alta_control_result=$link->query($SQL);
    $datos_atencion_diaria_alta_control=[];
    while($row_atencion_diaria_alta_control=mysqli_fetch_array($atencion_diaria_alta_control_result)){
        $datos_atencion_diaria_alta_control[]=utf8_converter($row_atencion_diaria_alta_control);
    }
    $link->close();
    return $datos_atencion_diaria_alta_control;
}

function consultarAltaMedica($id_informe){
    include("conexion.php");
    $SQL="SELECT * FROM atencion_diaria WHERE idinforme_medico=".$id_informe." AND tipo_atencion_atencion_diaria=3;";
    $atencion_diaria_alta_medica_result=$link->query($SQL);
    $datos_atencion_diaria_alta_medica=[];
    while($row_atencion_diaria_alta_medica=mysqli_fetch_array($atencion_diaria_alta_medica_result)){
        $datos_atencion_diaria_alta_medica[]=utf8_converter($row_atencion_diaria_alta_medica);
    }
    $link->close();
    return $datos_atencion_diaria_alta_medica;
}

function consultarAltaDeportiva($id_informe){
    include("conexion.php");
    $SQL="SELECT * FROM atencion_diaria WHERE idinforme_medico=".$id_informe." AND tipo_atencion_atencion_diaria=4;";
    $atencion_diaria_alta_deportiva_result=$link->query($SQL);
    $datos_atencion_diaria_alta_deportiva=[];
    while($row_atencion_diaria_alta_deportiva=mysqli_fetch_array($atencion_diaria_alta_deportiva_result)){
        $datos_atencion_diaria_alta_deportiva[]=utf8_converter($row_atencion_diaria_alta_deportiva);
    }
    $link->close();
    return $datos_atencion_diaria_alta_deportiva;
}

function consultarNuevosIncidentes($id_jugador){
    include("conexion.php");
    $SQL="SELECT * FROM atencion_diaria WHERE idfichaJugador=".$id_jugador." AND tipo_atencion_atencion_diaria=1;";
    $atencion_diaria_nuevo_incidente_result=$link->query($SQL);
    $datos_atencion_diaria_nuevo_incidente=[];
    while($row_atencion_diaria_nuevo_incidente=mysqli_fetch_array($atencion_diaria_nuevo_incidente_result)){
        $datos_atencion_diaria_nuevo_incidente[]=utf8_converter($row_atencion_diaria_nuevo_incidente);
    }
    $link->close();
    return $datos_atencion_diaria_nuevo_incidente;
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
	while($row = mysqli_fetch_array($resultado)){
		
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
	return $jugador['posicionPrincipal'];
    
}