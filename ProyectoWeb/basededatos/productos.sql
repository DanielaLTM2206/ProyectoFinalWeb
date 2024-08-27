-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-08-2024 a las 22:35:00
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
(1, 'manzana', 41, '', '2024-08-27', 'jdkajdkad dajdkajda djakdakdjaiwdjwadkwodkwd dwidwodwidw', '45.00', '54.00'),
(2, 'martillo', 12, 'Herramientas', '2024-08-27', 'dewdwdwde', '3.00', '3.00'),
(3, 'martillo', 45, 'Herramientas', '2024-08-27', 'dwdqad', '4.00', NULL);

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
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
