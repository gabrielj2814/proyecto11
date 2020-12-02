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

/* ---------------- Función que convierte la fecha en formato dia/mes/año. ----------------- */
function dbfecha( $fecha ){
    $fecha = substr($fecha,8,2)."-".substr($fecha,5,2)."-".substr($fecha,0,4);
    return $fecha;    
}

/* ---------------- Función que calcula edad. ----------------- */
function calcularEdad( $fechaNacimiento ) {
    dbfecha( $fechaNacimiento ); // <--- Fecha de Nacimiento en formado dd-mm-aaaa.

    $diaFechaNacimiento = substr($fechaNacimiento, 8, 2);
    $diaFechaNacimiento = intval( $diaFechaNacimiento );      

    $mesFechaNacimiento = substr($fechaNacimiento, 5, 2);
    $mesFechaNacimiento = intval( $mesFechaNacimiento );                       

    $anioFechaNacimiento = substr($fechaNacimiento, 0, 4);
    $anioFechaNacimiento = intval( $anioFechaNacimiento );

    // ----------- DÍA ACTUAL ----------- //
    $diafechaActual = date("d");
    $diafechaActual = intval( $diafechaActual );                

    // ----------- MES ACTUAL ----------- //
    $mesfechaActual = date("m");
    $mesfechaActual = intval( $mesfechaActual );

    // ----------- AÑO ACTUAL ----------- //
    $aniofechaActual = date("Y");
    $aniofechaActual = intval( $aniofechaActual );      


    $edad = $aniofechaActual - $anioFechaNacimiento;
            
    /*
    if( $mesfechaActual < $mesFechaNacimiento ) {
        $edad--;
    }

    if( $mesfechaActual > $mesFechaNacimiento ) {
        $edad;
    }

    if( $mesfechaActual === $mesFechaNacimiento ) {
        // Comparamos los días:
        if( $diafechaActual >= $diaFechaNacimiento ) {
        $edad;
        } else {
        $edad--;
        }
    } 
    */           

    return $edad;

}

function t_serie ($serie) {
    $arreglo = explode('_', $serie);
    return $arreglo;
}

function ver_series_total () {
    $dato = [
        '8_1'  => 'SUB-8 Masculina',
        '9_1'  => 'SUB-9 Masculina',
        '10_1' => 'SUB-10 Masculina',
        '11_1' => 'SUB-11 Masculina',
        '12_1' => 'SUB-12 Masculina',
        '13_1' => 'SUB-13 Masculina',
        '14_1' => 'SUB-14 Masculina',
        '15_1' => 'SUB-15 Masculina',
        '16_1' => 'SUB-16 Masculina',
        '17_1' => 'SUB-17 Masculina',
        '19_1' => 'SUB-19 Masculina',
        
        '99_1' => 'Primer Equipo',
        
        '15_2' => 'SUB-15 Femenina',
        '17_2' => 'SUB-17 Femenina',
        '99_2' => 'Primer Equipo'
    ];
    return $dato;
}


function jugadores_por_serie ($serie) {
    include("conexion.php");
    
    $dato = 0;
    $con    = t_serie($serie);
    $serie  = $con[0];
    $sexo   = $con[1];
    
    if ($resultado = $link->query("SELECT *
        FROM fichaJugador
        WHERE fichaJugador.serieActual='".$serie."'
        AND fichaJugador.sexo='".$sexo."'
        AND fichaJugador.estado <> 0 AND fichaJugador.estado <> 1 AND fichaJugador.estado <> 3
    ")){
        $dato = $resultado->num_rows;
    };
    
    $link->close();
    return $dato;
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
                    AND fichaJugador.estado <> 0 AND fichaJugador.estado <> 1 AND fichaJugador.estado <> 3
                ");
                
                
                while($row = mysqli_fetch_assoc($resultado)) {
                    $dato[] =  $row["COUNT(idfichaJugador)"];
                }

            }
            break;

        // ------------------------------------------------------------------------ //

        case '1':
            $string = $datos['string'];
            $sexo = $datos['sexo']; 
            $numero_serie = $datos['numero_serie'];
            
            if( $string=='' ) {

                $resultado = $link->query("
                    SELECT *
                    FROM fichaJugador
                    LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                    WHERE sexo = ".$sexo." 
                    AND serieActual = ".$numero_serie."
                    AND posicionCancha.numero_posicion = 0
                    AND fichaJugador.estado <> 0 AND fichaJugador.estado <> 1 AND fichaJugador.estado <> 3
                    ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
                ");

            } else {

                $resultado = $link->query("
                    SELECT *
                    FROM fichaJugador
                    LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                    WHERE (fichaJugador.nombre LIKE '".$datos['string']."%' OR fichaJugador.apellido1 LIKE '".$datos['string']."%' OR fichaJugador.apellido2 LIKE '".$datos['string']."%')
                    AND sexo = ".$sexo." 
                    AND serieActual = ".$numero_serie."
                    AND posicionCancha.numero_posicion = 0
                    AND fichaJugador.estado <> 0 AND fichaJugador.estado <> 1 AND fichaJugador.estado <> 3
                    ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
                ");

            }


            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                
                $idfichaJugador = $row["idfichaJugador"];
                 
                // Última informe de gestión de talento:
                $resultado2 = $link->query("
                    SELECT * FROM udc_gestion_talento
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_gestion_talento.idfichaJugador
                    WHERE udc_gestion_talento.idfichaJugador = ".$idfichaJugador."
                    ORDER BY udc_gestion_talento.idudc_gestion_talento DESC
                    LIMIT 1 
                ");

                while( $row2 = mysqli_fetch_assoc( $resultado2 ) ) {
                    $row['idudc_gestion_talento'] = $row2['idudc_gestion_talento'];
                    $row['idfichaJugador'] = $row2['idfichaJugador'];
                    $row['fecha_talento'] = $row2['fecha_talento'];
                    $row['perfil_comunicacional_talento'] = $row2['perfil_comunicacional_talento'];
                    $row['reputacion_deportiva_talento'] = $row2['reputacion_deportiva_talento'];
                    $row['redes_sociales_talento'] = $row2['redes_sociales_talento'];
                    $row['aspectos_mejorar_talento'] = $row2['aspectos_mejorar_talento'];
                    $row['actividades_realizar_talento'] = $row2['actividades_realizar_talento'];
                    $row['status_talento'] = $row2['status_talento'];
                } 

                // Cantidad de registros de informes de gestión de talento:
                $resultado3 = $link->query("
                    SELECT COUNT(udc_gestion_talento.idudc_gestion_talento) FROM udc_gestion_talento
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_gestion_talento.idfichaJugador
                    WHERE udc_gestion_talento.idfichaJugador = ".$idfichaJugador."
                ");

                while( $row3 = mysqli_fetch_assoc( $resultado3 ) ) {
                    $row['cantidad_informes_gestion_talento'] = $row3['COUNT(udc_gestion_talento.idudc_gestion_talento)'];
                }                             

                // Consultando posiciones:
                $resultado_4 = $link->query("
                SELECT 
                posicionCancha.posicion,
                posicionCancha.numero_posicion
                FROM fichaJugador        
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."        
                ");

                while($row_4 = mysqli_fetch_assoc($resultado_4)) {  
                    $posicion = $row_4['posicion'];
                    $numero_posicion = $row_4['numero_posicion']; 
                    $row['posicion'.$numero_posicion] = $posicion;                                        
                }                

                // $row["ultimos_datos_social"] = $ultimos_datos_social;
                $dato[] = utf8_converter( $row );          

            
            }
            break;

        case '2':
            $idfichaJugador = $datos['idfichaJugador']; 
            
            $resultado = $link->query("
                SELECT * FROM udc_gestion_talento 
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_gestion_talento.idfichaJugador
                WHERE udc_gestion_talento.idfichaJugador = ".$idfichaJugador." 
            ");
                
            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                $dato[] = utf8_converter( $row );          
            }
            break; 

        case '3':
            $idudc_gestion_talento = $datos['idudc_gestion_talento']; 
            
            $resultado = $link->query("
                SELECT * FROM udc_gestion_talento 
                WHERE idudc_gestion_talento = ".$idudc_gestion_talento." 
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
    if($datos['idudc_gestion_talento']==''){//agregar nuevo jugador
        $query = $link->query("INSERT INTO udc_gestion_talento (
            idfichaJugador,
            fecha_talento,
            perfil_comunicacional_talento,
            reputacion_deportiva_talento,
            redes_sociales_talento,
            aspectos_mejorar_talento,
            actividades_realizar_talento,
            status_talento,
            estudios_mesosociales,
            estudios_microsociales,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['idfichaJugador'])."',
              '".date_futbolJoven()."',
              '".utf8_decode($datos['perfil_comunicacional_talento'])."',
              '".utf8_decode($datos['reputacion_deportiva_talento'])."',
              '".utf8_decode($datos['redes_sociales_talento'])."',
              '".utf8_decode($datos['aspectos_mejorar_talento'])."',
              '".utf8_decode($datos['actividades_realizar_talento'])."',
              '".utf8_decode($datos['status_talento'])."',
              '".utf8_decode($datos['estudios_mesosociales'])."',
              '".utf8_decode($datos['estudios_microsociales'])."',              
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query )  { 
            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        }   
            
    }else{
        $query = $link->query("UPDATE udc_gestion_talento SET 
            fecha_talento = '".date_futbolJoven()."',
            perfil_comunicacional_talento = '".utf8_decode(ucwords(strtolower($datos['perfil_comunicacional_talento'])))."',
            reputacion_deportiva_talento = '".utf8_decode(ucwords(strtolower($datos['reputacion_deportiva_talento'])))."',
            redes_sociales_talento = '".utf8_decode(ucwords(strtolower($datos['redes_sociales_talento'])))."',
            aspectos_mejorar_talento = '".utf8_decode(ucwords(strtolower($datos['aspectos_mejorar_talento'])))."',
            actividades_realizar_talento = '".utf8_decode(ucwords(strtolower($datos['actividades_realizar_talento'])))."',
            status_talento = '".utf8_decode(ucwords(strtolower($datos['status_talento'])))."',
            estudios_mesosociales = '".utf8_decode(ucwords(strtolower($datos['estudios_mesosociales'])))."',
            estudios_microsociales = '".utf8_decode(ucwords(strtolower($datos['estudios_microsociales'])))."',            
            nombre_usuario_software = '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
            fecha_software = '".getDateTime()."'
            WHERE idudc_gestion_talento = '".$datos['idudc_gestion_talento']."'
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
    $query = $link->query("DELETE FROM udc_gestion_talento WHERE idudc_gestion_talento = ".$id." ");
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
        SELECT * FROM udc_gestion_talento 
        LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_gestion_talento.idfichaJugador
        WHERE udc_gestion_talento.idudc_gestion_talento = ".$id."     
    ");

     while($row = mysqli_fetch_array($resultado)){ 



        $idfichaJugador = $row['idfichaJugador'];



        // Consultando posiciones:
        $resultado_2 = $link->query("
          SELECT 

          -- Tabla 'fichaJugador_club':
          fichaJugador_club.idfichaJugador_club,
          fichaJugador_club.fechafin_contrato_jugadorclub,

          -- Tabla 'club':
          club.idclub,
          club.pais_club,
          club.division_club,
          club.nombre_club

          FROM fichaJugador_club 
          -- Datos del club del jugador:
          LEFT JOIN club ON club.idclub = fichaJugador_club.idclub
          WHERE fichaJugador_club.idfichaJugador = ".$idfichaJugador."
        ");

        while($row_2 = mysqli_fetch_assoc($resultado_2)) {  
            $row['idfichaJugador_club'] = $row_2['idfichaJugador_club']; 
            $row['fechafin_contrato_jugadorclub'] = $row_2['fechafin_contrato_jugadorclub']; 
            $row['idclub'] = $row_2['idclub'];                 
            $row['pais_club'] = $row_2['pais_club'];  
            $row['division_club'] = $row_2['division_club'];  
            $row['nombre_club'] = $row_2['nombre_club']; 
        }

        // Consultando posiciones:
        $resultado_3 = $link->query("
        SELECT 
        posicionCancha.posicion,
        posicionCancha.numero_posicion
        FROM posicionCancha                         
        WHERE idfichaJugador = ".$idfichaJugador."
        ");

        while($row_3 = mysqli_fetch_assoc($resultado_3)) {  
            $posicion = $row_3['posicion'];
            $numero_posicion = $row_3['numero_posicion']; 
            $row['posicion'.$numero_posicion] = $posicion;                                        
        }

        $dato[] = utf8_converter( $row );        
    }
    
    // var_dump( $dato );
    unset($row);


    $link->close();
    return $dato;
    
}

?>