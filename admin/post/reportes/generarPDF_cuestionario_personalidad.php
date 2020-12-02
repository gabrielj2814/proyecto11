<?php 

$array_preguntas = [
  [1, '¿le gusta abundancia de excitación y bullicio a su alrededor?'],
  [2, '¿tiene a menudo un sentimiento de intranquilidad, como si quisiera algo, pero sin saber que?'],
  [3, '¿tiene casi siempre una contestación lista ala mano cuando se le habla?'],
  [4, '¿se siente algunas veces feliz, algunas veces triste, sin una razón real?'],
  [5, '¿permanece usualmente retraído (a) en fiestas y reuniones?'],
  [6, '¿cuando era niño(a) ¿hacia siempre inmediatamente lo que le decían, sin refunfuñar?'],
  [7, '¿se enfada o molesta a menudo?'],
  [8, '¿cuando lo(a) meten a una pelea ¿prefiere sacar los trapitos al aire de una vez por todas, en vez de quedar callado(a) esperando que las cosas se calmen solas?'],
  [9, '¿es usted triste, melancólico (a)?'],
  [10, '¿le gusta mezclarse con la gente?'],
  [11, '¿a perdido a menudo el sueño por sus preocupaciones?'],
  [12, '¿se pone a veces malhumorado (a)?'],
  [13, '¿se catalogaría a si mismo(a) como despreocupado (a) o confiado a su buena suerte?'],
  [14, '¿se decide a menudo demasiado tarde?'],
  [15, '¿le gusta trabajar solo (a)?'],
  [16, '¿se ha sentido a menudo apático (a) y cansado(a) sin razón?'],
  [17, '¿es por lo contrario animado(a) y jovial?'],
  [18, '¿se ríe a menudo de chistes groseros?'],
  [19, '¿se siente a menudo hastiado(a), harto, fastidiado?'],
  [20, '¿se siente incomodo(a) con vestidos que no son del diario?'],
  [21, '¿se distrae (vaga su mente) a menudo cuando trata de prestar atención a algo?'],
  [22, '¿puede expresar en palabras fácilmente lo que piensa?'],
  [23, '¿se abstrae (se pierde en sus pensamientos) a menudo?'],
  [24, '¿esta completamente libre de prejuicios de cualquier tipo?'],
  [25, '¿le gusta las bromas?'],
  [26, '¿piensa a menudo en su pasado?'],
  [27, '¿le gusta mucho la buena comida?'],
  [28, '¿cuándo se fastidia ¿necesita algún(a) amigo(a) para hablar sobre ello?'],
  [29, '¿le molesta vender cosas o pedir dinero a la gente para alguna buena causa?'],
  [30, '¿alardea (se jacta) un poco a veces?'],
  [31, '¿es usted muy susceptible (sensible) por algunas cosas?'],
  [32, '¿le gusta mas quedarse en casa, que ir a una fiesta aburrida?'],
  [33, '¿se pone a menudo tan inquieto(a) que no puede permanecer sentado(a) durante mucho rato en una silla?'],
  [34, '¿le gusta planear las cosas, con mucha anticipación?'],
  [35, '¿tiene a menudo mareos (vértigos)?'],
  [36, '¿contesta siempre una carta personal, tan pronto como puede,  después de haberla leído?'],
  [37, '¿hace usted usualmente las cosas mejor resolviéndolas solo(a) que hablando a otra persona sobre ello?'],
  [38, '¿le falta frecuentemente aire, sin haber hecho un trabajo pesado?'],
  [39, '¿es usted generalmente una persona tolerante, que no se molesta si las cosas no están perfectas?'],
  [40, '¿sufre de los nervios?'],
  [41, '¿le gustaría mas planear cosas, que hacer cosas?'],
  [42, '¿deja algunas veces para mañana. Lo que debería hacer hoy día?'],
  [43, '¿se pone nervioso(a) en lugares tales como ascensores, trenes o túneles?'],
  [44, '¿cuando hace nuevos amigos(as) ¿es usted usualmente quien inicia la relación o invita a que se produzca?'],
  [45, '¿sufre fuertes dolores de cabeza?'],
  [46, '¿siente generalmente que las cosas se arreglaran por si solas y que terminaran bien de algún modo?'],
  [47, '¿le cuesta trabajo coger el sueño al acostarse en las noches?'],
  [48, '¿ha dicho alguna vez mentiras en su vida?'],
  [49, '¿dice algunas veces lo primero que se le viene a la cabeza?'],
  [50, '¿se preocupa durante un tiempo demasiado largo, después de una experiencia embarazosa?'],
  [51, '¿se mantiene usualmente hérnico(a) o encerrado (a) en si mismo(a), excepto con amigos muy íntimos?'],
  [52, '¿se crea a menudo problemas, por hacer cosas sin pensar?'],
  [53, '¿le gusta contar chistes y referir historias graciosas a sus amigos?'],
  [54, '¿se le hace más fácil ganar que perder un juego?'],
  [55, '¿se siente a menudo demasiado consciente de si mismo(a) o poco natural cuando esta con sus superiores?'],
  [56, '¿cuando todas las posibilidades están contra usted, ¿piensa aun usualmente que vale la pena intentar?'],
  [57, '¿siente “sensaciones” en el abdomen, antes de un hecho importante?']
];


$cuestionario = '';

$count = 1;
for( $i=0; $i<count($array_preguntas); $i++ ) {

  $num_pregunta = $array_preguntas[$i][0];
  $descripcion_pregunta = $array_preguntas[$i][1];
  $cuestionario .= '

    <tr>

      <td style="width: 91%; float: left; /*background-color: red;*/ height: 10px;">
        <table>
          <tr>
            <td style="max-width: 20px; width: 20px; text-align: center; font-weight: bold; /*background-color: lightblue;*/">
              <p style="margin:0; margin-bottom: 20px;">'.$num_pregunta.'</p>
            </td>
            <td style="max-width: 105%; width: 105%; text-align: left;" class="td-descripcion-item">
                <p class="descripcion-item-text" style="margin:0; margin-bottom: 20px; margin-left: 5px; /*background-color: tomato;*/ width: 100%;">'.$descripcion_pregunta.'</p>
            </td>
          </tr>
        </table>
      </td>    

      <td style="/*background-color: blue;*/ width: 9%; height: 10px;">
        <table class="tabla-valoracion" style="float: right;">
          <tr>
            <td>
                <input type="radio" name="item_'.$count.'" id="item_'.$count.'_1" value="1">
                <label for="item_'.$count.'_1" class="label-opcion">Sí</label>
            </td>
            <td>
                <input type="radio" name="item_'.$count.'" id="item_'.$count.'_2" value="2">
                <label for="item_'.$count.'_2" class="label-opcion">No</label>
            </td>
          </tr>
        </table>
      </td>

    </tr>

  ';

  $count++;

}


$data='';

$data.= '


  <!-- ================================ Inicio del cuerpo ================================ -->
  <main>

    <div style="width: 100%; background-color: #4f636d; height: 10px;"></div>

    <!-- ================================ Inicio del class="txCenter" ================================ -->
    <div class="txCenter" style="box-sizing: border-box; width: 90%; margin: auto; margin-top: 25px;">

      <div style="margin-top: 0px; max-width: 625px; margin: auto; width: 625px;">
        <div style="float: left;width: 14%;">
            <img src="../../../config/foto_jugador.png" style="width: 100%; height: 100px; border: 2px solid black; margin-left: 5px;">
        </div>
        <div style="float: right;width: 83%;padding-left: 10px;">
            <p  style="text-align: center; font-weight: bold; margin: 16px 0px;" class="big-text">INVENTARIO DE PERSONALIDAD EYSENCK</p>
            <p  style="font-size: 14px; font-weight: normal;text-align: center; margin: 16px 0px;">FORMATO B - CUESTIONARIO</p>
        </div>        
      </div>

      <br/><br/><br/><br/><br/><br/>
      <div style="clear: both; max-width: 625px; margin: auto; width: 625px;"><hr/></div>

      <div style="clear: both; max-width: 600px; margin: auto; width: 600px; border: 1px solid black; padding: 10px; margin-top: 10px; margin-bottom: 25px;">          
        <p style="text-align: center; font-weight: bold; margin-top: -5px; margin-bottom: 5px;">INSTRUCCIONES</p>

        <p style="text-align: justify; margin: 0;">Aquí tienes algunas preguntas sobre el modo como usted se comporta, siente y actúa. Después de cada pregunta, conteste en la hoja de respuestas con un “SI” o con una “NO”según sea su caso.</p>

        <p style="text-align: justify; margin: 0;">Trate de decir “SI” o “NO” representa su modo usual de actuar o sentir, entonces, ponga un aspa o cruz en el circulo debajo de la columna “SI” o “NO” de su hoja de respuestas. Trabaje rápidamente y no emplee mucho tiempo en cada pregunta; queremos su primera reacción, en un proceso de pensamiento prolongado.</p>

        <p style="text-align: justify; margin: 0;">El cuestionario total no debe de tomar más que unos pocos minutos. Asegúrese de omitir alguna pregunta.</p>

        <p style="text-align: justify; margin: 0;">Ahora comience. Trabaje rápidamente y recuerde de contestar todas las preguntas. No hay contestaciones “correctas” ni “incorrectas” y esto no es un test de inteligencia o habilidad, sino simplemente una medida de la forma como usted se comporta.</p>
      </div>   

      <table style="625px; margin: auto; width: 625px;" id="tabla_evaluacion_psicologica" class="gfg">'.$cuestionario.'</table>      

    </div>
    <!-- ================================ Fin del class="txCenter" ================================ -->    
  
    <!-- ================================ Inicio del class="txCenter" ================================ -->
    <div class="txCenter" style="box-sizing: border-box;width: 70%;margin: auto;margin-top: 10px;">
      <div style="border: 3px solid black; padding: 20px;">
        <p style="font-size: 14px;">POR FAVOR ASEGURESE QUE HAYA CONTESTADO TODAS LAS PREGUNTAS</p>
      </div>        
    </div>
    <!-- ================================ Fin del class="txCenter" ================================ -->

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
$titulo_documento_salida = "[11Analytics]_cuestionario_personalidad.pdf";
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
@font-face {font-family: "Bernard MT Condensed V2";
  src: url("../../@font-face/eceba41a00b4b94ea2965371c8dda96c.eot"); /* IE9*/
  src: url("../../@font-face/eceba41a00b4b94ea2965371c8dda96c.eot?#iefix") format("embedded-opentype"), /* IE6-IE8 */
  url("../../@font-face/eceba41a00b4b94ea2965371c8dda96c.woff2") format("woff2"), /* chrome、firefox */
  url("../../@font-face/eceba41a00b4b94ea2965371c8dda96c.woff") format("woff"), /* chrome、firefox */
  url("../../@font-face/eceba41a00b4b94ea2965371c8dda96c.ttf") format("truetype"), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
  url("../../@font-face/eceba41a00b4b94ea2965371c8dda96c.svg#Bernard MT Condensed V2") format("svg"); /* iOS 4.1- */
}

* {
  margin:0;
  padding:0
}

@page { margin-top: 10px; margin-bottom: 50px;}
header {
position: fixed; left: 0px; top: -90px; right: 0px; height: 450px; text-align: center;
}

footer {
  position: fixed; 
  /*bottom: -30px;*/ 
  bottom: -60px; 
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
  font-weight: bold;
  text-align: left;
  width: 100px;  
}

.datos-principales {
  margin-left: 10px;
}

.float-left {
  float: left;
}

.float-right {
  float: right;
}

.gray-textarea {
  background-color: #eeeeee;
  border: 2px solid #bebdbd;
}

.p-textarea {
  text-align: left;
  margin: 10px 5px;
  text-transform: uppercase;
  font-size: 11px;
}


.posicion-jugador {
  position: relative;
  border: 1px solid gray;
  padding: 0.5em;
  -webkit-appearance: none;
  border-radius: 50px;
  width: 15px;
  height: 15px;
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
  left: 240px;
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
  font-size: 10px;
  position: relative;
  top: 2px;
}

.t-datos-jugador {
  margin-bottom: 7px;
  font-size: 12px;
  color: #565454;
}

.t-black {
  background-color: #413d3d;
  color: white;
  border: 3px solid #7d7d7d;
}

.t-black thead tr {
  text-transform: uppercase;
}

.t-black thead tr th {
  padding: 5px;
  font-weight: normal;
}

.bernard-mt-ff {
  font-family:"Bernard MT Condensed V2" !important;
}

.tabla_opciones input[type=radio], .tabla-valoracion input[type=radio] {
    display: none;
}   

.label-opcion {
  font-weight: bold;
}

.titulo-cuestionario {
    max-width: 600px;
    margin: auto;
    width: 100%;
}   

.tabla-valoracion, .tabla-valoracion tr td {
  border: 1px solid black;
}        

.tabla-valoracion td {
  text-align: center;
  padding: 0px; 0px;
  font-size: 12px;
  width: 15px;
}

.big-text {
    font-size: 20px;
    text-transform: uppercase;
}     

.gfg { 
    border-collapse:separate; 
    border-spacing:0 5px; 
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