<?php 
include('../../../bd/socios_BD.php');
$ano = $_POST['anual'];
$ides = $_POST['ides'];
$respuesta=ver_pagos_pdf($ides,$ano);

$data='<br><h5>Año: '.$ano.'</h5>';

$data.= '
<h5>Nombre:  '.$respuesta[0]['nombre_socios'].' '.$respuesta[0]['apellido_socios'].'</h5>
';

for ($i=0; $i < count($respuesta[0]['pagos']) ; $i++) { 
  $data.= '
  <table>
    <tr>
      <td><h6>Mes:  '.$respuesta[0]['pagos'][$i]['mes_pagos'].'</h6></td>
      <td><h6>Valor: $'.$respuesta[0]['pagos'][$i]['valor_pagos'].' </h6></td>
      <td><h6>Fecha de Pago:  '.$respuesta[0]['pagos'][$i]['fecha_pagos'].'</h6></td>
    </tr>
  </table>
  ';
}

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
$titulo_documento_salida = "[11Analytics]_Pago_Socio.pdf";
/////////////////////////////////////////////////////////////////////////////////////////

$html='<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">


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