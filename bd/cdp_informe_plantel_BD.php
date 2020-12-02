<?php
function getDateTime(){
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

function ver_datos( $datos ){
    include("conexion.php");
    
    $dato = [];

    $tipo_consulta = $datos['tipo_consulta'];
    
    switch( $tipo_consulta ) {

        case '0':
            $array_sexo = $datos['array_sexo'];
            $array_numero_serie = $datos['array_numero_serie'];        
            for(
                $i_1 = 0,
                $i_2 = 0; 
                // ---------------------- //
                $i_1 < count( $array_sexo ),
                $i_2 < count( $array_numero_serie );
                // ---------------------- //
                $i_1++,
                $i_2++
            ) {

                $resultado = $link->query("
                    SELECT COUNT(idfichaJugador) FROM fichaJugador 
                    WHERE sexo = ".$array_sexo[$i_1]." 
                    AND serieActual = ".$array_numero_serie[$i_2]."
                ");
                
                
                while($row = mysqli_fetch_assoc($resultado)) {
                    $dato[] =  $row["COUNT(idfichaJugador)"];
                }

            }
            break;

        // ------------------------------------------------------------------------ //

        case '1':
            $serie_cdp_informeplantel = $datos['serie_cdp_informeplantel'];
            $anio = $datos['anio'];
            $mes = $datos['mes'];

            $resultado = $link->query("
                SELECT * FROM cdp_informe_plantel 
                WHERE YEAR(fecha_cdp_informeplantel) = '".$anio."' 
                AND MONTH(fecha_cdp_informeplantel) = '".$mes."'
                AND serie_cdp_informeplantel = '".$serie_cdp_informeplantel."' 
            ");
                
            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                $dato[] = utf8_converter( $row );          
            }
            break;

    }


    $link->close();
    return $dato;       
    
}

function guardar($datos){
    include("conexion.php");
    $respuesta = "";
    $query = "";
    if($datos['idcdp_informe_plantel']==''){//agregar nuevo jugador
        $query = $link->query("INSERT INTO cdp_informe_plantel (
            fecha_cdp_informeplantel,
            serie_cdp_informeplantel,
            titulo_cdp_informeplantel,
            informe_cdp_informeplantel,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['fecha_cdp_informeplantel'])."',
              '".utf8_decode($datos['serie_cdp_informeplantel'])."',
              '".utf8_decode($datos['titulo_cdp_informeplantel'])."',
              '".utf8_decode($datos['informe_cdp_informeplantel'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query )  { 
            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        }   
            
    }else{
        $query = $link->query("UPDATE cdp_informe_plantel SET 
            fecha_cdp_informeplantel = '".utf8_decode(ucwords(strtolower($datos['fecha_cdp_informeplantel'])))."',
            serie_cdp_informeplantel = '".utf8_decode(ucwords(strtolower($datos['serie_cdp_informeplantel'])))."',
            titulo_cdp_informeplantel = '".utf8_decode(ucwords(strtolower($datos['titulo_cdp_informeplantel'])))."',
            informe_cdp_informeplantel = '".utf8_decode(ucwords(strtolower($datos['informe_cdp_informeplantel'])))."',
            nombre_usuario_software = '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
            fecha_software = '".getDateTime()."'
            WHERE idcdp_informe_plantel = '".$datos['idcdp_informe_plantel']."'
        "); 

        if( $query )  { 
            $respuesta = 2; // UPDATE ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        } 

    }
    
    $link->close();
    return $respuesta;

}

function eliminar($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM cdp_informe_plantel WHERE idcdp_informe_plantel = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}

function buscar_datosPDF($id){
    include("conexion.php");

    $resultado = $link->query("
        SELECT * FROM cdp_informe_plantel
        WHERE idcdp_informe_plantel = ".$id."        
    ");

     while($row = mysqli_fetch_array($resultado)){ 
        $dato[] = utf8_converter($row);
    }
    
    // var_dump( $dato );
    unset($row);


    $link->close();
    return $dato;
    
}

?>