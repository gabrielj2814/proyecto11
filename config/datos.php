<?PHP
    /////////////////////////////////////////////////////////////
    /////////////////////// CONFIGURACION //////////////////////
    /////////////////////////////////////////////////////////////
    $software_demo = 1; //1=activo 0=inactivo
    date_default_timezone_set('America/Santiago');
    $dominio                  = "www.11analytics.cl";
    $abreviacion_dominio      = "11Analytics";
    $nombre_pestana_navegador = "11A";
    ////////////////////////////////////////////////////////////////
    /////////////////////// DATOS DEL CLIENTE //////////////////////
    ////////////////////////////////////////////////////////////////
    $dominio_cliente         = " http://test11analytics.com/test11analytics.com/11analytics/";
    $nombre_club             = "11Analytics";
    $nombre_perfil           = "11Analytics"; 
    ////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////
    //////////////// HABILITACION MENU SOFTWARE ////////////////////
    ////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////
    ////////////////////////// MODULO 1 - INFORME SEMANAL //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['informe']                                         = true;
    $menu_lateral['informe_semanal']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['informe']                                                 = true;
    $demo['informe_semanal']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['informe_semanal']                               = 'informe_semanal.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['informe_semanal']                             = 36;

    // Colores:
    $color_fondo = "#209BF5;";
    $color_fondo_suave = "#bcdefd;";    
    ////////////////////////// MODULO 2 - INFORME mensual //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['informe']                                         = true;
    $menu_lateral['informe_mensual']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['informe']                                                 = true;
    $demo['informe_mensual']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['informe_mensual']                               = 'informe_mensual.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['informe_mensual']                             = 36;  
    ////////////////////////// MODULO 3 - ATENCIÓN DIARIA //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['atencion']                                         = true;
    $menu_lateral['atencion_diaria']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['atencion']                                                 = true;
    $demo['atencion_diaria']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['atencion_diaria']                               = 'atencion_diaria.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['atencion_diaria']                             = 36;
    ////////////////////////// MODULO 3.2 - ATENCIÓN DIARIA FEDERACION //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['atencion']                                         = true;
    $menu_lateral['atencion_diaria']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['atencion_federacion']                                                 = true;
    $demo['atencion_diaria_federacion']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['atencion_diaria_federacion']                               = 'atencion_diaria_federacion.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['atencion_diaria_federacion']                             = 36;
    ////////////////////////// MODULO 4 - SEGUIMIENTO MEDICO //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['seguro_medico']                                         = true;
    $menu_lateral['seguimiento']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['seguro_medico']                                                 = true;
    $demo['seguimiento']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['seguimiento']                               = 'seguimiento.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['seguimiento']                             = 36;  
    ////////////////////////// MODULO 5 - CENTRO MEDCIO //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['centro_m']                                         = true;
    $menu_lateral['centro_medico']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['centro_m']                                                 = true;
    $demo['centro_medico']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['centro_medico']                               = 'centro medico.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['centro_medico']                             = 36;  
    ////////////////////////// MODULO 6 - PERFIL FISICO //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['perfil_f']                                         = true;
    $menu_lateral['perfil_fisico']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['perfil_f']                                                 = true;
    $demo['perfil_fisico']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['perfil_fisico']                               = 'perfil_fisico.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['perfil_fisico']                             = 36; 
    ////////////////////////// MODULO 7 - EVALUACION CONCEPTO //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['evaluacion']                                         = true;
    $menu_lateral['evaluacion_concepto']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['evaluacion']                                                 = true;
    $demo['evaluacion_concepto']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['evaluacion_concepto']                               = 'evaluacion_concepto.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['evaluacion_concepto']                             = 36;  
    ////////////////////////// MODULO 8 - EVALUACION JUGADOR //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['evaluacion']                                         = true;
    $menu_lateral['evaluacion_jugador']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['evaluacion']                                                 = true;
    $demo['evaluacion_jugador']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['evaluacion_jugador']                               = 'evaluacion_jugador.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['evaluacion_jugador']                             = 36;  
    ////////////////////////// MODULO 9 - FICHAJUGADOR MC //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['fichajugador']                                         = true;
    $menu_lateral['ficha_jugador']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['fichajugador']                                                 = true;
    $demo['ficha_jugador']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['ficha_jugador']                               = 'ficha_jugador.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['ficha_jugador']                             = 36; 
    ////////////////////////// MODULO 10 - TEST OUCLAR //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['test']                                         = true;
    $menu_lateral['test_ocular_jugador']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['test']                                                 = true;
    $demo['test_ocular_jugador']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['test_ocular_jugador']                               = 'test_ocular.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['test_ocular_jugador']                             = 36;  
    ////////////////////////// MODULO 12 - CENTOR MEDICO FEDERACION //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['centro_m']                                         = true;
    $menu_lateral['centro_medico_f']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['centro_m']                                                 = true;
    $demo['centro_medico_f']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['centro_medico_f']                               = 'centro_medico_f.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['centro_medico_f']                             = 36;   
    ////////////////////////// MODULO 13 - CENTOR MEDICO CLUB //////////////////////////////
    ////////////////////////////////////////////////////////////////
    $menu_lateral['centro_m']                                         = true;
    $menu_lateral['centro_medico_c']                            = true;
    /////////////////////////// DEMO /////////////////////////////
    $demo['centro_m']                                                 = true;
    $demo['centro_medico_c']                                    = true;
    ////////////////////////// URL //////////////////////////////
    $menu_link['centro_medico_c']                               = 'centro_medico_c.php';
    ////////////////////// COMENTARIOS //////////////////////////
    $comentarios['centro_medico_c']                             = 36;   