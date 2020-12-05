<?php 
// include('../../../bd/udc_ficha_social_BD.php');

// $data='';

// $datos_informe = buscar_datosPDF( $_POST['idudc_visita_social'] );

// var_dump( $datos_informe );

// -------------------------- ARRAYS ------------------------ //
// 
include("../../../bd/atencion_diaria_BD.php");
/*


<div style="box-sizing: border-box;width:95%;height:100px;margin-bottom:15px;margin-left:auto;margin-right:auto;border:0;">
<div style="box-sizing: border-box;width:100%;height:5px;border:0;">
<div style="box-sizing: border-box;display:inline-block;float:left;width:17%;height:15px;font-size:12px;line-height:10px;">
  '.$my_string.'
</div>
<div style="box-sizing: border-box;display:inline-block;float:left;width:13%;height:15px;font-size:12px;line-height:10px;">
    Nuevo Incidente
</div>
<div style="box-sizing: border-box;display:inline-block;float:left;width:30%;height:15px;font-size:12px;line-height:10px;">
    '.strMinimo($atencion_diaria["datos"][0]["diagnostico_atencion_diaria"],30,27).'
</div>
<div style="box-sizing: border-box;display:inline-block;float:left;width:10%;height:15px;font-size:12px;line-height:10px;">
  '.(($atencion_diaria["datos"][0]["derivado_seguro_atencion_diaria"]==="1")?"Si":"No").'
</div>
<div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:15px;font-size:12px;line-height:10px;">
    '.strMinimo(concatenarListasImplode(encontrarTratamientos($atencion_diaria["datos"][0]["lista_tratamiento"],$tratamientos["datos"])),25,20).'
</div>
<div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:15px;font-size:8.5px;line-height:10px;">
  '.odtenerIndicaciones($atencion_diaria["datos"][0]).'
</div>
</div>
<div style="clear:left;box-sizing: border-box;width:100%;height:auto;font-size:12px;">
<span style="font-weight: bold">Observación Kinesiologo</span>: '.(($atencion_diaria["datos"][0]["observacion_kinesiologo"]!=null)?$atencion_diaria["datos"][0]["observacion_kinesiologo"]:"sin obsevación").'
</div>
</div>

*/


// print_r($_POST);
$mensaje_sin_registros='
    <div style="box-sizing: border-box;font-size:12px;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;text-align:center;font-weight: normal;color:#4e4e4e;border:0;">
      No se registran jugadores atendidos esta semana
    </div>
';
$contadore_jugadores=0;
$fila_tabla_serie_20="";
$fila_tabla_serie_17="";
$fila_tabla_serie_16="";
$fila_tabla_serie_15="";
$fila_tabla_serie_14="";
$fila_tabla_serie_13="";
$fila_tabla_serie_12="";
$fila_tabla_serie_11="";
if(array_key_exists("array_id_atencion_diaria",$_POST)){
    $tratamientos=consultarTratamientos();
    for($contador=0;$contador<sizeof($_POST["array_id_atencion_diaria"]);$contador++){
      $id=$_POST["array_id_atencion_diaria"][$contador];
      $atencion_diaria=consultarAtencionPdf($id);
      $my_string =''.$atencion_diaria["datos"][0]["nombre"].' '.$atencion_diaria["datos"][0]["apellido1"].' '.$atencion_diaria["datos"][0]["apellido2"].'';
      if( strlen( $my_string ) >= 20 ) {
        $my_string = substr($my_string, 0, 15) . '...';
      }
      $fila="";
      if($atencion_diaria["datos"][0]["tipo_atencion_atencion_diaria"]==="1"){
        $fila='
            <div style="box-sizing: border-box;width:95%;height:100px;margin-bottom:15px;margin-left:auto;margin-right:auto;/*background-color:lime;*/border:0;">
                <div style="box-sizing: border-box;width:100%;height:25px;/*background-color:blue;*/border:0;">
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:17%;height:25px;/*background:red;*/font-size:12px;">
                      <img style="display:inline-block;height:25px;width:20%;border:1px solid #555;border-radius:13px;" src="../../foto_jugadores/'.$atencion_diaria["datos"][0]["idfichaJugador"].'.png">
                      <div style="display:inline-block;height:25px;width:80%;line-height:14px;">'.$my_string.'</div>
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:13%;height:25px;/*background:grey;*/font-size:12px;line-height:10px;">
                        Nuevo Incidente
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:30%;height:25px;/*background:purple;*/font-size:12px;line-height:10px;">
                        '.strMinimo($atencion_diaria["datos"][0]["diagnostico_atencion_diaria"],30,27).'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:10%;height:25px;/*background:lime;*/font-size:12px;line-height:10px;">
                      '.(($atencion_diaria["datos"][0]["derivado_seguro_atencion_diaria"]==="1")?"Si":"No").'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:25px;/*background:#fff;*/font-size:12px;line-height:10px;">
                        '.strMinimo(concatenarListasImplode(encontrarTratamientos($atencion_diaria["datos"][0]["lista_tratamiento"],$tratamientos["datos"])),25,20).'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:25px;/*background:#0b1972;*/font-size:8.5px;line-height:10px;">
                      '.odtenerIndicaciones($atencion_diaria["datos"][0]).'
                    </div>
                </div>
                <div style="clear:left;box-sizing: border-box;width:100%;height:auto;/*background:#0b1972;*/font-size:12px;">
                    <span style="font-weight: bold">Observación Kinesiologo</span>: '.(($atencion_diaria["datos"][0]["observacion_kinesiologo"]!=null)?$atencion_diaria["datos"][0]["observacion_kinesiologo"]:"sin obsevación").'
                </div>
            </div>
        ';
        $contadore_jugadores++;
      }
      elseif($atencion_diaria["datos"][0]["tipo_atencion_atencion_diaria"]==="2"){
        $fila='
            <div style="box-sizing: border-box;width:95%;height:100px;margin-bottom:15px;margin-left:auto;margin-right:auto;/*background-color:lime;*/border:0;">
                <div style="box-sizing: border-box;width:100%;height:25px;/*background-color:blue;*/border:0;">
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:17%;height:25px;/*background:red;*/font-size:12px;">
                      <img style="display:inline-block;height:25px;width:20%;border:1px solid #555;border-radius:13px;" src="../../foto_jugadores/'.$atencion_diaria["datos"][0]["idfichaJugador"].'.png">
                      <div style="display:inline-block;height:25px;width:80%;line-height:14px;">'.$my_string.'</div>
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:13%;height:25px;/*background:grey;*/font-size:12px;line-height:10px;">
                        Control
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:30%;height:25px;/*background:purple;*/font-size:12px;line-height:10px;">
                        '.strMinimo($atencion_diaria["datos"][0]["informe_medico"][0]["diagnostico"],30,27).'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:10%;height:25px;/*background:lime;*/font-size:12px;line-height:10px;">
                      '.(($atencion_diaria["datos"][0]["informe_medico"][0]["agregado_seguro_medico"]==="1")?"Si":"No").'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:25px;/*background:#fff;*/font-size:12px;line-height:10px;">
                        '.strMinimo(concatenarListasImplode(encontrarTratamientos($atencion_diaria["datos"][0]["lista_tratamiento"],$tratamientos["datos"])),25,20).'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:25px;/*background:#0b1972;*/font-size:8.5px;line-height:10px;">
                      '.odtenerIndicaciones($atencion_diaria["datos"][0]).'
                    </div>
                </div>
                <div style="clear:left;box-sizing: border-box;width:100%;height:auto;/*background:#0b1972;*/font-size:12px;">
                    <span style="font-weight: bold">Observación General</span>: '.(($atencion_diaria["datos"][0]["observacion_general"]!=null)?$atencion_diaria["datos"][0]["observacion_general"]:"sin obsevación").'
                </div>
            </div>
        ';
        $contadore_jugadores++;
      }
      elseif($atencion_diaria["datos"][0]["tipo_atencion_atencion_diaria"]==="3"){
        $tratamiento_control=consultarTratamientoControl($atencion_diaria["datos"][0]["idinforme_medico"]);
        //  '.strMinimo(concatenarListasImplode(encontrarTratamientos2(obtenerTratamientosControl($tratamiento_control["lista_tratamientos"]),$tratamientos["datos"])),25,20).'
        var_export($tratamiento_control["lista_tratamientos"]);
        $fila='
            <div style="box-sizing: border-box;width:95%;height:100px;margin-bottom:15px;margin-left:auto;margin-right:auto;/*background-color:lime;*/border:0;">
                <div style="box-sizing: border-box;width:100%;height:5px;/*background-color:blue;*/border:0;">
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:17%;height:25px;/*background:red;*/font-size:12px;">
                      <img style="display:inline-block;height:25px;width:20%;border:1px solid #555;border-radius:13px;" src="../../foto_jugadores/'.$atencion_diaria["datos"][0]["idfichaJugador"].'.png">
                      <div style="display:inline-block;height:25px;width:80%;line-height:14px;">'.$my_string.'</div>
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:13%;height:25px;/*background:grey;*/font-size:12px;line-height:10px;">
                        Medica
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:30%;height:25px;/*background:purple;*/font-size:12px;line-height:10px;">
                        '.strMinimo($atencion_diaria["datos"][0]["informe_medico"][0]["diagnostico"],30,27).'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:10%;height:25px;/*background:lime;*/font-size:12px;line-height:10px;">
                      '.(($atencion_diaria["datos"][0]["informe_medico"][0]["agregado_seguro_medico"]==="1")?"Si":"No").'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:25px;/*background:#fff;*/font-size:12px;line-height:10px;">
                    '.strMinimo(concatenarListasImplode(encontrarTratamientos2(obtenerTratamientosControl($tratamiento_control["lista_tratamientos"]),$tratamientos["datos"])),25,20).'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:25px;/*background:#0b1972;*/font-size:8.5px;line-height:10px;">
                      '.odtenerIndicaciones($atencion_diaria["datos"][0]).'
                    </div>
                </div>
                <div style="clear:left;box-sizing: border-box;width:100%;height:auto;/*background:#0b1972;*/font-size:12px;">
                    <span style="font-weight: bold">Recomendaciones Médicas</span>: '.(($atencion_diaria["datos"][0]["observacion_medica"]!=null)?$atencion_diaria["datos"][0]["observacion_medica"]:"sin obsevación").'
                </div>
            </div>
        ';
        
      }
      elseif($atencion_diaria["datos"][0]["tipo_atencion_atencion_diaria"]==="4"){
        $tratamiento_control=consultarTratamientoControl($atencion_diaria["datos"][0]["idinforme_medico"]);
        //  '.strMinimo(concatenarListasImplode(encontrarTratamientos2(obtenerTratamientosControl($tratamiento_control["lista_tratamientos"]),$tratamientos["datos"])),25,20).'
        var_export($tratamiento_control["lista_tratamientos"]);
        $fila='
            <div style="box-sizing: border-box;width:95%;height:100px;margin-bottom:15px;margin-left:auto;margin-right:auto;/*background-color:lime;*/border:0;">
                <div style="box-sizing: border-box;width:100%;height:25px;/*background-color:blue;*/border:0;">
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:17%;height:25px;/*background:red;*/font-size:12px;">
                      <img style="display:inline-block;height:25px;width:20%;border:1px solid #555;border-radius:13px;" src="../../foto_jugadores/'.$atencion_diaria["datos"][0]["idfichaJugador"].'.png">
                      <div style="display:inline-block;height:25px;width:80%;line-height:14px;">'.$my_string.'</div>
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:13%;height:25px;/*background:grey;*/font-size:12px;line-height:10px;">
                        Deportiva
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:30%;height:25px;/*background:purple;*/font-size:12px;line-height:10px;">
                        '.strMinimo($atencion_diaria["datos"][0]["informe_medico"][0]["diagnostico"],30,27).'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:10%;height:25px;/*background:lime;*/font-size:12px;line-height:10px;">
                      '.(($atencion_diaria["datos"][0]["informe_medico"][0]["agregado_seguro_medico"]==="1")?"Si":"No").'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:25px;/*background:#fff;*/font-size:12px;line-height:10px;">
                    '.strMinimo(concatenarListasImplode(encontrarTratamientos2(obtenerTratamientosControl($tratamiento_control["lista_tratamientos"]),$tratamientos["datos"])),25,20).'
                    </div>
                    <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:25px;/*background:#0b1972;*/font-size:8.5px;line-height:10px;">
                      '.odtenerIndicaciones($atencion_diaria["datos"][0]).'
                    </div>
                </div>
                <div style="clear:left;box-sizing: border-box;width:100%;height:auto;/*background:#0b1972;*/font-size:12px;">
                    <span style="font-weight: bold">Recomendaciones Readaptadores</span>: '.(($atencion_diaria["datos"][0]["observacion_readaptor"]!=null)?$atencion_diaria["datos"][0]["observacion_readaptor"]:"sin obsevación").'
                </div>
            </div>
            
        ';
        
      }
      switch($atencion_diaria["datos"][0]["serieActual"]){
        case "20":$fila_tabla_serie_20.=$fila;break;
        case "17":$fila_tabla_serie_17.=$fila;break;
        case "16":$fila_tabla_serie_16.=$fila;break;
        case "15":$fila_tabla_serie_15.=$fila;break;
        case "14":$fila_tabla_serie_14.=$fila;break;
        case "13":$fila_tabla_serie_13.=$fila;break;
        case "12":$fila_tabla_serie_12.=$fila;break;
        case "11":$fila_tabla_serie_11.=$fila;break;
      }
      
    }



}
// else{
//   $fila_tabla_serie_20=$mensaje_sin_registros;
//   $fila_tabla_serie_17=$mensaje_sin_registros;
//   $fila_tabla_serie_16=$mensaje_sin_registros;
// }









function strMinimo($str,$supera,$minimo){
  if( strlen( $str ) >= $supera ) {
    $str = substr($str, 0, $minimo) . '...';
  }
  return $str;
}


function encontrarTratamientos($tratamiento_consulta,$lista_tratamientos){
  $lista_tratamientos_encontrados=[];
  for($contador=0;$contador<sizeof($tratamiento_consulta);$contador++){
    for($contador2=0;$contador2<sizeof($lista_tratamientos);$contador2++){
      $tratamiento=$lista_tratamientos[$contador2];
      if($tratamiento_consulta[$contador]["nombre_tratamiento_atencion_diaria"]===$tratamiento["idtratamiento_aplicado"]){
        $lista_tratamientos_encontrados[]=$tratamiento["nombre_tratamiento_aplicado"];
      }
    }
  }
  return $lista_tratamientos_encontrados;
}

function encontrarTratamientos2($tratamiento_consulta,$lista_tratamientos){
  $lista_tratamientos_encontrados=[];
  for($contador=0;$contador<sizeof($tratamiento_consulta);$contador++){
    for($contador2=0;$contador2<sizeof($lista_tratamientos);$contador2++){
      $tratamiento=$lista_tratamientos[$contador2];
      if($tratamiento_consulta[$contador]===$tratamiento["idtratamiento_aplicado"]){
        $lista_tratamientos_encontrados[]=$tratamiento["nombre_tratamiento_aplicado"];
      }
    }
  }
  return $lista_tratamientos_encontrados;
}

function concatenarListasImplode($lista){
  $str="";
  if(sizeof($lista)>1){
    $str=implode(", ",$lista);
  }
  elseif(sizeof($lista)===1){
    $str=$lista[0];
  }
  elseif(sizeof($lista)===0){
    $str="-";
  }
  return $str;
}

function odtenerIndicaciones($atencion){
  $str="";
  $lista_sesion=[
    "Reposo Deportivo",
    "Entrenamiento diferenciado",
    "Alta médica solo para entrenar",
    "Kinesiología",
    "Reaptador",
    "Regenerativo",
    "Reposo total",
    "Derivado a relizar examenes",
    "Derivado a urgencias",
    "Alta médica para partidos y entrenamientos",
    "Citado a Médico",
    "Citado a Médico para Alta",
    "Reintegro deportivo progresivo"
  ];
  $lista_recomendacion_alta=[
    "Continuar el trabajo con readaptacion",
    "Reevaluación Fisica",
    "Debe realizar trabajo diferenciado",
    "Derivado al trabajo con readaptacion",
    "Kinesiologia completa",
    "Reevaluación médica",
  ];

  if($atencion["tipo_atencion_atencion_diaria"]==="1" || $atencion["tipo_atencion_atencion_diaria"]==="2"){
    if($atencion["recomendacion_sesion_actual_atencion_diaria"]==="1" || $atencion["recomendacion_sesion_actual_atencion_diaria"]==="7"){
      $numero=(int)$atencion["recomendacion_sesion_actual_atencion_diaria"];
      $str=$lista_sesion[$numero-1].", ".fecha_dia_mes_ano($atencion["fecha_recomendacion_sesion_actual_atencion_diaria"]);
    }
    else{
      $numero=(int)$atencion["recomendacion_sesion_actual_atencion_diaria"];
      $str=$lista_sesion[$numero-1];
    }
  }
  elseif ($atencion["tipo_atencion_atencion_diaria"]==="3" || $atencion["tipo_atencion_atencion_diaria"]==="4") {
    $lista_recomendaciones=[];
    for($contador=0;$contador<sizeof($atencion["lista_recomendacion"]);$contador++){
      $numero=(int)$atencion["lista_recomendacion"][$contador]["recomendacion_alta_atencion_diaria"];
      $lista_recomendaciones[]=$lista_recomendacion_alta[$numero-1];
    }
    $str=strMinimo(concatenarListasImplode($lista_recomendaciones),25,20);
  }
  return $str;
}

function fecha_dia_mes_ano($fecha){
  $fecha_explotada=explode("-",$fecha);
  return $fecha_explotada[1]."-".$fecha_explotada[2]."-".$fecha_explotada[0];
}


function obtenerTratamientosControl($tratamientos){
  $lista_id_tratamiento=[];
  for($contador=0;$contador<sizeof($tratamientos);$contador++){
    // array_push($lista_id_tratamiento,$tratamientos[$contador]["nombre_tratamiento_atencion_diaria"]);
    for($contador2=0;$contador2<sizeof($tratamientos[$contador]);$contador2++){
      array_push($lista_id_tratamiento,$tratamientos[$contador][$contador2]["nombre_tratamiento_atencion_diaria"]);
    }
  }
  return $lista_id_tratamiento;
}































$emcabezado_tabla='
<div style="box-sizing: border-box;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;background-color:blue;border:0;color:#4e4e4e;">
        <div style="box-sizing: border-box;display:inline-block;float:left;width:17%;height:15px;background:#fff;font-weight: bold;font-size:12px;line-height:10px;">
          JUGADOR
        </div>
        <div style="box-sizing: border-box;display:inline-block;float:left;width:13%;height:15px;background:#fff;font-weight: bold;font-size:12px;line-height:10px;">
          TIPO ATENCIÓN      
        </div>
        <div style="box-sizing: border-box;display:inline-block;float:left;width:30%;height:15px;background:#fff;font-weight: bold;font-size:12px;line-height:10px;">
          DIAGNÓSTICO                        
        </div>
        <div style="box-sizing: border-box;display:inline-block;float:left;width:10%;height:15px;background:#fff;font-weight: bold;font-size:12px;line-height:10px;">
          A SEGURO
        </div>
        <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:15px;background:#fff;font-weight: bold;font-size:12px;line-height:10px;">
          TRATAMIENTO           
        </div>
        <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:15px;background:#fff;font-weight: bold;font-size:12px;line-height:10px;">
          INDICACIONES
        </div>
  </div>

';

$platilla_tabla_datos='
<div style="box-sizing: border-box;width:95%;height:100px;margin-bottom:15px;margin-left:auto;margin-right:auto;background-color:lime;border:0;">
        <div style="box-sizing: border-box;width:100%;height:5px;background-color:blue;border:0;">
            <div style="box-sizing: border-box;display:inline-block;float:left;width:17%;height:15px;background:red;font-size:12px;line-height:10px;">
              
            </div>
            <div style="box-sizing: border-box;display:inline-block;float:left;width:13%;height:15px;background:grey;font-size:12px;line-height:10px;">
                    
            </div>
            <div style="box-sizing: border-box;display:inline-block;float:left;width:30%;height:15px;background:purple;font-size:12px;line-height:10px;">
                                      
            </div>
            <div style="box-sizing: border-box;display:inline-block;float:left;width:10%;height:15px;background:lime;font-size:12px;line-height:10px;">
              
            </div>
            <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:15px;background:#fff;font-size:12px;line-height:10px;">
                  
            </div>
            <div style="box-sizing: border-box;display:inline-block;float:left;width:15%;height:15px;background:#0b1972;font-size:12px;line-height:10px;">
              
            </div>
        </div>
        <div style="clear:left;box-sizing: border-box;width:100%;height:auto;background:#0b1972;font-size:12px;">
              mucho texto
        </div>
    </div>

';




$data.= '



  <!-- ================================ Inicio del cuerpo ================================ -->
  <main>
    <div style="width: 100%; background-color: #eb595f; height: 50px; padding: 5px 5px;">

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

    <!--
    
    <div style="width: 100%; background-color: #0b1972; height: 50px; padding: 5px 5px;">

        <div style="float: left; margin-left: 9px; margin-top: 6px;">
            <p style="text-transform: uppercase; color: white; font-size: 11px; font-weight: bold;">área social</p>
            <p style="text-transform: uppercase; color: white; font-size: 11px; position: relative; top: -4px;"><span style="font-weight: bold;">universidad</span> <span>de chile</span></p>
        </div>

        <div style="float: right; position: relative; top: 3px; margin-right: 10px;">
            <div style="display: inline-block; margin-top: 3px;">
                <img src="../../../config/logo_equipo.png" style="position: relative; top: 0px; height: 35px; margin-right: 10px;">
            </div>
            <div style="display: inline-block; margin-top: 4px;">
                <p class="text-cabecera" style="position: relative; top: 4px;">Fútbol</p>
                <p class="text-cabecera" style="position: relative; top: -2px;">Formativo</p>
                <p style="position: relative; top: -5px; color: #cacaca; text-transform: uppercase; letter-spacing: 0px; font-stretch: condensed; transform: scaleY(1.3); word-spacing: 2px; font-size: 5.5px;">Club Universidad de Chile</p>

            </div>      
        </div>

    </div>
    -->

    <!-- ================================ Inicio del class="txCenter" ================================ -->
    <div class="txCenter div-body" style="box-sizing: border-box; width: 95%; margin: auto; margin-top: 10px;">

        <div style="margin-top: 0px; max-width: 625px; margin: auto; width: 625px; /*background-color: orange;*/">

            <p  style="text-align: center; margin-top: 2px; margin-bottom: 45px; font-size: 14px; color: #4e4e4e;" class="">'.$_POST["fecha_pdf"].'</p>
            
            <!-- VERSIÓN QUE FUNCIONA EN LOCAL -->
            
            <img src="../../../config/logo_equipo.png" style="width: 80px; height: 100px; background-color: white;">
            

            <!-- VERSIÓN QUE FUNCIONA EN EL SERVIDOR -->
            <!-- <img src="../../../config/logo_equipo.png" style="width: 80px; height: 100px;background-color: white; margin-top: -17px; margin-bottom: 20px;"> -->      

            <div style="width: 30%; margin: auto; margin-top: 0px;margin-bottom: 15px; color:#606469;font-size:12px;font-weight: bold;">Se atendieron: <span style="color:#606469;font-weight: normal;">'.$contadore_jugadores.' '.(($contadore_jugadores>1)?"Jugadores":"Jugador").'</span></div>  
        </div>

    </div>
    <!-- ================================ Fin del class="txCenter" ================================ -->
    <!-- <div style="width:100%;height:50px"></div> -->
    <!--    SERIE 20         -->
    <div style="box-sizing: border-box;font-size:12px;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;text-align:center;line-height:10px;background-color:#4e4e4e;font-weight: bold;color:#fff;">
        SUB 20
    </div>
    '.(($fila_tabla_serie_20!="")?$emcabezado_tabla:"").'
    '.(($fila_tabla_serie_20!="")?$fila_tabla_serie_20:$mensaje_sin_registros).'
    <!--    SERIE 17         -->
    <div style="box-sizing: border-box;font-size:12px;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;text-align:center;line-height:10px;background-color:#4e4e4e;font-weight: bold;color:#fff;">
        SUB 17
    </div>
    '.(($fila_tabla_serie_17!="")?$emcabezado_tabla:"").'
    '.(($fila_tabla_serie_17!="")?$fila_tabla_serie_17:$mensaje_sin_registros).'

    <!--    SERIE 16         -->
    <div style="box-sizing: border-box;font-size:12px;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;text-align:center;line-height:10px;background-color:#4e4e4e;font-weight: bold;color:#fff;">
        SUB 16
    </div>
    '.(($fila_tabla_serie_16!="")?$emcabezado_tabla:"").'
    '.(($fila_tabla_serie_16!="")?$fila_tabla_serie_16:$mensaje_sin_registros).'
    <!--    SERIE 15         -->
    <div style="box-sizing: border-box;font-size:12px;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;text-align:center;line-height:10px;background-color:#4e4e4e;font-weight: bold;color:#fff;">
        SUB 15
    </div>
    '.(($fila_tabla_serie_15!="")?$emcabezado_tabla:"").'
    '.(($fila_tabla_serie_15!="")?$fila_tabla_serie_15:$mensaje_sin_registros).'
    <!--    SERIE 14         -->
    <div style="box-sizing: border-box;font-size:12px;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;text-align:center;line-height:10px;background-color:#4e4e4e;font-weight: bold;color:#fff;">
        SUB 14
    </div>
    '.(($fila_tabla_serie_14!="")?$emcabezado_tabla:"").'
    '.(($fila_tabla_serie_14!="")?$fila_tabla_serie_14:$mensaje_sin_registros).'
    <!--    SERIE 13         -->
    <div style="box-sizing: border-box;font-size:12px;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;text-align:center;line-height:10px;background-color:#4e4e4e;font-weight: bold;color:#fff;">
        SUB 13
    </div>
    '.(($fila_tabla_serie_13!="")?$emcabezado_tabla:"").'
    '.(($fila_tabla_serie_13!="")?$fila_tabla_serie_13:$mensaje_sin_registros).'
    <!--    SERIE 12         -->
    <div style="box-sizing: border-box;font-size:12px;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;text-align:center;line-height:10px;background-color:#4e4e4e;font-weight: bold;color:#fff;">
        SUB 12
    </div>
    '.(($fila_tabla_serie_12!="")?$emcabezado_tabla:"").'
    '.(($fila_tabla_serie_12!="")?$fila_tabla_serie_12:$mensaje_sin_registros).'
    <!--    SERIE 11         -->
    <div style="box-sizing: border-box;font-size:12px;width:95%;height:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;text-align:center;line-height:10px;background-color:#4e4e4e;font-weight: bold;color:#fff;">
        SUB 11
    </div>
    '.(($fila_tabla_serie_11!="")?$emcabezado_tabla:"").'
    '.(($fila_tabla_serie_11!="")?$fila_tabla_serie_11:$mensaje_sin_registros).'
  
  </main>

  <!-- ================================ Inicio del footer ================================ -->
  <footer >
    <div style="background-color: #eb595f;display:block;height:5px;width:95%;margin-left:2.5%;margin-right:2.5%"></div>
    <span style="font-size:12px;color:#606469;display:block;margin-top:2px;margin-left:20px;">SANTIAGO WANDERERS</span>
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
$pdf->setPaper('letter', 'portrait');  //A4, letter  ;  portrait (posicion vertical; landscape (posición horizontal))
$titulo_documento_salida = "[11Analytics]_ODR_atención_diaria_jugador_lista.pdf";
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