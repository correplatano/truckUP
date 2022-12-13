-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2017 at 07:24 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `envio_mercancia`
--

CREATE TABLE `envio_mercancia` (
  `Envio_mercancia_id` int(10) NOT NULL,
  `Altura` int(9) NOT NULL,
  `Anchura` int(9) NOT NULL,
  `Profundidad` int(9) NOT NULL,
  `PesoKg` int(9) NOT NULL,
  `FechaSalida` date NOT NULL,
  `FechaMaxLlegada` date NOT NULL,
  `TipoID` int(11) NOT NULL,
  `DireccionSalida` varchar(100) NOT NULL,
  `CPSalida` int(5) NOT NULL,
  `DireccionLlegada` varchar(100) NOT NULL,
  `CPLlegada` int(5) NOT NULL,
  `NombreDest` varchar(100) DEFAULT NULL,
  `transportista_id` int(11) DEFAULT NULL,
  `remitente_destinatario_id` int(11) NOT NULL,
  `Aceptado` int(1) DEFAULT NULL,
  `NombreTransportista` varchar(100) DEFAULT NULL,
  `Matricula` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remitente_destinatario`
--

CREATE TABLE `remitente_destinatario` (
  `Remitente_destinatario_id` int(10) NOT NULL,
  `CifDni` varchar(9) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `NombreEmpresa` varchar(50) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` int(9) NOT NULL,
  `Direccion` varchar(150) NOT NULL,
  `CodigoPostal` int(5) NOT NULL,
  `Contrasenia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `remitente_destinatario`
--

INSERT INTO `remitente_destinatario` (`Remitente_destinatario_id`, `CifDni`, `Nombre`, `NombreEmpresa`, `Email`, `Telefono`, `Direccion`, `CodigoPostal`, `Contrasenia`) VALUES
(1, '3465477', 'peter', 'peter s.l.', 'peter@peter.com', 89978979, 'kilhiu,l', 12345, 'peter'),
(3, 'e64566', 'antonio', 'fthjn', 'antonio@antonio.com', 567567, 'thnjmf', 57567, 'antonio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `TipoID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`TipoID`, `Nombre`) VALUES
(1, 'SECO'),
(2, 'REFRIGERADO'),
(3, 'CONGELADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportista`
--

CREATE TABLE `transportista` (
  `Transportista_id` int(10) NOT NULL,
  `Cif` varchar(9) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `NombreEmpresa` varchar(50) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` int(9) NOT NULL,
  `Contrasenia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transportista`
--

INSERT INTO `transportista` (`Transportista_id`, `Cif`, `Nombre`, `NombreEmpresa`, `Email`, `Telefono`, `Contrasenia`) VALUES
(1, '', 'paco', 'paco s.l.', 'paco@paco.com', 78678688, 'paco');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `envio_mercancia`
--
ALTER TABLE `envio_mercancia`
  ADD PRIMARY KEY (`Envio_mercancia_id`),
  ADD KEY `FK_ENVIO_MERCANCIA_RTTE_DESTINATARIO` (`remitente_destinatario_id`),
  ADD KEY `FK_ENVIO_MERCANCIA_TRANSPORTISTA` (`transportista_id`);

--
-- Indices de la tabla `remitente_destinatario`
--
ALTER TABLE `remitente_destinatario`
  ADD PRIMARY KEY (`Remitente_destinatario_id`);

--
-- Indices de la tabla `transportista`
--
ALTER TABLE `transportista`
  ADD PRIMARY KEY (`Transportista_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `envio_mercancia`
--
ALTER TABLE `envio_mercancia`
  MODIFY `Envio_mercancia_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `remitente_destinatario`
--
ALTER TABLE `remitente_destinatario`
  MODIFY `Remitente_destinatario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transportista`
--
ALTER TABLE `transportista`
  MODIFY `Transportista_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--
ALTER TABLE `remitente_destinatario`
  ADD CONSTRAINT `AK_REMITENTE_DESTINATARIO_EMAIL` UNIQUE (`Email`);

ALTER TABLE `transportista`
  ADD CONSTRAINT `AK_TRANSPORTISTA_EMAIL` UNIQUE (`Email`);

--
-- Filtros para la tabla `envio_mercancia`
--
ALTER TABLE `envio_mercancia`
  ADD CONSTRAINT `FK_ENVIO_MERCANCIA_RTTE_DESTINATARIO` FOREIGN KEY (`remitente_destinatario_id`) REFERENCES `remitente_destinatario` (`Remitente_destinatario_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ENVIO_MERCANCIA_TRANSPORTISTA` FOREIGN KEY (`transportista_id`) REFERENCES `transportista` (`Transportista_id`) ON UPDATE CASCADE;
COMMIT;