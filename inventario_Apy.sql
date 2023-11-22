-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2023 a las 03:22:24
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `cantidad_compra` int(10) NOT NULL,
  `codigo_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `fecha_compra`, `cantidad_compra`, `codigo_producto`) VALUES
(1, '2023-11-21 00:00:00', 300, 1),
(4, '2023-11-21 05:21:09', 10, 3),
(5, '2023-11-21 05:22:48', 10, 1),
(6, '2023-11-21 05:56:49', 30, 1),
(7, '2023-11-21 05:57:02', 30, 886),
(8, '2023-11-21 06:06:39', 10, 5),
(9, '2023-11-21 19:26:12', 20, 889),
(10, '2023-11-21 19:29:09', 50, 889),
(11, '2023-11-21 19:30:01', 16, 889),
(12, '2023-11-21 19:30:44', 20, 889),
(13, '2023-11-21 19:31:53', 40, 889),
(14, '2023-11-21 20:01:02', 20, 889),
(15, '2023-11-21 20:01:42', 20, 890),
(16, '2023-11-21 20:02:06', 50, 890),
(17, '2023-11-21 20:02:37', 16, 890),
(18, '2023-11-21 20:02:53', 20, 890),
(19, '2023-11-21 20:03:14', 40, 890);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo_producto` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `precio` double NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `cantidad_stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo_producto`, `nombre`, `precio`, `fecha_vencimiento`, `cantidad_stock`) VALUES
(1, 'Leche', 10.7, '2023-12-05', 38),
(2, 'Lechuga', 1.1, '2025-12-05', 72),
(3, 'Blanqueador', 2.79, '2026-11-04', 33),
(4, 'aceite', 6.94, '2025-03-25', 27),
(5, 'Panela', 20, '2024-02-12', 43),
(885, 'Azucar Manuelita', 2.5, '2025-07-12', 20),
(886, 'pata', 3.5, '2025-11-12', 40),
(887, 'Tomate', 2, '2024-01-05', 10),
(888, 'Platano', 4, '2024-01-05', 1),
(889, 'queso', 4.5, '2024-01-05', 20),
(890, 'carne', 7.5, '2024-01-05', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL,
  `cantidades_vendidas` int(10) NOT NULL,
  `fk_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fecha_venta`, `cantidades_vendidas`, `fk_producto`) VALUES
(17, '2023-11-21 00:00:00', 11, 1),
(20, '2023-11-21 00:00:00', 40, 886),
(21, '2023-11-21 00:00:00', 30, 1),
(22, '2023-11-21 00:00:00', 10, 5),
(23, '2023-11-21 19:38:33', 80, 889),
(24, '2023-11-21 19:39:59', 5, 889),
(25, '2023-11-21 19:41:00', 100, 889),
(26, '2023-11-21 19:41:51', 11, 889),
(27, '2023-11-21 20:06:40', 80, 890),
(28, '2023-11-21 20:07:07', 5, 890),
(29, '2023-11-21 20:07:31', 100, 890),
(30, '2023-11-21 20:07:59', 11, 890);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `codigo_producto` (`codigo_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo_producto`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codigo_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=891;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`codigo_producto`) REFERENCES `productos` (`codigo_producto`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`fk_producto`) REFERENCES `productos` (`codigo_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
