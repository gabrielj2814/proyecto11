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

function consultarTestOcularesMensual(){
    $fecha=date_futbolJoven();
    $ano=explode("-",$fecha)[0];
    $mes=explode("-",$fecha)[1];
    include("conexion.php");
    $SQL="SELECT * FROM test_ocular WHERE fecha_evaluacuion_test_ocular LIKE '%$ano-$mes%'";
    $result_test_ocular=$link->query($SQL);
    $test_data=[];
    while($row = mysqli_fetch_array($result_test_ocular)){
        $test_data[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($test_data)>0)?["test"=>"ocular","respuesta"=>true,"datos"=>$test_data]:["test"=>"ocular","respuesta"=>false,"datos"=>[]];

}  

function obtenerTotaltestMensuales(){
    $totalTestOcular=consultarTestOcularesMensual();
    return ["ocular" => $totalTestOcular];

}

function consultarJugadoresSerie($serie,$sexo){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador WHERE serieActual=$serie AND sexo=$sexo;";
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

function operacionTestOcular($POST){
    if($POST["tipo_formulario"]==="false"){
        return registarTestOcular($POST);
    }
    else{
        return actualizarTestOcular($POST);
    }
}

function registarTestOcular($POST){
    include("conexion.php");
    $fecha=datetime_futbolJoven();
    $SQL="INSERT INTO test_ocular(
        fecha_evaluacuion_test_ocular,
        ano_test_ocular,
        numeros_jugadores_evaluados_test_ocular,
        id_jugador_mejor_tiempo_test_ocular,
        mejor_tiempo_test_ocular,
        id_jugador_peor_tiempo_test_ocular,
        peor_tiempo_test_ocular,
        media_test_ocular,
        fecha_software,
        nombre_usuario_software,
        observacion_test_ocular
    ) 
    VALUES(
        '".$POST["fecha_evaluacuion_test_ocular"]."',
        '".$POST["ano_test_ocular"]."',
        ".$POST["numeros_jugadores_evaluados_test_ocular"].",
        ".$POST["id_jugador_mejor_tiempo_test_ocular"].",
        ".$POST["mejor_tiempo_test_ocular"].",
        ".$POST["id_jugador_peor_tiempo_test_ocular"].",
        ".$POST["peor_tiempo_test_ocular"].",
        ".$POST["media_test_ocular"].",
        '".$fecha."',
        '".$POST["nombre_usuario_software"]."',
        '".$POST["observacion_test_ocular"]."'
    );";
    // print($SQL);
    $link->query($SQL);
    $id=$link->insert_id;
    $link->close();
    return ($id!==0)?["respuesta" => true,"id" => $id]:["respuesta" => false,"id" => 0];
}

function actualizarTestOcular($POST){
    // print("actualizando");
    include("conexion.php");
    $fecha=datetime_futbolJoven();
    $SQL="UPDATE test_ocular SET
        fecha_evaluacuion_test_ocular='".$POST["fecha_evaluacuion_test_ocular"]."',
        ano_test_ocular='".$POST["ano_test_ocular"]."',
        numeros_jugadores_evaluados_test_ocular=".$POST["numeros_jugadores_evaluados_test_ocular"].",
        id_jugador_mejor_tiempo_test_ocular=".$POST["id_jugador_mejor_tiempo_test_ocular"].",
        mejor_tiempo_test_ocular=".$POST["mejor_tiempo_test_ocular"].",
        id_jugador_peor_tiempo_test_ocular=".$POST["id_jugador_peor_tiempo_test_ocular"].",
        peor_tiempo_test_ocular=".$POST["peor_tiempo_test_ocular"].",
        media_test_ocular=".$POST["media_test_ocular"].",
        fecha_software='".$fecha."',
        nombre_usuario_software='".$POST["nombre_usuario_software"]."',
        observacion_test_ocular='".$POST["observacion_test_ocular"]."'

        WHERE 
        idtest_ocular=".$POST["idtest_ocular"]."
        ;";
    // print($SQL);
    $link->query($SQL);
    $id=$POST["idtest_ocular"];
    $link->close();
    eliminarDetalleTestOcular($POST["idtest_ocular"]);
    return ($id!==0)?["respuesta" => true,"id" => $id]:["respuesta" => false,"id" => 0];
}

function eliminarDetalleTestOcular($id){
    include("conexion.php");
    $SQL="DELETE FROM detalle_test_ocular WHERE idtest_ocular=$id;";
    $link->query($SQL);
    $link->close();
}

function registrarDetallesTestOcular($id,$idJugador,$velocidad,$ranking,$comentario,$nombre_usuario_software){
    include("conexion.php");
    $fecha=datetime_futbolJoven();
    $SQL="INSERT INTO detalle_test_ocular(
        idtest_ocular,
        idfichaJugador,
        velocidad_detalle_test_ocular,
        ranking_detalle_test_ocular,
        comentario_detalle_test_ocular,
        fecha_software,
        nombre_usuario_software
    )
    VALUES(
        ".$id.",
        ".$idJugador.",
        ".$velocidad.",
        ".$ranking.",
        '".$comentario."',
        '".$fecha."',
        '".$nombre_usuario_software."'
    );";
    $link->query($SQL);
    // $id=$link->insert_id;
    $link->close();
}

function consultarTestOculares($ano,$mes){
    $text_fecha=$ano."-".$mes;
    include("conexion.php");
    // $SQL="SELECT * FROM test_ocular WHERE  ano_test_ocular='$ano';";
    $SQL="SELECT * FROM test_ocular WHERE  fecha_evaluacuion_test_ocular LIKE '%".$text_fecha."%';";
    // print($text_fecha);
    $resultTestOcular=$link->query($SQL);
    $testsOculares=[];
    while($row_test_ocular = mysqli_fetch_array($resultTestOcular)){
        $row_test_ocular["info_jugador_mejor_tiempo"]=consultarJugadorDetalleTestOcular($row_test_ocular["id_jugador_mejor_tiempo_test_ocular"]); 
        $row_test_ocular["info_jugador_peor_tiempo"]=consultarJugadorDetalleTestOcular($row_test_ocular["id_jugador_peor_tiempo_test_ocular"]);
        $row_test_ocular["detalles_test_ocular"]=consultarDetallesTestOcular($row_test_ocular["idtest_ocular"]);
        $testsOculares[]=utf8_converter($row_test_ocular);
    }
    $link->close();
    return (sizeof($testsOculares)>0)?["repuesta"=> true,"datos" =>$testsOculares]:["repuesta"=> false,"datos" =>[]];
}

function consultarTestOcular($id){
    include("conexion.php");
    // $SQL="SELECT * FROM test_ocular WHERE  ano_test_ocular='$ano';";
    $SQL="SELECT * FROM test_ocular WHERE  idtest_ocular=$id;";
    // print($text_fecha);
    $resultTestOcular=$link->query($SQL);
    $testsOculares=[];
    while($row_test_ocular = mysqli_fetch_array($resultTestOcular)){
        $row_test_ocular["info_jugador_mejor_tiempo"]=consultarJugadorDetalleTestOcular($row_test_ocular["id_jugador_mejor_tiempo_test_ocular"]); 
        $row_test_ocular["info_jugador_peor_tiempo"]=consultarJugadorDetalleTestOcular($row_test_ocular["id_jugador_peor_tiempo_test_ocular"]);
        $row_test_ocular["detalles_test_ocular"]=consultarDetallesTestOcular($row_test_ocular["idtest_ocular"]);
        $testsOculares[]=utf8_converter($row_test_ocular);
    }
    $link->close();
    return $testsOculares[0];
}
function consultarDetallesTestOcular($idTestOcular){
    include("conexion.php");
    $SQL="SELECT * FROM detalle_test_ocular WHERE idtest_ocular=$idTestOcular;";
    $resultDetalleTestOcular=$link->query($SQL);
    $detalleTestsOculares=[];
    while($row_detalle_test_ocular = mysqli_fetch_array($resultDetalleTestOcular)){
        $row_detalle_test_ocular["jugador_info"]=consultarJugadorDetalleTestOcular($row_detalle_test_ocular["idfichaJugador"]);
        $detalleTestsOculares[]=utf8_converter($row_detalle_test_ocular);
    }
    $link->close();
    return (sizeof($detalleTestsOculares)>0)?$detalleTestsOculares:[];
}

function consultarJugadorDetalleTestOcular($idFichaJugador){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador WHERE idfichaJugador=$idFichaJugador;";
    $result_ficha_jugador=$link->query($SQL);
    $jugadores_data=[];
    while($row = mysqli_fetch_array($result_ficha_jugador)){
        $posicon=calcular_posicion_jugador2($row["idfichaJugador"]);
        $row["posicion"]=$posicon["codigo_posicion"];
        $row["texto_posicion"]=$posicon["texto_posicion"];
        $jugadores_data[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($jugadores_data)>0)?$jugadores_data[0]:[];
}

function eliminarTestOcular($id){
    include("conexion.php");
    $SQL="DELETE FROM test_ocular WHERE idtest_ocular=$id;";
    $link->query($SQL);
    $link->close();
    return ["respuesta" => true];
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









?>