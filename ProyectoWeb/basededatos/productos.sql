-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-08-2024 a las 16:54:49
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ferreteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `fechaIngreso` date NOT NULL,
  `detalle` text NOT NULL,
  `precioUnitario` decimal(10,2) NOT NULL,
  `precioVenta` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `nombre`, `cantidad`, `categoria`, `fechaIngreso`, `detalle`, `precioUnitario`, `precioVenta`) VALUES
(29, 'hjh', 45, 'Herramientas', '0005-05-05', '454', '54.00', NULL),
(30, 'Daniela', 7, 'Electrodomésticos', '2024-08-07', 'dsd', '7.00', NULL),
(31, 'HOla', 12, 'Electrodomésticos', '2024-08-28', 'si', '2.00', NULL),
(32, 'HOla', 12, 'Electrodomésticos', '2024-08-28', 'si', '2.00', NULL),
(33, 'HOla', 12, 'Electrodomésticos', '2024-08-28', 'si', '2.00', NULL),
(34, 'HOla', 12, 'Electrodomésticos', '2024-08-28', 'si', '2.00', NULL),
(35, 'HOla', 12, 'Electrodomésticos', '2024-08-28', 'si', '2.00', NULL),
(36, 'tornillo', 12, 'Herramientas', '2024-08-28', 'nuevo ingreso', '2.00', NULL),
(37, 'hola', 46, 'Herramientas', '2024-08-08', 'oy', '2.00', NULL),
(38, 'Dilan Tituaña', 12, 'Electrodomésticos', '2024-08-19', 'era', '2.00', NULL),
(39, 'sasasa', 3, 'Materiales', '2024-08-28', 'prueba', '5.00', NULL),
(40, 'dsd', 2, 'Herramientas', '2024-08-29', 'editado', '5.00', NULL),
(41, 'dsd', 2, 'Materiales', '2024-08-28', 'sx', '5.00', NULL),
(42, 'nuevo', 2, 'Herramientas', '2024-08-28', 'dd', '5.00', NULL),
(43, 'Daniela', 2, 'Herramientas', '2024-08-28', '12', '4.00', NULL),
(44, 'dsds', 4, 'Herramientas', '7777-07-07', '4hj', '45.00', NULL),
(49, 'dsds', 4, 'Accesorios', '7777-07-07', 'editado', '45.00', NULL),
(50, 'Daniela', 4, 'Herramientas', '0004-04-04', '5', '4.00', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
