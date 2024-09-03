-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2023 a las 18:44:36
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `documentador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigos`
--

CREATE TABLE `codigos` (
  `id` int(11) NOT NULL,
  `num_codigo` varchar(100) NOT NULL,
  `nombre_codigo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `codigos`
--

INSERT INTO `codigos` (`id`, `num_codigo`, `nombre_codigo`) VALUES
(1, '#1.1', 'RELIZAR OBRA CIVIL'),
(2, '#1.1.1', 'ADECUACIONES FISICAS'),
(3, '#1.1.2', 'ADECUACIONES ELECTRICAS'),
(4, '#1.1.3', 'CANALIZACÓN INGRESO'),
(5, '#1.1.4', 'INSTALACIÓN RACK'),
(6, '#1.2', 'REALIZAR ENERGIZACIÓN'),
(7, '#1.3', 'GESTIONAR PERMISOS DE INGRESO'),
(8, '#1.4', 'CONFIRMAR CRONOGRAMA'),
(9, '#1.5', 'REALIZAR AFINAMIENTO Y CONSERVACIÓN'),
(10, '#1.6', 'APROBACION COSTOS'),
(11, '#1.7', 'APROBACIÓN VM'),
(12, '#1.8', 'PRUEBAS CLIENTE'),
(13, '#1.9', 'CONFIRMACIÓN DE DATOS'),
(14, '#1.10', 'CONFIGURACION LAN CLIENTE'),
(16, '#1.11', 'ENVIO FORMATOS'),
(17, '#1.12', 'INGRESO EQUIPOS DC'),
(18, '#1.13', 'APROBACIÓN ALCANCE'),
(19, '#1.14', 'CONFIGURACIONES CLIENTE'),
(20, '#2.1', 'REPARAR ANILLO'),
(21, '#2.2', 'APROBACIÓN COSTOS'),
(22, '#2.3', 'GESTIONAR COMPRA EQUIPOS'),
(23, '#2.4', 'PLATAFORMA'),
(24, '#2.5', 'AMPLIACIÓN RED'),
(25, '#2.6', 'ADQUISICIÓN ELEMENTOS SOLUCIONES ATIPICAS'),
(26, '#2.7', 'ADQUISICIÓN SOFTWARE Y LICENCIAMIENTO'),
(27, '#3.1', 'CORRECCIÓN NEGOCIACIÓN ALIADO\r\n'),
(28, '#3.2', 'DIMENSIONAMIENTO EQUIPOS\r\n'),
(29, '#3.3', 'DIMENSIONAMIENTO ALCANCE SOLICITUD'),
(30, '#3.4', 'RENOVACION NEGOCIACIONES ALIADOS'),
(31, '#3.5', 'NUEVA VIABILIDAD'),
(32, '#3.6', 'REVISION ALCANCE SOLUCION'),
(33, '#4.1', 'APROBAR DECLINACIÓN OC'),
(34, '#4.2', 'APROBAR COSTOS DE OC\r\n'),
(35, '#4.3', 'PENDIENTE INGRESO DE OC COMPLEMENTO'),
(36, '#4.4', 'CORRECCION DIRECCION DE INSTALACION'),
(37, '#4.5', 'INFORMACIÓN NUMERO CONTRATO'),
(38, '#4.6', 'FIRMA ACTA DE INICIO'),
(39, '#5.1', 'CONDICIONES CLIMATICAS'),
(40, '#5.2', 'CONFLICTO ARMADO'),
(41, '#5.3', 'VANDALISMO EN LA ZONA'),
(42, '#6.1', 'ENTREGAR CRONOGRAMA A CLIENTE'),
(43, '#6.2', 'ENTREGAR CRONOGRAMA OPERACIÓN'),
(44, '#6.3', 'CRONOGRAMA EN CURSO'),
(45, '#6.4', 'GESTION CALIDAD TERCEROS'),
(46, '#6.5', 'GESTION SUPERVISION DE CONTRATO'),
(47, '#6.6', 'DESPACHO DE EQUIPOS'),
(48, '#6.7', 'ENTREGA CANAL CONECTIVIDAD'),
(49, '#6.8', 'CONFIGURACION DATACENTER'),
(50, '#6.9', 'APROBACIÓN PERMISOS ELECTRIFICADORA'),
(51, '#6.10', 'APROBACIÓN PERMISOS IDU'),
(52, '#6.11', 'APROBACIÓN PERMISOS ALCALDÍA'),
(53, '#6.12', 'APROBACIÓN PERMISOS PLANEACIÓN'),
(54, '#6.13', 'APROBACIÓN PERMISOS SEC. MOVILIDAD'),
(55, '#6.14', 'APROBACIÓN PERMISOS POLICÍA'),
(56, '#6.15', 'ENTREGA CRONOGRAMA INSTALACION'),
(57, '#6.16', 'CONFIGURACION CANAL'),
(58, '#6.17', 'GARANTIA CANAL'),
(59, '#6.18', 'REPORTE VISITA VIABILIDAD'),
(60, '#6.19', 'ENTREGA ACTA'),
(61, '#6.20', 'FIRMA OS'),
(62, '#6.21', 'ADECUACIONES FISICAS'),
(63, '#6.22', 'GARANTIA ADECUACIONES FISICAS'),
(64, '#6.23', 'CONFIGURACIONES GESTION DOCUMENTAL'),
(65, '#7.1', 'LIBERACION RECURSOS'),
(66, '#7.2', 'CIERRE TAREAS'),
(67, '#7.3', 'ELABORAR OS DECLINACION'),
(68, '#7.4', 'REPETIR VIABILIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre_estado`) VALUES
(1, 'EN ESPERA COMERCIAL'),
(2, 'EN ESPERA INTERNA ETB'),
(3, 'EN ESPERA POR CLIENTE'),
(4, 'EN ESPERA POR TERCEROS/ALIADOS'),
(5, 'EN OPERACIÓN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(100) NOT NULL,
  `id_aprovisionamiento` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `estado_actual` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha_creacion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ans` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cuenta_cliente` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `asignado_a` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ciudad_instalacion` varchar(100) NOT NULL,
  `u_anotacion_resumen` varchar(100) NOT NULL,
  `segmento` varchar(100) NOT NULL,
  `estado_historial` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `codigo_historial` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `info_codigo_historial` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `observaciones_historial` varchar(3000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oc`
--

CREATE TABLE `oc` (
  `id` int(100) NOT NULL,
  `id_aprovisionamiento` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `estado_actual` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha_creacion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ans` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cuenta_cliente` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `asignado_a` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ciudad_instalacion` varchar(100) NOT NULL,
  `u_anotacion_resumen` varchar(3000) NOT NULL,
  `segmento` varchar(100) NOT NULL,
  `estado_oc` varchar(100) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(2, 'Documentador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(1000) NOT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `clave`, `nombre_usuario`, `estado`, `id_rol`) VALUES
(27, 'Administrador', 'a@hotmail.com', '$2y$10$N3ZnbAS8UKmjxxAblQxki.xQNJrjx9sivDoTmCXVAKQjtHoPSYwx2', 'Admin', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `codigos`
--
ALTER TABLE `codigos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oc`
--
ALTER TABLE `oc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `rol_id` (`id_rol`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `codigos`
--
ALTER TABLE `codigos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oc`
--
ALTER TABLE `oc`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
