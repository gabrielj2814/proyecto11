<?php 
include('../../../bd/informe_carga_BD.php');

$data='';

$datos_informe = buscar_datosPDF( $_POST['idinforme_carga'] );
$cantidad_total_jugadores_peso_normal = $_POST["cantidad_total_jugadores_peso_normal"];
$cantidad_total_jugadores_sobre_el_peso = $_POST["cantidad_total_jugadores_sobre_el_peso"];

$jugador = '';

$array_posicion = [
    'Todos',
    'Arquero',
    'Defensa Central',
    'Lateral Izquierdo',
    'Lateral Derecho',
    'Volante Defensivo/Central',
    'Volante Izquierdo',
    'Volante Derecho',
    'Volante Mixto',
    'Volante Ofensivo/Creativo',
    'Extremo Izquierdo',
    'Extremo Derecho',
    'Delantero Centro',  
];

$array_iniciales_categorias = [
    'DAL',
    'SCL',
    'RDR',
    'RRR',
    'R+C',
    'FCE',
    'MFC',
    'P'
];

$array_paises = [
    [0, 'Todos', ''],
    [1, 'Chile', 'chile.png', 1, 'Chileno'],
    [2, 'Argentina', 'argentina.png', 1, 'Argentino'],
    [3, 'Venezuela', 'venezuela.png', 1, 'Venezolano'],
    [4, 'Brasil', 'brasil.png', 1, 'Brasileño'],
    [5, 'Colombia', 'colombia.png', 1, 'Colombiano'],
    [6, 'Ecuador', 'ecuador.png', 1, 'Ecuatoriano'],
    [7, 'Uruguay', 'uruguay.png', 1, 'Uruguayo'],
    [8, 'Perú', 'peru.png', 1, 'Peruano'],
    [9, 'Paraguay', 'paraguay.png', 'Paraguayo'],
    [10, 'México', 'mexico.png', 1, 'Mexicano'],
    [11, 'España', 'espana.png', 2, 'Español'],
    [12, 'Inglaterra', 'inglaterra.png', 2, 'Inglés'],
    [13, 'Alemania', 'alemania.png', 2, 'Alemán'],
    [14, 'China', 'china.png', 2, 'Chino'],
    [15, 'Bélgica', 'belgica.png', 2, 'Belga'],
    [16, 'Bolivia', 'bolivia.png', 2, 'Boliviano'],
    [17, 'Costa Rica', 'costa_rica.png', 2, 'Costarricense'],
    [18, 'Estados Unidos', 'estados_unidos.png', 2, 'Estadounidense'],

    [19, 'Honduras', 'honduras.png', 2, 'Hondureño'],
    [20, 'El Salvador', 'el_salvador.png', 2, 'Salvadoreño'],
    [21, 'Escocia', 'escocia.png', 2, 'Escocés'],
    [22, 'Francia', 'francia.png', 2, 'Francés'],
    [23, 'Grecia', 'grecia.png', 2, 'Griego'],
    [24, 'Holanda', 'holanda.png', 2, 'Holandés'],
    [25, 'Italia', 'italia.png', 2, 'Italiano'],
    [26, 'Japón', 'japon.png', 2, 'Japonés'],
    [27, 'Portugal', 'portugal.png', 2, 'Portugués'],
    [28, 'Rusia', 'rusia.png', 2, 'Ruso'],
    [29, 'Turquía', 'turquia.png', 2, 'Turco'],
];

$count = 1;

  $serie = $datos_informe[0]['serieActual'];
  $sexo_serie = $datos_informe[0]['sexo'];
  $fecha_informe_carga = $datos_informe[0]['fecha_informe_carga'];
  
  $descripcion_serie = '';
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

for ($i=0; $i < count($datos_informe); $i++) { 

  $idfichaJugador = $datos_informe[$i]['idfichaJugador'];
  $posicion = $datos_informe[$i]['posicion'];
  $nombre = $datos_informe[$i]['nombre'];
  $nacionalidad1 = $datos_informe[$i]['nacionalidad1'];
  $apellido1 = $datos_informe[$i]['apellido1'];
  $apellido2 = $datos_informe[$i]['apellido2'];
  $rut = $datos_informe[$i]['rut'];
  $sexo = $datos_informe[$i]['sexo'];
  $serieActual = $datos_informe[$i]['serieActual'];
  $categoria_informe_carga_individual = $datos_informe[$i]['categoria_informe_carga_individual'];
  $peso_informe_carga_individual = $datos_informe[$i]['peso_informe_carga_individual'];
  $peso_ideal_informe_carga_individual = $datos_informe[$i]['peso_ideal_informe_carga_individual'];
  

  $iniciales_carga = $array_iniciales_categorias[$categoria_informe_carga_individual]; 


          $bandera_nacionalidad;
          if( $nacionalidad1 === null || $nacionalidad1 == '' || $nacionalidad1 == '0' ) {
            $bandera_nacionalidad = '../../img/default.png';
          } else {
            $bandera_nacionalidad = '../../img/' . $array_paises[$nacionalidad1][2];
          }

      $foto_jugador = '../../foto_jugadores/'.$datos_informe[0]['idfichaJugador'].'.png';

  $nombre_jugador = $nombre . " " . $apellido1 . " " . $apellido2;

    $jugador.= '
          <tr class="font-12" style="color: #555555;">
            <td class="text-center" style="padding: 2px;"><b>'.$count.'</b></td>
            <td style="padding: 2px; text-align: left; max-width: 10px; width: 10px;"><b>'.$array_posicion[$posicion].'</b></td>
            <td class="text-center" style="max-width: 22px; width: 22px; /*background-color: orange;*/ padding: 2px;">
              <div style="width: 20px;">
                <img src="'.$foto_jugador.'" style="max-width: 22px; width: 22px; border: 2px solid #555555; border-radius: 12px 12px 12px 12px;">
              </div>
            </td>
            <td class="text-center" style="padding: 3px; max-width: 30px; width: 30px; text-align: left;"><b>'.$nombre_jugador.'</b></td>
            <td class="text-center" style="padding: 2px; max-width: 20px; width: 20px;"><b>'.$iniciales_carga.'</b></td>
            <td class="text-center" style="padding: 2px; max-width: 20px; width: 20px;"><b>'.$peso_informe_carga_individual.'</b></td>
            <td class="text-center" style="padding: 2px; max-width: 20px; width: 20px;"><b>'.$peso_ideal_informe_carga_individual.'</b></td>
          </tr>
    ';
    
    $count++;
}

$data .= '
    <table style="width: 400px; color: black; margin: 0px auto 10px;">
        <tbody>
            <tr>
                <td class="text-center" style="width: 100px; padding: 0px 10px;">
                    <img src="../../../config/logo_equipo.png" style="height: 90px;  margin: -25px 0px 20px;">
                    <h6 style="color: #555555; margin: -15px 0px 0px;">'.$descripcion_serie.'</h6>
                </td>
                <td class="text-center">
                    <div style="margin-top: -35px;">
                        <h2 style="color: #555555; margin: 0px;">CARGAS DIARIAS</h2>
                        <h4 style="color: #555555; margin: 5px 0px; 0px"></h4>
                    <div>
                </td>
            </tr>
        </tbody>
    </table>
    
    <div class="d-inline-block w-100" style="background: #555555; height: 10px; margin: 0px 0px 15px;"></div>

    <table class="table-collapse w-100 font-12" style="color: #555555; margin: 0px 0px 0px;">
        <tbody>
            <tr>
                <td style="width: 10%; padding: 5px;"><b>Fecha informe:</b></td>
                <td style="width: 10%; padding: 0px 10px;"><b>'.$fecha_informe_carga.'</b></td>
                <td style="width: 2%;"></td>
                <td style="width: 13%; padding: 5px; visibility: hidden;"><b>Título del informe:</b></td>
                <td style="padding: 3px; text-transform: capitalize; visibility: hidden;"><b>CARGAS</b></td>
            </tr>
        </tbody>
    </table>

    <table class="font-12 w-100 table-collapse" style="margin-bottom: 5px;">
        <thead>
            <tr style="color: white;">
                <th class="font-9 text-center" style="padding: 0px; width: 25px;"><div class="w-100" style="border-radius: 5px 0px 0px 0px; background: #555555; padding: 7px;">#<div></th>
                <th colspan="1" font-11" style="background: #555555; padding: 3px; max-width: 20px; width: 20px; text-align: left;" class="font-10">POSICIÓN</th>
                <th colspan="2" class="text-center font-11" style="background: #555555; padding: 3px; max-width: 40px; width: 40px; text-align: left;" class="font-10">NOMBRE</th>
                <th class="text-center font-11" style="background: #555555; padding: 3px; width: 15px;" class="font-10">CATEGORÍA</th>
                <th class="text-center font-11" style="background: #555555; padding: 3px; width: 15px;" class="font-10">PESO</th>
                <th class="text-center font-10" style="padding: 0px; width: 15px;"><div class="w-100" style="border-radius: 0px 5px 0px 0px; background: #555555; padding: 6px;">PESO IDEAL<div></th>
            </tr>
        </thead>
        <tbody style="padding-top: 10px;">'.$jugador.'</tbody>
        <tfoot>
            <tr style="color: white;">
                <th style="padding: 0px;"><div class="w-100" style="border-radius: 0px 0px 0px 5px; background: #555555; height: 5px;"><div></th>
                <th colspan="5" style="background-color: #555555; padding: 0px;"></th>
                <th style="padding: 0px;"><div class="w-100" style="border-radius: 0px 0px 5px 0px; background: #555555; height: 5px;"><div></th>
            </tr>
        </tfoot>
    </table>
    
    <div></div>
';

function standardDeviation($values){
    $avg = average($values);
    $squareDiffs = [];
    foreach($values AS $value) {
        $diff       = $value - $avg;
        $sqrDiff    = $diff * $diff;
        $squareDiffs[] = $sqrDiff;
    }
    
    $avgSquareDiff  = average($squareDiffs);
    $stdDev         = sqrt($avgSquareDiff);
    return $stdDev;
}
function average($arreglo){
    $sum = array_reduce($arreglo,"rdce");
    $avg = $sum / count($arreglo);
    return $avg;
}
function rdce($x1, $x2) {
    return $x1 + $x2;
}
////////////////////////////////////////////////////////////////

require_once('../../../dompdf/autoload.inc.php');
require_once ('../../../dompdf/lib/html5lib/Parser.php');
require_once ('../../../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php');
require_once ('../../../dompdf/lib/php-svg-lib/src/autoload.php');
require_once ('../../../dompdf/src/Autoloader.php');
use Dompdf\Dompdf;
/////////////////////////////// CONFIGURACION DEL DOCUMENTO /////////////////////////////
$pdf = new Dompdf();
$pdf->setPaper('letter', 'landscape');  // [A4, letter], [portrait (Posición vertical), landscape (Posición horizontal)] 
$titulo_documento_salida = "[11Analytics]_carga_diaria.pdf";
/////////////////////////////////////////////////////////////////////////////////////////

$html='<!DOCTYPE html>
<html>
    <head>
        <title>Registro de Cargas Diarias</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="../../flags/flags.css" rel="stylesheet" type="text/css" />
        <link href="../../flags/flags.min.css" rel="stylesheet" type="text/css" />
        <style>
            @font-face { font-family: "Helvetica"; }
            body { font-family: "Helvetica"; box-sizing: border-box; }
            h1, h2, h3, h4, h5, h6, p { margin: 0px; }
            
            .table-collapse { border-collapse: collapse; }
            .position-relative { position: relative; }
            .position-absolute { position: absolute; }
            .d-inline-block { display: inline-block; }
            .d-inline { display: inline; }
            .d-block { display: block; }
            .d-flex { display: flex; }
            .w-100 { width: 100%; }
            .w-75 { width: 75%; }
            .w-50 { width: 50%; }
            .w-25 { width: 25%; }
            .w-20 { width: 20%; }
            .w-10 { width: 10%; }
            .text-center { text-align: center; }
            .text-left { text-align: left; }
            .text-right { text-align: right; }
            .font-8 { font-size: 8px; }
            .font-9 { font-size: 9px; }
            .font-10 { font-size: 10px; }
            .font-11 { font-size: 11px; }
            .font-12 { font-size: 12px; }
            .font-13 { font-size: 13px; }
            .font-14 { font-size: 14px; }
            .font-lighter { font-weight: lighter !important; }
            .font-bold { font-weight: bold !important; }
            
            .titulo_desc {
                color: #555555;
                background: transparent;
                position: absolute;
                text-align: center;
                height: 20px;
                margin: 0px;
                top: 0px;
                font-size: 11.5px;
                line-height: 17px;
                padding: 0px 4px;
                border: 2.5px solid transparent;
                border-radius: 6px 6px 6px 6px;
            }
            .input_desc {
                color: white;
                background: #555555;
                position: absolute;
                text-align: right;
                height: 20px;
                margin: 0px;
                top: 0px;
                display: inline-block;
                font-size: 11.5px;
                line-height: 17px;
                padding: 0px 4px;
                border: 2.5px solid grey;
                border-radius: 6px 6px 6px 6px;
            }
        </style>
    </head>
    <body>
    ';
    
    $html .= $data;
    
    $html.='
    </body>
</html>
';
$pdf->loadHtml($html);
$pdf->render();
$output = $pdf->output();
file_put_contents("../../reportes_pdf/".$titulo_documento_salida, $output);
echo json_encode($titulo_documento_salida);
?>