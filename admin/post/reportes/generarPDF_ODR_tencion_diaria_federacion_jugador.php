<?php 
include('../../../bd/atencion_diaria_federacion_BD.php');

// $data='';

// $datos_informe = buscar_datosPDF( $_POST['idudc_visita_social'] );

// var_dump( $datos_informe );

// -------------------------- ARRAYS ------------------------ //
// 

$consultaAtencionDiaria=consultarAtencionPdf($_POST["idatencion_diaria_federacion"]);

$listaEstadoJugador=[
  "Sin estado",
  "Apto para jugar",
  "Apto para entrenar",
  "En reintegro deportivo",
  "En rehabilitación kinésica",
  "En espera de revisión médica",
  "En espera de resultado de examenes",
  "En post operatorio",
  "En espera de cirugia",
  "En reposo",
  "En reintegro"
];


$lista_dia_semana=[
  "Lunes",
  "Martes",
  "Miercoles",
  "Jueves",
  "Viernes",
  "Sabado",
  "Domingo",
];

$lista_mes=[
  "Enero",
  "Febreo",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre"
];

$lista_tipo_atencion=[
  "Nueva",
  "Control",
  "Medica",
  "Deportiva",
  "Nueva A",
  "Control M",
  "Sesion"
];

$seRecomienda=[
  "Reposo Deportivo",
  "Reposo total",
  "Sesiones Kinesiología",
  "Trabajo con readaptador",
  "Realizarse exámenes",
  "Entrenamiento normal",
  "Entrenamiento diferenciado",
  "Control/Revisión médica",
  "Control/Cirugia"
];

$mes_y_dia_semana= date('d-n-Y-N', strtotime($_POST["fecha_atencion_diaria"]) );

$mes_y_dia_semana_explotado=explode("-",$mes_y_dia_semana);

$dia=(int)$mes_y_dia_semana_explotado[0];
$mes=$lista_mes[(int)$mes_y_dia_semana_explotado[1]-1];
$ano=(int)$mes_y_dia_semana_explotado[2];
$semana=$lista_dia_semana[((int)$mes_y_dia_semana_explotado[3])-1];

$fecha=$semana." ".$dia." de ".$mes." del ".$ano;



$numero=(int)$_POST["tipo_atencion_atencion_diaria"];

// echo $numero;

$tipo_atencion=$lista_tipo_atencion[$numero-1];
$titulo_pdf="";

$template="";

if($numero===5){
  $titulo_pdf="REGISTRO DE NUEVA ATENCION";
  $mes_y_dia_semana2= date('d-n-Y-N', strtotime($_POST["fecha_incidente_atencion_diaria"]) );

  $mes_y_dia_semana_explotado2=explode("-",$mes_y_dia_semana2);

  $dia2=(int)$mes_y_dia_semana_explotado2[0];
  $mes2=$lista_mes[(int)$mes_y_dia_semana_explotado2[1]-1];
  $ano2=(int)$mes_y_dia_semana_explotado2[2];
  $semana2=$lista_dia_semana[((int)$mes_y_dia_semana_explotado2[3])-1];

  $fecha2=$semana2." ".$dia2." de ".$mes2." del ".$ano2;

  // <div style="text-align:left;margin-top: 25px;width:100%;display:block;">Trabajo Readaptor: '.((sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0]).'</div>
  // $contador_tratamiento=0;
  // $lista_tratamiento=[];
  // while($contador_tratamiento<sizeof($_POST["datos_ayuda"]["tratamiento"])){
  //   $lista_tratamiento[]=$_POST["datos_ayuda"]["tratamiento"][$contador_tratamiento]["nombre_tratamiento_aplicado"];
  //   for($contador_2=0;$contador_2<sizeof($_POST["datos_ayuda"].)){

  //   }
  //   $contador_tratamiento++;
  // }
  // (sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0] <span style="color:#6d6d6e;"></span>

  $lista_partes_frt="";
  if(sizeof($_POST["partes_frt_encontradas"])>1){
    if(sizeof($_POST["partes_bck_encontradas"])>1 ||sizeof($_POST["partes_bck_encontradas"])===1){
      $lista_partes_frt=''.implode(",",$_POST["partes_frt_encontradas"]).',';
    }
    else{
      $lista_partes_frt=''.implode(",",$_POST["partes_frt_encontradas"]).'';
    }
  }
  else{
    if(sizeof($_POST["partes_frt_encontradas"])===1){
      if(sizeof($_POST["partes_bck_encontradas"])>1 ||sizeof($_POST["partes_bck_encontradas"])===1){
        $lista_partes_frt=''.$_POST["partes_frt_encontradas"][0].',';
      }
      else{
        $lista_partes_frt=''.$_POST["partes_frt_encontradas"][0].'';
      }
    }
    else{
      $lista_partes_frt='';
    }
  }

  $lista_partes_bck="";
  if(sizeof($_POST["partes_bck_encontradas"])>1){
    $lista_partes_bck=''.implode(",",$_POST["partes_bck_encontradas"]).'';
  }
  else{
    if(sizeof($_POST["partes_bck_encontradas"])===1){
      $lista_partes_bck=''.$_POST["partes_bck_encontradas"][0].'';
    }
    else{
      $lista_partes_bck="";
    }
  }

  // print($lista_partes_frt.''.$lista_partes_bck);
  
  
  $template='
          <div style="width:100%;height:50px;display:block;"></span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha de la atención: <span style="color:#6d6d6e;">'.$fecha.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Tipo atención: <span style="color:#6d6d6e;">Nueva Atencion</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha del incidente: <span style="color:#6d6d6e;">'.$fecha2.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Diagnóstico: <span style="color:#6d6d6e;">'.$_POST["diagnostico_atencion_diaria"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Anamnesis: <span style="color:#6d6d6e;">'.$_POST["anamnesis_atencion_diaria"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Contexto incidente: <span style="color:#6d6d6e;">'.$_POST["contexto"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Zona Afectada: <span style="color:#6d6d6e;">'.$lista_partes_frt.''.$lista_partes_bck.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Observaciones Kinesiologo: <span style="color:#6d6d6e;">'.(($_POST["observacion_kinesiologo"]!=="null")?$_POST["observacion_kinesiologo"]:"Sin observación").'</span></div>
  
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;">Examenes solicitados : <span style="color:#6d6d6e;">'.((sizeof($_POST["lista_examenes"])>1)?implode(", ",$_POST["lista_examenes"]):$_POST["lista_examenes"][0]).'</span></div>
          </div>
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;margin-right:25px;">Estado jugador: <span style="color:red;">'.$listaEstadoJugador[(int)$consultaAtencionDiaria["datos"][0]["estado_jugador"]].'</span></div>
          </div>
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;margin-right:25px;">Examen fisico: <span style="color:#6d6d6e;">'.(($consultaAtencionDiaria["datos"][0]["examen_fisico"]===NULL)?"":$consultaAtencionDiaria["datos"][0]["examen_fisico"]).'</span></div>
          </div>
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;margin-right:25px;">Plan: <span style="color:#6d6d6e;">'.(($consultaAtencionDiaria["datos"][0]["plan_atencion_diaria"]===NULL)?"":$consultaAtencionDiaria["datos"][0]["plan_atencion_diaria"]).'</span></div>
          </div>
  ';
}

if($tipo_atencion==="Nueva"){
  $titulo_pdf="REGISTRO DE NUEVO INCIDENTE ATENCIÓN MÉDICA";
  $mes_y_dia_semana2= date('d-n-Y-N', strtotime($_POST["fecha_incidente_atencion_diaria"]) );

  $mes_y_dia_semana_explotado2=explode("-",$mes_y_dia_semana2);

  $dia2=(int)$mes_y_dia_semana_explotado2[0];
  $mes2=$lista_mes[(int)$mes_y_dia_semana_explotado2[1]-1];
  $ano2=(int)$mes_y_dia_semana_explotado2[2];
  $semana2=$lista_dia_semana[((int)$mes_y_dia_semana_explotado2[3])-1];

  $fecha2=$semana2." ".$dia2." de ".$mes2." del ".$ano2;

  // <div style="text-align:left;margin-top: 25px;width:100%;display:block;">Trabajo Readaptor: '.((sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0]).'</div>
  // $contador_tratamiento=0;
  // $lista_tratamiento=[];
  // while($contador_tratamiento<sizeof($_POST["datos_ayuda"]["tratamiento"])){
  //   $lista_tratamiento[]=$_POST["datos_ayuda"]["tratamiento"][$contador_tratamiento]["nombre_tratamiento_aplicado"];
  //   for($contador_2=0;$contador_2<sizeof($_POST["datos_ayuda"].)){

  //   }
  //   $contador_tratamiento++;
  // }
  // (sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0] <span style="color:#6d6d6e;"></span>
  $lista_partes_frt="";
  if(sizeof($_POST["partes_frt_encontradas"])>1){
    if(sizeof($_POST["partes_bck_encontradas"])>1 ||sizeof($_POST["partes_bck_encontradas"])===1){
      $lista_partes_frt=''.implode(",",$_POST["partes_frt_encontradas"]).',';
    }
    else{
      $lista_partes_frt=''.implode(",",$_POST["partes_frt_encontradas"]).'';
    }
  }
  else{
    if(sizeof($_POST["partes_frt_encontradas"])===1){
      if(sizeof($_POST["partes_bck_encontradas"])>1 ||sizeof($_POST["partes_bck_encontradas"])===1){
        $lista_partes_frt=''.$_POST["partes_frt_encontradas"][0].',';
      }
      else{
        $lista_partes_frt=''.$_POST["partes_frt_encontradas"][0].'';
      }
    }
    else{
      $lista_partes_frt='';
    }
  }

  $lista_partes_bck="";
  if(sizeof($_POST["partes_bck_encontradas"])>1){
    $lista_partes_bck=''.implode(",",$_POST["partes_bck_encontradas"]).'';
  }
  else{
    if(sizeof($_POST["partes_bck_encontradas"])===1){
      $lista_partes_bck=''.$_POST["partes_bck_encontradas"][0].'';
    }
    else{
      $lista_partes_bck="";
    }
  }
  $strRecomendacion=" ";
  $listaRecomendaciones=[];
  for($contadorRecomendacion=0;$contadorRecomendacion<sizeof($consultaAtencionDiaria["datos"][0]["recomendaciones"]);$contadorRecomendacion++){
    if($consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]==="1" || $consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]==="2"){
      $listaRecomendaciones[]=$seRecomienda[(int)$consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]]." ".$consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["fecha_recomendacion"];
    }
    else{
      $listaRecomendaciones[]=$seRecomienda[(int)$consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]];
    }
  }
  if(sizeof($listaRecomendaciones)>1){
    $strRecomendacion=implode(", ",$listaRecomendaciones);
  }
  else if(sizeof($listaRecomendaciones)===1){
    $strRecomendacion=$listaRecomendaciones[0];
  }
  

  
  $template='
          <div style="width:100%;height:50px;display:block;"></span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha de la atención: <span style="color:#6d6d6e;">'.$fecha.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Tipo atención: <span style="color:#6d6d6e;">'.$tipo_atencion.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha del incidente: <span style="color:#6d6d6e;">'.$fecha2.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Diagnóstico: <span style="color:#6d6d6e;">'.$_POST["diagnostico_atencion_diaria"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Anamnesis: <span style="color:#6d6d6e;">'.$_POST["anamnesis_atencion_diaria"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Contexto incidente: <span style="color:#6d6d6e;">'.$_POST["contexto"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Zona Afectada: <span style="color:#6d6d6e;">'.$lista_partes_frt.''.$lista_partes_bck.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Tratamiento: <span style="color:#6d6d6e;">'.((sizeof($_POST["lista_tratamiento"])>1)?implode(", ",$_POST["lista_tratamiento"]):$_POST["lista_tratamiento"][0]).'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Observaciones Kinesiologo: <span style="color:#6d6d6e;">'.(($_POST["observacion_kinesiologo"]!=="null")?$_POST["observacion_kinesiologo"]:"Sin observación").'</span></div>
  
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;">Derivado al seguro médico: <span style="color:#6d6d6e;">'.(($_POST["derivado_seguro_atencion_diaria"]==="1")?"Si":"No").'</span></div>
              <div style="display:inline;margin-left:35px;"">Examenes solicitados : <span style="color:#6d6d6e;">'.((sizeof($_POST["lista_examenes"])>1)?implode(", ",$_POST["lista_examenes"]):$_POST["lista_examenes"][0]).'</span></div>
          </div>
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;margin-right:25px;">Estado jugador: <span style="color:red;">'.$listaEstadoJugador[(int)$consultaAtencionDiaria["datos"][0]["estado_jugador"]].'</span></div>
          </div>
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;margin-right:25px;">Examen fisico: <span style="color:#6d6d6e;">'.(($consultaAtencionDiaria["datos"][0]["examen_fisico"]===NULL)?"":$consultaAtencionDiaria["datos"][0]["examen_fisico"]).'</span></div>
          </div>
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;margin-right:25px;">Recomendaciones: <span style="color:#6d6d6e;">'.$strRecomendacion.'</span></div>
          </div>
  ';
}

if($numero===6){
  $titulo_pdf="REGISTRO DE CONTROL MEDICO";
  $mes_y_dia_semana2= date('d-n-Y-N', strtotime($_POST["agregado_fecha_lesion"]) );

  $mes_y_dia_semana_explotado2=explode("-",$mes_y_dia_semana2);

  $dia2=(int)$mes_y_dia_semana_explotado2[0];
  $mes2=$lista_mes[(int)$mes_y_dia_semana_explotado2[1]-1];
  $ano2=(int)$mes_y_dia_semana_explotado2[2];
  $semana2=$lista_dia_semana[(int)$mes_y_dia_semana_explotado2[3]-1];

  $fecha2=$semana2." ".$dia2." de ".$mes2." del ".$ano2;

  // <div style="text-align:left;margin-top: 25px;width:100%;display:block;">Trabajo Readaptor: '.((sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0]).'</div>
  // $contador_tratamiento=0;
  // $lista_tratamiento=[];
  // while($contador_tratamiento<sizeof($_POST["datos_ayuda"]["tratamiento"])){
  //   $lista_tratamiento[]=$_POST["datos_ayuda"]["tratamiento"][$contador_tratamiento]["nombre_tratamiento_aplicado"];
  //   for($contador_2=0;$contador_2<sizeof($_POST["datos_ayuda"].)){

  //   }
  //   $contador_tratamiento++;
  // }
  // (sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0] <span style="color:#6d6d6e;"></span>
  $strSeguro=" ";
  if($_POST["seguro_informe_medico"]!=="null"){
    $strSeguro=($_POST["seguro_informe_medico"]==="1")?"Si":"No";
  }
  // ((sizeof($_POST["lista_tratamiento"])>1)?implode(", ",$_POST["lista_tratamiento"]):$_POST["lista_tratamiento"][0])
  // $strTratamiento=" ";
  // if(sizeof($_POST["lista_tratamiento"])>1){
  //   $strTratamiento=implode(", ",$_POST["lista_tratamiento"]);
  // }
  // else if(sizeof($_POST["lista_tratamiento"])===1){
  //   $strTratamiento=$_POST["lista_tratamiento"][0];
  // }

  $strRecomendacion=" ";
  $listaRecomendaciones=[];
  for($contadorRecomendacion=0;$contadorRecomendacion<sizeof($consultaAtencionDiaria["datos"][0]["recomendaciones"]);$contadorRecomendacion++){
    if($consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]==="1" || $consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]==="2"){
      $listaRecomendaciones[]=$seRecomienda[(int)$consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]]." ".$consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["fecha_recomendacion"];
    }
    else{
      $listaRecomendaciones[]=$seRecomienda[(int)$consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]];
    }
  }
  if(sizeof($listaRecomendaciones)>1){
    $strRecomendacion=implode(", ",$listaRecomendaciones);
  }
  else if(sizeof($listaRecomendaciones)===1){
    $strRecomendacion=$listaRecomendaciones[0];
  }
  
  $template='
          <div style="width:100%;height:50px;display:block;"></span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Atendido por: <span style="color:#6d6d6e;">'.$_POST["nombre_medico"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha de la atención: <span style="color:#6d6d6e;">'.$fecha.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Tipo atención: <span style="color:#6d6d6e;">Control / Sesion kinesica</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">N° sesion: <span style="color:#6d6d6e;">'.$_POST["numero_sesion"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha del incidente: <span style="color:#6d6d6e;">'.$fecha2.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Diagnostico: <span style="color:#6d6d6e;">'.$_POST["diagnostico_informe"].'</span></div>
        
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Contexto incidente: <span style="color:#6d6d6e;">'.$_POST["contexto_informe_medico"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Examenes solicitados : <span style="color:#6d6d6e;">'.$_POST["examenes_informe_medico"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Zona Afectada: <span style="color:#6d6d6e;">'.$_POST["zonas_afectadas"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Derivado a seguro: <span style="color:red;">'.$strSeguro.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Obseervación: <span style="color:#6d6d6e;">'.(($_POST["observacion"]!=="null")?$_POST["observacion"]:"Sin observación").'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Examen fisico: <span style="color:#6d6d6e;">'.(($_POST["examen_fisico"]!=="null")?$_POST["examen_fisico"]:"Sin observación").'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Indicaciones: <span style="color:#6d6d6e;">'.(($consultaAtencionDiaria["datos"][0]["indicaciones"]===NULL)?"":$consultaAtencionDiaria["datos"][0]["indicaciones"]).'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha de alta medica: <span style="color:#6d6d6e;">'.$_POST["fecha_estimada_de_alta_2"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Estado jugador: <span style="color:#6d6d6e;">'.$listaEstadoJugador[(int)$consultaAtencionDiaria["datos"][0]["estado_jugador"]].'</span></div>
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;margin-right:25px;">Recomendaciones: <span style="color:#6d6d6e;">'.$strRecomendacion.'</span></div>
          </div>
  ';
}
if($numero===7){
  $titulo_pdf="REGISTRO DE SESION READAPTADOR";
  $mes_y_dia_semana2= date('d-n-Y-N', strtotime($_POST["agregado_fecha_lesion"]) );

  $mes_y_dia_semana_explotado2=explode("-",$mes_y_dia_semana2);

  $dia2=(int)$mes_y_dia_semana_explotado2[0];
  $mes2=$lista_mes[(int)$mes_y_dia_semana_explotado2[1]-1];
  $ano2=(int)$mes_y_dia_semana_explotado2[2];
  $semana2=$lista_dia_semana[(int)$mes_y_dia_semana_explotado2[3]-1];

  $fecha2=$semana2." ".$dia2." de ".$mes2." del ".$ano2;

  $strSeguro=" ";
  if($_POST["seguro_informe_medico"]!=="null"){
    $strSeguro=($_POST["seguro_informe_medico"]==="1")?"Si":"No";
  }
  // ((sizeof($_POST["lista_tratamiento"])>1)?implode(", ",$_POST["lista_tratamiento"]):$_POST["lista_tratamiento"][0])
  $strTrabajorReadaptador=" ";
  if(array_key_exists("lista_trbajo_readaptador",$_POST)){
    if(sizeof($_POST["lista_trbajo_readaptador"])>1){
      $strTrabajorReadaptador=implode(", ",$_POST["lista_trbajo_readaptador"]);
    }
    else if(sizeof($_POST["lista_trbajo_readaptador"])===1){
      $strTrabajorReadaptador=$_POST["lista_trbajo_readaptador"][0];
    }
  }
  
  $template='
          <div style="width:100%;height:50px;display:block;"></span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Atendido por: <span style="color:#6d6d6e;">'.$_POST["nombre_medico"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha de la atención: <span style="color:#6d6d6e;">'.$fecha.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Tipo atención: <span style="color:#6d6d6e;">Control / Sesion kinesica</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">N° sesion: <span style="color:#6d6d6e;">'.$_POST["numero_sesion"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha del incidente: <span style="color:#6d6d6e;">'.$fecha2.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Diagnostico: <span style="color:#6d6d6e;">'.$_POST["diagnostico_informe"].'</span></div>
        
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Contexto incidente: <span style="color:#6d6d6e;">'.$_POST["contexto_informe_medico"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Examenes solicitados : <span style="color:#6d6d6e;">'.$_POST["examenes_informe_medico"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Zona Afectada: <span style="color:#6d6d6e;">'.$_POST["zonas_afectadas"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Derivado a seguro: <span style="color:red;">'.$strSeguro.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Obseervación: <span style="color:#6d6d6e;">'.(($_POST["observacion"]!=="null")?$_POST["observacion"]:"Sin observación").'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Indicaciones: <span style="color:#6d6d6e;">'.(($consultaAtencionDiaria["datos"][0]["indicaciones"]===NULL)?"":$consultaAtencionDiaria["datos"][0]["indicaciones"]).'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha de alta deportiva: <span style="color:#6d6d6e;">'.$_POST["fecha_estimada_de_alta_2"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Estado jugador: <span style="color:#6d6d6e;">'.$listaEstadoJugador[(int)$consultaAtencionDiaria["datos"][0]["estado_jugador"]].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">% de recuperacón: <span style="color:#6d6d6e;">'.$_POST["porcentaje_recuperacion"].'%</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Trabajo readaprador: <span style="color:#6d6d6e;">'.$strTrabajorReadaptador.'</span></div>
  ';
}
if($tipo_atencion==="Control"){
  $titulo_pdf="REGISTRO DE CONTROL / SESION KINESICA";
  $mes_y_dia_semana2= date('d-n-Y-N', strtotime($_POST["agregado_fecha_lesion"]) );

  $mes_y_dia_semana_explotado2=explode("-",$mes_y_dia_semana2);

  $dia2=(int)$mes_y_dia_semana_explotado2[0];
  $mes2=$lista_mes[(int)$mes_y_dia_semana_explotado2[1]-1];
  $ano2=(int)$mes_y_dia_semana_explotado2[2];
  $semana2=$lista_dia_semana[(int)$mes_y_dia_semana_explotado2[3]-1];

  $fecha2=$semana2." ".$dia2." de ".$mes2." del ".$ano2;

  // <div style="text-align:left;margin-top: 25px;width:100%;display:block;">Trabajo Readaptor: '.((sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0]).'</div>
  // $contador_tratamiento=0;
  // $lista_tratamiento=[];
  // while($contador_tratamiento<sizeof($_POST["datos_ayuda"]["tratamiento"])){
  //   $lista_tratamiento[]=$_POST["datos_ayuda"]["tratamiento"][$contador_tratamiento]["nombre_tratamiento_aplicado"];
  //   for($contador_2=0;$contador_2<sizeof($_POST["datos_ayuda"].)){

  //   }
  //   $contador_tratamiento++;
  // }
  // (sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0] <span style="color:#6d6d6e;"></span>
  $strSeguro=" ";
  if($_POST["seguro_informe_medico"]!=="null"){
    $strSeguro=($_POST["seguro_informe_medico"]==="1")?"Si":"No";
  }
  // ((sizeof($_POST["lista_tratamiento"])>1)?implode(", ",$_POST["lista_tratamiento"]):$_POST["lista_tratamiento"][0])
  $strTratamiento=" ";
  if(array_key_exists("lista_tratamiento",$_POST)){
    if(sizeof($_POST["lista_tratamiento"])>1){
      $strTratamiento=implode(", ",$_POST["lista_tratamiento"]);
    }
    else if(sizeof($_POST["lista_tratamiento"])===1){
      $strTratamiento=$_POST["lista_tratamiento"][0];
    }
  }

  $strRecomendacion=" ";
  $listaRecomendaciones=[];
  for($contadorRecomendacion=0;$contadorRecomendacion<sizeof($consultaAtencionDiaria["datos"][0]["recomendaciones"]);$contadorRecomendacion++){
    if($consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]==="1" || $consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]==="2"){
      $listaRecomendaciones[]=$seRecomienda[(int)$consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]]." ".$consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["fecha_recomendacion"];
    }
    else{
      $listaRecomendaciones[]=$seRecomienda[(int)$consultaAtencionDiaria["datos"][0]["recomendaciones"][$contadorRecomendacion]["recomendacion_numero"]];
    }
  }
  if(sizeof($listaRecomendaciones)>1){
    $strRecomendacion=implode(", ",$listaRecomendaciones);
  }
  else if(sizeof($listaRecomendaciones)===1){
    $strRecomendacion=$listaRecomendaciones[0];
  }
  
  $template='
          <div style="width:100%;height:50px;display:block;"></span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Atendido por: <span style="color:#6d6d6e;">'.$_POST["nombre_medico"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha de la atención: <span style="color:#6d6d6e;">'.$fecha.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Tipo atención: <span style="color:#6d6d6e;">Control / Sesion kinesica</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">N° sesion: <span style="color:#6d6d6e;">'.$_POST["numero_sesion"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha del incidente: <span style="color:#6d6d6e;">'.$fecha2.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Diagnostico: <span style="color:#6d6d6e;">'.$_POST["diagnostico_informe"].'</span></div>
        
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Contexto incidente: <span style="color:#6d6d6e;">'.$_POST["contexto_informe_medico"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Examenes solicitados : <span style="color:#6d6d6e;">'.$_POST["examenes_informe_medico"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Zona Afectada: <span style="color:#6d6d6e;">'.$_POST["zonas_afectadas"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Derivado a seguro: <span style="color:red;">'.$strSeguro.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Tratamiento: <span style="color:#6d6d6e;">'.$strTratamiento.'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Obseervación: <span style="color:#6d6d6e;">'.(($_POST["observacion_general"]!=="null")?$_POST["observacion_general"]:"Sin observación").'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Indicaciones: <span style="color:#6d6d6e;">'.(($consultaAtencionDiaria["datos"][0]["indicaciones"]===NULL)?"":$consultaAtencionDiaria["datos"][0]["indicaciones"]).'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">% de recuperacón: <span style="color:#6d6d6e;">'.$_POST["porcentaje_recuperacion"].'%</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Fecha de alta medica: <span style="color:#6d6d6e;">'.$_POST["fecha_estimada_de_alta_2"].'</span></div>
          <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 15px;width:100%;display:block;">Estado jugador: <span style="color:#6d6d6e;">'.$listaEstadoJugador[(int)$consultaAtencionDiaria["datos"][0]["estado_jugador"]].'</span></div>
          <div style="display:block;margin-top: 15px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;margin-right:25px;">Recomendaciones: <span style="color:#6d6d6e;">'.$strRecomendacion.'</span></div>
          </div>
  ';
}
if($tipo_atencion==="Medica"){
  $titulo_pdf="CERTIFICADO DE ALTA MÉDICA";
  // $mes_y_dia_semana2= date('d-n-Y-N', strtotime($_POST["fecha_incidente_atencion_diaria"]) );

  // $mes_y_dia_semana_explotado2=explode("-",$mes_y_dia_semana2);

  // $dia2=(int)$mes_y_dia_semana_explotado2[0];
  // $mes2=$lista_mes[(int)$mes_y_dia_semana_explotado2[1]-1];
  // $ano2=(int)$mes_y_dia_semana_explotado2[2];
  // $semana2=$lista_dia_semana[(int)$mes_y_dia_semana_explotado2[3]-1];

  // $fecha2=$semana2." ".$dia2." de ".$mes2." del ".$ano2;

  // <div style="text-align:left;margin-top: 25px;width:100%;display:block;">Trabajo Readaptor: '.((sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0]).'</div>
  // $contador_tratamiento=0;
  // $lista_tratamiento=[];
  // while($contador_tratamiento<sizeof($_POST["datos_ayuda"]["tratamiento"])){
  //   $lista_tratamiento[]=$_POST["datos_ayuda"]["tratamiento"][$contador_tratamiento]["nombre_tratamiento_aplicado"];
  //   for($contador_2=0;$contador_2<sizeof($_POST["datos_ayuda"].)){

  //   }
  //   $contador_tratamiento++;
  // }
  // (sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0] <span style="color:#6d6d6e;"></span>

  $strDia=" ";
  if($_POST["dias_baja_informe"]!=="null"){
    $strDia=$_POST["dias_baja_informe"]." ".(($_POST["dias_baja_informe"]>1)?"Días":"Día");
  }

  $strResivida=" ";
  if($_POST["recidiva_informe"]!=="null"){
    $strResivida=($_POST["recidiva_informe"]==="1")?"Si":"No";
  }

  $strSeguro=" ";
  if($_POST["seguro_informe_medico"]!=="null"){
    $strSeguro=($_POST["seguro_informe_medico"]==="1")?"Si":"No";
  }

  $template='
  <div style="width:100%;height:50px;display:block;"></span></div>
  <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 25px;margin-bottom: 25px;width:100%;display:block;">Atendido por: <span style="color:#6d6d6e;">'.$_POST["nombre"].' '.$_POST["apellido1"].' '.$_POST["apellido2"].'</span></div>
  <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 30px;margin-right: 650px;display:inline;border-bottom:solid 2px #404040;">DATOS DE LA LESIÓN</div>
  <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 30px;width:100%;display:block;">Diagnóstico: <span style="color:#6d6d6e;">'.$_POST["diagnostico_informe"].'</span></div>
  <div style="display:block;margin-top: 30px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;">Fecha lesion: <span style="color:#6d6d6e;">'.$_POST["fecha_lesion_informe"].'</span></div>
              <div style="display:inline;margin-left:35px;">Recidiva : <span style="color:#6d6d6e;">'.$strResivida.'</span></div>
  </div>
  <div style="display:block;margin-top: 30px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;">Examenes realizados: <span style="color:#6d6d6e;">'.$_POST["examenes_informe_medico"].'</span></div>
              <div style="display:inline;margin-left:60px;">Comentario examen : <span style="color:#6d6d6e;">'.$_POST["comentario_examen_informe"].'</span></div>
  </div>
  <div style="display:block;margin-top: 30px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;">Derivado seguro medico realizados: <span style="color:#6d6d6e;">'.$strSeguro.'</span></div>
              <div style="display:inline;margin-left:48px;">Dias de baja  : <span style="color:#6d6d6e;"> '.$strDia.'</span></div>
  </div>
  <div style="font-size:12px;color:#ff8088;font-weight: bold;text-align:left;margin-top: 30px;width:100%;display:block;">Recomendación alta: <span style="color:#6d6d6e;">'.((sizeof($_POST["recomendaciones_alta"])>1)?implode(", ",$_POST["recomendaciones_alta"]):$_POST["recomendaciones_alta"][0]).'</span></div>
  <div style="font-size:12px;color:#ff8088;font-weight: bold;text-align:left;margin-top: 30px;width:100%;display:block;">Recomendaciones médicas: <span style="color:#6d6d6e;">'.(($_POST["observacion_medica"]!=="null")?$_POST["observacion_medica"]:"Sin recomendaciones").'</span></div>
  <div style="font-size:12px;color:#ff8088;font-weight: bold;text-align:left;margin-top: 30px;width:100%;display:block;">Estado jugador: <span style="color:#6d6d6e;">'.$listaEstadoJugador[(int)$consultaAtencionDiaria["datos"][0]["estado_jugador"]].'</span></div>
  ';
}

if($tipo_atencion==="Deportiva"){
  $titulo_pdf="CERTIFICADO DE ALTA DEPORTIVA";
  // $mes_y_dia_semana2= date('d-n-Y-N', strtotime($_POST["fecha_incidente_atencion_diaria"]) );

  // $mes_y_dia_semana_explotado2=explode("-",$mes_y_dia_semana2);

  // $dia2=(int)$mes_y_dia_semana_explotado2[0];
  // $mes2=$lista_mes[(int)$mes_y_dia_semana_explotado2[1]-1];
  // $ano2=(int)$mes_y_dia_semana_explotado2[2];
  // $semana2=$lista_dia_semana[(int)$mes_y_dia_semana_explotado2[3]-1];

  // $fecha2=$semana2." ".$dia2." de ".$mes2." del ".$ano2;

  // <div style="text-align:left;margin-top: 25px;width:100%;display:block;">Trabajo Readaptor: '.((sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0]).'</div>
  // $contador_tratamiento=0;
  // $lista_tratamiento=[];
  // while($contador_tratamiento<sizeof($_POST["datos_ayuda"]["tratamiento"])){
  //   $lista_tratamiento[]=$_POST["datos_ayuda"]["tratamiento"][$contador_tratamiento]["nombre_tratamiento_aplicado"];
  //   for($contador_2=0;$contador_2<sizeof($_POST["datos_ayuda"].)){

  //   }
  //   $contador_tratamiento++;
  // }
  // (sizeof($_POST["lista_trbajo_readaptador"])>1)?implode(", ",$_POST["lista_trbajo_readaptador"]):$_POST["lista_trbajo_readaptador"][0] <span style="color:#6d6d6e;"></span>
  $strDia=" ";
  if($_POST["dias_baja_informe"]!=="null"){
    $strDia=$_POST["dias_baja_informe"]." ".(($_POST["dias_baja_informe"]>1)?"Días":"Día");
  }

  $strResivida=" ";
  if($_POST["recidiva_informe"]!=="null"){
    $strResivida=($_POST["recidiva_informe"]==="1")?"Si":"No";
  }
  
  $strSeguro=" ";
  if($_POST["seguro_informe_medico"]!=="null"){
    $strSeguro=($_POST["seguro_informe_medico"]==="1")?"Si":"No";
  }

  $template='
  <div style="width:100%;height:50px;display:block;"></span></div>
  <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 25px;margin-bottom: 25px;width:100%;display:block;">Atendido por: <span style="color:#6d6d6e;">'.$_POST["nombre"].' '.$_POST["apellido1"].' '.$_POST["apellido2"].'</span></div>
  <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 30px;margin-right: 650px;display:inline;border-bottom:solid 2px #404040;">DATOS DE LA LESIÓN</div>
  <div style="font-size:12px;color:#404040;font-weight: bold;text-align:left;margin-top: 30px;width:100%;display:block;">Diagnóstico: <span style="color:#6d6d6e;">'.$_POST["diagnostico_informe"].'</span></div>
  <div style="display:block;margin-top: 30px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;">Fecha lesion: <span style="color:#6d6d6e;">'.$_POST["fecha_lesion_informe"].'</span></div>
              <div style="display:inline;margin-left:35px;">Recidiva : <span style="color:#6d6d6e;">'.$strResivida.'</span></div>
  </div>
  <div style="display:block;margin-top: 30px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;">Examenes realizados: <span style="color:#6d6d6e;">'.$_POST["examenes_informe_medico"].'</span></div>
              <div style="display:inline;margin-left:60px;">Comentario examen : <span style="color:#6d6d6e;">'.$_POST["comentario_examen_informe"].'</span></div>
  </div>
  <div style="display:block;margin-top: 30px;font-size:12px;color:#404040;font-weight: bold;text-align:left;">
              <div style="display:inline;">Derivado seguro medico realizados: <span style="color:#6d6d6e;">'.$strSeguro.'</span></div>
              <div style="display:inline;margin-left:48px;">Dias de baja  : <span style="color:#6d6d6e;"> '.$strDia.'</span></div>
  </div>
  <div style="font-size:12px;color:#ff8088;font-weight: bold;text-align:left;margin-top: 30px;width:100%;display:block;">Recomendación alta: <span style="color:#6d6d6e;">'.((sizeof($_POST["recomendaciones_alta"])>1)?implode(", ",$_POST["recomendaciones_alta"]):$_POST["recomendaciones_alta"][0]).'</span></div>
  <div style="font-size:12px;color:#ff8088;font-weight: bold;text-align:left;margin-top: 30px;width:100%;display:block;">Recomendaciones deportiva: <span style="color:#6d6d6e;">'.(($_POST["observacion_medica"]!=="null")?$_POST["observacion_medica"]:"Sin recomendaciones").'</span></div>
  <div style="font-size:12px;color:#ff8088;font-weight: bold;text-align:left;margin-top: 30px;width:100%;display:block;">Estado jugador: <span style="color:#6d6d6e;">'.$listaEstadoJugador[(int)$consultaAtencionDiaria["datos"][0]["estado_jugador"]].'</span></div>
  ';
}


$data.= '
  <!-- ================================ Inicio del cuerpo ================================ -->
  <main>

    <div style="width: 100%; background-color: #eb595f; height: 50px; padding: 5px 5px;">

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

    <!-- ================================ Inicio del class="txCenter" ================================ -->
    <div class="txCenter div-body" style="box-sizing: border-box; width: 95%; margin: auto; margin-top: 10px;">

        <div style="margin-top: 0px; max-width: 625px; margin: auto; width: 625px; /*background-color: orange;*/">

            <p  style="text-align: center; margin-top: 2px; margin-bottom: 25px; font-size: 14px; color: #4e4e4e;" class="big-text">'.$titulo_pdf.'</p>
            
            <!-- VERSIÓN QUE FUNCIONA EN LOCAL -->
            
            <!-- <img src="../../foto_jugadores/314--.png" style="width: 100px; height: 100px; border-radius: 50px; border: solid 2px #c1c1c1; background-color: white;"> -->
            

            <!-- VERSIÓN QUE FUNCIONA EN EL SERVIDOR -->
            <img src="../../foto_jugadores/'.$_POST["idfichaJugador"].'.png" style="width: 100px; height: 100px; border-radius: 50px; border: solid 2px #c1c1c1; background-color: white; margin-top: -17px; margin-bottom: 20px;">      

            <div style="border-top: 2px solid black; border-bottom: 2px solid black; width: 30%; margin: auto; margin-top: -13px;">
                <p style="background-color: transparent; text-transform: uppercase; font-family: Open Sans, sans-serif!important; font-size: 9px; font-weight: bold; margin-top: 3px; margin-bottom: 1px">'.$_POST["nombre"].' '.$_POST["apellido1"].' '.$_POST["apellido2"].'</p>
                <p style="background-color: transparent; text-transform: capitalize; font-family: Open Sans, sans-serif!important; font-size: 9px; font-weight: normal; margin: 1px 0px;">'.$_POST["posicion"].' / '.$_POST["texto_serie"].'</p>
            </div>  
        </div>
        <center>
            <div style="background-color: transparent; margin-top: 25px; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">DETALLE DE LA ATENCIÓN</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>


        '.$template.'
    </div>
    <!-- ================================ Fin del class="txCenter" ================================ -->
  
  </main>

  <!-- ================================ Inicio del footer ================================ -->
  <footer style="height:50px;">
    <div style="background-color: #eb595f;display:block;height:5px;width:95%;margin-left:2.5%;margin-right:2.5%"></div>
    <span style="font-size:12px;color:#606469;display:block;margin-top:2px;margin-left:20px;">CLUB UNIVERSIDAD DE CHILE</span>
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
$titulo_documento_salida = "[11Analytics]_ODR_atención_diaria_jugador.pdf";
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
    width: 35%; 
    float: left;
}

.right-div-title {
    height: 2px; 
    border-bottom: solid 2px #c1c1c1; 
    width: 35%; 
    float: right;
}

.middle-div-title {
    width: 30%; 
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