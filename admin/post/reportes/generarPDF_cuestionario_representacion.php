<?php 

$array_item = [
    'nulo',
    'Me ayuda escribir a mano las palabras cuando tengo que aprenderlas de memoria',
    'Recuerdo mejor las cosas cuando las cuenta el profesor/a que leyéndolas en el libro de texto',
    'Se me dan bien las pruebas en las que tengo que demostrar lo aprendido leyendo el libro de texto',
    'Me gusta comer y mascar chicle mientras estudio y hago ejercicios',
    'Si presto atención a una exposición oral, puedo recordar las ideas principales sin anotarlas',
    'Prefiero las instrucciones escritas antes que las orales',
    'Resuelvo muy bien rompecabezas y laberintos',
    'Se me dan bien las pruebas en las que he de demostrar lo que aprendí oyendo una conferencia',
    'Me ayuda ver diapositivas y videos para comprender un tema',
    'Recuerdo más cuando leo un libro que cuando escucho una exposición oral',
    'Por lo general, tengo que escribir los números del teléfono para recordarlos bien',
    'Prefiero recibir las noticias escuchando la radio antes que leerlas en un periódico',
    'Me gusta tener algo como un bolígrafo o un lápiz en la mano cuando estudio',
    'Necesito copiar los ejemplos de la pizarra del profesor/a para poder repasarlos más tarde',
    'Prefiero las instrucciones orales del profesor/a a aquellas escritas en un examen o en la pizarra',
    'Prefiero que los libros con diagramas gráficos y cuadros porque me ayudan a aprender mejor',
    'Me gusta escuchar música al hacer ejercicios y estudiar.',
    'Las clases que más me gustan son aquellas en las que se organizan debates y se puede dialogar',
    'Puedo corregir mi propia tarea examinándola y encontrando la mayoría de los errores',
    'Prefiero las actividades en las que tengo que hacer cosas y puedo moverme',
    'Puedo recordar los números de teléfono cuando los oigo',
    'Me encanta hacer cosas con las manos y herramientas',
    'Cuando escribo algo, necesito leerlo en voz alta para oír como suena',
    'Recuerdo mejor las cosas cuando puedo moverme o caminar mientras estoy aprendiéndolas'
];

$cuestionario = '';

$count = 1;
for( $i=1; $i<count($array_item); $i++ ) {

  $item = $array_item[$i];
  $cuestionario .= ' 
  
    <tr>

      <td style="width: 83%; float: left; /*background-color: red;*/ height: 0px;">
        <table>
          <tr>
            <td style="max-width: 20px; width: 20px; text-align: center; font-weight: bold; /*background-color: lightblue;*/">
              <p style="margin:0; margin-bottom: 20px;">'.$count.'</p>
            </td>            
            <td style="max-width: 105%; width: 105%; text-align: left;" class="td-descripcion-item">
                <p class="descripcion-item-text" style="margin:0; margin-bottom: 20px; margin-left: 5px; /*background-color: tomato;*/ width: 100%;">'.$item.'</p>
            </td>
          </tr>
        </table>
      </td>    

      <td style="/*background-color: blue;*/ width: 17%; height: 0px;">
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
              <p  style="text-align: center; font-weight: bold; margin: 16px 0px;" class="big-text">TEST SISTEMA DE REPRESENTACIÓN DOMINANTE</p>
              <p  style="font-size: 14px; font-weight: normal;text-align: center; margin: 16px 0px;">Diseñado por Ralph Metts (1999) y re-maquetado por Colectivo Cinética</p>
          </div>        
        </div>

        <br/><br/><br/><br/><br/><br/>
        <div style="clear: both; max-width: 625px; margin: auto; width: 625px;"><hr/></div>

        <div class="div-responsive" style="clear: both; max-width: 625px; margin: auto; width: 625px; margin-bottom: 25px;">
            <p style="font-size: 15px; font-weight: bold;margin: 0; margin: 10px 0px; text-align: left;">Establece cuál es tu sistema de representación dominante valorando desde el 1 (muy en desacuerdo) al 5 (totalmente de cuerdo) las siguientes afirmaciones.</p>
        </div>          

        <form name="cuestionario_checkin_form" style="margin-top: 0px; max-width: 625px; margin: auto; width: 625px;">

            <div class="container-responsive-table">
              <table class="gfg" style="max-width: 625px; width: 625px;">
                <tbody>'.$cuestionario.'</tbody>
              </table>
            </div>

            <div class="div-responsive">
                <p class="small-text" style="text-align: justify;"><span style="text-decoration: overline; font-weight: normal;">En Colectivo Cinética creemos que la</span> innovación educativa ha de basarse en el intercambio y la construcción compartida de conocimientos. Por eso, en aras de promover la inteligencia colectiva, os autorizamos a utilizar, modificar y compartir este documento, siempre que respetéis su autoría y, por supuesto, lo convirtáis en algo mejor.</p>
            </div>

            <!-- Salto de página -->
            <div style="page-break-after: always;"></div>

            <div class="div-responsive">
                <p class="big-text" style="text-align: left;margin: 20px 0px 0px 0px; text-align: left;">EVALUACIÓN DEL TEST</p>
                <p class="small-text" style="font-size: 12px; margin: 3px 0px 25px 0px; text-align: justify;">Rellena las siguientes tablas escribiendo en el recuadro de cada pregunta la puntuación que estableciste en el test anterior. Luego suma estos puntajes y tendrás tu sistema de representación dominante: los que presenten valores más altos</p>
            </div>            

            <!-- ================================================ Inicio del class="container-responsive-table" ================================================ -->
            <div class="container-responsive-table">
            <!-- ================================================ RESULTADO DE TEST VISUAL ================================================ -->
                <table class="tabla_resultados_test">
                    <tr>
                        <td class="titulo-tabla-resultado" rowspan="2" style="width:120px;"><div>visual</div></td>
                        <th style="width: 55px; text-align: center;">1</th>
                        <th style="width: 55px; text-align: center;">3</th>
                        <th style="width: 55px; text-align: center;">6</th>
                        <th style="width: 55px; text-align: center;">9</th>
                        <th style="width: 55px; text-align: center;">10</th>
                        <th style="width: 55px; text-align: center;">11</th>
                        <th style="width: 55px; text-align: center;">14</th>
                        <th style="width: 55px; text-align: center;">16</th>
                        <th style="width: 55px; text-align: center;" class="celda-total">TOTAL</th>
                    </tr>
                    <tr>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;" class="celda-total"></td>
                    </tr>                
                </table>

                <!-- ================================================ RESULTADO DE TEST AUDITIVO ================================================ -->
                <table class="tabla_resultados_test">
                    <tr>
                        <td class="titulo-tabla-resultado" rowspan="2" style="width:120px;"><div>auditivo</div></td>
                        <th style="width: 55px; text-align: center;">1</th>
                        <th style="width: 55px; text-align: center;">3</th>
                        <th style="width: 55px; text-align: center;">6</th>
                        <th style="width: 55px; text-align: center;">9</th>
                        <th style="width: 55px; text-align: center;">10</th>
                        <th style="width: 55px; text-align: center;">11</th>
                        <th style="width: 55px; text-align: center;">14</th>
                        <th style="width: 55px; text-align: center;">16</th>
                        <th style="width: 55px; text-align: center;" class="celda-total">TOTAL</th>
                    </tr>
                    <tr>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;" class="celda-total"></td>
                    </tr>              
                </table>  

                <!-- ================================================ RESULTADO DE TEST KINESTÉSICO ================================================ -->
                <table class="tabla_resultados_test">
                    <tr>
                        <td class="titulo-tabla-resultado" rowspan="2" style="width:120px;"><div>kinestésico</div></td>
                        <th style="width: 55px; text-align: center;">1</th>
                        <th style="width: 55px; text-align: center;">3</th>
                        <th style="width: 55px; text-align: center;">6</th>
                        <th style="width: 55px; text-align: center;">9</th>
                        <th style="width: 55px; text-align: center;">10</th>
                        <th style="width: 55px; text-align: center;">11</th>
                        <th style="width: 55px; text-align: center;">14</th>
                        <th style="width: 55px; text-align: center;">16</th>
                        <th style="width: 55px; text-align: center;" class="celda-total">TOTAL</th>
                    </tr>
                    <tr>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;"></td>
                        <td style="height: 55px; text-align: center;" class="celda-total"></td>
                    </tr>             
                </table>                
            </div>            
            <!-- ================================================ Fin del class="container-responsive-table" ================================================ -->            

            <div class="div-responsive" style="margin-top: 105px;">
                
                <div class="div-resultado-test" style="display: inline-block;">
                    <p class="big-text-resultado-test text-center text-bold">VISUAL</p>
                    <p class="normal-text-resultado-test text-bold text-left text-bold">CÓMO APRENDO…</p>
                    <p class="normal-text-resultado-test text-left">APRENDO LO QUE VEO. PIENSO EN IMÁGENES.</p>
                    <p class="normal-text-resultado-test text-left">NECESITO UNA VISIÓN DETALLADA DE TODO. ME CUESTA RECORDAR LO QUE OIGO.</p>
                    <p class="normal-text-resultado-test text-left">ALMACENO INFORMACIÓN RÁPIDAMENTE Y EN CUALQUIER ORDEN.</p>
                    <p class="normal-text-resultado-test text-left">ALMACENO INFORMACIÓN A TRAVÉS DE SENSACIONES CORPORALES Y MOVIMIENTO.</p>
                    <p class="normal-text-resultado-test text-left">ME DISTRAIGO CUANDO LAS EXPLICACIONES SON BÁSICAMENTE AUDITIVAS Y NO ME INVOLUCRAN DE ALGUNA FORMA</p>
                    <p style="margin-top: 20px;" class="normal-text-resultado-test text-bold text-right">PROPUESTAS ADECUADAS PARA MÍ</p>
                    <p class="normal-text-resultado-test text-right">TOCAR, MOVER, SENTIR, TRABAJO DE CAMPO, PINTAR, DIBUJAR, BAILAR, LABORATORIO, HACER COSAS, MOSTRAR, REPARAR COSAS.</p>
                    <div class="break-div-result-test"></div>
                    <div class="div-img-resultado-test">
                        <img class="img-resultado-test" style="/*position: relative; left: 10px;*/" src="../../../config/visual.png">
                    </div>
                </div>

                <div class="div-resultado-test" style="margin: 0px 0px; display: inline-block;">
                    <p class="big-text-resultado-test text-center text-bold">AUDITIVO</p>
                    <p class="normal-text-resultado-test text-bold text-left">CÓMO APRENDO…</p>
                    <p class="normal-text-resultado-test text-left">APRENDO LO QUE OIGO.</p>
                    <p class="normal-text-resultado-test text-left">TIENDO A UTILIZAR LA REPETICIÓN ORAL.</p>
                    <p class="normal-text-resultado-test text-left">NO SUELO TENER UNA VISIÓN GLOBAL DE LAS COSAS. ALMACENO INFORMACIÓN DE MANERA SECUENCIAL Y POR</p>
                    <p class="normal-text-resultado-test text-left">BLOQUES ENTEROS, POR ESO ME PIERDO SI ME PREGUNTAS POR UN ELEMENTO AISLADO O ME CAMBIAS EL ORDEN DE LA PREGUNTA.</p>
                    <p class="normal-text-resultado-test text-left">ME DISTRAIGO CON EL RUIDO.</p>
                    <p style="margin-top: 20px;" class="normal-text-resultado-test text-bold text-right">PROPUESTAS ADECUADAS PARA MÍ</p>
                    <p class="normal-text-resultado-test text-right">
                        ESCUCHAR, OÍR, CANTAR, RITMO, DEBATES, DISCUSIONES, CINTAS AUDIO, LECTURAS, HABLAR EN PÚBLICO, TELEFONEAR, GRUPOS
                        PEQUEÑOS,  ENTREVISTAS.                        
                    </p>
                    <div class="break-div-result-test"></div>
                    <div class="div-img-resultado-test">
                        <img class="img-resultado-test" src="../../../config/auditivo.png">
                    </div>
                </div>
                
                <div class="div-resultado-test" style="display: inline-block;">
                    <p class="big-text-resultado-test text-center text-bold">KINESTÉSICO</p>
                    <p class="normal-text-resultado-test text-bold text-left text-bold">CÓMO APRENDO…</p>
                    <p class="normal-text-resultado-test text-left">APRENDO TOCANDO Y HACIENDO.</p>
                    <p class="normal-text-resultado-test text-left">NECESITO INVOLUCRARME FÍSICAMENTE EN EL TRABAJO.</p>
                    <p class="normal-text-resultado-test text-left">SOY MÁS DE IMPRESIONES GENERALES QUE DE DETALLES.</p>
                    <p class="normal-text-resultado-test text-left">ALMACENO INFORMACIÓN A TRAVÉS DE SENSACIONES CORPORALES Y MOVIMIENTO.</p>
                    <p class="normal-text-resultado-test text-left">ME DISTRAIGO CUANDO LAS EXPLICACIONES SON BÁSICAMENTE AUDITIVAS Y NO ME INVOLUCRAN DE ALGUNA FORMA</p>
                    <p style="margin-top: 20px;" class="normal-text-resultado-test text-bold text-right">PROPUESTAS ADECUADAS PARA MÍ</p>
                    <p class="normal-text-resultado-test text-right">TOCAR, MOVER, SENTIR, TRABAJO DE CAMPO, PINTAR, DIBUJAR, BAILAR, LABORATORIO, HACER COSAS, MOSTRAR, REPARAR COSAS.</p>
                    <div class="break-div-result-test"></div>
                    <div class="div-img-resultado-test">
                        <img class="img-resultado-test" style="/*position: relative; left: 10px;*/" src="../../../config/kinestesico.png">
                    </div>
                </div>

            </div>            

        </form>

    </div>
    <!-- ================================ Fin del class="txCenter" ================================ -->
  
  </main>

  <!-- ================================ Inicio del footer ================================ -->
  <footer></footer>
  <!-- ================================ Fin del footer ================================ -->  


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
$titulo_documento_salida = "[11Analytics]_cuestionario_representacion.pdf";
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

        #cuestionario_checkin {
            height: 100%;
            width: 100%;
            background: #ececec;
            position: absolute;
            right: 100%;
            top: 0px;
            transition: all ease .3s;
            overflow: auto;
        }
        #cuestionario_checkin.show {
            right: 0%;
        }
        #cuestionario_checkin form {
            max-width: 600px;
            margin: auto;
        }
        #cuestionario_checkin #header_cuestionario {
            display: flex;
            background: #FF4C3E;
            color: #ffffff;
        }
        #cuestionario_checkin #header_cuestionario button {
            background: none;
            border: none;
            border-right: 1px solid #ffffff;
            margin-right: 10px;
            padding: 0px 10px;
            outline: none;
            color: #ffffff;
            z-index: 99;
        }
        #cuestionario_checkin #header_cuestionario span {
            display: inline-block;
            width: 100%;
            font-size: 10px;
            font-weight: bold;
            padding-top: 9px;
            padding-bottom: 9px;
            text-align: center;
            margin-left: -32px;
        }
        #cuestionario_checkin .titulo_label {
            display: inline-block;
            width: 100%;
            font-size: 14px;
            margin-bottom: 10px;
        }
        #cuestionario_checkin form {
            padding: 15px;
        }
        #cuestionario_checkin .form {
            margin-bottom: 10px;
        }
        #cuestionario_checkin .contenedor_input a {
            width: 40%;
        }
        #cuestionario_checkin .contenedor_input.suenio a {
            width: 40%;
        }
        #cuestionario_checkin .contenedor_input.suenio a:last-child {
            width: 20%;
        }
        #cuestionario_checkin .contenedor_input.suenio input {
            width: 40%;
        }
        #cuestionario_checkin .contenedor_input input, #cuestionario_checkin .contenedor_input select {
            width: 60%;
        }
        #cuestionario_checkin .contenedor_textarea a {
            width: 100%;
        }
        #cuestionario_checkin .contenedor_textarea textarea {
            width: 100%;
            height: 100px;
            font-size: 12px;
        }
        #cuestionario_checkin .list_opciones {
            list-style: none;
            margin: 0px 0px 10px;
            padding: 0px;
        }

        .tabla_opciones {
            margin: auto;
            padding: 0px;
            border-collapse: collapse;
        }

        .tabla_opciones tbody tr td {
            border-right: 1px solid black;
        }

        .tabla_opciones tr:nth-child(even) {
            background-color: #d3d3d3;
        }

        .tabla_opciones tr:nth-child(odd) {
            background-color: #FFF;
        }

        #cuestionario_checkin .list_opciones li {
            display: flex;
            width: 100%;
            align-items: center;
        }
        .tabla_opciones input[type=radio], .tabla-valoracion input[type=radio] {
            display: none;
        }        

        .tabla_opciones span {
            display: inline-block;
            width: 15px;
            font-size: 10px;
            font-weight: normal;
            text-align: center;
        }

        .tabla_opciones label {
            font-size: 10px;
            padding: 5px 3px;
            /*background: #ffffff;*/
            border: 3px solid transparent;
            display: inline-block;
            width: calc(100% - 15px);
            margin-bottom: 3px;
            text-align: center;
            font-weight: normal;
            /*cursor: pointer;*/
        }

        .tabla_opciones p {
            margin: 0;
            font-size: 10px;
            padding: 5px 3px;
            border: 3px solid transparent;
            text-align: left;
            font-weight: normal;          
        }

        .tabla_opciones .label-opcion {
            cursor: pointer;
        }        

        .label-opcion {
          font-weight: bold;
        }

        #cuestionario_checkin .list_opciones input[type=radio]:checked ~ label {
            border: 3px solid #28b779;
        }     

        /*
        .tabla_opciones input[type=radio]:checked ~ .label-opcion {
            border: 3px solid #28b779;
        } 
        */
        

        .checked {
            background-color: #28b779;
            color: white;
        }  

        .descripcion-item-text {
            word-break: break-all;
            line-height: 15px;
            font-weight: normal;
        }

        .ellipsis-text {
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;    
            margin-bottom: 0px;
            font-weight: bold;
        }

        .titulo-cuestionario {
            max-width: 600px;
            margin: auto;
            width: 100%;
        }   

        .tabla_resultados_test {
            border-collapse: collapse;
            margin-bottom: 15px;
            max-width: 600px;
            width: 600px;
            font-size: 11px;
            background-color: white;
        }

        .celda-total {
            background-color: #ececec;
        }

        .tabla_resultados_test tr th {
            font-weight: normal;
            padding: 5px 0px;
            color: #4b4646;
        }

        .tabla_resultados_test tr td, .tabla_resultados_test tr th {
            border: 1px solid black;
        }   

        .tabla_resultados_test input {
            border: none;
            width: 90px;
            height: 50px;
            text-align: center;
        }     

        .container-responsive-table {
            overflow-x:auto;
        }

        .titulo-cuestionario p {
            margin: 0;
            margin-bottom: 7px;
        }

        .small-text {
            font-size: 10px;
        } 

        .big-text {
            font-size: 20px;
            text-transform: uppercase;
        }                

        .titulo-tabla-resultado {
            text-align: center;
            text-transform: uppercase;
            background-color: black;
            color: white;
        }

        .titulo-tabla-resultado div {
            font-size: 15px;
            position: relative;
            top: -25px;
        }

        .img-resultado-test {
            width: 125px;
            height: 100px;
        }

        .div-resultado-test {
            width: 30%;
            padding: 7px;
            border: 1px dashed #6c6969;
            position: relative;
        }

        .text-center {
            text-align: center;
        }
        
        .text-left {
            text-align: left;
        }
        
        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
            text-shadow: 0.1px 0px #232020;
        }

        .big-text-resultado-test {
            font-size: 20px;
            margin: 5px 0px 20px 0px;
            font-stretch: condensed;
            transform: scaleX(1.15);
            word-spacing: 4px;
            text-shadow: 0.1px 0px #232020;
            letter-spacing: 0.2px;
            word-break: break-all;
        }

        .normal-text-resultado-test-nosacle {
            font-size: 7px;
        }

        .normal-text-resultado-test {
            font-size: 7px;
            letter-spacing: 0px;
            font-stretch: condensed;
            transform: scaleX(0.96);
            word-spacing: 4px;
            line-height: 11px;
            position: relative;
        }

        .break-div-result-test {
            height: 0px;
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