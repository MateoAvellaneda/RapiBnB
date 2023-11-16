-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-11-2023 a las 21:08:41
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rapibnb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `idAlq` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `coordenadas` varchar(255) NOT NULL,
  `etiquetas` varchar(255) NOT NULL,
  `fotos` varchar(1000) NOT NULL,
  `servicios` varchar(255) NOT NULL,
  `costoDia` float(8,2) NOT NULL,
  `minTiempo` int(11) NOT NULL,
  `maxTiempo` int(11) NOT NULL,
  `cupo` int(11) NOT NULL,
  `fechaIni` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `idUsu` int(11) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 0,
  `fechaEspera` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`idAlq`, `titulo`, `descripcion`, `coordenadas`, `etiquetas`, `fotos`, `servicios`, `costoDia`, `minTiempo`, `maxTiempo`, `cupo`, `fechaIni`, `fechaFin`, `idUsu`, `provincia`, `ciudad`, `activo`, `fechaEspera`) VALUES
(26, 'Cabaña San Martin de los Andes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et efficitur ligula. Suspendisse ut odio auctor, pellentesque ipsum at, auctor mi. Praesent ipsum dolor, semper sit amet malesuada eget, blandit ut ipsum.', '-40.15580139249764,-71.3546211726498', 'Cabaña', 'Enrique1/foto1.jpg,Enrique1/foto2.jpg,Enrique1/foto3.jpg', 'Agua,Gas envasado,Electricidad', 4000.00, 4, 6, 5, '2023-11-15', '2023-12-08', 10, 'Neuquén', 'San Martin de los Andes', 1, '2023-11-16 07:03:30'),
(27, 'Cabañas Sierras de Cordoba', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et efficitur ligula. Suspendisse ut odio auctor, pellentesque ipsum at, auctor mi. Praesent ipsum dolor, semper sit amet malesuada eget, blandit ut ipsum. Nulla lacus tortor', '-32.07299402377129,-64.53980112215505', 'Cabaña', 'Enrique2/foto1.JPG', 'Internet,Agua,Gas Natural,Electricidad', 6000.00, 2, 6, 4, NULL, NULL, 10, 'Córdoba', 'Sierras de Cordoba', 1, NULL),
(28, 'Complejo los Espinillos', 'Nunc in leo sed risus rhoncus rhoncus nec id turpis. Pellentesque quis est quis lectus convallis vulputate ut vitae felis. Etiam fringilla magna quis odio dapibus', '-32.3408133276872,-64.99950242112392', 'Cabaña', 'Enrique3/foto1.jpg,Enrique3/foto2.jpg,Enrique3/foto3.png', 'Agua,Electricidad', 7500.00, 4, 8, 2, '2023-11-23', NULL, 10, 'San Luis', 'Merlo', 1, NULL),
(29, 'Hotel Tronador', 'vitae tristique elit pellentesque. Donec vitae purus quis magna tempor pretium non non est. Cras quis ligula erat. Ut tempus, justo sit amet tincidunt porttitor, odio ante rutrum lectus, a egestas ex leo tincidunt quam. Suspendisse dapibus fermentum nunc sed cursus. Vivamus vel scelerisque metus. Mauris ', '-37.96634161135527,-57.5450626910606', 'Hotel,Playa', 'Luis12341/foto1.jpg,Luis12341/foto2.png', 'Internet,Agua,Electricidad', 11000.00, 3, 20, 2, NULL, NULL, 12, 'Buenos Aires', 'Mar del Plata', 0, '2023-11-16 07:40:19'),
(30, 'Cabañas flotantes', 'tur a sem id, tincidunt convallis lacus. Nam in mi vel nunc consectetur feugiat nec quis massa. Praesent tristique cursus ante eget convallis. Aenean hendrerit orci vitae dui fringilla fringilla. Proin mollis ante sed interdum tincidunt. Donec accumsan tempor aliquam. Phasellus lacinia fringilla massa, in elementum erat.', '-34.74913532826408,-68.02484896034002', 'Cabaña', 'pepe111111/foto1.jpg,pepe111111/foto2.jpg', 'Agua,Gas envasado,Electricidad', 7800.00, 2, 8, 3, NULL, '2023-12-23', 13, 'Mendoza', 'San Rafael', 1, '2023-11-16 07:44:25'),
(31, 'Las Cortaderas Bosque Peralta', 'Curabitur feugiat diam non urna imperdiet placerat. Nam tempus blandit nisi nec bibendum. Praesent eu lacinia tellus. Nulla facilisi. Quisque volutpat sed eros sit amet commodo. Sed leo nibh, rutrum ac mattis quis, imperdiet non lectus. Nulla eu facilisis ipsum.', '-38.08145320132567,-57.561157465679585', 'Cabaña,Playa', 'Rodolfo2221/foto1.jpg,Rodolfo2221/foto2.jpg,Rodolfo2221/foto3.jpg', 'Internet,Agua,Gas Natural,Electricidad', 15000.00, 4, 15, 4, '2023-11-25', '2023-12-28', 14, 'Buenos Aires', 'Mar del Plata', 1, '2023-11-16 16:12:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertasaceptadas`
--

CREATE TABLE `ofertasaceptadas` (
  `id` int(11) NOT NULL,
  `idPerfil` int(11) NOT NULL,
  `idAlq` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cantPersonas` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT 'espera'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertasaceptadas`
--

INSERT INTO `ofertasaceptadas` (`id`, `idPerfil`, `idAlq`, `fechaIni`, `fechaFin`, `nombre`, `telefono`, `email`, `cantPersonas`, `estado`) VALUES
(5, 16, 30, '2023-11-23', '2023-11-27', 'Rodolfo Gonzales', '2444765432', 'rodolf@hotmail.com', 3, 'finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertasdealquiler`
--

CREATE TABLE `ofertasdealquiler` (
  `idOferta` int(11) NOT NULL,
  `idAlq` int(11) NOT NULL,
  `idPerfil` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cantPersonas` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL,
  `estado` varchar(100) NOT NULL DEFAULT 'pendiente',
  `fechaOferta` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertasdealquiler`
--

INSERT INTO `ofertasdealquiler` (`idOferta`, `idAlq`, `idPerfil`, `nombre`, `telefono`, `email`, `cantPersonas`, `fechaIni`, `fechaFin`, `estado`, `fechaOferta`) VALUES
(13, 30, 16, 'Rodolfo Gonzales', '2444765432', 'rodolf@hotmail.com', 3, '2023-11-23', '2023-11-27', 'aceptada', '2023-11-13 19:14:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `idPerfil` int(11) NOT NULL,
  `idUsu` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `apellido` varchar(200) DEFAULT NULL,
  `tipoDoc` varchar(100) DEFAULT NULL,
  `numDoc` int(11) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `intereses` varchar(255) DEFAULT NULL,
  `verificado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`idPerfil`, `idUsu`, `nombre`, `apellido`, `tipoDoc`, `numDoc`, `foto`, `intereses`, `verificado`) VALUES
(12, 10, 'Enrique', 'Perez', 'Pasaporte', 29333456, '/App/Images/ImagenesPerfil/Enrique.jpg', 'Cabaña,Montañas', 1),
(13, 11, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(14, 12, 'Luis', 'Avellaneda', 'DNI', 15788528, '/App/Images/ImagenesPerfil/Luis1234.jpg', 'Cabaña,Montañas', 0),
(15, 13, 'Pepe Manuel', 'Ramirez', 'Pasaporte', 12345678, '/App/Images/ImagenesPerfil/pepe11111.jpg', 'Playa', 0),
(16, 14, 'Rodolfo', 'Garcia', 'DNI', 33567090, '/App/Images/ImagenesPerfil/Rodolfo222.jpg', 'Playa', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseñas`
--

CREATE TABLE `reseñas` (
  `idOferta` int(11) DEFAULT NULL,
  `idReseña` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `texto` varchar(1200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestasresenias`
--

CREATE TABLE `respuestasresenias` (
  `idResenia` int(11) NOT NULL,
  `idRespuesta` int(11) NOT NULL,
  `texto` varchar(1200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudesdeverificacion`
--

CREATE TABLE `solicitudesdeverificacion` (
  `id` int(11) NOT NULL,
  `idPerfil` int(11) NOT NULL,
  `documentoFrente` varchar(255) NOT NULL,
  `documentoDorso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsu` int(11) NOT NULL,
  `nombreUsu` varchar(200) NOT NULL,
  `passw` varchar(200) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsu`, `nombreUsu`, `passw`, `gmail`, `isAdmin`) VALUES
(10, 'Enrique', '$2y$10$qQ0SBV84qnHWciCqDGl.3u/PA94keAaY94a/jyvxZzikdEusVnsje', 'enrique@gmail.com', 0),
(11, 'admin', '$2y$10$cBixNFfAAUg4psvbIHyMy.wME3Nk2Hyhe9hAUKc7WTLFNkwQUvDM6', 'admin@admin.com', 1),
(12, 'Luis1234', '$2y$10$AdWIXGk8YvrbB1ehbMIM/uq.rgTFc5z/kRXCBQOTqbMPbOrYWkT6W', 'Luis@yahoo.com.ar', 0),
(13, 'pepe11111', '$2y$10$DloQNIEgoCN3qFbP5JCh1uBfGdOKMGYI05f4JZfEj4HbYU4BAkHyq', 'pepe@gmail.com', 0),
(14, 'Rodolfo222', '$2y$10$SajSalUxxmBeL99f8eUgVOWyWtzXxBacKh1ib/f32ESaL2G3CYOG6', 'rodolf@hotmail.com', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`idAlq`),
  ADD KEY `FK_Usuario` (`idUsu`);

--
-- Indices de la tabla `ofertasaceptadas`
--
ALTER TABLE `ofertasaceptadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPerfil` (`idPerfil`),
  ADD KEY `idAlq` (`idAlq`);

--
-- Indices de la tabla `ofertasdealquiler`
--
ALTER TABLE `ofertasdealquiler`
  ADD PRIMARY KEY (`idOferta`),
  ADD KEY `idAlq` (`idAlq`),
  ADD KEY `idPerfil` (`idPerfil`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`idPerfil`),
  ADD KEY `idUsu` (`idUsu`);

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`idReseña`),
  ADD KEY `idOferta` (`idOferta`);

--
-- Indices de la tabla `respuestasresenias`
--
ALTER TABLE `respuestasresenias`
  ADD PRIMARY KEY (`idRespuesta`),
  ADD KEY `idResenia` (`idResenia`);

--
-- Indices de la tabla `solicitudesdeverificacion`
--
ALTER TABLE `solicitudesdeverificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPerfil` (`idPerfil`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsu`),
  ADD UNIQUE KEY `gmail` (`gmail`),
  ADD UNIQUE KEY `nombreUsu` (`nombreUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `idAlq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `ofertasaceptadas`
--
ALTER TABLE `ofertasaceptadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ofertasdealquiler`
--
ALTER TABLE `ofertasdealquiler`
  MODIFY `idOferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `idPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `idReseña` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `respuestasresenias`
--
ALTER TABLE `respuestasresenias`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudesdeverificacion`
--
ALTER TABLE `solicitudesdeverificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `FK_Usuario` FOREIGN KEY (`idUsu`) REFERENCES `usuarios` (`idUsu`);

--
-- Filtros para la tabla `ofertasaceptadas`
--
ALTER TABLE `ofertasaceptadas`
  ADD CONSTRAINT `ofertasaceptadas_ibfk_1` FOREIGN KEY (`idPerfil`) REFERENCES `perfiles` (`idPerfil`),
  ADD CONSTRAINT `ofertasaceptadas_ibfk_2` FOREIGN KEY (`idAlq`) REFERENCES `alquileres` (`idAlq`);

--
-- Filtros para la tabla `ofertasdealquiler`
--
ALTER TABLE `ofertasdealquiler`
  ADD CONSTRAINT `ofertasdealquiler_ibfk_1` FOREIGN KEY (`idAlq`) REFERENCES `alquileres` (`idAlq`),
  ADD CONSTRAINT `ofertasdealquiler_ibfk_2` FOREIGN KEY (`idPerfil`) REFERENCES `perfiles` (`idPerfil`);

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD CONSTRAINT `perfiles_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuarios` (`idUsu`);

--
-- Filtros para la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD CONSTRAINT `reseñas_ibfk_1` FOREIGN KEY (`idOferta`) REFERENCES `ofertasaceptadas` (`id`);

--
-- Filtros para la tabla `respuestasresenias`
--
ALTER TABLE `respuestasresenias`
  ADD CONSTRAINT `respuestasresenias_ibfk_1` FOREIGN KEY (`idResenia`) REFERENCES `reseñas` (`idReseña`);

--
-- Filtros para la tabla `solicitudesdeverificacion`
--
ALTER TABLE `solicitudesdeverificacion`
  ADD CONSTRAINT `solicitudesdeverificacion_ibfk_1` FOREIGN KEY (`idPerfil`) REFERENCES `perfiles` (`idPerfil`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`mateo`@`localhost` EVENT `UpdateTiempoEsperaAlquileres` ON SCHEDULE EVERY 1 HOUR STARTS '2023-11-12 03:03:56' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE alquileres
    SET fechaEspera = NULL
    WHERE fechaEspera IS NOT NULL
    AND fechaEspera <= NOW()$$

CREATE DEFINER=`mateo`@`localhost` EVENT `rechazarOfertaAuto` ON SCHEDULE EVERY 1 HOUR STARTS '2023-11-12 03:10:49' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE ofertasdealquiler
SET estado = 'rechazada'
WHERE estado = 'pendiente'
AND fechaOferta <= DATE_SUB(NOW(), INTERVAL 3 DAY)$$

CREATE DEFINER=`mateo`@`localhost` EVENT `EliminarOfertasViejas` ON SCHEDULE EVERY 1 HOUR STARTS '2023-11-12 03:22:43' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM ofertasdealquiler
WHERE fechaOferta <= DATE_SUB(NOW(), INTERVAL 30 DAY)$$

CREATE DEFINER=`mateo`@`localhost` EVENT `UpdateEstadoOfertasAceptadas` ON SCHEDULE EVERY 1 HOUR STARTS '2023-11-12 03:55:45' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE ofertasaceptadas
SET estado = 'corriendo'
WHERE estado = 'pendiente'
AND fechaIni >= CURDATE()$$

CREATE DEFINER=`mateo`@`localhost` EVENT `UpdateEstadoOfertasAceptadas2` ON SCHEDULE EVERY 1 HOUR STARTS '2023-11-12 04:08:03' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE ofertasaceptadas
SET estado = 'finalizado'
WHERE estado = 'corriendo'
AND fechaFin >= CURDATE()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
