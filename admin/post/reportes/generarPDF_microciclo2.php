<?php 
include('../../../bd/calendar_BD.php');

$data='';
$months = ['All','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

$dataJugador = ver_jugadores_PDF($_POST);

$inicial = $_POST['inicio'];
$final = $_POST['fin'];
$comienzo = $inicial;

$anoF = intval(substr($final, 0, 4));
$mesF = intval(substr($final, 5, 2));
$diaF = intval(substr($final, 8, 2));

$nombre_jugador = $dataJugador['nombre'].' '.$dataJugador['apellido1'].' '.$dataJugador['apellido2'];
$fecha_informe  = substr($dataJugador['fecha_microciclo'],8,2).'-'.substr($dataJugador['fecha_microciclo'],5,2).'-'.substr($dataJugador['fecha_microciclo'],0,4);
$descripcion    = $dataJugador['informe_microciclo'];

$fecha_comienzo = substr($_POST['inicio2'],8,2).' '.$months[intval(substr($_POST['inicio2'],5,2))].' '.substr($_POST['inicio2'],0,4);
$fecha_fin      = substr($_POST['fin2'],8,2).' '.$months[intval(substr($_POST['fin2'],5,2))].' '.substr($_POST['fin2'],0,4);
$semana_comienzo= date('W', mktime(0,0,0, substr($_POST['inicio2'],5,2), substr($_POST['inicio2'],8,2), substr($_POST['inicio2'],0,4)));
$semana_fin     = date('W', mktime(0,0,0, substr($_POST['fin2'],5,2), substr($_POST['fin2'],8,2), substr($_POST['fin2'],0,4)));
$sesiones       = $_POST['sesiones'];

$datetime1  = new DateTime($inicial);
$datetime2  = new DateTime($final);
$interval   = $datetime1->diff($datetime2);
$semanas    = floor(($interval->format('%a') / 7));
$co_semanas = ($interval->format('%a') % 7);
if ($co_semanas > 0) { $semanas++; }

$data.= '
    <h2 class="txCenter" style="font-weight: bold; margin-bottom:30px; font-family: helvetica; font-size: 23px; text-transform: uppercase;">'.$nombre_jugador.'</h2>
    <table class="tg" style="border: none; width:320px; margin-bottom:10px;">
        <td class="txCenter tx12 verde" style="border: 1px solid #28b779; width:45%; color: #ffffff; padding-top: 7px;">Fecha informe</td>
        <td class="txCenter grisesOscuro tx14" style="border: 1px solid #22A56C; padding: 5px;">'.$fecha_informe.'</td>
    </table>
    
    <h2 class="tx16 txCenter" style="font-weight: bold; margin-bottom:10px; font-family: helvetica;">INFORME MICROCILIO JUGADOR</h2>
    <div class="tg tg-0pky tx14" style="height: 150px; font-family: helvetica; margin-bottom:10px; padding: 5px;">'.$descripcion.'</div>
    
    <h2 class="tx16 txCenter" style="font-weight: bold; margin-bottom:10px; font-family: helvetica; color: #ffffff; background: #ce1111; padding: 7px;">DETALLE INFORME</h2>
    <h2 class="tx16 txCenter" style="font-weight: bold; margin-bottom:10px; font-family: helvetica;">SELECCIÓN MONARCAS MORELIA</h2>
    
    <table class="tg" style="width: 65%; margin:auto;">
        <tr class="tx12">
            <td class="txCenter tg-0pky"><b>FECHA MICROCICLO</b></td>
            <td class="txCenter tg-0pky">'.$fecha_comienzo.' - '.$fecha_fin.'</td>
            <td class="txCenter tg-0pky"><b>JEFE TÉCNICO</b></td>
            <td class="txCenter tg-0pky">Luis Ahumada</td>
        </tr>
        <tr class="tx12">
            <td class="txCenter tg-0pky"><b>SEMANA N°</b></td>
            <td class="txCenter tg-0pky">'.$semana_comienzo.' - '.$semana_fin.'</td>
            <td class="txCenter tg-0pky"><b>D. TÉCNICO</b></td>
            <td class="txCenter tg-0pky">Cristian Leiva</td>
        </tr>
        <tr class="tx12">
            <td class="txCenter tg-0pky"><b>MICROCICLO</b></td>
            <td class="txCenter tg-0pky">21</td>
            <td class="txCenter tg-0pky"><b>AY. TÉCNICO</b></td>
            <td class="txCenter tg-0pky">Fernando Morinell</td>
        </tr>
        <tr class="tx12">
            <td class="txCenter tg-0pky"><b>N° DE SESIONES</b></td>
            <td class="txCenter tg-0pky">'.$sesiones.'</td>
            <td class="txCenter tg-0pky"><b>P. FÍSICO</b></td>
            <td class="txCenter tg-0pky">Jose M. Alvarado</td>
        </tr>
    </table>
';

$c_info=calendar_info($_POST);
$c_semana=calendar_semana($_POST);
for ($i = 0; $i <= $semanas; $i++) {
    if ($i != 0) {
        $comienzo = date ( 'Y-m-d' , $comienzo );
    }

    $_POST['inicio'] = $comienzo;
    $_POST['fin'] = strtotime ( '+7 day' , strtotime ($comienzo) ) ;
    $_POST['fin'] = date ( 'Y-m-d' , $_POST['fin'] );
    
    $anoR = intval(substr($_POST['inicio'], 0, 4));
    $mesR = intval(substr($_POST['inicio'], 5, 2));
    $diaR = intval(substr($_POST['inicio'], 8, 2));
    
    $estatusR = false;
    if ($anoR < $anoF) {
        $estatusR = true;
    } else if ($anoR == $anoF) {
        if ($mesR < $mesF) {
            $estatusR = true;
        } else if ($mesR == $mesF) {
            if ($diaR <= $diaF) {
                $estatusR = true;
            }
        }
    }

    if ($estatusR) {
        if ($i == 0) {
            $getget = date ( 'w' , strtotime($comienzo) );
            
            if ($getget == 1) {
                $s0 = strtotime ( '+0 day' , strtotime ($comienzo) ) ;
                $s1 = strtotime ( '+1 day' , strtotime ($comienzo) ) ;
                $s2 = strtotime ( '+2 day' , strtotime ($comienzo) ) ;
                $s3 = strtotime ( '+3 day' , strtotime ($comienzo) ) ; 
                $s4 = strtotime ( '+4 day' , strtotime ($comienzo) ) ;
                $s5 = strtotime ( '+5 day' , strtotime ($comienzo) ) ;
                $s6 = strtotime ( '+6 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 2) {
                $s0 = strtotime ( '-1 day' , strtotime ($comienzo) ) ;
                $s1 = strtotime ( '+0 day' , strtotime ($comienzo) ) ;
                $s2 = strtotime ( '+1 day' , strtotime ($comienzo) ) ;
                $s3 = strtotime ( '+2 day' , strtotime ($comienzo) ) ; 
                $s4 = strtotime ( '+3 day' , strtotime ($comienzo) ) ;
                $s5 = strtotime ( '+4 day' , strtotime ($comienzo) ) ;
                $s6 = strtotime ( '+5 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 3) {
                $s0 = strtotime ( '-2 day' , strtotime ($comienzo) ) ;
                $s1 = strtotime ( '-1 day' , strtotime ($comienzo) ) ;
                $s2 = strtotime ( '+0 day' , strtotime ($comienzo) ) ;
                $s3 = strtotime ( '+1 day' , strtotime ($comienzo) ) ; 
                $s4 = strtotime ( '+2 day' , strtotime ($comienzo) ) ;
                $s5 = strtotime ( '+3 day' , strtotime ($comienzo) ) ;
                $s6 = strtotime ( '+4 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 4) {
                $s0 = strtotime ( '-3 day' , strtotime ($comienzo) ) ;
                $s1 = strtotime ( '-2 day' , strtotime ($comienzo) ) ;
                $s2 = strtotime ( '-1 day' , strtotime ($comienzo) ) ;
                $s3 = strtotime ( '+0 day' , strtotime ($comienzo) ) ; 
                $s4 = strtotime ( '+1 day' , strtotime ($comienzo) ) ;
                $s5 = strtotime ( '+2 day' , strtotime ($comienzo) ) ;
                $s6 = strtotime ( '+3 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 5) {
                $s0 = strtotime ( '-4 day' , strtotime ($comienzo) ) ;
                $s1 = strtotime ( '-3 day' , strtotime ($comienzo) ) ;
                $s2 = strtotime ( '-2 day' , strtotime ($comienzo) ) ;
                $s3 = strtotime ( '-1 day' , strtotime ($comienzo) ) ; 
                $s4 = strtotime ( '+0 day' , strtotime ($comienzo) ) ;
                $s5 = strtotime ( '+1 day' , strtotime ($comienzo) ) ;
                $s6 = strtotime ( '+2 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 6) {
                $s0 = strtotime ( '-5 day' , strtotime ($comienzo) ) ;
                $s1 = strtotime ( '-4 day' , strtotime ($comienzo) ) ;
                $s2 = strtotime ( '-3 day' , strtotime ($comienzo) ) ;
                $s3 = strtotime ( '-2 day' , strtotime ($comienzo) ) ; 
                $s4 = strtotime ( '-1 day' , strtotime ($comienzo) ) ;
                $s5 = strtotime ( '+0 day' , strtotime ($comienzo) ) ;
                $s6 = strtotime ( '+1 day' , strtotime ($comienzo) ) ;
            }else{
                $s0 = strtotime ( '-6 day' , strtotime ($comienzo) ) ;
                $s1 = strtotime ( '-5 day' , strtotime ($comienzo) ) ;
                $s2 = strtotime ( '-4 day' , strtotime ($comienzo) ) ;
                $s3 = strtotime ( '-3 day' , strtotime ($comienzo) ) ; 
                $s4 = strtotime ( '-2 day' , strtotime ($comienzo) ) ;
                $s5 = strtotime ( '-1 day' , strtotime ($comienzo) ) ;
                $s6 = strtotime ( '+0 day' , strtotime ($comienzo) ) ;
            }
        }else{
            $s0 = strtotime ( '+0 day' , strtotime ($comienzo) ) ;
            $s1 = strtotime ( '+1 day' , strtotime ($comienzo) ) ;
            $s2 = strtotime ( '+2 day' , strtotime ($comienzo) ) ;
            $s3 = strtotime ( '+3 day' , strtotime ($comienzo) ) ; 
            $s4 = strtotime ( '+4 day' , strtotime ($comienzo) ) ;
            $s5 = strtotime ( '+5 day' , strtotime ($comienzo) ) ;
            $s6 = strtotime ( '+6 day' , strtotime ($comienzo) ) ;
        }
        
        $d0 = date("d", $s0); $d0 = intval($d0); 
        $d1 = date("d", $s1); $d1 = intval($d1);
        $d2 = date("d", $s2); $d2 = intval($d2);
        $d3 = date("d", $s3); $d3 = intval($d3);
        $d4 = date("d", $s4); $d4 = intval($d4);
        $d5 = date("d", $s5); $d5 = intval($d5);
        $d6 = date("d", $s6); $d6 = intval($d6);
        
        $m0 = date("m", $s0); $m0 = intval($m0); 
        $m1 = date("m", $s1); $m1 = intval($m1);
        $m2 = date("m", $s2); $m2 = intval($m2);
        $m3 = date("m", $s3); $m3 = intval($m3);
        $m4 = date("m", $s4); $m4 = intval($m4);
        $m5 = date("m", $s5); $m5 = intval($m5);
        $m6 = date("m", $s6); $m6 = intval($m6);
        
        $s0 = date ( 'Y-m-d' , $s0 );
        $s1 = date ( 'Y-m-d' , $s1 );
        $s2 = date ( 'Y-m-d' , $s2 );
        $s3 = date ( 'Y-m-d' , $s3 );
        $s4 = date ( 'Y-m-d' , $s4 );
        $s5 = date ( 'Y-m-d' , $s5 );
        $s6 = date ( 'Y-m-d' , $s6 );
        
        /*----------  SETEO DE VALORES  ----------*/
        $mananaf0 = ''; $tardef0 = ''; $mananat0 = ''; $tardet0 = ''; 
        $mananaf1 = ''; $tardef1 = ''; $mananat1 = ''; $tardet1 = ''; 
        $mananaf2 = ''; $tardef2 = ''; $mananat2 = ''; $tardet2 = ''; 
        $mananaf3 = ''; $tardef3 = ''; $mananat3 = ''; $tardet3 = ''; 
        $mananaf4 = ''; $tardef4 = ''; $mananat4 = ''; $tardet4 = ''; 
        $mananaf5 = ''; $tardef5 = ''; $mananat5 = ''; $tardet5 = ''; 
        $mananaf6 = ''; $tardef6 = ''; $mananat6 = ''; $tardet6 = ''; 
        
        $tiempo1m0 = ''; $tiempo2m0 = ''; $tiempo1t0 = ''; $tiempo2t0 = ''; 
        $tiempo1m1 = ''; $tiempo2m1 = ''; $tiempo1t1 = ''; $tiempo2t1 = ''; 
        $tiempo1m2 = ''; $tiempo2m2 = ''; $tiempo1t2 = ''; $tiempo2t2 = ''; 
        $tiempo1m3 = ''; $tiempo2m3 = ''; $tiempo1t3 = ''; $tiempo2t3 = ''; 
        $tiempo1m4 = ''; $tiempo2m4 = ''; $tiempo1t4 = ''; $tiempo2t4 = ''; 
        $tiempo1m5 = ''; $tiempo2m5 = ''; $tiempo1t5 = ''; $tiempo2t5 = ''; 
        $tiempo1m6 = ''; $tiempo2m6 = ''; $tiempo1t6 = ''; $tiempo2t6 = ''; 
    
        $horam0 = '10:00'; $horat0 = '10:00';
        $horam1 = '10:00'; $horat1 = '10:00';
        $horam2 = '10:00'; $horat2 = '10:00';
        $horam3 = '10:00'; $horat3 = '10:00';
        $horam4 = '10:00'; $horat4 = '10:00';
        $horam5 = '10:00'; $horat5 = '10:00';
        $horam6 = '10:00'; $horat6 = '10:00';
        
        $subtiempom0 = ''; $subtiempot0 = '';
        $subtiempom1 = ''; $subtiempot1 = '';
        $subtiempom2 = ''; $subtiempot2 = '';
        $subtiempom3 = ''; $subtiempot3 = '';
        $subtiempom4 = ''; $subtiempot4 = '';
        $subtiempom5 = ''; $subtiempot5 = '';
        $subtiempom6 = ''; $subtiempot6 = '';
        
        $tiempoTotalm0 = ''; $tiempoTotalt0 = '';
        $tiempoTotalm1 = ''; $tiempoTotalt1 = '';
        $tiempoTotalm2 = ''; $tiempoTotalt2 = '';
        $tiempoTotalm3 = ''; $tiempoTotalt3 = '';
        $tiempoTotalm4 = ''; $tiempoTotalt4 = '';
        $tiempoTotalm5 = ''; $tiempoTotalt5 = '';
        $tiempoTotalm6 = ''; $tiempoTotalt6 = '';
        
        $finalm0 = ''; $finalt0 = '';
        $finalm1 = ''; $finalt1 = '';
        $finalm2 = ''; $finalt2 = '';
        $finalm3 = ''; $finalt3 = '';
        $finalm4 = ''; $finalt4 = '';
        $finalm5 = ''; $finalt5 = '';
        $finalm6 = ''; $finalt6 = '';
        /*----------  FIN DE SETEO  ----------*/
        
        for ($k=0; $k < count($c_semana); $k++) {
            $ff = $c_semana[$k]['dia_semana'];
            // CONDICIONALES
            if ($c_semana[$k]['horario_semana'] == 0) {
              if ($c_semana[$k]['categoria_semana'] == 0) {
                if 		($ff == $s0) { $mananaf0 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s1) { $mananaf1 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s2) { $mananaf2 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s3) { $mananaf3 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s4) { $mananaf4 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s5) { $mananaf5 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s6) { $mananaf6 = nl2br($c_semana[$k]['descripcion_semana']);}
              }else{
                if 		($ff == $s0) { $mananat0 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s1) { $mananat1 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s2) { $mananat2 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s3) { $mananat3 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s4) { $mananat4 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s5) { $mananat5 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s6) { $mananat6 = nl2br($c_semana[$k]['descripcion_semana']);}
              }
            }else{
              if ($c_semana[$k]['categoria_semana'] == 0) {
                if 		($ff == $s0) { $tardef0 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s1) { $tardef1 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s2) { $tardef2 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s3) { $tardef3 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s4) { $tardef4 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s5) { $tardef5 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s6) { $tardef6 = nl2br($c_semana[$k]['descripcion_semana']);}
              }else{
                if 		($ff == $s0) { $tardet0 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s1) { $tardet1 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s2) { $tardet2 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s3) { $tardet3 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s4) { $tardet4 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s5) { $tardet5 = nl2br($c_semana[$k]['descripcion_semana']);}
                else if ($ff == $s6) { $tardet6 = nl2br($c_semana[$k]['descripcion_semana']);}
              }
            }
        }//FIN FOR
        
        for ($u=0; $u < count($c_info); $u++) {
            $ff = $c_info[$u]['fecha_info'];
            
            // CONDICIONALES
            if ($c_info[$u]['numero_info'] == 0) {
              if ($c_info[$u]['tipo_info'] == 5) {
                if 		($ff == $s0) { $horam0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $horam1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $horam2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $horam3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $horam4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $horam5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $horam6 = utf8_decode($c_info[$u]['contenido_info']);}
              }else if ($c_info[$u]['tipo_info'] == 4) {
                if 		($ff == $s0) { $tiempoTotalm0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $tiempoTotalm1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $tiempoTotalm2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $tiempoTotalm3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $tiempoTotalm4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $tiempoTotalm5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $tiempoTotalm6 = utf8_decode($c_info[$u]['contenido_info']);}
              }else if ($c_info[$u]['tipo_info'] == 3) {
                if 		($ff == $s0) { $subtiempom0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $subtiempom1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $subtiempom2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $subtiempom3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $subtiempom4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $subtiempom5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $subtiempom6 = utf8_decode($c_info[$u]['contenido_info']);}
              }else if ($c_info[$u]['tipo_info'] == 2) {
                if 		($ff == $s0) { if ($c_semana_info[$k]['contenido_info'] != '') $finalm0 = nl2br($c_info[$u]['contenido_info']); else $finalm0 = '<span class="grist">'.$finalm0.'</span>'; }
                else if ($ff == $s1) { if ($c_semana_info[$k]['contenido_info'] != '') $finalm1 = nl2br($c_info[$u]['contenido_info']); else $finalm1 = '<span class="grist">'.$finalm1.'</span>'; }
                else if ($ff == $s2) { if ($c_semana_info[$k]['contenido_info'] != '') $finalm2 = nl2br($c_info[$u]['contenido_info']); else $finalm2 = '<span class="grist">'.$finalm2.'</span>'; }
                else if ($ff == $s3) { if ($c_semana_info[$k]['contenido_info'] != '') $finalm3 = nl2br($c_info[$u]['contenido_info']); else $finalm3 = '<span class="grist">'.$finalm3.'</span>'; }
                else if ($ff == $s4) { if ($c_semana_info[$k]['contenido_info'] != '') $finalm4 = nl2br($c_info[$u]['contenido_info']); else $finalm4 = '<span class="grist">'.$finalm4.'</span>'; }
                else if ($ff == $s5) { if ($c_semana_info[$k]['contenido_info'] != '') $finalm5 = nl2br($c_info[$u]['contenido_info']); else $finalm5 = '<span class="grist">'.$finalm5.'</span>'; }
                else if ($ff == $s6) { if ($c_semana_info[$k]['contenido_info'] != '') $finalm6 = nl2br($c_info[$u]['contenido_info']); else $finalm6 = '<span class="grist">'.$finalm6.'</span>'; }
              }else if ($c_info[$u]['tipo_info'] == 1) {
                if 		($ff == $s0) { $tiempo1m0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $tiempo1m1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $tiempo1m2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $tiempo1m3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $tiempo1m4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $tiempo1m5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $tiempo1m6 = utf8_decode($c_info[$u]['contenido_info']);}
              }else if ($c_info[$u]['tipo_info'] == 6) {
                if 		($ff == $s0) { if ($c_semana_info[$k]['contenido_info'] != '') $mananaf0 = nl2br($c_info[$u]['contenido_info']); else $mananaf0 = '<span class="grist">'.$mananaf0.'</span>'; }
                else if ($ff == $s1) { if ($c_semana_info[$k]['contenido_info'] != '') $mananaf1 = nl2br($c_info[$u]['contenido_info']); else $mananaf1 = '<span class="grist">'.$mananaf1.'</span>'; }
                else if ($ff == $s2) { if ($c_semana_info[$k]['contenido_info'] != '') $mananaf2 = nl2br($c_info[$u]['contenido_info']); else $mananaf2 = '<span class="grist">'.$mananaf2.'</span>'; }
                else if ($ff == $s3) { if ($c_semana_info[$k]['contenido_info'] != '') $mananaf3 = nl2br($c_info[$u]['contenido_info']); else $mananaf3 = '<span class="grist">'.$mananaf3.'</span>'; }
                else if ($ff == $s4) { if ($c_semana_info[$k]['contenido_info'] != '') $mananaf4 = nl2br($c_info[$u]['contenido_info']); else $mananaf4 = '<span class="grist">'.$mananaf4.'</span>'; }
                else if ($ff == $s5) { if ($c_semana_info[$k]['contenido_info'] != '') $mananaf5 = nl2br($c_info[$u]['contenido_info']); else $mananaf5 = '<span class="grist">'.$mananaf5.'</span>'; }
                else if ($ff == $s6) { if ($c_semana_info[$k]['contenido_info'] != '') $mananaf6 = nl2br($c_info[$u]['contenido_info']); else $mananaf6 = '<span class="grist">'.$mananaf6.'</span>'; }
              }else{
                if 		($ff == $s0) { if ($c_semana_info[$k]['contenido_info'] != '') $mananat0 = nl2br($c_info[$u]['contenido_info']); else $mananat0 = '<span class="grist">'.$mananat0.'</span>'; }
                else if ($ff == $s1) { if ($c_semana_info[$k]['contenido_info'] != '') $mananat1 = nl2br($c_info[$u]['contenido_info']); else $mananat1 = '<span class="grist">'.$mananat1.'</span>'; }
                else if ($ff == $s2) { if ($c_semana_info[$k]['contenido_info'] != '') $mananat2 = nl2br($c_info[$u]['contenido_info']); else $mananat2 = '<span class="grist">'.$mananat2.'</span>'; }
                else if ($ff == $s3) { if ($c_semana_info[$k]['contenido_info'] != '') $mananat3 = nl2br($c_info[$u]['contenido_info']); else $mananat3 = '<span class="grist">'.$mananat3.'</span>'; }
                else if ($ff == $s4) { if ($c_semana_info[$k]['contenido_info'] != '') $mananat4 = nl2br($c_info[$u]['contenido_info']); else $mananat4 = '<span class="grist">'.$mananat4.'</span>'; }
                else if ($ff == $s5) { if ($c_semana_info[$k]['contenido_info'] != '') $mananat5 = nl2br($c_info[$u]['contenido_info']); else $mananat5 = '<span class="grist">'.$mananat5.'</span>'; }
                else if ($ff == $s6) { if ($c_semana_info[$k]['contenido_info'] != '') $mananat6 = nl2br($c_info[$u]['contenido_info']); else $mananat6 = '<span class="grist">'.$mananat6.'</span>'; }
              }
            }else if ($c_info[$u]['numero_info'] == 2) {
              if ($c_info[$u]['tipo_info'] == 1) {
                if 		($ff == $s0) { $tiempo1t0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $tiempo1t1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $tiempo1t2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $tiempo1t3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $tiempo1t4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $tiempo1t5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $tiempo1t6 = utf8_decode($c_info[$u]['contenido_info']);}
              }
            }else if ($c_info[$u]['numero_info'] == 3) {
              if ($c_info[$u]['tipo_info'] == 1) {
                if 		($ff == $s0) { $tiempo2t0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $tiempo2t1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $tiempo2t2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $tiempo2t3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $tiempo2t4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $tiempo2t5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $tiempo2t6 = utf8_decode($c_info[$u]['contenido_info']);}
              }
            }else{
              if ($c_info[$u]['tipo_info'] == 5) {
                if 		($ff == $s0) { $horat0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $horat1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $horat2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $horat3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $horat4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $horat5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $horat6 = utf8_decode($c_info[$u]['contenido_info']);}
              }else if ($c_info[$u]['tipo_info'] == 4) {
                if 		($ff == $s0) { $tiempoTotalt0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $tiempoTotalt1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $tiempoTotalt2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $tiempoTotalt3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $tiempoTotalt4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $tiempoTotalt5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $tiempoTotalt6 = utf8_decode($c_info[$u]['contenido_info']);}
              }else if ($c_info[$u]['tipo_info'] == 3) {
                if 		($ff == $s0) { $subtiempot0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $subtiempot1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $subtiempot2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $subtiempot3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $subtiempot4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $subtiempot5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $subtiempot6 = utf8_decode($c_info[$u]['contenido_info']);}
              }else if ($c_info[$u]['tipo_info'] == 2) {
                if 		($ff == $s0) { if ($c_semana_info[$k]['contenido_info'] != '') $finalt0 = nl2br($c_info[$u]['contenido_info']); else $finalt0 = '<span class="grist">'.$finalt0.'</span>'; }
                else if ($ff == $s1) { if ($c_semana_info[$k]['contenido_info'] != '') $finalt1 = nl2br($c_info[$u]['contenido_info']); else $finalt1 = '<span class="grist">'.$finalt1.'</span>'; }
                else if ($ff == $s2) { if ($c_semana_info[$k]['contenido_info'] != '') $finalt2 = nl2br($c_info[$u]['contenido_info']); else $finalt2 = '<span class="grist">'.$finalt2.'</span>'; }
                else if ($ff == $s3) { if ($c_semana_info[$k]['contenido_info'] != '') $finalt3 = nl2br($c_info[$u]['contenido_info']); else $finalt3 = '<span class="grist">'.$finalt3.'</span>'; }
                else if ($ff == $s4) { if ($c_semana_info[$k]['contenido_info'] != '') $finalt4 = nl2br($c_info[$u]['contenido_info']); else $finalt4 = '<span class="grist">'.$finalt4.'</span>'; }
                else if ($ff == $s5) { if ($c_semana_info[$k]['contenido_info'] != '') $finalt5 = nl2br($c_info[$u]['contenido_info']); else $finalt5 = '<span class="grist">'.$finalt5.'</span>'; }
                else if ($ff == $s6) { if ($c_semana_info[$k]['contenido_info'] != '') $finalt6 = nl2br($c_info[$u]['contenido_info']); else $finalt6 = '<span class="grist">'.$finalt6.'</span>'; }
              }else if ($c_info[$u]['tipo_info'] == 1) {
                if 		($ff == $s0) { $tiempo2m0 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s1) { $tiempo2m1 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s2) { $tiempo2m2 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s3) { $tiempo2m3 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s4) { $tiempo2m4 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s5) { $tiempo2m5 = utf8_decode($c_info[$u]['contenido_info']);}
                else if ($ff == $s6) { $tiempo2m6 = utf8_decode($c_info[$u]['contenido_info']);}
              }else if ($c_info[$u]['tipo_info'] == 6) {
                if 		($ff == $s0) { if ($c_semana_info[$k]['contenido_info'] != '') $tardef0 = nl2br($c_info[$u]['contenido_info']); else $tardef0 = '<span class="grist">'.$tardef0.'</span>'; }
                else if ($ff == $s1) { if ($c_semana_info[$k]['contenido_info'] != '') $tardef1 = nl2br($c_info[$u]['contenido_info']); else $tardef1 = '<span class="grist">'.$tardef1.'</span>'; }
                else if ($ff == $s2) { if ($c_semana_info[$k]['contenido_info'] != '') $tardef2 = nl2br($c_info[$u]['contenido_info']); else $tardef2 = '<span class="grist">'.$tardef2.'</span>'; }
                else if ($ff == $s3) { if ($c_semana_info[$k]['contenido_info'] != '') $tardef3 = nl2br($c_info[$u]['contenido_info']); else $tardef3 = '<span class="grist">'.$tardef3.'</span>'; }
                else if ($ff == $s4) { if ($c_semana_info[$k]['contenido_info'] != '') $tardef4 = nl2br($c_info[$u]['contenido_info']); else $tardef4 = '<span class="grist">'.$tardef4.'</span>'; }
                else if ($ff == $s5) { if ($c_semana_info[$k]['contenido_info'] != '') $tardef5 = nl2br($c_info[$u]['contenido_info']); else $tardef5 = '<span class="grist">'.$tardef5.'</span>'; }
                else if ($ff == $s6) { if ($c_semana_info[$k]['contenido_info'] != '') $tardef6 = nl2br($c_info[$u]['contenido_info']); else $tardef6 = '<span class="grist">'.$tardef6.'</span>'; }
              }else{
                if 		($ff == $s0) { if ($c_semana_info[$k]['contenido_info'] != '') $tardet0 = nl2br($c_info[$u]['contenido_info']); else $tardet0 = '<span class="grist">'.$tardet0.'</span>'; }
                else if ($ff == $s1) { if ($c_semana_info[$k]['contenido_info'] != '') $tardet1 = nl2br($c_info[$u]['contenido_info']); else $tardet1 = '<span class="grist">'.$tardet1.'</span>'; }
                else if ($ff == $s2) { if ($c_semana_info[$k]['contenido_info'] != '') $tardet2 = nl2br($c_info[$u]['contenido_info']); else $tardet2 = '<span class="grist">'.$tardet2.'</span>'; }
                else if ($ff == $s3) { if ($c_semana_info[$k]['contenido_info'] != '') $tardet3 = nl2br($c_info[$u]['contenido_info']); else $tardet3 = '<span class="grist">'.$tardet3.'</span>'; }
                else if ($ff == $s4) { if ($c_semana_info[$k]['contenido_info'] != '') $tardet4 = nl2br($c_info[$u]['contenido_info']); else $tardet4 = '<span class="grist">'.$tardet4.'</span>'; }
                else if ($ff == $s5) { if ($c_semana_info[$k]['contenido_info'] != '') $tardet5 = nl2br($c_info[$u]['contenido_info']); else $tardet5 = '<span class="grist">'.$tardet5.'</span>'; }
                else if ($ff == $s6) { if ($c_semana_info[$k]['contenido_info'] != '') $tardet6 = nl2br($c_info[$u]['contenido_info']); else $tardet6 = '<span class="grist">'.$tardet6.'</span>'; }
              }
            }
        }//FIN FOR
        
        /*==================================
        =            HTML PRINT            =
        ==================================*/
        $data.='
        <div style="page-break-after:always;"></div>
        
        <table color="black" class="tg">
          <tr>
            <th class="dia tginit txCenter tg-0pky tx14" rowspan="2">DÍA</th>
            <th class="diasSemana txCenter tg-0pky tx10">LUNES</th>
            <th class="diasSemana txCenter tg-0pky tx10">MARTES</th>
            <th class="diasSemana txCenter tg-0pky tx10">MIERCOLES</th>
            <th class="diasSemana txCenter tg-0pky tx10">JUEVES</th>
            <th class="diasSemana txCenter tg-0pky tx10">VIERNES</th>
            <th class="diasSemana txCenter tg-0pky tx10">SABADO</th>
            <th class="diasSemana txCenter tg-0pky tx10">DOMINGO</th>
          </tr>
          <tr class="tx12">
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d0.'</b><b class="tx12">'.$months[$m0].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d1.'</b><b class="tx12">'.$months[$m1].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d2.'</b><b class="tx12">'.$months[$m2].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d3.'</b><b class="tx12">'.$months[$m3].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d4.'</b><b class="tx12">'.$months[$m4].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d5.'</b><b class="tx12">'.$months[$m5].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d6.'</b><b class="tx12">'.$months[$m6].'</b></td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Jornada</td>
            <td class="txCenter tg-0pky grises">MAÑANA</td>
            <td class="txCenter tg-0pky grises">MAÑANA</td>
            <td class="txCenter tg-0pky grises">MAÑANA</td>
            <td class="txCenter tg-0pky grises">MAÑANA</td>
            <td class="txCenter tg-0pky grises">MAÑANA</td>
            <td class="txCenter tg-0pky grises">MAÑANA</td>
            <td class="txCenter tg-0pky grises">MAÑANA</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Hora</td>
            <td class="txCenter tg-0pky grises"><span id="m_hora1">'.$horam0.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="m_hora2">'.$horam1.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="m_hora3">'.$horam2.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="m_hora4">'.$horam3.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="m_hora5">'.$horam4.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="m_hora6">'.$horam5.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="m_hora7">'.$horam6.'</span> Hrs</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky lateralMenu"><div class="rotate">FÍSICO</div></td>
            <td class="txLeft tg-0pky" id="m_fisico1">'.$mananaf0.'</td>
            <td class="txLeft tg-0pky" id="m_fisico2">'.$mananaf1.'</td>
            <td class="txLeft tg-0pky" id="m_fisico3">'.$mananaf2.'</td>
            <td class="txLeft tg-0pky" id="m_fisico4">'.$mananaf3.'</td>
            <td class="txLeft tg-0pky" id="m_fisico5">'.$mananaf4.'</td>
            <td class="txLeft tg-0pky" id="m_fisico6">'.$mananaf5.'</td>
            <td class="txLeft tg-0pky" id="m_fisico7">'.$mananaf6.'</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Tiempo</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempo1">'.$tiempo1m0.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempo2">'.$tiempo1m1.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempo3">'.$tiempo1m2.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempo4">'.$tiempo1m3.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempo5">'.$tiempo1m4.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempo6">'.$tiempo1m5.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempo7">'.$tiempo1m6.'</span> Min</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky lateralMenu"><div class="rotate">TÉCNICO TÁCTICO</div></td>
            <td class="txLeft tg-0pky" id="m_tecnico1">'.$mananat0.'</td>
            <td class="txLeft tg-0pky" id="m_tecnico2">'.$mananat1.'</td>
            <td class="txLeft tg-0pky" id="m_tecnico3">'.$mananat2.'</td>
            <td class="txLeft tg-0pky" id="m_tecnico4">'.$mananat3.'</td>
            <td class="txLeft tg-0pky" id="m_tecnico5">'.$mananat4.'</td>
            <td class="txLeft tg-0pky" id="m_tecnico6">'.$mananat5.'</td>
            <td class="txLeft tg-0pky" id="m_tecnico7">'.$mananat6.'</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Tiempo</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempoo1">'.$tiempo2m0.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempoo2">'.$tiempo2m1.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempoo3">'.$tiempo2m2.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempoo4">'.$tiempo2m3.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempoo5">'.$tiempo2m4.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempoo6">'.$tiempo2m5.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="m_tiempoo7">'.$tiempo2m6.'</span> Min</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky lateralMenu2">Final</td>
            <td class="txCenter tg-0pky rojos" id="m_final1">'.$finalm0.'</td>
            <td class="txCenter tg-0pky rojos" id="m_final2">'.$finalm1.'</td>
            <td class="txCenter tg-0pky rojos" id="m_final3">'.$finalm2.'</td>
            <td class="txCenter tg-0pky rojos" id="m_final4">'.$finalm3.'</td>
            <td class="txCenter tg-0pky rojos" id="m_final5">'.$finalm4.'</td>
            <td class="txCenter tg-0pky rojos" id="m_final6">'.$finalm5.'</td>
            <td class="txCenter tg-0pky rojos" id="m_final7">'.$finalm6.'</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Tiempo</td>
            <td class="txCenter tg-0pky grises" id="m_tiempooo1">'.$subtiempom0.'</td>
            <td class="txCenter tg-0pky grises" id="m_tiempooo2">'.$subtiempom1.'</td>
            <td class="txCenter tg-0pky grises" id="m_tiempooo3">'.$subtiempom2.'</td>
            <td class="txCenter tg-0pky grises" id="m_tiempooo4">'.$subtiempom3.'</td>
            <td class="txCenter tg-0pky grises" id="m_tiempooo5">'.$subtiempom4.'</td>
            <td class="txCenter tg-0pky grises" id="m_tiempooo6">'.$subtiempom5.'</td>
            <td class="txCenter tg-0pky grises" id="m_tiempooo7">'.$subtiempom6.'</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky lateralMenu3">Tiempo Total</td>
            <td class="txCenter tg-0pky rojos" id="m_tiempot1">'.$tiempoTotalm0.'</td>
            <td class="txCenter tg-0pky rojos" id="m_tiempot2">'.$tiempoTotalm1.'</td>
            <td class="txCenter tg-0pky rojos" id="m_tiempot3">'.$tiempoTotalm2.'</td>
            <td class="txCenter tg-0pky rojos" id="m_tiempot4">'.$tiempoTotalm3.'</td>
            <td class="txCenter tg-0pky rojos" id="m_tiempot5">'.$tiempoTotalm4.'</td>
            <td class="txCenter tg-0pky rojos" id="m_tiempot6">'.$tiempoTotalm5.'</td>
            <td class="txCenter tg-0pky rojos" id="m_tiempot7">'.$tiempoTotalm6.'</td>
          </tr>
        </table>
        
        <div style="page-break-after:always;"></div>
        
        <table color="black" class="tg">
          <tr>
            <th class="dia tginit txCenter tg-0pky tx14" rowspan="2">DÍA</th>
            <th class="diasSemana txCenter tg-0pky tx10">LUNES</th>
            <th class="diasSemana txCenter tg-0pky tx10">MARTES</th>
            <th class="diasSemana txCenter tg-0pky tx10">MIERCOLES</th>
            <th class="diasSemana txCenter tg-0pky tx10">JUEVES</th>
            <th class="diasSemana txCenter tg-0pky tx10">VIERNES</th>
            <th class="diasSemana txCenter tg-0pky tx10">SABADO</th>
            <th class="diasSemana txCenter tg-0pky tx10">DOMINGO</th>
          </tr>
          <tr class="tx12">
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d0.'</b><b class="tx12">'.$months[$m0].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d1.'</b><b class="tx12">'.$months[$m1].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d2.'</b><b class="tx12">'.$months[$m2].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d3.'</b><b class="tx12">'.$months[$m3].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d4.'</b><b class="tx12">'.$months[$m4].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d5.'</b><b class="tx12">'.$months[$m5].'</b></td>
            <td class="txCenter tg-0pky grisesOscuro"><b class="tx18">'.$d6.'</b><b class="tx12">'.$months[$m6].'</b></td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Jornada</td>
            <td class="txCenter tg-0pky grises">TARDE</td>
            <td class="txCenter tg-0pky grises">TARDE</td>
            <td class="txCenter tg-0pky grises">TARDE</td>
            <td class="txCenter tg-0pky grises">TARDE</td>
            <td class="txCenter tg-0pky grises">TARDE</td>
            <td class="txCenter tg-0pky grises">TARDE</td>
            <td class="txCenter tg-0pky grises">TARDE</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Hora</td>
            <td class="txCenter tg-0pky grises"><span id="t_hora1">'.$horat0.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="t_hora2">'.$horat1.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="t_hora3">'.$horat2.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="t_hora4">'.$horat3.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="t_hora5">'.$horat4.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="t_hora6">'.$horat5.'</span> Hrs</td>
            <td class="txCenter tg-0pky grises"><span id="t_hora7">'.$horat6.'</span> Hrs</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky lateralMenu"><div class="rotate">FÍSICO</div></td>
            <td class="txLeft tg-0pky" id="t_fisico1">'.$tardef0.'</td>
            <td class="txLeft tg-0pky" id="t_fisico2">'.$tardef1.'</td>
            <td class="txLeft tg-0pky" id="t_fisico3">'.$tardef2.'</td>
            <td class="txLeft tg-0pky" id="t_fisico4">'.$tardef3.'</td>
            <td class="txLeft tg-0pky" id="t_fisico5">'.$tardef4.'</td>
            <td class="txLeft tg-0pky" id="t_fisico6">'.$tardef5.'</td>
            <td class="txLeft tg-0pky" id="t_fisico7">'.$tardef6.'</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Tiempo</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempo1">'.$tiempo1t0.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempo2">'.$tiempo1t1.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempo3">'.$tiempo1t2.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempo4">'.$tiempo1t3.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempo5">'.$tiempo1t4.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempo6">'.$tiempo1t5.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempo7">'.$tiempo1t6.'</span> Min</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky lateralMenu"><div class="rotate">TÉCNICO TÁCTICO</div></td>
            <td class="txLeft tg-0pky" id="t_tecnico1">'.$tardet0.'</td>
            <td class="txLeft tg-0pky" id="t_tecnico2">'.$tardet1.'</td>
            <td class="txLeft tg-0pky" id="t_tecnico3">'.$tardet2.'</td>
            <td class="txLeft tg-0pky" id="t_tecnico4">'.$tardet3.'</td>
            <td class="txLeft tg-0pky" id="t_tecnico5">'.$tardet4.'</td>
            <td class="txLeft tg-0pky" id="t_tecnico6">'.$tardet5.'</td>
            <td class="txLeft tg-0pky" id="t_tecnico7">'.$tardet6.'</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Tiempo</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempoo1">'.$tiempo2t0.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempoo2">'.$tiempo2t1.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempoo3">'.$tiempo2t2.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempoo4">'.$tiempo2t3.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempoo5">'.$tiempo2t4.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempoo6">'.$tiempo2t5.'</span> Min</td>
            <td class="txCenter tg-0pky grises"><span id="t_tiempoo7">'.$tiempo2t6.'</span> Min</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky lateralMenu2">Final</td>
            <td class="txCenter tg-0pky rojos" id="t_final1">'.$finalt0.'</td>
            <td class="txCenter tg-0pky rojos" id="t_final2">'.$finalt1.'</td>
            <td class="txCenter tg-0pky rojos" id="t_final3">'.$finalt2.'</td>
            <td class="txCenter tg-0pky rojos" id="t_final4">'.$finalt3.'</td>
            <td class="txCenter tg-0pky rojos" id="t_final5">'.$finalt4.'</td>
            <td class="txCenter tg-0pky rojos" id="t_final6">'.$finalt5.'</td>
            <td class="txCenter tg-0pky rojos" id="t_final7">'.$finalt6.'</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky grises">Tiempo</td>
            <td class="txCenter tg-0pky grises" id="t_tiempooo1">'.$subtiempot0.'</td>
            <td class="txCenter tg-0pky grises" id="t_tiempooo2">'.$subtiempot1.'</td>
            <td class="txCenter tg-0pky grises" id="t_tiempooo3">'.$subtiempot2.'</td>
            <td class="txCenter tg-0pky grises" id="t_tiempooo4">'.$subtiempot3.'</td>
            <td class="txCenter tg-0pky grises" id="t_tiempooo5">'.$subtiempot4.'</td>
            <td class="txCenter tg-0pky grises" id="t_tiempooo6">'.$subtiempot5.'</td>
            <td class="txCenter tg-0pky grises" id="t_tiempooo7">'.$subtiempot6.'</td>
          </tr>
          <tr class="tx12">
            <td class="tginit txCenter tg-0pky lateralMenu3">Tiempo Total</td>
            <td class="txCenter tg-0pky rojos" id="t_tiempot1">'.$tiempoTotalt0.'</td>
            <td class="txCenter tg-0pky rojos" id="t_tiempot2">'.$tiempoTotalt1.'</td>
            <td class="txCenter tg-0pky rojos" id="t_tiempot3">'.$tiempoTotalt2.'</td>
            <td class="txCenter tg-0pky rojos" id="t_tiempot4">'.$tiempoTotalt3.'</td>
            <td class="txCenter tg-0pky rojos" id="t_tiempot5">'.$tiempoTotalt4.'</td>
            <td class="txCenter tg-0pky rojos" id="t_tiempot6">'.$tiempoTotalt5.'</td>
            <td class="txCenter tg-0pky rojos" id="t_tiempot7">'.$tiempoTotalt6.'</td>
          </tr>
        </table>
        ';
        
        if ($i == 0) {
            if ($getget == 1) {
                $comienzo = strtotime ( '+7 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 2) {
                $comienzo = strtotime ( '+6 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 3) {
                $comienzo = strtotime ( '+5 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 4) {
                $comienzo = strtotime ( '+4 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 5) {
                $comienzo = strtotime ( '+3 day' , strtotime ($comienzo) ) ;
            }else if ($getget == 6) {
                $comienzo = strtotime ( '+2 day' , strtotime ($comienzo) ) ;
            }else{
                $comienzo = strtotime ( '+1 day' , strtotime ($comienzo) ) ;
            }
        } else {
            $comienzo = strtotime ( '+7 day' , strtotime ($comienzo) ) ;
        }
    }
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
$pdf->setPaper('letter', 'landscape');  //A4, letter  ;  portrait (posicion vertical; landscape (posici贸n horizontal))
$titulo_documento_salida = "[11Analytics]_microciclo.pdf";
/////////////////////////////////////////////////////////////////////////////////////////

$html='<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<style>
@font-face {
  font-family: "Helvetica";
}

.page_break {page-break-before:always; } 

.tg  {border-spacing:0; width: 100%; border: solid 1px black;}
.tg td, th {font-family: helvetica;border:solid 1px black;}
.tg td {border: black 1px solid; }
.tg .tg-0pky{padding: 3px;}

.txCenter{text-align:center;}
.txLeft{text-align:left;vertical-align: top;}

.rotate {transform: rotate(270deg);}
.tginit{width: 0px;}

.tx18{font-size: 18px;}
.tx16{font-size: 16px;}
.tx14{font-size: 14px;}
.tx12{font-size: 12px;}
.tx10{font-size: 10px;}
.tx8{font-size: 8px;}

.diasSemana{background-color: #D62A1C;color: white;font-weight: bold;}
.dia{background-color: #D62A1C;color: white;font-weight: bold;}
.lateralMenu{background-color: #D62A1C;color: white;font-weight: bold;height: 200px;}
.lateralMenu2{background-color: #D62A1C;color: white;font-weight: bold;height:50px;}
.lateralMenu3{background-color: #D62A1C;color: white;font-weight: bold;}

.grises{background-color: #eeeeee;color: black;}
.grisesOscuro{color: #595959;}
.rojos{background-color: #D62A1C;color: white;}
.verde { background: #28b779; }
.grist { color: #9C9C9C; }
.rojos .grist { color: #FF6D61; }

</style>
';

// $html.=$_POST['codigo_html'];
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