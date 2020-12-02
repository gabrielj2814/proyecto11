<?php 

$data='';
include('../../../bd/calendar_pal_BD.php');

$months = ['All','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

$fecha_comienzo = substr($_POST['inicio'],8,2).' '.$months[intval(substr($_POST['inicio'],5,2))].' '.substr($_POST['inicio'],0,4);
$fecha_fin      = substr($_POST['fin'],8,2).' '.$months[intval(substr($_POST['fin'],5,2))].' '.substr($_POST['fin'],0,4);

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

$c_semana = calendar_semana2($_POST);
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
        
        $_psicologia0 = ''; $_fisica0 = ''; $_espacio0 = '';
        $_psicologia1 = ''; $_fisica1 = ''; $_espacio1 = '';
        $_psicologia2 = ''; $_fisica2 = ''; $_espacio2 = '';
        $_psicologia3 = ''; $_fisica3 = ''; $_espacio3 = '';
        $_psicologia4 = ''; $_fisica4 = ''; $_espacio4 = '';
        $_psicologia5 = ''; $_fisica5 = ''; $_espacio5 = '';
        $_psicologia6 = ''; $_fisica6 = ''; $_espacio6 = '';
        
        $mesociclo = ''; $microciclo = ''; $estado = '';
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
                } else if ($c_semana[$k]['categoria_semana'] == 10) {
                    if 		($ff == $s0) { $_psicologia0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $_psicologia1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $_psicologia2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $_psicologia3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $_psicologia4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $_psicologia5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $_psicologia6 = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 11) {
                    if 		($ff == $s0) { $mesociclo = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 12) {
                    if 		($ff == $s0) { $microciclo = $c_semana[$k]['descripcion_semana'];}
                } else if ($c_semana[$k]['categoria_semana'] == 13) {
                    if 		($ff == $s0) { $estado = $c_semana[$k]['descripcion_semana'];}
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
                } else if ($c_semana[$k]['categoria_semana'] == 10) {
                    if 		($ff == $s0) { $_fisica0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $_fisica1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $_fisica2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $_fisica3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $_fisica4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $_fisica5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $_fisica6 = $c_semana[$k]['descripcion_semana'];}
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
                } else if ($c_semana[$k]['categoria_semana'] == 10) {
                    if 		($ff == $s0) { $_espacio0 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s1) { $_espacio1 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s2) { $_espacio2 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s3) { $_espacio3 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s4) { $_espacio4 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s5) { $_espacio5 = $c_semana[$k]['descripcion_semana'];}
                    else if ($ff == $s6) { $_espacio6 = $c_semana[$k]['descripcion_semana'];}
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
            }
        }
        
        /*==================================
        =            HTML PRINT            =
        ==================================*/
        if ($i != 0) {
            $data.='<div style="page-break-after:always;"></div>';
        }
        
        $data.= '
        <div class="Helvetica" style="margin-top: 250px;">
            <div style="margin-bottom:15px; background: #D62A1C; height: 20px; border-radius: 2px 2px 2px 2px;"></div>
            <h2 class="txCenter" style="font-size: 30px; font-weight: normal;">Informe Microciclo</h2>
            <h5 class="txCenter" style="font-size: 20px; font-weight: normal; margin-top: -10px;">'.$fecha_comienzo.' - '.$fecha_fin.'</h5>
            <div style="margin-bottom:15px; background: #D62A1C; height: 20px; border-radius: 2px 2px 2px 2px;"></div>
        </div>
        
        <div style="page-break-after:always;"></div>
        
        <div class="Helvetica tx12" style="width: 250px; margin: 0px; margin-right: 40px; margin-left: 50px; display: inline-block; margin-top: 10px;">
            <a style="display: inline-block; margin:0px; width:125px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; margin-top:0px; margin-bottom:0px;background-color:#D62A1C; font-weight: bold; color: #ffffff; padding: 5px;"> MESOCICLO</a>
            <span class="grisesOscuro" style="display: inline-block; margin:0px; width:125px; border: 2px solid #999999; margin-left: -4px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; padding: 3px; height: 14.5px;">'.$mesociclo.'</span>
        </div>
        
        <div class="Helvetica tx12" style="width: 250px; margin: 0px; margin-right: 40px; display: inline-block;">
            <a style="display: inline-block; margin:0px; width:125px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; margin-top:0px; margin-bottom:0px;background-color:#D62A1C; font-weight: bold; color: #ffffff; padding: 5px;"> MICROCICLO</a>
            <span class="grisesOscuro" style="display: inline-block; margin:0px; width:125px; border: 2px solid #999999; margin-left: -4px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; padding: 3px; height: 14.5px;">'.$microciclo.'</span>
        </div>
        
        <div class="Helvetica tx12" style="width: 250px; margin: 0px; margin-right: 40px; display: inline-block;">
            <a style="display: inline-block; margin:0px; width:125px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; margin-top:0px; margin-bottom:0px;background-color:#D62A1C; font-weight: bold; color: #ffffff; padding: 5px;"> PERIODO</a>
            <span class="grisesOscuro" style="display: inline-block; margin:0px; width:125px; border: 2px solid #999999; margin-left: -4px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; padding: 3px; height: 14.5px;">'.$estado.'</span>
        </div>
        
        <table color="black" class="tg" style="margin-top: 25px;">
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
                <td class="tginit txCenter tg-0pky lateralMenu4 tx10"><div class="rotate">D. PSICOLÓGICA</div></td>
                <td class="txLeft tg-0pky txCenter" id="m_fisico1" style="height: 100px; vertical-align:middle; text-align: center;">'.$_psicologia0.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_fisico2" style="height: 100px; vertical-align:middle; text-align: center;">'.$_psicologia1.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_fisico3" style="height: 100px; vertical-align:middle; text-align: center;">'.$_psicologia2.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_fisico4" style="height: 100px; vertical-align:middle; text-align: center;">'.$_psicologia3.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_fisico5" style="height: 100px; vertical-align:middle; text-align: center;">'.$_psicologia4.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_fisico6" style="height: 100px; vertical-align:middle; text-align: center;">'.$_psicologia5.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_fisico7" style="height: 100px; vertical-align:middle; text-align: center;">'.$_psicologia6.'</td>
            </tr>
            <tr class="tx12">
                <td class="tginit txCenter tg-0pky lateralMenu4 tx10"><div class="rotate">D. FISICA</div></td>
                <td class="txLeft tg-0pky txCenter" id="m_tecnico1" style="height: 100px; vertical-align:middle; text-align: center;">'.$_fisica0.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_tecnico2" style="height: 100px; vertical-align:middle; text-align: center;">'.$_fisica1.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_tecnico3" style="height: 100px; vertical-align:middle; text-align: center;">'.$_fisica2.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_tecnico4" style="height: 100px; vertical-align:middle; text-align: center;">'.$_fisica3.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_tecnico5" style="height: 100px; vertical-align:middle; text-align: center;">'.$_fisica4.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_tecnico6" style="height: 100px; vertical-align:middle; text-align: center;">'.$_fisica5.'</td>
                <td class="txLeft tg-0pky txCenter" id="m_tecnico7" style="height: 100px; vertical-align:middle; text-align: center;">'.$_fisica6.'</td>
            </tr>
            <tr class="tx12">
                <td class="tginit txCenter tg-0pky lateralMenu tx10"><div class="rotate">ESPACIO</div></td>
                <td class="txLeft tg-0pky" id="m_tecnico1" style="height: 100px;">'.$_espacio0.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico2" style="height: 100px;">'.$_espacio1.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico3" style="height: 100px;">'.$_espacio2.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico4" style="height: 100px;">'.$_espacio3.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico5" style="height: 100px;">'.$_espacio4.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico6" style="height: 100px;">'.$_espacio5.'</td>
                <td class="txLeft tg-0pky" id="m_tecnico7" style="height: 100px;">'.$_espacio6.'</td>
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
                <td class="tginit txCenter tg-0pky lateralMenu"><div class="rotate">PARTE INICIAL</div></td>
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
                <td class="tginit txCenter tg-0pky lateralMenu"><div class="rotate">PARTE PRINCIPAL</div></td>
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
                <td class="txCenter tg-0pky grises" id="m_tiempooo1">'.$subtiempom0.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo2">'.$subtiempom1.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo3">'.$subtiempom2.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo4">'.$subtiempom3.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo5">'.$subtiempom4.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo6">'.$subtiempom5.' Min</td>
                <td class="txCenter tg-0pky grises" id="m_tiempooo7">'.$subtiempom6.' Min</td>
            </tr>
            <tr class="tx12">
                <td class="tginit txCenter tg-0pky lateralMenu3">Tiempo Total</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot1">'.$tiempoTotalm0.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot2">'.$tiempoTotalm1.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot3">'.$tiempoTotalm2.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot4">'.$tiempoTotalm3.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot5">'.$tiempoTotalm4.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot6">'.$tiempoTotalm5.' Min</td>
                <td class="txCenter tg-0pky rojos" id="m_tiempot7">'.$tiempoTotalm6.' Min</td>
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

.rotate {transform: rotate(270deg);}
.tginit{width: 0px;}

.tx18{font-size: 18px;}
.tx14{font-size: 14px;}
.tx12{font-size: 12px;}
.tx10{font-size: 10px;}
.tx8{font-size: 8px;}

.diasSemana{background-color: #D62A1C;color: white;font-weight: bold;}
.dia{background-color: #D62A1C;color: white;font-weight: bold;}
.lateralMenu{background-color: #D62A1C;color: white;font-weight: bold;height: 200px;}
.lateralMenu2{background-color: #D62A1C;color: white;font-weight: bold;height:50px;}
.lateralMenu3{background-color: #D62A1C;color: white;font-weight: bold;}
.lateralMenu4{background-color: #D62A1C;color: white;font-weight: bold; height:120px;}

.grises{background-color: #eeeeee;color: black;}
.grisesOscuro{color: #595959;}
.rojos{background-color: #D62A1C;color: white;}

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

$output = $pdf->output();
file_put_contents("../../reportes_pdf/".$titulo_documento_salida, $output);

echo json_encode($titulo_documento_salida);
?>