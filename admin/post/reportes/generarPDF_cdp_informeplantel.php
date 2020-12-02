<?php 
include('../../../bd/cdp_informe_plantel_BD.php');

$data='';

$datos_informe = buscar_datosPDF( $_POST['idcdp_informe_plantel'] );
$titulo_serie = $_POST["titulo_serie"];
$nombre_tecnico = $_POST["nombre_tecnico"];
$jugador = '';


$fecha_cdp_informeplantel = $datos_informe[0]['fecha_cdp_informeplantel'];
$titulo_cdp_informeplantel = $datos_informe[0]['titulo_cdp_informeplantel'];
$informe_cdp_informeplantel = $datos_informe[0]['informe_cdp_informeplantel'];
  
  
$fecha_software = $datos_informe[0]['fecha_software'];

$fecha_software_date = substr($fecha_software, 0, 10);
$fecha_software_time = substr($fecha_software, 11, 19);

$data.= '

  <header style="display: block; text-align: -webkit-center;">
    <div class="txCenter wab">
      <div class="totalpaginas">
        <div class="txCenter" style="box-sizing: border-box;">
          
          <img class="displaylb" src="../../img/cdp.png" class="imagen-jugador" style="width: 100px; height: 100px; float: left;">

          <img class="displaylb" src="../../img/user.png" style="margin-top:-3px; width: 100px; height: 100px; border-radius: 50px; border: solid #059c4c 4px; float: right;"/>

          <br>

          <div style="/*background-color: green;*/ position: relative; left: 0px;">
            <span style="/*background-color:lightblue;*/ font-size:18px; font-weight:bold;">ÁREA PSICOLÓGICA</span>
            <br/><br/>
            <span style="/*background-color:orange;*/ font-size:20px; font-weight:bold;">INFORME PLANTEL</span>                       
          </div>      

        </div>    
        <div style="background-color:black; height:10px; margin-top: 30px;"></div>
      </div>
    </div>  
  </header>


  <!-- ================================ Inicio del cuerpo ================================ -->
<main>
  <div class="txCenter">


  <br>

    <center>
      <div class="txCenter wab" style="height: 20px;">
        <div class="totalpaginas">
          <table class="tabla-datos-principales-derecha">
            <tr>
              <td class="titulo-datos-principales">Fecha:</td>
              <td class="datos-principales">'.$fecha_cdp_informeplantel.'</td>
            </tr>
          </table>   
          <table class="tabla-datos-principales-izquierda">
            <tr>
              <td class="titulo-datos-principales">Serie:</td>
              <td class="datos-principales">'.$titulo_serie.'</td>
            </tr>
          </table>
          <table class="tabla-datos-principales-izquierda">
            <tr>
              <td class="titulo-datos-principales" style="width: 50px;">Entrenador:</td>
              <td class="datos-principales">'.$nombre_tecnico.'</td>
            </tr>
          </table>                       
        </div>
      </div>
    </center>     

  <br>

    <center>
      <div class="txCenter wab" style="margin-top:10px;">
        <div class="totalpaginas">
          <div class="th-textarea">
            <h4>
              TÍTULO
            </h4>
          </div>
          <div class="textarea-social txCenter">
            <p class="txCenter" style="margin: 0; font-size:16px;">'.$titulo_cdp_informeplantel.'</p>
          </div>
        </div>
      </div>
    </center> 
    
  <br>

    <center>
      <div class="txCenter wab">
        <div class="totalpaginas">
          <div class="th-textarea">
            <h4>
              INFORME PLANTEL
            </h4>
          </div>
          <div class="textarea-social">'.$informe_cdp_informeplantel.'</div>
        </div>
      </div>
    </center>       

  <br>

  </div>
  <footer>
    <div style="background-color:black; height:5px;"></div>
    <p style="text-align: center; font-weight: bold; margin-top: 10px;">
      CDP '.date("Y").' | Informe de Plantel ingresado el '.$fecha_software_date.' a las '.$fecha_software_time.'.
    <p>
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
$titulo_documento_salida = "[11Analytics]_cdp_informe_plantel.pdf";
// $titulo_documento_salida = "[11Analytics]_tratamiento_lesiones_".$salida.".pdf";
/////////////////////////////////////////////////////////////////////////////////////////

$html='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>

header {
}

footer {
  position: fixed; 
  bottom: -30px; 
  left: 0px; 
  right: 0px;
  height: 50px; 
}

@font-face {
  font-family: "Helvetica";
}

.page_break {page-break-before:always; } 

body{
  font-family: "Times New Roman";
  margin-bottom: 1cm;  
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
  border: 1px solid black;
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
  width: 50px;  
}

.datos-principales {
  margin-left: 10px;
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