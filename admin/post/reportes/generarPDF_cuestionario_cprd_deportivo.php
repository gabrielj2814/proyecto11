<?php 

$array_items = [
  [1, 'Suelo tener problemas concentrándome mientras compito.'],
  [2, 'Mientras duermo, suelo "darle muchas vueltas" a la competición (o el partido) en la que voy a participar.'],
  [3, 'Tengo una gran confianza en mi técnica.'],
  [4, 'Algunas veces no me encuentro motivado(a) por entrenar.'],
  [5, 'Me llevo muy bien con otros miembros del equipo.'],
  [6, 'Rara vez me encuentro tan tenso(a) como para que mi tensión interfiera negativamente en mi rendimiento'],
  [7, 'A menudo ensayo mentalmente lo que debo hacer justo antes de comenzar mi participación'],
  [8, 'La mayoría de las competiciones (o partidos) confío en que lo haré bien.'],
  [9, 'Cuando lo hago mal, suelo perder la concentración.'],
  [10, 'No se necesita mucho para que se debilite la confianza en mi mismo(a).'],
  [11, 'Me importa más mi propio rendimiento que el rendimiento del equipo (más lo que tengo que hacer yo que lo que tiene que hacer el equipo).'],
  [12, 'A menudo estoy "muerto(a) de miedo" en los momentos anteriores al comienzo de mi participación en una competición (o en un partido).'],
  [13, 'Cuando cometo un error me cuesta olvidarlo para concentrarme rápidamente en lo que tengo que hacer.'],
  [14, 'Cualquiera pequeña lesión o un mal entrenamiento puede debilitar mi confianza en mí mismo(a).'],
  [15, 'Establezco metas (u objetivos) que debo alcanzar y normalmente las consigo.'],
  [16, 'Algunas veces siento una intensa ansiedad mientras estoy participando en una prueba (o jugando un partido).'],
  [17, 'Durante mi actuación en una competición (o en un partido) mi atención parece fluctuar una y otra vez entre lo que tengo que hacer y otras cosas.'],
  [18, 'Me gusta trabajar con mis compañeros de equipo.'],
  [19, 'Tengo frecuentes dudas respecto a mis posibilidades de hacerlo bien en una competición (o en un partido).'],
  [20, 'Gasto mucha energía intentando estar tranquilo(a) antes de que comience una competición (o un partido).'],
  [21, 'Cuando comienzo haciéndolo mal, mi confianza baja rápidamente.'],
  [22, 'Pienso que el espíritu de equipo es muy importante.'],
  [23, 'Cuando practico mentalmente lo que tengo que hacer, me veo "haciéndolo como si estuviera viéndome desde mi persona en un monitor de televisión".'],
  [24, 'Generalmente, puedo seguir participando (jugando) con confianza, aunque se trate de una de mis peores actuaciones.'],
  [25, 'Cuando me preparo para participar en una prueba (o para jugar un partido), intento imaginarme, desde mi propia perspectiva, lo que veré, haré o notaré cuando la situación sea real.'],
  [26, 'Mi confianza en mí mismo(a) es muy inestable.'],
  [27, 'Cuando mi equipo pierde me encuentro mal con independencia de mi rendimiento individual.'],
  [28, 'Cuando cometo un error en una competición (o en un partido) me pongo muy ansioso.'],
  [29, 'En este momento, lo más importante en mi vida es hacerlo bien en mi deporte.'],
  [30, 'Soy eficaz controlando mi tensión.'],
  [31, 'Mi deporte es toda mi vida.'],
  [32, 'Tengo fé en mí mismo(a).'],
  [33, 'Suelo encontrarme motivado(a) por superarme día a día.'],
  [34, 'A menudo pierdo la concentración durante la competición (o durante los partidos) como consecuencia de las decisiones de los árbitros o jueces que considero desacertadas y van en contra mía o de mi equipo.'],
  [35, 'Cuando cometo un error durante una competición (o durante un partido) suele preocuparme lo que piensen otras personas como el entrenador, los compañeros de equipo o alguien que esté entre los espectadores.'],
  [36, 'El día anterior a una competición (o un partido) me encuentro habitualmente demasiado nervioso(a) o preocupado(a).'],
  [37, 'Suelo marcarme objetivos cuya consecución depende de mí al 100% en lugar de objetivos que no dependen sólo de mí.'],
  [38, 'Creo que la aportación específica de todos los miembros de un equipo es sumamente importante para la obtención del éxito del equipo.'],
  [39, 'No merece la pena dedicar tanto tiempo y esfuerzo como yo le dedico al deporte.'],
  [40, 'En las competiciones (o en los partidos) suelo animarme con palabras, pensamientos o imágenes.'],
  [41, 'A menudo pierdo la concentración durante una competición (o un partido) por preocuparme o ponerme a pensar en el resultado final.'],
  [42, 'Suelo aceptar bien las críticas e intento aprender de ellas.'],
  [43, 'Me concentro con facilidad en aquello que es lo más importante en cada momento de una competición (o de un partido).'],
  [44, 'Me cuesta aceptar que se destaque más la labor de otros miembros del equipo que la mía.'],
  [45, 'Cuando finaliza una competición (o un partido) analizo mi rendimiento de forma objetiva y específica (es decir, considerando hechos reales y cada apartado de la competición o el partido por separado).'],
  [46, 'A menudo pierdo la concentración en la competición (o el partido) a consecuencia de la actuación o los comentarios poco deportivos de los adversarios.'],
  [47, 'Me preocupan mucho las decisiones que respecto a mí pueda tomar el entrenador durante una competición (o un partido).'],
  [48, 'No ensayo mentalmente, como parte de mi plan de entrenamiento, situaciones que debo corregir o mejorar.'],
  [49, 'Durante los entrenamientos suelo estar muy concentrado(a) en lo que tengo que hacer.'],
  [50, 'Suelo establecer objetivos prioritarios antes de cada sesión de entrenamiento y de cada competición (o partido).'],
  [51, 'Mi confianza en la competición (o en el partido) depende en gran medida de los éxitos o fracasos en las competiciones (o partidos) anteriores.'],
  [52, 'Mi motivación depende en gran medida del reconocimiento que obtengo de los demás.'],
  [53, 'Las instrucciones, comentarios y gestos del entrenador suelen interferir negativamente en mi concentración durante la competición (o el partido).'],
  [54, 'Suelo confiar en mí mismo(a) aún en los momentos más difíciles de una competición (o de un partido).'],
  [55, 'Estoy dispuesto(a) a cualquier esfuerzo por ser cada vez mejor.']
];

$cuestionario = '';


$count = 0;
for( $i=0; $i<count($array_items); $i++ ) {

  $num_item = $array_items[$i][0];
  $descripcion_item = $array_items[$i][1];

  $cuestionario .= '
    <tr>

      <td style="width: 80%; float: left; /*background-color: red;*/ height: 10px;">
        <table>
          <tr>
            <td style="max-width: 20px; width: 20px; text-align: center; font-weight: bold; /*background-color: lightblue;*/">
              <p style="margin:0; margin-bottom: 20px;">'.$num_item.'</p>
            </td>                   
            <td style="max-width: 105%; width: 105%; text-align: left;" class="td-descripcion-item">
                <p class="descripcion-item-text" style="margin:0; margin-bottom: 20px; margin-left: 5px; /*background-color: tomato;*/ width: 100%; font-weight: normal;">'.$descripcion_item.'</p>
            </td>
          </tr>
        </table>
      </td>    

      <td style="/*background-color: blue;*/ width: 20%; height: 10px;">
        <table class="tabla-valoracion" style="float: right;">
          <tr>
            <td>
                <input type="radio" name="item_'.$count.'" id="item_'.$count.'_1" value="1">
                <label for="item_'.$count.'_1" class="label-opcion">1</label>
            </td>
            <td>
                <input type="radio" name="item_'.$count.'" id="item_'.$count.'_2" value="2">
                <label for="item_'.$count.'_2" class="label-opcion">2</label>
            </td>
            <td>
                <input type="radio" name="item_'.$count.'" id="item_'.$count.'_3" value="3">
                <label for="item_'.$count.'_3" class="label-opcion">3</label>
            </td>
            <td>
                <input type="radio" name="item_'.$count.'" id="item_'.$count.'_4" value="4">
                <label for="item_'.$count.'_4" class="label-opcion">4</label>
            </td>
            <td>
                <input type="radio" name="item_'.$count.'" id="item_'.$count.'_5" value="5">
                <label for="item_'.$count.'_5" class="label-opcion">5</label>
            </td>
            <td style="border: 3px solid black;">
                <input type="radio" name="item_'.$count.'" id="item_'.$count.'_5" value="5">
                <label for="item_'.$count.'_6" class="label-opcion">NE</label>
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
            <p style="text-align: center; font-weight: bold; margin: 16px 0px;" class="big-text">C.P.R.D</p>
            <p style="font-size: 14px; font-weight: normal;text-align: center; margin: 16px 0px;">CARACTERÍSTICAS PSICOLÓGICAS RELACIONADAS CON EL RENDIMIENTO DEPORTIVO</p>
        </div>                       
      </div>   
      
      <br/><br/><br/><br/><br/><br/>
      <div style="clear: both; max-width: 625px; margin: auto; width: 625px;"><hr/></div>

      <div style="max-width: 600px; margin: auto; width: 600px; border: 1px solid black; padding: 10px; margin-top: 10px; margin-bottom: 25px;">          
        
        <p style="text-align: center; font-weight: bold; margin-top: -5px; margin-bottom: 5px;">INSTRUCCIONES</p>

        <p style="text-align: justify; margin: 0;">Como podrá observar existen seis opciones de respuesta, representadas cada una de ellas por un círculo. Elija la que desee, según se encuentre más o menos de acuerdo, marcando con una cruz el círculo correspondiente. En el caso de que no entienda lo que quiere decir exactamente alguna de las preguntas, marque con una cruz el círculo de la última columna.</p>
      </div>   

      <!-- ================================================================ INICIO DE TABLA ================================================================ -->  
      <table style="max-width: 625px; margin: auto; width: 625px;" class="gfg">
        <!-- ================================ -->
        <tbody>'.$cuestionario.'</tbody>
      </table>    
      <!-- ================================================================ FIN DE TABLA ================================================================ -->
      <!-- ================================================================================================================================ -->
      <div style="margin-top: 15px; max-width: 625px; margin: auto; width: 625px;">
        <img src="../../../config/arrow-right.png" style="height: 30px; margin-top: 15px; display: inline-block; float: left;">
        <p style="float: left; display: inline-block; position: relative;left: 15px; text-transform: uppercase; font-size: 12px; text-align: left; margin: 16px 0px;">por favor, compruebe si ha contestado a todas las preguntas anteriores con una <br/> sola respuesta.</p>
      </div>  


    </div>
    <!-- ================================ Fin del class="txCenter" ================================ -->

    <!--
    <footer>
      <div style="height:5px;"></div>
      <p class="bernard-mt-ff" style="text-align: left; margin-top: 10px;">Pruebas psicométricas</p>
      <p></p>
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
$titulo_documento_salida = "[11Analytics]_cuestionario_cprd_deportivo.pdf";
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
  src: url("@font-face/eceba41a00b4b94ea2965371c8dda96c.eot"); /* IE9*/
  src: url("@font-face/eceba41a00b4b94ea2965371c8dda96c.eot?#iefix") format("embedded-opentype"), /* IE6-IE8 */
  url("@font-face/eceba41a00b4b94ea2965371c8dda96c.woff2") format("woff2"), /* chrome、firefox */
  url("@font-face/eceba41a00b4b94ea2965371c8dda96c.woff") format("woff"), /* chrome、firefox */
  url("@font-face/eceba41a00b4b94ea2965371c8dda96c.ttf") format("truetype"), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
  url("@font-face/eceba41a00b4b94ea2965371c8dda96c.svg#Bernard MT Condensed V2") format("svg"); /* iOS 4.1- */
}

* {
  margin:0;
  padding:0
}

@page { margin-top: 10px; margin-bottom: 50px;}
header {
}

footer {
  position: fixed; 
  /*bottom: -30px;*/ 
  bottom: 0px; 
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

.underline-element {
  border-bottom: 1px solid black;
}

.option-circule {
  width: 25px;
  height: 25px;
  border-radius: 80%;
  border: 1px solid black;
  display: inline-block;
  -webkit-appearance: none;
}

.tabla-principal, .tabla-preguntas {
  margin: auto;
  max-width: 600px;
  width: 600px;
  border-collapse: collapse;
  font-size: 14px;
}

.tabla-principal {
  font-weight: normal;
  /*max-width: 900px;*/
  border-collapse:separate; 
  border-spacing:0 15px;   
}

.tabla-preguntas tr td {
  border: 1px solid black;
}

.right-bordered-td {
  border-right: 1px solid black;
}

.thicker-bordered-td {
 border-right: 4px solid black!important; 
}

.td-descripcion-item {
  width: 60%;
  position: relative;
}

.valor-frecuencia {
  display: inline-block;
}

.texto-frecuencia {
  text-transform: uppercase;
  font-weight: bold;
  font-size: 9px;
  text-shadow: 1px 0px #232020;
  text-align: center;
}

.td-descripcion-item p {
  text-align: left;
  font-weight: bold;
  word-break: break-all;
}

.valor-desacuerdo {
  position: relative;
  left: 350px;  
}

.valor-acuerdo {
  position: relative;
  left: 420px;
}

.valor-no-entiendo {
  position: relative;
  left: 550px;  
}

.tabla-preguntas p {
  word-break: break-all;
  font-weight: normal;
  text-align: justify;
  padding: 0px 25px;
  /*
  position: absolute;
  bottom: -10px;    
  */
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
    border-spacing:0 8px; 
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