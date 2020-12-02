-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2020 a las 04:34:05
-- Versión del servidor: 5.7.18-log
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `onceanal_gabriel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alta_deportiva_atencion_diaria`
--

CREATE TABLE `alta_deportiva_atencion_diaria` (
  `idalta_deportiva_atencion_diaria` int(10) UNSIGNED NOT NULL,
  `alta_deportiva_atencion_diaria` int(11) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idatencion_diaria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_pdf_jugador`
--

CREATE TABLE `archivo_pdf_jugador` (
  `idarchivo_pdf_jugador` int(10) UNSIGNED NOT NULL,
  `nombre_archivo` varchar(150) DEFAULT NULL,
  `titulo_archivo` varchar(150) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idfichaJugador` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_diaria`
--

CREATE TABLE `atencion_diaria` (
  `idatencion_diaria` int(10) UNSIGNED NOT NULL,
  `idfichaJugador` int(10) UNSIGNED NOT NULL,
  `idcontexto_incidente` int(10) UNSIGNED DEFAULT NULL,
  `tipo_atencion_atencion_diaria` int(11) DEFAULT NULL,
  `fecha_incidente_atencion_diaria` date DEFAULT NULL,
  `diagnostico_atencion_diaria` varchar(150) DEFAULT NULL,
  `anamnesis_atencion_diaria` varchar(2000) DEFAULT NULL,
  `derivado_seguro_atencion_diaria` int(11) DEFAULT NULL,
  `examen_solicitados_atencion_diaria` int(11) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `fecha_atencion_diaria` date DEFAULT NULL,
  `recomendacion_sesion_actual_atencion_diaria` int(11) DEFAULT NULL,
  `fecha_recomendacion_sesion_actual_atencion_diaria` date DEFAULT NULL,
  `recomendacion_sesion_siguiente_atencion_diaria` int(11) DEFAULT NULL,
  `fecha_recomendacion_sesion_siguiente_atencion_diairai` date DEFAULT NULL,
  `observacion_kinesiologo` varchar(2000) DEFAULT NULL,
  `observacion_general` varchar(2000) DEFAULT NULL,
  `observacion_medica` varchar(2000) DEFAULT NULL,
  `observacion_readaptor` varchar(2000) DEFAULT NULL,
  `numero_sesion` int(11) DEFAULT NULL,
  `porcentaje_recuperacion` int(11) DEFAULT NULL,
  `idinforme_medico` int(10) UNSIGNED DEFAULT NULL,
  `asistencia_atencion_diaria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bono_jugador`
--

CREATE TABLE `bono_jugador` (
  `idbono_jugador` int(10) UNSIGNED NOT NULL,
  `tipo_bono` int(11) DEFAULT NULL,
  `monto` varchar(150) DEFAULT NULL,
  `comentario_bono` varchar(2000) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `moneda` int(11) DEFAULT NULL,
  `idfichaJugador` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bono_jugador`
--

INSERT INTO `bono_jugador` (`idbono_jugador`, `tipo_bono`, `monto`, `comentario_bono`, `fecha_software`, `nombre_usuario_software`, `moneda`, `idfichaJugador`) VALUES
(7, 0, 'a', 'a', '2020-11-14 00:00:00', 'Maiker Leon', 0, 331),
(8, 1, 'b', 'b', '2020-11-14 00:00:00', 'Maiker Leon', 1, 331),
(9, 2, 'c', 'c', '2020-11-14 00:00:00', 'Maiker Leon', 2, 331),
(10, 0, 'Test 1', 'Test 1', '2020-11-14 00:00:00', 'Maiker Leon', 0, 332),
(11, 1, 'Test 2', 'Test 2', '2020-11-14 00:00:00', 'Maiker Leon', 1, 332),
(12, 2, 'Test 3', 'Test 3', '2020-11-14 00:00:00', 'Maiker Leon', 2, 332);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

CREATE TABLE `club` (
  `idclub` int(10) UNSIGNED NOT NULL,
  `pais_club` varchar(150) DEFAULT NULL,
  `tipo_pais_club` int(11) DEFAULT NULL,
  `division_club` int(11) DEFAULT NULL,
  `nombre_club` varchar(150) DEFAULT NULL,
  `entrenador_club` varchar(150) DEFAULT NULL,
  `foto_club` varchar(150) DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `club`
--

INSERT INTO `club` (`idclub`, `pais_club`, `tipo_pais_club`, `division_club`, `nombre_club`, `entrenador_club`, `foto_club`, `nombre_usuario_software`, `fecha_software`) VALUES
(1, 'cl', 1, 1, 'Colo Colo', 'Ernesto Quintero', '0.png', 'Maiker Leon', '2020-05-11 06:09:42'),
(2, 'cl', 1, 1, 'Club Universidad De Chile', 'Sebasti?n Quiroz', '1.png', 'Maiker Leon', '2020-05-05 19:38:14'),
(3, 'cl', 1, 2, 'Rangers', 'Manuel Jim?nez', '21.png', 'Maiker Leon', '2020-05-05 19:39:22'),
(4, 've', 1, 10, 'Caracas Fútbol Club', 'Noel Sanvicente', NULL, NULL, NULL),
(5, 've', 1, 10, 'Trujillanos Fútbol Club', 'Jesús Valiente', 'globe_flags_earth.png', 'Maiker Leon', '2020-04-28 03:15:35'),
(6, 've', 1, 11, 'Llaneros de Guanare', 'Leonardo Terán', NULL, NULL, NULL),
(7, 'co', 1, 17, 'Deportes Tolima', 'Bbb', '', 'Maiker Leon', '2020-05-04 09:34:47'),
(8, 'es', 1, 14, 'Fc Barcelona', 'Quique Seti?n', NULL, 'Maiker Leon', '2020-05-11 06:04:52'),
(9, 'br', 1, 14, 'Sao Paulo', 'Aaa', '', 'Maiker Leon', '2020-05-01 23:59:08'),
(10, 've', 3, 10, 'Estudiantes de Mérida', 'yo', NULL, NULL, NULL),
(11, 'co', 1, 17, 'Once Caldas', 'Ccc', '', 'Maiker Leon', '2020-05-04 09:35:12'),
(12, 'ar', 1, 5, 'Boca Juniors', 'Ddd', 'futbol.png', 'Maiker Leon', '2020-05-04 09:35:49'),
(13, 'ar', 1, 5, 'River Plate', 'Pantoli', '', 'Maiker Leon', '2020-05-04 09:36:04'),
(14, 'pe', 1, 12, 'Alianza Lima', 'Ggg', '', 'Maiker Leon', '2020-05-04 09:36:30'),
(15, 'pe', 1, 12, 'Universitario Del Cusco', 'Iii', '', 'Maiker Leon', '2020-05-04 09:36:45'),
(18, 'ar', 1, 5, 'Club Estudiantes De La Plata', 'Www', '', 'Maiker Leon', '2020-05-04 09:37:18'),
(19, 'ec', 1, 16, 'Ldu Quito', 'Jefferson', '', 'Maiker Leon', '2020-05-04 09:37:37'),
(20, 'br', 1, 14, 'Sport Club Corinthians Paulista', 'Bbb', '../foto_clubes/futbol.png', 'Maiker Leon', '2020-05-04 09:38:06'),
(21, 've', 1, 10, 'Lara Fútbol Club', 'Hhh', 'sinFoto', 'Maiker Leon', '2020-05-04 09:38:53'),
(25, 've', 1, 10, 'Monagas FC', 'Yo', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contexto_incidente`
--

CREATE TABLE `contexto_incidente` (
  `idcontexto_incidente` int(10) UNSIGNED NOT NULL,
  `nombre_contexto_incidente` varchar(150) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contexto_incidente`
--

INSERT INTO `contexto_incidente` (`idcontexto_incidente`, `nombre_contexto_incidente`, `fecha_software`, `nombre_usuario_software`) VALUES
(1, 'test 1', '2020-07-27 00:00:00', 'Maiker Leon'),
(2, 'test 2', '2020-07-27 00:00:00', 'Maiker Leon'),
(3, 'test 5', '2020-07-27 00:00:00', 'Maiker Leon'),
(4, 'test 3', '2020-07-28 00:00:00', 'Maiker Leon'),
(5, 'test 4', '2020-07-28 00:00:00', 'Maiker Leon'),
(6, 'test 6', '2020-07-28 00:00:00', 'Maiker Leon'),
(7, 'test 7', '2020-07-28 00:00:00', 'Maiker Leon'),
(8, 'test 9', '2020-07-28 00:00:00', 'Maiker Leon'),
(9, 'test 9', '2020-07-28 00:00:00', 'Maiker Leon'),
(10, 'test 9', '2020-07-28 00:00:00', 'Maiker Leon'),
(11, 'test 10', '2020-07-28 00:00:00', 'Maiker Leon'),
(14, 'test 11', '2020-07-28 00:00:00', 'Maiker Leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_atencion_seguimiento`
--

CREATE TABLE `detalle_atencion_seguimiento` (
  `iddetalle_atencion_seguimiento` int(10) UNSIGNED NOT NULL,
  `fecha_atencion_detalle_atencion_seguimiento` datetime DEFAULT NULL,
  `centro_atencion_detalle_atencion_seguimiento` varchar(150) DEFAULT NULL,
  `detalle_atencion_seguimiento` varchar(2000) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idseguimiento` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_evaluacion_jugador`
--

CREATE TABLE `detalle_evaluacion_jugador` (
  `iddetalle_evaluacion_jugador` int(10) UNSIGNED NOT NULL,
  `nota_detalle_evaluacion_jugador` int(11) DEFAULT NULL,
  `comentario_detalle_evaluacion_jugador` varchar(150) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idevaluacion_jugador` int(10) UNSIGNED NOT NULL,
  `idevaluacion_concepto` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_test_ocular`
--

CREATE TABLE `detalle_test_ocular` (
  `iddetalle_test_ocular` int(10) UNSIGNED NOT NULL,
  `idtest_ocular` int(10) UNSIGNED NOT NULL,
  `idficha_jugador_mc` int(10) UNSIGNED NOT NULL,
  `velocidad_detalle_test_ocular` float DEFAULT NULL,
  `ranking_detalle_test_ocular` int(11) DEFAULT NULL,
  `comentario_detalle_test_ocular` varchar(2000) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_test_ocular`
--

INSERT INTO `detalle_test_ocular` (`iddetalle_test_ocular`, `idtest_ocular`, `idficha_jugador_mc`, `velocidad_detalle_test_ocular`, `ranking_detalle_test_ocular`, `comentario_detalle_test_ocular`, `fecha_software`, `nombre_usuario_software`) VALUES
(18, 5, 15, 1, 1, '', '2020-11-11 23:06:23', 'Maiker Leon'),
(19, 5, 16, 2, 2, '', '2020-11-11 23:06:23', 'Maiker Leon'),
(20, 5, 17, 3, 3, '', '2020-11-11 23:06:23', 'Maiker Leon'),
(21, 5, 19, 4, 4, '', '2020-11-11 23:06:23', 'Maiker Leon'),
(22, 5, 20, 5, 5, '', '2020-11-11 23:06:23', 'Maiker Leon'),
(23, 5, 21, 6, 6, '', '2020-11-11 23:06:23', 'Maiker Leon'),
(24, 5, 22, 7, 7, '', '2020-11-11 23:06:23', 'Maiker Leon'),
(25, 5, 23, 8, 8, '', '2020-11-11 23:06:23', 'Maiker Leon'),
(26, 6, 12, 1, 1, '', '2020-11-11 23:31:23', 'Maiker Leon'),
(27, 6, 23, 2, 2, '', '2020-11-11 23:31:23', 'Maiker Leon'),
(28, 6, 15, 3, 3, '', '2020-11-11 23:31:23', 'Maiker Leon'),
(29, 6, 16, 4, 4, '', '2020-11-11 23:31:23', 'Maiker Leon'),
(30, 6, 17, 5, 5, '', '2020-11-11 23:31:23', 'Maiker Leon'),
(31, 6, 19, 6, 6, '', '2020-11-11 23:31:23', 'Maiker Leon'),
(32, 6, 20, 7, 7, '', '2020-11-11 23:31:23', 'Maiker Leon'),
(33, 6, 21, 8, 8, '', '2020-11-11 23:31:23', 'Maiker Leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_concepto`
--

CREATE TABLE `evaluacion_concepto` (
  `idevaluacion_concepto` int(10) UNSIGNED NOT NULL,
  `evaluacion_concepto` varchar(150) DEFAULT NULL,
  `evaluacion` int(11) DEFAULT NULL,
  `posicion_evaluacion_concepto` int(11) DEFAULT NULL,
  `estado_evaluacion_concepto` int(11) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evaluacion_concepto`
--

INSERT INTO `evaluacion_concepto` (`idevaluacion_concepto`, `evaluacion_concepto`, `evaluacion`, `posicion_evaluacion_concepto`, `estado_evaluacion_concepto`, `fecha_software`, `nombre_usuario_software`) VALUES
(7, 'concepto 1', 0, 1, 1, '2020-09-25 00:00:00', 'Maiker Leon'),
(8, 'concepto 2', 0, 1, 1, '2020-09-20 00:00:00', 'Maiker Leon'),
(9, 'concepto 3', 0, 1, 1, '2020-09-20 00:00:00', 'Maiker Leon'),
(10, 'concepto 4', 1, 1, 1, '2020-09-20 00:00:00', 'Maiker Leon'),
(11, 'concepto 5', 2, 1, 1, '2020-09-20 00:00:00', 'Maiker Leon'),
(13, 'concepto uno', 0, 3, 1, '2020-09-22 00:00:00', 'Maiker Leon'),
(14, 'concepto dos', 0, 3, 1, '2020-09-22 00:00:00', 'Maiker Leon'),
(15, 'fff', 0, 9, 1, '2020-09-22 00:00:00', 'Maiker Leon'),
(16, 'gG', 2, 5, 1, '2020-09-25 00:00:00', 'Maiker Leon'),
(17, 'hh', 2, 1, 1, '2020-09-25 00:00:00', 'Maiker Leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_jugador`
--

CREATE TABLE `evaluacion_jugador` (
  `idevaluacion_jugador` int(10) UNSIGNED NOT NULL,
  `total_final_tecnica` int(11) DEFAULT NULL,
  `total_final_tactica` int(11) DEFAULT NULL,
  `total_final_otra` int(11) DEFAULT NULL,
  `total_promedio` int(11) DEFAULT NULL,
  `fecha_evaluacion_jugador` date DEFAULT NULL,
  `posicion_evaluacion_jugador` varchar(150) DEFAULT NULL,
  `comentario_fortaleza` varchar(3000) DEFAULT NULL,
  `comentario_devilidad` varchar(3000) DEFAULT NULL,
  `comentario_recomendacion` varchar(3000) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idfichaJugador` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_solicitado_atencion_diaria`
--

CREATE TABLE `examen_solicitado_atencion_diaria` (
  `idexamen_solicitado_atencion_diaria` int(10) UNSIGNED NOT NULL,
  `nombre_examen_atencion_diaria` varchar(150) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idatencion_diaria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichajugador`
--

CREATE TABLE `fichajugador` (
  `idfichaJugador` int(10) UNSIGNED NOT NULL,
  `idclub` int(10) UNSIGNED DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `apellido1` varchar(150) DEFAULT NULL,
  `apellido2` varchar(150) DEFAULT NULL,
  `rut` varchar(150) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `paisNacimiento` varchar(150) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `comuna` varchar(150) DEFAULT NULL,
  `ciudad` varchar(150) DEFAULT NULL,
  `region` varchar(150) DEFAULT NULL,
  `nacionalidad1` varchar(150) DEFAULT NULL,
  `nacionalidad2` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefono` varchar(150) DEFAULT NULL,
  `colegio` varchar(150) DEFAULT NULL,
  `curso` varchar(150) DEFAULT NULL,
  `nombrePadre` varchar(150) DEFAULT NULL,
  `telefonoPadre` varchar(150) DEFAULT NULL,
  `nacionalidadPadre` varchar(150) DEFAULT NULL,
  `domicilioPadre` varchar(150) DEFAULT NULL,
  `fechaNacimientoPadre` varchar(150) DEFAULT NULL,
  `correoPadre` varchar(150) DEFAULT NULL,
  `nombreMadre` varchar(150) DEFAULT NULL,
  `telefonoMadre` varchar(150) DEFAULT NULL,
  `nacionalidadMadre` varchar(150) DEFAULT NULL,
  `domicilioMadre` varchar(150) DEFAULT NULL,
  `fechaNacimientoMadre` date DEFAULT NULL,
  `correoMadre` varchar(150) DEFAULT NULL,
  `estadoCivil` varchar(150) DEFAULT NULL,
  `numeroHijos` int(11) DEFAULT NULL,
  `numeroHermanos` int(11) DEFAULT NULL,
  `numeroHermanosClub` int(11) DEFAULT NULL,
  `mantenedor` varchar(150) DEFAULT NULL,
  `casaDepto` varchar(150) DEFAULT NULL,
  `enfermedadPadres` varchar(150) DEFAULT NULL,
  `trabajanPadres` varchar(150) DEFAULT NULL,
  `saludPadres` varchar(150) DEFAULT NULL,
  `grupoSanguineo` varchar(150) DEFAULT NULL,
  `alergias` varchar(150) DEFAULT NULL,
  `lesionesPrevias` varchar(150) DEFAULT NULL,
  `operaciones` varchar(150) DEFAULT NULL,
  `medicamentosHabituales` varchar(150) DEFAULT NULL,
  `serieActual` varchar(150) DEFAULT NULL,
  `numeroDorsal` varchar(150) DEFAULT NULL,
  `pieHabil` varchar(150) DEFAULT NULL,
  `representante` varchar(150) DEFAULT NULL,
  `captador` varchar(150) DEFAULT NULL,
  `clubOrigen` varchar(150) DEFAULT NULL,
  `funciones` varchar(150) DEFAULT NULL,
  `tallaCamiseta` varchar(150) DEFAULT NULL,
  `numeroCalzado` varchar(150) DEFAULT NULL,
  `anosEnClub` varchar(150) DEFAULT NULL,
  `observaciones` varchar(150) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `peso` varchar(150) DEFAULT NULL,
  `grupo_proyeccion` varchar(150) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `estado` varchar(150) DEFAULT NULL,
  `comuna2` varchar(150) DEFAULT NULL,
  `ciudad2` varchar(150) DEFAULT NULL,
  `codigoPais` varchar(150) DEFAULT NULL,
  `codigoNacionalidad1` varchar(150) DEFAULT NULL,
  `paisNacionalidad1` varchar(150) DEFAULT NULL,
  `dinamico` varchar(150) DEFAULT NULL,
  `peso_ideal` float DEFAULT NULL,
  `proyeccion` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `viveCon` varchar(150) DEFAULT NULL,
  `marcaAuspicio` varchar(150) DEFAULT NULL,
  `tallaShort` varchar(150) DEFAULT NULL,
  `contratoProfesional` varchar(150) DEFAULT NULL,
  `fechaInicioContrato` varchar(150) DEFAULT NULL,
  `fechaFinContrato` varchar(150) DEFAULT NULL,
  `anoIngresoClub` varchar(150) DEFAULT NULL,
  `serieIngresoClub` varchar(150) DEFAULT NULL,
  `comoLlego` varchar(150) DEFAULT NULL,
  `llegadaAlClub` varchar(150) DEFAULT NULL,
  `participacionOtrosClubes` varchar(150) DEFAULT NULL,
  `pensionClub` varchar(150) DEFAULT NULL,
  `formacion` varchar(150) DEFAULT NULL,
  `seleccionado` int(11) DEFAULT NULL,
  `prevision` int(11) DEFAULT NULL,
  `posicion_ficha_jugador_mc` int(11) DEFAULT NULL,
  `seguro_ficha_jugador_mc` int(11) DEFAULT NULL,
  `pasaporte_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `fecha_vencimiento_pasaporte_ficha_jugador_mc` date DEFAULT NULL,
  `fecha_vencimiento_rut_ficha_jugador_mc` date DEFAULT NULL,
  `valor_mercado_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `representante_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `correo_representante_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `telefono_representante_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `formado_en_ficha_jugador_mc` int(11) DEFAULT NULL,
  `otro_club_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `condicion_ficha_jugador_mc` int(11) DEFAULT NULL,
  `ano_llegada_club_ficha_jugador_mc` int(11) DEFAULT NULL,
  `fecha_inicio_contrato_ficha_jugador_mc` date DEFAULT NULL,
  `fecha_fin_contrato_ficha_jugador_mc` date DEFAULT NULL,
  `costos_derecho_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `clausula_rescision_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc` varchar(3000) DEFAULT NULL,
  `sueldo_bruto_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `sueldo_neto_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `monto_arriendo_vivienda_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `valor_total_contrato_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `otros_costos_asociados_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `premios_pactados_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `observacion_datos_contrato_ficha_jugador_mc` varchar(3000) DEFAULT NULL,
  `estado_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `fecha_termino_contrato_ficha_jugador_mc` date DEFAULT NULL,
  `motivo_ficha_jugador_mc` int(11) DEFAULT NULL,
  `costos_asociados_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `observacion_rescision_contrato_ficha_jugador_mc` varchar(200) DEFAULT NULL,
  `derecho_federativo` int(11) DEFAULT NULL,
  `movilizacion` varchar(150) DEFAULT NULL,
  `colacion` varchar(150) DEFAULT NULL,
  `viaticos` varchar(150) DEFAULT NULL,
  `otros_remuneraciones` varchar(150) DEFAULT NULL,
  `desgaste` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fichajugador`
--

INSERT INTO `fichajugador` (`idfichaJugador`, `idclub`, `nombre`, `apellido1`, `apellido2`, `rut`, `fechaNacimiento`, `paisNacimiento`, `direccion`, `comuna`, `ciudad`, `region`, `nacionalidad1`, `nacionalidad2`, `email`, `telefono`, `colegio`, `curso`, `nombrePadre`, `telefonoPadre`, `nacionalidadPadre`, `domicilioPadre`, `fechaNacimientoPadre`, `correoPadre`, `nombreMadre`, `telefonoMadre`, `nacionalidadMadre`, `domicilioMadre`, `fechaNacimientoMadre`, `correoMadre`, `estadoCivil`, `numeroHijos`, `numeroHermanos`, `numeroHermanosClub`, `mantenedor`, `casaDepto`, `enfermedadPadres`, `trabajanPadres`, `saludPadres`, `grupoSanguineo`, `alergias`, `lesionesPrevias`, `operaciones`, `medicamentosHabituales`, `serieActual`, `numeroDorsal`, `pieHabil`, `representante`, `captador`, `clubOrigen`, `funciones`, `tallaCamiseta`, `numeroCalzado`, `anosEnClub`, `observaciones`, `altura`, `peso`, `grupo_proyeccion`, `fecha`, `nombre_usuario_software`, `estado`, `comuna2`, `ciudad2`, `codigoPais`, `codigoNacionalidad1`, `paisNacionalidad1`, `dinamico`, `peso_ideal`, `proyeccion`, `password`, `sexo`, `viveCon`, `marcaAuspicio`, `tallaShort`, `contratoProfesional`, `fechaInicioContrato`, `fechaFinContrato`, `anoIngresoClub`, `serieIngresoClub`, `comoLlego`, `llegadaAlClub`, `participacionOtrosClubes`, `pensionClub`, `formacion`, `seleccionado`, `prevision`, `posicion_ficha_jugador_mc`, `seguro_ficha_jugador_mc`, `pasaporte_ficha_jugador_mc`, `fecha_vencimiento_pasaporte_ficha_jugador_mc`, `fecha_vencimiento_rut_ficha_jugador_mc`, `valor_mercado_ficha_jugador_mc`, `representante_ficha_jugador_mc`, `correo_representante_ficha_jugador_mc`, `telefono_representante_ficha_jugador_mc`, `formado_en_ficha_jugador_mc`, `otro_club_ficha_jugador_mc`, `condicion_ficha_jugador_mc`, `ano_llegada_club_ficha_jugador_mc`, `fecha_inicio_contrato_ficha_jugador_mc`, `fecha_fin_contrato_ficha_jugador_mc`, `costos_derecho_ficha_jugador_mc`, `clausula_rescision_ficha_jugador_mc`, `observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc`, `sueldo_bruto_ficha_jugador_mc`, `sueldo_neto_ficha_jugador_mc`, `monto_arriendo_vivienda_ficha_jugador_mc`, `valor_total_contrato_ficha_jugador_mc`, `otros_costos_asociados_ficha_jugador_mc`, `premios_pactados_ficha_jugador_mc`, `observacion_datos_contrato_ficha_jugador_mc`, `estado_ficha_jugador_mc`, `fecha_termino_contrato_ficha_jugador_mc`, `motivo_ficha_jugador_mc`, `costos_asociados_ficha_jugador_mc`, `observacion_rescision_contrato_ficha_jugador_mc`, `derecho_federativo`, `movilizacion`, `colacion`, `viaticos`, `otros_remuneraciones`, `desgaste`) VALUES
(331, NULL, 'test', 'Test', 'Test', 'Test', '2009-02-28', NULL, NULL, NULL, NULL, NULL, 'CL', 'NULL', 'Test', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '99', '100', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, '2020-11-14 00:00:00', 'Maiker Leon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 'Test', '2020-11-12', '2020-11-13', 'Test', 'Test', 'Test', 'Test', NULL, '', 1, 2020, '2020-11-12', '2020-11-12', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Testz', '1', '2020-11-12', 0, 'Test', 'Test', 0, 'z', 'z', 'z', 'z', 'z'),
(332, NULL, 'test 1', 'Test 1', 'Test 1', '152', '1998-02-28', NULL, NULL, NULL, NULL, NULL, 'CL', 'NULL', 'Test 1', 'Test 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '99', '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 125, NULL, NULL, '2020-11-14 00:00:00', 'Maiker Leon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, 'Test 1', '2020-11-13', '2020-11-13', 'Test 1', 'Test 1', 'Test 1', 'Test 1', NULL, '', 1, 2020, '2020-11-13', '2020-11-13', 'Test 1', 'Test 1', 'Test 1', 'Test 1', 'Test 1', 'Test 1', 'Test 1', 'Test 1', 'Test 1', 'Test 1', '1', '2020-11-13', 0, 'Test 1', 'Test 1', 0, 'Test 1', 'Test 1', 'Test 1', 'Test 1', 'Test 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_jugador_mc`
--

CREATE TABLE `ficha_jugador_mc` (
  `idficha_jugador_mc` int(10) UNSIGNED NOT NULL,
  `nombre_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `apellido1_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `apellido2_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `rut_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `fecha_nacimiento_ficha_jugador_mc` date DEFAULT NULL,
  `nacionalidad_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `nacionalidad_adicional_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `pie_habil_ficha_jugador_mc` int(11) DEFAULT NULL,
  `estatura_ficha_jugador_mc` float DEFAULT NULL,
  `dorsal_ficha_jugador_mc` int(11) DEFAULT NULL,
  `correo_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `telefono_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `posicion_ficha_jugador_mc` int(11) DEFAULT NULL,
  `prevision_ficha_jugador_mc` int(11) DEFAULT NULL,
  `seguro_ficha_jugador_mc` int(11) DEFAULT NULL,
  `pasaporte_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `fecha_vencimiento_pasaporte_ficha_jugador_mc` date DEFAULT NULL,
  `fecha_vencimiento_rut_ficha_jugador_mc` date DEFAULT NULL,
  `valor_mercado_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `representante_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `correo_representante_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `telefono_representante_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `formado_en_ficha_jugador_mc` int(11) DEFAULT NULL,
  `otro_club_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `condicion_ficha_jugador_mc` int(11) DEFAULT NULL,
  `ano_llegada_club_ficha_jugador_mc` int(11) DEFAULT NULL,
  `fecha_inicio_contrato_ficha_jugador_mc` date DEFAULT NULL,
  `fecha_fin_contrato_ficha_jugador_mc` date DEFAULT NULL,
  `costos_derecho_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `clausula_rescision_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc` varchar(3000) DEFAULT NULL,
  `sueldo_bruto_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `sueldo_neto_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `monto_arriendo_vivienda_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `valor_total_contrato_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `otros_costos_asociados_ficha_jugador_mc` varchar(200) DEFAULT NULL,
  `premios_pactados_ficha_jugador_mc` varchar(200) DEFAULT NULL,
  `observacion_datos_contrato_ficha_jugador_mc` varchar(3000) DEFAULT NULL,
  `estado_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `fecha_termino_contrato_ficha_jugador_mc` date DEFAULT NULL,
  `motivo_ficha_jugador_mc` int(11) DEFAULT NULL,
  `costos_asociados_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `observacion_rescision_contrato_ficha_jugador_mc` varchar(200) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `serieActual` int(11) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `derecho_federativo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ficha_jugador_mc`
--

INSERT INTO `ficha_jugador_mc` (`idficha_jugador_mc`, `nombre_ficha_jugador_mc`, `apellido1_ficha_jugador_mc`, `apellido2_ficha_jugador_mc`, `rut_ficha_jugador_mc`, `fecha_nacimiento_ficha_jugador_mc`, `nacionalidad_ficha_jugador_mc`, `nacionalidad_adicional_ficha_jugador_mc`, `pie_habil_ficha_jugador_mc`, `estatura_ficha_jugador_mc`, `dorsal_ficha_jugador_mc`, `correo_ficha_jugador_mc`, `telefono_ficha_jugador_mc`, `posicion_ficha_jugador_mc`, `prevision_ficha_jugador_mc`, `seguro_ficha_jugador_mc`, `pasaporte_ficha_jugador_mc`, `fecha_vencimiento_pasaporte_ficha_jugador_mc`, `fecha_vencimiento_rut_ficha_jugador_mc`, `valor_mercado_ficha_jugador_mc`, `representante_ficha_jugador_mc`, `correo_representante_ficha_jugador_mc`, `telefono_representante_ficha_jugador_mc`, `formado_en_ficha_jugador_mc`, `otro_club_ficha_jugador_mc`, `condicion_ficha_jugador_mc`, `ano_llegada_club_ficha_jugador_mc`, `fecha_inicio_contrato_ficha_jugador_mc`, `fecha_fin_contrato_ficha_jugador_mc`, `costos_derecho_ficha_jugador_mc`, `clausula_rescision_ficha_jugador_mc`, `observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc`, `sueldo_bruto_ficha_jugador_mc`, `sueldo_neto_ficha_jugador_mc`, `monto_arriendo_vivienda_ficha_jugador_mc`, `valor_total_contrato_ficha_jugador_mc`, `otros_costos_asociados_ficha_jugador_mc`, `premios_pactados_ficha_jugador_mc`, `observacion_datos_contrato_ficha_jugador_mc`, `estado_ficha_jugador_mc`, `fecha_termino_contrato_ficha_jugador_mc`, `motivo_ficha_jugador_mc`, `costos_asociados_ficha_jugador_mc`, `observacion_rescision_contrato_ficha_jugador_mc`, `fecha_software`, `nombre_usuario_software`, `serieActual`, `sexo`, `derecho_federativo`) VALUES
(12, 'megumin', 'valera', 'castillo', 'd', '2020-11-11', 'JP', 'NULL', 0, 0.11, 1, 'd', '11', 1, 0, 1, 'd', '2020-11-11', '2020-11-11', 'd', 'd', 'd', 'd', 1, 'gxxxx', 1, 2020, '2020-10-24', '2020-10-31', 'hhhh', 'hhhh', 'hhh', 'd', 'd', 'd', 'd', 'd', 'd', 'd', '1', '2021-08-01', 0, 'x', 'x', '2020-11-11 00:00:00', 'Maiker Leon', 17, 1, 1),
(15, 'test 1', 'test 1', 'test 1', 'test 1', '2020-11-07', 'JP', 'NULL', 0, 0.5, 1, 't', 't', 1, 0, 1, 't', '2020-11-07', '2020-11-07', 't', 't', 't', 't', 1, 't', 1, 2020, '2020-10-21', '2020-10-21', 'A', 'A', 'A', 't', 't', 't', 't', 't', 't', 'ttttttttttttttttttttttttt', '1', '2020-11-14', 0, '', '', '2020-11-07 00:00:00', 'Maiker Leon', 99, 1, NULL),
(16, 'test 2', 'test 2', 'test 2', 'test 2', '1998-02-28', 'JP', 'NULL', 0, 15.69, 1, 'a', 'a', 1, 0, 1, 'a', '2020-10-21', '2020-10-21', 'a', 'a', 'a', 'a', 1, 'a', 1, 2020, '2020-10-21', '2020-10-21', '', '', '', 'a', 'a', 'a', 'a', 'a', 'a', 'aa', '0', '2020-10-21', 0, 'a', 'a', '2020-10-22 00:00:00', 'Maiker Leon', 99, 1, NULL),
(17, 'test 3', 'test 3', 'test 3', 'test 3', '2020-11-06', 'JP', 'NULL', 0, 158.25, 1, 'x', 'x', 1, 0, 1, 'x', '2020-11-06', '2020-11-06', 'x', 'x', 'x', 'x', 1, 'xxxxxxx', 1, 2020, '2020-10-21', '2020-10-21', 'x', 'x', 'x', 'xxxxxxxxx', 'xxxxxxxxxxx', 'xxxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', '1', '2020-10-21', 5, 'xxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxx', '2020-11-06 00:00:00', 'Maiker Leon', 99, 1, NULL),
(19, 'test 4', 'test 4', 'test 4', 'ggg', '2020-11-02', 'VE', 'NULL', 0, 11.22, 1, 'luis@gmail.com', '04160430565', 8, 14, 0, 'sss', '2020-11-02', '2020-11-02', 's', 's', 's', 's', 0, '', 1, 2020, '2020-10-24', '2020-10-31', 'kk', 'kk', 'kkkk', 'ss', 's', 's', 's', 's', 's', 'sss', '1', '2020-10-24', 5, 'ss', 'ss', '2020-11-02 00:00:00', 'Maiker Leon', 99, 1, NULL),
(20, 'gabriel valera', 'ggg', 'gggg', 'gggg', '2020-11-06', 'NULL', 'NULL', 0, 111, 1, 'fghfghfg', 'ghfh', 1, 0, 1, 'fghfgh', '2020-11-06', '2020-11-06', 'hfghfg', 'fghfgh', 'fghfg', 'fgh', 1, 'gfghg', 1, 2020, '2020-11-06', '2020-11-06', '', '', '', 'ghjghj', 'ghjghj', 'ghjghj', 'ghjghj', 'ghjghj', 'ghjghj', 'ghjgh', '1', '2020-11-06', 0, 'ghjghj', 'ghjghj', '2020-11-06 00:00:00', 'Maiker Leon', 99, 1, NULL),
(21, 'A', 'ddd', 'ddd', 'ddd', '2020-11-06', 'NULL', 'NULL', 0, 1, 18, 'dd', 'ddd', 1, 0, 1, 'ddd', '2020-11-06', '2020-11-06', 'dd', 'ddd', 'ddd', 'ddd', 1, 'ddd', 1, NULL, NULL, NULL, NULL, NULL, NULL, 'dddd', 'ddd', 'ddd', 'ddd', 'ddd', 'ddd', 'ddd', '1', '2020-11-06', 0, 'ddd', 'ddd', '2020-11-06 00:00:00', 'Maiker Leon', 99, 1, NULL),
(22, 'zz', 'zz', 'zz', 'zz', '2020-11-06', 'AD', 'NULL', 0, 122, 16, 'zzzz', 'zzz', 12, 0, 1, 'zzz', '2020-11-06', '2020-11-06', 'zzz', 'zzz', 'zzz', 'zzz', 1, 'zzzz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'zzz', 'zzzz', 'zzzz', 'zzz', 'zzz', 'zzz', 'zzzz', '1', '2020-11-06', 0, 'zzz', 'zzzz', '2020-11-06 00:00:00', 'Maiker Leon', 99, 1, NULL),
(23, 'cccc', 'ccc', 'ccc', 'ccc', '2020-11-06', 'DE', 'AM', 0, 159, 14, '1111', '1111', 6, 0, 1, '111', '2020-11-06', '2020-11-06', '111', '11', '111', '111', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '111', '111', '111', '111', '1111', '1111', '111', '1', '2020-11-06', 0, '111', '111', '2020-11-06 00:00:00', 'Maiker Leon', 99, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_medico`
--

CREATE TABLE `informe_medico` (
  `idinforme_medico` int(10) UNSIGNED NOT NULL,
  `tipoInforme` int(11) DEFAULT NULL,
  `patologia` int(11) DEFAULT NULL,
  `gravedad` int(11) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `contexto` int(11) DEFAULT NULL,
  `mecanismo` int(11) DEFAULT NULL,
  `superficie` int(11) DEFAULT NULL,
  `ocurridaEn` int(11) DEFAULT NULL,
  `etapaDeportiva` int(11) DEFAULT NULL,
  `aptoEntrenamiento` int(11) DEFAULT NULL,
  `reintegroEntrenamiento` date DEFAULT NULL,
  `aptoPartido` int(11) DEFAULT NULL,
  `reintegroPartido` date DEFAULT NULL,
  `diagnostico` varchar(5000) DEFAULT NULL,
  `informe_medico` varchar(5000) DEFAULT NULL,
  `nombre_medico` varchar(200) DEFAULT NULL,
  `rut_medico` varchar(200) DEFAULT NULL,
  `email_medico` varchar(200) DEFAULT NULL,
  `telefono_medico` varchar(200) DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `nombre_usuario_software` varchar(200) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `idfichaJugador` int(10) UNSIGNED NOT NULL,
  `agregado_examenes_realizados` varchar(2000) DEFAULT NULL,
  `agregado_fecha_lesion` date DEFAULT NULL,
  `agregado_zona_afectada` varchar(2000) DEFAULT NULL,
  `agregado_recidiva` int(11) DEFAULT NULL,
  `agregado_localizacion_lesion` varchar(2000) DEFAULT NULL,
  `agregado_seguro_medico` int(11) DEFAULT NULL,
  `agregado_comentario_examen` varchar(3000) DEFAULT NULL,
  `agregado_dias_de_baja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_mensual`
--

CREATE TABLE `informe_mensual` (
  `idinforme_mensual` int(10) UNSIGNED NOT NULL,
  `descripcion_informe_mensual` varchar(2000) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `ano_informe_mensual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informe_mensual`
--

INSERT INTO `informe_mensual` (`idinforme_mensual`, `descripcion_informe_mensual`, `fecha`, `nombre_usuario_software`, `ano_informe_mensual`) VALUES
(1, 'hhhhh', '2020-09-10 18:43:03', 'Maiker Leon', 2020),
(2, 'hola mundo dos', '2020-09-10 18:45:48', 'Maiker Leon', 2021),
(3, 'hhh', '2020-09-10 19:48:05', 'Maiker Leon', 2020),
(4, 'jjjj', '2020-09-10 19:48:23', 'Maiker Leon', 2021);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_mensual_area`
--

CREATE TABLE `informe_mensual_area` (
  `idinforme_mensual_area` int(10) UNSIGNED NOT NULL,
  `informe_mensual_area` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idinforme_mensual` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informe_mensual_area`
--

INSERT INTO `informe_mensual_area` (`idinforme_mensual_area`, `informe_mensual_area`, `fecha`, `nombre_usuario_software`, `idinforme_mensual`) VALUES
(7, 1, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(8, 2, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(9, 3, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(10, 4, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(11, 5, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(12, 6, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(19, 1, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(20, 2, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(21, 3, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(22, 4, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(23, 5, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(24, 6, '2020-09-10 18:45:50', 'Maiker Leon', 2),
(25, 1, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(26, 2, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(27, 3, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(28, 4, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(29, 5, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(30, 6, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(31, 1, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(32, 2, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(33, 3, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(34, 4, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(35, 5, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(36, 6, '2020-09-10 19:48:23', 'Maiker Leon', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_mensual_mes`
--

CREATE TABLE `informe_mensual_mes` (
  `idinforme_mensual_mes` int(10) UNSIGNED NOT NULL,
  `informe_mensual_mes` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idinforme_mensual` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informe_mensual_mes`
--

INSERT INTO `informe_mensual_mes` (`idinforme_mensual_mes`, `informe_mensual_mes`, `fecha`, `nombre_usuario_software`, `idinforme_mensual`) VALUES
(13, 1, '2020-09-10 18:43:04', 'Maiker Leon', 1),
(14, 2, '2020-09-10 18:43:04', 'Maiker Leon', 1),
(15, 3, '2020-09-10 18:43:04', 'Maiker Leon', 1),
(16, 4, '2020-09-10 18:43:04', 'Maiker Leon', 1),
(17, 5, '2020-09-10 18:43:04', 'Maiker Leon', 1),
(18, 6, '2020-09-10 18:43:04', 'Maiker Leon', 1),
(19, 7, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(20, 8, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(21, 9, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(22, 10, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(23, 11, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(24, 12, '2020-09-10 18:43:05', 'Maiker Leon', 1),
(37, 1, '2020-09-10 18:45:48', 'Maiker Leon', 2),
(38, 2, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(39, 3, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(40, 4, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(41, 5, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(42, 6, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(43, 7, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(44, 8, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(45, 9, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(46, 10, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(47, 11, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(48, 12, '2020-09-10 18:45:49', 'Maiker Leon', 2),
(49, 1, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(50, 2, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(51, 3, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(52, 4, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(53, 5, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(54, 6, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(55, 7, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(56, 8, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(57, 9, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(58, 10, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(59, 11, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(60, 12, '2020-09-10 19:48:06', 'Maiker Leon', 3),
(61, 1, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(62, 2, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(63, 3, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(64, 4, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(65, 5, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(66, 6, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(67, 7, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(68, 8, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(69, 9, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(70, 10, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(71, 11, '2020-09-10 19:48:23', 'Maiker Leon', 4),
(72, 12, '2020-09-10 19:48:23', 'Maiker Leon', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_mensual_serie`
--

CREATE TABLE `informe_mensual_serie` (
  `idinforme_mensual_serie` int(10) UNSIGNED NOT NULL,
  `informe_mensual_serie` varchar(150) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idinforme_mensual` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informe_mensual_serie`
--

INSERT INTO `informe_mensual_serie` (`idinforme_mensual_serie`, `informe_mensual_serie`, `fecha`, `nombre_usuario_software`, `idinforme_mensual`) VALUES
(17, '99_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(18, '20_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(19, '17_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(20, '16_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(21, '15_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(22, '14_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(23, '13_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(24, '12_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(25, '11_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(26, '10_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(27, '9_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(28, '8_1', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(29, '99_2', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(30, '17_2', '2020-09-10 18:43:05', 'Maiker Leon', 1),
(31, '15_2', '2020-09-10 18:43:06', 'Maiker Leon', 1),
(47, '99_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(48, '20_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(49, '17_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(50, '16_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(51, '15_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(52, '14_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(53, '13_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(54, '12_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(55, '11_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(56, '10_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(57, '9_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(58, '8_1', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(59, '99_2', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(60, '17_2', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(61, '15_2', '2020-09-10 18:45:50', 'Maiker Leon', 2),
(62, '99_1', '2020-09-10 19:48:06', 'Maiker Leon', 3),
(63, '20_1', '2020-09-10 19:48:06', 'Maiker Leon', 3),
(64, '17_1', '2020-09-10 19:48:06', 'Maiker Leon', 3),
(65, '16_1', '2020-09-10 19:48:06', 'Maiker Leon', 3),
(66, '15_1', '2020-09-10 19:48:06', 'Maiker Leon', 3),
(67, '14_1', '2020-09-10 19:48:06', 'Maiker Leon', 3),
(68, '13_1', '2020-09-10 19:48:07', 'Maiker Leon', 3),
(69, '12_1', '2020-09-10 19:48:07', 'Maiker Leon', 3),
(70, '11_1', '2020-09-10 19:48:07', 'Maiker Leon', 3),
(71, '10_1', '2020-09-10 19:48:07', 'Maiker Leon', 3),
(72, '9_1', '2020-09-10 19:48:07', 'Maiker Leon', 3),
(73, '8_1', '2020-09-10 19:48:07', 'Maiker Leon', 3),
(74, '99_2', '2020-09-10 19:48:07', 'Maiker Leon', 3),
(75, '17_2', '2020-09-10 19:48:07', 'Maiker Leon', 3),
(76, '15_2', '2020-09-10 19:48:07', 'Maiker Leon', 3),
(77, '99_1', '2020-09-10 19:48:23', 'Maiker Leon', 4),
(78, '20_1', '2020-09-10 19:48:23', 'Maiker Leon', 4),
(79, '17_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(80, '16_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(81, '15_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(82, '14_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(83, '13_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(84, '12_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(85, '11_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(86, '10_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(87, '9_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(88, '8_1', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(89, '99_2', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(90, '17_2', '2020-09-10 19:48:24', 'Maiker Leon', 4),
(91, '15_2', '2020-09-10 19:48:24', 'Maiker Leon', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_semanal`
--

CREATE TABLE `informe_semanal` (
  `idinformesemanal` int(10) UNSIGNED NOT NULL,
  `descripcion_informe_semanal` varchar(2000) DEFAULT NULL,
  `fecha_informe_semanal` date DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informe_semanal`
--

INSERT INTO `informe_semanal` (`idinformesemanal`, `descripcion_informe_semanal`, `fecha_informe_semanal`, `fecha`, `nombre_usuario_software`) VALUES
(1, 'sdfsdfsdfsdfsd', '2020-07-30', '2020-07-31 03:58:10', 'Maiker Leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_semanal_area`
--

CREATE TABLE `informe_semanal_area` (
  `idinformesemanalarea` int(10) UNSIGNED NOT NULL,
  `informe_semanal_area` int(11) DEFAULT NULL,
  `idinformesemanal` int(10) UNSIGNED NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informe_semanal_area`
--

INSERT INTO `informe_semanal_area` (`idinformesemanalarea`, `informe_semanal_area`, `idinformesemanal`, `fecha`, `nombre_usuario_software`) VALUES
(1, 1, 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(2, 2, 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(3, 3, 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(4, 4, 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(5, 5, 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(6, 6, 1, '2020-07-31 03:58:10', 'Maiker Leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informe_semanal_serie`
--

CREATE TABLE `informe_semanal_serie` (
  `idinformesemanalserie` int(10) UNSIGNED NOT NULL,
  `informe_semanal_serie` varchar(150) DEFAULT NULL,
  `idinformesemanal` int(10) UNSIGNED NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `informe_semanal_serie`
--

INSERT INTO `informe_semanal_serie` (`idinformesemanalserie`, `informe_semanal_serie`, `idinformesemanal`, `fecha`, `nombre_usuario_software`) VALUES
(1, '99_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(2, '20_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(3, '17_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(4, '16_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(5, '15_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(6, '14_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(7, '13_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(8, '12_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(9, '11_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(10, '10_1', 1, '2020-07-31 03:58:10', 'Maiker Leon'),
(11, '9_1', 1, '2020-07-31 03:58:11', 'Maiker Leon'),
(12, '8_1', 1, '2020-07-31 03:58:11', 'Maiker Leon'),
(13, '99_2', 1, '2020-07-31 03:58:11', 'Maiker Leon'),
(14, '17_2', 1, '2020-07-31 03:58:11', 'Maiker Leon'),
(15, '15_2', 1, '2020-07-31 03:58:11', 'Maiker Leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicioncancha`
--

CREATE TABLE `posicioncancha` (
  `idposicionCancha` int(10) UNSIGNED NOT NULL,
  `posicion` varchar(45) DEFAULT NULL,
  `numero_posicion` varchar(45) DEFAULT NULL,
  `idfichaJugador` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo_ficha_jugador_mc`
--

CREATE TABLE `prestamo_ficha_jugador_mc` (
  `idprestamo_ficha_jugador_mc` int(10) UNSIGNED NOT NULL,
  `condicion_prestamo_ficha_jugador_mc` int(11) DEFAULT NULL,
  `pais_origen_club_prestamo_ficha_jugador_mc` varchar(250) DEFAULT NULL,
  `origen_club_prestamo_ficha_jugador_mc` varchar(250) DEFAULT NULL,
  `fecha_inicio_prestamo_prestamo_ficha_jugador_mc` date DEFAULT NULL,
  `fecha_fin_prestamo_prestamo_ficha_jugador_mc` date DEFAULT NULL,
  `valor_prestamo_prestamo_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `opcion_compra_prestamo_ficha_jugador_mc` varchar(150) DEFAULT NULL,
  `observacion_datos_deportivos_prestamo_ficha_jugador_mc` varchar(3000) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idfichaJugador` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendacion_alta_atencion_diaria`
--

CREATE TABLE `recomendacion_alta_atencion_diaria` (
  `idrecomendacion_alta_atencion_diaria` int(10) UNSIGNED NOT NULL,
  `recomendacion_alta_atencion_diaria` int(11) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idatencion_diaria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `idseguimiento` int(10) UNSIGNED NOT NULL,
  `modalidad_seguimiento` int(11) DEFAULT NULL,
  `numero_caso_seguimiento` int(11) DEFAULT NULL,
  `diagnostico_seguimiento` varchar(2000) DEFAULT NULL,
  `fecha_accidente_seguimiento` date DEFAULT NULL,
  `fecha_denuncia_seguimiento` date DEFAULT NULL,
  `fecha_plazo_maximo_30_seguimiento` date DEFAULT NULL,
  `fecha_plazo_maximo_90_seguimiento` date DEFAULT NULL,
  `fecha_plazo_maximo_180_seguimiento` date DEFAULT NULL,
  `fecha_plazo_reembolzo_seguimiento` date DEFAULT NULL,
  `fecha_atencion_seguimiento` date DEFAULT NULL,
  `pendiente_ano_anterior_seguimiento` int(11) DEFAULT NULL,
  `comentario_caso` varchar(5000) DEFAULT NULL,
  `entrega_documento_seguimiento` int(11) DEFAULT NULL,
  `continuidad_tratamiento_seguimiento` int(11) DEFAULT NULL,
  `centro_atencion_seguimiento` varchar(150) DEFAULT NULL,
  `centro_derivacion_seguimiento` varchar(150) DEFAULT NULL,
  `medico_tratante_seguimiento` varchar(150) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idfichaJugador` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `test_ocular`
--

CREATE TABLE `test_ocular` (
  `idtest_ocular` int(10) UNSIGNED NOT NULL,
  `fecha_evaluacuion_test_ocular` date DEFAULT NULL,
  `ano_test_ocular` varchar(150) DEFAULT NULL,
  `numeros_jugadores_evaluados_test_ocular` int(11) DEFAULT NULL,
  `id_jugador_mejor_tiempo_test_ocular` int(11) DEFAULT NULL,
  `mejor_tiempo_test_ocular` float DEFAULT NULL,
  `id_jugador_peor_tiempo_test_ocular` int(11) DEFAULT NULL,
  `peor_tiempo_test_ocular` float DEFAULT NULL,
  `media_test_ocular` float DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `observacion_test_ocular` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `test_ocular`
--

INSERT INTO `test_ocular` (`idtest_ocular`, `fecha_evaluacuion_test_ocular`, `ano_test_ocular`, `numeros_jugadores_evaluados_test_ocular`, `id_jugador_mejor_tiempo_test_ocular`, `mejor_tiempo_test_ocular`, `id_jugador_peor_tiempo_test_ocular`, `peor_tiempo_test_ocular`, `media_test_ocular`, `fecha_software`, `nombre_usuario_software`, `observacion_test_ocular`) VALUES
(5, '2020-11-11', '2020', 8, 15, 1, 23, 8, 4.5, '2020-11-11 23:06:22', 'Maiker Leon', ''),
(6, '2020-11-11', '2020', 8, 12, 1, 21, 8, 5, '2020-11-11 23:31:23', 'Maiker Leon', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador_readatador`
--

CREATE TABLE `trabajador_readatador` (
  `idtrabajo_readatador` int(10) UNSIGNED NOT NULL,
  `trabajo_readatador` varchar(150) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `trabajador_readatador`
--

INSERT INTO `trabajador_readatador` (`idtrabajo_readatador`, `trabajo_readatador`, `fecha_software`, `nombre_usuario_software`) VALUES
(1, 'test 1', '2020-08-03 00:00:00', 'Maiker Leon'),
(2, 'test 2', '2020-08-03 00:00:00', 'Maiker Leon'),
(3, 'test 3', '2020-08-03 00:00:00', 'Maiker Leon'),
(4, 'test 4', '2020-08-03 00:00:00', 'Maiker Leon'),
(5, 'test 5', '2020-08-03 00:00:00', 'Maiker Leon'),
(6, 'test 6', '2020-08-04 00:00:00', 'Maiker Leon'),
(7, 'test 7', '2020-08-04 00:00:00', 'Maiker Leon'),
(8, 'test 8', '2020-08-05 00:00:00', 'Maiker Leon'),
(9, 'test 9', '2020-08-06 00:00:00', 'Maiker Leon'),
(10, 'test 10', '2020-08-07 00:00:00', 'Maiker Leon'),
(11, 'test 11', '2020-08-09 00:00:00', 'Maiker Leon'),
(12, 'test 12', '2020-08-09 00:00:00', 'Maiker Leon'),
(13, 'test 13', '2020-08-09 00:00:00', 'Maiker Leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo_readaptador_atencion_diaria`
--

CREATE TABLE `trabajo_readaptador_atencion_diaria` (
  `idtrabajo_readaptador_atencion_diaria` int(10) UNSIGNED NOT NULL,
  `trabajo_readaptador_atencion_diaria` int(11) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idatencion_diaria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento_aplicado`
--

CREATE TABLE `tratamiento_aplicado` (
  `idtratamiento_aplicado` int(10) UNSIGNED NOT NULL,
  `nombre_tratamiento_aplicado` varchar(150) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tratamiento_aplicado`
--

INSERT INTO `tratamiento_aplicado` (`idtratamiento_aplicado`, `nombre_tratamiento_aplicado`, `fecha_software`, `nombre_usuario_software`) VALUES
(1, 'tratamiento x', '2020-07-26 00:00:00', 'Maiker Leon'),
(2, 'tratamiento z', '2020-07-26 00:00:00', 'Maiker Leon'),
(3, 'tratamiento v', '2020-07-26 00:00:00', 'Maiker Leon'),
(4, 'tratamiento g', '2020-07-26 00:00:00', 'Maiker Leon'),
(5, 'test 1', '2020-07-26 00:00:00', 'Maiker Leon'),
(6, 'test 2', '2020-07-27 00:00:00', 'Maiker Leon'),
(7, 'test 3', '2020-07-27 00:00:00', 'Maiker Leon'),
(8, 'test 4', '2020-08-03 00:00:00', 'Maiker Leon'),
(9, 'test 5', '2020-08-03 00:00:00', 'Maiker Leon'),
(10, 'test 6', '2020-08-03 00:00:00', 'Maiker Leon'),
(11, 'test 7', '2020-08-03 00:00:00', 'Maiker Leon'),
(12, 'test 8', '2020-08-03 00:00:00', 'Maiker Leon'),
(13, 'test 9', '2020-08-03 00:00:00', 'Maiker Leon'),
(14, 'test 10', '2020-08-03 00:00:00', 'Maiker Leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento_aplicado_atencion_diaria`
--

CREATE TABLE `tratamiento_aplicado_atencion_diaria` (
  `idtratamiento_aplicado_atencion_diaria` int(10) UNSIGNED NOT NULL,
  `nombre_tratamiento_atencion_diaria` varchar(150) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idatencion_diaria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas_lesion_atencion_diaria`
--

CREATE TABLE `zonas_lesion_atencion_diaria` (
  `idzonas_lesion_atencion_diaria` int(10) UNSIGNED NOT NULL,
  `codigo_zonas_lesion` varchar(45) DEFAULT NULL,
  `zona_lesion` varchar(2000) DEFAULT NULL,
  `fecha_software` datetime DEFAULT NULL,
  `nombre_usuario_software` varchar(150) DEFAULT NULL,
  `idatencion_diaria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alta_deportiva_atencion_diaria`
--
ALTER TABLE `alta_deportiva_atencion_diaria`
  ADD PRIMARY KEY (`idalta_deportiva_atencion_diaria`),
  ADD KEY `fk_alta_deportiva_atencion_diaria_atencion_diaria` (`idatencion_diaria`);

--
-- Indices de la tabla `archivo_pdf_jugador`
--
ALTER TABLE `archivo_pdf_jugador`
  ADD PRIMARY KEY (`idarchivo_pdf_jugador`),
  ADD KEY `fk_archivo_pdf_jugador_fichaJugador_id` (`idfichaJugador`);

--
-- Indices de la tabla `atencion_diaria`
--
ALTER TABLE `atencion_diaria`
  ADD PRIMARY KEY (`idatencion_diaria`),
  ADD KEY `fk_atencion_diaria_fichaJugador1_id` (`idfichaJugador`),
  ADD KEY `fk_atencion_diaria_contexto_incidente1_id` (`idcontexto_incidente`),
  ADD KEY `fk_atencion_diaria_informe_medico` (`idinforme_medico`);

--
-- Indices de la tabla `bono_jugador`
--
ALTER TABLE `bono_jugador`
  ADD PRIMARY KEY (`idbono_jugador`),
  ADD KEY `fk_bono_jugador_fichaJugador_id` (`idfichaJugador`);

--
-- Indices de la tabla `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`idclub`);

--
-- Indices de la tabla `contexto_incidente`
--
ALTER TABLE `contexto_incidente`
  ADD PRIMARY KEY (`idcontexto_incidente`);

--
-- Indices de la tabla `detalle_atencion_seguimiento`
--
ALTER TABLE `detalle_atencion_seguimiento`
  ADD PRIMARY KEY (`iddetalle_atencion_seguimiento`),
  ADD KEY `fk_detalle_atencion_seguimiento_seguimiento` (`idseguimiento`);

--
-- Indices de la tabla `detalle_evaluacion_jugador`
--
ALTER TABLE `detalle_evaluacion_jugador`
  ADD PRIMARY KEY (`iddetalle_evaluacion_jugador`),
  ADD KEY `fk_detalle_evaluacion_jugador_evaluacion_jugador` (`idevaluacion_jugador`),
  ADD KEY `fk_detalle_evaluacion_jugador_evaluacion_concepto` (`idevaluacion_concepto`);

--
-- Indices de la tabla `detalle_test_ocular`
--
ALTER TABLE `detalle_test_ocular`
  ADD PRIMARY KEY (`iddetalle_test_ocular`),
  ADD KEY `fk_detalle_test_ocular_test_ocular_id` (`idtest_ocular`),
  ADD KEY `fk_detalle_test_ocular_ficha_jugador_mc1_id` (`idficha_jugador_mc`);

--
-- Indices de la tabla `evaluacion_concepto`
--
ALTER TABLE `evaluacion_concepto`
  ADD PRIMARY KEY (`idevaluacion_concepto`);

--
-- Indices de la tabla `evaluacion_jugador`
--
ALTER TABLE `evaluacion_jugador`
  ADD PRIMARY KEY (`idevaluacion_jugador`),
  ADD KEY `fk_evaluacion_jugador_fichaJugador` (`idfichaJugador`);

--
-- Indices de la tabla `examen_solicitado_atencion_diaria`
--
ALTER TABLE `examen_solicitado_atencion_diaria`
  ADD PRIMARY KEY (`idexamen_solicitado_atencion_diaria`),
  ADD KEY `fk_examen_solicitado_atencion_diaria_atencion_diaria1_id` (`idatencion_diaria`);

--
-- Indices de la tabla `fichajugador`
--
ALTER TABLE `fichajugador`
  ADD PRIMARY KEY (`idfichaJugador`),
  ADD KEY `fk_fichaJugador_club` (`idclub`);

--
-- Indices de la tabla `ficha_jugador_mc`
--
ALTER TABLE `ficha_jugador_mc`
  ADD PRIMARY KEY (`idficha_jugador_mc`);

--
-- Indices de la tabla `informe_medico`
--
ALTER TABLE `informe_medico`
  ADD PRIMARY KEY (`idinforme_medico`),
  ADD KEY `fk_informe_medico_fichaJugador` (`idfichaJugador`);

--
-- Indices de la tabla `informe_mensual`
--
ALTER TABLE `informe_mensual`
  ADD PRIMARY KEY (`idinforme_mensual`);

--
-- Indices de la tabla `informe_mensual_area`
--
ALTER TABLE `informe_mensual_area`
  ADD PRIMARY KEY (`idinforme_mensual_area`),
  ADD KEY `fk_informe_mensual_area_informe_mensual` (`idinforme_mensual`);

--
-- Indices de la tabla `informe_mensual_mes`
--
ALTER TABLE `informe_mensual_mes`
  ADD PRIMARY KEY (`idinforme_mensual_mes`),
  ADD KEY `fk_informe_mensual_mes_informe_mensual` (`idinforme_mensual`);

--
-- Indices de la tabla `informe_mensual_serie`
--
ALTER TABLE `informe_mensual_serie`
  ADD PRIMARY KEY (`idinforme_mensual_serie`),
  ADD KEY `fk_informe_mensual_serie_informe_mensual` (`idinforme_mensual`);

--
-- Indices de la tabla `informe_semanal`
--
ALTER TABLE `informe_semanal`
  ADD PRIMARY KEY (`idinformesemanal`);

--
-- Indices de la tabla `informe_semanal_area`
--
ALTER TABLE `informe_semanal_area`
  ADD PRIMARY KEY (`idinformesemanalarea`),
  ADD KEY `fk_informe_semanal_area_id` (`idinformesemanal`);

--
-- Indices de la tabla `informe_semanal_serie`
--
ALTER TABLE `informe_semanal_serie`
  ADD PRIMARY KEY (`idinformesemanalserie`),
  ADD KEY `fk_informe_semanal_serie_id` (`idinformesemanal`);

--
-- Indices de la tabla `posicioncancha`
--
ALTER TABLE `posicioncancha`
  ADD PRIMARY KEY (`idposicionCancha`),
  ADD KEY `fk_posicionCancha_fichaJugador` (`idfichaJugador`);

--
-- Indices de la tabla `prestamo_ficha_jugador_mc`
--
ALTER TABLE `prestamo_ficha_jugador_mc`
  ADD PRIMARY KEY (`idprestamo_ficha_jugador_mc`),
  ADD KEY `fk_prestamo_ficha_jugador_mc_fichaJugador_id` (`idfichaJugador`);

--
-- Indices de la tabla `recomendacion_alta_atencion_diaria`
--
ALTER TABLE `recomendacion_alta_atencion_diaria`
  ADD PRIMARY KEY (`idrecomendacion_alta_atencion_diaria`),
  ADD KEY `fk_recomendacion_alta_atencion_diaria_atencion_diaria` (`idatencion_diaria`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`idseguimiento`),
  ADD KEY `fk_seguimiento_fichaJugador` (`idfichaJugador`);

--
-- Indices de la tabla `test_ocular`
--
ALTER TABLE `test_ocular`
  ADD PRIMARY KEY (`idtest_ocular`);

--
-- Indices de la tabla `trabajador_readatador`
--
ALTER TABLE `trabajador_readatador`
  ADD PRIMARY KEY (`idtrabajo_readatador`);

--
-- Indices de la tabla `trabajo_readaptador_atencion_diaria`
--
ALTER TABLE `trabajo_readaptador_atencion_diaria`
  ADD PRIMARY KEY (`idtrabajo_readaptador_atencion_diaria`),
  ADD KEY `fk_trabajo_readaptador_atencion_diaria_atencion_diaria` (`idatencion_diaria`);

--
-- Indices de la tabla `tratamiento_aplicado`
--
ALTER TABLE `tratamiento_aplicado`
  ADD PRIMARY KEY (`idtratamiento_aplicado`);

--
-- Indices de la tabla `tratamiento_aplicado_atencion_diaria`
--
ALTER TABLE `tratamiento_aplicado_atencion_diaria`
  ADD PRIMARY KEY (`idtratamiento_aplicado_atencion_diaria`),
  ADD KEY `fk_tratamiento_aplicado_atencion_diaria_atencion_diaria1_id` (`idatencion_diaria`);

--
-- Indices de la tabla `zonas_lesion_atencion_diaria`
--
ALTER TABLE `zonas_lesion_atencion_diaria`
  ADD PRIMARY KEY (`idzonas_lesion_atencion_diaria`),
  ADD KEY `fk_zonas_lesion_atencion_diaria_atencion_diaria` (`idatencion_diaria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alta_deportiva_atencion_diaria`
--
ALTER TABLE `alta_deportiva_atencion_diaria`
  MODIFY `idalta_deportiva_atencion_diaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_pdf_jugador`
--
ALTER TABLE `archivo_pdf_jugador`
  MODIFY `idarchivo_pdf_jugador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `atencion_diaria`
--
ALTER TABLE `atencion_diaria`
  MODIFY `idatencion_diaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bono_jugador`
--
ALTER TABLE `bono_jugador`
  MODIFY `idbono_jugador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `club`
--
ALTER TABLE `club`
  MODIFY `idclub` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `contexto_incidente`
--
ALTER TABLE `contexto_incidente`
  MODIFY `idcontexto_incidente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_atencion_seguimiento`
--
ALTER TABLE `detalle_atencion_seguimiento`
  MODIFY `iddetalle_atencion_seguimiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_evaluacion_jugador`
--
ALTER TABLE `detalle_evaluacion_jugador`
  MODIFY `iddetalle_evaluacion_jugador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_test_ocular`
--
ALTER TABLE `detalle_test_ocular`
  MODIFY `iddetalle_test_ocular` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `evaluacion_concepto`
--
ALTER TABLE `evaluacion_concepto`
  MODIFY `idevaluacion_concepto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `evaluacion_jugador`
--
ALTER TABLE `evaluacion_jugador`
  MODIFY `idevaluacion_jugador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `examen_solicitado_atencion_diaria`
--
ALTER TABLE `examen_solicitado_atencion_diaria`
  MODIFY `idexamen_solicitado_atencion_diaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fichajugador`
--
ALTER TABLE `fichajugador`
  MODIFY `idfichaJugador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT de la tabla `ficha_jugador_mc`
--
ALTER TABLE `ficha_jugador_mc`
  MODIFY `idficha_jugador_mc` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `informe_medico`
--
ALTER TABLE `informe_medico`
  MODIFY `idinforme_medico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `informe_mensual`
--
ALTER TABLE `informe_mensual`
  MODIFY `idinforme_mensual` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `informe_mensual_area`
--
ALTER TABLE `informe_mensual_area`
  MODIFY `idinforme_mensual_area` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `informe_mensual_mes`
--
ALTER TABLE `informe_mensual_mes`
  MODIFY `idinforme_mensual_mes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `informe_mensual_serie`
--
ALTER TABLE `informe_mensual_serie`
  MODIFY `idinforme_mensual_serie` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `informe_semanal`
--
ALTER TABLE `informe_semanal`
  MODIFY `idinformesemanal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `informe_semanal_area`
--
ALTER TABLE `informe_semanal_area`
  MODIFY `idinformesemanalarea` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `informe_semanal_serie`
--
ALTER TABLE `informe_semanal_serie`
  MODIFY `idinformesemanalserie` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `posicioncancha`
--
ALTER TABLE `posicioncancha`
  MODIFY `idposicionCancha` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamo_ficha_jugador_mc`
--
ALTER TABLE `prestamo_ficha_jugador_mc`
  MODIFY `idprestamo_ficha_jugador_mc` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recomendacion_alta_atencion_diaria`
--
ALTER TABLE `recomendacion_alta_atencion_diaria`
  MODIFY `idrecomendacion_alta_atencion_diaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `idseguimiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `test_ocular`
--
ALTER TABLE `test_ocular`
  MODIFY `idtest_ocular` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `trabajador_readatador`
--
ALTER TABLE `trabajador_readatador`
  MODIFY `idtrabajo_readatador` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `trabajo_readaptador_atencion_diaria`
--
ALTER TABLE `trabajo_readaptador_atencion_diaria`
  MODIFY `idtrabajo_readaptador_atencion_diaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tratamiento_aplicado`
--
ALTER TABLE `tratamiento_aplicado`
  MODIFY `idtratamiento_aplicado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tratamiento_aplicado_atencion_diaria`
--
ALTER TABLE `tratamiento_aplicado_atencion_diaria`
  MODIFY `idtratamiento_aplicado_atencion_diaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zonas_lesion_atencion_diaria`
--
ALTER TABLE `zonas_lesion_atencion_diaria`
  MODIFY `idzonas_lesion_atencion_diaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alta_deportiva_atencion_diaria`
--
ALTER TABLE `alta_deportiva_atencion_diaria`
  ADD CONSTRAINT `fk_alta_deportiva_atencion_diaria_atencion_diaria` FOREIGN KEY (`idatencion_diaria`) REFERENCES `atencion_diaria` (`idatencion_diaria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `archivo_pdf_jugador`
--
ALTER TABLE `archivo_pdf_jugador`
  ADD CONSTRAINT `fk_archivo_pdf_jugador_fichaJugador` FOREIGN KEY (`idfichaJugador`) REFERENCES `fichajugador` (`idfichaJugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `atencion_diaria`
--
ALTER TABLE `atencion_diaria`
  ADD CONSTRAINT `fk_atencion_diaria_contexto_incidente` FOREIGN KEY (`idcontexto_incidente`) REFERENCES `contexto_incidente` (`idcontexto_incidente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_atencion_diaria_fichaJugador` FOREIGN KEY (`idfichaJugador`) REFERENCES `fichajugador` (`idfichaJugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_atencion_diaria_informe_medico` FOREIGN KEY (`idinforme_medico`) REFERENCES `informe_medico` (`idinforme_medico`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bono_jugador`
--
ALTER TABLE `bono_jugador`
  ADD CONSTRAINT `fk_bono_jugador_fichaJugador` FOREIGN KEY (`idfichaJugador`) REFERENCES `fichajugador` (`idfichaJugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_atencion_seguimiento`
--
ALTER TABLE `detalle_atencion_seguimiento`
  ADD CONSTRAINT `fk_detalle_atencion_seguimiento_seguimiento` FOREIGN KEY (`idseguimiento`) REFERENCES `seguimiento` (`idseguimiento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_evaluacion_jugador`
--
ALTER TABLE `detalle_evaluacion_jugador`
  ADD CONSTRAINT `fk_detalle_evaluacion_jugador_evaluacion_concepto` FOREIGN KEY (`idevaluacion_concepto`) REFERENCES `evaluacion_concepto` (`idevaluacion_concepto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_evaluacion_jugador_evaluacion_jugador` FOREIGN KEY (`idevaluacion_jugador`) REFERENCES `evaluacion_jugador` (`idevaluacion_jugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_test_ocular`
--
ALTER TABLE `detalle_test_ocular`
  ADD CONSTRAINT `fk_detalle_test_ocular_ficha_jugador_mc` FOREIGN KEY (`idficha_jugador_mc`) REFERENCES `ficha_jugador_mc` (`idficha_jugador_mc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detalle_test_ocular_test_ocular` FOREIGN KEY (`idtest_ocular`) REFERENCES `test_ocular` (`idtest_ocular`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluacion_jugador`
--
ALTER TABLE `evaluacion_jugador`
  ADD CONSTRAINT `fk_evaluacion_jugador_fichaJugador` FOREIGN KEY (`idfichaJugador`) REFERENCES `fichajugador` (`idfichaJugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `examen_solicitado_atencion_diaria`
--
ALTER TABLE `examen_solicitado_atencion_diaria`
  ADD CONSTRAINT `fk_examen_solicitado_atencion_diaria_atencion_diaria` FOREIGN KEY (`idatencion_diaria`) REFERENCES `atencion_diaria` (`idatencion_diaria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fichajugador`
--
ALTER TABLE `fichajugador`
  ADD CONSTRAINT `fk_fichaJugador_club` FOREIGN KEY (`idclub`) REFERENCES `club` (`idclub`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `informe_medico`
--
ALTER TABLE `informe_medico`
  ADD CONSTRAINT `fk_informe_medico_fichaJugador` FOREIGN KEY (`idfichaJugador`) REFERENCES `fichajugador` (`idfichaJugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `informe_mensual_area`
--
ALTER TABLE `informe_mensual_area`
  ADD CONSTRAINT `fk_informe_mensual_area_informe_mensual` FOREIGN KEY (`idinforme_mensual`) REFERENCES `informe_mensual` (`idinforme_mensual`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `informe_mensual_mes`
--
ALTER TABLE `informe_mensual_mes`
  ADD CONSTRAINT `fk_informe_mensual_mes_informe_mensual` FOREIGN KEY (`idinforme_mensual`) REFERENCES `informe_mensual` (`idinforme_mensual`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `informe_mensual_serie`
--
ALTER TABLE `informe_mensual_serie`
  ADD CONSTRAINT `fk_informe_mensual_serie_informe_mensual` FOREIGN KEY (`idinforme_mensual`) REFERENCES `informe_mensual` (`idinforme_mensual`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `informe_semanal_area`
--
ALTER TABLE `informe_semanal_area`
  ADD CONSTRAINT `fk_informe_semanal_area` FOREIGN KEY (`idinformesemanal`) REFERENCES `informe_semanal` (`idinformesemanal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `informe_semanal_serie`
--
ALTER TABLE `informe_semanal_serie`
  ADD CONSTRAINT `fk_informe_semanal_serie` FOREIGN KEY (`idinformesemanal`) REFERENCES `informe_semanal` (`idinformesemanal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `posicioncancha`
--
ALTER TABLE `posicioncancha`
  ADD CONSTRAINT `fk_posicionCancha_fichaJugador` FOREIGN KEY (`idfichaJugador`) REFERENCES `fichajugador` (`idfichaJugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo_ficha_jugador_mc`
--
ALTER TABLE `prestamo_ficha_jugador_mc`
  ADD CONSTRAINT `fk_prestamo_ficha_jugador_mc_fichaJugador` FOREIGN KEY (`idfichaJugador`) REFERENCES `fichajugador` (`idfichaJugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `recomendacion_alta_atencion_diaria`
--
ALTER TABLE `recomendacion_alta_atencion_diaria`
  ADD CONSTRAINT `fk_recomendacion_alta_atencion_diaria_atencion_diaria` FOREIGN KEY (`idatencion_diaria`) REFERENCES `atencion_diaria` (`idatencion_diaria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD CONSTRAINT `fk_seguimiento_fichaJugador` FOREIGN KEY (`idfichaJugador`) REFERENCES `fichajugador` (`idfichaJugador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabajo_readaptador_atencion_diaria`
--
ALTER TABLE `trabajo_readaptador_atencion_diaria`
  ADD CONSTRAINT `fk_trabajo_readaptador_atencion_diaria_atencion_diaria` FOREIGN KEY (`idatencion_diaria`) REFERENCES `atencion_diaria` (`idatencion_diaria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tratamiento_aplicado_atencion_diaria`
--
ALTER TABLE `tratamiento_aplicado_atencion_diaria`
  ADD CONSTRAINT `fk_tratamiento_aplicado_atencion_diaria_atencion_diaria` FOREIGN KEY (`idatencion_diaria`) REFERENCES `atencion_diaria` (`idatencion_diaria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `zonas_lesion_atencion_diaria`
--
ALTER TABLE `zonas_lesion_atencion_diaria`
  ADD CONSTRAINT `fk_zonas_lesion_atencion_diaria_atencion_diaria` FOREIGN KEY (`idatencion_diaria`) REFERENCES `atencion_diaria` (`idatencion_diaria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
