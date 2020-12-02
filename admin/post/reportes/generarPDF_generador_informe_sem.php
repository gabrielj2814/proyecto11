<?php 

$data='';
include('../../../bd/calendario_BD.php');

$months = ['All','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

$inicial = $_POST['inicio'];
$final = $_POST['fin'];
$comienzo = $inicial;

$anoF = intval(substr($final, 0, 4));
$mesF = intval(substr($final, 5, 2));
$diaF = intval(substr($final, 8, 2));

$datetime1  = new DateTime($inicial);
$datetime2  = new DateTime($final);
$interval   = $datetime1->diff($datetime2);
$semanas    = floor(($interval->format('%a') / 7));
$co_semanas = ($interval->format('%a') % 7);
if ($co_semanas > 0) { $semanas++; }

$c_semana = calendario_semana2($_POST);
$c_semana_info = calendario_informacion($_POST);
$series = ver_series_total();

$fecha_inicio = substr($_POST['inicio'],8,2).' '.$months[intval(substr($_POST['inicio'],5,2))].' '.substr($_POST['inicio'],0,4);
$fecha_fin = substr($_POST['fin'],8,2).' '.$months[intval(substr($_POST['fin'],5,2))].' '.substr($_POST['fin'],0,4);

for ($i = 0; $i <= $semanas; $i++) { 
    if ($i != 0) {
        $comienzo = date ('Y-m-d', $comienzo);
    }

    $_POST['inicio'] = $comienzo;
    $_POST['fin'] = strtotime ('+7 day', strtotime ($comienzo) ) ;
    $_POST['fin'] = date ('Y-m-d', $_POST['fin']);
    
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
            $getget = date ('w' , strtotime($comienzo));
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
        $mananaf0 = ''; $tardef0 = ''; $mananat0 = ''; $tardet0 = ''; $mananai0 = ''; $tardei0 = ''; 
        $mananaf1 = ''; $tardef1 = ''; $mananat1 = ''; $tardet1 = ''; $mananai1 = ''; $tardei1 = ''; 
        $mananaf2 = ''; $tardef2 = ''; $mananat2 = ''; $tardet2 = ''; $mananai2 = ''; $tardei2 = ''; 
        $mananaf3 = ''; $tardef3 = ''; $mananat3 = ''; $tardet3 = ''; $mananai3 = ''; $tardei3 = ''; 
        $mananaf4 = ''; $tardef4 = ''; $mananat4 = ''; $tardet4 = ''; $mananai4 = ''; $tardei4 = ''; 
        $mananaf5 = ''; $tardef5 = ''; $mananat5 = ''; $tardet5 = ''; $mananai5 = ''; $tardei5 = ''; 
        $mananaf6 = ''; $tardef6 = ''; $mananat6 = ''; $tardet6 = ''; $mananai6 = ''; $tardei6 = ''; 
        
        $tiempo1m0 = ''; $tiempo2m0 = ''; $tiempo3m0 = ''; $tiempo1t0 = ''; $tiempo2t0 = ''; $tiempo3t0 = ''; 
        $tiempo1m1 = ''; $tiempo2m1 = ''; $tiempo3m1 = ''; $tiempo1t1 = ''; $tiempo2t1 = ''; $tiempo3t1 = ''; 
        $tiempo1m2 = ''; $tiempo2m2 = ''; $tiempo3m2 = ''; $tiempo1t2 = ''; $tiempo2t2 = ''; $tiempo3t2 = ''; 
        $tiempo1m3 = ''; $tiempo2m3 = ''; $tiempo3m3 = ''; $tiempo1t3 = ''; $tiempo2t3 = ''; $tiempo3t3 = ''; 
        $tiempo1m4 = ''; $tiempo2m4 = ''; $tiempo3m4 = ''; $tiempo1t4 = ''; $tiempo2t4 = ''; $tiempo3t4 = ''; 
        $tiempo1m5 = ''; $tiempo2m5 = ''; $tiempo3m5 = ''; $tiempo1t5 = ''; $tiempo2t5 = ''; $tiempo3t5 = ''; 
        $tiempo1m6 = ''; $tiempo2m6 = ''; $tiempo3m6 = ''; $tiempo1t6 = ''; $tiempo2t6 = ''; $tiempo3t6 = ''; 
        
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
                } else if ($c_semana[$k]['categoria_semana'] == 1) {
                    if 		($ff == $s0) { $mananat0 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s1) { $mananat1 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s2) { $mananat2 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s3) { $mananat3 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s4) { $mananat4 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s5) { $mananat5 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s6) { $mananat6 = nl2br($c_semana[$k]['descripcion_semana']);}
                } else if ($c_semana[$k]['categoria_semana'] == 7) {
                    if 		($ff == $s0) { $finalm0 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s1) { $finalm1 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s2) { $finalm2 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s3) { $finalm3 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s4) { $finalm4 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s5) { $finalm5 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s6) { $finalm6 = nl2br($c_semana[$k]['descripcion_semana']);}
                } else if ($c_semana[$k]['categoria_semana'] == 5) {
                    if 		($ff == $s0) { $horam0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $horam1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $horam2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $horam3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $horam4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $horam5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $horam6 = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 6) {
                    if 		($ff == $s0) { $tiempo1m0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $tiempo1m1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $tiempo1m2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $tiempo1m3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $tiempo1m4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $tiempo1m5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $tiempo1m6 = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 8) {
                    if 		($ff == $s0) { $subtiempom0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $subtiempom1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $subtiempom2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $subtiempom3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $subtiempom4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $subtiempom5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $subtiempom6 = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 9) {
                    if 		($ff == $s0) { $tiempoTotalm0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $tiempoTotalm1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $tiempoTotalm2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $tiempoTotalm3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $tiempoTotalm4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $tiempoTotalm5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $tiempoTotalm6 = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 2) {
                    if 		($ff == $s0) { $mananai0 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s1) { $mananai1 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s2) { $mananai2 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s3) { $mananai3 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s4) { $mananai4 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s5) { $mananai5 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s6) { $mananai6 = nl2br($c_semana[$k]['descripcion_semana']);}
                }
            } else if ($c_semana[$k]['horario_semana'] == 1) {
                if ($c_semana[$k]['categoria_semana'] == 0) {
                    if 		($ff == $s0) { $tardef0 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s1) { $tardef1 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s2) { $tardef2 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s3) { $tardef3 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s4) { $tardef4 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s5) { $tardef5 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s6) { $tardef6 = nl2br($c_semana[$k]['descripcion_semana']);}
                }else if ($c_semana[$k]['categoria_semana'] == 1){
                    if 		($ff == $s0) { $tardet0 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s1) { $tardet1 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s2) { $tardet2 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s3) { $tardet3 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s4) { $tardet4 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s5) { $tardet5 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s6) { $tardet6 = nl2br($c_semana[$k]['descripcion_semana']);}
                } else if ($c_semana[$k]['categoria_semana'] == 7) {
                    if 		($ff == $s0) { $finalt0 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s1) { $finalt1 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s2) { $finalt2 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s3) { $finalt3 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s4) { $finalt4 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s5) { $finalt5 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s6) { $finalt6 = nl2br($c_semana[$k]['descripcion_semana']);}
                } else if ($c_semana[$k]['categoria_semana'] == 5) {
                    if 		($ff == $s0) { $horat0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $horat1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $horat2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $horat3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $horat4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $horat5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $horat6 = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 6) {
                    if 		($ff == $s0) { $tiempo2m0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $tiempo2m1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $tiempo2m2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $tiempo2m3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $tiempo2m4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $tiempo2m5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $tiempo2m6 = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 8) {
                    if 		($ff == $s0) { $subtiempot0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $subtiempot1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $subtiempot2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $subtiempot3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $subtiempot4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $subtiempot5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $subtiempot6 = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 9) {
                    if 		($ff == $s0) { $tiempoTotalt0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $tiempoTotalt1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $tiempoTotalt2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $tiempoTotalt3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $tiempoTotalt4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $tiempoTotalt5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $tiempoTotalt6 = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 2) {
                    if 		($ff == $s0) { $tardei0 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s1) { $tardei1 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s2) { $tardei2 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s3) { $tardei3 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s4) { $tardei4 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s5) { $tardei5 = nl2br($c_semana[$k]['descripcion_semana']);}
                    else if ($ff == $s6) { $tardei6 = nl2br($c_semana[$k]['descripcion_semana']);}
                }
            } else if ($c_semana[$k]['horario_semana'] == 2) {
                if ($c_semana[$k]['categoria_semana'] == 6) {
                    if 		($ff == $s0) { $tiempo1t0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $tiempo1t1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $tiempo1t2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $tiempo1t3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $tiempo1t4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $tiempo1t5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $tiempo1t6 = $c_semana[$k]['descripcion_semana'];}
                }
            } else if ($c_semana[$k]['horario_semana'] == 3) {
                if ($c_semana[$k]['categoria_semana'] == 6) {
                    if 		($ff == $s0) { $tiempo2t0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $tiempo2t1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $tiempo2t2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $tiempo2t3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $tiempo2t4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $tiempo2t5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $tiempo2t6 = $c_semana[$k]['descripcion_semana'];}
                }
            } else if ($c_semana[$k]['horario_semana'] == 4) {
                if ($c_semana[$k]['categoria_semana'] == 6) {
                    if 		($ff == $s0) { $tiempo3m0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $tiempo3m1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $tiempo3m2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $tiempo3m3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $tiempo3m4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $tiempo3m5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $tiempo3m6 = $c_semana[$k]['descripcion_semana'];}
                }
            } else if ($c_semana[$k]['horario_semana'] == 5) {
                if ($c_semana[$k]['categoria_semana'] == 6) {
                    if 		($ff == $s0) { $tiempo3t0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $tiempo3t1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $tiempo3t2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $tiempo3t3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $tiempo3t4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $tiempo3t5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $tiempo3t6 = $c_semana[$k]['descripcion_semana'];}
                }
            }
        }
        
        
        for ($k=0; $k < count($c_semana_info); $k++) {
            $ff = $c_semana_info[$k]['dia_informe'];
            
            // CONDICIONALES
            if ($c_semana_info[$k]['horario_informe'] == 0) {
                if ($c_semana_info[$k]['categoria_informe'] == 0) {
                    if 		($ff == $s0) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananaf0 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananaf0 = '<span class="grist">'.$mananaf0.'</span>'; }
                    else if ($ff == $s1) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananaf1 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananaf1 = '<span class="grist">'.$mananaf1.'</span>'; }
                    else if ($ff == $s2) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananaf2 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananaf2 = '<span class="grist">'.$mananaf2.'</span>'; }
                    else if ($ff == $s3) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananaf3 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananaf3 = '<span class="grist">'.$mananaf3.'</span>'; }
                    else if ($ff == $s4) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananaf4 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananaf4 = '<span class="grist">'.$mananaf4.'</span>'; }
                    else if ($ff == $s5) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananaf5 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananaf5 = '<span class="grist">'.$mananaf5.'</span>'; }
                    else if ($ff == $s6) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananaf6 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananaf6 = '<span class="grist">'.$mananaf6.'</span>'; }
                } else if ($c_semana_info[$k]['categoria_informe'] == 1) {
                    if 		($ff == $s0) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananat0 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananat0 = '<span class="grist">'.$mananat0.'</span>'; }
                    else if ($ff == $s1) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananat1 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananat1 = '<span class="grist">'.$mananat1.'</span>'; }
                    else if ($ff == $s2) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananat2 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananat2 = '<span class="grist">'.$mananat2.'</span>'; }
                    else if ($ff == $s3) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananat3 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananat3 = '<span class="grist">'.$mananat3.'</span>'; }
                    else if ($ff == $s4) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananat4 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananat4 = '<span class="grist">'.$mananat4.'</span>'; }
                    else if ($ff == $s5) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananat5 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananat5 = '<span class="grist">'.$mananat5.'</span>'; }
                    else if ($ff == $s6) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananat6 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananat6 = '<span class="grist">'.$mananat6.'</span>'; }
                } else if ($c_semana_info[$k]['categoria_informe'] == 7) {
                    if 		($ff == $s0) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalm0 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalm0 = '<span class="grist">'.$finalm0.'</span>'; }
                    else if ($ff == $s1) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalm1 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalm1 = '<span class="grist">'.$finalm1.'</span>'; }
                    else if ($ff == $s2) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalm2 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalm2 = '<span class="grist">'.$finalm2.'</span>'; }
                    else if ($ff == $s3) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalm3 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalm3 = '<span class="grist">'.$finalm3.'</span>'; }
                    else if ($ff == $s4) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalm4 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalm4 = '<span class="grist">'.$finalm4.'</span>'; }
                    else if ($ff == $s5) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalm5 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalm5 = '<span class="grist">'.$finalm5.'</span>'; }
                    else if ($ff == $s6) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalm6 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalm6 = '<span class="grist">'.$finalm6.'</span>'; }
                } else if ($c_semana_info[$k]['categoria_informe'] == 5) {
                    if 		($ff == $s0) { $horam0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $horam1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $horam2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $horam3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $horam4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $horam5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $horam6 = $c_semana_info[$k]['descripcion_informe'];}
                } else if ($c_semana_info[$k]['categoria_informe'] == 6) {
                    if 		($ff == $s0) { $tiempo1m0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $tiempo1m1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $tiempo1m2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $tiempo1m3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $tiempo1m4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $tiempo1m5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $tiempo1m6 = $c_semana_info[$k]['descripcion_informe'];}
                } else if ($c_semana_info[$k]['categoria_informe'] == 8) {
                    if 		($ff == $s0) { $subtiempom0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $subtiempom1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $subtiempom2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $subtiempom3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $subtiempom4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $subtiempom5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $subtiempom6 = $c_semana_info[$k]['descripcion_informe'];}
                } else if ($c_semana_info[$k]['categoria_informe'] == 9) {
                    if 		($ff == $s0) { $tiempoTotalm0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $tiempoTotalm1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $tiempoTotalm2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $tiempoTotalm3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $tiempoTotalm4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $tiempoTotalm5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $tiempoTotalm6 = $c_semana_info[$k]['descripcion_informe'];}
                } else if ($c_semana_info[$k]['categoria_informe'] == 2) {
                    if 		($ff == $s0) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananai0 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananai0 = '<span class="grist">'.$mananai0.'</span>'; }
                    else if ($ff == $s1) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananai1 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananai1 = '<span class="grist">'.$mananai1.'</span>'; }
                    else if ($ff == $s2) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananai2 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananai2 = '<span class="grist">'.$mananai2.'</span>'; }
                    else if ($ff == $s3) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananai3 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananai3 = '<span class="grist">'.$mananai3.'</span>'; }
                    else if ($ff == $s4) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananai4 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananai4 = '<span class="grist">'.$mananai4.'</span>'; }
                    else if ($ff == $s5) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananai5 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananai5 = '<span class="grist">'.$mananai5.'</span>'; }
                    else if ($ff == $s6) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $mananai6 = nl2br($c_semana_info[$k]['descripcion_informe']); else $mananai6 = '<span class="grist">'.$mananai6.'</span>'; }
                }
            } else if ($c_semana_info[$k]['horario_informe'] == 1) {
                if ($c_semana_info[$k]['categoria_informe'] == 0) {
                    if 		($ff == $s0) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardef0 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardef0 = '<span class="grist">'.$tardef0.'</span>'; }
                    else if ($ff == $s1) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardef1 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardef1 = '<span class="grist">'.$tardef1.'</span>'; }
                    else if ($ff == $s2) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardef2 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardef2 = '<span class="grist">'.$tardef2.'</span>'; }
                    else if ($ff == $s3) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardef3 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardef3 = '<span class="grist">'.$tardef3.'</span>'; }
                    else if ($ff == $s4) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardef4 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardef4 = '<span class="grist">'.$tardef4.'</span>'; }
                    else if ($ff == $s5) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardef5 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardef5 = '<span class="grist">'.$tardef5.'</span>'; }
                    else if ($ff == $s6) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardef6 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardef6 = '<span class="grist">'.$tardef6.'</span>'; }
                }else if ($c_semana_info[$k]['categoria_informe'] == 1){
                    if 		($ff == $s0) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardet0 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardet0 = '<span class="grist">'.$tardet0.'</span>'; }
                    else if ($ff == $s1) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardet1 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardet1 = '<span class="grist">'.$tardet1.'</span>'; }
                    else if ($ff == $s2) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardet2 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardet2 = '<span class="grist">'.$tardet2.'</span>'; }
                    else if ($ff == $s3) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardet3 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardet3 = '<span class="grist">'.$tardet3.'</span>'; }
                    else if ($ff == $s4) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardet4 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardet4 = '<span class="grist">'.$tardet4.'</span>'; }
                    else if ($ff == $s5) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardet5 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardet5 = '<span class="grist">'.$tardet5.'</span>'; }
                    else if ($ff == $s6) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardet6 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardet6 = '<span class="grist">'.$tardet6.'</span>'; }
                } else if ($c_semana_info[$k]['categoria_informe'] == 7) {
                    if 		($ff == $s0) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalt0 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalt0 = '<span class="grist">'.$finalt0.'</span>'; }
                    else if ($ff == $s1) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalt1 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalt1 = '<span class="grist">'.$finalt1.'</span>'; }
                    else if ($ff == $s2) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalt2 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalt2 = '<span class="grist">'.$finalt2.'</span>'; }
                    else if ($ff == $s3) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalt3 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalt3 = '<span class="grist">'.$finalt3.'</span>'; }
                    else if ($ff == $s4) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalt4 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalt4 = '<span class="grist">'.$finalt4.'</span>'; }
                    else if ($ff == $s5) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalt5 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalt5 = '<span class="grist">'.$finalt5.'</span>'; }
                    else if ($ff == $s6) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $finalt6 = nl2br($c_semana_info[$k]['descripcion_informe']); else $finalt6 = '<span class="grist">'.$finalt6.'</span>'; }
                } else if ($c_semana_info[$k]['categoria_informe'] == 5) {
                    if 		($ff == $s0) { $horat0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $horat1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $horat2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $horat3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $horat4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $horat5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $horat6 = $c_semana_info[$k]['descripcion_informe'];}
                } else if ($c_semana_info[$k]['categoria_informe'] == 6) {
                    if 		($ff == $s0) { $tiempo2m0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $tiempo2m1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $tiempo2m2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $tiempo2m3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $tiempo2m4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $tiempo2m5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $tiempo2m6 = $c_semana_info[$k]['descripcion_informe'];}
                } else if ($c_semana_info[$k]['categoria_informe'] == 8) {
                    if 		($ff == $s0) { $subtiempot0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $subtiempot1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $subtiempot2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $subtiempot3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $subtiempot4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $subtiempot5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $subtiempot6 = $c_semana_info[$k]['descripcion_informe'];}
                } else if ($c_semana_info[$k]['categoria_informe'] == 9) {
                    if 		($ff == $s0) { $tiempoTotalt0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $tiempoTotalt1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $tiempoTotalt2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $tiempoTotalt3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $tiempoTotalt4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $tiempoTotalt5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $tiempoTotalt6 = $c_semana_info[$k]['descripcion_informe'];}
                } else if ($c_semana_info[$k]['categoria_informe'] == 2) {
                    if 		($ff == $s0) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardei0 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardei0 = '<span class="grist">'.$tardei0.'</span>'; }
                    else if ($ff == $s1) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardei1 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardei1 = '<span class="grist">'.$tardei1.'</span>'; }
                    else if ($ff == $s2) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardei2 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardei2 = '<span class="grist">'.$tardei2.'</span>'; }
                    else if ($ff == $s3) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardei3 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardei3 = '<span class="grist">'.$tardei3.'</span>'; }
                    else if ($ff == $s4) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardei4 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardei4 = '<span class="grist">'.$tardei4.'</span>'; }
                    else if ($ff == $s5) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardei5 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardei5 = '<span class="grist">'.$tardei5.'</span>'; }
                    else if ($ff == $s6) { if ($c_semana_info[$k]['descripcion_informe'] != ' ') $tardei6 = nl2br($c_semana_info[$k]['descripcion_informe']); else $tardei6 = '<span class="grist">'.$tardei6.'</span>'; }
                } else if ($c_semana_info[$k]['categoria_informe'] == 10) {
                    if 		($ff == $s0) { $informe = nl2br($c_semana_info[$k]['descripcion_informe']);}
                }
            } else if ($c_semana_info[$k]['horario_informe'] == 2) {
                if ($c_semana_info[$k]['categoria_informe'] == 6) {
                    if 		($ff == $s0) { $tiempo1t0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $tiempo1t1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $tiempo1t2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $tiempo1t3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $tiempo1t4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $tiempo1t5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $tiempo1t6 = $c_semana_info[$k]['descripcion_informe'];}
                }
            } else if ($c_semana_info[$k]['horario_informe'] == 3) {
                if ($c_semana_info[$k]['categoria_informe'] == 6) {
                    if 		($ff == $s0) { $tiempo2t0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $tiempo2t1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $tiempo2t2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $tiempo2t3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $tiempo2t4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $tiempo2t5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $tiempo2t6 = $c_semana_info[$k]['descripcion_informe'];}
                }
            } else if ($c_semana_info[$k]['horario_informe'] == 4) {
                if ($c_semana_info[$k]['categoria_informe'] == 6) {
                    if 		($ff == $s0) { $tiempo3m0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $tiempo3m1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $tiempo3m2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $tiempo3m3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $tiempo3m4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $tiempo3m5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $tiempo3m6 = $c_semana_info[$k]['descripcion_informe'];}
                }
            } else if ($c_semana_info[$k]['horario_informe'] == 5) {
                if ($c_semana_info[$k]['categoria_informe'] == 6) {
                    if 		($ff == $s0) { $tiempo3t0 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s1) { $tiempo3t1 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s2) { $tiempo3t2 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s3) { $tiempo3t3 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s4) { $tiempo3t4 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s5) { $tiempo3t5 = $c_semana_info[$k]['descripcion_informe'];}
                    else if ($ff == $s6) { $tiempo3t6 = $c_semana_info[$k]['descripcion_informe'];}
                }
            }
        }
        
        /*==================================
        =            HTML PRINT            =
        ==================================*/
        if ($i != 0) {
            $data.='<div style="page-break-after:always;"></div>';
        }
        
        $data.= '
        <table color="black" class="tg">
            <tr class="tx12">
                <td class="txCenter lateralMenu width-10" style="height: 200px;"><div class="rotate tx10">INFORME</div></td>
                <td class="txLeft" style="padding: 3px;">'.$informe.'</td>
            </tr>
        </table>
        
        <h2 class="tx16 txCenter" style="font-weight: bold; margin-bottom:10px; font-family: helvetica; color: #ffffff; background: #ce1111; padding: 7px;">DETALLES</h2>
        
        <table class="tg" style="width: 65%; margin:auto;">
            <tr class="tx12">
                <td class="txCenter tg-0pky" style="width: 25%;"><b>FECHA MICROCICLO</b></td>
                <td class="txCenter tg-0pky">'.$fecha_inicio.' - '.$fecha_fin.'</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter tg-0pky" style="width: 25%;"><b>SELECCIÓN</b></td>
                <td class="txCenter tg-0pky">'.$series[$_POST['convocatoria']].'</td>
            </tr>
        </table>
        
        <div style="page-break-after:always;"></div>
        
        <table color="black" class="tg">
            <tr>
                <th class="dia txCenter tx12 width-10" rowspan="2">DÍA</th>
                <th class="diasSemana txCenter tg-0pky tx10">LUNES</th>
                <th class="diasSemana txCenter tg-0pky tx10">MARTES</th>
                <th class="diasSemana txCenter tg-0pky tx10">MIERCOLES</th>
                <th class="diasSemana txCenter tg-0pky tx10">JUEVES</th>
                <th class="diasSemana txCenter tg-0pky tx10">VIERNES</th>
                <th class="diasSemana txCenter tg-0pky tx10">SABADO</th>
                <th class="diasSemana txCenter tg-0pky tx10">DOMINGO</th>
            </tr>
            <tr>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d0.'</b><b class="tx12">'.$months[$m0].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d1.'</b><b class="tx12">'.$months[$m1].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d2.'</b><b class="tx12">'.$months[$m2].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d3.'</b><b class="tx12">'.$months[$m3].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d4.'</b><b class="tx12">'.$months[$m4].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d5.'</b><b class="tx12">'.$months[$m5].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d6.'</b><b class="tx12">'.$months[$m6].'</b></td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Jornada</td>
                <td class="txCenter tg-0pky grises">MAÑANA</td>
                <td class="txCenter tg-0pky grises">MAÑANA</td>
                <td class="txCenter tg-0pky grises">MAÑANA</td>
                <td class="txCenter tg-0pky grises">MAÑANA</td>
                <td class="txCenter tg-0pky grises">MAÑANA</td>
                <td class="txCenter tg-0pky grises">MAÑANA</td>
                <td class="txCenter tg-0pky grises">MAÑANA</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Hora</td>
                <td class="txCenter tg-0pky grises"><span id="m_hora1">'.$horam0.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="m_hora2">'.$horam1.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="m_hora3">'.$horam2.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="m_hora4">'.$horam3.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="m_hora5">'.$horam4.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="m_hora6">'.$horam5.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="m_hora7">'.$horam6.'</span> Hrs</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter lateralMenu width-10"><div class="rotate tx10">FÍSICO</div></td>
                <td class="txLeft tg-0pky" id="m_fisico1">'.$mananaf0.'</td>
                <td class="txLeft tg-0pky" id="m_fisico2">'.$mananaf1.'</td>
                <td class="txLeft tg-0pky" id="m_fisico3">'.$mananaf2.'</td>
                <td class="txLeft tg-0pky" id="m_fisico4">'.$mananaf3.'</td>
                <td class="txLeft tg-0pky" id="m_fisico5">'.$mananaf4.'</td>
                <td class="txLeft tg-0pky" id="m_fisico6">'.$mananaf5.'</td>
                <td class="txLeft tg-0pky" id="m_fisico7">'.$mananaf6.'</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Tiempo</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempo1">'.$tiempo1m0.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempo2">'.$tiempo1m1.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempo3">'.$tiempo1m2.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempo4">'.$tiempo1m3.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempo5">'.$tiempo1m4.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempo6">'.$tiempo1m5.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempo7">'.$tiempo1m6.'</span> Min</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter lateralMenu width-10"><div class="rotate tx10">TÉCNICO TÁCTICO</div></td>
                <td class="txLeft tg-0pky" id="m_tecnico1">'.$mananat0.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico2">'.$mananat1.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico3">'.$mananat2.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico4">'.$mananat3.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico5">'.$mananat4.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico6">'.$mananat5.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico7">'.$mananat6.'</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Tiempo</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo1">'.$tiempo2m0.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo2">'.$tiempo2m1.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo3">'.$tiempo2m2.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo4">'.$tiempo2m3.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo5">'.$tiempo2m4.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo6">'.$tiempo2m5.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo7">'.$tiempo2m6.'</span> Min</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter lateralMenu width-10"><div class="rotate tx10">INDIVIDUALES</div></td>
                <td class="txLeft tg-0pky" id="m_tecnico1">'.$mananai0.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico2">'.$mananai1.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico3">'.$mananai2.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico4">'.$mananai3.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico5">'.$mananai4.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico6">'.$mananai5.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico7">'.$mananai6.'</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Tiempo</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo1">'.$tiempo3m0.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo2">'.$tiempo3m1.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo3">'.$tiempo3m2.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo4">'.$tiempo3m3.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo5">'.$tiempo3m4.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo6">'.$tiempo3m5.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="m_tiempoo7">'.$tiempo3m6.'</span> Min</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter lateralMenu2 width-10">Final</td>
                <td class="txCenter tg-0pky rojos" id="m_final1">'.$finalm0.'</td>
                <td class="txCenter tg-0pky rojos" id="m_final2">'.$finalm1.'</td>
                <td class="txCenter tg-0pky rojos" id="m_final3">'.$finalm2.'</td>
                <td class="txCenter tg-0pky rojos" id="m_final4">'.$finalm3.'</td>
                <td class="txCenter tg-0pky rojos" id="m_final5">'.$finalm4.'</td>
                <td class="txCenter tg-0pky rojos" id="m_final6">'.$finalm5.'</td>
                <td class="txCenter tg-0pky rojos" id="m_final7">'.$finalm6.'</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Tiempo</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo1">'.$subtiempom0.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo2">'.$subtiempom1.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo3">'.$subtiempom2.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo4">'.$subtiempom3.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo5">'.$subtiempom4.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo6">'.$subtiempom5.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo7">'.$subtiempom6.' Min</td>
            </tr>
            <tr class="tx12">
                <td class="dia txCenter">Total</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot1">'.$tiempoTotalm0.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot2">'.$tiempoTotalm1.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot3">'.$tiempoTotalm2.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot4">'.$tiempoTotalm3.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot5">'.$tiempoTotalm4.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot6">'.$tiempoTotalm5.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot7">'.$tiempoTotalm6.' Min</td>
            </tr>
        </table>
        
        <div style="page-break-after:always;"></div>
        
        <table color="black" class="tg">
            <tr>
                <th class="dia txCenter tx12 width-10" rowspan="2">DÍA</th>
                <th class="diasSemana txCenter tg-0pky tx10">LUNES</th>
                <th class="diasSemana txCenter tg-0pky tx10">MARTES</th>
                <th class="diasSemana txCenter tg-0pky tx10">MIERCOLES</th>
                <th class="diasSemana txCenter tg-0pky tx10">JUEVES</th>
                <th class="diasSemana txCenter tg-0pky tx10">VIERNES</th>
                <th class="diasSemana txCenter tg-0pky tx10">SABADO</th>
                <th class="diasSemana txCenter tg-0pky tx10">DOMINGO</th>
            </tr>
            <tr>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d0.'</b><b class="tx12">'.$months[$m0].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d1.'</b><b class="tx12">'.$months[$m1].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d2.'</b><b class="tx12">'.$months[$m2].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d3.'</b><b class="tx12">'.$months[$m3].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d4.'</b><b class="tx12">'.$months[$m4].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d5.'</b><b class="tx12">'.$months[$m5].'</b></td>
                <td class="txCenter grisesOscuro"><b class="tx16">'.$d6.'</b><b class="tx12">'.$months[$m6].'</b></td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Jornada</td>
                <td class="txCenter tg-0pky grises">TARDE</td>
                <td class="txCenter tg-0pky grises">TARDE</td>
                <td class="txCenter tg-0pky grises">TARDE</td>
                <td class="txCenter tg-0pky grises">TARDE</td>
                <td class="txCenter tg-0pky grises">TARDE</td>
                <td class="txCenter tg-0pky grises">TARDE</td>
                <td class="txCenter tg-0pky grises">TARDE</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Hora</td>
                <td class="txCenter tg-0pky grises"><span id="t_hora1">'.$horat0.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="t_hora2">'.$horat1.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="t_hora3">'.$horat2.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="t_hora4">'.$horat3.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="t_hora5">'.$horat4.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="t_hora6">'.$horat5.'</span> Hrs</td>
                <td class="txCenter tg-0pky grises"><span id="t_hora7">'.$horat6.'</span> Hrs</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter lateralMenu width-10"><div class="rotate tx10">FÍSICO</div></td>
                <td class="txLeft tg-0pky" id="t_fisico1">'.$tardef0.'</td>
                <td class="txLeft tg-0pky" id="t_fisico2">'.$tardef1.'</td>
                <td class="txLeft tg-0pky" id="t_fisico3">'.$tardef2.'</td>
                <td class="txLeft tg-0pky" id="t_fisico4">'.$tardef3.'</td>
                <td class="txLeft tg-0pky" id="t_fisico5">'.$tardef4.'</td>
                <td class="txLeft tg-0pky" id="t_fisico6">'.$tardef5.'</td>
                <td class="txLeft tg-0pky" id="t_fisico7">'.$tardef6.'</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Tiempo</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempo1">'.$tiempo1t0.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempo2">'.$tiempo1t1.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempo3">'.$tiempo1t2.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempo4">'.$tiempo1t3.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempo5">'.$tiempo1t4.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempo6">'.$tiempo1t5.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempo7">'.$tiempo1t6.'</span> Min</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter lateralMenu width-10"><div class="rotate tx10">TÉCNICO TÁCTICO</div></td>
                <td class="txLeft tg-0pky" id="t_tecnico1">'.$tardet0.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico2">'.$tardet1.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico3">'.$tardet2.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico4">'.$tardet3.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico5">'.$tardet4.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico6">'.$tardet5.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico7">'.$tardet6.'</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Tiempo</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo1">'.$tiempo2t0.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo2">'.$tiempo2t1.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo3">'.$tiempo2t2.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo4">'.$tiempo2t3.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo5">'.$tiempo2t4.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo6">'.$tiempo2t5.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo7">'.$tiempo2t6.'</span> Min</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter lateralMenu width-10"><div class="rotate tx10">INDIVIDUALES</div></td>
                <td class="txLeft tg-0pky" id="t_tecnico1">'.$tardei0.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico2">'.$tardei1.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico3">'.$tardei2.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico4">'.$tardei3.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico5">'.$tardei4.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico6">'.$tardei5.'</td>
                <td class="txLeft tg-0pky" id="t_tecnico7">'.$tardei6.'</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Tiempo</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo1">'.$tiempo3t0.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo2">'.$tiempo3t1.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo3">'.$tiempo3t2.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo4">'.$tiempo3t3.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo5">'.$tiempo3t4.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo6">'.$tiempo3t5.'</span> Min</td>
                <td class="txCenter tg-0pky grises"><span id="t_tiempoo7">'.$tiempo3t6.'</span> Min</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter lateralMenu2 width-10">Final</td>
                <td class="txCenter tg-0pky rojos" id="t_final1">'.$finalt0.'</td>
                <td class="txCenter tg-0pky rojos" id="t_final2">'.$finalt1.'</td>
                <td class="txCenter tg-0pky rojos" id="t_final3">'.$finalt2.'</td>
                <td class="txCenter tg-0pky rojos" id="t_final4">'.$finalt3.'</td>
                <td class="txCenter tg-0pky rojos" id="t_final5">'.$finalt4.'</td>
                <td class="txCenter tg-0pky rojos" id="t_final6">'.$finalt5.'</td>
                <td class="txCenter tg-0pky rojos" id="t_final7">'.$finalt6.'</td>
            </tr>
            <tr class="tx12">
                <td class="txCenter grises width-10">Tiempo</td>
                <td class="txCenter tg-0pky grises" id="t_tiempooo1">'.$subtiempot0.' Min</td>
                <td class="txCenter tg-0pky grises" id="t_tiempooo2">'.$subtiempot1.' Min</td>
                <td class="txCenter tg-0pky grises" id="t_tiempooo3">'.$subtiempot2.' Min</td>
                <td class="txCenter tg-0pky grises" id="t_tiempooo4">'.$subtiempot3.' Min</td>
                <td class="txCenter tg-0pky grises" id="t_tiempooo5">'.$subtiempot4.' Min</td>
                <td class="txCenter tg-0pky grises" id="t_tiempooo6">'.$subtiempot5.' Min</td>
                <td class="txCenter tg-0pky grises" id="t_tiempooo7">'.$subtiempot6.' Min</td>
            </tr>
            <tr class="tx12">
                <td class="dia txCenter">Total</td>
                <td class="txCenter tg-0pky rojos" id="t_tiempot1">'.$tiempoTotalt0.' Min</td>
                <td class="txCenter tg-0pky rojos" id="t_tiempot2">'.$tiempoTotalt1.' Min</td>
                <td class="txCenter tg-0pky rojos" id="t_tiempot3">'.$tiempoTotalt2.' Min</td>
                <td class="txCenter tg-0pky rojos" id="t_tiempot4">'.$tiempoTotalt3.' Min</td>
                <td class="txCenter tg-0pky rojos" id="t_tiempot5">'.$tiempoTotalt4.' Min</td>
                <td class="txCenter tg-0pky rojos" id="t_tiempot6">'.$tiempoTotalt5.' Min</td>
                <td class="txCenter tg-0pky rojos" id="t_tiempot7">'.$tiempoTotalt6.' Min</td>
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
.Helvetica {
    font-family: "Helvetica";
}

.page_break {page-break-before:always; } 

.tg  {border-spacing:0; width: 100%; border: solid 1px black;}
.tg td, th {font-family: helvetica;border:solid 1px black;}
.tg td {border: black 1px solid; }
.tg .tg-0pky{padding: 2px;}

.txCenter{text-align:center;}
.txLeft{text-align:left;vertical-align: top;}
.width-10 {
    width: 50px !important;
    max-width: 50px !important;
}

.rotate {transform: rotate(270deg);}

.tx18{font-size: 18px;}
.tx16{font-size: 16px;}
.tx14{font-size: 14px;}
.tx12{font-size: 12px;}
.tx10{font-size: 10px;}
.tx8{font-size: 8px;}

.diasSemana{background-color: #D62A1C;color: white;font-weight: bold;}
.dia{background-color: #D62A1C;color: white;font-weight: bold;}
.lateralMenu{background-color: #D62A1C;color: white;font-weight: bold; height: 139px; max-width: 50px !important;}
.lateralMenu2{background-color: #D62A1C;color: white;font-weight: bold; height:50px; max-width: 50px !important;}

.grises{background-color: #eeeeee;color: black;}
.grisesOscuro{color: #595959;}
.rojos{background-color: #D62A1C;color: white;}
.grist { color: #9C9C9C; }
.rojos .grist { color: #FF6D61; }

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

$output = $pdf->output();
file_put_contents("../../reportes_pdf/".$titulo_documento_salida, $output);

echo json_encode($titulo_documento_salida);
?>