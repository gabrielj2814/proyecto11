<?php 
include('../../../bd/udc_gestion_talento_BD.php');

$data='';

$datos_informe = buscar_datosPDF( $_POST['idudc_gestion_talento'] );

// ----------------------------------------- Inicio de los Arrays ----------------------------------------- //
// ---------- Países:
$dir_img_system = '../../../config/';
$array_paises = [
    [0, 'Todos', ''],
    [1, 'Chile', $dir_img_system.'chile.png', 1, 'Chileno'],
    [2, 'Argentina', $dir_img_system.'argentina.png', 1, 'Argentino'],
    [3, 'Venezuela', $dir_img_system.'venezuela.png', 1, 'Venezolano'],
    [4, 'Brasil', $dir_img_system.'brasil.png', 1, 'Brasileño'],
    [5, 'Colombia', $dir_img_system.'colombia.png', 1, 'Colombiano'],
    [6, 'Ecuador', $dir_img_system.'ecuador.png', 1, 'Ecuatoriano'],
    [7, 'Uruguay', $dir_img_system.'uruguay.png', 1, 'Uruguayo'],
    [8, 'Perú', $dir_img_system.'peru.png', 1, 'Peruano'],
    [9, 'Paraguay', $dir_img_system.'paraguay.png', 'Paraguayo'],
    [10, 'México', $dir_img_system.'mexico.png', 1, 'Mexicano'],
    [11, 'España', $dir_img_system.'espana.png', 2, 'Español'],
    [12, 'Inglaterra', $dir_img_system.'inglaterra.png', 2, 'Inglés'],
    [13, 'Alemania', $dir_img_system.'alemania.png', 2, 'Alemán'],
    [14, 'China', $dir_img_system.'china.png', 2, 'Chino'],
    [15, 'Bélgica', $dir_img_system.'belgica.png', 2, 'Belga'],
    [16, 'Bolivia', $dir_img_system.'bolivia.png', 2, 'Boliviano'],
    [17, 'Costa Rica', $dir_img_system.'costa_rica.png', 2, 'Costarricense'],
    [18, 'Estados Unidos', $dir_img_system.'estados_unidos.png', 2, 'Estadounidense'],
    [19, 'Honduras', $dir_img_system.'honduras.png', 2, 'Hondureño'],
    [20, 'El Salvador', $dir_img_system.'el_salvador.png', 2, 'Salvadoreño'],
    [21, 'Escocia', $dir_img_system.'escocia.png', 2, 'Escocés'],
    [22, 'Francia', $dir_img_system.'francia.png', 2, 'Francés'],
    [23, 'Grecia', $dir_img_system.'grecia.png', 2, 'Griego'],
    [24, 'Holanda', $dir_img_system.'holanda.png', 2, 'Holandés'],
    [25, 'Italia', $dir_img_system.'italia.png', 2, 'Italiano'],
    [26, 'Japón', $dir_img_system.'japon.png', 2, 'Japonés'],
    [27, 'Portugal', $dir_img_system.'portugal.png', 2, 'Portugués'],
    [28, 'Rusia', $dir_img_system.'rusia.png', 2, 'Ruso'],
    [29, 'Turquía', $dir_img_system.'turquia.png', 2, 'Turco'],
];

// Array Posiciones:
// Nota: La posición 2 hace referencia número del grupo de posiciones y el 3 al nombre:
$array_posiciones = [
    [0, 'Todos'],
    [1, 'Arquero', 1, 'Arqueros'],
    [2, 'Defensa Central', 2, 'Defensas'],
    [3, 'Lateral Izquierdo', 2, 'Defensas'],
    [4, 'Lateral Derecho', 2, 'Defensas'],
    [5, 'Volante Defensivo', 3, 'Mediocampistas'],
    [6, 'Volante Izquierdo', 3, 'Mediocampistas'],
    [7, 'Volante Derecho', 3, 'Mediocampistas'],
    [8, 'Volante Mixto', 3, 'Mediocampistas'],
    [9, 'Volante Ofensivo', 3, 'Mediocampistas'],
    [10, 'Extremo Izquierdo', 4, 'Delanteros'],
    [11, 'Extremo Derecho', 4, 'Delanteros'],
    [12, 'Delantero Centro', 4, 'Delanteros'],
];

// Array de Divisiones:
$array_divisiones = [];

// Chile:
$array_divisiones[1] = [];
$array_divisiones[1][1] = [1, 'Primera A'];
$array_divisiones[1][2] = [2, 'Primera B'];
$array_divisiones[1][3] = [3, 'Segunda Profesional'];
$array_divisiones[1][4] = [4, 'Tercera A'];    

// Argentina:
$array_divisiones[2] = [];
$array_divisiones[2][5] = [5, 'Primera División'];
$array_divisiones[2][6] = [6, 'Primera Nacional'];
$array_divisiones[2][7] = [7, 'Primera B Metropolitana'];    

// Uruguay:
$array_divisiones[7] = [];
$array_divisiones[7][8] = [8, 'Primera División'];
$array_divisiones[7][9] = [9, 'Segunda División'];   

// Venezuela:
$array_divisiones[3] = [];
$array_divisiones[3][10] = [10, 'Primera División'];
$array_divisiones[3][11] = [11, 'Segunda División'];

// --- Perú:
$array_divisiones[8] = [];
$array_divisiones[8][12] = [12, 'Primera División'];
$array_divisiones[8][13] = [13, 'Segunda División'];

// --- Brasil:
$array_divisiones[4] = [];
$array_divisiones[4][14] = [14, 'Serie A Primera División'];
$array_divisiones[4][15] = [15, 'Serie B Segunda División'];

// --- Ecuador:
$array_divisiones[6] = [];
$array_divisiones[6][16] = [16, 'Serie A Primera División'];

// --- Colombia:
$array_divisiones[5] = [];
$array_divisiones[5][17] = [17, 'Primera A'];
$array_divisiones[5][18] = [18, 'Primera B'];   
 
// --- Paraguay:
$array_divisiones[9] = [];
$array_divisiones[9][19] = [19, 'Primera División'];     

// --- Bolivia:
$array_divisiones[16] = [];
$array_divisiones[16][20] = [20, 'Primera División']; 
     
// --- México:
$array_divisiones[10] = [];
$array_divisiones[10][21] = [21, 'Primera División Liga MX'];
$array_divisiones[10][22] = [22, 'Ascenso Mexicano'];

// Array de Lateralidad:
$array_lateralidad = [
  [0, 'Todos'],
  [1, 'Derecho'],
  [2, 'Izquierdo'],
  [3, 'Ambidiestro'],
];

// ----------------------------------------- Fin de los Arrays ----------------------------------------- //

// Datos de Gestión de Talentos:
$fecha_talento = $datos_informe[0]['fecha_talento'];
$perfil_comunicacional_talento = $datos_informe[0]['perfil_comunicacional_talento'];
$reputacion_deportiva_talento = $datos_informe[0]['reputacion_deportiva_talento'];
$redes_sociales_talento = $datos_informe[0]['redes_sociales_talento'];
$aspectos_mejorar_talento = $datos_informe[0]['aspectos_mejorar_talento'];
$actividades_realizar_talento = $datos_informe[0]['actividades_realizar_talento'];

$status_talento = $datos_informe[0]['status_talento'];

switch( $status_talento ) {
    case '0': // <---- Jugador seleccionable.
        $status_talento = "Jugador seleccionable";
        break;
    case '1': // <---- Jugador pre seleccionable.
        $status_talento = "Jugador pre seleccionable";
        break;
    case '2': // <---- Jugador en desarrollo.
        $status_talento = "Jugador en desarrollo";
        break;                                                                 
}


// Datos de Sociología:
$estudios_mesosociales = $datos_informe[0]['estudios_mesosociales'];
$estudios_microsociales = $datos_informe[0]['estudios_microsociales'];

// ------------------------- Datos del jugador ------------------------- //

$nombre = $datos_informe[0]['nombre'];
$apellido1 = $datos_informe[0]['apellido1'];
$apellido2 = $datos_informe[0]['apellido2'];

// --------- Fecha de Nacimiento y Edad:
$fechaNacimiento = '';
$edad = '';
if( is_null( $datos_informe[0]['fechaNacimiento'] ) || $datos_informe[0]['fechaNacimiento'] == '' || $datos_informe[0]['fechaNacimiento'] == '0000-00-00' ) {
  $fechaNacimiento = 'No especificada';
  $edad = 'No especificada';  
} else {
  $fechaNacimiento = $datos_informe[0]['fechaNacimiento'];
  $edad = calcularEdad( $fechaNacimiento ) . ' años';  
}

// --------- Nacionalidad:
$num_nacionalidad = '';
$nacionalidad = '';
$bandera_nacionalidad = '';
if( is_null( $datos_informe[0]['nacionalidad1'] ) || $datos_informe[0]['nacionalidad1'] == '' || $datos_informe[0]['nacionalidad1'] == '0' ) {
  $num_nacionalidad = '';
  $nacionalidad = 'No especificada';
  $bandera_nacionalidad = $dir_img_system.'default.png';
} else {
  $num_nacionalidad = intval( $datos_informe[0]['nacionalidad1'] );
  $nacionalidad = $array_paises[$num_nacionalidad][4];   
  $bandera_nacionalidad = $array_paises[$num_nacionalidad][2];
}

// --------- Altura:
$altura = '';
if( is_null( $datos_informe[0]['altura'] ) || $datos_informe[0]['altura'] == '' || $datos_informe[0]['altura'] == '0' ) {
  $altura = 'No especificada';
} else {
  $altura = $datos_informe[0]['altura'] . ' cm';
}

// --------- Posición:
$posicion0 = "";

$display_arquero = '';
$display_defensa_central = '';
$display_lateral_izquierdo = '';
$display_lateral_derecho = '';
$display_volante_defensivo = '';
$display_volante_izquierdo = '';
$display_volante_derecho = '';
$display_volante_mixto = '';
$display_volante_ofensivo = '';
$display_extremo_izquierdo = '';
$display_extremo_derecho = '';
$display_delantero_central = '';


// ------------------------------------ Posición 0 ------------------------------------ //
$style_posicion_0 = 'display:block; background-color: orange;';

$leyenda_posicion_0 = '';

if( is_null( $datos_informe[0]['posicion0'] ) || $datos_informe[0]['posicion0'] == '' || $datos_informe[0]['posicion0'] == '0' || $datos_informe[0]['posicion0'] == '999' ) {
  
  $posicion0 = '';

  $leyenda_posicion_0 = '
  <div class="posicion-jugador" style="position: absolute; top: 920px; left: 40px; background-color: orange; display: block;"></div>
  <p class="text-posicion-jugador" style="position: absolute; top: 930px; left: 80px;">Principal</p>
  ';
   
} else {

  $num_posicion0 = intval( $datos_informe[0]['posicion0'] );
  
  switch ( $num_posicion0 ) {
    case '1': 
      $display_arquero = $style_posicion_0;
      break;
    case '2':
      $display_defensa_central = $style_posicion_0;
      break;     
    case '3':
      $display_lateral_izquierdo = $style_posicion_0;
      break;            
    case '4':
      $display_lateral_derecho = $style_posicion_0;
      break;                  
    case '5':
      $display_volante_defensivo = $style_posicion_0;
      break; 
    case '6':
      $display_volante_izquierdo = $style_posicion_0;
      break;
    case '7':
      $display_volante_derecho = $style_posicion_0;
      break;
    case '8':
      $display_volante_mixto = $style_posicion_0;
      break;
    case '9':
      $display_volante_ofensivo = $style_posicion_0;
      break;  
    case '10':
      $display_extremo_izquierdo = $style_posicion_0;
      break;
    case '11':
      $display_extremo_derecho = $style_posicion_0;
      break;                                                            
    case '12':
      $display_delantero_central = $style_posicion_0;
      break;    
  }

  $posicion0 = $array_posiciones[$num_posicion0][1]; 

  $leyenda_posicion_0 = '
  <div class="posicion-jugador" style="position: absolute; top: 920px; left: 40px; '.$style_posicion_0.' "></div>
  <p class="text-posicion-jugador" style="position: absolute; top: 930px; left: 80px;">Principal</p>
  ';

}

// ------------------------------------ Posición 1 ------------------------------------ //
$style_posicion_1 = 'display:block; background-color: #eeeeee;';

$leyenda_posicion_1 = '';

if( !is_null( $datos_informe[0]['posicion1'] ) || $datos_informe[0]['posicion1'] != '' || $datos_informe[0]['posicion1'] != '0' || $datos_informe[0]['posicion1'] != '999' ) {
  
  $num_posicion1 = intval( $datos_informe[0]['posicion1'] );
  
  switch ( $num_posicion1 ) {
    case '1': 
      $display_arquero = $style_posicion_1;
      break;
    case '2':
      $display_defensa_central = $style_posicion_1;
      break;     
    case '3':
      $display_lateral_izquierdo = $style_posicion_1;
      break;            
    case '4':
      $display_lateral_derecho = $style_posicion_1;
      break;                  
    case '5':
      $display_volante_defensivo = $style_posicion_1;
      break; 
    case '6':
      $display_volante_izquierdo = $style_posicion_1;
      break;
    case '7':
      $display_volante_derecho = $style_posicion_1;
      break;
    case '8':
      $display_volante_mixto = $style_posicion_1;
      break;
    case '9':
      $display_volante_ofensivo = $style_posicion_1;
      break;  
    case '10':
      $display_extremo_izquierdo = $style_posicion_1;
      break;
    case '11':
      $display_extremo_derecho = $style_posicion_1;
      break;                                                            
    case '12':
      $display_delantero_central = $style_posicion_1;
      break;    
  }

  $posicion1 = $array_posiciones[$num_posicion1][1]; 

  $leyenda_posicion_1 = '
  <div class="posicion-jugador" style="position: absolute; top: 960px; left: 40px; '.$style_posicion_1.' "></div>
  <p class="text-posicion-jugador" style="position: absolute; top: 970px; left: 80px;">Polivalencia 1</p>
  ';

}

// ------------------------------------ Posición 2 ------------------------------------ //
$style_posicion_2 = 'display:block; background-color: lightblue;';

$leyenda_posicion_2 = '';

if( !is_null( $datos_informe[0]['posicion2'] ) || $datos_informe[0]['posicion2'] != '' || $datos_informe[0]['posicion2'] != '0' || $datos_informe[0]['posicion2'] != '999' ) {
  
  $num_posicion2 = intval( $datos_informe[0]['posicion2'] );
  
  switch ( $num_posicion2 ) {
    case '1': 
      $display_arquero = $style_posicion_2;
      break;
    case '2':
      $display_defensa_central = $style_posicion_2;
      break;     
    case '3':
      $display_lateral_izquierdo = $style_posicion_2;
      break;            
    case '4':
      $display_lateral_derecho = $style_posicion_2;
      break;                  
    case '5':
      $display_volante_defensivo = $style_posicion_2;
      break; 
    case '6':
      $display_volante_izquierdo = $style_posicion_2;
      break;
    case '7':
      $display_volante_derecho = $style_posicion_2;
      break;
    case '8':
      $display_volante_mixto = $style_posicion_2;
      break;
    case '9':
      $display_volante_ofensivo = $style_posicion_2;
      break;  
    case '10':
      $display_extremo_izquierdo = $style_posicion_2;
      break;
    case '11':
      $display_extremo_derecho = $style_posicion_2;
      break;                                                            
    case '12':
      $display_delantero_central = $style_posicion_2;
      break;    
  }

  $posicion2 = $array_posiciones[$num_posicion2][1]; 

  $leyenda_posicion_2 = '
  <div class="posicion-jugador" style="position: absolute; top: 1000px; left: 40px; '.$style_posicion_2.' "></div>
  <p class="text-posicion-jugador" style="position: absolute; top: 1010px; left: 80px;">Polivalencia 2</p>
  ';

}
// var_dump($datos_informe[0]['idfichaJugador']);
// --------- Foto del jugador:
$foto_jugador = '../../foto_jugadores/'.$datos_informe[0]['idfichaJugador'].'.png';
$nombre_completo_jugador = $nombre . " " . $apellido1 . " " . $apellido2;

// --------- Fecha fin de contrato:
$fechafin_contrato_jugadorclub = '';
if( is_null( $datos_informe[0]['fechafin_contrato_jugadorclub'] ) || $datos_informe[0]['fechafin_contrato_jugadorclub'] == '' || $datos_informe[0]['fechafin_contrato_jugadorclub'] == '0000-00-00' ) {
  $fechafin_contrato_jugadorclub = "No especificado";
} else {
  $fechafin_contrato_jugadorclub = 'Hasta el ' . $datos_informe[0]['fechafin_contrato_jugadorclub']; 
}

// --------- Lateralidad:
$lateralidad = '';
if( is_null( $datos_informe[0]['dinamico'] ) || $datos_informe[0]['dinamico'] == '' || $datos_informe[0]['dinamico'] == '0' ) {
  $lateralidad = 'No especificada';
} else {
  $lateralidad = intval( $datos_informe[0]['dinamico'] );
  $lateralidad = $array_lateralidad[$lateralidad][1];
}

// --------- Seleccionado:
$seleccionado = '';
if( is_null( $datos_informe[0]['seleccionado'] ) || $datos_informe[0]['seleccionado'] == '' || $datos_informe[0]['seleccionado'] == '0' ) {
  $seleccionado = 'No especificado';
} else {
  $seleccionado = $datos_informe[0]['seleccionado'];
  if( $seleccionado == '1' ) {
    $seleccionado = 'Sí';
  } else {
    $seleccionado = 'No';
  }
}


// Tabla 't_club_jugador':
$pais_club = $datos_informe[0]['pais_club'];

// --------- División:
$division_club = "";
if( is_null( $datos_informe[0]['division_club'] ) || $datos_informe[0]['division_club'] == '' || $datos_informe[0]['division_club'] == '0' ) {
  $division_club = 'No especificada';
} else {
  $division_club = intval( $datos_informe[0]['division_club'] );
  $division_club = $array_divisiones[$pais_club][$division_club][1];
}

$nombre_club;
if( is_null( $datos_informe[0]['nombre_club'] ) || $datos_informe[0]['nombre_club'] == '' ) {
  $nombre_club = 'No especificado';
} else {
  $nombre_club = $datos_informe[0]['nombre_club'];
}

$foto_club_jugador = '../../foto_clubes/'.$datos_informe[0]['idclub'].'.png';

/*
// Tabla 't_club_rival':
$nombre_club_rival = $datos_informe[0]['nombre_club_rival'];
$foto_club_rival = '../../foto_clubes/'.$datos_informe[0]['idclub_rival'].'';                


// Tabla 'campeonato':
$nombre_campeonato = $datos_informe[0]['nombre_campeonato'];
$foto_campeonato = '../../foto_campeonatos/'.$datos_informe[0]['idcampeonato'].'';
*/

/*
$fecha_software_date = substr($fecha_software, 0, 10);
$fecha_software_time = substr($fecha_software, 11, 19);  
*/

// ------------------------------ INICIO DE LOS DATOS DE GESTIÓN DE TALENTOS ------------------------------ //
$datos_gestion_talentos = '
    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="width: 100%">
        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">PERFIL COMUNICACIONAL</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$perfil_comunicacional_talento.'</textarea>
        </div>

        <div class="float-right" style="width: 45%;">
          <p class="p-textarea">REPUTACIÓN DEPORTIVA</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$reputacion_deportiva_talento.'</textarea>
        </div>
      </div>
    </div>

    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="width: 100%">
        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">REDES SOCIALES</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$redes_sociales_talento.'</textarea>
        </div>

        <div class="float-right" style="width: 45%;">
          <p class="p-textarea">ASPECTOS A MEJORAR</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$aspectos_mejorar_talento.'</textarea>
        </div>
      </div>
    </div> 

    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="width: 100%">

        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">ACTIVIDADES A REALIZAR</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$actividades_realizar_talento.'</textarea>
        </div>

      </div>
    </div>        
';
// ------------------------------ FIN DE LOS DATOS DE GESTIÓN DE TALENTOS------------------------------ //

// ------------------------------ INICIO DE LOS DATOS DE SOCIOLOGÍA ------------------------------ //
$datos_sociologia = '
    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="width: 100%">
        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">ESTUDIOS MESOSOCIALES</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$estudios_mesosociales.'</textarea>
        </div>

        <div class="float-right" style="width: 45%;">
          <p class="p-textarea">ESTUDIOS MICROSOCIALES</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$estudios_microsociales.'</textarea>
        </div>
      </div>
    </div>    
';
// ------------------------------ FIN DE LOS DATOS DE SOCIOLOGÍA ------------------------------ //
  
$data.= '

  <!-- ================================ Fin del header ================================ -->
  <header style="display: block; text-align: -webkit-center;">
    <div style="width: 100%; background-color: #4f636d;">
        <p style="color: white; text-transform: uppercase; margin: 0; font-weight: bold; padding: 8px; text-align: center; font-size: 11px;">gestión de talentos</p>
    </div>

    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin-top: 25px;">
      
      <div style="width: 35%;display: inline-block;float: left;">
        <img class="displaylb" src="'.$foto_jugador.'" style="margin-top: 10px;width: 120px;height: 120px;border-radius: 60px;border: solid #9E9E9E 1px;/* float: left; */">

        <p style="font-size: 11px; text-transform: uppercase; margin-top: 6px;">'.$nombre_completo_jugador.'</p>
      </div>

      <div style="width: 65%;display: inline-block;float: right;"> 

        <div style="width: 50%; float: left;">
          <table class="t-datos-jugador">
            <tbody>
                <tr>
                  <td class="titulo-datos-principales" style="max-width: 80px; width: 60px;">Club actual:</td>
                  <td class="datos-principales" style="max-width: 150px; width: 120px; text-align: left;">'.$nombre_club.'</td>
                  <td style="width: 130px;"><img src="'.$foto_club_jugador.'" style="margin-left: 5px; width: 15px; height: 15px;" /> </td>
              </tr>
            </tbody>
          </table>

          <table class="t-datos-jugador">
            <tbody>
              <tr>
                <td class="titulo-datos-principales">Fecha de Nac:</td>
                <td class="datos-principales">'.$fechaNacimiento.'</td>
              </tr>
            </tbody>
          </table>

          <table class="t-datos-jugador">
              <tbody>
                <tr>
                  <td class="titulo-datos-principales">Edad:</td>
                  <td class="datos-principales">'.$edad.'</td>
                </tr>
            </tbody>
          </table>

          <table class="t-datos-jugador">
              <tbody>
                <tr>
                  <td class="titulo-datos-principales">Nacionalidad:</td>
                  <td class="datos-principales" style="max-width: 75px;">'.$nacionalidad.'</td>
                  <td><img src="'.$bandera_nacionalidad.'" style="margin-left: 5px; width: 15px; height: 10px;" /> </td>
                </tr>
            </tbody>
          </table>          

          <table class="t-datos-jugador">
              <tbody>
                <tr>
                  <td class="titulo-datos-principales">Estatura:</td>
                  <td class="datos-principales">'.$altura.'</td>
                </tr>
            </tbody>
          </table>          
        </div>

        <!-- ========================================== -->        
        <div style="width: 50%; float: right;">
          <table class="t-datos-jugador">
            <tbody>
                <tr>
                  <td class="titulo-datos-principales">Posición:</td>
                  <td class="datos-principales">'.$posicion0.'</td>
              </tr>
            </tbody>
          </table>

          <table class="t-datos-jugador">
            <tbody>
              <tr>
                <td class="titulo-datos-principales">División:</td>
                <td class="datos-principales">'.$division_club.'</td>
              </tr>
            </tbody>
          </table>

          <table class="t-datos-jugador">
              <tbody>
                <tr>
                  <td class="titulo-datos-principales">Contrato</td>
                  <td class="datos-principales">'.$fechafin_contrato_jugadorclub.'</td>
                </tr>
            </tbody>
          </table>

          <table class="t-datos-jugador">
              <tbody>
                <tr>
                  <td class="titulo-datos-principales">Lateralidad:</td>
                  <td class="datos-principales">'.$lateralidad.'</td>
                </tr>
            </tbody>
          </table> 

          <table class="t-datos-jugador">
              <tbody>
                <tr>
                  <td class="titulo-datos-principales">Seleccionado:</td>
                  <td class="datos-principales">'.$seleccionado.'</td>
                </tr>
            </tbody>
          </table> 

        </div>               

      </div>
    </div>  
  </header>
  <!-- ================================ Fin del header ================================ -->


  <!-- ================================ Inicio del cuerpo ================================ -->
  <main>

    <br/><br/><br/><br/><br/><br/><br/><br/><br/>

    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="height: 1px; background-color: #d5d4d4; margin: auto; margin-bottom: 20px;"></div>
      <br/>
      <p style="text-transform: uppercase; font-size: 11px; color: gray;">gestión de talentos</p>
    </div>

    '.$datos_gestion_talentos.'

    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <!-- <div style="height: 1px; background-color: #d5d4d4; margin: auto; margin-bottom: 20px;"></div> -->
      <br/>
      <p style="text-transform: uppercase; font-size: 11px; color: gray;">sociología</p>
    </div>

    '.$datos_sociologia.'    


    <br/><br/>

    <div style="clear:both; position: absolute; bottom: 10px;">
      <div>
        <p style="text-transform: uppercase; font-size: 8px; margin-top:100px; text-align: center;">status del jugador</p>
      </div>
      <br/>
      <div style="width: 30%; background-color: #4f7182; clear: both; margin: auto; border: 2px solid #7d7d7d;">
          <p style="color: white; text-transform: none; margin: 0; font-weight: normal; padding: 5px; font-size: 8px; text-align: center;">'.$status_talento.'</p>
      </div>  
    </div>    

    <!-- Salto de página -->
    <!-- <div style="page-break-after: always;"></div> -->

    <!--
    <footer style="width: 100%; background-color: #4f636d;">
    </footer>
    -->  
    
  </main>


';

/*=====  End of HTML PRINT  ======*/

// $salida = str_replace("  ", "_", 'edgar');
// $salida = str_replace(" ", "_", $salida);

require_once('../../../dompdf/autoload.inc.php');
require_once ('../../../dompdf/lib/html5lib/Parser.php');
require_once ('../../../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php');
require_once ('../../../dompdf/lib/php-svg-lib/src/autoload.php');
require_once ('../../../dompdf/src/Autoloader.php');
use Dompdf\Dompdf;
/////////////////////////////// CONFIGURACION DEL DOCUMENTO /////////////////////////////
$pdf = new Dompdf();
$pdf->setPaper('letter', 'portrait');  //A4, letter  ;  portrait (posicion vertical; landscape (posición horizontal))
$titulo_documento_salida = "[11Analytics]_udc_gestion_talento.pdf";
// $titulo_documento_salida = "[11Analytics]_tratamiento_lesiones_".$salida.".pdf";
/////////////////////////////////////////////////////////////////////////////////////////

$html='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>

* {
  margin:0;
  padding:0
}

header {
}

footer {
  position: fixed; 
  bottom: -20px; 
  left: 0px; 
  right: 0px;
  height: 50px; 
}

@font-face {
  font-family: "Helvetica";
}

.page_break {page-break-before:always; } 

body{
  font-family: "Open Sans", sans-serif;
  margin-bottom: 1cm;  
  margin: 0;
}
.page_break {
    page-break-before: always;
}

.tabla_partidos_jugador {
  text-align: center;
}

.tabla_partidos_jugador tr td {
  text-align: center;
}

h4 {
  text-transform: uppercase;
}


.txCenter{text-align:center;}
.txCenterL{text-align-last:left;}
.txLeft{text-align:left;vertical-align: top;}

.tx18{font-size: 18px;}
.tx14{font-size: 14px;}
.tx13{font-size: 13px;}
.tx12{font-size: 12px;}
.tx10{font-size: 10px;}
.tx8{font-size: 8px;}

.margintitular{
  margin-top: -30px;
}

.th-textarea {
    color: black;
    font-weight: bold;
    text-align: center;
    padding: 5px;
}

.textarea-social {
    -webkit-appearance: none;
    -moz-appearance: none;
    border: 1px solid black;
    border-radius: 5px;
    margin-bottom: 0px;
    text-align: center;
    line-height: 16px;
    text-align: justify;
    padding: 10px;
    font-size: 12px;
}

.btn{
  border-bottom-left-radius:2px;
  border-top-left-radius:2px;
  background-color: #059c4c;
  color: white;
  font-weight: bold;
}
.fecha{
  padding: 8px 14px 8px 14px;
  margin-right: -7px;
}
.fecha1{
  padding: 8px 40px 8px 40px;
  margin-right: -7px;
}
.fecha2{
  padding: 5px;
  border:solid 2px #059c4c;
}
.fecha3{
  margin-top: -0.5px;
  padding: 6px;
  border:solid 2px #059c4c;
}

.fondoClaro{
  background-color: #D4FFDC; 
}

.fondoBlanco{
  background-color: white; 
}

.fondoNormal{
 background-color: #059c4c; 
}
.totalpagina{
  width: 90%;
}
.todopagina{
  width: 100%;
}
.porcion1{
  width: 10%;
}
.porcion2{
  width: 80%;
}
.displaylb{
  display: inline-block;
}
.totalpaginas{
  width: 91.4%;
  margin-left: 4px;
}
.pp{

  padding: 5px 6px 5px 6px;
  border: solid 2px #059c4c;
  margin-top: -0.3px;
}
.w95{
    width: 96.2%;
}
.especialarea{
  width: 98.7%;
  margin: 0px;
  margin-left: 0px;
  height: auto;
  min-height: 40px;
}
.fisiot{
  width: 92.6%;
  margin: 0px 33px;
}
.displayf{
  display: inline-flex;
}
.pard{
  margin:0px 20px;
  padding: 0px 12px;
}
.margen{
  margin: 5px 0px 5px 50px;
}
.tablet{
  background-color: #d4ffdc;
  border: solid 2px #059c4c;
  border-radius: 2px;
  padding: 2px;
}
.left{
  text-align: left;
  margin-left: 5%;
}
.float{
  float: right; 
  margin: 10px 70px 40px 0px;
}
.wa{
  margin-left: 35px;
}
.wab{
  margin-left: 30px;
}

.tabla-datos-principales-derecha {
  float: right;
  padding: 1px;
}

.tabla-datos-izquierda {
  float: left;
  padding: 1px;
}

.titulo-datos-principales {
  font-weight: normal;
  text-align: left;
  /*width: 100px;*/  
}

.datos-principales {
  margin-left: 10px;
  color: gray;
}

.float-left {
  float: left;
}

.float-right {
  float: right;
}

.gray-textarea {
  background-color: #eeeeee;
  border: 1px solid #bebdbd;
  height: 75px;
  text-align: left;
  font-size: 9px;
}

.p-textarea {
  text-align: left;
  margin: 10px 5px;
  text-transform: uppercase;
  font-size: 7px;
}

.position-relative { 
  position: relative;
}

.position-absolute { 
  position: absolute;
}

.posicion-jugador {
  display: none;
  border: 1px solid gray;
  padding: 0.5em;
  -webkit-appearance: none;
  border-radius: 90%;
  width: 12px;
  height: 12px;
  background-color: white;  
}

.arquero { 
  top: -60px;
  margin: auto;
}

.defensa-central { 
  top: -155px;
  margin: auto;
}

.lateral-izquierdo {
  left: -80px;
  margin: auto;
  top: -205px;
}

.lateral-derecho {
  left: 80px;
  margin: auto;
  top: -237px;
}

.volante-defensivo {
  margin: auto;
  top: -335px; 
}

.volante-izquierdo {
  top: -385px;
  left: 30px;
}

.volante-derecho {
  top: -417px;
  left: 160px;
}

.volante-mixto {
  top: -470px;
  margin: auto;
}

.extremo-izquierdo {
  top: -585px;
  left: 30px; 
}

.extremo-derecho {
  top: -617px;
  left: 240px;
}

.delantero-centro {
  margin: auto;
  top: -650px;
}


.text-posicion-jugador {
  text-align: center;
  font-size: 8px;
  position: relative;
  top: 2px;
}

.t-datos-jugador {
  margin-bottom: 7px;
  font-size: 10px;
  color: #565454;
}

.t-black {
  background-color: #413d3d;
  color: white;
  border: 2px solid #7d7d7d;
}

.t-black thead tr {
  text-transform: uppercase;
}

.t-black thead tr th {
  padding: 3px;
  font-weight: normal;
}

#tabla_resumen_partidos thead tr th {
  max-width: 30px;
  width: 30px;
  text-align: center;
}

#tabla_resumen_partidos tbody tr td {
  max-width: 30px;
  width: 30px;
  text-align: center;
}

#tabla_detalles_partido thead tr th {
  max-width: 30px;
  width: 30px;
  text-align: center;
}

#tabla_detalles_partido tbody tr td {
  max-width: 30px;
  width: 30px;
  text-align: center;
}

#tabla_estadisticas_informe thead tr th {
  text-align: left;
}

#tabla_estadisticas_informe tbody tr td {
  text-align: left;
}

</style>

</head>
';

$html.='
<body>
  '.$data.'
</body>
</html>
';

$pdf->loadHtml($html);


//////////////////////////////////// EXPORTAR EL DOCUMENTO //////////////////////////////
$pdf->render();

// $pdf->stream($titulo_documento_salida);

$output = $pdf->output();
file_put_contents("../../reportes_pdf/".$titulo_documento_salida, $output);

echo json_encode($titulo_documento_salida);

?>