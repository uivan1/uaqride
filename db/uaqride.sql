-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-03-2020 a las 06:43:26
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uaqride`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `infoViaje` (IN `_idViaje` INT)  BEGIN
DECLARE v INTEGER;
DECLARE v2 INTEGER;
DECLARE res INTEGER;
set v=(SELECT v.lugares FROM viajes v WHERE v.idViaje=_idViaje);
set v2=(SELECT count(*) FROM usuarios_viaje WHERE idViaje=_idViaje);
set res=v-v2;
SELECT v.*,res FROM viajes v WHERE v.idViaje=_idViaje;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `reserva` (`_idViaje` INT, `_idUsuario` INT) RETURNS TINYINT(4) BEGIN
DECLARE bandera INTEGER;
DECLARE Usuario INTEGER;
SET Usuario=(SELECT idUsuario FROM viajes WHERE idViaje=_idViaje);
IF(Usuario=_idUsuario) THEN
	return 0;-- Este viaje es tuyo
ELSEIF EXISTS(SELECT * from usuarios_viaje WHERE idUsuario=_idUsuario AND idViaje=_idViaje) THEN
		RETURN 2;
	ELSEIF((SELECT v.lugares FROM viajes v WHERE idViaje=_idViaje)=(SELECT count(*) FROM usuarios_viaje WHERE idViaje=_idViaje))THEN
		return 3;
	ELSE
		INSERT INTO usuarios_viaje (idViaje,idUsuario) VALUES (_idViaje,_idUsuario);
		RETURN 1;
	END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `facultad` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `rutaFoto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellido`, `facultad`, `correo`, `username`, `pass`, `fechaNac`, `rutaFoto`) VALUES
(23, 'ulises', '', 'Informática', 'ulises.jicote2@gmail.com', 'cruz', '25d55ad283aa400af464c76d713c07ad', '1998-05-29', ''),
(29, 'andrea', '', 'Informática', 'andi@pandi.com', 'andi', '25d55ad283aa400af464c76d713c07ad', '1998-05-29', ''),
(30, 'Ulises Iván Cruz Romero', '', 'Informática', 'ulises.jicote@gmail.com', 'uivan', '25d55ad283aa400af464c76d713c07ad', '1998-05-29', 'WIN_20180809_09_30_30_Pro.jpg'),
(31, 'Daniela Sanchez', '', 'Informática', 'dani@sanchez.com', 'dani', '25d55ad283aa400af464c76d713c07ad', '1998-03-29', 'img1.jpg'),
(32, 'Brandom', '', 'Medicina', 'rangel@a.com', 'randall', '25d55ad283aa400af464c76d713c07ad', '1998-06-25', 'img8.jpg'),
(33, 'Claudia Bernal', '', 'Informática', 'clau@bernal.com', 'clau', '25d55ad283aa400af464c76d713c07ad', '1995-12-13', ''),
(35, 'Jesus Vargas A', '', 'Informática', 'jesus@gg.com', 'jesus', 'd41d8cd98f00b204e9800998ecf8427e', '1998-10-10', 'WIN_20180115_16_49_25_Pro.jpg'),
(36, 'Brandon R', '', 'Informática', 'brandon@gmail.com', 'BrandonR', 'd41d8cd98f00b204e9800998ecf8427e', '1998-08-24', ''),
(37, 'Daniela Sanchez', '', 'Informática', 'danielasanchez@hotmail.com', 'danielas', 'ff1aa48d1d7553e106ee8e96ff9d8b21', '1997-10-27', ''),
(38, 'eduardo', '', 'informatica', 'lalo@uaq.mx', 'lalo', 'd41d8cd98f00b204e9800998ecf8427e', '1990-06-10', 'guapos.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_viaje`
--

CREATE TABLE `usuarios_viaje` (
  `idUsuarioViaje` int(11) NOT NULL,
  `idViaje` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios_viaje`
--

INSERT INTO `usuarios_viaje` (`idUsuarioViaje`, `idViaje`, `idUsuario`) VALUES
(1, 19, 1),
(2, 19, 23),
(3, 21, 30),
(4, 17, 30),
(7, 25, 31),
(8, 19, 31),
(9, 25, 36),
(13, 17, 37),
(14, 17, 38);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `idViaje` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `origen` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `destino` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `escalas` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `salida` datetime NOT NULL,
  `idayvuelta` tinyint(4) NOT NULL,
  `lugares` int(11) NOT NULL,
  `precio` double NOT NULL,
  `finalizado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`idViaje`, `idUsuario`, `origen`, `destino`, `escalas`, `salida`, `idayvuelta`, `lugares`, `precio`, `finalizado`) VALUES
(17, 23, 'San Juan del Rio, Qro., México', 'Querétaro, Qro., México', 'Pedro Escobedo-Santiago de Querétaro, Querétaro, México', '2018-12-11 10:10:00', 1, 3, 50, 0),
(19, 30, 'San Juan del Rio, Qro., México', 'Querétaro, Qro., México', 'Pedro Escobedo-Santiago de Querétaro, Querétaro, México', '2018-12-12 10:10:00', 1, 3, 50, 0),
(21, 23, 'UAQ Juriquilla, Boulevard Villas del Meson, Montenegro, Qro., México', 'U.A.Q., Santiago de Querétaro, Qro., México', 'Salitre, Qro., México', '2018-12-11 10:10:00', 1, 1, 46, 0),
(22, 23, 'UAQ Juriquilla, Boulevard Villas del Meson, Montenegro, Qro., México', 'San José el Alto, Qro., México', 'Salitre, Qro., México', '2018-12-11 10:10:00', 1, 1, 46, 0),
(25, 32, 'San Juan del Rio, Qro., México', 'Querétaro, Qro., México', 'San Gil, Qro., México', '2018-12-15 09:00:00', 1, 2, 62, 0),
(26, 35, 'Cerro de las Campanas, U.A.Q., Santiago de Querétaro, Qro., México', 'Juriquilla, Qro., México', 'Desarrollo San Pablo, Santiago de Querétaro, Qro., México', '2018-12-14 12:30:00', 0, 4, 50, 0),
(27, 31, 'Centro, Querétaro, Qro., México', 'Niños Heroes, Santiago de Querétaro, Qro., México', 'Templo de Santa Rosa de Viterbo, Centro, Santiago de Querétaro, Qro., México', '2018-12-13 22:00:00', 0, 2, 50, 1),
(28, 36, 'Cerrito Colorado, Santiago de Querétaro, Qro., México', 'UAQ Juriquilla, Boulevard Villas del Meson, Montenegro, Qro., México', 'Antea Lifestyle Center, Carretera San Luis Potosí Querétaro, Querétaro, México', '2019-01-01 08:00:00', 1, 3, 35, 0),
(29, 37, 'Alameda, Santiago de Querétaro, Qro., México', 'UAQ Juriquilla, Boulevard Villas del Meson, Montenegro, Qro., México', 'Parada De La Obrera, 5 de Febrero, Santiago de Querétaro, GTO, México', '2018-12-14 11:30:00', 0, 4, 50, 0),
(30, 38, 'Juriquilla, Qro., México', 'Cortazar, Gto., México', 'Apaseo el Grande, Gto., México', '2018-12-14 01:00:00', 1, 3, 20, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuarios_viaje`
--
ALTER TABLE `usuarios_viaje`
  ADD PRIMARY KEY (`idUsuarioViaje`),
  ADD KEY `idViaje` (`idViaje`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`idViaje`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `usuarios_viaje`
--
ALTER TABLE `usuarios_viaje`
  MODIFY `idUsuarioViaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `idViaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios_viaje`
--
ALTER TABLE `usuarios_viaje`
  ADD CONSTRAINT `usuarios_viaje_ibfk_1` FOREIGN KEY (`idViaje`) REFERENCES `viajes` (`idViaje`);

--
-- Filtros para la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
