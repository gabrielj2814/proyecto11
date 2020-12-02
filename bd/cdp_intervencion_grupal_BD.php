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
            $serie_cdp_intervgrupal = $datos['serie_cdp_intervgrupal'];
            $anio = $datos['anio'];
            $mes = $datos['mes'];

            $resultado = $link->query("
                SELECT * FROM cdp_intervencion_grupal 
                WHERE YEAR(fecha_cdp_intervgrupal) = '".$anio."' 
                AND MONTH(fecha_cdp_intervgrupal) = '".$mes."'
                AND serie_cdp_intervgrupal = '".$serie_cdp_intervgrupal."' 
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
    if($datos['idcdp_intervencion_grupal']==''){//agregar nuevo jugador
        $query = $link->query("INSERT INTO cdp_intervencion_grupal (
            fecha_cdp_intervgrupal,
            serie_cdp_intervgrupal,
            intervdinamica_cdp_intervgrupal,
            materiales_cdp_intervgrupal,
            objetivos_cdp_intervgrupal,
            actividadrealizar_cdp_intervgrupal,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['fecha_cdp_intervgrupal'])."',
              '".utf8_decode($datos['serie_cdp_intervgrupal'])."',
              '".utf8_decode($datos['intervdinamica_cdp_intervgrupal'])."',
              '".utf8_decode($datos['materiales_cdp_intervgrupal'])."',
              '".utf8_decode($datos['objetivos_cdp_intervgrupal'])."',
              '".utf8_decode($datos['actividadrealizar_cdp_intervgrupal'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query )  { 
            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        }   
            
    }else{
        $query = $link->query("UPDATE cdp_intervencion_grupal SET 
            fecha_cdp_intervgrupal = '".utf8_decode(ucwords(strtolower($datos['fecha_cdp_intervgrupal'])))."',
            serie_cdp_intervgrupal = '".utf8_decode(ucwords(strtolower($datos['serie_cdp_intervgrupal'])))."',
            intervdinamica_cdp_intervgrupal = '".utf8_decode(ucwords(strtolower($datos['intervdinamica_cdp_intervgrupal'])))."',
            materiales_cdp_intervgrupal = '".utf8_decode(ucwords(strtolower($datos['materiales_cdp_intervgrupal'])))."',
            objetivos_cdp_intervgrupal = '".utf8_decode(ucwords(strtolower($datos['objetivos_cdp_intervgrupal'])))."',
            actividadrealizar_cdp_intervgrupal = '".utf8_decode(ucwords(strtolower($datos['actividadrealizar_cdp_intervgrupal'])))."',
            nombre_usuario_software = '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
            fecha_software = '".getDateTime()."'
            WHERE idcdp_intervencion_grupal = '".$datos['idcdp_intervencion_grupal']."'
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
    $query = $link->query("DELETE FROM cdp_intervencion_grupal WHERE idcdp_intervencion_grupal = ".$id." ");
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
        SELECT * FROM cdp_intervencion_grupal
        WHERE idcdp_intervencion_grupal = ".$id."        
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