<?php
	include('../config/datos.php');
	session_start();
	if(!(isset($_SESSION["nombre_usuario_software"]))){
		session_destroy();
		header('Location: ../index.php?cerrar_sesion=1');
	}else{
		$menu_actual="scouting";
		$submenu_actual="scouting_busqueda";
		$seccion_comentarios = $comentarios['scouting_busqueda'];//mis cuotas
		$demo_seccion = $demo['scouting_busqueda'];
		$nombre_pestana_navegador='Scouting - Búsqueda';
		
		$datetime_now = new DateTime();
		$date_hoy = new DateTime();
		$datetime_now = $datetime_now->format('Y-m-d H:i:s');
		$year = $date_hoy->format('Y');
		$date_hoy = $date_hoy->format('Y-m-d');
		$data = explode(" ", $datetime_now);
		$ano_actual =  date("Y");
		$mes_actual =  date("m");	

	// ------------ PAÍSES ------------------- //

$paises2 = [
        'AF' => 'Afganistán',
        'AL' => 'Albania',
        'DE' => 'Alemania',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antártida',
        'AG' => 'Antigua y Barbuda',
        'AN' => 'Antillas Holandesas',
        'SA' => 'Arabia Saudí',
        'DZ' => 'Argelia',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaiyán',
        'BS' => 'Bahamas',
        'BH' => 'Bahrein',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BE' => 'Bélgica',
        'BZ' => 'Belice',
        'BJ' => 'Benin',
        'BM' => 'Bermudas',
        'BY' => 'Bielorrusia',
        'MM' => 'Birmania',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia y Herzegovina',
        'BW' => 'Botswana',
        'BR' => 'Brasil',
        'BN' => 'Brunei',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'BT' => 'Bután',
        'CV' => 'Cabo Verde',
        'KH' => 'Camboya',
        'CM' => 'Camerún',
        'CA' => 'Canadá',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CY' => 'Chipre',
        'VA' => 'Ciudad del Vaticano (Santa Sede)',
        'CO' => 'Colombia',
        'KM' => 'Comores',
        'CG' => 'Congo',
        'CD' => 'Congo, República Democrática del',
        'KR' => 'Corea',
        'KP' => 'Corea del Norte',
        'CI' => 'Costa de Marfíl',
        'CR' => 'Costa Rica',
        'HR' => 'Croacia (Hrvatska)',
        'CU' => 'Cuba',
        'DK' => 'Dinamarca',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'EC' => 'Ecuador',
        'EG' => 'Egipto',
        'SV' => 'El Salvador',
        'AE' => 'Emiratos Árabes Unidos',
        'ER' => 'Eritrea',
        'SI' => 'Eslovenia',
        'ES' => 'España',
        'US' => 'Estados Unidos',
        'EE' => 'Estonia',
        'ET' => 'Etiopía',
        'FJ' => 'Fiji',
        'PH' => 'Filipinas',
        'FI' => 'Finlandia',
        'FR' => 'Francia',
        'GA' => 'Gabón',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GD' => 'Granada',
        'GR' => 'Grecia',
        'GL' => 'Groenlandia',
        'GP' => 'Guadalupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GY' => 'Guayana',
        'GF' => 'Guayana Francesa',
        'GN' => 'Guinea',
        'GQ' => 'Guinea Ecuatorial',
        'GW' => 'Guinea-Bissau',
        'HT' => 'Haití',
        'HN' => 'Honduras',
        'HU' => 'Hungría',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IQ' => 'Irak',
        'IR' => 'Irán',
        'IE' => 'Irlanda',
        'BV' => 'Isla Bouvet',
        'CX' => 'Isla de Christmas',
        'IS' => 'Islandia',
        'KY' => 'Islas Caimán',
        'CK' => 'Islas Cook',
        'CC' => 'Islas de Cocos o Keeling',
        'FO' => 'Islas Faroe',
        'HM' => 'Islas Heard y McDonald',
        'FK' => 'Islas Malvinas',
        'MP' => 'Islas Marianas del Norte',
        'MH' => 'Islas Marshall',
        'UM' => 'Islas menores de Estados Unidos',
        'PW' => 'Islas Palau',
        'SB' => 'Islas Salomón',
        'SJ' => 'Islas Svalbard y Jan Mayen',
        'TK' => 'Islas Tokelau',
        'TC' => 'Islas Turks y Caicos',
        'VI' => 'Islas Vírgenes (EEUU)',
        'VG' => 'Islas Vírgenes (Reino Unido)',
        'WF' => 'Islas Wallis y Futuna',
        'IL' => 'Israel',
        'IT' => 'Italia',
        'JM' => 'Jamaica',
        'JP' => 'Japón',
        'JO' => 'Jordania',
        'KZ' => 'Kazajistán',
        'KE' => 'Kenia',
        'KG' => 'Kirguizistán',
        'KI' => 'Kiribati',
        'KW' => 'Kuwait',
        'LA' => 'Laos',
        'LS' => 'Lesotho',
        'LV' => 'Letonia',
        'LB' => 'Líbano',
        'LR' => 'Liberia',
        'LY' => 'Libia',
        'LI' => 'Liechtenstein',
        'LT' => 'Lituania',
        'LU' => 'Luxemburgo',
        'MK' => 'Macedonia, Ex-República Yugoslava de',
        'MG' => 'Madagascar',
        'MY' => 'Malasia',
        'MW' => 'Malawi',
        'MV' => 'Maldivas',
        'ML' => 'Malí',
        'MT' => 'Malta',
        'MA' => 'Marruecos',
        'MQ' => 'Martinica',
        'MU' => 'Mauricio',
        'MR' => 'Mauritania',
        'YT' => 'Mayotte',
        'MX' => 'México',
        'FM' => 'Micronesia',
        'MD' => 'Moldavia',
        'MC' => 'Mónaco',
        'MN' => 'Mongolia',
        'MS' => 'Montserrat',
        'MZ' => 'Mozambique',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NI' => 'Nicaragua',
        'NE' => 'Níger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk',
        'NO' => 'Noruega',
        'NC' => 'Nueva Caledonia',
        'NZ' => 'Nueva Zelanda',
        'OM' => 'Omán',
        'NL' => 'Países Bajos',
        'PA' => 'Panamá',
        'PG' => 'Papúa Nueva Guinea',
        'PK' => 'Paquistán',
        'PY' => 'Paraguay',
        'PE' => 'Perú',
        'PN' => 'Pitcairn',
        'PF' => 'Polinesia Francesa',
        'PL' => 'Polonia',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'UK' => 'Reino Unido',
        'CF' => 'República Centroafricana',
        'CZ' => 'República Checa',
        'ZA' => 'República de Sudáfrica',
        'DO' => 'República Dominicana',
        'SK' => 'República Eslovaca',
        'RE' => 'Reunión',
        'RW' => 'Ruanda',
        'RO' => 'Rumania',
        'RU' => 'Rusia',
        'EH' => 'Sahara Occidental',
        'KN' => 'Saint Kitts y Nevis',
        'WS' => 'Samoa',
        'AS' => 'Samoa Americana',
        'SM' => 'San Marino',
        'VC' => 'San Vicente y Granadinas',
        'SH' => 'Santa Helena',
        'LC' => 'Santa Lucía',
        'ST' => 'Santo Tomé y Príncipe',
        'SN' => 'Senegal',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leona',
        'SG' => 'Singapur',
        'SY' => 'Siria',
        'SO' => 'Somalia',
        'LK' => 'Sri Lanka',
        'PM' => 'St Pierre y Miquelon',
        'SZ' => 'Suazilandia',
        'SD' => 'Sudán',
        'SE' => 'Suecia',
        'CH' => 'Suiza',
        'SR' => 'Surinam',
        'TH' => 'Tailandia',
        'TW' => 'Taiwán',
        'TZ' => 'Tanzania',
        'TJ' => 'Tayikistán',
        'TF' => 'Territorios franceses del Sur',
        'TP' => 'Timor Oriental',
        'TG' => 'Togo',
        'TO' => 'Tonga',
        'TT' => 'Trinidad y Tobago',
        'TN' => 'Túnez',
        'TM' => 'Turkmenistán',
        'TR' => 'Turquía',
        'TV' => 'Tuvalu',
        'UA' => 'Ucrania',
        'UG' => 'Uganda',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistán',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Vietnam',
        'YE' => 'Yemen',
        'YU' => 'Yugoslavia',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabue'
    ];

?>   

<!DOCTYPE html> 
<html lang="es"> 
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title><?php echo $nombre_pestana_navegador;?> | Búsqueda</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link rel="stylesheet" href="font-awesome_3.2.1/css/font-awesome.css" />
<link rel="stylesheet" href="css/jquery.gritter.css" />
<link rel='stylesheet' href='css/font_googleapis.css' type='text/css'>
<link rel='stylesheet' href='css/comentarios.css' type='text/css'>
<link rel='stylesheet' href='../print_js/print.min.css' type='text/css'>
<link href="bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<!-- Países -->
<link rel="stylesheet" href="flags/flags.css" />
<link rel="stylesheet" href="flags/flags.min.css" />

<style type="text/css">
	.sin_fondo:hover{
		background-color:transparent; 
	} 

	.boton_eliminar2{
		padding-left: 3px;
		padding-right: 3px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid #fb973e; 
		color: #fb973e;
		border-radius:2px;
		cursor:pointer;
		margin-right:8px;
	}
	.boton_eliminar2:hover{
		padding-left: 3px;
		padding-right: 3px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid #6e6d6c; 
		color: #6e6d6c;
		border-radius:2px;
		cursor:pointer;
		margin-right:8px;
	}
	.boton_refresh{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border:3px solid #e19830; 
		color: #e19830;
		border-radius:2px;
	} 
	.boton_refresh:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid #8f5708; 
		color: #8f5708;
		border-radius:2px;
	} 
	.panel_seleccionar_serie:hover{ 
		background-color:#f7b48b; 
		color:white; 
	} 
	.panel_seleccionar_serie_inhabilitada{ 
		background-color:#ffa42d; 
		color:black; 
	} 
	.panel_seleccionar_serie{ 
		background-color:#ffa42d; 
		color:black; 
	} 
	
	.tabla_1_sin_efecto{
		border: 2px solid white; 
		color:white; 
		background-color:black; 
		opacity:0.5;
	}
	.tabla_1_sin_efecto:hover{
		border: 2px solid white; 
		color:white; 
		background-color:black; 
		opacity:0.5;
	}
	.tabla_2_sin_efecto{
		background-color:transparent;
		color:white; 
	}
	.tabla_2_sin_efecto:hover{
		background-color:transparent;
		color:white; 
	}

	/* ------------------------ */
	.boton_informe_jugador{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid <?php echo $color_fondo; ?>; 
		color: <?php echo $color_fondo; ?>;
		border-radius:5px;
	}
	.boton_informe_jugador:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid black; 
		color: black;
		border-radius:5px;
	}

	/* ------------------------ */
	.boton_agregar_jugador {
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none;
		background-color: <?php echo $color_fondo; ?>;
		border: 1px solid white;
		color: white;
		border-radius: 5px;
	}

	.boton_agregar_jugador:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 1px solid #8f8f8f; 
		color: #8f8f8f;
		border-radius:5px;
	}    

	/* ------------------------ */
	.boton_menu_desactivado{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: <?php echo $color_fondo; ?>;
		border: 3px solid black; 
		color: black;
		border-radius:5px;
	}
	.boton_menu{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid <?php echo $color_fondo; ?>; 
		color: <?php echo $color_fondo; ?>;
		border-radius:5px;
	}
	.boton_menu:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: <?php echo $color_fondo; ?>;
		border: 3px solid black; 
		color: black;
		border-radius:5px;
	}
	.boton_menu:disabled{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 5px solid black; 
		color: black;
		border-radius:2px;
	}
	.checkeado {
		color: orange;
	}
	.panel_seleccionar_serie:hover .checkeado {
		color: <?php echo $color_fondo; ?>;
	}


	

	.panel_buscar {
		height:27px; 
		cursor:pointer; 
		color:#555555; 
		font-size:13px;
	}

	.panel_buscar_claro {
		background-color: #ffcd43;
	}
.boton_volver
	.panel_buscar_oscuro {
		background-color: #ffbb00;
	}

	.panel_buscar_claro:hover{
		background-color: #ffbb00;
	}

	.panel_buscar:hover{
		background-color: #ffbb00;
	}    

	.boton_volver{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 1px solid <?php echo $color_fondo; ?>; 
		color: <?php echo $color_fondo; ?>;
		border-radius:10px;
	}
	.boton_volver:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 1px solid black.boton_volver; 
		color: black.boton_volver;
		border-radius:10px;
	}
	
	.boton_eliminar4{
		cursor: pointer;
		position: absolute;
		margin-left: -18px;
		margin-top: -7px;
		border: solid 1px red;
		padding: 1px 5px 2px 5px;
		border-radius: 50px;
		background-color: red;
		color: #E8E6E6;
		font-size: 16px;
	}

	  .boton_eliminar4:hover {
		cursor: pointer;
		position: absolute;
		margin-left: -18px;
		margin-top: -7px;
		border: solid 1px red;
		padding: 1px 5px 2px 5px;
		border-radius: 50px;
		background-color: red;
		color: #fff;
		font-size: 17px;
	}
	.boton_eliminar4:disabled{
		cursor: pointer;
		position: absolute;
		margin-left: -18px;
		margin-top: -7px;
		border: solid 1px red;
		padding: 1px 5px 2px 5px;
		border-radius: 50px;
		background-color: red;
		color: #E8E6E6;
		font-size: 16px;
	}
	
	/* -------------------------- Botón de Eliminar -------------------------- */
	.boton_eliminar{
		padding-left: 3px;
		padding-right: 3px;
		text-shadow: none; 
		background-color: #f44336;
		border-left:1px solid  #f44336; 
		border-right: 1px solid  #f44336;
		font-size:16px;
		text-align: center;
		color: #fff;
		border-radius:5px;
		width: 20px;
		height:20px;
	}
	.boton_eliminar:hover{
		padding-left: 3px;
		padding-right: 3px;
		text-shadow: none; 
		background-color: #D83F25;
		border-left:1px solid  #D83F25; 
		border-right: 1px solid  #D83F25;
		font-size:16px;
		color: #ffffff;
		border-radius:5px;
		width: 20px;
		height:20px;
	}
	.boton_eliminar:disabled{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: <?php echo $color_fondo; ?>;
		border: 3px solid rgba(0, 0, 0, .2);    
		color: #fff;
		border-radius:2px;
	}

	.boton_menu_desactivado{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: <?php echo $color_fondo; ?>;
		border: 3px solid black; 
		color: black;
		border-radius:5px;
	}


	/* -------------------------- Botón de Editar -------------------------- */
	.boton_editar{
		padding-left: 3px;
		padding-right: 3px;
		text-shadow: none; 
		background-color: #1d9663;
		border-left:1px solid  #1d9663; 
		border-right: 1px solid  #1d9663;
		font-size:16px;
		text-align: center;
		color: #fff;
		border-radius:5px;
		width: 20px;
		height:20px;
	}
	.boton_editar:hover{
		padding-left: 3px;
		padding-right: 3px;
		text-shadow: none; 
		background-color: #45b384;
		border-left:1px solid  #45b384; 
		border-right: 1px solid  #45b384;
		font-size:16px;
		color: #ffffff;
		border-radius:5px;
		width: 20px;
		height:20px;
	}
	.boton_editar:disabled{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: <?php echo $color_fondo; ?>;
		border: 3px solid rgba(0, 0, 0, .2);    
		color: #fff;
		border-radius:2px;
	}
	
	.boton_ver{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid <?php echo $color_fondo; ?>; 
		color: <?php echo $color_fondo; ?>;
		border-radius:2px;
	}
	.boton_ver:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid #1aa0d8; 
		color: #1aa0d8;
		border-radius:2px;
	}
	.boton_ver:disabled{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid rgba(0, 0, 0, .2);    
		color: rgba(0, 0, 0, .2);
		border-radius:2px;
	}
	
	/* -------------------------- Botón de Agregar -------------------------- */
	.boton_add{
		padding-left: 3px;
		padding-right: 3px;
		text-shadow: none; 
		background-color: #007bff;
		border-left:1px solid  #007bff; 
		border-right: 1px solid  #007bff;
		font-size:16px;
		text-align: center;
		color: #fff;
		border-radius:5px;
		width: 20px;
		height:20px;
	}
	.boton_add:hover{
		padding-left: 3px;
		padding-right: 3px;
		text-shadow: none; 
		background-color: #59a9ff;
		border-left:1px solid  #59a9ff; 
		border-right: 1px solid  #59a9ff;
		font-size:16px;
		color: #ffffff;
		border-radius:5px;
		width: 20px;
		height:20px;
	}
	.boton_add:disabled{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: <?php echo $color_fondo; ?>;
		border: 3px solid rgba(0, 0, 0, .2);    
		color: #fff;
		border-radius:2px;
	}


	.boton_remove{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid #f26027; 
		color: #f26027;
		border-radius:2px;
	}
	.boton_remove:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid black; 
		color: black;
		border-radius:2px;
	}
	.boton_modal{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid white; 
		color: white;
		border-radius:2px;
	}
	.boton_modal:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid black; 
		color: black;
		border-radius:2px;
	}
	
	.boton_gestionar_cargos{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid <?php echo $color_fondo; ?>; 
		color: <?php echo $color_fondo; ?>;
		border-radius:2px;
	}
	.boton_gestionar_cargos:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid black; 
		color: black;
		border-radius:2px;
	}
	.boton_gestionar_cargos_eliminar{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid <?php echo $color_fondo; ?>; 
		color: <?php echo $color_fondo; ?>;
		border-radius:2px;
	}
	.boton_gestionar_cargos_eliminar:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid #D83F25; 
		color: #D83F25;
		border-radius:2px;
	}
	.boton_gestionar_cargos:disabled{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid rgba(0, 0, 0, .2);    
		color: rgba(0, 0, 0, .2);
		border-radius:2px;
	}
	.botonAgregar{
		padding-left: 10px;
		padding-right: 10px;
		text-shadow: none; 
		background-color: <?php echo $color_fondo; ?>;
		border: 1px solid <?php echo $color_fondo; ?>; 
		color: #fff;
		border-radius:5px;
		padding-bottom: 2px;
		padding-top: 2px;
	}
	.botonAgregar:hover{
		padding-left: 10px;
		padding-right: 10px;
		text-shadow: none; 
		color: black;
		border-radius:5px;
		padding-bottom: 2px;
		padding-top: 2px;
	}

	.ph-center::-webkit-input-placeholder{
	  text-align: center;
	}

	.bootstrap-datetimepicker-widget table td.today:before {
	content: '';
	display: inline-block;
	border: solid transparent;
	border-width: 0 0 7px 7px;
	border-bottom-color: #337ab7;
	border-top-color: rgba(0, 0, 0, 0.2);
	position: absolute;
	bottom: 4px;
	right: 4px;
}
.btn-upload{
	border: 2px solid <?php echo $color_fondo; ?>;
	color: <?php echo $color_fondo; ?>;
	width: 40px;
	height:28px;
	margin-left: 10px;
}
.btn-upload:hover{
	border: 2px solid #000;
	color: #000;
}

	.ph-center::-webkit-input-placeholder{
	  text-align: center;
	}

.colorNegro{
		color: #000;
	}
.doubleTable{
	background-color: #fff;
	height:40px;
	display: flex;
	justify-content: center;
	align-items: center;
	padding:4px;
	border:solid #666666 2px;
	margin: -2px;

}

.doubleTable_min{
	background-color: #fff;
	height:25px;
	display: flex;
	justify-content: center;
	align-items: center;
	padding:0px;
	border:solid #666666 2px;
	margin: -2px;

}
.boton_informe_jugador:disabled{
	opacity: 0.5;
	cursor: no-drop;
}

/* ---------------- Estilos -------------------*/

.cuadro_serie {
	cursor: pointer;
	text-shadow: none; 
	background-color: <?php echo $color_fondo; ?>
	color: white;
	border-radius:10px;
}   
.cuadro_serie:hover{
	background-color: <?php echo $color_fondo_suave; ?>
}   

.cuadro_serie .nombre_seleccion {
    width: 100%;
    display: inline-block;
    border-top: 2px solid #ffffff;
    border-bottom: 2px solid #ffffff;
    padding: 5px;
    box-sizing: border-box;
}

	.boton_volver_a_series{
		position: absolute;
		text-shadow: none; 
		background-color: <?php echo $color_fondo; ?>;
		border: 5px solid white;     
		color: white;
		border-radius: 50%;
		padding: 13px;
	}
	.boton_volver_a_series:hover{
		position: absolute;
		text-shadow: none; 
		background-color: <?php echo $color_fondo; ?>;
		border: 5px solid white;     
		color: white;
		border-radius: 50%;
		padding: 13px;
	}

	#ingresar_peso_ideal_informe_carga::placeholder {
		color: white;
	}

	.black-table thead tr {
		text-align: center;
		height: 27px;
	}   

	.black-table thead tr th{
		padding-top: 5px; 
		padding-bottom:5px;        
	}           

	.black-table tbody tr {
		text-align: center;
	}

	.boton_crud_informe_carga{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid #e19830; 
		color: #e19830;
		border-radius:2px;
	}
	.boton_crud_informe_carga:hover{
		padding-left: 7px;
		padding-right: 7px;
		text-shadow: none; 
		background-color: transparent;
		border: 3px solid #fda101; 
		color: #fda101;
		border-radius:2px;
	}       


.hr-line {
	position: relative;
	display: inline-block;
	margin-left: 5px;
	margin-right: 5px;
	width: 100%;
	border-bottom: 1px solid #7A7A7A;
}

.black-placeholder::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
   color: black;
}

.sexo_seleccion {
	color: #7b7575;
	width: 100%;
	display: inline-block;
	border-top: 2px solid <?php echo $color_fondo; ?>;
	border-bottom: 2px solid <?php echo $color_fondo; ?>;
	padding: 0px;
	box-sizing: border-box;
}

.titulo_serie {
	color: #7b7575;
}

.th-small-font-size {
	font-weight: 600;
	font-size: 10px;
	width: 100px;
}

.tr-posiciones-jugador {
	background-color:#555555; 
	color:white;
}

/* ------------------------------------------------------------------ */

.black-table { 
	background-color: transparent;
	/* width: 93%; */
	width: 100%;
	margin: auto;
}

.black-table tbody tr:hover {
	background-color: #ffbb00;
}

.black-table thead tr, .black-table tbody tr {
	background-color: transparent;
}

.black-table thead tr {
	text-align: center;
	background-color: #555555;
	color: white;
}

.black-table thead tr th {
	font-weight: bold;
}

.black-table tbody tr {
	height:27px;
	cursor:pointer;
	font-size:11px;
	line-height: 14px;
}

.black-table tfoot tr {
	background-color:#555555;
	 color:white;
}

.black-table tfoot tr:hover{
	background-color:#555555;
}


/* ------------------------------------------------------------------ */

#tabla_ver_perfil_jugador thead tr, #tabla_ver_perfil_jugador tbody tr {
	text-align: center;  
}

#tabla_ver_perfil_jugador thead tr, #tabla_ver_perfil_jugador tbody tr {
	text-align: center;  
}

.span-valoracion {
	font-weight: bold;
	background-color: grey;
	border-radius: 5px;
	color: white;
	text-transform: uppercase;   
}

.valoracion-baja {
	color: white;
	background-color: #f44336;
}

.valoracion-media {
	color: white;
	background-color: #ffc107;
}

.valoracion-alta {
	color: white;
	background-color: #4caf50;
}

.td-valoracion {
	padding-right: 10px;
	padding-top: 7px;
	padding-bottom: 7px;
}

.td-valoracion .span-valoracion {
	width: 70px;
	margin-left: 25px;
}

input[type=radio] {
  border: 1px solid black;
  padding: 0.5em;
  -webkit-appearance: none;
}

input[type=radio]:checked {
  background: black;
  background-size: 9px 9px;
}

input[type=radio]:focus {
  outline-color: blue;
}


.radio-button {
	display:none; 
	margin:10px;
}


.radio-button-valoracion-alta + label {
	display:inline-block;
	font-weight: bold;
	background-color: #4caf50;
	border-radius: 5px;
	padding: 5px;
	color: white;
	text-transform: uppercase;       
}

.radio-button-valoracion-media + label {
	display:inline-block;
	font-weight: bold;
	background-color: #ffc107;
	border-radius: 5px;
	padding: 5px;
	color: white;
	text-transform: uppercase;       
}

.radio-button-valoracion-baja + label {
	display:inline-block;
	font-weight: bold;
	background-color: #f44336;
	border-radius: 5px;
	padding: 5px;
	color: white;
	text-transform: uppercase;       
}


.radio-button:checked + label { 
	background-image: none;
	border: solid 4px #3e3e3e;
	color: white;
}

.th-textarea {
	background-color: <?php echo $color_fondo; ?>;
	color: white;
	border-radius: 6px 6px 0px 0px;
	font-weight: bold;
}

.div-tr-break {
	height: 20px;
}

.textarea-social {
	width:100%; -webkit-appearance: none; 
	-moz-appearance : none; 
	border: 2px solid <?php echo $color_fondo; ?>; 
	border-radius: 0px 0px 0px 0px;
	margin-bottom:0px; 
	text-align:center; 
	line-height: 16px;          
	font-weight: bold;
	text-align: left;
}

.imagenes-centro {
	width: 35px;
}

.texto-imagen-centro {
	margin-right: 40px;
	font-weight: bold;
	color: black;
}

.nombre-jugador {
	font-weight: bold;
	color: black;
	margin-top: 0px;
	font-size: 20px;    
}

.titulo-campo-talento {
	text-transform: uppercase;
	color: black;    
}

.select-status-talento {
	text-indent: 35px;
	border-radius: 7px;
	height: 40px;    
	font-weight: bold;
	color: #999999;
	width: 230px;
	-webkit-appearance: none;
	-moz-appearance: none;        
}

#boton_agregar_ficha_jugador:enabled {
	cursor: pointer;
}

#boton_agregar_ficha_jugador:disabled {
	cursor: no-drop;
}

 
.img-star-five-stars {
	width: 80px;margin-left: 50px; height: 13px; margin-top: -3px;
}

.imagen-jugador {
	background-color: white;
}

.ellipsis-text {
	text-overflow: ellipsis;
	overflow: hidden;
	white-space: nowrap;    
	margin-bottom: 0px;
	font-weight: bold;
}

.nombre-club-table {
	display: inline;
} 

.div-club-table {
	text-align: center;
	max-width: 150px;
}

.serie-cantidad-jugadores {
	text-align: center;
	height: 20px;
	margin-top: -15px;
	width: 70px;
	float: right;
	background-color: #ff291a;
	color: white;
	border: 2px solid white;
	border-radius: 20px;
	padding: 2px;
}

.nombre-pais-inicio {
	color: aliceblue;
	margin: 0;
}

.img-nacionalidad {
	width: 20px; 
	height:auto; 
}

.img-nacionalidad-small {
	width: 20px; 
	height:	15px;
}

.img-club { 
	width: 15px; 
	height:auto; 
	margin-right: 5px;
}


/* ------------------------------------------ */

.form-range-control {
	margin: 0 auto;
	padding: 1.5em;
	border-radius: 5px; 
}
/*
.form-range-control input[type="range"] {
	-webkit-appearance: none;
	background-color: white;
	height: 1px;
	border-radius: 1px;
	width: 100%;
}

.form-range-control input[type="range"]::-webkit-slider-thumb {
	-webkit-appearance: none;
	width: 20px;
	height: 20px;
	background-color: #f44336;
	border-radius: 50%;
	cursor: -moz-grab;
	cursor: -webkit-grab; 
}
*/

.span-input-range {
	margin-top: 4px;
	color: black;
    margin-right: 10px;	
}

.multi-range, .multi-range * { box-sizing: border-box; padding: 0; margin: 0; }
.multi-range { 
    position: relative; 
    width: 80%;
    height: 28px; 
    /* margin: 16px; 
	border: 1px solid #ddd;
    */
    font-family: monospace;
}
.multi-range > hr { position: absolute; width: 100%; top: 50%; }
.multi-range > input[type=range] {
    width: calc(100% - 16px); 
    position: absolute; bottom: 6px; left: 0;
}
.multi-range > input[type=range]:last-of-type { margin-left: 16px; }
.multi-range > input[type=range]::-webkit-slider-thumb { transform: translateY(-18px); }
.multi-range > input[type=range]::-webkit-slider-runnable-track { -webkit-appearance: none; height: 0px;}
.multi-range > input[type=range]::-moz-range-thumb { transform: translateY(-18px); }
.multi-range > input[type=range]::-moz-range-track { -webkit-appearance: none; height: 0px;}
.multi-range > input[type=range]::-ms-thumb { transform: translateY(-18px); }
.multi-range > input[type=range]::-ms-track { -webkit-appearance: none; height: 0px; }
.multi-range::after { 
	/*
    content: attr(data-lbound) ' - ' attr(data-ubound); 
    position: absolute; top: 0; left: 100%; white-space: nowrap;
    display: block; padding: 0px 4px; margin: -1px 2px;
    height: 26px; width: auto; border: 1px solid #ddd; 
    font-size: 13px; line-height: 26px;
    */
    content: attr(data-lbound) ' - ' attr(data-ubound);
    position: absolute;
    top: 20px;
    left: 35%;
    white-space: nowrap;
    display: block;
    padding: 0px 4px;
    margin: -1px 2px;
    height: 26px;
    width: auto;
    font-size: 13px;
    line-height: 26px;
    color: black;    
}


input[type=range]::-moz-range-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  background: #3071a9;
  border-radius: 1.3px;
  border: 0.2px solid #010101;
}
/* ------------------------------- */
input[type=range] {
 	-webkit-appearance: none;
  	/*
  	margin: 18px 0;
  	width: 100%;
  	background-color: blue;
  	*/
}
input[type=range]:focus {
 	outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
 	width: 100%;
 	cursor: pointer;
  	animate: 0.2s;
	background-color: #f44336;
	border-radius: 50%;
}

input[type=range]::-webkit-slider-thumb {
 	border: 1px solid #000000;
 	height: 20px;
 	width: 20px;
	background-color: #f44336;
	border-radius: 50%;
 	cursor: pointer;
 	-webkit-appearance: none;
}

/*------------------ */
.cr-slider-wrap > input[type=range]::-webkit-slider-runnable-track {
    width: 100%;
    cursor: pointer;
    animate: 0.2s;
    background-color: <?php echo $color_fondo; ?>
    border-radius: 50%;
}

.cr-slider-wrap > input[type=range]::-webkit-slider-thumb {
    border: 1px solid #000000;
    height: 20px;
    width: 20px;
    background-color: <?php echo $color_fondo; ?>
    border-radius: 50%;
    cursor: pointer;
    -webkit-appearance: none;
}

.row-form-jugador {
	width: 100%;
    margin-bottom: 50px;
    height: 5px;
}

div#div_file{
    border: 3px solid <?php echo $color_fondo; ?>;
    position: relative;
    margin: auto;
    width: 170px;
}

p#texto{
	text-align: center;
	color: <?php echo $color_fondo; ?>;
	margin: 0;
	font-weight: 600;
}

input#foto_jugador{
	position:absolute;
	top:0px;
	left:0px;
	right:0px;
	bottom:0px;
	width:100%;
	height:100%;
	opacity: 0;
}

.tabbable {
    -webkit-appearance: none;
    -moz-appearance: none;
    border: 1px solid <?php echo $color_fondo; ?>;
    border-radius: 6px;
    background-color: transparent;
}

.nav-tabs>li>a {
    padding-top: 8px;
    padding-bottom: 8px;
    line-height: 20px;
    border: 1px solid transparent;
    -webkit-border-radius: 4px 4px 0 0;
    -moz-border-radius: 4px 4px 0 0;
    border-radius: 4px 4px 0 0;
    color: white;
    font-weight: bold;
}

.nav-tabs {
    background-color: <?php echo $color_fondo; ?>;
    border-bottom: 1px solid #ddd;
}

.nav-tabs>.active>a, .nav-tabs>.active>a:hover, .nav-tabs>.active>a:focus {
    color: black;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}

.nav>li>a:hover, .nav>li>a:focus {
    text-decoration: none;
    background-color: <?php echo $color_fondo; ?>; /*#eee*/
}


/* ------------------ INPUT GRIS ------------------ */
.gray-a {
margin:0px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; width: 90px; margin-top:0px; background-color:<?php echo $color_fondo; ?>; font-size: 12px; margin-bottom:0px;
}

.gray-a:hover{
	background-color:<?php echo $color_fondo; ?>;	
}

.gray-input {
margin:0px; width:52%; -webkit-appearance: none; -moz-appearance : none; border: 1px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; text-align:center;
}

/* ------------------ INPUT VERDE ------------------ */
.green-a {
margin:0px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; width: 90px; margin-top:0px; background-color:<?php echo $color_fondo; ?>; font-size: 12px; margin-bottom:0px;
}

.green-a:hover{
	background-color:<?php echo $color_fondo; ?>;	
}

.green-input {
margin:0px; width:52%; -webkit-appearance: none; -moz-appearance : none; border: 1px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; text-align:center;
}

#modal-detalle-jugador {
	width: 950px; 
	height: auto;
    position: fixed;
    top: 5%;
    left: 45%;	
    background-color: #212121;
    border: 1px solid white;
    border-radius: 0px;	
    margin-left: -400px;
}

#modal-detalle-jugador .modal-header {
	border-bottom: none;
	background-color: inherit;
}

.tabla-modal-detalle-jugador {
	width: 100%;
	color: white;
}
.tabla-modal-detalle-jugador tr:hover {
	background-color: inherit;
}

.tabla-modal-detalle-jugador tr th, .tabla-modal-detalle-jugador tr td {
	text-align: left;
}

.tarjetaAmarilla {
    background: #ffbd4c;
    background: -moz-radial-gradient(center, ellipse cover, #ffbd4c 0%, #ffa500 100%);
    background: -webkit-radial-gradient(center, ellipse cover, #ffbd4c 0%,#ffa500 100%);
    background: radial-gradient(ellipse at center, #ffbd4c 0%,#ffa500 100%);
    border-radius: 2px;
    width: 14px;
    height: 20px;
    vertical-align: middle;
}

.tarjetaRoja {
    background: #ff3f3f;
    background: -moz-radial-gradient(center, ellipse cover, #ff3f3f 1%, #ff0000 99%);
    background: -webkit-radial-gradient(center, ellipse cover, #ff3f3f 1%,#ff0000 99%);
    background: radial-gradient(ellipse at center, #ff3f3f 1%,#ff0000 99%);
    border-radius: 2px;
    width: 14px;
    height: 20px;
    vertical-align: middle;
}

/* ------------------------------------------------------------------ */

.blackt-jugador-modal { 
	background-color: transparent;
	/*
	border-collapse: separate;
	border-spacing: 0px 3px;
	*/
	width: 100%;
}

.blackt-jugador-modal thead tr {
	border-bottom: 1px solid white;
	font-weight: bold;
}

.blackt-jugador-modal thead tr, .blackt-jugador-modal tbody tr {
	background-color: transparent;
}


.blackt-jugador-modal thead tr th {
	font-weight: bold;
	text-align: center;
	color: #dcdbdb;
}

.blackt-jugador-modal tbody tr td{
	color: #a29f9f;
	height:27px;
	cursor:pointer;
	font-size:13px;
}

.blackt-jugador-modal tbody tr:hover{
	background-color: #e0e0e0;
}

.div-imagen-club-tabla {
    margin: auto;
    background-color: #6b6a6a;
    border-radius: 50%;
    width: 45px;
    margin-top: 5px;
    margin-bottom: 5px;	
    margin-left: 5px;
}

.div-imagen-club-tabla-2 {
	margin-top: 1px;
    margin-bottom: 1px;
}

.imagen-club-tabla {
	width: 25px;
	border-radius: 50%;
	border: solid 2px;
	height:25px;
	margin-right: 5px;
}


table tfoot tr:hover {
	background-color: transparent;
	cursor: none;
}

/* --------------- Botón para agregar partido deshabilitado -------------- */
.boton-agregar-partido-disabled {
    font-weight: bold;
    text-transform: uppercase;
    padding: 10px;
    border: none;
    display: block;
    margin: auto;
    border-radius: 7px;
    width: 250px;
    background-color: transparent;
    color: #8e8c8c;
    border: 1px solid #8e8c8c;
    margin-bottom: 20px;
    cursor: not-allowed;
}

.boton-agregar-partido-disabled:hover {
    background-color: transparent;
}

/* --------------- Botón para agregar partido habilitado -------------- */
.boton-agregar-partido-enabled {
    font-weight: bold;
    text-transform: uppercase;
    padding: 10px;
    border: none;
    display: block;
    margin: auto;
    border-radius: 7px;
    width: 250px;
    background-color: transparent;
    color: <?php echo $color_fondo; ?>;
    border: 1px solid <?php echo $color_fondo; ?>;
    margin-bottom: 20px;
    cursor: pointer;
}

.boton-agregar-partido-enabled:hover {
    background-color: transparent;
	border: 1px solid black;
    color: black;    
}


/* --------------- Botón para agregar a Scouting -------------- */
#boton-agregar-scouting {
    font-weight: bold;
    text-transform: uppercase;
    padding: 10px;
    border: none;
    display: block;
    margin: auto;
    border-radius: 7px;
    width: 250px;
    background-color: #30b76c;
    color: white;    
    margin-bottom: 20px;
}



.datos-jugador-small {
    margin-top: 0px; 
    color: white; 
    padding: 10px 0px 0px 50px; 
    font-size: 12px;
}

.datos-jugador-medium {
    margin-top: 0px; 
    color: white; 
    padding: 10px 0px 0px 50px; 
    font-size: 16px;
}

.img-datos-jugador {
    width: 20px;
    height: 25px;
    position: relative;
    left: 35px;
}

.div-datos-partido {
	width: 100%;
}

.div-datos-partido .span4 {
	width: 30%;
	margin-bottom: 20px;
}

.div-break {
	height: 20px;
	margin-top: 30px;	
}

#cuadro_form_agregar_jugador select {
	color: black;
}

select {
  text-align: center;
  text-align-last: center;
}
option {
  text-align: center;
}

.input-label-match {
	color: white;
	font-weight: bold;
	display: inline-block;
	margin: -1px 20px 0px 10px;
}

input[type=radio].input-label-match {
    border: 1px solid gray;
    padding: 0.5em;
    -webkit-appearance: none;
    border-radius: 20px;
    background-color: white;
    font-size: 15px;
}

input[type=radio].input-label-match:checked {
    background: #f4f4f4; 
    background-size: 9px 9px;
    box-shadow: inset 0 0 0 5px #2196F3;
}

/* Centrando texto de inputs del formulario de partido */
#formulario_partido_jugador input {
	text-align: center;
}

#min_entrada_jugadorpartido::placeholder {
	color: white;
}

.campo-disabled {
	background-color: #cfcccc;
}

.boton-disabled {
	cursor: not-allowed;
}

.img-next-to-text {
    float:left;
    display:block;
    position:relative;
    width:20%;
}

.t-partidos-modal tbody tr{
	background-color: #f9f9f9;
}

.t-partidos-modal tbody tr td {
	line-height: 12px;
}

.text-club {
	position: relative;
	top: 5px;
}

/*
.foto-jugador-modal {
	top: 11px;
    height: 50px;
    width: 50px;
    position: relative;
    right: 10px;
}
*/
.foto-jugador-modal {
    top: -18px;
    height: 75px;
    width: 78px;
    position: relative;
    border-radius: 50%;
    left: 3.5px;
}

.foto-nacionalidad-jugador-modal {
	/*
    width: 20px;
    height: 15px;
    border-radius: 3px;
    */
    position: relative;
    left: 72px;
    
}

.div-imagen-form {
	height: 190px; 
	width: 220px; 
	display: block; 
	margin-bottom: 10px; 
	margin: auto; 
	background-color: transparent; 
	border: solid <?php echo $color_fondo; ?>; 5px; 
	border-radius: 50%; 
	margin-bottom: 10px;
}

.img-form {
	position: relative; 
	width: 140px; 
	height: 140px; 
	padding: 5px; 
	top: 20px; 
	display: block; 
	margin: auto;
}

.hr-input-range {
	border-bottom: 1px solid #7d7979;
}

.div-cuadro-principal {
	margin-bottom: 10px;
}

.my-input {
	width: 48%!important;
    border: 1px solid <?php echo substr($color_fondo, 0, -1) . '!important;'; ?>
    margin-left: 0px!important;
    margin-right: 0px!important;
    text-transform: capitalize!important;
    border-bottom-right-radius: 2px!important;
    border-top-right-radius: 2px!important;
    margin-bottom: 0px!important;
    background-color: white!important;
}

.white-bordered-img {
	border: 3px solid white;
    border-radius: 10%;
    width:100px; height:70px; margin-top:20px;
}

.regular-main-img {
    border: 3px solid transparent;
    border-radius: 10%;
    width: 100px;
    height: 100px;
    margin-top: -10px;
    position: relative;
    top: 10px;
}

.tabla-pais-principal {
	margin: 10px auto 10px;
}

.tabla-pais-otros {
	margin: 4px auto 10px;
}

.img-pais-principal {
	width: 50px; 
	height: 35px;
}

.img-pais-otros {
	width: 50px; 
	height: 45px;
}

.date-picker::placeholder {
	color: gray;
	text-transform: none;
}

#selecciones_cajas {
    margin-left: 5%;
    width: 97%;
}

@media (max-width: 980px) {
    .seleccion_test {
        width: calc(100% - 20px) !important;
    }
    .seleccion_test:hover {
        width: calc(100% - 0px) !important;
    }
    #selecciones_cajas {
        margin-left: 0px;
        width: 100%;
    }
    .titulo_series {
        width: 100%;
    }
}

/*
    top: 5px;
    width: 140px;
    position: relative;
    border-radius: 100px;
    height: 170px;    


   	width: 180px;
    border-radius: 100px;
    height: 180px; 
*/

</style>
<script type="text/javascript">
	var imagen_cargando = new Image();
	imagen_cargando.src = "../config/cargando_final_2.gif";
</script>
<script src="../print_js/print.min.js"></script>
<script src="js/angular.min.js" type="application/javascript"></script>
<script type="text/javascript" src="graficos/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="graficos/highcharts-3d.js"></script>
<script type="text/javascript" src="graficos/highcharts.js"></script>
<script type="text/javascript" src="graficos/exporting.js"></script>
<!--<script type="text/javascript" src="graficos/highcharts-3d.js"></script>-->
<script type="text/javascript" src="graficos/highcharts-more.js"></script>
<script type="text/javascript" src="graficos/series-label.js"></script>
<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.dashboard.js"></script> 
<script src="js/jquery.gritter.min.js"></script> 
<!--<script src="js/matrix.interface.js"></script> -->
<script src="js/matrix.chat.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script> 
<script type="text/javascript">

// Array de Países:
// El penúltimo elemento de cada array representa el tipo de país.
// El último elemento de cada array representa el gentilicio.
var dir_img_system = '../config/';
var array_paises = [
    [0, 'Todos', ''],
    [1, 'Chile', dir_img_system + 'chile.png', 1, 'Chileno'],
    [2, 'Argentina', dir_img_system + 'argentina.png', 1, 'Argentino'],
    [3, 'Venezuela', dir_img_system + 'venezuela.png', 1, 'Venezolano'],
    [4, 'Brasil', dir_img_system + 'brasil.png', 1, 'Brasileño'],
    [5, 'Colombia', dir_img_system + 'colombia.png', 1, 'Colombiano'],
    [6, 'Ecuador', dir_img_system + 'ecuador.png', 1, 'Ecuatoriano'],
    [7, 'Uruguay', dir_img_system + 'uruguay.png', 1, 'Uruguayo'],
    [8, 'Perú', dir_img_system + 'peru.png', 1, 'Peruano'],
    [9, 'Paraguay', dir_img_system + 'paraguay.png', 'Paraguayo'],
    [10, 'México', dir_img_system + 'mexico.png', 1, 'Mexicano'],
    [11, 'España', dir_img_system + 'espana.png', 2, 'Español'],
    [12, 'Inglaterra', dir_img_system + 'inglaterra.png', 2, 'Inglés'],
    [13, 'Alemania', dir_img_system + 'alemania.png', 2, 'Alemán'],
    [14, 'China', dir_img_system + 'china.png', 2, 'Chino'],
    [15, 'Bélgica', dir_img_system + 'belgica.png', 2, 'Belga'],
    [16, 'Bolivia', dir_img_system + 'bolivia.png', 2, 'Boliviano'],
    [17, 'Costa Rica', dir_img_system + 'costa_rica.png', 2, 'Costarricense'],
    [18, 'Estados Unidos', dir_img_system + 'estados_unidos.png', 2, 'Estadounidense'],
    [19, 'Honduras', dir_img_system + 'honduras.png', 2, 'Hondureño'],
    [20, 'El Salvador', dir_img_system + 'el_salvador.png', 2, 'Salvadoreño'],
    [21, 'Escocia', dir_img_system + 'escocia.png', 2, 'Escocés'],
    [22, 'Francia', dir_img_system + 'francia.png', 2, 'Francés'],
    [23, 'Grecia', dir_img_system + 'grecia.png', 2, 'Griego'],
    [24, 'Holanda', dir_img_system + 'holanda.png', 2, 'Holandés'],
    [25, 'Italia', dir_img_system + 'italia.png', 2, 'Italiano'],
    [26, 'Japón', dir_img_system + 'japon.png', 2, 'Japonés'],
    [27, 'Portugal', dir_img_system + 'portugal.png', 2, 'Portugués'],
    [28, 'Rusia', dir_img_system + 'rusia.png', 2, 'Ruso'],
    [29, 'Turquía', dir_img_system + 'turquia.png', 2, 'Turco'],
];

// Array series
var array_series = [
	['nulo', "Seleccione"],
    [8, "SUB-8"],
    [9, "SUB-9"],
    [10, "SUB-10"],
    [11, "SUB-11"],
    [12, "SUB-12"],
    [13, "SUB-13"],
    [14, "SUB-14"],
    [15, "SUB-15"],
    [16, "SUB-16"],
    [17, "SUB-17"],
    [19, "SUB-19"],
    [99, "Primer Equipo"],
];

// Array de Divisiones:
var array_divisiones = [];

// Chile:
array_divisiones['cl'] = [];
array_divisiones['cl'][1] = [1, 'Primera A'];
array_divisiones['cl'][2] = [2, 'Primera B'];
array_divisiones['cl'][3] = [3, 'Segunda Profesional'];
array_divisiones['cl'][4] = [4, 'Tercera A'];    

// Argentina:
array_divisiones['ar'] = [];
array_divisiones['ar'][5] = [5, 'Primera División'];
array_divisiones['ar'][6] = [6, 'Primera Nacional'];
array_divisiones['ar'][7] = [7, 'Primera B Metropolitana'];    

// Uruguay:
array_divisiones['uy'] = [];
array_divisiones['uy'][8] = [8, 'Primera División'];
array_divisiones['uy'][9] = [9, 'Segunda División'];   


// Venezuela:
array_divisiones['ve'] = [];
array_divisiones['ve'][10] = [10, 'Primera División'];
array_divisiones['ve'][11] = [11, 'Segunda División'];

// --- Perú:
array_divisiones['pe'] = [];
array_divisiones['pe'][12] = [12, 'Primera División'];
array_divisiones['pe'][13] = [13, 'Segunda División'];

// --- Brasil:
array_divisiones['br'] = [];
array_divisiones['br'][14] = [14, 'Serie A Primera División'];
array_divisiones['br'][15] = [15, 'Serie B Segunda División'];


// --- Ecuador:
array_divisiones['ec'] = [];
array_divisiones['ec'][16] = [16, 'Serie A Primera División'];

// --- Colombia:
array_divisiones['co'] = [];
array_divisiones['co'][17] = [17, 'Primera A'];
array_divisiones['co'][18] = [18, 'Primera B'];   
 
// --- Paraguay:
array_divisiones['py'] = [];
array_divisiones['py'][19] = [19, 'Primera División'];     

// --- Bolivia:
array_divisiones['bo'] = [];
array_divisiones['bo'][20] = [20, 'Primera División']; 

      
// --- México:
array_divisiones['mx'] = [];
array_divisiones['mx'][21] = [21, 'Primera División Liga MX'];
array_divisiones['mx'][22] = [22, 'Ascenso Mexicano'];      


// Array Posiciones:
// Nota: La posición 2 hace referencia número del grupo de posiciones y el 3 al nombre:
var array_posiciones = [
    [0, 'Todos'],
    [1, 'Arquero', 1, 'Arqueros'],
    [2, 'Defensa Central', 2, 'Defensas'],
    [3, 'Lateral Izquierdo', 2, 'Defensas'],
    [4, 'Lateral Derecho', 2, 'Defensas'],
    [5, 'Volante Defensivo', 3, 'Mediocampistas'],
    [6, 'Volante Izquierdo', 3, 'Mediocampistas'],
    [7, 'Volante Derecho', 3, 'Mediocampistas'],
    [8, 'Volante Mixto', 3, 'Mediocampistas'],
    [9, 'Volante Ofensivo', 3, 'Mediocampistas'],
    [10, 'Extremo Izquierdo', 4, 'Delanteros'],
    [11, 'Extremo Derecho', 4, 'Delanteros'],
    [12, 'Delantero Centro', 4, 'Delanteros'],
];

// -------- Países ------------- //
var paises_nacionalidad = [];
paises_nacionalidad['af'] = 'Afganistán';
paises_nacionalidad['al'] = 'Albania';
paises_nacionalidad['de'] = 'Alemania';
paises_nacionalidad['ad'] = 'Andorra';
paises_nacionalidad['ao'] = 'Angola';
paises_nacionalidad['ai'] = 'Anguilla';
paises_nacionalidad['aq'] = 'Antártida';
paises_nacionalidad['ag'] = 'Antigua y Barbuda';
paises_nacionalidad['an'] = 'Antillas Holandesas';
paises_nacionalidad['sa'] = 'Arabia Saudí';
paises_nacionalidad['dz'] = 'Argelia';
paises_nacionalidad['ar'] = 'Argentina';
paises_nacionalidad['am'] = 'Armenia';
paises_nacionalidad['aw'] = 'Aruba';
paises_nacionalidad['au'] = 'Australia';
paises_nacionalidad['at'] = 'Austria';
paises_nacionalidad['az'] = 'Azerbaiyán';
paises_nacionalidad['bs'] = 'Bahamas';
paises_nacionalidad['bh'] = 'Bahrein';
paises_nacionalidad['bd'] = 'Bangladesh';
paises_nacionalidad['bb'] = 'Barbados';
paises_nacionalidad['be'] = 'Bélgica';
paises_nacionalidad['bz'] = 'Belice';
paises_nacionalidad['bj'] = 'Benin';
paises_nacionalidad['bm'] = 'Bermudas';
paises_nacionalidad['by'] = 'Bielorrusia';
paises_nacionalidad['mm'] = 'Birmania';
paises_nacionalidad['bo'] = 'Bolivia';
paises_nacionalidad['ba'] = 'Bosnia y Herzegovina';
paises_nacionalidad['bw'] = 'Botswana';
paises_nacionalidad['br'] = 'Brasil';
paises_nacionalidad['bn'] = 'Brunei';
paises_nacionalidad['bg'] = 'Bulgaria';
paises_nacionalidad['bf'] = 'Burkina Faso';
paises_nacionalidad['bi'] = 'Burundi';
paises_nacionalidad['bt'] = 'Bután';
paises_nacionalidad['cv'] = 'Cabo Verde';
paises_nacionalidad['kh'] = 'Camboya';
paises_nacionalidad['cm'] = 'Camerún';
paises_nacionalidad['ca'] = 'Canadá';
paises_nacionalidad['td'] = 'Chad';
paises_nacionalidad['cl'] = 'Chile';
paises_nacionalidad['cn'] = 'China';
paises_nacionalidad['cy'] = 'Chipre';
paises_nacionalidad['va'] = 'Ciudad del Vaticano (Santa Sede)';
paises_nacionalidad['co'] = 'Colombia';
paises_nacionalidad['km'] = 'Comores';
paises_nacionalidad['cg'] = 'Congo';
paises_nacionalidad['cd'] = 'Congo, República Democrática del';
paises_nacionalidad['kr'] = 'Corea';
paises_nacionalidad['kp'] = 'Corea del Norte';
paises_nacionalidad['ci'] = 'Costa de Marfíl';
paises_nacionalidad['cr'] = 'Costa Rica';
paises_nacionalidad['hr'] = 'Croacia (Hrvatska)';
paises_nacionalidad['cu'] = 'Cuba';
paises_nacionalidad['dk'] = 'Dinamarca';
paises_nacionalidad['dj'] = 'Djibouti';
paises_nacionalidad['dm'] = 'Dominica';
paises_nacionalidad['ec'] = 'Ecuador';
paises_nacionalidad['eg'] = 'Egipto';
paises_nacionalidad['sv'] = 'El Salvador';
paises_nacionalidad['ae'] = 'Emiratos Árabes Unidos';
paises_nacionalidad['er'] = 'Eritrea';
paises_nacionalidad['si'] = 'Eslovenia';
paises_nacionalidad['es'] = 'España';
paises_nacionalidad['us'] = 'Estados Unidos';
paises_nacionalidad['ee'] = 'Estonia';
paises_nacionalidad['et'] = 'Etiopía';
paises_nacionalidad['fj'] = 'Fiji';
paises_nacionalidad['ph'] = 'Filipinas';
paises_nacionalidad['fi'] = 'Finlandia';
paises_nacionalidad['fr'] = 'Francia';
paises_nacionalidad['ga'] = 'Gabón';
paises_nacionalidad['gm'] = 'Gambia';
paises_nacionalidad['ge'] = 'Georgia';
paises_nacionalidad['gh'] = 'Ghana';
paises_nacionalidad['gi'] = 'Gibraltar';
paises_nacionalidad['gd'] = 'Granada';
paises_nacionalidad['gr'] = 'Grecia';
paises_nacionalidad['gl'] = 'Groenlandia';
paises_nacionalidad['gp'] = 'Guadalupe';
paises_nacionalidad['gu'] = 'Guam';
paises_nacionalidad['gt'] = 'Guatemala';
paises_nacionalidad['gy'] = 'Guayana';
paises_nacionalidad['gf'] = 'Guayana Francesa';
paises_nacionalidad['gn'] = 'Guinea';
paises_nacionalidad['gq'] = 'Guinea Ecuatorial';
paises_nacionalidad['gw'] = 'Guinea-Bissau';
paises_nacionalidad['ht'] = 'Haití';
paises_nacionalidad['hn'] = 'Honduras';
paises_nacionalidad['hu'] = 'Hungría';
paises_nacionalidad['in'] = 'India';
paises_nacionalidad['id'] = 'Indonesia';
paises_nacionalidad['iq'] = 'Irak';
paises_nacionalidad['ir'] = 'Irán';
paises_nacionalidad['ie'] = 'Irlanda';
paises_nacionalidad['bv'] = 'Isla Bouvet';
paises_nacionalidad['cx'] = 'Isla de Christmas';
paises_nacionalidad['is'] = 'Islandia';
paises_nacionalidad['ky'] = 'Islas Caimán';
paises_nacionalidad['ck'] = 'Islas Cook';
paises_nacionalidad['cc'] = 'Islas de Cocos o Keeling';
paises_nacionalidad['fo'] = 'Islas Faroe';
paises_nacionalidad['hm'] = 'Islas Heard y McDonald';
paises_nacionalidad['fk'] = 'Islas Malvinas';
paises_nacionalidad['mp'] = 'Islas Marianas del Norte';
paises_nacionalidad['mh'] = 'Islas Marshall';
paises_nacionalidad['um'] = 'Islas menores de Estados Unidos';
paises_nacionalidad['pw'] = 'Islas Palau';
paises_nacionalidad['sb'] = 'Islas Salomón';
paises_nacionalidad['sj'] = 'Islas Svalbard y Jan Mayen';
paises_nacionalidad['tk'] = 'Islas Tokelau';
paises_nacionalidad['tc'] = 'Islas Turks y Caicos';
paises_nacionalidad['vi'] = 'Islas Vírgenes (EEUU)';
paises_nacionalidad['vg'] = 'Islas Vírgenes (Reino Unido)';
paises_nacionalidad['wf'] = 'Islas Wallis y Futuna';
paises_nacionalidad['il'] = 'Israel';
paises_nacionalidad['it'] = 'Italia';
paises_nacionalidad['jm'] = 'Jamaica';
paises_nacionalidad['jp'] = 'Japón';
paises_nacionalidad['jo'] = 'Jordania';
paises_nacionalidad['kz'] = 'Kazajistán';
paises_nacionalidad['ke'] = 'Kenia';
paises_nacionalidad['kg'] = 'Kirguizistán';
paises_nacionalidad['ki'] = 'Kiribati';
paises_nacionalidad['kw'] = 'Kuwait';
paises_nacionalidad['la'] = 'Laos';
paises_nacionalidad['ls'] = 'Lesotho';
paises_nacionalidad['lv'] = 'Letonia';
paises_nacionalidad['lb'] = 'Líbano';
paises_nacionalidad['lr'] = 'Liberia';
paises_nacionalidad['ly'] = 'Libia';
paises_nacionalidad['li'] = 'Liechtenstein';
paises_nacionalidad['lt'] = 'Lituania';
paises_nacionalidad['lu'] = 'Luxemburgo';
paises_nacionalidad['mk'] = 'Macedonia, Ex-República Yugoslava de';
paises_nacionalidad['mg'] = 'Madagascar';
paises_nacionalidad['my'] = 'Malasia';
paises_nacionalidad['mw'] = 'Malawi';
paises_nacionalidad['mv'] = 'Maldivas';
paises_nacionalidad['ml'] = 'Malí';
paises_nacionalidad['mt'] = 'Malta';
paises_nacionalidad['ma'] = 'Marruecos';
paises_nacionalidad['mq'] = 'Martinica';
paises_nacionalidad['mu'] = 'Mauricio';
paises_nacionalidad['mr'] = 'Mauritania';
paises_nacionalidad['yt'] = 'Mayotte';
paises_nacionalidad['mx'] = 'México';
paises_nacionalidad['fm'] = 'Micronesia';
paises_nacionalidad['md'] = 'Moldavia';
paises_nacionalidad['mc'] = 'Mónaco';
paises_nacionalidad['mn'] = 'Mongolia';
paises_nacionalidad['ms'] = 'Montserrat';
paises_nacionalidad['mz'] = 'Mozambique';
paises_nacionalidad['na'] = 'Namibia';
paises_nacionalidad['nr'] = 'Nauru';
paises_nacionalidad['np'] = 'Nepal';
paises_nacionalidad['ni'] = 'Nicaragua';
paises_nacionalidad['ne'] = 'Níger';
paises_nacionalidad['ng'] = 'Nigeria';
paises_nacionalidad['nu'] = 'Niue';
paises_nacionalidad['nf'] = 'Norfolk';
paises_nacionalidad['no'] = 'Noruega';
paises_nacionalidad['nc'] = 'Nueva Caledonia';
paises_nacionalidad['nz'] = 'Nueva Zelanda';
paises_nacionalidad['om'] = 'Omán';
paises_nacionalidad['nl'] = 'Países Bajos';
paises_nacionalidad['pa'] = 'Panamá';
paises_nacionalidad['pg'] = 'Papúa Nueva Guinea';
paises_nacionalidad['pk'] = 'Paquistán';
paises_nacionalidad['py'] = 'Paraguay';
paises_nacionalidad['pe'] = 'Perú';
paises_nacionalidad['pn'] = 'Pitcairn';
paises_nacionalidad['pf'] = 'Polinesia Francesa';
paises_nacionalidad['pl'] = 'Polonia';
paises_nacionalidad['pt'] = 'Portugal';
paises_nacionalidad['pr'] = 'Puerto Rico';
paises_nacionalidad['qa'] = 'Qatar';
paises_nacionalidad['uk'] = 'Reino Unido';
paises_nacionalidad['cf'] = 'República Centroafricana';
paises_nacionalidad['cz'] = 'República Checa';
paises_nacionalidad['za'] = 'República de Sudáfrica';
paises_nacionalidad['do'] = 'República Dominicana';
paises_nacionalidad['sk'] = 'República Eslovaca';
paises_nacionalidad['re'] = 'Reunión';
paises_nacionalidad['rw'] = 'Ruanda';
paises_nacionalidad['ro'] = 'Rumania';
paises_nacionalidad['ru'] = 'Rusia';
paises_nacionalidad['eh'] = 'Sahara Occidental';
paises_nacionalidad['kn'] = 'Saint Kitts y Nevis';
paises_nacionalidad['ws'] = 'Samoa';
paises_nacionalidad['as'] = 'Samoa Americana';
paises_nacionalidad['sm'] = 'San Marino';
paises_nacionalidad['vc'] = 'San Vicente y Granadinas';
paises_nacionalidad['sh'] = 'Santa Helena';
paises_nacionalidad['lc'] = 'Santa Lucía';
paises_nacionalidad['st'] = 'Santo Tomé y Príncipe';
paises_nacionalidad['sn'] = 'Senegal';
paises_nacionalidad['sc'] = 'Seychelles';
paises_nacionalidad['sl'] = 'Sierra Leona';
paises_nacionalidad['sg'] = 'Singapur';
paises_nacionalidad['sy'] = 'Siria';
paises_nacionalidad['so'] = 'Somalia';
paises_nacionalidad['lk'] = 'Sri Lanka';
paises_nacionalidad['pm'] = 'St Pierre y Miquelon';
paises_nacionalidad['sz'] = 'Suazilandia';
paises_nacionalidad['sd'] = 'Sudán';
paises_nacionalidad['se'] = 'Suecia';
paises_nacionalidad['ch'] = 'Suiza';
paises_nacionalidad['sr'] = 'Surinam';
paises_nacionalidad['th'] = 'Tailandia';
paises_nacionalidad['tw'] = 'Taiwán';
paises_nacionalidad['tz'] = 'Tanzania';
paises_nacionalidad['tj'] = 'Tayikistán';
paises_nacionalidad['tf'] = 'Territorios franceses del Sur';
paises_nacionalidad['tp'] = 'Timor Oriental';
paises_nacionalidad['tg'] = 'Togo';
paises_nacionalidad['to'] = 'Tonga';
paises_nacionalidad['tt'] = 'Trinidad y Tobago';
paises_nacionalidad['tn'] = 'Túnez';
paises_nacionalidad['tm'] = 'Turkmenistán';
paises_nacionalidad['tr'] = 'Turquía';
paises_nacionalidad['tv'] = 'Tuvalu';
paises_nacionalidad['ua'] = 'Ucrania';
paises_nacionalidad['ug'] = 'Uganda';
paises_nacionalidad['uy'] = 'Uruguay';
paises_nacionalidad['uz'] = 'Uzbekistán';
paises_nacionalidad['vu'] = 'Vanuatu';
paises_nacionalidad['ve'] = 'Venezuela';
paises_nacionalidad['vn'] = 'Vietnam';
paises_nacionalidad['ye'] = 'Yemen';
paises_nacionalidad['yu'] = 'Yugoslavia';
paises_nacionalidad['zm'] = 'Zambia';
paises_nacionalidad['zw'] = 'Zimbabue';

// Array Lateralidad:
var array_lateralidad = [
	[0, 'Todos'],
	[1, 'Derecho'],
	[2, 'Izquierdo'],
	[3, 'Ambidiestro'],
];

// Array del estado del club del jugador:
var array_estadoclub_jugador = [
	[0, 'Todos'],
	[1, 'Jugador Libre'],
	[2, 'En club'],
];

var estatus_vista_form;
var idfichaJugador = "";
var idfichaJugador_club = "";
var idfichaJugador_partido = "";
var idcscouting_jugador = "";
// Array para guardar datos del jugador:
var datos_jugador_club = {};
// Array para guardar datos de los partidos del jugador:
var datos_jugador_partido = {};

var ano_actual = '<?php echo $ano_actual;?>';
var mes_actual = parseInt('<?php echo $mes_actual;?>');
var error_foto = 0;

function goPage (newURL) {
	if (newURL != "") {
		if (newURL == 0 ) {
			resetMenu();            
		}   
		else {  
		  document.location.href = newURL;
		}
	}
}

function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}

function refrescar(){
	$("#search").load("post/consultar_datetime.php");
}

function subir_imagen_jugador(){
	var file = document.forms['formulario_ficha_jugador']['foto_jugador'].files[0];
	var imagefile = file.type;
	var imagesize = file.size;
	var match= ["image/jpeg","image/png","image/jpg"];
	if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
		if(window.error_foto!=1){//1=copia camiseta (AGREGAR)
			window.error_foto=1;
		}else{
			window.error_foto=3; //no se copia nada
		}
		$("#message_foto_jugador").html("<span id='error_message' style='color:#f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> solo formato jpg o png</span>");
	}else if(imagesize > 4000000){	
		if(error_foto!=1){//1=copia camiseta (AGREGAR)
			window.error_foto=1;
		}else{
			window.error_foto=3; //no se copia nada
		}
		$("#message_foto_jugador").html("<span id='error_message' style='color:#f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> tamaño máximo 4[mb]</span>");
	}else{
		window.error_foto=4;
		
		$("#message_foto_jugador").html("");
	}
	return window.error_foto;
}

function imageIsLoaded(e) {
	$('#image_preview_jugador').css("display", "block");
	/*
	$('#foto-jugador').attr('src', e.target.result);
	$('#foto-jugador').attr('width', '250px');
	$('#foto-jugador').attr('height', '230px');
	*/
}

function colocar_icono_cargando(opcionMenu){
	var texto_opcion="<i class='icon-spinner icon-spin icon-large'></i> "+opcionMenu.innerHTML;
	opcionMenu.innerHTML = texto_opcion;
}

function mostrar_al_cargar_pagina(){
	$('#pagina').slideDown("slow");
	$('#cargando_pagina').hide();
}




//Angular//
/*
//////////////////////Expresiones regulares//////////////////////
?     0 o 1 vez
*     0 o muchas veces
+     1 o muchas veces
\s    espacio en blanco
{n}   n veces
{n,m} n a m veces
//////////////////////Angular JS//////////////////////////
ng-trim    false-->     elimina espacios en blanco al comienzo y al final
*/
var app= angular.module("App_Angular",[]);
app.controller("controlador_1",['$scope',function($scope){
	
	$.fn.modal.Constructor.prototype.enforceFocus = function () {}; // <---- Esta función permite un modal dentro de otra.

	$scope.ER_alfaNumericoConEspacios=/^([a-zA-Z0-9\x7f-\xff](\s[a-zA-Z0-9\x7f-\xff])*)+$/;
	$scope.ER_email=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	$scope.ER_alfaNumericoSinEspacios=/^([a-zA-Z0-9])+$/;
	$scope.ER_numericoSinEspacios=/^[0-9]+$/;
	$scope.ER_caracteresConEspacios=/^([a-zA-Z\x7f-\xff](\s[a-zA-Z\x7f-\xff])*)+$/;
	$scope.ER_altura=/^([1-2]{1}[0-9]{2})$/;
	$scope.ER_peso=/^((([1]{1}[0-4]{1}[0-9]{1})|([3-9]{1}[0-9]{1}))(\.[1-9])?)$/;
	$scope.ER_telefono=/^[0-9]+$/;
	$scope.ER_rut=/^(([1-2]{1}[0-9]?)|([1-9]{1}))[0-9]{6}-([0-9]|k){1}$/;
	$scope.ER_rut_empresa=/^(([1-9]{1}[0-9]{1,2})|([1-9]{1}))[0-9]{6}-([0-9]|k){1}$/;
	
	$scope.ER_valorMonto=/^[1-9]{1}[0-9]*[0]{1}$/;
	
	$scope.ER_alfaNumericoConEspaciosAcentos=/^([a-zA-Z0-9\x7f-\xff](\s[a-zA-Z0-9])*)+$/;
	
	$scope.clickFunction = function() {
		$scope.buttonClicks=1;
	};
	
	$scope.aplicar = function() {
		$scope.ingresar_nombre = 'value here';
	}
	
	$scope.desactivarBoton = function() {
		$('#boton_comentario').attr('disabled', true);
		//$scope.isDisabled = true;
		return false;
	}
	
	$scope.activarBoton = function() {
		$('#boton_comentario').attr('disabled', false);
		//$scope.isDisabled = true;
		return false;
	}
	$scope.desactivarBoton2 = function() {
		$('#boton_agregar_Fertilizante').attr('disabled', true);    
		//$scope.isDisabled = true;
		return false;
	}
	
	
	$scope.desactivarBotonAgregarProveedor = function() {
		$('#boton_agregar_ficha_jugador').attr('disabled', true);   
		//$scope.isDisabled = true;
		return false;
	}
	$scope.desactivarBotonEliminarProveedor = function() {
		$('#boton_eliminar_proveedor').attr('disabled', true);  
		//$scope.isDisabled = true;
		return false;
	}
}]);
</script>

</head>
<body onload="setInterval(refrescar, 1000)" ng-controller="controlador_1" ng-app="App_Angular" id="angularData">

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html"><?php echo $abreviacion_dominio;?></a></h1>
</div>
<!--close-Header-part--> 
<!--start-top-serch-->
<div id="search" style="font-size:15px; font-weight: bold; color: white; padding-top:3px; padding-right:5px;">
	<?php 
		echo $data[0]."&nbsp;&nbsp;&nbsp;".$data[1];
	?>
</div>
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon-truck"></i> SCOUTING <i class="icon-chevron-right"></i> Búsqueda</a>
  <?php include('../config/menu.php');?>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
   <div id="breadcrumb"> 
		<a title="Go to Home" class="tip-bottom">
			<i class="icon-home"></i> Inicio
		</a> 
		<a class="tip-bottom">
			<i class="icon-truck"></i> SCOUTING
		</a> 
		<a class="current">
			Búsqueda
		</a> 
	
	</div>
  </div>
<!--End-breadcrumbs-->
 
<div class="container-fluid" id="cargando_pagina">
	<center>
	<img src="" style="margin-top:100px;" id="cargando_final">
	<script>$('#cargando_final').attr('src',imagen_cargando.src);</script>
	</center>
</div>
<!--Action boxes-->


<div class="container-fluid" style="display:none;" id="pagina">
	  
	
<?php if(($software_demo && $demo_seccion) || !$software_demo){?>


<div class="row-fluid">

<!--
cuadro_listado_series
jugadores_pozo_comun
cuadro_form_agregar_jugador
-->

<!-- ========================================== Inicio del id="cuadro_listado_series" ========================================== -->     
<div class="row-fluid" style="margin-top: 0px; color:black; font-family:Arial, Helvetica, sans-serif;" id="cuadro_listado_series"> 

<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
<div class="cuadro_buscar_titulo">

	<center>
		<!--	
		<table style="color:black; font-family:Arial, Helvetica, sans-serif;margin-bottom: 10px">
			<tr class="sin_fondo">
				<td style="width: 150px; text-align: center;">
					<div style="padding:0px; margin:0px; width: 250px; margin-top: 25px;">
						<img src="../config/icon-search-inverted.png" style="width:75px; margin-top:5px;"> 
						<h3 style="margin-top: 0px; display: inline-block;">Búsqueda</h3>
					</div>
				</td>
			</tr>
		</table>
		-->
		<table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
		        <tbody>
		        	<tr class="sin_fondo">
			            <td style="padding:12px; padding-top:15px;"><img src="../config/icon-search-inverted.png" style="height: 100px; margin-top:5px;"></td>
			            <td>
			                <center>
			                    <h3 class="titulo_principal" style="text-transform: uppercase;">Scouting - Búsqueda</h3>
			                    <p style="margin: 0px;">
			                    	En esta sección puedes crear, visualizar, modifcar y eliminar datos de jugadores clasificados por país y club
			                    </p>
			                </center>
			            </td>
		        	</tr>
		    </tbody>
		</table>		

		<div style="width:100%; background-color:#163D61; height:20px; border-radius: 4px;"></div>
		<br>
	</center>

</div>
<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

<div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px;">

	<div id="selecciones_cajas" class="row-fluid" style="margin-top: 20px; margin-left: 5%; width: 97%;">
		<!-- Aquí se insertarán los cuadros de las series -->
	</div>

</div>



</div>
<!-- ========================================== Fin del id="cuadro_listado_series" ========================================== -->

<!-- Cuadro para los clubes de países mostrados en la vista principal:
- Chile.
- Argentina.
- Venezuela.
- Brasil.
- Colombia.
- Ecuador.
- Uruguay.
- Perú.
- Paraguay.
- Mexico.
 -->

<!-- Inputs tipo "hidden" para usarlos como filtro de datos --> 
<input class="input-filtro-tipo-pais" type="hidden">
<input class="input-filtro-pais_club" type="hidden">
<!-- ========================================== Inicio del id="club_pais_selected" ========================================== -->
<div style=" display:none;" id="club_pais_selected">

	<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
	<div class="cuadro_buscar_titulo" style="margin-top: -10px;">
		
		<center>
			<div class="row-fluid" style="margin-top:0px; /*width: 93%;*/">
                <div class="span12" style="margin: 0px;">
					
					<table id="tabla-pais-club" style="color: black; font-family: Arial, Helvetica, sans-serif;">
			            <tbody>
			            	<tr class="sin_fondo">
			                    <td style="padding: 15px; text-align: center;">
			                        <img class="foto-pais-clubpais" src="" style="/*margin-top:5px; margin-right: 5px;*/ display: inline-block;">
			                    </td>
			                    <td style="text-align: center;">
			                        <!-- <h3 class="titulo_principal" style="margin: 0px; line-height: 26px; text-transform: uppercase;">jugadores</h3> -->
			                        <h3 class="titulo_principal" style="margin: 0px; line-height: 26px; text-transform: uppercase;">scouting <b class="nombre-pais-clubpais-tipo1"></b></h3>
			                        <!--
									<p style="margin-top: 0px; display: inline-block; color: black; font-weight: bold; font-size: 20px; text-transform: uppercase; position: relative; top: 5px;">scouting <b class="nombre-pais-clubpais-tipo1"></b></p>
			                        -->
			                    </td>
			                </tr>
			            </tbody>
					</table>					

					<div style="width:100%; background-color: <?php echo $color_fondo; ?> height:20px; border-radius: 4px;"></div>

					<div style="width: 100%; margin-top: 20px;">
			
						<button class="boton_volver" onclick="boton_volver_cuadro_listado_series();" style="float: left;">
							<i class="icon-arrow-left"></i> volver
						</button>    	
				        <!--
				        <div style="display: block;width: 30%;">
				           <p style="text-align: center; font-size: 13px; font-weight: bold; color: black;">Seleccione el tipo de informe a realizar</p>
				        </div>
				        -->

				        <!-- ========== FILTRO PARA CLUBES PERTENECIENTES A UNO DE LOS PAÍSES PRINCIPALES -->
				        <div class="filtros-pais-principales" style="display: none;width: 30%;">
							<div style="display: flex;">
								<a class="btn btn-md btn-primary gray-a"> 
								DIVISIÓN
								</a>
								<!-- <select class="gray-input select-division-filtro-busqueda" onchange="buscar_club_pais();"></select> -->
								<select class="gray-input" id="division_idpais_main_filtro" name="division_idpais_main_filtro" onchange="buscar_club_pais();"></select>
							</div>
				        </div> 

				        <!-- ========== FILTRO PARA CLUBES PERTENECIENTES A OTROS PAÍSES -->
						<div class="filtros-pais-otros" style="display: none;width: 60%;">

				           	<div style="float: left;width: 45%;">
				           		<a class="btn-md btn-primary gray-a" style="padding: 5px 0px;vertical-align: middle;width: 50%;display: block;float: left;">PAÍS</a>
				           		<select id="idpais_otros_filtro" name="idpais_otros_filtro" class="gray-input select-pais-otro" style="width: 50%;text-align: center;margin: 0;float: right; text-align-last: center;" onchange="get_divisiones_from_pais( 10 );"></select>	
				           	</div>		

				           	<div style="width: 45%;float: right;">
				           		<a class="btn-md btn-primary gray-a" style="padding: 5px 0px;vertical-align: middle;width: 50%;display: block;float: left;">DIVISIÓN</a>
				           		<select class="gray-input" id="division_idpais_otros_filtro" name="division_idpais_otros_filtro" style="width: 50%;text-align: center;margin: 0;float: right; text-align-last: center;" onchange="buscar_club_pais();"></select>				           		
				           	</div>
	           	
				        </div>

				    </div>						            
                </div>
            </div>		
		</center>

		<!-- ================= Inicio del class="fluid cuadro_buscar_buscar" ================= -->
		<div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
								     
				
			<center>
				<div style=" width:500px; margin-bottom:10px; display: inline-block;">
					<button class="boton_refresh" id="boton_refresh_club_pais" onclick="buscar_club_pais();" style="margin-left:10px;"><i class="icon-refresh"></i></button>
				</div>
			</center>
						
			<center>
				<div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar_club_pais" style=" display:none;">
					<span style="color:#dc4e4e; display:none;" id="error_conexion_club_pais"><b>Error:</b> conexión a internet deficiente.</span>
					<span style="color:<?php echo $color_fondo; ?>; display:block;" id="sin_resultados_club_pais">Busqueda sin resultados.</span>
				</div>
			</center>
			
							
			<!-- ================= Inicio del class="row-fluid" ================= -->
			<div class="row-fluid" style="/*margin-top: 100px;*/">

				<!-- ================= Inicio del class="span12" ================= -->
				<div class="span12" style="margin: 0px;"> 

					<!-- ================= Inicio del id="tabla_club_pais_selected" ================= -->  
					<table id="tabla_club_pais_selected" class="black-table">
						<thead>
							<tr>
								<th scope="col" style="border-top-left-radius:5px; min-width:25px; width: 60px;"></th>
								<th scope="col" style="cursor:pointer; ;text-align: left; width: 150px;">
									<div class="tip-top" data-original-title="Club" style="width:170px;">CLUB</div>
								</th>	
								<th scope="col" style="cursor:pointer; text-align: left; width: 180px;">
									<div class="tip-top" data-original-title="División" style="width:120px;">DIVISIÓN</div>
								</th>
								<th scope="col" style="cursor:pointer;  width: 140px; text-align: left;">
									<div class="tip-top" data-original-title="Plantel Actual" style=" cursor: pointer; padding: 0px; text-align: left;">
										PLANTEL ACTUAL
									</div>
								</th>
								<th scope="col" style="cursor:pointer; text-align: left; width: 100px;">
									<div class="tip-top" data-original-title="Entrenador" style="width:100%;">
										ENTRENADOR
									</div>
								</th>
								<th scope="col" style="cursor:pointer; text-align: center; width: 100px;">
									<div class="tip-top" data-original-title="Media Edad" style="width:100%;">MEDIA EDAD</div>
								</th>							
								<th scope="col" style="cursor:pointer;  border-top-right-radius:5px; width:150px;" colspan="1"></th>
							</tr>
						</thead>
						<tbody>

						</tbody>             
						<tfoot>
							<tr style="color:white;">
								<th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th colspan="1" scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
							</tr>
						</tfoot>
					</table>
					<!-- ================= Fin del id="tabla_club_pais_selected" ================= -->
				</div>
				<!-- ================= Fin del class="span12" ================= -->
			</div>
			<!-- ================= Fin del class="row-fluid" ================= -->
		</div>
		<!-- ================= Fin del class="fluid cuadro_buscar_buscar" ================= -->
	</div>		
	<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
</div>
<!-- ========================================== Fin del id="club_pais_selected" ========================================== -->

<!-- Cuadro para los clubes de otros países (no son mostrados en la vista principal):
 -->
<div style=" display:none;" id="cuadro_jugadores_club_selected">

	<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
	<div class="cuadro_buscar_titulo" style="margin-top: -10px;">

		<!-- Inputs tipo "hidden" para usarlos como filtro de datos -->
		<input class="sexo" type="hidden">
		<input class="numero_serie" type="hidden">
		<input class="tecnico" type="hidden">

		<center>
			<div class="row-fluid" style="margin-top: 50px;">
				<div class="span12" style="margin-top: 20px;">
				    <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px; border-radius: 4px;"></div>
					<div style=" width: 160px; height: 150px; border-radius: 50%; /*background-color: <?php echo $color_fondo; ?>;*/ margin-top: -90px;">
						<img src="" class="foto-club-selected" style="width: 120px;/* border-radius: 50%; *//* border: solid <?php echo $color_fondo; ?>; 4px; */ height: 120px;padding: 20px;display: block;background-color: transparent;">
					</div>                  
				</div>			
			</div>
		</center>

		<h4 style="color: black; text-align: center; text-transform: uppercase;" class="nombre-club-selected"></h4>

		<center>
			<div class="row-fluid" style="/*width: 93%;*/">
				<div class="span12">
					<button class="boton_volver" onclick="btnvolver_clubpais_tipo1_selected();" style="float:left; margin:0px;">
						<i class="icon-arrow-left"></i> volver
					</button>					
				</div>					
			</div>
		</center>			

		<!-- ================= Inicio del class="fluid cuadro_buscar_buscar" ================= -->
		<div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
			
			<input class="input-id-club-filtro" name="" type="hidden">
			<input class="input-pais-club-filtro" name="" type="hidden">
			<input class="input-division-club-filtro" name="" type="hidden">						 	

			<div style="width: 80%; margin: auto;">			

				<div class="span4" style="display: flex;">
					<a class="btn btn-md btn-primary gray-a"> 
						Posición
					</a>
					<select class="gray-input select-posicion-jugador-filtro-busqueda" onchange="ver_jugadores_club_selected( 2 );"></select>
				</div>
				<!-- ======================================================================== -->
				<div class="span4" style="display: flex;">
					<a class="btn btn-md btn-primary gray-a"> 
						Nacionalidad
					</a>
					<select class="gray-input select-pais-filtro-busqueda" onchange="ver_jugadores_club_selected( 2 );"></select>
				</div>
				<!-- ======================================================================== -->
				<div class="span4" style="display: flex;">
					<span class="btn btn-md btn-primary gray-a" style="width: 60%; margin-right: 5px;">Año Nacimiento</span>	
					<div class='multi-range' data-lbound='' data-ubound=''>
					    <hr class="hr-input-range" />
					    <input type='range' id="range_anio_nac_1" 
					           min='0' max='0' step='' value='0' 
					           oninput='this.parentNode.dataset.lbound=this.value;'
					           onchange="ver_jugadores_club_selected( 2 );" 
					    />
					    <input type='range' id="range_anio_nac_2" 
					           min='' max='50000' step='' value='0' 
					           oninput='this.parentNode.dataset.ubound=this.value;'
					           onchange="ver_jugadores_club_selected( 2 );" 
					    />
					</div>
				</div>
				<!-- ======================================================================== -->                                    
			</div>                
		
			<center>
				<div style=" width:500px; margin-bottom:10px; display: inline-block;">
					<button class="boton_refresh" id="boton_refresh_jugadores_club_selected" onclick="ver_jugadores_club_selected( 2 );" style="margin-left:10px;"><i class="icon-refresh"></i></button>
				</div>
			</center>
				
			<center>
				<div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar_jugadores_club_selected" style=" display:none;">
					<span style="color:#dc4e4e; display:none;" id="error_conexion_buscar_jugadores_club_selected"><b>Error:</b> conexión a internet deficiente.</span>
					<span style="color:<?php echo $color_fondo; ?>; display:block;" id="sin_resultados_jugadores_club_selected">Busqueda sin resultados.</span>
				</div>
			</center>
										
			<!-- ================= Inicio del class="row-fluid" ================= -->
			<div class="row-fluid" style="margin-top: 0px;">

				<!-- ================= Inicio del class="span12" ================= -->
				<div class="span12" style="margin: 0px;"> 
				
					<div style="width: 100%; margin: auto;">
						<button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onclick="btn_ir_form_agregarjugador();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar jugador</b></button>            						
					</div>

					<!-- ================= Inicio del id="tabla_cuadro_jugadores_club_selected" ================= -->  
					<table id="tabla_cuadro_jugadores_club_selected" class="black-table">
						<thead>
							<tr>
								<th scope="col" style="border-top-left-radius:5px; min-width:25px; width: 60px;"></th>
								<th scope="col" style="cursor:pointer; text-align: left; width:120px;">
									<div class="tip-top" data-original-title="Nombre" style="width:100%;">NOMBRE</div>
								</th>
								<th scope="col" style="cursor:pointer; text-align: center; width: 100px;">
									<div class="tip-top" data-original-title="Nacionalidad" style="width:100%;">NAC</div>
								</th>
								<th scope="col" style="cursor:pointer;  width: 140px;">
									<div class="tip-top" data-original-title="Posición" style=" cursor: pointer; padding: 0px; text-align: left;">
										POSICIÓN
									</div>
								</th>
								<th scope="col" style="cursor:pointer; text-align: center; width: 100px;">
									<div class="tip-top" data-original-title="Año de Nacimiento" style="width:100%;">AÑO NAC</div>
								</th>
								<th scope="col" style="cursor:pointer; text-align: center; width: 100px;">
									<div class="tip-top" data-original-title="Edad" style="width:100%;">EDAD</div>
								</th>
								<th scope="col" style="cursor:pointer; ;text-align: center; width: 100px;">
									<div class="tip-top" data-original-title="Pie Hábil" style="width:100%;">PIE HÁBIL</div>
								</th>
								<th scope="col" style="cursor:pointer; ;text-align: center; width: 150px;">
									<div class="tip-top" data-original-title="Fin de Contrato" style="width:100%;">FIN CONTRATO</div>
								</th>								
								<th scope="col" style="cursor:pointer;  border-top-right-radius:5px; width:150px;" colspan="3"></th>
							</tr>
						</thead>
						<tbody><!-- AQUÍ SERÁN INSERTADOS LOS DATOS CON JS --></tbody>             
						<tfoot>
							<tr style="color:white;">
								<th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th colspan="2" scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
							</tr>
						</tfoot>
					</table>
					<!-- ================= Fin del id="tabla_cuadro_jugadores_club_selected" ================= -->
				</div>
				<!-- ================= Fin del class="span12" ================= -->
			</div>
			<!-- ================= Fin del class="row-fluid" ================= -->
		</div>
		<!-- ================= Fin del class="fluid cuadro_buscar_buscar" ================= -->
	</div>		
	<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
</div>
<!-- ========================================== Fin del id="cuadro_jugadores_club_selected" ========================================== -->


<!-- ========================================== Inicio del id="jugadores_pozo_comun" ========================================== -->
<div style=" display:none;" id="jugadores_pozo_comun">

	<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
	<div class="cuadro_buscar_titulo" style="margin-top: 10px;">

		<button class="boton_volver" onclick="boton_volver_cuadro_listado_series();" style="position: absolute; top: 50px;">
			<i class="icon-arrow-left"></i> volver
		</button>

		<!-- Inputs tipo "hidden" para usarlos como filtro de datos -->
		<input class="sexo" type="hidden">
		<input class="numero_serie" type="hidden">
		<input class="tecnico" type="hidden">

		<!-- <h4 style="color: black; text-align: center; text-transform: uppercase;">jugadores</h4> -->

		<table style="color: black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
            <tbody>
            	<tr class="sin_fondo">
                    <td style="padding: 15px; text-align: center;">
                        <!-- <img src="../config/logo_equipo.png" style="height: 90px;"> -->
                    </td>
                    <td style="text-align: center;">
                        <h3 class="titulo_principal" style="margin: 0px; line-height: 26px; text-transform: uppercase;">jugadores</h3>
                    </td>
                </tr>
            </tbody>
		</table>

		<!-- <hr style="background-color: <?php echo $color_fondo; ?>;"/>  -->

		<div style="width:100%; background-color: <?php echo $color_fondo; ?> height:20px; border-radius: 4px;"></div>


		<!-- ================= Inicio del class="fluid cuadro_buscar_buscar" ================= -->
		<div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
									 
			<div style="margin-top: -10px; margin-bottom: 40px;">
				<div class="span3" style="display: flex;">
					<a class="btn btn-md btn-primary gray-a"> 
						Estado
					</a>
					<select class="gray-input select-estadoclub-jugador-filtro-busqueda" id="estadoclub-jugador-pzcomun" onchange="buscar_jugadores_pozo_comun( 2 );"></select>
				</div>
				<!-- ======================================================================== -->
				<div class="span3" style="display: flex;">
					<a class="btn btn-md btn-primary gray-a"> 
						Nacionalidad 
					</a>
					<select class="gray-input select-pais-filtro-busqueda" id="nacionalidad-jugador-pzcomun"  onchange="buscar_jugadores_pozo_comun( 2 );"></select>
				</div>
				<!-- ======================================================================== -->
				<div class="span3" style="display: flex;">
					<a class="btn btn-md btn-primary gray-a" style="width: 50%; text-transform: none;"> 
						País donde juega
					</a>
					<select class="gray-input select-pais-filtro-busqueda" id="paisclub-jugador-pzcomun" style="width: 40%;" onchange="get_divisiones_from_pais( 9 );"></select>
				</div>
				<!-- ======================================================================== -->
				<div class="span3" style="display: flex;">
					<a class="btn btn-md btn-primary gray-a"> 
						División
					</a>
					<select class="gray-input select-division-filtro-busqueda" id="divisionclub-jugador-pzcomun" onchange="get_clubes_from_paisdivision_pozocomun();">
						<option value="">Seleccione primero un país</option>
					</select>
				</div>
				<!-- ======================================================================== -->                                    
			</div>        

			<div>
				<div class="span3" style="display: flex;">
					<a class="btn btn-md btn-primary gray-a"> 
						Club
					</a>
					<!-- <select class="gray-input select-club-filtro-busqueda" id="club-jugador-pzcomun" onchange="buscar_jugadores_pozo_comun( 2 );"></select> -->
					<select class="gray-input" id="club-jugador-pzcomun" onchange="buscar_jugadores_pozo_comun( 2 );">
						<option value="">Seleccione primero una división</option>
					</select>
				</div>
				<!-- ======================================================================== -->
				<div class="span3" style="display: flex;">
					<span class="span-input-range" style="width: 20%;">Edad</span>
					<div class='multi-range mr-edad-pozo-comun' data-lbound='' data-ubound=''>
					    <hr class="hr-input-range" />
					    <input type='range' 
					           min='0' max='0' step='' value='0' id='range-edad-min-pzcomun' 
					           oninput='this.parentNode.dataset.lbound=this.value;' onchange="buscar_jugadores_pozo_comun( 2 );"
					    />
					    <input type='range' 
					           min='0' max='50000' step='' value='0' id='range-edad-max-pzcomun' 
					           oninput='this.parentNode.dataset.ubound=this.value;' onchange="buscar_jugadores_pozo_comun( 2 );"
					    />
					</div>
				</div>
				<!-- ======================================================================== -->
				<div class="span3" style="display: flex;">
					<span class="span-input-range" style="width: 20%;">Altura</span>	
					<div class='multi-range mr-altura-pozo-comun' data-lbound='10' data-ubound=''>
					    <hr class="hr-input-range" />
					    <input type='range' 
					           min='0' max='0' step='' value='0' id='altura-min-pzcomun' 
					           oninput='this.parentNode.dataset.lbound=this.value;' onchange="buscar_jugadores_pozo_comun( 2 );"
					    />
					    <input type='range' 
					           min='0' max='50000' step='' value='0' id='altura-max-pzcomun'
					           oninput='this.parentNode.dataset.ubound=this.value;' onchange="buscar_jugadores_pozo_comun( 2 );"
					    />
					</div>
				</div>
				<!-- ======================================================================== -->
				<div class="span3" style="display: flex;">
					<a class="btn btn-md btn-primary gray-a"> 
						Posición
					</a>
					<select class="gray-input select-posicion-jugador-filtro-busqueda" id="posicion-jugador-pzcomun" onchange="buscar_jugadores_pozo_comun( 2 );"></select>
				</div>
				<!-- ======================================================================== -->                                    
			</div>                

			
			<center>
				<div style=" width:500px; margin-bottom:10px; display: inline-block;">
					<button id="boton_refresh_pozo_comun" class="boton_refresh" onclick="buscar_jugadores_pozo_comun( 1 );" style="margin-left:10px;"><i class="icon-refresh"></i></button>
				</div>
			</center>
									
			<center>
				<div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar_pozo_comun" style=" display:none;">
					<span style="color:#dc4e4e; display:none;" id="error_conexion_pozo_comun"><b>Error:</b> conexión a internet deficiente.</span>
					<span style="color:<?php echo $color_fondo; ?>; display:block;" id="sin_resultados_pozo_comun">Busqueda sin resultados.</span>
				</div>
			</center>
			
							
			<!-- ================= Inicio del class="row-fluid" ================= -->
			<div class="row-fluid" style="margin-top: 0px;">

				<!-- ================= Inicio del class="span12" ================= -->
				<div class="span12" style="margin: 0px;"> 
				
					<div style="width: 100%; margin: auto;">
						<button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onclick="btn_ir_form_agregarjugador();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar jugador</b></button>            						
					</div>

					<!-- ================= Inicio del id="tabla_jugadores_pozo_comun" ================= -->  
					<table id="tabla_jugadores_pozo_comun" class="black-table">
						<thead>
							<tr>
								<th scope="col" style="border-top-left-radius:5px; cursor:pointer; text-align: center; width:120px;">
									<div class="tip-top" data-original-title="Nombre" style="width:100%;">NOMBRE</div>
								</th>
								<th scope="col" style="cursor:pointer; text-align: center; width: 100px;">
									<div class="tip-top" data-original-title="Nacionalidad" style="width:100%;">NAC</div>
								</th>
								<th scope="col" style="cursor:pointer;  width: 140px;">
									<div class="tip-top" data-original-title="Posición" style=" cursor: pointer; padding: 0px; text-align: left;">
										POSICIÓN
									</div>
								</th>
								<th scope="col" style="cursor:pointer; text-align: center; width: 100px;">
									<div class="tip-top" data-original-title="Año de Nacimiento" style="width:100%;">AÑO NAC</div>
								</th>
								<th scope="col" style="cursor:pointer; text-align: center; width: 100px;">
									<div class="tip-top" data-original-title="Edad" style="width:100%;">EDAD</div>
								</th>
								<th scope="col" style="cursor:pointer; ;text-align: center; width: 100px;">
									<div class="tip-top" data-original-title="Pie Hábil" style="width:100%;">PIE HÁBIL</div>
								</th>
								<th scope="col" style="cursor:pointer; ;text-align: center; width: 150px;">
									<div class="tip-top" data-original-title="CLUB" style="width:100px;">CLUB</div>
								</th>								
								<th scope="col" style="cursor:pointer;  border-top-right-radius:5px; width:150px;" colspan="3"></th>
							</tr>
						</thead>
						<tbody><!-- AQUÍ SE INSERTARÁN CON JS --></tbody>             
						<tfoot>
							<tr style="color:white;">
								<th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th scope="col" style="cursor:pointer; padding:0px;"></th>
								<th colspan="2" scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
							</tr>
						</tfoot>
					</table>
					<!-- ================= Fin del id="tabla_jugadores_pozo_comun" ================= -->
				</div>
				<!-- ================= Fin del class="span12" ================= -->
			</div>
			<!-- ================= Fin del class="row-fluid" ================= -->
		</div>
		<!-- ================= Fin del class="fluid cuadro_buscar_buscar" ================= -->
	</div>		
	<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
</div>
<!-- ========================================== Fin del id="jugadores_pozo_comun" ========================================== -->


<!-- ========================================== Inicio del id="cuadro_form_agregar_jugador" ========================================== -->
<!-- <br><center><h1>----------</h1></center><br> -->
<div style="display:none" id="cuadro_form_agregar_jugador">



	<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
	<div class="cuadro_buscar_titulo">
		<center>
			<div class="row-fluid" style="margin-top:0px;">
				<div class="span12" style="margin: 0px;">
					<button class="boton_volver" onclick="bntvolver_desde_form_jugador();" style="float:left; margin:0px; margin-top: 20px;">
						<i class="icon-arrow-left"></i> volver
					</button>    

					<p class="datos_fichaJugador" style="left: 170px;top: 25px;position: relative;display: inline-block;color: #040404;">
						<b style="text-transform: uppercase;color: #292727;">!NOTA: </b><span>los campos con (*) son</span><span style="text-decoration: underline;"> obligatorios</span>!
					</p>

				</div>			
			</div> 
		</center>     

		<!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
	</div>
	<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
	
	<div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; /*margin-top:-60px;*/">
		<div class="row-fluid" style="margin-top:0px;">

			<div class="span12 datos_fichaJugador" style="margin: 0px; margin-top: 10px;">            
				<p style="color: black; font-weight: bold; text-transform: uppercase; float: left;">Nuevo jugador:</p>
			</div>	


			<!-- ========================================== Inicio del id="formulario_ficha_jugador" ========================================== -->
			<form method="post" ng-model="formulario_ficha_jugador" name="formulario_ficha_jugador" id="formulario_ficha_jugador" novalidate autocomplete="off" enctype="multipart/form-data">			

			<div class="span12" style="margin-top: -10px; margin-left: 0;">

					<div style="width: 100%" class="datos_fichaJugador">
						
						<div class="span4">
							<!--
                            <div class="div-imagen-form">
                                <img id="foto-jugador" class="img-form" src="">
                            </div>  
						  	<div id="div_file">
						    	<p id="texto"><i class="icon-cloud-upload"></i> Subir foto (.jpg o png)</p>
						    	<input type="file" class="custom-file-input" id="foto_jugador" name="foto_jugador" required="" accept=".jpg, .png, .jpeg" onchange="readURL(this);"/>
						    	<input type="hidden" name="foto_anterior_jugador" id="foto_anterior_jugador" value="sinFoto">
						  	</div>
						  	-->
					      <center>
					      	<div id="image_preview_jugador" style="border: 6px solid <?php echo $color_fondo; ?>; width:180px; height:180px;  border-radius:100px;">
					      		<img id="foto-jugador" src="../config/cargando_logo_final.gif" style="width:180px; border-radius:100px; height:180px;" class="img-thumbnail"/>
					      	</div>	
					     	<label for="foto_jugador" class="boton_gestionar_cargos subiendo_foto" style="width:170px; margin-top:10px;">
					    		<i class="icon-cloud-upload"></i> Subir foto (.jpg o .png)
					    	</label>
							<input type="file" name="foto_jugador" id="foto_jugador" value=""  style="display:none;"/>
							<input type="hidden" name="foto_anterior_jugador" id="foto_anterior_jugador" value="sinFoto">
					        <div id="message_foto_jugador">
					        </div>
					   	  </center>

						</div>

						<!-- ========================================== Inicio de campos a la derecha ========================================== -->
				      <div class="span8" style="margin: 0px;">
				      	<div class="span12"  style="margin: 0px;">
				            <div class="span6" style="margin: 0px; margin-bottom:20px;">
				              <div style="padding:0px; margin:0px;">
				          	    <a class="btn btn-md btn-primary green-a"> *Nombre</a><input type="text" class="my-input" maxlength="149" name="nombre" id="nombre" onkeyup="chequear_datos_form_fichajugador();" onkeydown="chequear_datos_form_fichajugador();">
				          		</div>
				            </div>
				            <div class="span6" style="margin: 0px; margin-bottom:20px;">
				              <div style="padding:0px; margin:0px;">
				          	    <a class="btn btn-md btn-primary green-a"> *Apellido 1</a><input id="apellido1" name="apellido1" type="text" class="my-input" maxlength="149" onkeyup="chequear_datos_form_fichajugador();" onkeydown="chequear_datos_form_fichajugador();"></div>
				              </div>
				        </div>
				        <!-- ==================================================================================== -->
				        <div class="span12"  style="margin: 0px;">
				      		<div class="span6" style="margin: 0px;">
				            	<div style="padding:0px; margin:0px;">
				          	    	<a class="btn btn-md btn-primary green-a"> Apellido 2</a><input id="apellido2" name="apellido2" type="text" class="my-input" maxlength="149" onkeyup="chequear_datos_form_fichajugador();" onkeydown="chequear_datos_form_fichajugador();">
				          	    </div>
				            </div>
				            <div class="span6" style="margin: 0px; margin-bottom:20px;">
				            	<a class="btn btn-md btn-primary green-a"> Fecha nac.</a><input class="date-picker my-input" id="fechaNacimiento" name="fechaNacimiento" size="16" type="text" readonly>
				              </div>
				        </div>

				        <div class="span12"  style="margin: 0px;">
				      		<div class="span6" style="margin: 0px; margin-bottom:20px;">
					            <div style="padding:0px; margin:0px;">
					          	    <a class="btn btn-md btn-primary green-a"> Sexo</a><select id="sexo" name="sexo" class="green-input" onchange="chequear_datos_form_fichajugador();">
				                    	<option value="">Seleccione</option>
                                    	<option value="1">Masculino</option>
                                    	<option value="2">Femenino</option>
				                	</select>
					            </div>
				            </div>

				      		<div class="span6" style="margin: 0px; margin-bottom:20px;">
					            <div style="padding:0px; margin:0px;">
					          	    <a class="btn btn-md btn-primary green-a"> Altura</a><input id="altura" name="altura" type="text" class="my-input" onkeyup="chequear_datos_form_fichajugador();" onkeydown="chequear_datos_form_fichajugador();">
					            </div>
				            </div>				            
				        </div>

				        <!-- ==================================================================================== -->
				        <div class="span12"  style="margin: 0px;">
				      		<div class="span6" style="margin: 0px; margin-bottom:20px;">
					            <div style="padding:0px; margin:0px;">
					          	    <a class="btn btn-md btn-primary green-a"> Nacionalidad 1</a><select id="nacionalidad1" name="nacionalidad1" class="green-input select-pais-form" onchange="chequear_datos_form_fichajugador();">
					                </select>
					            </div>
				            </div>
				      		<div class="span6" style="margin: 0px; margin-bottom:20px;">
					            <div style="padding:0px; margin:0px;">
					          	    <a class="btn btn-md btn-primary green-a"> Nacionalidad 2</a><select id="nacionalidad2" name="nacionalidad2" class="green-input select-pais-form select-pais-form-adicional" onchange="chequear_datos_form_fichajugador();">
					                </select>
					            </div>
				            </div>
				        </div>
				        <!-- ==================================================================================== -->
				        <div class="span12"  style="margin: 0px;">
				      		<div class="span6" style="margin: 0px; margin-bottom:20px;">
					            <div style="padding:0px; margin:0px;">
					          	    <a class="btn btn-md btn-primary green-a"> Serie</a><select id="serieActual" name="serieActual" class="green-input select-serie-jugador-form" onchange="chequear_datos_form_fichajugador();">
					                </select>
					            </div>
				            </div>

				      		<div class="span6" style="margin: 0px; margin-bottom:20px;">
					            <div style="padding:0px; margin:0px;">
					          	    <a class="btn btn-md btn-primary green-a"> Lateralidad</a><select id="dinamico" name="dinamico" class="select-lateralidad-form green-input" onchange="chequear_datos_form_fichajugador();">
					                </select>
					            </div>
				            </div>				            
				        </div>
				     </div>						
						<!-- ========================================== Fin de campos a la derecha ========================================== -->

                        <div class="span12" style="margin: 0px; margin-top: 10px;">
                            <div class="span4" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Posición Principal</p></div></a><select id="posicion0" name="posicion0" class="select-posicion-jugador-form green-input " onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>
                            
                            <div class="span4" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Posición Adicional</p></div></a><select id="posicion1" name="posicion1" class="select-posicion-jugador-form select-posicion-jugador-form-adicional green-input " style="width:52.5%;" onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>

                            <div class="span4" style="margin: 0px; margin-bottom:20px; margin-left: 5px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Posición Adicional</p></div></a><select id="posicion2" name="posicion2" class="select-posicion-jugador-form select-posicion-jugador-form-adicional green-input " style="width:52.5%;" onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="span12" style="margin: 0px; margin-top: 10px;">
                            <div class="span4" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Seleccionado</p></div></a><select id="seleccionado" name="seleccionado" class="green-input " onchange="chequear_datos_form_fichajugador();">
                                    	<option value="">Seleccione</option>
                                    	<option value="1">Sí</option>
                                    	<option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>                        

					</div>
			</div>

			<div class="span12" style="margin-top: 10px; margin-left: 0;">
				<div class="tabbable"> <!-- Only required for left/right tabs -->
				  <ul class="nav nav-tabs">
				    <li class="active"><a href="#tab_form_fichajugador" data-toggle="tab">Datos</a></li>
				    <li><a href="#tab_form_partido" data-toggle="tab">Partidos</a></li>
				  </ul>
				  <div class="tab-content" style="overflow: visible;">
				   	
				   	<!-- ================================================= Inicio del id="tab_form_fichajugador" ================================================= -->
				    <div class="tab-pane active" id="tab_form_fichajugador">
				    
					  		<hr style="margin: auto; margin-top: 50px; margin-bottom: 20px; border-top: 2px solid #c8c5c5; border-bottom: 1px solid #fff; width: 97%;" />

							<div class="row-fluid cuadro_buscar_buscar" style="width: 98%;">
								
							<div class="row-fluid div-datos-partido">
								
								<div class="span4" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a"> 
										Estado
									</a>
									<select class="green-input select-estadoclub-jugador-form" id="estado_jugadorclub" name="estado_jugadorclub" onchange="campos_ficha_jugador();"></select>
								</div>
								<!-- ======================================================================== -->
								<div class="span4 campo-jugador-libre" style="display: flex;">
									<a class="btn btn-md btn-primary green-a"> 
										Último Club
									</a>
									<select class="green-input select-club" id="idclub_jugadorlibre" name="idclub_jugadorlibre" onchange="chequear_datos_form_fichajugador();"></select>
								</div> 

								<!-- ====================== Inicio de los campos class="campo-club-jugador-libre-otro" ====================== -->
								<div class="span4 campo-club-jugador-libre-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a"> País club (Último) </a>
									<!-- select-pais-form <- Esta clase agrega valores al select -->
									<select class="green-input select-pais-form" id="pais_club_jugadorlibre_otro" name="pais_club_jugadorlibre_otro" onchange="get_divisiones_from_pais( 0 );"></select>
								</div>

								<div class="span4 campo-club-jugador-libre-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a">División club (Último) </a>
									<select class="green-input select-division-form" id="division_club_jugadorlibre_otro" name="division_club_jugadorlibre_otro" onchange="chequear_datos_form_fichajugador();"></select>
								</div>

								<div class="span4 campo-club-jugador-libre-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a">Club (Último)</a>
									<input class="green-input" id="nombre_club_jugadorlibre_otro" name="nombre_club_jugadorlibre_otro" onkeyup="chequear_datos_form_fichajugador();"/>
								</div>	

								<div class="span4 campo-club-jugador-libre-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a">Entrenador (Último)</a>
									<input class="green-input" id="entrenador_club_jugadorlibre_otro" name="entrenador_club_jugadorlibre_otro" onkeyup="chequear_datos_form_fichajugador();"/>
								</div>																							
								<!-- ====================== Fin de los campos class="campo-club-jugador-libre-otro" ====================== -->	

								<!-- ======================================================================== -->
								<div class="span4 campo-jugador-en-club" style="display: flex;">
									<a class="btn btn-md btn-primary green-a"> 
										País club actual
									</a>
									<!-- select-pais-form <- Esta clase agrega valores al select -->
									<!-- <select class="green-input select-pais-form select-pais-dinamico" id="pais_club_actual" name="pais_club_actual" onchange="get_clubes_from_paisdivision();"></select> -->
									<select class="green-input select-pais-form select-pais-dinamico" id="pais_club_actual" name="pais_club_actual" onchange="get_divisiones_from_pais( 1 );"></select>
								</div> 
								<!-- ======================================================================== -->
								<div class="span4 campo-jugador-en-club" style="display: flex;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">División club actual</p></div></a>
									<!-- select-division-form <- Esta clase agrega valores al select -->
									<select class="green-input select-division-form select-division-dinamico" id="division_club_actual" name="division_club_actual" onchange="get_clubes_from_paisdivision();">
										<option value="">Seleccione primero un país</option>
									</select>
								</div> 							                           	

		                    	<!-- ************************************************************************************************************************ -->
								<div class="span4 campo-jugador-en-club" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a"> 
										Club actual
									</a>
									<select class="green-input select-idclub-dinamico" id="idclub_actual_jugadorenclub" name="idclub_actual_jugadorenclub" onchange="chequear_datos_form_fichajugador();"></select>
								</div>

								<!-- ====================== Inicio de los campos class="campo-club-jugadorenclub-otro" ====================== -->
								<div class="span4 campo-club-jugadorenclub-otro" style="display: flex;">
									<a class="btn btn-md btn-primary green-a"> País club </a>
									<!-- select-pais-form <- Esta clase agrega valores al select -->
									<select class="green-input select-pais-form" id="pais_club_jugadorenclub_otro" name="pais_club_jugadorenclub_otro" onchange="get_divisiones_from_pais( 2 );"></select>
								</div>

								<div class="span4 campo-club-jugadorenclub-otro" style="display: flex;">
									<a class="btn btn-md btn-primary green-a">División club </a>
									<select class="green-input select-division-form" id="division_club_jugadorenclub_otro" name="division_club_jugadorenclub_otro" onchange="chequear_datos_form_fichajugador();"></select>
								</div>

								<div class="span4 campo-club-jugadorenclub-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a">Club</a>
									<input class="green-input" id="nombre_clubenclub_jugadorenclub_otro" name="nombre_clubenclub_jugadorenclub_otro" onkeyup="chequear_datos_form_fichajugador();"/>
								</div>	

								<div class="span4 campo-club-jugadorenclub-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a">Entrenador</a>
									<input class="green-input" id="entrenador_club_jugadorenclub_otro" name="entrenador_club_jugadorenclub_otro" onkeyup="chequear_datos_form_fichajugador();"/>
								</div>																							
								<!-- ====================== Fin de los campos class="campo-club-jugadorenclub-otro" ====================== -->								
								<!-- ======================================================================== -->
								<div class="span4 campo-jugador-en-club" style="display: flex;">
									<a class="btn btn-md btn-primary green-a"><div><p class="ellipsis-text" style="font-weight: normal;">Contrato Profesional</p></div></a>
									<select class="green-input" id="contrato_pro_jugadorclub" name="contrato_pro_jugadorclub" onchange="chequear_datos_form_fichajugador();">
										<option value="">Seleccione</option>
										<option value="1">Sí</option>
										<option value="0">No</option>
									</select>
								</div> 
								<!-- ======================================================================== -->
								<div class="span4 campo-jugador-en-club" style="display: flex;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Situación en el club actual</p></div></a>
									<select class="green-input" id="situ_clubactual_jugadorclub" name="situ_clubactual_jugadorclub" onchange="campos_ficha_jugador();">
										<option value="">Seleccione</option>
										<option value="1">A préstamo</option>
										<option value="2">Pertenece al club</option>
									</select>
								</div> 							                           	

		                    	<!-- ************************************************************************************************************************ -->
								<div class="span4 campo-jugador-prestamo campo-jugador-en-club campo-situacion-club-actual" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Fecha fin préstamo</p></div></a>
									<input readonly class="green-input date-picker" id="fechafin_prestamo_jugadorclub" name="fechafin_prestamo_jugadorclub" onchange="chequear_datos_form_fichajugador();"/>
								</div>
								<!-- ======================================================================== -->
								<div class="span4 campo-jugador-prestamo campo-jugador-en-club campo-situacion-club-actual" style="display: flex;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Su pase pertenece a</p></div></a>
									<input class="green-input" id="pase_pertenencia_jugadorclub" name="pase_pertenencia_jugadorclub" onkeyup="chequear_datos_form_fichajugador();"/>
								</div> 
								<!-- ======================================================================== -->
								<div class="span4 campo-jugador-en-club campo-situacion-club-actual" style="display: flex;">
									<a class="btn btn-md btn-primary green-a"> 
										Fin contrato
									</a>
									<input readonly class="green-input date-picker" id="fechafin_contrato_jugadorclub" name="fechafin_contrato_jugadorclub" onchange="chequear_datos_form_fichajugador();"/>
								</div> 							                           	

		                    	<!-- ************************************************************************************************************************ -->
								<div class="span4 campo-jugador-en-club campo-situacion-club-actual" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Valor de mercado</p></div></a>
									<input class="green-input" id="valor_mercado_jugadorclub" name="valor_mercado_jugadorclub" onkeyup="chequear_datos_form_fichajugador();"/>
								</div>
								<!-- ======================================================================== -->
								<div class="span4 campo-jugador-en-club campo-situacion-club-actual" style="display: flex;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Cláusula de salida</p></div></a>
									<select class="green-input" id="clausula_salida_jugadorclub" name="clausula_salida_jugadorclub" onchange="campos_ficha_jugador();">
										<option value="0">Seleccione</option>
										<option value="1">Sí</option>
										<option value="2">No</option>
									</select>
								</div> 
								<!-- ======================================================================== -->
								<div class="span4 campo-jugador-en-club campo-situacion-club-actual" style="display: flex;">
									<a class="btn btn-md btn-primary green-a"> 
										Valor cláusula
									</a>
									<input class="green-input" id="valor_clausula_jugadorclub" name="valor_clausula_jugadorclub" onkeyup="chequear_datos_form_fichajugador();"/>
								</div> 

								<!-- ======================================================================== -->
								<div class="span4 campo-representante" style="display: flex;">
									<a class="btn btn-md btn-primary green-a"> 
										Representante
									</a>
									<input class="green-input" id="representante_jugadorclub" name="representante_jugadorclub" onkeyup="chequear_datos_form_fichajugador();"/>
								</div> 															                           	

								<!-- Salto de línea -->
								<div class="div-break"></div>

		                    	<!-- ************************************************************************************************************************ -->                   	
								<div class="span12" style="display: flex; margin-left: 2.5%;">
	                                <table style="width: 95.2%; margin-bottom: 15px;">
	                                    <thead>
	                                        <tr>
	                                            <th class="th-textarea">Observaciones</th>
	                                        </tr> 
	                                    </thead>
	                                    <tbody>
	                                        <tr>
	                                            <td style="width: 100%; padding: 0px;">
	                                                <div class="span12" style="display: flex; width: 100%;">
	                                                    <textarea onkeyup="chequear_datos_form_fichajugador();" style="resize: none;" class="textarea-social" name="observaciones_jugadorclub" id="observaciones_jugadorclub" rows="10"></textarea>
	                                                </div>
	                                            </td>                                                  
	                                        </tr>
	                                    </tbody>
	                                </table>     
								</div>
								
							</div>	


							</div>				                           	
                    	
                    	<!-- ************************************************************************************************************************ -->                    	                    	                    
			</form>        
			<!-- ========================================== Fin del id="formulario_ficha_jugador" ========================================== -->                   	
				    </div>
				    <!-- ================================================= Fin del id="tab_form_fichajugador" ================================================= -->

				    <!-- ================================================= Inicio del id="tab_form_partido" ================================================= -->
				    <div class="tab-pane" id="tab_form_partido">
				    	<!-- ================================================= Inicio del id="formulario_partido_jugador" ================================================= -->
				    	<form id="formulario_partido_jugador" style="display: none;">
							<div class="row-fluid div-datos-partido">

								<div class="span4" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a"> 
										Fecha Partido
									</a>
									<input readonly class="green-input date-picker" id="fecha_jugadorpartido" name="fecha_jugadorpartido" onchange="chequear_datos_form_partidojugador();" />
								</div>

								<div class="span4" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a"> 
										Campeonato
									</a>
									<select class="green-input select-campeonato" id="idcampeonato" name="idcampeonato" onchange="get_clubes_from_paiscampeonato();"></select>
								</div> 

								<!-- ====================== Inicio de los campos class="campo-campeonato-otro" ====================== -->
								<div class="span4 campo-campeonato-otro" style="display: flex;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">País campeonato</p></div></a>
									<!-- select-pais-form <- Esta clase agrega valores al select -->
									<select class="green-input select-pais-form" id="pais_campeonato_otro" name="pais_campeonato_otro" onchange="get_divisiones_from_pais( 8 );"></select>
								</div>

								<div class="span4 campo-campeonato-otro" style="display: flex;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">División campeonato</p></div></a>
									<select class="green-input select-division-form" id="division_campeonato_otro" name="division_campeonato_otro" onchange="chequear_datos_form_partidojugador();"></select>
								</div>

								<div class="span4 campo-campeonato-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Nombre campeonato</p></div></a>
									<input class="green-input" id="nombre_campeonato_otro" name="nombre_campeonato_otro" onkeyup="chequear_datos_form_partidojugador();" />
								</div>	

								<div class="span4 campo-campeonato-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Organizador campeonato</p></div></a>
									<input class="green-input" id="organizador_campeonato_otro" name="organizador_campeonato_otro" onkeyup="chequear_datos_form_partidojugador();" />
								</div>																							
								<!-- ====================== Fin de los campos class="campo-campeonato-otro" ====================== -->

								<div class="span4" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a"> 
										Temporada
									</a>
									<input class="green-input" id="temporada_jugadorpartido" name="temporada_jugadorpartido" onkeyup="chequear_datos_form_partidojugador();" />
								</div> 

								<div class="span4" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a"> 
										Jornada
									</a>
									<input class="green-input" id="jornada_jugadorpartido" name="jornada_jugadorpartido" onkeyup="chequear_datos_form_partidojugador();" />
								</div> 			

								<div class="span4" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a"> 
										*Rival
									</a>
									<!-- <select class="green-input select-club" id="idclub_rival" name="idclub_rival" onchange="chequear_datos_form_partidojugador();"></select> -->
									<select class="green-input" id="idclub_rival" name="idclub_rival" onchange="chequear_datos_form_partidojugador();">
										<option value="">Seleccione primero un campeonato</option>
										<option value="000">Otro</option>
									</select>
								</div>

								<!-- ====================== Inicio de los campos class="campo-club-rival-otro" ====================== -->
								<div class="span4 campo-club-rival-otro" style="display: flex;">
									<a class="btn btn-md btn-primary green-a"> País club rival</a>
									<!-- select-pais-form <- Esta clase agrega valores al select -->
									<select class="green-input select-pais-form" id="pais_club_rival_otro" name="pais_club_rival_otro" onchange="get_divisiones_from_pais( 3 );"></select>
								</div>

								<div class="span4 campo-club-rival-otro" style="display: flex;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">División club rival</p></div></a>
									<select class="green-input select-division-form" id="division_club_rival_otro" name="division_club_rival_otro" onchange="chequear_datos_form_partidojugador();"></select>
								</div>

								<div class="span4 campo-club-rival-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a">Club rival</a>
									<input class="green-input" id="nombre_club_rival_otro" name="nombre_club_rival_otro" onkeyup="chequear_datos_form_partidojugador();" />
								</div>	

								<div class="span4 campo-club-rival-otro" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Entrenador rival</p></div></a>
									<input class="green-input" id="entrenador_club_rival_otro" name="entrenador_club_rival_otro" onkeyup="chequear_datos_form_partidojugador();" />
								</div>																							
								<!-- ====================== Fin de los campos class="campo-club-rival-otro" ====================== -->

								<div class="span4" style="display: flex; margin-left: 2.5%;">
									<a class="btn btn-md btn-primary green-a"> 
										Posición
									</a>
									<select class="green-input select-posicion-jugador-form" id="posicion_jugadorpartido" name="posicion_jugadorpartido" onchange="chequear_datos_form_partidojugador();"></select>
								</div> 

								<div class="span4" style="display: flex;">
									<a class="btn btn-md btn-primary green-a"> 
										*Tit/Sup
									</a>
	                                <select class="green-input" id="tit_sup_nc_jugadorpartido" name="tit_sup_nc_jugadorpartido" onchange="chequear_datos_form_partidojugador();">
	                                    <option value="">Seleccione</option>
	                                    <option value="1">Titular</option>
	                                    <option value="2">Suplente</option>
	                                    <option value="3">No compite</option>
	                                </select>
								</div> 																																				
							</div>
					 	
	                    	<div style="width: 92%; margin: auto; margin-top: 90px; margin-bottom: 25px;">
	                    		<h4 style="text-align: center; color: black; text-transform: uppercase;">estadísticas</h4>
	                    	</div>

					        <!-- ================================================ Inicio del div para imagen e input para indicar la cantidad de goles - Tabla de estadísticas ================================================ -->
							<div class="row-fluid" style="width: 92%; margin: auto; margin-bottom: 50px;">
								
								<!-- ========================== Inicio del div para imagen e input para indicar la cantidad de goles ========================== -->
								<div class="span6" style="width: 40%; /*display: inline-block;*/">
									<center>
										<div style="margin-bottom: 20px;">
											<img id="foto_1_club_jugador_partido" src="../config/default.png" style="width: 30px;position: relative;right: 10px;">
											<input type="text" id="gol_equipo1_jugadorpartido" name="gol_equipo1_jugadorpartido" style="width: 20px;border: 1px solid <?php echo $color_fondo; ?>;" maxlength="2" onkeyup="chequear_datos_form_partidojugador();"> 
											<div style="font-size: 30px;position: relative;top: 5px;font-weight: bold;width: 40px;display: inline-block;">-</div>
											<input type="text" id="gol_equipo2_jugadorpartido" maxlength="2" name="gol_equipo2_jugadorpartido" style="width: 20px;border: 1px solid <?php echo $color_fondo; ?>;" onkeyup="chequear_datos_form_partidojugador();">
											<img id="foto_1_club_rival_partido" src="../config/default.png" style="width: 30px;position: relative;left: 10px;">										
										</div>
									</center>

									<div>
										<center>
											<div style="z-index: 100;position: relative;top: 60px;">
												<div style="position: relative; top: -10px;">
													<img id="foto_2_club_jugador_partido" src="../config/default.png" style="width: 60px; height: 60px;">
													<img src="../config/balon.png" style="width: 30px;">
													<img id="foto_2_club_rival_partido" src="../config/default.png" style="width: 60px; height: 60px;">												
												</div>
												<div style="background-color: <?php echo $color_fondo; ?>; width: 90%; border-radius: 5px; position: relative; top: 10px;">
													<div style="padding: 10px;">
														<input class="input-label-match" type="radio" id="condicion_local_jugadorpartido" name="condicion_jugadorpartido" value="1" onclick="chequear_datos_form_partidojugador();">
														<label class="input-label-match" for="male">Local</label>
														<input class="input-label-match" type="radio" id="condicion_visita_jugadorpartido" name="condicion_jugadorpartido" value="2" onclick="chequear_datos_form_partidojugador();">
														<label class="input-label-match" for="female">Visita</label>
														<input class="input-label-match" type="radio" id="condicion_neutral_jugadorpartido" name="condicion_jugadorpartido" value="3" onclick="chequear_datos_form_partidojugador();">
														<label class="input-label-match" for="other">Neutral</label>
													</div>										
												</div>									
											</div>
										</center>								

										<center>
											<div style="height: 100px;">
												<img src="../config/cancha-scouting.png" style="width: 100%;height: 250px;margin: 0;position: relative;top: -120px;">
											</div>
										</center>									
									</div>
								</div>
								<!-- ========================== Fin del div para imagen e input para indicar la cantidad de goles ========================== -->
								
								<!-- ========================== Inicio del div para tabla de estadísticas ========================== -->
								<div class="span6" style="width: 60%; margin: 0;">

									<table class="table-striped" style="width:100%; margin-bottom: 100px; margin: auto; border: 1px solid dimgray;" id="">
							     		<thead>
							                <tr style="background-color:#2e2c2c; color:white;height:30px;">
							                    <th scope="col" style="cursor:pointer; padding-top:5px; padding-bottom:5px; text-align: center; width: 350px;">
							                  		<div class="tip-top" data-original-title="Jugador" style="width:100%;">TITULARES</div>
							                 	</th>
							                  	<th scope="col" style="cursor:pointer; padding:0px;">
													<div class="tip-top" data-original-title="Tarjetas Amarillas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/yellow-card-hand.png"></center></div>						                  		
							                  	</th>
							                  	<th scope="col" style="cursor:pointer; padding:0px;">
													<div class="tip-top" data-original-title="Dobles Tarjetas Amarillas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/double-yellow-card.png"></center></div>	
							                  	</th>
							                  	<th scope="col" style="cursor:pointer; padding:0px;">
													<div class="tip-top" data-original-title="Tarjetas Rojas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/red-card-hand.png"></center></div>	
							                  	</th>						                  							                  	
							                  	<th scope="col" style="cursor:pointer; padding:0px; width: 80px;">
							                  		<div class="tip-top" data-original-title="Goles" style="width:100%;"><center><img src="../config/balon.png" style="width: 19px"></center></div>
							                  	</th>
							                  	<th scope="col" style="cursor:pointer; padding:0px;">
													<div class="tip-top" data-original-title="Minuto de entrada" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/green-arrow-facing-right.png" style="transform: rotate(90deg);"></center></div>
							                  	</th>
							                  	<th scope="col" style="cursor:pointer; padding:0px;">
													<div class="tip-top" data-original-title="Minuto de salida" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/red-arrow.png" style="    transform: rotate(270deg);"></center></div>
							                  	</th>
							                  	<th scope="col" style="cursor:pointer; padding:0px; width: 300px;">
													<div class="tip-top" data-original-title="Minutos jugados" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/min-jugados.png"></center></div>
							                  	</th>						                  							                  							                  	
							                </tr>
							            </thead>
							           <tbody>
							                <tr style="cursor: pointer;">
							                	
                                                <td style="width: 200px; max-width: 200px;">
                                                    <div class="div-club-table" style="text-align: left; max-width: 250px;">
                                                        <div class="img-next-to-text">
                                                            <img class="foto-jugador-partido" src="" style="width: 25px;border-radius: 50%;border: solid 2px;height:25px;display: block;margin: auto;">
                                                        </div>
                                                        <div style="float: right;width: 80%;">
                                                            <p class="ellipsis-text nombre-jugador-partido" style="text-transform: uppercase; font-weight: bold; color: black; margin: 0; text-align: left; position: relative; top: 5px;"></p>
                                                        </div>
                                                    </div>
                                                </td> 
							                	
							                	<td><center><input type="text" style="width: 25px;" id="t_amarilla_jugadorpartido" name="t_amarilla_jugadorpartido" maxlength="1" onkeyup="chequear_datos_form_partidojugador();"></center></td>

							                	<td><center><input type="text" style="width: 25px;" id="t_amarilladb_jugadorpartido" name="t_amarilladb_jugadorpartido" maxlength="1" onkeyup="chequear_datos_form_partidojugador();"></center></td>
							                	
							                	<td><center><input type="text" style="width: 25px;" id="t_roja_jugadorpartido" name="t_roja_jugadorpartido" maxlength="1" onkeyup="chequear_datos_form_partidojugador();"></center></td>
							                	
							                	<td><center><input type="text" style="width: 25px;" id="num_gol_jugadorpartido" name="num_gol_jugadorpartido" placeholder="nº" maxlength="2" onkeyup="chequear_datos_form_partidojugador();"></center></td>
							                	
							                	<td><center><input type="text" style="width: 25px; background-color: <?php echo $color_fondo; ?>;" id="min_entrada_jugadorpartido" name="min_entrada_jugadorpartido" placeholder="min" maxlength="3" onkeyup="calcular_minutos_jugados();"></center></td>
							                	
							                	<td><center><input type="text" style="width: 25px;" id="min_salida_jugadorpartido" name="min_salida_jugadorpartido" placeholder="min" maxlength="3" onkeyup="calcular_minutos_jugados();"></center></td>
							                	<td><center><b id="min_jugados_jugadorpartido_text" style="color: black; position: relative; top: -4px;">0 minutos</b><input type="hidden" style="width: 25px;" id="min_jugados_jugadorpartido" name="min_jugados_jugadorpartido" maxlength="3"></center></td>

							                </tr>
							          	</tbody>
							          	<tfoot>
							          		<tr><td colspan="9"></td></tr>
							          	</tfoot>
							        </table> 								
								</div>
								<!-- ========================== Fin del div para tabla de estadísticas ========================== -->

							</div>
							<!-- ================================================ Fin del div para imagen e input para indicar la cantidad de goles - Tabla de estadísticas ================================================ -->

							<button id="boton-agregar-partido" onclick="boton_guardar_partido();">guardar partido</button>

				    	</form>		
				    	<!-- ================================================= Fin del id="formulario_partido_jugador" ================================================= -->

							<div style="margin-bottom: 50px;">

								<div class="row-fluid" style="margin-top: 90px; width: 95%; margin: auto;">
						            <h4 style="color: black; text-transform: uppercase; text-align: center;margin: 0; font-size: 13px;">Análisis de partidos</h4>
						            <button style="margin-bottom:10px;margin-top: -20px;float:right;" class="boton_informe_jugador" onclick="boton_agregar_partido();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar partido</b></button>            
						        </div>								
								<!-- ================================================ Inicio del class="tabla_partidos_jugador" ================================================ -->

								<div class="row-fluid">
									<div class="span12">
								<table class="table-striped tabla_partidos_jugador" style="width:95%; margin-bottom: 100px; margin: auto; font-size: 10px;" vista-modal-partido='0'>
                                    <thead>
                                        <tr style="background-color:#555555; color:white;height:30px; ">                                        
                                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; border-right: 1px solid;">
                                                <div class="tip-top" data-original-title="Fecha" style="width: 60px;">FECHA</div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 120px;">
                                                <div class="tip-top" data-original-title="Club" style="width: 90px;">CLUB</div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid;">
                                                <div class="tip-top" data-original-title="Campeonato" style="width: 90px;">
                                                    CAMPEONATO
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid;">
                                                <div class="tip-top" data-original-title="Jornada" style="width:70px;">
                                                    JORNADA
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 65px;">
                                                <div class="tip-top" data-original-title="Condición" style="width:60px;">
                                                    COND
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 120px;">
                                                <div class="tip-top" data-original-title="Rival" style="width: 50px;">
                                                    RIVAL
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 100px;">
                                                <div class="tip-top" data-original-title="Resultado" style="width: 85px;">
                                                    RESULTADO
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid;">
                                                <div class="tip-top" data-original-title="Posición" style="width:100%;">
                                                    POS
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 80px;">
                                                <div class="tip-top" data-original-title="Titula/Suplente" style="/*width: 55px;*/width: 80px;">
                                                    TIT / SUP/ NC
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 40px;">
                                                <div class="tip-top" data-original-title="%." style="width: 40px;">
                                                    MIN
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
                                                <div class="tip-top" data-original-title="Minuto de entrada" style="width:30px;"><center style="margin: auto;display: block;width: 15px;"><img src="../config/green-arrow-facing-right.png"></center></div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
                                                <div class="tip-top" data-original-title="Goles" style="width:30px;"><center><img src="../config/balon.png" style="width: 15px;"></center></div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
                                                <div class="tip-top" data-original-title="Tarjeta Amarilla" style="width: 30px;"><div style="display:inline-block;" class="tarjetaAmarilla"></div></div>
                                            </th>                                       
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
                                                <div class="tip-top" data-original-title="Tarjeta Roja" style="width:30px;"><div style="display:inline-block;" class="tarjetaRoja"></div></div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;  border-top-right-radius:5px;" colspan="2"></th>
                                        </tr>
                                   </thead>
						           <tbody></tbody>
						          	<tfoot>
						          		<tr><td colspan="16" style="border-bottom: 1px solid"></td></tr>
						          	</tfoot>
						        </table>										
									</div>
								</div>

						        <!-- ================================================ Fin del class="tabla_partidos_jugador" ================================================ -->                    		
	                    	</div>
	                    	
				    </div>
				    <!-- ================================================= Fin del id="tab_form_partido" ================================================= -->

				  </div>
				</div>				
			</div>

			<div class="span12" style="margin-top: 20px;">
				<center>
                	<button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar_ficha_jugador();" id="boton_agregar_ficha_jugador">
                    	<i class="icon-save"></i> GUARDAR FICHA JUGADOR
                	</button>
               </center>     
			</div>	

		<center>
			<div class="row-fluid" style="margin-top:0px;">
				<div class="span12" style="margin: 0px;">
					<button class="boton_volver" onclick="bntvolver_desde_form_jugador();" style="float:left; margin:0px; margin-top: 20px;">
						<i class="icon-arrow-left"></i> volver
					</button>                      
				</div>			
			</div> 
		</center>

		</div>
	</div>      
</div>
<!-- ========================================== Fin del id="cuadro_form_agregar_jugador" ========================================== -->
  
<!-- ========================================== Inicio del id="cuadro_modulo_scouting_main" ========================================== -->     
<div id="cuadro_modulo_scouting_main" class="row-fluid" style="display: none; margin-top: 0px; color:black; font-family:Arial, Helvetica, sans-serif;"> 

	<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
	<div class="cuadro_buscar_titulo">
		<button class="boton_volver" onclick="boton_volver_cuadro_busqueda();" style="position: absolute; top: 50px;">
			<i class="icon-arrow-left"></i> volver
		</button>

		<center>
			<table style="color:black; font-family:Arial, Helvetica, sans-serif;margin-bottom: 10px">
				<tr class="sin_fondo">
					<td style="width: 150px; text-align: center;">
						<div style="padding:0px; margin:0px; width: 250px; margin-top: 25px;">
							<img src="../config/icon-search-inverted.png" style="width:75px; margin-top:5px;"> 
							<h3 style="margin-top: 0px; display: inline-block;">Centro de Scouting</h3>
						</div>
					</td>
				</tr>
			</table>
			<br>
		</center>

	</div>
	<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

	<div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px;">

		<div class="row-fluid" style="margin-top: 20px; /*margin-left: 5%;*/ width: 100%;">
			<!-- Aquí se insertarán los cuadros de las series -->
			<div style="width: 70%; margin: auto;">
				<div style="text-align: center;margin: 0px;width: 30%;padding: 10px; float: left;">
					<div class="serie-cantidad-jugadores">
						<i class="icon-male"></i> <span class="cantidad-jugadores-scouting" style="font-weight: bold;">(0)</span>
					</div>
					<div class="cuadro_scouting_jugador cuadro_serie" style="padding: 5px;" onclick="ir_scouting_jugadores();">
						<div style="clear: right">
							<img src="../config/cdp.png" style="width:100px; margin-top:5px;">
						</div>
						<h4 class="nombre-pais-inicio">JUGADORES</h4>
					</div>
				</div>
				<div style="text-align: center;margin: 0px;padding: 10px;width: 30%; float: right;">
					<div class="serie-cantidad-jugadores">
						<i class="icon-male"></i> <span class="cantidad-jugadores-scouting" style="font-weight: bold;">(0)</span>
					</div>
					<div class="cuadro_scouting_entrenador cuadro_serie" style="padding: 5px;">
						<div style="clear: right">
							<img src="../config/cdp.png" style="width:100px; margin-top:5px;">
						</div>
						<h4 class="nombre-pais-inicio">ENTRENADORES</h4>
					</div>
				</div>				
			</div>					
		</div>

	</div>

</div>
<!-- ========================================== Fin del id="cuadro_modulo_scouting_main" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_jugadores_seguimiento" ========================================== -->
<div style="display: none; margin: -41px -30px 0px -20px;" id="cuadro_jugadores_seguimiento">

	<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
	<div class="cuadro_buscar_titulo" style="background-image: url('./../config/banner_4.PNG'); background-size: cover; height: 177px; margin-top: -10px">
        
        <div class="row-fluid">
            <div style="padding:0px; margin:0px; margin-top: -20px;">

                <div>
                    <div>
                        <img src="./../config/carta-soccer.png" class="img-datos-jugador" style="width: 35px; top: 30px; left: 55px; height: 45px;">        
                    </div>
                    <div>
                        <h5 class="nombre-jugador" style="margin-top: 0px; color: white; padding: 0px 0px 0px 100px; font-size: 16px;     line-height: 7px;">Michael Jackson Johnson</h5>
                        <h5 class="datos-jugador" style="margin-top: 0px; color: white; padding: 0px 0px 0px 100px; font-size: 16px;">28 años, Arquero, Pie Izquierdo</h5>
                    </div>
                </div>

                <br>
                
                <img src="./../config/estatura-1.png" class="img-datos-jugador">
                <span class="datos-jugador-small">Estatura: <span class="estatura" style="font-weight: bold;"></span> </span>
                <br>
                
                <img src="./../config/birthday_1.png" class="img-datos-jugador">
                <span class="datos-jugador-small">Fecha de Nacimiento: <span class="edad-jugador">28</span></span>
                <br>
                
                <img src="./../config/soccer_shoes_1.png" class="img-datos-jugador">
                <span class="datos-jugador-small">Lateralidad: <span class="lateralidad" style="font-weight: bold;">Izquierdo</span> </span>

                <input type="hidden" name="" class="idfichaJugador_club" autocomplete="off" value="13">
            </div>            
        </div>
         
        <br/>
        
        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>	
	<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
	
	<hr/>

	<!-- ================= Inicio del class="fluid cuadro_buscar_buscar" ================= -->
	<div class="row-fluid cuadro_buscar_buscar" style="width: 93%; margin: auto; margin-top: -30px;">
		<button class="boton_volver" onclick="boton_volver_cuadro_scouting();" style="position: relative; top: 25px;">
			<i class="icon-arrow-left"></i> volver
		</button>		

		<center>
			<div style=" width:500px; margin-bottom:10px; display: inline-block;">
				<table border="0">
					<tbody>
						<tr class="sin_fondo">
							<td style="width:330px; padding-left:40px;"><input class="ph-center" name="buscar_nombre" style="width:96%; background-color:white; border: 3px solid #555555; border-radius:20px; margin-bottom:0px;padding-left: 10px; height: 24px;" placeholder="Nombre del Jugador o Vacío para Ver Todos" maxlength="149" id="buscar_nombre" onkeyup="buscador();" onkeydown="buscador();"></td>
							<td style="width:40px; cursor:pointer;"> <button class="boton_refresh" onclick="buscador()" style="margin-left: 10px; display: none;">
								<i class="icon-refresh"></i></button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</center>
									
		<center>
			<div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar" style="display: none;">
				<span style="color: rgb(220, 78, 78); display: none;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
			</div>
		</center>

		<div style="margin-top: -10px; margin-bottom: 40px;">
			<div class="span3" style="display: flex;">
				<a class="btn btn-md btn-primary gray-a" style="width: 50%;"> 
					País donde juega
				</a>
				<select class="gray-input" style="width: 40%;">
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
				</select>
			</div>
			<!-- ======================================================================== -->
			<div class="span3" style="display: flex;">
				<a class="btn btn-md btn-primary gray-a"> 
					División
				</a>
				<select class="gray-input">
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
				</select>
			</div>
			<!-- ======================================================================== -->
			<div class="span3" style="display: flex;">
				<a class="btn btn-md btn-primary gray-a"> 
						Club
				</a>
				<select class="gray-input">
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
				</select>
			</div>
			<!-- ======================================================================== -->
			<div class="span3" style="display: flex;">
				<a class="btn btn-md btn-primary gray-a"> 
						Nacionalidad
				</a>
				<select class="gray-input">
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
				</select>
			</div>
			<!-- ======================================================================== -->                                    
		</div>        

		<div>
			<div class="span3" style="display: flex;">
				<span class="span-input-range" style="width: 20%; color: black; font-weight: bold;">Año Nacimiento</span>
				<div class="multi-range" data-lbound="10" data-ubound="50">
					<hr>
					<input type="range" min="10" max="45" step="5" value="10" oninput="this.parentNode.dataset.lbound=this.value;">
					<input type="range" min="15" max="50" step="5" value="50" oninput="this.parentNode.dataset.ubound=this.value;">
				</div>
			</div>
			<!-- ======================================================================== -->
			<div class="span3" style="display: flex;">
				<a class="btn btn-md btn-primary gray-a"> 
					Lateralidad
				</a>
				<select class="gray-input">
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
				</select>
			</div>
			<!-- ======================================================================== -->                                    
		</div>                

		<div class="row-fluid" style="margin-top: 90px;">
			<h4 style="color: black; text-transform: uppercase; text-align: center;margin: 0;">jugadores en seguimiento</h4>
			<button style="margin-bottom:10px;margin-top: -20px;float:right;" class="boton_agregar_jugador" onclick="btn_ir_form_agregarjugador();"><b style="font-size:13px;"><i class="icon-plus"></i> AGREGAR JUGADOR</b></button>            
        </div>
							
			<!-- ================= Inicio del class="row-fluid" ================= -->
			<div class="row-fluid" style="margin-top:0px;">

			<!-- ================= Inicio del class="span12" ================= -->
			<div class="span12" style="margin: 0px;"> 
				<!-- ================= Inicio del id="tabla_informes_seguimiento_jugador" ================= -->  
				<table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_informes_seguimiento_jugador">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
	                        <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px; width: 80px;">
	                            <div class="tip-top" data-original-title="Número" style="width:100%;">#</div>
	                        </th>
	                        <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
	                            <div class="tip-top" data-original-title="Fecha" style=" cursor: pointer; padding: 0px; text-align: left;">
	                                FECHA
	                            </div>
	                        </th>
	                        <th scope="col" style="cursor:pointer; padding:0px; width: 30%;">
	                            <div class="tip-top" data-original-title="Nombre del Informe" style="width:100%;">NOMBRE INFOME</div>
	                        </th>
	                        <th scope="col" style="cursor:pointer; padding:0px;width: 113px;">
	                            <div class="tip-top" data-original-title="Realizado por" style="width:100%;">REALIZADO POR</div>
	                        </th>                                                
	                        <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
	                            <div class="tip-top" data-original-title="Tipo de Informe" style="width:100%;">TIPO INFORME</div>
	                        </th>
	                        <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
	                            <div class="tip-top" data-original-title="Observación" style="width:100%;">EDAD</div>
	                        </th>           
	                        <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:140px;" colspan="3"></th>
                       	</tr>
                    </thead>
                                        
                    <tbody>                
                       	<tr class="panel_buscar ">
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" style="font-weight:bold;">1</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" style="text-align: left;">
                       			<b>11-06-2019</b>                            
                       		</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" style="text-align: left;">
                       			<p class="ellipsis-text">Informe general del jugador</p>
                       		</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" class="td-valoracion">
                       			<p class="ellipsis-text">Jhon Valladares</p>
                       		</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" class="td-valoracion">
                       			<p class="ellipsis-text">De partido</p>
                       		</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" class="td-valoracion">
                       			<p class="ellipsis-text">Continuar seguimiento</p>
                       		</td>
							<td class="td-valoracion" style="padding: 7px; width: 9px;">
								<a class="boton_eliminar" onclick="descargarPDF(1, 'SUB-19', 'Carlos Ramírez');">
									<i class="icon-download-alt"></i>
								</a>                        
							</td>
							<td class="td-valoracion" style="padding: 7px; width: 9px;">
								<a class="boton_eliminar" onclick="boton_editar(0);">
									<i class="icon-pencil"></i>
								</a>                        
							</td>
							<td class="td-valoracion" style="padding: 7px; width: 9px;">
								<a class="boton_eliminar" onclick="boton_eliminar(0);">
									<i class="icon-remove"></i>
								</a>                        
							</td>														                  
                       	</tr>         
					</tbody>
                                        
                    <tfoot>            
						<tr style="background-color:#555555; color:white;">
                           	<th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
						</tr>
                    </tfoot>

                </table>
				<!-- ================= Fin del id="tabla_informes_seguimiento_jugador" ================= -->
			</div>
			<!-- ================= Fin del class="span12" ================= -->
		</div>
		<!-- ================= Fin del class="row-fluid" ================= -->
	</div>
	<!-- ================= Fin del class="fluid cuadro_buscar_buscar" ================= -->

</div>
<!-- ========================================== Fin del id="cuadro_jugadores_seguimiento" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_informes_seguimiento_jugador" ========================================== -->
<div style="margin: -41px -30px 0px -20px; display: none;" id="cuadro_informes_seguimiento_jugador">

	<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
	<div class="cuadro_buscar_titulo" style="background-image: url('./../config/banner_4.PNG'); background-size: cover; height: 177px; margin-top: -10px">
        
        <div class="row-fluid">
            <div style="padding:0px; margin:0px; margin-top: -20px;">

                <div>
                    <div>
                        <img src="./../config/carta-soccer.png" class="img-datos-jugador" style="width: 35px; top: 30px; left: 55px; height: 45px;">        
                    </div>
                    <div>
                        <h5 class="nombre-jugador" style="margin-top: 0px; color: white; padding: 0px 0px 0px 100px; font-size: 16px;     line-height: 7px;">Michael Jackson Johnson</h5>
                        <h5 class="datos-jugador" style="margin-top: 0px; color: white; padding: 0px 0px 0px 100px; font-size: 16px;">28 años, Arquero, Pie Izquierdo</h5>
                    </div>
                </div>

                <br>
                
                <img src="./../config/estatura-1.png" class="img-datos-jugador">
                <span class="datos-jugador-small">Estatura: <span class="estatura" style="font-weight: bold;"></span> </span>
                <br>
                
                <img src="./../config/birthday_1.png" class="img-datos-jugador">
                <span class="datos-jugador-small">Fecha de Nacimiento: <span class="edad-jugador">28</span></span>
                <br>
                
                <img src="./../config/soccer_shoes_1.png" class="img-datos-jugador">
                <span class="datos-jugador-small">Lateralidad: <span class="lateralidad" style="font-weight: bold;">Izquierdo</span> </span>

                <input type="hidden" name="" class="idfichaJugador_club" autocomplete="off" value="13">
            </div>            
        </div>
         
        <br/>
        
        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>	
	<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
	
	<!-- <hr/> -->

	<!-- ================= Inicio del class="fluid cuadro_buscar_buscar" ================= -->
	<div class="row-fluid cuadro_buscar_buscar" style="width: 93%; margin: auto; margin-top: -30px;">


		<div class="row-fluid" style="margin-bottom: 20px;">	
			<button class="boton_volver" onclick="boton_volver_cuadro_jugadores_seguimiento();" style="float: left;">
				<i class="icon-arrow-left"></i> volver
			</button>			
			<button style="float: right;" class="boton_agregar_jugador" onclick=""><b style="font-size:13px;"><i class="icon-plus"></i> AGREGAR INFORME</b></button>            
		</div>
									
		<center>
			<div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar" style="display: none;">
				<span style="color: rgb(220, 78, 78); display: none;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
			</div>
		</center>   
               		
			<!-- ================= Inicio del class="row-fluid" ================= -->
			<div class="row-fluid" style="margin-top:10px;">


			<!-- ================= Inicio del class="span12" ================= -->
			<div class="span12" style="margin: 0px;"> 
				<!-- ================= Inicio del id="tabla_centro_scouting" ================= -->  
				<table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_centro_scouting">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
	                        <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px; width: 80px;">
	                            <div class="tip-top" data-original-title="Número" style="width:100%;">#</div>
	                        </th>
	                        <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
	                            <div class="tip-top" data-original-title="Fecha" style=" cursor: pointer; padding: 0px; text-align: left;">
	                                FECHA
	                            </div>
	                        </th>
	                        <th scope="col" style="cursor:pointer; padding:0px; width: 30%;">
	                            <div class="tip-top" data-original-title="Nombre del Informe" style="width:100%;">NOMBRE INFOME</div>
	                        </th>
	                        <th scope="col" style="cursor:pointer; padding:0px;width: 113px;">
	                            <div class="tip-top" data-original-title="Realizado por" style="width:100%;">REALIZADO POR</div>
	                        </th>                                                
	                        <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
	                            <div class="tip-top" data-original-title="Tipo de Informe" style="width:100%;">TIPO INFORME</div>
	                        </th>
	                        <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
	                            <div class="tip-top" data-original-title="Observación" style="width:100%;">EDAD</div>
	                        </th>           
	                        <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:140px;" colspan="3"></th>
                       	</tr>
                    </thead>
                                        
                    <tbody>                
                       	<tr class="panel_buscar ">
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" style="font-weight:bold;">1</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" style="text-align: left;">
                       			<b>11-06-2019</b>                            
                       		</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" style="text-align: left;">
                       			<p class="ellipsis-text">Informe general del jugador</p>
                       		</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" class="td-valoracion">
                       			<p class="ellipsis-text">Jhon Valladares</p>
                       		</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" class="td-valoracion">
                       			<p class="ellipsis-text">De partido</p>
                       		</td>
                       		<td onclick="btnver_informes_seguimiento_jugador(0);" class="td-valoracion">
                       			<p class="ellipsis-text">Continuar seguimiento</p>
                       		</td>
							<td class="td-valoracion" style="padding: 7px; width: 9px;">
								<a class="boton_eliminar" onclick="descargarPDF(1, 'SUB-19', 'Carlos Ramírez');">
									<i class="icon-download-alt"></i>
								</a>                        
							</td>
							<td class="td-valoracion" style="padding: 7px; width: 9px;">
								<a class="boton_eliminar" onclick="boton_editar(0);">
									<i class="icon-pencil"></i>
								</a>                        
							</td>
							<td class="td-valoracion" style="padding: 7px; width: 9px;">
								<a class="boton_eliminar" onclick="boton_eliminar(0);">
									<i class="icon-remove"></i>
								</a>                        
							</td>														                  
                       	</tr>         
					</tbody>
                                        
                    <tfoot>            
						<tr style="background-color:#555555; color:white;">
                           	<th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px;"></th>
                           	<th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
						</tr>
                    </tfoot>

                </table>
				<!-- ================= Fin del tabla_centro_scouting ================= -->
			</div>
			<!-- ================= Fin del class="span12" ================= -->
		</div>
		<!-- ================= Fin del class="row-fluid" ================= -->
	</div>
	<!-- ================= Fin del class="fluid cuadro_buscar_buscar" ================= -->

</div>
<!-- ========================================== Fin del id="cuadro_informes_seguimiento_jugador" ========================================== -->

<!-- ========================================== Inicio del id="modal_formulario_ficha_jugador" ========================================== -->
<div id="modal_formulario_ficha_jugador" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
	 <center>
			<br>
			<div id="mensaje_agregar_ficha_jugador">
			  <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
			  </div>
			<br>
	 </center>
	</div>
	  <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
		  <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_ficha_jugador();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
		
	</div>
</div>    
<!-- ========================================== Fin del id="modal_formulario_ficha_jugador" ========================================== -->

<!-- ========================================== Inicio del id="modal_formulario_guardar_partido_jugador" ========================================== -->
<div id="modal_formulario_guardar_partido_jugador" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
	 <center>
			<br>
			<div id="mensaje_agregar_partido_jugador">
			  <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
			  </div>
			<br>
	 </center>
	</div>
	  <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
		  <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_partido_jugador();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
		
	</div>
</div>    
<!-- ========================================== Fin del id="modal_formulario_guardar_partido_jugador" ========================================== -->

<!-- ========================================== Inicio del id="modal_guardar_scouting" ========================================== -->
<div id="modal_guardar_scouting" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
	 <center>
			<br>
			<div id="mensaje_agregar_scouting">
			  <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
			  </div>
			<br>
	 </center>
	</div>
	  <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
		  <center><button type="button" onclick="boton_cerrar_confirm_scouting();" class="btn btn-default boton_modal" data-dismiss="modal" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_scouting();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
		
	</div>
</div>    
<!-- ========================================== Fin del id="modal_guardar_scouting" ========================================== -->

<!-- ========================================== Inicio del id="modal_scouting_ya_registrado" ========================================== -->
<div id="modal_scouting_ya_registrado" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
	 <center>
			<br>
			<div id="">
			  <h5>Disculpe, este jugador ya se encuentra en seguimiento</h5>
			  </div>
			<br>
	 </center>
	</div>
</div>    
<!-- ========================================== Fin del id="modal_scouting_ya_registrado" ========================================== -->

<!-- ************************************************ Modal del PDF ************************************************ -->
<div id="descargarPDF" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
	 <center>
			<br>
			<div id="mensaje_agregar_descargarPDF">
			  <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
			  </div>
			<br>
	 </center>
	</div>
	  <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">     
	</div>
</div>

<div id="myModalDescargarExcel" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body">
	 <center>
			<br>
			<div id="mensaje_agregar_DescargarExcel">
			  <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
			  </div>
			<br>
	 </center>
	</div>
	  <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
		  <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="boton_aceptar_excel();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
		
	</div>
</div>

<!-- ============================== Inicio del id="modal_eliminar_jugador" ============================== -->
<div id="modal_eliminar_jugador" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body">
	 <center>
			<br>
			<div id="mensaje_eliminar_jugador" style="color:black;">
			  <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
			  <br>
			  <img src="../config/ver_archivo_jugador.png">
			  </div>
		   
	 </center>
	</div>
	  <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
		  <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_jugador();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
		
	</div>
</div>
<!-- ============================== Fin del id="modal_eliminar_jugador" ============================== -->

<!-- ============================== Inicio del id="modal_eliminar_partido" ============================== -->
<div id="modal_eliminar_partido" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body">
	 <center>
			<br>
			<div id="mensaje_eliminar_partido" style="color:black;">
			  <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
			  <br>
			  <img src="../config/ver_archivo_jugador.png">
			  </div>
		   
	 </center>
	</div>
	  <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
		  <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_partido();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
		
	</div>
</div>
<!-- ============================== Fin del id="modal_eliminar_partido" ============================== -->

<!-- VIEW JUGADOR -->
<div id="modal-detalle-jugador" class="modal hide">
	<div class="modal-header" style="margin-left: 1px; /*background-color: white; border: white; border-top-right-radius: 5px; border-top-left-radius: 5px;height: 20px*/">

        <div class="row-fluid" style="margin-top:0px;">
            <div class="span12" style="margin: 0px;">
              	<div style="width:100%; height:20px;">
					<div style="margin: auto; width: 85px; height: 80px; box-sizing: border-box;" class="div-imagen-club-tabla">
						<img src="" class="foto-nacionalidad-jugador-modal">
						<img class="foto-jugador-modal">
					</div>			
					<h3 class="nombrecompleto-jugador-modal" style="text-align: center; color: white; text-shadow: none; font-size: 12px; text-transform: uppercase;">JUGADOR</h3>
					<p class="edadlateralidad-jugador-modal" style="font-weight: normal; text-align: center; color: white; text-shadow: none; font-size: 10px; text-transform: none; margin-top: -6px;"></p>
              	</div>
				<div style="float:right; margin-top: -15px;">   					
	              	<img src="../config/cuerpo_masculino.png" style="width:75px; height: 90px; margin-right: 5px;">
	              	<div style="display: inline-block;">
	              		<p style="margin: 0; color: white;">Altura</p>
	              		<p class="altura-header-modal" style="margin: 0; font-size: 20px; font-weight: bold; color: white;">187 cm</p>
	              	</div>
				</div>              
            </div>
        </div>  

	<!-- <button type="button" class="close" data-dismiss="modal" style="margin-top: -2px;color: #fff">&times;</button> -->	
	</div>

	<!-- ========================================================== Inicio del class="modal-body" ========================================================== -->
	<div class="modal-body">
		<div style="padding: 15px;">
			<p style="color: white; text-transform: uppercase; font-weight: bold; margin: 0;">datos personales</p>
			<div style="border-bottom: 1px solid white; height: 2px;"></div>
			<div style="margin-top: 10px; font-size: 11px;">
				<table class="tabla-modal-detalle-jugador">
					<tr>
						<th>Fecha de Nacimiento:</th>
						<td class="fecha-nac-modal"></td>
						<th>Estatura:</th>
						<td class="estatura-modal"></td>
						<th>Valor del pase:</th>
						<td class="valorpase-modal"></td>										
					</tr>	
					<tr>
						<th>Nacionalidad:</th>
						<td class="nacionalidad-modal"></td>
						<th>Pie hábil:</th>
						<td class="pie-habil-modal"></td>
						<th></th>
						<td></td>										
					</tr>	
					<tr>
						<th>Contrato Profesional:</th>
						<td class="contrato-profesional-modal"></td>
						<th>Club Actual:</th>
						<td class="club-actual-modal"></td>
						<th></th>
						<td></td>										
					</tr>
					<tr>
						<th>Fin contrato:</th>
						<td class="fin-contrato-modal">31/12/2019</td>
						<th >Representante:</th>
						<td class="representante-modal"></td>
						<th></th>
						<td></td>										
					</tr>															
				</table>
			</div>			
		</div>

		<div style="width: 60%; margin: auto;">
			<table class="blackt-jugador-modal tabla_partidos_jugador_modal_small">
				<thead>
					<tr>
						<th scope="col" style="border-top-left-radius:5px; width: 90px; text-align: left;">
							<div class="tip-top" data-original-title="Competición">Competición</div>
						</th>
						<th scope="col" style="cursor:pointer;text-align: center;width: 150px;padding-bottom: 5px;">
							<b class="tip-top" data-original-title="Partidos jugados" style="">PJ</b>
							<img style="height: 19px;display:inline-block;/* margin-left: 5px; */width: 25px;" class="" src="../config/cancha-scouting.png">
						</th>
						<th scope="col" style="cursor:pointer; text-align: center; width: 100px;">
							<div class="tip-top" data-original-title="Minutos jugados" style="width:100%;">
								Min
							</div>
						</th>
						<th scope="col" style="cursor:pointer;  width: 140px; text-align: center;">
							<div class="tip-top" data-original-title="Partidos como titular" style=" cursor: pointer; padding: 0px;">
								Titular
							</div>
						</th>
						<th scope="col" style="cursor:pointer; text-align: center; width: 50px;">
							<div class="tip-top" data-original-title="Partidos como suplente" style="width:100%;">
								Suplente
							</div>
						</th>
						<th scope="col" style="cursor:pointer; text-align: center; width: 100px;">
							<div class="tip-top" data-original-title="Partidos no competidos" style="width:100%;">
								NC
							</div>
						</th>
						<th scope="col" style="cursor:pointer; ;text-align: center; width: 100px;">
							<div class="tip-top" data-original-title="Tarjetas amarillas" style="width:100%;">
								<center><div style="display:inline-block;" class="tarjetaAmarilla"></div></center>
							</div>
						</th>
						<th scope="col" style="cursor:pointer; ;text-align: center; width: 100px;">
							<div class="tip-top" data-original-title="Tarjetas rojas" style="width:100%;">
								<center><div style="display:inline-block;" class="tarjetaRoja"></div></center>
							</div>
						</th>					
						<th scope="col" style="cursor:pointer;  border-top-right-radius:5px; width:100px;" colspan="1">
							<div class="tip-top" data-original-title="Goles convertidos" style="width:100%;">
								<center><img src="../config/balon.png" style="width: 19px"></center>
							</div>						
						</th>
					</tr>
				</thead>
				<tbody><!-- AQUÍ SE INSERTARÁN CON JS --></tbody>			
				<tfoot>
					<tr style="color:white;">
						<th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
						<th scope="col" style="cursor:pointer; padding:0px;"></th>
						<th scope="col" style="cursor:pointer; padding:0px;"></th>
						<th scope="col" style="cursor:pointer; padding:0px;"></th>
						<th scope="col" style="cursor:pointer; padding:0px;"></th>
						<th scope="col" style="cursor:pointer; padding:0px;"></th>
						<th scope="col" style="cursor:pointer; padding:0px;"></th>
						<th scope="col" style="cursor:pointer; padding:0px;"></th>
						<th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
					</tr>
				</tfoot>						
			</table>
		</div>

		<!-- ======================================================================== -->
		<div style="width: 100%; margin: auto; margin-top: 20px; margin-bottom: 20px;">
			<!-- ================================================ Inicio del class="tabla_partidos_jugador" ================================================ -->
			<table class="table-striped tabla_partidos_jugador t-partidos-modal" style="width:100%; margin-bottom: 100px; margin: auto; font-size: 9px;" vista-modal-partido='1'>
				<thead style="">
		            <tr style="background-color:#555555;color:white;/* height:30px; */line-height: 8px;">					          			
		                <th scope="col" style="border-top-left-radius:5px;padding-top:5px;padding-bottom:5px;border-right: 1px solid;width: 60px;">
		              		<div class="tip-top" data-original-title="Fecha" style="width:50px;">FECHA</div>
		             	</th>
		      			<th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 120px;">
		              		<div class="tip-top" data-original-title="Club" style="width:130px;">CLUB</div>
		              	</th>
		              	<th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 100px;">
		                  	<div class="tip-top" data-original-title="Campeonato" style="width:100%;">
		                  		CAMPEONATO
		                  	</div>
		              	</th>
		              	<th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 80px;">
		              		<div class="tip-top" data-original-title="Jornada" style="width:50px;">
		              			JORNADA
		              		</div>
		              	</th>
		                <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 65px;">
		              		<div class="tip-top" data-original-title="Condición" style="width:50px;">
		              			COND
		              		</div>
		              	</th>
		              	<th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 120px;">
		              		<div class="tip-top" data-original-title="Rival" style="width:100%;">
		              			RIVAL
		              		</div>
		              	</th>
		              	<th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 100px;">
		              		<div class="tip-top" data-original-title="Resultado" style="width:80px;">
		              			RESULTADO
		              		</div>
		              	</th>
		              	<th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid;">
		              		<div class="tip-top" data-original-title="Posición" style="width:100%;">
		              			POS
		              		</div>
		              	</th>
		              	<th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 90px;">
		              		<div class="tip-top" data-original-title="Titula/Suplente" style="width:70px;">
		              			TIT / SUP/ NC
		              		</div>
		              	</th>
		              	<th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 40px;">
		              		<div class="tip-top" data-original-title="%." style="width:25px;">
		              			MIN
		              		</div>
		              	</th>
						<th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
		              		<div class="tip-top" data-original-title="Minuto de entrada" style="width:20px;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/green-arrow-facing-right.png" style="height: 15px"></center></div>
		              	</th>
		              	<th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
		              		<div class="tip-top" data-original-title="Goles" style="width:20px;"><center><img src="../config/balon.png" style="height: 15px"></center></div>
		              	</th>
		              	<th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
		              		<div class="tip-top" data-original-title="Tarjeta Amarilla" style="width:20px;"><center style=""><div style="height: 14px;display:inline-block;width: 10px;" class="tarjetaAmarilla"></div></center></div>
		              	</th>					                  	
		              	<th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
		              		<div class="tip-top" data-original-title="Tarjeta Roja" style="width:20px;"><div style="width: 10px;display:inline-block;height: 15px;" class="tarjetaRoja"></div></div>
		              	</th>
						<th scope="col" style="cursor:pointer;  border-top-right-radius:5px;" colspan="2"></th>
		            </tr>
		       </thead>
		       <tbody></tbody>
		      	<tfoot>
		      		<tr><td colspan="16" style="border-bottom: 1px solid"></td></tr>
		      	</tfoot>
		    </table>
		    <!-- ================================================ Fin del class="tabla_partidos_jugador" ================================================ -->                    			
		</div>

		<button style="display: none;" id="boton-agregar-scouting" onclick="boton_guardar_scouting();">agregar a scouting</button>
		<h4 style="color: white; display: none; text-align: center;" id="mensaje_jugador_ya_registrado_scouting">Este jugador ya ha sido agregado al Centro de Scouting</h4>

	</div>
	<!-- ========================================================== Fin del class="modal-body" ========================================================== -->



</div>
<!-- FIN VIEW JUGADOR -->


<div id="myModal1" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body">
	 <center>
			<br>
			<div id="mensaje_agregar_proveedor" style="color:black;">
			  <h5>¿Estás seguro que quieres agregar este Proveedor?</h5>
			  </div>
			<br>
	 </center>
	</div>
	  <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
		  <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="guardar_ficha_jugador();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
		
	</div>
</div>
	  
	  
<div id="myModalComentario" class="modal hide" style="border-radius:10px;">
	<div class="modal-header" style="background-color: #28AEB7; border-top-right-radius: 5px; border-top-left-radius: 5px;">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
	</div>
	<div class="modal-body">
	 <center>
			<br>
			<div id="mensaje_agregar_comentario">
			  <h5>¿Estás seguro que quieres agregar este comentario?</h5>
			  </div>
			<br>
	 </center>
	</div>
	  <div class="modal-footer" style="background-color:#28AEB7; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
		  <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;" ng-click="activarBoton()"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="enviar_comentario();" ng-click="desactivarBoton()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
		
	</div>
</div>
	

<!-- ========================================================== Inicio del id="uploadImageModalJugador" ========================================================== -->
<div id="uploadImageModalJugador" class="modal hide" role="dialog" style="border-radius:10px;">
    <div class="modal-header" style="background-color:<?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:white; font-family:Arial, Helvetica, sans-serif; background-color:black;">
     <center>
	    <div class="imagen_subir_jugador" id="image_demo_jugador" style="width:350px; margin-top:10px;"></div>		
  		<div class="texto_subir_jugador" style="margin-top:10px;"></div>	
		<!--<button class="btn btn-success crop_image">USAR ESTA IMAGEN</button>-->		
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center>
          <button type="button" id="crop_image_jugador" class="btn btn-default boton_modal" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> USAR ESTA IMAGEN</button></center>
    </div>
</div>
<!-- ========================================================== Fin del id="uploadImageModalJugador" ========================================================== -->

	  
  </div>
  
  <?php }?>
</div>
</div>





</div>
<!--end-main-container-part-->
<!--Footer-part-->
<div class="row-fluid" style="color: white;">
	<div id="footer" class="span12"> &copy; <?php echo date("Y"); ?> | <?php echo $abreviacion_dominio;?>&#x2122;. Todos los derechos reservados.</div>
</div>
<!--end-Footer-part-->
</body>
</html>

<?php 
	}
?>


<script>

// Agregando placeholer a todos los inputs de tipo fecha:
$('.date-picker').each(function(){
	let thisElement = $(this);
	thisElement.attr('placeholder', 'Click aquí');
});


// -------------------- Inicio de la función 'ocultar_datos_fichaJugador()' -------------------- //
function ocultar_datos_fichaJugador() {
	// $(".datos_fichaJugador").hide();
	$("#boton_agregar_ficha_jugador").hide();	
}
// -------------------- Fin de la función 'ocultar_datos_fichaJugador()' -------------------- //

// -------------------- Inicio de la función 'mostrar_datos_fichaJugador()' -------------------- //
function mostrar_datos_fichaJugador() {
	// $(".datos_fichaJugador").show();
	$("#boton_agregar_ficha_jugador").show();	
}
// -------------------- Fin de la función 'mostrar_datos_fichaJugador()' -------------------- //


$('a[href="#tab_form_fichajugador"]').click(function(){
	mostrar_datos_fichaJugador();
});

$('a[href="#tab_form_partido"]').click(function(){
	ocultar_datos_fichaJugador();
});


// -------------------- Inicio de la función 'cambiar_color_contenedor()' -------------------- //
function cambiar_color_contenedor() {
	$("#content").css("background-color" , "#eeeeee");	
}
// -------------------- Fin de la función 'cambiar_color_contenedor()' -------------------- //

// ---------- OCULTANDO POR DEFECTO LOS SIGUIENTES CAMPOS ---------- //
$('.campo-club-jugador-libre-otro').hide();
$('.campo-club-jugadorenclub-otro').hide();
$('.campo-campeonato-otro').hide();
$('.campo-club-rival-otro').hide();

// ---------- Mostrando los campos para agregar nuevo club según sea el caso (Jugador Libre) ---------- //:
$('#idclub_jugadorlibre').change(function(){
	let thisValue = $(this).val(); 
	if( thisValue == "000" ) {
		$('.campo-club-jugador-libre-otro').show();								
	} else {
		$('.campo-club-jugador-libre-otro').hide();
	}
	chequear_datos_form_fichajugador(); // <--- Validando el formulario de la ficha del jugador.
});

// ---------- Mostrando los campos para agregar nuevo club según sea el caso (Jugador en club) ---------- //
$('#idclub_actual_jugadorenclub').change(function(){
	let thisValue = $(this).val(); 
	if( thisValue == "000" ) {
		$('.campo-club-jugadorenclub-otro').show();
		$('#pais_club_actual').parent().hide();
		$('#division_club_actual').parent().hide();

		// Seleccionando por defecto el país 

	} else {
		$('.campo-club-jugadorenclub-otro').hide();
		$('#pais_club_actual').parent().show();
		$('#division_club_actual').parent().show();
	}
	chequear_datos_form_fichajugador(); // <--- Validando el formulario de la ficha del jugador.
});

// ---------- Mostrando los campos para agregar nuevo campeonato según sea el caso ---------- //
$('#idcampeonato').change(function(){
	let thisValue = $(this).val(); 
	if( thisValue == "000" ) {
		$('.campo-campeonato-otro').show();
		$("#idclub_rival").append('<option value="">Seleccione</option>'); // <--- Importante.
		$("#idclub_rival").append('<option value="000">Otro</option>'); // <--- Importante.
	} else {
		$('.campo-campeonato-otro').hide();
	}
	// chequear_datos_form_partidojugador(); // <--- Validando el formulario de partidos del jugador.
});

// ---------- Mostrando los campos para agregar nuevo club según sea el caso (Rival) ---------- //
$('#idclub_rival').change(function(){
	let thisValue = $(this).val(); 
	if( thisValue == "000" ) {
		$('.campo-club-rival-otro').show();
	} else {
		$('.campo-club-rival-otro').hide();
	}
	// chequear_datos_form_partidojugador(); // <--- Validando el formulario de partidos del jugador.
});
			
// --------------- Inicio de la función 'get_divisiones_from_pais()' --------------- //
function get_divisiones_from_pais( form ) {
	
	var pais_club;
	var division_club;

	switch( form ) {

        case 0: // <---- Ficha Jugador - Jugador libre 
            pais_club = $('#pais_club_jugadorlibre_otro');
            division_club = $('#division_club_jugadorlibre_otro');
            break;

		case 1: // <---- Ficha Jugador - Jugador en club
			pais_club = $('#pais_club_actual');
			division_club = $('#division_club_actual');
			break;

		case 2: // <---- Ficha Jugador (Otro club) - Jugador en club
			pais_club = $('#pais_club_jugadorenclub_otro');
			division_club = $('#division_club_jugadorenclub_otro');
			break;			

		case 3: // <---- Partido Jugador
			pais_club = $('#pais_club_rival_otro');
			division_club = $('#division_club_rival_otro');
			break;

        // --------------- Campeonatos --------------- //           
        case 8: // <---- Partidos de jugador
            pais_club = $('#pais_campeonato_otro');
            division_club = $('#division_campeonato_otro');
            break;  

        // --------------- Filtro para pozo común --------------- //           
        case 9:
            pais_club = $('#paisclub-jugador-pzcomun');
            division_club = $('#divisionclub-jugador-pzcomun');
            break;  

        // --------------- Filtro para vista de clubes de otros países --------------- //           
        case 10:
            pais_club = $('#idpais_otros_filtro');
            division_club = $('#division_idpais_otros_filtro');
            break;                          

	}
	pais_club = pais_club.val();
	division_club.empty(); // <--- Vaciando select.          
						
	let divisiones_pais_selected = array_divisiones[pais_club];
	// console.log( divisiones_pais_selected );
	if( typeof divisiones_pais_selected !== 'undefined' ) {

		// console.log( divisiones_pais_selected );
		// --------------------- Agregando los valores del array del estado del club de jugadores --------------------- //
		// FILTRO DE BÚSQUEDA:
		divisiones_pais_selected = divisiones_pais_selected.filter(function(){return true;}); // Reiniciando el valor de los índices de 0 a n.
		division_club.append('<option value="">Seleccione</option>');
		for (var i = 0; i < divisiones_pais_selected.length; i++) {
		    division_club.append('<option value="'+divisiones_pais_selected[i][0]+'">'+divisiones_pais_selected[i][1]+'</option>');
		} 

	} else {
		division_club.append('<option value="">No se encontraron divisiones según el país seleccionado</option>');
	}

    // Validando según el formulario del select:
    switch( form ) {

        case 0: // <---- Ficha Jugador - Jugador libre 
            /*
            pais_club = $('#pais_club_jugadorlibre_otro');
            division_club = $('#division_club_jugadorlibre_otro');
            */
            chequear_datos_form_fichajugador();
            break;    	

        case 1: // <---- Ficha Jugador - Jugador en club
            /* 
            pais_club = $('#pais_club_actual');
            division_club = $('#division_club_actual');
            */
            chequear_datos_form_fichajugador();
            break;

        case 2: // <---- Ficha Jugador - Jugador en club - Otro
            /*
            pais_club = $('#pais_club_jugadorenclub_otro');
            division_club = $('#division_club_jugadorenclub_otro');
            */
            chequear_datos_form_fichajugador();
            break;            

        case 3: // <---- Partido Jugador
            /*
            pais_club = $('#pais_club_rival_otro');
            division_club = $('#division_club_rival_otro');
            */
            chequear_datos_form_partidojugador();
            break;                    

        // --------------- Campeonatos --------------- //           
        case 8: // <---- Partidos de jugador
            /*
            pais_club = $('#pais_campeonato_otro');
            division_club = $('#division_campeonato_otro');
            */
            chequear_datos_form_partidojugador();
            break;  

        // --------------- Filtro para pozo común --------------- //           
        case 9:
        	/*
            pais_club = $('#paisclub-jugador-pzcomun');
            division_club = $('#divisionclub-jugador-pzcomun');
            */
            buscar_jugadores_pozo_comun( 2 );
            break;        

        // --------------- Filtro para pozo común --------------- //           
        case 10:
        	/*
            pais_club = $('#idpais_otros_filtro');
            division_club = $('#division_idpais_otros_filtro');
            */
            buscar_club_pais();
            break;                             

    }

}
// --------------- Fin de la función 'get_divisiones_from_pais()' --------------- //

// ----------- CONSULTANDO CLUBES CUANDO SE SELECCIONA OTRO CAMPEONATO --------------------- //

// ------------ Partidos de Jugador ------------ //
$('#division_campeonato_otro').change(function(){
    // Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': $('#pais_campeonato_otro').val(),
            'division_club': $('#division_campeonato_otro').val() 
        },
        success: function(respuesta)  {
            $('#idclub_rival').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_rival").append('<option value="">Seleccione primero una división</option>');
            } else {                            
                $("#idclub_rival").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_rival").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $("#idclub_rival").append('<option value="000">Otro</option>');
            } 
        
        },
        error: function(){// will fire when timeout is reached
            $('#idclub_rival').empty(); // <--- Vaciando select.
            console.log('Error al consulta clubes para el select de club actual del jugador');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
});

// --------------- Inicio de la función 'get_clubes_from_paisdivision_pozocomun()' --------------- //
function get_clubes_from_paisdivision_pozocomun() {
	
	var pais_club = $('#paisclub-jugador-pzcomun').val();
	var division_club = $('#divisionclub-jugador-pzcomun').val();
	$("#club-jugador-pzcomun").empty();

	// Inhabilitando el select de club dinámico:
	// $('#club-jugador-pzcomun').prop("disabled", true).css('background-color', '#cfcccc');

	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
			'pais_club': pais_club,
			'division_club': division_club 
		},
		success: function(respuesta)  {
			$('#club-jugador-pzcomun').empty(); // <--- Vaciando select.
			if( respuesta== "" ) { //jugador sin informes
				console.log("No se encontró ningún club según el país y división seleccionada...");
				$("#club-jugador-pzcomun").append('<option value="">No se encontraron clubes</option>');
			} else {              
								
                $("#club-jugador-pzcomun").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#club-jugador-pzcomun").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
			} 
		
		},
		error: function(){// will fire when timeout is reached
			console.log('Error al consultar clubes para el select de clubes del jugador');
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

	buscar_jugadores_pozo_comun( 2 );
}
// --------------- Fin de la función 'get_clubes_from_paisdivision_pozocomun()' --------------- //

// --------------- Inicio de la función 'get_clubes_from_paisdivision()' --------------- //
function get_clubes_from_paisdivision() {
	
	var pais_club = $('.select-pais-dinamico').val();
	var division_club = $('.select-division-dinamico').val();
	$(".select-idclub-dinamico").empty();

	// Inhabilitando el select de club dinámico:
	// $('.select-idclub-dinamico').prop("disabled", true).css('background-color', '#cfcccc');

	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
			'pais_club': pais_club,
			'division_club': division_club 
		},
		success: function(respuesta)  {
			$('.select-idclub-dinamico').empty(); // <--- Vaciando select.
			if( respuesta== "" ) { //jugador sin informes
				console.log("No se encontró ningún club según el país y división seleccionada...");
				$(".select-idclub-dinamico").append('<option value="">No se encontraron clubes</option>');
				$(".select-idclub-dinamico").append('<option value="000">Otro</option>');
			} else {              
								
                $(".select-idclub-dinamico").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $(".select-idclub-dinamico").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $(".select-idclub-dinamico").append('<option value="000">Otro</option>');
			} 
		
		},
		error: function(){// will fire when timeout is reached
			console.log('Error al consultar clubes para el select de clubes del jugador');
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

	chequear_datos_form_fichajugador();
}
// --------------- Fin de la función 'get_clubes_from_paisdivision()' --------------- //

// --------------- Inicio de la función 'get_clubes_from_paiscampeonato()' --------------- //
function get_clubes_from_paiscampeonato() {

	var idcampeonato = $('#idcampeonato').val();
	var pais_campeonato = $('#idcampeonato option:selected').attr('pais-campeonato');

	// Seleccionando el país del campeonato:
	// $('#pais_club_rival_otro').prop('disabled', true);
	$('#pais_club_rival_otro option').each(function(){
		let thisElement = $(this);
		let thisValue = thisElement.val();
		if( thisValue == pais_campeonato ) {
			thisElement.prop('selected', true)
		}
	});

	get_divisiones_from_pais( 3 ); // Consultando las divisiones según el país.

	if( idcampeonato == '' ) {
		$("#idclub_rival").empty();
		$("#idclub_rival").append('<option value="">Seleccione primero un campeonato</option>');
	} else {

		$("#idclub_rival").empty();

		// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
		$.ajax({
			url: "post/scouting_busqueda_ver.php",
			type: "post",
			dataType: 'json',
			cache: false,
			data: {
				'tipo_consulta': 'get_clubes_from_paiscampeonato', // <---- Consultando clubes según el país del campeonato seleccionado.
				'pais_campeonato': pais_campeonato
			},
			success: function(respuesta)  {
				$('#idclub_rival').empty(); // <--- Vaciando select.
				if( respuesta== "" ) { //jugador sin informes
					console.log("No se encontró ningún club según el país del campeonato seleccionado...");
					$("#idclub_rival").append('<option value="">No se encontraron clubes</option>');
					$("#idclub_rival").append('<option value="000">Otro</option>');
				} else {              
									
	                $("#idclub_rival").append('<option value="">Seleccione</option>');
	                for(var i=0; i < respuesta.length; i++) {   
	                    $("#idclub_rival").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
	                }
	                $("#idclub_rival").append('<option value="000">Otro</option>');
				} 
			
			},
			error: function(){// will fire when timeout is reached
				console.log('Error al consultar clubes para el select de clubes del rival');
			}, timeout: 15000 // sets timeout to 3 seconds
		});	
		// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

	}


	chequear_datos_form_partidojugador(); // <--- Ejecutando validación.
}
// --------------- Fin de la función 'get_clubes_from_paiscampeonato()' --------------- //
 
// ------------------------ Inicio de la función que carga foto en la etiqueta <img> del jugador ------------------------ //
function readURL(input) {
	chequear_datos_form_fichajugador();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          	$('#foto-jugador')
            	.attr('src', e.target.result)
            	.width(140)
            	.height(140);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
// ------------------------ Fin de la función que carga foto en la etiqueta <img> del jugador ------------------------ //

// ------------------------ Inicio de la función 'campos_ficha_jugador()' ------------------------ //
function campos_ficha_jugador() {

	let estado_jugador = $('#estado_jugadorclub').val();
	switch( estado_jugador ) {
		case '1': // <----- JUGADOR LIBRE

			// Representante:
			$('.campo-representante').show(); // <---- Siempre será mostrado menos cuando no se seleccionada nada.

			$('.campo-jugador-en-club').hide();
			$('.campo-jugador-prestamo').hide(); // <--- También desaparece.			
			$('.campo-club-jugadorenclub-otro').hide();
			$('.campo-club-jugador-libre-otro').hide();
			$('.campo-jugador-libre').show(); // <--- Mostrar
			
			// Ejecutando sin que se desencadene un evento:
			let idclub_jugadorlibre = $('#idclub_jugadorlibre').val(); 
			if( idclub_jugadorlibre == "000" ) {
				$('.campo-club-jugador-libre-otro').show();								
			} else {
				$('.campo-club-jugador-libre-otro').hide();
			}

			// Evento onchange:
			$('#idclub_jugadorlibre').change(function(){
				let thisValue = $(this).val(); 
				if( thisValue == "000" ) {
					$('.campo-club-jugador-libre-otro').show();								
				} else {
					$('.campo-club-jugador-libre-otro').hide();
				}
			});

			break;
		case '2': // <----- EN CLUB

			// Representante:
			$('.campo-representante').show(); // <---- Siempre será mostrado menos cuando no se seleccionada nada.
			$('.campo-jugador-en-club').show();			

			// Estas funciones que muestra u ocultan los campos del club (si uno ya registrdo en la BD o nuevo/otro) debe ser ejecutada después ya que justo antes de este comentario se ejecuta la siguiente función: $('.campo-jugador-en-club').show();

			$('.campo-club-jugadorenclub-otro').hide(); // <--- Esconder
			// alert('Aquí se esconde 1');

			// Ejecutando sin que se desencadene un evento:
			let idclub_actual_jugadorenclub = $('#idclub_actual_jugadorenclub').val(); 
			if( idclub_actual_jugadorenclub == "000" ) {
				$('.campo-club-jugadorenclub-otro').show();
				$('#pais_club_actual').parent().hide();
				$('#division_club_actual').parent().hide();	
				// alert('Aquí se muestra 1');							
			} else {
				$('.campo-club-jugadorenclub-otro').hide();
				$('#pais_club_actual').parent().show();
				$('#division_club_actual').parent().show();
				// alert('Aquí se esconde 2');
			}

			// Evento onchange:
			$('#idclub_actual_jugadorenclub').change(function(){
				let thisValue = $(this).val(); 
				if( thisValue == "000" ) {
					$('.campo-club-jugadorenclub-otro').show();
					$('#pais_club_actual').parent().hide();
					$('#division_club_actual').parent().hide();	
					// alert('Aquí se muestra 2');									
				} else {
					$('.campo-club-jugadorenclub-otro').hide();
					$('#pais_club_actual').parent().show();
					$('#division_club_actual').parent().show();
					// alert('Aquí se esconde 3');
				}
			});			

			$('.campo-jugador-libre').hide(); // <--- Esconder
			$('.campo-club-jugador-libre-otro').hide(); // <--- Esconder
			

			let situacion = $('#situ_clubactual_jugadorclub').val();
			switch( situacion ) {
				case '1': // <----- A PRÉSTAMO
					$('.campo-jugador-prestamo').show();						
					break;
				case '2': // <----- PERTENECE AL CLUB
					$('.campo-jugador-prestamo').hide();			
					break;		
				default:
					$('.campo-situacion-club-actual').hide();
					//$('.campo-jugador-prestamo').show();
					break;
			}	

			// Cláusula de salida:
			let clausula_salida_jugadorclub = $("#clausula_salida_jugadorclub").val();	
				switch( clausula_salida_jugadorclub ) {
					case '0': // <---- NO
						$("#valor_clausula_jugadorclub").parent().hide();
						break;
					case '1': // <---- SÍ
						$("#valor_clausula_jugadorclub").parent().show();
						break;
					default:
						$("#valor_clausula_jugadorclub").parent().hide();
						break;							
			}	

			break;		
		default:
			// Escondemos todos los campos:
			$('.campo-representante').hide();
			$('.campo-jugador-en-club').hide();
			$('.campo-jugador-libre').hide(); // <--- Esconder
			$('.campo-club-jugadorenclub-otro').hide();
			break;
	}
	chequear_datos_form_fichajugador(); // <--- Validando el formulario de la ficha del jugador.
}
// ------------------------ Fin de la función 'campos_ficha_jugador()' ------------------------ //

// campos_ficha_jugador();

	// ---------------------------- Calculando la edad del jugador ---------------------------- //
	function calcularEdad( fecha_nacimiento_param ) {

		var date = new Date();
		var anioActual = date.getFullYear();

		var date_actual_str = date.toString();
						
		var anio_actual = date_actual_str.substring(11, 15); 
		var mes_actual_str = date_actual_str.substring(4, 7);
		var dia_actual = date_actual_str.substring(8, 10);

		var anio_actual_int = parseInt( anio_actual ); 
		var mes_actual_int = parseInt( mes_actual_str );
		var dia_actual = parseInt( dia_actual );
					
		var fecha_nacimiento = fecha_nacimiento_param;

		// Día de Nacimiento:
		var dia_nacimiento = fecha_nacimiento.substring(8, 10);
		dia_nacimiento = parseInt( dia_nacimiento ); 

		// Mes de Nacimiento:
		var mes_nacimiento = fecha_nacimiento.substring(5, 7);
		mes_nacimiento = parseInt( mes_nacimiento );     

		// Año de Nacimiento:
		var anio_nacimiento = fecha_nacimiento.substring(0, 4);
		anio_nacimiento = parseInt( anio_nacimiento ); 


		// Calculando edad:
		var edad = anio_actual_int - anio_nacimiento;

		if( mes_actual_int < mes_nacimiento ) {
				edad--;
		}

		if( mes_actual_int > mes_nacimiento ) {
			edad;
		}    

		if( mes_actual_int === mes_nacimiento ) {
			// Comparamos los días:
			if( dia_actual >= dia_nacimiento ) {
				edad;
			} else {
				edad--;
			}
		}

		return edad;

	}

	// ---------------------------- Cambiando formato de fecha a DD-MMM-AAAA ---------------------------- //
	function fecha_formato_ddmmaaa( fecha ) {
        // Día:
        var dia = fecha.substring(8, 10); 
        // Mes:
        var mes = fecha.substring(5, 7);     
        // Año:
        var anio = fecha.substring(0, 4); 
        // Resultado:
        return fecha = dia + "-" + mes + "-" + anio;
	}

	// ----------- Agregando los cuadros de las series ------------- //
	
	let array_cuadros = [

		// Países:
		[1, 1, 'cl', null, 'CHILE', dir_img_system + 'chile.png'],
		[1, 1, 'ar', null, 'ARGENTINA', dir_img_system + 'argentina.png'],
		[1, 1, 've', null, 'VENEZUELA', dir_img_system + 'venezuela.png'],
		[1, 1, 'br', null, 'BRASIL', dir_img_system + 'brasil.png'],
		[1, 1, 'co', null, 'COLOMBIA', dir_img_system + 'colombia.png'],
		[1, 1, 'ec', null, 'ECUADOR', dir_img_system + 'ecuador.png'],
		[1, 1, 'uy', null, 'URUGUAY', dir_img_system + 'uruguay.png'],
		[1, 1, 'pe', null, 'PERÚ', dir_img_system + 'peru.png'],
		[1, 1, 'py', null, 'PARAGUAY', dir_img_system + 'paraguay.png'],
		[1, 1, 'mx', null, 'MÉXICO', dir_img_system + 'mexico.png'],

		[2, 2, 'otros', null, "OTROS", dir_img_system + 'globe_flags_earth.png'],
		[3, null, null, 1, "JUGADORES", dir_img_system + 'silueta_jugador.png'],
		// [3, null, null, 2, "ENTRENADORES", 'silueta_jugador.png'],

	];

	for( let i = 0; i < array_cuadros.length; i++ ) {

		// Tipo de cuadro (Países o Jugadores/Entrenadores): 
		let tipo_cuadro = array_cuadros[i][0];
		// Tipo de  País (los que aparecen en los cuadros principales o los de la sección 'OTROS'):
		let tipo_pais = array_cuadros[i][1];
		// Número del País:
		let pais_club = array_cuadros[i][2];
		// Jugador/Entrenador:
		let jugador_entrenador = array_cuadros[i][3];
		// Nombre del Tipo de Cuadro:
		let nombre_tipo_cuadro = array_cuadros[i][4];		
		// Foto del Cuadro:
		let foto_cuadro = array_cuadros[i][5];

		let class_cuadro_serie = "cuadro_serie";

		// Si la imagen es de uno de los países principales, se le agregará la clase de bordes blancos:
		let class_white_border = '';
		let margin_top_cuadro = '';
		if( tipo_pais === 1 ) {
			class_white_border = 'white-bordered-img'
		} else {
			margin_top_cuadro = 'margin-top: -2px;';
			class_white_border = 'regular-main-img'
		}

		let cuadro_paises = 
		'<div class="span3" style="text-align: center; margin: 0px; padding: 10px;">\
			<div class="serie-cantidad-jugadores">\
				<i class="icon-male"></i> <span class="cantidad-jugadores" style="font-weight: bold;">(0)</span>\
			</div>\
			<div tipo-cuadro="'+tipo_cuadro+'" tipo-pais="'+tipo_pais+'" id-pais="'+pais_club+'" jugador-entrenador="'+jugador_entrenador+'" nombre-tipo-cuadro="'+nombre_tipo_cuadro+'" foto-cuadro="'+foto_cuadro+'" class="cuadro_serie" style="padding: 15px; '+margin_top_cuadro+' ">\
				<div style="clear: right">\
					<div class="div-cuadro-principal"><img class="img-cuadro-principal '+class_white_border+'" src="'+foto_cuadro+'"></div>\
				</div>\
				<div class="nombre_seleccion"><h4 class="nombre-pais-inicio">'+nombre_tipo_cuadro+'</h4>\</div>\
			</div>\
		</div>\
		';

		$("#selecciones_cajas").append( cuadro_paises );

	}

	// -------------------- Inicio de la función 'get_cantidad_registros_main()' -------------------- // 
	function get_cantidad_registros_main() {

		// Arrays que serán enviandos al controlador:

		// Tipo de cuadro (Países o Jugadores/Entrenadores): 
		let array_tipo_cuadro = [];
		// Tipo de  País (los que aparecen en los cuadros principales o los de la sección 'OTROS'):
		let array_tipo_pais = [];
		// Número del País:
		let array_pais_club = [];
		// Jugador/Entrenador:
		let array_jugador_entrenador = [];
		// Nombre del Tipo de Cuadro:
		let array_nombre_tipo_cuadro = [];		
		// Foto del Cuadro:
		let array_foto_cuadro = [];

		$(".cuadro_serie").each(function(i){

			let tipo_cuadro = $(this).attr("tipo-cuadro");
			let tipo_pais = $(this).attr("tipo-pais");
			let pais_club = $(this).attr("id-pais");
			let jugador_entrenador = $(this).attr("jugador-entrenador");

			array_tipo_cuadro[i] = tipo_cuadro;
			array_tipo_pais[i] = tipo_pais;
			array_pais_club[i] = pais_club;
			array_jugador_entrenador[i] = jugador_entrenador;

		});

		$.ajax({
			url: "post/scouting_busqueda_ver.php",
			type: "post",
			dataType: 'json',
			cache: false,
			data: {
				'tipo_consulta': 0,    
				'array_tipo_cuadro': array_tipo_cuadro,
				'array_tipo_pais': array_tipo_pais,
				'array_pais_club': array_pais_club,
				'array_jugador_entrenador': array_jugador_entrenador
			},success: function(respuesta){
				var count = 1;
				var x = [];
				for(var i=0; i < respuesta.length; i++) {   
					x[i] = respuesta[i];
				}

				$(".cantidad-jugadores").each(function(i){
					$(this).html( '(' + x[i] + ')' );
				});         
				
			},error: function(){// will fire when timeout is reached
				$('#cargando_buscar').hide();
				$('#sin_resultados').hide();
				$('#error_conexion').show();
				$('#boton_editar').hide();
				$('.boton_refresh').show();
			}, timeout: 15000 // sets timeout to 3 seconds
		});
	}
	// -------------------- Fin de la función 'get_cantidad_registros_main()' -------------------- //
	get_cantidad_registros_main(); // <---- Llamando a la función.

// -------------------- Inicio de la función 'boton_mostrar_modal_descarga()' -------------------- //
function boton_mostrar_modal_descarga() {
	$('#modal-detalle-jugador').modal('show');
}
// -------------------- Fin de la función 'boton_mostrar_modal_descarga()' -------------------- //

// --------------- Inicio de la función 'ver_jugadores_club_selected()' --------------- //
function ver_jugadores_club_selected( query ) {

	$('#error_conexion_buscar_jugadores_club_selected').hide();
	$('#sin_resultados_jugadores_club_selected').hide();
	$('#cargando_buscar_jugadores_club_selected').show();
	$("#tabla_cuadro_jugadores_club_selected tbody").empty(); // <--- Vaciando tabla.	

	let data;
	let idclub = $('.input-id-club-filtro').val();
	if( query === 1 ) {

		data = {
			'tipo_consulta': 'edad_minmax_jugadores_club', // <---- Consultando jugadores del club seleccionado.
			'idclub': idclub, 
		};

	} else {

		let range_anio_nac_1 = $('#range_anio_nac_1').val();
		let range_anio_nac_2 = $('#range_anio_nac_2').val();
		let posicion_jugador = $('.select-posicion-jugador-filtro-busqueda').val();
		let nacionalidad_jugador = $('.select-pais-filtro-busqueda').val();

		data = {
			'tipo_consulta': 2, // <---- Consultando jugadores del club seleccionado.
			'idclub': idclub,
			'posicion_jugador': posicion_jugador,
			'nacionalidad_jugador': nacionalidad_jugador,
			'range_anio_nac_1': range_anio_nac_1,
			'range_anio_nac_2': range_anio_nac_2,  
		};

	}
	
	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: data,
		success: function(respuesta)  {

			if(respuesta== ""){ //jugador sin informes
				$("#tabla_cuadro_jugadores_club_selected tbody").empty();
				var markup = '<tr class="panel_buscar" id="informe_"><td colspan="9"><b>No se encontraron jugadores según el club seleccionado</b></td></tr>';
				$("#tabla_cuadro_jugadores_club_selected tbody").append(markup);
				$('#cargando_buscar_jugadores_club_selected').hide();
				$('#sin_resultados_jugadores_club_selected').show();
				$('#boton_refresh_jugadores_club_selected').hide();
			}else{              
				window.datos_jugador_club = respuesta; //se copian todos los profesores al cache
				$("#tabla_cuadro_jugadores_club_selected tbody").empty();
   		
				if( query === 1 ) {

					let min_anio = respuesta[0]['min_anio'];
					let max_anio = respuesta[0]['max_anio'];

					console.log( 'Año mínimo: ' + min_anio );
					console.log( 'Año máximo: ' + max_anio );

					$('.multi-range').attr('data-lbound', min_anio);
					$('.multi-range').attr('data-ubound', max_anio);
					
					$('#range_anio_nac_1').attr('min', min_anio);
					$('#range_anio_nac_1').attr('max', max_anio);
					$('#range_anio_nac_1').attr('value', min_anio);

					$('#range_anio_nac_2').attr('min', min_anio);
					$('#range_anio_nac_2').attr('max', max_anio);
					$('#range_anio_nac_2').attr('value', max_anio);

				}

				var count = 1;
				for(var i=0; i < respuesta.length; i++){

					// Datos del Club:
					let idclub = parseInt( respuesta[i]['idclub'] );
					let division_club = parseInt( respuesta[i]['division_club'] );
					let nombre_club = respuesta[i]['nombre_club'];                              
					let entrenador_club = respuesta[i]['entrenador_club'];

					let foto_club = './foto_clubes/'+idclub+'.png?lala='+new Date()+'';

					let cantidad_total_jugadores = respuesta[i]['cantidad_total_jugadores'];
					let media_edad = respuesta[i]['media_edad'];

					// Datos del Jugador:
					let idfichaJugador_club = parseInt( respuesta[i]['idfichaJugador_club'] );				    
				    if( respuesta[i]['apellido2'] == null ) {
				        respuesta[i]['apellido2'] = "";
				    } 

					let nombre_completo_jugador = respuesta[i]['nombre'] + " " + respuesta[i]['apellido1'] + " " + respuesta[i]['apellido2'];

					let fechaNacimiento;
					if( respuesta[i]['fechaNacimiento'] == '0000-00-00' || respuesta[i]['fechaNacimiento'] == '' || respuesta[i]['fechaNacimiento'] === null ) {
						fechaNacimiento = 'No especificado';
					} else {
						fechaNacimiento = fecha_formato_ddmmaaa( respuesta[i]['fechaNacimiento'] );
					}
					
					let edad;
					if( respuesta[i]['fechaNacimiento'] == '0000-00-00' || respuesta[i]['fechaNacimiento'] == '' || respuesta[i]['fechaNacimiento'] === null ) {
						edad = 'No especificado';
					} else {
						edad = calcularEdad( respuesta[i]['fechaNacimiento'] ) + ' años';
					}

					let codigoNacionalidad1 = respuesta[i]['codigoNacionalidad1'];
					let nacionalidad2 = respuesta[i]['nacionalidad2'];
					let dinamico = respuesta[i]['dinamico'];
					let posicion = respuesta[i]['posicion'];
					
					let idfichaJugador = respuesta[i]['idfichaJugador'];
					let foto_jugador = './foto_jugadores_scouting/'+idfichaJugador+'.png?lala='+new Date()+'';

					let fechafin_contrato_jugadorclub = respuesta[i]['fechafin_contrato_jugadorclub'];
					if( respuesta[i]['fechafin_contrato_jugadorclub'] === null || respuesta[i]['fechafin_contrato_jugadorclub'] == '' || respuesta[i]['fechafin_contrato_jugadorclub'] == '0000-00-00' ) {
						fechafin_contrato_jugadorclub = "No tiene";
					} else {
						fechafin_contrato_jugadorclub = respuesta[i]['fechafin_contrato_jugadorclub'];
					}

					let nombre_posicion;
					if( posicion === null || posicion == '' || posicion == '0' || posicion == '999' ) {
						nombre_posicion = 'No especificado';
					} else {
						nombre_posicion = array_posiciones[posicion][1];
					}

                    let bandera_nacionalidad;
                    if( codigoNacionalidad1 === null || codigoNacionalidad1 == '' || codigoNacionalidad1 == '0' ) {
                        bandera_nacionalidad = 'src="img/default.png" class="img-nacionalidad-small"';
                    } else {
                        bandera_nacionalidad = 'src="flags/blank.gif" class="flag flag-'+respuesta[i]['codigoNacionalidad1'].toLowerCase()+'"';
                    }

					let pie_habil;
					if( dinamico === null || dinamico == '' || dinamico == '0' ) {
						pie_habil = 'No especificado';
					} else {
						pie_habil = array_lateralidad[dinamico][1];
					}					

					var markup = 
					'<tr class="panel_buscar">\
						<td onclick="boton_ver_jugador_modal('+i+');" style="font-weight:bold;">\
							<div class="div-imagen-club-tabla-2"><img class="imagen-club-tabla" src="'+foto_jugador+'"></div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');" style="text-align: left; max-width: 170px; width: 170px;">\
							<p class="ellipsis-text" style="text-transform: capitalize;">'+nombre_completo_jugador+'</p>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');" class="td-valoracion">\
							<img '+bandera_nacionalidad+'>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');" style="text-align: left;">\
							<div style="max-width:140px;"><p class="ellipsis-text">'+nombre_posicion+'</p></div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');" class="td-valoracion">\
							<div style="max-width: 90px;"><p class="ellipsis-text">'+fechaNacimiento+'</p></div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');" class="td-valoracion">\
							<div style="max-width: 90px;"><p class="ellipsis-text">'+edad+'</p></div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');" class="td-valoracion">\
							<div style="max-width: 90px;"><p class="ellipsis-text">'+pie_habil+'</p></div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');" class="td-valoracion" style="text-align: center;">\
							<p class="ellipsis-text">'+fechafin_contrato_jugadorclub+'</p>\
						</td>\
                        <td style="padding: 7px; width: 9px;">\
                            <a class="boton_editar" onClick="boton_editar_form_jugador('+i+');">\
                                <i class="icon-pencil"></i>\
                            </a>\
                        </td>\
                        <td style="padding: 7px; width: 9px;">\
                            <a class="boton_eliminar" onClick="boton_eliminar_jugador('+i+');">\
                                <i class="icon-remove"></i>\
                            </a>\
                        </td>\
					</tr>';

					$("#tabla_cuadro_jugadores_club_selected tbody").append(markup);

					count = count + 1;
				}

				$('#boton_refresh_jugadores_club_selected').hide();
			}

			$('#cargando_buscar_jugadores_club_selected').hide();
			$('#error_conexion_buscar_jugadores_club_selected').hide();
			$('#sin_resultados_jugadores_club_selected').hide();
		
		},
		error: function(){// will fire when timeout is reached
			$('#cargando_buscar_jugadores_club_selected').hide();
			$('#sin_resultados_jugadores_club_selected').hide();
			$('#error_conexion_buscar_jugadores_club_selected').show();
			$('#boton_refresh_jugadores_club_selected').show();
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //	
}
// --------------- Fin de la función 'ver_jugadores_club_selected()' --------------- //


// --------------- Evento 'onclick' para guardar el ID del club selccionado en un input --------------- // 
$(document).on('click', '.tr-club', function(){
	$('#club_pais_selected').hide(500);
	$('#cuadro_jugadores_club_selected').show(500);
	
	var idclub = $(this).attr('tr-id-club');
	var pais_club = $(this).attr('tr-pais-club');
	var division_club = $(this).attr('tr-division-club');
	var nombre_club = $(this).attr('tr-nombre-club');
	var foto_club = $(this).attr('tr-foto-club');

	$('.input-id-club-filtro').val( idclub );
	$('.input-pais-club-filtro').val( pais_club );
	$('.input-division-club-filtro').val( division_club );

	$('.nombre-club-selected').html( nombre_club );
	$('.foto-club-selected').attr( "src", foto_club );
	cambiar_color_contenedor(); // <----- Cambiando el color del contenedor.
	ver_jugadores_club_selected( 1 );

	// Reseteando valores:
	$('#range_anio_nac_1').val(0);
	$('#range_anio_nac_2').val(5000);
	$('.select-posicion-jugador-filtro-busqueda').prop('selectedIndex',0);;
	$('.select-pais-filtro-busqueda').prop('selectedIndex',0);	


});
// --------------- Evento 'onclick' para guardar el ID del club selccionado en un input --------------- //

// ------------------------------ Inicio de la función 'get_cantidad_registros_scouting()' ------------------------------ //
function get_cantidad_registros_scouting() {
	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'get_cantidad_registros_scouting', // <---- Consultando jugadores del club seleccionado.
			'idfichaJugador_club': window.idfichaJugador_club,
		},
		success: function(respuesta)  {
			if(respuesta== ""){
				console.log('No se encontraron registros...'); 
			}else{            
				let cantidad_registros_scouting = parseInt( respuesta[0]['COUNT(cscouting_jugador.idcscouting_jugador)'] );
				if( cantidad_registros_scouting === 0 ) {
					$('#mensaje_jugador_ya_registrado_scouting').hide();					
					$('#boton-agregar-scouting').show();
				} else {
					$('#boton-agregar-scouting').hide();
					$('#mensaje_jugador_ya_registrado_scouting').show();					
				}
			}
		},
		error: function(){// will fire when timeout is reached
			console.log('Ha ocurrido un error en la petición AJAX...'); 
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //	
}
// ------------------------------ Fin de la función 'get_cantidad_registros_scouting()' ------------------------------ //

// -------------------------- Inicio de la función 'boton_ver_jugador_modal()' - AGREGAR (INSERT) --------------------------- //
function boton_ver_jugador_modal( linea ){
	window.idfichaJugador_club = datos_jugador_club[linea]['idfichaJugador_club'];

	// alert( datos_jugador_club[linea]['idfichaJugador_club'] );

	// alert( datos_jugador_club[linea]['foto_jugador'] );
	let foto_jugador = 'foto_jugadores_scouting/' + datos_jugador_club[linea]['idfichaJugador'] + '.png?lala='+new Date()+'';

	// Foto del jugador:
	$(".foto-jugador-modal").attr("src", foto_jugador );
	
	if( datos_jugador_club[linea]['apellido2'] === null ) {
		datos_jugador_club[linea]['apellido2'] = "";
	} 

	// Nombre Completo:
	$(".nombrecompleto-jugador-modal").html( datos_jugador_club[linea]['nombre'] + " " + datos_jugador_club[linea]['apellido1'] + " " + datos_jugador_club[linea]['apellido2'] );    

	// Edad:
	let edad;
	// Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
	if( datos_jugador_club[linea]['fechaNacimiento'] === null || datos_jugador_club[linea]['fechaNacimiento'] == '0000-00-00' || datos_jugador_club[linea]['fechaNacimiento'] == '' ) {
		edad = '0 años (no especificado), ';
	} else {
		edad = calcularEdad( datos_jugador_club[linea]['fechaNacimiento'] ) + ' Años, ';
	}

	// Posición:
	let posicion;
	// Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
	if( datos_jugador_club[linea]['posicion0'] === null || datos_jugador_club[linea]['posicion0'] == '0' || datos_jugador_club[linea]['posicion0'] == '' || datos_jugador_club[linea]['posicion0'] == '999' ) {
		posicion = 'No especificado';
	} else {
		posicion = parseInt( datos_jugador_club[linea]['posicion0'] );
		posicion = array_posiciones[posicion][1];
	}
	$(".edadlateralidad-jugador-modal").html( edad + posicion );


	// Altura (Header):
	let altura;
	// Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
	if( datos_jugador_club[linea]['altura'] === null || datos_jugador_club[linea]['altura'] == '0' || datos_jugador_club[linea]['altura'] == '' ) {
		altura = '0 cm (no especificado)';
	} else {
		altura = datos_jugador_club[linea]['altura'] + ' cm';
	}	
	$(".altura-header-modal").html( altura );

	// Fecha de Nacimiento:
	$(".fecha-nac-modal").html( fecha_formato_ddmmaaa( datos_jugador_club[linea]['fechaNacimiento'] ) );

	// Altura:
	$(".estatura-modal").html( altura );

	// Valor del pase:
	let valor_mercado_jugadorclub = datos_jugador_club[linea]['valor_mercado_jugadorclub'];
	if( valor_mercado_jugadorclub === null || valor_mercado_jugadorclub == '' ) {
		valor_mercado_jugadorclub = 'No posee';
	} else {
		valor_mercado_jugadorclub = valor_mercado_jugadorclub;
	}	
	$(".valorpase-modal").html( valor_mercado_jugadorclub );

	// Nacionalidad:
	let nacionalidad;
	// alert( datos_jugador_club[linea]['codigoNacionalidad1'] );

    // Vaciando los atributos 'src' y 'class':   
    $('.foto-nacionalidad-jugador-modal').attr( 'src', '' );
    $('.foto-nacionalidad-jugador-modal').attr( 'class', 'foto-nacionalidad-jugador-modal' );

	// Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
	if( datos_jugador_club[linea]['codigoNacionalidad1'] === null || datos_jugador_club[linea]['codigoNacionalidad1'] == '0' || datos_jugador_club[linea]['codigoNacionalidad1'] == '' ) {
		nacionalidad = 'No especificado';

		$('.foto-nacionalidad-jugador-modal').attr( 'class',  'foto-nacionalidad-jugador-modal' );
		$('.foto-nacionalidad-jugador-modal').attr( "src", '../config/default.png' ).css({
			'width': '16px',
			'height': '11px'
		});


	} else {
		nacionalidad = paises_nacionalidad[ datos_jugador_club[linea]['codigoNacionalidad1'] ];		
		$('.foto-nacionalidad-jugador-modal').attr( "src", 'flags/blank.gif' ).addClass('flag flag-'+datos_jugador_club[linea]['codigoNacionalidad1'].toLowerCase()+''); // <--- Bandera		
	}
	
	$(".nacionalidad-modal").html( nacionalidad ); // <--- Gentilicio		
	

	// Pie Hábil:
	let dinamico;
	// Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
	if( datos_jugador_club[linea]['dinamico'] === null || datos_jugador_club[linea]['dinamico'] == '0' || datos_jugador_club[linea]['dinamico'] == '' ) {
		dinamico = 'No especificado';
	} else {
		dinamico = parseInt( datos_jugador_club[linea]['dinamico'] );
		dinamico = array_lateralidad[dinamico][1];
	}
	$(".pie-habil-modal").html( dinamico );	


	// Contrato Profesional:
	let contrato_pro_jugadorclub = parseInt( datos_jugador_club[linea]['contrato_pro_jugadorclub'] );
	if( contrato_pro_jugadorclub === 1 ) { // <---- Sí
		contrato_pro_jugadorclub = 'Sí';
	} else { // <---- No
		contrato_pro_jugadorclub = 'No tiene';
	}
	$(".contrato-profesional-modal").html( contrato_pro_jugadorclub );	

	// Club Actual (O anterior):
	let nombre_club = datos_jugador_club[linea]['nombre_club'];
	// Determinando si pertenece actualmente a un club o on:
	// Estado del jugador (	1 = 'Jugador Libre'; 2 = 'En club'; ):
	let estado_jugadorclub = parseInt( datos_jugador_club[linea]['estado_jugadorclub'] );
	if( estado_jugadorclub ===  1 ) {
		nombre_club = nombre_club + ' (club anterior)';
	} else {
		nombre_club = nombre_club;
	}
	$(".club-actual-modal").html( nombre_club );

	// Fin del Contrato:
	let fechafin_contrato_jugadorclub = datos_jugador_club[linea]['fechafin_contrato_jugadorclub'];
	if( fechafin_contrato_jugadorclub === null ) {
		fechafin_contrato_jugadorclub = 'No tiene';
	} else {
		fechafin_contrato_jugadorclub = fecha_formato_ddmmaaa( fechafin_contrato_jugadorclub );
	}
	$(".fin-contrato-modal").html( fechafin_contrato_jugadorclub );

	// Representante:
	let representante_jugadorclub = datos_jugador_club[linea]['representante_jugadorclub'];
	if( representante_jugadorclub === null || representante_jugadorclub == '' ) {
		representante_jugadorclub = 'No tiene';
	} 	
	$(".representante-modal").html( representante_jugadorclub );

	$('#modal-detalle-jugador').modal('show');

	$('.modal-backdrop').css({
		"position":"fixed",
		"top":"0",
		"right":"0",
		"bottom":"0",
		"left":"0",
		"z-index":"1040",
		"background-color":"transparent",

	});

	/*
	$('#jugadores_pozo_comun').hide(500);
	$('#cuadro_perfil_jugador_selected').show(500);
	*/

	buscar_partidos_jugador(); // <---- Consultando los partidos del jugador
	buscar_partidos_jugador_porcampeonato(); // <---- Consultando los partidos por campeonato del jugador
	get_cantidad_registros_scouting();

}

// -------------------------- Inicio de la función 'btn_ir_form_agregarjugador()' - AGREGAR (INSERT) --------------------------- //
function btn_ir_form_agregarjugador() {

	window.idfichaJugador = ''; // DEBEN ESTAR VACÍOS PARA EJECUTAR EL INSERT
	window.idfichaJugador_club = ''; // DEBEN ESTAR VACÍOS PARA EJECUTAR EL INSERT

	// Mostrando por defecto la pestaña 'Datos':
	$('a[href="#tab_form_fichajugador"]').parent().attr('class', 'active');
	$('#tab_form_fichajugador').attr('class', 'tab-pane active');

	/*
	$('a[href="#tab_form_partido"]').parent().attr('class', '');
	*/

	// Seleccionando por defecto la primera opción de cada select del formulario #formulario_ficha_jugador:
	$('#formulario_ficha_jugador select').each(function(){
		$(this).prop('selectedIndex', 0);	
	});

	$('a[href="#tab_form_partido"]').parent('li').hide();
	$('#tab_form_partido').attr('class', 'tab-pane');
 
	$('#formulario_partido_jugador').hide(); // <--- Ocultando el formulario // Ocultando el formulario

	// -------------------------------------------- FORMUARLIO DE FICHA DE JUGADOR -------------------------------------------- // 
    $('#foto_anterior_jugador').val(''); // <---- Vaciar - IMPORTANTE.
    $('#foto_jugador').val(''); // <---- Vaciar - IMPORTANTE.    	
	// Estableciendo imagen por defecto:
	let foto_jugador = '../config/silueta_jugador.png';

	$('#foto-jugador').attr( 'src', foto_jugador );

    // Vaciando ambos formularios:
    $("#formulario_ficha_jugador")[0].reset();
    $("#formulario_partido_jugador")[0].reset();  

    // Formualario de jugador en club:
    $("#estado_jugadorclub").prop('selectedIndex', 0); // <--- Seleccionando por defecto el primer option del estado del jugador.
    
    // Jugador libre:
    $("#idclub_jugadorlibre").prop('selectedIndex', 0);
    $('#division_club_jugadorlibre_otro').empty().append('<option value="">Seleccione primero una división</option>');

    // Jugador en club:
    $('#idclub_actual_jugadorenclub').empty().append('<option value="">Seleccione primero una división</option>');
    $('#division_club_actual').empty().append('<option value="">Seleccione primero un país</option>');

	if( window.estatus_vista_form === 1 ) {
		$('#cuadro_jugadores_club_selected').hide(500);
		$('#cuadro_form_agregar_jugador').show(500);	

		// Este es el ID del Club que actualmente el usuario está visualizando:
		// Por defecto será seleccionado en el formulario:
		let idclub_selected = $('.input-id-club-filtro').val();
		let pais_club_selected = $('.input-pais-club-filtro').val();
		let division_club_selected = $('.input-division-club-filtro').val();
		// alert( division_club_selected );

		// Seleccionándolo por defecto en el select de clubes para jugadores libres:
		$("#idclub_jugadorlibre option").each(function(){
			let thisElement = $(this);
			let thisValue = $(this).val();
			if( thisValue == idclub_selected ) {
				thisElement.prop("selected", true);
			}
		});		

		
		// Seleccionando por defecto el país del club seleccionado:
		$("#pais_club_actual option").each(function(){
			let thisElement = $(this);
			let thisValue = $(this).val();
			if( thisValue == pais_club_selected ) {
				thisElement.prop("selected", true);
			}
		});		

		// Consultando las divisiones según el país seleccionado:
		get_divisiones_from_pais( 1 );

		// Seleccionando por defecto la división del club seleccionado:
		$("#division_club_actual option").each(function(){
			let thisElement = $(this);
			let thisValue = $(this).val();
			if( thisValue == division_club_selected ) {
				thisElement.prop("selected", true);
			}
		});	
		

		// Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
		// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
		$.ajax({
			url: "post/scouting_busqueda_ver.php",
			type: "post",
			dataType: 'json',
			cache: false,
			data: {
				'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
				'pais_club': pais_club_selected,
				'division_club': division_club_selected 
			},
			success: function(respuesta)  {
				$('#idclub_actual_jugadorenclub').empty(); // <--- Vaciando select.
				if( respuesta== "" ) { //jugador sin informes
					console.log("No se encontró ningún club según el país y división seleccionada...");
					$("#idclub_actual_jugadorenclub").append('<option value="">No se encontraron clubes</option>');
					$("#idclub_actual_jugadorenclub").append('<option value="000">Otro</option>');
				} else {              
									
	                $("#idclub_actual_jugadorenclub").append('<option value="">Seleccione</option>');
	                for(var i=0; i < respuesta.length; i++) {   
	                    $("#idclub_actual_jugadorenclub").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
	                }
	                $("#idclub_actual_jugadorenclub").append('<option value="000">Otro</option>');

					// Seleccionándolo por defecto en el select de clubes para jugadores que actualmente pertenecen a un club:
					$("#idclub_actual_jugadorenclub option").each(function(){
						let thisElement = $(this);
						let thisValue = $(this).val();
						if( thisValue == idclub_selected ) {
							thisElement.prop("selected", true);
						}
					});	
					
				} 
			
			},
			error: function(){// will fire when timeout is reached
				console.log('Error al consulta clubes para el select de club actual del jugador');
			}, timeout: 15000 // sets timeout to 3 seconds
		});	
		// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
		
	} else {
		$('#jugadores_pozo_comun').hide(500);
		$('#cuadro_form_agregar_jugador').show(500);				
	}

	// $('#boton_agregar_ficha_jugador').prop('disabled', false);
	// chequear_datos_form_fichajugador(); // <----- Validando los campos.

	// Cambiando el color de fonto de los inputs, selects y textareas del formulario id="formulario_ficha_jugador":
	$("#formulario_ficha_jugador input").each(function(){
		let thisElement = $(this);
		thisElement.css("background-color", "white");
	});

	$("#formulario_ficha_jugador select").each(function(){
		let thisElement = $(this);
		thisElement.css("background-color", "white");
	});	

	$("#formulario_ficha_jugador textarea").each(function(){
		let thisElement = $(this);
		thisElement.css("background-color", "white");
	});	

	// -------------------------------------------- FORMUARLIO DE PARTIDOS -------------------------------------------- // 

	// Mostrando el mensaje de registrar jugadores en el formulario de partidos:
	$('.mensaje_registrarjugador_formpartido').show();	
	// Foto del jugador por defecto (sin registrar):
	$('.foto-jugador-partido').attr( 'src', foto_jugador );
	// Nombre del jugador por defecto (sin registrar):
	$('.nombre-jugador-partido').html( 'Registre jugador' );

	// Deshabilitando todos los inputs y selects del formulario id="formulario_partido_jugador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
	$('#formulario_partido_jugador input, #formulario_partido_jugador select').each(function(){
		let thisElement = $(this);
		thisElement.prop('disabled', true).css('background-color', '#cfcccc');
	});

	// Vaciando la tabla de partidos (tabla '.tabla_partidos_jugador')
	$('.tabla_partidos_jugador tbody').empty();
	let markup = '<tr class="panel_buscar"><td colspan="14" style="text-align: center;"><b>Ingrese partidos</b></td></tr>';
	$('.tabla_partidos_jugador tbody').append( markup );

	// Deshabilitando el botón de agregar partido (estará únicamente habilitado cuando se seleccione el partido a modificar desde la ventana modal):
	$('#boton-agregar-partido').prop('disabled', true); // <---- Deshabilitando el botón de guardar partido
	$('#boton-agregar-partido').removeClass('boton-agregar-partido-enabled');
	$('#boton-agregar-partido').addClass('boton-agregar-partido-disabled');

	$('#boton_agregar_ficha_jugador').show();
    campos_ficha_jugador(); // <--- Con esta función se muestran los campos según sea el caso.
    calcular_minutos_jugados(); // Calculando la cantidad total de minutos jugados (en caso de que el usuario decida seleccionar el tab 'Partidos').
    // get_clubes_from_paisdivision(); // <------------- Ejecutando la función 'get_clubes_from_paisdivision()'

}
// -------------------------- Fin de la función 'btn_ir_form_agregarjugador()' - AGREGAR (INSERT) --------------------------- //

// -------------------- Inicio de la función 'buscar_partidos_jugador()' ------------------------- //
function buscar_partidos_jugador() {

	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'buscar_partidos_jugador',
			'idfichaJugador_club': window.idfichaJugador_club    
		},
		success: function(respuesta)  {

			if(respuesta== ""){ //jugador sin informes
				$(".tabla_partidos_jugador tbody").empty();
				var markup = '<tr class="panel_buscar"><td colspan="16" style="text-align: center;"><b>No se encontraron partidos registrados</b></td></tr>';
				$(".tabla_partidos_jugador tbody").append(markup);
				$("#graficos_informes_resumen").hide();
				$('#cargando_buscar').hide();
				$('#sin_resultados').show();
				$('#boton_editar').hide();
				$('.boton_refresh').hide();
				// $('#boton_agregar_ficha_jugador').prop("disabled", true);
			}else{              
				window.datos_jugador_partido = respuesta; //se copian todos los profesores al cache
				$(".tabla_partidos_jugador tbody").empty(); // <--- Vaciando la tabla.

				// Inicio de la función each
				$('.tabla_partidos_jugador').each(function(){
					let vista_modal_partido = $(this).attr('vista-modal-partido');
					vista_modal_partido = parseInt( vista_modal_partido );

					let img_club_width = "";
					let img_campeonato_width = "";
					let img_club_resultados_width = "";
					let img_height = "";
					let td_valoracion = "";
					let icon_size = "";
					let p_position = "";
					let max_width_campeonato_clubes = "";
					let max_width_posicion_partido = "";
					if( vista_modal_partido == '1' ) { // <--- La tabla se muestra en al ventana modal.
						img_club_width = "width: 14%;";
						img_campeonato_width = "width: 26%;";
						img_club_resultados_width = "";
						img_height = "height: 15px;";
						td_valoracion = "";
						icon_size = "font-size: 12px;";
						p_position = "position: relative; top: 5px; text-align: left; left: 7px;";
						max_width_campeonato_pos = "max-width: 60px;";	
						max_width_campeonato_clubes	= "max-width: 60px;";
						max_width_posicion_partido = "max-width: 60px;";							
					} else {
						img_club_width = "";
						img_campeonato_width = "width: 25%;";
						img_club_resultados_width = "width: 23px;";
						img_height = "height: 25px;";
						td_valoracion = "td-valoracion";
						icon_size = "";
						p_position = "position: relative; top: 5px; text-align: left; left: 7px;";		
						max_width_campeonato_pos = "max-width: 100px;";
						max_width_campeonato_clubes	= "max-width: 80px;";
						max_width_posicion_partido = "max-width: 80px;";					
					}

					var count = 1;
					for(var i=0; i < respuesta.length; i++){

                        // Tabla 'fichaJugador_partido':
                        
                        let fecha_jugadorpartido;
                        if( respuesta[i]['fecha_jugadorpartido'] === null || respuesta[i]['fecha_jugadorpartido'] == '' || respuesta[i]['fecha_jugadorpartido'] == '0000-00-00' ) {
                            fecha_jugadorpartido = '-';
                        } else {    
                            fecha_jugadorpartido = fecha_formato_ddmmaaa( respuesta[i]['fecha_jugadorpartido'] );
                        }
                        
                        let jornada_jugadorpartido
                        if( respuesta[i]['jornada_jugadorpartido'] === null || respuesta[i]['jornada_jugadorpartido'] == '' ) {
                            jornada_jugadorpartido = 'No especificado';
                        } else {    
                            jornada_jugadorpartido = respuesta[i]['jornada_jugadorpartido'];
                        }                        
                        
                        let condicion_jugadorpartido = respuesta[i]['condicion_jugadorpartido'];
                        switch( condicion_jugadorpartido ) {
                            case '1': // <---- Local.
                                condicion_jugadorpartido = "Local";
                                break;
                            case '2': // <---- Visita.
                                condicion_jugadorpartido = "Visita";
                                break;
                            case '3': // <---- Neutral.
                                condicion_jugadorpartido = "Neutral";
                                break;
                            default:
                                condicion_jugadorpartido = "-";
                                break;
                        }

                        let gol_equipo1_jugadorpartido = respuesta[i]['gol_equipo1_jugadorpartido'];
                        let gol_equipo2_jugadorpartido = respuesta[i]['gol_equipo2_jugadorpartido'];

                        let posicion_jugadorpartido = respuesta[i]['posicion_jugadorpartido'];
                        let nombre_posicion;
                        if( posicion_jugadorpartido === null || posicion_jugadorpartido == '' || posicion_jugadorpartido == '0' || posicion_jugadorpartido == '999' ) {
                            nombre_posicion = 'No especificado';
                        } else {
                            nombre_posicion = array_posiciones[posicion_jugadorpartido][1];
                        }                        
                        
                        let tit_sup_nc_jugadorpartido = respuesta[i]['tit_sup_nc_jugadorpartido'];
                        switch( tit_sup_nc_jugadorpartido ) {
                            case '1': // <---- Titular.
                                tit_sup_nc_jugadorpartido = "Titular";
                                break;
                            case '2': // <---- Suplente.
                                tit_sup_nc_jugadorpartido = "Suplente";
                                break;
                            case '3': // <---- No compite.
                                tit_sup_nc_jugadorpartido = "No compite";
                                break;
                            default: // <---- No compite.
                                tit_sup_nc_jugadorpartido = "-";
                                break;                                
                        }       

                        let min_jugados_jugadorpartido = respuesta[i]['min_jugados_jugadorpartido'];
                        let min_entrada_jugadorpartido = respuesta[i]['min_entrada_jugadorpartido'];
                        let num_gol_jugadorpartido = respuesta[i]['num_gol_jugadorpartido'];
                        let t_amarilla_jugadorpartido = respuesta[i]['t_amarilla_jugadorpartido'];
                        let t_roja_jugadorpartido = respuesta[i]['t_roja_jugadorpartido'];

                        // Tabla 'campeonato':
                        let idcampeonato = respuesta[i]['idcampeonato'];
                        
                        let nombre_campeonato;
                        if( respuesta[i]['nombre_campeonato'] === null || respuesta[i]['nombre_campeonato'] == '' ) {
                            nombre_campeonato = 'No especificado';
                        } else {    
                            nombre_campeonato = respuesta[i]['nombre_campeonato'];
                        }

                        let foto_campeonato = './foto_campeonatos/'+idcampeonato+'.png?lala='+new Date()+'';

                        // Tabla 't_club_jugador':
                        let idclub_jugador = respuesta[i]['idclub_jugador'];
                        let nombre_club_jugador;
                        if( respuesta[i]['nombre_club_jugador'] === null || respuesta[i]['nombre_club_jugador'] == '' ) {
                            nombre_club_jugador = 'No especificado';
                        } else {    
                            nombre_club_jugador = respuesta[i]['nombre_club_jugador'];
                        }                                            
                        let foto_club_jugador = './foto_clubes/'+idclub_jugador+'.png?lala='+new Date()+'';

                        // Tabla 't_club_rival':
                        let idclub_rival = respuesta[i]['idclub_rival'];
                        let nombre_club_rival;
                        if( respuesta[i]['nombre_club_rival'] === null || respuesta[i]['nombre_club_rival'] == '' ) {
                            nombre_club_rival = 'No especificado';
                        } else {    
                            nombre_club_rival = respuesta[i]['nombre_club_rival'];
                        }                        
                        let foto_club_rival = './foto_clubes/'+idclub_rival+'.png?lala='+new Date()+'';

						var markup = 
						'<tr style="cursor: pointer;">\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="text-align: center;"><div style="max-width: 60px;"><p class="ellipsis-text">'+fecha_jugadorpartido+'</p></div></td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;">\
								<div class="div-club-table" style="text-align: center;">\
									<div class="img-next-to-text" style="'+img_club_width+'"><img src="'+foto_club_jugador+'" style="width: 25px; border-radius: 50%; border: solid 2px;'+img_height+'"></div>\
									<div style="'+max_width_campeonato_clubes+'"><p class="ellipsis-text" style="'+p_position+'">'+nombre_club_jugador+'</p></div>\
								</div>\
				            </td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;">\
								<div class="div-club-table" style="text-align: center; '+max_width_campeonato_pos+'">\
									<div class="img-next-to-text" style="'+img_campeonato_width+'"><img src="'+foto_campeonato+'" style="width: 25px; border-radius: 50%; border: solid 2px;'+img_height+'"></div>\
									<div style="'+max_width_campeonato_clubes+'"><p class="ellipsis-text" style="'+p_position+'">'+nombre_campeonato+'</p></div>\
								</div>\
				            </td style="border-left: 1px solid;">\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;"><div class="div-club-table" style="text-align: center; font-weight: bold; max-width:60px;"><p class="ellipsis-text">'+jornada_jugadorpartido+'</p></div></td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;"><div class="div-club-table" style="text-align: center; font-weight: bold; max-width:60px;"><p class="ellipsis-text">'+condicion_jugadorpartido+'</p></div></td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;">\
								<div class="div-club-table" style="text-align: center;">\
									<div class="img-next-to-text" style="'+img_club_width+'"><img src="'+foto_club_rival+'" style="width: 25px; border-radius: 50%; border: solid 2px;'+img_height+'"></div>\
									<div style="'+max_width_campeonato_clubes+'"><p class="ellipsis-text" style="'+p_position+'">'+nombre_club_rival+'</p></div>\
								</div>\
				            </td style="border-left: 1px solid;">\
							<td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')"  style="width: 25px; border-left: 1px solid;">\
								<center>\
									<img src="'+foto_club_jugador+'" class="img-club" style="'+img_club_resultados_width+'"> '+gol_equipo1_jugadorpartido+'<span> - </span> '+gol_equipo2_jugadorpartido+' <img src="'+foto_club_rival+'" class="img-club" style="'+img_club_resultados_width+' position: relative; left: 3px;">\
								</center>\
							</td>\
							<td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;"><div style="'+max_width_posicion_partido+'"><p class="ellipsis-text">'+nombre_posicion+'</p></div></td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+tit_sup_nc_jugadorpartido+'</td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+min_jugados_jugadorpartido+'\'</td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+min_entrada_jugadorpartido+'\'</td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+num_gol_jugadorpartido+'</td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+t_amarilla_jugadorpartido+'</td>\
				            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+t_roja_jugadorpartido+'</td>\
							<td style="padding: 2px; width: 9px; border-left: 1px solid;">\
								<a style="'+icon_size+'" class="boton_editar" onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')">\
									<i class="icon-pencil"></i>\
								</a>\
							</td>\
							<td style="padding: 2px; width: 9px;">\
								<a style="'+icon_size+'" class="boton_eliminar" onclick="boton_eliminar_partido('+i+', '+vista_modal_partido+');">\
									<i class="icon-remove"></i>\
								</a>\
							</td>\
				        </tr>';

						//$(".tabla_partidos_jugador tbody").append(markup);
						
						$(this).children('tbody').append(markup); 

						count = count + 1;
					}							
				});
				// Inicio de la función each

				$('#boton_agregar').show();
				$('.boton_refresh').hide();
			} 
			$('#cargando_buscar').hide();
			$('#error_conexion').hide();
			$('#sin_resultados').hide();
		
		},
		error: function(){// will fire when timeout is reached
			$('#cargando_buscar').hide();
			$('#sin_resultados').hide();
			$('#error_conexion').show();
			$('#boton_editar').hide();
				$('.boton_refresh').show();
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //	
} 
// -------------------- Fin de la función 'buscar_partidos_jugador()' ------------------------- //

// -------------------- Inicio de la función 'buscar_partidos_jugador_porcampeonato()' ------------------------- //
function buscar_partidos_jugador_porcampeonato() {

	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'buscar_partidos_jugador_porcampeonato',
			'idfichaJugador_club': window.idfichaJugador_club    
		},
		success: function(respuesta)  {

			if(respuesta== ""){ //jugador sin informes
				$(".tabla_partidos_jugador_modal_small tbody").empty();
				var markup = '<tr class="panel_buscar"><td colspan="9" style="text-align: center;"><b>No se encontraron partidos registrados</b></td></tr>';						
				$(".tabla_partidos_jugador_modal_small tbody").append(markup);						

				$("#graficos_informes_resumen").hide();
				$('#cargando_buscar').hide();
				$('#sin_resultados').show();
				$('#boton_editar').hide();
				$('.boton_refresh').hide();
				// $('#boton_agregar_ficha_jugador').prop("disabled", true);
			}else{              
				// window.datos_jugador = respuesta; //se copian todos los profesores al cache
				$(".tabla_partidos_jugador_modal_small tbody").empty(); // <---- Vaciando la tabla.

				var count = 1;
				for(var i=0; i < respuesta.length; i++){

					// Tabla 'campeonato':
					let idcampeonato = respuesta[i]['idcampeonato'];
					let nombre_campeonato = respuesta[i]['nombre_campeonato'];
					let foto_campeonato = './foto_campeonatos/'+idcampeonato+'.png';

					// Tabla 'fichaJugador_partido':
					let partidos_jugados = respuesta[i]['partidos_jugados'];
					let min_jugados_jugadorpartido = respuesta[i]['min_jugados_jugadorpartido'];
					let partidos_jugados_titular = respuesta[i]['partidos_jugados_titular'];
					let partidos_jugados_suplente = respuesta[i]['partidos_jugados_suplente'];
					let partidos_jugados_nojugados = respuesta[i]['partidos_jugados_nojugados'];
					let t_amarillas_jugadorpartido = respuesta[i]['t_amarillas_jugadorpartido'];
					let t_rojas_jugadorpartido = respuesta[i]['t_rojas_jugadorpartido'];
					let goles_convertidos = respuesta[i]['goles_convertidos'];					

					// -- Tabla '.tabla_partidos_jugador_modal_small':
					var markup = 
					'<tr>\
						<td style="font-weight:bold;">\
							<div>\
								<img src="'+foto_campeonato+'" class="img-next-to-text" style="width: 23px; border-radius: 50%; height:21px; margin-right: 5px;">\
								<div style="max-width: 150px;"><p class="ellipsis-text" style="position: relative; top: 0px; left: 3px;">'+nombre_campeonato+'</p></div>\
							</div>\
						</td>\
						<td style="text-align: center;">'+partidos_jugados+'</td>\
						<td style="text-align: center;">'+min_jugados_jugadorpartido+'"</td>\
						<td style="text-align: center;">'+partidos_jugados_titular+'</td>\
						<td style="text-align: center;">'+partidos_jugados_suplente+'</td>\
						<td style="text-align: center;">'+partidos_jugados_nojugados+'</td>\
						<td style="text-align: center;">'+t_amarillas_jugadorpartido+'</td>\
						<td style="text-align: center;">'+t_rojas_jugadorpartido+'</td>\
						<td style="text-align: center;">'+goles_convertidos+'</td>\
					</tr>';
					$(".tabla_partidos_jugador_modal_small tbody").append(markup);

					count = count + 1;
				}


				$('#boton_agregar').show();
				$('.boton_refresh').hide();
			} 
			$('#cargando_buscar').hide();
			$('#error_conexion').hide();
			$('#sin_resultados').hide();
		
		},
		error: function(){// will fire when timeout is reached
			$('#cargando_buscar').hide();
			$('#sin_resultados').hide();
			$('#error_conexion').show();
			$('#boton_editar').hide();
			$('.boton_refresh').show();
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //	
} 
// -------------------- Fin de la función 'buscar_partidos_jugador_porcampeonato()' ------------------------- //

// -------------------------- Inicio de la función 'boton_agregar_partido( linea )' - AGREGAR (INSERT) PARTIDOS --------------------------- //
function boton_agregar_partido() {

	window.idfichaJugador_partido = ''; // <---- DEBE ESTAR VACÍO PARA EJECUTAR EL INSERT
	$('#formulario_partido_jugador').slideDown('fast'); // <---- Mostrando el formulario
	// -------------------------------------------- FORMULARIO DE PARTIDO -------------------------------------------- //
	// Agregando por defecto la foto del club rival:
	$('#foto_1_club_rival_partido').attr( 'src', '../config/default.png' );
	$('#foto_2_club_rival_partido').attr( 'src', '../config/default.png' );
	$('#formulario_partido_jugador')[0].reset(); // <--- Vaciando el formulario #formulario_partido_jugador.
    $('#min_jugados_jugadorpartido_text').html('0 minutos'); // <--- Importante. Cambiar texto
    $('#min_jugados_jugadorpartido').val(''); // <--- Importante. Vaciar
	chequear_datos_form_partidojugador(); // <---- Validando

	$('.campo-campeonato-otro').hide(); // <--- Importante - Agregado el 18-05-2020
	$('.campo-club-rival-otro').hide(); // <--- Importante - Agregado el 18-05-2020
	
}
// -------------------------- Fin de la función 'boton_agregar_partido( linea )' - AGREGAR (INSERT) PARTIDOS --------------------------- //


// -------------------------- Inicio de la función 'boton_editar_form_jugador( linea )' - EDITAR (UPDATE) --------------------------- //
function boton_editar_form_jugador( linea ){

	window.idfichaJugador = datos_jugador_club[linea]['idfichaJugador'];
	window.idfichaJugador_club = datos_jugador_club[linea]['idfichaJugador_club'];
	window.idfichaJugador_partido = ''; // DEBE ESTAR VACÍO PARA EJECUTAR EL INSERT

	// Mostrando por defecto la pestaña 'Datos':
	$('a[href="#tab_form_fichajugador"]').parent().attr('class', 'active');
	$('#tab_form_fichajugador').attr('class', 'tab-pane active');

	$('a[href="#tab_form_partido"]').parent('li').show(); // <--- Mostrando tab de formulario de partidos.
	$('a[href="#tab_form_partido"]').parent().attr('class', '');
	$('#tab_form_partido').attr('class', 'tab-pane');
 
	$('#formulario_partido_jugador').hide(); // <--- Ocultando el formulario // Ocultando el formulario

	// alert( datos_jugador_club[linea]['idfichaJugador_club'] );

	// -------------------------------------------- FORMUARLIO DE FICHA DE JUGADOR -------------------------------------------- //
	let foto_jugador = 'foto_jugadores_scouting/' + datos_jugador_club[linea]['idfichaJugador'] + '.png?lala='+new Date()+'';
	// $('#foto_anterior_jugador').val( foto_jugador ); // <--- Importante. Cargar valor de la foto del jugador en este campo oculto.
	$('#foto_anterior_jugador').val( datos_jugador_club[linea]['idfichaJugador'] + '.png' ); // <--- Importante. Cargar valor de la foto del jugador en este campo oculto.
	$('#foto_jugador').val(''); // <--- Importante. Vaciar. 

	/*
	if( foto_jugador == 'sinFoto' || foto_jugador === null || foto_jugador == '' ) {
		foto_jugador = '../config/silueta_jugador.png';
	} else {
		foto_jugador = 'foto_jugadores_scouting/' + foto_jugador;
	}
	*/

	$('#foto-jugador').attr( 'src', foto_jugador );
	$("#nombre").val( datos_jugador_club[linea]['nombre'] );
	$("#apellido1").val( datos_jugador_club[linea]['apellido1'] );
	
	if( datos_jugador_club[linea]['apellido2'] === null ||  datos_jugador_club[linea]['apellido2'] === '' ) {
		datos_jugador_club[linea]['apellido2'] = "";
	}
	$("#apellido2").val( datos_jugador_club[linea]['apellido2'] );
	
	$("#fechaNacimiento").val( datos_jugador_club[linea]['fechaNacimiento'] );

	let nombre_completo_jugador = datos_jugador_club[linea]['nombre'] + " " + datos_jugador_club[linea]['apellido1'] + " " + datos_jugador_club[linea]['apellido2'];

	// Selects:
	$("#sexo option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['sexo'] ) {
			thisElement.prop("selected", true);
		}
	});

	$("#altura").val( datos_jugador_club[linea]['altura'] );
	
	// Selects:
	$("#nacionalidad1").prop("selectedIndex", 0);
	$("#nacionalidad1 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['nacionalidad1'] ) {
			thisElement.prop("selected", true);
		}
	});
	
	$("#nacionalidad2").prop("selectedIndex", 0);
	$("#nacionalidad2 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['nacionalidad2'] ) {
			thisElement.prop("selected", true);
		}
	});	

	$("#serieActual").prop("selectedIndex", 0);
	$("#serieActual option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['serieActual'] ) {
			thisElement.prop("selected", true);
		}
	});		

	$("#dinamico").prop("selectedIndex", 0);
	$("#dinamico option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['dinamico'] ) {
			thisElement.prop("selected", true);
		}
	});	

	$("#posicion0").prop("selectedIndex", 0);
	$("#posicion0 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['posicion0'] ) {
			thisElement.prop("selected", true);
		}
	});	

	$("#posicion1").prop("selectedIndex", 0);
	$("#posicion1 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['posicion1'] ) {
			thisElement.prop("selected", true);
		}
	});

	$("#posicion2").prop("selectedIndex", 0);
	$("#posicion2 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['posicion2'] ) {
			thisElement.prop("selected", true);
		}
	});	

	$("#seleccionado").prop("selectedIndex", 0);
	$("#seleccionado option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['seleccionado'] ) {
			thisElement.prop("selected", true);
		}
	});						

	// Estado del jugador:
	$("#estado_jugadorclub").prop("selectedIndex", 0);
	$("#estado_jugadorclub option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['estado_jugadorclub'] ) {
			thisElement.prop("selected", true);
		}
	});	

	// Club anterior de Jugador libre:
	$("#idclub_jugadorlibre").prop("selectedIndex", 0);
	$("#idclub_jugadorlibre option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['idclub'] ) {
			thisElement.prop("selected", true);
		}
	});

	$('#representante_jugadorclub').val( datos_jugador_club[linea]['representante_jugadorclub'] );

	// Club actual de Jugador en Club:
	// alert( 'idclub: ' + datos_jugador_club[linea]['idclub'] );

	$("#pais_club_actual").prop("selectedIndex", 0);
	$("#pais_club_actual option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['pais_club'] ) {
			thisElement.prop("selected", true);
		}
	});

    // División:
    $("#division_club_actual").empty();
    if( datos_jugador_club[linea]['division_club'] === null || datos_jugador_club[linea]['division_club'] == '' || datos_jugador_club[linea]['division_club'] == '0'  ) {

    	$("#division_club_actual").append('<option value="">Seleccione primero un país</option>');

    } else {

        $('#division_club_actual').empty();
        let divisiones_pais_selected = array_divisiones[ datos_jugador_club[linea]['pais_club'] ];
        divisiones_pais_selected = divisiones_pais_selected.filter(function(){return true;}); // Reiniciando el valor de los índices de 0 a n.
        $('#division_club_actual').append('<option value="">Seleccione</option>');
        for (var i = 0; i < divisiones_pais_selected.length; i++) {
            let division =  divisiones_pais_selected[i][0];
            let prop_selected = '';
            if( division == datos_jugador_club[linea]['division_club'] ) {
                prop_selected = 'selected'
            }

            $('#division_club_actual').append('<option '+prop_selected+' value="'+divisiones_pais_selected[i][0]+'">'+divisiones_pais_selected[i][1]+'</option>');
        }

    } 

	// Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
			'pais_club': datos_jugador_club[linea]['pais_club'],
			'division_club': datos_jugador_club[linea]['division_club'] 
		},
		success: function(respuesta)  {
			$('.select-idclub-dinamico').empty(); // <--- Vaciando select.
			if( respuesta== "" ) { //jugador sin informes
				console.log("No se encontró ningún club según el país y división seleccionada...");
				$(".select-idclub-dinamico").append('<option value="">Seleccione primero una división</option>');
			} else {              				
                $(".select-idclub-dinamico").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $(".select-idclub-dinamico").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $(".select-idclub-dinamico").append('<option value="000">Otro</option>');

				$("#idclub_actual_jugadorenclub option").each(function(){
					let thisElement = $(this);
					let thisValue = $(this).val();
					if( thisValue == datos_jugador_club[linea]['idclub'] ) {
						thisElement.prop("selected", true);
					}
				});
			} 
		
		},
		error: function(){// will fire when timeout is reached
			$('.select-idclub-dinamico').empty(); // <--- Vaciando select.
			console.log('Error al consulta clubes para el select de club actual del jugador');
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

	$("#contrato_pro_jugadorclub").prop("selectedIndex", 0);
	$("#contrato_pro_jugadorclub option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['contrato_pro_jugadorclub'] ) {
			thisElement.prop("selected", true);
		}
	});			

	// Situación del jugador en el club actual:
	$("#situ_clubactual_jugadorclub").prop("selectedIndex", 0);
	$("#situ_clubactual_jugadorclub option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['situ_clubactual_jugadorclub'] ) {
			thisElement.prop("selected", true);
		}
	});	

	// Inputs:
	$("#fechafin_prestamo_jugadorclub").val( datos_jugador_club[linea]['fechafin_prestamo_jugadorclub'] );
	$("#pase_pertenencia_jugadorclub").val( datos_jugador_club[linea]['pase_pertenencia_jugadorclub'] );
	$("#fechafin_contrato_jugadorclub").val( datos_jugador_club[linea]['fechafin_contrato_jugadorclub'] );
	$("#valor_mercado_jugadorclub").val( datos_jugador_club[linea]['valor_mercado_jugadorclub'] );

	// Cláusula de salida:
	$("#clausula_salida_jugadorclub").prop("selectedIndex", 0);
	$("#clausula_salida_jugadorclub option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_club[linea]['clausula_salida_jugadorclub'] ) {
			thisElement.prop("selected", true);
			/*
			if( thisValue == '0' ) {
				$("#valor_clausula_jugadorclub").parent().hide();
			}
			*/
		}
	});

	$("#valor_clausula_jugadorclub").val( datos_jugador_club[linea]['valor_clausula_jugadorclub'] );		

	$("#observaciones_jugadorclub").val( datos_jugador_club[linea]['observaciones_jugadorclub'] );


	// -------------------------------------------- FORMUARLIO DE PARTIDOS -------------------------------------------- // 
	// Habilitando todos los inputs y selects del formulario id="formulario_partido_jugador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
	$('#formulario_partido_jugador input, #formulario_partido_jugador select').each(function(){
		let thisElement = $(this);
		thisElement.prop('disabled', false).css('background-color', '');
	});

	// Agregando la foto del club del jugador:
	// alert( datos_jugador_club[linea]['idclub'] );
	let foto_club_jugador = 'foto_clubes/' + datos_jugador_club[linea]['idclub'] + '.png?lala='+new Date()+'';

	$('#foto_1_club_jugador_partido').attr( 'src', foto_club_jugador );
	$('#foto_2_club_jugador_partido').attr( 'src', foto_club_jugador );

	// Agregando por defecto la foto del club rival:
	$('#foto_1_club_rival_partido').attr( 'src', '../config/default.png' );
	$('#foto_2_club_rival_partido').attr( 'src', '../config/default.png' );

	$('.foto-jugador-partido').attr( 'src', foto_jugador ); // <--- Formulario id="formulario_partido_jugador"	
	$('.nombre-jugador-partido').html( nombre_completo_jugador ); // <--- Formulario id="formulario_partido_jugador"
	
	buscar_partidos_jugador(); // <---- Consultando los partidos del jugador

	/*
	// Deshabilitando todos los inputs y selects del formulario id="formulario_partido_jugador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
	$('#formulario_partido_jugador input, #formulario_partido_jugador select').each(function(){
		let thisElement = $(this);
		// thisElement.prop('disabled', true).css('background-color', '#cfcccc');
	});
	*/

	$('#formulario_partido_jugador')[0].reset(); // <---- Vaciando formulario de partido.

	// Deshabilitando el botón de agregar partido:
	$('#boton-agregar-partido').prop('disabled', true); // <---- Deshabilitando el botón de guardar partido
	$('#boton-agregar-partido').removeClass('boton-agregar-partido-enabled');
	$('#boton-agregar-partido').addClass('boton-agregar-partido-disabled');

	calcular_minutos_jugados(); // <--- Calculando la cantidad de minutos jugados.

	// Ocultando vistas según el valor de la variable globar 'estatus_vista_form':
	if( window.estatus_vista_form === 1 ) { // Ingresó al formulario desde la vista de un determinado club
		$('#cuadro_jugadores_club_selected').hide(500);
	} else { // Ingresó al formulario desde la vista de jugadores del pozo común
		$('#jugadores_pozo_comun').hide(500);
	}
		
	// Mostrando la vista del formulario:
	$('#cuadro_form_agregar_jugador').show(500);

	campos_ficha_jugador(); // <--- Con esta función se muestran los campos según sea el caso.
	chequear_datos_form_fichajugador(); // <----- Validando los campos del formulario id="formulario_partido_jugador".
	$('.campo-club-jugadorenclub-otro').hide(); // <--- Esconder (Añadido el 18-05-2020 a las 12:47)
    $('.campo-campeonato-otro').hide(); // <--- Importante - Agregado el 18-05-2020
    $('.campo-club-rival-otro').hide(); // <--- Importante - Agregado el 18-05-2020

    // Mostrando el botón de agregar ficha jugador:
    $('#boton_agregar_ficha_jugador').show();
        
}
// -------------------------- Fin de la función 'boton_editar_form_jugador( linea )' - EDITAR (UPDATE) --------------------------- //


// -------------------------- Inicio de la función 'boton_editar_form_partido( linea, vista_modal_partido )' - EDITAR (UPDATE) --------------------------- //
function boton_editar_form_partido( linea, vista_modal_partido ){

	window.idfichaJugador = datos_jugador_partido[linea]['idfichaJugador'];
	window.idfichaJugador_club = datos_jugador_partido[linea]['idfichaJugador_club'];
	window.idfichaJugador_partido = datos_jugador_partido[linea]['idfichaJugador_partido'];


	$('#formulario_partido_jugador').show();
	// alert(datos_jugador_partido[linea]['idfichaJugador_partido']);

	// -------------------------------------------- FORMULARIO DE FICHA JUGADOR -------------------------------------------- //
    let foto_jugador = 'foto_jugadores_scouting/' + datos_jugador_partido[linea]['idfichaJugador'] + '.png?lala='+new Date()+'';
    // $('#foto_anterior_jugador').val( foto_jugador ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_anterior_jugador').val( datos_jugador_partido[linea]['idfichaJugador'] + '.png' ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_jugador').val(''); // <--- Importante. Vaciar. 	

	$('#foto-jugador').attr( 'src', foto_jugador ); // <--- Formulario id="formulario_ficha_jugador"
	$("#nombre").val( datos_jugador_partido[linea]['nombre'] );
	$("#apellido1").val( datos_jugador_partido[linea]['apellido1'] );
	
	if( datos_jugador_partido[linea]['apellido2'] === null ||  datos_jugador_partido[linea]['apellido2'] === '' ) {
		datos_jugador_partido[linea]['apellido2'] = "";
	}
	$("#apellido2").val( datos_jugador_partido[linea]['apellido2'] );
	
	$("#fechaNacimiento").val( datos_jugador_partido[linea]['fechaNacimiento'] );

	let nombre_completo_jugador = datos_jugador_partido[linea]['nombre'] + " " + datos_jugador_partido[linea]['apellido1'] + " " + datos_jugador_partido[linea]['apellido2'];

	// Selects:
	$("#sexo option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['sexo'] ) {
			thisElement.prop("selected", true);
		}
	});

	$("#altura").val( datos_jugador_partido[linea]['altura'] );
	
	// Selects:
	$("#nacionalidad1 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['nacionalidad1'] ) {
			thisElement.prop("selected", true);
		}
	});
	
	$("#nacionalidad2 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['nacionalidad2'] ) {
			thisElement.prop("selected", true);
		}
	});	

	$("#serieActual option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['serieActual'] ) {
			thisElement.prop("selected", true);
		}
	});		

	$("#dinamico option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['dinamico'] ) {
			thisElement.prop("selected", true);
		}
	});	

	$("#posicion0 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['posicion0'] ) {
			thisElement.prop("selected", true);
		}
	});	

	$("#posicion1 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['posicion1'] ) {
			thisElement.prop("selected", true);
		}
	});

	$("#posicion2 option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['posicion2'] ) {
			thisElement.prop("selected", true);
		}
	});	

	$("#seleccionado option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['seleccionado'] ) {
			thisElement.prop("selected", true);
		}
	});						

	// Estado del jugador:
	$("#estado_jugadorclub option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['estado_jugadorclub'] ) {
			thisElement.prop("selected", true);
		}
	});	

	// Club anterior de Jugador libre:
	$("#idclub_jugadorlibre option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['idclub_jugador'] ) {
			thisElement.prop("selected", true);
		}
	});

	// Representante
	$('#representante_jugadorclub').val( datos_jugador_partido[linea]['representante_jugadorclub'] );

	// Club actual de Jugador en Club:

	$("#pais_club_actual option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['pais_club_jugador'] ) {
			thisElement.prop("selected", true);
		}
	});

	$("#division_club_actual option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['division_club_jugador'] ) {
			thisElement.prop("selected", true);
		}
	});

	// Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$('#idclub_actual_jugadorenclub').empty(); // <--- Vaciando select.
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
			'pais_club': datos_jugador_partido[linea]['pais_club_jugador'],
			'division_club': datos_jugador_partido[linea]['division_club_jugador'] 
		},
		success: function(respuesta)  {
			$('#idclub_actual_jugadorenclub').empty(); // <--- Vaciando select.
			if( respuesta== "" ) { //jugador sin informes
				console.log("No se encontró ningún club según el país y división seleccionada...");
				$("#idclub_actual_jugadorenclub").append('<option value="">No se encontraron clubes</option>');
				$("#idclub_actual_jugadorenclub").append('<option value="000">Otro</option>');
			} else {              
								
                $("#idclub_actual_jugadorenclub").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_actual_jugadorenclub").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $("#idclub_actual_jugadorenclub").append('<option value="000">Otro</option>');

				$("#idclub_actual_jugadorenclub option").each(function(){
					let thisElement = $(this);
					let thisValue = $(this).val();
					if( thisValue == datos_jugador_partido[linea]['idclub_jugador'] ) {
						thisElement.prop("selected", true);
					}
				});
			} 
		
		},
		error: function(){// will fire when timeout is reached
			$('#cargando_buscar').hide();
			$('#sin_resultados').hide();
			$('#error_conexion').show();
			$('#boton_editar').hide();
				$('.boton_refresh').show();
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //


	$("#contrato_pro_jugadorclub option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['contrato_pro_jugadorclub'] ) {
			thisElement.prop("selected", true);
		}
	});			

	// Situación del jugador en el club actual:
	$("#situ_clubactual_jugadorclub option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['situ_clubactual_jugadorclub'] ) {
			thisElement.prop("selected", true);
		}
	});	

	// Inputs:
	$("#fechafin_prestamo_jugadorclub").val( datos_jugador_partido[linea]['fechafin_prestamo_jugadorclub'] );
	$("#pase_pertenencia_jugadorclub").val( datos_jugador_partido[linea]['pase_pertenencia_jugadorclub'] );
	$("#fechafin_contrato_jugadorclub").val( datos_jugador_partido[linea]['fechafin_contrato_jugadorclub'] );
	$("#valor_mercado_jugadorclub").val( datos_jugador_partido[linea]['valor_mercado_jugadorclub'] );

	// Cláusula de salida:
	$("#clausula_salida_jugadorclub option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['clausula_salida_jugadorclub'] ) {
			thisElement.prop("selected", true);
			/*
			if( thisValue == '0' ) {
				$("#valor_clausula_jugadorclub").parent().hide();
			}
			*/
		}
	});

	$("#valor_clausula_jugadorclub").val( datos_jugador_partido[linea]['valor_clausula_jugadorclub'] );		

	$("#observaciones_jugadorclub").val( datos_jugador_partido[linea]['observaciones_jugadorclub'] );

	campos_ficha_jugador(); // <--- Con esta función se muestran los campos según sea el caso.
	chequear_datos_form_fichajugador(); // <----- Validando los campos del formulario id="formulario_partido_jugador".

	// -------------------------------------------- FORMUARLIO DE FICHA DE PARTIDO -------------------------------------------- //
	if( vista_modal_partido === 1 ) {
		$('#modal-detalle-jugador').modal('hide');

		if( window.estatus_vista_form === 1 ) {
			$('#cuadro_jugadores_club_selected').hide(500);
		} else {
			$('#jugadores_pozo_comun').hide(500);
		}
		
		$('#cuadro_form_agregar_jugador').show(500);

		// Ocultando por defecto los datos de ficha jugador:
		ocultar_datos_fichaJugador();
		$('a[href="#tab_form_fichajugador"]').parent().attr('class', '');
		$('#tab_form_fichajugador').attr('class', 'tab-pane');

		$('a[href="#tab_form_partido"]').parent('li').show(); // <--- Mostrando tab de formulario de partidos.
		$('a[href="#tab_form_partido"]').parent().attr('class', 'active');
		$('#tab_form_partido').attr('class', 'tab-pane active');
		$('#formulario_partido_jugador').show(); // <--- Mostrando formulario.
		
	} 

	// Habilitando todos los inputs y selects del formulario id="formulario_partido_jugador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
	$('#formulario_partido_jugador input, #formulario_partido_jugador select').each(function(){
		let thisElement = $(this);
		thisElement.prop('disabled', false).css('background-color', '');
	});

	// Habilitando el botón de agregar partido (estaránrá únicamente habilitado cuando se seleccione el partido a modificar desde la ventana modal):
	/*
	$('#boton-agregar-partido').prop('disabled', false).css('cursor', 'default'); // <---- Deshabilitando el botón de guardar partido
	$('#boton-agregar-partido').addClass('boton-agregar-partido-enabled');
	*/

	// Agregando la foto del club del jugador:
	let foto_club_jugador = 'foto_clubes/' + datos_jugador_partido[linea]['idclub_jugador'] + '.png?lala='+new Date()+'';

	$('#foto_1_club_jugador_partido').attr( 'src', foto_club_jugador );
	$('#foto_2_club_jugador_partido').attr( 'src', foto_club_jugador );

	// Agregando la foto del club rival:
	let foto_club_rival = 'foto_clubes/' + datos_jugador_partido[linea]['idclub_rival'] + '.png?lala='+new Date()+'';

	$('#foto_1_club_rival_partido').attr( 'src', foto_club_rival );
	$('#foto_2_club_rival_partido').attr( 'src', foto_club_rival );

	// -------------------------- Agregando los valores a los inputs y selects del partido seleccionado -------------------------- //
	$("#fecha_jugadorpartido").val( datos_jugador_partido[linea]['fecha_jugadorpartido'] );

	// ---------------------- Establecer como selected el campeonato ---------------------- // 
	$("#idcampeonato").empty();
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'get_all_campeonatos',    
		},success: function(respuesta){

			$("#idcampeonato").append('<option value="">Seleccione</option>');
			for(var i=0; i < respuesta.length; i++) {   
				$("#idcampeonato").append('<option pais-campeonato="'+respuesta[i]['pais_campeonato']+'" value="'+respuesta[i]['idcampeonato']+'">'+respuesta[i]['nombre_campeonato']+'</option>');
			}
			$("#idcampeonato").append('<option value="000">Otro</option>');

			$("#idcampeonato option").each(function(){
				let thisElement = $(this);
				let thisValue = $(this).val();
				if( thisValue == datos_jugador_partido[linea]['idcampeonato'] ) {
					thisElement.prop("selected", true);
				}
			});

			
		},error: function(){// will fire when timeout is reached
			console.log('Error al consultar campeonatos para el select de campeonatos (partidos de jugador)');
		}, timeout: 15000 // sets timeout to 3 seconds
	});	

	$("#temporada_jugadorpartido").val( datos_jugador_partido[linea]['temporada_jugadorpartido'] );
	$("#jornada_jugadorpartido").val( datos_jugador_partido[linea]['jornada_jugadorpartido'] );

	// ---------------------- Establecer como selected el club rival ---------------------- // 
	$("#idclub_rival").empty();
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
            'tipo_consulta': 'get_clubes_from_paiscampeonato', // <---- Consultando clubes según el país del campeonato seleccionado.
            'pais_campeonato': datos_jugador_partido[linea]['pais_campeonato']   
		},success: function(respuesta){

			$("#idclub_rival").append('<option value="">Seleccione</option>');
			for(var i=0; i < respuesta.length; i++) {   
				$("#idclub_rival").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
			}
			$("#idclub_rival").append('<option value="000">Otro</option>');

			$("#idclub_rival option").each(function(){
				let thisElement = $(this);
				let thisValue = $(this).val();
				if( thisValue == datos_jugador_partido[linea]['idclub_rival'] ) {
					thisElement.prop("selected", true);
				}
			});

			
		},error: function(){// will fire when timeout is reached
			console.log('Error al consultar clubes para el select de clubes rival (partidos de jugador)');
		}, timeout: 15000 // sets timeout to 3 seconds
	});	

	$("#posicion_jugadorpartido option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['posicion_jugadorpartido'] ) {
			thisElement.prop("selected", true);
		}
	});	

	$("#tit_sup_nc_jugadorpartido option").each(function(){
		let thisElement = $(this);
		let thisValue = $(this).val();
		if( thisValue == datos_jugador_partido[linea]['tit_sup_nc_jugadorpartido'] ) {
			thisElement.prop("selected", true);
		}
	});

	$("#gol_equipo1_jugadorpartido").val( datos_jugador_partido[linea]['gol_equipo1_jugadorpartido'] );
	$("#gol_equipo2_jugadorpartido").val( datos_jugador_partido[linea]['gol_equipo2_jugadorpartido'] );

    switch( datos_jugador_partido[linea]['condicion_jugadorpartido'] ) {
        case "1": // <---- Local.
            $("#condicion_local_jugadorpartido").prop('checked', true);
            break;
        case "2": // <---- Visitante.
            $("#condicion_visita_jugadorpartido").prop('checked', true);
            break;     
        case "3": // <---- Neutral.
            $("#condicion_neutral_jugadorpartido").prop('checked', true);
            break;                                                                  
    }

	$('#t_amarilla_jugadorpartido').val( datos_jugador_partido[linea]['t_amarilla_jugadorpartido'] );
	$('#t_amarilladb_jugadorpartido').val( datos_jugador_partido[linea]['t_amarilladb_jugadorpartido'] );
	$('#t_roja_jugadorpartido').val( datos_jugador_partido[linea]['t_roja_jugadorpartido'] );
	$('#num_gol_jugadorpartido').val( datos_jugador_partido[linea]['num_gol_jugadorpartido'] );
	$('#min_entrada_jugadorpartido').val( datos_jugador_partido[linea]['min_entrada_jugadorpartido'] );
	$('#min_salida_jugadorpartido').val( datos_jugador_partido[linea]['min_salida_jugadorpartido'] );
	$('#min_jugados_jugadorpartido_text').html( datos_jugador_partido[linea]['min_jugados_jugadorpartido'] + ' minutos' );
	$('#min_jugados_jugadorpartido').val( datos_jugador_partido[linea]['min_jugados_jugadorpartido'] );

	chequear_datos_form_partidojugador(); // <---- Validando campos del formulario id="formulario_partido_jugador"
	$('.campo-club-jugadorenclub-otro').hide(); // <--- Esconder (Añadido el 18-05-2020 a las 12:47)
    $('.campo-campeonato-otro').hide(); // <--- Importante - Agregado el 18-05-2020
    $('.campo-club-rival-otro').hide(); // <--- Importante - Agregado el 18-05-2020
}
// -------------------------- Fin de la función 'boton_editar_form_partido( linea, vista_modal_partido )' - EDITAR (UPDATE) --------------------------- //


// -------------------------- Inicio de la función 'boton_agregar_scouting()' --------------------------- //
function boton_agregar_scouting() {
	
	$('#modal-detalle-jugador').modal('hide');
	/*
	$('#jugadores_pozo_comun').hide(500);
	$('#cuadro_modulo_scouting_main').show(500);	
	*/
}
// -------------------------- Fin de la función 'boton_agregar_scouting()' --------------------------- //

// -------------------------- Inicio de la función 'ir_scouting_jugadores()' --------------------------- //
function ir_scouting_jugadores() {
	$('#cuadro_modulo_scouting_main').hide(500);
	$('#cuadro_jugadores_seguimiento').show(500);	
}
// -------------------------- Fin de la función 'ir_scouting_jugadores()' --------------------------- //

// -------------------------- Inicio de la función 'ir_scouting_entrenadores()' --------------------------- //
function ir_scouting_entrenadores() {
	$('#cuadro_modulo_scouting_main').hide(500);
	$('#cuadro_jugadores_seguimiento').show(500);	
}
// -------------------------- Fin de la función 'ir_scouting_entrenadores()' --------------------------- //

// -------------------------- Inicio de la función 'btnver_informes_seguimiento_jugador()' - SELECT --------------------------- //
function btnver_informes_seguimiento_jugador( linea ){
	$('#cuadro_jugadores_seguimiento').hide(500);
	$('#cuadro_informes_seguimiento_jugador').show(500);	
}
// -------------------------- Fin de la función 'btnver_informes_seguimiento_jugador()' - SELECT --------------------------- //

	
// ----------------- Inicio de la función 'boton_guardar_ficha_jugador()' ----------------- // 
function boton_guardar_ficha_jugador(){
	if (window.idfichaJugador != "" ) {
		$('#mensaje_agregar_ficha_jugador').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
	}else{
		$('#mensaje_agregar_ficha_jugador').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
	}
	$('#modal_formulario_ficha_jugador').modal('show');
	$('.boton_modal').css('display','');
}
// ----------------- Fin de la función 'boton_guardar_ficha_jugador()' ----------------- //

// ----------------- Inicio de la función 'guardar_ficha_jugador()' ----------------- //
function guardar_ficha_jugador(){
	$('.boton_modal').css('display','none');

	if(window.idfichaJugador_club!=""){
		$('#mensaje_agregar_ficha_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
		$('#mensaje_agregar_ficha_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
	}

	// var data = $('#formulario_ficha_jugador').serializeArray();
	var data = new FormData( $('#formulario_ficha_jugador')[0] );

	data.append('idfichaJugador', window.idfichaJugador);
	data.append('idfichaJugador_club', window.idfichaJugador_club);
	data.append('nombre_usuario_software', '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>');

	$.ajax({
		url: "post/scouting_busqueda_guardar_fichajugador.php",
		type: "post",
            contentType:false,
            data:data,
            processData:false,
            cache:false,
		success: function(respuesta){
			// alert(respuesta);
			if(respuesta==1){
				$('#mensaje_agregar_ficha_jugador').html('<h4>Registro ingresado correctamente!</h4>');

				$("#cuadro_form_agregar_jugador").hide(500);
				if( window.estatus_vista_form === 1 ) { // Ingresó al formulario desde la vista de un determinado club. 
					ver_jugadores_club_selected( 1 );				
					$('#cuadro_jugadores_club_selected').show(500);	
				} else { // Ingresó al formulario desde la vista de jugadores del pozo común.
					buscar_jugadores_pozo_comun( 1 );
					$('#jugadores_pozo_comun').show(500);
				}

				$('#modal_formulario_ficha_jugador').modal('hide');
				cambiar_color_contenedor(); // <----- Cambiando el color del contenedor.
				buscar_clubes_todos(); // <---- Consultando todos los clubes para los selects.

			}else if(respuesta==2){
				$('#mensaje_agregar_ficha_jugador').html('<h4>Registro editado correctamente!</h4>');

				$("#cuadro_form_agregar_jugador").hide(500);
				if( window.estatus_vista_form === 1 ) { // Ingresó al formulario desde la vista de un determinado club. 
					ver_jugadores_club_selected( 1 );				
					$('#cuadro_jugadores_club_selected').show(500);	
				} else { // Ingresó al formulario desde la vista de jugadores del pozo común.
					buscar_jugadores_pozo_comun( 1 );
					$('#jugadores_pozo_comun').show(500);
				}

				$('#modal_formulario_ficha_jugador').modal('hide');
				cambiar_color_contenedor(); // <----- Cambiando el color del contenedor.
				buscar_clubes_todos(); // <---- Consultando todos los clubes para los selects.
			}
			else{ // respuesta==4
				$('#mensaje_agregar_ficha_jugador').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
			}
			
		},error: function(){// will fire when timeout is reached
		   $('#mensaje_agregar_ficha_jugador').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
		}, timeout: 15000 // sets timeout to 3 seconds
	}); 

	// Reiniciando selects de ambas vistas:
	// Código agregado el 17-05-2020 a las 17:27:
	$('#jugadores_pozo_comun select').each(function() {
		let thisElement = $(this);
		thisElement.prop('selectedIndex', 0);
	});

	// Código agregado el 17-05-2020 a las 17:27:
	$('#cuadro_jugadores_club_selected select').each(function() {
		let thisElement = $(this);
		thisElement.prop('selectedIndex', 0);
	});						
}
// ----------------- Fin de la función 'guardar_ficha_jugador()' ----------------- //


// ------------------------------------------ Inicio de la función 'boton_eliminar_jugador( linea )' ------------------------------------------ // 
function boton_eliminar_jugador( linea ) {
	window.idfichaJugador= datos_jugador_club[linea]['idfichaJugador'];
	// alert( datos_jugador_club[linea]['idfichaJugador'] );
	$('#modal_eliminar_jugador').modal('show');
	$('#mensaje_eliminar_jugador').html('<h5>¿Estás seguro que quieres eliminar este jugador?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
	$('.boton_modal').show();
}
// ------------------------------------------ Fin de la función 'boton_eliminar_jugador( linea )' ------------------------------------------ //

// ------------------------------------------ Inicio de la función 'eliminar_jugador()' ------------------------------------------ //
function eliminar_jugador() {
	//alert( window.idfichaJugador );

	 $('.boton_modal').hide();
	 $('#mensaje_eliminar_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando jugador...</h5><br><img src="../config/remover_archivo.png">');
	 $.ajax({
		url: "post/scouting_busqueda_eliminar_fichajugador.php",
		type: "post",
		data: {
			'idfichaJugador': window.idfichaJugador
		},success: function(respuesta) {
			if(respuesta==1){//eliminado correctamente
				$('#mensaje_eliminar_jugador').html('<h5>Jugador eliminado correctamente!</h5>');
				
				// alert( window.estatus_vista_form );
				if( window.estatus_vista_form === 1 ) { // Ingresó al formulario desde la vista de un determinado club. 
					ver_jugadores_club_selected( 1 );
				} else { // Ingresó al formulario desde la vista de jugadores del pozo común.
					buscar_jugadores_pozo_comun( 1 );
				}				
				$('#modal_eliminar_jugador').modal('hide');
			}else{
				$('#mensaje_eliminar_jugador').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
			}
			// $('#modal_eliminar_jugador').modal('hide');
		},error: function(){// will fire when timeout is reached
			$('#mensaje_eliminar_jugador').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
		}, timeout: 10000 // sets timeout to 3 seconds
	  });     
}
// ------------------------------------------ Fin de la función 'eliminar_jugador()' ------------------------------------------ //

// ----------------- Inicio de la función 'boton_guardar_partido()' ----------------- // 
function boton_guardar_partido(){

	// alert( "idfichaJugador_partido: " + window.idfichaJugador_partido );
	
	if (window.idfichaJugador_partido != "" ) {
		$('#mensaje_agregar_partido_jugador').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
	}else{
		$('#mensaje_agregar_partido_jugador').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
	}
	$('#modal_formulario_guardar_partido_jugador').modal('show');
	$('.boton_modal').css('display','');
}
// ----------------- Fin de la función 'boton_guardar_partido()' ----------------- //

// ----------------- Inicio de la función 'guardar_partido_jugador()' ----------------- //
function guardar_partido_jugador(){
	$('.boton_modal').css('display','none');

	if(window.idfichaJugador_partido!=""){
		$('#mensaje_agregar_partido_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
		$('#mensaje_agregar_partido_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
	}

	// var data = $('#formulario_partido_jugador').serializeArray();
	var data = new FormData( $('#formulario_partido_jugador')[0] );

	data.append('idfichaJugador_club', window.idfichaJugador_club);
	data.append('idfichaJugador_partido', window.idfichaJugador_partido);
	data.append('nombre_usuario_software', '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>');

	// alert(JSON.stringify(data));
	$.ajax({
		url: "post/scouting_busqueda_guardar_partidojugador.php",
		type: "post",
            contentType:false,
            data:data,
            processData:false,
            cache:false,
		success: function(respuesta){
			// alert(respuesta);
			if(respuesta==1){

				$('#mensaje_agregar_partido_jugador').html('<h4>Registro ingresado correctamente!</h4>');
				buscar_partidos_jugador(); // <---- Consultando los partidos del jugador
				$('#modal_formulario_guardar_partido_jugador').modal('hide');
				$('#formulario_partido_jugador')[0].reset(); // <--- Vaciando formulario.
				
				// Escondiendo los inputs de otro campeonato y club:
				$('.campo-campeonato-otro').hide();
				$('.campo-club-rival-otro').hide();					

				window.idfichaJugador_partido = ''; // <--- Vaciando la variable en caso de que el usuario quiera registrar otro partido (para que pueda ejecutarse el INSERT)
				$('#formulario_partido_jugador').hide(); // <--- Escondiendo formulario de partido de jugador.


			}else if(respuesta==2){

				$('#mensaje_agregar_partido_jugador').html('<h4>Registro editado correctamente!</h4>');
				buscar_partidos_jugador(); // <---- Consultando los partidos del jugador
				$('#modal_formulario_guardar_partido_jugador').modal('hide');
				$('#formulario_partido_jugador')[0].reset(); // <--- Vaciando formulario.
				
				// Escondiendo los inputs de otro campeonato y club:
				$('.campo-campeonato-otro').hide();
				$('.campo-club-rival-otro').hide();					

				window.idfichaJugador_partido = ''; // <--- Vaciando la variable en caso de que el usuario quiera registrar otro partido (para que pueda ejecutarse el INSERT)
				$('#formulario_partido_jugador').hide(); // <--- Escondiendo formulario de partido de jugador.

			}
			else{ // respuesta==4
				$('#mensaje_agregar_partido_jugador').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
			}
			
		},error: function(){// will fire when timeout is reached
		   $('#mensaje_agregar_partido_jugador').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
		}, timeout: 15000 // sets timeout to 3 seconds
	}); 
}
// ----------------- Fin de la función 'guardar_partido_jugador()' ----------------- //

// ------------------------------------------ Inicio de la función 'boton_eliminar_partido( linea )' ------------------------------------------ // 
function boton_eliminar_partido( linea ) {
	
	window.idfichaJugador_club = datos_jugador_partido[linea]['idfichaJugador_club'];
	window.idfichaJugador_partido = datos_jugador_partido[linea]['idfichaJugador_partido'];
	
	// alert( datos_jugador_partido[linea]['idfichaJugador_partido'] );

	$('#modal-detalle-jugador').modal('hide'); // <--- Ocultando la venta modal del jugador por si se el usuario ha decidido eliminar desde la ventana modal.

	// alert( datos_partido_club[linea]['idfichaJugador_partido']; );
	$('#modal_eliminar_partido').modal('show');
	$('#mensaje_eliminar_partido').html('<h5>¿Estás seguro que quieres eliminar este partido?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
	$('.boton_modal').show();

}
// ------------------------------------------ Fin de la función 'boton_eliminar_partido( linea )' ------------------------------------------ //

// ------------------------------------------ Inicio de la función 'eliminar_partido()' ------------------------------------------ //
function eliminar_partido() {
	//alert( window.idfichaJugador_partido );

	 $('.boton_modal').hide();
	 $('#mensaje_eliminar_partido').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando partido...</h5><br><img src="../config/remover_archivo.png">');
	 $.ajax({
		url: "post/scouting_busqueda_eliminar_partidojugador.php",
		type: "post",
		data: {
			'idfichaJugador_partido': window.idfichaJugador_partido
		},success: function(respuesta) {
			if(respuesta==1){//eliminado correctamente
				$('#mensaje_eliminar_partido').html('<h5>Partido eliminado correctamente!</h5>');

				$('#modal_eliminar_partido').modal('hide');
				$('#modal-detalle-jugador').modal('hide'); // <--- Ocultando la venta modal del jugador por si se el usuario ha decidido eliminar desde la ventana modal.

				buscar_partidos_jugador(); // <---- Consultando los partidos del jugador
				buscar_partidos_jugador_porcampeonato(); // <---- Consultando los partidos por campeonato del jugador

				$('#formulario_partido_jugador')[0].reset(); // <---- Vaciando formulario.
				$('#formulario_partido_jugador').hide(); // <---- Escondiendo formulario.
				// Escondiendo los inputs de otro campeonato y club:
				$('.campo-campeonato-otro').hide();
				$('.campo-club-rival-otro').hide();				

				window.idfichaJugador_partido = ''; // <--- Vaciando la variable en caso de que el usuario quiera registrar otro partido (para que pueda ejecutarse el INSERT)				

			}else{
				$('#mensaje_eliminar_partido').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
			}
			// $('#modal_eliminar_partido').modal('hide');
		},error: function(){// will fire when timeout is reached
			$('#mensaje_eliminar_partido').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
		}, timeout: 10000 // sets timeout to 3 seconds
	  });     
}
// ------------------------------------------ Fin de la función 'eliminar_partido()' ------------------------------------------ //

// ----------------- Inicio de la función 'guardar_scouting()' ----------------- //
function boton_guardar_scouting(){
	// alert( idfichaJugador_club );
    $('#mensaje_agregar_scouting').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">')
    
    $('#modal-detalle-jugador').modal('hide');
    $('#modal_guardar_scouting').modal('show');
    $('.boton_modal').css('display','');
}
// ----------------- Fin de la función 'guardar_scouting()' ----------------- //

// ----------------- Inicio de la función 'boton_cerrar_confirm_scouting()' ----------------- //
function boton_cerrar_confirm_scouting(){
    $('#modal_guardar_scouting').modal('hide');
    $('#modal-detalle-jugador').modal('show');
}
// ----------------- Fin de la función 'boton_cerrar_confirm_scouting()' ----------------- //

// ----------------- Inicio de la función 'guardar_scouting()' ----------------- //
function guardar_scouting(){
	$('.boton_modal').css('display','none');

	$('#mensaje_agregar_scouting').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
 
	var data = {
		'idfichaJugador_club': window.idfichaJugador_club,
		'nombre_usuario_software': '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'
	}

	$.ajax({
		url: "post/scouting_busqueda_guardar_scouting.php",
      	type: "post",
        data: data,
        dataType: 'json',
        cache: false,
		success: function(respuesta){
			// alert(respuesta);
			if(respuesta==1){
				$('#mensaje_agregar_scouting').html('<h4>Registro ingresado correctamente!</h4>');
				if( window.estatus_vista_form === 1 ) { // Ingresó al formulario desde la vista de un determinado club. 
					ver_jugadores_club_selected( 1 );						
				} else { // Ingresó al formulario desde la vista de jugadores del pozo común.
					buscar_jugadores_pozo_comun( 1 );
				}

				$('#modal_guardar_scouting').modal('hide');
				$('#modal-detalle-jugador').modal('hide');

			} else{ // respuesta==4
				$('#mensaje_agregar_scouting').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
			}
			
		},error: function(){// will fire when timeout is reached
		   $('#mensaje_agregar_scouting').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
		}, timeout: 15000 // sets timeout to 3 seconds
	}); 
}
// ----------------- Fin de la función 'guardar_scouting()' ----------------- //

/*
cuadro_listado_series
jugadores_pozo_comun
cuadro_perfil_jugador_selected
cuadro_form_agregar_jugador
*/

// -------------------- Inicio de la función 'buscar_club_pais()' ------------------------- //
function buscar_club_pais() {

	// Filtros de búsqueda:
	var tipo_pais = $('.input-filtro-tipo-pais').val();
	var pais_club;
	var division_club;

	if( tipo_pais == '1' ) {
		pais_club = $('.input-filtro-pais_club').val();
		division_club = $('#division_idpais_main_filtro').val();
	} else {
		pais_club = $('#idpais_otros_filtro').val();
		division_club = $('#division_idpais_otros_filtro').val();
	}

	// alert( pais_club );

	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 1, // <---- Consultando clubes del país seleccionado (los mostrados en la vista principal).
			'tipo_pais': tipo_pais,
			'pais_club': pais_club,
			'division_club': division_club      
		},
		success: function(respuesta)  {

			if(respuesta== ""){ //jugador sin informes
				$("#tabla_club_pais_selected tbody").empty();
				var markup = '<tr class="panel_buscar" id="informe_"><td colspan="10"><b>No se encontraron clubes según el país seleccionado</b></td></tr>';
				$("#tabla_club_pais_selected tbody").append(markup);
				$('#cargando_buscar_club_pais').hide();
				$('#sin_resultados_club_pais').show();
				$('#boton_refresh_club_pais').hide();
				// $('#boton_agregar_ficha_jugador').prop("disabled", true);
			}else{              
				// console.log( array_divisiones[pais_club][1][1] );
				window.datos_jugador_club = respuesta; //se copian todos los profesores al cache
				$("#tabla_club_pais_selected tbody").empty();

				var count = 1;
				for(var i=0; i < respuesta.length; i++){
					let idclub = parseInt( respuesta[i]['idclub'] );
					let pais_club = respuesta[i]['pais_club'];
					let division_club = parseInt( respuesta[i]['division_club'] );
					let nombre_club = respuesta[i]['nombre_club'];                              
					let entrenador_club = respuesta[i]['entrenador_club'];

					let foto_club = './foto_clubes/'+idclub+'.png?lala='+new Date()+'';

					let cantidad_total_jugadores = respuesta[i]['cantidad_total_jugadores'];
					let media_edad = respuesta[i]['media_edad'];

					// alert( array_divisiones[pais_club][division_club][1] );

					var markup = 
					'<tr class="tr-club" tr-id-club="'+idclub+'" tr-pais-club="'+pais_club+'" tr-division-club="'+division_club+'" tr-nombre-club="'+nombre_club+'" tr-foto-club="'+foto_club+'">\
						<td style="font-weight:bold;">\
							<div class="div-imagen-club-tabla-2"><img class="imagen-club-tabla" src="'+foto_club+'"></div>\
						</td>\
						<td style="text-align: left; max-width: 150px;">\
							<p class="ellipsis-text">\
								'+nombre_club+'\
							</p>\
						</td>\
						<td style="text-align: left;">\
							<div class="div-club-table" style="max-width: 180px;">\
                                <div class="img-next-to-text"><img src="flags/blank.gif" class="flag flag-'+pais_club.toLowerCase()+'" /></div>\
                                <div><p class="ellipsis-text">'+array_divisiones[pais_club][division_club][1]+'</p></div>\
                            </div>\
						</td>\
						<td style="text-align: left;">\
							<b>'+cantidad_total_jugadores+' jugadores</b>\
						</td>\
						<td>\
							<div style="max-width:110px; text-align: left;"><p class="ellipsis-text" style="font-weight: bold;">'+entrenador_club+'</p></div>\
						</td>\
						<td>\
							<b>'+media_edad+' años</b>\
						</td>\
						<td></td>\
					</tr>';

					$("#tabla_club_pais_selected tbody").append(markup);

					count = count + 1;
				}

				$('#boton_refresh_club_pais').hide();
			} 
			$('#cargando_buscar_club_pais').hide();
			$('#error_conexion_club_pais').hide();
			$('#sin_resultados_club_pais').hide();
		
		},
		error: function(){// will fire when timeout is reached
			$('#cargando_buscar_club_pais').hide();
			$('#sin_resultados_club_pais').hide();
			$('#error_conexion_club_pais').show();
			$('#boton_refresh_club_pais').show();
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	
} 
// -------------------- Fin de la función 'buscar_club_pais()' ------------------------- //

// --------------------- Inicio de la función 'buscar_campeonatos_todos()' --------------------- //
function buscar_campeonatos_todos() {

	$(".select-campeonato").empty();

	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'get_all_campeonatos',    
		},success: function(respuesta){

			$(".select-campeonato").append('<option value="">Seleccione</option>');
			for(var i=0; i < respuesta.length; i++) {   
				$(".select-campeonato").append('<option pais-campeonato="'+respuesta[i]['pais_campeonato']+'" value="'+respuesta[i]['idcampeonato']+'">'+respuesta[i]['nombre_campeonato']+'</option>');
			}
			$(".select-campeonato").append('<option value="000">Otro</option>');
			
		},error: function(){// will fire when timeout is reached
			$('#cargando_buscar').hide();
			$('#sin_resultados').hide();
			$('#error_conexion').show();
			$('#boton_editar').hide();
			$('.boton_refresh').show();
		}, timeout: 15000 // sets timeout to 3 seconds
	});    	
}
// --------------------- Fin de la función 'buscar_campeonatos_todos()' --------------------- //

// --------------------- Inicio de la función 'buscar_clubes_todos()' --------------------- //
function buscar_clubes_todos() {

	// Vaciando selects:
	$(".select-club").empty();
	$(".select-club-filtro-busqueda").empty();
	
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: {
			'tipo_consulta': 'get_all_clubes',    
		},success: function(respuesta){

			// Para los formularios (la primera opción es 'Seleccione')
			$(".select-club").append('<option value="">Seleccione</option>');
			for(var i=0; i < respuesta.length; i++) {   
				$(".select-club").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
			}
			$(".select-club").append('<option value="000">Otro</option>');

			// Para los filtros de búsqueda (la primera opción es 'Todos')
			$(".select-club-filtro-busqueda").append('<option value="">Todos</option>');
			for(var i=0; i < respuesta.length; i++) {   
				$(".select-club-filtro-busqueda").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
			}			
			
		},error: function(){// will fire when timeout is reached
			$('#cargando_buscar').hide();
			$('#sin_resultados').hide();
			$('#error_conexion').show();
			$('#boton_editar').hide();
			$('.boton_refresh').show();
		}, timeout: 15000 // sets timeout to 3 seconds
	});    	
}
// --------------------- Fin de la función 'buscar_clubes_todos()' --------------------- //

// --------------- Inicio de la función 'buscar_jugadores_pozo_comun()' --------------- //
function buscar_jugadores_pozo_comun( query ) {

	$('#error_conexion_pozo_comun').hide();
	$('#sin_resultados_pozo_comun').hide();
	$('#cargando_buscar_pozo_comun').show();
	$("#tabla_jugadores_pozo_comun tbody").empty(); // <--- Vaciando tabla.					

	let data;
	if( query === 1 ) {
		
		data = {
			'tipo_consulta': 'edad_altura_minmax_pozocomun'
		}

	} else {

		let estadoclub_jugador_pzcomun = $('#estadoclub-jugador-pzcomun').val();
		let nacionalidad_jugador_pzcomun = $('#nacionalidad-jugador-pzcomun').val();
		let paisclub_jugador_pzcomun = $('#paisclub-jugador-pzcomun').val();
		let divisionclub_jugador_pzcomun = $('#divisionclub-jugador-pzcomun').val();
		let club_jugador_pzcomun = $('#club-jugador-pzcomun').val();
		let range_edad_min_pzcomun = $('#range-edad-min-pzcomun').val();
		let range_edad_max_pzcomun = $('#range-edad-max-pzcomun').val();
		let altura_min_pzcomun = $('#altura-min-pzcomun').val();
		let altura_max_pzcomun = $('#altura-max-pzcomun').val();
		let posicion_jugador_pzcomun = $('#posicion-jugador-pzcomun').val();
		data = {
			'tipo_consulta': 'jugadores_pozo_comun',
			'estadoclub_jugador_pzcomun': estadoclub_jugador_pzcomun,
			'nacionalidad_jugador_pzcomun': nacionalidad_jugador_pzcomun,
			'paisclub_jugador_pzcomun': paisclub_jugador_pzcomun,
			'divisionclub_jugador_pzcomun': divisionclub_jugador_pzcomun,
			'club_jugador_pzcomun': club_jugador_pzcomun,
			'range_edad_min_pzcomun': range_edad_min_pzcomun,
			'range_edad_max_pzcomun': range_edad_max_pzcomun,
			'altura_min_pzcomun': altura_min_pzcomun,
			'altura_max_pzcomun': altura_max_pzcomun,
			'posicion_jugador_pzcomun': posicion_jugador_pzcomun,
		}		
	}

	// ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
	$.ajax({
		url: "post/scouting_busqueda_ver.php",
		type: "post",
		dataType: 'json',
		cache: false,
		data: data,
		success: function(respuesta)  {

			if(respuesta== ""){ //jugador sin informes
				$("#tabla_jugadores_pozo_comun tbody").empty();
				var markup = '<tr class="panel_buscar" id="informe_"><td colspan="9"><b>No se encontraron jugadores</b></td></tr>';
				$("#tabla_jugadores_pozo_comun tbody").append(markup);
				$('#cargando_buscar_pozo_comun').hide();
				$('#sin_resultados_pozo_comun').show();
				$('#boton_refresh_pozo_comun').hide();
				// $('#boton_agregar_ficha_jugador').prop("disabled", true);
			}else{              
				window.datos_jugador_club = respuesta; //se copian todos los profesores al cache
				$("#tabla_jugadores_pozo_comun tbody").empty();
   				
   				if( query === 1 ) {
					let min_edad = respuesta[0]['min_edad'];
					let max_edad = respuesta[0]['max_edad'];

					let min_altura = respuesta[0]['min_altura'];
					let max_altura = respuesta[0]['max_altura'];						

					console.log( 'Edad mínima: ' + min_edad );
					console.log( 'Edad máxima: ' + max_edad );

					console.log( 'Altura mínima: ' + min_altura );
					console.log( 'Altura máxima: ' + max_altura );						

					// --------------- Range para la edad ---------------  //
					$('.mr-edad-pozo-comun').attr('data-lbound', min_edad);
					$('.mr-edad-pozo-comun').attr('data-ubound', max_edad);
					
					$('#range-edad-min-pzcomun').attr('min', min_edad);
					$('#range-edad-min-pzcomun').attr('max', max_edad);
					$('#range-edad-min-pzcomun').attr('value', min_edad);

					$('#range-edad-max-pzcomun').attr('min', min_edad);
					$('#range-edad-max-pzcomun').attr('max', max_edad);
					$('#range-edad-max-pzcomun').attr('value', max_edad);

					// --------------- Range para la altura ---------------  //
					$('.mr-altura-pozo-comun').attr('data-lbound', min_altura);
					$('.mr-altura-pozo-comun').attr('data-ubound', max_altura);
					
					$('#altura-min-pzcomun').attr('min', min_altura);
					$('#altura-min-pzcomun').attr('max', max_altura);
					$('#altura-min-pzcomun').attr('value', min_altura);

					$('#altura-max-pzcomun').attr('min', min_altura);
					$('#altura-max-pzcomun').attr('max', max_altura);
					$('#altura-max-pzcomun').attr('value', max_altura);
   				} 


				var count = 1;
				for(var i=0; i < respuesta.length; i++){

					let idfichaJugador = respuesta[i]['idfichaJugador'];

					// Datos del Club:
					let idclub = parseInt( respuesta[i]['idclub'] );
					let division_club = parseInt( respuesta[i]['division_club'] );
					
					let nombre_club;
					if( respuesta[i]['nombre_club'] === null || respuesta[i]['nombre_club'] == '' ) {
						nombre_club = 'No especificado';
					} else {	
						nombre_club = respuesta[i]['nombre_club'];
					}                             
					
					let entrenador_club = respuesta[i]['entrenador_club'];
					
					let foto_club = './foto_clubes/'+idclub+'.png?lala='+new Date()+'';

					let cantidad_total_jugadores = respuesta[i]['cantidad_total_jugadores'];
					let media_edad = respuesta[i]['media_edad'];

					// Datos del Jugador:
					let idfichaJugador_club = parseInt( respuesta[i]['idfichaJugador_club'] );				    
				    if( respuesta[i]['apellido2'] == null ) {
				        respuesta[i]['apellido2'] = "";
				    } 

					let nombre_completo_jugador = respuesta[i]['nombre'] + " " + respuesta[i]['apellido1'] + " " + respuesta[i]['apellido2'];

					let fechaNacimiento;
					if( respuesta[i]['fechaNacimiento'] == '0000-00-00' || respuesta[i]['fechaNacimiento'] == '' || respuesta[i]['fechaNacimiento'] === null ) {
						fechaNacimiento = 'No especificado';
					} else {
						fechaNacimiento = fecha_formato_ddmmaaa( respuesta[i]['fechaNacimiento'] );
					}
					
					let edad;
					if( respuesta[i]['fechaNacimiento'] == '0000-00-00' || respuesta[i]['fechaNacimiento'] == '' || respuesta[i]['fechaNacimiento'] === null ) {
						edad = 'No especificado';
					} else {
						edad = calcularEdad( respuesta[i]['fechaNacimiento'] ) + ' años';
					}

					let codigoNacionalidad1 = respuesta[i]['codigoNacionalidad1'];
					let nacionalidad2 = respuesta[i]['nacionalidad2'];
					let dinamico = respuesta[i]['dinamico'];
					let posicion = respuesta[i]['posicion'];
					
					let foto_jugador = './foto_jugadores_scouting/'+idfichaJugador+'.png?lala='+new Date()+'';

					let fechafin_contrato_jugadorclub = respuesta[i]['fechafin_contrato_jugadorclub'];
					if( fechafin_contrato_jugadorclub === null || fechafin_contrato_jugadorclub == '' || fechafin_contrato_jugadorclub == '0000-00-00' ) {
						fechafin_contrato_jugadorclub = "No tiene";
					}

					let nombre_posicion;
					if( posicion === null || posicion == '' || posicion == '0' || posicion == '999' ) {
						nombre_posicion = 'No especificado';
					} else {
						nombre_posicion = array_posiciones[posicion][1];
					}

					let bandera_nacionalidad;
					if( codigoNacionalidad1 === null || codigoNacionalidad1 == '' || codigoNacionalidad1 == '0' ) {
						bandera_nacionalidad = 'src="img/default.png" class="img-nacionalidad-small"';
					} else {
						bandera_nacionalidad = 'src="flags/blank.gif" class="flag flag-'+respuesta[i]['codigoNacionalidad1'].toLowerCase()+'"';
					}

					let pie_habil;
					if( dinamico === null || dinamico == '' || dinamico == '0' ) {
						pie_habil = 'No especificado';
					} else {
						pie_habil = array_lateralidad[dinamico][1];
					}

					var markup = 
					'<tr class="panel_buscar">\
						<td onclick="boton_ver_jugador_modal('+i+');" style="text-align: left;">\
                            <div class="div-club-table" style="text-align: left;">\
                                <div class="img-next-to-text" style="width: 15%;"><img src="'+foto_jugador+'" class="imagen-club-tabla"></div>\
                                <div style="max-width: 200px;"><p class="ellipsis-text" style="position: relative; left: 7px; top: 7px; text-transform: capitalize;">'+nombre_completo_jugador+'</p></div>\
                            </div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');">\
							<img '+bandera_nacionalidad+'>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');" style="text-align: left;">\
							<div style="max-width:140px;"><p class="ellipsis-text">'+nombre_posicion+'</p></div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');">\
							<div style="max-width: 90px;"><p class="ellipsis-text">'+fechaNacimiento+'</p></div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');">\
							<div style="max-width: 90px;"><p class="ellipsis-text">'+edad+'</p></div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');">\
							<div style="max-width: 90px;"><p class="ellipsis-text">'+pie_habil+'</p></div>\
						</td>\
						<td onclick="boton_ver_jugador_modal('+i+');">\
							<div class="div-club-table" style="text-align: left;">\
								<div class="img-next-to-text"><img class="imagen-club-tabla" style="border: none;" src="'+foto_club+'"></div>\
								<div><p class="ellipsis-text text-club">'+nombre_club+'</p></div>\
							</div>\
						</td>\
                        <td style="padding: 7px; width: 9px;">\
                            <a class="boton_editar" onClick="boton_editar_form_jugador('+i+');">\
                                <i class="icon-pencil"></i>\
                            </a>\
                        </td>\
                        <td style="padding: 7px; width: 9px;">\
                            <a class="boton_eliminar" onClick="boton_eliminar_jugador('+i+');">\
                                <i class="icon-remove"></i>\
                            </a>\
                        </td>\
					</tr>';

					$("#tabla_jugadores_pozo_comun tbody").append(markup);

					count = count + 1;
				}

				$('#boton_refresh_pozo_comun').hide();
			} 
			$('#cargando_buscar_pozo_comun').hide();
			$('#error_conexion_pozo_comun').hide();
			$('#sin_resultados_pozo_comun').hide();
		
		},
		error: function(){// will fire when timeout is reached
			$('#cargando_buscar_pozo_comun').hide();
			$('#sin_resultados_pozo_comun').hide();
			$('#error_conexion_pozo_comun').show();
			$('#boton_refresh_pozo_comun').show();
		}, timeout: 15000 // sets timeout to 3 seconds
	});	
	// ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //	
}
// --------------- Fin de la función 'buscar_jugadores_pozo_comun()' --------------- //

// Función que consulta datos según el cuadro principal seleccionado:
$(".cuadro_serie").click(function(){

	// Tipo de cuadro (Países o Jugadores/Entrenadores): 
	let tipo_cuadro = $(this).attr('tipo-cuadro');
	// Tipo de  País (los que aparecen en los cuadros principales o los de la sección 'OTROS'):
	let tipo_pais = $(this).attr('tipo-pais');
	// Número del País:
	let pais_club = $(this).attr('id-pais');
	// Jugador/Entrenador:
	let jugador_entrenador = $(this).attr('jugador-entrenador');
	// Nombre del Tipo de Cuadro:
	let nombre_tipo_cuadro = $(this).attr('nombre-tipo-cuadro');		
	// Foto del Cuadro:
	let foto_cuadro = $(this).attr('foto-cuadro');

	tipo_cuadro = parseInt( tipo_cuadro );
	tipo_pais = parseInt( tipo_pais );
	// pais_club = parseInt( pais_club );

	// Inputs para filtros de búsqueda:
	$('.input-filtro-tipo-pais').val( tipo_pais );
	$('.input-filtro-pais_club').val( pais_club );
  
	$('#cuadro_listado_series').hide(500); // <---- Siempre será este cuandro el que desaparezca al dar click.

	let class_tabla_pais_club_remove;
	let class_tabla_pais_club_add;

	let class_img_pais_remove;
	let class_img_pais_add;
	
	switch( tipo_cuadro ) {

		// ------ Jugadores en clubes de países mostrados en la vista principal y de otros países (no mostrados en la vista principal) ------ //
		case 1:
		case 2:
			window.estatus_vista_form = 1; // <----- Valor de la variable si se selecciona vista de jugadores que ACTUALMENTE PERTENECEN A UN CLUB.
			// alert( tipo_cuadro );
				
			if( tipo_cuadro == '1' ) {
				class_tabla_pais_club_remove = 'tabla-pais-otros';
				class_tabla_pais_club_add = 'tabla-pais-principal';
				// ------------
				class_img_pais_remove = 'img-pais-otros';
				class_img_pais_add = 'img-pais-principal';
			} else {
				class_tabla_pais_club_remove = 'tabla-pais-principal';
				class_tabla_pais_club_add = 'tabla-pais-otros';				
				// ------------
				class_img_pais_remove = 'img-pais-principal';
				class_img_pais_add = 'img-pais-otros';
			}

			// Agregando foto de país seleccionado:
			$(".foto-pais-clubpais").attr( "src", '../config/' + foto_cuadro ).removeClass( class_img_pais_remove ).addClass( class_img_pais_add );

			$('#tabla-pais-club').removeClass( class_tabla_pais_club_remove ).addClass( class_tabla_pais_club_add );

			// Agregando nombre de país seleccionado:
			$(".nombre-pais-clubpais-tipo1").html( nombre_tipo_cuadro );
			// Mostrando el cuadro:
			$('#club_pais_selected').show(500);

			// Vaciando selects:
			$('#division_idpais_main_filtro').empty();
			$('#division_idpais_otros_filtro').empty();
			$("#tabla_club_pais_selected tbody").empty();

			var division_club_element;
			// alert( tipo_pais );
			if( tipo_pais == '1' ) {
				$('.filtros-pais-otros').hide();
				$('.filtros-pais-principales').show();	
				division_club_element = $('#division_idpais_main_filtro');
			} else {
				$('.filtros-pais-principales').hide();
				$('.filtros-pais-otros').show();		
				division_club_element = $('#division_idpais_otros_filtro');				
			}

			let divisiones_pais_selected = array_divisiones[pais_club];
			console.log( divisiones_pais_selected );
			if( typeof divisiones_pais_selected !== 'undefined' ) {

				let pais_club_value;
				let division_club_value;
				divisiones_pais_selected = divisiones_pais_selected.filter(function(){return true;}); // Reiniciando el valor de los índices de 0 a n.
				division_club_element.append('<option value="0">Todos</option>');
				for (var i = 0; i < divisiones_pais_selected.length; i++) {
				    division_club_element.append('<option value="'+divisiones_pais_selected[i][0]+'">'+divisiones_pais_selected[i][1]+'</option>');
				}

				buscar_club_pais();

			} else {
				division_club_element.append('<option value="">Seleccione un país</option>');
				buscar_club_pais();
			}

			
			break;
		// ------ Jugadores en clubes de países mostrados en la vista principal ------ //
		case 3:
			window.estatus_vista_form = 2; // <----- Valor de la variable si se selecciona vista de jugadores del POZO COMÚN.
			$('#jugadores_pozo_comun').show(500);
			buscar_jugadores_pozo_comun( 1 );
			break;						
	}

	buscar_clubes_todos(); // Consultando todos los clubes para los selects.
	cambiar_color_contenedor(); // <----- Cambiando el color del contenedor.

	// Reiniciando selects de ambas vistas:
	// Código agregado el 17-05-2020 a las 17:27:
	$('#jugadores_pozo_comun select').each(function() {
		let thisElement = $(this);
		thisElement.prop('selectedIndex', 0);
	});

	// Código agregado el 17-05-2020 a las 17:27:
	$('#cuadro_jugadores_club_selected select').each(function() {
		let thisElement = $(this);
		thisElement.prop('selectedIndex', 0);
	});			

});

function boton_volver_cuadro_listado_series() {
	$('#club_pais_selected').hide(500);
	$('#jugadores_pozo_comun').hide(500);
	$('#cuadro_listado_series').show(500);
	get_cantidad_registros_main();
	// $("#tabla_verEjercicios tbody").empty();
}

function btnvolver_clubpais_tipo1_selected() {
	$('#cuadro_jugadores_club_selected').hide(500);
	$('#club_pais_selected').show(500);
	buscar_club_pais();
}

function boton_volver_cuadro_scouting() {
	$('#cuadro_jugadores_seguimiento').hide(500);
	$('#cuadro_modulo_scouting_main').show(500);
}

function boton_volver_cuadro_jugadores_seguimiento() {
	$('#cuadro_informes_seguimiento_jugador').hide(500);
	$('#cuadro_jugadores_seguimiento').show(500);
}

function boton_volver_cuadro_busqueda() {
	$('#cuadro_modulo_scouting_main').hide(500);
	$('#cuadro_listado_series').show(500);
}

function bntvolver_desde_form_jugador() {
	if( window.estatus_vista_form === 1 ) {
		ver_jugadores_club_selected( 1 ); // <--- Consultando datos de jugadores de un determinado club.
		$('#cuadro_form_agregar_jugador').hide(500);		
		$('#cuadro_jugadores_club_selected').show(500);
	} else {
		buscar_jugadores_pozo_comun( 1 ); // <--- Consultando datos de jugadores del pozo común.
		$('#cuadro_form_agregar_jugador').hide(500);
		$('#jugadores_pozo_comun').show(500);	
	}
	buscar_clubes_todos(); // <---- Consultando todos los clubes para los selects.
	cambiar_color_contenedor(); // <----- Cambiando el color del contenedor.

	// Reiniciando selects de ambas vistas:
	// Código agregado el 17-05-2020 a las 17:27:
	$('#jugadores_pozo_comun select').each(function() {
		let thisElement = $(this);
		thisElement.prop('selectedIndex', 0);
	});

	// Código agregado el 17-05-2020 a las 17:27:
	$('#cuadro_jugadores_club_selected select').each(function() {
		let thisElement = $(this);
		thisElement.prop('selectedIndex', 0);
	});		

}

function boton_volver_perfil_jugador_selected() {
	$("#tabla_ver_perfil_jugador tbody").empty(); // <--- Vaciando tabla.
	$('#cuadro_form_agregar_jugador').hide(500);
	$('#cuadro_perfil_jugador_selected').show(500);
	buscar_visitas_jugador_social(); // <--- Modificación hecha el 28-02-2020.
}


function volver_despues_guardado() {
	$('#cuadro_form_agregar_jugador').hide(500);
	$('#jugadores_pozo_comun').show(500);
}


function volver_despues_eliminacion() {
	buscar_visitas_jugador_social();
}

// ------------------------------ Inicio de la función 'chequear_datos_form_fichajugador()' ------------------------------ // 
function chequear_datos_form_fichajugador(){
	// alert('Estoy validando...');
	// var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
	var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,})?$/;
	var ER_numericosEnteros = /[0-9]/;
	var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
	flag = true;
		
	/*
	#ffc6c6 <--- Color rosado.
	#d4ffdc <--- Color verde.
	*/

	// ---------------------- Datos fichaJugador ---------------------- //

	// ------------------------------------------------------------------------ //
	let foto_jugador = $("#foto_jugador").val();
	var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
	if( foto_jugador != "" ) {
		if( !allowedExtensions.exec(foto_jugador) ) {      
			// alert('Formato inválido para foto');
			flag = false;
		} else {
			// alert('Formato correcto para foto');
		}
	} else {
		// flag = false;
	}
		
	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let nombre = $("#nombre").val();
	if( nombre != "" ) {
		if( nombre.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre.length) >= 1 && parseInt(nombre.length) <= 150 ) ) {      
			$("#nombre").css("background-color", "white");
		} else {
			$("#nombre").css("background-color", "white");
			flag = false;
		}
	} else {
		$("#nombre").css("background-color", "white");
		flag = false;
	}

	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let apellido1 = $("#apellido1").val();
	if( apellido1 != "" ) {
		if( apellido1.match(ER_caracteresAlfaNumericos) && ( parseInt(apellido1.length) >= 1 && parseInt(apellido1.length) <= 150 ) ) {      
			$("#apellido1").css("background-color", "white");
		} else {
			$("#apellido1").css("background-color", "white");
			flag = false;
		}
	} else {
		$("#apellido1").css("background-color", "white");
		flag = false;
	}

	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let apellido2 = $("#apellido2").val();
	if( apellido2 != "" ) {
		if( apellido2.match(ER_caracteresAlfaNumericos) && ( parseInt(apellido2.length) >= 1 && parseInt(apellido2.length) <= 150 ) ) {      
			$("#apellido2").css("background-color", "white");
		} else {
			$("#apellido2").css("background-color", "white");
			flag = false;
		}
	} else {
		$("#apellido2").css("background-color", "white");
		// flag = false;
	}	

	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let fechaNacimiento = $("#fechaNacimiento").val();
	if( fechaNacimiento == "" ) {
		$("#fechaNacimiento").css("background-color", "white");
		// flag = false;
	} else {
		$("#fechaNacimiento").css("background-color", "white");
	}

	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let sexo = $("#sexo").val();
	if( sexo == "" ) {
		$("#sexo").css("background-color", "white");
		// flag = false;
	} else {
		$("#sexo").css("background-color", "white");
	}

	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let altura = $("#altura").val();
	if( altura != "" ) {
		if( altura.match(ER_numericosEnteros) && ( parseInt(altura.length) >= 1 && parseInt(altura.length) <= 3 ) ) {      
			$("#altura").css("background-color", "white");
		} else {
			$("#altura").css("background-color", "white");
			flag = false;
		}
	} else {
		$("#altura").css("background-color", "white");
		// flag = false;
	}			

	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let nacionalidad1 = $("#nacionalidad1").val();
	if( nacionalidad1 == "" ) {
		$("#nacionalidad1").css("background-color", "white");
		// flag = false;
	} else {
		$("#nacionalidad1").css("background-color", "white");
	}

	// ------------------------------------------------------------------------ //
	let nacionalidad2 = $("#nacionalidad2").val();
	if( nacionalidad2 == "" ) {
		$("#nacionalidad2").css("background-color", "white");
		// flag = false;
	} else {
		$("#nacionalidad2").css("background-color", "white");
	}

	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let serieActual = $("#serieActual").val();
	if( serieActual == "" ) {
		$("#serieActual").css("background-color", "white");
		// flag = false;
	} else {
		$("#serieActual").css("background-color", "white");
	}		

	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let dinamico = $("#dinamico").val();
	if( dinamico == "" ) {
		$("#dinamico").css("background-color", "white");
		// flag = false;
	} else {
		$("#dinamico").css("background-color", "white");
	}

	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let posicion0 = $("#posicion0").val();
	if( posicion0 == "" ) {
		$("#posicion0").css("background-color", "white");
		// flag = false;
	} else {
		$("#posicion0").css("background-color", "white");
	}

	// ------------------------------------------------------------------------ //
	let posicion1 = $("#posicion1").val();
	if( posicion1 == "" ) {
		$("#posicion1").css("background-color", "white");
		// flag = false;
	} else {
		$("#posicion1").css("background-color", "white");
	}		

	// ------------------------------------------------------------------------ //
	let posicion2 = $("#posicion2").val();
	if( posicion2 == "" ) {
		$("#posicion2").css("background-color", "white");
		// flag = false;
	} else {
		$("#posicion2").css("background-color", "white");
	}

	// ---------------------- Datos fichaJugador_club ---------------------- //
	// ------------------------------------------------------------------------ //
	// OBLIGATORIO
	let estado_jugadorclub = $("#estado_jugadorclub").val();
	if( estado_jugadorclub == "" ) {
		$("#estado_jugadorclub").css("background-color", "white");
		// flag = false;
	} else {
		$("#estado_jugadorclub").css("background-color", "white");
	}

	// Aplicando validación solamente si el campo es visible:
    if($("#representante_jugadorclub").is(":visible")) {
		// ------------------------------------------------------------------------ //
		let representante_jugadorclub = $("#representante_jugadorclub").val();
		if( representante_jugadorclub != "" ) {
			if( representante_jugadorclub.match(ER_caracteresAlfaNumericos) && ( parseInt(representante_jugadorclub.length) >= 1 && parseInt(representante_jugadorclub.length) <= 150 ) ) {
				$("#representante_jugadorclub").css("background-color", "white");
			} else {
				$("#representante_jugadorclub").css("background-color", "white");
				flag = false;
			}
		} else {
			$("#representante_jugadorclub").css("background-color", "white");
			// flag = false;
		}
    } 	

	// --------------- JUGADOR LIBRE --------------- //
	// ------------------------------------------------------------------------ //

	// Aplicando validación solamente si el campo es visible:
    if($("#idclub_jugadorlibre").is(":visible")) {
    	// alert("El campo es visible.");
		// OBLIGATORIO
		let idclub_jugadorlibre = $("#idclub_jugadorlibre").val();
		if( idclub_jugadorlibre == "" ) {
			$("#idclub_jugadorlibre").css("background-color", "white");
			// flag = false;
		} else {
			$("#idclub_jugadorlibre").css("background-color", "white");
		}	
    } 


	// Datos del último club (otro):
	// ------------------------------------------------------------------------ //

	// Aplicando validación solamente si el campo es visible:
    if($("#pais_club_jugadorlibre_otro").is(":visible")) {
    	// alert("El campo es visible.");
		// OBLIGATORIO
		let pais_club_jugadorlibre_otro = $("#pais_club_jugadorlibre_otro").val();
		if( pais_club_jugadorlibre_otro == "" ) {
			$("#pais_club_jugadorlibre_otro").css("background-color", "white");
			// flag = false;
		} else {
			$("#pais_club_jugadorlibre_otro").css("background-color", "white");
		}	
    } 

	// Aplicando validación solamente si el campo es visible:
    if($("#division_club_jugadorlibre_otro").is(":visible")) {
		// ------------------------------------------------------------------------ //
		// OBLIGATORIO
		let division_club_jugadorlibre_otro = $("#division_club_jugadorlibre_otro").val();
		if( division_club_jugadorlibre_otro == "" ) {
			$("#division_club_jugadorlibre_otro").css("background-color", "white");
			// flag = false;
		} else {
			$("#division_club_jugadorlibre_otro").css("background-color", "white");
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#nombre_club_jugadorlibre_otro").is(":visible")) {
		// ------------------------------------------------------------------------ //
		// OBLIGATORIO
		let nombre_club_jugadorlibre_otro = $("#nombre_club_jugadorlibre_otro").val();
		if( nombre_club_jugadorlibre_otro != "" ) {
			if( nombre_club_jugadorlibre_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_club_jugadorlibre_otro.length) >= 1 && parseInt(nombre_club_jugadorlibre_otro.length) <= 150 ) ) {
				$("#nombre_club_jugadorlibre_otro").css("background-color", "white");
			} else {
				$("#nombre_club_jugadorlibre_otro").css("background-color", "white");
				flag = false;
			}
		} else {
			$("#nombre_club_jugadorlibre_otro").css("background-color", "white");
			// flag = false;
		}
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#entrenador_club_jugadorlibre_otro").is(":visible")) {
		// ------------------------------------------------------------------------ //
		// OBLIGATORIO
		let entrenador_club_jugadorlibre_otro = $("#entrenador_club_jugadorlibre_otro").val();
		if( entrenador_club_jugadorlibre_otro != "" ) {
			if( entrenador_club_jugadorlibre_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(entrenador_club_jugadorlibre_otro.length) >= 1 && parseInt(entrenador_club_jugadorlibre_otro.length) <= 150 ) ) {
				$("#entrenador_club_jugadorlibre_otro").css("background-color", "white");
			} else {
				$("#entrenador_club_jugadorlibre_otro").css("background-color", "white");
				flag = false;
			}
		} else {
			$("#entrenador_club_jugadorlibre_otro").css("background-color", "white");
			// flag = false;
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#idclub_actual_jugadorenclub").is(":visible")) {
		// --------------- JUGADOR EN CLUB --------------- //
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let idclub_actual_jugadorenclub = $("#idclub_actual_jugadorenclub").val();
		if( idclub_actual_jugadorenclub == "" ) {
			$("#idclub_actual_jugadorenclub").css("background-color", "white");
			// flag = false;
		} else {
			$("#idclub_actual_jugadorenclub").css("background-color", "white");
		}  			
    }

    // alert( $("#idclub_actual_jugadorenclub").val() + typeof( $("#idclub_actual_jugadorenclub").val() ) );
    // Datos del club actual (otro):

	// Aplicando validación solamente si el campo es visible:
    if($("#pais_club_jugadorenclub_otro").is(":visible")) {
		// Datos del club actual (otro):
		// ------------------------------------------------------------------------ //
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let pais_club_jugadorenclub_otro = $("#pais_club_jugadorenclub_otro").val();
		if( pais_club_jugadorenclub_otro == "" ) {
			$("#pais_club_jugadorenclub_otro").css("background-color", "white");
			// flag = false;
		} else {
			$("#pais_club_jugadorenclub_otro").css("background-color", "white");
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#division_club_jugadorenclub_otro").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let division_club_jugadorenclub_otro = $("#division_club_jugadorenclub_otro").val();
		if( division_club_jugadorenclub_otro == "" ) {
			$("#division_club_jugadorenclub_otro").css("background-color", "white");
			// flag = false;
		} else {
			$("#division_club_jugadorenclub_otro").css("background-color", "white");
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#nombre_clubenclub_jugadorenclub_otro").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let nombre_clubenclub_jugadorenclub_otro = $("#nombre_clubenclub_jugadorenclub_otro").val();
		if( nombre_clubenclub_jugadorenclub_otro != "" ) {
			if( nombre_clubenclub_jugadorenclub_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_clubenclub_jugadorenclub_otro.length) >= 1 && parseInt(nombre_clubenclub_jugadorenclub_otro.length) <= 150 ) ) {
				$("#nombre_clubenclub_jugadorenclub_otro").css("background-color", "white");
			} else {
				$("#nombre_clubenclub_jugadorenclub_otro").css("background-color", "white");
				flag = false;
			}
		} else {
			$("#nombre_clubenclub_jugadorenclub_otro").css("background-color", "white");
			// flag = false;
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#entrenador_club_jugadorenclub_otro").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let entrenador_club_jugadorenclub_otro = $("#entrenador_club_jugadorenclub_otro").val();
		if( entrenador_club_jugadorenclub_otro != "" ) {
			if( entrenador_club_jugadorenclub_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(entrenador_club_jugadorenclub_otro.length) >= 1 && parseInt(entrenador_club_jugadorenclub_otro.length) <= 150 ) ) {
				$("#entrenador_club_jugadorenclub_otro").css("background-color", "white");
			} else {
				$("#entrenador_club_jugadorenclub_otro").css("background-color", "white");
				flag = false;
			}
		} else {
			$("#entrenador_club_jugadorenclub_otro").css("background-color", "white");
			// flag = false;
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#contrato_pro_jugadorclub").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let contrato_pro_jugadorclub = $("#contrato_pro_jugadorclub").val();
		if( contrato_pro_jugadorclub == "" ) {
			$("#contrato_pro_jugadorclub").css("background-color", "white");
			// flag = false;
		} else {
			$("#contrato_pro_jugadorclub").css("background-color", "white");
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#situ_clubactual_jugadorclub").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let situ_clubactual_jugadorclub = $("#situ_clubactual_jugadorclub").val();
		if( situ_clubactual_jugadorclub == "" ) {
			$("#situ_clubactual_jugadorclub").css("background-color", "white");
			// flag = false;
		} else {
			$("#situ_clubactual_jugadorclub").css("background-color", "white");
			// alert('godd');
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#fechafin_prestamo_jugadorclub").is(":visible")) {
		// Datos de jugador a préstamo:
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let fechafin_prestamo_jugadorclub = $("#fechafin_prestamo_jugadorclub").val();
		if( fechafin_prestamo_jugadorclub == "" ) {
			$("#fechafin_prestamo_jugadorclub").css("background-color", "white");
			// flag = false;
		} else {
			$("#fechafin_prestamo_jugadorclub").css("background-color", "white");
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#pase_pertenencia_jugadorclub").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let pase_pertenencia_jugadorclub = $("#pase_pertenencia_jugadorclub").val();
		if( pase_pertenencia_jugadorclub != "" ) {
			if( pase_pertenencia_jugadorclub.match(ER_caracteresAlfaNumericos) && ( parseInt(pase_pertenencia_jugadorclub.length) >= 1 && parseInt(pase_pertenencia_jugadorclub.length) <= 150 ) ) {
				$("#pase_pertenencia_jugadorclub").css("background-color", "white");
			} else {
				$("#pase_pertenencia_jugadorclub").css("background-color", "white");
				flag = false;
			}
		} else {
			$("#pase_pertenencia_jugadorclub").css("background-color", "white");
			// flag = false;
		}
    }   

	// Aplicando validación solamente si el campo es visible:
    if($("#fechafin_contrato_jugadorclub").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let fechafin_contrato_jugadorclub = $("#fechafin_contrato_jugadorclub").val();
		if( fechafin_contrato_jugadorclub == "" ) {
			$("#fechafin_contrato_jugadorclub").css("background-color", "white");
			// flag = false;
		} else {
			$("#fechafin_contrato_jugadorclub").css("background-color", "white");
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#valor_mercado_jugadorclub").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let valor_mercado_jugadorclub = $("#valor_mercado_jugadorclub").val();
		if( valor_mercado_jugadorclub != "" ) {
			if( valor_mercado_jugadorclub.match(ER_numericosDecimales) && ( parseInt(valor_mercado_jugadorclub.length) >= 1 && parseInt(valor_mercado_jugadorclub.length) <= 10 ) ) {      
				$("#valor_mercado_jugadorclub").css("background-color", "white");
			} else {
				$("#valor_mercado_jugadorclub").css("background-color", "white");
				flag = false;
			}
		} else {
			$("#valor_mercado_jugadorclub").css("background-color", "white");
			// flag = false;
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#clausula_salida_jugadorclub").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let clausula_salida_jugadorclub = $("#clausula_salida_jugadorclub").val();
		if( clausula_salida_jugadorclub == "" ) {
			$("#clausula_salida_jugadorclub").css("background-color", "white");
			// flag = false;
		} else {
			$("#clausula_salida_jugadorclub").css("background-color", "white");
		}    	
    }

	// Aplicando validación solamente si el campo es visible:
    if($("#valor_clausula_jugadorclub").is(":visible")) {
		// OBLIGATORIO
		// ------------------------------------------------------------------------ //
		let valor_clausula_jugadorclub = $("#valor_clausula_jugadorclub").val();
		if( valor_clausula_jugadorclub != "" ) {
			if( valor_clausula_jugadorclub.match(ER_numericosDecimales) && ( parseInt(valor_clausula_jugadorclub.length) >= 1 && parseInt(valor_clausula_jugadorclub.length) <= 10 ) ) {      
				$("#valor_clausula_jugadorclub").css("background-color", "white");
			} else {
				$("#valor_clausula_jugadorclub").css("background-color", "white");
				flag = false;
			}
		} else {
			$("#valor_clausula_jugadorclub").css("background-color", "white");
			// flag = false;
		}
    }

	// OBLIGATORIO
	// ------------------------------------------------------------------------ //
	let observaciones_jugadorclub = $("#observaciones_jugadorclub").val();
	if( observaciones_jugadorclub != "" ) {
		if( observaciones_jugadorclub.match(ER_caracteresAlfaNumericos) && ( parseInt(observaciones_jugadorclub.length) >= 1 && parseInt(observaciones_jugadorclub.length) <= 150 ) ) {
			$("#observaciones_jugadorclub").css("background-color", "white");
		} else {
			$("#observaciones_jugadorclub").css("background-color", "white");
			flag = false;
		}
	} else {
		$("#observaciones_jugadorclub").css("background-color", "white");
		// flag = false;
	}    
	
	// alert('Bandera:' + flag);
	
	if( flag === false ){
		$('#boton_agregar_ficha_jugador').prop("disabled", true);
	}else{
		$('#boton_agregar_ficha_jugador').prop("disabled", false);
		// alert("Formulario validado");
	}
	

}
// ------------------------------ Fin de la función 'chequear_datos_form_fichajugador()' ------------------------------ //

// ------------------------------ Inicio de la función 'calcular_minutos_jugados()' ------------------------------ //
function calcular_minutos_jugados() {

	// Valor del minuto de salida:
	let min_salida_jugadorpartido = parseInt( $("#min_salida_jugadorpartido").val() );
	// Valor del minuto de entrada:
	let min_entrada_jugadorpartido = parseInt( $("#min_entrada_jugadorpartido").val() );	
	// Diferencia (resta) entre el minuto de salida y el minuto de entrada:
	let min_total_jugados = min_salida_jugadorpartido - min_entrada_jugadorpartido;
	// alert(min_entrada_jugadorpartido);
	// -----------Validando los minutos de entrada ----------- //
	// Si es 0, vacío o menor a 0 la cantidad de minutos jugados será 0:
	if( /*min_entrada_jugadorpartido === 0 ||*/ min_entrada_jugadorpartido === "" || min_entrada_jugadorpartido < 0 ) {
		min_total_jugados = 0;
		// alert('Error 1');
	}
	// Si el minuto de entrada es mayor al de salida, la cantidad de minutos jugados será 0:
	if( min_entrada_jugadorpartido > min_salida_jugadorpartido ) {
		min_total_jugados = 0;
		// alert('Error 2');
	}

	// -----------Validando los minutos de salida ----------- //
	// Si es 0, vacío o menor a 0 la cantidad de minutos jugados será 0:
	if( /*min_salida_jugadorpartido === 0 ||*/ min_salida_jugadorpartido === "" || min_salida_jugadorpartido < 0 ) {
		min_total_jugados = 0;
		// alert('Error 3');
	}
	// Si el minuto de salida es menor al de entrada, la cantidad de minutos jugados será 0:
	if( min_salida_jugadorpartido < min_entrada_jugadorpartido ) {
		min_total_jugados = 0;
	}	


	if( min_total_jugados === 0 || min_total_jugados == "" || min_total_jugados < 0 ) {
		min_entrada_jugadorpartido = 0;
	}	


	if( Number.isNaN( min_total_jugados ) ) {
		min_total_jugados = 0;
	}
	if( min_total_jugados < 0 ) {
		min_total_jugados = 0;
	}

	// Agregando el valor del total de minutos jugados al campo '#min_jugados_jugadorpartido':
	$("#min_jugados_jugadorpartido_text").html( min_total_jugados + ' minutos' );

	$("#min_jugados_jugadorpartido").val( min_total_jugados );		 

	chequear_datos_form_partidojugador(); // <---------------------- Validando   
}
// ------------------------------ Fin de la función 'calcular_minutos_jugados()' ------------------------------ //

// ------------------------------ Inicio de la función 'chequear_datos_form_partidojugador()' ------------------------------ // 
function chequear_datos_form_partidojugador(){

    // alert('Estoy validando...');
    // var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;
        
    /*
    #ffc6c6 <--- Color rosado.
    #d4ffdc <--- Color verde.
    */
        
    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let fecha_jugadorpartido = $("#fecha_jugadorpartido").val();
    if( fecha_jugadorpartido == "" ) {
        $("#fecha_jugadorpartido").css("background-color", "white");
        // flag = false;
    } else {
        $("#fecha_jugadorpartido").css("background-color", "white");
    }  

    // ------------------------------------------------------------------------ //
    // Campeonato:
    // OBLIGATORIO
    let idcampeonato = $("#idcampeonato").val();
    if( idcampeonato == "" ) {
        $("#idcampeonato").css("background-color", "white");
        // flag = false;
    } else {
        $("#idcampeonato").css("background-color", "white");
    }       
 
    // Datos del campeonato (otro):
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#pais_campeonato_otro").is(":visible")) {
        // alert("El campo es visible.");
        // OBLIGATORIO
        let pais_campeonato_otro = $("#pais_campeonato_otro").val();
        if( pais_campeonato_otro == "" ) {
            $("#pais_campeonato_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_campeonato_otro").css("background-color", "white");
        }   
    } 
    
    // Aplicando validación solamente si el campo es visible:
    if($("#division_campeonato_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let division_campeonato_otro = $("#division_campeonato_otro").val();
        if( division_campeonato_otro == "" ) {
            $("#division_campeonato_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_campeonato_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_campeonato_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let nombre_campeonato_otro = $("#nombre_campeonato_otro").val();
        if( nombre_campeonato_otro != "" ) {
            if( nombre_campeonato_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_campeonato_otro.length) >= 1 && parseInt(nombre_campeonato_otro.length) <= 150 ) ) {
                $("#nombre_campeonato_otro").css("background-color", "white");
            } else {
                $("#nombre_campeonato_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_campeonato_otro").css("background-color", "white");
            // flag = false;
        }
    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#organizador_campeonato_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let organizador_campeonato_otro = $("#organizador_campeonato_otro").val();
        if( organizador_campeonato_otro != "" ) {
            if( organizador_campeonato_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(organizador_campeonato_otro.length) >= 1 && parseInt(organizador_campeonato_otro.length) <= 150 ) ) {
                $("#organizador_campeonato_otro").css("background-color", "white");
            } else {
                $("#organizador_campeonato_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#organizador_campeonato_otro").css("background-color", "white");
            // flag = false;
        }       
    }    

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let jornada_jugadorpartido = $("#jornada_jugadorpartido").val();
    if( jornada_jugadorpartido != "" ) {
        if( jornada_jugadorpartido.match(ER_caracteresAlfaNumericos) && ( parseInt(jornada_jugadorpartido.length) >= 1 && parseInt(jornada_jugadorpartido.length) <= 150 ) ) {
            $("#jornada_jugadorpartido").css("background-color", "white");
        } else {
            $("#jornada_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#jornada_jugadorpartido").css("background-color", "white");
        // flag = false;
    }     

    // Club rival:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let idclub_rival = $("#idclub_rival").val();
    if( idclub_rival == "" ) {
        $("#idclub_rival").css("background-color", "white");
        // flag = false;
    } else {
        $("#idclub_rival").css("background-color", "white");
    }   

    // Datos del club rival (otro):

    // Aplicando validación solamente si el campo es visible:
    if($("#pais_club_rival_otro").is(":visible")) {
        // Datos del club actual (otro):
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let pais_club_rival_otro = $("#pais_club_rival_otro").val();
        if( pais_club_rival_otro == "" ) {
            $("#pais_club_rival_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_club_rival_otro").css("background-color", "white");
        }       
    }   

    // Aplicando validación solamente si el campo es visible:
    if($("#division_club_rival_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let division_club_rival_otro = $("#division_club_rival_otro").val();
        if( division_club_rival_otro == "" ) {
            $("#division_club_rival_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_club_rival_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_club_rival_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let nombre_club_rival_otro = $("#nombre_club_rival_otro").val();
        if( nombre_club_rival_otro != "" ) {
            if( nombre_club_rival_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_club_rival_otro.length) >= 1 && parseInt(nombre_club_rival_otro.length) <= 150 ) ) {
                $("#nombre_club_rival_otro").css("background-color", "white");
            } else {
                $("#nombre_club_rival_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_club_rival_otro").css("background-color", "white");
            // flag = false;
        }       
    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#entrenador_club_rival_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let entrenador_club_rival_otro = $("#entrenador_club_rival_otro").val();
        if( entrenador_club_rival_otro != "" ) {
            if( entrenador_club_rival_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(entrenador_club_rival_otro.length) >= 1 && parseInt(entrenador_club_rival_otro.length) <= 150 ) ) {
                $("#entrenador_club_rival_otro").css("background-color", "white");
            } else {
                $("#entrenador_club_rival_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#entrenador_club_rival_otro").css("background-color", "white");
            // flag = false;
        }       
    }    

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let posicion_jugadorpartido = $("#posicion_jugadorpartido").val();
    if( posicion_jugadorpartido == "" ) {
        $("#posicion_jugadorpartido").css("background-color", "white");
        // flag = false;
    } else {
        $("#posicion_jugadorpartido").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let tit_sup_nc_jugadorpartido = $("#tit_sup_nc_jugadorpartido").val();
    if( tit_sup_nc_jugadorpartido == "" ) {
        $("#tit_sup_nc_jugadorpartido").css("background-color", "white");
        // flag = false;
    } else {
        $("#tit_sup_nc_jugadorpartido").css("background-color", "white");
    }    

    // Condición del equipo en el partido:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    if( $("input:radio[name='condicion_jugadorpartido']:checked").length === 0 ) {
        // flag = false;
    } 

    // Datos de goles del partido:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let gol_equipo1_jugadorpartido = $("#gol_equipo1_jugadorpartido").val();
    if( gol_equipo1_jugadorpartido != "" ) {
        if( gol_equipo1_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(gol_equipo1_jugadorpartido.length) >= 1 && parseInt(gol_equipo1_jugadorpartido.length) <= 2 ) ) {      
            $("#gol_equipo1_jugadorpartido").css("background-color", "white");
        } else {
            $("#gol_equipo1_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#gol_equipo1_jugadorpartido").css("background-color", "white");
        // flag = false;
    } 

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let gol_equipo2_jugadorpartido = $("#gol_equipo2_jugadorpartido").val();
    if( gol_equipo2_jugadorpartido != "" ) {
        if( gol_equipo2_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(gol_equipo2_jugadorpartido.length) >= 1 && parseInt(gol_equipo2_jugadorpartido.length) <= 2 ) ) {      
            $("#gol_equipo2_jugadorpartido").css("background-color", "white");
        } else {
            $("#gol_equipo2_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#gol_equipo2_jugadorpartido").css("background-color", "white");
        // flag = false;
    }       

    // Datos del jugador con respecto a tarjetas, goles y minutos:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let t_amarilla_jugadorpartido = $("#t_amarilla_jugadorpartido").val();
    if( t_amarilla_jugadorpartido != "" ) {
        if( t_amarilla_jugadorpartido.match(ER_numericosEnteros) && parseInt(t_amarilla_jugadorpartido.length) === 1 ) {      
            $("#t_amarilla_jugadorpartido").css("background-color", "white");
        } else {
            $("#t_amarilla_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#t_amarilla_jugadorpartido").css("background-color", "white");
        // flag = false;
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //  
    let t_amarilladb_jugadorpartido = $("#t_amarilladb_jugadorpartido").val();
    if( t_amarilladb_jugadorpartido != "" ) {
        if( t_amarilladb_jugadorpartido.match(ER_numericosEnteros) && parseInt(t_amarilladb_jugadorpartido.length) === 1 ) {      
            $("#t_amarilladb_jugadorpartido").css("background-color", "white");
        } else {
            $("#t_amarilladb_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#t_amarilladb_jugadorpartido").css("background-color", "white");
        // flag = false;
    }   

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let t_roja_jugadorpartido = $("#t_roja_jugadorpartido").val();
    if( t_roja_jugadorpartido != "" ) {
        if( t_roja_jugadorpartido.match(ER_numericosEnteros) && parseInt(t_roja_jugadorpartido.length) === 1 ) {      
            $("#t_roja_jugadorpartido").css("background-color", "white");
        } else {
            $("#t_roja_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#t_roja_jugadorpartido").css("background-color", "white");
        // flag = false;
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let num_gol_jugadorpartido = $("#num_gol_jugadorpartido").val();
    if( num_gol_jugadorpartido != "" ) {
        if( num_gol_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(num_gol_jugadorpartido.length) >= 1 && parseInt(num_gol_jugadorpartido.length) <= 2 ) ) {      
            $("#num_gol_jugadorpartido").css("background-color", "white");
        } else {
            $("#num_gol_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#num_gol_jugadorpartido").css("background-color", "white");
        // flag = false;
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let min_entrada_jugadorpartido = $("#min_entrada_jugadorpartido").val();
    // Validando que no esté vacío:
    if( min_entrada_jugadorpartido != "" ) {
        // Validando que sea un número entero y que la longitud sea entre 1 y 3.
        if( min_entrada_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(min_entrada_jugadorpartido.length) >= 1 && parseInt(min_entrada_jugadorpartido.length) <= 3 ) ) {      

            // Validando que el minuto de entrada sea menor al minuto de salida:
            // Valor del minuto de salida.
            let min_salida_jugadorpartido = $("#min_salida_jugadorpartido").val();
            
            // Convirtiendo tipo de dato a entero:
            min_entrada_jugadorpartido = parseInt( min_entrada_jugadorpartido );
            min_salida_jugadorpartido = parseInt( min_salida_jugadorpartido );

            if( min_entrada_jugadorpartido < min_salida_jugadorpartido ) {
                $("#min_entrada_jugadorpartido").css({
                    "background-color": "white",
                    "color": "black",
                });
            } else {
                $("#min_entrada_jugadorpartido").css("background-color", "white");
                // flag = false;   
                // alert('Error 1');            
            }

        } else {
            $("#min_entrada_jugadorpartido").css("background-color", "white");
            flag = false;
            // alert('Error 2');
        }
    } else {
        $("#min_entrada_jugadorpartido").css("background-color", "white");
        // flag = false;
        // alert('Error 3');
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let min_salida_jugadorpartido = $("#min_salida_jugadorpartido").val();
    // Validando que no esté vacío:
    if( min_salida_jugadorpartido != "" ) {
        // Validando que sea un número entero y que la longitud sea entre 1 y 3.
        if( min_salida_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(min_salida_jugadorpartido.length) >= 1 && parseInt(min_salida_jugadorpartido.length) <= 2 ) ) {

            // Validando que el minuto de salida sea mayor al minuto de entrada:
            // Valor del minuto de entrada.

            let min_entrada_jugadorpartido = $("#min_entrada_jugadorpartido").val();

            // Convirtiendo tipo de dato a entero:
            min_entrada_jugadorpartido = parseInt( min_entrada_jugadorpartido );
            min_salida_jugadorpartido = parseInt( min_salida_jugadorpartido );
            
            if( min_salida_jugadorpartido > min_entrada_jugadorpartido ) {
                $("#min_salida_jugadorpartido").css("background-color", "white");
            } else {
                $("#min_salida_jugadorpartido").css("background-color", "white");
                // flag = false;               
                // alert('Error 4');
            }           
        
        } else {
            $("#min_salida_jugadorpartido").css("background-color", "white");
            flag = false;
            // alert('Error 5');
        }
    } else {
        $("#min_salida_jugadorpartido").css("background-color", "white");
        // flag = false;
        // alert('Error 6');
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let min_jugados_jugadorpartido = $("#min_jugados_jugadorpartido").val();
    // Validando que no esté vacío:
    if( min_jugados_jugadorpartido != "" ) {
        // Validando que sea un número entero y que la longitud sea entre 1 y 3.
        if( min_jugados_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(min_jugados_jugadorpartido.length) >= 1 && parseInt(min_jugados_jugadorpartido.length) <= 3 ) ) {      

            // Validando que la cantidad de minutos jugados sea el resultado de la diferencia (resta) entre el minuto de salida y el minuto de entrada:
            // Valor del minuto de salida:
            let min_salida_jugadorpartido = parseInt( $("#min_salida_jugadorpartido").val() );
            // Valor del minuto de entrada:
            let min_entrada_jugadorpartido = parseInt( $("#min_entrada_jugadorpartido").val() );                        

            // Diferencia (resta) entre el minuto de salida y el minuto de entrada:
            let min_total_jugados = min_salida_jugadorpartido - min_entrada_jugadorpartido;

            // alert( min_jugados_jugadorpartido + ' - ' + min_total_jugados )

            // min_jugados_jugadorpartido <--- Valor del input:
            min_jugados_jugadorpartido = parseInt( min_jugados_jugadorpartido ); // <--- Hay que convertirlo en número entero para ejecutar correctamente la comparación.
            if( min_jugados_jugadorpartido === min_total_jugados ) {
                $("#min_jugados_jugadorpartido").css("background-color", "white");
            } else {
                $("#min_jugados_jugadorpartido").css("background-color", "white");
                // flag = false;   
                // alert('Error 7');            
            }

        } else {
            $("#min_jugados_jugadorpartido").css("background-color", "white");
            flag = false;
            // alert('Error 8');
        }
    } else {
        $("#min_jugados_jugadorpartido").css("background-color", "white");
        // flag = false;
        // alert('Error 9');
    }           

    // alert('Bandera:' + flag);
    
    if( flag === false ){
        $('#boton-agregar-partido').prop("disabled", true);
        $('#boton-agregar-partido').removeClass('boton-agregar-partido-enabled');
        $('#boton-agregar-partido').addClass('boton-agregar-partido-disabled');
    }else{
        $('#boton-agregar-partido').prop("disabled", false);
        $('#boton-agregar-partido').removeClass('boton-agregar-partido-disabled');
        $('#boton-agregar-partido').addClass('boton-agregar-partido-enabled');
    }
    

}
// ------------------------------ Fin de la función 'chequear_datos_form_partidojugador()' ------------------------------ //

function closeModal_pdf(){
	$("#descargarPDF").modal('hide');
}

// --------------------------------------- Inicio de la función descargarPDF() --------------------------------------- //
function descargarPDF( idfichaJugador, titulo_serie_reporte, sexo_seleccion_reporte ){

console.log("ID Intervención Individual: " + idfichaJugador );

// alert( titulo_serie_reporte + " - " + sexo_seleccion_reporte );

if( sexo_seleccion_reporte == '(Hombres)') {
	sexo_seleccion_reporte = '(Masculino)';
} else {
	sexo_seleccion_reporte = '(Femenina)';
}

// alert( sexo_seleccion_reporte );

$("#descargarPDF").modal('show');
$('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');

	$.ajax({
		url: "post/reportes/generarPDF_cdp_informeindiv.php",
		type: "post",
		data: {
			idfichaJugador,
			titulo_serie_reporte,
			sexo_seleccion_reporte
		},
		dataType: 'json',
		cache: false,
		success: function(respuesta){
			if(respuesta != ''){
				$('#mensaje_agregar_descargarPDF').html('<h5>PDF Generado Exitosamente...</h5><br><button type="submit" class="boton_informe_jugador" style="border-radius: 5px" id="boton_agregar_informe" ><a  class="btn_descargar" onClick="closeModal_pdf();" download href="reportes_pdf/'+respuesta+'">DESCARGAR PDF</a></button>');
			}else{
				$('#mensaje_agregar_descargarPDF').html('<h5>Error de conexión: los datos no se han podido insertar.</h5><br>');
			}
			
		},error: function(){// will fire when timeout is reached
		   $('#mensaje_agregar_descargarPDF').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
		}, timeout: 15000 // sets timeout to 3 seconds
	}); 
// }, 1500);

}
// --------------------------------------- Fin de la función descargarPDF() --------------------------------------- // 

</script>
<script src="subir_imagen3/croppie.js"></script>
<link rel="stylesheet" href="subir_imagen3/croppie.css" />
<script>  

$image_crop_jugador = $('#image_demo_jugador').croppie({
	
	enableExif: true,
	viewport: {
	  width:200,
	  height:200,
	  type:'square' //circle
	},
	boundary:{
	  width:300,
	  height:300
	}
});

// Evento onchange desencadenado al seleccionar foto del jugador:
$('#foto_jugador').on('change', function(){
  // alert("0");
   $('.boton_modal').show();
  if(subir_imagen_jugador()==4){ //subir
	  var reader = new FileReader();
	  reader.onload = function (event) {
		$image_crop_jugador.croppie('bind', {
		  url: event.target.result
		}).then(function(){
		  console.log('jQuery bind complete');
		});
	  }
	  reader.readAsDataURL(this.files[0]);
	  $('#uploadImageModalJugador').modal('show');
  }
});

$('#crop_image_jugador').click(function(event){
  //alert("1");
  //$('.imagen_subir_jugador').hide();
  $('.boton_modal').hide();
  $('.texto_subir_jugador').html("<br><h3 style='color:white;'><i class='icon-spinner icon-spin icon-large'></i> Subiendo imagen...</h3><br><br><br>");
  $('.texto_subir_jugador').show();
	$image_crop_jugador.croppie('result', {
	  type: 'canvas',
	  size: 'viewport'
	}).then(function(response){
		  $('.imagen_subir_jugador').hide();
		  $.ajax({
			url:"subir_imagen3/upload.php",
			type: "POST",
			data:{"image": response},
			success:function(data){
			  window.error_foto=2; //copiar la camiseta
			  $('#foto-jugador').attr('src', data+'?lala='+new Date());
			  $('.imagen_subir_jugador').show();
			  $('.texto_subir_jugador').hide();
			  $('#uploadImageModalJugador').modal('hide');
			},error: function(){// will fire when timeout is reached
				$('.texto_subir_jugador').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
				$('.boton_modal').show();
			}, timeout: 15000 // sets timeout to 3 seconds
		  });
	  
	})
});

 
</script>	
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">
	$('.date_fechaNacimiento').datetimepicker({
		language:  'es',
		format: 'yyyy-mm-dd',
		//startDate: '2014-12-01',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		autoclose: true,
		useCurrent: false
	});

	$('.date-picker').datetimepicker({
		language:  'es',
		format: 'yyyy-mm-dd',
		//startDate: '2014-12-01',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		autoclose: true,
		useCurrent: false
	});	

	$('.date_fechaNacimiento').datetimepicker('setDate', new Date() );

	mostrar_al_cargar_pagina();

	// ============================================ AGREGANDO VALORES DE ARRAYS A LOS SELECTS ============================================ // 

	// --------------------- Agregando los valores del array de las divisiones a select(s) --------------------- //
    // FILTRO DE BÚSQUEDA:
    /*
    for (var i = 0; i < array_divisiones.length; i++) {
        $(".select-division-filtro-busqueda").append('<option value="'+array_divisiones[i][0]+'">'+array_divisiones[i][1]+'</option>');
    }
	// FORMULARIO:
    for (var i = 0; i < array_divisiones.length; i++) {
        if( i === 0 ){
        	array_divisiones[i][0] = '';
        	array_divisiones[i][1] = 'Seleccione';
        }        
        $(".select-division-form").append('<option value="'+array_divisiones[i][0]+'">'+array_divisiones[i][1]+'</option>');
    }    
    */


    // --------------------- Agregando los valores del array de posiciones de jugador a select(s) --------------------- //
    // FILTRO DE BÚSQUEDA:
    for (var i = 0; i < array_posiciones.length; i++) {
        $(".select-posicion-jugador-filtro-busqueda").append('<option value="'+array_posiciones[i][0]+'">'+array_posiciones[i][1]+'</option>');
    }
    // FORMULARIO:
    for (var i = 0; i < array_posiciones.length; i++) {
        if( i === 0 ){
        	array_posiciones[i][0] = '';
        	array_posiciones[i][1] = 'Seleccione';
        }     
        $(".select-posicion-jugador-form").append('<option value="'+array_posiciones[i][0]+'">'+array_posiciones[i][1]+'</option>');
    }
    // FORMULARIO (POSICIÓN ADICIONAL):  
    $(".select-posicion-adicional").append('<option value="999">No aplica</option>');
       

    // --------------------- Agregando los valores de países a select(s) --------------------- //
	var paises_otros = 
	'<option value="af">Afganistán</option>\
	<option value="al">Albania</option>\
	<option value="de">Alemania</option>\
	<option value="ad">Andorra</option>\
	<option value="ao">Angola</option>\
	<option value="ai">Anguilla</option>\
	<option value="aq">Antártida</option>\
	<option value="ag">Antigua y Barbuda</option>\
	<option value="an">Antillas Holandesas</option>\
	<option value="sa">Arabia Saudí</option>\
	<option value="dz">Argelia</option>\
	<option value="am">Armenia</option>\
	<option value="aw">Aruba</option>\
	<option value="au">Australia</option>\
	<option value="at">Austria</option>\
	<option value="az">Azerbaiyán</option>\
	<option value="bs">Bahamas</option>\
	<option value="bh">Bahrein</option>\
	<option value="bd">Bangladesh</option>\
	<option value="bb">Barbados</option>\
	<option value="be">Bélgica</option>\
	<option value="bz">Belice</option>\
	<option value="bj">Benin</option>\
	<option value="bm">Bermudas</option>\
	<option value="by">Bielorrusia</option>\
	<option value="mm">Birmania</option>\
	<option value="bo">Bolivia</option>\
	<option value="ba">Bosnia y Herzegovina</option>\
	<option value="bw">Botswana</option>\
	<option value="bn">Brunei</option>\
	<option value="bg">Bulgaria</option>\
	<option value="bf">Burkina Faso</option>\
	<option value="bi">Burundi</option>\
	<option value="bt">Bután</option>\
	<option value="cv">Cabo Verde</option>\
	<option value="kh">Camboya</option>\
	<option value="cm">Camerún</option>\
	<option value="ca">Canadá</option>\
	<option value="td">Chad</option>\
	<option value="cn">China</option>\
	<option value="cy">Chipre</option>\
	<option value="va">Ciudad del Vaticano (Santa Sede)</option>\
	<option value="km">Comores</option>\
	<option value="cg">Congo</option>\
	<option value="cd">Congo, República Democrática del</option>\
	<option value="kr">Corea</option>\
	<option value="kp">Corea del Norte</option>\
	<option value="ci">Costa de Marfíl</option>\
	<option value="cr">Costa Rica</option>\
	<option value="hr">Croacia (Hrvatska)</option>\
	<option value="cu">Cuba</option>\
	<option value="dk">Dinamarca</option>\
	<option value="dj">Djibouti</option>\
	<option value="dm">Dominica</option>\
	<option value="eg">Egipto</option>\
	<option value="sv">El Salvador</option>\
	<option value="ae">Emiratos Árabes Unidos</option>\
	<option value="er">Eritrea</option>\
	<option value="si">Eslovenia</option>\
	<option value="es">España</option>\
	<option value="us">Estados Unidos</option>\
	<option value="ee">Estonia</option>\
	<option value="et">Etiopía</option>\
	<option value="fj">Fiji</option>\
	<option value="ph">Filipinas</option>\
	<option value="fi">Finlandia</option>\
	<option value="fr">Francia</option>\
	<option value="ga">Gabón</option>\
	<option value="gm">Gambia</option>\
	<option value="ge">Georgia</option>\
	<option value="gh">Ghana</option>\
	<option value="gi">Gibraltar</option>\
	<option value="gd">Granada</option>\
	<option value="gr">Grecia</option>\
	<option value="gl">Groenlandia</option>\
	<option value="gp">Guadalupe</option>\
	<option value="gu">Guam</option>\
	<option value="gt">Guatemala</option>\
	<option value="gy">Guayana</option>\
	<option value="gf">Guayana Francesa</option>\
	<option value="gn">Guinea</option>\
	<option value="gq">Guinea Ecuatorial</option>\
	<option value="gw">Guinea-Bissau</option>\
	<option value="ht">Haití</option>\
	<option value="hn">Honduras</option>\
	<option value="hu">Hungría</option>\
	<option value="in">India</option>\
	<option value="id">Indonesia</option>\
	<option value="iq">Irak</option>\
	<option value="ir">Irán</option>\
	<option value="ie">Irlanda</option>\
	<option value="bv">Isla Bouvet</option>\
	<option value="cx">Isla de Christmas</option>\
	<option value="is">Islandia</option>\
	<option value="ky">Islas Caimán</option>\
	<option value="ck">Islas Cook</option>\
	<option value="cc">Islas de Cocos o Keeling</option>\
	<option value="fo">Islas Faroe</option>\
	<option value="hm">Islas Heard y McDonald</option>\
	<option value="fk">Islas Malvinas</option>\
	<option value="mp">Islas Marianas del Norte</option>\
	<option value="mh">Islas Marshall</option>\
	<option value="um">Islas menores de Estados Unidos</option>\
	<option value="pw">Islas Palau</option>\
	<option value="sb">Islas Salomón</option>\
	<option value="sj">Islas Svalbard y Jan Mayen</option>\
	<option value="tk">Islas Tokelau</option>\
	<option value="tc">Islas Turks y Caicos</option>\
	<option value="vi">Islas Vírgenes (EEUU)</option>\
	<option value="vg">Islas Vírgenes (Reino Unido)</option>\
	<option value="wf">Islas Wallis y Futuna</option>\
	<option value="il">Israel</option>\
	<option value="it">Italia</option>\
	<option value="jm">Jamaica</option>\
	<option value="jp">Japón</option>\
	<option value="jo">Jordania</option>\
	<option value="kz">Kazajistán</option>\
	<option value="ke">Kenia</option>\
	<option value="kg">Kirguizistán</option>\
	<option value="ki">Kiribati</option>\
	<option value="kw">Kuwait</option>\
	<option value="la">Laos</option>\
	<option value="ls">Lesotho</option>\
	<option value="lv">Letonia</option>\
	<option value="lb">Líbano</option>\
	<option value="lr">Liberia</option>\
	<option value="ly">Libia</option>\
	<option value="li">Liechtenstein</option>\
	<option value="lt">Lituania</option>\
	<option value="lu">Luxemburgo</option>\
	<option value="mk">Macedonia, Ex-República Yugoslava de</option>\
	<option value="mg">Madagascar</option>\
	<option value="my">Malasia</option>\
	<option value="mw">Malawi</option>\
	<option value="mv">Maldivas</option>\
	<option value="ml">Malí</option>\
	<option value="mt">Malta</option>\
	<option value="ma">Marruecos</option>\
	<option value="mq">Martinica</option>\
	<option value="mu">Mauricio</option>\
	<option value="mr">Mauritania</option>\
	<option value="yt">Mayotte</option>\
	<option value="fm">Micronesia</option>\
	<option value="md">Moldavia</option>\
	<option value="mc">Mónaco</option>\
	<option value="mn">Mongolia</option>\
	<option value="ms">Montserrat</option>\
	<option value="mz">Mozambique</option>\
	<option value="na">Namibia</option>\
	<option value="nr">Nauru</option>\
	<option value="np">Nepal</option>\
	<option value="ni">Nicaragua</option>\
	<option value="ne">Níger</option>\
	<option value="ng">Nigeria</option>\
	<option value="nu">Niue</option>\
	<option value="nf">Norfolk</option>\
	<option value="no">Noruega</option>\
	<option value="nc">Nueva Caledonia</option>\
	<option value="nz">Nueva Zelanda</option>\
	<option value="om">Omán</option>\
	<option value="nl">Países Bajos</option>\
	<option value="pa">Panamá</option>\
	<option value="pg">Papúa Nueva Guinea</option>\
	<option value="pk">Paquistán</option>\
	<option value="pn">Pitcairn</option>\
	<option value="pf">Polinesia Francesa</option>\
	<option value="pl">Polonia</option>\
	<option value="pt">Portugal</option>\
	<option value="pr">Puerto Rico</option>\
	<option value="qa">Qatar</option>\
	<option value="uk">Reino Unido</option>\
	<option value="cf">República Centroafricana</option>\
	<option value="cz">República Checa</option>\
	<option value="za">República de Sudáfrica</option>\
	<option value="do">República Dominicana</option>\
	<option value="sk">República Eslovaca</option>\
	<option value="re">Reunión</option>\
	<option value="rw">Ruanda</option>\
	<option value="ro">Rumania</option>\
	<option value="ru">Rusia</option>\
	<option value="eh">Sahara Occidental</option>\
	<option value="kn">Saint Kitts y Nevis</option>\
	<option value="ws">Samoa</option>\
	<option value="as">Samoa Americana</option>\
	<option value="sm">San Marino</option>\
	<option value="vc">San Vicente y Granadinas</option>\
	<option value="sh">Santa Helena</option>\
	<option value="lc">Santa Lucía</option>\
	<option value="st">Santo Tomé y Príncipe</option>\
	<option value="sn">Senegal</option>\
	<option value="sc">Seychelles</option>\
	<option value="sl">Sierra Leona</option>\
	<option value="sg">Singapur</option>\
	<option value="sy">Siria</option>\
	<option value="so">Somalia</option>\
	<option value="lk">Sri Lanka</option>\
	<option value="pm">St Pierre y Miquelon</option>\
	<option value="sz">Suazilandia</option>\
	<option value="sd">Sudán</option>\
	<option value="se">Suecia</option>\
	<option value="ch">Suiza</option>\
	<option value="sr">Surinam</option>\
	<option value="th">Tailandia</option>\
	<option value="tw">Taiwán</option>\
	<option value="tz">Tanzania</option>\
	<option value="tj">Tayikistán</option>\
	<option value="tf">Territorios franceses del Sur</option>\
	<option value="tp">Timor Oriental</option>\
	<option value="tg">Togo</option>\
	<option value="to">Tonga</option>\
	<option value="tt">Trinidad y Tobago</option>\
	<option value="tn">Túnez</option>\
	<option value="tm">Turkmenistán</option>\
	<option value="tr">Turquía</option>\
	<option value="tv">Tuvalu</option>\
	<option value="ua">Ucrania</option>\
	<option value="ug">Uganda</option>\
	<option value="uz">Uzbekistán</option>\
	<option value="vu">Vanuatu</option>\
	<option value="vn">Vietnam</option>\
	<option value="ye">Yemen</option>\
	<option value="yu">Yugoslavia</option>\
	<option value="zm">Zambia</option>\
	<option value="zw">Zimbabue</option>';
    
    // FILTRO DE BÚSQUEDA:
	// $('.select-pais-filtro-busqueda').append( paises );
    // --------------------- Agregando los valores del array de países (OTROS) a los select(s) --------------------- //
    // FILTRO DE BÚSQUEDA:
    for ( let codigo_pais in paises_nacionalidad ) {
    	let pais = paises_nacionalidad[codigo_pais];
		$(".select-pais-filtro-busqueda").append('<option value="'+codigo_pais+'">'+pais+'</option>');
    }  
    // Agregando la opción 'Todos' al inicio:
	$('.select-pais-filtro-busqueda').prepend('<option value="0" selected>Todos</option>');
    // FORMULARIO:
    for ( let codigo_pais in paises_nacionalidad ) {
    	let pais = paises_nacionalidad[codigo_pais];
		$(".select-pais-form").append('<option value="'+codigo_pais+'">'+pais+'</option>');
    }  

    // Agregando la opción 'Seleccione':
	$('.select-pais-form').prepend('<option value="" selected>Seleccione</option>');
	// Agregando la opción 'No aplica' a los selects de nacionalidades adicionales:
	$('.select-pais-form-adicional').append("<option value='999'>No aplica</option>");

    // --------------------- Agregando los valores del array de países (OTROS) a los select(s) --------------------- //
    // FILTRO DE BÚSQUEDA:
	$(".select-pais-otro").append( paises_otros ); 

    // --------------------- Agregando los valores del array del estado del club de jugadores --------------------- //
    // FILTRO DE BÚSQUEDA:
    for (var i = 0; i < array_estadoclub_jugador.length; i++) {
        $(".select-estadoclub-jugador-filtro-busqueda").append('<option value="'+array_estadoclub_jugador[i][0]+'">'+array_estadoclub_jugador[i][1]+'</option>');
    }     
    // FORMULARIO:
    for (var i = 0; i < array_estadoclub_jugador.length; i++) { // <-------------- PARA FORMULARIO (sin la opción 'Todos').
        if( i === 0 ){
        	array_estadoclub_jugador[i][0] = '';
        	array_estadoclub_jugador[i][1] = 'Seleccione';
        }     
        $(".select-estadoclub-jugador-form").append('<option value="'+array_estadoclub_jugador[i][0]+'">'+array_estadoclub_jugador[i][1]+'</option>');
    }                  

    // --------------------- Agregando los valores del array de series --------------------- //
    // FORMULARIO:
    for (var i = 0; i < array_series.length; i++) { // <-------------- PARA FORMULARIO (sin la opción 'Todos').
        if( i === 0 ){
        	array_series[i][0] = '';
        	array_series[i][1] = 'Seleccione';
        }     
        $(".select-serie-jugador-form").append('<option value="'+array_series[i][0]+'">'+array_series[i][1]+'</option>');
    }

 	// --------------------- Agregando los valores del array de lateralidad de jugadores --------------------- //
    // FILTRO DE BÚSQUEDA:
    for (var i = 0; i < array_lateralidad.length; i++) {   
        $(".select-lateralidad-filtro-busqueda").append('<option value="'+array_lateralidad[i][0]+'">'+array_lateralidad[i][1]+'</option>');
    }      
    // FORMULARIO:
    for (var i = 0; i < array_lateralidad.length; i++) {
        if( i === 0 ){
        	array_lateralidad[i][0] = '';
        	array_lateralidad[i][1] = 'Seleccione';
        }        
        $(".select-lateralidad-form").append('<option value="'+array_lateralidad[i][0]+'">'+array_lateralidad[i][1]+'</option>');
    }    

    // ============================================ CONSULTANDO TODOS LOS CAMPEONATOS Y CLUBES A LOS SELECTS ============================================ //
	// Insertando en los selects los campeonatos y clubes de la BD:
	buscar_campeonatos_todos();
	buscar_clubes_todos();


// Ordenando options de los selects para países :
// - Filtro de Búsqueda:



/*
$('.select-pais-filtro-busqueda').find('option[value="0"]').remove(); // <--- Eliminando el option 'Todos'
$('.select-pais-filtro-busqueda').each(function(){
	let thisSelect = $(this);
	let thisSelectOptions = $(this).find('option');

	//$(this).find('option[value="0"]').remove();
	
	// Ordenando select de países:
	$(thisSelect).html($(thisSelectOptions).sort(function (a, b) {
	    if(!a.value) return;
	    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
	}));
	$(thisSelect).prepend("<option value='0' selected>Todos</option>");
});

// ---------------- Selects de países para formulario:
// - Filtro de Formulario:
$('.select-pais-form').each(function(){
	let thisSelect = $(this);
	let thisSelectOptions = $(this).find('option');
	// Ordenando select de países:
	$(thisSelect).html($(thisSelectOptions).sort(function (a, b) {
	    if(!a.value) return;
	    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
	}));
	// $(thisSelect).prepend("<option value='' selected>Seleccione</option>");
});

// - Filtro de Formulario:
$('.select-pais-form').each(function(){
	let thisSelect = $(this);
	$(thisSelect).prepend("<option value='' selected>Seleccione</option>");
});

// ---------------- Selects de nacionalidad adicionales para formulario :
$('.select-pais-form-adicional').find('option[value=""]').remove(); // <--- Eliminando el option 'Todos'
// - Filtro de Formulario:
$('.select-pais-form-adicional').each(function(){
	let thisSelect = $(this);
	let thisSelectOptions = $(this).find('option');
	// Ordenando select de países:
	$(thisSelect).html($(thisSelectOptions).sort(function (a, b) {
	    if(!a.value) return;
	    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
	}));
	// $(thisSelect).prepend("<option value='' selected>Seleccione</option>");
});

$('.select-pais-form-adicional').each(function(){
	let thisSelect = $(this);
	$(thisSelect).prepend("<option value='' selected>Seleccione</option>");
});

// - Filtro de Formulario:
$('.select-pais-form-adicional').each(function(){
	let thisSelect = $(this);
	$(thisSelect).append("<option value='999'>No aplica</option>");
});

*/

// ---------------- Selects de posiciones adicionales :
$('.select-posicion-jugador-form-adicional').each(function(){
	let thisSelect = $(this);
	$(thisSelect).append("<option value='999'>No aplica</option>");
});


</script>