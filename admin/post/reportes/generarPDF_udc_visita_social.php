<?php 
include('../../../bd/udc_ficha_social_BD.php');

$data='';

$datos_informe = buscar_datosPDF( $_POST['idudc_visita_social'] );

$data.= '


  <!-- ================================ Inicio del cuerpo ================================ -->
  <main>

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

    <!-- ================================ Inicio del class="txCenter" ================================ -->
    <div class="txCenter div-body" style="box-sizing: border-box; width: 95%; margin: auto; margin-top: 10px;">

        <div style="margin-top: 0px; max-width: 625px; margin: auto; width: 625px; /*background-color: orange;*/">

            <p  style="text-align: center; margin-top: 2px; margin-bottom: 25px; font-size: 14px; color: #4e4e4e;" class="big-text">FICHA SOCIAL</p>
            
            <!-- VERSIÓN QUE FUNCIONA EN LOCAL -->
            <!--
            <img src="../../../config/foto_jugador.png" style="width: 100px; height: 100px; border-radius: 50px; border: solid 2px #c1c1c1; background-color: white;">
            -->

            <!-- VERSIÓN QUE FUNCIONA EN EL SERVIDOR -->
            <img src="../../../config/foto_jugador.png" style="width: 100px; height: 100px; border-radius: 50px; border: solid 2px #c1c1c1; background-color: white; margin-top: -17px; margin-bottom: 20px;">            

            <div style="border-top: 2px solid black; border-bottom: 2px solid black; width: 25%; margin: auto; margin-top: -18px;">
                <p style="background-color: transparent; text-transform: uppercase; font-family: Open Sans, sans-serif!important; font-size: 9px; font-weight: bold; margin-top: 3px; margin-bottom: 1px">Edgar Aldana</p>
                <p style="background-color: transparent; text-transform: capitalize; font-family: Open Sans, sans-serif!important; font-size: 9px; font-weight: normal; margin: 1px 0px;">voltante ofensivo</p>
            </div>  
        </div>

        
        <!-- ============================================================================================================ -->
        <center>
            <div style="background-color: transparent; margin-top: 25px; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">domicilio</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>
        
        <table class="bottom-space-modal tabla-item" style="width: 90%;">
            <tbody>
                <tr>
                   <th style="width: 50px;">Nombre:</th>
                   <td class="nombrecompleto-jugador-modal"></td>
                
                   <th>Serie:</th>
                   <td class="serie-jugador-modal"></td>
                   
                   <th style="width: 105px;">Domicilio Actual:</th>
                   <td class="domicilio-actual-jugador-modal"></td>
                   
                   <th style="width: 55px;">Comuna:</th>
                   <td class="comuna-jugador-modal"></td>
                   
                   <th style="width: 135px;">Comuna Procedencia:</th>
                   <td class="comuna-procedencia-jugador-modal"></td>
                </tr>                                                                                  
            </tbody>                 
        </table>   


        <!-- ============================================================================================================ -->
        <center>
            <div style="background-color: transparent; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">APODERADO</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>        

        <table class="bottom-space-modal tabla-item" style="width: 90%; margin: auto; clear: both; margin-bottom: 20px;">
            <tbody>
                <tr>
                   <th style="width: 50px;">Nombre:</th>
                   <td style="width: 140px;" class="nombre-apoderado-modal"></td>
                   
                   <th style="width: 75px;">Parentesco:</th>
                   <td class="parentesco-apoderado-modal" style="width: 95px;"></td>
                   
                   <th style="width: 55px;">Correo:</th>
                   <td class="correo-apoderado-modal" style="width: 155px;"></td>
                   
                   <th style="width: 60px;">Teléfono:</th>
                   <td class="telefono-apoderado-modal"></td>
                </tr>                                                                                  
            </tbody>                 
        </table>   

        <!-- ============================================================================================================ -->
        <center>
            <div style="background-color: transparent; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">Antecedentes Familiares</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>  
        
        <table class="bottom-space-modal" style="width:100%; margin-top: 20px; margin-bottom: 15px; clear: both;">
            <tbody>
                <tr>
                    <th style="width: 50px;">Nº Personas grupo familiar:</th>
                    <td class="af_num_personas_gf_modal" style="width: 10px;">5</td>
                    
                    <th style="width: 80px;">Nº Personas que viven en el domicilio del jugador:</th>
                    <td class="af_num_personas_domicilio_modal" style="width: 10px;">2</td>
                    
                    <th style="width: 50px;">Nº Habitaciones del domicilio:</th>
                    <td class="af_num_habitaciones_domicilio_modal" style="width: 10px;">1</td>
                    
                    <th style="width: 30px;">Tipo de domicilio:</th>
                    <td class="af_comparte_habitacion_modal" style="width: 10px;">Sí</td>
                </tr>            
            </tbody>                 
        </table>
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 15px; margin-bottom: 15px; clear: both;">
            <tbody>
                <tr>
                    <th style="width: 80px;">Comparte habitación:</th>
                    <td class="af_num_personas_gf_modal" style="width: 10px;">5</td>
                    
                    <th style="width: 80px;">Principal Sostenedor:</th>
                    <td class="af_num_personas_domicilio_modal" style="width: 70px;">Pareja de un familiar</td>
                    
                    <th style="width: 80px;">Ingreso núcleo familiar:</th>
                    <td class="af_num_habitaciones_domicilio_modal" style="width: 25px;">$764.000</td>
                    
                    <th style="width: 100px;">Es independiente económicamente:</th>
                    <td class="af_comparte_habitacion_modal" style="width: 10px;">Sí</td>
                </tr>            
            </tbody>                 
        </table>
        <!-- ============================================================================================================ -->        
        <table class="bottom-space-modal" style="width:100%; margin-bottom: 15px;">
            <tbody>
                <tr>                    
                    <th style="width: 205px;">Situación conyugal de sus padres:</th>
                    <td class="af_situacion_conyugal_padres_modal"></td>

                    <th style="width: 144px;">Nº Hermanos:</th>
                    <td class="af_ingreso_nucleo_familiar_modal" style="width: 70px;"5</td>                    
                </tr>                    
            </tbody>                 
        </table>                 
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <p style="text-transform: uppercase;color: black; text-align: left;">detalle personas que viven con el jugador</p>
            <div style="border-bottom: 2px solid black; height: 2px; width: 215px; position: relative; top: -5px;"></div>
        </div>        
        <!-- ============================================================================================================ -->
        <table id="tabla_personas_viven_conjug_modal" class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody></tbody>                 
        </table>  
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <p style="text-transform: uppercase; color: black; text-align: left;">INFORMACIÓN RELEVANTE DEL GRUPO FAMILIAR DEL JUGADOR</p>
            <div style="border-bottom: 2px solid black; height: 2px; width: 277px; position: relative; top: -5px;"></div>
        </div>
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th class="af_info_grupo_familiar_modal"></th>
            </tbody>                 
        </table>         
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;">
                        <p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DEL ENTORNO FAMILIAR</p>
                        <div style="border-bottom: 2px solid black; height: 2px; width: 220px; position: relative; top: -5px; margin: auto;
                            "></div>                        
                    </div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="af_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="af_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                            
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->

        <!-- ============================================================================================================ -->
        <center>
            <div style="background-color: transparent; margin-top: 25px; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">Relaciones personales</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>             
        
        <table class="bottom-space-modal table-tr-separate" style="width:100%; margin-top: 15px; margin-bottom: 15px; clear: both;">
            <tbody>
                <tr>
                    <th style="width: 120px;">Situación amorosa:</th>
                    <td class="rp_situacion_amorosa_modal" style="width: 90px;"></td>
                    
                    <th>Hace:</th>
                    <td class="rp_hace_cuanto_modal" style="width: 50px;"></td>
                    
                    <th style="width: 195px;">Calidad de la relación en pareja:</th>
                    <td class="rp_relacion_pareja_modal" style="width: 110px;"></td>
                    
                    <th style="width: 110px;">Inició vida sexual:</th>
                    <td style="width: 30px;" class="rp_inicio_vida_sexual_modal"></td>

                    <th style="width: 140px;">Método de protección:</th>
                    <td class="rp_metodo_proteccion_modal"></td>                    
                </tr>
                <!-- ============================================================================================================ --> 
                <tr>
                    <th>Tiene hijos:</th>
                    <td class="rp_tiene_hijos_modal"></td>
                </tr>                   
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DE LAS RELACIONES PERSONALES</p></div>
                    <div style="border-bottom: 2px solid black; height: 2px; width: 260px; position: relative; top: -5px; margin: auto;
                            "></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="rp_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="rp_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                              
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->        

        <!-- ============================================================================================================ -->
        <center>
            <div style="background-color: transparent; margin-top: 25px; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">Alimentación</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>                  
        
        <table class="bottom-space-modal tabla-item table-tr-separate" style="width:100%;">
            <tbody>
                <tr>
                    <th>Puede costear su alimentación:</th>
                    <td class="a_costear_alimentacion_modal"></td>
                    
                    <th>Observaciones:</th>
                    <td class="a_observaciones_modal"></td>                 
                </tr>
                <!-- ============================================================================================================ --> 
                <tr>
                    <th>Comidas que realiza en el club:</th>
                    <td class="a_comidas_club_modal"></td>
                    
                    <th>Comidas que realiza al día:</th>
                    <td class="a_comidas_diarias_modal"></td>                 
                </tr>                  
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DE LA ALIMENTACIÓN</p></div>
                    <div style="border-bottom: 2px solid black; height: 2px; width: 210px; position: relative; top: -5px; margin: auto;
                            "></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="a_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="a_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                            
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ --> 

        <!-- ============================================================================================================ -->
        <center>
            <div style="background-color: transparent; margin-top: 25px; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">Locomoción</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>   

        <table class="bottom-space-modal tabla-item" style="width:100%;">
            <tbody>
                <tr>
                    <th>Como llega al club:</th>
                    <td class="llegada_club_modal"></td>
                    
                    <th>Medio:</th>
                    <td class="mediotrans_llegada_club_modal"></td>  

                    <th>Como se va del club a su casa:</th>
                    <td class="ida_club_modal"></td>    

                    <th>Medio:</th>
                    <td class="mediotrans_ida_club_modal"></td>       
                    
                    <th>Observaciones:</th>
                    <td class="l_observaciones_modal">Sin observaciones</td>                                                                                 
                </tr>         
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DE LA LOCOMOCIÓN</p></div>
                    <div style="border-bottom: 2px solid black; height: 2px; width: 205px; position: relative; top: -5px; margin: auto;
                            "></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="l_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="l_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                           
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->  

        <!-- ============================================================================================================ -->
        <center>
            <div style="background-color: transparent; margin-top: 25px; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">Salud</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>   

        <!-- ============================================================================================================ -->
        <table class="tabla-item" style="width:100%;">
            <tbody>
                <tr>
                    <th>Consume drogas:</th>
                    <td class="s_consume_drogas_modal"></td>
                    
                    <th>Drogas que ha probado:</th>
                    <td class="drogas_probadas_jugador_modal"></td>  

                    <th>Familiar consume drogas:</th>
                    <td class="s_familiar_consume_drogas_modal"></td>    

                    <th>Quien / es:</th>
                    <td class="s_quien_consume_drogas_familiar_modal"></td>       
                    
                    <th>Que drogas:</th>
                    <td class="s_drogas_consumidas_familiar_modal"></td>                                                                                 
                </tr>         
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DE SALUD</p></div> 
                    <div style="border-bottom: 2px solid black; height: 2px; width: 160px; position: relative; top: -5px; margin: auto;
                            "></div>                   
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="s_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="s_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                            
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ --> 

        <!-- ============================================================================================================ -->
        <center>
            <div style="background-color: transparent; margin-top: 25px; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">Antecedentes judiciales</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>   

        <!-- ============================================================================================================ -->
        <table class="tabla-item" style="width:100%;">
            <tbody>
                <tr>
                    <th>Antecedentes:</th>
                    <td class="aj_jugador_antecedentes_modal"></td>
                    
                    <th>Familiar con antecedentes:</th>
                    <td class="aj_familiar_antecedentes_modal"></td>                                                                                  
                </tr>         
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO JUDICIAL</p></div>                    
                    <div style="border-bottom: 2px solid black; height: 2px; width: 150px; position: relative; top: -5px; margin: auto;
                            "></div>
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="aj_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="aj_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                              
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ --> 

        <!-- ============================================================================================================ -->
        <center>
            <div style="background-color: transparent; margin-top: 25px; width: 100%;">
                <div class="left-div-title"></div>
                <div class="middle-div-title">
                    <p style="">Otros datos</p>
                </div>
                <div class="right-div-title"></div>
            </div> 
        </center>   

        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal tabla-item" style="width:100%;">
            <tbody>
                <tr>
                    <th>Seguro contra accidentes:</th>
                    <td class="od_tiene_seguro_modal"></td>
                    
                    <th>Compañia:</th>
                    <td class="od_nombre_compania_seguro_modal"></td>   

                    <th>Vencimiento:</th>
                    <td class="od_seguro_vencimiento_modal"></td>          

                    <th>Tiene pasaporte:</th>
                    <td class="od_tiene_pasaporte_modal"></td>  
                    
                    <th>Venc. Carnet Identidad:</th>
                    <td class="od_vencimiento_carnetid_modal"></td>                                                                                                                            
                </tr>         
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">OBSERVACIONES</p></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span12" style="display: flex;">
                    <div id="od_observaciones_modal" class="big-text-modal" style="width: 70%; margin: auto;"></div>
                </div>                                                             
            </div>                            
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->        


    </div>
    <!-- ================================ Fin del class="txCenter" ================================ -->
  
  </main>

  <!-- ================================ Inicio del footer ================================ -->
  <footer></footer>
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
$titulo_documento_salida = "[11Analytics]_udc_visita_social.pdf";
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