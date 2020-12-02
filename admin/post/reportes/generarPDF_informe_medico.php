<?php 
include('../../../bd/kine_BD.php');

$data = '';
$data_informe = ver_informe_determinado($_POST['id_informe']);
$data_jugador = consultar_jugador($data_informe['idficha_jugador']);

$diaN = substr($data_jugador['fecha_nacimiento'],8,2);
$mesN = substr($data_jugador['fecha_nacimiento'],5,2);
$anoN = substr($data_jugador['fecha_nacimiento'],0,4);

date_default_timezone_set("America/Caracas");   // ESTABLECEMOS LA ZONA HORARIA.
$diaA = $date = date('d', time());
$mesA = $date = date('m', time());
$anoA = $date = date('Y', time());

$posicion = ['a' => 'Arquero', 'd' => 'Defenza', 'v' => 'Volante', 't' => 'Delantero'];
$lateralidad = ['i' => 'Izquierda', 'd' => 'Derecha', 'a' => 'Ambidiestro'];

$edad = 0;
if ($anoN <= $anoA) {
    $edad = $anoA - $anoN;
    if ($mesN > $mesA) {
        if ($edad != 0) 
            $edad--;
    } else if ($mesN == $mesA) {
        if ($diaN > $diaA)
            if ($edad != 0) 
                $edad--;
    }
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
if ($data_informe['enfermedades_cronicas'] == '') {
    $enfermedades_cronicas = '';
    $ec_s = ' ';
    $ec_n = '\ ';
} else {
    $enfermedades_cronicas = ': <span class="descripcionCheck">'.$data_informe['enfermedades_cronicas'].'</span>';
    $ec_s = '\ ';
    $ec_n = ' ';
}

if ($data_informe['cirugias'] == '') {
    $cirugias = '';
    $cir_s = ' ';
    $cir_n = '\ ';
} else {
    $cirugias = ': <span class="descripcionCheck">'.$data_informe['cirugias'].'</span>';
    $cir_s = '\ ';
    $cir_n = ' ';
}

if ($data_informe['medicamentos'] == '') {
    $medicamentos = '';
    $medic_s = ' ';
    $medic_n = '\ ';
} else {
    $medicamentos = ': <span class="descripcionCheck">'.$data_informe['medicamentos'].'</span>';
    $medic_s = '\ ';
    $medic_n = ' ';
}

if ($data_informe['habitos'] == 'no') {
    $habitos = '';
    $habi_s = ' ';
    $habi_n = '\ ';
} else {
    $habitos = ': <span class="descripcionCheck">'.ucfirst($data_informe['habitos']).'</span>';
    $habi_s = '\ ';
    $habi_n = ' ';
}

if ($data_informe['alergias'] == '') {
    $alergias = '';
    $alerg_s = ' ';
    $alerg_n = '\ ';
} else {
    $alergias = ': <span class="descripcionCheck">'.$data_informe['alergias'].'</span>';
    $alerg_s = '\ ';
    $alerg_n = ' ';
}

if ($data_informe['infecciones_respiratorias'] == '') {
    $infecciones_respiratorias = '';
    $inR_s = ' ';
    $inR_n = '\ ';
} else {
    $infecciones_respiratorias = '<span style="font-size: 11px; display: inline-block; margin-top: 5px;" class="descripcionCheck">'.$data_informe['infecciones_respiratorias'].'</span>';
    $inR_s = '\ ';
    $inR_n = ' ';
}

if ($data_informe['infecciones_gastrointes'] == '') {
    $infecciones_gastrointes = '';
    $inG_s = ' ';
    $inG_n = '\ ';
} else {
    $infecciones_gastrointes = '<span style="font-size: 11px; display: inline-block; margin-top: 5px;" class="descripcionCheck">'.$data_informe['infecciones_gastrointes'].'</span>';
    $inG_s = '\ ';
    $inG_n = ' ';
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
if ($data_informe['muerte_subita'] == '') {
    $ant_fam_s_1 = ' ';
    $ant_fam_n_1 = '\ ';
} else {
    $ant_fam_s_1 = '\ ';
    $ant_fam_n_1 = ' ';
}
if ($data_informe['enfermedad_coronaria'] == '') {
    $ant_fam_s_2 = ' ';
    $ant_fam_n_2 = '\ ';
} else {
    $ant_fam_s_2 = '\ ';
    $ant_fam_n_2 = ' ';
}
if ($data_informe['miocardiopatia'] == '') {
    $ant_fam_s_3 = ' ';
    $ant_fam_n_3 = '\ ';
} else {
    $ant_fam_s_3 = '\ ';
    $ant_fam_n_3 = ' ';
}
if ($data_informe['hta'] == '') {
    $ant_fam_s_4 = ' ';
    $ant_fam_n_4 = '\ ';
} else {
    $ant_fam_s_4 = '\ ';
    $ant_fam_n_4 = ' ';
}
if ($data_informe['sincopes_recurrentes'] == '') {
    $ant_fam_s_5 = ' ';
    $ant_fam_n_5 = '\ ';
} else {
    $ant_fam_s_5 = '\ ';
    $ant_fam_n_5 = ' ';
}
if ($data_informe['arritmias'] == '') {
    $ant_fam_s_6 = ' ';
    $ant_fam_n_6 = '\ ';
} else {
    $ant_fam_s_6 = '\ ';
    $ant_fam_n_6 = ' ';
}
if ($data_informe['cirugia_cardiaca'] == '') {
    $ant_fam_s_7 = ' ';
    $ant_fam_n_7 = '\ ';
} else {
    $ant_fam_s_7 = '\ ';
    $ant_fam_n_7 = ' ';
}
if ($data_informe['marcapasos_des'] == '') {
    $ant_fam_s_8 = ' ';
    $ant_fam_n_8 = '\ ';
} else {
    $ant_fam_s_8 = '\ ';
    $ant_fam_n_8 = ' ';
}
if ($data_informe['sd_marfan'] == '') {
    $ant_fam_s_9 = ' ';
    $ant_fam_n_9 = '\ ';
} else {
    $ant_fam_s_9 = '\ ';
    $ant_fam_n_9 = ' ';
}
if ($data_informe['acv'] == '') {
    $ant_fam_s_10 = ' ';
    $ant_fam_n_10 = '\ ';
} else {
    $ant_fam_s_10 = '\ ';
    $ant_fam_n_10 = ' ';
}
if ($data_informe['diabetes'] == '') {
    $ant_fam_s_11 = ' ';
    $ant_fam_n_11 = '\ ';
} else {
    $ant_fam_s_11 = '\ ';
    $ant_fam_n_11 = ' ';
}
if ($data_informe['cancer'] == '') {
    $ant_fam_s_12 = ' ';
    $ant_fam_n_12 = '\ ';
} else {
    $ant_fam_s_12 = '\ ';
    $ant_fam_n_12 = ' ';
}
if ($data_informe['accidente_auto'] == '') {
    $ant_fam_s_13 = ' ';
    $ant_fam_n_13 = '\ ';
} else {
    $ant_fam_s_13 = '\ ';
    $ant_fam_n_13 = ' ';
}
if ($data_informe['otro'] == '') {
    $ant_fam_s_14 = ' ';
    $ant_fam_n_14 = '\ ';
} else {
    $ant_fam_s_14 = '\ ';
    $ant_fam_n_14 = ' ';
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$anteTraumatologicos = '';
for ($i = 0; $i < count($data_informe['antecedentes_trauma']); $i++) {
    if ($data_informe['antecedentes_trauma'][$i]['year'] == '') {
        $trauma_s = '';
        $trauma_n = '\ ';
    } else {
        $trauma_s = '\ ';
        $trauma_n = '';
    }
    
    $anteTraumatologicos .= '
    <tr>
        <td>'.$data_informe['antecedentes_trauma'][$i]['tipo_antecedentes'].'</td>
        <td class="center">'.$trauma_n.'</td>
        <td class="center">'.$trauma_s.'</td>
        <td class="center">'.$data_informe['antecedentes_trauma'][$i]['year'].'</td>
        <td>'.$data_informe['antecedentes_trauma'][$i]['area_afectada'].'</td>
        <td>'.$data_informe['antecedentes_trauma'][$i]['lateralidad'].'</td>
        <td>'.$data_informe['antecedentes_trauma'][$i]['tiempo_ausencia'].'</td>
    </tr>
    ';
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
if ($data_informe['angina_esfuerzo'] == 'N') {
    $ant_ang_s = ' ';
    $ant_ang_n = '\ ';
} else {
    $ant_ang_s = '\ ';
    $ant_ang_n = ' ';
}
if ($data_informe['palpitaciones'] == 'N') {
    $ant_palpi_s = ' ';
    $ant_palpi_n = '\ ';
} else {
    $ant_palpi_s = '\ ';
    $ant_palpi_n = ' ';
}
if ($data_informe['sincopes'] == 'N') {
    $sincopes_s = ' ';
    $sincopes_n = '\ ';
} else {
    $sincopes_s = '\ ';
    $sincopes_n = ' ';
}
if ($data_informe['disnea_desproporcionada'] == 'N') {
    $ant_dis_desp_s = ' ';
    $ant_dis_desp_n = '\ ';
} else {
    $ant_dis_desp_s = '\ ';
    $ant_dis_desp_n = ' ';
}
if ($data_informe['fatiga_desproporcionada'] == 'N') {
    $ant_fat_desp_s = ' ';
    $ant_fat_desp_n = '\ ';
} else {
    $ant_fat_desp_s = '\ ';
    $ant_fat_desp_n = ' ';
}
if ($data_informe['sintomas_obstructivos'] == 'N') {
    $ant_sint_ob_s = ' ';
    $ant_sint_ob_n = '\ ';
} else {
    $ant_sint_ob_s = '\ ';
    $ant_sint_ob_n = ' ';
}
if ($data_informe['problemas_cardiacos'] == 'N') {
    $prob_card_s = ' ';
    $prob_card_n = '\ ';
} else {
    $prob_card_s = '\ ';
    $prob_card_n = ' ';
}
if ($data_informe['problemas_respiratorios'] == 'N') {
    $prob_resp_s = ' ';
    $prob_resp_n = '\ ';
} else {
    $prob_resp_s = '\ ';
    $prob_resp_n = ' ';
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
if ($data_informe['piel_fanereos_desc'] == '') {
    $piel_fane_s = ' ';
    $piel_fane_n = '\ ';
    $piel_fanereos_desc = '';
} else {
    $piel_fane_s = '\ ';
    $piel_fane_n = ' ';
    $piel_fanereos_desc = ': <span class="descripcionCheck">'.$data_informe['piel_fanereos_desc'].'</span>';
}
if ($data_informe['adenopatias_desc'] == '') {
    $adenop_s = ' ';
    $adenop_n = '\ ';
    $adenopatias_desc = '';
} else {
    $adenop_s = '\ ';
    $adenop_n = ' ';
    $adenopatias_desc = ': <span class="descripcionCheck">'.$data_informe['adenopatias_desc'].'</span>';
}
if ($data_informe['tiroides'] == '') {
    $tiroides_s = ' ';
    $tiroides_n = '\ ';
    $tiroides = '';
} else {
    $tiroides_s = '\ ';
    $tiroides_n = ' ';
    $tiroides = ': <span class="descripcionCheck">'.$data_informe['tiroides'].'</span>';
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
if ($data_informe['ritmo'] == 'R') {
    $ritmo_s = ' ';
    $ritmo_n = '\ ';
} else {
    $ritmo_s = '\ ';
    $ritmo_n = ' ';
}
if ($data_informe['soplos'] == '') {
    $soplos_s = ' ';
    $soplos_n = '\ ';
    $soplos_desc = '';
} else {
    $soplos_s = '\ ';
    $soplos_n = ' ';
    $soplos_desc = ': <span class="descripcionCheck">'.$data_informe['soplos'].'</span>';
}
if ($data_informe['edema_extremedides'] == '') {
    $edema_extr_s = ' ';
    $edema_extr_n = '\ ';
    $edema_extr_desc = '';
} else {
    $edema_extr_s = '\ ';
    $edema_extr_n = ' ';
    $edema_extr_desc = ': <span class="descripcionCheck">'.$data_informe['edema_extremedides'].'</span>';
}
if ($data_informe['venas_yugulares'] == '') {
    $venas_s = ' ';
    $venas_n = '\ ';
    $venas_desc = '';
} else {
    $venas_s = '\ ';
    $venas_n = ' ';
    $venas_desc = ': <span class="descripcionCheck">'.$data_informe['venas_yugulares'].'</span>';
}
if ($data_informe['varices'] == '') {
    $varices_s = ' ';
    $varices_n = '\ ';
    $varices_desc = '';
} else {
    $varices_s = '\ ';
    $varices_n = ' ';
    $varices_desc = ': <span class="descripcionCheck">'.$data_informe['varices'].'</span>';
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
if ($data_informe['palpable_central'] == 'P') {
    $palpable_1_p = '\ ';
    $palpable_1_n = ' ';
} else {
    $palpable_1_p = ' ';
    $palpable_1_n = '\ ';
}
if ($data_informe['palpable_periferico'] == 'P') {
    $palpable_2_p = '\ ';
    $palpable_2_n = ' ';
} else {
    $palpable_2_p = ' ';
    $palpable_2_n = '\ ';
}
////////////////////////////////////////////////////////////////////////////////
if ($data_informe['acost_pulmonar'] == '') {
    $acost_pul_s = ' ';
    $acost_pul_n = '\ ';
    $acost_pul_desc = '';
} else {
    $acost_pul_s = '\ ';
    $acost_pul_n = ' ';
    $acost_pul_desc = ': <span class="descripcionCheck">'.$data_informe['acost_pulmonar'].'</span>';
}
if ($data_informe['palpacion_abdo'] == '') {
    $palp_abdo_s = ' ';
    $palp_abdo_n = '\ ';
    $palp_abdo_desc = '';
} else {
    $palp_abdo_s = '\ ';
    $palp_abdo_n = ' ';
    $palp_abdo_desc = ': <span class="descripcionCheck">'.$data_informe['palpacion_abdo'].'</span>';
}
if ($data_informe['auscultacion'] == '') {
    $auscultacion_s = ' ';
    $auscultacion_n = '\ ';
    $auscultacion_desc = '';
} else {
    $auscultacion_s = '\ ';
    $auscultacion_n = ' ';
    $auscultacion_desc = ': <span class="descripcionCheck">'.$data_informe['auscultacion'].'</span>';
}
////////////////////////////////////////////////////////////////////////////////
if ($data_informe['conclusion_ecg'] == '') {
    $conclusion_ecg_s = ' ';
    $conclusion_ecg_n = '\ ';
} else {
    $conclusion_ecg_s = '\ ';
    $conclusion_ecg_n = ' ';
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$examen_labo_1 = '';
$examen_labo_2 = '';
$con = count($data_informe['examen_labo']) / 2;
$con = ceil($con);

$nombres = [
    'bun' => 'BUN',
    'colesterol_total' => 'Colesterol Total',
    'colesterol_ldl' => 'Colesterol LDL',
    'colesterol_hdl' => 'Colesterol HDL',
    'trigliceridos' => 'Trigliceridos',
    'glicemia' => 'Glicemia',
    'acido_urico' => 'Ácido úrico',
    'hemoglobina' => 'Hemoglobina',
    'hematocrito' => 'Hematocrito',
    'plaquetas' => 'Plaquetas',
    'leucocitos' => 'Leucocitos',
    'ferritina' => 'Ferritina',
    'sodio' => 'Sodio',
    'potasio' => 'Potasio',
    'creatinina' => 'Creatinina'
];

for ($i = 0; $i < count($data_informe['examen_labo']); $i++) {
    if ($con > $i) {
        $examen_labo_1 .= '
        <tr>
            <td style="padding: 2px 4px;">'.$nombres[$data_informe['examen_labo'][$i]['tipo_examen']].'</td>
            <td style="padding: 2px 4px;">'.$data_informe['examen_labo'][$i]['resultados'].'</td>
        </tr>
        ';
    } else {
        $examen_labo_2 .= '
        <tr>
            <td style="padding: 2px 4px;">'.$nombres[$data_informe['examen_labo'][$i]['tipo_examen']].'</td>
            <td style="padding: 2px 4px;">'.$data_informe['examen_labo'][$i]['resultados'].'</td>
        </tr>
        ';
    }
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
if ($data_informe['habilitado'] == 'N') {
    $habilitado_s = ' ';
    $habilitado_n = '\ ';
} else {
    $habilitado_s = '\ ';
    $habilitado_n = ' ';
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$data.='
    <div class="fontFamily" style="position: relative; height: 30px;">
        <div style="position: absolute; border: 1px solid #999;height: 0px; width: 100%;left: 1px;"></div>
        
        <img src="../../img/logo_informe_medico.png" style="position: absolute; height: 98px;top: -36px; left: 11px;">
        <img src="../../img/foto_jugador.png" style="border: 1px solid #999; border-radius: 55px 55px 55px 55px; width: 110px; position: absolute; right: -15px; top: -36px;">
        
        <div style="position: absolute; top: -45px;">
            <h5 style="text-align: center; margin-bottom: 10px;">ÁREA MÉDICA SANTIAGO WANDERERS</h5>
            <p style="text-align: center; font-size: 12px;">Evaluación médica Pre - Competitiva</p>
        </div>
    </div>
    
    <hr style="width: 113%; left: -45px;position: relative; z-index: -2;">
    
    <h6 class="fontFamily" style="text-align: center; margin-bottom: 30px; text-decoration: underline; margin-top: 15px; font-size: 10px;">IDENTIFICACIÓN DEL JUGADOR</h6>
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px;">
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>Nombre:</b> '.$data_jugador['nombre'].' '.$data_jugador['apellido1'].' '.$data_jugador['apellido2'].'</span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>Fecha Nacimiento:</b> '.$diaN.'-'.$mesN.'-'.$anoN.' ('.$edad.' años)</span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>Nacionalidad:</b> '.$data_jugador['nacionalidad'].'</span><br>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>Posición:</b> '.$posicion[$data_jugador['posicion_jugador']].'</span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>Lateralidad:</b> '.$lateralidad[$data_informe['pierna_dominante']].'</span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>Partidos últimos 12 meses:</b> '.$data_informe['numero_partidos'].'</span>
    </div>
  
    <hr>
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">ANTECEDENTES MÉDICOS</h6>
        
        <p style="font-size: 11px; margin-bottom: -4px;">ENFERMEDADES CRÓNICAS: <span class="check">'.$ec_n.'</span> NO  <span class="check">'.$ec_s.'</span> SI'.$enfermedades_cronicas.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">CIRUGÍAS: <span class="check">'.$cir_n.'</span> NO  <span class="check">'.$cir_s.'</span> SI'.$cirugias.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">MEDICAMENTOS: <span class="check">'.$medic_n.'</span> NO  <span class="check">'.$medic_s.'</span> SI'.$medicamentos.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">HÁBITOS: <span class="check">'.$habi_n.'</span> NO  <span class="check">'.$habi_s.'</span> SI'.$habitos.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">ALERGIAS: <span class="check">'.$alerg_n.'</span> NO  <span class="check">'.$alerg_s.'</span> SI'.$alergias.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">INFECCIONES RESPIRATORIAS (en últimas 4 semanas): <span class="check">'.$inR_n.'</span> NO  <span class="check">'.$inR_s.'</span> SI</p>
        '.$infecciones_respiratorias.'
        <p style="font-size: 11px; margin-bottom: -4px;">INFECCIONES GASTROINTESTINALES (en ultimas 4 semanas): <span class="check">'.$inG_n.'</span> NO  <span class="check">'.$inG_s.'</span> SI</p>
        '.$infecciones_gastrointes.'
    </div>
    
    <div class="fontFamily" style="margin: 10px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['notas_antecesdentes_gen'].'</div>
    
    <div class="fontFamily" style="padding: 0 20px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">ANTECEDENTES FAMILIARES <span style="font-weight: normal;">(Hombres &#60; 55 años - mujeres &#60; 65 años)</span></h6>
    </div>
    
    <div class="fontFamily" style="padding: 0 20px;">
        <table class="fontFamily" border="1" style="border-collapse:collapse; width: 100%; font-size: 11px;">
            <tr>
                <th style="width: 30%;">Antecedente</th>
                <th style="text-align:center;">No</th>
                <th style="text-align:center;">Sí</th>
                <th style="width: 60%;">Parentesco</th>
            </tr>
            <tr>
                <td>Muerte Súbita</td>
                <td style="text-align:center;">'.$ant_fam_n_1.'</td>
                <td style="text-align:center;">'.$ant_fam_s_1.'</td>
                <td>'.$data_informe['muerte_subita'].'</td>
            </tr>
            <tr>
                <td>Enfermedad Coronaria</td>
                <td style="text-align:center;">'.$ant_fam_n_2.'</td>
                <td style="text-align:center;">'.$ant_fam_s_2.'</td>
                <td>'.$data_informe['enfermedad_coronaria'].'</td>
            </tr>
            <tr>
                <td>Miocardiopatías</td>
                <td style="text-align:center;">'.$ant_fam_n_3.'</td>
                <td style="text-align:center;">'.$ant_fam_s_3.'</td>
                <td>'.$data_informe['miocardiopatia'].'</td>
            </tr>
            <tr>
                <td>HTA</td>
                <td style="text-align:center;">'.$ant_fam_n_4.'</td>
                <td style="text-align:center;">'.$ant_fam_s_4.'</td>
                <td>'.$data_informe['hta'].'</td>
            </tr>
            <tr>
                <td>Síncopes recurrentes</td>
                <td style="text-align:center;">'.$ant_fam_n_5.'</td>
                <td style="text-align:center;">'.$ant_fam_s_5.'</td>
                <td>'.$data_informe['sincopes_recurrentes'].'</td>
            </tr>
            <tr>
                <td>Arritmias</td>
                <td style="text-align:center;">'.$ant_fam_n_6.'</td>
                <td style="text-align:center;">'.$ant_fam_s_6.'</td>
                <td>'.$data_informe['arritmias'].'</td>
            </tr>
            <tr>
                <td>Cirugía Cardíaca</td>
                <td style="text-align:center;">'.$ant_fam_n_7.'</td>
                <td style="text-align:center;">'.$ant_fam_s_7.'</td>
                <td>'.$data_informe['cirugia_cardiaca'].'</td>
            </tr>
            <tr>
                <td>Marcapasos/Desfibrilador</td>
                <td style="text-align:center;">'.$ant_fam_n_8.'</td>
                <td style="text-align:center;">'.$ant_fam_s_8.'</td>
                <td>'.$data_informe['marcapasos_des'].'</td>
            </tr>
            <tr>
                <td>Sd. Marfán</td>
                <td style="text-align:center;">'.$ant_fam_n_9.'</td>
                <td style="text-align:center;">'.$ant_fam_s_9.'</td>
                <td>'.$data_informe['sd_marfan'].'</td>
            </tr>
            <tr>
                <td>Accidente Cerebrovascular</td>
                <td style="text-align:center;">'.$ant_fam_n_10.'</td>
                <td style="text-align:center;">'.$ant_fam_s_10.'</td>
                <td>'.$data_informe['acv'].'</td>
            </tr>
            <tr>
                <td>Diabetes</td>
                <td style="text-align:center;">'.$ant_fam_n_11.'</td>
                <td style="text-align:center;">'.$ant_fam_s_11.'</td>
                <td>'.$data_informe['diabetes'].'</td>
            </tr>
            <tr>
                <td>Cáncer</td>
                <td style="text-align:center;">'.$ant_fam_n_12.'</td>
                <td style="text-align:center;">'.$ant_fam_s_12.'</td>
                <td>'.$data_informe['cancer'].'</td>
            </tr>
            <tr>
                <td>Accidente automovilístico /
                Ahogamiento inexplicados</td>
                <td style="text-align:center;">'.$ant_fam_n_13.'</td>
                <td style="text-align:center;">'.$ant_fam_s_13.'</td>
                <td>'.$data_informe['accidente_auto'].'</td>
            </tr>
            <tr>
                <td>Otro</td>
                <td style="text-align:center;">'.$ant_fam_n_14.'</td>
                <td style="text-align:center;">'.$ant_fam_s_14.'</td>
                <td>'.$data_informe['otro'].'</td>
            </tr>
        </table>
    </div>
    
    <div class="fontFamily" style="margin: 10px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['notas_antecedentes_fam'].'</div>
    
    
    
    
    
    <div class="fontFamily" style="padding: 0 20px; margin-top: -20px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">ANTECEDENTES TRAUMATOLÓGICOS</h6>
    </div>
    
    <div class="fontFamily" style="padding: 0 20px; margin-bottom: 20px;">
        <table class="fontFamily" border="1" style="border-collapse:collapse; width: 100%; font-size: 11px;">
            <tr>
                <th style="width: 15%;">Antecedente</th>
                <th class="center" style="width: 3%;">No</th>
                <th class="center" style="width: 3%;">Sí</th>
                <th class="center" style="width: 5%;">Año</th>
                <th style="width: 24.5%">Área Afectada</th>
                <th style="width: 24.5%">Lateralidad (izq/der)</th>
                <th style="">Tiempo de ausencia deportiva</th>
            </tr>
            '.$anteTraumatologicos.'
        </table>
    </div>
    
    <div class="fontFamily" style="margin: 10px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['notas_antecedentes_trau'].'</div>
    
    <div class="fontFamily" style="padding: 0 20px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">ANTECEDENTES CARDIOVASCULARES/RESPIRATORIOS</h6>
    </div>
    
    <div class="fontFamily" style="padding: 0 20px; margin-bottom: 20px;">
        <table class="fontFamily" border="1" style="border-collapse:collapse; width: 80%; font-size: 11px; margin: auto;">
            <tr>
                <th>Antecedente</th>
                <th class="center" style="width: 10%;">No</th>
                <th class="center" style="width: 10%;">Sí</th>
            </tr>
            <tr>
                <td>Angina de esfuerzo</td>
                <td class="center">'.$ant_ang_n.'</td>
                <td class="center">'.$ant_ang_s.'</td>
            </tr>
            <tr>
                <td>Palpitaciones</td>
                <td class="center">'.$ant_palpi_n.'</td>
                <td class="center">'.$ant_palpi_s.'</td>
            </tr>
            <tr>
                <td>Síncopes</td>
                <td class="center">'.$sincopes_n.'</td>
                <td class="center">'.$sincopes_s.'</td>
            </tr>
            <tr>
                <td>Disnea desproporcionada durante el ejercicio</td>
                <td class="center">'.$ant_dis_desp_n.'</td>
                <td class="center">'.$ant_dis_desp_s.'</td>
            </tr>
            <tr>
                <td>Fatiga desproporcionada durante el ejercicio</td>
                <td class="center">'.$ant_fat_desp_n.'</td>
                <td class="center">'.$ant_fat_desp_s.'</td>
            </tr>
            <tr>
                <td>Síntomas obstructivos durante/post ejercicio</td>
                <td class="center">'.$ant_sint_ob_n.'</td>
                <td class="center">'.$ant_sint_ob_s.'</td>
            </tr>
            <tr>
                <td>Otros problemas cardíacos</td>
                <td class="center">'.$prob_card_n.'</td>
                <td class="center">'.$prob_card_s.'</td>
            </tr>
            <tr>
                <td>Otros problemas respiratorios</td>
                <td class="center">'.$prob_resp_n.'</td>
                <td class="center">'.$prob_resp_s.'</td>
            </tr>
        </table>
    </div>
    
    <div class="fontFamily" style="margin: 10px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['notas_antecedentes_cardio'].'</div>
    
    <div class="fontFamily" style="padding: 0 20px;">
        <h6 style="margin-bottom: 10px; text-decoration: underline; margin-top: 23px; font-size: 10px;">EXAMEN FÍSICO</h6>
    </div>
    
    <div class="fontFamily" style="width: 100%; padding: 0 40px;">
        <span style="font-size: 11px; display: inline-block; width: 25%; margin-bottom: 10px;"></span>
        <span style="font-size: 11px; display: inline-block; width: 25%; margin-bottom: 10px;"><b class="inline-block" style="width: 35px; margin-top: 3px;">Peso:</b> '.$data_informe['peso'].' kgs</span>
        <span style="font-size: 11px; display: inline-block; width: 25%; margin-bottom: 10px;"><b class="inline-block" style="width: 35px; margin-top: 3px;">Talla:</b> '.$data_informe['talla'].' cms</span>
        <span style="font-size: 11px; display: inline-block; width: 25%; margin-bottom: 10px;"><b class="inline-block" style="width: 35px; margin-top: 3px;">IMC:</b> '.$data_informe['imc'].' </span><br>
        
        <span style="font-size: 11px; display: inline-block; width: 25%; margin-bottom: 10px;"><b class="inline-block" style="margin-top: 3px;">Signos vitales:</b></span>
        <span style="font-size: 11px; display: inline-block; width: 25%; margin-bottom: 10px;"><b class="inline-block" style="width: 35px; margin-top: 3px;">PA:</b> '.$data_informe['pa'].' mmHg</span>
        <span style="font-size: 11px; display: inline-block; width: 25%; margin-bottom: 10px;"><b class="inline-block" style="width: 35px; margin-top: 3px;">T°:</b> '.$data_informe['temperatura'].' C°</span>
        <span style="font-size: 11px; display: inline-block; width: 25%; margin-bottom: 10px;"><b class="inline-block" style="width: 35px; margin-top: 3px;">Fc:</b> '.$data_informe['fc'].' lpm</span>
    </div>
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px; margin-bottom: 10px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">EXPLORACIÓN GENERAL</h6>
        
        <p style="font-size: 11px; margin-bottom: -4px;">PIEL Y FANÉREOS: <span class="check">'.$piel_fane_n.'</span> Normal  <span class="check">'.$piel_fane_s.'</span> Anormal'.$piel_fanereos_desc.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">ADENOPATÍAS: <span class="check">'.$adenop_n.'</span> Normal  <span class="check">'.$adenop_s.'</span> Anormal'.$adenopatias_desc.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">TIROIDES: <span class="check">'.$tiroides_n.'</span> Normal  <span class="check">'.$tiroides_s.'</span> Anormal'.$tiroides.'</p>
    </div>
    
    <div class="fontFamily" style="margin: 20px 20px 20px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['notas_examen_fisico'].'</div>




    <div class="fontFamily" style="padding: 0 20px; margin-top: -20px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">EXPLORACIÓN SEGMENTARIA</h6>
    </div>
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px; margin-bottom: 10px; margin-top: -23px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; font-size: 10px;">CARDIOVASCULAR</h6>
        
        <p style="font-size: 11px; margin-bottom: -4px;">RITMO: <span class="check">'.$ritmo_n.'</span> Regular  <span class="check">'.$ritmo_s.'</span> Irregular</p>
        <p style="font-size: 11px; margin-bottom: -4px;">SOPLOS: <span class="check">'.$soplos_n.'</span> Normal/Ausentes  <span class="check">'.$soplos_s.'</span> Anormal'.$soplos_desc.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">EDEMA DE EXTREMIDADES: <span class="check">'.$edema_extr_n.'</span> Ausente  <span class="check">'.$edema_extr_s.'</span> Presente'.$edema_extr_desc.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">VENAS YUGULARES : <span class="check">'.$venas_n.'</span> Normal  <span class="check">'.$venas_s.'</span> Anormal'.$venas_desc.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">VÁRICES: <span class="check">'.$varices_n.'</span> Ausente  <span class="check">'.$varices_s.'</span> Presente'.$varices_desc.'</p>
    </div>
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px;">
        <p style="font-size: 10px;">PRESIÓN ARTERIAL DIFERENCIAL (Posición supina, al menos 5 minutos en reposo):</p>
    
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b class="inline-block" style="width: 55px; margin-top: 3px;">Brazo Derecho:</b> '.$data_informe['brazo_derecho'].' mmHg</span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b class="inline-block" style="width: 55px; margin-top: 3px;">Brazo Izquierdo:</b> '.$data_informe['brazo_izquierdo'].' mmHg</span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b class="inline-block" style="width: 50px; margin-top: 3px;">Tobillo:</b> '.$data_informe['tobillo'].' mmHg <br><span class="block" style="font-size: 9px;">(*Sólo en caso de sospecha clínica)</span></span><br>
    </div>
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px;">
        <p style="font-size: 10px;">PULSOS (especificar, registrar simetría con signo “+” separando derecha/izquierda):</p>
    
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>Central:</b> '.$data_informe['central'].'</span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>[ Simetría:</b> '.$data_informe['simetria_central'].' <b>]</b></span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><span class="check">'.$palpable_1_p.'</span> Palpable <span class="check">'.$palpable_1_n.'</span> No alpable </span><br>
        
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>Periférico:</b> '.$data_informe['periferico'].'</span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><b>[ Simetría:</b> '.$data_informe['simetria_periferica'].' <b>]</b></span>
        <span style="font-size: 11px; display: inline-block; width: 33%; margin-bottom: 10px;"><span class="check">'.$palpable_2_p.'</span> Palpable <span class="check">'.$palpable_2_n.'</span> No alpable </span>
    </div>
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px; margin-bottom: 10px; margin-top: -10px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">RESPIRATORIO</h6>
        
        <p style="font-size: 11px; margin-bottom: -4px;">AUSCULTACIÓN PULMONAR: <span class="check">'.$acost_pul_n.'</span> Normal  <span class="check">'.$acost_pul_s.'</span> Anormal'.$acost_pul_desc.'</p>
    </div>
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px; margin-bottom: 10px; margin-top: -10px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">ABDOMINAL</h6>
        
        <p style="font-size: 11px; margin-bottom: -4px;">PALPACIÓN: <span class="check">'.$palp_abdo_n.'</span> Normal <span class="check">'.$palp_abdo_s.'</span> Anormal'.$palp_abdo_desc.'</p>
        <p style="font-size: 11px; margin-bottom: -4px;">AUSCULTACIÓN: <span class="check">'.$auscultacion_n.'</span> Normal  <span class="check">'.$auscultacion_s.'</span> Anormal'.$auscultacion_desc.'</p>
    </div>
    
    <div class="fontFamily" style="margin: 20px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['notas_exploracion_seg'].'</div>

    <div class="fontFamily" style="padding: 0 20px; margin-top: -15px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">ELECTROCARDIOGRAMA DE 12 DERIVACIONES</h6>
    </div>
    
    <div class="fontFamily" style="padding: 0 20px; margin-top: -15px;">
        <h6 style="margin-bottom: 20px; text-decoration: underline; margin-top: 23px; font-size: 10px;">DESCRIPCIÓN ELECTROCARDIOGRAMA</h6>
    </div>
    <div class="fontFamily" style="margin: 20px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['descripcion_electro'].'</div>
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px; margin-bottom: 10px; margin-top: 10px;">
        <p style="font-size: 11px; margin-bottom: -4px;">CONCLUSIÓN ECG: <span class="check">'.$conclusion_ecg_n.'</span> Normal  <span class="check">'.$conclusion_ecg_s.'</span> Anormal</p>
    </div>
    <div class="fontFamily" style="margin: 10px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['conclusion_ecg'].'</div>
    
    
    
    
    
    <div class="center">
        <img src="../../electrocardiograma.png" style="height: 320px;">
    </div>
    <div class="fontFamily" style="width: 100%; padding: 0 20px; margin-bottom: 0px; margin-top: -20px;">
        <p style="font-size: 10px; ">Analizar hallazgos según criterios de Seattle (2017). En caso de dudas, consultar a especialista.</p>
    </div>
    
    <div class="fontFamily" style="padding: 0 20px;">
        <h6 style="margin-bottom: 10px; text-decoration: underline; margin-top: 10px; font-size: 10px;">EVALUACIÓN VISUAL</h6>
    </div>
    <div class="fontFamily" style="margin: 10px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['evaluacion_visual'].'</div>

    <div class="fontFamily" style="padding: 0 20px;">
        <h6 style="margin-bottom: 10px; text-decoration: underline; margin-top: 23px; font-size: 10px;">EXÁMENES DE LABORATORIO</h6>
    </div>
    <div class="fontFamily" style="padding: 0 20px; position: relative;">
        <table class="fontFamily" border="1" style="border-collapse:collapse; width: 48%; font-size: 11px; margin:10px 0px ;">
            <tr>
                <th style="width: 30%;">Parámetro</th>
                <th style="width: 70%;">Resultado</th>
            </tr>
            '.$examen_labo_1.'
        </table>
        
        <table class="fontFamily" border="1" style="border-collapse:collapse; width: 48%; font-size: 11px; position: absolute; top: 0px; right: 20px;">
            <tr>
                <th style="width: 30%;">Parámetro</th>
                <th style="width: 70%;">Resultado</th>
            </tr>
            '.$examen_labo_2 .'
        </table>
    </div>
    
    <div class="fontFamily" style="padding: 0 20px;">
        <h6 style="margin-bottom: 10px; text-decoration: underline; margin-top: 13px; font-size: 10px;">OTROS EXÁMENES</h6>
    </div>
    <div class="fontFamily" style="margin: 10px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['otros_examenes'].'</div>
    
    <div class="fontFamily" style="padding: 0 20px;">
        <h6 style="margin-bottom: 10px; text-decoration: underline; margin-top: 13px; font-size: 10px;">EVALUACIÓN MÚSCULO-ESQUELÉTICA</h6>
    </div>
    <div class="fontFamily" style="margin: 10px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['evaluacion_musculo'].'</div>
    
    
    
    
    <div class="fontFamily" style="width: 100%; padding: 0 20px;">
        <p style="font-size: 11px; margin-bottom: -4px;">Fecha: '.substr($data_informe['fecha_em'],8,2).'-'.substr($data_informe['fecha_em'],5,2).'-'.substr($data_informe['fecha_em'],0,4).'</p>
    </div>
    
    <div class="fontFamily" style="padding: 0 20px;">
        <h6 style="margin-bottom: 10px; text-decoration: underline; margin-top: 13px; font-size: 10px;">EVALUACIÓN NUTRICIONAL</h6>
    </div>
    <div class="fontFamily" style="margin: 10px 20px 0px; height: 70px; border: 1px solid #999999; border-radius: 10px 10px 10px 10px; font-size: 12px; padding: 5px;">'.$data_informe['evaluacion_nutricional'].'</div>

    <div class="fontFamily" style="width: 100%; padding: 0 20px;">
        <p style="font-size: 11px; margin-bottom: -4px;">Fecha: '.substr($data_informe['fecha_en'],8,2).'-'.substr($data_informe['fecha_en'],5,2).'-'.substr($data_informe['fecha_en'],0,4).'</p>
        
        <p style="font-size: 11px; margin-bottom: -4px;">HABILITADO PARA LA PRÁCTICA DE FUTBOL COMPETITIVO: <span class="check">'.$habilitado_s.'</span> SI <span class="check">'.$habilitado_n.'</span> NO </p>
        
        <p style="font-size: 11px; margin-bottom: -4px;">Fecha: '.substr($data_informe['fecha'],8,2).'-'.substr($data_informe['fecha'],5,2).'-'.substr($data_informe['fecha'],0,4).'</p>
    </div>
';
    
require_once('../../../dompdf/autoload.inc.php');
require_once ('../../../dompdf/lib/html5lib/Parser.php');
require_once ('../../../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php');
require_once ('../../../dompdf/lib/php-svg-lib/src/autoload.php');
require_once ('../../../dompdf/src/Autoloader.php');
use Dompdf\Dompdf;
/////////////////////////////// CONFIGURACION DEL DOCUMENTO /////////////////////////////
$pdf = new Dompdf();
$pdf->setPaper('letter', 'portrait');  //A4, letter  ;  portrait (posicion vertical; landscape (posición horizontal))
$titulo_documento_salida = "[11Analytics]_informe_medico.pdf";
/////////////////////////////////////////////////////////////////////////////////////////

$html='<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
@font-face {
  font-family: "Helvetica";
}
.fontFamily {
    font-family: helvetica;
}
table td {
    font-size: 11px;
}
.center {
    text-align:center;
}
.inline-block {
    display: inline-block
}
.block {
    display: block
}
/* ------------ ---------------- */
.check {
    display: inline-block;
    width: 15px;
    height: 15px;
    border: 1px solid #999; line-height: 15px;
    border-radius: 3px 3px 3px 3px;
    margin-left: 10px;
    margin-right: 5px;
    text-align: center;
}
.descripcionCheck {
    display: inline-block;
    width: 350px;
    border-bottom: 1px solid #999999;
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
$output = $pdf->output();
file_put_contents("../../reportes_pdf/".$titulo_documento_salida, $output);
echo json_encode($titulo_documento_salida);
?>