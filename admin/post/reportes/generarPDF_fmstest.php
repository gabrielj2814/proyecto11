<?php 

$data='';

if (($_POST['p41'] == '+') || ($_POST['p42'] == '+')) {$p4 = 0; $p3 = 0;} else{ $p4 = '-'; $p3 = min($_POST['p31'],$_POST['p32']);}
if ( $_POST['p71'] == '+')                            {$p7 = 0; $p6 = 0;} else{ $p7 = '-'; $p6 = $_POST['p61'];}
if ( $_POST['p91'] == '+')                            {$p9 = 0; $p8 = 0;} else{ $p9 = '-'; $p8 = min($_POST['p81'],$_POST['p82']);}

$p0 = $_POST['p01'];
$p1 = min($_POST['p11'],$_POST['p12']);
$p2 = min($_POST['p21'],$_POST['p22']);
$p5 = min($_POST['p51'],$_POST['p52']);

$total = $p0 + $p1 + $p2 + $p3 + $p5 + $p6 + $p8;

$salida = str_replace("  ", "_", $_POST['nombre']);
$salida = str_replace(" ", "_", $salida);

$data.= '

<img src="../../img/bannerpuntuacion.jpg">

<div class="datos">
  <p class="tx12"><b>Fecha: </b><span>'.substr($_POST['fecha'], 0, 10).'</span></p>
  <p class="tx12"><b>Nombre: </b><span>'.$_POST['nombre'].'</span></p>
</div>

<table>
  <tr>
    <td class="tx14 txcenter rojoblanco" colspan="2">TEST</td>
    <td class="tx14 txcenter rojoblanco">SCORE PARCIAL</td>
    <td class="tx14 txcenter rojoblanco">SCORE FINAL</td>
    <td class="tx14 txcenter rojoblanco">COMENTARIOS</td>
  </tr>
  <tr>
    <td class="tx12 txleft winitial" colspan="2">SENTADILLA</td>
    <td class="tx12 txcenter wscore">'.$_POST['p01'].'</td>
    <td class="tx12 txcenter wscore">'.$p0.'</td>
    <td class="tx12 txleft toptop">'.$_POST['comentario0'].'</td>
  </tr>
  <tr>
    <td class="tx12 txleft winitial" rowspan="2">PASO VALLA</td>
    <td class="tx12 txcenter rojoblanco wdirect">I</td>
    <td class="tx12 txcenter wscore">'.$_POST['p11'].'</td>
    <td class="tx12 txcenter wscore" rowspan="2">'.$p1.'</td>
    <td class="tx12 txleft toptop" rowspan="2">'.$_POST['comentario1'].'</td>
  </tr>
  <tr>
    <td class="tx12 txcenter rojoblanco wdirect">D</td>
    <td class="tx12 txcenter wscore">'.$_POST['p12'].'</td>
  </tr>
  <tr>
    <td class="tx12 txleft winitial" rowspan="2">ESTOCADA</td>
    <td class="tx12 txcenter rojoblanco wdirect">I</td>
    <td class="tx12 txcenter wscore">'.$_POST['p21'].'</td>
    <td class="tx12 txcenter wscore" rowspan="2">'.$p2.'</td>
    <td class="tx12 txleft toptop" rowspan="2">'.$_POST['comentario2'].'</td>
  </tr>
  <tr>
    <td class="tx12 txcenter rojoblanco wdirect">D</td>
    <td class="tx12 txcenter wscore">'.$_POST['p22'].'</td>
  </tr>
  <tr>
    <td class="tx12 txleft winitial" rowspan="2">MOVILIDAD DE HOMBRO</td>
    <td class="tx12 txcenter rojoblanco wdirect">I</td>
    <td class="tx12 txcenter wscore">'.$_POST['p31'].'</td>
    <td class="tx12 txcenter wscore" rowspan="2">'.$p3.'</td>
    <td class="tx12 txleft toptop" rowspan="2">'.$_POST['comentario3'].'</td>
  </tr>
  <tr>
    <td class="tx12 txcenter rojoblanco wdirect">D</td>
    <td class="tx12 txcenter wscore">'.$_POST['p32'].'</td>
  </tr>
  <tr>
    <td class="tx12 txright winitial" rowspan="2">PRUEBA DE PELLIZCAMIENTO</td>
    <td class="tx12 txcenter rojoblanco wdirect">I (+/-)</td>
    <td class="tx12 txcenter wscore">'.$_POST['p41'].'</td>
    <td class="tx12 txcenter wscore" rowspan="2">'.$p4.'</td>
    <td class="tx12 txleft toptop" rowspan="2">'.$_POST['comentario4'].'</td>
  </tr>
  <tr>
    <td class="tx12 txcenter rojoblanco wdirect">D (+/-)</td>
    <td class="tx12 txcenter">'.$_POST['p42'].'</td>
  </tr>
  <tr>
    <td class="tx12 txleft winitial" rowspan="2">LEVANTAR PIERNA ACTIVA</td>
    <td class="tx12 txcenter rojoblanco wdirect">I</td>
    <td class="tx12 txcenter wscore">'.$_POST['p51'].'</td>
    <td class="tx12 txcenter wscore" rowspan="2">'.$p5.'</td>
    <td class="tx12 txleft toptop" rowspan="2">'.$_POST['comentario5'].'</td>
  </tr>
  <tr>
    <td class="tx12 txcenter rojoblanco wdirect">D</td>
    <td class="tx12 txcenter wscore">'.$_POST['p52'].'</td>
  </tr>
  <tr>
    <td class="tx12 txleft winitial" colspan="2">PUSH UP ESTABILIDAD DE TRONCO</td>
    <td class="tx12 txcenter wscore">'.$_POST['p61'].'</td>
    <td class="tx12 txcenter wscore">'.$p6.'</td>
    <td class="tx12 txleft toptop">'.$_POST['comentario6'].'</td>
  </tr>
  <tr>
    <td class="tx12 txright winitial">PRUEBA EXTENSIÓN</td>
    <td class="tx12 txcenter rojoblanco wdirect">(+/-)</td>
    <td class="tx12 txcenter wscore">'.$_POST['p71'].'</td>
    <td class="tx12 txcenter wscore">'.$p7.'</td>
    <td class="tx12 txleft toptop">'.$_POST['comentario7'].'</td>
  </tr>
  <tr>
    <td class="tx12 txleft winitial" rowspan="2">ESTABILIDAD ROTACIONAL</td>
    <td class="tx12 txcenter rojoblanco wdirect">I</td>
    <td class="tx12 txcenter wscore">'.$_POST['p81'].'</td>
    <td class="tx12 txcenter wscore" rowspan="2">'.$p8.'</td>
    <td class="tx12 txleft toptop" rowspan="2">'.$_POST['comentario8'].'</td>
  </tr>
  <tr>
    <td class="tx12 txcenter rojoblanco wdirect">D</td>
    <td class="tx12 txcenter wscore">'.$_POST['p82'].'</td>
  </tr>
  <tr>
    <td class="tx12 txright winitial">FLEXIÓN CLEARNING TEST</td>
    <td class="tx12 txcenter rojoblanco wdirect">(+/-)</td>
    <td class="tx12 txcenter wscore">'.$_POST['p91'].'</td>
    <td class="tx12 txcenter wscore">'.$p9.'</td>
    <td class="tx12 txleft toptop">'.$_POST['comentario9'].'</td>
  </tr>
  <tr>
    <td class="tx12 txleft rojoblanco" colspan="2">TOTAL FMS</td>
    <td class="txcenter tx16" colspan="3">'.$total.'</td>
  </tr>
</table>
<br>
<table class="sinestilos tx10 footerseparacion">
  <tr class="sinestilos">
    <td class="sinestilos wfooter">
      <div class="cajagris">
      <p><b>Puntuación bruta:</b> esta puntuación es usada para denotar la puntuación del lado derecho e izquierdo. Los lados derecho e izquierdo se puntúan en cinco de las siete pruebas y ambas están documentadas en este espacio.</p>

      <p><b>Puntaje final:</b> este puntaje se utiliza para denotar el puntaje general de la prueba. El puntaje más bajo para el puntaje bruto (cada lado) es transferido para dar un puntaje final para la prueba. Una persona que obtenga un tres a la derecha y un dos a la izquierda recibiría un puntaje final de dos. El puntaje final se resume y se usa como puntaje total.</p>

      <p><b>Prueba de compensación:</b> un positivo indica dolor. Un negativo indica que no hay dolor. Si el dolor está presente (+), el puntaje para esa prueba resultaría en un 0.>
      </div>
    </td>
    <td class="sinestilos"><img src="../../img/fmstest.jpg"></td>
  </tr>
</table>

';

/*=====  End of HTML PRINT  ======*/


require_once('../../../dompdf/autoload.inc.php');
require_once ('../../../dompdf/lib/html5lib/Parser.php');
require_once ('../../../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php');
require_once ('../../../dompdf/lib/php-svg-lib/src/autoload.php');
require_once ('../../../dompdf/src/Autoloader.php');
use Dompdf\Dompdf;
/////////////////////////////// CONFIGURACION DEL DOCUMENTO /////////////////////////////
$pdf = new Dompdf();
$pdf->setPaper('letter', 'portrait');  //A4, letter  ;  portrait (posicion vertical; landscape (posición horizontal))
$titulo_documento_salida = "[11Analytics]_FMS_Test_".$salida.".pdf";
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

body{
  font-family: "Helvetica";
}
table {
  border-collapse: collapse;
  margin: 10px 0px 0px 1px;
  width: 99.8%;
}
table, td, tr{
  border:solid 1px black;
}
td{
  height: 30px;
}
.txcenter{
  text-align: center;
  text-align-last: center;
  padding: 2px 6px;
}
.txleft{
  text-align: left;
  text-align-last: left;
  padding: 2px 6px;
}
.txright{
  text-align: right;
  text-align-last: right;
  padding: 2px 6px;
  color: #ff0000;
}
.rojoblanco{
  background-color: #EE1D23;
  color: #ffffff; 
}
.cajagris{
  background-color: #3E3E3F;
  color: #ffffff;
  padding: 3px;
}
.wfooter{
  width: 85%;
}
.wdirect{
  width: 35px;
  max-width: 35px;
}
.wscore{
  width: 13%;
}
.winitial{
  width: 30%;
}
.footerseparacion{
  margin-top: 20px;
}
.sinestilos{
  border:none;
}
.datos{
  margin-left: 5px;
  line-height:2px;
}
.toptop{
  vertical-align:top;
}
.tx10{
  font-size: 10px;
}
.tx12{
  font-size: 12px;
}
.tx13{
  font-size: 13px;
}
.tx14{
  font-size: 14px;
}
.tx16{
  font-size: 16px;
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