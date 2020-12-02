<?php 
include('../../../bd/kine_BD.php');

$data='';
$nombre = $_POST['nombre'];

$tratamiento = ver_tratamientos_pdf($_POST['idjugador']);

for ($i=0; $i < count($tratamiento); $i++) {

$ej = '';
$el = '';
$nombreej = '';
$nombreel = '';

$rrsspp=buscar_datosPDF($tratamiento[$i]['idtratamiento_kine']);

$elongaciones = $rrsspp[0]['elongaciones'];
$ejercicios = $rrsspp[0]['ejercicios'];
$names = $rrsspp[0]['nombresEjercicios'];

for ($j=0; $j < count($ejercicios); $j++) { 

  for ($o=0; $o < count($names); $o++) { 
    if ($names[$o]['idejercicio_kine'] == $ejercicios[$j]['idejercicio_kine']) { $nombreej = $names[$o]['nombre_ejercicio'];} 
  }

  $ej.= '<tr>
            <td class="tablet"><b>'.$nombreej.'</b></td>
            <td class="tablet"><b>Series: </b><span>'.$ejercicios[$j]['serie_asignado'].'</span></td>
            <td class="tablet"><b>Repeticiones: </b>'.$ejercicios[$j]['repeticion_asignado'].'<span></span></td>
            <td class="tablet"><b>Tiempo: </b><span>'.$ejercicios[$j]['carga_asignado'].'</span></td>
          </tr>';
}

for ($l=0; $l < count($elongaciones); $l++) { 

  for ($u=0; $u < count($names); $u++) { 
    if ($names[$u]['idejercicio_kine'] == $elongaciones[$l]['idejercicio_kine']) { $nombreel = $names[$u]['nombre_ejercicio'];} 
  }

  $el.= '<tr>
            <td class="tablet"><b>'.$nombreel.'</b></td>
            <td class="tablet"><b>Series: </b><span>'.$elongaciones[$l]['serie_elongaciones'].'</span></td>
            <td class="tablet"><b>Repeticiones: </b>'.$elongaciones[$l]['repeticion_elongaciones'].'<span></span></td>
            <td class="tablet"><b>Tiempo: </b><span>'.$elongaciones[$l]['carga_elongaciones'].'</span></td>
          </tr>';
}

$anamnesis = $tratamiento[$i]['anamnesis_tratamiento'];
$descripcion = $tratamiento[$i]['descripcion_tratamiento'];
$patologia = $tratamiento[$i]['patologia_tratamiento'];
$fecha = $tratamiento[$i]['fecha_tratamiento'];
$campo1 = $tratamiento[$i]['us_tratamiento'];
$campo2 = $tratamiento[$i]['tens_tratamiento'];
$campo3 = $tratamiento[$i]['tif_tratamiento'];
$campo4 = $tratamiento[$i]['rusa_tratamiento'];
$campo5 = $tratamiento[$i]['micro_tratamiento'];
$campo6 = $tratamiento[$i]['tecar_tratamiento'];
$campo7 = $tratamiento[$i]['chc_tratamiento'];
$campo8 = $tratamiento[$i]['crio_tratamiento'];
$campo9 = $tratamiento[$i]['neum_tratamiento'];
$campo10 = $tratamiento[$i]['swt_tratamiento'];
$manana1 = $tratamiento[$i]['manana1_tratamiento'];
$manana2 = $tratamiento[$i]['manana2_tratamiento'];
$tarde1 = $tratamiento[$i]['tarde1_tratamiento'];
$tarde2 = $tratamiento[$i]['tarde2_tratamiento'];

if ($campo1 == 1) {$valor1 = 'checked';}else{$valor1 = '';}
if ($campo2 == 1) {$valor2 = 'checked';}else{$valor2 = '';}
if ($campo3 == 1) {$valor3 = 'checked';}else{$valor3 = '';}
if ($campo4 == 1) {$valor4 = 'checked';}else{$valor4 = '';}
if ($campo5 == 1) {$valor5 = 'checked';}else{$valor5 = '';}
if ($campo6 == 1) {$valor6 = 'checked';}else{$valor6 = '';}
if ($campo7 == 1) {$valor7 = 'checked';}else{$valor7 = '';}
if ($campo8 == 1) {$valor8 = 'checked';}else{$valor8 = '';}
if ($campo9 == 1) {$valor9 = 'checked';}else{$valor9 = '';}
if ($campo10 == 1) {$valor10 = 'checked';}else{$valor10 = '';}

if ($manana1 == 1) {$m1 = 'checked';}else{$m1 = '';}
if ($manana2 == 1) {$m2 = 'checked';}else{$m2 = '';}
if ($tarde1 == 1) {$t1 = 'checked';}else{$t1 = '';}
if ($tarde2 == 1) {$t2 = 'checked';}else{$valor10 = '';}

$data.= '

<div class="txCenter">

  <div class="txCenter">
    <h3> TRATAMIENTO LESIONES </h3><br>
    <h4 class="margintitular">'.$nombre.'</h4>
  </div>


  <center>
    <div class="txCenter wa">
      <div class="txCenter">
        <div class="txCenter btn fecha1 tx13 displaylb"><a>Fecha</a></div>
        <input type="text" class="txCenterL tx14 fecha3 fondoClaro" value="'.$fecha.'">
      </div>
    </div>
  </center>

<br>

  <center>
    <div class="txCenter wab">
        <div class="totalpaginas">
          <div class="btn fecha tx13 displaylb porcion1"><a>Patología</a></div>
          <input type="text"  class="porcion2 fondoClaro pp" value="'.$patologia.'">
        </div>
    </div>
  </center>

<br>

  <center>
    <div class="txCenter totalpagina wa">

        <div class="w95">
          <div class="btn fecha tx13 w95"><a>Anamnesis</a></div>
          <div class="w95 especialarea fondoClaro fecha2"> '.$anamnesis.' </div>
        </div>

    </div>
  </center>

<br>
  
  <center>
    <div class="txCenter totalpagina">
      <div class="btn fecha tx13 w95 fisiot"><a>FISIOTERAPIA</a></div>
    </div>

    <center>
      <div class="displaylb margen">
       <table> 
        <tr>
          <td class="pard"> <input '.$valor1.' type="checkbox">us </td>
          <td class="pard"> <input '.$valor2.' type="checkbox">tens </td>
          <td class="pard"> <input '.$valor3.' type="checkbox">tif </td>
          <td class="pard"> <input '.$valor4.' type="checkbox">rusa </td>
          <td class="pard"> <input '.$valor5.' type="checkbox">micro </td>
          <td class="pard"> <input '.$valor6.' type="checkbox">tecar </td> 
          <td class="pard"> <input '.$valor7.' type="checkbox">chc </td>
          <td class="pard"> <input '.$valor8.' type="checkbox">crio </td>
          <td class="pard"> <input '.$valor9.' type="checkbox">neum </td>
          <td class="pard"> <input '.$valor10.' type="checkbox">swt </td>
        </tr>
       </table>
      </div>
    </center>
  </center>

  <center>
    <div class="wa txCenter totalpagina">
      
        <div class="w95">
          <center>
            <div class="btn fecha tx13 w95"><a>Descripción del Tratamiento</a></div>
            <div class="w95 especialarea fondoClaro fecha2">'.$descripcion.'</div>
          </center>
        </div>
      
    </div>
  </center>
  
<br>

  <div>
    <center>

      <div class="txCenter totalpagina">
        <div class="btn fecha tx13 w95 fisiot"><a>EJERCICIOS</a></div>
      </div>

      <div class="left">

        <div class="float">
          <div> <input '.$m1.' type="checkbox"> <label> MAÑANA </label> </div>
          <div> <input '.$t1.' type="checkbox"> <label> TARDE </label> </div>
        </div>

        <table class="tx14">
          '.$ej.'
        </table>
        
      </div>

    </center>

<br>

    <center>
      <div class="txCenter totalpagina">
        <div class="btn fecha tx13 w95 fisiot"><a>ELONGACIONES</a></div>
      </div>

      <div class="left">

        <div class="float">
          <div> <input '.$m2.' type="checkbox"> <label> MAÑANA </label> </div>
          <div> <input '.$t2.' type="checkbox"> <label> TARDE </label> </div>
        </div>

        <table class="tx14">
          '.$el.'
        </table>

      </div>
    </center>
  </div>

</div>

';

  if ($i != count($tratamiento)-1) {
    $data.= '<div class="page_break"></div>';
  }
}

/*=====  End of HTML PRINT  ======*/

$salida = str_replace("  ", "_", $nombre);
$salida = str_replace(" ", "_", $salida);

require_once('../../../dompdf/autoload.inc.php');
require_once ('../../../dompdf/lib/html5lib/Parser.php');
require_once ('../../../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php');
require_once ('../../../dompdf/lib/php-svg-lib/src/autoload.php');
require_once ('../../../dompdf/src/Autoloader.php');
use Dompdf\Dompdf;
/////////////////////////////// CONFIGURACION DEL DOCUMENTO /////////////////////////////
$pdf = new Dompdf();
$pdf->setPaper('letter', 'portrait');  //A4, letter  ;  portrait (posicion vertical; landscape (posición horizontal))
$titulo_documento_salida = "[11Analytics]_tratamiento_lesiones_".$salida.".pdf";
/////////////////////////////////////////////////////////////////////////////////////////

$html='<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>
@font-face {
  font-family: "Helvetica";
}

.page_break {page-break-before:always; } 

body{
  font-family: "Helvetica";
}
.page_break {
    page-break-before: always;
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

.btn{
  border-bottom-left-radius:2px;
  border-top-left-radius:2px;
  background-color:#28b779;
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
  border:solid 1px #28B779;
}
.fecha3{
  margin-top: -0.5px;
  padding: 6px;
  border:solid 1px #28B779;
}

.fondoClaro{
  background-color: #D4FFDC; 
}
.fondoNormal{
 background-color: #28B779; 
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
  border: solid 1px #28B779;
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
  border: solid 2px #28b779;
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

</style>
';

$html.=$data;

$html.='
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