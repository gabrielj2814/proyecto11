<?php 
//include('../../../bd/escuela_BD.php');
require_once('../../../dompdf/autoload.inc.php');
require_once ('../../../dompdf/lib/html5lib/Parser.php');
require_once ('../../../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php');
require_once ('../../../dompdf/lib/php-svg-lib/src/autoload.php');
require_once ('../../../dompdf/src/Autoloader.php');
use Dompdf\Dompdf;
/////////////////////////////// CONFIGURACION DEL DOCUMENTO /////////////////////////////
$pdf = new Dompdf();
$pdf->setPaper('letter', 'portrait');  //A4, letter  ;  portrait (posicion vertical)
$titulo_documento_salida = "[11Analytics]_Ficha_personal.pdf";
/////////////////////////////////////////////////////////////////////////////////////////

$html='<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
@font-face {
  font-family: "Helvetica";
  font-weight: normal;
  font-style: normal;
  font-variant: normal;
}
</style>
<title>Title</title>
</head>
<body>
';

$html.=$_POST['codigo_html'];
//$html.=$data;

$html.='
</body>
</html>
';


$pdf->loadHtml($html);


//////////////////////////////////// EXPORTAR EL DOCUMENTO //////////////////////////////
$pdf->render();

$pdf->stream($titulo_documento_salida);

/*
$output = $pdf->output();
file_put_contents("../../reportes_pdf/".$titulo_documento_salida, $output);
*/
echo $titulo_documento_salida;

?>