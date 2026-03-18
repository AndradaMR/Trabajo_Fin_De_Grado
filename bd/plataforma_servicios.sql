-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2026 a las 21:52:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plataforma_servicios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_categoria_padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `id_categoria_padre`) VALUES
(1, 'Aventura', NULL),
(2, 'Bienestar', NULL),
(4, 'Escalada', 1),
(5, 'Senderismo', 1),
(6, 'Yoga', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_actividad`
--

CREATE TABLE `detalle_actividad` (
  `id` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `plazas_maximas` int(11) NOT NULL
) ;

--
-- Volcado de datos para la tabla `detalle_actividad`
--

INSERT INTO `detalle_actividad` (`id`, `id_servicio`, `fecha`, `hora_inicio`, `hora_fin`, `plazas_maximas`) VALUES
(1, 1, '2026-04-10', '10:00:00', '12:00:00', 15),
(2, 1, '2026-04-11', '16:00:00', '18:00:00', 15),
(3, 2, '2026-04-12', '09:00:00', '11:00:00', 10),
(4, 3, '2026-04-13', '19:00:00', '20:30:00', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre_empresa` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nombre_empresa`, `email`, `contrasena`, `direccion`, `telefono`) VALUES
(1, 'empresa1', 'contacto@aventuramadrid.com', 'empresa1', 'Calle Mayor 10, Madrid', '910000111'),
(2, 'empresa2', 'info@natureescape.com', 'empresa2', 'Av. Sierra 45, Segovia', '910000222');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_servicio`
--

CREATE TABLE `imagen_servicio` (
  `id_imagen` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `imagen_servicio`
--

INSERT INTO `imagen_servicio` (`id_imagen`, `id_servicio`, `url_imagen`) VALUES
(1, 1, 'imagenes/senderismo1.jpg'),
(2, 1, 'imagenes/senderismo2.jpg'),
(3, 2, 'imagenes/escalada1.jpg'),
(4, 3, 'imagenes/yoga1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resena`
--

CREATE TABLE `resena` (
  `id_resena` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ;

--
-- Volcado de datos para la tabla `resena`
--

INSERT INTO `resena` (`id_resena`, `id_usuario`, `id_servicio`, `puntuacion`, `comentario`, `fecha`) VALUES
(1, 1, 1, 5, 'Ruta increíble, muy recomendable.', '2026-04-10 18:00:00'),
(2, 2, 1, 4, 'Muy buena experiencia.', '2026-04-10 19:00:00'),
(3, 4, 2, 5, 'Los monitores explican muy bien.', '2026-04-12 13:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` enum('pendiente','confirmada','cancelada') NOT NULL DEFAULT 'pendiente',
  `id_detalle_actividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `id_usuario`, `id_servicio`, `fecha_hora`, `estado`, `id_detalle_actividad`) VALUES
(1, 1, 1, '2026-04-10 10:00:00', 'confirmada', 1),
(2, 2, 1, '2026-04-10 10:00:00', 'pendiente', 1),
(3, 4, 2, '2026-04-12 09:00:00', 'confirmada', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
(3, 'administrador'),
(2, 'empresa'),
(1, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nombre_servicio` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `lugar` varchar(150) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `id_empresa`, `nombre_servicio`, `descripcion`, `lugar`, `id_categoria`, `precio`) VALUES
(1, 1, 'Ruta guiada de senderismo', 'Excursión guiada por la sierra con monitor especializado', 'Sierra de Guadarrama', 5, 25.00),
(2, 1, 'Escalada para principiantes', 'Curso de iniciación a la escalada en roca', 'La Pedriza', 4, 40.00),
(3, 2, 'Clase de Yoga al aire libre', 'Sesión de yoga para todos los niveles', 'Parque del Retiro', 6, 15.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_empresa`
--

CREATE TABLE `solicitud_empresa` (
  `id_solicitud` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `datos` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','aprobada','rechazada') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `solicitud_empresa`
--

INSERT INTO `solicitud_empresa` (`id_solicitud`, `id_empresa`, `nombre`, `email`, `datos`, `fecha`, `estado`) VALUES
(1, NULL, 'Aventuras Extremas', 'aventuras@email.com', 'Empresa especializada en rafting y barranquismo', '2026-03-05 10:00:00', 'pendiente'),
(2, 1, 'empresa1', 'contacto@aventuramadrid.com', 'Solicitud aprobada para publicar actividades', '2026-03-01 09:00:00', 'aprobada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `email`, `contrasena`, `telefono`, `id_rol`, `fecha_registro`) VALUES
(1, 'Laura', 'laura@email.com', 'Laura', '611234567', 3, '2026-03-01 10:15:00'),
(2, 'Andrada', 'carlos@email.com', 'Andrada', '622345678', 3, '2026-03-02 12:20:00'),
(3, 'Cris', 'admin@email.com', 'Cris', '600000000', 3, '2026-03-01 09:00:00'),
(4, 'Usuario1', 'user1@email.com', 'hash789', '600000000', 1, '2026-03-01 09:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_categoria_padre` (`id_categoria_padre`);

--
-- Indices de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_detalle_id_servicio` (`id_servicio`),
  ADD KEY `idx_detalle_fecha` (`fecha`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `imagen_servicio`
--
ALTER TABLE `imagen_servicio`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `idx_imagen_id_servicio` (`id_servicio`);

--
-- Indices de la tabla `resena`
--
ALTER TABLE `resena`
  ADD PRIMARY KEY (`id_resena`),
  ADD UNIQUE KEY `uq_resena_usuario_servicio` (`id_usuario`,`id_servicio`),
  ADD KEY `idx_resena_id_usuario` (`id_usuario`),
  ADD KEY `idx_resena_id_servicio` (`id_servicio`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `idx_reserva_id_usuario` (`id_usuario`),
  ADD KEY `idx_reserva_id_servicio` (`id_servicio`),
  ADD KEY `idx_reserva_id_detalle` (`id_detalle_actividad`),
  ADD KEY `idx_reserva_fecha_hora` (`fecha_hora`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `idx_servicio_id_empresa` (`id_empresa`),
  ADD KEY `idx_servicio_id_categoria` (`id_categoria`);

--
-- Indices de la tabla `solicitud_empresa`
--
ALTER TABLE `solicitud_empresa`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `idx_solicitud_id_empresa` (`id_empresa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_usuario_id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagen_servicio`
--
ALTER TABLE `imagen_servicio`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `resena`
--
ALTER TABLE `resena`
  MODIFY `id_resena` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitud_empresa`
--
ALTER TABLE `solicitud_empresa`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_padre` FOREIGN KEY (`id_categoria_padre`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_actividad`
--
ALTER TABLE `detalle_actividad`
  ADD CONSTRAINT `fk_detalle_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen_servicio`
--
ALTER TABLE `imagen_servicio`
  ADD CONSTRAINT `fk_imagen_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resena`
--
ALTER TABLE `resena`
  ADD CONSTRAINT `fk_resena_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_resena_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_detalle` FOREIGN KEY (`id_detalle_actividad`) REFERENCES `detalle_actividad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_servicio_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_servicio_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_empresa`
--
ALTER TABLE `solicitud_empresa`
  ADD CONSTRAINT `fk_solicitud_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
