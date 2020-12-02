<?php 
// include('../../../bd/udc_ficha_social_BD.php');

// $data='';

// $datos_informe = buscar_datosPDF( $_POST['idudc_visita_social'] );

// var_dump( $datos_informe );

// -------------------------- ARRAYS ------------------------ //
// 
include("../../../bd/seguimiento_BD.php");

function serie($serie){
  $lista_codigo_serie=[
    "99_1",
    "20_1",
    "19_1",
    "18_1",
    "17_1",
    "16_1",
    "15_1",
    "14_1",
    "13_1",
    "12_1",
    "11_1",
    "10_1",
    "9_1",
    "8_1",
    "99_2",
    "17_2",
    "15_2",
  ];
  $lista_nombre_serie=[
    "Primer",
    "Sub 20",
    "Sub 19",
    "Sub 18",
    "Sub 17",
    "Sub 16",
    "Sub 15",
    "Sub 14",
    "Sub 13",
    "Sub 12",
    "Sub 11",
    "Sub 10",
    "Sub 9",
    "Sub 8",
    "Adulta",
    "Sub 17 Adul...",
    "Sub 15 Adul...",
  ];
  $posicion="";
  for($contador=0;$contador<sizeof($lista_codigo_serie);$contador++){
    if($serie===$lista_codigo_serie[$contador]){
      $posicion=$contador;
    }
  }
  return $lista_nombre_serie[$posicion];
}

function mostrarSaludJugador($prevision){
  $texto_salud=[
      '',
      'Ninguna',
      'Fonasa A',
      'Fonasa B',
      'Fonasa C',
      'Fonasa D',
      'Fonasa C',
      'Isapre Banmedica',
      'Isapre Vida tres',
      'Isapre Colmena',
      'Isapre Consalud',
      'Isapre Cruz blanza',
      'Isapre Nueva Más Vida',
      'Capredena',
      'Dipreca',
      'Isapre Fusat',
      'Isapre Isalud',
      'PRAIS'
  ];
  return $texto_salud[(int)$prevision];
}

function strMinimo($str,$supera,$minimo){
  if( strlen( $str ) >= $supera ) {
    $str = substr($str, 0, $minimo) . '...';
  }
  return $str;
}

function fecha_dia_mes_ano($fecha){
  $fecha_explotada=explode("-",$fecha);
  return $fecha_explotada[1]."-".$fecha_explotada[2]."-".$fecha_explotada[0];
}

// print_r($_POST);
$estado_tabla_modalidad_cordinada=false;
$estado_tabla_modalidad_libre=false;
$lista_fila_tabla_modalidad_libre="";
$lista_fila_tabla_modalidad_coordinada="";
$contado_jugador=0;
if(array_key_exists("array_id_seguimiento",$_POST)){
  for($contador=0;$contador<sizeof($_POST["array_id_seguimiento"]);$contador++){
    $seguimiento=consultarSeguimientoId($_POST["array_id_seguimiento"][$contador]);
    if($seguimiento[0]["modalidad_seguimiento"]==="1"){
      $estado_tabla_modalidad_libre=true;
        $my_string =''.$seguimiento[0]["nombre"].' '.$seguimiento[0]["apellido1"].' '.$seguimiento[0]["apellido2"].'';
        if( strlen( $my_string ) >= 20 ) {
          $my_string = substr($my_string, 0, 15) . '...';
        }
        // <img src="../../foto_jugadores/'.$atencion_explodata[0].'.png" style="margin-top:5px;display:inline-block;border:1px solid #404040;border-radius: 8px;width:15px;height:15px;">
        $fila='
        <tr style="background-color:#fff; color:#606469;">
                <td scope="col" style="cursor:pointer; padding:0px;max-width:95px;">
                    <p style="display:inline;font-size: 10px;font-weight: bold;">
                      '.$my_string.'
                    </p>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:45px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.(serie(''.$seguimiento[0]["serieActual"].'_'.$seguimiento[0]["sexo"].'')).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:65px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.strMinimo(mostrarSaludJugador($seguimiento[0]["prevision"]),20,15).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:100px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.strMinimo($seguimiento[0]["diagnostico_seguimiento"],20,15).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:50px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.$seguimiento[0]["numero_caso_seguimiento"].'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:65px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.fecha_dia_mes_ano($seguimiento[0]["fecha_accidente_seguimiento"]).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:65px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.fecha_dia_mes_ano($seguimiento[0]["fecha_denuncia_seguimiento"]).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:90px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.fecha_dia_mes_ano($seguimiento[0]["fecha_plazo_maximo_30_seguimiento"]).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:90px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.(($seguimiento[0]["pendiente_ano_anterior_seguimiento"]==="1")?"Si":"No").'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:110px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.(($seguimiento[0]["entrega_documento_seguimiento"]==="1")?"Si":"No").'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:95px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.(($seguimiento[0]["continuidad_tratamiento_seguimiento"]==="1")?"Si":"No").'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:50px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.fecha_dia_mes_ano($seguimiento[0]["fecha_plazo_maximo_90_seguimiento"]).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:50px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.fecha_dia_mes_ano($seguimiento[0]["fecha_plazo_maximo_180_seguimiento"]).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:50px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.fecha_dia_mes_ano($seguimiento[0]["fecha_plazo_reembolzo_seguimiento"]).'</div>
                </td>

            </tr>
        ';
        $lista_fila_tabla_modalidad_libre.=$fila;
    }
    else{
      $estado_tabla_modalidad_cordinada=true;
      $my_string =''.$seguimiento[0]["nombre"].' '.$seguimiento[0]["apellido1"].' '.$seguimiento[0]["apellido2"].'';
        if( strlen( $my_string ) >= 20 ) {
          $my_string = substr($my_string, 0, 15) . '...';
        }
        // <img src="../../foto_jugadores/'.$atencion_explodata[0].'.png" style="margin-top:5px;display:inline-block;border:1px solid #404040;border-radius: 8px;width:15px;height:15px;">
        $fila='
        <tr style="background-color:#fff; color:#606469;">
                <td scope="col" style="cursor:pointer; padding:0px;max-width:95px;">
                    <p style="display:inline;font-size: 10px;font-weight: bold;">
                      '.$my_string.'
                    </p>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:45px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.(serie(''.$seguimiento[0]["serieActual"].'_'.$seguimiento[0]["sexo"].'')).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:65px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.strMinimo(mostrarSaludJugador($seguimiento[0]["prevision"]),20,15).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:100px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.strMinimo($seguimiento[0]["diagnostico_seguimiento"],50,45).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:50px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.$seguimiento[0]["numero_caso_seguimiento"].'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:65px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.fecha_dia_mes_ano($seguimiento[0]["fecha_denuncia_seguimiento"]).'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:65px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.fecha_dia_mes_ano($seguimiento[0]["fecha_atencion_seguimiento"]).'</div>
                </td>

                <td scope="col" style="cursor:pointer; padding:0px;width:100px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.(($seguimiento[0]["centro_atencion_seguimiento"]!="null")?$seguimiento[0]["centro_atencion_seguimiento"]:"-").'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:120px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.(($seguimiento[0]["centro_derivacion_seguimiento"]!="null")?$seguimiento[0]["centro_derivacion_seguimiento"]:"-").'</div>
                </td>
                <td scope="col" style="cursor:pointer; padding:0px;width:120px;">
                  <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">'.(($seguimiento[0]["medico_tratante_seguimiento"]!="null")?$seguimiento[0]["medico_tratante_seguimiento"]:"-").'</div>
                </td>

            </tr>
        ';
        $lista_fila_tabla_modalidad_coordinada.=$fila;

    }
  }
}




$tabla_seguimiento_modalidad_libre_eleccion="";
if($estado_tabla_modalidad_libre){
  $tabla_seguimiento_modalidad_libre_eleccion='
  <div style="width:100%;height:50px;display:block;"></div>
  <div style="width:100%;height:25px;left;font-size: 13px;display:block;box-sizing:borde-box;background:#4e4e4e;color:#fff;padding-left:10px;">
    Modalidad libre elección
  </div>
  <table style= width:50%;margin-left:5px" id="tabla_ver_informes">
      <thead>
          <tr style="background-color:#fff; color:white;">
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:95px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">JUGADOR</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:45px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">SERIE</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:65px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">PREVISION</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:100px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">DIAGNOSTICO</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:50px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">N° CASO</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:65px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">F.ACCIDENTE</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:65px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">F.DENUNCIA</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:90px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">Plazo máx 30 días</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:90px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">Pendiente año ant.</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:110px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">Entrega documentación</div>
              </th>

              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:95px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">Cont. de tratamiento</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:50px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">90 días</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:50px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">180 días</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:50px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">Reembolso</div>
              </th>
          </tr>
      </thead>
      <tbody id="contenido_tabla">
        '.$lista_fila_tabla_modalidad_libre.'
      </tbody>
  </table>
  ';
}
else{
  /*
  <div style="width:100%;height:30px;display:block;"></span></div>
  <div style="font-size:12px;color:#606469;display:block;margin-left: 270px;margin-top: 20px;background-color: transparent;  width: 100%;">
    no hay registro de modalidad libre elección
  </div>
  */
  $tabla_seguimiento_modalidad_libre_eleccion='';
}


$tabla_seguimiento_modalidad_coodinada="";
if($estado_tabla_modalidad_cordinada){
  $tabla_seguimiento_modalidad_coodinada='
  <div style="width:100%;height:50px;display:block;"></div>
  <div style="width:100%;height:25px;left;font-size: 13px;display:block;box-sizing:borde-box;background:#4e4e4e;color:#fff;padding-left:10px;">
    Modalidad coordinada
  </div>
  <table style= width:50%;margin-left:5px" id="tabla_ver_informes">
      <thead>
          <tr style="background-color:#fff; color:white;">
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:95px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">JUGADOR</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:45px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">SERIE</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:65px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">PREVISION</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:220px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">DIAGNOSTICO</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:50px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">N° CASO</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:65px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">F.DENUNCIA</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:65px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">F.ATENCION</div>
              </th>

              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:100px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">CENTRO ATENCIÓN</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:120px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">CENTRO DE DERIVACIÓN</div>
              </th>
              <th scope="col" style="/*background:blue*/;font-size:14px;color:#606469;cursor:pointer; padding:0px;width:120px;">
                <div class="tip-top" data-original-title="Fecha atención" style="text-align: left;font-size: 10px;">MÉDICO TRATANTE</div>
              </th>

          </tr>
      </thead>
      <tbody id="contenido_tabla">
        '.$lista_fila_tabla_modalidad_coordinada.'
      </tbody>
  </table>
  ';
}
else{
  /*
  <div style="width:100%;height:30px;display:block;"></span></div>
  <div style="font-size:12px;color:#606469;display:block;margin-left: 270px;margin-top: 20px;background-color: transparent;  width: 100%;">
    no hay registro de modalidad coordinada
  
  */
  $tabla_seguimiento_modalidad_coodinada='';
}




$data.= '
  <!-- ================================ Inicio del cuerpo ================================ -->
  <main>

    <div style="width: 100%; background-color: #0b1972; height: 50px; padding: 5px 5px;">

        <div style="float: left; margin-left: 9px; margin-top: 6px;padding-top:10px;">
            <p style="text-transform: uppercase; color: white; font-size: 11px; font-weight: bold;">SANTIAGO <span style="font-weight: normal">WANDERERS</span></p>
            
        </div>

        <div style="float: right; position: relative; top: 3px; margin-right: 2px;">
            <div style="display: inline-block; margin-top: 3px;">
                <img src="../../../config/logo_equipo.png" style="position: relative; top: 0px; height: 35px; margin-right: 10px;">
            </div>
            <!--
            <div style="display: inline-block; margin-top: 4px;">
                <p class="text-cabecera" style="position: relative; top: 4px;">Fútbol</p>
                <p class="text-cabecera" style="position: relative; top: -2px;">Formativo</p>
                <p style="position: relative; top: -5px; color: #cacaca; text-transform: uppercase; letter-spacing: 0px; font-stretch: condensed; transform: scaleY(1.3); word-spacing: 2px; font-size: 5.5px;">Club Universidad de Chile</p>

            </div>  
            -->    
        </div>

    </div>

    <!-- ================================ Inicio del class="txCenter" ================================ -->
    <div class="txCenter div-body" style="box-sizing: border-box; width: 95%; margin: auto; margin-top: 10px;">

        <div style="margin-top: 0px; max-width: 625px; margin: auto; width: 625px; /*background-color: orange;*/">

            <p  style="text-align: center; margin-top: 2px; margin-bottom: 45px; font-size: 14px; color: #4e4e4e;" class="">'.$_POST["fecha_completa"].'</p>
            
            <!-- VERSIÓN QUE FUNCIONA EN LOCAL -->
            
            <img src="../../../config/logo_equipo.png" style="width: 80px; height: 100px; background-color: white;">
            

            <!-- VERSIÓN QUE FUNCIONA EN EL SERVIDOR -->
            <!-- <img src="../../../config/logo_equipo.png" style="width: 80px; height: 100px;background-color: white; margin-top: -17px; margin-bottom: 20px;"> -->      

            
        </div>
      <!--
      <center>
        <div style="background-color: transparent; margin-top: 25px; width: 100%;">
            <div class="left-div-title"></div>
            <div class="middle-div-title">
                <p style="">JUGADORES ATENDIDOS DERIVADOS AL SEGURO MEDICO</p>
            </div>
            <div class="right-div-title"></div>
        </div> 
      </center>
      -->
    </div>
    <!-- ================================ Fin del class="txCenter" ================================ -->

    '.$tabla_seguimiento_modalidad_coodinada.'
    '.$tabla_seguimiento_modalidad_libre_eleccion.'













<!--
<center style="margin-top: 50px;">
            <div style="background-color: transparent;  width: 100%;">
                <div class="left-div-title" style="margin-left:15px;"></div>
                <div class="middle-div-title" style="width: 47%;">
                    <p style="">JUGADORES QUE NO REQUIEREN DERIVACIÓN AL SEGURO</p>
                </div>
                <div class="right-div-title" style="margin-right:15px;"></div>
            </div> 
</center>
<div style="width:100%;height:10px;display:block;"></span></div>
tabla_nuevo_Y_control_no_seguro
-->

  
  </main>

  <!-- ================================ Inicio del footer ================================ -->
  <footer >
    <div style="background-color: #0b1972;display:block;height:5px;width:95%;margin-left:2.5%;margin-right:2.5%"></div>
    <span style="font-size:12px;color:#606469;display:block;margin-top:2px;margin-left:25px;">SANTIAGO WANDERERS</span>
  </footer>
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
$pdf->setPaper('letter', 'landscape');  //A4, letter  ;  portrait (posicion vertical; landscape (posición horizontal))
$titulo_documento_salida = "[11Analytics]_ODR_seguimiento_lista.pdf";
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

@font-face {
    font-family: Candara Normal;
    font-style: normal;
    font-weight: bold;
    src: url("../fonts/CANDARAB.ttf") format("truetype");
}

body{
    font-family:"Candara Normal";
    margin-bottom: 1cm;  
    margin: 0;    
}

* {
    margin:0;
    padding:0
}

@page { margin-top: 10px; margin-bottom: 50px;}

header {
  position: fixed;
  left: 0px;
  top: -90px;
  right: 0px;
  height: 450px;
  text-align:
  center;
}

#tabla_ver_informes_todos tbody tr {
  text-align: center;
}

#tabla_ver_informes_todos thead tr {
  text-align: center;
} 

footer {
  position: fixed; 
  bottom: -20px; 
  left: 0px; 
  right: 0px;
  height: 50px; 
}

.div-body table {
    font-size: 10px!important;
}

.left-div-title {
    height: 2px; border-bottom: solid 2px #c1c1c1; 
    width: 25%; 
    float: left;
}

.right-div-title {
    height: 2px; 
    border-bottom: solid 2px #c1c1c1; 
    width: 25%; 
    float: right;
}

.middle-div-title {
    width: 50%; 
    float:left;
}

.middle-div-title p {
    text-align: center; 
    text-transform: uppercase;
    font-size: 11px; 
    position: relative; 
    top: -10px;
    color: #656565;
}


.bottom-space-modal p {
    font-size: 10px;
}

table.bottom-space-modal tbody tr td {
    text-align: left;
    /*background-color: red;*/
}

.table-tr-separate { 
    border-collapse:separate; 
    border-spacing:0 15px; 
} 

.tabla-item {
    clear: both;
    margin-bottom: 30px;
    margin-bottom: 30px;
}

.page_break {page-break-before:always; } 


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


.text-cabecera {
    font-family: Candara Bold;
    color: #cacaca;
    font-size: 11px;
}

.valoracion-modal {
    width: 150px;
    height: 80px;
    margin: auto;
    border-radius: 11px;
    display: inline-block;
    font-weight: bold;
    padding: 5px;
    color: white;
    text-transform: uppercase;
    text-align: center;
}

.valoracion-modal span {
    display: block;
    position: relative;
    top: 25px;
    font-size: 12px;    
}

.big-text-modal {
    border: 1px solid #191818;
    width: 100%;    
    height: 80px;
    color: black;
    text-align: left;
    font-size: 10px;
    padding: 4px;
}

.span-valoracion {
    font-weight: bold;
    background-color: grey;
    border-radius: 5px;
    color: white;
    text-transform: uppercase;   
}

.valoracion-baja {
    color: black;
    background-color: #4caf50;
}

.valoracion-media {
    color: black;
    background-color: #ffc107;
}

.valoracion-alta {
    color: white;
    background-color: #f44336;
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