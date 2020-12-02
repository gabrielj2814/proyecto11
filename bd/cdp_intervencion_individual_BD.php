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
                    SELECT * FROM cdp_intervencion_individual
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = cdp_intervencion_individual.idfichaJugador
                    WHERE cdp_intervencion_individual.idfichaJugador = ".$idfichaJugador."
                    ORDER BY cdp_intervencion_individual.idcdp_intervencion_individual DESC
                    LIMIT 1 
                ");

                while( $row2 = mysqli_fetch_assoc( $resultado2 ) ) {
                    $row['idcdp_intervencion_individual'] = $row2['idcdp_intervencion_individual'];
                    $row['idfichaJugador'] = $row2['idfichaJugador'];
                    $row['fecha_cdp_intervindiv'] = $row2['fecha_cdp_intervindiv'];
                    $row['motivoconsulta_cdp_intervindiv'] = $row2['motivoconsulta_cdp_intervindiv'];
                    $row['objetivos_cdp_intervindiv'] = $row2['objetivos_cdp_intervindiv'];
                    $row['actividad_cdp_intervindiv'] = $row2['actividad_cdp_intervindiv'];
                    $row['intervdinamica_cdp_intervindiv'] = $row2['intervdinamica_cdp_intervindiv'];
                    $row['observaciones_cdp_intervindiv'] = $row2['observaciones_cdp_intervindiv'];
                } 

                // Cantidad de registros de informes de gestión de talento:
                $resultado3 = $link->query("
                    SELECT COUNT(cdp_intervencion_individual.idcdp_intervencion_individual) FROM cdp_intervencion_individual
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = cdp_intervencion_individual.idfichaJugador
                    WHERE cdp_intervencion_individual.idfichaJugador = ".$idfichaJugador."
                ");

                while( $row3 = mysqli_fetch_assoc( $resultado3 ) ) {
                    $row['cantidad_informes_cdp_interindiv'] = $row3['COUNT(cdp_intervencion_individual.idcdp_intervencion_individual)'];
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
                SELECT * FROM cdp_intervencion_individual 
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = cdp_intervencion_individual.idfichaJugador
                WHERE cdp_intervencion_individual.idfichaJugador = ".$idfichaJugador." 
            ");
                
            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                $dato[] = utf8_converter( $row );          
            }
            break; 

        case '3':
            $idcdp_intervencion_individual = $datos['idcdp_intervencion_individual']; 
            
            $resultado = $link->query("
                SELECT * FROM cdp_intervencion_individual 
                WHERE idcdp_intervencion_individual = ".$idcdp_intervencion_individual." 
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
    if($datos['idcdp_intervencion_individual']==''){//agregar nuevo jugador
        $query = $link->query("INSERT INTO cdp_intervencion_individual (
            idfichaJugador,
            fecha_cdp_intervindiv,
            motivoconsulta_cdp_intervindiv,
            objetivos_cdp_intervindiv,
            actividad_cdp_intervindiv,
            intervdinamica_cdp_intervindiv,
            observaciones_cdp_intervindiv,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['idfichaJugador'])."',
              '".utf8_decode($datos['fecha_cdp_intervindiv'])."',
              '".utf8_decode($datos['motivoconsulta_cdp_intervindiv'])."',
              '".utf8_decode($datos['objetivos_cdp_intervindiv'])."',
              '".utf8_decode($datos['actividad_cdp_intervindiv'])."',
              '".utf8_decode($datos['intervdinamica_cdp_intervindiv'])."',
              '".utf8_decode($datos['observaciones_cdp_intervindiv'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query )  { 
            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        }   
            
    }else{
        $query = $link->query("UPDATE cdp_intervencion_individual SET 
            fecha_cdp_intervindiv = '".$datos['fecha_cdp_intervindiv']."',
            motivoconsulta_cdp_intervindiv = '".utf8_decode(ucwords(strtolower($datos['motivoconsulta_cdp_intervindiv'])))."',
            objetivos_cdp_intervindiv = '".utf8_decode(ucwords(strtolower($datos['objetivos_cdp_intervindiv'])))."',
            actividad_cdp_intervindiv = '".utf8_decode(ucwords(strtolower($datos['actividad_cdp_intervindiv'])))."',
            intervdinamica_cdp_intervindiv = '".utf8_decode(ucwords(strtolower($datos['intervdinamica_cdp_intervindiv'])))."',
            observaciones_cdp_intervindiv = '".utf8_decode(ucwords(strtolower($datos['observaciones_cdp_intervindiv'])))."',
            nombre_usuario_software = '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
            fecha_software = '".getDateTime()."'
            WHERE idcdp_intervencion_individual = '".$datos['idcdp_intervencion_individual']."'
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
    $query = $link->query("DELETE FROM cdp_intervencion_individual WHERE idcdp_intervencion_individual = ".$id." ");
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
        SELECT * FROM cdp_intervencion_individual
        LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = cdp_intervencion_individual.idfichaJugador
        LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador  
        WHERE cdp_intervencion_individual.idcdp_intervencion_individual = ".$id."        
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