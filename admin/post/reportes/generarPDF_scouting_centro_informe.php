<?php 
include('../../../bd/scouting_centro_BD.php');

$data='';

$datos_informe = buscar_datosPDF( $_POST['idinforme_cscouting_jugador'] );

// ------------ Estadísticas del informe scouting (tabla 'estadistica_informe_csj'):
$tr_estadisticas_informe_scouting = '';
$estadisticas_informe_scouting = ver_estadisticas_informe_reporte( $_POST['idinforme_cscouting_jugador'] );
for ($i=0; $i < count($estadisticas_informe_scouting); $i++) { 

  $descripcion_estadistica_icsj = $estadisticas_informe_scouting[$i]['descripcion_estadistica_icsj'];
  $valor_estadistica_icsj = $estadisticas_informe_scouting[$i]['valor_estadistica_icsj'];

  $tr_estadisticas_informe_scouting.= '
    <tr>
      <td><div style="max-width: 150px; width: 150px; text-align: left;">'.$descripcion_estadistica_icsj.'</div></td>
      <td><div style="max-width: 450px; width: 450px; text-align: left;">'.$valor_estadistica_icsj.'</div></td>  
    </tr>
  ';
}

// ----------------------------------------- Inicio de los Arrays ----------------------------------------- //
// ---------- Países:
$dir_img_system = '../../../config/';



// Array Países:
$array_paises = [
        'AF' => 'Afganistán',
        'AL' => 'Albania',
        'DE' => 'Alemania',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antártida',
        'AG' => 'Antigua y Barbuda',
        'AN' => 'Antillas Holandesas',
        'SA' => 'Arabia Saudí',
        'DZ' => 'Argelia',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaiyán',
        'BS' => 'Bahamas',
        'BH' => 'Bahrein',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BE' => 'Bélgica',
        'BZ' => 'Belice',
        'BJ' => 'Benin',
        'BM' => 'Bermudas',
        'BY' => 'Bielorrusia',
        'MM' => 'Birmania',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia y Herzegovina',
        'BW' => 'Botswana',
        'BR' => 'Brasil',
        'BN' => 'Brunei',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'BT' => 'Bután',
        'CV' => 'Cabo Verde',
        'KH' => 'Camboya',
        'CM' => 'Camerún',
        'CA' => 'Canadá',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CY' => 'Chipre',
        'VA' => 'Ciudad del Vaticano (Santa Sede)',
        'CO' => 'Colombia',
        'KM' => 'Comores',
        'CG' => 'Congo',
        'CD' => 'Congo, República Democrática del',
        'KR' => 'Corea',
        'KP' => 'Corea del Norte',
        'CI' => 'Costa de Marfíl',
        'CR' => 'Costa Rica',
        'HR' => 'Croacia (Hrvatska)',
        'CU' => 'Cuba',
        'DK' => 'Dinamarca',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'EC' => 'Ecuador',
        'EG' => 'Egipto',
        'SV' => 'El Salvador',
        'AE' => 'Emiratos Árabes Unidos',
        'ER' => 'Eritrea',
        'SI' => 'Eslovenia',
        'ES' => 'España',
        'US' => 'Estados Unidos',
        'EE' => 'Estonia',
        'ET' => 'Etiopía',
        'FJ' => 'Fiji',
        'PH' => 'Filipinas',
        'FI' => 'Finlandia',
        'FR' => 'Francia',
        'GA' => 'Gabón',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GD' => 'Granada',
        'GR' => 'Grecia',
        'GL' => 'Groenlandia',
        'GP' => 'Guadalupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GY' => 'Guayana',
        'GF' => 'Guayana Francesa',
        'GN' => 'Guinea',
        'GQ' => 'Guinea Ecuatorial',
        'GW' => 'Guinea-Bissau',
        'HT' => 'Haití',
        'HN' => 'Honduras',
        'HU' => 'Hungría',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IQ' => 'Irak',
        'IR' => 'Irán',
        'IE' => 'Irlanda',
        'BV' => 'Isla Bouvet',
        'CX' => 'Isla de Christmas',
        'IS' => 'Islandia',
        'KY' => 'Islas Caimán',
        'CK' => 'Islas Cook',
        'CC' => 'Islas de Cocos o Keeling',
        'FO' => 'Islas Faroe',
        'HM' => 'Islas Heard y McDonald',
        'FK' => 'Islas Malvinas',
        'MP' => 'Islas Marianas del Norte',
        'MH' => 'Islas Marshall',
        'UM' => 'Islas menores de Estados Unidos',
        'PW' => 'Islas Palau',
        'SB' => 'Islas Salomón',
        'SJ' => 'Islas Svalbard y Jan Mayen',
        'TK' => 'Islas Tokelau',
        'TC' => 'Islas Turks y Caicos',
        'VI' => 'Islas Vírgenes (EEUU)',
        'VG' => 'Islas Vírgenes (Reino Unido)',
        'WF' => 'Islas Wallis y Futuna',
        'IL' => 'Israel',
        'IT' => 'Italia',
        'JM' => 'Jamaica',
        'JP' => 'Japón',
        'JO' => 'Jordania',
        'KZ' => 'Kazajistán',
        'KE' => 'Kenia',
        'KG' => 'Kirguizistán',
        'KI' => 'Kiribati',
        'KW' => 'Kuwait',
        'LA' => 'Laos',
        'LS' => 'Lesotho',
        'LV' => 'Letonia',
        'LB' => 'Líbano',
        'LR' => 'Liberia',
        'LY' => 'Libia',
        'LI' => 'Liechtenstein',
        'LT' => 'Lituania',
        'LU' => 'Luxemburgo',
        'MK' => 'Macedonia, Ex-República Yugoslava de',
        'MG' => 'Madagascar',
        'MY' => 'Malasia',
        'MW' => 'Malawi',
        'MV' => 'Maldivas',
        'ML' => 'Malí',
        'MT' => 'Malta',
        'MA' => 'Marruecos',
        'MQ' => 'Martinica',
        'MU' => 'Mauricio',
        'MR' => 'Mauritania',
        'YT' => 'Mayotte',
        'MX' => 'México',
        'FM' => 'Micronesia',
        'MD' => 'Moldavia',
        'MC' => 'Mónaco',
        'MN' => 'Mongolia',
        'MS' => 'Montserrat',
        'MZ' => 'Mozambique',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NI' => 'Nicaragua',
        'NE' => 'Níger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk',
        'NO' => 'Noruega',
        'NC' => 'Nueva Caledonia',
        'NZ' => 'Nueva Zelanda',
        'OM' => 'Omán',
        'NL' => 'Países Bajos',
        'PA' => 'Panamá',
        'PG' => 'Papúa Nueva Guinea',
        'PK' => 'Paquistán',
        'PY' => 'Paraguay',
        'PE' => 'Perú',
        'PN' => 'Pitcairn',
        'PF' => 'Polinesia Francesa',
        'PL' => 'Polonia',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'UK' => 'Reino Unido',
        'CF' => 'República Centroafricana',
        'CZ' => 'República Checa',
        'ZA' => 'República de Sudáfrica',
        'DO' => 'República Dominicana',
        'SK' => 'República Eslovaca',
        'RE' => 'Reunión',
        'RW' => 'Ruanda',
        'RO' => 'Rumania',
        'RU' => 'Rusia',
        'EH' => 'Sahara Occidental',
        'KN' => 'Saint Kitts y Nevis',
        'WS' => 'Samoa',
        'AS' => 'Samoa Americana',
        'SM' => 'San Marino',
        'VC' => 'San Vicente y Granadinas',
        'SH' => 'Santa Helena',
        'LC' => 'Santa Lucía',
        'ST' => 'Santo Tomé y Príncipe',
        'SN' => 'Senegal',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leona',
        'SG' => 'Singapur',
        'SY' => 'Siria',
        'SO' => 'Somalia',
        'LK' => 'Sri Lanka',
        'PM' => 'St Pierre y Miquelon',
        'SZ' => 'Suazilandia',
        'SD' => 'Sudán',
        'SE' => 'Suecia',
        'CH' => 'Suiza',
        'SR' => 'Surinam',
        'TH' => 'Tailandia',
        'TW' => 'Taiwán',
        'TZ' => 'Tanzania',
        'TJ' => 'Tayikistán',
        'TF' => 'Territorios franceses del Sur',
        'TP' => 'Timor Oriental',
        'TG' => 'Togo',
        'TO' => 'Tonga',
        'TT' => 'Trinidad y Tobago',
        'TN' => 'Túnez',
        'TM' => 'Turkmenistán',
        'TR' => 'Turquía',
        'TV' => 'Tuvalu',
        'UA' => 'Ucrania',
        'UG' => 'Uganda',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistán',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'YE' => 'Yemen',
        'YU' => 'Yugoslavia',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabue'
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

// Tabla 'informe_cscouting_jugador':
$idinforme_cscouting_jugador = $datos_informe[0]['idinforme_cscouting_jugador'];
$idcscouting_jugador = $datos_informe[0]['idcscouting_jugador'];
$fecha_icsj = $datos_informe[0]['fecha_icsj'];
$nombre_icsj = $datos_informe[0]['nombre_icsj'];
$tipo_informe_icsj = $datos_informe[0]['tipo_informe_icsj'];

$recomendacion_icsj = $datos_informe[0]['recomendacion_icsj'];

switch( $recomendacion_icsj ) {
    case '1': // <---- Observar.
        $recomendacion_icsj = "Observar";
        break;
    case '2': // <---- Fichar.
        $recomendacion_icsj = "Fichar";
        break;
    case '3': // <---- Descartar.
        $recomendacion_icsj = "Descartar";
        break;                                
    case '4': // <---- Continuar seguimiento.
        $recomendacion_icsj = "Continuar seguimiento";
        break; 
    default:
        $recomendacion_icsj = "No especificado";
        break;                                            
}


$realizado_por_icsj = $datos_informe[0]['realizado_por_icsj'];
$fecha_software = $datos_informe[0]['fecha_software'];

$tipo_informe_icsj_text = "";
if( $tipo_informe_icsj == '1' ) {
  $tipo_informe_icsj_text = "General";
} else {
  $tipo_informe_icsj_text = "Partido";
}

// Tabla 'informe_csj_general':
$aspct_tecnico_icsjg = $datos_informe[0]['aspct_tecnico_icsjg'];
$aspct_tactico_icsjg = $datos_informe[0]['aspct_tactico_icsjg'];
$aspct_fisico_icsjg = $datos_informe[0]['aspct_fisico_icsjg'];
$aspct_psico_icsjg = $datos_informe[0]['aspct_psico_icsjg'];
$resumen_obsrv_icsjg = $datos_informe[0]['resumen_obsrv_icsjg'];
$sugerencias_icsjg = $datos_informe[0]['sugerencias_icsjg'];
$proyeccion_icsjg = $datos_informe[0]['proyeccion_icsjg'];
$exportacion_icsjg = $datos_informe[0]['exportacion_icsjg'];

// Tabla 'informe_csj_partido':
$aspct_ofen_icsjp = $datos_informe[0]['aspct_ofen_icsjp']; 
$aspct_def_icsjp = $datos_informe[0]['aspct_def_icsjp']; 
$aspct_fisico_icsjp = $datos_informe[0]['aspct_fisico_icsjp']; 
$observaciones_generales_icsjp = $datos_informe[0]['observaciones_generales_icsjp']; 

// ------------------------- Datos del jugador ------------------------- //

$idfichaJugador_club = $datos_informe[0]['idfichaJugador_club'];

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
if( is_null( $datos_informe[0]['codigoNacionalidad1'] ) || $datos_informe[0]['codigoNacionalidad1'] == '' || $datos_informe[0]['codigoNacionalidad1'] == '0' ) {
  $num_nacionalidad = '';
  $nacionalidad = 'No especificada';
  $bandera_nacionalidad = 'src="'.$dir_img_system.'default.png" style="margin-left: 5px; width: 15px; height: 10px;"';
} else {
  $nacionalidad = $array_paises[ strtoupper( $datos_informe[0]['codigoNacionalidad1'] ) ];   
  $bandera_nacionalidad = 'src="../../flags/blank.gif" class="flag flag-'.$datos_informe[0]['codigoNacionalidad1'].'" style="margin-left: 5px;"';
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

// --------- Foto del jugador:
$foto_jugador = '../../foto_jugadores_scouting/'.$datos_informe[0]['idfichaJugador'].'.png';
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
$pais_club_jugador = $datos_informe[0]['pais_club_jugador'];

// --------- División:
$division_club_jugador = "";
if( is_null( $datos_informe[0]['division_club_jugador'] ) || $datos_informe[0]['division_club_jugador'] == '' || $datos_informe[0]['division_club_jugador'] == '0' ) {
  $division_club_jugador = 'No especificada';
} else {
  $division_club_jugador = intval( $datos_informe[0]['division_club_jugador'] );
  $division_club_jugador = $array_divisiones[$pais_club_jugador][$division_club_jugador][1];
}

$nombre_club_jugador;
if( is_null( $datos_informe[0]['nombre_club_jugador'] ) || $datos_informe[0]['nombre_club_jugador'] == '' ) {
  $nombre_club_jugador = 'No especificado';
} else {
  $nombre_club_jugador = $datos_informe[0]['nombre_club_jugador'];
}

$foto_club_jugador = '../../foto_clubes/'.$datos_informe[0]['idclub_jugador'].'.png';

/*
// Tabla 't_club_rival':
$nombre_club_rival = $datos_informe[0]['nombre_club_rival'];
$foto_club_rival = '../../foto_clubes/'.$datos_informe[0]['idclub_rival'].'';                


// Tabla 'campeonato':
$nombre_campeonato = $datos_informe[0]['nombre_campeonato'];
$foto_campeonato = '../../foto_campeonatos/'.$datos_informe[0]['idcampeonato'].'';
*/

$fecha_software_date = substr($fecha_software, 0, 10);
$fecha_software_time = substr($fecha_software, 11, 19);  

// ------------------------------ INICIO DE LOS DATOS PARA INFORME GENERAL ------------------------------ //
$datos_informe_general = '
    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="width: 100%">
        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">características técnicas</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$aspct_tecnico_icsjg.'</textarea>
        </div>

        <div class="float-right" style="width: 45%;">
          <p class="p-textarea">características tácticas</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$aspct_tactico_icsjg.'</textarea>
        </div>
      </div>
    </div>

    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="width: 100%">
        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">resumen</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$resumen_obsrv_icsjg.'</textarea>
        </div>

        <div class="float-right" style="width: 45%;">
          <p class="p-textarea">sugerencias</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$sugerencias_icsjg.'</textarea>
        </div>
      </div>
    </div> 

    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="width: 100%">
        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">proyección</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$proyeccion_icsjg.'</textarea>
        </div>

        <div class="float-right" style="width: 45%;">
          <p class="p-textarea">aspectos físicos</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$aspct_fisico_icsjg.'</textarea>
        </div>
      </div>
    </div>        
';
// ------------------------------ FIN DE LOS DATOS PARA INFORME GENERAL ------------------------------ //

// ------------------------------ INICIO DE LOS DATOS PARA INFORME DE PARTIDO ------------------------------ //
$datos_informe_partido = '
    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="width: 100%">
        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">Observaciones generales del jugador en el partido</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$observaciones_generales_icsjp.'</textarea>
        </div>

        <div class="float-right" style="width: 45%;">
          <p class="p-textarea">Aspectos Ofensivos</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$aspct_ofen_icsjp.'</textarea>
        </div>
      </div>
    </div> 

    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454;">
      <div style="width: 100%">
        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">Aspectos Defensivos</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$aspct_def_icsjp.'</textarea>
        </div>

        <div class="float-right" style="width: 45%;">
          <p class="p-textarea">Aspectos Físicos</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">'.$aspct_fisico_icsjp.'</textarea>
        </div>
      </div>
    </div>

    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; clear: both; color: #565454; visibility: hidden;">
      <div style="width: 100%">
        <div class="float-left" style="width: 45%;">
          <p class="p-textarea">AAA</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">AAA</textarea>
        </div>

        <div class="float-right" style="width: 45%;">
          <p class="p-textarea">BBB</p>
          <textarea class="gray-textarea" style="width: 100%;" rows="25">BBB</textarea>
        </div>
      </div>
    </div>    
';
// ------------------------------ FIN DE LOS DATOS PARA INFORME DE PARTIDO ------------------------------ //
  

// Determinando el tipo de informe:
$datos_tipo_informe = "";
if( $tipo_informe_icsj == '1' ) { // GENERAL
  $datos_tipo_informe = $datos_informe_general;
} else { // PARTODO 
  $datos_tipo_informe = $datos_informe_partido;
}

// ------------------------------ INICIO DE DATOS QUE SERÁN INSERTADOS EN LA TABLA 'RESUMEN ESTADÍSTICAS GENERALES' ------------------------------ //

// ------------ Partidos de jugador (tabla 'fichaJugador_partido'):
$tr_partidos_jugador = '';
$partidos_jugador = partidos_jugador( $idfichaJugador_club );
for ($i=0; $i < count($partidos_jugador); $i++) { 

  $temporada_jugadorpartido = $partidos_jugador[$i]['temporada_jugadorpartido'];
  $nombre_campeonato_jugadorpartido = $partidos_jugador[$i]['nombre_campeonato'];

  $min_jugados_jugadorpartido = $partidos_jugador[$i]['min_jugados_jugadorpartido'];
  $partidos_jugados = $partidos_jugador[$i]['partidos_jugados'];  
  $partidos_jugados_titular = $partidos_jugador[$i]['partidos_jugados_titular'];
  $partidos_jugados_suplente = $partidos_jugador[$i]['partidos_jugados_suplente'];
  $t_amarillas_jugadorpartido = $partidos_jugador[$i]['t_amarillas_jugadorpartido'];
  $t_rojas_jugadorpartido = $partidos_jugador[$i]['t_rojas_jugadorpartido'];
  $goles_convertidos = $partidos_jugador[$i]['goles_convertidos'];

  $tr_partidos_jugador.= "
    <tr>
      <td>".$temporada_jugadorpartido."</td>
      <td style='text-align: left;'>".$nombre_campeonato_jugadorpartido."</td>
      <td>".$min_jugados_jugadorpartido."'</td>
      <td>".$partidos_jugados."</td>
      <td>".$partidos_jugados_titular."</td>
      <td>".$partidos_jugados_suplente."</td>
      <td>".$t_amarillas_jugadorpartido."</td>
      <td>".$t_rojas_jugadorpartido."</td>
      <td>".$goles_convertidos."</td>
    </tr>
  ";
}

// ------------ Partidos de informe scouting (tabla 'fichaJugador_partido') - DETALLADO:
$tr_partidos_jugador_detalle = '';
$partidos_jugador_detalle = partidos_jugador_detalle( $idfichaJugador_club );
for ($i=0; $i < count($partidos_jugador_detalle); $i++) { 

  $serie = $partidos_jugador_detalle[$i]['serieActual'];
  $sexo_serie = $partidos_jugador_detalle[$i]['sexo'];
  
  $descripcion_serie = '';

  if( is_null($serie) || $serie == '' || $serie == '0' || is_null($sexo_serie) || $sexo_serie == '' || $sexo_serie == '0' ) {
    $descripcion_serie = '-';
  } else {

    if( $serie == '99' ) {
      $descripcion_serie = 'Primer Equipo';
    } else {
      $genero = '';
      if( $sexo_serie == '1' ) {
        $genero = 'Masculina';
      } else {
        $genero = 'Femenina';
      }
      $descripcion_serie = 'SUB ' . $serie . ' ' . $genero;
    }

  }

  $fecha_jugadorpartido = $partidos_jugador_detalle[$i]['fecha_jugadorpartido'];

  $nombre_club_rival = $partidos_jugador_detalle[$i]['nombre_club_rival'];
  $condicion_jugadorpartido = $partidos_jugador_detalle[$i]['condicion_jugadorpartido'];

  switch( $condicion_jugadorpartido ) {
      case '1': // <----- Local
          $condicion_jugadorpartido = 'Local';                        
          break;
      case '2': // <----- Visitante
          $condicion_jugadorpartido = 'Visitante';            
          break;      
      case '3': // <----- Neutral
          $condicion_jugadorpartido = 'Neutral';            
          break;   
      default: // <---- No especificado.
          $condicion_jugadorpartido = "-";
          break;                                           
  }

  $tit_sup_nc_jugadorpartido = $partidos_jugador_detalle[$i]['tit_sup_nc_jugadorpartido'];
  switch( $tit_sup_nc_jugadorpartido ) {
    case '1': // <---- Titular
        $tit_sup_nc_jugadorpartido = 'Titular';
        break;
    case '2': // <---- Suplente
        $tit_sup_nc_jugadorpartido = 'Suplente';
        break;    
    case '3': // <---- No compite
        $tit_sup_nc_jugadorpartido = 'No compite';
        break;  
    default: // <---- No especificado
        $tit_sup_nc_jugadorpartido = 'No especificado';
        break;                                                                        
  }

  $min_jugados_jugadorpartido = $partidos_jugador_detalle[$i]['min_jugados_jugadorpartido'];
  $t_amarilla_jugadorpartido = $partidos_jugador_detalle[$i]['t_amarilla_jugadorpartido'];
  $t_roja_jugadorpartido = $partidos_jugador_detalle[$i]['t_roja_jugadorpartido'];
  $num_gol_jugadorpartido = $partidos_jugador_detalle[$i]['num_gol_jugadorpartido'];

  $titutlar_suplente = '';
  if( $tit_sup_nc_jugadorpartido == '2' ) { // <---- Suplente
      $titutlar_suplente = 'Sí';                            
  } else {
      // Titular o No compite
      $titutlar_suplente = 'No';
  }

  $gol_equipo1_jugadorpartido = $partidos_jugador_detalle[$i]['gol_equipo1_jugadorpartido']; 
  $gol_equipo2_jugadorpartido = $partidos_jugador_detalle[$i]['gol_equipo2_jugadorpartido'];
  $resultado = $gol_equipo1_jugadorpartido . ' - ' . $gol_equipo2_jugadorpartido;

  $tr_partidos_jugador_detalle.= "
    <tr>
      <td>".$descripcion_serie."</td>
      <td>".$fecha_jugadorpartido."</td>
      <td style='text-align: left;'>".$nombre_club_rival."</td>
      <td>".$condicion_jugadorpartido."</td>
      <td>".$tit_sup_nc_jugadorpartido."</td>
      <td>".$min_jugados_jugadorpartido."'</td>
      <td>".$t_amarilla_jugadorpartido."</td>
      <td>".$t_roja_jugadorpartido."</td>
      <td>".$num_gol_jugadorpartido."</td>
      <td>".$titutlar_suplente."</td>
      <td>".$resultado."</td>      
    </tr>
  ";
}

// ------------ Partidos de informe scouting (tabla 'informe_csj_partido'):
$tr_partidos_jugador_informe_scouting = '';
$partidos_jugador_informe_scouting = partidos_jugador_informe_scouting( $idcscouting_jugador );
for ($i=0; $i < count($partidos_jugador_informe_scouting); $i++) { 

  $temporada_icsjp = $partidos_jugador_informe_scouting[$i]['temporada_icsjp'];
  $nombre_campeonato_icsjp = $partidos_jugador_informe_scouting[$i]['nombre_campeonato'];

  $min_jugados_icsjp = $partidos_jugador_informe_scouting[$i]['min_jugados_icsjp'];
  $partidos_jugados = $partidos_jugador_informe_scouting[$i]['partidos_jugados'];  
  $partidos_jugados_titular = $partidos_jugador_informe_scouting[$i]['partidos_jugados_titular'];
  $partidos_jugados_suplente = $partidos_jugador_informe_scouting[$i]['partidos_jugados_suplente'];
  $t_amarillas_icsjp = $partidos_jugador_informe_scouting[$i]['t_amarillas_icsjp'];
  $t_rojas_icsjp = $partidos_jugador_informe_scouting[$i]['t_rojas_icsjp'];
  $num_gol_icsjp = $partidos_jugador_informe_scouting[$i]['num_gol_icsjp'];

  $tr_partidos_jugador_informe_scouting.= "
    <tr>
      <td>".$temporada_icsjp."</td>
      <td style='text-align: left;'>".$nombre_campeonato_icsjp."</td>
      <td>".$min_jugados_icsjp."'</td>
      <td>".$partidos_jugados."</td>
      <td>".$partidos_jugados_titular."</td>
      <td>".$partidos_jugados_suplente."</td>
      <td>".$t_amarillas_icsjp."</td>
      <td>".$t_rojas_icsjp."</td>
      <td>".$num_gol_icsjp."</td>
    </tr>
  ";
}

// ------------ Partidos de informe scouting (tabla 'informe_csj_partido') - DETALLADO:
$tr_partidos_jugador_informe_scouting_detalle = '';
$partidos_jugador_informe_scouting_detalle = partidos_jugador_informe_scouting_detalle( $idcscouting_jugador );
for ($i=0; $i < count($partidos_jugador_informe_scouting_detalle); $i++) { 

  $serie = $partidos_jugador_informe_scouting_detalle[$i]['serieActual'];
  $sexo_serie = $partidos_jugador_informe_scouting_detalle[$i]['sexo'];
  
  $descripcion_serie = '';

  if( is_null($serie) || $serie == '' || $serie == '0' || is_null($sexo_serie) || $sexo_serie == '' || $sexo_serie == '0' ) {
    $descripcion_serie = '-';
  } else {

    if( $serie == '99' ) {
      $descripcion_serie = 'Primer Equipo';
    } else {
      $genero = '';
      if( $sexo_serie == '1' ) {
        $genero = 'Masculina';
      } else {
        $genero = 'Femenina';
      }
      $descripcion_serie = 'SUB ' . $serie . ' ' . $genero;
    }

  }

  $fecha_icsjp = $partidos_jugador_informe_scouting_detalle[$i]['fecha_icsjp'];

  $nombre_club_rival = $partidos_jugador_informe_scouting_detalle[$i]['nombre_club_rival'];

  $condicion_icsjp = $partidos_jugador_informe_scouting_detalle[$i]['condicion_icsjp'];
  switch( $condicion_icsjp ) {
      case '1': // <----- Local
          $condicion_icsjp = 'Local';                        
          break;
      case '2': // <----- Visitante
          $condicion_icsjp = 'Visitante';            
          break;      
      case '3': // <----- Neutral
          $condicion_icsjp = 'Neutral';            
          break;   
      default: // <---- No especificado.
          $condicion_icsjp = "-";
          break;                                           
  }

  $tit_sup_nc_icsjp = $partidos_jugador_informe_scouting_detalle[$i]['tit_sup_nc_icsjp'];
  switch( $tit_sup_nc_icsjp ) {
    case '1': // <---- Titular
        $tit_sup_nc_icsjp = 'Titular';
        break;
    case '2': // <---- Suplente
        $tit_sup_nc_icsjp = 'Suplente';
        break;    
    case '3': // <---- No compite
        $tit_sup_nc_icsjp = 'No compite';
        break;  
    default: // <---- No especificado
        $tit_sup_nc_icsjp = 'No especificado';
        break;                                                                        
  }

  $min_jugados_icsjp = $partidos_jugador_informe_scouting_detalle[$i]['min_jugados_icsjp'];
  $t_amarilla_icsjp = $partidos_jugador_informe_scouting_detalle[$i]['t_amarilla_icsjp'];
  $t_roja_icsjp = $partidos_jugador_informe_scouting_detalle[$i]['t_roja_icsjp'];
  $num_gol_icsjp = $partidos_jugador_informe_scouting_detalle[$i]['num_gol_icsjp'];

  $titutlar_suplente = '';
  if( $tit_sup_nc_icsjp == '2' ) { // <---- Suplente
      $titutlar_suplente = 'Sí';                            
  } else {
      // Titular o No compite
      $titutlar_suplente = 'No';
  }

  $golequipo1_icsjp = $partidos_jugador_informe_scouting_detalle[$i]['golequipo1_icsjp']; 
  $golequipo2_icsjp = $partidos_jugador_informe_scouting_detalle[$i]['golequipo2_icsjp'];
  $resultado = $golequipo1_icsjp . ' - ' . $golequipo2_icsjp;

  $tr_partidos_jugador_informe_scouting_detalle.= "
    <tr>
      <td>".$descripcion_serie."</td>
      <td>".$fecha_icsjp."</td>
      <td style='text-align: left;'>".$nombre_club_rival."</td>
      <td>".$condicion_icsjp."</td>
      <td>".$tit_sup_nc_icsjp."</td>
      <td>".$min_jugados_icsjp."'</td>
      <td>".$t_amarilla_icsjp."</td>
      <td>".$t_roja_icsjp."</td>
      <td>".$num_gol_icsjp."</td>
      <td>".$titutlar_suplente."</td>
      <td>".$resultado."</td>      
    </tr>
  ";
}

// Partidos de la tabla 'fichaJugador_partido' y la tabla 'informe_csj_partido':
$resumen_estadisticas_generales = $tr_partidos_jugador . $tr_partidos_jugador_informe_scouting;

// Partidos de la tabla 'fichaJugador_partido' y la tabla 'informe_csj_partido':
$detalles_partido = $tr_partidos_jugador_detalle . $tr_partidos_jugador_informe_scouting_detalle;

// ------------------------------ FIN DE DATOS QUE SERÁN INSERTADOS EN LA TABLA 'RESUMEN ESTADÍSTICAS GENERALES' ------------------------------ //

$data.= '

  <!-- ================================ Fin del header ================================ -->
  <header style="display: block; text-align: -webkit-center;">
    <div style="width: 100%; background-color: #4f636d;">
        <p style="color: white; text-transform: uppercase; margin: 0; font-weight: bold; padding: 8px; text-align: center; font-size: 11px;">informe de seguimiento</p>
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
                  <td class="datos-principales" style="max-width: 150px; width: 120px; text-align: left;">'.$nombre_club_jugador.'</td>
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
                  <td><img '.$bandera_nacionalidad.' /> </td>
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
                <td class="datos-principales">'.$division_club_jugador.'</td>
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
      <p style="text-transform: uppercase; font-size: 11px; color: gray;">reporte jugador</p>
    </div>

    '.$datos_tipo_informe.'

    <div class="txCenter" style="box-sizing: border-box;width: 90%;margin: auto; color: #565454;">
      <div style="width: 100%; clear: both;">
        <div class="float-left" style="width: 25%;">
          <p class="p-textarea">Posición</p>
        </div>

        <div class="float-right" style="width: 70%;">
          <p class="p-textarea" style="text-align: center;">resumen estadísticas generales</p>
        </div>        
      </div>

      <div style="width: 100%; clear: both;">
        <div class="float-left" style="width: 30%; height: 185px;">
                         

          <!-- Arquero -->
          <div class="posicion-jugador" style="position: absolute; top: 860px; left: 135px; '.$display_arquero.' "><p class="text-posicion-jugador">A</div>

          <!-- Defensa Central -->
          <div class="posicion-jugador" style="position: absolute; top: 810px; left: 135px; '.$display_defensa_central.' "><p class="text-posicion-jugador">C</div>          

          <!-- Lateral Izquierdo -->
          <div class="posicion-jugador" style="position: absolute; top: 810px; left: 70px; '.$display_lateral_izquierdo.' "><p class="text-posicion-jugador">LI</div>

          <!-- Lateral Derecho -->
          <div class="posicion-jugador" style="position: absolute; top: 810px; left: 200px; '.$display_lateral_derecho.' "><p class="text-posicion-jugador">LD</div>                              

          <!-- Volante Izquierdo -->
          <div class="posicion-jugador" style="position: absolute; top: 740px; left: 70px; '.$display_volante_izquierdo.' "><p class="text-posicion-jugador">VI</div>

          <!-- Volante Derecho -->
          <div class="posicion-jugador" style="position: absolute; top: 740px; left: 200px; font-size: 8.5px; '.$display_volante_derecho.' "><p class="text-posicion-jugador">VD</div>  

          <!-- Volante Defensivo -->
          <div class="posicion-jugador" style="position: absolute; top: 760px; left: 135px; font-size: 8.5px; '.$display_volante_defensivo.' "><p class="text-posicion-jugador">VDF</p></div> 

          <!-- Volante Mixto -->
          <div class="posicion-jugador" style="position: absolute; top: 720px; left: 135px; '.$display_volante_mixto.' "><p class="text-posicion-jugador">VM</p></div>           

          <!-- Extremo Izquierdo -->
          <div class="posicion-jugador" style="position: absolute; top: 650px; left: 70px; '.$display_extremo_izquierdo.' "><p class="text-posicion-jugador">EI</p></div> 

          <!-- Delantero Centro -->
          <div class="posicion-jugador" style="position: absolute; top: 650px; left: 135px; '.$display_delantero_central.' "><p class="text-posicion-jugador">DC</p></div> 

          <!-- Extremo Derecho -->
          <div class="posicion-jugador" style="position: absolute; top: 650px; left: 200px; '.$display_extremo_derecho.' "><p class="text-posicion-jugador">ED</p></div>           

          <!-- Posición -->
          '.$leyenda_posicion_0.'  

          <!-- Polivalencia 1 -->
          '.$leyenda_posicion_1.'

          <!-- Polivalencia 2 -->
          '.$leyenda_posicion_2.'          
                   
          <img src="'.$dir_img_system.'canchachica.png" style="height: 295px; width: 100%;">
                        

        </div>

        <div class="float-right" style="width: 65%;">
          <table id="tabla_resumen_partidos" class="t-black" style="font-size: 8px;">
            <thead>
              <tr>
                <th style="max-width: 80px; width: 80px;">temporada</th>
                <th style="text-align: left; max-width: 80px; width: 80px;">campeonato</th>
                <th>min</th>
                <th>pj</th>
                <th>t</th>
                <th>s</th>
                <th>ta</th>
                <th>tr</th>
                <th>goles</th>
              </tr>
            </thead>
            <tbody>'.$resumen_estadisticas_generales.'</tbody>
            <tfoot></tfoot>
          </table>
        </div>        
      </div>

    </div>

    <br/><br/>

    <div style="clear:both; position: absolute; bottom: 10px;">
      <div>
        <p style="text-transform: uppercase; font-size: 8px; margin-top:100px; text-align: center;">se recomienda</p>
      </div>
      <br/>
      <div style="width: 30%; background-color: #4f7182; clear: both; margin: auto; border: 2px solid #7d7d7d;">
          <p style="color: white; text-transform: none; margin: 0; font-weight: normal; padding: 5px; font-size: 8px; text-align: center;">'.$recomendacion_icsj.'</p>
      </div>  
    </div>    

    <!-- Salto de página -->
    <div style="page-break-after: always;"></div>

    <div style="width: 100%; background-color: #4f636d;">
        <p style="color: white; text-transform: uppercase; margin: 0; font-weight: bold; padding: 8px; text-align: center; font-size: 11px;">detalle estadísticas</p>
    </div>

    <br/><br/>

    <div class="txCenter" style="box-sizing: border-box;width: 95%;margin: auto;clear: both; color: #565454;">

      <p style="text-transform: uppercase; font-size: 8px;">detalle partidos</p>

      <br/>

      <table id="tabla_detalles_partido" class="t-black" style="width: 100%; font-size: 8px;">
        <thead>
          <tr>
            <th>serie</th>
            <th>fecha</th>
            <th style="text-align: left;">rival</th>
            <th>condición</th>
            <th>tit/sup</th>
            <th>min jugados</th>
            <th>ta</th>
            <th>tr</th>
            <th>goles</th>
            <th>sust</th>
            <th>resultado</th>
          </tr>
        </thead>
        <tbody>'.$detalles_partido.'</tbody>
        <tfoot></tfoot>
      </table>

      <!-- ======================================= -->

      <br/><br/>

      <p style="text-transform: uppercase; font-size: 8px;">otras estadísticas</p>

      <br/>

      <table id="tabla_estadisticas_informe" class="t-black" style="width: 100%; font-size: 8px;">
        <thead>
          <tr>
            <th><div style="max-width: 150px; width: 150px;">estadística/parámetro</div></th>
            <th><div style="max-width: 450px; width: 450px;">valor</div></th>
          </tr>
        </thead>
        <tbody>'.$tr_estadisticas_informe_scouting.'</tbody>
        <tfoot></tfoot>
      </table>      

    </div>

    <!--
    <div style="">
        <p style="color: white; text-transform: uppercase; margin: 0; font-weight: bold; padding: 8px; text-align: center; font-size: 11px;">informe de seguimiento</p>
    </div>
    -->
    
    <footer style="width: 100%; background-color: #4f636d;">
      <p style="color: white; text-align: center; margin: 0; font-weight: bold; margin-top: 0px; font-size: 11px; padding: 8px;">
        Centro de Scouting '.date("Y").' | Informe ingresado el '.$fecha_software_date.' a las '.$fecha_software_time.'.
      </p>
      <p></p>
    </footer>  
    
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
$titulo_documento_salida = "[11Analytics]_scouting_centro_informe.pdf";
// $titulo_documento_salida = "[11Analytics]_tratamiento_lesiones_".$salida.".pdf";
/////////////////////////////////////////////////////////////////////////////////////////

$html='
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../../flags/flags.css" rel="stylesheet" type="text/css" />
<link href="../../flags/flags.min.css" rel="stylesheet" type="text/css" />

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