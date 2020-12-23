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

function consultarJugadoresSerie($serie,$sexo){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador WHERE serieActual=$serie AND sexo=$sexo ORDER BY fichaJugador.nombre ASC;";
    $result_ficha_jugador=$link->query($SQL);
    $jugadores_data=[];
    while($row = mysqli_fetch_array($result_ficha_jugador)){
        $posicon=calcular_posicion_jugador2($row["idfichaJugador"]);
        $row["posicion"]=$posicon["codigo_posicion"];
        $row["texto_posicion"]=$posicon["texto_posicion"];
        if($row["estado"]!=="0"){
            $jugadores_data[]=utf8_converter($row);
        }
    }
    $link->close();
    return (sizeof($jugadores_data)>0)?["respuesta"=>true,"datos"=>$jugadores_data]:["respuesta"=>false,"datos"=>[]];
}

function consultarTestMensual($ano,$mes){
    include("conexion.php");
    $SQL="SELECT * FROM test_reaccion WHERE fecha_evaluacion_test LIKE '%$ano-$mes%'";
    $result_test=$link->query($SQL);
    $test_data=[];
    while($row = mysqli_fetch_array($result_test)){
		$row["detalle_test"]=consultarDestalleTest($row["idtest_reaccion"]);
        $test_data[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($test_data)>0)?["respuesta" => true , "datos" => $test_data]:["respuesta" => false , "datos" => []];

} 

function consultarDestalleTest($id){
    include("conexion.php");
    $SQL="SELECT * FROM detalle_test_reaccion WHERE idtest_reaccion=$id";
    $result_detalle_test=$link->query($SQL);
    $test_data=[];
    while($row = mysqli_fetch_array($result_detalle_test)){
		$row["infoJugador"]=consultarJugadorTestDetalle($row["idfichaJugador"]);
        $test_data[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($test_data)>0)?$test_data:[];
}

function consultarJugadorTestDetalle($id){
	include("conexion.php");
    $SQL="SELECT * FROM fichaJugador WHERE idfichaJugador=$id";
    $result_ficha_jugador=$link->query($SQL);
    $jugadores_data=[];
    while($row = mysqli_fetch_array($result_ficha_jugador)){
        $posicon=calcular_posicion_jugador2($row["idfichaJugador"]);
        $row["posicion"]=$posicon["codigo_posicion"];
        $row["texto_posicion"]=$posicon["texto_posicion"];
        if($row["estado"]!=="0"){
            $jugadores_data[]=utf8_converter($row);
        }
    }
    $link->close();
    return (sizeof($jugadores_data)>0)?$jugadores_data[0]:[];
}


function calcular_posicion_jugador2($id){
    
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

function operacionTestReaccion($POST){
	if($POST["tipo_formulario"]==="false"){
        return registrarTestReaccion($POST);
    }
    else{
        return actualizarTestReaccion($POST);
    }
}

function registrarTestReaccion($POST){
	include("conexion.php");
	$fecha=datetime_futbolJoven();
	$SQL="INSERT INTO test_reaccion(
		fecha_evaluacion_test,
		observacion_test,
		promedio_1,
		promedio_2,
		promedio_3,
		promedio_4,
		numeros_evaluados_test,
		ano_test,
		fecha_software,
		nombre_usuario_software
	)
	VALUES(
		'".$POST["fecha_evaluacion_test"]."',
		'".$POST["observacion_test"]."',
		'".$POST["promedio_1_test"]."',
		'".$POST["promedio_2_test"]."',
		'".$POST["promedio_3_test"]."',
		'".$POST["promedio_4_test"]."',
		'".$POST["numeros_jugadores_evaluados_test"]."',
		'".$POST["ano_test"]."',
		'$fecha',
		'".$POST["nombre_usuario_software"]."'
	);";
	$link->query($SQL);
    $id=$link->insert_id;
    $link->close();
    return ($id!==0)?["respuesta" => true,"id" => $id]:["respuesta" => false,"id" => 0];
}

function actualizarTestReaccion($POST){
	include("conexion.php");
	$fecha=datetime_futbolJoven();
	$SQL="UPDATE test_reaccion SET 
		fecha_evaluacion_test='".$POST["fecha_evaluacion_test"]."',
		observacion_test='".$POST["observacion_test"]."',
		promedio_1='".$POST["promedio_1_test"]."',
		promedio_2='".$POST["promedio_2_test"]."',
		promedio_3='".$POST["promedio_3_test"]."',
		promedio_4='".$POST["promedio_4_test"]."',
		numeros_evaluados_test='".$POST["numeros_jugadores_evaluados_test"]."',
		ano_test='".$POST["ano_test"]."',
		fecha_software='$fecha',
		nombre_usuario_software='".$POST["nombre_usuario_software"]."'
		WHERE 
		idtest_reaccion=".$POST["idtest_reaccion"].";";
	$link->query($SQL);
    $id=$POST["idtest_reaccion"];
	$link->close();
	eliminarDetallesTest($id);
    return ($id!==0)?["respuesta" => true,"id" => $id]:["respuesta" => false,"id" => 0];
}

function eliminarDetallesTest($id){
	include("conexion.php");
	$SQL="DELETE FROM detalle_test_reaccion WHERE idtest_reaccion=$id;";
	$link->query($SQL);
    $link->close();
}

function registrarDetallesTesteaccion($idReaccion,$idJugador,$tiempo_1,$tiempo_2,$tiempo_3,$tiempo_4,$ranking,$comentario,$nombre_usuario_software){
	include("conexion.php");
	$fecha=datetime_futbolJoven();
	$SQL="INSERT INTO detalle_test_reaccion(
		idtest_reaccion,
		idfichaJugador,
		tiempo_1,
		tiempo_2,
		tiempo_3,
		tiempo_4,
		comentario,
		ranking,
		fecha_software,
		nombre_usuario_software
	)
	VALUES(
		".$idReaccion.",
		".$idJugador.",
		'".$tiempo_1."',
		'".$tiempo_2."',
		'".$tiempo_3."',
		'".$tiempo_4."',
		'".$comentario."',
		'".$ranking."',
		'".$fecha."',
		'".$nombre_usuario_software."'
	);";

	$link->query($SQL);
    $id=$link->insert_id;
    $link->close();
}

function eliminarTestReaccion($id){
    include("conexion.php");
    $SQL="DELETE FROM test_reaccion WHERE idtest_reaccion=$id;";
    $link->query($SQL);
    $link->close();
    return ["respuesta" => true];
}

function consultarTestReaccion($id){
	include("conexion.php");
    $SQL="SELECT * FROM test_reaccion WHERE idtest_reaccion=$id;";
    $result_test=$link->query($SQL);
    $test_data=[];
    while($row = mysqli_fetch_array($result_test)){
		$row["detalle_test"]=consultarDestalleTest($row["idtest_reaccion"]);
        $test_data[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($test_data)>0)?$test_data[0]:[];
}


?>