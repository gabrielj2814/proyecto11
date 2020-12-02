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

        case '1':
            $string = $datos['string'];

            if( $string=='' ) {

                $resultado = $link->query("
                    SELECT * FROM campeonato
                ");

            } else {

                $resultado = $link->query("
                    SELECT * FROM campeonato
                    WHERE nombre_campeonato LIKE '".$string."%'
                ");

            }
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

    if($datos['idcampeonato']==''){//agregar nuevo jugador
        $query = $link->query("INSERT INTO campeonato (
            pais_campeonato,
            nombre_campeonato,
            division_campeonato,
            organizador_campeonato,
            fecha_campeonato,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['pais_campeonato'])."',
              '".utf8_decode($datos['nombre_campeonato'])."',
              '".utf8_decode($datos['division_campeonato'])."',
              '".utf8_decode($datos['organizador_campeonato'])."',
              '".utf8_decode($datos['fecha_campeonato'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query )  { 

            // Valor del ID del jugador recién insertado:
            $idcampeonato = $link->insert_id;            

            // ------------------- FOTO --------------- //
            if( isset($_FILES['foto_campeonato']['name']) ){
                if( $_FILES['foto_campeonato']['name'] == '' ) {
                    copy('../img/default.png', '../foto_campeonatos/'.$idcampeonato.'.png');
                } else {
                    copy('../subir_imagen3/buffer_imagen.png', '../foto_campeonatos/'.$idcampeonato.'.png');
                }

            } else{ // Si no selecciona foto (registro de usuario con nuevo perfil)... 
                copy('../subir_imagen3/buffer_imagen.png', '../foto_campeonatos/'.$idcampeonato.'.png');
            }

            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        }   
            
    }else{
        $query = $link->query("UPDATE campeonato SET 
            pais_campeonato = '".$datos['pais_campeonato']."',
            nombre_campeonato = '".utf8_decode(ucwords(strtolower($datos['nombre_campeonato'])))."',
            division_campeonato = '".$datos['division_campeonato']."',
            organizador_campeonato = '".utf8_decode(ucwords(strtolower($datos['organizador_campeonato'])))."',
            fecha_campeonato = '".utf8_decode($datos['fecha_campeonato'])."',
            nombre_usuario_software = '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
            fecha_software = '".getDateTime()."'
            WHERE idcampeonato = ".$datos['idcampeonato']."
        "); 

        if( $query )  { 

            $idcampeonato = $datos['idcampeonato'];

            // ------------------- FOTO --------------- //
            if( isset($_FILES['foto_campeonato']['name']) ){
                if( $_FILES['foto_campeonato']['name'] == '' ) {
                    
                    if (!file_exists('../foto_campeonatos/'.$idcampeonato.'.png')) {
                        copy('../img/default.png', '../foto_campeonatos/'.$idcampeonato.'.png');
                    } else {
                        copy('../foto_campeonatos/'.$datos['idcampeonato'].'.png', '../'.$datos['foto_anterior_campeonato']);
                    }

                } else {
                    copy('../subir_imagen3/buffer_imagen.png', '../foto_campeonatos/'.$datos['idcampeonato'].'.png');
                }

            } else{ // Si no selecciona foto (registro de usuario con nuevo perfil)... 
                copy('../subir_imagen3/buffer_imagen.png', '../foto_campeonatos/'.$datos['idcampeonato'].'.png');
            }

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
    $query = $link->query("DELETE FROM campeonato WHERE idcampeonato = ".$id." ");
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
        SELECT * FROM campeonato
        WHERE idcampeonato = ".$id."        
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