-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-08-2024 a las 03:39:44
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
CREATE DATABASE IF NOT EXISTS `ferreteria` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ferreteria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credenciales`
--

CREATE TABLE `credenciales` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `accesos` varchar(150) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `credenciales`
--

INSERT INTO `credenciales` (`id`, `usuario`, `contraseña`, `rol`, `nombre`, `apellido`, `descripcion`, `accesos`, `estado`) VALUES
(1, 'admin', 'admin', 'admin', 'gustavo', 'molina', 'perfil de usuario administrador con acceso a todos los elementos del menú', 'usuarios, proveedores, clientes, reportes, perfil de usuarios', 'Activo'),
(2, 'alexis', 'pass1', 'bodeguero', 'alexis', 'chimba', 'perfil de usuario bodeguero con acceso al inventario de productos (ingreso, eliminacion, actualizacion)', 'este perfil tiene accesos a productos, proveedores y reportes ', 'Activo'),
(0, 'gsmolina', 'hola123', 'admin', 'Gustavo Stiven', 'Molina Guaico', 'este usuario puede hacer lo que quiera', 'este usuario puede hacer lo que quiera', 'Activo');
--
-- Base de datos: `persona`
--
CREATE DATABASE IF NOT EXISTS `persona` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `persona`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(12) NOT NULL,
  `birthday` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`name`, `lastname`, `email`, `age`, `birthday`) VALUES
('Gustavo Stiven', 'Molina Guaico', 'stevemolin2001@hotmail.com', 0, '2024-08-09'),
('Maria Fernanda ', 'Molina Guaico', 'stevemolin201@hotmail.com', 22, '2001-11-09');
--
-- Base de datos: `personal`
--
CREATE DATABASE IF NOT EXISTS `personal` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `personal`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `email` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ecivil` varchar(30) NOT NULL,
  `fnacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `nombre`, `apellido`, `cedula`, `email`, `ecivil`, `fnacimiento`) VALUES
(6, 'Gustavo Stiven', 'Molina Lopez', '1723548101', 'stevemolin2001@hotmail.com', 'Casado', '2001-11-09'),
(7, 'Maria Fernanda', 'Molina Guaico', '1753354313', 'stevemolin2017@hotmail.com', 'Divorciado', '1999-10-23'),
(8, 'Christian Paul', 'Molina Guaico', '1723548102', 'stevemolin2002@hotmail.com', 'Casado', '2024-08-30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Base de datos: `productos`
--
CREATE DATABASE IF NOT EXISTS `productos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `productos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosproductos`
--

CREATE TABLE `datosproductos` (
  `id` int(11) NOT NULL,
  `pronombre` varchar(50) NOT NULL,
  `precio` int(10) NOT NULL,
  `cantidad` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datosproductos`
--

INSERT INTO `datosproductos` (`id`, `pronombre`, `precio`, `cantidad`, `categoria`) VALUES
(2, 'Manzana', 50, '60', 'Fruta'),
(3, 'Pera', 50, '100', 'Fruta');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datosproductos`
--
ALTER TABLE `datosproductos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datosproductos`
--
ALTER TABLE `datosproductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
